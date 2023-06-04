<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Atolls extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."Atolls/index/";
        $counts                     = $this->developer_model->getAtolls(0, 0);
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
        $data['rows']       = $this->developer_model->getAtolls($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/Atolls/Atolls';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function addAtoll($id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('state_name', 'Atoll name', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if($this->form_validation->run() == TRUE) {
                $insertData = array();
                if($this->input->post('state_name')) 
                    $insertData['state_name'] = $this->input->post('state_name'); 
                if(!empty($id)){
                    $this->common_model->update('states', $insertData, array('id' => $id));
                    $this->session->set_flashdata('msg_success', 'Atoll is updated successfully');
                    redirect(ADMIN_URL.'atolls');
                }else{
                    $this->common_model->insert('states', $insertData);
                    $this->session->set_flashdata('msg_success', 'Atoll is added successfully');
                    redirect(ADMIN_URL.'atolls/addAtoll');
                }
            }
        }
        $data['title'] = 'Add Atoll';
        if (!empty($id)) {
            $data['title'] = 'Edit Atoll';
            $data['row']   = $this->common_model->get_row('states', array('id' => $id));
        }
        $data['template'] = 'superadmin/Atolls/addAtoll';
        $this->load->view('templates/superadmin_template', $data);
    }
}
