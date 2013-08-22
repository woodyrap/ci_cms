<?php

class Page extends Frontend_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('page_m');
        $this->load->model('product_m');
        $this->uripag = null;
    }

    public function index() {
        //Fetch the page template
        $this->data['page'] = $this->page_m->get_by(array('slug' => (string) $this->uri->segment(1)), TRUE);
        count($this->data['page']) || show_404(current_url());
        
        if ($this->data['page']->template == 'portfolio'){
            $this->uripag = $this->uri->segment(2);
        }

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

    private function _contact() {
        $this->data['recent_news'] = $this->article_m->get_recent();
    }

    private function _portfolio() {
        $this->data['search'] = false;
        $ajax   = $this->input->get('ajax');
        $search = $this->input->get('inputsearchform');
            
        if (($ajax) || ($this->uripag > 0)) {
            $this->get_list_products($ajax, $search);
        }else {
            $this->data['listing'] = $this->product_m->getAllsubcatByCat();
        }
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
            //redirect($this->uri->uri_string()); // Refresh current page
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
            $this->data['list'] = $this->product_m->getProductsByCategory($id); // $Id is of Categories.
            $this->data['search'] = false;
            $this->load->view('list', $this->data);
        } else {
            $product = $this->product_m->get_by(array('id' => $type), TRUE);
            //dump($product->longdesc);
            $data['title'] = $product->name;
            $data['subview'] = $product->longdesc;
            $this->load->view('admin/product/modal', $data);
        }
    }

    function view_modal() {

        $id = 1;

        $product = $this->product_m->get_by(array('id' => $id), TRUE);

        if (!count($product)) {
            // no product so redirect
            redirect('Portfolio');
        } else {
            $this->data['title'] = $product->name;
            $this->data['subview'] = $product->longdesc;
        }
    }

    function send_email($data) {
        //Create a new PHPMailer instance
        $email = new My_phpmailer();
        //Tell PHPMailer to use SMTP
        $email->IsSMTP();
        //Enable SMTP debugging
        // 0 = off (for production use)
        // 1 = client messages
        // 2 = client and server messages
        $email->SMTPDebug = 0;
        //Ask for HTML-friendly debug output
        $email->Debugoutput = config_item('mserver_mailtype');
        //Set the hostname of the mail server
        $email->Host = config_item('mserver_smtphost');
        //Set the SMTP port number - 587 for authenticated TLS, a.k.a. RFC4409 SMTP submission
        $email->Port = config_item('mserver_smtpport');
        //Set the encryption system to use - ssl (deprecated) or tls
        $email->SMTPSecure = config_item('mserver_smtpsecure');
        //Whether to use SMTP authentication
        $email->SMTPAuth = true;
        //Username to use for SMTP authentication - use full email address for gmail
        $email->Username = config_item('mserver_smtpuser');
        //Password to use for SMTP authentication
        $email->Password = config_item('mserver_smtppass');

        //Set who the message is to be sent from
        $email->SetFrom(config_item('mserver_smtpuser'), 'Servicio Al Cliente');
        //Set who the message is to be sent to
        if ($data['inputemail'] == '') {
            return NULL;
        }
        $email->AddAddress($data['inputemail'], $data['fullname']);
        //Set the subject line
        $email->Subject = ($data['inputsubject']);
        //Read an HTML message body from an external file, convert referenced images to embedded, convert HTML into a basic plain-text alternative body
        $email->MsgHTML($data['inputmessage']);
        //Attach an image file
        //$email->AddAttachment('images/phpmailer_mini.gif');
        //Send the message, check for errors
        $msg = 'You email was send.';
        if (!$email->Send()) {
            $this->data['out_send_email'] = $email->ErrorInfo;
        } else {
            $this->data['out_send_email'] = $msg;
        }

        return $this->data['out_send_email'];
    }

    function submit_email() {
        $data = array('fullname' => $this->input->get('fullname'),
            'inputemail' => $this->input->get('inputemail'),
            'inputsubject' => $this->input->get('inputsubject'),
            'inputmessage' => $this->input->get('inputmessage'),
        );

        $this->data['out'] = $this->send_email($data);
        $this->data['home'] = anchor(site_url(), "Back to Home");

        //Load the view
        $this->data['subview'] = 'contact_submitted';
        if ($this->input->get('ajax')) {
            $this->load->view($this->data['subview'], $this->data);
        } else {
            $this->load->view('_main_layout', $this->data);
        }
    }

    function get_list_products($ajax, $search) {
        //Fetch the page template
        $this->data['page'] = $this->page_m->get_by(array('slug' => 'portfolio'), TRUE);        

        if (($ajax) || ($this->uripag > 0)) {
            //Count all data
            $this->db->start_cache();
            $this->product_m->getSearch($search); // Like about $search.            
            $this->db->stop_cache();
            $count = $this->db->count_all_results();
            //Set up pagination
            $perpage = 2;
            if ($count > $perpage) {
                $this->load->library('pagination');                
                $config['base_url'] = base_url() . 'portfolio';
                $config['total_rows'] = $count;
                $config['per_page'] = $perpage;
                $config['uri_segment'] = 2;
                $this->pagination->initialize($config);
                $this->data['pagination'] = $this->pagination->create_links();                
                $offset = ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
            } else {
                $this->data['pagination'] = '';
                $offset = 0;
            }
            $this->db->limit($perpage, $offset);
            $this->data['listing'] = $this->product_m->getSearch($search); // Like about $search.            
        } else {
            $this->data['listing'] = $this->product_m->get(NULL, TRUE); // Show all data.
        }
        $this->data['search'] = true;        
    }

}