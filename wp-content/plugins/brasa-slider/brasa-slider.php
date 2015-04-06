<?php
/**
 *
 *
 * @package   Brasa Slider
 * @author    Matheus Gimenez <contato@matheusgimenez.com.br>
 * @license   GPL-2.0+
 * @link      http://example.com
 * @copyright 2014 Matheus Gimenez
 *
 * @wordpress-plugin
 * Plugin Name:       Brasa Slider
 * Plugin URI:        http://codeispoetry.info/plugins/reveal-modal
 * Description:       Brasa Slider
 * Version:           1.0.0
 * Author:            Matheus Gimenez
 * Plugin URI:        http://codeispoetry.info/plugins/reveal-modal
 * Text Domain:       brasa_slider
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path:       /languages
 * GitHub Plugin URI: https://github.com/brasadesign/reveal-modal
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


class Brasa_Slider {
	public function __construct() {
		define( 'BRASA_SLIDER_URL', plugin_dir_url( __FILE__ ) );
		define( 'BRASA_SLIDER_DIR' , plugin_dir_path( __FILE__ ) );
		require_once BRASA_SLIDER_DIR . 'inc/odin-metabox.php';
		require_once BRASA_SLIDER_DIR . 'inc/metabox.php';
		add_image_size( 'brasa_slider_img', 1006, 408, true );
		add_action('init',array($this, 'init')); //init
		add_action( 'admin_init', array($this, 'admin_scripts') );
		add_action( 'add_meta_boxes', array( $this, 'add_boxes' ) );
		add_action( 'save_post', array( $this, 'save' ) );
		add_shortcode( 'brasa_slider',  array( $this, 'shortcode' ) );
	}
	public function init(){
		if(isset($_GET['brasa_slider_ajax']) && $_GET['brasa_slider_ajax'] == 'true' && current_user_can('edit_posts')){
			$this->ajax_search();
		}
		wp_enqueue_script('jquery');
		wp_enqueue_script(
			'brasa_slider_jqueryui_js',
			BRASA_SLIDER_URL . 'assets/js/slick.min.js',
			array('jquery')
		);
		wp_enqueue_style( 'brasa_slider_css_frontend', BRASA_SLIDER_URL . 'assets/css/slick.css' );
		$this->register_cpt();
	}
	private function register_cpt(){
		$labels = array(
			'name'                => _x( 'Brasa Sliders', 'Post Type General Name', 'brasa_slider' ),
			'singular_name'       => _x( 'Brasa Slider', 'Post Type Singular Name', 'brasa_slider' ),
			'menu_name'           => __( 'Brasa Slider', 'brasa_slider' ),
			'parent_item_colon'   => __( 'Slider parent', 'brasa_slider' ),
			'all_items'           => __( 'All sliders', 'brasa_slider' ),
			'view_item'           => __( 'View slider', 'brasa_slider' ),
			'add_new_item'        => __( 'Add New Slider', 'brasa_slider' ),
			'add_new'             => __( 'Add New', 'brasa_slider' ),
			'edit_item'           => __( 'Edit Slider', 'brasa_slider' ),
			'update_item'         => __( 'Update Slider', 'brasa_slider' ),
			'search_items'        => __( 'Search Slider', 'brasa_slider' ),
			'not_found'           => __( 'Not found', 'brasa_slider' ),
			'not_found_in_trash'  => __( 'Not found in Trash', 'brasa_slider' ),
			);
		$args = array(
			'label'               => __( 'brasa_slider_cpt', 'brasa_slider' ),
			'description'         => __( 'Brasa Slider', 'brasa_slider' ),
			'labels'              => $labels,
			'supports'            => array( 'title', ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_nav_menus'   => true,
			'show_in_admin_bar'   => true,
			'menu_position'       => 5,
			'menu_icon'           => 'dashicons-images-alt',
			'can_export'          => true,
			'has_archive'         => false,
			'exclude_from_search' => true,
			'publicly_queryable'  => false,
			'rewrite'             => false,
			'capability_type'     => 'page',
			);
		register_post_type( 'brasa_slider_cpt', $args );
	}
	public function admin_scripts(){
		if(isset($_GET['post'])){
			$post = get_post($_GET['post']);
		}
		if(isset($_GET['post_type']) && $_GET['post_type'] == 'brasa_slider_cpt' || isset($post) && $post->post_type == 'brasa_slider_cpt'){
			wp_enqueue_style( 'brasa_slider_css', BRASA_SLIDER_URL . 'assets/css/admin.css' );
			wp_enqueue_script('jquery');
			wp_enqueue_script(
				'brasa_slider_jqueryui_js',
				BRASA_SLIDER_URL . 'assets/js/jquery-ui.min.js',
				array('jquery')
				);
			wp_enqueue_script(
				'brasa_slider_all_js',
				BRASA_SLIDER_URL . 'assets/js/all.js',
				array('jquery')
				);
		}
	}
	public function add_boxes(){
		add_meta_box(
			'brasa_slider_search'
			,__( 'Search Posts by Name', 'brasa_slider' )
			,array( $this, 'render_search_meta' )
			,'brasa_slider_cpt'
			,'advanced'
			,'core'
			);
		add_meta_box(
			'brasa_slider_sortable'
			,__( 'Order Slider', 'brasa_slider' )
			,array( $this, 'render_sortable_meta' )
			,'brasa_slider_cpt'
			,'advanced'
			,'core'
			);
	}
	public function render_search_meta($post){
		_e('<input type="text" id="search_brasa_slider" placeholder="Search.. ">','brasa_slider');
		_e('<a id="search-bt-slider" class="button button-primary button-large">Search!</a>','brasa_slider');
		_e('<a class="button button-primary button-large select-image-brasa">Or select image</a>','brasa_slider');
		echo '<div id="brasa_slider_result" data-url="'.home_url().'"></div>';
	}
	public function render_sortable_meta($post){
		echo '<input type="text" name="brasa_slider_input" id="brasa_slider_hide" style="display:none">';
		echo '<ul id="brasa_slider_sortable_ul">';
		$ids = get_post_meta( $post->ID, 'brasa_slider_ids', true );
		if(!empty($ids)){
			$ids = explode(',',$ids);
			foreach ($ids as $id) {
				echo '<li class="brasa_slider_item is_item" data-post-id="'.$id.'" id="'.$id.'">';
				echo '<div class="title_item">';
	      		echo get_the_title($id);
	   			echo '</div><!-- title_item -->';
				echo '<div class="thumb_item">';
				if(get_post_type($id) == 'attachment'){
					$image_attributes = wp_get_attachment_image_src($id,'medium',false);
					echo '<img src="'.$image_attributes[0].'">';
				}
				else{
					echo get_the_post_thumbnail($id, 'medium');
				}
			   	echo sprintf(__('<a class="rm-item" data-post-id="%s">Remove this</a>','brasa-slider'),$id);
			    echo '</div><!-- thumb_item -->';
	   		    echo '<div class="container_brasa_link" style="width:70%;margin-left:30%;">';
	      		echo '<label class="link">Link (URL):</label><br>';
	      		echo '<input class="link_brasa_slider" type="text" name="brasa_slider_link_'.$id.'" placeholder="'.__('Link','brasa_slider').'" value="'.esc_url(get_post_meta($post->ID, 'brasa_slider_id'.$id, true )).'">';
	 			echo '</div><!-- container_brasa_link -->';
	   			echo '</li><!-- brasa_slider_item -->';
			}
		} else {
			_e( '<span class="notice_not_item">No items added to the Slider. Use the \'Search Posts by Name\' to search for items and add to Slider.</span>','brasa_slider');
		}
		echo '</ul>';
	}
	private function ajax_search(){
		$key = $_GET['key'];
	      	/**
			 * The WordPress Query class.
			 * @link http://codex.wordpress.org/Function_Reference/WP_Query
			 *
			 */
	      	$args = array(
				//Type & Status Parameters
	      		'post_type'   => 'any',
	      		's'         => $key
	      		);

	      	$query = new WP_Query( $args );

	      	if ( $query->have_posts() ) {
	      		_e('<h2>Click to select</h2>','brasa-slider');
	      		while ( $query->have_posts() ) {
	      			$query->the_post();
	      			echo '<div class="brasa_slider_item" data-post-id="'.get_the_ID().'">';
	      			the_post_thumbnail( 'medium' );
	      			echo '<div class="title_item">';
	      			the_title();
	      			echo '</div>';
	      			echo '<div class="container_brasa_link">';
	      			echo '<label>Link:</label><br>';
	      			echo '<input class="link_brasa_slider" type="text" name="brasa_slider_link_'.get_the_ID().'" placeholder="'.__('Link (Destination URL)','brasa_slider').'" value="'.get_permalink(get_the_ID()).'">';
	      			echo '</div>';
	      			_e('<a class="rm-item" data-post-id="'.get_the_ID().'">Remove this</a>','brasa-slider');
	      			echo '</div>';
	      		}
	      	}
	      	else{
	      		echo 'Not found';
	      	}
	    die();
	}
	public function save($post_id){
		if(isset($_POST['brasa_slider_input'])){
			$ids = $_POST['brasa_slider_input'];
			if(!empty($ids)){
				update_post_meta($post_id, 'brasa_slider_ids', $ids);
				$ids = explode(',', $ids);
				foreach ($ids as $id) {
					update_post_meta($post_id,'brasa_slider_id'.$id,esc_url($_POST['brasa_slider_link_'.$id]));
				}
			}
			else{
			    delete_post_meta( $post_id, 'brasa_slider_ids' );
			}
		}
	}
	public function shortcode($atts){
		$html = '';
		// Attributes
		extract( shortcode_atts(
			array(
				'name' => '',
				'size' => '',
				'json' => ''
				), $atts )
		);
		$slider = get_page_by_title( $atts['name'], OBJECT, 'brasa_slider_cpt' );
		if(!empty($slider) && isset($slider)){
			$cfg = (!empty($atts['json'])) ? $atts['json'] : get_post_meta($slider->ID,'brasa-slider-cfg',true);;
			$ids = get_post_meta( $slider->ID, 'brasa_slider_ids', true );
			$ids = explode(',', $ids);
			$size = (!empty($atts['size'])) ? $atts['size'] : get_post_meta( $slider->ID, 'brasa_slider_size', true );
			global $brasa_slider_id;
			$brasa_slider_id = $slider->ID;
			do_action( 'brasa_slider_before_foreach', $ids, $slider->ID );
		    $html = '<div class="col-md-12 is_slider" id="slider-'.$slider->post_name.'" data-json="'.esc_attr($cfg).'">';
		    foreach ($ids as $id) {
		    	global $brasa_slider_item_id;
		    	$brasa_slider_item_id = $id;
		    	do_action( 'brasa_slider_loop_header');
				if(get_post_type($id) == 'attachment'){
					$img = $id;
				}
				else{
					$img = get_post_thumbnail_id($id);
				}
				$size = apply_filters('brasa_slider_img_size', $size);
				$img = wp_get_attachment_image_src( $img, $size, false );
		    	$html .= '<div class="slick_slide">';
		    	$html  = apply_filters( 'brasa_slider_loop_before_link_container', $html );
		    	$html .= '<a href="'.esc_url(get_post_meta($slider->ID, 'brasa_slider_id'.$id, true )).'">';
		    	$html  = apply_filters( 'brasa_slider_loop_before_image', $html );
		    	$html .= '<img src="'.$img[0].'" class="img_slider"></a>';
		    	$html  = apply_filters( 'brasa_slider_loop_after_image', $html );
		    	$html .= '</div>';
		    }
		    $html .= '</div>';
		    return $html;
		}
		else{
			return false;
		}
	}
}
new Brasa_Slider();
