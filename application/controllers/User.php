<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*this controller for making user section*/
class User extends CI_Controller {
    public function __construct(){
        parent::__construct();
        clear_cache();
        if(!user_logged_in()){ 
            redirect(base_url('login'));
        }
    } 
    /****************  user  section ***********************/
    public function index(){ 
       $this->dashboard();
    } 
    /*show user dashboard  */  
    public function dashboard($offset=NULL){
        $user = user_info(); 
		if(!empty($user->user_type)&&$user->user_type=='2'){
            $data               = $this->resort_filter_list($offset);
            $data['user']       = $user;
            $data['storys']     = $this->developer_model->get_traveller_stories_list();              
            $data['activities'] = $this->developer_model->get_activities(array(), PER_PAGE_ACTIVITY);
            $data['activity_count'] = $this->developer_model->get_activities();
            $data['user_type']  = '2';
            $data['template']   = 'frontend/hotel_dashboard';
        }else if(!empty($user->user_type)&&$user->user_type=='3'){
            $data['user']       = $user;
            $data['storys']     = $this->developer_model->get_traveller_stories_list();
            $data['user_type']  = '3'; 
            $data['template']   = 'frontend/subadmin_dashboard';
        }else{ 
            $data               = $this->favorites_resort_filter_list($offset);
            $data['user']       = $user;
            $data['storys']     = $this->developer_model->get_contributions();
            $data['activities'] = $this->developer_model->get_activities(array(), PER_PAGE_ACTIVITY);
            if($this->input->get('type')&&$this->input->get('type')=='add_story'){
                $data['users']       = $this->common_model->get_result('users', array('status'=>'1', 'id !='=>user_id()));      
                $data['categorys']   = $this->common_model->get_result('traveller_categorys', array('status'=>'1'));      
                $data['hear_by']     = $this->common_model->get_result('hear_by', array('status'=>'1'));      
                $data['resorts']     = $this->common_model->get_result('resorts', array('status'=>'1', 'user_id'=>user_id())); 
            }
            $data['countrys']   = $this->common_model->get_result('countries');
            $data['user_type']  = '1';
            $data['template']   = 'frontend/user_dashboard';
        }
        if($this->input->get('blog_id')){
            $blog_id      = base64_decode($this->input->get('blog_id'));
            $data['blog'] = $this->common_model->get_row('news_blog', array('id'=>$blog_id));
            $imgArr = array('type'=>'blog', 'item_id' =>$blog_id); 
            $data['blog_images'] = $this->common_model->get_result('images', $imgArr, array(), array('id', 'asc'));
        }
        if($this->input->get('admin_id')){
            $admin_id         = base64_decode($this->input->get('admin_id'));
            $data['subadmin'] = $this->common_model->get_row('users', array('id'=>$admin_id));
        }
        $this->load->view('templates/frontend_template', $data);
    }     
    public function sub_admin_list() {
        $data               = array();    
        $data['sub_admins'] = $this->developer_model->get_user_sub_admins_list();
        $this->load->view('frontend/sub_admins', $data);
    }
    public function read_activities() {
        $this->common_model->update('guest_activities', array('read_status'=>1), array('notified_user'=>user_id(), 'read_status'=>0));
    }
    public function read_favorites() {
        $this->common_model->update('resorts_likes', array('read_status'=>1), array('user_id'=>user_id(), 'read_status'=>0));
    }
    public function read_traveller_stories() {
        $this->common_model->update('traveller_stories', array('read_status'=>1), array('owner_id'=>user_id(), 'read_status'=>0));
    }    
    public function add_sub_admin_res() {
        //print_r($_POST); exit();
        $loginResponce = array();
        $this->form_validation->set_rules('hotel_name', 'sub admin name', 'required');
        if($this->input->post('old_email')&&$this->input->post('email')&&$this->input->post('old_email')==$this->input->post('email')){
            $this->form_validation->set_rules('email', 'email', 'required|valid_email');
        }else{
            $this->form_validation->set_rules('email', 'email', 'required|valid_email|callback_emailChecked');
        }
        $this->form_validation->set_rules('password', 'password', 'min_length[6]');
        if ($this->form_validation->run() == TRUE) {
            if($this->input->post('password', TRUE)){                
                $activationcode = rand(111,999).time().rand(111,999);
                $newSalt        = salt();
                $password       = passwordGenrate($this->input->post('password', TRUE), $newSalt);
            }
            $signup = array(); 
                $signup['country_id'] = '134';
            if ($this->input->post('hotel_name')) 
                $signup['first_name'] = $this->input->post('hotel_name', TRUE);
            if($this->input->post('email', TRUE))
                $signup['email'] = $this->input->post('email', TRUE); 
            $signup['user_type'] = 3;
            $signup['parent_id'] = user_id();
            if($this->input->post('password', TRUE)){
                $signup['activation_code']  = $activationcode;
                $signup['password']         = $password;
                $signup['salt']             = $newSalt;
                $signup['is_email_verify']  = 0; 
                $signup['created_date']     = date('Y-m-d H:i:s');            
            } 
            if($this->input->post('admin_id')){
                $this->common_model->update('users', $signup, array('id'=>$this->input->post('admin_id')));
                $user_id = $this->input->post('admin_id');
                $loginResponce  = array('status'   => 'true', 
                                        'message'  => 'Sub admin is updated successfully'
                                    );
            }else{
                $user_id = $this->common_model->insert('users', $signup);
                if(!empty($user_id)){
                    $linkUrl = base_url('home/activateAccount/' . $activationcode);
                    if($_SERVER['HTTP_HOST']!='www.localhost'){   
                        /***** activation mail to customer ***********/
                        $email_template = $this->cimail_email->get_email_template('account_verification');
                        $param = array(
                                    'template'      => array(
                                    'temp'          => $email_template->template_body,
                                    'var_name'      => array(
                                                            'name'            => $this->input->post('hotel_name', TRUE),
                                                            'site_url'        =>  base_url(),   
                                                            'site_name'       =>  site_info('site_name_not_http'),    
                                                            'site_logo'       =>  base_url().'assets/front/images/logo.png',   
                                                            'activation_link' =>  $linkUrl              
                                                            ), 
                                    ),      
                            'email' =>  array(
                                            'to'        => $this->input->post('email', TRUE),
                                            'from'      => site_info('mail_from_email'),
                                            'from_name' => site_info('mail_from_name'),
                                            'subject'   => $email_template->template_subject,
                                            )
                        ); 
                        //print_r($param); exit();
                        $status = $this->cimail_email->send_mail($param); 
                    }
                    $loginResponce  = array('status'   => 'true', 
                                            'message'  => 'Your registration is successful, activation link has been sent to your registered email do not forget check in spam'
                                        );
                }else{
                    $loginResponce = array('status' => 'true', 'message' => "Registration failed, try again");
                }
            }           
        } else {
            $loginResponce = array('status' => 'false', 'message' => validation_errors());
        }
        echo json_encode($loginResponce);
    }
    public function read_more_activity() {  
        $response         = array('status'=>'true');  
        $offset           = ($this->input->get('page_num'))?$this->input->get('page_num'):0;  
        $data['activities'] = $this->developer_model->get_activities(array(), PER_PAGE_ACTIVITY, $offset);
        //echo $this->db->last_query(); exit();
        $html = $this->load->view('frontend/activity_list', $data, TRUE);    
        $response['html']        = $html;
        echo json_encode($response);   
    } 
    public function story_list() { 
        $data['storys']   = $this->developer_model->get_traveller_stories_list();
        $data['template'] = 'frontend/story_list';
        $this->load->view('templates/frontend_template', $data);
    }  
    public function resort_story_list() { 
        $data['storys']   = $this->developer_model->get_resort_stories_list();
        $data['template'] = 'frontend/resort_story_list';
        $this->load->view('templates/frontend_template', $data);
    } 
    public function contributions() { 
        $data['storys']   = $this->developer_model->get_contributions();
        $data['template'] = 'frontend/contributions';
        $this->load->view('templates/frontend_template', $data);
    } 
    public function user_activity_list(){
        $data    = array();
        $get     = $_GET;
        $limit   = isset($_GET['length']) ? $_GET['length'] : 10;
        $offset  = isset($_GET['start']) ? $_GET['start'] : 0;
        $results = $this->developer_model->get_activities($get, $limit, $offset);
        $total   = $this->developer_model->get_activities($get, 0, 0);
        $output  = array(
                        "sEcho" => isset($_GET['sEcho']) ? intval($_GET['sEcho']) : 0,
                        "iTotalRecords" => $total,
                        "iTotalDisplayRecords" => $total,
                        "aaData" => array()
                    );
        if ($results) {
            $counter = $offset + 1;
            foreach ($results['res'] as $activity) {
                $row = array();
                $user_name  = "";
                $user_name .= !empty($activity->first_name)?$activity->first_name:"";
                $user_name .= !empty($activity->last_name)?" ".$activity->last_name:"";
                $row[]      = $counter;
                $row[]      = $user_name;                
                switch ($activity->type) {
                    case 'resorts_like':
                        $row[]  = "Like resort";
                        $row[]  = $user_name.' liked this resort : <a href="'.base_url().'resort-detail?resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break;
                    case 'resorts_unlike':
                        $row[]  = "Unlike resort";
                        $row[]  = $user_name.' unliked this resort : <a href="'.base_url().'resort-detail?resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break; 
                    case 'accommodation_like':
                        $row[]  = "Like villa";
                        $row[]  = $user_name.' liked this villa : <a href="'.base_url().'resort-detail?type=accommodations_likes&resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break;
                    case 'accommodation_unlike':
                        $row[]  = "Unlike villa";
                        $row[]  = $user_name.' unliked this villa : <a href="'.base_url().'resort-detail?type=accommodations_likes&resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break; 
                    case 'dining_like':
                        $row[]  = "Like dine & wine";
                        $row[]  = $user_name.' liked this dine & wine : <a href="'.base_url().'resort-detail?type=dinnings&resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break;
                    case 'dining_unlike':
                        $row[]  = "Unlike dine & wine";
                        $row[]  = $user_name.' unliked this dine & wine : <a href="'.base_url().'resort-detail?type=dinnings&resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break;
                    case 'traveller_story_like':
                        $row[]  = "Like Traveller Story";
                        $row[]  = $user_name.' liked this traveller story : <a href="'.base_url().'resort-detail?type=reviews&resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break; 
                    case 'traveller_story_unlike':
                        $row[]  = "Unlike Traveller Story";
                        $row[]  = $user_name.' unliked this traveller story : <a href="'.base_url().'resort-detail?type=reviews&resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break;
                    case 'traveller_story_share':
                        $row[]  = "Share Traveller Story";
                        $row[]  = $user_name.' shared this traveller story on '.$activity->socail_type.' : <a href="'.base_url().'resort-detail?resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break;
                    case 'traveller_story':
                        $row[]  = "Post Traveller Story";
                        $row[]  = $user_name.' posted a traveller story : <a href="'.base_url().'resort-detail?type=reviews&resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break;  
                    case 'traveller_stories_comment':
                        $row[]  = "Comment On Traveller Story";
                        $row[]  = $user_name.' commented a traveller story : <a href="'.base_url().'resort-detail?type=reviews&resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break;
                    case 'resort_story_like':
                        $row[]  = "Like Resort Story";
                        $row[]  = $user_name.' liked this resort story : <a href="'.base_url().'resort-detail?resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break; 
                    case 'resort_story_unlike':
                        $row[]  = "Unlike Resort Story";
                        $row[]  = $user_name.' unliked this resort story : <a href="'.base_url().'resort-detail?type=resort_story_comment&resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break;
                    case 'resort_story_share':
                        $row[]  = "Share Resort Story";
                        $row[]  = $user_name.' shared this resort story on '.$activity->socail_type.' : <a href="'.base_url().'resort-detail?type=resort_story_comment&resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break;
                    case 'resort_story':
                        $row[]  = "Post Resort Story";
                        $row[]  = $user_name.' posted a resort story : <a href="'.base_url().'resort-detail?type=resort_story_comment&resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break; 
                    case 'resort_stories_comment':
                        $row[]  = "Comment On Resort Story";
                        $row[]  = $user_name.' commented a resort story : <a href="'.base_url().'resort-detail?type=resort_story_comment&resort_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break;    
                    case 'blog_like':
                        $row[]  = "Like blog";
                        $row[]  = $user_name.' liked this blog : <a href="'.base_url().'blog-detail?type=blog_like&blog_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break; 
                    case 'blog_unlike':
                        $row[]  = "Unlike blog";
                        $row[]  = $user_name.' unliked this blog : <a href="'.base_url().'blog-detail?type=blog_like&blog_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break;
                    case 'blog_share':
                        $row[]  = "Share blog";
                        $row[]  = $user_name.' shared this blog on '.$activity->socail_type.' : <a href="'.base_url().'blog-detail?type=blog_like&blog_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break;
                    case 'blog_comment':
                        $row[]  = "Comment On Blog";
                        $row[]  = $user_name.' commented a blog : <a href="'.base_url().'blog-detail?type=blog_comment&blog_id='.base64_encode($activity->resort_id).'">'.$activity->item_name.'</a>';
                        break;                               
                    default:
                        $row[]  = "";
                        break;
                }
                $row[]      = !empty($activity->created_date) ? date('d F, Y', strtotime($activity->created_date)) : 'NA';   
                $output['aaData'][] = $row;
                $counter++;
            }
        }
        echo json_encode($output);
    }
    public function activity_filter_list($offset=null) {
        $config               = ajax_pagination();
        $config['base_url']   = base_url()."user/user_activity_list"; 
        $config['total_rows'] = $this->developer_model->get_activities(0,0); 
        $config['per_page']   = 10;
        $this->pagination->initialize($config);
        $offSet                     = 0;
        if($offset){
            $offSet   = $config['per_page']*($offset-1);
        } 
        $data['offset']      = $offset;
        $data['total_rows']  = $config['total_rows'];
        $data['per_page']    = $config['per_page'];        
        $data['resorts']     = $this->developer_model->get_activities($offSet, $config['per_page']);
        return $data;
    } 
    /*public function user_activity_list($offset=null) { 
        $data = $this->activity_filter_list($offset);
        $this->load->view('frontend/user_activity_list', $data);
    } */ 
    public function favorites_resort_filter_list($offset=null) {
        $config               = ajax_pagination();
        $config['base_url']   = base_url()."user/favorites_resort_list"; 
        $config['total_rows'] = $this->developer_model->get_favorites_resorts(0,0); 
        $config['per_page']   = 10;
        $this->pagination->initialize($config);
        $offSet                     = 0;
        if($offset){
            $offSet   = $config['per_page']*($offset-1);
        } 
        $data['offset']      = $offset;
        $data['total_rows']  = $config['total_rows'];
        $data['per_page']    = $config['per_page'];        
        $data['resorts']     = $this->developer_model->get_favorites_resorts($offSet, $config['per_page']);
        return $data;
    } 
    public function favorites_resort_list($offset=null) { 
        $data = $this->favorites_resort_filter_list($offset);
        $this->load->view('frontend/favorites_resort_list', $data);
    } 
    public function resort_filter_list($offset=null) {
        $config               = ajax_pagination();
        $config['base_url']   = base_url()."user/user_resort_list"; 
        $config['total_rows'] = $this->developer_model->user_resorts(0,0); 
        $config['per_page']   = 10;
        $this->pagination->initialize($config);
        $offSet                     = 0;
        if($offset){
            $offSet   = $config['per_page']*($offset-1);
        } 
        $data['offset']      = $offset;
        $data['total_rows']  = $config['total_rows'];
        $data['per_page']    = $config['per_page'];        
        $data['resorts']     = $this->developer_model->user_resorts($offSet, $config['per_page']);
        return $data;
    } 
    public function user_resort_list($offset=null) { 
        $data = $this->resort_filter_list($offset);
        $this->load->view('frontend/user_resort_list', $data);
    }  
    public function update_profile_res() {
        //print_r($_POST); exit();
        $loginResponce = array();
        $user = user_info();
        if(!empty($user->user_type)&&$user->user_type==2){
            $this->form_validation->set_rules('hotel_name', 'hotel name', 'required|xss_clean');
        }else if(!empty($user->user_type)&&$user->user_type==3){
            $this->form_validation->set_rules('hotel_name', 'user name', 'required|xss_clean');
        }else{          
            $this->form_validation->set_rules('first_name', 'first name', 'required|xss_clean');
            $this->form_validation->set_rules('last_name', 'last name', 'required|xss_clean');
            $this->form_validation->set_rules('country_id', 'country', 'required|xss_clean');
        }        
        if ($this->form_validation->run() == TRUE) {
            $signup = array();
            if ($this->input->post('hotel_name')) 
                $signup['first_name'] = $this->input->post('hotel_name', TRUE);
            if ($this->input->post('first_name')) 
                $signup['first_name'] = $this->input->post('first_name', TRUE);
            if ($this->input->post('last_name')) 
                $signup['last_name'] = $this->input->post('last_name', TRUE);
            if ($this->input->post('country_id')) 
                $signup['country_id'] = $this->input->post('country_id', TRUE);
            if($this->common_model->update('users', $signup, array('id'=>user_id()))){
                $loginResponce  = array(
                                        'status'   => 'true', 
                                        'message' => 'Your profile is updated successfully',
                                    );
            }else{
                $loginResponce = array('status' => 'false', 'message' => "Profile is not updated");
            }
        } else {
            $loginResponce = array('status' => 'false', 'message' => validation_errors());
        }
        echo json_encode($loginResponce);
    }
    public function change_password_res(){
        //print_r($_POST); exit();
        $ajaxResponce = array('status'   => 'false','message' => '');   
        $this->form_validation->set_rules('old_password', 'Old password', 'trim|required|xss_clean|callback_password_check');
        $this->form_validation->set_rules('new_password', 'new password', 'trim|required|xss_clean|min_length[6]|matches[confirm_password]');
        $this->form_validation->set_rules('confirm_password','confirm password', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="error">', '</div>');
        if ($this->form_validation->run() == TRUE){
            //echo 'yes'; exit();
            $salt = salt();
            $user_data  = array('salt'=>$salt,'password' => sha1($salt.sha1($salt.sha1($this->input->post('new_password', TRUE)))));
            $id = user_id();
            if($this->common_model->update('users', $user_data,array('id'=>$id))){
               $ajaxResponce = array('status'   => 'true','message' => 'Password is updated successfully'); 
            }else{               
                $ajaxResponce = array('status'   => 'true','message' => 'Password is not  update, try again');
            }
        }else{
             $ajaxResponce = array('status'   => 'false','message' => validation_errors());
        }
        echo json_encode($ajaxResponce);         
    }
   /*check old  password */ 
    public function password_check($oldpassword){
        $user_info  = $this->common_model->get_row('users',array('id'=>user_id()));
        $salt       = $user_info->salt;
        if($this->common_model->get_row('users', array('password'=>sha1($salt.sha1($salt.sha1($oldpassword))),'id'=>user_id()))){
            return TRUE;
        }else{
            $this->form_validation->set_message('password_check', "The old password does not match");
            return FALSE;
        }
    }    
    public function edit_story() {     
        $story_id = base64_decode($this->input->get('story_id'));
        $row      = $this->common_model->get_row('traveller_stories', array('id'=>$story_id));
        echo base_url('user/add_story?type=add_story&resort_id='.base64_encode($row->resort_id).'&story_id='.base64_encode($story_id));
    }     
    public function edit_story_back() {     
        $data['users']       = $this->common_model->get_result('users', array('status'=>'1', 'id !='=>user_id()));      
        $data['categorys']   = $this->common_model->get_result('traveller_categorys', array('status'=>'1'));      
        $data['resorts']     = $this->common_model->get_result('resorts', array('status'=>'1', 'user_id'=>user_id()));   
        $data['hear_by']     = $this->common_model->get_result('hear_by', array('status'=>'1'));  
        if($this->input->get('story_id')){
            $story_id        = base64_decode($this->input->get('story_id'));
            $data['row']     = $this->common_model->get_row('traveller_stories', array('id'=>$story_id)); 
            $data['images']  = $this->common_model->get_result('images', array('status'=>'1', 'item_id'=>base64_decode($this->input->get('story_id')), 'type'=>'traveller_story'));    
        }
        $this->load->view('frontend/add_story', $data);
    }     
    public function add_story() {       
        $data['categorys']   = $this->common_model->get_result('traveller_categorys', array('status'=>'1')); 
        $data['hear_by']     = $this->common_model->get_result('hear_by', array('status'=>'1'));
		if($this->input->get('resort_id')==''){
			$data['resort_list'] = $this->common_model->get_result('resorts', array('status'=>1), array('id,resort_name'), array('id','ASC')); 
			
		}
        if($this->input->get('resort_id')){
            $resort_id      = base64_decode($this->input->get('resort_id'));
            $data['resort'] = $this->developer_model->resort_detail($resort_id); 
            $data['villas']   = $this->common_model->get_result('accommodation', array('resort_id'=>$resort_id), array(), array('priority_order','ASC')); 
            //echo '<pre>';print_r($data['resort']);   
        } 
        if($this->input->get('story_id')){
            $story_id        = base64_decode($this->input->get('story_id'));
            $data['row']     = $this->common_model->get_row('traveller_stories', array('id'=>$story_id)); 
            $data['images']  = $this->common_model->get_result('images', array('status'=>'1', 'item_id'=>base64_decode($this->input->get('story_id')), 'type'=>'traveller_story'));    
        }
        $data['template']    = 'frontend/add_story_template';
        $this->load->view('templates/frontend_template', $data);
    }
    public function add_story_res() {   
        $ajaxResponce  = array();
        $this->form_validation->set_rules('resort_id', 'resort', 'required');
        $this->form_validation->set_rules('category_id', 'category', 'required');
        if ($this->form_validation->run() == TRUE) {
            //echo '<pre>';print_r($_POST); 
            $insertData = array();
            if($this->input->post('resort_id')){
                $resort = $this->common_model->get_row('resorts', array('id'=>$this->input->post('resort_id')), array('user_id'));
                $insertData['owner_id'] = !empty($resort->user_id)?$resort->user_id:'';
            }
            if($this->input->post('resort_id')){
                $insertData['resort_id'] = $this->input->post('resort_id');
            }           
            if($this->input->post('category_id')){
                $insertData['category_id'] = $this->input->post('category_id');
            }
            if($this->input->post('villa_id')){
                $insertData['villa_id'] = $this->input->post('villa_id');
            } 
            if($this->input->post('traveller_date')){
                $insertData['traveller_date'] = $this->input->post('traveller_date');
            } 
            if($this->input->post('story_title')){
                $insertData['story_title'] = $this->input->post('story_title');
            }  
            if($this->input->post('my_experience')){
                $insertData['my_experience'] = $this->input->post('my_experience');
            }            
            if($this->input->post('nights_stayed')){
                $insertData['nights_stayed'] = $this->input->post('nights_stayed');
            } 
            if($this->input->post('maldives_visits')){
                $insertData['maldives_visits'] = $this->input->post('maldives_visits');
            } 
            if($this->input->post('hotel_visits')){
                $insertData['hotel_visits'] = $this->input->post('hotel_visits');
            } 
            if($this->input->post('memorable')){
                $insertData['memorable'] = 1;
            }else{ 
                $insertData['memorable'] = 0;
            }
            if($this->input->post('staff_name')){
                $insertData['staff_name'] = $this->input->post('staff_name');
            }            
            if($this->input->post('staff_friendliness')){
                $insertData['staff_friendliness'] = $this->input->post('staff_friendliness');
            } 
            if($this->input->post('services')){
                $insertData['services'] = $this->input->post('services');
            } 
            if($this->input->post('villa')){
                $insertData['villa'] = $this->input->post('villa');
            } 
            if($this->input->post('dine_wine')){
                $insertData['dine_wine'] = $this->input->post('dine_wine');
            } 
            if($this->input->post('spa')){
                $insertData['spa'] = $this->input->post('spa');
            }
            if($this->input->post('facilities')){
                $insertData['facilities'] = $this->input->post('facilities');
            }
            if($this->input->post('location')){
                $insertData['location'] = $this->input->post('location');
            } 
            if($this->input->post('beach')){
                $insertData['beach'] = $this->input->post('beach');
            } 
            if($this->input->post('snorkeling')){
                $insertData['snorkeling'] = $this->input->post('snorkeling');
            }  
            if($this->input->post('over_all')){
                $insertData['over_all'] = $this->input->post('over_all');
            }  
            if($this->input->post('kids_facilities')){
                $insertData['kids_facilities'] = $this->input->post('kids_facilities');
            }  
            if($this->input->post('verified_by')){
                $insertData['verified_by'] = $this->input->post('verified_by');
            }             
            if($this->input->post('hear_by')){
                $insertData['hear_by'] = $this->input->post('hear_by');
            }             
            $insertData['verified_status'] = 0;
            $insertData['verified_by'] = '';
            $insertData['user_id'] = user_id();   
            if($this->input->post('story_id')){
                $this->common_model->update('traveller_stories', $insertData, array('id'=>$this->input->post('story_id'))); 
                $story_id     = $this->input->post('story_id');
                $ajaxResponce = array('status' => 'true', 'type'=>'edit', 'message' => 'Story is updated successfully');
            }else{
                $story_id = $this->common_model->insert('traveller_stories', $insertData);
                $ajaxResponce = array('status' => 'true', 'type'=>'add', 'message' => 'Story is saved successfully');
            } 
            if($this->input->post('story_images')){
                $story_images = explode(',', $this->input->post('story_images'));
                if(!empty($story_images)){
                    foreach($story_images as $story_image){
                        $imgArr = array('type'=>'traveller_story', 'item_id' =>$story_id, 'image_name'=>$story_image); 
                        $this->common_model->insert('images', $imgArr);
                    }
                }
            }  
            $notified      = $this->developer_model->get_story_user($story_id);
            $notified_user = !empty($notified->user_id)?$notified->user_id:"";
            $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'traveller_story', 'activity_id'=>$story_id, 'created_date'=>date('Y-m-d H:i:s'));
            $this->common_model->insert('guest_activities', $inserted_data);   
            if($_SERVER['HTTP_HOST']!='www.localhost'){   
                $user = user_info();
                /***** activation mail to customer ***********/
                $email_template = $this->cimail_email->get_email_template('customer_notification_post_comment');
                $param = array(
                            'template'      => array(
                            'temp'          => $email_template->template_body,
                            'var_name'      => array(
                                                    'name'            => $user->first_name,
                                                    'site_url'        =>  base_url(),   
                                                    'site_name'       =>  site_info('site_name_not_http'),    
                                                    'site_logo'       =>  base_url().'assets/front/images/logo.png'          
                                                    ), 
                            ),      
                    'email' =>  array(
                                    'to'        => $user->email,
                                    'from'      => site_info('mail_from_email'),
                                    'from_name' => site_info('mail_from_name'),
                                    'subject'   => $email_template->template_subject,
                                    )
                ); 
                //print_r($param); exit();
                $status = $this->cimail_email->send_mail($param); 
                $user_info           = user_info();
                $user_data_user_id   = array();
                $user_data_user_id[] = $user_info->id;
                if(!empty($user_info->parent_id)){
                    $user_data_user_id[] = $user_info->parent_id;
                }
                $childs = $this->common_model->get_result('users', array('parent_id'=>$user_info->id), array('id'));
                if(!empty($childs)){
                    foreach($childs as $child){
                        $user_data_user_id[] = $child->id;
                    }
                }
                $users = $this->developer_model->get_related_user(implode(',', $user_data_user_id));
                if(!empty($users)){
                    foreach($users as $user){
                        /***** Hotel And Subadmin Notification ***********/
                        $email_template = $this->cimail_email->get_email_template('hotel_owner_notification_post_comment');
                        $review_link = base_url('login?type=story_list');
                        $param = array(
                                    'template'      => array(
                                    'temp'          => $email_template->template_body,
                                    'var_name'      => array(
                                                            'name'         => $user->first_name,
                                                            'site_url'     => base_url(),   
                                                            'site_name'    => site_info('site_name_not_http'),    
                                                            'site_logo'    => base_url().'assets/front/images/logo.png',
                                                            'review_link'  => $review_link          
                                                            ), 
                                    ),      
                            'email' =>  array(
                                            'to'        => $user->email,
                                            'from'      => site_info('mail_from_email'),
                                            'from_name' => site_info('mail_from_name'),
                                            'subject'   => $email_template->template_subject,
                                            )
                        ); 
                        //print_r($param); exit();
                        $status = $this->cimail_email->send_mail($param); 
                    }
                }
            }
            $list['storys']  = $this->developer_model->get_contributions();
            $ajaxResponce['contributions_list'] = $this->load->view('frontend/contributions_list', $list, TRUE);          
        } else {
            $ajaxResponce = array('status' => 'false', 'message' => validation_errors());
        }
        echo json_encode($ajaxResponce);
    }     
    
    
    public function add_blog() {     
        $data = array();
        if($this->input->get('blog_id')){
            $blog_id      = base64_decode($this->input->get('blog_id'));
            $data['row']  = $this->common_model->get_row('news_blog', array('id'=>$blog_id)); 
            // $imgArr = array('type'=>'blog', 'item_id' =>$blog_id);
            
            $data['blog_images']=$this->common_model->get_result('images', array('status'=>1, 'type'=>'blog','item_id'=>$blog_id));

            // $data['blog_images'] = $this->common_model->get_result('images', $imgArr, array(), array('id', 'asc'));
        }
        $this->load->view('frontend/add_blog', $data);
    }
    
    
    public function add_blog_res() {   
        $ajaxResponce  = array();
        $this->form_validation->set_rules('news_title', 'title', 'required');
        $this->form_validation->set_rules('news_description', 'description', 'required');
        if ($this->form_validation->run() == TRUE) {
            //print_r($_POST); exit();
            $insertData = array();
            if($this->input->post('news_title')){
                $insertData['news_title'] = $this->input->post('news_title');
            }
            if($this->input->post('news_description')){
                $insertData['news_description'] = $this->input->post('news_description');
            }    
            if($this->input->post('tags')){
                $insertData['tags'] = $this->input->post('tags');
            } 
            
            $userData = $this->developer_model->getUserDetails(user_id());
            if($userData->user_type == 2){
                $insertData['role'] = 'Hotel User';
            }elseif($userData->user_type == 1){
                $insertData['role'] = 'User';
            }
            
            $insertData['news_added_user'] = user_id();   
            $insertData['status'] = 4;   
            if($this->input->post('blog_id')){
                $this->common_model->update('news_blog', $insertData, array('id'=>$this->input->post('blog_id'))); 
                $blog_id = $this->input->post('blog_id');
                $ajaxResponce = array('status' => 'true', 'type'=>'edit', 'message' => 'Blog is updated successfully');
            }else{
                $blog_id = $this->common_model->insert('news_blog', $insertData);
                $ajaxResponce = array('status' => 'true', 'type'=>'add', 'message' => 'Blog is saved successfully');
            } 
            if($this->input->post('blog_images')){
                $story_images = explode(',', $this->input->post('blog_images'));
                if(!empty($story_images)){
                    foreach($story_images as $story_image){
                        if(!empty($story_image)){                            
                            $imgArr = array('type'=>'blog', 'item_id' =>$blog_id, 'image_name'=>$story_image); 
                            $this->common_model->insert('images', $imgArr);
                        }
                    }
                }
            }
            $user = user_info();
            if($_SERVER['HTTP_HOST']!='www.localhost'){   
                /***** activation mail to customer ***********/
                $email_template = $this->cimail_email->get_email_template('customer_notification_post_blog');
                $param = array(
                            'template'      => array(
                            'temp'          => $email_template->template_body,
                            'var_name'      => array(
                                                    'name'            => $user->first_name,
                                                    'site_url'        =>  base_url(),   
                                                    'site_name'       =>  site_info('site_name_not_http'),    
                                                    'site_logo'       =>  base_url().'assets/front/images/logo.png'          
                                                    ), 
                            ),      
                    'email' =>  array(
                                    'to'        => $user->email,
                                    'from'      => site_info('mail_from_email'),
                                    'from_name' => site_info('mail_from_name'),
                                    'subject'   => $email_template->template_subject,
                                    )
                ); 
                //print_r($param); exit();
                $status = $this->cimail_email->send_mail($param); 
            }
                           
        } else {
            $ajaxResponce = array('status' => 'false', 'message' => validation_errors());
        }
        echo json_encode($ajaxResponce);
    }  
    public function resort_story() { 
        $data             = array();    
        $data['re_storys']  = $this->developer_model->get_resort_stories_list();
        $this->load->view('frontend/user_resort_story', $data);
    }
    public function blog_list() { 
        $data             = array();    
        $data['blogs']    = $this->developer_model->get_user_blogs_list();
        $this->load->view('frontend/user_blogs', $data);
    }
    public function add_resort_story() { 
        $data              = array();
        $data['resorts']   = $this->developer_model->get_resort_list();  
        if($this->input->get('story_id')){
            $story_id      = base64_decode($this->input->get('story_id'));
            $data['row']   = $this->common_model->get_row('resort_stories', array('status'=>'1','id'=>$story_id)); 
            $imgArr = array('type'=>'resort_story', 'item_id' =>$story_id); 
            $data['images'] = $this->common_model->get_result('images', $imgArr, array(), array('id', 'asc'));
        }
        $this->load->view('frontend/add_resort_story', $data);
    }
    public function add_resort_story_res() {   
        $ajaxResponce  = array();
        $this->form_validation->set_rules('title', 'resort', 'required');
        $this->form_validation->set_rules('desciption', 'user', 'required');
        $this->form_validation->set_rules('resort_id', 'user', 'required');
        
        if ($this->form_validation->run() == TRUE) {

            $insertData = array();
            if($this->input->post('title')){
                $insertData['title'] = $this->input->post('title');
            }
            if($this->input->post('desciption')){
                $insertData['description'] = $this->input->post('desciption');
            }            
            if($this->input->post('story_images')){
                $insertData['image_name'] = $this->input->post('story_images');
            }    
            if($this->input->post('resort_id')){
                $insertData['resort_id'] = $this->input->post('resort_id');
            } 
            $insertData['user_id'] = user_id();   
            if($this->input->post('story_id')){
                $this->common_model->update('resort_stories', $insertData, array('id'=>$this->input->post('story_id'))); 
                $story_id = $this->input->post('story_id');
                $ajaxResponce = array('status' => 'true', 'type'=>'edit', 'message' => 'Story is updated successfully');
            }else{
                $story_id = $this->common_model->insert('resort_stories', $insertData);
                $ajaxResponce = array('status' => 'true', 'type'=>'add', 'message' => 'Story is saved successfully');
            } 
            if($this->input->post('story_images')){
                $story_images = explode(',', $this->input->post('story_images'));
                if(!empty($story_images)){
                    foreach($story_images as $story_image){
                        if(!empty($story_image)){                            
                            $imgArr = array('type'=>'resort_story', 'item_id' =>$story_id, 'image_name'=>$story_image); 
                            $this->common_model->insert('images', $imgArr);
                        }
                    }
                }
            }                
            $notified      = $this->developer_model->get_resort_story_user($story_id);
            $notified_user = !empty($notified->user_id)?$notified->user_id:"";
            $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'resort_story', 'activity_id'=>$story_id, 'created_date'=>date('Y-m-d H:i:s'));
            $this->common_model->insert('guest_activities', $inserted_data);           
        } else {
            $ajaxResponce = array('status' => 'false', 'message' => validation_errors());
        }
        echo json_encode($ajaxResponce);
    }    
   /* logout users*/ 
    public function logout(){
        $this->session->unset_userdata('user_info');
        redirect(base_url());
    } 
    public function emailChecked($email) {
        $confirm = $this->common_model->get_row('users', array('email' => $email));
        if ($confirm) {
            $this->form_validation->set_message('emailChecked', "A user already exists with this email.");
            return false;
        } else {
            return true;
        }
    } 
    public function delete_sub_admin() {
        $ajaxResponce  = array();
        $this->form_validation->set_rules('admin_id', 'admin id', 'required');
        if ($this->form_validation->run() == TRUE) {
            $ajaxResponce  = array('status' => 'true');
            if($this->input->post('admin_id')){
                $this->common_model->delete('users', array('id'=>$this->input->post('admin_id')));
            }  
            $ajaxResponce['message']  = 'Sub admin is deleted successfully';
        }
        echo json_encode($ajaxResponce);
    }
}
?>