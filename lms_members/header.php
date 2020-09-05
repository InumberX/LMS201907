<!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width,initial-scale=1">
<meta name="format-detection" content="telephone=no">
<meta http-equiv="X-UA-Compatible" content="IE=Edge">
<?php wp_head(); ?>
</head>

<body id="<?php echo get_post_meta($post->ID, 'page_id' ,true); ?>" <?php body_class(); ?>>
<div class="wrap-all">
<header class="head-wrap">
<div class="inner">
<div class="head-brand">
<h1 class="logo">
<a href="<?php echo esc_url( home_url( '/' ) ); ?>">
<img src="<?php header_image(); ?>" alt="<?php get_bloginfo(); ?>">
</a>
</h1>
</div><!-- /.head-brand -->
</div><!-- /.inner -->
</header>

<main class="main-wrap">
<article class="contents-wrap">