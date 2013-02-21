<?php
/**
 * The template for displaying posts in the Link post format.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<article id="post-<?php $content->id; ?>" class="<?php echo $content->class; ?>">
	<header class="entry-header">
		<h1 class="entry-title">
			<h1 class="entry-title"><?php echo $content->title; ?></h1>
		</h1>

		<div class="entry-meta">
			<?php echo $content->entrydate; ?>
			<?php echo $content->showeditlink; ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->

	<div class="entry-content">
		<?php echo $content->content; ?>
	</div><!-- .entry-content -->

	<?php if ( $request->display_post ) : ?>
	<footer class="entry-meta">
		<?php echo $content->meta; ?>
		<?php if ( $content->author->info->bio != '' && Users::get(array('count'=>true)) > 1 ) : ?>
			<?php $theme->display( 'author-bio' ); ?>
		<?php endif; ?>
	</footer>
	<?php endif; // is_single() ?>
</article><!-- #post -->
