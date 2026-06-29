<?php
/**
 * Plugin Name: CM Performance Tools
 * Plugin URI: https://www.cmperformancesrls.it
 * Description: Plugin ufficiale di CM Performance.
 * Version: 1.0.3
 * Author: Mirko Cataluddi
 * Author URI: https://www.cmperformancesrls.it
 * License: GPL2+
 * Text Domain: cm-performance-tools
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

// Costanti del plugin
define( 'CMPT_VERSION', '1.0.3' );
define( 'CMPT_PATH', plugin_dir_path( __FILE__ ) );
define( 'CMPT_URL', plugin_dir_url( __FILE__ ) );

// Carica i moduli
$modules = array(

    'includes/class-loader.php',

    'includes/class-brand-selector.php',
    

    'includes/class-brand-banner.php',

    'includes/class-auto-scroll.php',

    'includes/class-configurator.php',

    'includes/helpers.php',

);

foreach ( $modules as $module ) {
    $file = CMPT_PATH . $module;

    if ( file_exists( $file ) ) {
        require_once $file;
    }
}

register_activation_hook( __FILE__, function () {
    flush_rewrite_rules();
});

register_deactivation_hook( __FILE__, function () {
    flush_rewrite_rules();
});