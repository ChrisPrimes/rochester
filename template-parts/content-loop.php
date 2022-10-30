<?php $class = ( $wp_query->current_post + 1 === $wp_query->post_count ) ? 'clear last' : 'clear'; ?>

<div id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>	
	<div>
	<?php if ( has_post_thumbnail() ) { ?>
		<a class="thumbnail-link" href="<?php the_permalink(); ?>">
			<div class="thumbnail-wrap">
				<?php 
					//the_post_thumbnail('blogsite_post_thumb');
					the_post_thumbnail( get_the_ID(), 'large' );
				?>
			</div><!-- .thumbnail-wrap -->
		</a>
	<?php } ?>
	</div>

	<div>
	<div class="entry-category">
		<?php blogsite_first_category(); ?>
		<?php if ( 'permanent-collection' === get_post_type() ) { ?> <a href="/permanent-collection/">Collection</a> <?php } ?>
	</div>		

	<h2 class="entry-title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
	
	<?php get_template_part( 'template-parts/entry', 'card' ); ?>
	
	<?php /*get_template_part( 'template-parts/entry', 'meta' );*/ ?>
	
	<div class="entry-summary">
		<?php the_excerpt(); ?>
	</div><!-- .entry-summary -->
	</div>
</div><!-- #post-<?php the_ID(); ?> -->