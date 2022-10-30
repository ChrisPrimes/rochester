<?php
/**
 * Template part for displaying page content in page.php.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package rochester
 */

if(is_front_page()) {
	$front_page = "post-home-page";
}

?>

<article id="post-<?php the_ID(); ?>" <?php post_class($front_page); ?>>
	<?php if(!is_front_page()) { ?>
	<header class="entry-header">
		<?php the_title( '<h1 class="page-title">', '</h1>' ); ?>
	</header><!-- .entry-header -->
	<?php } ?>

	<div class="entry-content">
		<?php
			the_content();

			wp_link_pages( array(
				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'blogsite' ),
				'after'  => '</div>',
			) );
		?>
	</div><!-- .entry-content -->

	<?php if ( get_edit_post_link() ) : ?>
		<footer class="entry-footer">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'blogsite' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</footer><!-- .entry-footer -->
	<?php endif; ?>
</article><!-- #post-## -->

<?php if(is_front_page()) { ?>
	<script>
		jQuery('.wp-block-ap-block-posts.apbAdvancedPosts').on('DOMSubtreeModified', function(){ 
			jQuery('.apbPostTitle a').each(function () {
				var link = this.href;
				var post = this.closest('.apbPost');
				jQuery(post).click(function(){ location.href = link });
				jQuery(post).css('cursor', 'pointer');
			});
		});
	</script>
<?php } ?>