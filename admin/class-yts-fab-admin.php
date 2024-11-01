<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.github.com/yigitus/
 * @since      1.0.0
 *
 * @package    Yts_Fab
 * @subpackage Yts_Fab/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Yts_Fab
 * @subpackage Yts_Fab/admin
 * @author     yigitus <zenginyigit@yandex.com>
 */
class Yts_Fab_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

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
		 * defined in Yts_Fab_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Yts_Fab_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/yts-fab-admin.css', array(), $this->version, 'all' );

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
		 * defined in Yts_Fab_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Yts_Fab_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		wp_register_script(
			'yts-fab-admin-script',
			plugin_dir_url( __FILE__ ) . 'js/yts-fab-admin.js',
			array( 'jquery' ),
			'1.0  ',
			false
		);
		$saved_attachment_post_id = get_option( 'media_selector_attachment_id', 0 );
		wp_enqueue_script( 'yts-fab-admin-script' );
	}

	/**
 	* Generated by the WordPress Option Page generator
 	* at http://jeremyhixon.com/wp-tools/option-page/
 	*/

	private $yts_fab_options;

	public function yts_add_plugin_page() {
		add_theme_page(
			'YTS Floating action button', // page_title
			'YTS Floating action button', // menu_title
			'manage_options', // capability
			'yts-fab', // menu_slug
			array( $this, 'yts_create_admin_page' ) // function
		);
	}

	public function yts_create_admin_page() {
		 ?>

		<div class="wrap">
			<h2>YTS Floating action button</h2>
			<p>Customize FAB</p>
			<?php settings_errors(); ?>

			<form method="post" action="options.php">
				<?php
					settings_fields( 'yts_fab_option_group' );
					do_settings_sections( 'yts-fab-admin' );
					submit_button();
					do_settings_sections( 'yts_fab_advanced_setting_section' );
				?>
			</form>
		</div>
	<?php }

	public function yts_page_init() {
		$defaults = array(
			'isActive_0' => 'false',
			'text_1' => 'Help',
			'position_2' => 'right',
			'url_3' => '',
			'image_id_4' => '',
			'width_5' => '50',
			'height_6' => '50',
			'border_radius_0' => '5'
		  );
		  $this->yts_fab_options = wp_parse_args(get_option('yts_fab_option_name'), $defaults);
		register_setting(
			'yts_fab_option_group', // option_group
			'yts_fab_option_name', // option_name
			array( $this, 'yts_fab_sanitize' ) // sanitize_callback
		);

		add_settings_section(
			'yts_fab_setting_section', // id
			'Settings', // title
			array( $this, 'yts_fab_section_info' ), // callback
			'yts-fab-admin' // page
		);

		add_settings_section(
			'yts_fab_advanced_setting_section', // id
			'Advanced settings', // title
			array( $this, 'yts_fab_section_info' ), // callback
			'yts-fab-admin' // page
		);

		add_settings_field(
			'isActive_0', // id
			'Active', // title
			array( $this, 'isActive_0_callback' ), // callback
			'yts-fab-admin', // page
			'yts_fab_setting_section' // section
		);
		
		add_settings_field(
			'text_1', // id
			'Text', // title
			array( $this, 'text_1_callback' ), // callback
			'yts-fab-admin', // page
			'yts_fab_setting_section' // section
		);

		add_settings_field(
			'position_2', // id
			'Location', // title
			array( $this, 'position_2_callback' ), // callback
			'yts-fab-admin', // page
			'yts_fab_setting_section' // section
		);

		add_settings_field(
			'url_3', // id
			'Link', // title
			array( $this, 'url_3_callback' ), // callback
			'yts-fab-admin', // page
			'yts_fab_setting_section' // section
		);

		add_settings_field(
			'image_id_4', // id
			'Image', // title
			array( $this, 'image_id_4_callback' ), // callback
			'yts-fab-admin', // page
			'yts_fab_setting_section' // section
		);

		add_settings_field(
			'width_5', // id
			'Width', // title
			array( $this, 'width_5_callback' ), // callback
			'yts-fab-admin', // page
			'yts_fab_setting_section' // section
		);

		add_settings_field(
			'height_6', // id
			'Height', // title
			array( $this, 'height_6_callback' ), // callback
			'yts-fab-admin', // page
			'yts_fab_setting_section' // section
		);

		//Advanced Settings

		add_settings_field(
			'border_radius_0',
			'Border radius',
			array( $this, 'border_radius_0_callback'),
			'yts-fab-admin',
			'yts_fab_advanced_setting_section'
		);
	}

	public function yts_fab_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['text_1'] ) ) {
			$sanitary_values['text_1'] = esc_attr( $input['text_1'] );
		}

		if ( isset( $input['position_2'] ) ) {
			$sanitary_values['position_2'] = esc_attr( $input['position_2'] );
		}

		if ( isset( $input['url_3'] ) ) {
			$sanitary_values['url_3'] = esc_url( $input['url_3'] );
		}

		if ( isset( $input['image_id_4'] ) ) {
			$sanitary_values['image_id_4'] = esc_attr( $input['image_id_4'] );
		}

		if ( isset( $input['width_5'] ) ) {
			$sanitary_values['width_5'] = esc_attr( $input['width_5'] );
		}

		if ( isset( $input['height_6'] ) ) {
			$sanitary_values['height_6'] = esc_attr( $input['height_6'] );
		}

		if ( isset( $input['border_radius_0'] ) ) {
			$sanitary_values['border_radius_0'] = esc_attr( $input['border_radius_0'] );
		}

		if ( isset( $input['isActive_0'] ) ) {
			$sanitary_values['isActive_0'] = esc_attr( $input['isActive_0'] );
		}

		return $sanitary_values;
	}

	public function yts_fab_section_info() {
		
	}

	public function text_1_callback() {
		printf(
			'<textarea class="large-text" rows="5" name="yts_fab_option_name[text_1]" id="text_1">%s</textarea>',
			esc_attr( $this->yts_fab_options['text_1'])
		);
	}

	public function position_2_callback() {
		?> <select name="yts_fab_option_name[position_2]" id="position_2">
			<?php $selected = ($this->yts_fab_options['position_2'] === 'right') ? 'selected' : '' ; ?>
			<option value="right" <?php echo $selected; ?>>Right</option>
			<?php $selected = ($this->yts_fab_options['position_2'] === 'left') ? 'selected' : '' ; ?>
			<option value="left" <?php echo $selected; ?>>Left</option>
		</select> <?php
	}

	public function url_3_callback() {
		printf(
			'<textarea class="large-text" rows="2" name="yts_fab_option_name[url_3]" id="url_3">%s</textarea>',
			esc_attr( $this->yts_fab_options['url_3'])
		);
	}

	
	public function image_id_4_callback() {
		wp_enqueue_media();
		$image_id = isset($this->yts_fab_options['image_id_4']) ? $this->yts_fab_options['image_id_4'] : "";
		?>
        <div class='image-preview-wrapper'>
            <img id='image-preview' src='<?php echo  $image_id != "" && isset($image_id) ? esc_attr( wp_get_attachment_image_src($image_id)[0]) : esc_url(plugin_dir_url( __FILE__ ) . 'placeholder.png') ; ?>' width='200'>
        </div>
        <input id="upload_image_button" type="button" class="button" value="<?php  _e('Select image', 'yts_fab')  ?>" >
        <input type='hidden' name='yts_fab_option_name[image_id_4]' value="<?php echo isset( $this->yts_fab_options['image_id_4'] ) ? esc_attr( $this->yts_fab_options['image_id_4'] ) : '' ; ?>" id='image_id_4'  >
		<?php
	}
	
	
	public function width_5_callback() {
		printf(
			'<input type="text" name="yts_fab_option_name[width_5]" id="width_5" value="%s">',
			esc_attr( $this->yts_fab_options['width_5'])
		);
	}

	public function height_6_callback() {
		printf(
			'<input type="text" name="yts_fab_option_name[height_6]" id="height_6" value="%s">',
			esc_attr( $this->yts_fab_options['height_6'])
		);
	}

	public function isActive_0_callback() {
		?> 
		 <input type="checkbox" id="isActive_0" name="yts_fab_option_name[isActive_0]" value="true" <?php echo $this->yts_fab_options['isActive_0'] == "true" ? "checked" : "" ;?> />
		<?php
	}

	//Advanced settings

	public function border_radius_0_callback() {
		printf(
			'<input type="text" name="yts_fab_option_name[border_radius_0]" id="border_radius_0" value="%s">',
			esc_attr( $this->yts_fab_options['border_radius_0'])
		);
	}

}