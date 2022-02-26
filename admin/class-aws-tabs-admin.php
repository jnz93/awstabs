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

		add_action( 'init', [ $this, 'awstabs_register_custom_post_type' ] );
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

	/**
	 * Create custom post type
	 * 
	 */
	public function awstabs_register_custom_post_type()
	{
		$labels = array(
			'name'                  => _x( 'AWS Cartões de Crédito', 'Post type general name', 'textdomain' ),
			'singular_name'         => _x( 'AWS Cartão de Crédito', 'Post type singular name', 'textdomain' ),
			'menu_name'             => _x( 'AWS Cartão de Crédito', 'Admin Menu text', 'textdomain' ),
			'name_admin_bar'        => _x( 'AWS Cartão de Crédito', 'Add New on Toolbar', 'textdomain' ),
			'add_new'               => __( 'Adicionar novo', 'textdomain' ),
			'add_new_item'          => __( 'Adicionar novo Cartão de Crédito', 'textdomain' ),
			'new_item'              => __( 'Novo', 'textdomain' ),
			'edit_item'             => __( 'Editar', 'textdomain' ),
			'view_item'             => __( 'Visualizar', 'textdomain' ),
			'all_items'             => __( 'Todos Cartão de Crédito', 'textdomain' ),
			'search_items'          => __( 'Procurar Cartão de Crédito', 'textdomain' ),
			'parent_item_colon'     => __( 'Parent Cartão de Crédito:', 'textdomain' ),
			'not_found'             => __( 'No Cartão de Crédito found.', 'textdomain' ),
			'not_found_in_trash'    => __( 'No Cartão de Crédito found in Trash.', 'textdomain' ),
			'featured_image'        => _x( 'Cartão de Crédito Foto', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
			'set_featured_image'    => _x( 'Definir foto do cartão', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
			'remove_featured_image' => _x( 'Remover foto do cartão', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
			'use_featured_image'    => _x( 'Usar como foto do cartão', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
			'archives'              => _x( 'Cartão de Crédito arquivos', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
			'insert_into_item'      => _x( 'Inserir em Cartão de Crédito', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
			'uploaded_to_this_item' => _x( 'Carregado para o Cartão de Crédito', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
			'filter_items_list'     => _x( 'Filtrar lista de Cartão de Crédito', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
			'items_list_navigation' => _x( 'Cartão de Crédito lista de navegação', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
			'items_list'            => _x( 'Cartão de Crédito Lista', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
		);
	 
		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => 'credit-card' ),
			'capability_type'    => 'post',
			'has_archive'        => true,
			'hierarchical'       => false,
			'menu_position'      => null,
			'supports'           => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt' ),
		);
	 
		register_post_type( 'aws-credit-card', $args );
	}
}
