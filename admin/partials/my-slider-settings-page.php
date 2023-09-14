<div class="wrap">
	<h1>
		<?php
		/**
		 * Get the settings page title.
		 *
		 * @package My-slider/Dapo-Obembe
		 */

		echo esc_html( get_admin_page_title() );
		?>
	</h1>
	<?php
		$active_tab = isset( $_GET['tab'] ) ? sanitize_key( $_GET['tab'] ) : 'main_options';


	?>
	<h2 class="nav-tab-wrapper">
		<a href="?page=my_slider_admin&tab=main_options" class="nav-tab <?php echo 'main_options' === $active_tab ? 'nav-tab-active' : ''; ?>">Main Options</a>
		<a href="?page=my_slider_admin&tab=additional_options" class="nav-tab <?php echo 'additional_options' === $active_tab ? 'nav-tab-active' : ''; ?>">Additional Options</a>
	</h2>
	<form action="options.php" method="post">
		<?php
		if ( 'main_options' === $active_tab ) {
			settings_fields( 'my_slider_group' );
			do_settings_sections( 'my_slider_page1' );
		} else {
			settings_fields( 'my_slider_group' );
			do_settings_sections( 'my_slider_page2' );
		}
			submit_button( 'Save Settings' );
		?>
	</form>
</div>
