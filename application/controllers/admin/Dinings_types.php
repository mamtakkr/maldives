<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Dinings_types extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."dinings_types/index/";
        $counts                     = $this->developer_model->get_dinnings_types(0, 0);
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
        $data['rows']       = $this->developer_model->get_dinnings_types($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/dinnings_types/dinnings_types';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_dinings_type($id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('dinnings_type', 'dinnings type', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('dinnings_type')) 
                    $insertData['dinnings_type'] = $this->input->post('dinnings_type'); 
                if(!empty($id)){
                    $this->common_model->update('dinnings_type', $insertData, array('id' => $id));
                    $this->session->set_flashdata('msg_success', 'dinnings type is updated successfully');
                    redirect(ADMIN_URL.'dinings_types');
                }else{
                    $this->common_model->insert('dinnings_type', $insertData);
                    $this->session->set_flashdata('msg_success', 'dinnings type is added successfully');
                    redirect(ADMIN_URL.'dinings_types/add_dinings_type');
                }
            }
        }
        $data['title'] = 'Add Dining Type';
        if (!empty($id)) {
            $data['title'] = 'Edit Dining Type';
            $data['row']   = $this->common_model->get_row('dinnings_type', array('id' => $id));
        }
        $data['template'] = 'superadmin/dinnings_types/add_dinnings_type';
        $this->load->view('templates/superadmin_template', $data);
    }
}
