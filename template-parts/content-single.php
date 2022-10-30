<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rochester
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-loop hentry">
		<div class="entry-category white">
			<?php blogsite_first_category(); ?>
			<?php if ( 'permanent-collection' === get_post_type() ) { ?> <a href="/permanent-collection/">Collection</a> <?php } ?>
		</div>
	</div>
	
	<header class="entry-header">
		<?php
		if ( is_single() ) :
			the_title( '<h1 class="entry-title">', '</h1>' );
			get_template_part( 'template-parts/entry', 'card' );
		
		else :
			the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
		endif;

		if ( 'post' === get_post_type() ) : ?>

		<?php /*get_template_part( 'template-parts/entry-meta', 'single' );*/ ?>

		<?php
		endif; ?>
		
	</header><!-- .entry-header -->

	<div class="entry-content">
		
		<div class="wp-container-3 wp-block-columns" style="align-items:flex-start !important; gap: 20px;">
<div class="wp-container-1 wp-block-column" style="flex-basis:66.66%">
<?php

					the_content( sprintf(
						/* translators: %s: Name of current post. */
						wp_kses( __( 'Continue reading %s <span class="meta-nav">&rarr;</span>', 'blogsite' ), array( 'span' => array( 'class' => array() ) ) ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					) );

				$linked = wp_link_pages(array('echo' => $false));
				if($linked != $null && str_contains($linked, 'aria-current="page">1</span>')) {
				?>
				<!--<button style="margin-bottom:25px; font-weight: normal; background-color: black" onclick="window.location.href='2'" id="gallery-button">View Gallery</button>-->
				<a href="2" style="display: block; margin-bottom:25px; text-decoration: none; font-size: 14px">View Gallery</a>
				
				<?php
				}
				get_template_part( 'template-parts/entry', 'sales' );
				?>
	
				<?php if ( function_exists( 'ADDTOANY_SHARE_SAVE_KIT' ) ) { ADDTOANY_SHARE_SAVE_KIT(); } ?>
</div>

			
<div class="wp-container-2 wp-block-column" style="flex-basis:33.33%">
<?php the_post_thumbnail( get_the_ID(), 'large'); ?>
</div>
</div>
	</div><!-- .entry-content -->
	
	<div class="entry-tags">

		<?php if (has_tag()) { ?><span class="tag-links"><?php the_tags(' ', ' '); ?></span><?php } ?>
	</div><!-- .entry-tags -->

</article><!-- #post-## -->

<div class="entry-footer">

	<div class="share-icons">
		
		<?php get_template_part('template-parts/entry', 'share'); ?>

	</div><!-- .share-icons -->

</div><!-- .entry-footer -->

<?php	 
	// Get the taxonomy terms of the current page for the specified taxonomy.
	$terms = wp_get_post_terms( get_the_ID(), 'category', array( 'fields' => 'ids' ) );

	// Bail if the term empty.
	if ( empty( $terms ) ) {
		return;
	}

	// Posts query arguments.
	$query = array(
		'post__not_in' => array( get_the_ID() ),
		'tax_query'    => array(
			array(
				'taxonomy' => 'category',
				'field'    => 'id',
				'terms'    => $terms,
				'operator' => 'IN'
			)
		),
		'posts_per_page' => 6,
		'post_type'      => 'post',
	);

	// Allow dev to filter the query.
	$args = apply_filters( 'blogsite_related_posts_args', $query );

	// The post query
	$blogsite_related = new WP_Query( $args );

	if ( $blogsite_related->have_posts() ) : $i = 1; ?>

		<div class="entry-related clear">
			<h3><?php esc_html_e('Related Posts', 'blogsite'); ?></h3>
			<div class="content-loop clear">
				<?php while ( $blogsite_related->have_posts() ) : $blogsite_related->the_post(); ?>
					<?php
					$class = ( 0 == $i % 3 ) ? 'hentry last' : 'hentry';

					get_template_part('template-parts/content', 'loop');

					?>

				<?php $i++; endwhile; ?>
			</div><!-- .related-posts -->
		</div><!-- .entry-related -->

	<?php endif;

	// Restore original Post Data.
	wp_reset_postdata();
?>

<script>
var colors = ['#2dde98', '#1cc7d0', '#008eaa', '#ff9900', '#ff6c5f', '#ff4f81', '#b84592', '#8e43e7', '#3369e7', '#00aeff'];
var random_color = colors[Math.floor(Math.random() * colors.length)];
document.querySelector('.white a').style.backgroundColor = random_color;
</script>