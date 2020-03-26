<?php
/*
*   @package VideoHelpV2
*/

namespace Inc\Base;

use Inc\Base\BaseController;

class Enqueue extends BaseController
{
    public function register()
    {
        add_action( 'admin_enqueue_scripts', array( $this, 'enqueue' ) );
    }

    public function enqueue( $hook ) {
        
            // Load only on ?page=customviewvideo
            //if($hook != 'toplevel_page_customviewvideo') {
            //  return;
            //}
            wp_enqueue_style( 'custom_wp_admin_css', $this->plugin_url . 'style.css' );           

            wp_enqueue_style( 'font-awesome-free', '//use.fontawesome.com/releases/v5.2.0/css/all.css' );
            
            //load the JS and localize it 
            wp_register_script( 'customvideojs',  $this->plugin_url . 'js/scripts.js' );
            $translation_array = array(
                'adminajax' =>  admin_url( 'admin-ajax.php' )
            );
            wp_localize_script( 'customvideojs', 'customvideoadminscripts', $translation_array );
            wp_enqueue_script( 'customvideojs' );       
            
    }
}