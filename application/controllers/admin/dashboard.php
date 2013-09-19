<?php
class Dashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        //Fetch recently modified articles
        $this->load->model('article_m');
        $this->db->order_by('modified desc');
        $this->db->limit(5);
        $this->data['recent_articles']=$this->article_m->get();
        
        $this->data['subview'] = 'admin/dashboard/index';
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    function modal() {
        $this->load->view('admin/_layout_modal', $this->data);
    }
}
