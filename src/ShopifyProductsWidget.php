<?php
/**
 * This file is part of Shopify Products Widget
 * (c) Nicolai Lebek <mail@nicolailebek.de>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace NicolaiLebek\ShopifyProductsWidget;

class ShopifyProductsWidget extends \WP_Widget
{
	/**
	 * Unique identifier for this widget
	 *
	 * The variable name is used as the widgets id and the text domain
	 * when internationalizing strings of text 
	 *
	 * @since 1.0.0
	 *
	 * @var string
	 */
	protected $widget_slug = 'shopify-products-widget';

	function __construct()
	{
		parent::__construct(
			$this->getWidgetSlug(),
			__('Shopify Products Widget', $this->getWidgetSlug()),
			[
				'classname' => $this->getWidgetSlug(),
				'description' => __(
					'Widget for displaying products from your Shopify shop on your WordPress Site',
					$this->getWidgetSlug()
				)
			]
		);

		// Enqueue scripts & styles
		add_action('wp_enqueue_scripts', [$this, 'enqueueWidgetStyles']);
		add_action('wp_enqueue_scripts', [$this, 'enqueueWidgetScripts']);
	}

	public function getWidgetSlug()
	{
		return $this->widget_slug;
	}

	public function enqueueWidgetStyles()
	{
		if (is_admin()) {
			return;
		}

		wp_enqueue_style(
			$this->getWidgetSlug() . '-styles',
			plugin_dir_url(dirname(__FILE__, 1)) . '/assets/css/shopify-products-widget.css'
		);
	}

	public function enqueueWidgetScripts()
	{
		if (is_admin()) {
			return;
		}
		
		wp_register_script(
			$this->getWidgetSlug() . '-scripts',
			plugin_dir_url(dirname(__FILE__, 1)) . '/assets/js/shopify-products-widget.js',
		);

		wp_enqueue_script($this->getWidgetSlug() . '-scripts');
	}

	 /**
     * Displays the widget based on the contents of the included template.
     *
     * @param array $args argument provided by WordPress that may be useful in rendering the widget
     * @param array $instance the values of the widget
     */
	public function widget($args, $instance)
	{
		extract($args);

		echo $before_widget;
		include(plugin_dir_path(__FILE__) . '/Views/Widget.php');
		echo $after_widget;

		wp_register_script($this->getWidgetSlug() . '-config', '', [], '', true);
		wp_enqueue_script($this->getWidgetSlug() . '-config');
		wp_add_inline_script($this->getWidgetSlug() . '-config', $this->provideWidgetConfig($args, $instance), 'after');
	}

	public function provideWidgetConfig($args, $instance)
	{
		$widget_id = str_replace('-', '_', $args['widget_id']);
		return "var {$widget_id} = " . wp_json_encode($instance);
	}

	/**
     * Displays the administrative view of the form and includes the options
     * for the instance of the widget as arguments passed into the function.
     *
     * @param array $instance the options for the instance of this widget
     *
     */
	public function form($instance)
	{
		$instance = wp_parse_args($instance, ['interval' => 1500, 'limit' => 5]);

		include(plugin_dir_path(__FILE__) . '/Views/Admin.php');
	}

	/**
     * Updates the values of the widget.
     * Sanitizes the information before saving it.
     *
     * @param array $newInstance the values to be sanitized and saved
     * @param array $oldInstance the values that were originally saved
     */
	public function update($new_instance, $old_instance)
	{
		$instance = [];

		foreach ($new_instance as $key => $value) {
			$instance[$key] = strip_tags($value);
		}

		return $instance;
	}

	/**
     * If the value for the key exists in the current instance of the widget, then it will
     * retrieve it. Otherwise, it will return an empty value.
     *
     * @param string $key used to identify the value of the widget
     * @param array  $instance the options for the instance of this widget
     */
	public function get($key, $instance)
	{
		return empty($instance[$key]) ? '' : $instance[$key];
	}
}
