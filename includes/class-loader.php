<?php
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class CMPT_Loader {

    public function __construct() {

        add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_assets' ) );

    }

    public function enqueue_assets() {

        wp_enqueue_style(
            'cmpt-brand-selector',
            CMPT_URL . 'assets/css/brand-selector.css',
            array(),
            CMPT_VERSION
        );

        wp_enqueue_script(
            'cmpt-brand-selector',
            CMPT_URL . 'assets/js/brand-selector.js',
            array('jquery'),
            CMPT_VERSION,
            true
        );

    }

}

new CMPT_Loader();