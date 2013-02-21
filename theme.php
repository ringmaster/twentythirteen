<?php

class TwentyThirteenTheme extends Theme
{
	function action_template_header($theme) {
		// Add the HTML5 shiv for IE < 9
		Stack::add('template_header_javascript', array('http://cdnjs.cloudflare.com/ajax/libs/html5shiv/r29/html5.js', null, '<!--[if lt IE 9]>%s<![endif]-->'), 'html5_shiv');

		// Add this line to your config.php to show an error and a notice, and
		// to process the raw LESS code via javascript instead of the rendered CSS:  define('DEBUG_THEME', 1);
		if(defined('DEBUG_THEME')) {
			Session::error('This is a <b>sample error</b>');
			Session::notice('This is a <b>sample notice</b> for ' . $_SERVER['REQUEST_URI']);

			Stack::add('template_header_javascript', $theme->get_url('/less/less-1.3.0.min.js'), 'less');
			Stack::add('template_stylesheet', array($theme->get_url('/less/style.less'), null, array('type'=> null, 'rel' => 'stylesheet/less')), 'style');
		}
		else {
			Stack::add('template_stylesheet', $theme->get_url('/css/style.css'), 'style');
			Stack::add('template_stylesheet', 'http://fonts.googleapis.com/css?family=Source+Sans+Pro:400,700,300italic,400italic,700italic|Bitter:400,700&#038;subset=latin,latin-ext', 'bitter');
			$header_bg = Site::get_url('theme', '/assets/images/headers/' . Options::get('theme_header_background', 'circle.jpg'));
			$header_styles = <<< HEADER_STYLES
.site-header {
background: #999 url({$header_bg});
}
HEADER_STYLES;

			Stack::add('template_stylesheet', $header_styles, 'header');
		}
	}

	public function action_theme_ui( $theme )
	{
		$ui = new FormUI( __CLASS__ );
		$headers_dir = Site::get_dir('theme') . '/assets/images/headers/*';
		$headers = Utils::glob($headers_dir);
		$options = array_combine(array_map('basename', $headers), array_map('basename', $headers));
		$ui->append( new FormControlSelect('background', 'option:theme_header_background', 'Header Background Image:', $options));

		// Save
		$ui->append( 'submit', 'save', _t( 'Save' ) );
		$ui->set_option( 'success_message', _t( 'Options saved' ) );
		$ui->out();
	}

	/**
	 * @param string $class
	 * @param Post $post
	 * @return string
	 */
	function filter_post_class($class, $post) {
		if(empty($class)) {
			$class = array();
		}
		elseif(is_string($class)) {
			$class = array($class);
		}
		if(isset($post->info->class)) {
			$class[] = $post->info->class;
		}
		$class = array_merge($class, $post->content_type());
		if($post->content_type == Post::type('entry')) {
			if(isset($post->info->format)) {
				array_unshift($class, 'format-' . $post->info->format);
			}
			else {
				array_unshift($class, 'format-standard');
			}
		}
		$class[] = 'hentry';
		return implode(' ', $class);
	}

	function filter_content_type($type, $post) {
		if($post->content_type == Post::type('entry')) {
			if(isset($post->info->format)) {
				array_unshift($type, 'entry.' . $post->info->format);
			}
			else {
				array_unshift($type, 'entry.standard');
			}
		}
		return $type;
	}

	function get_formats() {
		return array(
			'standard' => 'Standard Entry',
			'aside' => 'Aside',
			'audio' => 'Audio',
			'chat' => 'Chat',
			'gallery' => 'Gallery',
			'image' => 'Image',
			'link' => 'Link',
			'quote' => 'Quote',
			'status' => 'Status',
			'video' => 'Video',
		);
	}


	function action_form_publish_entry($form, $post, $context) {
		$options = $this->get_formats();
		$form->settings->append(new FormControlSelect('format', $post, 'Post Format', $options, 'tabcontrol_select'));
	}

	function filter_body_class( $class, $theme ) {
		/* if ( wp_style_is( 'twentythirteen-fonts', 'queue' ) ) */
		$class[] = 'custom-font';

		/* if ( ! is_multi_author() ) */
		//$class[] = 'single-author';

		if ( $theme->area( 'sidebar_1' ) != '' /* && ! is_attachment() */ && $theme->request->display_404 != 1 ) {
			$class[] = 'sidebar';
		}
		return $class;
	}

