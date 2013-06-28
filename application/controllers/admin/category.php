<?php

class Category extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('category_m');
    }

    public function index() {
        //Fetch all category
        $this->data['categories'] = $this->category_m->get_with_parent();
        
        //Load view
        $this->data['subview'] = 'admin/category/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL) {
        //Load enum fields
        $this->data['enums_status'] = field_enums('categories', 'status');       
                
        //Fetch a category or set a new category
        if ($id) {
            $this->data['category'] = $this->category_m->get($id);
            count($this->data['category']) || $this->data['errors'][] = $this->lang->line('msg_user_could_not_be_found');
        } else {
            $this->data['category'] = $this->category_m->get_new();
        }                 
        
        //Categories for dropdown
        $this->data['categories_no_parents']=$this->category_m->get_no_parents();    

        //Set up the form
        $rules = $this->category_m->rules;
        $this->form_validation->set_rules($rules);
        
        //Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->category_m->array_from_post(array('name', 'shortdesc', 'longdesc', 'status', 'parent_id'));
            $this->category_m->save($data, $id);
            redirect('admin/category');
        }
        
        //Load the view
        $this->data['subview'] = 'admin/category/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    public function delete($id) {
        $this->category_m->delete($id);
        redirect('admin/category');
    }    
    
}

