<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Facility extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL . "facility/index/";
        $counts                     = $this->developer_model->get_facility(0, 0);
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
        $data['rows']       = $this->developer_model->get_facility($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/facility/facility';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function addfacility($id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('facility_name', 'facility name', 'trim|required');
            if (!empty($_FILES['user_img']['name'])){
                $this->form_validation->set_rules('user_img','','callback_uploadFile');
            }
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('facility_name')) 
                    $insertData['facility_name'] = $this->input->post('facility_name');                
                if($this->session->userdata('uploadFile')!=''){        
                    $facility_img               = $this->session->userdata('uploadFile');
                    $insertData['facility_img'] = $facility_img;    
                    $this->session->unset_userdata('uploadFile');       
                }
                if(!empty($id)){
                    $this->common_model->update('facilities', $insertData, array('id' => $id));
                    $this->session->set_flashdata('msg_success', 'Facility is updated successfully');
                    redirect(ADMIN_URL . 'facility');
                }else{
                    $this->common_model->insert('facilities', $insertData);
                    $this->session->set_flashdata('msg_success', 'Facility is added successfully');
                    redirect(ADMIN_URL . 'facility/addfacility');
                }
            }
        }
        $data['title'] = 'Add Facility';
        if (!empty($id)) {
            $data['title'] = 'Edit Facility';
            $data['row']   = $this->common_model->get_row('facilities', array('id' => $id));
        }
        $data['template'] = 'superadmin/facility/addfacility';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*upload images*/
    public function uploadFile($str){
        $allowed = array("image/jpeg", "image/jpg", "image/png");       
        if(empty($_FILES['user_img']['name'])){
            $this->form_validation->set_message('uploadFile', 'Choose logo');
            return FALSE;
         }
        if(!in_array($_FILES['user_img']['type'], $allowed)) {        
            $this->form_validation->set_message('uploadFile', 'Only jpg, jpeg, and png files are allowed');
            return FALSE;
        }
        $image = getimagesize($_FILES['user_img']['tmp_name']);
        if ($image[0] < 30 || $image[1] < 30) {
            $this->form_validation->set_message('uploadFile', 'Oops! Your logo needs to be atleast 30 x 30 pixels');
            return FALSE;
        }
        if ($image[0] > 2000 || $image[1] > 2000) {
            $this->form_validation->set_message('uploadFile', 'Oops! Your logo needs to be maximum of 2000 x 2000 pixels');
            return FALSE;
        }
        if(!empty($_FILES['user_img']['name'])):
            $config['encrypt_name']  = TRUE;
            $new_name                = 'image_'.substr(md5(rand()),0,7).$_FILES["user_img"]['name'];
            $config['file_name']     = $new_name;
            $config['upload_path']   = 'uploads/facilities/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size']      = '5024';
            $config['max_width']     = '2000';
            $config['max_height']    = '2000';
            $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('user_img')){
            $this->form_validation->set_message('uploadFile', $this->upload->display_errors());
            return FALSE;
        }
        else{
            $data = $this->upload->data(); // upload image
            $config_img_p['source_path']        = 'uploads/facilities/';
            $config_img_p['destination_path']   = 'uploads/facilities/thumbnails/';
            $config_img_p['width']              = '100';
            $config_img_p['height']             = '100';
            $config_img_p['file_name']          = $data['file_name'];
            $status=create_thumbnail($config_img_p);
            $this->session->set_userdata('uploadFile', $data['file_name']);
            return TRUE;
        }else:
            $this->form_validation->set_message('uploadFile', 'The %s field required.');
            return FALSE;
        endif;
    }
}
