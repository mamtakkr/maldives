<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*this controller for making manage cms in superadmin */
class Airport extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."airport/index/";
        $counts                     = $this->developer_model->get_airport(0, 0);
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
        $data['rows']       = $this->developer_model->get_airport($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/airport/airport';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_airport($airport_id =''){
        $this->form_validation->set_rules('name', 'name', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            $insertData = array();
            if($this->input->post('name')) 
                $insertData['name'] = $this->input->post('name');    
				if($this->input->post('address')) 
                $insertData['address'] = $this->input->post('address');    
   			if($this->input->post('description')) 
                $insertData['description'] = $this->input->post('description'); 
			if($this->input->post('airport_type')) 
                $insertData['airport_type'] = $this->input->post('airport_type'); 
			$highlights='';
			if($this->input->post('highlights'))
					$highlights = implode("##",$this->input->post('highlights'));
			$insertData['highlights'] = $highlights; 
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
				$config['upload_path'] = './uploads/transfer/airport';
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
				    unlink('./uploads/transfer/airport/'.$old_image);
					}
               }
            }else{
				$image = $old_image;
			}
			$insertData['image'] = $image;
            if(!empty($airport_id)){
                $this->common_model->update('maldives_airports', $insertData, array('airport_id' => $airport_id));
                $airport_id = $airport_id;            
                $this->session->set_flashdata('msg_success', 'Airport is updated successfully');
                redirect(ADMIN_URL.'airport');
            }else{
                $airport_id = $this->common_model->insert('maldives_airports', $insertData);
				
                $this->session->set_flashdata('msg_success', 'Airport is added successfully');
                redirect(ADMIN_URL.'airport/add_airport');
            }
        }
        $data['title'] = 'Add Airport';
        if (!empty($airport_id)) {
            $data['title']  = 'Edit Airport';
            $data['row']    = $this->common_model->get_row('maldives_airports', array('airport_id' => $airport_id));
        }
		$data['template'] = 'superadmin/airport/add_airport';
        $this->load->view('templates/superadmin_template', $data);
    }
} 