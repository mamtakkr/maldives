<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*this controller for making login all users*/
class Login extends CI_Controller {
	public function __construct(){
        parent::__construct();
        clear_cache();  
    } 
 	/*redirect login page */
	public function index(){
		$this->login();
	}
	/*login page load*/
	public function login(){
		if(superadmin_logged_in()===TRUE) 
			redirect(ADMIN_URL.'superadmin/dashboard');	
		$data['title']  = 'Login';
		$this->load->view(ADMIN_DIR.'login');
	}
	/*check login user name and password and  login user */
	public function login_new(){
		
		$loginResponce = array();					
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');
		$this->form_validation->set_rules('password', 'password', 'required');
		if ($this->form_validation->run() == TRUE){
			$email    = $this->input->post('email');
			$password = $this->input->post('password');
			if($this->common_model->login($email, $password)){
				if(superadmin_logged_in()){
					$loginResponce = array( 'status' 		=> 'true',
											'message'   	=> 'Your Login successfully.',
											'redirect_url' 	=> ADMIN_URL.'superadmin/dashboard'
										   );
				}else{
					$loginResponce = array('status'   => 'false',
						 					'message' => 'Your account is blocked  by admin,<br/> please contact to admin.'
										);
				}
			}else{
				$loginResponce = array('status'  => 'false',
									   'message' => 'Incorrect Email or Password.'
									  );
			}
		}else{
			$loginResponce = array('status'   => 'false',
								   'message'  => 'The email is invalid.'
						          );
		}		
		echo json_encode($loginResponce);
	}
	/*create new password for parents and teacher*/
	public function userNewPassword(){ 
		$this->form_validation->set_rules('password', 'New Password', 'trim|min_length[6]|required');	
		$this->form_validation->set_rules('confirmPassword', 'Confirm Password', 'trim|required|min_length[6]|matches[password]');
		if ($this->form_validation->run() == TRUE){ 
			$salt = $this->salt();
			$user_data  = array('salt'=>$salt,
								'password' => sha1($salt.sha1($salt.sha1($this->input->post('password')))),

								 'webOtp'=>''

								);
			$id = user_id();
			if($this->common_model->update('users', $user_data,array('id'=>$id))){
				$this->session->set_flashdata('msg_success','Password updated successfully.');
				redirect('users/user/dashboard');
			}else{
				$this->session->set_flashdata('msg_error','Update failed, please try again.');	
			}
		} 
	  	$this->load->view(ADMIN_DIR.'newPassword');
	}
    /*send mail for admin and ecosystem forgot Email*/ 

