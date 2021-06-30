<?php
/*
Plugin Name: Quartiersplattform Energie Ampel
Version: 0.2
Description: Energie Ampel der WSW für die Quartiersplattformen in Wuppertal
Author: studio arrenberg
Author URI: https://github.com/studio-arrenberg
Plugin URI: https://github.com/studio-arrenberg/energie-ampel-plugin
Requires PHP: 7.0
Text Domain: energie-ampel
Function: Energie_Ampel
*/

// Exit if accessed directly
if (!defined( 'ABSPATH')) {
	exit;
}

if(!class_exists('EnergieAmpelInit')):

Class EnergieAmpelInit {

	/**
	 * __construct
	 *
	 * A dummy constructor to ensure Acf Onyx Poll is only setup once.
	 * Set some constants
	 *
	 * @param	void
	 * @return	void
	 */
	function __construct() {
		// define('Energie_Ampel', '1.0');
		// define('Energie_Ampel', __FILE__);
		define('Energie_Ampel', plugin_dir_path(__FILE__));
	}

	/**
	 * initialize
	 *
	 * Sets up the Onyx Poll plugin.
	 *
	 * @param	void
	 * @return	void
	 */
	 public function initialize() {

		// Load Content
		require_once(__DIR__ . '/energie-ampel-content.php');

	}

}

/**
 * Instantiate Onyx Poll
 */
$energie_ampel = new EnergieAmpelInit();
$energie_ampel->initialize();

endif; // class_exists check

?>
