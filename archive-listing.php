<?php
/**
 * Archive template for Listing (Annuaire)
 */
get_header();
?>
<section class="blog-section listing-archive">
    <div class="container">
        <?php if ( is_active_sidebar('medazin-ad-archive-top') ): ?>
            <div class="row mb-4">
                <div class="col-12 text-center">
                    <?php dynamic_sidebar('medazin-ad-archive-top'); ?>
                </div>
            </div>
        <?php endif; ?>

        <div class="row mb-4">
            <div class="col-12">
                <?php echo do_shortcode('[listing_search]'); ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-9">
                <?php echo do_shortcode('[listing_grid posts_per_page="12" columns="3"]'); ?>
            </div>
            <div class="col-lg-3">
                <?php if ( is_active_sidebar('medazin-ad-archive-sidebar') ) { dynamic_sidebar('medazin-ad-archive-sidebar'); } ?>
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</section>
<?php get_footer(); ?>