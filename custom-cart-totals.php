<?php
/**
 * Plugin Name: Custom Cart Totals
 * Description: Reemplaza la tabla de totales del carrito de WooCommerce con un diseño personalizado.
 * Author: Enmanuel
 * Version: 1.0
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
                <span>Envío</span>
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

add_action( 'wp_enqueue_scripts', function() {
    wp_add_inline_style( 'woocommerce-general', "
        .custom-cart-totals-container {
            background: #fff;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 3px 12px rgba(0,0,0,0.1);
        }

        .custom-cart-summary-box {
            margin-top: 15px;
        }

        .custom-row, .custom-total-row {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }

        .custom-total-row {
            font-size: 18px;
            font-weight: bold;
            border-bottom: none;
            margin-top: 10px;
        }

        .custom-checkout-btn {
            margin-top: 20px;
            text-align: center;
        }
    " );
});

