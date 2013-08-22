<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Search extends Frontend_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('page_m');
        $this->load->model('product_m');
        $this->load->library('Jquery_pagination'); //-->Jquery_pagination
    }

    public function index($offset = 0) {
        //Fetch the page template
        $this->data['page'] = $this->page_m->get_by(array('slug' => 'portfolio'), TRUE);

        //Initialize searched         
        if ($this->session->userdata('searched')) {
            $this->session->set_userdata('searched', NULL);
        }
        $searcher = $this->input->post('inputsearchform');
        if ($searcher) {
            $this->session->set_userdata('searched', $searcher);
        }

        $this->data['search'] = true;

        //Make html output
        ob_start();
        $this->pagination_ajax(0);
        $initial_content = ob_get_contents();
        ob_end_clean();

        //Show table with $initial_content        
        $this->data['table'] = "<div id='pagination'>" . $initial_content . "</div>";

        //Load the view
        $this->data['subview'] = $this->data['page']->template;
        $this->load->view('_main_layout', $this->data);
    }

    public function pagination_ajax($offset = 0) {
        //Set up variable
        if ($this->session->userdata('searched')) {
            $searcher = $this->session->userdata('searched');
        } else {
            $searcher = null;
        }

        $pages = 2; //Item by pages
        //Count all data
        $this->db->start_cache();
        $this->product_m->getSearch($searcher); // Like about $search.            
        $this->db->stop_cache();
        $count = $this->db->count_all_results();
        //Set up pagination
        //Configuration library jquery_pagination
        $config['base_url'] = base_url('search/pagination_ajax/');

        $config['div'] = '#pagination'; //assign an id to the overall container

        $config['anchor_class'] = 'page_link'; //assign a class to the link for layout

        $config['show_count'] = true; //view a label show_count with true      

        $config['total_rows'] = ($searcher) ? $count : 0; //count number of rows

        $config['per_page'] = $pages; //-->number of rows by page

        $config['num_links'] = 10; //-->number of links visibles

        $config['first_link'] = '&lsaquo; First'; //->config
        $config['next_link'] = '&gt;'; //-------------->links
        $config['prev_link'] = '&lt;'; //-------------->before
        $config['last_link'] = 'Last &rsaquo;'; //--->and next
        //inicializamos la librería
        $this->jquery_pagination->initialize($config);

        //cargamos la paginación con los links        
        if ($searcher) {
            $this->db->limit($pages, $offset);
            $html = generate_table($this->product_m->getSearch($searcher)) .
                    $this->jquery_pagination->create_links();
        } else {
            $html = '<h1>' . $this->lang->line('index_we_could_not_find_any_products') . '</h1>';
        }
        echo $html;
    }

    function get_product_ajax() {
        $data = array();
        $id = $this->input->post('id_product');

        if ($id == null) {
            return false;
        } else {
            $product = $this->product_m->get_by(array('id' => $id), TRUE);            
            $data['title']   = $product->name;
            $data['subview'] = $product->longdesc;
            $this->load->view('admin/product/modal', $data);
        }
    }

}

?>
