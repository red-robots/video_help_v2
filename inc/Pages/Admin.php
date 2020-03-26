<?php
/*
*   @package VideoHelpV2
*/

namespace Inc\Pages;

use Inc\Api\AdminApi;
use Inc\Api\AjaxRequest;
use Inc\Base\BaseController;
use Inc\Api\VideoHelpCustomPage;


class Admin extends BaseController
{
    public $pages = array();

    public $subpages = array();

    public $args_for_list_pages = array();

    public function setPages()
    {
        $this->pages = array(
                array(
                      'page_title'  => 'Video Help', 
                      'menu_title'  => 'Video Help', 
                      'capability'  => 'manage_options', 
                      'menu_slug'   => 'customviewvideo', 
                      'callback'    => array( $this, 'customvideoviewrenderfunc'), 
                      'icon_url'    => 'dashicons-video-alt3', 
                      'position'    => 1
                )
        );

        $this->subpages = array(
                array(
                      'parent_slug'  => 'customviewvideo', 
                      'page_title'  => 'VH Admin',
                      'menu_title'  => 'VH Admin', 
                      'capability'  => 'manage_options', 
                      'menu_slug'   => 'edit.php?post_type=video_help', 
                      'callback'    => '',
                ),
                array(
                      'parent_slug'  => 'customviewvideo', 
                      'page_title'  => 'VH Admin New',
                      'menu_title'  => 'New Video', 
                      'capability'  => 'manage_options', 
                      'menu_slug'   => 'post-new.php?post_type=video_help', 
                      'callback'    => '',
                ),
                array(
                      'parent_slug'  => 'customviewvideo', 
                      'page_title'  => 'Settings',
                      'menu_title'  => 'Settings', 
                      'capability'  => 'manage_options', 
                      'menu_slug'   => 'video-settings', 
                      'callback'    => array( $this, 'custom_video_settings_callback'),
                )
        );
    }


    public function customvideoviewrenderfunc(){
            $this->args_for_list_pages = array (
                'post_type' => 'video_help',
                'title_li' => '',
                'walker' => new VideoHelpCustomPage(),
                'link_after' => '<i class="far fa-play-circle"></i>'
            );  
        ?>
        
        <div class="custom_toc_and_video_container">
            <h1 class="wp-heading-inline">Table of Contents</h1>
            <div class="custom_half_chapter">
                <div class="custom_video_help_container">
                    <?php  var_dump( wp_list_pages( $this->args_for_list_pages ) ); ?>
                    <ul>
                        <?php echo wp_list_pages( $this->args_for_list_pages ); ?>
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


    public function custom_video_settings_callback()
    {
        return require_once ( $this->plugin_path . 'templates/settings.php');
    }


    public function register()
    {
        $this->settings = new AdminApi();

        $this->setPages();

        $ajax = new AjaxRequest();
        $ajax->register();

        $this->settings->addPages( $this->pages )->withSubPage('Dashboard')->addSubPages( $this->subpages )->register();

    }





}