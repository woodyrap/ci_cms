<?php
class Page extends Frontend_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('page_m');
        }
    public function index() {
        $this->load->view('_main_layout', $this->data);
    }
    public function save() {
        $data = array(
                'order' => '4'
                );
        $id=$this->page_m->save($data, 3);
        var_dump($id);
    }
     public function delete() {
        $this->page_m->delete(3);
    }
}