<?php if (!defined('ABSPATH')) die('No direct access allowed'); ?>
<?php if ($_REQUEST['sidebar_position'] != 'no_sidebar'): ?>
	</section>
	<?php if ($_REQUEST['sidebar_position'] != 'no_sidebar'): ?>
		<aside id="sidebar" class="one-third column"><?php TMM_Custom_Sidebars::show_custom_sidebars(); ?></aside>
	<?php endif; ?>
<?php endif; ?>

</div><!--/ .container-->
<?php
if (is_page() AND $_REQUEST['sidebar_position'] == 'no_sidebar') {
	global $post;
	if (class_exists('TMM_Ext_LayoutConstructor')) {
		TMM_Ext_LayoutConstructor::draw_front($post->ID);
	}
}
?>
</section><!--/ #content -->


<!-- - - - - - - - - - - - - end Main - - - - - - - - - - - - - - - - -->


<!-- - - - - - - - - - - - - - - Footer - - - - - - - - - - - - - - - - -->

<?php if ((bool) !TMM::get_option("hide_footer")) : ?>

	<footer id="footer">

		<div class="container">

			<div class="one-third column">

				<?php if (function_exists('dynamic_sidebar') AND dynamic_sidebar('Footer Sidebar 1'))  ?>

			</div><!--/ .column-->

			<div class="one-third column">

				<?php if (function_exists('dynamic_sidebar') AND dynamic_sidebar('Footer Sidebar 2'))  ?>

			</div><!--/ .column-->

			<div class="one-third column">

				<?php if (function_exists('dynamic_sidebar') AND dynamic_sidebar('Footer Sidebar 3'))  ?>

			</div><!--/ .column-->

			<?php if (is_active_sidebar('footer_sidebar_4') OR is_active_sidebar('footer_sidebar_5')) : ?>

				<div class="clear"></div>
				<div class="divider"></div>

				<div class="eight columns">
					<?php
					if (is_active_sidebar('footer_sidebar_4')) {
						dynamic_sidebar('Footer Sidebar 4');
					}
					?>
				</div><!--/ .columns-->

				<div class="eight columns">
					<?php
					if (is_active_sidebar('footer_sidebar_5')) {
						dynamic_sidebar('Footer Sidebar 5');
					}
					?>
				</div><!--/ .columns-->

			<?php endif; ?>

			<div class="clear"></div>

			<div class="bottom-footer clearfix">

				<div class="copyright">
					<?php echo TMM::get_option("copyright_text") ?>
				</div><!--/ .copyright-->

			</div><!--/ .bottom-footer-->

		</div><!--/ .container-->

	</footer><!--/ #footer-->

<?php endif; ?>

<!-- - - - - - - - - - - - - - end Footer - - - - - - - - - - - - - - - -->

<?php wp_footer(); ?>

</body>
</html>
