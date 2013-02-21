<?php
/**
 * The template for displaying posts in the Quote post format.
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

	<footer class="entry-meta">
		<?php echo $content->meta; ?>

		<?php if ( !$content->info->comments_disabled ) : ?>
		<span class="comments-link">
			<?php echo $theme->comments_link( $content, $zero = _t('<span class="leave-reply">Leave a comment</span>', 'twentythirteen'), $one = _t('One comment so far', 'twentythirteen'), $many = _t('View all %s comments', 'twentythirteen'), $fragment =  'comments' ); ?>
		</span><!-- .comments-link -->
		<?php endif; // comments_open() ?>
		<?php if($content->get_access()->edit): ?>
			<a href="<?php echo $content->editlink; ?>"><span class="edit-link"><?php _e('Edit', 'twentythirteen'); ?></span></a>
		<?php endif; ?>

		<?php if ( $request->display_post && $content->author->info->bio != '' && Users::get(array('count'=>true)) > 1 ) : ?>
			<?php $theme->display( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
