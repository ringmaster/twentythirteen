<aside id="<?php echo $block->id; ?>" class="<?php echo $block->css_classes; ?>">
	<?php if($block->_show_title):?><h3 class="widget-title"><?php echo $block->title; ?></h3><?php endif; ?>
	<?php echo $content; ?>
</aside>
