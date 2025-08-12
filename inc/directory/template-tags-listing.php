<?php
/**
 * Annuaire Local - Template tags for listings
 */

function medazin_get_listing_meta( int $post_id ): array {
    return array(
        'phone_primary'   => get_post_meta( $post_id, '_medazin_phone_primary', true ),
        'phone_secondary' => get_post_meta( $post_id, '_medazin_phone_secondary', true ),
        'email'           => get_post_meta( $post_id, '_medazin_email', true ),
        'website'         => get_post_meta( $post_id, '_medazin_website', true ),
        'address'         => get_post_meta( $post_id, '_medazin_address', true ),
        'opening_hours'   => get_post_meta( $post_id, '_medazin_opening_hours', true ),
        'latitude'        => get_post_meta( $post_id, '_medazin_latitude', true ),
        'longitude'       => get_post_meta( $post_id, '_medazin_longitude', true ),
        'logo_id'         => (int) get_post_meta( $post_id, '_medazin_logo_id', true ),
        'gallery_ids'     => get_post_meta( $post_id, '_medazin_gallery_ids', true ),
    );
}

function medazin_render_listing_contacts( int $post_id ): void {
    $meta = medazin_get_listing_meta( $post_id );
    echo '<ul class="listing-contacts">';
    if ( ! empty( $meta['phone_primary'] ) ) {
        echo '<li><i class="fas fa-phone"></i> <a href="tel:' . esc_attr( preg_replace('/\s+/', '', $meta['phone_primary'] ) ) . '">' . esc_html( $meta['phone_primary'] ) . '</a></li>';
    }
    if ( ! empty( $meta['phone_secondary'] ) ) {
        echo '<li><i class="fas fa-phone-alt"></i> <a href="tel:' . esc_attr( preg_replace('/\s+/', '', $meta['phone_secondary'] ) ) . '">' . esc_html( $meta['phone_secondary'] ) . '</a></li>';
    }
    if ( ! empty( $meta['email'] ) ) {
        echo '<li><i class="fas fa-envelope"></i> <a href="mailto:' . esc_attr( $meta['email'] ) . '">' . esc_html( $meta['email'] ) . '</a></li>';
    }
    if ( ! empty( $meta['website'] ) ) {
        echo '<li><i class="fas fa-globe"></i> <a target="_blank" rel="nofollow noopener" href="' . esc_url( $meta['website'] ) . '">' . esc_html( $meta['website'] ) . '</a></li>';
    }
    if ( ! empty( $meta['address'] ) ) {
        echo '<li><i class="fas fa-map-marker-alt"></i> ' . esc_html( $meta['address'] ) . '</li>';
    }
    echo '</ul>';
}