<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Categorys extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."categorys/index/";
        $counts                     = $this->developer_model->get_resort_category(0, 0);
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
        $data['rows']       = $this->developer_model->get_resort_category($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/categorys/categorys';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_category($id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('category_name', 'category name', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('category_name')) {
                    $insertData['category_name'] = $this->input->post('category_name'); 
                }
                if ($this->input->post('no_of_star')) {
                    $insertData['no_of_star'] = $this->input->post('no_of_star'); 
                }
                if(!empty($id)){
                    $this->common_model->update('category', $insertData, array('id' => $id));
                    $this->session->set_flashdata('msg_success', 'category is updated successfully');
                    redirect(ADMIN_URL.'categorys');
                }else{
                    $this->common_model->insert('category', $insertData);
                    $this->session->set_flashdata('msg_success', 'category is added successfully');
                    redirect(ADMIN_URL.'categorys/add_category');
                }
            }
        }
        $data['title'] = 'Add Category';
        if (!empty($id)) {
            $data['title'] = 'Edit Category';
            $data['row']   = $this->common_model->get_row('category', array('id' => $id));
        }
        $data['template'] = 'superadmin/categorys/add_category';
        $this->load->view('templates/superadmin_template', $data);
    }
}
