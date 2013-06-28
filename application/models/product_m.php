<?php

class Product_m extends MY_Model {

    protected $_table_name = 'products';
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
        'thumbnail' => array(
            'field' => 'thumbnail',
            'label' => 'Thumbnail',
            'rules' => 'trim|required'
        ),
        'image' => array(
            'field' => 'image',
            'label' => 'Image',
            'rules' => 'trim|required'
        ),
        'product_order' => array(
            'field' => 'product_order',
            'label' => 'Product Order',
            'rules' => 'trim|required'
        ),
        'class' => array(
            'field' => 'class',
            'label' => 'Class',
            'rules' => 'trim|required'
        ),
        'grouping' => array(
            'field' => 'grouping',
            'label' => 'Grouping',
            'rules' => 'trim|required'
        ),
        'price' => array(
            'field' => 'price',
            'label' => 'Price',
            'rules' => 'required'
        ),
    );

    public function get_new() {
        $product = new stdClass();
        $product->name = '';
        $product->shortdesc = '';
        $product->longdesc = '';
        $product->thumbnail = '';
        $product->image = '';
        $product->product_order = '';
        $product->class = '';
        $product->grouping = '';
        $product->status = 'active';
        $product->category_id = '';
        $product->featured = '';
        $product->other_feature = '';
        $product->price = 0;
        return $product;
    }

    public function get_with_categories($id = NULL, $single = FALSE) {
        $this->db->select('products.*, p.name as category_name');
        $this->db->join('categories as p', 'products.category_id = p.id', 'left');
        return parent::get($id, $single);
    }

    public function get_categories() {
        $this->load->model('category_m');

        //Fetch pages without categories
        $this->db->select('id, name');
        $this->db->order_by('name');

        $categories = $this->category_m->get();

        //Return key => value pair array
        $array = array(0 => 'No category');
        if (count($categories)) {
            foreach ($categories as $category) {
                $array[$category->id] = $category->name;
            }
        }
        return $array;
    }

    function getAllsubcatByCat() {
        $data = array();
        // get category details
        $query = $this->db->get('categories');

        foreach ($query->result_array() as $row) {
            if ($row['parent_id'] == 0) {
                // for each category get product details
                $category_id = $row['id'];   // this returns 3, 4, 5
                $category = $row;
                $data[] = $category;
                //  $query= $this->db->query("SELECT id, name FROM omc_product WHERE status='active' AND category_id='$category_id'");
                $this->db->where('parent_id', $category_id);
                $this->db->where('status', 'active');
                $query = $this->db->get('categories');
                foreach ($query->result_array() as $categories) {
                    $data[] = $categories;
                }
                // $data[]=$category_id;
            }
        }
        $query->free_result();
        return $data;
    }

    function getProductsByCategory($catid) {
        // this is used in function cat($id) in the shop frontend
        // When a product is clicked this will be used.
        // If not $cat['parentid'] < 1
        // $catid is given in URI, the third element
        $data = array();
        $this->db->where('category_id', $catid);
        $this->db->where('status', 'active');
        $this->db->order_by('name', 'asc');
        $Q = $this->db->get($this->product_m->_table_name);
        if ($Q->num_rows() > 0) {
            foreach ($Q->result_array() as $row) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }

}