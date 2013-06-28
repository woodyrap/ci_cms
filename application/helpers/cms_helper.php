<?php

defined('BASEPATH') OR exit('No direct script access allowed');

function add_meta_title($string) {
    $CI = & get_instance();
    $CI->data['meta_title'] = e($string) . ' - ' . $CI->data['meta_title'];
}

function btn_edit($uri) {
    return anchor($uri, '<i class="icon-edit"></i>');
}

function btn_delete($uri) {
    return anchor($uri, '<i class="icon-remove"></i>', array(
                'onclick' => "return confirm('You are about to delete a record. This cannot be undone. Are you sure?');"
            ));
}

function article_link($article) {
    return 'article/' . intval($article->id) . '/' . e($article->slug);
}

function article_links($articles) {
    $string = '<ul>';
    foreach ($articles as $article) {
        $url = article_link($article);
        $string .= '<li>';
        $string .= '<h3>' . anchor($url, e($article->title)) . ' ›</h3>';
        $string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
        $string .= '</li>';
    }
    $string .= '</ul>';
    return $string;
}

function get_excerpt($article, $numwords = 50) {
    $string = '';
    $url = article_link($article);
    $string .= '<h2>' . anchor($url, e($article->title)) . '</h2>';
    $string .= '<p class="pubdate">' . e($article->pubdate) . '</p>';
    $string .= '<p>' . e(limit_to_numwords(strip_tags($article->body), $numwords)) . '</p>';
    $string .= '<p>' . anchor($url, 'Read more ›', array('title' => e($article->title))) . '</p>';
    return $string;
}

function limit_to_numwords($string, $numwords) {
    $excerpt = explode(' ', $string, $numwords + 1);
    if (count($excerpt) >= $numwords) {
        array_pop($excerpt);
    }
    $excerpt = implode(' ', $excerpt);
    return $excerpt;
}

function e($string) {
    return htmlentities($string);
}

function get_menu($array, $child = FALSE) {
    $CI = & get_instance();
    $str = '';

    if (count($array)) {
        $str .= $child == FALSE ? '<ul class="nav">' . PHP_EOL : '<ul class="dropdown-menu">' . PHP_EOL;

        foreach ($array as $item) {

            $active = $CI->uri->segment(1) == $item['slug'] ? TRUE : FALSE;
            if (isset($item['children']) && count($item['children'])) {
                $str .= $active ? '<li class="dropdown active">' : '<li class="dropdown">';
                $str .= '<a  class="dropdown-toggle" data-toggle="dropdown" href="' . site_url(e($item['slug'])) . '">' . e($item['title']);
                $str .= '<b class="caret"></b></a>' . PHP_EOL;
                $str .= get_menu($item['children'], TRUE);
            } else {
                $str .= $active ? '<li class="active">' : '<li>';
                $str .= '<a href="' . site_url($item['slug']) . '">' . e($item['title']) . '</a>';
            }
            $str .= '</li>' . PHP_EOL;
        }

        $str .= '</ul>' . PHP_EOL;
    }

    return $str;
}

function get_carousel_indicator($array, $target) {   
    $str = '<ol class="carousel-indicators">' . PHP_EOL;

    if (count($array)) {
        $str .= '';
        
        $cnt = 0;
        foreach ($array as $item) {            
            if (($cnt == 0 )){                
                $active = TRUE;
                $str .= '<li data-target="#' . $target . '" data-slide-to="' . $cnt . '" class="active"></li>'. PHP_EOL;
            }else{
                $active = FALSE;
                $str .= '<li data-target="#' . $target . '" data-slide-to="' . $cnt . '"></li>'. PHP_EOL;
            }
            $cnt = $cnt + 1;
        }

        $str .= '</ol><!-- End of carousel-indicators -->' . PHP_EOL;
    }

    return $str;
}

