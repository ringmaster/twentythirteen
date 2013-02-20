<?php
/**
 * The Header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Thirteen
 * @since Twenty Thirteen 1.0
 */


?><!DOCTYPE html>
<!--[if IE 7]>
<html class="ie ie7 <?php /* echo $html_class; */ ?>">
<![endif]-->
<!--[if IE 8]>
<html class="ie ie8 <?php /* echo $html_class; */ ?>">
<![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!-->
<html>
<!--<![endif]-->
<head>
	<meta charset="UTF-8" />
	<meta name="viewport" content="width=device-width" />
	<title><?php if($request->display_entry && isset($post)) { echo $post->title_title . ' - '; } ?><?php echo Options::get('title'); ?></title>
	<meta name="generator" content="Habari">
	<link rel="Shortcut Icon" href="<?php echo $theme->get_url('/favicon.png'); ?>">
	<?php echo $theme->header(); ?>
</head>

<body class="<?php echo $theme->body_class(); ?>">
	<div id="page" class="hfeed site">
		<header id="masthead" class="site-header" role="banner">
			<hgroup>
				<h1 class="site-title"><a href="<?php Site::out_url('habari'); ?>" title="<?php Options::out('title'); ?>" rel="home"><?php Options::out('title'); ?></a></h1>
				<h2 class="site-description"><?php Options::out('tagline'); ?></h2>
			</hgroup>

			<div id="navbar" class="navbar">
				<nav id="site-navigation" class="navigation main-navigation" role="navigation">
					<h3 class="menu-toggle"><?php _t( 'Menu', 'twentythirteen' ); ?></h3>
					<a class="assistive-text skip-link" href="#content" title="<?php _t( 'Skip to content', 'twentythirteen' ); ?>"><?php _t( 'Skip to content', 'twentythirteen' ); ?></a>
					<?php $theme->area('primary'); ?>
					<?php /* get_search_form(); */ ?>
				</nav><!-- #site-navigation -->
			</div><!-- #navbar -->
		</header><!-- #masthead -->

		<div id="main" class="site-main">
