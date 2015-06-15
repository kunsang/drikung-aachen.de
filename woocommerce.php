<?php get_header(); ?>

<!-- BEGIN .container -->
<div class="container">

	<?php if ( has_post_thumbnail()) { ?>
		<div class="feature-img page"><?php the_post_thumbnail( 'featured-large' ); ?></div>
	<?php } else { ?>
		<div class="feature-img page"><img src="<?php bloginfo('template_directory'); ?>/images/default-page.png" alt="<?php the_title(); ?>" /></div>
	<?php } ?>

	<!-- BEGIN .row -->
	<div class="row">

		<!-- BEGIN .eight columns -->
		<div class="twelve columns">

			<!-- BEGIN .postarea -->

<!-- 		//	<?php echo do_shortcode( '[woocommerce_product_search]' ); ?> -->

			<div class="page postarea full hentry type-page">
				<?php woocommerce_content(); ?>
			<!-- END .postarea -->
			</div>

		<!-- END .eight columns -->
		</div>

<!-- 		<div class="four columns">
			<div class="sidebar">
			/*	<?php get_sidebar( 'right-sidebar' ); ?> */
			</div>
		</div> -->



	<!-- END .row -->
	</div>

<!-- END .container -->
</div>

<?php get_footer(); ?>