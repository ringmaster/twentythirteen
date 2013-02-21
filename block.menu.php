<?php
echo Format::term_tree(
	$content->tree,
	$content->vocabulary->name,
	array(
		'itemcallback' => function( Term $term, $config )
{
	$title = $term->term_display;

	$active = false;

	$get_menu_type_data = function ()
	{
		static $menu_type_data = null;
		if ( empty($menu_type_data) ) {
			$menu_type_data = Plugins::filter('menu_type_data', array());
		}
		return $menu_type_data;
	};
	$menu_type_data = $get_menu_type_data();

	$spacer = false;
	$active = false;
	$link = null;
	if ( !isset($term->object_id) ) {
		$objects = $term->object_types();
		$term->type = reset($objects);
		$term->object_id = key($objects);
	}
	if ( isset($menu_type_data[$term->type]['render']) ) {
		$result = $menu_type_data[$term->type]['render']($term, $term->object_id, $config);
		$result = array_intersect_key(
			$result,
			array(
				'link' => 1,
				'title' => 1,
				'active' => 1,
				'spacer' => 1,
				'config' => 1,
			)
		);
		extract($result);
	}

	if ( empty( $link ) ) {
		$config[ 'wrapper' ] = sprintf($config[ 'linkwrapper' ], $title);
	}
	else {
		$config[ 'wrapper' ] = sprintf( $config[ 'linkwrapper' ], "<a href=\"{$link}\">{$title}</a>" );
	}
	if ( $active ) {
		$config[ 'itemattr' ][ 'class' ] = 'current-menu-item current_page_item active';
	}
	else {
		$config[ 'itemattr' ][ 'class' ] = 'inactive';
	}
	if ( $spacer ) {
		$config[ 'itemattr' ][ 'class' ] .= ' spacer';
	}
	return $config;
},
		'linkwrapper' => $content->wrapper,
		'theme' => $theme,
		'treestart' => '<ul %s>',
		'treeattr' => array('class' => $content->list_class . ' nav-menu', 'id' => Utils::slugify('tree_' . $tree_name)),
		'treeend' => '</ul>',
		'liststart' => '<ul %s>',
		'listattr' => array('class' => 'sub-menu'),
		'listend' => '</ul>',
		'itemstart' => '<li %s>',
		'itemattr' => array('class' => 'menu-item'),
		'itemend' => '</li>',
		'wrapper' => '<div>%s</div>',
	)
);
?>
