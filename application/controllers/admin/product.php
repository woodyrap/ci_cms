<?php

class Product extends Admin_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('product_m');        
                
    }

    public function index() {
        //Fetch all product
        $this->data['products'] = $this->product_m->get_with_categories();                
        
        //Load view
        $this->data['subview'] = 'admin/product/index';
        $this->load->view('admin/_layout_main', $this->data);
    }

    public function edit($id = NULL) {
        //Load enum fields
        $this->data['enums_status'] = field_enums('products', 'status');       
        $this->data['enums_featured'] = field_enums('products', 'featured');       
        $this->data['enums_other_feature'] = field_enums('products', 'other_feature');       
                
        //Fetch a product or set a new product
        if ($id) {
            $this->data['product'] = $this->product_m->get($id);
            count($this->data['product']) || $this->data['errors'][] = $this->lang->line('msg_product_could_not_be_found');
        } else {
            $this->data['product'] = $this->product_m->get_new();
        }                 
        
        //Categories for dropdown
        $this->data['categories']=$this->product_m->get_categories();    

        //Set up the form
        $rules = $this->product_m->rules;
        $this->form_validation->set_rules($rules);
        
        //Process the form
        if ($this->form_validation->run() == TRUE) {
            $data = $this->product_m->array_from_post(array('name', 'shortdesc', 'longdesc', 'thumbnail', 'image', 'product_order', 'class', 'grouping', 'status', 'category_id', 'featured', 'other_feature', 'price'));
            $this->product_m->save($data, $id);
            redirect('admin/product');
        }
        
        //Load the view
        $this->data['subview'] = 'admin/product/edit';
        $this->load->view('admin/_layout_main', $this->data);
    }
    
    public function delete($id) {
        $this->product_m->delete($id);
        redirect('admin/product');
    }    
    
}

