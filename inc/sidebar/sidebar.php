<?php	
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package medazin
 */

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */

function medazin_widgets_init() {	
	register_sidebar( array(
		'name' => __( 'Sidebar Widget Area', 'medazin' ),
		'id' => 'medazin-sidebar-primary',
		'description' => __( 'The Primary Widget Area', 'medazin' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title"><span></span>',
		'after_title' => '</h5>',
	) );
	

	register_sidebar( array(
		'name' => __( 'Footer 1', 'medazin' ),
		'id' => 'medazin-footer-1',
		'description' => __( 'The Footer Widget Area 1', 'medazin' ),
		'before_widget' => '<aside id="%1$s" class="%2$s col-lg-3 footer-content-wrap col-md-6">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer 2', 'medazin' ),
		'id' => 'medazin-footer-2',
		'description' => __( 'The Footer Widget Area 2', 'medazin' ),
		'before_widget' => '<aside id="%1$s" class="%2$s col-lg-3 footer-content-wrap col-md-6">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer 3', 'medazin' ),
		'id' => 'medazin-footer-3',
		'description' => __( 'The Footer Widget Area 3', 'medazin' ),
		'before_widget' => '<aside id="%1$s" class="%2$s col-lg-3 footer-content-wrap col-md-6">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'Footer 4', 'medazin' ),
		'id' => 'medazin-footer-4',
		'description' => __( 'The Footer Widget Area 4', 'medazin' ),
		'before_widget' => '<aside id="%1$s" class="%2$s col-lg-3 footer-content-wrap col-md-6">',
		'after_widget' => '</aside>',
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	
	register_sidebar( array(
		'name' => __( 'WooCommerce Widget Area', 'medazin' ),
		'id' => 'medazin-woocommerce-sidebar',
		'description' => __( 'This Widget area for WooCommerce Widget', 'medazin' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title">',
		'after_title' => '</h5>',
	) );	

	// Annuaire - Zones publicitaires
	register_sidebar( array(
		'name' => __( 'Ad - Header Banner', 'medazin' ),
		'id' => 'medazin-ad-header',
		'description' => __( 'Top header advertisement area', 'medazin' ),
		'before_widget' => '<div id="%1$s" class="widget widget-ad ad-header %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title visually-hidden">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => __( 'Ad - Archive Top', 'medazin' ),
		'id' => 'medazin-ad-archive-top',
		'description' => __( 'Advertisement area above the listing archive grid', 'medazin' ),
		'before_widget' => '<div id="%1$s" class="widget widget-ad ad-archive-top %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title visually-hidden">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => __( 'Ad - Archive Sidebar', 'medazin' ),
		'id' => 'medazin-ad-archive-sidebar',
		'description' => __( 'Sidebar advertisement area on listing archive pages', 'medazin' ),
		'before_widget' => '<aside id="%1$s" class="widget widget-ad ad-archive-sidebar %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title visually-hidden">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => __( 'Ad - Single Listing Sidebar', 'medazin' ),
		'id' => 'medazin-ad-single-sidebar',
		'description' => __( 'Sidebar advertisement area on single listing pages', 'medazin' ),
		'before_widget' => '<aside id="%1$s" class="widget widget-ad ad-single-sidebar %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h5 class="widget-title visually-hidden">',
		'after_title' => '</h5>',
	) );

	register_sidebar( array(
		'name' => __( 'Ad - Footer Banner', 'medazin' ),
		'id' => 'medazin-ad-footer',
		'description' => __( 'Footer banner advertisement area', 'medazin' ),
		'before_widget' => '<div id="%1$s" class="widget widget-ad ad-footer %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h5 class="widget-title visually-hidden">',
		'after_title' => '</h5>',
	) );
}
add_action( 'widgets_init', 'medazin_widgets_init' );
?>