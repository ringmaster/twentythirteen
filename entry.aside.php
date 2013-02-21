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
		<?php echo $content->meta; ?>
		<?php echo $content->showeditlink; ?>

		<?php if ( $content->author->info->bio != '' && Users::get(array('count'=>true)) > 1 ) : ?>
			<?php $theme->display( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->

	<?php else : ?>
	<footer class="entry-meta">
		<?php echo $content->meta; ?>
		<?php echo $content->showeditlink; ?>
	</footer><!-- .entry-meta -->
	<?php endif; // is_single() ?>
</article><!-- #post -->
