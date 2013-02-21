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
		}
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

	function action_form_publish_entry($form, $post, $context) {
		$options = array(
			'standard' => 'Standard Entry',
			'audio' => 'Audio',
			'chat' => 'Chat',
			'quote' => 'Quote',
			'status' => 'Status',
			'video' => 'Video',
		);
		$form->settings->append(new FormControlSelect('format', $post, 'Post Format', $options, 'tabcontrol_select'));
	}

	function filter_body_class( $class, $theme ) {
		/* if ( wp_style_is( 'twentythirteen-fonts', 'queue' ) ) */
		$class[] = 'custom-font';

		/* if ( ! is_multi_author() ) */
		$class[] = 'single-author';

		if ( $theme->area( 'sidebar_1' ) != '' /* && ! is_attachment() */ && $theme->request->display_404 != 1 ) {
			$class[] = 'sidebar';
		}
		return $class;
	}

	function filter_post_meta( $something, $content ) {
		$meta = '';
		$content_type = Post::type_name( $content->content_type );

		if ( $content_type !== 'aside' && $content_type !== 'link' && $content_type == 'entry' ) { // is that last one even necessary? WP checked it was 'post'
			// I do not understand this following line.
			// $format_prefix = ( has_post_format( 'chat' ) || has_post_format( 'status' ) ) ? _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' ): '%2$s';
			$meta .= sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
				$content->permalink,
				_t( 'Permalink to %s', array( $content->permalink ), 'twentythirteen' ),
				$content->pubdate->format( 'c' ),
				$content->pubdate->format( Options::get('dateformat') . ' ' . Options::get('timeformat'))
			);
		}

		if ( count( $content->categories ) ) {
			$meta .= '<span class="categories-links">'.
				Format::tag_and_list( $content->categories, _t( ', ', 'twentythirteen'), _t( ', ', 'twentythirteen' ) /* no ', and ' */ ) .
				'</span>';
		}

		if ( count( $content->tags ) ) {
			$meta .= '<span class="tags-links">'.
				Format::tag_and_list( $content->tags, _t( ', ', 'twentythirteen'), _t( ', ', 'twentythirteen' ) /* no ', and ' */ ) .
				'</span>';
		}
		// Post author
		if ( $content_type == 'entry' ) {
			$meta .= sprintf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
				$content->author->id, // esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				_t( 'View all posts by %s', array( $content->author->username ), 'twentythirteen' ),
				$content->author->username
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
		$email_hash = md5(strtolower(trim($user->email)));
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


}

?>
