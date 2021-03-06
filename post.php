<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php echo $content->id; ?>" class="<?php echo $content->class; ?>">
	<header class="entry-header">
		<?php if ( false && has_post_thumbnail() && ! is_single() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>

		<?php if ( $request->display_post ) : ?>
		<h1 class="entry-title"><?php echo $content->title; ?></h1>
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php echo $content->permalink; ?>" title="<?php _e( 'Permalink to %s', array( $content->title ), 'twentythirteen' ); ?>" rel="bookmark"><?php echo $content->title; ?></a>
		</h1>
		<?php endif; // is_single() ?>

		<div class="entry-meta">
			<?php echo $content->meta; ?>
			<?php echo $content->showeditlink; ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( $request->display_search ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php echo $content->content_excerpt; ?>
	</div><!-- .entry-summary -->
	<?php else : ?>
	<div class="entry-content">
		<?php echo $content->content_out; ?>
	</div><!-- .entry-content -->
	<?php endif; ?>

	<footer class="entry-meta">
		<?php if ( !$content->info->comments_disabled ) : ?>
			<div class="comments-link">
				<?php echo $theme->comments_link( $content, $zero = _t('<span class="leave-reply">Leave a comment</span>', 'twentythirteen'), $one = _t('One comment so far', 'twentythirteen'), $many = _t('View all %s comments', 'twentythirteen'), $fragment =  'comments' ); ?>
			</div><!-- .comments-link -->
		<?php endif; // comments_open() ?>

		<?php if ( $request->display_post && $content->author->info->bio != '' && Users::get(array('count'=>true)) > 1 ) : ?>
			<?php $theme->display( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->

<?php if($request->display_post): ?>
<?php $theme->display('comments'); ?>
<?php endif; ?>
