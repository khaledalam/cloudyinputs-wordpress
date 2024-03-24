<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://KhaledAlam.net
 * @since      1.0.0
 *
 * @package    Cloudyinputs
 * @subpackage Cloudyinputs/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cloudyinputs
 * @subpackage Cloudyinputs/admin
 * @author     Khaled Alam <khaledalam.net@gmail.com>
 */
class Cloudyinputs_Admin {

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
		 * defined in Cloudyinputs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cloudyinputs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cloudyinputs-admin.css', array(), $this->version, 'all' );

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
		 * defined in Cloudyinputs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cloudyinputs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cloudyinputs-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Function for `admin_menu` action-hook.
	 *
	 * Admin menu for powered-by-9h.
	 *
	 */
	public function admin_menu(): void
	{
		if (!current_user_can('manage_options')) {
			wp_die(__('You do not have sufficient permissions to access this page.'));
		}

		$adminMenuSettingsContent = function (): void {

			$pluginName = $this->plugin_name;
			$nonce = wp_create_nonce($pluginName . "_settings");
			$adminAjaxUrl = admin_url('admin-ajax.php');
			$apikeyOptionValue = get_option($pluginName . '_apikey');
			$enablePlugin = get_option($pluginName . '_enable') == 1 ? 'checked' : '';

			echo <<<HTML
                <div class="container" style="width: 90%; margin: auto; padding-top: 10px;">
                    <h3 style="display: flex; align-items: center;">
                        <span>CloudyInputs - Settings</span>
                    </h3>
                    <div style="margin: 5px;">
                    	<h3>General</h3>
                    	<div class="input-section">
                    			Enable Cloudyinputs: <input
                        		name="{$pluginName}_enable"
                        		id="{$pluginName}_enable"
                        		type="checkbox"
                        		$enablePlugin
                        	/><br /><br />
                        	
                    		<label>APIKEY:</label>
                    		<input 
                    			name="{$pluginName}_apikey"
                    			id="{$pluginName}_apikey"
                    			type="text"
                    			value="$apikeyOptionValue"
                            /><br /><br />
                            <small style="color: #a1a1a1;">
                            <span>1. Get Your APIKEY from <a href="https://speaktextonline.com/cloudyinputs" target="_blank">Dashboard</a></a> </span>
                            </small><br /><br />
                            <small style="color: #a1a1a1;">
                            <span>2. Put your domain <b>without</b> (http/https) in the "Allow use your API Key only from" section in <a href="https://speaktextonline.com/cloudyinputs" target="_blank">Dashboard</a></span>
                            </small>
                        </div>
                       
                        
                    </div>
                    <button style="margin-right: 5px; margin-top: 10px;" id="btn-save-settings" data-nonce="$nonce" data-admin-ajax="$adminAjaxUrl">💾 Save</button>
                </div>
                <br /><hr /><br />
                <small>Follow updates on twitter: <a href="https://twitter.com/KhaledAlamXYZ" target="_blank">@KhaledAlamXYZ</a></small>
            </div>
            HTML;
		};

		add_menu_page(
			__('CloudyInputs | Settings', 'cloudyinputs'),
			__('CloudyInputs', 'cloudyinputs'),
			'manage_options',
			'cloudyinputs',
			$adminMenuSettingsContent,
			'dashicons-cloud'
		);

	}

	/**
	 * Function for `wp_ajax_ajax_handle_save_settings` action-hook.
	 *
	 * Save plugin settings.
	 *
	 * @return void
	 */
	public function ajax_handle_save_settings(): void
	{
		$pluginName = $this->plugin_name;

		// Validate the nonce
		if (!wp_verify_nonce( $_POST['nonce'], $pluginName . "_settings")) {
			wp_send_json_error(["message" => "Bad request!"], 400);
		}

		$apikey = $_POST['apikey'];
		$enablePlugin = $_POST['enable'];

		update_option($pluginName . '_apikey', $apikey);
		update_option($pluginName . '_enable', $enablePlugin);


		wp_send_json(["message" => "Settings updated successfully!"], 200);

	}

}
