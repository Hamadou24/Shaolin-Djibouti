<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 * @package Medazin
 */

get_header();
?>
<section class="blog-section">
	<div class="container">
		<div class="row">
			 <div class="<?php esc_attr(medazin_post_layout()); ?>">	
			
				<?php if ( isset($_GET['post_type']) && $_GET['post_type'] === 'listing' ) : ?>
					<div class="mb-4">
						<?php echo do_shortcode('[listing_search]'); ?>
					</div>
					<?php echo do_shortcode('[listing_grid posts_per_page="12" columns="3"]'); ?>
				<?php else: ?>
					<?php if( have_posts() ): ?>
						<?php while( have_posts() ) : the_post(); ?>
							<?php get_template_part('template-parts/content/content','search'); ?> 
						<?php endwhile; 
						the_posts_navigation(); ?>
					<?php else: ?>
						<?php get_template_part('template-parts/content/content','none'); ?>
					<?php endif; ?>
				<?php endif; ?>
			</div>
			<?php  get_sidebar(); ?>
		</div>
	</div>
</section>
<?php get_footer(); ?>
