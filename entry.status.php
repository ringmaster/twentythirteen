<?php
/**
 * The template for displaying posts in the Status post format.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php echo $content->id; ?>" class="<?php echo $content->class; ?>">
	<div class="entry-content">
		<?php echo $content->content_out; ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php if ( $request->display_post ) : ?>
			<?php echo $content->meta; ?>
		<?php else : ?>
			<?php echo $content->pubdate->format( Options::get('dateformat') . ' ' . Options::get('timeformat')); ?>
		<?php endif; ?>
		<?php echo $content->showeditlink; ?>

		<?php if ( $request->display_post && $content->author->info->bio != '' && Users::get(array('count'=>true)) > 1 ) : ?>
			<?php $theme->display( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
