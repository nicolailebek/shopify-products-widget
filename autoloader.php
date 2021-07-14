<?php
/**
 * This file is part of Shopify Products Widget
 * (c) Nicolai Lebek <mail@nicolailebek.de>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

spl_autoload_register('shopify_products_widget_autoloader');

function shopify_products_widget_autoloader($class)
{
	$namespace = 'NicolaiLebek\ShopifyProductsWidget';

	if (strpos($class, $namespace) !== 0) {
		return;
	}

	$class = str_replace($namespace, '', $class);
	$class = str_replace('\\', DIRECTORY_SEPARATOR, $class) . '.php';

	$path = __DIR__ . DIRECTORY_SEPARATOR . 'src' . DIRECTORY_SEPARATOR . $class;

	if (file_exists($path)) {
		require_once($path);
	}
}
