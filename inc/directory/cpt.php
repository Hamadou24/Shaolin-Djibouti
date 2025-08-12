<?php
/**
 * Annuaire Local - Custom Post Type
 */

if ( ! function_exists( 'medazin_register_listing_cpt' ) ) {
    function medazin_register_listing_cpt(): void {
        $labels = array(
            'name'                  => _x( 'Fiches', 'Post Type General Name', 'medazin' ),
            'singular_name'         => _x( 'Fiche', 'Post Type Singular Name', 'medazin' ),
            'menu_name'             => __( 'Annuaire', 'medazin' ),
            'name_admin_bar'        => __( 'Fiche', 'medazin' ),
            'archives'              => __( 'Archives des fiches', 'medazin' ),
            'attributes'            => __( 'Attributs de la fiche', 'medazin' ),
            'all_items'             => __( 'Toutes les fiches', 'medazin' ),
            'add_new_item'          => __( 'Ajouter une nouvelle fiche', 'medazin' ),
            'add_new'               => __( 'Ajouter', 'medazin' ),
            'new_item'              => __( 'Nouvelle fiche', 'medazin' ),
            'edit_item'             => __( 'Modifier la fiche', 'medazin' ),
            'update_item'           => __( 'Mettre à jour', 'medazin' ),
            'view_item'             => __( 'Voir la fiche', 'medazin' ),
            'view_items'            => __( 'Voir les fiches', 'medazin' ),
            'search_items'          => __( 'Rechercher une fiche', 'medazin' ),
        );

        $args = array(
            'label'               => __( 'Fiche', 'medazin' ),
            'description'         => __( 'Fiches d\'entreprises et services (Djibouti)', 'medazin' ),
            'labels'              => $labels,
            'supports'            => array( 'title', 'editor', 'thumbnail', 'excerpt', 'comments' ),
            'hierarchical'        => false,
            'public'              => true,
            'show_ui'             => true,
            'show_in_menu'        => true,
            'menu_position'       => 5,
            'menu_icon'           => 'dashicons-store',
            'show_in_admin_bar'   => true,
            'show_in_nav_menus'   => true,
            'can_export'          => true,
            'has_archive'         => true,
            'rewrite'             => array( 'slug' => 'annuaire', 'with_front' => false ),
            'exclude_from_search' => false,
            'publicly_queryable'  => true,
            'show_in_rest'        => true,
        );

        register_post_type( 'listing', $args );
    }
}
add_action( 'init', 'medazin_register_listing_cpt' );

// Flush rewrite rules when the theme is switched to ensure CPT archive works
function medazin_flush_rewrite_on_switch(): void {
    medazin_register_listing_cpt();
    flush_rewrite_rules();
}
add_action( 'after_switch_theme', 'medazin_flush_rewrite_on_switch' );

/**
 * Enable taxonomy filtering on listing archives via GET params: sector, region
 */
function medazin_filter_listing_archive_query( WP_Query $query ): void {
    if ( is_admin() || ! $query->is_main_query() ) {
        return;
    }

    if ( ( $query->is_post_type_archive( 'listing' ) || ( $query->is_search() && isset($_GET['post_type']) && $_GET['post_type'] === 'listing') ) ) {
        $tax_query = array();

        if ( ! empty( $_GET['sector'] ) ) {
            $tax_query[] = array(
                'taxonomy' => 'sector',
                'field'    => 'slug',
                'terms'    => sanitize_text_field( wp_unslash( $_GET['sector'] ) ),
            );
        }
        if ( ! empty( $_GET['region'] ) ) {
            $tax_query[] = array(
                'taxonomy' => 'region',
                'field'    => 'slug',
                'terms'    => sanitize_text_field( wp_unslash( $_GET['region'] ) ),
            );
        }
        if ( ! empty( $tax_query ) ) {
            $query->set( 'tax_query', $tax_query );
        }
    }
}
add_action( 'pre_get_posts', 'medazin_filter_listing_archive_query' );