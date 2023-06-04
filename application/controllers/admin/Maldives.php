
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*this controller for making manage cms in superadmin */
class Maldives extends CI_Controller {
    public function __construct(){
        parent::__construct();  
        clear_cache();  
        $this->load->model('common_model');  
        if(!superadmin_logged_in()){
            redirect(ADMIN_URL.'login');
        }
    }
    public function index(){
        $this->form_validation->set_rules('location', 'location', 'trim|required');
        $this->form_validation->set_rules('capital', 'capital', 'trim|required');
        if (!empty($_FILES['user_img']['name'])){
            $this->form_validation->set_rules('user_img','','callback_uploadFile');
        }
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            if($this->input->post('location')){
                $insertData['location'] = $this->input->post('location');
            } 
            if($this->input->post('capital')){
                $insertData['capital'] = $this->input->post('capital');
            } 
            if($this->input->post('population')){
                $insertData['population'] = $this->input->post('population');
            } 
            if($this->input->post('area')){
                $insertData['area'] = $this->input->post('area');
            }
            if($this->input->post('calling_code')){
                $insertData['calling_code'] = $this->input->post('calling_code');
            }
            if($this->input->post('largest_industry')){
                $insertData['largest_industry'] = $this->input->post('largest_industry');
            } 
            if($this->input->post('government')){
                $insertData['government'] = $this->input->post('government');
            } 
            if($this->input->post('independence')){
                $insertData['independence'] = $this->input->post('independence');
            }
            if($this->input->post('geography')){
                $insertData['geography'] = $this->input->post('geography');
            }
            if($this->input->post('number_of_resorts')){
                $insertData['number_of_resorts'] = $this->input->post('number_of_resorts');
            } 
            if($this->input->post('local_time')){
                $insertData['local_time'] = $this->input->post('local_time');
            } 
            if($this->input->post('currency')){
                $insertData['currency'] = $this->input->post('currency');
            }
            if($this->input->post('official_language')){
                $insertData['official_language'] = $this->input->post('official_language');
            }
            if($this->input->post('airports')){
                $insertData['airports'] = $this->input->post('airports');
            } 
            if($this->input->post('electricity')){
                $insertData['electricity'] = $this->input->post('electricity');
            }
            if($this->input->post('climate_weather')){
                $insertData['climate_weather'] = $this->input->post('climate_weather');
            }         
            if($this->session->userdata('uploadFile')!=''){        
                $image_name            = $this->session->userdata('uploadFile');
                $insertData['map_img'] = $image_name;    
                $this->session->unset_userdata('uploadFile');       
            }
            $this->common_model->update('about_maldives', $insertData, array('id'=>'1'));
            $this->session->set_flashdata('msg_success', 'Maldives data is updated successfull');   
        }
        $data               = array();
        $data['title']      = 'Update Maldives';
        $data['row']        = $this->common_model->get_row('about_maldives', array('id'=>1), array(), array('id','ASC'));      
        $data['template']   = 'superadmin/maldives/maldives';
        $this->load->view('templates/superadmin_template', $data);       
    }  
    public function uploadFile($str){
        $allowed = array("image/jpeg", "image/jpg", "image/png"); 
        if(empty($_FILES['user_img']['name'])){
            $this->form_validation->set_message('uploadFile', 'The map  is required');
            return FALSE;
        }
        if(!in_array($_FILES['user_img']['type'], $allowed)) {
            $this->form_validation->set_message('uploadFile', 'Only jpg, jpeg and png files are allowed');
            return FALSE;
        }
        $image = getimagesize($_FILES['user_img']['tmp_name']);
        if ($image[0] < 100 || $image[1] < 100) {
            $this->form_validation->set_message('uploadFile', 'Oops! Your map needs to be atleast 100 x 100 pixels');
            return FALSE;
        }
        if ($image[0] > 3000 || $image[1] > 3000) {
            $this->form_validation->set_message('uploadFile', 'Oops! Your map needs to be maximum of 3000 x 3000 pixels');
            return FALSE;
        }
        if(!empty($_FILES['user_img']['name'])):
            $config['encrypt_name']     = TRUE;
            $max_size                   = 1024*20;
            $new_name                   = 'image_'.substr(md5(rand()),0,7).$_FILES["user_img"]['name'];
            $config['file_name']        = $new_name;
            $config['upload_path']      = 'uploads/maldives/';
            $config['allowed_types']    = 'jpeg|jpg|png';
            $config['max_size']         = $max_size;
            $config['max_width']        = '2000';
            $config['max_height']       = '2000';
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('user_img')){
                $this->form_validation->set_message('blog_image_check', $this->upload->display_errors());
                return FALSE;
            }else{
                $data = $this->upload->data(); // upload image
                $config_img_p['source_path'] = 'uploads/maldives/';
                $config_img_p['destination_path'] = 'uploads/maldives/thumbnails/';
                $config_img_p['width']      = '360';
                $config_img_p['height']     = '360';
                $config_img_p['file_name']  = $data['file_name'];
                $status=create_thumbnail($config_img_p);
                $this->session->set_userdata('uploadFile', $data['file_name']);    
                return TRUE;
            } 
        else:
            $this->form_validation->set_message('blog_image_check', 'The %s field required.');
            return FALSE;
            endif;
    }  
	public function arrival_immegration(){
		
		if($_POST){
			$title 					= $this->input->post('title',true);
			$description 			= $this->input->post('description',true);
			$arrival_immigration_link= $this->input->post('arrival_immigration_link',true);
		
		//image upload code
			$old_image1 = $this->input->post('old_image1',true)?$this->input->post('old_image1',true):'';
			$old_image2 = $this->input->post('old_image2',true)?$this->input->post('old_image2',true):'';
			$old_image3 = $this->input->post('old_image3',true)?$this->input->post('old_image3',true):'';
			$old_image4 = $this->input->post('old_image4',true)?$this->input->post('old_image4',true):'';
			$old_image5 = $this->input->post('old_image5',true)?$this->input->post('old_image5',true):'';
            //image upload code
           
            // image1
            if($_FILES['image1']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image1']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/arrival_immigration';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image1'))
               {
                   $fileData = $this->upload->data();
                   $image1 = $fileData['file_name'];
				    if($old_image1!=''){
				    unlink('./uploads/maldives/arrival_immigration/'.$old_image1);
					}
               }
            }else{
				$image1 = $old_image1;
			}
			// image2
            if($_FILES['image2']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image2']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/arrival_immigration';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image2'))
               {
                   $fileData = $this->upload->data();
                   $image2 = $fileData['file_name'];
				    if($old_image2!=''){
				    unlink('./uploads/maldives/arrival_immigration/'.$old_image2);
					}
               }
            }else{
				$image2 = $old_image2;
			}
			// image3
            if($_FILES['image3']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image3']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/arrival_immigration';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image3'))
               {
                   $fileData = $this->upload->data();
                   $image3 = $fileData['file_name'];
				    if($old_image3!=''){
				    unlink('./uploads/maldives/arrival_immigration/'.$old_image3);
					}
               }
            }else{
				$image3 = $old_image3;
			}
			
			// image4
            if($_FILES['image4']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image4']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/arrival_immigration';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image4'))
               {
                   $fileData = $this->upload->data();
                   $image4 = $fileData['file_name'];
				    if($old_image4!=''){
				    unlink('./uploads/maldives/arrival_immigration/'.$old_image4);
					}
               }
            }else{
				$image4 = $old_image4;
			}
			// image5
            if($_FILES['image5']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image5']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/arrival_immigration';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image5'))
               {
                   $fileData = $this->upload->data();
                   $image5 = $fileData['file_name'];
				    if($old_image5!=''){
				    unlink('./uploads/maldives/arrival_immigration/'.$old_image5);
					}
               }
            }else{
				$image5 = $old_image5;
			}
		$update_data=array('title'=>$title,'description'=>$description,"image1"=>$image1,"image2"=>$image2,"image3"=>$image3,"image4"=>$image4,"image5"=>$image5,'arrival_immigration_link'=>$arrival_immigration_link);
		$this->common_model->update('arrival_immigration', $update_data, array('arrival_immigration_id'=>'1'));
        $this->session->set_flashdata('msg_success', 'Arrival & Immigration data is updated successfully'); 
		redirect('admin/maldives/arrival_immegration');
		}else{
			$data               = array();
			$data['title']      = 'Update Arrival Immigration';
			$data['row']        = $this->common_model->get_row('arrival_immigration', array('arrival_immigration_id'=>1), array(), array('arrival_immigration_id','ASC'));      
			$data['template']   = 'superadmin/maldives/arrival_immigration';
			$this->load->view('templates/superadmin_template', $data);     
		}
	}
	// What to wear
	public function what_to_wear(){
		
		if($_POST){
			$title 					= $this->input->post('title',true);
			$description 			= $this->input->post('description',true);
			
		
		//image upload code
			$old_image1 = $this->input->post('old_image1',true)?$this->input->post('old_image1',true):'';
			$old_image2 = $this->input->post('old_image2',true)?$this->input->post('old_image2',true):'';
			$old_image3 = $this->input->post('old_image3',true)?$this->input->post('old_image3',true):'';
			$old_image4 = $this->input->post('old_image4',true)?$this->input->post('old_image4',true):'';
			$old_image5 = $this->input->post('old_image5',true)?$this->input->post('old_image5',true):'';
            //image upload code
           
            // image1
            if($_FILES['image1']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image1']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/what_to_wear';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image1'))
               {
                   $fileData = $this->upload->data();
                   $image1 = $fileData['file_name'];
				    if($old_image1!=''){
				    unlink('./uploads/maldives/what_to_wear/'.$old_image1);
					}
               }
            }else{
				$image1 = $old_image1;
			}
			// image2
            if($_FILES['image2']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image2']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/what_to_wear';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image2'))
               {
                   $fileData = $this->upload->data();
                   $image2 = $fileData['file_name'];
				    if($old_image2!=''){
				    unlink('./uploads/maldives/what_to_wear/'.$old_image2);
					}
               }
            }else{
				$image2 = $old_image2;
			}
			// image3
            if($_FILES['image3']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image3']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/what_to_wear';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image3'))
               {
                   $fileData = $this->upload->data();
                   $image3 = $fileData['file_name'];
				    if($old_image3!=''){
				    unlink('./uploads/maldives/what_to_wear/'.$old_image3);
					}
               }
            }else{
				$image3 = $old_image3;
			}
			
			// image4
            if($_FILES['image4']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image4']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/what_to_wear';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image4'))
               {
                   $fileData = $this->upload->data();
                   $image4 = $fileData['file_name'];
				    if($old_image4!=''){
				    unlink('./uploads/maldives/what_to_wear/'.$old_image4);
					}
               }
            }else{
				$image4 = $old_image4;
			}
			// image5
            if($_FILES['image5']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image5']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/what_to_wear';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image5'))
               {
                   $fileData = $this->upload->data();
                   $image5 = $fileData['file_name'];
				    if($old_image5!=''){
				    unlink('./uploads/maldives/what_to_wear/'.$old_image5);
					}
               }
            }else{
				$image5 = $old_image5;
			}
		$update_data=array('title'=>$title,'description'=>$description,"image1"=>$image1,"image2"=>$image2,"image3"=>$image3,"image4"=>$image4,"image5"=>$image5);
		
		$this->common_model->update('what_to_wear', $update_data, array('wear_id'=>'1'));
        $this->session->set_flashdata('msg_success', 'Updated successfully'); 
		redirect('admin/maldives/what_to_wear');
		}else{
			$data               = array();
			$data['title']      = 'Update What To Wear';
			$data['row']        = $this->common_model->get_row('what_to_wear', array('wear_id'=>1), array(), array('wear_id','ASC'));      
			$data['template']   = 'superadmin/maldives/what_to_wear';
			$this->load->view('templates/superadmin_template', $data);     
		}
	}
	// Local Environment
	public function local_environment(){
		
		if($_POST){
			$title 					= $this->input->post('title',true);
			$description 			= $this->input->post('description',true);
			
		
		//image upload code
			$old_image1 = $this->input->post('old_image1',true)?$this->input->post('old_image1',true):'';
			$old_image2 = $this->input->post('old_image2',true)?$this->input->post('old_image2',true):'';
			$old_image3 = $this->input->post('old_image3',true)?$this->input->post('old_image3',true):'';
			$old_image4 = $this->input->post('old_image4',true)?$this->input->post('old_image4',true):'';
			$old_image5 = $this->input->post('old_image5',true)?$this->input->post('old_image5',true):'';
            //image upload code
           
            // image1
            if($_FILES['image1']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image1']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/local_environment';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image1'))
               {
                   $fileData = $this->upload->data();
                   $image1 = $fileData['file_name'];
				    if($old_image1!=''){
				    unlink('./uploads/maldives/local_environment/'.$old_image1);
					}
               }
            }else{
				$image1 = $old_image1;
			}
			// image2
            if($_FILES['image2']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image2']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/local_environment';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image2'))
               {
                   $fileData = $this->upload->data();
                   $image2 = $fileData['file_name'];
				    if($old_image2!=''){
				    unlink('./uploads/maldives/local_environment/'.$old_image2);
					}
               }
            }else{
				$image2 = $old_image2;
			}
			// image3
            if($_FILES['image3']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image3']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/local_environment';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image3'))
               {
                   $fileData = $this->upload->data();
                   $image3 = $fileData['file_name'];
				    if($old_image3!=''){
				    unlink('./uploads/maldives/local_environment/'.$old_image3);
					}
               }
            }else{
				$image3 = $old_image3;
			}
			
			// image4
            if($_FILES['image4']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image4']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/local_environment';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image4'))
               {
                   $fileData = $this->upload->data();
                   $image4 = $fileData['file_name'];
				    if($old_image4!=''){
				    unlink('./uploads/maldives/local_environment/'.$old_image4);
					}
               }
            }else{
				$image4 = $old_image4;
			}
			// image5
            if($_FILES['image5']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image5']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/local_environment';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image5'))
               {
                   $fileData = $this->upload->data();
                   $image5 = $fileData['file_name'];
				    if($old_image5!=''){
				    unlink('./uploads/maldives/local_environment/'.$old_image5);
					}
               }
            }else{
				$image5 = $old_image5;
			}
		$update_data=array('title'=>$title,'description'=>$description,"image1"=>$image1,"image2"=>$image2,"image3"=>$image3,"image4"=>$image4,"image5"=>$image5);
		
		$this->common_model->update('local_environment', $update_data, array('environment_id'=>'1'));
        $this->session->set_flashdata('msg_success', 'Updated successfully'); 
		redirect('admin/maldives/local_environment');
		}else{
			$data               = array();
			$data['title']      = 'Update Local Environment';
			$data['row']        = $this->common_model->get_row('local_environment', array('environment_id'=>1), array(), array('environment_id','ASC'));      
			$data['template']   = 'superadmin/maldives/local_environment';
			$this->load->view('templates/superadmin_template', $data);     
		}
	}
	// Maldives People
	public function maldives_people(){
		
		if($_POST){
			$title 					= $this->input->post('title',true);
			$description 			= $this->input->post('description',true);
			
		
		//image upload code
			$old_image1 = $this->input->post('old_image1',true)?$this->input->post('old_image1',true):'';
			$old_image2 = $this->input->post('old_image2',true)?$this->input->post('old_image2',true):'';
			$old_image3 = $this->input->post('old_image3',true)?$this->input->post('old_image3',true):'';
			$old_image4 = $this->input->post('old_image4',true)?$this->input->post('old_image4',true):'';
			$old_image5 = $this->input->post('old_image5',true)?$this->input->post('old_image5',true):'';
            //image upload code
           
            // image1
            if($_FILES['image1']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image1']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/maldives_people';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image1'))
               {
                   $fileData = $this->upload->data();
                   $image1 = $fileData['file_name'];
				    if($old_image1!=''){
				    unlink('./uploads/maldives/maldives_people/'.$old_image1);
					}
               }
            }else{
				$image1 = $old_image1;
			}
			// image2
            if($_FILES['image2']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image2']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/maldives_people';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image2'))
               {
                   $fileData = $this->upload->data();
                   $image2 = $fileData['file_name'];
				    if($old_image2!=''){
				    unlink('./uploads/maldives/maldives_people/'.$old_image2);
					}
               }
            }else{
				$image2 = $old_image2;
			}
			// image3
            if($_FILES['image3']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image3']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/maldives_people';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image3'))
               {
                   $fileData = $this->upload->data();
                   $image3 = $fileData['file_name'];
				    if($old_image3!=''){
				    unlink('./uploads/maldives/maldives_people/'.$old_image3);
					}
               }
            }else{
				$image3 = $old_image3;
			}
			
			// image4
            if($_FILES['image4']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image4']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/maldives_people';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image4'))
               {
                   $fileData = $this->upload->data();
                   $image4 = $fileData['file_name'];
				    if($old_image4!=''){
				    unlink('./uploads/maldives/maldives_people/'.$old_image4);
					}
               }
            }else{
				$image4 = $old_image4;
			}
			// image5
            if($_FILES['image5']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image5']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/maldives_people';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image5'))
               {
                   $fileData = $this->upload->data();
                   $image5 = $fileData['file_name'];
				    if($old_image5!=''){
				    unlink('./uploads/maldives/maldives_people/'.$old_image5);
					}
               }
            }else{
				$image5 = $old_image5;
			}
		$update_data=array('title'=>$title,'description'=>$description,"image1"=>$image1,"image2"=>$image2,"image3"=>$image3,"image4"=>$image4,"image5"=>$image5);
		
		$this->common_model->update('maldives_people', $update_data, array('people_id'=>'1'));
        $this->session->set_flashdata('msg_success', 'Updated successfully'); 
		redirect('admin/maldives/maldives_people');
		}else{
			$data               = array();
			$data['title']      = 'Update People';
			$data['row']        = $this->common_model->get_row('maldives_people', array('people_id'=>1), array(), array('people_id','ASC'));      
			$data['template']   = 'superadmin/maldives/maldives_people';
			$this->load->view('templates/superadmin_template', $data);     
		}
	}
	// Climate Weather
	public function climate_weather(){
		
		if($_POST){
			$title 					= $this->input->post('title',true);
			$description 			= $this->input->post('description',true);
			$climate_weather_link1	= $this->input->post('climate_weather_link1',true);
			$climate_weather_link2	= $this->input->post('climate_weather_link2',true);
			
		
		//image upload code
			$old_image1 = $this->input->post('old_image1',true)?$this->input->post('old_image1',true):'';
			$old_image2 = $this->input->post('old_image2',true)?$this->input->post('old_image2',true):'';
			$old_image3 = $this->input->post('old_image3',true)?$this->input->post('old_image3',true):'';
			$old_image4 = $this->input->post('old_image4',true)?$this->input->post('old_image4',true):'';
			$old_image5 = $this->input->post('old_image5',true)?$this->input->post('old_image5',true):'';
            //image upload code
           
            // image1
            if($_FILES['image1']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image1']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/climate_weather';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image1'))
               {
                   $fileData = $this->upload->data();
                   $image1 = $fileData['file_name'];
				    if($old_image1!=''){
				    unlink('./uploads/maldives/climate_weather/'.$old_image1);
					}
               }
            }else{
				$image1 = $old_image1;
			}
			// image2
            if($_FILES['image2']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image2']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/climate_weather';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image2'))
               {
                   $fileData = $this->upload->data();
                   $image2 = $fileData['file_name'];
				    if($old_image2!=''){
				    unlink('./uploads/maldives/climate_weather/'.$old_image2);
					}
               }
            }else{
				$image2 = $old_image2;
			}
			// image3
            if($_FILES['image3']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image3']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/climate_weather';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image3'))
               {
                   $fileData = $this->upload->data();
                   $image3 = $fileData['file_name'];
				    if($old_image3!=''){
				    unlink('./uploads/maldives/climate_weather/'.$old_image3);
					}
               }
            }else{
				$image3 = $old_image3;
			}
			
			// image4
            if($_FILES['image4']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image4']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/climate_weather';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image4'))
               {
                   $fileData = $this->upload->data();
                   $image4 = $fileData['file_name'];
				    if($old_image4!=''){
				    unlink('./uploads/maldives/climate_weather/'.$old_image4);
					}
               }
            }else{
				$image4 = $old_image4;
			}
			// image5
            if($_FILES['image5']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image5']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/climate_weather';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image5'))
               {
                   $fileData = $this->upload->data();
                   $image5 = $fileData['file_name'];
				    if($old_image5!=''){
				    unlink('./uploads/maldives/climate_weather/'.$old_image5);
					}
               }
            }else{
				$image5 = $old_image5;
			}
		$update_data=array('title'=>$title,'description'=>$description,"image1"=>$image1,"image2"=>$image2,"image3"=>$image3,"image4"=>$image4,"image5"=>$image5,'climate_weather_link1'=>$climate_weather_link1,'climate_weather_link2'=>$climate_weather_link2);
		
		$this->common_model->update('climate_weather', $update_data, array('climate_weather_id'=>'1'));
        $this->session->set_flashdata('msg_success', 'Updated successfully'); 
		redirect('admin/maldives/climate_weather');
		}else{
			$data               = array();
			$data['title']      = 'Update People';
			$data['row']        = $this->common_model->get_row('climate_weather', array('climate_weather_id'=>1), array(), array('climate_weather_id','ASC'));      
			$data['template']   = 'superadmin/maldives/climate_weather';
			$this->load->view('templates/superadmin_template', $data);     
		}
	}
	// Diving
	public function remove_maldives_diving1(){
		$update_data=array("image1"=>"");
		$this->common_model->update('maldives_diving', $update_data, array('diving_id'=>'1'));
	}
	public function remove_maldives_diving2(){
		$update_data=array("image2"=>"");
		$this->common_model->update('maldives_diving', $update_data, array('diving_id'=>'1'));
	}
	public function remove_maldives_diving3(){
		$update_data=array("image3"=>"");
		$this->common_model->update('maldives_diving', $update_data, array('diving_id'=>'1'));
	}
	public function remove_maldives_diving4(){
		$update_data=array("image4"=>"");
		$this->common_model->update('maldives_diving', $update_data, array('diving_id'=>'1'));
	}
	public function remove_maldives_diving5(){
		$update_data=array("image5"=>"");
		$this->common_model->update('maldives_diving', $update_data, array('diving_id'=>'1'));
	}
	public function maldives_diving(){
		//echo "asd";exit;
		if($_POST){
			$title 					= $this->input->post('title',true);
			$description 			= $this->input->post('description',true);
			$diving_link1	= $this->input->post('diving_link1',true);
			$diving_link2	= $this->input->post('diving_link2',true);
			
		
		//image upload code
			$old_image1 = $this->input->post('old_image1',true)?$this->input->post('old_image1',true):'';
			$old_image2 = $this->input->post('old_image2',true)?$this->input->post('old_image2',true):'';
			$old_image3 = $this->input->post('old_image3',true)?$this->input->post('old_image3',true):'';
			$old_image4 = $this->input->post('old_image4',true)?$this->input->post('old_image4',true):'';
			$old_image5 = $this->input->post('old_image5',true)?$this->input->post('old_image5',true):'';
            //image upload code
           
            // image1
            if($_FILES['image1']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image1']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/maldives_diving';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image1'))
               {
                   $fileData = $this->upload->data();
                   $image1 = $fileData['file_name'];
				    if($old_image1!=''){
				    unlink('./uploads/maldives/maldives_diving/'.$old_image1);
					}
               }
            }else{
				$image1 = $old_image1;
			}
			// image2
            if($_FILES['image2']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image2']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/maldives_diving';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image2'))
               {
                   $fileData = $this->upload->data();
                   $image2 = $fileData['file_name'];
				    if($old_image2!=''){
				    unlink('./uploads/maldives/maldives_diving/'.$old_image2);
					}
               }
            }else{
				$image2 = $old_image2;
			}
			// image3
            if($_FILES['image3']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image3']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/maldives_diving';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image3'))
               {
                   $fileData = $this->upload->data();
                   $image3 = $fileData['file_name'];
				    if($old_image3!=''){
				    unlink('./uploads/maldives/maldives_diving/'.$old_image3);
					}
               }
            }else{
				$image3 = $old_image3;
			}
			
			// image4
            if($_FILES['image4']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image4']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/maldives_diving';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image4'))
               {
                   $fileData = $this->upload->data();
                   $image4 = $fileData['file_name'];
				    if($old_image4!=''){
				    unlink('./uploads/maldives/maldives_diving/'.$old_image4);
					}
               }
            }else{
				$image4 = $old_image4;
			}
			// image5
            if($_FILES['image5']['name'] != '')
            {
				$imageExts = array("gif", "jpeg", "jpg", "png");
				$data['error'] = true;
				$config['allowed_types'] = 'jpeg|gif|jpg|png';
				$config['overwrite']     = FALSE;
				$fileName = $_FILES['image5']['name'];
				$str = 'image_'.substr(md5(rand()),0,7);
				$ext = pathinfo($fileName, PATHINFO_EXTENSION);
				$new_name = $fileName = time() . $str . "." . $ext;
				$config['upload_path'] = './uploads/maldives/maldives_diving';
				$config['file_name'] = $new_name;
               // load upload library
               $this->load->library('upload', $config);
               // initialize file data
               $this->upload->initialize($config);
               if($this->upload->do_upload('image5'))
               {
                   $fileData = $this->upload->data();
                   $image5 = $fileData['file_name'];
				    if($old_image5!=''){
				    unlink('./uploads/maldives/maldives_diving/'.$old_image5);
					}
               }
            }else{
				$image5 = $old_image5;
			}
		$update_data=array('title'=>$title,'description'=>$description,"image1"=>$image1,"image2"=>$image2,"image3"=>$image3,"image4"=>$image4,"image5"=>$image5,'diving_link1'=>$diving_link1,'diving_link2'=>$diving_link2);
		//print_r($update_data);exit;
		
		$this->common_model->update('maldives_diving', $update_data, array('diving_id'=>'1'));
        $this->session->set_flashdata('msg_success', 'Updated successfully'); 
		redirect('admin/maldives/maldives_diving');
		}else{
			$data               = array();
			$data['title']      = 'Update People';
			$data['row']        = $this->common_model->get_row('maldives_diving', array('diving_id'=>1), array(), array('diving_id','ASC'));      
			$data['template']   = 'superadmin/maldives/maldives_diving';
			$this->load->view('templates/superadmin_template', $data);     
		}
	}
}