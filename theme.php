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

	function filter_post_class($class, $post) {
		if(empty($class) && isset($post->info->class)) {
			return ' class="' . $post->info->class . '" ';
		}
		return $class;
	}

	function filter_body_class( $class, $theme ) {
		/* if ( wp_style_is( 'twentythirteen-fonts', 'queue' ) ) */
		$class[] = 'custom-font';

		/* if ( ! is_multi_author() ) */
		$class[] = 'single-author';

		if ( $theme->area( 'sidebar-1' ) != '' /* && ! is_attachment() */ && $theme->request->display_404 != 1 ) {
			$class[] = 'sidebar';
		}
		return $class;
	}

	function filter_post_meta( $something, $content ) {
		$date = '';
		$content_type = Post::type_name( $content->content_type );

		if ( $content_type !== 'aside' && $content_type !== 'link' && $content_type == 'entry' ) { // is that last one even necessary? WP checked it was 'post'
			// I do not understand this following line.
			// $format_prefix = ( has_post_format( 'chat' ) || has_post_format( 'status' ) ) ? _x( '%1$s on %2$s', '1: post format name. 2: date', 'twentythirteen' ): '%2$s';
			$date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
				$content->permalink,
				_t( 'Permalink to %s', array( $content->permalink ), 'twentythirteen' ),
				$content->pubdate->format( 'c' ),
				$content->pubdate->format( Options::get('dateformat') . ' ' . Options::get('timeformat'))
			);
		}
/*		// Translators: used between list items, there is a space after the comma.
		$categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
		if ( $categories_list ) {
			echo '<span class="categories-links">' . $categories_list . '</span>';
		}

		// Translators: used between list items, there is a space after the comma.
		$tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
		if ( $tag_list ) {
			echo '<span class="tags-links">' . $tag_list . '</span>';
		}

		// Post author
		if ( $post->content_type == 'post' ) {
			printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
				esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
				get_the_author()
			);
		}
*/		return $date;
	}
}

?>