    public function sendForgotPasswordMail(){
    	$this->form_validation->set_rules('forgotEmail', 'Email', 'trim|required|valid_email');
    	if ($this->form_validation->run() == TRUE){
        	$forgotEmail = $this->input->post('forgotEmail');
       		$user = $this->common_model->get_row('admin_users', array('email' =>$forgotEmail),array('id','email','first_name')); 
           	if($user){
           	  	$activationCode = substr(time().$user->id,-6);
           	  	if($this->common_model->update('admin_users',array('activationCode'=>$activationCode), array('id'=>$user->id))){
           	  		/*$this->load->library('chapter247_email');
			        $subject = $this->common_model->get_row('email_templates',array('id'=>3));
			        $link= base_url().'login/reset_password/'.$activationCode; 
			        $email_template=$this->chapter247_email->get_email_template(2);
			        $site_url = "<a href=".base_url()." target='_blank'>".SITE_NAME."</a>";
			        $param=array(
			        'template'  =>  array(
			                        'temp'  =>  $email_template->template_body,
			                        'var_name'  =>  array(
			                        'name'  => $user->first_name,
			                        'activation_key'  =>  $link,
			                        'site_url' =>  $site_url,   
			                        ), 
			        ),          
			        'email' =>  array(
			                'to'        =>   $user->email,
			                'from'      =>   NO_REPLY,
			                'from_name' =>   NO_REPLY_EMAIL_FROM_NAME,
			                'subject'   =>   $email_template->template_subject,
			            )
			        );  
			        $status=$this->chapter247_email->send_mail($param);*/
	           	  	$mailResponse = array('status' =>'true',
	           	  				   'message'=>'Password reset instructions have been sent to <br><strong>'.$user->email.'</strong>.<br> Don’t forget to check your spam'

	           	  				 );         	  	

           	  	}         	  

           }else{
           	 	$mailResponse = array('status' =>'false',
           	  				 		'message'=>'Email does not  exist.'
           	  				 );
           }   
        }else{
 			$mailResponse = array('status' =>'false',
           	  				'message'=>'Please insert a vailid email.'
           	  			);
        }
        echo json_encode($mailResponse);
    } 
    
    
    
    
    
    
    public function sendForgotPasswordMailAdmin(){
    	$mailResponse = array('status' =>'false', 'message'=>'The email is invalid');

    	$this->form_validation->set_rules('forgot_email', 'Email', 'trim|xss_clean|required|valid_email');

    	if ($this->form_validation->run() == TRUE){

        	$forgotEmail = $this->input->post('forgot_email', TRUE); 

        	$user 	= $this->common_model->get_row('admin_users', array('email' =>$forgotEmail),array('id','email','first_name')); 

           if($user){

           	  $activationCode = substr(time().$user->id,-6);

           	  if($this->common_model->update('admin_users',array('activation_code'=>$activationCode), array('id'=>$user->id))){

           	  	$mailResponse = array(

           	  						'status' =>'true',

		           	  				'message'=>'A password reset link will be sent to your email.'

		           	  				);	

           	  	$linkUrl 		=  base_url().'admin/login/reset_password_admin/'.$activationCode;  //base_url('login/reset_password/'.$activationCode);

				$email_template = $this->cimail_email->get_email_template('forgot_password');

				$param = array(

				            'template'  => array(

				            'temp'      => $email_template->template_body,

				            'var_name'  => array(

			                                    'name' => $user->first_name,

			                                    'forgot_password_link' =>  $linkUrl,

			                                    'site_name' => site_info('site_name_not_http'),

			                                    'site_logo' => base_url().'assets/front/images/logo.png',

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

           }else{

           	 	$mailResponse = array('status' =>'false',

		           	  				 'message'=>'Email does not  exist.'

		           	  				 );

           }

        }              		

        echo json_encode($mailResponse);

    }
    
    
    
    
    
    
    
    
    
    
    
    
    /*update a new password for admin*/
   	public function reset_password($activation_key=''){  
      	$data['title'] 	= 'Reset password';  
      	if(empty($activation_key)){ redirect('login'); }
      	if(!empty($activation_key)){
      	    
      		$user = $this->common_model->get_row('admin_users',array('activation_code'=>trim($activation_key)));
      		
	      	if(empty($user)){
	          	$this->session->set_flashdata('msg_error','Your activation key expired.');
	          	redirect(ADMIN_DIR.'login');
	       	} 
	       	$data['user'] 	= $user;
      	}
      	
      	$this->form_validation->set_rules('password', 'New Password', 'trim|required|min_length[6]|matches[confpassword]');
      	$this->form_validation->set_rules('confpassword','Confirm Password', 'trim|required');
      	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      	if ($this->form_validation->run() == TRUE){
          	$user = $this->common_model->get_row('admin_users',array('activation_code'=>trim($activation_key)));
          
          	if(empty($user)){
              	$this->session->set_flashdata('msg_error','Your activation key expired.');
              	redirect(ADMIN_DIR.'login');
            }
            $salt = salt();
		    $user_data  = array('salt'=>$salt,
								'password' => sha1($salt.sha1($salt.sha1($this->input->post('password')))),
								'activation_code'=>''
								);
            if($this->common_model->update('admin_users',$user_data,array('id'=>$user->id))){
                $this->session->set_flashdata('msg_success','Your Password has reset successfully <br/> now you can Login.');
                redirect(ADMIN_DIR.'login');
            }
      	} 
      	
      	$this->load->view(ADMIN_DIR.'admin_new_password', $data);
    }
    
    
    

    public function reset_password_admin($activation_key=''){   

      	$data['title']   = 'Reset password';  

      	if(empty($activation_key)){ redirect(base_url('admin/login?actType=forgotPassword')); }

      	if(!empty($activation_key)){

	      	$user 			= $this->common_model->get_row('admin_users', array('activation_code'=>trim($activation_key)));

	      	$data['user'] 	= $user;

	      	if($user==FALSE){

	          	$this->session->set_flashdata('msg_error','Your activation key expired.');

	          	redirect(base_url('admin/login?actType=forgotPassword'));

	       	} 

    	}

      $data['template'] 		= 'superadmin/admin_new_password';

	  $this->load->view('templates/frontend_template', $data);
    //   	$this->load->view(ADMIN_DIR.'admin_new_password', $data);

    }
    
    

    public function reset_password_res(){ 

    	$array 	  = array('status'=>'false', 'message'=>'');

		$this->form_validation->set_rules('password', 'New Password', 'trim|required|xss_clean|min_length[6]|matches[confirm_password]');

        $this->form_validation->set_rules('confirm_password','Confirm Password', 'trim|xss_clean|required');

    //   	$this->form_validation->set_rules('user_token','', 'trim|xss_clean|callback_check_token');

      	$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

      	if ($this->form_validation->run() == TRUE){
      	    
      		$user_id 	= base64_decode($this->input->post('user_token'));

            $salt 	 	= salt();

		    $user_data  = array('salt'=>$salt,

								'password' => sha1($salt.sha1($salt.sha1($this->input->post('password', TRUE)))),

								'activation_code'=>''

								);

            if($this->common_model->update('admin_users', $user_data, array('id'=>$user_id))){

            	$array 	  = array('status'=>'true', 'message'=>'Password is updated successfully');             	

            }else{

            	$array 	  = array('status'=>'false', 'message'=>'Password did not update, try again'); 

            }

      	}else{  

      		$array 	  = array('status'=>'false', 'message'=>validation_errors());

      	}

      	echo json_encode($array);

    } 

    
    
    
	/*if url is missing, redirect this funcation*/
	function error_404(){     
      	$this->load->view('error_404'); 
    }
}