<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*this controller for making manage cms in superadmin */
class Travel_partner extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."travel_partner/index/";
        $counts                     = $this->developer_model->get_travel_partner(0, 0);
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
        $data['rows']       = $this->developer_model->get_travel_partner($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/travel_partner/travel_partner';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_travel_partner($travel_partner_id =''){
        $this->form_validation->set_rules('title', 'Title', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            $insertData = array();
            if($this->input->post('title')) 
                $insertData['title'] = $this->input->post('title');    
   			if($this->input->post('description')) 
                $insertData['description'] = $this->input->post('description'); 
			if($this->input->post('airport_type')) 
                $insertData['airport_type'] = $this->input->post('airport_type'); 
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
				$config['upload_path'] = './uploads/transfer/travel_partner';
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
				    unlink('./uploads/transfer/travel_partner/'.$old_image);
					}
               }
            }else{
				$image = $old_image;
			}
			$insertData['image'] = $image;
            if(!empty($travel_partner_id)){
                $this->common_model->update('travel_partner', $insertData, array('travel_partner_id' => $travel_partner_id));
                $travel_partner_id = $travel_partner_id;            
                $this->session->set_flashdata('msg_success', 'Travel Partner is updated successfully');
                redirect(ADMIN_URL.'travel_partner');
            }else{
                $travel_partner_id = $this->common_model->insert('travel_partner', $insertData);
				
                $this->session->set_flashdata('msg_success', 'Travel Partner is added successfully');
                redirect(ADMIN_URL.'travel_partner/add_travel_partner');
            }
        }
        $data['title'] = 'Add Travel Partner';
        if (!empty($travel_partner_id)) {
            $data['title']  = 'Edit Travel Partner';
            $data['row']    = $this->common_model->get_row('travel_partner', array('travel_partner_id' => $travel_partner_id));
        }
		$data['airporttype'] = $this->common_model->get_result('international_airport_type', array('status' => 1));
		$data['template'] = 'superadmin/travel_partner/add_travel_partner';
        $this->load->view('templates/superadmin_template', $data);
    }
} 