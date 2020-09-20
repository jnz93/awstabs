<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       unitycode.tech
 * @since      1.0.0
 *
 * @package    Aws_Tabs
 * @subpackage Aws_Tabs/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Aws_Tabs
 * @subpackage Aws_Tabs/admin
 * @author     @joanezandrades <plugins@unitycode.tech>
 */
class Aws_Tabs_Admin {

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


		add_action('init', array($this, 'awstabs_buttons'));

		add_action('wp_head', array($this, 'enqueue_styles'));
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
		 * defined in Aws_Tabs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aws_Tabs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/aws-tabs-admin.css', array(), $this->version, 'all' );

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
		 * defined in Aws_Tabs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aws_Tabs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/aws-tabs-admin.js', array( 'jquery' ), $this->version, false );

	}

	
	// https://scanwp.net/blog/add-a-button-to-the-tinymce-editor-in-wordpress/
	public function awstabs_buttons()
	{
		if (!current_user_can('edit_posts') && !current_user_can('edit_pages')) :
			return;
		endif;

		if (get_user_option('rich_editing') !== 'true') :
			return;
		endif;

		add_filter('mce_external_plugins', array($this, 'awstabs_add_buttons'));
		add_filter('mce_buttons', array($this, 'awstabs_register_buttons'));
	}


	public function awstabs_add_buttons($plugin_array)
	{
		$plugin_array['topThreeBtn'] = plugin_dir_url(__FILE__) . '/js/aws-tabs-top-three-cta.js';
		$plugin_array['proAndConBtn'] = plugin_dir_url(__FILE__) . '/js/aws-tabs-pro-and-con.js';
		$plugin_array['technicalDetails'] = plugin_dir_url(__FILE__) . '/js/aws-tabs-technical-details.js';
		return $plugin_array;
	}
	
	public function awstabs_register_buttons($buttons)
	{
		array_push($buttons, 'topThreeBtn');
		array_push($buttons, 'proAndConBtn');
		array_push($buttons, 'technicalDetails');
		return $buttons;
	}
}
