<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Villa_types extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."Villa_types/index/";
        $counts                     = $this->developer_model->get_villa_types(0, 0);
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
        $data['rows']       = $this->developer_model->get_villa_types($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/villa_types/villa_types';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_villa_type($id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('villa_type', 'villa type', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('villa_type')) 
                    $insertData['villa_type'] = $this->input->post('villa_type'); 
                if(!empty($id)){
                    $this->common_model->update('villa_type', $insertData, array('id' => $id));
                    $this->session->set_flashdata('msg_success', 'Villa type is updated successfully');
                    redirect(ADMIN_URL.'villa_types');
                }else{
                    $this->common_model->insert('villa_type', $insertData);
                    $this->session->set_flashdata('msg_success', 'Villa type is added successfully');
                    redirect(ADMIN_URL.'villa_types/add_villa_type');
                }
            }
        }
        $data['title'] = 'Add Villa Type';
        if (!empty($id)) {
            $data['title'] = 'Edit Villa Type';
            $data['row']   = $this->common_model->get_row('villa_type', array('id' => $id));
        }
        $data['template'] = 'superadmin/villa_types/add_villa_type';
        $this->load->view('templates/superadmin_template', $data);
    }
}
