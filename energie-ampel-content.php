<?php

add_action( 'qp_menu_button', 'energie_ampel_button', 10, 3 );

function energie_ampel_button() {
	?>
		<a class="button header-button  energie-ampel-button" onclick="show()">
			<?php include_once( plugin_dir_path( __FILE__ ) . '/helper/assets/icons/ampelmann.svg'); ?>
		</a>
	<?php
}


add_action('qp_overlays', 'energie_ampel_overlay', 10, 3);

function energie_ampel_overlay() {
	get_template_part('components/energie_ampel-menu');

	if( file_exists( __DIR__ . "/helper/energie_ampel-helper.php" ) ) {
		include( __DIR__ . "/helper/energie_ampel-helper.php" );
	}
}

// load styles
function css_style_energie_ampel(){
    wp_enqueue_style( 'plugin-style-energie-ampel', plugins_url( '/helper/assets/css/styles.css', __FILE__ ), false, null );
}
add_action('wp_enqueue_scripts', 'css_style_energie_ampel');

?>