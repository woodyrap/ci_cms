<?php

class Frontend_Controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        //Load helpers and libraries
        $this->load->helper('form');
        
        //Load stuff
        $this->load->model('page_m');
        $this->load->model('article_m');
        //TODO Remove all article model loads
        
        //Fetch navigation
        $this->data['menu']=$this->page_m->get_nested();
        $this->data['news_archive_link']=$this->page_m->get_archive_link();
        $this->data['meta_title']=config_item('site_name');
        $this->data['web_master']=config_item('webmaster_email');
        $this->data['url_google_maps']=config_item('url_google_maps');
    }

}
