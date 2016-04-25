<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php
echo do_shortcode('[portfolio tags="" skills="' . (isset($_REQUEST['skills_tax']) ? $_REQUEST['skills_tax'] : 'all') . '" clients="' . (isset($_REQUEST['clients_tax']) ? $_REQUEST['clients_tax'] : 'all') . '" posts_per_page="' . TMM::get_option('folio_archive_per_page') . '"]' . TMM::get_option('folio_archive_layout') . '[/portfolio]');

