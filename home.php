<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme and one of the
 * two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * For example, it puts together the home page when no home.php file exists.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

$theme->display('header'); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">
		<?php if ( count($posts) > 0 ) : ?>

			<?php /* The loop */ ?>
			<?php foreach($posts as $post): ?>
				<?php echo $theme->content($post); ?>
			<?php endforeach; ?>

			<?php false && twentythirteen_paging_nav(); ?>

		<?php else : ?>
			<?php $theme->display('content-none'); ?>
		<?php endif; ?>

		</div><!-- #content -->
	</div><!-- #primary -->

<?php $theme->display('sidebar'); ?>
<?php $theme->display('footer'); ?>