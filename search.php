<?php
/**
 * The template for displaying Search Results pages.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

$theme->display('header'); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

		<?php if ( count($posts) > 0 ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php _e( 'Search Results for: %s', array($criteria), 'twentythirteen' ); ?></h1>
			</header>

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