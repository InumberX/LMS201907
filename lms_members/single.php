<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package LMS
 */

get_header();
?>
<?php
  require(get_theme_root() . '/' .get_stylesheet() . '/vue-index.php');
?>
<?php
get_sidebar();
get_footer();