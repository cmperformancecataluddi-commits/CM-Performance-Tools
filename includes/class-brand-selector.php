<?php

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

class CMPT_Brand_Selector {

    public function __construct() {

        add_action(
            'woocommerce_archive_description',
            array( $this, 'render' ),
            15
        );

    }

    public function render() {

        if ( ! is_product_category( 'cerchi-in-lega' ) ) {
            return;
        }

        $brands = get_terms( array(
            'taxonomy'   => 'pa_brand-auto',
            'hide_empty' => false,
            'orderby'    => 'name',
            'order'      => 'ASC'
        ) );

        if ( empty( $brands ) || is_wp_error( $brands ) ) {
            return;
        }

        ?>
        <div class="cm-brand-selector">

            <h2>Seleziona la tua auto</h2>

            <div class="cm-brand-grid">

                <?php foreach ( $brands as $brand ) : ?>

                    <?php echo $this->brand_card( $brand ); ?>

                <?php endforeach; ?>

            </div>

        </div>
        <?php

    }

    private function brand_card( $brand ) {

        $upload = wp_upload_dir();

        $logo = '';

        foreach ( array( 'webp', 'png', 'svg' ) as $ext ) {

            $file = $upload['basedir'] . '/loghi-auto/' . $brand->slug . '.' . $ext;

            if ( file_exists( $file ) ) {

                $logo = $upload['baseurl'] . '/loghi-auto/' . $brand->slug . '.' . $ext;

                break;

            }

        }

        ob_start();

        ?>

        <a class="cm-brand-card"
           href="<?php echo esc_url( home_url( '/product-category/cerchi-in-lega/?query_type_brand-auto=or&filter_brand-auto=' . $brand->slug ) ); ?>">

            <div class="cm-brand-logo">

                <?php if ( $logo ) : ?>

                    <img src="<?php echo esc_url( $logo ); ?>" alt="<?php echo esc_attr( $brand->name ); ?>">

                <?php else : ?>

                    <div class="cm-brand-placeholder">🚗</div>

                <?php endif; ?>

            </div>

            <span><?php echo esc_html( $brand->name ); ?></span>

        </a>

        <?php

        return ob_get_clean();

    }

}

new CMPT_Brand_Selector();