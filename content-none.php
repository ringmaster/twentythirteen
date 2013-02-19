<?php
/**
 * The template for displaying a "No posts found" message.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<header class="page-header">
	<h1 class="page-title"><?php _e( 'Nothing Found', 'twentythirteen' ); ?></h1>
</header><!-- .page-header -->

<div class="page-content">
	<?php if ( $request->display_home && $user->can( 'publish_posts' ) ) : ?>

	<p><?php _e( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', array( Url::get( 'admin', array( 'page' => 'publish' ) ) ), 'twentythirteen' ); ?></p>

	<?php elseif ( $request->display_search ) : ?>

	<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with different keywords.', 'twentythirteen' ); ?></p>
	<?php get_search_form(); ?>

	<?php else : ?>

	<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'twentythirteen' ); ?></p>
	<?php get_search_form(); ?>

	<?php endif; ?>
</div><!-- .page-content -->
