<?php
/**
 * Page Template
 *
 * This template is the default page template. It is used to display content when someone is viewing a
 * singular view of a page ('page' post_type) unless another page template overrules this one.
 * @link http://codex.wordpress.org/Pages
 *
 * @package WooFramework
 * @subpackage Template
 */

get_header();
?>

<!-- #content Starts -->
<?php woo_content_before(); ?>
<div id="content" class="col-full woocommerce-page">

	<!-- #main Starts -->
	<?php woo_main_before(); ?>
	<section id="main">

		<?php woo_loop_before(); ?>

		<?php woocommerce_content(); ?>

	</section><!-- /#main -->

</div>

<?php get_footer(); ?>