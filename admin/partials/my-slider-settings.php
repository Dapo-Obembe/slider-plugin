<?php
/**
 * This handles the functionality of adding settings option to the plugin's setting page.
 *
 * @package My-slider/Dapo-Obembe
 * @version 1.0.0
 */

register_setting( 'my_slider_group', 'my_slider_options', array( $this, 'my_slider_validate' ) );
	// First section of the option settings page.
	add_settings_section(
		'my_slider_main_section',
		'How does it work?',
		null,
		'my_slider_page1'
	);
	// Second section of the option settings page.
	add_settings_section(
		'my_slider_second_section',
		'Other plugin option',
		null,
		'my_slider_page2'
	);

	// First  field.
	add_settings_field(
		'my_slider_shortcode',
		'Shortcode',
		array( $this, 'my_slider_shortcode_callback' ),
		'my_slider_page1',
		'my_slider_main_section'
	);
	// Second field.
	add_settings_field(
		'my_slider_title',
		'Slider title',
		array( $this, 'my_slider_title_callback' ),
		'my_slider_page2',
		'my_slider_second_section',
		array(
			'label_for' => 'my_slider_title',
		)
	);
	// Third field.
	add_settings_field(
		'my_slider_bullets',
		'Display Bullets',
		array( $this, 'my_slider_bullets_callback' ),
		'my_slider_page2',
		'my_slider_second_section',
		array(
			'label_for' => 'my_slider_bullets',
		)
	);
	// Third field.
	add_settings_field(
		'my_slider_style',
		'Slider Styles',
		array( $this, 'my_slider_style_callback' ),
		'my_slider_page2',
		'my_slider_second_section'
	);
