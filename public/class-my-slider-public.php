<?php
/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    My_Slider
 * @subpackage My_Slider/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    My_Slider
 * @subpackage My_Slider/public
 * @author     Dapo Obembe <obembedapo@gmail.com>
 */
class My_Slider_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of the plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/my-slider-public.css', array(), $this->version, 'all' );
		wp_enqueue_style( 'flexslider', plugin_dir_url( __FILE__ ) . 'css/flexslider.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in My_Slider_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The My_Slider_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/my-slider-public.js', array( 'jquery' ), $this->version, false );
		wp_enqueue_script( 'flexslider_script', plugin_dir_url( __FILE__ ) . 'js/jquery.flexslider-min.js', array( 'jquery' ), $this->version, false );

	}
	/**
	 * This function registers the shortcode.
	 *
	 * @package My-Slider/Dapo-Obembe
	 *
	 * @return ob_get_clean();
	 */
	public function register_shortcodes() {

		add_shortcode( 'my_slider', 'my_slider_shortcode' );
		/**
		 * This function handles the shortcode of the My-Slider on the frontend.
		 *
		 * @package My-Slider/Dapo-Obembe
		 * @param array  $atts for the attributes passed into the shortcode.
		 * @param string $content for the contents passed into the shortcode.
		 * @param string $tag for the tags passed into the shortcode.
		 * @version 1.0.0
		 */
		function my_slider_shortcode( $atts = array(), $content = null, $tag = '' ) {
			// Ensure all the characters of the attribute is in lowercase .
			$atts = array_change_key_case( (array) $atts, CASE_LOWER );

			// Set defaults for the shortcode attributes.
			$atts = shortcode_atts(
				array(
					'id'      => '',
					'orderby' => 'date',
				),
				$atts,
				$tag
			);

			// Access the shortcode attributes directly as variables.
			$id      = $atts['id'];
			$orderby = $atts['orderby'];

			if ( ! empty( $id ) ) {
				$id = array_map( 'absint', explode( ',', $id ) );
			}

			// Require the file showing the html of the shortcode.
			require __DIR__ . './partials/my-slider-public-display.php';
			return ob_get_clean();
		}
	}

}
