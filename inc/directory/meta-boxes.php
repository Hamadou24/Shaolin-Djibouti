<?php
/**
 * Annuaire Local - Meta Boxes for Listing
 */

function medazin_listing_register_meta_boxes(): void {
    add_meta_box(
        'medazin_listing_contact_box',
        __( 'Coordonnées', 'medazin' ),
        'medazin_listing_contact_box_html',
        'listing',
        'normal',
        'high'
    );

    add_meta_box(
        'medazin_listing_media_box',
        __( 'Médias', 'medazin' ),
        'medazin_listing_media_box_html',
        'listing',
        'side',
        'default'
    );
}
add_action( 'add_meta_boxes', 'medazin_listing_register_meta_boxes' );

function medazin_listing_contact_box_html( WP_Post $post ): void {
    wp_nonce_field( 'medazin_save_listing_meta', 'medazin_listing_meta_nonce' );

    $phone_primary   = get_post_meta( $post->ID, '_medazin_phone_primary', true );
    $phone_secondary = get_post_meta( $post->ID, '_medazin_phone_secondary', true );
    $email           = get_post_meta( $post->ID, '_medazin_email', true );
    $website         = get_post_meta( $post->ID, '_medazin_website', true );
    $address         = get_post_meta( $post->ID, '_medazin_address', true );
    $opening_hours   = get_post_meta( $post->ID, '_medazin_opening_hours', true );
    $latitude        = get_post_meta( $post->ID, '_medazin_latitude', true );
    $longitude       = get_post_meta( $post->ID, '_medazin_longitude', true );

    echo '<p><label for="medazin_phone_primary">' . esc_html__( 'Téléphone principal', 'medazin' ) . '</label><br />';
    echo '<input type="text" id="medazin_phone_primary" name="medazin_phone_primary" class="widefat" value="' . esc_attr( $phone_primary ) . '" /></p>';

    echo '<p><label for="medazin_phone_secondary">' . esc_html__( 'Téléphone secondaire', 'medazin' ) . '</label><br />';
    echo '<input type="text" id="medazin_phone_secondary" name="medazin_phone_secondary" class="widefat" value="' . esc_attr( $phone_secondary ) . '" /></p>';

    echo '<p><label for="medazin_email">' . esc_html__( 'Email', 'medazin' ) . '</label><br />';
    echo '<input type="email" id="medazin_email" name="medazin_email" class="widefat" value="' . esc_attr( $email ) . '" /></p>';

    echo '<p><label for="medazin_website">' . esc_html__( 'Site web', 'medazin' ) . '</label><br />';
    echo '<input type="url" id="medazin_website" name="medazin_website" class="widefat" value="' . esc_attr( $website ) . '" placeholder="https://" /></p>';

    echo '<p><label for="medazin_address">' . esc_html__( 'Adresse', 'medazin' ) . '</label><br />';
    echo '<textarea id="medazin_address" name="medazin_address" class="widefat" rows="3">' . esc_textarea( $address ) . '</textarea></p>';

    echo '<p><label for="medazin_opening_hours">' . esc_html__( 'Horaires', 'medazin' ) . '</label><br />';
    echo '<textarea id="medazin_opening_hours" name="medazin_opening_hours" class="widefat" rows="3" placeholder="Lun-Ven 08:00-17:00\nSam 09:00-13:00\nDim fermé">' . esc_textarea( $opening_hours ) . '</textarea></p>';

    echo '<p><label for="medazin_latitude">' . esc_html__( 'Latitude', 'medazin' ) . '</label><br />';
    echo '<input type="text" id="medazin_latitude" name="medazin_latitude" class="widefat" value="' . esc_attr( $latitude ) . '" placeholder="11.8251" /></p>';

    echo '<p><label for="medazin_longitude">' . esc_html__( 'Longitude', 'medazin' ) . '</label><br />';
    echo '<input type="text" id="medazin_longitude" name="medazin_longitude" class="widefat" value="' . esc_attr( $longitude ) . '" placeholder="42.5903" /></p>';
}

