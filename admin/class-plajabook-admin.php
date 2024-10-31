<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://www.codelabstudio.it
 * @since      1.0.0
 *
 * @package    Plajabook
 * @subpackage Plajabook/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Plajabook
 * @subpackage Plajabook/admin
 * @author     Codelab Studio <info@codelabstudio.it>
 */
class Plajabook_Admin {

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
		 * defined in Plajabook_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plajabook_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/plajabook-admin.css', array(), $this->version, 'all' );

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
		 * defined in Plajabook_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Plajabook_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/plajabook-admin.js', array( 'jquery' ), $this->version, false );

	}

	public function display_admin_page() {
 		add_action( 'admin_init', array( $this, 'plajabook_settings_page_init' ) );
		add_options_page(
			'Impostazioni Plajabook', // page_title
			'Plajabook', // menu_title
			'manage_options', // capability
			'plajabook-settings', // menu_slug
			array( $this, 'showPage' ) // function
		);		
	}

	public function showPage() {		
		include dirname(__FILE__)."/partials/plajabook-admin-display.php";
	}

	/*** settings ****/
	public function plajabook_settings_page_init() {
		
		register_setting(
			'plajabook_settings_option_group', // option_group
			'plajabook_settings_option_name', // option_name
			array( $this, 'plajabook_settings_sanitize' ) // sanitize_callback
		);
		
		add_settings_section(
			'plajabook_settings_setting_section', // id
			'', // title
			array( $this, 'plajabook_settings_section_info' ), // callback
			'plajabook-settings-admin' // page
		);
		
		add_settings_field(
			'codice_lido_0', // id
			'Codice Lido', // title
			array( $this, 'codice_lido_0_callback' ), // callback
			'plajabook-settings-admin', // page
			'plajabook_settings_setting_section' // section
		);
		
		add_settings_field(
			'modalit_visualizzazione_1', // id
			'Modalità visualizzazione', // title
			array( $this, 'modalit_visualizzazione_1_callback' ), // callback
			'plajabook-settings-admin', // page
			'plajabook_settings_setting_section' // section
		);

		add_settings_field(
			'testo_link_0', // id
			'Testo link', // title
			array( $this, 'testo_link_0_callback' ), // callback
			'plajabook-settings-admin', // page
			'plajabook_settings_setting_section' // section
		);

		add_settings_field(
			'classe_css_link_0', // id
			'Classe Css Link', // title
			array( $this, 'classe_css_link_0' ), // callback
			'plajabook-settings-admin', // page
			'plajabook_settings_setting_section' // section
		);
	}
	
	
	 function plajabook_settings_sanitize($input) {
		$sanitary_values = array();
		if ( isset( $input['codice_lido_0'] ) ) {
			$sanitary_values['codice_lido_0'] = sanitize_text_field( $input['codice_lido_0'] );
		}

		if ( isset( $input['testo_link_0'] ) ) {
			$sanitary_values['testo_link_0'] = sanitize_text_field( $input['testo_link_0'] );
		}

		if ( isset( $input['classe_css_link_0'] ) ) {
			$sanitary_values['classe_css_link_0'] = sanitize_text_field( $input['classe_css_link_0'] );
		}
	
		if ( isset( $input['modalit_visualizzazione_1'] ) ) {
			$sanitary_values['modalit_visualizzazione_1'] = $input['modalit_visualizzazione_1'];
		}
	
		return $sanitary_values;
	}
	
	function plajabook_settings_section_info() {
		
	}
	
	function codice_lido_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="plajabook_settings_option_name[codice_lido_0]" id="codice_lido_0" value="%s">',
			isset( $this->plajabook_settings_options['codice_lido_0'] ) ? esc_attr( $this->plajabook_settings_options['codice_lido_0']) : ''
		);
	}

	function classe_css_link_0() {
		printf(
			'<input class="regular-text" type="text" name="plajabook_settings_option_name[classe_css_link_0]" id="classe_css_link_0" value="%s">',
			isset( $this->plajabook_settings_options['classe_css_link_0'] ) ? esc_attr( $this->plajabook_settings_options['classe_css_link_0']) : ''
		);
	}

	function testo_link_0_callback() {
		printf(
			'<input class="regular-text" type="text" name="plajabook_settings_option_name[testo_link_0]" id="testo_link_0" value="%s">',
			isset( $this->plajabook_settings_options['testo_link_0'] ) ? esc_attr( $this->plajabook_settings_options['testo_link_0']) : ''
		);
	}
	
	function modalit_visualizzazione_1_callback() {
		?> <select name="plajabook_settings_option_name[modalit_visualizzazione_1]" id="modalit_visualizzazione_1">
			<?php $selected = (isset( $this->plajabook_settings_options['modalit_visualizzazione_1'] ) && $this->plajabook_settings_options['modalit_visualizzazione_1'] === '0') ? 'selected' : '' ; ?>
			<option value="0" <?php echo $selected; ?>>Link</option>
			<?php $selected = (isset( $this->plajabook_settings_options['modalit_visualizzazione_1'] ) && $this->plajabook_settings_options['modalit_visualizzazione_1'] === '1') ? 'selected' : '' ; ?>
			<option value="1" <?php echo $selected; ?>>IFrame</option>
		</select> <?php
	}
	
}
