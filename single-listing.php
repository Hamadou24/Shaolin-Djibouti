<?php
/**
 * Single template for Listing (Annuaire)
 */
get_header();
?>
<section class="blog-section blog-single-page single-listing">
    <div class="container">
        <div class="row">
            <div class="<?php esc_attr(medazin_post_layout()); ?>">
                <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('post-item active'); ?>>
                        <div class="post-content ">
                            <header class="mb-3">
                                <?php
                                $meta = medazin_get_listing_meta( get_the_ID() );
                                $logo = $meta['logo_id'] ? wp_get_attachment_image( $meta['logo_id'], 'thumbnail', false, array('class' => 'me-2') ) : '';
                                if ( $logo ) {
                                    echo '<div class="d-flex align-items-center mb-2">' . $logo . '<h1 class="h4 m-0">' . esc_html( get_the_title() ) . '</h1></div>';
                                } else {
                                    the_title('<h1 class="h4">','</h1>');
                                }
                                ?>
                                <div class="text-muted small">
                                    <?php echo get_the_term_list( get_the_ID(), 'sector', '<span class="me-2"><i class="fas fa-folder-open"></i> ', ', ', '</span>' ); ?>
                                    <?php echo get_the_term_list( get_the_ID(), 'region', '<span><i class="fas fa-map"></i> ', ', ', '</span>' ); ?>
                                </div>
                            </header>

                            <?php if ( has_post_thumbnail() ) : ?>
                                <figure class="post-image mb-3"><?php the_post_thumbnail('large'); ?></figure>
                            <?php endif; ?>

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="listing-description">
                                        <?php the_content(); ?>
                                    </div>

                                    <?php if ( ! empty( $meta['opening_hours'] ) ) : ?>
                                        <div class="listing-opening-hours mt-4">
                                            <h5><?php echo esc_html__( 'Horaires', 'medazin' ); ?></h5>
                                            <pre style="white-space: pre-wrap; background: #f8f9fa; padding: 12px; border-radius: 6px;"><?php echo esc_html( $meta['opening_hours'] ); ?></pre>
                                        </div>
                                    <?php endif; ?>

                                    <?php if ( ! empty( $meta['latitude'] ) && ! empty( $meta['longitude'] ) ) : ?>
                                        <div class="listing-map mt-4">
                                            <h5><?php echo esc_html__( 'Localisation', 'medazin' ); ?></h5>
                                            <iframe width="100%" height="300" style="border:0" loading="lazy" allowfullscreen
                                                src="https://www.google.com/maps?q=<?php echo rawurlencode($meta['latitude'] . ',' . $meta['longitude']); ?>&output=embed"></iframe>
                                        </div>
                                    <?php endif; ?>
                                </div>
                                <div class="col-md-4">
                                    <div class="listing-contacts-box mb-4">
                                        <h5><?php echo esc_html__( 'Contact', 'medazin' ); ?></h5>
                                        <?php medazin_render_listing_contacts( get_the_ID() ); ?>
                                    </div>

                                    <?php if ( is_active_sidebar('medazin-ad-single-sidebar') ) { dynamic_sidebar('medazin-ad-single-sidebar'); } ?>
                                </div>
                            </div>
                        </div>
                    </article>
                    <?php comments_template( '', true ); ?>
                <?php endwhile; endif; ?>
            </div>
            <?php get_sidebar(); ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>