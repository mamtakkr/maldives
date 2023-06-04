<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*this controller for making manage cms in superadmin */
class Airlines extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."airlines/index/";
        $counts                     = $this->developer_model->get_airlines(0, 0);
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
        $data['rows']       = $this->developer_model->get_airlines($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/airlines/airlines';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_airline($airlines_id =''){
        $this->form_validation->set_rules('airlines_name', 'Name', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            $insertData = array();
            if($this->input->post('airlines_name')) 
                $insertData['airlines_name'] = $this->input->post('airlines_name');    
   			if($this->input->post('scheduled')) 
                $insertData['scheduled'] = $this->input->post('scheduled'); 
			if($this->input->post('country')) 
                $insertData['country'] = $this->input->post('country'); 
		     $old_image = $this->input->post('old_image')?$this->input->post('old_image'):''; 
			// image
            if($_FILES['image']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/transfer/airlines';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image'))
               {
                   $fileData = $this->upload->data();
                   $image = $fileData['file_name'];
				    if($old_image!=''){
				    unlink('./uploads/transfer/airlines/'.$old_image);
					}
               }
            }else{
				$image = $old_image;
			}
			$insertData['image'] = $image;
            if(!empty($airlines_id)){
                $this->common_model->update('airlines_travling', $insertData, array('airlines_id' => $airlines_id));
                $airlines_id = $airlines_id;            
                $this->session->set_flashdata('msg_success', 'Airlines is updated successfully');
                redirect(ADMIN_URL.'airlines');
            }else{
                $airlines_id = $this->common_model->insert('airlines_travling', $insertData);
				
                $this->session->set_flashdata('msg_success', 'Airlines is added successfully');
                redirect(ADMIN_URL.'airlines/add_airline');
            }
        }
        $data['title'] = 'Add Airline';
        if (!empty($airlines_id)) {
            $data['title']  = 'Edit Airlin';
            $data['row']    = $this->common_model->get_row('airlines_travling', array('airlines_id' => $airlines_id));
        }
		$data['template'] = 'superadmin/airlines/add_airline';
        $this->load->view('templates/superadmin_template', $data);
    }
} 