function get_carousel_slide($array) {   
    $str = '';

    if (count($array)) {
        $str .= '<div class="carousel-inner">' . PHP_EOL;
        
        $cnt = 0;
        foreach ($array as $item) {            
            if (($cnt == 0 )){                
                $active = TRUE;
                $str .= '<div class="active item" style="text-align:center;" data-slide-number="' . $cnt .'">' . $item['image'] . '</div>'. PHP_EOL;
            }else{
                $active = FALSE;
                $str .= '<div class="item" style="text-align:center;" data-slide-number="' . $cnt .'">' . $item['image'] . '</div>'. PHP_EOL;
            }
            $cnt = $cnt + 1;
        }

        $str .= '</div><!-- End of carousel-inner -->' . PHP_EOL;
    }

    return $str;
}

function get_carousel_text($array) {   
    $str = '';

    if (count($array)) {
        $str .= '<div style="display: none;" id="slide-content">' . PHP_EOL;
        $cnt = 0;
        foreach ($array as $item) {   
            $slide_number = 'slide-content-' . $cnt;
            $str .= '<div id="' . $slide_number . '">' . PHP_EOL;
            $str .= '<h4>' . $item['name'] . '</h4>' . PHP_EOL;
            $str .= '<p>' . $item['shortdesc'] . '</p>' . PHP_EOL;
            $str .= '<a data-toggle="modal" class="btn" href="#modal-' . $slide_number .'">View More...' . '</a>' . PHP_EOL;
            $str .= '</div><!--slide-content-# -->' . PHP_EOL;
            
            //Modal Data
            $str .= '<div class="modal hide fade" tabindex="-1" role="dialog" id="modal-' . $slide_number . '"><!-modal-slide-content-# -->' . PHP_EOL;            
            $str .= '<div class="modal-header">' . PHP_EOL;
            $str .= '<button type="button" class="close" data-dismiss="modal">✕</button>' . PHP_EOL;
            $str .= '<h3>' . $item['name'] . '</h3>' . PHP_EOL;
            $str .= '</div><!-- end-modal-header -->' . PHP_EOL;
            
            $str .= '<div class="modal-body" style="text-align:center;"><!-- modal-body -->' . PHP_EOL;
            $str .= $item['longdesc'] . PHP_EOL;
            $str .= '</div><!-- end-modal-body -->' . PHP_EOL;
            $str .= '</div><!-- end-modal-slide-content-# -->' . PHP_EOL;
                        
            $cnt = $cnt + 1;
        }

        $str .= '</div><!-- End of slide-content -->' . PHP_EOL;
    }

    return $str;
}
/**
 * Dump helper. Functions to dump variables to the screen, in a nicley formatted manner.
 * @author Joost van Veen
 * @version 1.0
 */
if (!function_exists('dump')) {

    function dump($var, $label = 'Dump', $echo = TRUE) {
        // Store dump in variable 
        ob_start();
        var_dump($var);
        $output = ob_get_clean();

        // Add formatting
        $output = preg_replace("/\]\=\>\n(\s+)/m", "] => ", $output);
        $output = '<pre style="background: #FFFEEF; color: #000; border: 1px dotted #000; padding: 10px; margin: 10px 0; text-align: left;">' . $label . ' => ' . $output . '</pre>';

        // Output
        if ($echo == TRUE) {
            echo $output;
        } else {
            return $output;
        }
    }

}


if (!function_exists('dump_exit')) {

    function dump_exit($var, $label = 'Dump', $echo = TRUE) {
        dump($var, $label, $echo);
        exit;
    }

}
// Function taked of Robert Mullaney's Blog.
if ( ! function_exists('field_enums'))
{
    function field_enums($table = '', $field = '')
    {
        $enums = array();
        if ($table == '' || $field == '') return $enums;
        $CI =& get_instance();
        preg_match_all("/'(.*?)'/", $CI->db->query("SHOW COLUMNS FROM {$table} LIKE '{$field}'")->row()->Type, $matches);
        foreach ($matches[1] as $key => $value) {
            $enums[$value] = $value; 
        }
        return $enums;
    }  
}
