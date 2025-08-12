<?php
/**
 * Annuaire Local - Taxonomies
 */

if ( ! function_exists( 'medazin_register_directory_taxonomies' ) ) {
    function medazin_register_directory_taxonomies(): void {
        // Sector taxonomy
        $sector_labels = array(
            'name'              => _x( 'Secteurs', 'taxonomy general name', 'medazin' ),
            'singular_name'     => _x( 'Secteur', 'taxonomy singular name', 'medazin' ),
            'search_items'      => __( 'Rechercher des secteurs', 'medazin' ),
            'all_items'         => __( 'Tous les secteurs', 'medazin' ),
            'edit_item'         => __( 'Modifier le secteur', 'medazin' ),
            'update_item'       => __( 'Mettre à jour le secteur', 'medazin' ),
            'add_new_item'      => __( 'Ajouter un nouveau secteur', 'medazin' ),
            'new_item_name'     => __( 'Nom du nouveau secteur', 'medazin' ),
            'menu_name'         => __( 'Secteurs', 'medazin' ),
        );

        register_taxonomy( 'sector', array( 'listing' ), array(
            'hierarchical'      => true,
            'labels'            => $sector_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'secteur' ),
            'show_in_rest'      => true,
        ) );

        // Region taxonomy
        $region_labels = array(
            'name'              => _x( 'Régions', 'taxonomy general name', 'medazin' ),
            'singular_name'     => _x( 'Région', 'taxonomy singular name', 'medazin' ),
            'search_items'      => __( 'Rechercher des régions', 'medazin' ),
            'all_items'         => __( 'Toutes les régions', 'medazin' ),
            'edit_item'         => __( 'Modifier la région', 'medazin' ),
            'update_item'       => __( 'Mettre à jour la région', 'medazin' ),
            'add_new_item'      => __( 'Ajouter une nouvelle région', 'medazin' ),
            'new_item_name'     => __( 'Nom de la nouvelle région', 'medazin' ),
            'menu_name'         => __( 'Régions', 'medazin' ),
        );

        register_taxonomy( 'region', array( 'listing' ), array(
            'hierarchical'      => true,
            'labels'            => $region_labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => array( 'slug' => 'region' ),
            'show_in_rest'      => true,
        ) );
    }
}
add_action( 'init', 'medazin_register_directory_taxonomies' );

/**
 * Seed default Djibouti regions on theme switch
 */
function medazin_seed_default_regions(): void {
    $default_regions = array( 'Djibouti', 'Ali Sabieh', 'Arta', 'Dikhil', 'Obock', 'Tadjourah' );

    foreach ( $default_regions as $region_name ) {
        if ( ! term_exists( $region_name, 'region' ) ) {
            wp_insert_term( $region_name, 'region' );
        }
    }
}
add_action( 'after_switch_theme', 'medazin_seed_default_regions' );