<?php
class Dashboard extends Admin_Controller {

    function __construct() {
        parent::__construct();
    }

    function index() {
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    function modal() {
        $this->load->view('admin/_layout_modal', $this->data);
    }
}
