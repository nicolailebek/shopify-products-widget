<?php

/**
 * Shopify Products Widget
 *
 * Simple WordPress Widget for displaying products from your Shopify shop on your WordPress site
 *
 * @package   ShopifyProductsWidget
 * @author    Nicolai Lebek <mail@nicolailebek.de>
 * @license   MIT
 * @link      https://nicolailebek.de
 * @copyright 2021 Nicolai Lebek - Web & App Development
 *
 * Plugin Name:       Shopify Products Widget
 * Plugin URI:        https://github.com/nicolailebek/shopify-products-widget
 * Description:       Widget for displaying products from your Shopify shop on your WordPress Site
 * Version:           1.0.0
 * Author:            Nicolai Lebek
 * Author URI:        https://nicolailebek.de
 * Text Domain:       shopify-products-widget
 * License:           MIT
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Domain Path:       /lang
 * GitHub Plugin URI: https://github.com/nicolailebek/shopify-products-widget
 */

// Prevent this file from being called directly.
defined('WPINC') || die;

// Include the autoloader
require_once(__DIR__ . '/autoloader.php');

// Register the widget
add_action('widgets_init', function () {
	register_widget(NicolaiLebek\ShopifyProductsWidget\ShopifyProductsWidget::class);
});
