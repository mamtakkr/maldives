<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*this controller for making manage  superadmin */
class Superadmin extends CI_Controller {
	public function __construct(){
        parent::__construct();
        clear_cache();
        $this->_check_login();       
        $this->load->model('common_model');
    }   
	public function index(){		
		$this->dashboard();
	}
	/*check superadmin login */
	private function _check_login(){
		if(superadmin_logged_in()===FALSE)
			redirect(ADMIN_URL.'login');
	}
	/*logout superadmin user*/
	public function logout(){
		$this->_check_login(); //check  login authentication
		$this->session->unset_userdata('superadmin_info');
		redirect(ADMIN_URL.'login');
	}
	/*show superadmin dashboard*/
	public function dashboard(){    	   
	    $data['template']='superadmin/dashboard';
	    $this->load->view('templates/superadmin_template',$data);
    }
    /*validation funcation for email */
    public function email_check($new){
        if ($this->common_model->get_row('admin_users',array('email'=>$new))){ 
            $this->form_validation->set_message('email_check','This email address already exists');
            return FALSE;
        }else {
            return TRUE; 
        } 
    } 
    /*check mobile no exists*/
    public function mobile_check($new){
        if ($this->common_model->get_row('users',array('mobile'=>$new))) 
        { 
            $this->form_validation->set_message('mobile_check','This mobile no. already exists');
            return FALSE;
        } else {
            return TRUE; 
        } 
    }    
	/*change user status*/
	public function changeFavStatus($id="",$status="")	{
		$this->_check_login(); //check login authentication		
		$data=array('feachered'=>$status);
		if($this->common_model->update('resorts', $data, array('id'=>$id)))
		if($status==2){
			$this->session->set_flashdata('msg_success','The resort is removed from   favorites list successfully');
		}else{
			$this->session->set_flashdata('msg_success','The resort is added in   favorites list successfully');
		}
		redirect($_SERVER['HTTP_REFERER']);
	}
	public function changeUserStatus($table_name, $title="",$id="",$status="")	{
		$this->_check_login(); //check login authentication		
		$data=array('status'=>$status);
		if($this->common_model->update($table_name, $data,array('id'=>$id)))
		$this->session->set_flashdata('msg_success',$title.' status updated successfully');
		redirect($_SERVER['HTTP_REFERER']);
	}	
	/*upload images*/
 	public function user_image_check($str){
 		$allowed = array("image/jpeg", "image/jpg", "image/png");		
	    if(empty($_FILES['user_img']['name'])){
	        $this->form_validation->set_message('user_image_check', 'Choose logo');
	        return FALSE;
	     }
	    if(!in_array($_FILES['user_img']['type'], $allowed)) {		  
		  	$this->form_validation->set_message('user_image_check', 'Only jpg, jpeg, and png files are allowed');
	        return FALSE;
		}
	    $image = getimagesize($_FILES['user_img']['tmp_name']);
	    if ($image[0] < 100 || $image[1] < 100) {
	        $this->form_validation->set_message('user_image_check', 'Oops! Your logo needs to be atleast 100 x 100 pixels');
	        return FALSE;
	    }
	    if ($image[0] > 2000 || $image[1] > 2000) {
	        $this->form_validation->set_message('user_image_check', 'Oops! Your logo needs to be maximum of 2000 x 2000 pixels');
	        return FALSE;
	    }
	    if(!empty($_FILES['user_img']['name'])):
			$config['encrypt_name'] = TRUE;
			  $new_name = 'image_'.substr(md5(rand()),0,7).$_FILES["user_img"]['name'];
			$config['file_name'] = $new_name;
			$config['upload_path'] = 'uploads/admin_user/';
			$config['allowed_types'] = 'jpeg|jpg|png';
			$config['max_size']  = '5024';
			$config['max_width']  = '2000';
			$config['max_height']  = '2000';
			$this->load->library('upload', $config);
	    if ( ! $this->upload->do_upload('user_img')){
	        $this->form_validation->set_message('user_image_check', $this->upload->display_errors());
	        return FALSE;
	    }
	    else{
			$data = $this->upload->data(); // upload image
			$config_img_p['source_path'] = 'uploads/admin_user/';
			$config_img_p['destination_path'] = 'uploads/admin_user/thumbnails/';
			$config_img_p['width']  = '100';
			$config_img_p['height']  = '100';
			$config_img_p['file_name'] =$data['file_name'];
			$status=create_thumbnail($config_img_p);
			$this->session->set_userdata('user_image_check',array('image_url'=>$config['upload_path'].$data['file_name'],
			   'user_img'=>$data['file_name']));
			return TRUE;
	    }else:
	        $this->form_validation->set_message('user_image_check', 'The %s field required.');
	        return FALSE;
	    endif;
    }
    /*superadmin dashboard*/
	public function profile(){		
		$data['title']='profile';
		$oldEmail = $this->input->post('oldEmail');
		$email    = $this->input->post('email');
		$this->form_validation->set_rules('first_name', 'first Name', 'required');
		$this->form_validation->set_rules('last_name', 'last Name', 'required');
		if($oldEmail == $email){
		   $this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		}else{
		   $this->form_validation->set_rules('email', 'Email', 'required|valid_email|callback_email_check');
		}
		if (!empty($_FILES['user_img']['name'])){
	      $this->form_validation->set_rules('user_img','','callback_user_image_check');
	    }
		$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
		if ($this->form_validation->run() == TRUE){
			$user_data  = array();
		    if($this->session->userdata('user_image_check')!=''){        
		        $user_image_check=$this->session->userdata('user_image_check');
		        $user_data['image'] = $user_image_check['user_img'];	
		        $this->session->unset_userdata('user_image_check');       
		      }
			$user_data['first_name'] =  $this->input->post('first_name');
			$user_data['last_name']	 =  $this->input->post('last_name');
			$user_data['email']		 =	$this->input->post('email');			
			if($this->common_model->update('admin_users', $user_data,array('id'=>superadmin_id()))){
				$this->session->set_flashdata('msg_success','Profile updated successfully');
				redirect(ADMIN_URL.'superadmin/profile');
			}else{
				$this->session->set_flashdata('msg_error','Update failed, Please try again');
				redirect(ADMIN_URL.'superadmin/profile');
			}
		}else{
			$data['user'] = $this->common_model->get_row('admin_users', array('id'=>superadmin_id()));
			$data['template']='superadmin/profile';
			$this->load->view('templates/superadmin_template',$data);
		}
	}
	public function setting(){
		if(isset($_POST['submit'])){
			if($this->input->post('admin_email')){
				$this->common_model->update('web_info', array('meta_data'=>$this->input->post('admin_email')), array('meta_key'=>'admin_email'));	
				$this->session->set_flashdata('msg_success','Setting is updated successfully');
			}
			if($this->input->post('newslettor_email')){
				$this->common_model->update('web_info', array('meta_data'=>$this->input->post('newslettor_email')), array('meta_key'=>'newslettor_email'));	
				$this->session->set_flashdata('msg_success','Setting is updated successfully');
			}
			if($this->input->post('fb_link')){
				$this->common_model->update('web_info', array('meta_data'=>$this->input->post('fb_link')), array('meta_key'=>'fb_link'));	
				$this->session->set_flashdata('msg_success','Setting is updated successfully');
			}
			if($this->input->post('google_link')){
				$this->common_model->update('web_info', array('meta_data'=>$this->input->post('google_link')), array('meta_key'=>'google_link'));	
				$this->session->set_flashdata('msg_success','Setting is updated successfully');
			}
			if($this->input->post('twittor_link')){
				$this->common_model->update('web_info', array('meta_data'=>$this->input->post('twittor_link')), array('meta_key'=>'twittor_link'));	
				$this->session->set_flashdata('msg_success','Setting is updated successfully');
			}
			if($this->input->post('instagram_link')){
				$this->common_model->update('web_info', array('meta_data'=>$this->input->post('instagram_link')), array('meta_key'=>'instagram_link'));	
				$this->session->set_flashdata('msg_success','Setting is updated successfully');
			}
			if($this->input->post('pinterest_link')){
				$this->common_model->update('web_info', array('meta_data'=>$this->input->post('pinterest_link')), array('meta_key'=>'pinterest_link'));	
				$this->session->set_flashdata('msg_success','Setting is updated successfully');
			}
			if($this->input->post('contact_name')){
				$this->common_model->update('web_info', array('meta_data'=>$this->input->post('contact_name')), array('meta_key'=>'contact_name'));	
				$this->session->set_flashdata('msg_success','Setting is updated successfully');
			}
			if($this->input->post('contact_email')){
				$this->common_model->update('web_info', array('meta_data'=>$this->input->post('contact_email')), array('meta_key'=>'contact_email'));	
				$this->session->set_flashdata('msg_success','Setting is updated successfully');
			}
			if($this->input->post('contact_address')){
				$this->common_model->update('web_info', array('meta_data'=>$this->input->post('contact_address')), array('meta_key'=>'contact_address'));	
				$this->session->set_flashdata('msg_success','Setting is updated successfully');
			}
			if($this->input->post('contact_number')){
				$this->common_model->update('web_info', array('meta_data'=>$this->input->post('contact_number')), array('meta_key'=>'contact_number'));	
				$this->session->set_flashdata('msg_success','Setting is updated successfully');
			}
			if($this->input->post('outside_contact_number')){
				$this->common_model->update('web_info', array('meta_data'=>$this->input->post('outside_contact_number')), array('meta_key'=>'outside_contact_number'));	
				$this->session->set_flashdata('msg_success','Setting is updated successfully');
			}
			if($this->input->post('outside_contact_number_country')){
				$this->common_model->update('web_info', array('meta_data'=>$this->input->post('outside_contact_number_country')), array('meta_key'=>'outside_contact_number_country'));	
				$this->session->set_flashdata('msg_success','Setting is updated successfully');
			}
			redirect('superadmin/superadmin/setting');
		}
		$data['setting'] = $this->common_model->get_result('web_info', array());
		$data['template']='superadmin/setting';
		$this->load->view('templates/superadmin_template', $data);
	}		
	/*change super admin password*/
	public function change_password(){
		$this->_check_login(); //check login authentication
		$data['title']='change_password';
		$this->form_validation->set_rules('oldpassword', 'old password', 'trim|required|callback_password_check');
		$this->form_validation->set_rules('newpassword', 'new password', 'trim|required|min_length[6]|matches[confpassword]');
		$this->form_validation->set_rules('confpassword','confirm password', 'trim|required');
		$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
		if ($this->form_validation->run() == TRUE){
			$salt = salt();
			$user_data  = array('salt'=>$salt,'password' => sha1($salt.sha1($salt.sha1($this->input->post('newpassword')))));
			$id =superadmin_id();
			if($this->common_model->update('admin_users',$user_data,array('id'=>$id))){
				$this->session->set_flashdata('msg_success','Password updated successfully');
			}else{
				$this->session->set_flashdata('msg_error','Update failed, please try again.');			
			}
		}
		$data['template']='superadmin/change_password';
		$this->load->view('templates/superadmin_template',$data);
	}
	/*check superadmin password*/
	public function password_check($oldpassword){		
		$user_info = $this->common_model->get_row('admin_users',array('id'=>superadmin_id()));
		$salt = $user_info->salt;
		if($this->common_model->password_check(array('password'=>sha1($salt.sha1($salt.sha1($oldpassword)))),superadmin_id())){
			return TRUE;
		}else{
			$this->form_validation->set_message('password_check', 'The %s does not match.');
			return FALSE;
		}
	}	
	/*active and deactive */ 
  	public function changeStatus($table='', $title='', $id='', $status='', $message='', $key='id',$column='status',$permanentDelete=''){ 
		if(preg_match('/^\d+$/', $id)){ 
			if(!empty($status)&&$status==3&&!empty($permanentDelete)){
				$this->common_model->delete($table, array($key => $id)); 
		      	$this->session->set_flashdata('msg_success', $title.' is '.urldecode($message).' successfully');         
			}else if(!empty($column)){				
		      	$update = $this->common_model->update($table, array($column=>$status), array($key => $id)); 
		      	$this->session->set_flashdata('msg_success', ucfirst(urldecode($title)).' is '.urldecode($message).' successfully');
			}else{
				$update = $this->common_model->update($table, array('status'=>$status), array($key => $id));
			}
		    redirect($_SERVER['HTTP_REFERER']);            
		}else{
		    redirect(ADMIN_URL.'superadmin/error_404');
		}
  	} 
  	/*upload images*/
    public function uploadPics() {
        $array = array('statuss' => 'false', 'message' => '');
        $this->form_validation->set_rules('user_img', '', 'callback_uploadFile');       
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            $userdata = array();
            if ($this->session->userdata('uploadFile') != '') {
                $user_image_check = $this->session->userdata('uploadFile');
                $this->session->unset_userdata('uploadFile'); 
                $fileHtml = !empty($user_image_check['file_path'])?'<div class="image_li">
                				<img src="'.$user_image_check['file_path'].'" class="img_banner thumimgs"/>
                		 	</div>':'';
                $fileNames = explode('.', $user_image_check['file_path']);
                $fileNames = end($fileNames);
                $fileNames = strtolower($fileNames);
                $imgKey    = rand(111, 999).time().rand(111, 999);
                $fileHtml  = '<div class="image_li" id="'.$imgKey.'">';
                if(!empty($fileNames)&&($fileNames=='png'||$fileNames=='jpeg'||$fileNames=='jpg')){
                    $fileHtml .= '<img src="'.$user_image_check['file_path'].'" class="img_banner thumimgs"/>';
                }else if(!empty($fileNames)&&($fileNames=='pdf'||$fileNames=='mp4')){ 
                    $fileHtml .= '<iframe src="'.$user_image_check['file_path'].'" width="230"></iframe>';
                } else if(!empty($fileNames)&&($fileNames=='doc'||$fileNames=='docx')){
                    $fileHtml .= '<a href="'.$user_image_check['file_path'].'"><img src="'.base_url('assets/front/images/word-download.png').'"/></a>';
                } 
                if($this->input->post('multiPleImg')){
                	$fun = "deleteImages('".$imgKey."','".$user_image_check['user_img']."');";
                	$fileHtml .= '<a href="javascript:void(0);" onclick="'.$fun.'" class="btn btn-sm btn-danger deleteSchoolImg">
                        			<i class="fa fa-trash" aria-hidden="true"></i>
                      			 </a>';
                }
                $fileHtml .= '</div>';
                $thumb_pathHtml = !empty($user_image_check['thumb_path'])?' <div class="image_li"><img src="'.$user_image_check['thumb_path'].'" class="img_banner thumimgs"/>
                		 			</div>':'';
                $array      = array('statuss'		 => 'true', 
                				    'message' 		 => 'Image is uploaded', 
                				    'file_name' 	 => $user_image_check['user_img'], 
                				    'fileHtml' 		 => $fileHtml, 
                				    'thumb_pathHtml' => $thumb_pathHtml
                					);                
            }
        } else {
            $array = array('statuss' => 'false', 'message' => form_error('user_img'));
        }
        echo json_encode($array);
    }
    public function deleteImgs() {
    	$arry = array();
    	if($this->input->post('files_name')){
    		if(strpos($this->input->post('files_name'), ',')>0){    			
	    		$files = explode(',', $this->input->post('files_name')); 
	    		$arry = array_diff($files, array($this->input->post('img')));
    		}
    	}
    	if($this->input->post('imageID')){
    		$this->common_model->delete('images', array('id'=>$this->input->post('imageID')));
    	}
    	echo implode(',', $arry);
    }
    public function uploadFileEditor() {
         if(!file_exists('uploads/blogs'))
       {
       	mkdir('uploads/blogs',0777,true);
       }
       if(!file_exists('uploads/blogs/thumbnails'))
       {
       	mkdir('uploads/blogs/thumbnails',0777,true);
       }
    	 $dataRes = array('status'=>'false','message'=>'');
    	$config['allowed_types']    = 'jpeg|jpg|png';
        $config['max_size']         = '7024';
        $config['max_width']        = '3000';
        $config['max_height']       = '3000';
        $config['upload_path']      = 'uploads/blogs/';   
        $config['encrypt_name']     = TRUE;
        $new_name                   = 'image_' . substr(md5(rand()), 0, 7) . $_FILES["user_img"]['name'];
        $config['file_name']        = $new_name;            
        $this->load->library('upload', $config);
        $this->upload->initialize($config);
        if (!$this->upload->do_upload('user_img')) {
            $dataRes = array('status'=>'false','message'=>$this->upload->display_errors());
        } else {
            $data                               = $this->upload->data(); // upload image
            $config_img_p['source_path']      = 'uploads/blogs/';   
	    	$config_img_p['destination_path'] = 'uploads/blogs/thumbnails/';
            $config_img_p['width']              = '250';
            $config_img_p['height']             = '250';
            $config_img_p['file_name']          = $data['file_name'];
            $status                             = create_thumbnail($config_img_p);
            $uploadFile = array('user_img' => $data['file_name']);
            if(!empty($config_img_p['source_path'])&&!empty($data['file_name'])&&!empty($config_img_p['destination_path'])){
            	$file_path  = base_url().$config_img_p['source_path'].$data['file_name'];
            	$dataRes = array('status'=>'true','location' => $file_path);
            }
        }
    	echo json_encode($dataRes);
    }
    public function uploadFile($str) {
    	//print_r($_POST); exit();
    	if (empty($_FILES['user_img']['name'])) {
            $this->form_validation->set_message('uploadFile', 'Choose file');
            return FALSE;
        }
        if (!empty($_FILES['user_img']['name'])) {
	    	$new_name    = explode('.', $_FILES['user_img']['name']);
	        $new_name    = end($new_name);
	        $new_nameext = strtolower($new_name);
	        //echo $new_nameext; exit();
	    }
    	if($this->input->post('isImage')&&$this->input->post('isImage')==2){
    		$allowed = array("application/pdf");        		        
	        if (!in_array($_FILES['user_img']['type'], $allowed)) {
	            $this->form_validation->set_message('uploadFile', 'Only pdf files are allowed');
	            return FALSE;
	        }
            $config['allowed_types']    = 'pdf';
            $config['max_size']         = '7024';
    	}else if(!empty($new_nameext)&&($new_nameext=='png'||$new_nameext=='jpeg'||$new_nameext=='jpg')){
        	$allowed = array("image/jpeg", "image/jpg", "image/png");
        	$width   = 50; 
	        $height  = 50;	        
	        if (!in_array($_FILES['user_img']['type'], $allowed)) {
	            $this->form_validation->set_message('uploadFile', 'Only jpg, jpeg, and png files are allowed');
	            return FALSE;
	        }
	        $image = getimagesize($_FILES['user_img']['tmp_name']);
	        if ($image[0] < $width || $image[1] < $height) {
	            $this->form_validation->set_message('uploadFile', 'Oops! Your logo needs to be atleast '.$width.' x '.$height.' pixels');
	            return FALSE;
	        }
	        if ($image[0] > 3000 || $image[1] > 3000) {
	            $this->form_validation->set_message('user_image_check', 'Oops! Your logo needs to be maximum of 3000 x 3000 pixels');
	            return FALSE;
	        }
	        $config['allowed_types']    = 'jpeg|jpg|png';
            $config['max_size']         = '7024';
            $config['max_width']        = '3000';
            $config['max_height']       = '3000';
    	}else{
    		$allowed = array("image/jpeg", "image/jpg", "image/png", "image/png", "image/png","application/pdf", "application/x-download","application/msword","application/octet-stream","application/vnd.openxmlformats-officedocument.wordprocessingml.document");
            $config['allowed_types']    = 'jpeg|jpg|png|pdf|doc|docx|mp4';
            $config['max_size']         = '7024';
    	}   
    	if($this->input->post('fileUpload')){
    		$config['upload_path']      = 'uploads/'.$this->input->post('fileUpload').'/';   
    	}else{
    		$config['upload_path']      = 'uploads/';   
    	}
        if (!empty($_FILES['user_img']['name'])):
            $config['encrypt_name']     = TRUE;
            $new_name                   = 'image_' . substr(md5(rand()), 0, 7) . $_FILES["user_img"]['name'];
            $config['file_name']        = $new_name;            
            $this->load->library('upload', $config);
            $this->upload->initialize($config);
            if (!$this->upload->do_upload('user_img')) {
                $this->form_validation->set_message('uploadFile', $this->upload->display_errors());
                return FALSE;
            } else {
                $data                               = $this->upload->data(); // upload image
                if($this->input->post('fileUpload')){
		    		$config_img_p['source_path']      = 'uploads/'.$this->input->post('fileUpload').'/';   
		    		$config_img_p['destination_path'] = 'uploads/'.$this->input->post('fileUpload').'/thumbnails/';
		    	}else{
		    		$config_img_p['source_path']        = 'uploads/';
                	$config_img_p['destination_path']   = 'uploads/thumbnails/';  
		    	}
                if(!empty($new_nameext)&&($new_nameext=='png'||$new_nameext=='jpeg'||$new_nameext=='jpg')){   
	                $config_img_p['width']              = '250';
	                $config_img_p['height']             = '250';
	                $config_img_p['file_name']          = $data['file_name'];
	                $status                             = create_thumbnail($config_img_p);
	            }
	            $uploadFile = array('user_img' => $data['file_name']);
	            if(!empty($config_img_p['source_path'])&&!empty($data['file_name'])&&!empty($config_img_p['destination_path'])){
	            	$uploadFile['file_path']   = base_url().$config_img_p['source_path'].$data['file_name'];
	            	$uploadFile['thumb_path']  = base_url().$config_img_p['destination_path'].$data['file_name'];
	            }
                $this->session->set_userdata('uploadFile', $uploadFile);
                return TRUE;
            } else:
                $this->form_validation->set_message('uploadFile', 'The %s field required.');
                return FALSE;
            endif;

    }
    /*change user status*/
	public function VerifyUserEmail($id="")	{
		$this->_check_login(); //check login authentication
		$user = $this->common_model->get_row('users', array('id'=>$id));
		$activationcode = rand().time();
		$linkUrl 		= base_url('home/activateAccount/'.$activationcode);				
		if($_SERVER['HTTP_HOST']!='www.localhost'){   			
            /****************** activation mail to customer *******************/
            $email_template = $this->cimail_email->get_email_template('account_verification');
            $param = array(
                        'template'      => array(
                        'temp'          => $email_template->template_body,
                        'var_name'      => array(
                                                'name'            => $user->first_name.' '.$user->last_name,
                                                'site_url'        =>  base_url(),   
                                                'site_name'       =>  site_info('site_name_not_http'),    
                                                'site_logo'       =>  base_url().'assets/front/images/logo.png',   
                                                'activation_link' =>  $linkUrl,                 
                                                ), 
                        ),      
                'email' =>  array(
                                'to'        =>  $user->email,
                                'from'      =>  site_info('mail_from_email'),
                                'from_name' =>  site_info('mail_from_name'),
                                'subject'   =>  $email_template->template_subject,
                                )
            ); 
            $status = $this->cimail_email->send_mail($param); 
        }	
		$this->common_model->update('users', 
								array('activation_code'=>$activationcode) ,
								array('id'=>$id)
							);	
		$this->session->set_flashdata('msg_success', 'User email verification email is sent successfully');
		redirect($_SERVER['HTTP_REFERER']);
	} 
	public function changeVerifyStatus($id="")	{
		$this->_check_login(); //check login authentication
		if($this->common_model->update('users', array('is_email_verify'=>1), array('id'=>$id)))
		$this->session->set_flashdata('msg_success','User email verification status is updated successfully');
		redirect($_SERVER['HTTP_REFERER']);
	} 
	/*if page and data is not available in superadmin section show this page*/
	function error_404(){     
      $data['template']='superadmin/404';  
      $this->load->view('templates/superadmin_template',$data); 
    }    
}