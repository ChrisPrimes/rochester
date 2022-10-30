<?php
function format_phone_number_rochester($input) {
	$output = "(" . substr($input, -10, -7) . ") " . substr($input, -7, -4) . "-" . substr($input, -4); 
	return $output;
}

	if ( 'post' === get_post_type() && true === get_field('post_is_exhibition')  && (get_field('sales_email') != '' || get_field('sales_phone') != '' || get_artist_link() != '')) {
	?>
	<div class="sales-card">
		<?php
		echo '<div class="sales-title">More information and sales inquiries</div>';
		
		echo '<div class="artist-link">' . get_artist_link() . '</div>';

        if(get_field('sales_email') != '') {
			echo '<div class="sales-link">' . esc_html( get_field('sales_email') ) .  '</div>';	
		}

        if(get_field('sales_phone') != '') {
			echo '<div class="sales-link">' . esc_html( format_phone_number_rochester(get_field('sales_phone') )) .  '</div>';	
		}
		?>
	</div>
	<?php
	}