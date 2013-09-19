<?php

class Admin_Controller extends MY_Controller {

    function __construct() {
        parent::__construct();
        $this->data['meta_title'] = 'My Awesome CMS';
        $this->load->helper('form');
        $this->load->library('form_validation');
        $this->load->library('session');
        $this->load->model('user_m');
        
        // Load data
        $this->data['meta_title']=config_item('site_name');
        $this->data['web_master']=config_item('webmaster_email');
        $this->data['portfolio']=config_item('portfolio');

        //Login check
        $exception_uris = array(
            'admin/user/login',
            'admin/user_logout'
        );
        if (in_array(uri_string(), $exception_uris) == FALSE) {
            if ($this->user_m->loggedin() == FALSE) {
                redirect('admin/user/login');
            }
        }
    }

    public function language() {
        $lang = $this->input->get('lang');
        $uri = $this->input->get('uri');

        if ($lang == 'english' || $lang == 'spanish') {
            $this->session->set_userdata('language', $lang);
            redirect($uri);
        } else {
            redirect('/');
        }
    }

}
