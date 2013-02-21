<?php
/**
 * The template for displaying posts in the Aside post format.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php echo $content->id; ?>" class="<?php echo $content->class; ?>">
	<div class="entry-content">
		<?php echo $content->content_excerpt; ?>
	</div><!-- .entry-content -->

	<?php if ( $request->display_post ) : ?>
	<footer class="entry-meta">
		<?php echo $content->meta; /* $content didn't work paired with filter_content_meta */ ?>
		<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<span class="edit-link">', '</span>' ); ?>

		<?php if ( get_the_author_meta( 'description' ) && is_multi_author() ) : ?>
			<?php get_template_part( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->

	<?php else : ?>
		<?php edit_post_link( __( 'Edit', 'twentythirteen' ), '<footer class="entry-meta"><span class="edit-link">', '</span></footer><!-- .entry-meta -->' ); ?>
	<?php endif; // is_single() ?>
</article><!-- #post -->
