<?php
/*
Plugin Name: Fasheno Core
Plugin URI: https://www.radiustheme.com
Description: Fasheno Theme Core Plugin
Version: 1.0.0
Author: RadiusTheme
Author URI: https://www.radiustheme.com
*/

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'FASHENO_CORE' ) ) {
	define( 'FASHENO_CORE', '1.0.0' );
	define( 'FASHENO_CORE_PREFIX', 'fasheno' );
	define( 'FASHENO_CORE_BASE_URL', plugin_dir_url( __FILE__ ) );
	define( 'FASHENO_CORE_BASE_DIR', plugin_dir_path( __FILE__ ) );
}

if ( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ) :
	require_once dirname( __FILE__ ) . '/vendor/autoload.php';
endif;

if ( class_exists( 'RT\\FashenoCore\\Init' ) ) :
	RT\FashenoCore\Init::instance();
endif;

define( 'RDTHEME_CORE_DEMO_CONTENT', plugin_dir_path( __FILE__ ) . '/demo-content/' );
define( 'RDTHEME_CORE_BASE_URL', plugin_dir_url( __FILE__ ) . 'demo-content/' );

require_once RDTHEME_CORE_DEMO_CONTENT . 'demo-content.php';