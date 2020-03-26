<?php

namespace Inc\Api;


class VideoHelpCustomPage
{
    public function start_el(&$output, $page, $depth = 0, $args = array(), $current_page = 0) {

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