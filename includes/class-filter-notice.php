<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class CMPT_Filter_Notice {

    public function __construct() {
        add_action( 'woocommerce_before_shop_loop', array( $this, 'render_notice' ), 5 );
    }

    public function render_notice() {

        if ( ! is_product_category( 'cerchi-in-lega' ) ) {
            return;
        }

        if ( empty( $_GET['filter_brand-auto'] ) ) {
            return;
        }

        $brand = sanitize_text_field( wp_unslash( $_GET['filter_brand-auto'] ) );

        $term = get_term_by( 'slug', $brand, 'pa_brand-auto' );

        if ( ! $term ) {
            return;
        }

        ?>

        <div class="cm-filter-notice">

            <strong>✅ Hai selezionato <?php echo esc_html( $term->name ); ?></strong>

            <p>
                Ti stiamo mostrando tutti i cerchi compatibili con questa marca.
            </p>

            <p>
                <a class="cm-reset-brand"
                   href="<?php echo esc_url( get_term_link( 'cerchi-in-lega', 'product_cat' ) ); ?>">
                    Cambia marca
                </a>
            </p>

        </div>

        <?php
    }
}

new CMPT_Filter_Notice();