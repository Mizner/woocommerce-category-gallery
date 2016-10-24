<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/archive-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see        https://docs.woocommerce.com/document/template-structure/
 * @author        WooThemes
 * @package    WooCommerce/Templates
 * @version     2.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

get_header( 'shop' );

wp_enqueue_script( 'woo-cat-gallery-script', plugins_url( '../assets/woo-cat-gallery.js', __FILE__ ), [], null, true );
wp_enqueue_style( 'woo-cat-gallery-style', plugins_url( '../assets/woo-cat-gallery.css', __FILE__ ) );
add_action( 'wp_enqueue_scripts', 'woo_cat_gallery_enqueues' );
function woo_cat_gallery_enqueues() {

}

$queried_object = get_queried_object();
$args           = [
	'post_type'      => 'product',
	'posts_per_page' => - 1,
	'tax_query'      => array(
		'relation' => 'IN',
		array(
			'taxonomy' => 'product_cat',
			'field'    => 'slug',
			'terms'    => $queried_object->slug
		)
	),
];
$the_query      = new WP_Query( $args ); ?>
	<div id="woo-category-gallery">
		<div id="theImageContainer">
			<a href="" id="productImage">
				<div id="theImage"></div>
			</a>
		</div>
		<div id="theGalleryContainer">
			<?php
			while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
				<div class="theGalleryImage"
				     product_link="<?php the_permalink() ?>"
				     value="<?php echo get_the_post_thumbnail_url(); ?>"
				     style="background: url(<?php echo get_the_post_thumbnail_url(); ?>) center center no-repeat; background-size: cover;">
				</div>
				<?php
			endwhile;
			?>
		</div>
	</div>
<?php
wp_reset_postdata();

get_footer( 'shop' );
