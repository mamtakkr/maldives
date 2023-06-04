<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Attractions extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."attractions/index/";
        $counts                     = $this->developer_model->get_attractions(0, 0);
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
        $data['rows']       = $this->developer_model->get_attractions($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/Attractions/Attractions';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_attraction($id =''){
        $this->form_validation->set_rules('attraction_name', 'attractions name', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            $insertData = array();
            if ($this->input->post('attraction_name')) 
                $insertData['attraction_name'] = $this->input->post('attraction_name'); 
            if(!empty($id)){
                $this->common_model->update('attractions', $insertData, array('id' => $id));
                $this->session->set_flashdata('msg_success', 'attractions is updated successfully');
                redirect(ADMIN_URL.'attractions');
            }else{
                $this->common_model->insert('attractions', $insertData);
                $this->session->set_flashdata('msg_success', 'attractions is added successfully');
                redirect(ADMIN_URL.'attractions/add_attraction');
            }
        }
        $data['title'] = 'Add Attraction';
        if (!empty($id)) {
            $data['title'] = 'Edit Attraction';
            $data['row']   = $this->common_model->get_row('attractions', array('id' => $id));
        }
        $data['template'] = 'superadmin/Attractions/add_Attractions';
        $this->load->view('templates/superadmin_template', $data);
    }
}
