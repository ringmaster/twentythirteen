<?php
/**
 * The template for displaying Comments.
 *
 * The area of the page that contains both current comments and the comment
 * form. The actual display of comments is handled by a callback to
 * twentythirteen_comment() which is located in the functions.php file.
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */
$post = $content;
?>

<div id="comments" class="comments-area">

	<?php if ( $post->comments->moderated->count > 0 ) : ?>
		<h2 class="comments-title">
			<?php
				_ne(
					_t('One thought on &ldquo;<span>%1$s</span>&rdquo;', array($content->title)),
					_t('%1$s thoughts on &ldquo;<span>%2$s</span>&rdquo;', array($content->comments->moderated->count, $content->title)),
					$content->comments->moderated->count,
					'twentythirteen'
				);
			?>
		</h2>

		<ol class="comment-list">
			<?php foreach($post->comments->moderated as $comment): ?>
			<?php echo $theme->content($comment); ?>
			<?php endforeach; ?>
		</ol><!-- .comment-list -->

		<?php if ( $post->info->comments_disabled && $content->comments->moderated->count == 0 ) : ?>
		<p class="no-comments"><?php _e( 'Comments are closed.' , 'twentythirteen' ); ?></p>
		<?php endif; ?>

	<?php endif; // have_comments() ?>

	<div id="respond" class="js">
		<h3 id="reply-title">Leave a Reply</h3>
		<?php $post->comment_form()->out(); ?>
	</div><!-- #respond -->
</div><!-- #comments -->
