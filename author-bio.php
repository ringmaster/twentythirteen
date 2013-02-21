<?php
/**
 * The template for displaying Author bios.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
?>

<div class="author-info">
	<div class="author-avatar">
		<?php echo $theme->get_avatar( $content->author, Options::get( 'bio_avatar_size', 74 ) ); ?>
	</div><!-- .author-avatar -->
	<div class="author-description">
		<h2><?php _e( 'About %s', array($content->author->displayname), 'twentythirteen' ); ?></h2>
		<p>
			<?php echo $content->author->info->bio; ?>
			<a class="author-link" href="<?php URL::out('author_url', $content->author); ?>" rel="author">
				<?php _e( 'View all posts by %s <span class="meta-nav">&rarr;</span>', array($content->author->displayname), 'twentythirteen' ); ?>
			</a>
		</p>
	</div><!-- .author-description -->
</div><!-- .author-info -->