	function filter_post_meta( $something, $post ) {
		$meta = '';
		$post_type = Post::type_name( $post->content_type );

		if ( $post_type !== 'aside' && $post_type !== 'link' ) {
			$formats = $this->get_formats();
			$linktext = ( in_array($post->info->format, array('chat', 'status')) ) ? _t( '%1$s on %2$s', array($formats[$post->info->format], $post->pubdate->format( Options::get('dateformat') . ' ' . Options::get('timeformat')))) : $post->pubdate->format( Options::get('dateformat') . ' ' . Options::get('timeformat'));
			$meta .= sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
				$post->permalink,
				_t( 'Permalink to %s', array( $post->permalink ), 'twentythirteen' ),
				$post->pubdate->format( 'c' ),
				$linktext
			);
		}

		if ( count( $post->categories ) ) {
			$meta .= '<span class="categories-links">'.
				Format::tag_and_list( $post->categories, _t( ', ', 'twentythirteen'), _t( ', ', 'twentythirteen' ) /* no ', and ' */ ) .
				'</span>';
		}

		if ( count( $post->tags ) ) {
			$meta .= '<span class="tags-links">'.
				Format::tag_and_list( $post->tags, _t( ', ', 'twentythirteen'), _t( ', ', 'twentythirteen' ) /* no ', and ' */ ) .
				'</span>';
		}
		// Post author
		if ( in_array($post->typename, array('entry') )) {
			$meta .= sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
				$post->author->id, // esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				_t( 'View all posts by %s', array( $post->author->username ), 'twentythirteen' ),
				$post->author->username
			);
		}
		return $meta;
	}

	function action_form_user($form, $user)
	{
		$form->user_info->append(new FormControlTextArea('bio', $user, _t('Bio', 'twentythirteen')));
	}

	function get_avatar($user, $size = 96, $default = 'mystery')
	{
		if($user instanceof User) {
			$email_hash = md5(strtolower(trim($user->email)));
		}
		else {
			$email_hash = md5(strtolower(trim($user)));
		}
		$host = sprintf( "http://%d.gravatar.com", ( hexdec( $email_hash[0] ) % 2 ) );
		$default = "{$host}/avatar/ad516503a11cd5ca435acc9bb6523536?s={$size}";
		$classes = explode(' ', "avatar avatar-{$size} photo");
		$classes[] = 'avatar-default';
		$classes = implode(' ', $classes);
		$url = "{$host}/avatar/{$email_hash}?s={$size}&amp;" . urlencode($default);

		$avatar = <<< AVATAR_HTML
<img src="{$url}" class="{$classes}" height="{$size}" width="{$size}">
AVATAR_HTML;
		return $avatar;
	}

	/**
	 * @param $nothing
	 * @param Post $post
	 */
	function filter_post_showeditlink($nothing, $post)
	{
		if($post->get_access()->edit) {
			$edit = _t('Edit', 'twentythirteen');
			return <<< EDITLINK
<a href="{$post->editlink}"><span class="edit-link">{$edit}</span></a>
EDITLINK;
		}
		return '';
	}

	function filter_post_entrydate($nothing, $post)
	{
		$formats = $this->get_formats();
		$dateout = $post->pubdate->format( Options::get('dateformat') . ' ' . Options::get('timeformat'));
		$linktext = ( in_array($post->info->format, array('chat', 'status')) ) ? _t( '%1$s on %2$s', array($formats[$post->info->format], $dateout)) : $dateout;
		$meta = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
			$post->permalink,
			_t( 'Permalink to %s', array( $post->permalink ), 'twentythirteen' ),
			$post->pubdate->format( 'c' ),
			$linktext
		);

		return $meta;
	}

	public function filter_block_list( $block_list )
	{
		$block_list[ 'search' ] = _t( 'Search', 'twentythirteen' );
		return $block_list;
	}

	public function action_block_content_search( $block, $theme )
	{
		$block->content = <<< SEARCH_BLOCK_CONTENT
<form method="get" id="searchform" class="searchform" action="/search" role="search"> <label for="s" class="assistive-text">Search</label> <input type="search" class="field" name="criteria" value="" id="s" placeholder="Search …"> <input type="submit" class="submit" name="submit" id="searchsubmit" value="Search"> </form>
SEARCH_BLOCK_CONTENT;

	}

	public function action_form_comment( $form ) {
		$form->id = 'commentform';
		$form->cf_content->class[] = "comment-form-field comment-textarea";
		$form->cf_content->placeholder = _t( "Enter your comment here...", 'twentythirteen' );
		$form->cf_content->move_before( $form->cf_commenter );
		$form->cf_content->caption = '';
	}
}

?>
