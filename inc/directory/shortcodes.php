<?php
/**
 * Annuaire Local - Shortcodes
 */

function medazin_listing_search_shortcode( $atts = array(), $content = '' ): string {
    $sector_terms = get_terms( array( 'taxonomy' => 'sector', 'hide_empty' => false ) );
    $region_terms = get_terms( array( 'taxonomy' => 'region', 'hide_empty' => false ) );

    $current_sector = isset($_GET['sector']) ? sanitize_text_field( wp_unslash( $_GET['sector'] ) ) : '';
    $current_region = isset($_GET['region']) ? sanitize_text_field( wp_unslash( $_GET['region'] ) ) : '';
    $current_s      = isset($_GET['s']) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '';

    $action = get_post_type_archive_link( 'listing' );

    ob_start();
    ?>
    <form class="listing-search-form" action="<?php echo esc_url( $action ); ?>" method="get">
        <div class="row g-2 align-items-end">
            <div class="col-md-4">
                <label class="form-label"><?php echo esc_html__( 'Mot-clé', 'medazin' ); ?></label>
                <input type="text" class="form-control" name="s" value="<?php echo esc_attr( $current_s ); ?>" placeholder="<?php echo esc_attr__( 'Que cherchez-vous ?', 'medazin' ); ?>" />
                <input type="hidden" name="post_type" value="listing" />
            </div>
            <div class="col-md-3">
                <label class="form-label"><?php echo esc_html__( 'Secteur', 'medazin' ); ?></label>
                <select class="form-select" name="sector">
                    <option value=""><?php echo esc_html__( 'Tous les secteurs', 'medazin' ); ?></option>
                    <?php foreach ( $sector_terms as $term ) : ?>
                        <option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $current_sector, $term->slug ); ?>><?php echo esc_html( $term->name ); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-3">
                <label class="form-label"><?php echo esc_html__( 'Région', 'medazin' ); ?></label>
                <select class="form-select" name="region">
                    <option value=""><?php echo esc_html__( 'Toutes les régions', 'medazin' ); ?></option>
                    <?php foreach ( $region_terms as $term ) : ?>
                        <option value="<?php echo esc_attr( $term->slug ); ?>" <?php selected( $current_region, $term->slug ); ?>><?php echo esc_html( $term->name ); ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary w-100"><?php echo esc_html__( 'Rechercher', 'medazin' ); ?></button>
            </div>
        </div>
    </form>
    <?php
    return ob_get_clean();
}
add_shortcode( 'listing_search', 'medazin_listing_search_shortcode' );

function medazin_listing_grid_shortcode( $atts = array() ): string {
    $atts = shortcode_atts( array(
        'posts_per_page' => 12,
        'columns'        => 3,
    ), $atts, 'listing_grid' );

    $paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1;

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

    $args = array(
        'post_type'      => 'listing',
        's'              => isset($_GET['s']) ? sanitize_text_field( wp_unslash( $_GET['s'] ) ) : '',
        'posts_per_page' => (int) $atts['posts_per_page'],
        'paged'          => $paged,
    );
    if ( ! empty( $tax_query ) ) {
        $args['tax_query'] = $tax_query;
    }

    $query = new WP_Query( $args );

    ob_start();
    $col = max(1, min(4, (int) $atts['columns']));
    echo '<div class="row listing-grid">';
    if ( $query->have_posts() ) {
        while ( $query->have_posts() ) {
            $query->the_post();
            echo '<div class="col-lg-' . (12/$col) . ' col-md-6 mb-4">';
            get_template_part('template-parts/content/content','listing');
            echo '</div>';
        }
    } else {
        echo '<div class="col-12">';
        get_template_part('template-parts/content/content','none');
        echo '</div>';
    }
    echo '</div>';

    // Pagination
    $big = 999999999; // need an unlikely integer
    $paginate = paginate_links( array(
        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
        'format'    => '?paged=%#%',
        'current'   => max( 1, get_query_var('paged') ),
        'total'     => $query->max_num_pages,
        'prev_text' => '<i class="fas fa-chevron-left"></i>',
        'next_text' => '<i class="fas fa-chevron-right"></i>',
        'type'      => 'list',
    ) );
    if ( $paginate ) {
        echo '<div class="listing-pagination">' . $paginate . '</div>';
    }

    wp_reset_postdata();
    return ob_get_clean();
}
add_shortcode( 'listing_grid', 'medazin_listing_grid_shortcode' );