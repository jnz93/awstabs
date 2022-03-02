<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       unitycode.tech
 * @since      1.0.0
 *
 * @package    Aws_Tabs
 * @subpackage Aws_Tabs/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Aws_Tabs
 * @subpackage Aws_Tabs/public
 * @author     @joanezandrades <plugins@unitycode.tech>
 */
class Aws_Tabs_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

		add_shortcode( 'cartoes_credito', [ $this, 'table_of_credit_card'] );
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
		 * defined in Aws_Tabs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aws_Tabs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/aws-tabs-public.css', array(), $this->version, 'all' );
		wp_enqueue_style('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css', array(), '5.1.3', 'all');

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
		 * defined in Aws_Tabs_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Aws_Tabs_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/aws-tabs-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Table of credit cards shortcode function
	 */
	public function table_of_credit_card( $atts ){
		$a = shortcode_atts( 
			[
				'number'    => 5,
				'tableType'	=> 'default',
			], 
			$atts
		);

        $args   = array(
            'post_type'         => 'aws-credit-card',
            'post_status'       => 'publish',
            'posts_per_page'    => $a['number'],
        );
        $posts 	= new WP_Query($args);

		# Bandeiras
		$args = array(
			'taxonomy'		=> 'credit-card-flags',
			'hide_empty'	=> false,
			'orderby'		=> 'name',
			'order'			=> 'ASC'
		);
		$cardFlags = get_terms( $args );
		$flags = '';
		if( $cardFlags ){
			foreach( $cardFlags as $item ){
				$flags .= '<option value="'. strtolower($item->name) .'" class="">'. $item->name .'</option>';
			} 
		}

		# Emissor
		$args['taxonomy'] = 'credit-card-issuers';
		$cardIssuers = get_terms( $args );
		$issuers = '';
		if( $cardIssuers ){
			foreach( $cardIssuers as $item ){
				$issuers .= '<option value="'. strtolower( $item->name ) .'" class="">'. $item->name .'</option>';
			}
		}
		# Segments
		$args['taxonomy'] = 'credit-card-segments';
		$cardSegments = get_terms( $args );
		$segments = '';
		if( $cardSegments ){
			foreach( $cardSegments as $item ){
				$segments .= '<option value="'. strtolower( $item->name ) .'" class="">'. $item->name .'</option>';
			}
		}
		
		$output = '';
		if( $posts->have_posts() ){
			$output .= '<div class="row header-list">
				<div class="col-4">
					<select name="" id="card-flag" class="">
						<option value="" class="" selected>Todas</option>
						'. $flags .'
					</select>
				</div>
				<div class="col-4">
					<select name="" id="card-issuer" class="">
						<option value="" class="" selected>Todas</option>
						'. $issuers .'
					</select>
				</div>
				<div class="col-4">
					<select name="" id="card-segment" class="">
						<option value="" class="" selected>Todas</option>
						'. $segments .'
					</select>
				</div>
			</div>';

			$output .= '<div class="table-responsive">
				<table class="table table-striped table-credit-cards">
					<thead class="table-head-rank">
						<tr>
						<th scope="col">#</th>
						<th scope="col">Cashback Padrão</th>
						<th scope="col">Cashback Parceiros</th>
						<th scope="col">Anuidade</th>
						<th scope="col">Observações</th>
						</tr>
					</thead>
					<tbody>';
			$position = 1;
			while( $posts->have_posts() ){
				$posts->the_post();
				$id 				= get_the_ID();
				$thumbnail 			= get_the_post_thumbnail( $id );
				$title 				= get_the_title( $id );
				$defaultCashback 	= get_post_meta( $id, 'awstabs_default_cashback', true );
				$partnersCashback 	= get_post_meta( $id, 'awstabs_partners_cashback', true );
				$annuity 			= get_post_meta( $id, 'awstabs_annuity', true );
				$comments 			= get_the_content( $id );
				$flag 				= wp_get_post_terms( $id, 'credit-card-flags' );
				$issuer 			= wp_get_post_terms( $id, 'credit-card-issuers' );
				$segment 			= wp_get_post_terms( $id, 'credit-card-segments' );
				
				$output .= '<tr data-flag="'. strtolower( $flag[0]->name ) .'" data-issuer="'. strtolower( $issuer[0]->name ) .'" data-segment="'. strtolower( $segment[0]->name ) .'">
					<th scope="row">
						<div class="d-block">'. $title .'</div>
						<div class="d-flex align-items-center">
							<span class="rank-position d-flex align-items-center justify-content-center">'. $position .'º</span>
							'. $thumbnail .'
						</div>
					</th>
					<td>'. $defaultCashback .'%</td>
					<td>'. $partnersCashback .'%</td>
					<td>R$'. $annuity .'</td>
					<td>'. $comments .'</td>
				</tr>';

				$position++;
			}

			
			$output .= '</tbody>
				</table>
			</div>';
		}
		wp_reset_postdata();

		return $output;
	}
}