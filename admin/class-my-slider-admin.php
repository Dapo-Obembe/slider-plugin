<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://example.com
 * @since      1.0.0
 *
 * @package    My_Slider
 * @subpackage My_Slider/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    My_Slider
 * @subpackage My_Slider/admin
 * @author     Dapo Obembe <obembedapo@gmail.com>
 */
class My_Slider_Admin {

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
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   public
	 * @var      string    $options    The plugin's setting options..
	 */
	public static $options;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;
		// Initialize options when the class is constructed.
		self::$options = get_option( 'my_slider_options' );
	}

	/**
	 * Register the stylesheets for the admin area.
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/my-slider-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
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

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/my-slider-admin.js', array( 'jquery' ), $this->version, false );
	}
	/**
	 * This function create te My-SLider Post Type.
	 *
	 * @package My-Slider/Dapo-Obembe
	 * @return void
	 * @since version 1.0.0
	 */
	public function create_post_type() {
		register_post_type(
			'my-slider',
			array(
				'label'              => 'Slider',
				'description'        => 'Sliders',
				'labels'             => array(
					'name'          => 'Sliders',
					'singular_name' => 'Slider',
					'add_new_item'  => 'Add New Slider',
					'edit_item'     => 'Edit Slider',
				),
				'public'             => true,
				'supports'           => array( 'title', 'editor', 'thumbnail' ),
				'hierarchical'       => false,
				'show_ui'            => true,
				'show_in_menu'       => false,
				'menu_position'      => 5,
				'show_in_admin_bar'  => true,
				'show_in_nav_menu'   => true,
				'can_export'         => true,
				'has_archive'        => true,
				'publicly_queryable' => true,
				'show_in_rest'       => false,
				'menu_icon'          => 'dashicons-format-video',
			)
		);

	}
	/**
	 * This function adds the following columns to the ost tpe table.
	 *
	 * @param array $columns the tr texts.
	 * @package My-slider/Dapo-Obembe
	 * @version 1.0.0
	 */
	public function my_slider_cpt_columns( $columns ) {
		$columns['my_slider_link_text'] = esc_html( 'Link Text' );
		$columns['my_slider_link_url']  = esc_html( 'Link URL' );
		return $columns;
	}
	/**
	 * This function adds the table data values in the backend.
	 *
	 * @param array $column and int $post_id the tr texts.
	 * @param int   $post_id for the current post type.
	 * @package My-slider/Dapo-Obembe
	 * @version 1.0.0
	 */
	public function my_slider_custom_columns( $column, $post_id ) {
		switch ( $column ) {
			case 'my_slider_link_text':
				$link_text = get_post_meta( $post_id, 'my_slider_link_text', true );
				echo esc_html( $link_text );
				break;
			case 'my_slider_link_url':
				$link_url = get_post_meta( $post_id, 'my_slider_link_url', true );
				echo esc_url( $link_url );
				break;
		}
	}

	/**
	 * This function adds sorting feature to post table.
	 *
	 * @param array $columns the tr texts.
	 * @package My-slider/Dapo-Obembe
	 * @version 1.0.0
	 */
	public function my_slider_sortable_columns( $columns ) {
		$columns['my_slider_link_text'] = 'my_slider_link_text';
		return $columns;
	}
	/**
	 * This function create My-SLider Meta Box
	 *
	 * @package My-Slider/Dapo-Obembe
	 * @return void
	 * @since version 1.0.0
	 */
	public function register_my_slider_meta_boxes() {

		add_meta_box(
			'my_slider_meta_box',
			'Link Options',
			array( $this, 'add_meta_boxes_html' ),
			'my - slider',
			'normal',
			'high',
		);
	}
	/**
	 * This function create My-SLider Meta Box
	 *
	 * @param WP_Post $post   Post object.
	 * @package My-Slider/Dapo-Obembe
	 * @return void
	 * @since version 1.0.0
	 */
	public function add_meta_boxes_html( $post ) {
		require_once __DIR__ . '/partials/my-slider-admin-display.php';
	}
	/**
	 * This function saves My-SLider Meta Box in the DB
	 *
	 * @param int $post_id   Id of the Post object.
	 * @package My-Slider/Dapo-Obembe
	 * @return void
	 * @since version 1.0.0
	 */
	public function save_metabox_data( $post_id ) {
		// Guard clause for security. Declaring the nonce for security purposes.
		if ( isset( $_POST['my_slider_none'] ) ) {
			if ( ! wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['my_slider_none'] ) ), 'my_slider_none' ) ) {
				return;
			}
		}
		// Autosave the meta data in the post.
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return;
		}

		// Check if the post type matches and if the user can edit the post.
		if ( isset( $_POST['post_type'] ) && 'my - slider' === $_POST['post_type'] ) {
			if ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			} elseif ( ! current_user_can( 'edit_page', $post_id ) ) {
				return;
			}
		}

		// Hook to the post meta data to perform CRUD operation.
		if ( isset( $_POST['action'] ) && 'editpost' === $_POST['action'] ) {
			$old_link_text = get_post_meta( $post_id, 'my_slider_link_text', true );
			$new_link_text = isset( $_POST['my_slider_link_text'] ) ? sanitize_text_field( wp_unslash( $_POST['my_slider_link_text'] ) ) : ''; // Check if the index exists.

			$old_link_url = get_post_meta( $post_id, 'my_slider_link_url', true );
			$new_link_url = isset( $_POST['my_slider_link_url'] ) ? esc_url_raw( wp_unslash( $_POST['my_slider_link_url'] ) ) : ''; // Check if the index exists.

			// Check if the fields are empty.
			if ( empty( $new_link_text ) ) {
				update_post_meta( $post_id, 'my_slider_link_text', 'Add some text' );
			} else {
				update_post_meta( $post_id, 'my_slider_link_text', sanitize_text_field( $new_link_text ), $old_link_text );
			}
			if ( empty( $new_link_url ) ) {
				update_post_meta( $post_id, 'my_slider_link_url', '// ' );
			} else {
				update_post_meta( $post_id, 'my_slider_link_url', esc_url_raw( $new_link_url ), $old_link_url );

			}
		}
	}
	/**
	 * This function adds the Plugin menu link in the admin page.
	 *
	 * @package My-slider/Dapo-Obembe
	 * @version 1.0.0
	 */
	public function add_slider_menu_pages() {
			add_menu_page(
				'My Slider Options', // Plugin title.
				'My Slider', // Page title.
				'manage_options', // Capability.
				'my_slider_admin', // Slug.
				array( $this, 'my_slider_settings_page' ), // callback function for the settings page.
				'dashicons-images-alt2', // WordPress icon for the menu.
			);
			add_submenu_page(
				'my_slider_admin', // Parent slug.
				'Manage Slides', // Page title.
				'Manage Slides', // Menu title.
				'manage_options', // Capability.
				'edit.php?post_type=my-slider', // Slug.
				null, // callback function for the settings page.
				null, // WordPress icon for the menu.
			);
			add_submenu_page(
				'my_slider_admin', // Parent slug.
				'Add New Slide', // Page title.
				'Add New Slide', // Menu title.
				'manage_options', // Capability.
				'post-new.php?post_type=my-slider', // Page Slug.
				null, // callback function for the settings page.
				null, // WordPress icon for the menu.
			);
	}
	/**
	 * This function sets the plugin Settings page in the backend.
	 *
	 * @package My-slider/Dapo-Obembe
	 * @version 1.0.0
	 */
	public function my_slider_settings_page() {
		if ( ! current_user_can( 'manage_options' ) ) {
			return;
		}
		// Notification of success message when the field is saved.
		if ( isset( $_GET['settings-updated'] ) ) {
			add_settings_error( 'my_slider_options', 'my_slider_message', 'Settings saved', 'success' );
		}
		settings_errors( 'my_slider_options' );

		require_once __DIR__ . '/partials/my-slider-settings-page.php';

	}
	/**
	 * This function initiates the plugin Settings.
	 *
	 * @package My-slider/Dapo-Obembe
	 * @version 1.0.0
	 */
	public function admin_init() {
		require_once __DIR__ . '/partials/my-slider-settings.php';
	}
	/**
	 * Function for the slider shortcode callback of the settings.
	 *
	 * @package My-slider/Dapo-Obembe
	 * @version 1.0.0
	 */
	public function my_slider_shortcode_callback() {
		?>
			<span>Use the shortcode <strong>[my_slider]</strong> to display the slider in any page/post/widget</span>
		<?php
	}
	/**
	 * Function for the slider TITLE callback of the settings.
	 *
	 * @package My-slider/Dapo-Obembe
	 * @version 1.0.0
	 */
	public function my_slider_title_callback() {
		?>
		<input
			type="text"
			name="my_slider_options[my_slider_title]"
			id="my_slider_title"
			value="<?php echo isset( self::$options['my_slider_title'] ) ? esc_attr( self::$options['my_slider_title'] ) : ''; ?>"/>
		<?php
	}
	/**
	 * Function for the slider BULLETS callback of the settings.
	 *
	 * @package My-slider/Dapo-Obembe
	 * @version 1.0.0
	 */
	public function my_slider_bullets_callback() {
		?>
		<input 
			type="checkbox"
			name="my_slider_options[my_slider_bullets]"
			id="my_slider_bullets"
			value="1"
			<?php
			if ( isset( self::$options['my_slider_bullets'] ) ) {
				checked( '1', self::$options['my_slider_bullets'], true );
			}
			?>
		/>
		<label for="my_slider_bullets">Whether to display bullets or not</label>
		<?php
	}
	/**
	 * Function for the slider STYLE callback of the settings.
	 *
	 * @package My-slider/Dapo-Obembe
	 * @version 1.0.0
	 */
	public function my_slider_style_callback() {
		?>
			<select 
				id="my_slider_style" 
				name="my_slider_options[my_slider_style]">
				<option value="style-1" 
					<?php isset( self::$options['my_slider_style'] ) ? selected( 'style-1', self::$options['my_slider_style'], true ) : ''; ?>>Style-1</option>
				<option value="style-2" 
					<?php isset( self::$options['my_slider_style'] ) ? selected( 'style-2', self::$options['my_slider_style'], true ) : ''; ?>>Style-2</option>
			</select>
			<?php
	}
	/**
	 * This function validates the input fields of the regsiter settings.
	 *
	 * @param array $input the param for the settings field.
	 * @return array $new_input array item.
	 */
	public function my_slider_validate( $input ) {
		$new_input = array();
		foreach ( $input as $key => $value ) {
			switch ( $key ) {
				case 'my_slider_title':
					if ( empty( $value ) ) {
						add_settings_error( 'my_slider_options', 'my_slider_message', 'Title field cannot be left empty!', 'warning' );
						$value = 'Please type some text';
					}
					$new_input[ $key ] = sanitize_text_field( $value );
					break;
				default:
					$new_input[ $key ] = sanitize_text_field( $value );
					break;
			}
		}
		return $new_input;
	}

}
