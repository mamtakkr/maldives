<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*this controller for making manage all users in superadmin */
class Customer extends CI_Controller {
	public function __construct(){
	    parent::__construct();  
	    clear_cache();  	
		$this->load->model('common_model');	
	    if(!superadmin_logged_in()){
	     	redirect(ADMIN_URL.'login');
	    }
	}	
	public function index(){	
        $this->users();
	}
    public function users(){        
        $data                           = array();      
        $config                         = frontend_pagination();
        $config['enable_query_strings'] = TRUE;   
        if(!empty($_SERVER['QUERY_STRING'])){
            $config['suffix'] = "?".$_SERVER['QUERY_STRING'];
        }else{
            $config['suffix'] = '';
        }       
        $config['base_url']         = ADMIN_URL."customer/users/";
        $counts                     = $this->developer_model->getCustomer(0, 0, 1);
        $config['total_rows']       = $counts;
        $config['per_page']         = PER_PAGE;    
        $config['uri_segment']      = 4;           
        $config['use_page_numbers'] = TRUE;  
        $config['first_url']        = $config['base_url'].$config['suffix'];  
        $pageNo                     = $this->uri->segment(4);
        $offSet                     = 0;
        if($pageNo){
            $offSet   = $config['per_page']*($pageNo-1);
        }
        $this->pagination->initialize($config);
        $data['offset']     = $offSet;
        $data['pagination'] = $this->pagination->create_links();      
        $data['users']      = $this->developer_model->getCustomer($offSet, PER_PAGE, 1);      
        //echo $this->db->last_query();exit();                
        $data['type']   = 'user';  
        $data['template']='superadmin/customer/customer';
        $this->load->view('templates/superadmin_template', $data);
    }
    public function hotels(){       
        $data                           = array();      
        $config                         = frontend_pagination();
        $config['enable_query_strings'] = TRUE;   
        if(!empty($_SERVER['QUERY_STRING'])){
            $config['suffix'] = "?".$_SERVER['QUERY_STRING'];
        }else{
            $config['suffix'] = '';
        }       
        $config['base_url']         = ADMIN_URL."customer/hotels/";
        $counts                     = $this->developer_model->getCustomer(0, 0, 2);
        $config['total_rows']       = $counts;
        $config['per_page']         = PER_PAGE;    
        $config['uri_segment']      = 4;           
        $config['use_page_numbers'] = TRUE;  
        $config['first_url']        = $config['base_url'].$config['suffix'];  
        $pageNo                     = $this->uri->segment(4);
        $offSet                     = 0;
        if($pageNo){
            $offSet   = $config['per_page']*($pageNo-1);
        }
        $this->pagination->initialize($config);
        $data['offset']     = $offSet;
        $data['pagination'] = $this->pagination->create_links();      
        $data['users']      = $this->developer_model->getCustomer($offSet, PER_PAGE, 2);  
        $data['type']       = 'hotel';        
        $data['template']   = 'superadmin/customer/customer';
        $this->load->view('templates/superadmin_template', $data);  

    }
    public function user_image_check($str){
        $allowed = array("image/jpeg", "image/jpg", "image/png"); 
          if(empty($_FILES['user_img']['name'])){
              $this->form_validation->set_message('user_image_check', "Choose image");
              return FALSE;
           }
          if(!in_array($_FILES['user_img']['type'], $allowed)) {
            $this->form_validation->set_message('user_image_check', "Only jpg, jpeg, and png files are allowed");
              return FALSE;
        }
           $image = getimagesize($_FILES['user_img']['tmp_name']);
           if ($image[0] < 100 || $image[1] < 100) {
               $this->form_validation->set_message('user_image_check', "Oops! Your profile pic needs to be atleast 100 x 100 pixels");
               return FALSE;
           }
           if ($image[0] > 2000 || $image[1] > 2000) {
               $this->form_validation->set_message('user_image_check', "Oops! your profile pic needs to be maximum of 2000 x 2000 pixels");
               return FALSE;
           }
        if(!empty($_FILES['user_img']['name'])):
            $config['encrypt_name']     = TRUE;
            $new_name                   = 'image_'.substr(md5(rand()),0,7).$_FILES["user_img"]['name'];
            $config['file_name']        = $new_name;
            $config['upload_path']      = 'uploads/users/';
            $config['allowed_types']    = 'jpeg|jpg|png';
            $config['max_size']         = '7024';
            $config['max_width']        = '2000';
            $config['max_height']       = '2000';
            $this->load->library('upload', $config);
            if ( ! $this->upload->do_upload('user_img')){
                $this->form_validation->set_message('user_image_check', $this->upload->display_errors());
                return FALSE;
            }else{
                $data = $this->upload->data(); // upload image
                $config_img_p['source_path'] = 'uploads/users/';
                $config_img_p['destination_path'] = 'uploads/users/thumbnails/';
                $config_img_p['width']      = '250';
                $config_img_p['height']     = '250';
                $config_img_p['file_name']  = $data['file_name'];
                $status=create_thumbnail($config_img_p);
                $this->session->set_userdata('user_image_check',array('image_url'=>$config['upload_path'].$data['file_name'],
                     'user_img'=>$data['file_name']));
                //unlink('uploads/users/'.$data['file_name']);
                return TRUE;
            } 
        else:
            $this->form_validation->set_message('user_image_check', "The %s field required.");
            return FALSE;
            endif;
    }
    public function add_customer($id=''){      
        $data['title'] = 'profile';  
        if(isset($_POST['submit'])){            
            $this->form_validation->set_rules('first_name','first name', 'required');
            $this->form_validation->set_rules('last_name', 'last name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
            $this->form_validation->set_rules('mobile', 'mobile number', 'numeric|required|callback_mobileNoCheck');
            if(!empty($id)){            
                $this->form_validation->set_rules('password','new password', 'trim');
                $this->form_validation->set_rules('confirm_password','confirm password', 'trim|matches[password]');
            }else{
                $this->form_validation->set_rules('password', 'new password', 'trim|required|min_length[6]');
                $this->form_validation->set_rules('confirm_password','confirm password', 'trim|required|matches[password]');
            }
            if (!empty($_FILES['user_img']['name'])){
                $this->form_validation->set_rules('user_img','','callback_user_image_check');
            }
            if($this->input->post('government_id_number')){
                $this->form_validation->set_rules('government_id_number', 'government id number', 'is_unique[users.government_id_number]');
            }
            if(!empty($_FILES['government_id_uploads']['name'][0])){
                $this->form_validation->set_rules('government_id_uploads','','callback_governmentFileUpload');
            }else{
                //$this->form_validation->set_rules('government_id_uploads','government id file','required');
            }
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == TRUE){
                $user_data  = array();
                if($this->session->userdata('user_image_check')!=''){        
                    $user_image_check=$this->session->userdata('user_image_check');
                    $user_data['profile_pic'] = $user_image_check['user_img'];    
                    $this->session->unset_userdata('user_image_check');       
                }           
                $user_data['first_name'] = $this->input->post('first_name');
                $user_data['last_name']  = $this->input->post('last_name');
                if ($this->input->post('membership')) 
                    $user_data['membership'] = $this->input->post('membership', TRUE);
                if ($this->input->post('gender')) 
                    $user_data['gender'] = $this->input->post('gender', TRUE);
                if ($this->input->post('PGSprogrammes')) 
                    $user_data['PGSprogrammes'] = $this->input->post('PGSprogrammes', TRUE);
                if ($this->input->post('government_id_number')) 
                    $user_data['government_id_number'] = $this->input->post('government_id_number', TRUE);
                if ($this->input->post('date_of_birth')) 
                    $user_data['date_of_birth'] = $this->input->post('date_of_birth', TRUE);
                if ($this->input->post('age')) 
                    $user_data['age'] = $this->input->post('age', TRUE);
                if ($this->input->post('emergency_contact')) 
                    $user_data['emergency_contact'] = $this->input->post('emergency_contact', TRUE);
                if ($this->input->post('emergency_contact_2')) 
                    $user_data['emergency_contact_2'] = $this->input->post('emergency_contact_2', TRUE);
                if ($this->input->post('medical_condition')) 
                    $user_data['medical_condition'] = $this->input->post('medical_condition', TRUE);
                if ($this->input->post('medical_condition_desc')) 
                    $user_data['medical_condition_desc'] = $this->input->post('medical_condition_desc', TRUE);
                if ($this->input->post('coach_education')) 
                    $user_data['coach_education'] = $this->input->post('coach_education', TRUE);
                if ($this->input->post('student_education')) 
                    $user_data['student_education'] = $this->input->post('student_education', TRUE);
                if ($this->input->post('marketing_material')) 
                    $user_data['marketing_material'] = $this->input->post('marketing_material', TRUE);                
                if($this->input->post('country_code_phone_1', TRUE))
                    $user_data['country_code_phone_1']      =  $this->input->post('country_code_phone_1'); 
                if($this->input->post('country_code_phone_2', TRUE))
                    $user_data['country_code_phone_2']      =  $this->input->post('country_code_phone_2'); 
                if($this->input->post('emergency_contact_contry_code', TRUE))
                    $user_data['emergency_contact_contry_code']      =  $this->input->post('emergency_contact_contry_code'); 
                if($this->input->post('email', TRUE))
                    $user_data['email'] = $this->input->post('email', TRUE);
                if($this->input->post('email_2', TRUE))
                    $user_data['email_2'] = $this->input->post('email_2', TRUE);
                if($this->input->post('mobile', TRUE))
                    $user_data['mobile']      =  $this->input->post('mobile');
                 if($this->input->post('mobile_2', TRUE))
                    $user_data['mobile_2']      =  $this->input->post('mobile_2'); 
                if($this->input->post('password')){                    
                    $salt                   = salt();
                    $user_data['password']  = sha1($salt.sha1($salt.sha1($this->input->post('password'))));    
                    $user_data['salt']      = $salt;       
                }    
                if(!empty($id)){
                    if($this->common_model->update('users', $user_data, array('id'=>$id))){
                        $this->session->set_flashdata('msg_success','Customer is  updated successfully');
                        $government_id_upload = $this->session->userdata('governmentFileUpload');
                        if(!empty($government_id_upload)){
                            $userImgs     = explode(',', $government_id_upload);
                            if(!empty($userImgs)){
                                foreach($userImgs as $userImg){
                                    $i=1;
                                    if($i==1){ $firstImg = $userImg;}
                                    if(!empty($userImg)){                            
                                        $this->common_model->insert('images', 
                                                                        array(
                                                                            'image_name'   => $userImg, 
                                                                            'type'         => 'user',
                                                                            'user_id'      => $id,
                                                                            'created_date' => date('Y-m-d H:i:s')
                                                                        )
                                                                    );
                                        $i++;
                                    }
                                }
                            }
                        } 
                        redirect(ADMIN_URL.'customer');
                    }else{      
                        $this->session->set_flashdata('msg_error','Update failed, Please try again'); 
                        redirect($_SERVER['HTTP_REFERER']);                  
                    }
                }else{              
                    $user_data['is_email_verify']  = 1; 
                    $user_data['mobile_verify']    = 1; 
                    $user_data['added_by']         = 1; 
                    $user_data['created_date']     = date('Y-m-d H:i:s'); 
                    $user_id = $this->common_model->insert('users', $user_data);
                    if(!empty($user_id)){
                        $this->session->set_flashdata('msg_success','Customer is  added successfully');
                        $government_id_upload = $this->session->userdata('governmentFileUpload');
                        if(!empty($government_id_upload)){
                            $userImgs     = explode(',', $government_id_upload);
                            if(!empty($userImgs)){
                                foreach($userImgs as $userImg){
                                    $i=1;
                                    if($i==1){ $firstImg = $userImg;}
                                    if(!empty($userImg)){                            
                                        $this->common_model->insert('images', 
                                                                        array(
                                                                            'image_name'   => $userImg, 
                                                                            'type'         => 'user',
                                                                            'user_id'      => $user_id,
                                                                            'created_date' => date('Y-m-d H:i:s')
                                                                        )
                                                                    );
                                        $i++;
                                    }
                                }
                            }
                        } 
                        $this->session->unset_userdata('governmentFileUpload');
                        redirect($_SERVER['HTTP_REFERER']); 
                    }else{
                        $this->session->set_flashdata('msg_error','Update failed, Please try again');
                        $this->session->unset_userdata('governmentFileUpload');
                        redirect($_SERVER['HTTP_REFERER']); 
                    }
                }         
            } 
        }    
        $data['type']     = 'Add User';
        $data['user']     = $this->common_model->get_row('users', array('id'=>$id));
        $data['template'] ='superadmin/customer/add_customer';       
        $this->load->view('templates/superadmin_template', $data);
    }
    public function edit_customer($id=''){      
        $data['title'] = 'profile';
        $oldEmail = $this->input->post('oldEmail');
        $email    = $this->input->post('email');
        $oldMobile = $this->input->post('oldMobile');
        $mobile    = $this->input->post('mobile');
        $this->form_validation->set_rules('first_name', 'first name', 'required');
        $this->form_validation->set_rules('last_name', 'last name', 'required');
        if($oldEmail == $email){
           $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
        }else{
            $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
        }
        if($oldMobile == $mobile){
           $this->form_validation->set_rules('mobile', 'mobile number', 'numeric');
        }else{
            $this->form_validation->set_rules('mobile', 'mobile number', 'numeric|callback_mobileNoCheck');
        }
        if(!empty($id)){            
            $this->form_validation->set_rules('password', 'new password', 'trim');
            $this->form_validation->set_rules('confirm_password','confirm password', 'trim|matches[password]');
        }else{
            $this->form_validation->set_rules('password', 'new password', 'trim|required|min_length[6]');
            $this->form_validation->set_rules('confirm_password','confirm password', 'trim|required|matches[password]');
        }
        if ($this->input->post('gender')) 
                    $user_data['gender'] = $this->input->post('gender', TRUE);
        if (!empty($_FILES['user_img']['name'])){
            $this->form_validation->set_rules('user_img','','callback_user_image_check');
        }
        if($this->input->post('government_id_number')&&$this->input->post('old_government_id_number')&&$this->input->post('government_id_number')!=$this->input->post('old_government_id_number')){
            $this->form_validation->set_rules('government_id_number', 'government id number', 'is_unique[users.government_id_number]');
        }
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $user_data  = array();
            if($this->session->userdata('user_image_check')!=''){        
                $user_image_check=$this->session->userdata('user_image_check');
                $user_data['profile_pic'] = $user_image_check['user_img'];    
                $this->session->unset_userdata('user_image_check');       
            }
            $user_data['first_name'] =  $this->input->post('first_name');
            $user_data['last_name']  =  $this->input->post('last_name');
            $user_data['email']      =  $this->input->post('email');   
            $user_data['mobile']     =  $this->input->post('mobile');
            if ($this->input->post('membership')) 
                $user_data['membership'] = $this->input->post('membership', TRUE);
            if ($this->input->post('gender')) 
                $user_data['gender'] = $this->input->post('gender', TRUE);
            if ($this->input->post('PGSprogrammes')) 
                $user_data['PGSprogrammes'] = $this->input->post('PGSprogrammes', TRUE);
            if ($this->input->post('government_id_number')) 
                $user_data['government_id_number'] = $this->input->post('government_id_number', TRUE);
            if ($this->input->post('date_of_birth')) 
                $user_data['date_of_birth'] = $this->input->post('date_of_birth', TRUE);
            if ($this->input->post('age')) 
                $user_data['age'] = $this->input->post('age', TRUE);
            if ($this->input->post('emergency_contact')) 
                $user_data['emergency_contact'] = $this->input->post('emergency_contact', TRUE);
            if ($this->input->post('emergency_contact_2')) 
                $user_data['emergency_contact_2'] = $this->input->post('emergency_contact_2', TRUE);
            if ($this->input->post('medical_condition')) 
                $user_data['medical_condition'] = $this->input->post('medical_condition', TRUE);
            if ($this->input->post('medical_condition_desc')) 
                $user_data['medical_condition_desc'] = $this->input->post('medical_condition_desc', TRUE);
            if ($this->input->post('coach_education')) 
                $user_data['coach_education'] = $this->input->post('coach_education', TRUE);
            if ($this->input->post('student_education')) 
                $user_data['student_education'] = $this->input->post('student_education', TRUE);
            if ($this->input->post('marketing_material')) 
                $user_data['marketing_material'] = $this->input->post('marketing_material', TRUE);                
            if($this->input->post('country_code_phone_1', TRUE))
                $user_data['country_code_phone_1']      =  $this->input->post('country_code_phone_1'); 
            if($this->input->post('country_code_phone_2', TRUE))
                $user_data['country_code_phone_2']      =  $this->input->post('country_code_phone_2'); 
            if($this->input->post('emergency_contact_contry_code', TRUE))
                $user_data['emergency_contact_contry_code']      =  $this->input->post('emergency_contact_contry_code'); 
            if($this->input->post('email', TRUE))
                $user_data['email'] = $this->input->post('email', TRUE);
            if($this->input->post('email_2', TRUE))
                $user_data['email_2'] = $this->input->post('email_2', TRUE);
            if($this->input->post('mobile', TRUE))
                $user_data['mobile']      =  $this->input->post('mobile');
             if($this->input->post('mobile_2', TRUE))
                $user_data['mobile_2']      =  $this->input->post('mobile_2'); 
            if($this->input->post('password')){                    
                $salt                   = salt();
                $user_data['password']  = sha1($salt.sha1($salt.sha1($this->input->post('password'))));    
                $user_data['salt']      = $salt;       
            }    
            if(!empty($id)){
                if($this->common_model->update('users', $user_data, array('id'=>$id))){
                    $this->session->set_flashdata('msg_success','Customer is  updated successfully');
                    $government_id_upload = $this->session->userdata('governmentFileUpload');
                    if(!empty($government_id_upload)){
                        $userImgs     = explode(',', $government_id_upload);
                        if(!empty($userImgs)){
                            foreach($userImgs as $userImg){
                                $i=1;
                                if($i==1){ $firstImg = $userImg;}
                                if(!empty($userImg)){                            
                                    $this->common_model->insert('images', 
                                                                    array(
                                                                        'image_name'   => $userImg, 
                                                                        'type'         => 'user',
                                                                        'user_id'      => $id,
                                                                        'created_date' => date('Y-m-d H:i:s')
                                                                    )
                                                                );
                                    $i++;
                                }
                            }
                        }
                    } 
                    $this->session->unset_userdata('governmentFileUpload');
                    redirect(ADMIN_URL.'customer');
                }else{
                    $this->session->set_flashdata('msg_error','Update failed, Please try again'); 
                    redirect(ADMIN_URL.'customer');                   
                }
            }else{         
                $user_id =  $this->common_model->insert('users', $user_data);     
                if(!empty($user_id)){
                    $government_id_upload = $this->session->userdata('governmentFileUpload');
                    if(!empty($government_id_upload)){
                        $userImgs     = explode(',', $government_id_upload);
                        if(!empty($userImgs)){
                            foreach($userImgs as $userImg){
                                $i=1;
                                if($i==1){ $firstImg = $userImg;}
                                if(!empty($userImg)){                            
                                    $this->common_model->insert('images', 
                                                                    array(
                                                                        'image_name'   => $userImg, 
                                                                        'type'         => 'user',
                                                                        'user_id'      => $user_id,
                                                                        'created_date' => date('Y-m-d H:i:s')
                                                                    )
                                                                );
                                    $i++;
                                }
                            }
                        }
                    } 
                    $this->session->unset_userdata('governmentFileUpload');
                    $this->session->set_flashdata('msg_success','Customer is  added successfully');
                    redirect($_SERVER['HTTP_REFERER']); 
                }else{
                    $this->session->set_flashdata('msg_error','Update failed, Please try again');
                    redirect($_SERVER['HTTP_REFERER']); 
                }
            }         
        } 
        $data['type']       = 'Update Customer';
        $data['user']       = $this->common_model->get_row('users', array('id'=>$id));
        $data['template']   ='superadmin/customer/edit_customer';       
        $this->load->view('templates/superadmin_template', $data);
    }    
    public function governmentFileUpload($str){        
        $allowed = array("image/jpeg", "image/jpg", "image/png", "image/png", "image/png","application/pdf", "application/x-download","application/msword","application/octet-stream","application/vnd.openxmlformats-officedocument.wordprocessingml.document");
        $government_id_file_count  = count($_FILES['government_id_uploads']['name']);
        $error  = $fileNames = array();
        $fileNu = 0;
        if(!empty($government_id_file_count)){
            for($fi=0; $fi<$government_id_file_count;$fi++){
                $fileNu++;
                $_FILES['government_id_upload']['name'] = $_FILES['government_id_uploads']['name'][$fi];
                $_FILES['government_id_upload']['type'] = $_FILES['government_id_uploads']['type'][$fi];
                $_FILES['government_id_upload']['tmp_name'] = $_FILES['government_id_uploads']['tmp_name'][$fi];
                $_FILES['government_id_upload']['size'] = $_FILES['government_id_uploads']['size'][$fi];
                //echo 'government_id_upload '.$fi.'.....<pre>';print_r($_FILES);
                if(empty($_FILES['government_id_upload']['name'])) {
                    $error[] = 'The government id file is required';
                }else if(!in_array($_FILES['government_id_upload']['type'], $allowed)) {
                    $error[] = ' file '.$fileNu." only jpg, jpeg, png, pdf and doc files are allowed";
                }
                if(!empty($_FILES['government_id_upload']['name'])){
                    $config['encrypt_name']     = TRUE;
                    $new_name                   = 'image_'.substr(md5(rand()),0,7).$_FILES["government_id_upload"]['name'];
                    $config['file_name']        = $new_name;
                    $config['upload_path']      = 'uploads/users/';
                    $config['allowed_types']    = 'jpeg|jpg|png|pdf|doc|docx';
                    $config['max_size']         = '7024';
                    $this->load->library('upload', $config);
                    if ( ! $this->upload->do_upload('government_id_upload')){
                        $error[] = ' file '.$fileNu.' '.$this->upload->display_errors();
                    }else{
                        $new_name  = explode('.', $new_name);
                        $new_name  = end($new_name);
                        $new_name = strtolower($new_name);
                        $data = $this->upload->data(); // upload image
                        if(!empty($new_name)&&($new_name=='png'||$new_name=='jpeg'||$new_name=='jpg')){
                            $config_img_p['source_path']      = 'uploads/users/';
                            $config_img_p['destination_path'] = 'uploads/users/thumbnails/';
                            $config_img_p['width']            = '250';
                            $config_img_p['height']           = '250';
                            $config_img_p['file_name']        = $data['file_name'];
                            $status                           = create_thumbnail($config_img_p);
                        }  
                        $fileNames[] =  $data['file_name'];
                    } 
                }
            }
        }
        /*echo 'fileNames.........<pre>';print_r($_FILES);
        echo 'fileNames.........<pre>';print_r($fileNames);
        echo 'error.........<pre>';print_r($error);exit();*/
        if(!empty($error)){            
            $this->form_validation->set_message('governmentFileUpload', implode(',', $error));
            return FALSE;
        }else if(!empty($fileNames)){
            $this->session->set_userdata('governmentFileUpload', implode(',', $fileNames));
            return TRUE;
        }else{
            $this->form_validation->set_message('governmentFileUpload', 'The government id file is required');
        }        
    }    
    public function add_member(){      
        $data['title'] = 'profile';  
        if(isset($_POST['submit'])){            
            $this->form_validation->set_rules('user_id','user', 'required');
            $this->form_validation->set_rules('first_name','first name', 'required');
            $this->form_validation->set_rules('last_name', 'last name', 'required');
            $this->form_validation->set_rules('email', 'Email', 'valid_email');
            $this->form_validation->set_rules('mobile', 'mobile number', 'numeric');
            if($this->input->post('government_id_number')){
                $this->form_validation->set_rules('government_id_number', 'government id number', 'is_unique[users.government_id_number]');
            }
            if(!empty($_FILES['government_id_uploads']['name'][0])){
                $this->form_validation->set_rules('government_id_uploads','','callback_governmentFileUpload');
            }
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == TRUE){
                $user_data  = array();
                if($this->session->userdata('user_image_check')!=''){        
                    $user_image_check=$this->session->userdata('user_image_check');
                    $user_data['profile_pic'] = $user_image_check['user_img'];    
                    $this->session->unset_userdata('user_image_check');       
                }            
                $user_data['first_name'] = $this->input->post('first_name');
                $user_data['last_name']  = $this->input->post('last_name');                
                if($this->input->post('email', TRUE))
                    $user_data['email'] = $this->input->post('email', TRUE);
                if($this->input->post('mobile', TRUE))
                    $user_data['mobile']      =  $this->input->post('mobile');
                if ($this->input->post('membership')) 
                    $user_data['membership'] = $this->input->post('membership', TRUE);
                if ($this->input->post('gender')) 
                    $user_data['gender'] = $this->input->post('gender', TRUE);
                if ($this->input->post('PGSprogrammes')) 
                    $user_data['PGSprogrammes'] = $this->input->post('PGSprogrammes', TRUE);
                if ($this->input->post('government_id_number')) 
                    $user_data['government_id_number'] = $this->input->post('government_id_number', TRUE);
                if ($this->input->post('date_of_birth')) 
                    $user_data['date_of_birth'] = $this->input->post('date_of_birth', TRUE);
                if ($this->input->post('age')) 
                    $user_data['age'] = $this->input->post('age', TRUE);
                if ($this->input->post('emergency_contact')) 
                    $user_data['emergency_contact'] = $this->input->post('emergency_contact', TRUE);
                if ($this->input->post('emergency_contact_2')) 
                    $user_data['emergency_contact_2'] = $this->input->post('emergency_contact_2', TRUE);
                if ($this->input->post('medical_condition')) 
                    $user_data['medical_condition'] = $this->input->post('medical_condition', TRUE);
                if ($this->input->post('medical_condition_desc')) 
                    $user_data['medical_condition_desc'] = $this->input->post('medical_condition_desc', TRUE);
                if ($this->input->post('coach_education')) 
                    $user_data['coach_education'] = $this->input->post('coach_education', TRUE);
                if ($this->input->post('student_education')) 
                    $user_data['student_education'] = $this->input->post('student_education', TRUE);
                if ($this->input->post('marketing_material')) 
                    $user_data['marketing_material'] = $this->input->post('marketing_material', TRUE);                
                if($this->input->post('country_code_phone_1', TRUE))
                    $user_data['country_code_phone_1']      =  $this->input->post('country_code_phone_1'); 
                if($this->input->post('country_code_phone_2', TRUE))
                    $user_data['country_code_phone_2']      =  $this->input->post('country_code_phone_2'); 
                if($this->input->post('emergency_contact_contry_code', TRUE))
                    $user_data['emergency_contact_contry_code']      =  $this->input->post('emergency_contact_contry_code'); 
                if($this->input->post('email', TRUE))
                    $user_data['email'] = $this->input->post('email', TRUE);
                if($this->input->post('email_2', TRUE))
                    $user_data['email_2'] = $this->input->post('email_2', TRUE);
                if($this->input->post('mobile', TRUE))
                    $user_data['mobile']      =  $this->input->post('mobile');
                if($this->input->post('mobile_2', TRUE))
                    $user_data['mobile_2']      =  $this->input->post('mobile_2'); 
                if($this->input->post('user_id', TRUE))
                    $user_data['user_id']      =  $this->input->post('user_id'); 
                    
                if(!empty($id)){
                    if($this->common_model->update('users', $user_data, array('id'=>$id))){
                        $this->session->set_flashdata('msg_success','Member is  updated successfully');
                        $government_id_upload = $this->session->userdata('governmentFileUpload');
                        if(!empty($government_id_upload)){
                            $userImgs     = explode(',', $government_id_upload);
                            if(!empty($userImgs)){
                                foreach($userImgs as $userImg){
                                    $i=1;
                                    if($i==1){ $firstImg = $userImg;}
                                    if(!empty($userImg)){                            
                                        $this->common_model->insert('images', 
                                                                        array(
                                                                            'image_name'   => $userImg, 
                                                                            'type'         => 'user',
                                                                            'user_id'      => $id,
                                                                            'created_date' => date('Y-m-d H:i:s')
                                                                        )
                                                                    );
                                        $i++;
                                    }
                                }
                            }
                        } 
                        $this->session->unset_userdata('governmentFileUpload');
                        redirect(ADMIN_URL.'customer/members');
                    }else{      
                        $this->session->set_flashdata('msg_error','Update failed, Please try again'); 
                        redirect($_SERVER['HTTP_REFERER']);                  
                    }
                }else{              
                    $user_data['user_type']        = 2; 
                    $user_data['is_email_verify']  = 1; 
                    $user_data['mobile_verify']    = 1; 
                    $user_data['added_by']         = 1; 
                    $user_data['created_date']     = date('Y-m-d H:i:s'); 
                    $user_id = $this->common_model->insert('users', $user_data);
                    if(!empty($user_id)){
                        $government_id_upload = $this->session->userdata('governmentFileUpload');
                        if(!empty($government_id_upload)){
                            $userImgs     = explode(',', $government_id_upload);
                            if(!empty($userImgs)){
                                foreach($userImgs as $userImg){
                                    $i=1;
                                    if($i==1){ $firstImg = $userImg;}
                                    if(!empty($userImg)){                            
                                        $this->common_model->insert('images', 
                                                                        array(
                                                                            'image_name'   => $userImg, 
                                                                            'type'         => 'user',
                                                                            'user_id'      => $user_id,
                                                                            'created_date' => date('Y-m-d H:i:s')
                                                                        )
                                                                    );
                                        $i++;
                                    }
                                }
                            }
                        } 
                        $this->session->unset_userdata('governmentFileUpload');
                        $this->session->set_flashdata('msg_success','Member is  added successfully');
                        redirect($_SERVER['HTTP_REFERER']); 
                    }else{
                        $this->session->set_flashdata('msg_error','Update failed, Please try again');
                        redirect($_SERVER['HTTP_REFERER']); 
                    }
                }         
            } 
        }    
        $data['type']     = 'Add Member';
        $data['users']    = $this->common_model->get_result('users', array('user_type'=>1), array(), array('first_name', 'asc'));
        $data['template'] ='superadmin/customer/add_member';       
        $this->load->view('templates/superadmin_template', $data);
    }
    public function edit_member($id=''){      
        $data['title'] = 'profile';
        $this->form_validation->set_rules('user_id','user', 'required');
        $this->form_validation->set_rules('first_name', 'first name', 'required');
        $this->form_validation->set_rules('last_name', 'last name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'valid_email');
        $this->form_validation->set_rules('mobile', 'mobile number', 'numeric'); 
        if($this->input->post('government_id_number')&&$this->input->post('old_government_id_number')&&$this->input->post('government_id_number')!=$this->input->post('old_government_id_number')){
            $this->form_validation->set_rules('government_id_number', 'government id number', 'is_unique[users.government_id_number]');
        }
        if(!empty($_FILES['government_id_uploads']['name'][0])){
            $this->form_validation->set_rules('government_id_uploads','','callback_governmentFileUpload');
        }
        if (!empty($_FILES['user_img']['name'])){
            $this->form_validation->set_rules('user_img','','callback_user_image_check');
        }
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == TRUE){
            $user_data  = array();
            if($this->session->userdata('user_image_check')!=''){        
                $user_image_check=$this->session->userdata('user_image_check');
                $user_data['profile_pic'] = $user_image_check['user_img'];    
                $this->session->unset_userdata('user_image_check');       
            }
            $user_data['first_name'] =  $this->input->post('first_name');
            $user_data['last_name']  =  $this->input->post('last_name');
            $user_data['email']      =  $this->input->post('email');   
            $user_data['mobile']     =  $this->input->post('mobile');
            if($this->input->post('user_id', TRUE))
                $user_data['user_id']      =  $this->input->post('user_id'); 
            if ($this->input->post('membership')) 
                $user_data['membership'] = $this->input->post('membership', TRUE);
            if ($this->input->post('gender')) 
                $user_data['gender'] = $this->input->post('gender', TRUE);
            if ($this->input->post('PGSprogrammes')) 
                $user_data['PGSprogrammes'] = $this->input->post('PGSprogrammes', TRUE);
            if ($this->input->post('government_id_number')) 
                $user_data['government_id_number'] = $this->input->post('government_id_number', TRUE);
            if ($this->input->post('date_of_birth')) 
                $user_data['date_of_birth'] = $this->input->post('date_of_birth', TRUE);
            if ($this->input->post('age')) 
                $user_data['age'] = $this->input->post('age', TRUE);
            if ($this->input->post('emergency_contact')) 
                $user_data['emergency_contact'] = $this->input->post('emergency_contact', TRUE);
            if ($this->input->post('emergency_contact_2')) 
                $user_data['emergency_contact_2'] = $this->input->post('emergency_contact_2', TRUE);
            if ($this->input->post('medical_condition')) 
                $user_data['medical_condition'] = $this->input->post('medical_condition', TRUE);
            if ($this->input->post('medical_condition_desc')) 
                $user_data['medical_condition_desc'] = $this->input->post('medical_condition_desc', TRUE);
            if ($this->input->post('coach_education')) 
                $user_data['coach_education'] = $this->input->post('coach_education', TRUE);
            if ($this->input->post('student_education')) 
                $user_data['student_education'] = $this->input->post('student_education', TRUE);
            if ($this->input->post('marketing_material')) 
                $user_data['marketing_material'] = $this->input->post('marketing_material', TRUE);                
            if($this->input->post('country_code_phone_1', TRUE))
                $user_data['country_code_phone_1']      =  $this->input->post('country_code_phone_1'); 
            if($this->input->post('country_code_phone_2', TRUE))
                $user_data['country_code_phone_2']      =  $this->input->post('country_code_phone_2'); 
            if($this->input->post('emergency_contact_contry_code', TRUE))
                $user_data['emergency_contact_contry_code']      =  $this->input->post('emergency_contact_contry_code'); 
            if($this->input->post('email', TRUE))
                $user_data['email'] = $this->input->post('email', TRUE);
            if($this->input->post('email_2', TRUE))
                $user_data['email_2'] = $this->input->post('email_2', TRUE);
            if($this->input->post('mobile', TRUE))
                $user_data['mobile']      =  $this->input->post('mobile');
             if($this->input->post('mobile_2', TRUE))
                $user_data['mobile_2']      =  $this->input->post('mobile_2'); 
            if(!empty($id)){
                $government_id_upload = $this->session->userdata('governmentFileUpload');
                if(!empty($government_id_upload)){
                    $userImgs     = explode(',', $government_id_upload);
                    if(!empty($userImgs)){
                        foreach($userImgs as $userImg){
                            $i=1;
                            if($i==1){ $firstImg = $userImg;}
                            if(!empty($userImg)){                            
                                $this->common_model->insert('images', 
                                                                array(
                                                                    'image_name'   => $userImg, 
                                                                    'type'         => 'user',
                                                                    'user_id'      => $id,
                                                                    'created_date' => date('Y-m-d H:i:s')
                                                                )
                                                            );
                                $i++;
                            }
                        }
                    }
                } 
                $this->session->unset_userdata('governmentFileUpload');
                if($this->common_model->update('users', $user_data, array('id'=>$id))){
                    $this->session->set_flashdata('msg_success','Member is  updated successfully');
                    redirect(ADMIN_URL.'customer/members');
                }else{
                    $this->session->set_flashdata('msg_error','Update failed, Please try again'); 
                    redirect(ADMIN_URL.'customer/members');                   
                }
            }else{               
                $user_id = $this->common_model->insert('users', $user_data);
                if(!empty($user_id)){
                    $government_id_upload = $this->session->userdata('governmentFileUpload');
                    if(!empty($government_id_upload)){
                        $userImgs     = explode(',', $government_id_upload);
                        if(!empty($userImgs)){
                            foreach($userImgs as $userImg){
                                $i=1;
                                if($i==1){ $firstImg = $userImg;}
                                if(!empty($userImg)){                            
                                    $this->common_model->insert('images', 
                                                                    array(
                                                                        'image_name'   => $userImg, 
                                                                        'type'         => 'user',
                                                                        'user_id'      => $user_id,
                                                                        'created_date' => date('Y-m-d H:i:s')
                                                                    )
                                                                );
                                    $i++;
                                }
                            }
                        }
                    } 
                    $this->session->unset_userdata('governmentFileUpload');
                    $this->session->set_flashdata('msg_success','Member is  added successfully');
                    redirect($_SERVER['HTTP_REFERER']); 
                }else{
                    $this->session->set_flashdata('msg_error','Update failed, Please try again');
                    redirect($_SERVER['HTTP_REFERER']); 
                }

            }         
        } 
        $data['type']   = 'Update Member';
        $data['user']   = $this->common_model->get_row('users', array('id'=>$id));
        $data['users']  = $this->common_model->get_result('users', array('user_type'=>1), array(), array('first_name', 'asc'));
        $data['template'] ='superadmin/customer/edit_member';       
        $this->load->view('templates/superadmin_template', $data);
    }
	/*validations funcation check email id exists*/
    public function email_check($str=''){
        if(!empty($str)){            
    	   if($this->common_model->get_row('users',array('email'=>$str, 'user_type'=>1))):
    		    $this->form_validation->set_message('email_check', 'The %s already exists');
    		       return FALSE;
    		else:
    	       return TRUE;
    	    endif;
        }
	}
	/*check mobile no exists*/
	public function mobileNoCheck($new){
        if(!empty($new)){            
            if($this->common_model->get_row('users', array('mobile'=>$new))){ 
                $this->form_validation->set_message('mobileNoCheck','This mobile number already exists');
                return FALSE;
            } else {
                return TRUE; 
            } 
        }else{
            return TRUE; 
        }
    }
    public function customerInfo(){
        if($this->input->get('user_id')){            
            $data['res_data'] = $this->developer_model->getUserDetails($this->input->get('user_id'));
    	    $this->load->view('superadmin/customer/customer_info', $data);	
        }
	}
}