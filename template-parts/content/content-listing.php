<?php
$categories_sector = get_the_terms( get_the_ID(), 'sector' );
$categories_region = get_the_terms( get_the_ID(), 'region' );
$meta = function_exists('medazin_get_listing_meta') ? medazin_get_listing_meta( get_the_ID() ) : array();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post-item active'); ?>>
    <?php if ( has_post_thumbnail() ) { ?>
        <figure class="post-image">
            <a href="<?php echo esc_url(get_permalink()); ?>" class="icon"><i class="fas fa-link"></i></a>
            <?php the_post_thumbnail('large'); ?>
            <?php if ( ! empty( $categories_sector ) ) { ?>
                <ul class="post-categories">
                    <li>
                        <a href="<?php echo esc_url( get_term_link( $categories_sector[0] ) );?>"><i class="fa fa-folder-open"></i> <?php echo esc_html( $categories_sector[0]->name ); ?></a>
                    </li>
                </ul>
            <?php } ?>
        </figure>
    <?php } ?>

    <div class="post-content">
        <?php the_title( sprintf( '<h5 class="post-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h5>' ); ?>
        <div class="post-meta up">
            <?php if ( ! empty( $categories_region ) ) : ?>
                <span class="author-name"><i class="fas fa-map-marker-alt"></i> <?php echo esc_html( $categories_region[0]->name ); ?></span>
            <?php endif; ?>
            <?php if ( ! empty( $meta['address'] ) ) : ?>
                <span class="post-tag"><i class="fas fa-map"></i> <?php echo esc_html( $meta['address'] ); ?></span>
            <?php endif; ?>
        </div>
        <div class="excerpt">
            <?php echo wp_kses_post( wp_trim_words( get_the_excerpt(), 20, '...' ) ); ?>
        </div>
    </div>
</article>