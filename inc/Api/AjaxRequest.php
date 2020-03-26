<?php

namespace Inc\Api;

class AjaxRequest
{
    public $array_to_return = array();

    public function register() {
 
        add_action(
            'wp_ajax_nopriv_getvideocontent',
            array( $this, 'getvideohelpcontent_func' )
        );
     
        add_action(
            'wp_ajax_getvideocontent',
            array( $this, 'getvideohelpcontent_func' )
        );
     
    }


    public function getvideohelpcontent_func() {
        //sleep(300);
        
        $post = get_post($_POST['pageid']); 
        $postcontent = get_post_meta($post->ID,'videodescription',true);
        
        //print_r($post);
        
        $title = apply_filters('the_title', $post->post_title); 
        $content = apply_filters('the_content', $postcontent); 
        
        $videourl= get_post_meta($post->ID , 'videourl', true);
        
        
        $this->array_to_return = array(
            'title'         => $title,
            'videoembed'    => ( $videourl ? wp_oembed_get($videourl) : '' ),
            'content'       => $content
        );
        
        wp_send_json ( $this->array_to_return  );

    }
}