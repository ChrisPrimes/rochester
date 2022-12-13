<?php
	if ( 'permanent-collection' === get_post_type() ) {
	?>
	<div class="permanent-collection-card">
		<?php
		echo '<div class="artist-title">' . esc_html( get_field('title') ) . '</div>';
		echo '<div class="art-medium">' . esc_html( get_field('art_medium') ) . '</div>';
		echo '<div class="collection-number">ID Number:&nbsp;' . esc_html( str_pad(get_field('collection_number'), 4, "0", STR_PAD_LEFT) ) . '</div>';
		?>
	</div>
	<?php
	}

	if ( 'post' === get_post_type() && true === get_field('post_is_exhibition') ) {
	?>
	<div class="permanent-collection-card">
		<?php
		echo '<div class="artist-title">' . esc_html( get_field('exhibition_title') ) . '</div>';
		echo '<div class="art-medium">' . esc_html( get_field('exhibition_start') . '&nbsp;-&nbsp;' . get_field('exhibition_end') ) . '</div>';
		echo '<div class="art-medium">' . esc_html( get_address() ) . '</div>';
		if(get_field('reception_date') !== '') {
			echo '<div class="collection-number">Reception:&nbsp;' . esc_html( get_field('reception_date') . '&nbsp;-&nbsp;' . get_field('reception_end_time') ) . '</div>';
		} else {
			echo '<div class="collection-number-none">'  . '</div>';
		}
		?>
	</div>
	<?php
	} else if ( 'post' === get_post_type() && true === in_category('news') ) {
		?>
		<div class="permanent-collection-card">
			<div class="art-medium"><?php echo get_the_date(); ?></div>
			<div class="collection-number-none"></div>
		</div>
		<?php
	}