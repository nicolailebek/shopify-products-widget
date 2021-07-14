<?php

/**
 * This file is part of Shopify Products Widget
 * (c) Nicolai Lebek <mail@nicolailebek.de>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

if (empty($instance['title']) && empty($instance['url'])) {
	return;
}
?>

<h3 class="widget-title"><?php echo $instance['title']; ?></h3>

<!-- Products -->
<div class="shopify-products-widget__gallery">
	<div class="shopify-products-widget__preloader">
		<div class="shopify-products-widget__bounce1"></div>
		<div class="shopify-products-widget__bounce2"></div>
	</div>
</div>