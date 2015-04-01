<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>

<?php

if (TMM::get_option("blog_listing_template") == 0) {
	get_template_part('content', 'default');
} else {
	get_template_part('content', 'alternative');
}
