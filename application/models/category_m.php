<?php

class Category_m extends MY_Model {

    protected $_table_name = 'categories';
    protected $_order_by = 'id';
    protected $_timestamps = FALSE;
    
    public $rules = array(
        'name' => array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required|max_length[100]|xss_clean'
        ),
        'shortdesc' => array(
            'field' => 'shortdesc',
            'label' => 'Short description',
            'rules' => 'trim|required|max_length[255]|xss_clean'
        ),
        'longdesc' => array(
            'field' => 'longdesc',
            'label' => 'Long description',
            'rules' => 'trim|required'
        ),
        'image' => array(
            'field' => 'image',
            'label' => 'Image',
            'rules' => 'trim|required'
        ),
    );

    public function get_new() {
        $category = new stdClass();
        $category->name = '';
        $category->shortdesc = '';
        $category->longdesc = '';
        $category->image = '';
        $category->status = 'active';
        $category->parent_id = 0;
        return $category;
    }        
    
    public function get_with_parent($id = NULL, $single = FALSE) {
        $this->db->select('categories.*, p.name as parent_name');
        $this->db->join('categories as p', 'categories.parent_id = p.id', 'left');
        return parent::get($id, $single);
    }

    public function get_no_parents() {
        //Fetch pages without parents
        $this->db->select('id, name');
        $this->db->where('parent_id', 0);
        $categories = parent::get();
        //Return key => value pair array
        $array = array(0 => 'No parent');
        if (count($categories)) {
            foreach ($categories as $category) {
                $array[$category->id] = $category->name;
            }
        }
        return $array;
    }
}