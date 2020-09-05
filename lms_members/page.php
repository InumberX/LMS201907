<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
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
