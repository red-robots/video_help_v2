<?php
/**
 * Plugin Name: Video Help v2
 * Plugin URI: https://bellaworksweb.com/
 * Description: VH Admin
 * Version: 1.1.2 
 * Author: Austin Crane
 */


if( ! defined('ABSPATH') ){
    die('Hey! What are you doing here?');
}

define( 'CUSTOM_VIDEO_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define( 'CUSTOM_VIDEO_PLUGIN_URI', plugin_dir_url( __FILE__ ));

/*
if( file_exists( dirname( __FILE__ ) . '/vendor/autoload.php' ) ){
    require_once dirname( __FILE__ ) . '/vendor/autoload.php';
}


function activate_video_help_plugin(){
    \Inc\Base\Activate::activate();
}
register_activation_hook( __FILE__, 'activate_video_help_plugin' );

function deactivate_video_help_plugin(){
    \Inc\Base\Deactivate::deactivate();
}
register_deactivation_hook( __FILE__, 'deactivate_video_help_plugin' );


if( class_exists('Inc\\Init') )
{
    Inc\Init::register_services();
}

*/


function activate_video_help_plugin(){
    $menuLabel = "Video Help";
    $titleLabel = "Table of Contents";
    update_option( 'video_help_menu_label', $menuLabel);
    update_option( 'video_help_title_label', $titleLabel);
}
register_activation_hook( __FILE__, 'activate_video_help_plugin' );

function deactivate_video_help_plugin(){
    delete_option( 'video_help_menu_label' );
    delete_option( 'video_help_title_label' );
}
register_deactivation_hook( __FILE__, 'deactivate_video_help_plugin' );





// Register Custom Post Type video_link
// Post Type Key: videolink

//Add view videos 
add_action('admin_menu', 'addcustomvideoview');
function addcustomvideoview(){

	$menuTitle = ( get_option( 'video_help_menu_label' ) ) ? get_option( 'video_help_menu_label' ) : 'Video Help';

    add_menu_page( $menuTitle, $menuTitle, 	'manage_options', 'customviewvideo', 'customvideoviewrenderfunc', 'dashicons-video-alt3', 	1 );

    add_submenu_page('customviewvideo', 'Videos', 'Videos', 'manage_options', 'customviewvideo'); 
    add_submenu_page( 'customviewvideo', 'VH Admin', 'VH Admin', 'manage_options', 'edit.php?post_type=video_help' );
    add_submenu_page( 'customviewvideo', 'VH Admin New', 'New Video', 'manage_options', 'post-new.php?post_type=video_help' );
    add_submenu_page( 'customviewvideo', 'Settings', 'Settings', 'manage_options', 'video-settings', 'custom_video_settings_callback' );
}


function create_videolink_cpt() {

	$labels = array(
		'name' => __( 'VH Admin', 'Post Type General Name', 'videolinktextdomain' ),
		'singular_name' => __( 'VH Admin', 'Post Type Singular Name', 'videolinktextdomain' ),
		'menu_name' => __( 'VH Admin', 'videolinktextdomain' ),
		'name_admin_bar' => __( 'VH Admin', 'videolinktextdomain' ),
		'archives' => __( 'VH Admin Archives', 'videolinktextdomain' ),
		'attributes' => __( 'VH Admin Attributes', 'videolinktextdomain' ),
		'parent_item_colon' => __( 'Parent video_link:', 'videolinktextdomain' ),
		'all_items' => __( 'All VH Admin', 'videolinktextdomain' ),
		'add_new_item' => __( 'Add new video', 'videolinktextdomain' ),
		'add_new' => __( 'Add New', 'videolinktextdomain' ),
		'new_item' => __( 'New VH Admin', 'videolinktextdomain' ),
		'edit_item' => __( 'Edit VH Admin', 'videolinktextdomain' ),
		'update_item' => __( 'Update VH Admin', 'videolinktextdomain' ),
		'view_item' => __( 'View VH Admin', 'videolinktextdomain' ),
		'view_items' => __( 'View VH Admin', 'videolinktextdomain' ),
		'search_items' => __( 'Search VH Admin', 'videolinktextdomain' ),
		'not_found' => __( 'Not found', 'videolinktextdomain' ),
		'not_found_in_trash' => __( 'Not found in Trash', 'videolinktextdomain' ),
		'featured_image' => __( 'Featured Image', 'videolinktextdomain' ),
		'set_featured_image' => __( 'Set featured image', 'videolinktextdomain' ),
		'remove_featured_image' => __( 'Remove featured image', 'videolinktextdomain' ),
		'use_featured_image' => __( 'Use as featured image', 'videolinktextdomain' ),
		'insert_into_item' => __( 'Insert into VH Admin', 'videolinktextdomain' ),
		'uploaded_to_this_item' => __( 'Uploaded to this VH Admin', 'videolinktextdomain' ),
		'items_list' => __( 'VH Admin list', 'videolinktextdomain' ),
		'items_list_navigation' => __( 'VH Admin list navigation', 'videolinktextdomain' ),
		'filter_items_list' => __( 'Filter VH Admin list', 'videolinktextdomain' ),
	);
	$args = array(
		'label' => __( 'video_link', 'videolinktextdomain' ),
		'description' => __( 'Video links', 'videolinktextdomain' ),
		'labels' => $labels,
		'menu_icon' => 'dashicons-admin-generic',
		'supports' => array('title', 'page-attributes' ),
		'taxonomies' => array('video_cats', ),
		'public' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'menu_position' => 500,
		'show_in_admin_bar' => true,
		'show_in_nav_menus' => true,
		'can_export' => true,
		'has_archive' => false,
		'hierarchical' => true,
		'exclude_from_search' => true,
		'show_in_rest' => true,
		'publicly_queryable' => true,
		'capability_type' => 'page',		
	);
	register_post_type( 'video_help', $args );

}
add_action( 'admin_menu', 'create_videolink_cpt', 0 );



function custom_video_settings_callback()
{
	require_once ( CUSTOM_VIDEO_PLUGIN_DIR . 'templates/settings.php');
}



class videohelpmetabox {
	private $screen = array(
		'video_help',
	);
	private $meta_fields = array(
		array(
			'label' => 'Video description',
			'id' => 'videodescription',
			'type' => 'wysiwyg',
			'default' => ''
		),
		
		array(
			'label' => 'Video URL',
			'id' => 'videourl',
			'type' => 'text',
			'default' => ''
        ),
		

	);
	public function __construct() {
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_fields' ) );
	}
	public function add_meta_boxes() {
		foreach ( $this->screen as $single_screen ) {
			add_meta_box(
				'videmetabox',
				__( 'Video content', 'videolinktextdomain' ),
				array( $this, 'meta_box_callback' ),
				$single_screen,
				'advanced',
				'default'
			);
		}
	}
	public function meta_box_callback( $post ) {
		wp_nonce_field( 'videometabox_data', 'videmetabox_nonce' );
		$this->field_generator( $post );
	}
	public function field_generator( $post ) {
		$output = '';
		foreach ( $this->meta_fields as $meta_field ) {
			$label = '<label for="' . $meta_field['id'] . '">' . $meta_field['label'] . '</label>';
			$meta_value = get_post_meta( $post->ID, $meta_field['id'], true );
			if ( empty( $meta_value ) ) {
				$meta_value = $meta_field['default']; 
			}
			switch ( $meta_field['type'] ) {
				case 'wysiwyg':
					ob_start();
					wp_editor($meta_value, $meta_field['id']);
					$input = ob_get_contents();
					ob_end_clean();
					break;
				default:
					$input = sprintf(
						'<input %s id="%s" name="%s" type="%s" value="%s">',
						$meta_field['type'] = 'style="width: 100%"' ,
						$meta_field['id'],
						$meta_field['id'],
						$meta_field['type'],
						$meta_value
					);
			}
			$output .= $this->format_rows( $label, $input );
		}
		echo '<table class="form-table"><tbody>' . $output . '</tbody></table>';
	}
	public function format_rows( $label, $input ) {
		return '<tr><th>'.$label.'</th><td>'.$input.'</td></tr>';
	}
	public function save_fields( $post_id ) {
		if ( ! isset( $_POST['videmetabox_nonce'] ) )
			return $post_id;
		$nonce = $_POST['videmetabox_nonce'];
		if ( !wp_verify_nonce( $nonce, 'videometabox_data' ) )
			return $post_id;
		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
			return $post_id;
		foreach ( $this->meta_fields as $meta_field ) {
			$_POST[ $meta_field['id'] ] = sanitize_text_field( $_POST[ $meta_field['id'] ] );
			update_post_meta( $post_id, $meta_field['id'], $_POST[ $meta_field['id'] ] );
		}
	}
}
if (class_exists('videohelpmetabox')) {
	new videohelpmetabox();
};


class Video_Help_Custom_Page_Walker extends Walker_Page {

    function start_el(&$output, $page, $depth = 0, $args = array(), $current_page = 0) {

        extract($args, EXTR_SKIP);
        $css_class = array('page_item', 'page-item-'.$page->ID);
		
        $css_class = implode( ' ', apply_filters( 'page_css_class', $css_class, $page, $depth, $args, $current_page ) );

		$has_children =  $page->post_parent;
		$is_parent= '';
		if( $has_children == 0 ){
			$is_parent = ' page_item_has_children';
		}
		
        $output .=  '<li id="field_id_'. $page->ID .'" class="' . $css_class . $is_parent . ' ui-state-default">';
		$output .= '<a href="' . get_permalink($page->ID) . '"  data-pageid='.$page->ID.'>' . $link_before;

		$output .= apply_filters( 'the_title', $page->post_title, $page->ID );
		$output .= $link_after . '</a>';

    }
}



function customvideoviewrenderfunc(){

		$titleLabel = get_option( 'video_help_title_label' );

		$args_for_list_pages = array (
			'post_type' => 'video_help',
			'title_li' => '',
			'walker' => new Video_Help_Custom_Page_Walker(),
			'link_after' => '<i class="far fa-play-circle"></i>'
		);	
	?>
	
	<div class="custom_toc_and_video_container">
		<h1 class="wp-heading-inline"><?php echo ($titleLabel) ? $titleLabel : 'Table of Contents'; ?></h1>
		<div class="custom_half_chapter">
			<div class="custom_video_help_container">				
				<ul id="new_fields">
					<?php echo wp_list_pages($args_for_list_pages); ?>
				</ul>
			</div>
		</div>
		
		<div class="custom_half_video custom_post_video_title_and_content">
			<!-- just a spinner -->
			<div class="lds-dual-ring"></div>
			
			<div class="custom_post_title"></div>
			<div class="custom_post_video">
				<div class="embed-container">					
				</div>
			</div>
			<div class="custom_post_content"></div>
		</div>
		
	</div>	

	<div class="clearfix"></div>

	<?php if( esc_attr( get_option('video_activate_agency_link') ) ): ?>
	<div class="activate_agency">

		<div class="activated" style="background-color: <?php echo esc_attr( get_option('video_agency_background_color') ); ?>">
			<div class="logo-holder">
				<img src="<?php echo esc_attr( get_option('video_agency_branding') ); ?>" alt="">
			</div>
			<div class="title-holder">
				<h2><?php echo esc_attr( get_option('video_agency_title') ); ?></h2>
			</div>
			<div class="description-holder">
				<?php echo esc_attr( get_option('video_agency_description') ); ?>
			</div>
			<div class="btn-holder">
				<a href="<?php echo esc_attr( get_option('video_agency_button_link') ); ?>" target="_blank" class="contact" style="color: <?php echo esc_attr( get_option('video_agency_button_text_color') ); ?>; background-color: <?php echo esc_attr( get_option('video_agency_button_color') ); ?>">Contact Us Today</a>
			</div>
		</div>
			
	</div>

	<div class="clearfix"></div>

	<?php endif; ?>

	
	<?php 
	
}	


add_action( 'wp_ajax_nopriv_getvideocontent', 'getvideohelpcontent_func' );
add_action( 'wp_ajax_getvideocontent', 'getvideohelpcontent_func' );

function getvideohelpcontent_func() {
	//sleep(300);
	
	$post = get_post($_POST['pageid']); 
	$postcontent = get_post_meta($post->ID,'videodescription',true);
	
	//print_r($post);
	
	$title = apply_filters('the_title', $post->post_title); 
	$content = apply_filters('the_content', $postcontent); 
	
	$videourl= get_post_meta($post->ID , 'videourl', true);
	
	
	$array_to_return = array(
		'title' => $title,
		'videoembed' => ( $videourl ? wp_oembed_get($videourl) : '' ),
		'content' => $content
	);
	
	wp_send_json ( $array_to_return  );

}






function customvideohelp_load_wp_admin_style($hook) {
		
        // Load only on ?page=customviewvideo
        //if($hook != 'toplevel_page_customviewvideo') {
		//	return;
        //}
            

        wp_enqueue_style( 'font-awesome-free', '//use.fontawesome.com/releases/v5.2.0/css/all.css' );

        // jquery ui
        wp_enqueue_style( 'jquery-ui-custom-css', CUSTOM_VIDEO_PLUGIN_URI . 'css/jquery-ui.css' );
        wp_enqueue_script( 'jquery-ui-custom-js', 'https://code.jquery.com/ui/1.12.0/jquery-ui.min.js', array('jquery'),'', true );

        wp_enqueue_style( 'custom_wp_admin_css', CUSTOM_VIDEO_PLUGIN_URI . 'style.css' );    
		
		//load the JS and localize it 
		wp_register_script( 'customvideojs',  CUSTOM_VIDEO_PLUGIN_URI . 'js/scripts.js' );
		$translation_array = array(
			'adminajax' =>  admin_url( 'admin-ajax.php' )
		);
		wp_localize_script( 'customvideojs', 'customvideoadminscripts', $translation_array );
		wp_enqueue_script( 'customvideojs' );		
		
}
add_action( 'admin_enqueue_scripts', 'customvideohelp_load_wp_admin_style' );


function update_field_order(){
	global $wpdb;
	$fields = explode('&', $_POST['field_id']);
	//var_dump($fields);
	foreach ( $fields as $position => $item ) {
		$value  	= (int) substr( $item, strpos( $item, '=') + 1 );
		$value 		= filter_var( $value, FILTER_VALIDATE_INT ) ? $value : 0;
		$position 	= filter_var($position, FILTER_VALIDATE_INT) ? $position : 0;
		$query 		= sprintf("UPDATE wp_posts SET menu_order=%d where id=%d", $position, $value);
		$wpdb->query($query);		
	}
	die();
}
add_action('wp_ajax_update_field_order', 'update_field_order' );
add_action( 'wp_ajax_nopriv_update_field_order', 'update_field_order' );

