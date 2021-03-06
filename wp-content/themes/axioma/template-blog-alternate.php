<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php

/*
  Template Name: Blog Alternate
 */

get_header();
wp_reset_query();
//posts query
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$posts_per_page = get_option('posts_per_page');
query_posts(array(
	'post_type' => 'post',
	'paged' => $paged,
	'posts_per_page' => $posts_per_page
		));
global $wp_query;
?>
<?php get_template_part('content', 'alternate'); ?>
<?php get_template_part('content', 'pagenavi'); ?>
<?php get_footer(); ?>