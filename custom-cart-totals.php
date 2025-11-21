<?php
/**
 * Plugin Name: Custom Cart Totals
 * Description: Reemplaza la tabla de totales del carrito de WooCommerce con un diseño personalizado.
 * Author: Enmanuel
 * Version: 1.2
 */

if ( ! defined( 'ABSPATH' ) ) exit;

// 1. Quitamos el template original
add_action( 'init', function() {
    remove_action( 'woocommerce_cart_collaterals', 'woocommerce_cart_totals', 10 );
});

// 2. Agregamos nuestro nuevo diseño
add_action( 'woocommerce_cart_collaterals', 'custom_new_cart_totals', 10 );

function custom_new_cart_totals() {
    if ( WC()->cart->is_empty() ) return;

    $cart = WC()->cart;
    ?>

    <div class="custom-cart-totals-container">

        <h2>Total del Carrito</h2>

        <div class="custom-cart-summary-box">

            <!-- SUBTOTAL -->
            <div class="custom-row">
                <span>Subtotal</span>
                <span><?php echo wc_price($cart->get_subtotal()); ?></span>
            </div>

            <!-- MÉTODOS DE ENVÍO -->
            <div class="custom-row">
                <span>
                    <?php wc_cart_totals_shipping_html(); ?>
                </span>
            </div>

            <!-- TOTAL -->
            <div class="custom-total-row">
                <strong>Total</strong>
                <strong><?php wc_cart_totals_order_total_html(); ?></strong>
            </div>

        </div>

        <!-- BOTÓN CHECKOUT -->
        <div class="custom-checkout-btn">
            <?php do_action('woocommerce_proceed_to_checkout'); ?>
        </div>

    </div>

    <?php
}

add_action('wp_enqueue_scripts', function() {
    wp_enqueue_style(
        'custom-cart-totals-styles',
        plugin_dir_url(__FILE__) . 'assets/css/custom-cart-totals.css',
        array(),
        '1.0.0'
    );
});

