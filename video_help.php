<?php
/**
 * Plugin Name: Video Help
 * Plugin URI: https://bellaworksweb.com/
 * Description: VH Admin
 * Version: 1.1.2 
 * Author: Austin Crane
 */

define( 'CUSTOM_VIDEO_PLUGIN_DIR', plugin_dir_path( __FILE__ ));
define( 'CUSTOM_VIDEO_PLUGIN_URI', plugin_dir_url( __FILE__ ));


 


// Register Custom Post Type video_link
// Post Type Key: videolink

//Add view videos 
add_action('admin_menu', 'addcustomvideoview');
function addcustomvideoview(){
    add_menu_page(
    	'Video Help', 
    	'Video Help', 
    	'manage_options', 
    	'customviewvideo', 
    	'customvideoviewrenderfunc',
    	'dashicons-video-alt3',
    	1

    );
}


function create_videolink_cpt() {

	$labels = array(
		'name' => __( 'VH Admin', 'Post Type General Name', 'videolinktextdomain' ),
		'singular_name' => __( 'VH Admin', 'Post Type Singular Name', 'videolinktextdomain' ),
		/*'menu_name' => __( 'VH Admin', 'videolinktextdomain' ),
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
		'filter_items_list' => __( 'Filter VH Admin list', 'videolinktextdomain' ),*/
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


function videos_custom_admin_menu() { 
    add_submenu_page('customviewvideo', 'Videos', 'Videos', 'manage_options', 'customviewvideo'); 
    add_submenu_page( 'customviewvideo', 'VH Admin', 'VH Admin', 'manage_options', 'edit.php?post_type=video_help' );
    add_submenu_page( 'customviewvideo', 'VH Admin New', 'New Video', 'manage_options', 'post-new.php?post_type=video_help' );
    add_submenu_page( 'customviewvideo', 'Settings', 'Settings', 'manage_options', 'video-settings', 'custom_video_settings_callback' );   
}  
add_action('admin_menu', 'videos_custom_admin_menu'); 

function custom_video_settings_callback()
{
	require_once ( CUSTOM_VIDEO_PLUGIN_DIR . 'templates/settings.php');
}

// Register Taxonomy Category
// Taxonomy Key: category
/*
add_action( 'init', 'create_category_tax' );
function create_category_tax() {

	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'videolinktextdomain' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'videolinktextdomain' ),
		'search_items'      => __( 'Search Categories', 'videolinktextdomain' ),
		'all_items'         => __( 'All Categories', 'videolinktextdomain' ),
		'parent_item'       => __( 'Parent Category', 'videolinktextdomain' ),
		'parent_item_colon' => __( 'Parent Category:', 'videolinktextdomain' ),
		'edit_item'         => __( 'Edit Category', 'videolinktextdomain' ),
		'update_item'       => __( 'Update Category', 'videolinktextdomain' ),
		'add_new_item'      => __( 'Add New Category', 'videolinktextdomain' ),
		'new_item_name'     => __( 'New Category Name', 'videolinktextdomain' ),
		'menu_name'         => __( 'Category', 'videolinktextdomain' ),
	);
	$args = array(
		'labels' => $labels,
		'description' => __( '', 'videolinktextdomain' ),
		'hierarchical' => true,
		'public' => true,
		'publicly_queryable' => true,
		'show_ui' => true,
		'show_in_menu' => true,
		'show_in_nav_menus' => true,
		'show_in_rest' => false,
		'show_tagcloud' => true,
		'show_in_quick_edit' => true,
		'show_admin_column' => false,
	);
	register_taxonomy( 'videocats', array('videolink', ), $args );

}

*/


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
		/*
		array(
			'label' => 'Video Priority',
			'id' => 'videopriority',
			'type' => 'number',
			'default' => ''
		),
		*/

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










// Create Shortcode videhelp
// Use the shortcode: [videhelp category=""]

/*
add_shortcode( 'videohelp', 'create_videhelp_shortcode' );
function create_videhelp_shortcode($atts) {
	// Attributes
	$atts = shortcode_atts(
		array(
			'category' => '',
		),
		$atts,
		'videhelp'
	);
	// Attributes in var
    $category = $atts['category'];
    


    ob_start();

    //var_dump($category);
    // Query Arguments
    $args = array(
        'post_type' => array('video_help'),
        'ignore_sticky_posts' => true,
        //'order' => 'DESC',
        //'orderby' => 'meta_value_num',
        //'meta_key' => 'videopriority',
        

        
    );

    if($category!=''){
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'videocats',
                'field' => 'slug',
                'terms' => $category
            )
        );
    }

    //pp($args);

    // The Query
    $getallvideos = new WP_Query( $args );

    // The Loop
    if ( $getallvideos->have_posts() ) {
        while ( $getallvideos->have_posts() ) {
            $getallvideos->the_post();
              // echo the_title();
        }
    } else {
        echo "nothing found";
    } 
    // Restore original Post Data 
    wp_reset_postdata();


	$output_string = ob_get_contents();
	ob_end_clean();
	return $output_string;
	
}

*/



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
		
        $output .=  '<li class="' . $css_class . $is_parent . '">';
		$output .= '<a href="' . get_permalink($page->ID) . '"  data-pageid='.$page->ID.'>' . $link_before;

		$output .= apply_filters( 'the_title', $page->post_title, $page->ID );
		$output .= $link_after . '</a>';

    }
}



function customvideoviewrenderfunc(){
		$args_for_list_pages = array (
			'post_type' => 'video_help',
			'title_li' => '',
			'walker' => new Video_Help_Custom_Page_Walker(),
			'link_after' => '<i class="far fa-play-circle"></i>'
		);	
	?>
	
	<div class="custom_toc_and_video_container">
		<h1 class="wp-heading-inline">Table of Contents</h1>
		<div class="custom_half_chapter">
			<div class="custom_video_help_container">
				
				<ul>
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
        if($hook != 'toplevel_page_customviewvideo') {
			return;
        }
        wp_enqueue_style( 'custom_wp_admin_css', CUSTOM_VIDEO_PLUGIN_URI . 'style.css' );

        wp_enqueue_style( 'font-awesome-free', '//use.fontawesome.com/releases/v5.2.0/css/all.css' );
		
		//load the JS and localize it 
		wp_register_script( 'customvideojs',  CUSTOM_VIDEO_PLUGIN_URI . 'js/scripts.js' );
		$translation_array = array(
			'adminajax' =>  admin_url( 'admin-ajax.php' )
		);
		wp_localize_script( 'customvideojs', 'customvideoadminscripts', $translation_array );
		wp_enqueue_script( 'customvideojs' );		
		
}
add_action( 'admin_enqueue_scripts', 'customvideohelp_load_wp_admin_style' );




