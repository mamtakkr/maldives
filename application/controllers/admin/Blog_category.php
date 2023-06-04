<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Blog_category extends CI_Controller {
    public function __construct() {
        parent::__construct();
        clear_cache();
        if (!superadmin_logged_in()) {
            redirect(ADMIN_URL.'login');
        }
    }
    /*user list with filters*/
    function index() {
        $data = array();
        $config = admin_pagination();
        $config['enable_query_strings'] = TRUE;
        if (!empty($_SERVER['QUERY_STRING'])) {
            $config['suffix'] = "?" . $_SERVER['QUERY_STRING'];
        } else {
            $config['suffix'] = '';
        }
        $config['base_url']         = ADMIN_URL."Blog_category/index/";
        $counts                     = $this->developer_model->get_blog_category(0, 0);
        $config['total_rows']       = $counts;
        $config['per_page']         = PER_PAGE;
        $config['uri_segment']      = 4;
        $config['use_page_numbers'] = TRUE;
        $config['first_url']        = $config['base_url'] . $config['suffix'];
        $pageNo                     = $this->uri->segment(4);
        $this->pagination->initialize($config);
        $offSet = 0;
        if ($pageNo) {
            $offSet = $config['per_page'] * ($pageNo - 1);
        }
        $data['pagination'] = $this->pagination->create_links();
        $data['rows']       = $this->developer_model->get_blog_category($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/blog_category/blog_category';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_blog_category($blog_cat_id =''){ 
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('blog_cat_name', 'blog category', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('blog_cat_name')) 
                    $insertData['blog_cat_name'] = $this->input->post('blog_cat_name'); 
                if(!empty($blog_cat_id)){
                    $this->common_model->update('blog_category', $insertData, array('blog_cat_id' => $blog_cat_id));
                    $this->session->set_flashdata('msg_success', 'blog category is updated successfully');
                    redirect(ADMIN_URL.'Blog_category');
                }else{
                    $this->common_model->insert('blog_category', $insertData);
                    $this->session->set_flashdata('msg_success', 'blog category is added successfully');
                    redirect(ADMIN_URL.'blog_category/add_blog_category');
                }
            }
        }
        $data['title'] = 'Add blog category';
        if (!empty($blog_cat_id)) {
            $data['title'] = 'Edit blog category';
            $data['row']   = $this->common_model->get_row('blog_category', array('blog_cat_id' => $blog_cat_id));
        }
        $data['template'] = 'superadmin/blog_category/add_blog_category';
        $this->load->view('templates/superadmin_template', $data);
    }
}
