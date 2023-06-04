<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*this controller for making manage cms in superadmin */
class Hear_by extends CI_Controller {
    public function __construct(){
        parent::__construct();  
        clear_cache();  
        $this->load->model('common_model');  
        if(!superadmin_logged_in()){
            redirect(ADMIN_URL.'login');
        }
    }
    public function index() {
        $data = array();
        $config = admin_pagination();
        $config['enable_query_strings'] = TRUE;
        if (!empty($_SERVER['QUERY_STRING'])) {
            $config['suffix'] = "?" . $_SERVER['QUERY_STRING'];
        } else {
            $config['suffix'] = '';
        }
        $config['base_url']         = ADMIN_URL."hear_by/index/";
        $counts                     = $this->developer_model->get_hear_by(0, 0);
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
        $data['rows']       = $this->developer_model->get_hear_by($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/hear_by/hear_by';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_hear_by($id =''){
        $this->form_validation->set_rules('hear_by', 'hear by', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            $insertData = array();
            if($this->input->post('hear_by')) 
                $insertData['hear_by'] = $this->input->post('hear_by');             
            if(!empty($id)){
                $this->common_model->update('hear_by', $insertData, array('id' => $id));
                $caption_id = $id;            
                $this->session->set_flashdata('msg_success', 'Hear by is updated successfully');
                redirect(ADMIN_URL.'hear_by');
            }else{
                $caption_id = $this->common_model->insert('hear_by', $insertData);
                $this->session->set_flashdata('msg_success', 'Hear by is added successfully');
                redirect(ADMIN_URL.'hear_by/add_hear_by');
            }
        }
        $data['title'] = 'Add Hear by';
        if (!empty($id)) {
            $data['title']  = 'Edit Hear by';
            $data['row']    = $this->common_model->get_row('hear_by', array('id' => $id));
        }
        $data['template'] = 'superadmin/hear_by/add_hear_by';
        $this->load->view('templates/superadmin_template', $data);
    }
} 