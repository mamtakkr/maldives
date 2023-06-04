<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Brands extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."brands/index/";
        $counts                     = $this->developer_model->getBrands(0, 0);
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
        $data['rows']       = $this->developer_model->getBrands($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/brands/brands';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function addBrand($id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('brand_name', 'brand name', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('brand_name')) 
                    $insertData['brand_name'] = $this->input->post('brand_name'); 
                if(!empty($id)){
                    $this->common_model->update('brand', $insertData, array('id' => $id));
                    $this->session->set_flashdata('msg_success', 'Brand is updated successfully');
                    redirect(ADMIN_URL.'brands');
                }else{
                    $this->common_model->insert('brand', $insertData);
                    $this->session->set_flashdata('msg_success', 'Brand is added successfully');
                    redirect(ADMIN_URL.'brands/addBrand');
                }
            }
        }
        $data['title'] = 'Add Brand';
        if (!empty($id)) {
            $data['title'] = 'Edit Brand';
            $data['row']   = $this->common_model->get_row('brand', array('id' => $id));
        }
        $data['template'] = 'superadmin/brands/addBrand';
        $this->load->view('templates/superadmin_template', $data);
    }
}
