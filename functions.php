<?php
//
// 	Custom functions
//

add_image_size( 'beitrag-large', 980, 550, true ); // Large Featured Image
add_image_size( 'beitrag-medium', 640, 340, true ); // Medium Featured Image
add_image_size( 'beitrag-small', 300, 150, true ); // Small Featured Image

function my_login_logo() { ?>
    <style type="text/css">
        body.login div#login h1 a {
        	width: 128px;
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/images/hung.svg);
            background-size: 128px;
            padding-bottom: 50px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'my_login_logo' );

// WooCommerce Support

// add_action( 'after_setup_theme', 'woocommerce_support' );
// function woocommerce_support() {
//     add_theme_support( 'woocommerce' );
// }

// WooCommerce tabs

add_filter( 'woocommerce_product_tabs', 'woo_remove_product_tabs', 98 );

function woo_remove_product_tabs ( $tabs ) {

	if( has_term( 'audio-cds', 'product_cat'  ) ){
		$tabs['audio_samples_tab'] = array(
				'title'		=>	'H&ouml;rbeispiele',
				'priority'	=>	15,
				'callback'	=>	'audio_samples_tab'
			);
	}
	if( has_term( 'buecher', 'product_cat'  ) ){
		$tabs['books_excerpt_tab'] = array(
				'title'		=>	'Leseprobe',
				'priority'	=>	15,
				'callback'	=>	'books_excerpt_tab'
			);
	}
	if( has_term( 'buecher', 'product_cat'  ) ){
		$tabs['books_recension_tab'] = array(
				'title'		=>	'Rezension',
				'priority'	=>	16,
				'callback'	=>	'books_recension_tab'
			);
	}
	return $tabs;

}

function audio_samples_tab() {
	if (get_field('hoerbeispiele')): ?>
		<div class="audio-samples">
			<h3>Hörbeispiele</h3>
			<?php while(has_sub_field('hoerbeispiele')): ?>
				<p><strong><?php the_sub_field('sample_name') ?></strong><br><a href="<?php the_sub_field('samples') ?>" class="sample"><?php the_sub_field('sample_name') ?></a></p>

			<?php endwhile; ?>
		</div>
	<?php endif;
}

function books_excerpt_tab() {
	if (get_field('books_excerpt')): ?>
		<div class="books-excerpt">
			<h2>Leseprobe</h2>
			<p><?php the_field('books_excerpt') ?></p>
		</div>
	<?php endif;
}

function books_recension_tab() {
	if (get_field('books_recension')): ?>
		<div class="books-recension">
			<h2>Rezension</h2>
			<p><?php the_field('books_recension') ?></p>
		</div>
	<?php endif;
}

// WooCommerce product count

add_filter( 'loop_shop_per_page', create_function( '$cols', 'return 24;' ), 20 );

// WooCommerce category description

//Display product category descriptions under category image/title on woocommerce shop page */

add_action( 'woocommerce_before_shop_loop', 'my_add_cat_description', 12);
function my_add_cat_description ($category) {
$cat_id=$category->term_id;
$prod_term=get_term($cat_id,'product_cat');
$description=$prod_term->description;
echo '<div class="shop_cat_desc">'.$description.'</div>';
}

//

// add_action( 'woocommerce_before_shop_loop', 'my_add_instasearch', 0);
// function my_add_instasearch () {
// echo '
// <div id="shop-search">
// 	<form action="/">
// 	<input type="text" name="s" placeholder="Shop durchsuchen">
// 	<input type="hidden" name="post_type" value="product">
// 	</form>
// </div>';
// }

//Page Slug Body Class
function add_slug_body_class( $classes ) {
	global $post;
	if ( isset( $post ) ) {
		$classes[] = $post->post_type . '-' . $post->post_name;
	}
	return $classes;
}
add_filter( 'body_class', 'add_slug_body_class' );

//


function my_em_custom_formats( $array ){
	$my_formats = array('dbem_single_event_format', 'dbem_category_event_list_item_format'); //the format you want to override, corresponding to file above.
	return $array + $my_formats; //return the default array and your formats.
}
add_filter('em_formats_filter', 'my_em_custom_formats', 1, 1);


// Woocommerce Sort Products by SKU

add_filter('woocommerce_get_catalog_ordering_args', 'am_woocommerce_catalog_orderby');
function am_woocommerce_catalog_orderby( $args ) {
    $args['meta_key'] = '_sku';
    $args['orderby'] = 'meta_value';
    $args['order'] = 'asc';
    return $args;
}

/*
usage: [events_list hide_recurring=1]
*/

add_filter('em_events_get_default_search','my_em_styles_get_default_search_hide_recurr',1,2);
function my_em_styles_get_default_search_hide_recurr($searches, $array){
    if( !empty($array['hide_recurring']) ){
        $searches['hide_recurring'] = $array['hide_recurring'];
    }
    return $searches;
}

add_filter('em_events_get','my_em_hide_recurr',1,2);
function my_em_hide_recurr($events, $args){
    if( !empty($args['hide_recurring']) && is_numeric($args['hide_recurring']) ){
        foreach($events as $event_key => $EM_Event){
            if ( !empty($EM_Event->recurrence_id) ){
                unset($events[$event_key]);
            }
        }
    }
    return $events;
}

//  Google Analytics

add_action('wp_footer', 'add_google_analytics');
function add_google_analytics() { ?>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-62503411-1', 'auto');
  ga('send', 'pageview');

</script>

<?php }

//  Lehrer Custom Post Type

function lehrer_custom_post_type() {

$labels = array(
'name' => _x( 'Lehrer', 'Post Type General Name', 'text_domain' ),
'singular_name' => _x( 'Lehrer', 'Post Type Singular Name', 'text_domain' ),
'menu_name' => __( 'Lehrer', 'text_domain' ),
'parent_item_colon' => __( 'Parent Information:', 'text_domain' ),
'all_items' => __( 'Alle Lehrer', 'text_domain' ),
'view_item' => __( 'Lehrer anzeigen', 'text_domain' ),
'add_new_item' => __( 'Neuen Lehrer hinzufügen', 'text_domain' ),
'add_new' => __( 'Neuer Lehrer', 'text_domain' ),
'edit_item' => __( 'Lehrer bearbeiten', 'text_domain' ),
'update_item' => __( 'Lehrer aktualisieren', 'text_domain' ),
'search_items' => __( 'Lehrer suchen', 'text_domain' ),
'not_found' => __( 'Kein Lehrer gefunden', 'text_domain' ),
'not_found_in_trash' => __( 'Kein Lehrer im Papierkorb gefunden', 'text_domain' ),
);
$rewrite = array(
'slug' => 'lehrer',
'with_front' => true,
'pages' => true,
'feeds' => true,
);
$args = array(
'label' => __( 'lehrer', 'text_domain' ),
'description' => __( 'Lehrer und ReferentInnen', 'text_domain' ),
'labels' => $labels,
'supports' => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields', 'post-formats', ),
'taxonomies' => array( 'category', 'post_tag' ),
'hierarchical' => true,
'public' => true,
'show_ui' => true,
'show_in_menu' => true,
'show_in_nav_menus' => true,
'show_in_admin_bar' => true,
'menu_position' => 5,
'menu_icon' => '/dashicons-admin-users',
'can_export' => true,
'has_archive' => false,
'exclude_from_search' => false,
'publicly_queryable' => true,
'rewrite' => $rewrite,
'capability_type' => 'page',
);
register_post_type( 'products', $args );

}

// Hook into the 'init' action
add_action( 'init', 'custom_post_type', 0 );

}