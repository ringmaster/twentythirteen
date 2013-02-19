<?php
/**
 * The Template for displaying all single posts.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */

$theme->display('header'); ?>

	<div id="primary" class="content-area">
		<div id="content" class="site-content" role="main">

			<?php echo $theme->content( $post ); ?>

			<?php false && twentythirteen_post_nav(); ?>
			<?php comments_template(); ?>


		</div><!-- #content -->
	</div><!-- #primary -->

<?php $theme->display('sidebar'); ?>
<?php $theme->display('footer'); ?>
