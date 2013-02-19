<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php echo $content->id; ?>" <?php echo $content->class; ?>>
	<header class="entry-header">
		<?php if ( false && has_post_thumbnail() && ! is_single() && ! post_password_required() ) : ?>
		<div class="entry-thumbnail">
			<?php the_post_thumbnail(); ?>
		</div>
		<?php endif; ?>

		<?php if ( $request->display_entry ) : ?>
		<h1 class="entry-title"><?php echo $content->title; ?></h1>
		<?php else : ?>
		<h1 class="entry-title">
			<a href="<?php $content->permalink; ?>" title="<?php echo _e( 'Permalink to %s', 'twentythirteen' ), array( $content->title ); ?>" rel="bookmark"><?php echo $content->title; ?></a>
		</h1>
		<?php endif; // is_single() ?>

		<div class="entry-meta">
			<?php false && twentythirteen_entry_meta(); ?>
			<?php if($content->get_access()->edit): ?>
			<a href="<?php echo $content->editlink; ?>"><span class="edit-link"><?php _e('Edit', 'twentythirteen'); ?></span></a>
			<?php endif; ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<?php if ( $request->display_search ) : // Only display Excerpts for Search ?>
	<div class="entry-summary">
		<?php echo $content->content_excert; ?>
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

		<?php if ( $request->display_post && $content->user->info->profile != '' && Users::get(array('count'=>true)) > 1 ) : ?>
			<?php $theme->display( 'author-bio' ); ?>
		<?php endif; ?>
	</footer><!-- .entry-meta -->
</article><!-- #post -->
