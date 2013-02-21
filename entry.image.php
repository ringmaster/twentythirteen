<?php
/**
 * The template for displaying posts in the Image post format.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php echo $content->id; ?>" class="<?php echo $content->class; ?>">
	<header class="entry-header">
		<?php if ( $request->display_post ) : ?>
		<h1 class="entry-title"><?php echo $content->title; ?></h1>
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php echo $content->permalink; ?>" title="<?php _e( 'Permalink to %s', array( $content->title ), 'twentythirteen' ); ?>" rel="bookmark"><?php echo $content->title; ?></a>
		</h1>
		<?php endif; // is_single() ?>
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php echo $content->content_out; ?>
	</div><!-- .entry-content -->

	<footer class="entry-meta">
		<?php echo $content->entrydate; ?>

		<?php if ( !$content->info->comments_disabled ) : ?>
		<span class="comments-link">
			<?php echo $theme->comments_link( $content, $zero = _t('<span class="leave-reply">Leave a comment</span>', 'twentythirteen'), $one = _t('One comment so far', 'twentythirteen'), $many = _t('View all %s comments', 'twentythirteen'), $fragment =  'comments' ); ?>
		</span><!-- .comments-link -->
		<?php endif; // comments_open() ?>
		<?php echo $content->showeditlink; ?>

		<?php if ( $request->display_post && $content->author->info->bio != '' && Users::get(array('count'=>true)) > 1 ) : ?>
			<?php $theme->display( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
