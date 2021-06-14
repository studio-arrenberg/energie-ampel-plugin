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

// Load Translation
function energie_ampel_init() {
	load_plugin_textdomain( 'energie-ampel', false, basename( dirname( __FILE__ ) ) . '/helper/assets//languages' );
}
add_action('init', 'energie_ampel_init');

//Translation Weekdays
__("Montag", "energie-ampel");
__("Dienstag", "energie-ampel");
__("Mittwoch", "energie-ampel");
__("Donnerstag", "energie-ampel");
__("Freitag", "energie-ampel");
__("Samstag", "energie-ampel");
__("Sonntag", "energie-ampel");
__("grüne", "energie-ampel");

__("grüne",'energie-ampel');
__("rote auswählen",'energie-ampel');
__("gelbe auswählen",'energie-ampel');



?>