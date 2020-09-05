<?php
/**
 * The template for displaying search results pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
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