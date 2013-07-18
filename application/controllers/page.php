<?php

class Page extends Frontend_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('page_m');
        $this->load->model('product_m');
    }

    public function index() {
        //Fetch the page template
        $this->data['page'] = $this->page_m->get_by(array('slug' => (string) $this->uri->segment(1)), TRUE);
        count($this->data['page']) || show_404(current_url());

        add_meta_title($this->data['page']->title);

        //Fetch the page data
        $method = '_' . $this->data['page']->template;
        if (method_exists($this, $method)) {
            $this->$method();
        } else {
            log_message('error', 'Could not load template ' . $method . ' in file ' . __FILE__ . ' at line ' . __LINE__);
            show_error('Could not load template' . $method);
        }


        //Load the view
        $this->data['subview'] = $this->data['page']->template;
        $this->load->view('_main_layout', $this->data);
    }

    private function _page() {
        $this->data['recent_news'] = $this->article_m->get_recent();
    }

    private function _homepage() {
        $this->article_m->set_published();
        $this->db->limit(6);
        $this->data['articles'] = $this->article_m->get();
    }

    private function _news_archive() {
        $this->data['recent_news'] = $this->article_m->get_recent();
        //Count all articles
        $this->article_m->set_published();
        $count = $this->db->count_all_results('articles');

        //Set up pagination
        $perpage = 4;
        if ($count > $perpage) {
            $this->load->library('pagination');
            $config['base_url'] = site_url($this->uri->segment(1) . '/');
            $config['total_rows'] = $count;
            $config['per_page'] = $perpage;
            $config['uri_segment'] = 2;
            $this->pagination->initialize($config);
            $this->data['pagination'] = $this->pagination->create_links();
            $offset = $this->uri->segment(2);
        } else {
            $this->data['pagination'] = '';
            $offset = 0;
        }
        //Fetch articles        
        $this->article_m->set_published();
        $this->db->limit($perpage, $offset);
        $this->data['articles'] = $this->article_m->get();
    }

    private function _portfolio() {
        $this->data['listing'] = $this->product_m->getAllsubcatByCat();
    }

    function products_by_category($id) {
        //Fetch the page template
        $this->data['page'] = $this->page_m->get_by(array('template' => 'portfolio'), TRUE);

        $product = $this->product_m->getProductsByCategory($id);
        /** this returns all, i.e. id, name, shortdesc, longdesc, thumbnail,
         * image, grouping, status, category_id, featured and price
         * from product db.
         */
        if (!count($product)) {
            // no product so redirect
            redirect('Portfolio');
        }
        $this->data['products'] = $product;
        add_meta_title($this->data['page']->title);

        //Load the view
        $this->data['subview'] = '../admin/product/product';
        $this->load->view('_main_layout', $this->data);
    }

    function get_list_view() {
        $data = array();
        $type = $this->input->post('type');

        if ($type == null) {
            $data['list'] = $this->product_m->getProductsByCategory($id); // $Id is of Categories.
            $this->load->view('list', $data);
        } else {
            $product = $this->product_m->get_by(array('id' => $type), TRUE);
            //dump($product->longdesc);
            $data['title']   = $product->name;
            $data['subview'] = $product->longdesc;
            $this->load->view('admin/product/modal', $data);
        }
    }

    function view_modal() {

        $id = 1;

        $product = $this->product_m->get_by(array('id' => $id), TRUE);
        /** this returns all, i.e. id, name, shortdesc, longdesc, thumbnail,
         * image, grouping, status, category_id, featured and price
         * from product db.
         */
        if (!count($product)) {
            // no product so redirect
            redirect('Portfolio');
        } else {
            $this->data['title'] = $product->name;
            $this->data['subview'] = $product->longdesc;
        }
        //Load the view
//        $this->load->view('_layout_modal', $this->data);
    }

}