<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php get_header(); ?>
<?php
global $wp_query;
$value = get_query_var($wp_query->query_vars['taxonomy']);
$term = get_term_by('name', $value, 'clients');
$_REQUEST['clients_tax'] = $term->term_id;
?>
<?php get_template_part('content', TMM_Portfolio::$slug); ?>
<?php get_footer(); ?>
