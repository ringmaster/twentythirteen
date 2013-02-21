<?php
/**
 * The template for displaying the footer.
 *
 * Contains footer content and the closing of the
 * #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

		</div><!-- #main -->
		<footer id="colophon" class="site-footer" role="contentinfo">
			<?php echo $theme->area( 'sidebar_2' ); ?>

			<div class="site-info">
				<a href="http://habariproject.org/" title="<?php _e( 'Semantic Personal Publishing Platform', 'twentythirteen' ); ?>"><?php _e( 'Proudly powered by %s', array( 'Habari' ), 'twentythirteen' ); ?></a>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<?php echo $theme->footer(); ?>
</body>
</html>
