<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Openings extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."openings/index/";
        $counts                     = $this->developer_model->get_openings(0, 0);
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
        $data['rows']       = $this->developer_model->get_openings($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/openings/openings';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_opening($id =''){
        $this->form_validation->set_rules('resort_id', 'resort', 'trim|required');
        $this->form_validation->set_rules('position', 'position', 'trim|required');
        $this->form_validation->set_rules('location', 'location', 'trim|required');
        $this->form_validation->set_rules('est_opening', 'Opening', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            //print_r($_POST); exit();
            $insertData = array();
            if ($this->input->post('resort_id')) 
                $insertData['resort_id'] = $this->input->post('resort_id');
            if ($this->input->post('position')) 
                $insertData['position'] = $this->input->post('position');
            if ($this->input->post('location')) 
                $insertData['location'] = $this->input->post('location');
            if ($this->input->post('transport_mode')) 
                $insertData['transport_mode'] = $this->input->post('transport_mode');
            if ($this->input->post('est_opening')) 
                $insertData['est_opening'] = $this->input->post('est_opening');
            if ($this->input->post('no_units')) 
                $insertData['no_units'] = $this->input->post('no_units');
            if ($this->input->post('no_beds')) 
                $insertData['no_beds'] = $this->input->post('no_beds');
            if(!empty($id)){
                $this->common_model->update('new_openings', $insertData, array('id' => $id));
                $this->session->set_flashdata('msg_success', 'Opening is updated successfully');
                redirect(ADMIN_URL.'openings');
            }else{
                $this->common_model->insert('new_openings', $insertData);
                $this->session->set_flashdata('msg_success', 'Opening is added successfully');
                redirect(ADMIN_URL.'openings/add_opening');
            }
        }
        $data['title'] = 'Add Opening';
        if (!empty($id)) {
            $data['title'] = 'Edit Opening';
            $data['row']   = $this->common_model->get_row('new_openings', array('id' => $id));
        }
        $data['resorts']  = $this->common_model->get_result('resorts', array('status' => '1'));
        $data['template'] = 'superadmin/openings/add_opening';
        $this->load->view('templates/superadmin_template', $data);
    }
}
