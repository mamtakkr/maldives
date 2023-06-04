<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Distance_places extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."distance_places/index/";
        $counts                     = $this->developer_model->get_distance_places(0, 0);
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
        $data['rows']       = $this->developer_model->get_distance_places($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/distance_place/distance_places';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_distance_place($id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('title', 'title', 'trim|required');
            $this->form_validation->set_rules('latitude', 'latitude', 'trim|required');
            $this->form_validation->set_rules('longitude', 'longitude', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('title')) 
                    $insertData['title'] = $this->input->post('title'); 
                if ($this->input->post('latitude')) 
                    $insertData['latitude'] = $this->input->post('latitude'); 
                if ($this->input->post('longitude')) 
                    $insertData['longitude'] = $this->input->post('longitude'); 
                if(!empty($id)){
                    $this->common_model->update('distance_place', $insertData, array('id' => $id));
                    $this->session->set_flashdata('msg_success', 'Distance place is updated successfully');
                    redirect(ADMIN_URL.'distance_places');
                }else{
                    $this->common_model->insert('distance_place', $insertData);
                    $this->session->set_flashdata('msg_success', 'Distance place is added successfully');
                    redirect(ADMIN_URL.'distance_places/add_distance_place');
                }
            }
        }
        $data['title'] = 'Add distance place';
        if (!empty($id)) {
            $data['title'] = 'Edit distance place';
            $data['row']   = $this->common_model->get_row('distance_place', array('id' => $id));
        }
        $data['template'] = 'superadmin/distance_place/add_distance_place';
        $this->load->view('templates/superadmin_template', $data);
    }
}
