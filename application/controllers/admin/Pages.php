<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Pages extends CI_Controller {
    public function __construct() {
        parent::__construct();
        clear_cache();
        if (!superadmin_logged_in()) {
            redirect(ADMIN_URL.'login');
        }
    }
    /*page list*/
    function index() {
        $data = array();
        $config = admin_pagination();
        $config['enable_query_strings'] = TRUE;
        if (!empty($_SERVER['QUERY_STRING'])) {
            $config['suffix'] = "?" . $_SERVER['QUERY_STRING'];
        } else {
            $config['suffix'] = '';
        }
        $config['base_url']         = ADMIN_URL."page/index/";
        $counts                     = $this->developer_model->get_faq(0, 0);
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
        $data['rows']       = $this->developer_model->get_inspiration($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/pages/inspiration_list';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_inspiration($inspiration_id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('description', 'description', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('description')) 
                    $insertData['description'] = $this->input->post('description'); 
                if(!empty($inspiration_id)){
                    $this->common_model->update('mal_inspiration', $insertData, array('id' => $inspiration_id));
                    $this->session->set_flashdata('msg_success', 'INSPIRATION updated successfully');
                    redirect(ADMIN_URL.'pages');
                }else{
                    $this->common_model->insert('mal_inspiration', $insertData);
                    $this->session->set_flashdata('msg_success', 'INSPIRATION is added successfully');
                    redirect(ADMIN_URL.'pages/add_inspiration');
                }
            }
        }
        $data['title'] = 'Add INSPIRATION';
        if (!empty($inspiration_id)) {
            $data['title'] = 'Edit INSPIRATION';
            $data['row']   = $this->common_model->get_row('mal_inspiration', array('id' => $inspiration_id));
        }
        $data['template'] = 'superadmin/pages/add_inspiration';
        $this->load->view('templates/superadmin_template', $data);
    }



    /*page list*/
    function accommodation_list() {
        $data = array();
        $config = admin_pagination();
        $config['enable_query_strings'] = TRUE;
        if (!empty($_SERVER['QUERY_STRING'])) {
            $config['suffix'] = "?" . $_SERVER['QUERY_STRING'];
        } else {
            $config['suffix'] = '';
        }
        $config['base_url']         = ADMIN_URL."page/index/";
        $counts                     = $this->developer_model->get_faq(0, 0);
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
        $data['rows']       = $this->developer_model->get_admin_accommodation($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/pages/accommodation_list';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_accommodation($acommodatio_id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('title', 'Tile', 'trim|required');
            $this->form_validation->set_rules('description', 'description', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('description')) 
                    $insertData['description'] = $this->input->post('description'); 
                if ($this->input->post('title')) 
                    $insertData['title'] = $this->input->post('title');  
                if(!empty($acommodatio_id)){
                    $this->common_model->update('mal_admin_accommodation', $insertData, array('id' => $acommodatio_id));
                    $this->session->set_flashdata('msg_success', 'accommodation updated successfully');
                    redirect(ADMIN_URL.'pages/accommodation_list');
                }else{
                    $this->common_model->insert('mal_admin_accommodation', $insertData);
                    $this->session->set_flashdata('msg_success', 'Accommodation is added successfully');
                    redirect(ADMIN_URL.'pages/add_accommodation');
                }
            }
        }
        $data['title'] = 'Add accommodation';
        if (!empty($acommodatio_id)) {
            $data['title'] = 'Edit accommodation';
            $data['row']   = $this->common_model->get_row('mal_admin_accommodation', array('id' => $acommodatio_id));
        }
        $data['template'] = 'superadmin/pages/add_accommodation';
        $this->load->view('templates/superadmin_template', $data);
    }


/*page list*/
    function experince_list() {
        $data = array();
        $config = admin_pagination();
        $config['enable_query_strings'] = TRUE;
        if (!empty($_SERVER['QUERY_STRING'])) {
            $config['suffix'] = "?" . $_SERVER['QUERY_STRING'];
        } else {
            $config['suffix'] = '';
        }
        $config['base_url']         = ADMIN_URL."page/index/";
        $counts                     = $this->developer_model->get_faq(0, 0);
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
        $data['rows']       = $this->developer_model->get_admin_experience($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/pages/experince_list';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_experince($experince_id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('title', 'Tile', 'trim|required');
            $this->form_validation->set_rules('description', 'description', 'trim|required');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('description')) 
                    $insertData['description'] = $this->input->post('description'); 
                if ($this->input->post('title')) 
                    $insertData['title'] = $this->input->post('title');  
                if(!empty($experince_id)){
                    $this->common_model->update('mal_admin_exeperince', $insertData, array('id' => $experince_id));
                    $this->session->set_flashdata('msg_success', 'Experince updated successfully');
                    redirect(ADMIN_URL.'pages/experince_list');
                }else{
                    $this->common_model->insert('mal_admin_exeperince', $insertData);
                    $this->session->set_flashdata('msg_success', 'Experince is added successfully');
                    redirect(ADMIN_URL.'pages/add_experince');
                }
            }
        }
        $data['title'] = 'Add Experince';
        if (!empty($experince_id)) {
            $data['title'] = 'Edit Experince';
            $data['row']   = $this->common_model->get_row('mal_admin_exeperince', array('id' => $experince_id));
        }
        $data['template'] = 'superadmin/pages/add_experince';
        $this->load->view('templates/superadmin_template', $data);
    }

}