function medazin_listing_media_box_html( WP_Post $post ): void {
    $logo_id   = (int) get_post_meta( $post->ID, '_medazin_logo_id', true );
    $gallery   = (string) get_post_meta( $post->ID, '_medazin_gallery_ids', true );

    $logo_src  = $logo_id ? wp_get_attachment_image_url( $logo_id, 'thumbnail' ) : '';

    echo '<p><label>' . esc_html__( 'Logo', 'medazin' ) . '</label><br />';
    echo '<input type="hidden" id="medazin_logo_id" name="medazin_logo_id" value="' . esc_attr( $logo_id ) . '" />';
    echo '<div id="medazin_logo_preview">' . ( $logo_src ? '<img src="' . esc_url( $logo_src ) . '" style="max-width:100%;height:auto;" />' : '' ) . '</div>';
    echo '<button type="button" class="button" id="medazin_logo_upload">' . esc_html__( 'Choisir le logo', 'medazin' ) . '</button> ';
    echo '<button type="button" class="button" id="medazin_logo_remove">' . esc_html__( 'Retirer', 'medazin' ) . '</button></p>';

    echo '<p><label>' . esc_html__( 'Galerie (IDs séparés par des virgules)', 'medazin' ) . '</label><br />';
    echo '<input type="text" id="medazin_gallery_ids" name="medazin_gallery_ids" class="widefat" value="' . esc_attr( $gallery ) . '" placeholder="12,34,56" /></p>';

    // Simple admin JS to pick media (relies on WordPress media modal)
    echo '<script>jQuery(function($){
        var frame; 
        $("#medazin_logo_upload").on("click", function(e){ e.preventDefault(); if(frame){ frame.open(); return; } frame = wp.media({ title: "' . esc_js( __( 'Sélectionner un logo', 'medazin' ) ) . '", button: { text: "' . esc_js( __( 'Utiliser ce logo', 'medazin' ) ) . '" }, multiple: false }); frame.on("select", function(){ var attachment = frame.state().get("selection").first().toJSON(); $("#medazin_logo_id").val(attachment.id); $("#medazin_logo_preview").html("<img src='"+attachment.url+"' style=\"max-width:100%;height:auto;\"/>"); }); frame.open(); });
        $("#medazin_logo_remove").on("click", function(){ $("#medazin_logo_id").val(''); $("#medazin_logo_preview").empty(); });
    });</script>';
}

function medazin_save_listing_meta( int $post_id ): void {
    if ( ! isset( $_POST['medazin_listing_meta_nonce'] ) || ! wp_verify_nonce( $_POST['medazin_listing_meta_nonce'], 'medazin_save_listing_meta' ) ) {
        return;
    }
    if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
        return;
    }
    if ( isset( $_POST['post_type'] ) && 'listing' === $_POST['post_type'] ) {
        if ( ! current_user_can( 'edit_post', $post_id ) ) {
            return;
        }
    }

    $map = array(
        '_medazin_phone_primary'   => isset($_POST['medazin_phone_primary']) ? sanitize_text_field( wp_unslash( $_POST['medazin_phone_primary'] ) ) : '',
        '_medazin_phone_secondary' => isset($_POST['medazin_phone_secondary']) ? sanitize_text_field( wp_unslash( $_POST['medazin_phone_secondary'] ) ) : '',
        '_medazin_email'           => isset($_POST['medazin_email']) ? sanitize_email( wp_unslash( $_POST['medazin_email'] ) ) : '',
        '_medazin_website'         => isset($_POST['medazin_website']) ? esc_url_raw( wp_unslash( $_POST['medazin_website'] ) ) : '',
        '_medazin_address'         => isset($_POST['medazin_address']) ? sanitize_textarea_field( wp_unslash( $_POST['medazin_address'] ) ) : '',
        '_medazin_opening_hours'   => isset($_POST['medazin_opening_hours']) ? sanitize_textarea_field( wp_unslash( $_POST['medazin_opening_hours'] ) ) : '',
        '_medazin_latitude'        => isset($_POST['medazin_latitude']) ? sanitize_text_field( wp_unslash( $_POST['medazin_latitude'] ) ) : '',
        '_medazin_longitude'       => isset($_POST['medazin_longitude']) ? sanitize_text_field( wp_unslash( $_POST['medazin_longitude'] ) ) : '',
        '_medazin_logo_id'         => isset($_POST['medazin_logo_id']) ? (int) $_POST['medazin_logo_id'] : 0,
        '_medazin_gallery_ids'     => isset($_POST['medazin_gallery_ids']) ? preg_replace('/[^0-9,]/', '', wp_unslash( $_POST['medazin_gallery_ids'] ) ) : '',
    );

    foreach ( $map as $key => $value ) {
        if ( '' === $value || ( is_int($value) && 0 === $value ) ) {
            delete_post_meta( $post_id, $key );
        } else {
            update_post_meta( $post_id, $key, $value );
        }
    }
}
add_action( 'save_post_listing', 'medazin_save_listing_meta' );