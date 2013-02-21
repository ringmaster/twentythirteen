<?php
$comment = $content;
switch ( $comment->typename ) :
case 'pingback' :
case 'trackback' :
// Display trackbacks differently than normal comments.
?>
<li id="comment-<?php $comment->id; ?>">
	<p><?php _e( 'Pingback:', 'twentythirteen' ); ?> <?php $comment->name; ?></p>
	<?php
	break;
	default :
	// Proceed with normal comments.
	?>
<li id="li-comment-<?php $comment->id; ?>">
	<article id="comment-<?php $comment->id; ?>">
		<div class="comment-author vcard">
			<?php echo $theme->get_avatar( $comment->email, 74 ); ?>
			<cite class="fn"><?php $theme->comment_author_link($comment); ?></cite>
		</div><!-- .comment-author -->

		<header class="comment-meta">
			<?php
			_e(
				'<a href="%1$s"><time datetime="%2$s">%3$s</time></a>',
				array(
					$comment->post->permalink . '#comment-' . $comment->id,
					$comment->date->text_format('{M} {j}, {Y} at {h}:{i}{a}'),
				),
				'twentythirteen'
			);
			?>
		</header><!-- .comment-meta -->

		<?php if ( '0' == $comment->comment_approved ) : ?>
		<p class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'twentythirteen' ); ?></p>
		<?php endif; ?>

		<div class="comment-content">
			<?php echo Utils::htmlspecialchars($comment->content); ?>
		</div><!-- .comment-content -->

	</article><!-- #comment-## -->
<?php
break;
endswitch; // End comment_type check.
?>