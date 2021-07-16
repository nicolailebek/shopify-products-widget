<?php
/**
 * This file is part of Shopify Products Widget
 * (c) Nicolai Lebek <mail@nicolailebek.de>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */
?>

<div class="widget-content">
	<p>
		<input 
			type="text" 
			id="<?php echo esc_attr($this->get_field_id('title')); ?>" 
			name="<?php echo esc_attr($this->get_field_name('title')); ?>"
			value="<?php echo $this->get('title', $instance); ?>"
			placeholder="<?php _e('Title'); ?>"
			class="widefat"
		>
	</p>

	<p>
		<input 
			type="text" 
			id="<?php echo esc_attr($this->get_field_id('url')); ?>" 
			name="<?php echo esc_attr($this->get_field_name('url')); ?>"
			value="<?php echo $this->get('url', $instance); ?>"
			placeholder="https://your-shopify-store-url"
			class="widefat"
		>
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id('interval')); ?>">Interval</label>
		<input 
			type="number" 
			id="<?php echo esc_attr($this->get_field_id('interval')); ?>" 
			name="<?php echo esc_attr($this->get_field_name('interval')); ?>"
			min="1"
			value="<?php echo $this->get('interval', $instance); ?>"
			class="widefat"
			autocomplete="off"
			style="max-width: 85px;"
		>
		<span>ms</span>
	</p>

	<p>
		<label for="<?php echo esc_attr($this->get_field_id('limit')); ?>">Number of items</label>
		<input 
			type="number" 
			id="<?php echo esc_attr($this->get_field_id('limit')); ?>" 
			name="<?php echo esc_attr($this->get_field_name('limit')); ?>"
			min="1"
			value="<?php echo $this->get('limit', $instance); ?>"
			class="widefat"
			autocomplete="off"
			style="max-width: 65px;"
		>
	</p>

	<p>
		<strong>If you like this widget & want to support its development</strong>
	</p>

	<p>
		<a href="https://www.paypal.com/donate?hosted_button_id=EGL5W2K9PGBK8" target="_blank">
			<img src="https://www.paypalobjects.com/en_US/i/btn/btn_donate_LG.gif" alt="">
		</a>
	</p>

	<p>Made with 🖤 in <a href="https://nicolailebek.de" target="_blank">Dortmund</a></p>
</div>