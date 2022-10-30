<?php
/**
 * The template for displaying archive pages.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package blogsite
 */

get_header(); ?>

	<div id="primary" class="content-area clear">
		
		<div class="extra-header-space"></div>
				
		<main id="main" class="site-main clear">
			
			<div class="breadcrumbs clear">			
				<h1>
					<?php echo wp_kses_post( get_the_archive_title('') ); ?>					
				</h1>	
			</div><!-- .breadcrumbs -->
		
			<div id="recent-content" class="content-loop">

				<?php

				if ( have_posts() ) :	
									
				$i = 1;

				/* Start the Loop */
				while ( $wp_query->have_posts() ) : $wp_query->the_post();

					get_template_part('template-parts/content', 'loop');

					$i++; 

				endwhile;

				else :

					get_template_part( 'template-parts/content', 'none' );

				endif; 

				?>

			</div><!-- #recent-content -->

			<?php get_template_part( 'template-parts/pagination', '' ); ?>

		</main><!-- .site-main -->

	</div><!-- #primary -->

<?php get_sidebar(); ?>
<?php get_footer(); ?>

