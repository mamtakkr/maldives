<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*this controller for making front end */

class Home extends CI_Controller {

    public function __construct() {

        parent::__construct();

          

    }    

    /********************* home page *******************************/

    public function index($offset=NULL) {    

        

        $data                   = $this->feachered_resort_filter_list($offset); 

        $data['holidays']       = $this->developer_model->get_filter_data('holidays', 'holiday_styles', 'multi', array('holidays.holiday_name', 'ASC'));



        $data['categorys']      = $this->developer_model->get_filter_data('category', 'resort_category', 'single', array('category.id', 'ASC'));

        $data['sports']         = $this->developer_model->get_filter_data('sport', 'sports', 'multi', array('sport.sport_name', 'ASC'));



        $data['amenities']      = $this->developer_model->get_filter_data('amenities', 'amenities', 'multi', array('amenities.amenitie_name', 'ASC'));



        $data['facilities']      = $this->developer_model->get_filter_data('facilities', 'facilities', 'multi', array('facilities.facility_name', 'ASC'));



		$data['airports']       = $this->developer_model->get_filter_airports();

        $data['meal_plans']     = $this->developer_model->get_filter_meal_plans();

        $data['holiday_styles']       = $this->common_model->get_result('holidays', array('status'=>1), array(), array('holiday_name', 'ASC'));

        //echo '<pre>';print_r($data['holidays']);exit();

        $data['food_types']     = $this->common_model->get_result('food_types', array('status'=>1), array(), array('food_type', 'ASC'));

		$data['caption']        = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home'));
		$data['banner_caption']        = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home#banner'));
		
        if(!empty($data['caption']->id)){

            $data['caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['caption']->id));

        }

		if(!empty($data['banner_caption']->id)){

            $data['banner_caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['banner_caption']->id));

        }
        

		// accommodation		

		$join  = array(array('join_table'=>'mal_resorts AS resorts','join_on'=>	

			'resorts.id = acc.resort_id','join_type'=>'inner'),array('join_table'=>'mal_brand AS brand','join_on'=>	

			'brand.id = resorts.brand_id','join_type'=>'inner'),array('join_table'=>'mal_states AS state','join_on'=>	

			'state.id = resorts.physical_state','join_type'=>'inner')); 

		$where = array();

        $where = array('acc.is_featured'=>1);            

		$groupby = "acc.id";

		$orderby = "acc.priority_order";

        // $limit = site_info('accommodation_page_limit');
        $limit = 6;
        
		$accommodations  = $this->common_model->getjoinwhere("acc.*,resort_category,resort_name,name_of_villa,state_name,resort_description,island_name,brand_name,max_occupancy,(SELECT GROUP_CONCAT(".DB_PRE."holidays.holiday_name SEPARATOR ', ') FROM ".DB_PRE."holidays 

		WHERE FIND_IN_SET(".DB_PRE."holidays.id, acc.ideal_for)) as ideal_for",'mal_accommodation'." as acc",$join,$where,$groupby,$orderby,$limit); 



        // $accommodations      = $this->developer_model->resort_accommodation();

		$data['accommodations'] = $accommodations;

		// exprience

		

		$join1  = array(array('join_table'=>'mal_resorts AS resorts','join_on'=>	

			'resorts.id = act.resort_id','join_type'=>'inner'),array('join_table'=>'mal_brand AS brand','join_on'=>	

			'brand.id = resorts.brand_id','join_type'=>'inner'),array('join_table'=>'mal_states AS state','join_on'=>	

			'state.id = resorts.physical_state','join_type'=>'inner')); 

			

		$where = array();

		$groupby = "act.id";

		$orderby = "act.id";

		$limit = 6;

		$expriences  = $this->common_model->getjoinwhere("act.*,resort_name,state_name,resort_category,resort_description,island_name,brand_name",'mal_activitie_excursions'." as act",$join1,$where,$groupby,$orderby,$limit); 
    //   echo "<pre>"; var_dump($expriences); die;
		$data['expriences'] = $expriences;

		$blogs_arr =  $this->blog_filter_list(0,"");

		$data['blogs']= $blogs_arr['blogs'];

        $data['resort_highlights'] = $this->common_model->get_result('resort_highlights', array('status'=>1), array(), array('id', 'asc'));
        $highlights = [];
        if(is_array($data['resort_highlights'])){
            foreach($data['resort_highlights'] as $resort_highlight) {
                if(!isset($highlights[$resort_highlight->resort_id])) {
                    $highlights[$resort_highlight->resort_id] = [];
                }
                array_push($highlights[$resort_highlight->resort_id],$resort_highlight->resort_highlights);
            }
        }
        $data['resort_highlights'] = $highlights;

		// instrgram feeds

		$url = "https://api.instagram.com/v1/users/5215466/media/recent/?access_token=kjkhjhghuhuhuyhuyu&count=14";

		$ch = curl_init();

		curl_setopt($ch, CURLOPT_URL, $url);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

		curl_setopt($ch, CURLOPT_TIMEOUT, 20);

		$result = curl_exec($ch);

		curl_close($ch); 

		//print_r($result);die;

		// instrgram feeds

		$data['stories']  = $this->developer_model->get_traveller_stories(0, 0, 0, 3);
        
        $faq_limit=5;
        $faq_offset=0;
		$data['faqs'] = $this->common_model->get_faq_result($faq_limit,$faq_offset);
        
        // $data['faqs']     = $this->common_model->get_result('faq', array('status'=>1), array(), array('faq_id', 'ASC'));
        
        $data['mal_insipiration'] = $this->common_model->get_row('mal_inspiration', array('status' => 1));
        $data['mal_admin_accommodation'] = $this->common_model->get_row('mal_admin_accommodation', array('status' => 1));
        $data['mal_admin_exeperince'] = $this->common_model->get_row('mal_admin_exeperince', array('status' => 1));
        
        $data['template']       = 'frontend/index';

        $this->load->view('templates/frontend_template', $data);

    }

    public function test_datas() {

        $rows = $this->common_model->get_result('resorts');

        $count =1;

        if(!empty($rows)){

            foreach($rows as $row){

                $this->common_model->update('resorts', array('order_priority'=>$count), array('id'=>$row->id));

                $count++;

            }

        }

    } 

    public function feachered_resort_filter_list($offset=null) {
        
        $resort_page_limit    = site_info('resort_page_limit'); 

        $config               = ajax_pagination();

        $config['base_url']   = base_url()."home/feachered_resort_list"; 

        $config['total_rows'] = $this->developer_model->home_resorts(0, 0, 1); 

		//echo $this->db->last_query();

        $config['per_page']   = !empty($resort_page_limit)?$resort_page_limit:'8';

        $this->pagination->initialize($config);

        $offSet               = 0;

        if($offset){

            $offSet   = $config['per_page']*($offset-1);

        } 

        $data['offset']      = $offset;

        $data['total_rows']  = $config['total_rows'];

        $data['per_page']    = $config['per_page'];        

        $data['resorts']     = $this->developer_model->home_resorts($offSet, $config['per_page'], 1);

        
        if(!empty($data['resorts'])) {
            foreach($data['resorts'] as $key=>$val) {
                $data['resorts'][$key]->airportType = $this->developer_model->user_international_airports($data['resorts'][$key]->id);
            }
        }
        //echo $this->db->last_query();
        return $data;

    } 

    public function feachered_resort_list($offset=null) { 

        $data = $this->feachered_resort_filter_list($offset);

        $this->load->view('frontend/resort_list', $data);

    } 

    public function resorts($offset=NULL) {      

        $data                   = $this->resort_filter_list($offset); 
        
        if(!empty($data['resorts'])) {
            foreach($data['resorts'] as $key=>$val) {
                $data['resorts'][$key]->airportType = $this->developer_model->user_international_airports($data['resorts'][$key]->id);
            }
        }
        //echo $this->db->last_query();
        
		$data['holidays']       = $this->developer_model->get_filter_data('holidays', 'holiday_styles', 'multi', array('holidays.holiday_name', 'ASC'));

		$data['category']      = $this->developer_model->get_filter_data('category', 'resort_category', 'single', array('category.id', 'ASC'));

        $data['sports']         = $this->developer_model->get_filter_data('sport', 'sports', 'multi', array('sport.sport_name', 'ASC'));

		$data['facilities']      = $this->developer_model->get_filter_data('facilities', 'facilities', 'multi', array('facilities.facility_name', 'ASC'));

        $data['location'] = $this->common_model->get_result('mal_states', array('status'=>1)); 

        $data['transfer_mode']       = $this->developer_model->get_filter_airports();

        $data['meal_plans']     = $this->developer_model->get_filter_meal_plans();

        $data['holiday_styles'] = $this->common_model->get_result('holidays', array('status'=>1), array(), array('holiday_name', 'ASC'));

        $data['food_types']     = $this->common_model->get_result('food_types', array('status'=>1), array(), array('food_type', 'ASC'));

        $data['caption']        = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/resorts'));

        $data['resort_highlights'] = $this->common_model->get_result('resort_highlights', array('status'=>1), array(), array('id', 'asc'));
        $highlights = [];
        if(is_array($data['resort_highlights'])){
            foreach($data['resort_highlights'] as $resort_highlight) {
                if(!isset($highlights[$resort_highlight->resort_id])) {
                    $highlights[$resort_highlight->resort_id] = [];
                }
                array_push($highlights[$resort_highlight->resort_id],$resort_highlight->resort_highlights);
            }
        }
        $data['resort_highlights'] = $highlights;

        if(!empty($data['caption']->id)){

            $data['caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['caption']->id));

        }

		$data['offset']      = $offset?$offset:0;

        $data['template']       = 'frontend/resorts';

        $this->load->view('templates/frontend_template', $data);

    }     

    public function resort_filter_list($offset=null) {

        
        $resort_page_limit    =site_info('resort_page_limit'); 

        $config               = ajax_pagination();

        $config['base_url']   = base_url()."home/resort_list"; 

        $config['total_rows'] = $this->developer_model->home_resorts($offset, $resort_page_limit); 

        $config['per_page']   = !empty($resort_page_limit)?$resort_page_limit:'6';

        $this->pagination->initialize($config);

        //$offSet                     = 0;

        if($offset){

            //$offset   = $config['per_page']*($offset-1);

        } 

        $data['offset']      = $offset;

        $data['total_rows']  = $config['total_rows'];

        $data['per_page']    = $config['per_page'];        

        $data['resortsList']     = $this->developer_model->get_resorts_list($offset, $config['per_page']);
        $data['resorts']     = $this->developer_model->home_resorts($offset, $config['per_page']);
        //print_R($data['resorts']);

        $data['resort_highlights'] = $this->common_model->get_result('resort_highlights', array('status'=>1), array(), array('id', 'asc'));
        $highlights = [];
        if(is_array($data['resort_highlights'])){
            foreach($data['resort_highlights'] as $resort_highlight) {
                if(!isset($highlights[$resort_highlight->resort_id])) {
                    $highlights[$resort_highlight->resort_id] = [];
                }
                array_push($highlights[$resort_highlight->resort_id],$resort_highlight->resort_highlights);
            }
        }
        $data['resort_highlights'] = $highlights;


        if(!empty($data['resorts'])) {
            foreach($data['resorts'] as $key=>$val) {
                $data['resorts'][$key]->airportType = $this->developer_model->user_international_airports($data['resorts'][$key]->id);
            }
        }
        
        
        return $data;

    }

    public function resort_list($offset=null) { 
        
        if(isset($_REQUEST['offset']) && $_REQUEST['offset']>0) {
            $offset = $_REQUEST['offset'];
        }
        $data = $this->resort_filter_list($offset);
        //print_r($data);
        
        $this->load->view('frontend/resort_list', $data);

    } 

	public function ajax_resort_list() { 

		$offset = $this->input->post('offset')?$this->input->post('offset'):6;

        $data = $this->resort_filter_list($offset);
        //$data = $this->resort_filter_list($offset); 
        if(!empty($data['resorts'])) {
            $ajaxSearchResult  = $this->load->view('frontend/ajax_resort_list',$data, TRUE);
            $value = $this->output->set_output($ajaxSearchResult);
            echo json_encode($value);
            exit();
        } else {
            $value[] = "NoRecord";
            echo json_encode($value);
            exit;
        }

		

    } 

    public function search_resort_name() { 

        $resorts  = $this->developer_model->home_resorts_name();

        $skillData = array(); 

        if(!empty($resorts)){ 

            foreach($resorts as $resort){ 

                $data['id']    = $resort->id; 

                $data['value'] = trim($resort->resort_name);                

                $data['url'] = base_url().'resort-detail?resort_id='.base64_encode($resort->id).'&search='.trim($resort->resort_name);

                array_push($skillData, $data); 

            } 

        }          
        // Return results as json encoded array 

        echo json_encode($skillData); 

    }         

    /******************************** validation function **********************/

    public function emailChecked($email) {

        $confirm = $this->common_model->get_row('users', array('email' => $email));

        if ($confirm) {

            $this->form_validation->set_message('emailChecked', "A user already exists with this email.");

            return false;

        } else {

            return true;

        }

    } 

     public function check_token($email) {        

        if (empty($this->input->post('user_token'))) {

            $this->form_validation->set_message('check_token', "Token is expired try again.");

            return false;

        } else {

            return true;

        }

    } 

    public function signup_res() {

        //print_r($_POST); exit();

        $loginResponce = array();

        if($this->input->post('user_type', TRUE)&&$this->input->post('user_type', TRUE)==2){

        	$this->form_validation->set_rules('hotel_name', 'hotel name', 'required|xss_clean');

        }else{        	

	        $this->form_validation->set_rules('first_name', 'first name', 'required|xss_clean');

	        $this->form_validation->set_rules('last_name', 'last name', 'required|xss_clean');

        }

        $this->form_validation->set_rules('email', 'email', 'required|valid_email|xss_clean|callback_emailChecked');

        $this->form_validation->set_rules('password', 'password', 'required|xss_clean|min_length[6]');

        if ($this->form_validation->run() == TRUE) {

        	if($this->input->post('user_type', TRUE)&&$this->input->post('user_type', TRUE)==2){

	        	$first_name = $this->input->post('hotel_name', TRUE);

	        }else{        	

		        $first_name = $this->input->post('first_name', TRUE);

	        }        	

            $activationcode = rand(111,999).time().rand(111,999);

            $newSalt        = salt();

            $password       = passwordGenrate($this->input->post('password', TRUE), $newSalt);

            $signup = array(); 

            if ($this->input->post('country_id')) 

                $signup['country_id'] = $this->input->post('country_id', TRUE);

            if ($this->input->post('hotel_name')) 

                $signup['first_name'] = $this->input->post('hotel_name', TRUE);

            if ($this->input->post('first_name')) 

                $signup['first_name'] = $this->input->post('first_name', TRUE);

            if ($this->input->post('last_name')) 

                $signup['last_name'] = $this->input->post('last_name', TRUE);

            if($this->input->post('email', TRUE))

                $signup['email'] = $this->input->post('email', TRUE); 

            if($this->input->post('user_type', TRUE))

                $signup['user_type'] = $this->input->post('user_type', TRUE);

            $signup['activation_code']  = $activationcode;

            $signup['is_email_verify']  = 0; 

            $signup['created_date']     = date('Y-m-d H:i:s');

            $signup['password']         = $password;

            $signup['salt']             = $newSalt;

            $insert = $this->common_model->insert('users', $signup);

            if(!empty($insert)){

                $linkUrl = base_url('home/activateAccount/' . $activationcode);

                if($_SERVER['HTTP_HOST']!='www.localhost'){   

                    /***** activation mail to customer ***********/

                    $email_template = $this->cimail_email->get_email_template('account_verification');

                    $param = array(

                                'template'      => array(

                                'temp'          => $email_template->template_body,

                                'var_name'      => array(

                                                        'name'            => $first_name,

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

        } else {

            $loginResponce = array('status' => 'false', 'message' => validation_errors());

        }

        echo json_encode($loginResponce);

    }

    public	 function activateAccount($id=''){	

		$row = $this->common_model->get_row('users', array('activation_code'=>$id,'is_email_verify'=>0));

		if($row){	

			$update = $this->common_model->update('users', array('is_email_verify'=>1), array('id'=>$row->id));

			if($update){

				$this->session->set_flashdata('msg_success', 'Your account is activated successfuly');

				$urlLink = base_url().'home/login';

				redirect($urlLink);			    

			}

		}else{

			redirect(base_url());	

		}

	}

    public function login_res() {

        $loginResponce  = array();

        $this->form_validation->set_rules('user_name', 'user name', 'required|xss_clean');

        $this->form_validation->set_rules('password', 'password', 'required|xss_clean');

        if ($this->form_validation->run() == TRUE) {

            $user_name = $this->input->post('user_name', TRUE);

            $password = $this->input->post('password', TRUE);

            $response = $this->common_model->front_user_login($user_name, $password);

            if ($response == 1) {

                if (user_logged_in()) {

                    $user = user_info();

                    if($this->input->post('activity_type')&&$this->input->post('activity_type')=='resort_like'){

                        $resort_id = base64_decode($this->input->post('activity_id'));

                        if($resort_id){

                            $whrr = array('resort_id'=>$resort_id, 'user_id'=>user_id());

                            if($this->common_model->get_row('resorts_likes', $whrr)){

                                $this->common_model->delete('resorts_likes', $whrr);

                                /********** activity Report *******************/

                                $row           = $this->common_model->get_row('resorts', array('id'=>$resort_id));

                                $notified_user = $row->user_id;

                                $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'resorts_unlike', 'activity_id'=>$resort_id, 'created_date'=>date('Y-m-d H:i:s'));

                                $this->common_model->insert('guest_activities', $inserted_data);

                                /********** activity Report *******************/

                                $likes = get_all_count('resorts_likes', array('resort_id'=>$resort_id));

                                $likes = !empty($likes)?number_format($likes, 0):'';

                                $html  = '<span class="fa fa-heart-o" aria-hidden="true"></span><strong>&nbsp;&nbsp;'.$likes.'</strong>';

                                $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                                $this->session->set_flashdata('msg_success', 'Resort is Unliked');

                            }else{

                                $this->common_model->insert('resorts_likes', $whrr);

                                /********** activity Report *******************/

                                $row           = $this->common_model->get_row('resorts', array('id'=>$resort_id));

                                $notified_user = $row->user_id;

                                $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'resorts_like', 'activity_id'=>$resort_id, 'created_date'=>date('Y-m-d H:i:s'));

                                $this->common_model->insert('guest_activities', $inserted_data);

                                /********** activity Report *******************/

                                $likes = get_all_count('resorts_likes', array('resort_id'=>$resort_id));

                                $likes = !empty($likes)?number_format($likes, 0):'';

                               $html  = '<span class="fa fa-heart" aria-hidden="true"></span><strong>&nbsp;&nbsp;'.$likes.'</strong>';

                                $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                                $this->session->set_flashdata('msg_success', 'Resort is Liked');

                            }

                        }

                        $loginResponce = array('status' => 'true', 'message' => "Your Login successfully.", 'redirect_url' => 'resorts?type=resort_like', 'type'=>'resort_like');

                    }else if($this->input->post('activity_type')&&$this->input->post('activity_type')=='blog_like'){

                        $blog_id = base64_decode($this->input->post('activity_id'));

                        if(!empty($blog_id)){

                            $whrr = array('new_blog_id'=>$blog_id, 'user_id'=>user_id());

                            if($this->common_model->get_row('blog_likes', $whrr)){

                                $this->common_model->delete('blog_likes', $whrr);

                                $likes = get_all_count('blog_likes', array('new_blog_id'=>$blog_id));

                                $likes = !empty($likes)?$likes:'';

                                $html  = '<span><img src="'.FRONT_THEAM_PATH.'img/unlike.png" alt="thumb-like"/></span><span class="number-like danger">'.$likes.'</span>';

                                $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                                /********** activity Report *******************/

                                $row           = $this->common_model->get_row('news_blog', array('id'=>$blog_id));

                                $notified_user = $row->news_added_user;

                                $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'blog_unlike', 'activity_id'=>$blog_id, 'created_date'=>date('Y-m-d H:i:s'));

                                $this->common_model->insert('guest_activities', $inserted_data);

                                $this->session->set_flashdata('msg_success', 'Blog is Unliked');

                                /********** activity Report *******************/

                            }else{

                                $this->common_model->insert('blog_likes', $whrr);

                                $html = '<span><img src="'.FRONT_THEAM_PATH.'img/like.png" alt="thumb-like"/></span><span class="number-like danger">'.get_all_count('blog_likes', array('new_blog_id'=>$blog_id)).'</span>';

                                $response = array('status'=>'true', 'html'=>$html, 'message'=>'');  

                                /********** activity Report *******************/

                                $row           = $this->common_model->get_row('news_blog', array('id'=>$blog_id));

                                $notified_user = $row->news_added_user;

                                $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'blog_like', 'activity_id'=>$blog_id, 'created_date'=>date('Y-m-d H:i:s'));

                                $this->common_model->insert('guest_activities', $inserted_data);

                                $this->session->set_flashdata('msg_success', 'Blog is liked');

                                /********** activity Report *******************/        

                            }

                        }

                        $loginResponce = array('status' => 'true', 'message' => "Your Login successfully.", 'redirect_url' => 'blog-detail?type=blog_like&blog_id='.$this->input->post('activity_id'));

                    }else if($this->input->post('activity_type')&&$this->input->post('activity_type')=='blog_comment'){

                        $loginResponce = array('status' => 'true', 'message' => "Your Login successfully.", 'redirect_url' => 'blog-detail?type=blog_comment&blog_id='.$this->input->post('activity_id'));

                    }else if($this->input->post('activity_type')&&$this->input->post('activity_type')=='accommodation_like'){

                        $accommodation_id = base64_decode($this->input->post('activity_id'));

                        $notified = $this->developer_model->get_accommodation_user($accommodation_id);

                        //print_r($notified_user ); exit();

                        $notified_user = !empty($notified->user_id)?$notified->user_id:"";

                        if(!empty($accommodation_id)){

                            $whrr = array('accommodation_id'=>$accommodation_id, 'user_id'=>user_id());

                            if($this->common_model->get_row('accommodations_likes', $whrr)){

                                $this->common_model->delete('accommodations_likes', $whrr);

                                $likes = get_all_count('accommodations_likes', array('accommodation_id'=>$accommodation_id));

                                $likes = !empty($likes)?number_format($likes, 0):'';

                                $html  = '<span class="fa fa-heart-o" aria-hidden="true"></span><strong>&nbsp;&nbsp;'.$likes.'</strong>';

                                $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                                /********** activity Report *******************/

                                $inserted_data = array('user_id'=>user_id(), 

                                                    'notified_user'=> $notified_user, 

                                                    'type'=>'accommodation_unlike', 

                                                    'activity_id'=>$accommodation_id, 

                                                    'created_date'=>date('Y-m-d H:i:s')

                                                );

                                $this->common_model->insert('guest_activities', $inserted_data);

                                $this->session->set_flashdata('msg_success', 'Villa is unliked');

                                /********** activity Report *******************/

                            }else{                    

                                $this->common_model->insert('accommodations_likes', $whrr);

                                $likes = get_all_count('accommodations_likes', array('accommodation_id'=>$accommodation_id));

                                $likes = !empty($likes)?number_format($likes, 0):'';

                                /********** activity Report *******************/

                                $inserted_data = array('user_id'=>user_id(), 

                                                        'notified_user'=>$notified_user, 

                                                        'type'=>'accommodation_like', 

                                                        'activity_id'=>$accommodation_id, 

                                                        'created_date'=>date('Y-m-d H:i:s')

                                                    );

                                $this->common_model->insert('guest_activities', $inserted_data);

                                $this->session->set_flashdata('msg_success', 'Villa is liked');

                                /********** activity Report *******************/

                                $html = '<span class="fa fa-heart" aria-hidden="true"></span><strong>&nbsp;&nbsp;'.$likes.'</strong>';

                                $response = array('status'=>'true', 'html'=>$html, 'message'=>'');          

                            }

                        }

                        $redirect_url = 'resort-detail?type=accommodations_likes&resort_id='.base64_encode($notified->id);

                        $loginResponce = array('status' => 'true', 'message' => "Your Login successfully.", 'redirect_url' =>$redirect_url);

                    }else if($this->input->post('activity_type')&&$this->input->post('activity_type')=='dinning_like'){

                        $dining_id = base64_decode($this->input->post('activity_id'));

                        $notified  = $this->developer_model->get_dining_user($dining_id);

                        //print_r($notified_user ); exit();

                        $notified_user = !empty($notified->user_id)?$notified->user_id:"";

                        if(!empty($dining_id)){

                            $whrr = array('dinning_id'=>$dining_id, 'user_id'=>user_id());

                            if($this->common_model->get_row('dinnings_likes', $whrr)){

                                $this->common_model->delete('dinnings_likes', $whrr);

                                $likes = get_all_count('dinnings_likes', array('dinning_id'=>$dining_id));

                                $likes = !empty($likes)?$likes:'';

                                /********** activity Report *******************/

                                $inserted_data = array('user_id'=>user_id(), 

                                                    'notified_user'=> $notified_user, 

                                                    'type'=>'dining_unlike', 

                                                    'activity_id'=>$dining_id, 

                                                    'created_date'=>date('Y-m-d H:i:s')

                                                );

                                $this->common_model->insert('guest_activities', $inserted_data);

                                $this->session->set_flashdata('msg_success', 'Dinning is unliked');

                                /********** activity Report *******************/

                                $html  = '<span class="fa fa-heart-o" aria-hidden="true"></span><strong>&nbsp;&nbsp;'.$likes.'</strong>';

                                $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                            }else{

                                $this->common_model->insert('dinnings_likes', $whrr);

                                $likes = get_all_count('dinnings_likes', array('dinning_id'=>$dining_id));

                                $likes = !empty($likes)?number_format($likes, 0):'';

                                $html = '<span class="fa fa-heart" aria-hidden="true"></span><strong>&nbsp;&nbsp;'.$likes.'</strong>';

                                /********** activity Report *******************/

                                $inserted_data = array('user_id'=>user_id(), 

                                                    'notified_user'=> $notified_user, 

                                                    'type'=>'dining_like', 

                                                    'activity_id'=>$dining_id, 

                                                    'created_date'=>date('Y-m-d H:i:s')

                                                );

                                $this->common_model->insert('guest_activities', $inserted_data);

                                $this->session->set_flashdata('msg_success', 'Dinning is liked');

                                /********** activity Report *******************/

                                $response = array('status'=>'true', 'html'=>$html, 'message'=>'');         

                            }

                        }

                        $redirect_url = 'resort-detail?type=accommodations_likes&resort_id='.base64_encode($notified->id);

                        $loginResponce = array('status' => 'true', 'message' => "Your Login successfully.", 'redirect_url' =>$redirect_url);

                    }else if($this->input->post('activity_type')&&$this->input->post('activity_type')=='traveller_story_like'){

                        $story_id = base64_decode($this->input->post('activity_id'));

                        $notified  = $this->developer_model->get_story_user($story_id);

                        //print_r($notified_user ); exit();

                        $notified_user = !empty($notified->user_id)?$notified->user_id:"";

                        if(!empty($story_id)){

                            $whrr = array('story_id'=>$story_id, 'user_id'=>user_id());

                            if($this->common_model->get_row('traveller_stories_like', $whrr)){

                                $this->common_model->delete('traveller_stories_like', $whrr);

                                $likes = get_all_count('traveller_stories_like', array('story_id'=>$story_id));

                                $likes = !empty($likes)?number_format($likes, 0):'';

                                $html  = '<span><img src="'.FRONT_THEAM_PATH.'img/unlike.png" alt="thumb-like"/></span><span class="number-like danger">'.$likes.'</span>';

                                $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                                /********** activity Report *******************/

                                $inserted_data = array('user_id'=>user_id(), 

                                                    'notified_user'=> $notified_user, 

                                                    'type'=>'traveller_story_unlike', 

                                                    'activity_id'=>$story_id, 

                                                    'created_date'=>date('Y-m-d H:i:s')

                                                );

                                $this->common_model->insert('guest_activities', $inserted_data);

                                $this->session->set_flashdata('msg_success', 'Traveller story is unliked');

                                /********** activity Report *******************/

                            }else{

                                $this->common_model->insert('traveller_stories_like', $whrr);

                                $likes = get_all_count('traveller_stories_like', array('story_id'=>$story_id));

                                $likes = !empty($likes)?number_format($likes, 0):'';

                                $html  = '<div><img src="'.FRONT_THEAM_PATH.'img/like.png" alt="thumb-like"/></div><div class="number-like danger">'.$likes.'</div>';

                                $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                                /********** activity Report *******************/

                                $inserted_data = array('user_id'=>user_id(), 

                                                    'notified_user'=> $notified_user, 

                                                    'type'=>'traveller_story_like', 

                                                    'activity_id'=>$story_id, 

                                                    'created_date'=>date('Y-m-d H:i:s')

                                                );

                                $this->common_model->insert('guest_activities', $inserted_data);

                                $this->session->set_flashdata('msg_success', 'Traveller story is liked');

                                /********** activity Report *******************/

                            }

                        }

                        $redirect_url = 'resort-detail?type=accommodations_likes&resort_id='.base64_encode($notified->id);

                        $loginResponce = array('status' => 'true', 'message' => "Your Login successfully.", 'redirect_url' =>$redirect_url);

                    }else if($this->input->post('activity_type')&&$this->input->post('activity_type')=='traveller_story_comment'){

                    	$story_id = base64_decode($this->input->post('activity_id'));

                        $notified  = $this->developer_model->get_story_user($story_id);

                        $loginResponce = array('status' => 'true', 'message' => "Your Login successfully.", 'redirect_url' => 'resort-detail?type=traveller_story_comment&resort_id='.base64_encode($notified->id));

                    }else if($this->input->post('activity_type')&&$this->input->post('activity_type')=='resort_story_like'){

                        $story_id = base64_decode($this->input->post('activity_id'));

                        $notified  = $this->developer_model->get_resort_story_user($story_id);

                        //print_r($notified_user ); exit();

                        $notified_user = !empty($notified->user_id)?$notified->user_id:"";

                        if(!empty($story_id)){

                            $whrr = array('story_id'=>$story_id, 'user_id'=>user_id());

                            if($this->common_model->get_row('resort_story_likes', $whrr)){

                                $this->common_model->delete('resort_story_likes', $whrr);

                                $likes = get_all_count('resort_story_likes', array('story_id'=>$story_id));

                                $likes = !empty($likes)?number_format($likes, 0):'';

                                $html  = '<div><img src="'.FRONT_THEAM_PATH.'img/unlike.png" alt="thumb-like"/></div><div class="number-like danger">'.$likes.'</div>';

                                /********** activity Report *******************/

                                $inserted_data = array('user_id'=>user_id(), 

                                                    'notified_user'=> $notified_user, 

                                                    'type'=>'resort_story_unlike', 

                                                    'activity_id'=>$story_id, 

                                                    'created_date'=>date('Y-m-d H:i:s')

                                                );

                                $this->common_model->insert('guest_activities', $inserted_data);

                                $this->session->set_flashdata('msg_success', 'Resort story is unliked');

                                $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                            }else{

                                $this->common_model->insert('resort_story_likes', $whrr);

                                $likes = get_all_count('resort_story_likes', array('story_id'=>$story_id));

                                $likes = !empty($likes)?number_format($likes, 0):'';

                                $html  = '<div><img src="'.FRONT_THEAM_PATH.'img/like.png" alt="thumb-like"/></div><div class="number-like danger">'.$likes.'</div>';

                                /********** activity Report *******************/

                                $inserted_data = array('user_id'=>user_id(), 

                                                    'notified_user'=> $notified_user, 

                                                    'type'=>'resort_story_like', 

                                                    'activity_id'=>$story_id, 

                                                    'created_date'=>date('Y-m-d H:i:s')

                                                );

                                $this->common_model->insert('guest_activities', $inserted_data);

                                $this->session->set_flashdata('msg_success', 'Resort story is liked');

                                $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                            }

                        }

                        $redirect_url = 'resort-detail?type=accommodations_likes&resort_id='.base64_encode($notified->id);

                        $loginResponce = array('status' => 'true', 'message' => "Your Login successfully.", 'redirect_url' =>$redirect_url);

                    }else if($this->input->post('activity_type')&&$this->input->post('activity_type')=='resort_story_comment'){

                    	$story_id = base64_decode($this->input->post('activity_id'));

                        $notified  = $this->developer_model->get_resort_story_user($story_id);

                        $loginResponce = array('status' => 'true', 'message' => "Your Login successfully.", 'redirect_url' => 'resort-detail?type=resort_story_comment&resort_id='.base64_encode($notified->id));

                    }else{

                        $loginResponce = array('status' => 'true', 'message' => "Your Login successfully.", 'redirect_url' => '');

                    }                     

                } else {

                    $loginResponce = array('status' => 'false', 'message' =>"Your account has been banned from using the maldives experts platform. If you believe this has been in error, then please contact info@maldivesexperts.com");

                }

            } else if ($response == 2) {

                $loginResponce = array('status' => 'false', 'message' => "Your account has been banned from using the maldives experts platform. If you believe this has been in error, then please contact info@maldivesexperts.com");

            } else if ($response == 3) {

                $loginResponce = array('status' => 'false', 'message' => "Your account is not verified");

            } else if ($response == 4) {

                $loginResponce = array('status' => 'false', 'message' => "The username or password is invalid.");

            } else {

                $loginResponce = array('status' => 'false', 'message' => "The username or password is invalid.");

            }

        } else {

            $loginResponce = array('status' => 'false', 'message' => validation_errors());

        }

        echo json_encode($loginResponce);

    }

    public function fb_login(){   

        if($this->input->post('name', TRUE)){

            $fbfullname = $this->input->post('name', TRUE);

        }

        if($this->input->post('email', TRUE)){

            $femail = $this->input->post('email', TRUE);

        }

        if($this->input->post('fb_id', TRUE)){

            $fbid = $this->input->post('fb_id', TRUE);

        }

        if($this->input->post('url', TRUE)){

            $picture = $this->input->post('url', TRUE);

        }

		$result = $this->common_model->fb_login($fbfullname,$femail,$fbid,$picture);

        echo $result;

    }   

    public function gmail_login(){ 

        if($this->input->post('email', TRUE)){            

            $fullname = $emai = $page_url = $picture = '';    

            if($this->input->post('name', TRUE)){

                $fullname = $this->input->post('name', TRUE);

            }

            if($this->input->post('email', TRUE)){

                $email = $this->input->post('email', TRUE);

            }

            if($this->input->post('page_url', TRUE)){

                $page_url = $this->input->post('page_url', TRUE);

            }

            if($this->input->post('url')){

                $picture = $this->input->post('url', TRUE);

            }

            $result = $this->common_model->gmail_login($fullname,$email,'1',$page_url,  $picture,'','');

            echo $result;

        }else{

            echo 'Email is required';

        }

    }

    public function aboutus() {  

        $data['caption']        = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/resorts'));

        if(!empty($data['caption']->id)){

            $data['caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['caption']->id));

        }     

        $data['template']    = 'frontend/aboutus';

        $this->load->view('templates/frontend_template', $data);

    } 

    public function privacy_policy() {  

        $data['caption']        = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/privacy_policy'));

        if(!empty($data['caption']->id)){

            $data['caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['caption']->id));

        }     

        $data['template']    = 'frontend/privacy_policy';

        $this->load->view('templates/frontend_template', $data);

    } 

    public function term_and_services() {  

        $data['caption']        = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/term_and_services'));

        if(!empty($data['caption']->id)){

            $data['caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['caption']->id));

        }     

        $data['template']    = 'frontend/term_and_services';

        $this->load->view('templates/frontend_template', $data);

    } 

    public function maldives() {  

        $data['row']       = $this->common_model->get_row('about_maldives', array('id'=>1));

        $data['airports']  = $this->common_model->get_result('international_airport_type', array('status'=>1));

        $data['distance_places']  = $this->common_model->get_result('distance_place', array('status'=>1));

        $data['resorts']   		  = $this->developer_model->maldives_resort();

        $data['resorts_places']   = $this->developer_model->maldives_resorts_places();

        //echo '<pre>';print_r($data['resorts_places']); exit();

        $data['openings']  		  = $this->developer_model->get_openings(0, 2000);

        $data['blogs']     		  = $this->developer_model->home_blogs(0, 3);

        $data['caption']          = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/maldives'));

        if(!empty($data['caption']->id)){

            $data['caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['caption']->id));

        }

		$data['arrival_immigration']  = $this->common_model->get_row('arrival_immigration', array());

		$data['what_to_wear']  = $this->common_model->get_row('what_to_wear', array());

		$data['local_environment']  = $this->common_model->get_row('local_environment', array());

		$data['maldives_people']  = $this->common_model->get_row('maldives_people', array());

		$data['climate_weather']  = $this->common_model->get_row('climate_weather', array());

		$data['maldives_diving']  = $this->common_model->get_row('maldives_diving', array());

        $data['template']  = 'frontend/maldives-main';

        $this->load->view('templates/frontend_template', $data);

    } 

    public function calculateDistance(){

        echo $this->distanceCalculation('','','','');

    }

    public function distanceCalculation($point1_lat, $point1_long, $point2_lat, $point2_long, $unit = 'km', $decimals = 2) {

        // Calculate the distance in degrees

        $degrees = rad2deg(acos((sin(deg2rad($point1_lat))*sin(deg2rad($point2_lat))) + (cos(deg2rad($point1_lat))*cos(deg2rad($point2_lat))*cos(deg2rad($point1_long-$point2_long)))));

     

        // Convert the distance in degrees to the chosen unit (kilometres, miles or nautical miles)

        switch($unit) {

            case 'km':

                $distance = $degrees * 111.13384; // 1 degree = 111.13384 km, based on the average diameter of the Earth (12,735 km)

                break;

            case 'mi':

                $distance = $degrees * 69.05482; // 1 degree = 69.05482 miles, based on the average diameter of the Earth (7,913.1 miles)

                break;

            case 'nmi':

                $distance =  $degrees * 59.97662; // 1 degree = 59.97662 nautic miles, based on the average diameter of the Earth (6,876.3 nautical miles)

        }

        return round($distance, $decimals);

    }

    public function reviews() {  
          
        $data['resorts']     = $this->common_model->get_result('resorts', array('status'=>1,'admin_approved'=>1));   
        
        $data['t_categorys'] = $this->common_model->get_result('traveller_categorys', array('status'=>'1'));

        $data['holidays']   = $this->developer_model->get_filter_data('holidays', 'holiday_styles', 'multi');

        $data['categorys']  = $this->developer_model->get_filter_data('category', 'resort_category', 'single');

         $data['location'] = $this->common_model->get_result('mal_states', array('status'=>1)); 

        $data['sports']         = $this->developer_model->get_filter_data('sport', 'sports', 'multi');

       // $data['amenities']      = $this->developer_model->get_filter_data('amenities', 'amenities', 'multi');

        $data['facilities']      = $this->developer_model->get_filter_data('facilities', 'facilities', 'multi');

		$data['airports']       = $this->developer_model->get_filter_airports();

        $data['meal_plans']     = $this->developer_model->get_filter_meal_plans();

        $data['total_story']    = $this->developer_model->get_traveller_stories();

        $data['stories']        = $this->developer_model->get_traveller_stories(0, 0, 0, PER_PAGE_STORY);

        $data['total_rs_story'] = $this->developer_model->get_rs_stories();

        $data['resort_storys']  = $this->developer_model->resort_stories_new();

        $data['caption']        = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/reviews'));

        $data['food_types']     = $this->common_model->get_result('food_types', array('status'=>1), array(), array('food_type', 'ASC'));

        if(!empty($data['caption']->id)){

            $data['caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['caption']->id));

        }

		$data['traveller_categorys']      = $this->common_model->get_result('traveller_categorys', array('status'=>'1'));  

        $data['template'] 		= 'frontend/reviews';

        //print_r($data);
        //exit;

        $this->load->view('templates/frontend_template', $data);

    }     

    public function read_more_story() {   

        $category_id      = $this->input->get('category_id')?$this->input->get('category_id'):'';

        $resort_id        = $this->input->get('resort_id')?$this->input->get('resort_id'):'';

        $page_num         = $this->input->get('page_num');             

        $data['stories']  = $this->developer_model->get_traveller_stories($resort_id, $category_id, $page_num, PER_PAGE_STORY);

        //echo $this->db->last_query();

        $this->load->view('frontend/read_more_story', $data);    

    }

    public function read_more_story_new() {

        $response         = array('status'=>'true');  

        $category_id      = $this->input->post('categorys')?implode(',', $this->input->post('categorys')):'';

        $resort_id        = $this->input->post('resort_id')?$this->input->post('resort_id'):'';

        $page_num         = ($this->input->get('page_num'))?$this->input->get('page_num'):0;

        $data['stories']  = $this->developer_model->get_traveller_stories($resort_id, $category_id, $page_num, PER_PAGE_STORY);

        $total_pages      = $this->developer_model->get_traveller_stories($resort_id, $category_id);
        
        $html             = $this->load->view('frontend/read_more_story', $data, TRUE);    

        $response['html']        = $html;

        $response['total_pages'] = $total_pages;

        echo json_encode($response);

    }

    public function read_more_story_new2() {

        $response         = array('status'=>'true');  

        $category_id      =  $this->input->post('categorys');

        $resort_id        = $this->input->post('resort_id')?$this->input->post('resort_id'):'';

        $page_num         = ($this->input->get('page_num'))?$this->input->get('page_num'):0;

        $data['stories']  = $this->developer_model->get_traveller_stories2($category_id, $page_num, PER_PAGE_STORY);

        // echo '<pre>';

        // print_r($data);

        // die();

        $total_pages      = $this->developer_model->get_traveller_stories2($category_id);

        $html             = $this->load->view('frontend/read_more_story', $data, TRUE);    

        $response['html']        = $html;

        $response['total_pages'] = $total_pages;

        echo json_encode($response);

    }

	public function inspiration($offset=NULL){

        // $data                   = $this->resort_filter_list($offset); 
        // echo "<pre>"; var_dump($data['resorts'][0]->holidays); die;
		$data['caption']        = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/inspire_me'));

		if(!empty($data['caption']->id)){

            $data['caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['caption']->id));

        } 

		$data['inspiration']     = $this->common_model->get_result('inspiration', array('status'=>1));   
		if(is_array($data['inspiration'])){
            $data['inspiration']     = $data['inspiration'][0];
		}

		$data['resorts']     = $this->common_model->get_result('resorts', array('status'=>1,'admin_approved'=>1));   

        if(!empty($data['resorts'])) {
            foreach($data['resorts'] as $key=>$val) {
                $data['resorts'][$key]->airportType = $this->developer_model->user_international_airports($data['resorts'][$key]->id);
            }
        }

        $data['resort_highlights'] = $this->common_model->get_result('resort_highlights', array('status'=>1), array(), array('id', 'asc'));
        $highlights = [];
        
        if(is_array($data['resort_highlights'])){
            foreach($data['resort_highlights'] as $resort_highlight) {
                if(!isset($highlights[$resort_highlight->resort_id])) {
                    $highlights[$resort_highlight->resort_id] = [];
                }
                array_push($highlights[$resort_highlight->resort_id],$resort_highlight->resort_highlights);
            }
        }
        $data['resort_highlights'] = $highlights;


// 		$data['holidays']       = $this->developer_model->get_filter_data('holidays', 'holiday_styles', 'multi', array('holidays.holiday_name', 'ASC'));
        $data['holidays']       = $this->developer_model->get_filter_data('holidays', 'holiday_styles', 'multi', array('holidays.holiday_name', 'ASC'));
        // echo "<pre>"; var_dump($data['holidays']); die;

		$data['category']      = $this->developer_model->get_filter_data('category', 'resort_category', 'single', array('category.id', 'ASC'));
		
		$data['category_for_exp']      = $this->developer_model->get_filter_data('category', 'resort_category', 'single', array('category.id', 'ASC'));

        $data['sports']         = $this->developer_model->get_filter_data('sport', 'sports', 'multi', array('sport.sport_name', 'ASC'));

		$data['facilities']      = $this->developer_model->get_filter_data('facilities', 'facilities', 'multi', array('facilities.facility_name', 'ASC'));

        $data['transfer_mode']       = $this->developer_model->get_filter_airports();

        $data['location'] = $this->common_model->get_result('mal_states', array('status'=>1)); 

		// accommodation		

		$join  = array(array('join_table'=>'mal_resorts AS resorts','join_on'=>	

			'resorts.id = acc.resort_id','join_type'=>'inner'),array('join_table'=>'mal_states AS state','join_on'=>	

			'state.id = resorts.physical_state','join_type'=>'inner'),array('join_table'=>'mal_villa_type as villa_type','join_on'=> 'acc.villa_type = villa_type.id', 'join_type'=>'inner')); 

		$where = array();

		$groupby = "";

		$orderby = "acc.created_at DESC";

		$limit = 4;

		$accommodations  = $this->common_model->getjoinwhere("acc.*,resort_category,resort_name,name_of_villa,state_name,resort_description,island_name,(SELECT GROUP_CONCAT(".DB_PRE."holidays.holiday_name SEPARATOR ', ') FROM ".DB_PRE."holidays 

		WHERE FIND_IN_SET(".DB_PRE."holidays.id, acc.ideal_for)) as ideal_for,villa_type.villa_type as villa_type_name",'mal_accommodation'." as acc",$join,$where,$groupby,$orderby,$limit); 

        //echo $this->db->last_query();
        
        $data['accommodations'] = $accommodations;
		
		$data['accommodations_categories'] = $this->common_model->get_result('villa_type', array('status'=> 1), array(), array('id', 'ASC'));

		// exprience

			

		$join1  = array(array('join_table'=>'mal_resorts AS resorts','join_on'=>	

			'resorts.id = act.resort_id','join_type'=>'inner'),array('join_table'=>'mal_brand AS brand','join_on'=>	

			'brand.id = resorts.brand_id','join_type'=>'inner'),array('join_table'=>'mal_states AS state','join_on'=>	

			'state.id = resorts.physical_state','join_type'=>'inner')); 

		$where = array();

		$groupby = "act.id";

		$orderby = "act.id";

		$limit = 4;

		$expriences  = $this->common_model->getjoinwhere("act.*,resort_name,state_name,resort_category,resort_description,island_name,brand_name",'mal_activitie_excursions'." as act",$join1,$where,$groupby,$orderby,$limit); 

		//echo $this->db->last_query();die;

		$data['expriencesCount']  = $this->common_model->getjoinwhere("act.*,resort_name,state_name,resort_category,resort_description,
				island_name,brand_name",'mal_activitie_excursions'." as act",$join1,$where,$groupby,$orderby);


		$data['expriences'] = $expriences;
        if(is_array($data['expriences'])){
            $data['resort_id']=$expriences[0]->resort_id;
        }

		$data['experience_categories'] = $this->common_model->get_result('experience_category', array('status'=> 1), array(), array('exp_cat_id', 'ASC'));

		$data['experince_offset'] = 0;
		
		$data['accommodation_offset'] =0;

        $data['resort_highlights'] = $this->common_model->get_result('resort_highlights', array('status'=>1), array(), array('id', 'asc'));
        $highlights = [];
        
        if(is_array($data['resort_highlights'])){
            foreach($data['resort_highlights'] as $resort_highlight) {
                if(!isset($highlights[$resort_highlight->resort_id])) {
                    $highlights[$resort_highlight->resort_id] = [];
                }
                array_push($highlights[$resort_highlight->resort_id],$resort_highlight->resort_highlights);
            }
        }
        $data['resort_highlights'] = $highlights;

		$data['template'] = 'frontend/inspiration';

        // echo '<pre>';

        // print_r($data['expriencesCount']);

        // die();
        $this->load->view('templates/frontend_template', $data);

	}

    public function inspiration_resort_filter(){
        
        $data = array();
        
        $data['resorts']     = $this->developer_model->inspiration_resort_filter();
        
        // if(!empty($data['resorts'])) {
        //     foreach($data['resorts'] as $key=>$val) {
        //         $data['resorts'][$key]->airportType = $this->developer_model->user_international_airports($data['resorts'][$key]->id);
        //     }
        // }
        // echo "<pre>"; var_dump($data['resorts']); die;
        
        $data['resort_highlights'] = $this->common_model->get_result('resort_highlights', array('status'=>1), array(), array('id', 'asc'));
        $highlights = [];
        foreach($data['resort_highlights'] as $resort_highlight) {
            if(!isset($highlights[$resort_highlight->resort_id])) {
                $highlights[$resort_highlight->resort_id] = [];
            }
            array_push($highlights[$resort_highlight->resort_id],$resort_highlight->resort_highlights);
        }
        $data['resort_highlights'] = $highlights;

        // echo "<pre>";
        // print_r($data['resorts']);
        // exit;
        $this->load->view('frontend/inspiration_resort_result', $data);
	}

	public function inspiration_accommodation_categories(){
	    
		$data   = array();

		$offset = 0;

		$accommodations = $this->developer_model->inspiration_accommodation($offset,4);

		$data['accommodations'] = $accommodations;

        $this->load->view('frontend/inspiration_accommodation_result', $data);

	}
	
	public function inspiration_accommodation_filter(){
	   // var_dump($this->input->post()); die;
		$data   = array();

		$offset = 0;

		$accommodations = $this->developer_model->inspiration_accommodation($offset,4);

		$data['accommodations'] = $accommodations;

        $this->load->view('frontend/inspiration_accommodation_result', $data);

	}

	public function inspiration_accommodation_filter_more(){

		$data   = array();
        
        // echo $this->input->post('accommodation_offset');
        // die();
        
		$offset = $this->input->post('accommodation_offset')>2 ? $this->input->post('accommodation_offset') : 2;

		$data['accommodations'] = $this->developer_model->inspiration_accommodation($offset,4);

        $data['resort_highlights'] = $this->common_model->get_result('resort_highlights', array('status'=>1), array(), array('id', 'asc'));
        $highlights = [];
        
        foreach($data['resort_highlights'] as $resort_highlight) {
            if(!isset($highlights[$resort_highlight->resort_id])) {
                $highlights[$resort_highlight->resort_id] = [];
            }
            array_push($highlights[$resort_highlight->resort_id],$resort_highlight->resort_highlights);
        }
        
        $data['resort_highlights'] = $highlights;

		$ajaxSearchResult  = $this->load->view('frontend/inspiration_accommodation_result',$data, TRUE);

		

		$value = $this->output->set_output($ajaxSearchResult);

		echo json_encode($value);

		exit();

	}

	public function inspiration_experience_categories(){

		$expriences = $this->developer_model->inspiration_experience();

		$data['expriences'] = $expriences;

		$this->load->view('frontend/inspiration_experience_result', $data);

	}

    public function inspiration_experience_categories2(){

        $expriences = $this->developer_model->inspiration_experience2();

        $data['expriences'] = $expriences;

        $this->load->view('frontend/inspiration_experience_result', $data);

    }

	public function inspiration_experience_filter(){
        $limit = $this->input->post('experince_limit');
        $offset = $this->input->post('experince_offset');
        $resort_id = $this->input->post('resort_id');

		$data   = array();

		$expriences = $this->developer_model->inspiration_experience($limit,$offset);

		$data['expriences'] = $expriences;

		$this->load->view('frontend/inspiration_experience_result', $data);

	}

	public function inspiration_experience_filter_more(){
	    
        $limit = $this->input->post('experince_limit');
        //$offset = $this->input->post('experince_offset');
        $resort_id = $this->input->post('resort_id');
        
        $offset = $this->input->post('experince_offset');
// 		echo $offset;
// 		die();
		$data   = array();

		$expriences = $this->developer_model->inspiration_experience($limit, $offset);

		$data['expriences'] = $expriences;
		$data['offset'] = $offset;

		$ajaxSearchResult  = $this->load->view('frontend/inspiration_experience_result',$data, TRUE);

		$value = $this->output->set_output($ajaxSearchResult);

		echo json_encode($value);

		exit();



	}

	public function resort_experience_filter_more(){
        $limit = $this->input->post('limit');
        $offset = $this->input->post('offset');
        $resort_id = $this->input->post('resort_id');
        
		$data   = array();
		
		$expriences = $this->developer_model->resort_experience($limit,$offset);
		
// 		$offset = $this->input->post('experince_offset')>2?$this->input->post('experince_offset'):2;

// 		$expriences = $this->developer_model->resort_experience($offset,4);

		$data['offset'] = $offset;
		$data['expriences'] = $expriences;

		$ajaxSearchResult  = $this->load->view('frontend/resort_experience_result',$data, TRUE);

		$value = $this->output->set_output($ajaxSearchResult);

		echo json_encode($value);

		exit();



	}

    public function inspire_me() {  

        $data['holidays'] = $this->common_model->get_result('holidays', array('status'=>1));     

        $data['resorts']  = $this->common_model->get_result('resorts', array('status'=>1, 'admin_approved'=>1), array(), array('resort_name','asc'));  

        $data['caption']        = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/inspire_me'));

        if(!empty($data['caption']->id)){

            $data['caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['caption']->id));

        }   

        $data['template'] = 'frontend/inspire-me';

        $this->load->view('templates/frontend_template', $data);

    }

    public function resort_com() { 

        if($this->input->get('type')&&$this->input->get('type')==1){

            $where = array('resorts.status'=>1, 'resorts.admin_approved'=>1);            

            $not_data = array();

            if($this->input->post('resort_1')){

                $not_data[] = $this->input->post('resort_1');

            }

            if($this->input->post('resort_3')){

                $not_data[] = $this->input->post('resort_3');

            }

            $not_data = implode(',', $not_data);

            $resorts = $this->developer_model->get_compair_resort($where, $not_data);

            $secound_sql = $this->db->last_query();

            $secound_html = '<option value="">Choose...</option>';

            if(!empty($resorts)){

                foreach($resorts as $resort){                    

                    if($this->input->post('resort_2')&&$this->input->post('resort_2')==$resort->id){

                       $secound_html .= '<option selected value="'.$resort->id.'">'.$resort->resort_name.'</option>';

                    }else{

                       $secound_html .= '<option value="'.$resort->id.'">'.$resort->resort_name.'</option>';

                    }

                }

            }

            $where = array('resorts.status'=>1, 'resorts.admin_approved'=>1);

            $not_data = array();

            if($this->input->post('resort_1')){

                $not_data[] = $this->input->post('resort_1');

            }

            if($this->input->post('resort_2')){

                $not_data[] = $this->input->post('resort_2');

            }

            $not_data = implode(',', $not_data);

            $resorts = $this->developer_model->get_compair_resort($where, $not_data);

            $third_sql = $this->db->last_query();

            $third_html = '<option value="">Choose...</option>';

            if(!empty($resorts)){

                foreach($resorts as $resort){                    

                    if($this->input->post('resort_3')&&$this->input->post('resort_3')==$resort->id){

                       $third_html .= '<option selected value="'.$resort->id.'">'.$resort->resort_name.'</option>';

                    }else{

                       $third_html .= '<option value="'.$resort->id.'">'.$resort->resort_name.'</option>';

                    }

                }

            }

            $arr_data = array(  'secound_html'=>$secound_html, 

                                'third_html'=>$third_html, 

                                'secound_sql'=>$secound_sql, 

                                'third_sql'=>$third_sql

                            );

            echo json_encode($arr_data);

        }else if($this->input->get('type')&&$this->input->get('type')==2){

            $where = array('resorts.status'=>1, 'resorts.admin_approved'=>1);

            $not_data = array();

            if($this->input->post('resort_3')){

                $not_data[] = $this->input->post('resort_3');

            }

            if($this->input->post('resort_2')){

                $not_data[] = $this->input->post('resort_2');

            }

            $not_data = implode(',', $not_data);

            $resorts = $this->developer_model->get_compair_resort($where, $not_data);

            $secound_sql = $this->db->last_query();

            $first_html = '<option value="">Choose...</option>';

            if(!empty($resorts)){

                foreach($resorts as $resort){                    

                    if($this->input->post('resort_1')&&$this->input->post('resort_1')==$resort->id){

                       $first_html .= '<option selected value="'.$resort->id.'">'.$resort->resort_name.'</option>';

                    }else{

                       $first_html .= '<option value="'.$resort->id.'">'.$resort->resort_name.'</option>';

                    }

                }

            }

            $where = array('resorts.status'=>1, 'resorts.admin_approved'=>1);

            $not_data = array();

            if($this->input->post('resort_1')){

                $not_data[] = $this->input->post('resort_1');

            }

            if($this->input->post('resort_2')){

                $not_data[] = $this->input->post('resort_2');

            }

            $not_data = implode(',', $not_data);

            $resorts = $this->developer_model->get_compair_resort($where, $not_data);

            $third_sql = $this->db->last_query();

            $third_html = '<option value="">Choose...</option>';

            if(!empty($resorts)){

                foreach($resorts as $resort){                    

                    if($this->input->post('resort_3')&&$this->input->post('resort_3')==$resort->id){

                       $third_html .= '<option selected value="'.$resort->id.'">'.$resort->resort_name.'</option>';

                    }else{

                       $third_html .= '<option value="'.$resort->id.'">'.$resort->resort_name.'</option>';

                    }

                }

            }

            $arr_data = array(  'first_html'=>$first_html, 

                                'third_html'=>$third_html,

                                'secound_sql'=>$secound_sql, 

                                'third_sql'=>$third_sql

                            );

            echo json_encode($arr_data);

        }else if($this->input->get('type')&&$this->input->get('type')==3){

            /****************  first html ****************************/

            $where = array('resorts.status'=>1, 'resorts.admin_approved'=>1);  

            $not_data = array();

            if($this->input->post('resort_3')){

                $not_data[] = $this->input->post('resort_3');

            }

            if($this->input->post('resort_2')){

                $not_data[] = $this->input->post('resort_2');

            }

            $not_data = implode(',', $not_data);

            $resorts = $this->developer_model->get_compair_resort($where, $not_data);

            $secound_sql = $this->db->last_query();

            $first_html = '<option value="">Choose...</option>';

            if(!empty($resorts)){

                foreach($resorts as $resort){                    

                    if($this->input->post('resort_1')&&$this->input->post('resort_1')==$resort->id){

                       $first_html .= '<option selected value="'.$resort->id.'">'.$resort->resort_name.'</option>';

                    }else{

                       $first_html .= '<option value="'.$resort->id.'">'.$resort->resort_name.'</option>';

                    }

                }

            }

            /****************  secound html ****************************/

            $where = array('resorts.status'=>1, 'resorts.admin_approved'=>1);

            $not_data = array();

            if($this->input->post('resort_3')){

                $not_data[] = $this->input->post('resort_3');

            }

            if($this->input->post('resort_1')){

                $not_data[] = $this->input->post('resort_1');

            }

            $not_data = implode(',', $not_data);

            $resorts = $this->developer_model->get_compair_resort($where, $not_data);

            $third_sql = $this->db->last_query();

            $secound_html = '<option value="">Choose...</option>';

            if(!empty($resorts)){

                foreach($resorts as $resort){                    

                    if($this->input->post('resort_2')&&$this->input->post('resort_2')==$resort->id){

                       $secound_html .= '<option selected value="'.$resort->id.'">'.$resort->resort_name.'</option>';

                    }else{

                       $secound_html .= '<option value="'.$resort->id.'">'.$resort->resort_name.'</option>';

                    }

                }

            }

            $arr_data = array('first_html'=>$first_html, 

                              'secound_html'=>$secound_html,

                               'secound_sql'=>$secound_sql, 

                                'third_sql'=>$third_sql

                          );

            echo json_encode($arr_data);

        }

    }

    public function compare_htm() {

        $html = '';
        $images1 = array();
        $images2 = array();
        $images3 = array();
        if($this->input->post('resort_1')){
            $data['resort_one']    = array();
            $data['resort_one']    = $this->developer_model->resort_compair_detail($this->input->post('resort_1'));
            // $data['resort_one_acc_count']    = $this->developer_model->get_acco_Count($this->input->post('resort_1'));
            $data['resort_one_acc_count']    = $data['resort_one']->total_no_villas;
            $images1 = $this->common_model->get_result('images', array('item_id'=>$data['resort_one']->id, 'type'=>'resort'));
        }
        if($this->input->post('resort_2')){
            $data['resort_two'] = array();
            $data['resort_two']    = $this->developer_model->resort_compair_detail($this->input->post('resort_2'));
            // $data['resort_two_acc_count']    = $this->developer_model->get_acco_Count($this->input->post('resort_2'));
            $data['resort_two_acc_count']    = $data['resort_two']->total_no_villas;
            $images2 = $this->common_model->get_result('images', array('item_id'=>$data['resort_two']->id, 'type'=>'resort'));
        }
        if($this->input->post('resort_3')){
            $data['resort_three'] = array();
            $data['resort_three']    = $this->developer_model->resort_compair_detail($this->input->post('resort_3')); 
            // $data['resort_three_acc_count']    = $this->developer_model->get_acco_Count($this->input->post('resort_3'));
            $data['resort_three_acc_count']    = $data['resort_three']->total_no_villas;
            $images3 = $this->common_model->get_result('images', array('item_id'=>$data['resort_three']->id, 'type'=>'resort'));
        }

        $html .= '<div class="row">
            <div class="col-4">
                <figure>';
                    if(!empty($images1)) {
                        foreach($images1 as $image){
                            if(!empty($image->image_name) && file_exists('uploads/resorts/thumbnails/500_'.$image->image_name)) {
                                $html .= ' <img  class="d-block w-100 HomeImage" src="'.base_url().'uploads/resorts/thumbnails/500_'.$image->image_name.'" alt="resort" class="img-fluid"/>';
                            break;
                        }
                    }
                }
            if(isset($data['resort_one']->resort_name)) {
                $category = $this->common_model->get_row('mal_category', array('id'=>$data['resort_one']->resort_category));
                $state_name = $this->developer_model->resort_detail($data['resort_one']->id);
                $html .= '<a class="mt-1 hotel-caption" href="'.base_url().'/resort-detail?type=reviews&resort_id='.base64_encode($data['resort_one']->id).'">'.$data['resort_one']->resort_name.'</a>';
                    $html .= '<div class="d-flex">';
                        for($i=0;$i< $category->no_of_star;$i++){ 
                            $html .= '<i class="fa fa-star" aria-hidden="true" style="color:#FFC107;"></i>';
                        }
                        $html .= '<span class="description ml-0">'.$category->category_name.'</span></div>';
                        $html .= '<div class="hotel-inner-profile-name">'. !empty($state_name->state_name) ? ucfirst($state_name->state_name) : '';
                    //$html .= '</div>';
            }
            
            $html .= '</figure>
        </div>
        <div class="col-4">
            <figure>';
                if(!empty($images2)){
                    foreach($images2 as $image){
                        if(!empty($image->image_name) && file_exists('uploads/resorts/thumbnails/500_'.$image->image_name)){
                            $html .= ' <img  class="d-block w-100 HomeImage" src="'.base_url().'uploads/resorts/thumbnails/500_'.$image->image_name.'" alt="resort" class="img-fluid"/>';
                            break;
                        }
                    }
                }
                if(isset($data['resort_two']->resort_name)) {
                    $category = $this->common_model->get_row('mal_category', array('id'=>$data['resort_two']->resort_category));
                    $state_name = $this->developer_model->resort_detail($data['resort_two']->id);
                    $html .= '<a class="mt-1 hotel-caption" href="'.base_url().'/resort-detail?type=reviews&resort_id='.base64_encode($data['resort_two']->id).'">'.$data['resort_two']->resort_name.'</a><div class="d-flex">';
                    for($i=0;$i< $category->no_of_star;$i++){ 
                        $html .= '<i class="fa fa-star" aria-hidden="true" style="color:#FFC107;"></i>';
                    }
                    $html .= '<span class="description ml-0">'.$category->category_name.'</span></div>';
                    $html .= '<div class="hotel-inner-profile-name">'. !empty($state_name->state_name) ? ucfirst($state_name->state_name) : '';
                    //$html .= '</div>';
                }
            $html .= '</figure>
        </div>
        <div class="col-4">
            <figure>';
                if(!empty($images3)){
                    foreach($images3 as $image){
                        if(!empty($image->image_name) && file_exists('uploads/resorts/thumbnails/500_'.$image->image_name)){
                            $html .= ' <img  class="d-block w-100 HomeImage" src="'.base_url().'uploads/resorts/thumbnails/500_'.$image->image_name.'" alt="resort" class="img-fluid"/>';
                            break;
                        }
                    }
                }
                
                
                if(isset($data['resort_three']->resort_name)) {
                    $category = $this->common_model->get_row('mal_category', array('id'=>$data['resort_three']->resort_category));
                    $state_name = $this->developer_model->resort_detail($data['resort_three']->id);
                    $html .= '<a class="mt-1 hotel-caption" href="'.base_url().'/resort-detail?type=reviews&resort_id='.base64_encode($data['resort_three']->id).'">'.$data['resort_three']->resort_name.'</a><div class="d-flex">';
                    for($i=0;$i< $category->no_of_star;$i++){ 
                        $html .= '<i class="fa fa-star" aria-hidden="true" style="color:#FFC107;"></i>';
                    }
                    $html .= '<span class="description ml-0">'.$category->category_name.'</span></div>';
                    $html .= '<div class="hotel-inner-profile-name">'. !empty($state_name->state_name) ? ucfirst($state_name->state_name) : '';
                    //$html .= '</div>';
                }
                $html .= '</figure>
        </div>
    </div>';
    
    $result['resort_data'] = $html;
    $result['compair_data'] = $this->load->view('frontend/compare_htm', $data, TRUE);

        echo json_encode($result);
        exit;
    } 

	// Compare villa

	public function villa_type_accomandation(){

		$where = array('villatype.status'=>1);

		$villa_type = $this->input->get('villa_type')?$this->input->get('villa_type'):'';

		if($villa_type!=''){

			$where['acc.villa_type'] = $villa_type;

		}

		

		$villas = $this->developer_model->get_compare_villa($where, $not_data=array());

		$villa_select_html = '<option selected value="">Choose...</option>';

		if(!empty($villas)){

                foreach($villas as $villa){                    

                    $villa_select_html .= '<option value="'.$villa->id.'">'.$villa->name_of_villa.'</option>';

				}

            }

		 $arr_data = array('villa_select_html'=>$villa_select_html);

        echo json_encode($arr_data);

		exit;

	}

	public function villa_compare() { 

        if($this->input->get('type')&&$this->input->get('type')==1){

            $where = array('villatype.status'=>1);            

            $not_data = array();

            if($this->input->post('villa_type_1')){

                $not_data[] = $this->input->post('villa_type_1');

            }

            if($this->input->post('villa_type_3')){

                $not_data[] = $this->input->post('villa_type_3');

            }

            $not_data = implode(',', $not_data);

            $villas = $this->developer_model->get_compare_villa($where, $not_data);

            $secound_html = '<option value="">Choose...</option>';

            if(!empty($villas)){

                foreach($villas as $villa){                    

                    if($this->input->post('villa_type_2')&&$this->input->post('villa_type_2')==$villa->id){

                       $secound_html .= '<option selected value="'.$villa->id.'">'.$villa->villa_type_name.'</option>';

                    }else{

                       $secound_html .= '<option value="'.$villa->id.'">'.$villa->villa_type_name.'</option>';

                    }

                }

            }

            $where = array('villatype.status'=>1);

            $not_data = array();

            if($this->input->post('villa_type_1')){

                $not_data[] = $this->input->post('villa_type_1');

            }

            if($this->input->post('villa_type_2')){

                $not_data[] = $this->input->post('villa_type_2');

            }

            $not_data = implode(',', $not_data);

            $villas = $this->developer_model->get_compare_villa($where, $not_data);

            $third_html = '<option value="">Choose...</option>';

            if(!empty($villas)){

                foreach($villas as $villa){                    

                    if($this->input->post('villa_type_2')&&$this->input->post('villa_type_2')==$villa->id){

                       $third_html .= '<option selected value="'.$villa->id.'">'.$villa->villa_type_name.'</option>';

                    }else{

                       $third_html .= '<option value="'.$villa->id.'">'.$villa->villa_type_name.'</option>';

                    }

                }

            }

            $arr_data = array(  'villa_secound_html'=>$secound_html, 

                                'villa_third_html'=>$third_html, 

                                );

            echo json_encode($arr_data);

        }else if($this->input->get('type')&&$this->input->get('type')==2){

            $where = array('villatype.status'=>1);

            $not_data = array();

            if($this->input->post('villa_type_3')){

                $not_data[] = $this->input->post('villa_type_3');

            }

            if($this->input->post('villa_type_2')){

                $not_data[] = $this->input->post('villa_type_2');

            }

            $not_data = implode(',', $not_data);

            $villas = $this->developer_model->get_compare_villa($where, $not_data);

            $first_html = '<option value="">Choose...</option>';

            if(!empty($villas)){

                foreach($villas as $villa){                    

                    if($this->input->post('villa_type_1')&&$this->input->post('villa_type_1')==$villa->id){

                       $first_html .= '<option selected value="'.$villa->id.'">'.$villa->villa_type_name.'</option>';

                    }else{

                       $first_html .= '<option value="'.$villa->id.'">'.$villa->villa_type_name.'</option>';

                    }

                }

            }

            $where = array('villatype.status'=>1);

            $not_data = array();

            if($this->input->post('villa_type_1')){

                $not_data[] = $this->input->post('villa_type_1');

            }

            if($this->input->post('villa_type_2')){

                $not_data[] = $this->input->post('villa_type_2');

            }

            $not_data = implode(',', $not_data);

            $villas = $this->developer_model->get_compare_villa($where, $not_data);

            $third_html = '<option value="">Choose...</option>';

            if(!empty($villas)){

                foreach($villas as $villas){                    

                    if($this->input->post('villa_type_3')&&$this->input->post('villa_type_3')==$villas->id){

                       $third_html .= '<option selected value="'.$villas->id.'">'.$villas->villa_type_name.'</option>';

                    }else{

                       $third_html .= '<option value="'.$villas->id.'">'.$villas->villa_type_name.'</option>';

                    }

                }

            }

            $arr_data = array(  'villa_first_html'=>$first_html, 

                                'villa_third_html'=>$third_html,

                          

                            );

            echo json_encode($arr_data);

        }else if($this->input->get('type')&&$this->input->get('type')==3){

            /****************  first html ****************************/

              $where = array('villatype.status'=>1);

            $not_data = array();

            if($this->input->post('villa_type_3')){

                $not_data[] = $this->input->post('villa_type_3');

            }

            if($this->input->post('villa_type_2')){

                $not_data[] = $this->input->post('villa_type_2');

            }

            $not_data = implode(',', $not_data);

            $villas = $this->developer_model->get_compare_villa($where, $not_data);

            $secound_sql = $this->db->last_query();

            $first_html = '<option value="">Choose...</option>';

            if(!empty($villas)){

                foreach($villas as $villa){                    

                    if($this->input->post('villa_type_1')&&$this->input->post('villa_type_1')==$villa->id){

                       $first_html .= '<option selected value="'.$villa->id.'">'.$villa->villa_type_name.'</option>';

                    }else{

                       $first_html .= '<option value="'.$villa->id.'">'.$villa->villa_type_name.'</option>';

                    }

                }

            }

            /****************  secound html ****************************/

           $where = array('villatype.status'=>1);

            $not_data = array();

            if($this->input->post('villa_type_3')){

                $not_data[] = $this->input->post('villa_type_3');

            }

            if($this->input->post('villa_type_1')){

                $not_data[] = $this->input->post('villa_type_1');

            }

            $not_data = implode(',', $not_data);

            $villas = $this->developer_model->get_compare_villa($where, $not_data);

            $secound_html = '<option value="">Choose...</option>';

            if(!empty($villas)){

                foreach($villas as $villa){                    

                    if($this->input->post('resort_2')&&$this->input->post('resort_2')==$villas->id){

                       $secound_html .= '<option selected value="'.$villa->id.'">'.$villa->villa_type_name.'</option>';

                    }else{

                       $secound_html .= '<option value="'.$villa->id.'">'.$villa->villa_type_name.'</option>';

                    }

                }

            }

            $arr_data = array('villa_first_html'=>$first_html, 

                              'villa_secound_html'=>$secound_html,

                              );

            echo json_encode($arr_data);

        }

    }

    public function compare_villa_htm() {
        $html = '';
        $images1 = array();
        $images2 = array();
        $images3 = array();
        $data['villas']  = $this->common_model->get_result('accommodation', array(), array(), array('id','asc'));  
        
        if($this->input->post('villa_type_1')){
            $data['villa_one']    = $this->developer_model->villa_compare_detail($this->input->post('villa_type_1'));
            //  var_dump($data['villa_one']); die;
            $images1 = $this->common_model->get_result('images', array('item_id'=>$data['villa_one']->id, 'type'=>'accommodation'));
        }
        
        // var_dump($data['villa_one']->id);
        if($this->input->post('villa_type_2')){
            $data['villa_two']    = $this->developer_model->villa_compare_detail($this->input->post('villa_type_2'));
            $images2 = $this->common_model->get_result('images', array('item_id'=>$data['villa_two']->id, 'type'=>'accommodation'));
        }
        
        if($this->input->post('villa_type_3')){
            $data['villa_three']    = $this->developer_model->villa_compare_detail($this->input->post('villa_type_3'));
            $images3 = $this->common_model->get_result('images', array('item_id'=>$data['villa_three']->id, 'type'=>'accommodation'));
        }
        
        $html .= '<div class="row">
        <div class="col-4">
            <figure>';
           //var_dump($data['accommodations']->photos); die;
            // var_dump($images1);
            if(!empty($images1)){
                foreach($images1 as $image){
                    
                    if(!empty($image->image_name) && file_exists('uploads/resorts/thumbnails/500_'.$image->image_name)){
                        $html .= ' <img  class="d-block w-100 HomeImage" src="'.base_url().'uploads/resorts/thumbnails/500_'.$image->image_name.'" alt="resort" class="img-fluid"/>';
                    //   $html .= ' <img  class="d-block w-100" src="'.base_url().'uploads/resorts/thumbnails/500_'.$image->image_name.'" alt="resort" class="img-fluid"/>';
                       
                        break;
                    }
                }
            }                
            $html .= '</figure>
        </div>
        <div class="col-4">
            <figure>';
                if(!empty($images2)){
                    foreach($images2 as $image){
                        if(!empty($image->image_name) && file_exists('uploads/resorts/thumbnails/500_'.$image->image_name)){
                            $html .= ' <img  class="d-block w-100 HomeImage" src="'.base_url().'uploads/resorts/thumbnails/500_'.$image->image_name.'" alt="resort" class="img-fluid"/>';
                            break;
                        }
                    }
                }
            $html .= '</figure>
        </div>
        <div class="col-4">
            <figure>';
                if(!empty($images3)){
                    foreach($images3 as $image){
                        if(!empty($image->image_name) && file_exists('uploads/resorts/thumbnails/500_'.$image->image_name)){
                            $html .= ' <img  class="d-block w-100 HomeImage" src="'.base_url().'uploads/resorts/thumbnails/500_'.$image->image_name.'" alt="resort" class="img-fluid"/>';
                            break;
                        }
                    }
                }
                $html .= '</figure>
        </div>
    </div>';
    
    $result['villa_data'] = $html;
    $result['villa_compare_data'] = $this->load->view('frontend/compare_villa_htm', $data, TRUE);
    echo json_encode($result);
    exit;
		

		 if($this->input->post('villa_type_1')){

			$data['villa_one']    = $this->developer_model->villa_compare_detail($this->input->post('villa_type_1'));

		

			if(!empty($data['villa_one'])){

				

				$villa_data_1         = '<div class="compare-pic resort-pic">

											<div class="book-btn-top"><a href="#" class="book-btn">Book</a></div>

											<a href="'.base_url().'resort-detail?resort_id='.base64_encode($data['villa_one']->resort_id).'">

												<div class="resort-caption">';

				$images = $this->common_model->get_result('images', array('item_id'=>$data['villa_one']->resort_id, 'type'=>'resort'));

				$img    = 0;

				$villa_data_1         .= '<div id="carouselExampleIndicators_'.$data['villa_one']->id.'" class="carousel slide" data-ride="carousel"><ol class="carousel-indicators">';

				if(!empty($images)){

					foreach($images as $image){

						$img_cl = ($img==0)?'active':'';

						$villa_data_1 .= ' <li data-target="#carouselExampleIndicators_'.$data['villa_one']->id.'" data-slide-to="'.$img.'" class="'.$img_cl.'"></li>';

					$img++;

					}

				}

				$villa_data_1 .= '</ol><div class="carousel-inner">';

				$img = 1;                                   

				if(!empty($images)){

					foreach($images as $image){

						

						

						if(!empty($image->image_name) && file_exists('uploads/resorts/thumbnails/150_'.$image->image_name)){

							 $villa_data_1 .= ($img==1)?'<div class="carousel-item active">':'<div class="carousel-item">';

							$villa_data_1 .= ' <img  class="d-block w-100" src="'.base_url().'uploads/resorts/thumbnails/150_'.$image->image_name.'" alt="resort"/>';

							$villa_data_1 .= '</div>';

							$img++;

						}

					}

				}

				$villa_data_1 .= '</div><a class="carousel-control-prev" href="#carouselExampleIndicators_'.$data['villa_one']->id.'" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carouselExampleIndicators_'.$data['villa_one']->id.'" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a></div></div>'; 

				$html['villa_data_1']  = $villa_data_1;

			}else{

				$html['villa_data_1']  = '';

				$html['villa_one']  = array();

			}

			

        } 

        if($this->input->post('villa_type_2')){

			 $data['villa_two'] = array();

            $data['villa_two']    = $this->developer_model->villa_compare_detail($this->input->post('villa_type_2'));

            if(!empty($data['villa_two'])){

				$villa_data_2         = '<div class="compare-pic resort-pic">

											<div class="book-btn-top"><a href="#" class="book-btn">Book</a></div>

											<a href="'.base_url().'resort-detail?resort_id='.base64_encode($data['villa_two']->resort_id).'">

												<div class="resort-caption">';

				$images = $this->common_model->get_result('images', array('item_id'=>$data['villa_two']->resort_id, 'type'=>'resort'));

				$img    = 0;

				 $villa_data_2         .= '<div id="carouselExampleIndicators_'.$data['villa_two']->id.'" class="carousel slide" data-ride="carousel"><ol class="carousel-indicators">';

				if(!empty($images)){

					foreach($images as $image){

						$img_cl = ($img==0)?'active':'';

						$villa_data_2 .= ' <li data-target="#carouselExampleIndicators_'.$data['villa_two']->id.'" data-slide-to="'.$img.'" class="'.$img_cl.'"></li>';

					$img++;

					}

				}

				$villa_data_2 .= '</ol><div class="carousel-inner">';

				$img = 1;                                   

				if(!empty($images)){

					foreach($images as $image){

						if(!empty($image->image_name)&& file_exists('uploads/resorts/thumbnails/150_'.$image->image_name)){

							$villa_data_2 .= ($img==1)?'<div class="carousel-item active">':'<div class="carousel-item">';

							$villa_data_2 .= ' <img  class="d-block w-100" src="'.base_url().'uploads/resorts/thumbnails/150_'.$image->image_name.'" alt="resort"/>';

							$villa_data_2 .= '</div>';

							$img++;

						}

					}

				}

				$villa_data_2 .= '</div><a class="carousel-control-prev" href="#carouselExampleIndicators_'.$data['villa_two']->id.'" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carouselExampleIndicators_'.$data['villa_two']->id.'" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a></div></div>'; 

				$html['villa_data_2']  = $villa_data_2;

			}else{

				$html['villa_data_2']  = '';

				$html['villa_two']  = array();

			}

        } 

        if($this->input->post('villa_type_3')){

			

            $data['villa_three']    = $this->developer_model->villa_compare_detail($this->input->post('villa_type_3')); 

             if(!empty($data['villa_three'])){

				 

				$villa_data_3           = '<div class="compare-pic resort-pic">

											<div class="book-btn-top"><a href="#" class="book-btn">Book</a></div>

											<a href="'.base_url().'resort-detail?resort_id='.base64_encode($data['villa_three']->resort_id).'">

												<div class="resort-caption">';

				$images = $this->common_model->get_result('images', array('item_id'=>$data['villa_three']->resort_id, 'type'=>'resort'));

				$img             = 0;

				$villa_data_3  .= '<div id="carouselExampleIndicators_'.$data['villa_three']->id.'" class="carousel slide" data-ride="carousel"><ol class="carousel-indicators">';

				if(!empty($images)){

					foreach($images as $image){

						$img_cl = ($img==0)?'active':'';

						$villa_data_3 .= ' <li data-target="#carouselExampleIndicators_'.$data['villa_three']->id.'" data-slide-to="'.$img.'" class="'.$img_cl.'"></li>';

					$img++;

					}

				}

				$villa_data_3 .= '</ol><div class="carousel-inner">';

				$img = 1;                                   

				if(!empty($images)){

					foreach($images as $image){

						if(!empty($image->image_name)&&file_exists('uploads/resorts/thumbnails/150_'.$image->image_name)){

							$villa_data_3 .= ($img==1)?'<div class="carousel-item active">':'<div class="carousel-item">';

							$villa_data_3 .= ' <img  class="d-block w-100" src="'.base_url().'uploads/resorts/thumbnails/150_'.$image->image_name.'" alt="resort"/>';

							$villa_data_3 .= '</div>';

							$img++;

						}

					}

				}

				$villa_data_3 .= '</div><a class="carousel-control-prev" href="#carouselExampleIndicators_'.$data['villa_three']->id.'" role="button" data-slide="prev"><span class="carousel-control-prev-icon" aria-hidden="true"></span><span class="sr-only">Previous</span></a><a class="carousel-control-next" href="#carouselExampleIndicators_'.$data['villa_three']->id.'" role="button" data-slide="next"><span class="carousel-control-next-icon" aria-hidden="true"></span><span class="sr-only">Next</span></a></div></div>'; 

				$html['villa_data_3']  = $villa_data_3;

			}else{

				$html['villa_data_3']  = '';

				$html['villa_three']  = array();

			}

        } 

		

        $html['villa_compare_data'] = $this->load->view('frontend/compare_villa_htm', $data, TRUE);

        echo json_encode($html);

    } 

    public function resort_detail() {    

        if($this->input->get('resort_id')){

            $resort_id = base64_decode($this->input->get('resort_id'));

			$data['resort_id'] = $resort_id;

            if(!empty($resort_id)&&is_numeric($resort_id)){

                // addthisresortid

                $data['resort_id']=$resort_id;

                // addthisresortid

                

                $data['resort'] = $this->developer_model->resort_detail($resort_id);
                
                $data['Resortimages'] = $this->common_model->get_result('images', array('item_id'=>$data['resort']->id, 'type'=>'resort','iscoverImage'=>1));                

                $data['resort_faqs'] = $this->common_model->get_result('resorts_faq', array('resort_id'=>$data['resort']->id, 'delete_flag'=>'0'));                

                $data['spa_images']   = $this->common_model->get_result('images', array('item_id'=>$data['resort']->id, 'type'=>'spa'));
                
                $data['sport_images']   = $this->common_model->get_result('images', array('item_id'=>$data['resort']->id, 'type'=>'sport'));
                
                $data['fac_images']   = $this->common_model->get_result('images', array('item_id'=>$data['resort']->id, 'type'=>'facility'));

                $data['international_airports'] = $this->developer_model->resort_international_airports($data['resort']->id);

                $data['sports']       = $this->developer_model->resort_sports($data['resort']->sports);

                $data['water_sports'] = $this->developer_model->resort_water_sports($data['resort']->water_sports);

                $data['holiday_styles'] = $this->developer_model->resort_holiday_style($data['resort']->holiday_styles);

                $data['villas']         = $this->developer_model->resort_villas($data['resort']->id);

				// Experience

				$join1  = array(array('join_table'=>'mal_resorts AS resorts','join_on'=>	

				'resorts.id = act.resort_id','join_type'=>'inner'),array('join_table'=>'mal_brand AS brand','join_on'=>	

				'brand.id = resorts.brand_id','join_type'=>'inner'),array('join_table'=>'mal_states AS state','join_on'=>	

				'state.id = resorts.physical_state','join_type'=>'inner')); 



				$where = array('resort_id'=>$data['resort']->id);

		        $where1 = array();
				$groupby = "act.id";

				$orderby = "act.id";

				$limit = 3;

				// $expriences  = $this->common_model->getjoinwhere("act.*,resort_name,state_name,resort_category,resort_description,island_name,brand_name",'mal_activitie_excursions'." as act",$join1,$where1,$groupby,$orderby,$limit); 
				$expriences  = $this->common_model->getjoinwhere("act.*,resort_name,state_name,resort_category,resort_description,
				island_name,brand_name",'mal_activitie_excursions'." as act",$join1,$where,$groupby,$orderby,$limit);
				
				$data['expriencesCount']  = $this->common_model->getjoinwhere("act.*,resort_name,state_name,resort_category,resort_description,
				island_name,brand_name",'mal_activitie_excursions'." as act",$join1,$where,$groupby,$orderby);

                $data['expriences'] = $expriences;

                $data['activitys']      = $expriences;

               // $data['activitys']      = $this->common_model->get_result('activitie_excursions', array('resort_id'=>$data['resort']->id));

				
		        $data['experince_offset'] = 0;

				$data['experience_categories'] = $this->common_model->get_result('experience_category', array('status'=> 1), array(), array('exp_cat_id', 'ASC'));

                $data['villa_types']    = $this->common_model->get_result('villa_type');

                $data['accommodationAminity']      = $this->developer_model->accommodationAminnityIds(); 

				// $data['meal_serveds']           = $this->common_model->get_result('meal_served', array('status'=>1)); 
				$data['meal_serveds']   = $this->common_model->get_result('meal_served', array('status'=>1), array(), array('id', 'asc'));


                $data['accommodations']         = $this->developer_model->resort_accommodation($data['resort']->id, PER_PAGE_VILLA);

                $data['accommodationsBottoms']  = $this->developer_model->resort_accommodation($data['resort']->id, 100);                

                $data['accommodation_count']    = $this->developer_model->resort_accommodation($data['resort']->id, 0, 'count');

                //echo 'accommodation_count = '.$data['accommodation_count'];exit();

                $data['amenitys']       = $this->developer_model->resort_amenitys($data['accommodationAminity']);

				$data['facilities']      = $this->developer_model->get_filter_data('facilities', 'facilities', 'multi', array('facilities.facility_name', 'ASC'));

			    $data['dinnings']       = $this->developer_model->resort_dinnings($data['resort']->id, DINE_VILLA); 

                $data['dinning_count']  = $this->developer_model->resort_dinnings($data['resort']->id, 0, 'count');

                $data['categorys']      = $this->common_model->get_result('traveller_categorys', array('status'=>'1'));                 

                $data['complimentary_services']  = $this->common_model->get_result('complimentary_services', array('status'=>'1', 'resort_id'=>$data['resort']->id));

                $data['resort_storys']  = $this->common_model->get_result('resort_stories', array('status'=>'1', 'resort_id'=>$data['resort']->id)); 

                $data['food_types']     = $this->common_model->get_result('food_types', array('status'=>1));     

				$data['traveller_categorys']      = $this->common_model->get_result('traveller_categorys', array('status'=>'1'));  

        		$data['kids_club']       = $this->common_model->get_row('kids_club', array('resort_id'=>$resort_id));

				$data['divecenter_club']       = $this->common_model->get_row('divecenter_club', array('resort_id'=>$resort_id));

				$data['watersports_club']       = $this->common_model->get_row('watersports_club', array('resort_id'=>$resort_id));		

                $data['stories']        = $this->developer_model->get_traveller_stories($resort_id, 0, 0, 3);

                $data['Resortstories']  = $this->developer_model->resort_stories_new($resort_id);


            }else{

                redirect(base_url());

            }

        }else{

            redirect(base_url());

        } 
        $data['template']    = 'frontend/resort-detail';

        $this->load->view('templates/frontend_template', $data);

    }    

    public function test_distance($lat1='',$lng1='',$lat2='',$lng2='') {

        /*echo distance(32.9697, -96.80322, 29.46786, -98.53506, "K") . " Kilometers<br>";

        echo distance(32.9697, -96.80322, 29.46786, -98.53506, "N") . " Nautical Miles<br>";

        echo distance(32.9697, -96.80322, 29.46786, -98.53506, "M") . " Miles<br>";*/

        echo 'Ex :<br/>';

        echo 'Indore -  Dewas  '.distance(22.7196, 75.8577, 22.9623, 76.0508, "N") . " nautical miles<br>";

        echo 'Ari Atoll, Athuruga Island, Maldives -  Kuredu, Maldives   '.distance(3.887260, 72.816154, 5.539629, 73.447853, "N") . " nautical miles<br>";

        echo 'Ukulhas, Maldives -  Maldives Islands, the Maldives    '.distance(4.215128, 72.864471,1.924992, 73.399658, "N") . " nautical miles<br><br><br>";

        if(!empty($lat1)){

        	echo 'calculate distance b/t your data : '.distance($lat1,$lng1,$lat2,$lng2, "N") . " nautical miles<br>";

        }



        echo '<br/><br/><br/>';

        echo 'Indore -  Dewas  '.distance(22.7196, 75.8577, 22.9623, 76.0508, "K") . " Kilometers miles<br>";

        echo 'Ari Atoll, Athuruga Island, Maldives -  Kuredu, Maldives   '.distance(3.887260, 72.816154, 5.539629, 73.447853, "K") . " Kilometers miles<br>";

        echo 'Ukulhas, Maldives -  Maldives Islands, the Maldives    '.distance(4.215128, 72.864471,1.924992, 73.399658, "K") . " Kilometers miles<br><br><br>";

        if(!empty($lat1)){

        	echo 'calculate distance b/t your data : '.distance($lat1,$lng1,$lat2,$lng2, "K") . " Kilometers miles<br>";

        }

    }

    public function calculate_distance() {

        //echo '<pre>';;print_r($_POST);

    	$other_resort = '<option value="">Select</option>';

        $distance_places  = $this->common_model->get_result('distance_place', array('status'=>1));

    	if($this->input->post('resort_first')){

            $fi_arr = explode('_', $this->input->post('resort_first'));

            if(!empty($fi_arr[0])&&$fi_arr[0]=='resort'){

    		    $resort_first = $this->common_model->get_row('resorts', array('id'=>$fi_arr[1]));

        		$lat1 = !empty($resort_first->physical_lat)?$resort_first->physical_lat:'';    		

        		$lng1 = !empty($resort_first->physical_lng)?$resort_first->physical_lng:'';

            }else if(!empty($fi_arr[0])&&$fi_arr[0]=='place'){

                $resort_first = $this->common_model->get_row('distance_place', array('id'=>$fi_arr[1]));

                $lat1 = !empty($resort_first->latitude)?$resort_first->latitude:'';         

                $lng1 = !empty($resort_first->longitude)?$resort_first->longitude:'';

            }

    		if($this->input->post('type')&&$this->input->post('type')==1){   			

	    		$resorts   = $this->developer_model->maldives_resorts_places(); 

	    		if(!empty($resorts)){

	              	foreach($resorts as $resort){

	              		if($this->input->post('resort_second')&&$this->input->post('resort_second')==$resort->type.'_'.$resort->id){

	                 		$other_resort .= '<option selected value="'.$resort->type.'_'.$resort->id.'">'.$resort->title.'</option>';

	              		}else if(empty($this->input->post('resort_first'))||$this->input->post('resort_first')!=$resort->type.'_'.$resort->id){

	              			$other_resort .= '<option value="'.$resort->type.'_'.$resort->id.'">'.$resort->title.'</option>';

	              		}

	              	}

	            } 		

    		}

    	}

    	if($this->input->post('resort_second')){

            $fi_arr = explode('_', $this->input->post('resort_second'));

            if(!empty($fi_arr[0])&&$fi_arr[0]=='resort'){

                $resort_first = $this->common_model->get_row('resorts', array('id'=>$fi_arr[1]));

                $lat2 = !empty($resort_first->physical_lat)?$resort_first->physical_lat:'';         

                $lng2 = !empty($resort_first->physical_lng)?$resort_first->physical_lng:'';

            }else if(!empty($fi_arr[0])&&$fi_arr[0]=='place'){

                $resort_first = $this->common_model->get_row('distance_place', array('id'=>$fi_arr[1]));

                $lat2 = !empty($resort_first->latitude)?$resort_first->latitude:'';         

                $lng2 = !empty($resort_first->longitude)?$resort_first->longitude:'';

            }

    		if($this->input->post('type')&&$this->input->post('type')==2){

	    		$resorts   = $this->developer_model->maldives_resorts_places(); 

	    		if(!empty($resorts)){

	              	foreach($resorts as $resort){

	              		if($this->input->post('resort_first')&&$this->input->post('resort_first')==$resort->type.'_'.$resort->id){

	                 		$other_resort .= '<option selected value="'.$resort->type.'_'.$resort->id.'">'.$resort->title.'</option>';

	              		}else if(empty($this->input->post('resort_second'))||$this->input->post('resort_second')!=$resort->type.'_'.$resort->id){

	              			$other_resort .= '<option value="'.$resort->type.'_'.$resort->id.'">'.$resort->title.'</option>';

	              		}

	              	}

	           }

	        }    		

    	}

    	$distance = '';

        if(!empty($lat1)&&!empty($lng1)&&!empty($lat2)&&!empty($lng2)){

        	$nm   = distance($lat1,$lng1,$lat2,$lng2, "N");

        	$km   = distance($lat1,$lng1,$lat2,$lng2, "K");

        	$distance .= number_format($nm, 3). " Nm or ";

        	$distance .= number_format($km, 3). " km";

        	$Seaplan_time    = ($km/222.24)*60;

        	$Speed_boat_time = ($km/55.56)*60;

            $Seaplan         = round($Seaplan_time);

            if($Seaplan>60){

                $Seaplan_time_minutes = round($Seaplan);

                $Seaplan = floor(($Seaplan_time_minutes/60))." hour ".floor(($Seaplan_time_minutes%60))." minutes";

            }else{

                $Seaplan = round($Seaplan)." minutes";

            }

            $Speed_boat         = round($Speed_boat_time);

            if($Speed_boat>60){

                $Speed_boat_minutes = round($Speed_boat);

                $Speed_boat = floor(($Speed_boat_minutes/60))." hour ".floor(($Speed_boat_minutes%60))." minutes";

            }else{

                $Speed_boat = round($Speed_boat)." minutes";

            }

        }        

        echo json_encode(array('other_resort'=>$other_resort, 'distance'=>$distance, 'seaplan'=>$Seaplan, 'speed_boat'=>$Speed_boat));

    }

    public function resort_stories_new() {

    	
        
        $resort_id = $this->input->post('resort_id')?$this->input->post('resort_id'):'';
        
        $data['stories']  = $this->developer_model->resort_stories_new($resort_id);

        $html = $this->load->view('frontend/resort_stories_new', $data, TRUE);    
        
        echo json_encode($html);

    }

    public function read_more_rs_story_new() {

    	
        $response         = array('status'=>'true'); 

        $resort_id        = $this->input->post('resort_id')?$this->input->post('resort_id'):'';

        $page_num         = ($this->input->get('page_num'))?$this->input->get('page_num'):0;             

        $data['resort_storys']  = $this->developer_model->get_rs_stories_new('', $page_num, PER_PAGE_STORY);

    

        $total_pages      = $this->developer_model->get_rs_stories_new('');
        
        $html = $this->load->view('frontend/read_more_rs_story', $data, TRUE);    

        $response['html'] 	     = $html;

        $response['total_pages'] = $total_pages;

        echo json_encode($response);

    }
      public function read_more_rs_story_filter() {

       
        $response         = array('status'=>'true'); 

        $resort_id        = $this->input->post('resort_id')?$this->input->post('resort_id'):'';

        $page_num         = ($this->input->get('page_num'))?$this->input->get('page_num'):0;             
        //resort_storys
        //$data['stories']  = $this->developer_model->get_rs_stories($resort_id, $page_num, PER_PAGE_STORY);
        $total_pages      = $this->developer_model->get_rs_stories($resort_id);
        $data['resort_storys']  = $this->developer_model->get_rs_stories($resort_id, $page_num, PER_PAGE_STORY);

        $html = $this->load->view('frontend/read_more_rs_story', $data, TRUE);    
        //$html = $this->load->view('frontend/reviews', $data, TRUE);    

        $response['html']         = $html;

        $response['total_pages'] = $total_pages;
        echo json_encode($response);

    }

    public function share_resort_story() {

        if($this->input->get('story_id')){            

            $data['resort_story']  = $this->common_model->get_row('resort_stories', array('id'=>base64_decode($this->input->get('story_id'))));

            $data['caption']        = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/reviews'));

            if(!empty($data['caption']->id)){

	            $data['caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['caption']->id));

	        }

            $data['template']    = 'frontend/share_resort_story';

            $this->load->view('templates/frontend_template', $data);

        }

    } 

    public function share_story() {

        if($this->input->get('story_id')){            

            $data['story']    = $this->common_model->get_row('traveller_stories', array('id'=>base64_decode($this->input->get('story_id'))));

            $data['images'] = $this->common_model->get_result('images', array('status'=>'1', 'item_id'=>base64_decode($this->input->get('story_id')), 'type'=>'traveller_story')); 

            $data['caption']        = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/reviews'));

            if(!empty($data['caption']->id)){

	            $data['caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['caption']->id));

	        }

            $data['template'] = 'frontend/share_story';

            $this->load->view('templates/frontend_template', $data);

        }

    } 

    public function save_comment_resort() { 

        $response = array('status'=>'true', 'message'=>'');    

        if (user_logged_in()) {     

            if($this->input->post('resort_story_id')){

                $whrr['user_id']          = user_id();

                $whrr['resort_story_id']  = $this->input->post('resort_story_id');

                $whrr['comment_name']     = $this->input->post('comment');

                $this->common_model->insert('resort_story_comments', $whrr);

                /********** activity Report *******************/

                $story_id  = $this->input->post('resort_story_id');

                $notified  = $this->developer_model->get_resort_story_user($story_id);

                //print_r($notified_user ); exit();

                $notified_user = !empty($notified->user_id)?$notified->user_id:"";

                $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'resort_stories_comment', 'activity_id'=>$story_id, 'created_date'=>date('Y-m-d H:i:s'));

                $this->common_model->insert('guest_activities', $inserted_data);

                /********** activity Report *******************/ 

                $data['total_comments'] = $this->developer_model->getResortStoryComments($this->input->post('resort_story_id'),0,0);

                $data['comments'] = $this->developer_model->getResortStoryComments($this->input->post('resort_story_id'),0, PER_PAGE_COMMENTS);

                if(!empty($data['total_comments'])&&$data['total_comments']>PER_PAGE_COMMENTS){

                    $data['more_comment'] = 'show';

                }else{

                    $data['more_comment'] = 'hide';

                } 

                $data['resort_story_id']        = $this->input->post('resort_story_id');

                $html     = $this->load->view('frontend/resort_comment_list', $data, TRUE);

                $response = array(

                                'status'  => 'true', 

                                'html'    => $html, 

                                'message' => 'Your comment is saved successfully', 

                                'more_comment'   => $data['more_comment'],

                                'total_comments' => $data['total_comments']

                            );

            }

        }else{

            $response = array('status'=>'false', 'message'=>'The user is not logged in,  <a href="'.base_url('login?type=resort_story_comment&story_id='.base64_encode($this->input->post('resort_story_id'))).'">click here</a> to login');

        }

        echo json_encode($response);

    }

    public function loadResortMoreComment() { 

        if($this->input->get('current_page')&&$this->input->get('total_comments')){

            $offset = $this->input->get('current_page');

            $data['total_comments']  = $this->input->get('total_comments');

            $data['comments']        = $this->developer_model->getResortStoryComments($this->input->get('resort_story_id'), $offset, PER_PAGE_COMMENTS);

            $data['resort_story_id'] = $this->input->get('resort_story_id');

        }

        $pages['current_page'] = !empty($offset)?$offset+PER_PAGE_COMMENTS:1;

        if(!empty($data['total_comments'])&&$data['total_comments']<=$pages['current_page']){

            $pages['more_comment'] = 'hide';

        }else{          

            $pages['more_comment'] = 'show';

        }      

        /*$pages['checko'] = ' total_comments = '.$data['total_comments'].' offset= '.$pages['current_page'];*/

        $pages['html'] = $this->load->view('frontend/resort_comment_list', $data, TRUE);

        echo json_encode($pages);        

    }

    public function loadTravellerMoreComment() { 

        $data = array();

        if($this->input->get('current_page')&&$this->input->get('total_comments')){

            $offset                  = $this->input->get('current_page');

            $data['total_comments']  = $this->input->get('total_comments');

            $data['comments']        = $this->developer_model->getTravellerStoryComments($this->input->get('story_id'), $offset, PER_PAGE_COMMENTS);

            $data['story_id']   = $this->input->get('story_id');

        }

        $pages['current_page']  = !empty($offset)?$offset+PER_PAGE_COMMENTS:1;

        if(!empty($data['total_comments'])&&$data['total_comments']<=$pages['current_page']){

            $pages['more_comment'] = 'hide';

        }else{          

            $pages['more_comment'] = 'show';

        }    

        $pages['html'] = $this->load->view('frontend/resort_comment_list', $data, TRUE);

        echo json_encode($pages);        

    }

    public function save_comment_traveller() { 

        $response = array('status'=>'true', 'message'=>'');    

        if (user_logged_in()) {     

            if($this->input->post('story_id')){

                $whrr['user_id']      = user_id();

                $whrr['story_id']     = $this->input->post('story_id');

                $whrr['comment_name'] = $this->input->post('comment');

                $comment_id =  $this->common_model->insert('traveller_stories_comments', $whrr);

                /********** activity Report *******************/

                $story_id  = $this->input->post('story_id');

                $notified  = $this->developer_model->get_story_user($story_id);

                //print_r($notified_user ); exit();

                $notified_user = !empty($notified->user_id)?$notified->user_id:"";

                $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'traveller_stories_comment', 'activity_id'=>$comment_id, 'created_date'=>date('Y-m-d H:i:s'));

                $this->common_model->insert('guest_activities', $inserted_data);

                /********** activity Report *******************/ 

                $data['total_comments'] = $this->developer_model->getTravellerStoryComments($this->input->post('story_id'),0,0);

                $data['comments']       = $this->developer_model->getTravellerStoryComments($this->input->post('story_id'),0, PER_PAGE_COMMENTS);

                if(!empty($data['total_comments'])&&$data['total_comments']>PER_PAGE_COMMENTS){

                    $data['more_comment'] = 'show';

                }else{

                    $data['more_comment'] = 'hide';

                } 

                $data['story_id']         = $this->input->post('story_id');

                $html     = $this->load->view('frontend/resort_comment_list', $data, TRUE);

                $response = array(

                                'status'  => 'true', 

                                'html'    => $html, 

                                'message' => 'Your comment is saved successfully', 

                                'more_comment'   => $data['more_comment'],

                                'total_comments' => $data['total_comments']

                            );

            }

        }else{

            $response = array('status'=>'false', 'message'=>'The user is not logged in,  <a href="'.base_url('login?type=traveller_story_comment&story_id='.base64_encode($this->input->post('story_id'))).'">click here</a> to login');

        }

        echo json_encode($response);

    }

    public function share_socail_media() { 

        $response = array('status'=>'true', 'message'=>'');    

        if (user_logged_in()) {     

            /********** activity Report *******************/

            if($this->input->post('type')&&$this->input->post('type')=='blog_share'){                

                $blog_id       = $this->input->post('blog_id');

                $row           = $this->common_model->get_row('news_blog', array('id'=>$blog_id));

                $notified_user = $row->news_added_user;

                $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'blog_share', 'activity_id'=>$blog_id, 'created_date'=>date('Y-m-d H:i:s'), 'socail_type'=>$this->input->post('socail_type'));

                $this->common_model->insert('guest_activities', $inserted_data);

            }

            if($this->input->post('type')&&$this->input->post('type')=='traveller_story_share'){

                $story_id      = $this->input->post('story_id');

                $notified  	   = $this->developer_model->get_story_user($story_id);

                $notified_user = !empty($notified->user_id)?$notified->user_id:"";

                $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'traveller_story_share', 'activity_id'=>$story_id, 'created_date'=>date('Y-m-d H:i:s'), 'socail_type'=>$this->input->post('socail_type'));

                $this->common_model->insert('guest_activities', $inserted_data);

            }

            if($this->input->post('type')&&$this->input->post('type')=='resort_story_share'){

                $story_id      = $this->input->post('story_id');

                $notified  	   = $this->developer_model->get_resort_story_user($story_id);

                $notified_user = !empty($notified->user_id)?$notified->user_id:"";

                $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'resort_story_share', 'activity_id'=>$story_id, 'created_date'=>date('Y-m-d H:i:s'), 'socail_type'=>$this->input->post('socail_type'));

                $this->common_model->insert('guest_activities', $inserted_data);

            }

            /********** activity Report *******************/                 

        }else{

            $login_url = base_url().'login?type=blog_share&blog_id='.base64_encode($this->input->get('blog_id'));

            $response = array('status'=>'false', 'message'=>'The user is not logged in,  <a href="'.$login_url.'">click here</a> to login');

        }

        echo json_encode($response);

    }

    public function save_like_unlike() { 

        $response = array('status'=>'true', 'message'=>'');    

        if (user_logged_in()) {     

            if($this->input->get('blog_id')){

                $whrr = array('new_blog_id'=>$this->input->get('blog_id'), 'user_id'=>user_id());

                if($this->common_model->get_row('blog_likes', $whrr)){

                    $this->common_model->delete('blog_likes', $whrr);

                    $likes = get_all_count('blog_likes', array('new_blog_id'=>$this->input->get('blog_id')));

                    $likes = !empty($likes)?$likes:'';

                    $html  = '<div><img src="'.FRONT_THEAM_PATH.'img/unlike.png" alt="thumb-like"/></div>

                                <div class="number-like danger">'.$likes.'</div>';

                    $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                    /********** activity Report *******************/

                    $blog_id       = $this->input->get('blog_id');

                    $row           = $this->common_model->get_row('news_blog', array('id'=>$blog_id));

                    $notified_user = $row->news_added_user;

                    $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'blog_unlike', 'activity_id'=>$blog_id, 'created_date'=>date('Y-m-d H:i:s'));

                    $this->common_model->insert('guest_activities', $inserted_data);

                    /********** activity Report *******************/

                }else{

                    $this->common_model->insert('blog_likes', $whrr);

                    $html = '<div><img src="'.FRONT_THEAM_PATH.'img/like.png" alt="thumb-like"/></div><div class="number-like danger">'.get_all_count('blog_likes', array('new_blog_id'=>$this->input->get('blog_id'))).'</div>';

                    $response = array('status'=>'true', 'html'=>$html, 'message'=>'');  

                    /********** activity Report *******************/

                    $blog_id       = $this->input->get('blog_id');

                    $row           = $this->common_model->get_row('news_blog', array('id'=>$blog_id));

                    $notified_user = $row->news_added_user;

                    $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'blog_like', 'activity_id'=>$blog_id, 'created_date'=>date('Y-m-d H:i:s'));

                    $this->common_model->insert('guest_activities', $inserted_data);

                    /********** activity Report *******************/        

                }

            }

        }else{

            $login_url = base_url().'login?type=blog_like&blog_id='.base64_encode($this->input->get('blog_id'));

            $response = array('status'=>'false', 'message'=>'The user is not logged in,  <a href="'.$login_url.'">click here</a> to login');

        }

        echo json_encode($response);

    }

    public function save_resort_like_unlike() { 

        $response = array('status'=>'true', 'message'=>'');    

        if (user_logged_in()) {     

            if($this->input->get('resort_id')){

                $whrr = array('resort_id'=>$this->input->get('resort_id'), 'user_id'=>user_id());

                if($this->common_model->get_row('resorts_likes', $whrr)){

                    $this->common_model->delete('resorts_likes', $whrr);

                    $likes = get_all_count('resorts_likes', array('resort_id'=>$this->input->get('resort_id')));

                    $likes = !empty($likes)?number_format($likes, 0):'';

                    /********** activity Report *******************/

                    $resort_id     = $this->input->get('resort_id');

                    $row           = $this->common_model->get_row('resorts', array('id'=>$resort_id));

                    $notified_user = $row->user_id;

                    $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'resorts_unlike', 'activity_id'=>$resort_id, 'created_date'=>date('Y-m-d H:i:s'));

                    $this->common_model->insert('guest_activities', $inserted_data);

                    /********** activity Report *******************/

                    $html  = '<span class="fa fa-heart-o MyheartIcon" aria-hidden="true" style="padding-right:1px;"></span><strong>'.$likes.'</strong>';

                    $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                }else{

                    $this->common_model->insert('resorts_likes', $whrr);

                    /********** activity Report *******************/

                    $resort_id     = $this->input->get('resort_id');

                    $row           = $this->common_model->get_row('resorts', array('id'=>$resort_id));

                    $notified_user = $row->user_id;

                    $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'resorts_like', 'activity_id'=>$resort_id, 'created_date'=>date('Y-m-d H:i:s'));

                    $this->common_model->insert('guest_activities', $inserted_data);

                    /********** activity Report *******************/

                    $likes = get_all_count('resorts_likes', array('resort_id'=>$this->input->get('resort_id')));

                    $likes = !empty($likes)?number_format($likes, 0):'';

                    $html  = '<span class="fa fa-heart MyheartIcon" aria-hidden="true" style="padding-right:1px;"></span><strong>'.$likes.'</strong>';

                    $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                }

            }

        }else{

            $response = array('status'=>'not_login_in', 'message'=>'The user is not logged in,  <a href="'.base_url('home/login').'">click here</a> to login', 'login_url'=>base_url().'login?type=resort_like&resort_id='.base64_encode($this->input->get('resort_id')));

        }

        echo json_encode($response);

    }

    public function save_resort_story_like_unlike() { 

        $response = array('status'=>'true', 'message'=>'');    

        if (user_logged_in()) {     

            if($this->input->get('story_id')){

                $whrr = array('story_id'=>$this->input->get('story_id'), 'user_id'=>user_id());

                $story_id  = $this->input->get('story_id');

                $notified  = $this->developer_model->get_story_user($story_id);

                //print_r($notified_user ); exit();

                $notified_user = !empty($notified->user_id)?$notified->user_id:"";

                if($this->common_model->get_row('resort_story_likes', $whrr)){

                    $this->common_model->delete('resort_story_likes', $whrr);

                    $likes = get_all_count('resort_story_likes', array('story_id'=>$this->input->get('story_id')));

                    $likes = !empty($likes)?number_format($likes, 0):'';

                    $html  = '<span><img src="'.FRONT_THEAM_PATH.'images/dishelpful.png" alt="thumb-like"/></span><span class="number-like danger">'.$likes.'</span>';

                    /********** activity Report *******************/

                    $inserted_data = array('user_id'=>user_id(), 

                                        'notified_user'=> $notified_user, 

                                        'type'=>'resort_story_unlike', 

                                        'activity_id'=>$story_id, 

                                        'created_date'=>date('Y-m-d H:i:s')

                                    );

                    $this->common_model->insert('guest_activities', $inserted_data);

                    $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                }else{

                    $this->common_model->insert('resort_story_likes', $whrr);

                    $likes = get_all_count('resort_story_likes', array('story_id'=>$this->input->get('story_id')));

                    $likes = !empty($likes)?number_format($likes, 0):'';

                    $html  = '<span><img src="'.FRONT_THEAM_PATH.'images/Helpful.png" alt="thumb-like"/></span><span class="number-like danger">'.$likes.'</span>';

                    $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                    $inserted_data = array('user_id'=>user_id(), 

                                                    'notified_user'=> $notified_user, 

                                                    'type'=>'resort_story_like', 

                                                    'activity_id'=>$story_id, 

                                                    'created_date'=>date('Y-m-d H:i:s')

                                                );

                    $this->common_model->insert('guest_activities', $inserted_data);

                }

            }

        }else{

            $login_url = base_url().'login?type=resort_story_like&story_id='.base64_encode($this->input->get('story_id'));

            $response = array('status'=>'false', 'message'=>'The user is not logged in,  <a href="'.$login_url.'">click here</a> to login');

        }

        echo json_encode($response);

    }

    public function save_traveller_like_unlike() { 

        $response = array('status'=>'true', 'message'=>'');    

        if (user_logged_in()) {     

            if($this->input->get('story_id')){

                $whrr = array('story_id'=>$this->input->get('story_id'), 'user_id'=>user_id());

                if($this->common_model->get_row('traveller_stories_like', $whrr)){

                    $this->common_model->delete('traveller_stories_like', $whrr);

                    $likes = get_all_count('traveller_stories_like', array('story_id'=>$this->input->get('story_id')));

                    $likes = !empty($likes)?number_format($likes, 0):'';

                    $html  = '<span><img src="'.FRONT_THEAM_PATH.'images/dishelpful.png" alt="thumb-like"/></span><span class="number-like danger">'.$likes.'</span>';

                    $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                    /********** activity Report *******************/

                    $story_id = $this->input->get('story_id');

                    $notified  = $this->developer_model->get_story_user($story_id);

                    //print_r($notified_user ); exit();

                    $notified_user = !empty($notified->user_id)?$notified->user_id:"";

                    $inserted_data = array('user_id'=>user_id(), 

                                        'notified_user'=> $notified_user, 

                                        'type'=>'traveller_story_unlike', 

                                        'activity_id'=>$story_id, 

                                        'created_date'=>date('Y-m-d H:i:s')

                                    );

                    $this->common_model->insert('guest_activities', $inserted_data);

                    $this->session->set_flashdata('msg_success', 'Traveller story is unliked');

                    /********** activity Report *******************/

                }else{

                    $this->common_model->insert('traveller_stories_like', $whrr);

                    $likes = get_all_count('traveller_stories_like', array('story_id'=>$this->input->get('story_id')));

                    $likes = !empty($likes)?number_format($likes, 0):'';

                    $html  = '<span><img src="'.FRONT_THEAM_PATH.'images/Helpful.png" alt="thumb-like"/></span><span class="number-like danger">'.$likes.'</span>';

                    $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                    /********** activity Report *******************/

                    $story_id  = $this->input->get('story_id');

                    $notified  = $this->developer_model->get_story_user($story_id);

                    //print_r($notified_user ); exit();

                    $notified_user = !empty($notified->user_id)?$notified->user_id:"";

                    $inserted_data = array('user_id'=>user_id(), 

                                        'notified_user'=> $notified_user, 

                                        'type'=>'traveller_story_like', 

                                        'activity_id'=>$story_id, 

                                        'created_date'=>date('Y-m-d H:i:s')

                                    );

                    $this->common_model->insert('guest_activities', $inserted_data);

                }

            }

        }else{

            $login_url = base_url().'login?type=traveller_story_like&story_id='.base64_encode($this->input->get('story_id'));

            $response = array('status'=>'false', 'message'=>'The user is not logged in,  <a href="'.$login_url .'">click here</a> to login');

        }

        echo json_encode($response);

    }

    public function save_dinning_like_unlike() { 

        $response = array('status'=>'true', 'message'=>'');    

        if (user_logged_in()) {     

            if($this->input->get('dinning_id')){

                $whrr = array('dinning_id'=>$this->input->get('dinning_id'), 'user_id'=>user_id());

                $dining_id = $this->input->get('dinning_id');

                if($this->common_model->get_row('dinnings_likes', $whrr)){

                    $this->common_model->delete('dinnings_likes', $whrr);

                    $likes = get_all_count('dinnings_likes', array('dinning_id'=>$this->input->get('dinning_id')));

                    $likes = !empty($likes)?$likes:'';

                    $html  = '<span class="fa fa-heart-o" aria-hidden="true"></span><strong>&nbsp;&nbsp;'.$likes.'</strong>';

                    $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                    $notified  = $this->developer_model->get_dining_user($dining_id);

                    //print_r($notified_user ); exit();

                    $notified_user = !empty($notified->user_id)?$notified->user_id:"";

                    /********** activity Report *******************/

                    $inserted_data = array('user_id'=>user_id(), 

                                        'notified_user'=> $notified_user, 

                                        'type'=>'dining_unlike', 

                                        'activity_id'=>$dining_id, 

                                        'created_date'=>date('Y-m-d H:i:s')

                                    );

                    $this->common_model->insert('guest_activities', $inserted_data);

                }else{

                    $this->common_model->insert('dinnings_likes', $whrr);

                    $likes = get_all_count('dinnings_likes', array('dinning_id'=>$this->input->get('dinning_id')));

                    $likes = !empty($likes)?number_format($likes, 0):'';

                    $html = '<span class="fa fa-heart" aria-hidden="true"></span><strong>&nbsp;&nbsp;'.$likes.'</strong>';

                    $response = array('status'=>'true', 'html'=>$html, 'message'=>''); 

                    $notified  = $this->developer_model->get_dining_user($dining_id);

                    $notified_user = !empty($notified->user_id)?$notified->user_id:"";

                    /********** activity Report *******************/

                    $inserted_data = array('user_id'=>user_id(), 

                                        'notified_user'=> $notified_user, 

                                        'type'=>'dining_like', 

                                        'activity_id'=>$dining_id, 

                                        'created_date'=>date('Y-m-d H:i:s')

                                    );     

                    $this->common_model->insert('guest_activities', $inserted_data);    

                }

            }

        }else{

            $response = array('status'=>'not_login_in', 'message'=>'The user is not logged in,  <a href="'.base_url('home/login').'">click here</a> to login', 'login_url'=>base_url().'login?type=dinning_like&dinning_id='.base64_encode($this->input->get('dinning_id')));

        }

        echo json_encode($response);

    }

    public function save_accommodation_like_unlike() { 

	

        $response = array('status'=>'true', 'message'=>'');    

        if (user_logged_in()) {     

            if($this->input->get('accommodation_id')){

                $whrr = array('accommodation_id'=>$this->input->get('accommodation_id'), 'user_id'=>user_id());

                if($this->common_model->get_row('accommodations_likes', $whrr)){
                    
                    $this->common_model->delete('accommodations_likes', $whrr);

                    $likes = get_all_count('accommodations_likes', array('accommodation_id'=>$this->input->get('accommodation_id')));

                    $likes = !empty($likes)?number_format($likes, 0):'';

                    $html  = '<span class="fa fa-heart-o  MyheartIcon" aria-hidden="true"></span><strong>&nbsp;'.$likes.'</strong>';

                    $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                    /********** activity Report *******************/

                    $accommodation_id = $this->input->get('accommodation_id');

                    $notified_user = $this->developer_model->get_accommodation_user($accommodation_id);

                    $notified_user = $notified_user->user_id;

                    $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'accommodation_unlike', 'activity_id'=>$accommodation_id, 'created_date'=>date('Y-m-d H:i:s'));

                    $this->common_model->insert('guest_activities', $inserted_data);

                    /********** activity Report *******************/

                }else{                    

                    $this->common_model->insert('accommodations_likes', $whrr);

                    $likes = get_all_count('accommodations_likes', array('accommodation_id'=>$this->input->get('accommodation_id')));

                    $likes = !empty($likes)?number_format($likes, 0):'';

                    $html = '<span class="fa fa-heart  MyheartIcon" aria-hidden="true"></span><strong>&nbsp;'.$likes.'</strong>';

                    /********** activity Report *******************/

                    $accommodation_id = $this->input->get('accommodation_id');

                    $notified_user = $this->developer_model->get_accommodation_user($accommodation_id);

                    $notified_user = $notified_user->user_id;

                    $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'accommodation_like', 'activity_id'=>$accommodation_id, 'created_date'=>date('Y-m-d H:i:s'));

                    $this->common_model->insert('guest_activities', $inserted_data);

                    /********** activity Report *******************/

                    $response = array('status'=>'true', 'html'=>$html, 'message'=>'');          

                }

            }

        }else{

			$login_url = base_url().'login?type=accommodation_like&accommodation_id='.base64_encode($this->input->get('accommodation_id')); 

            $response = array('status'=>'not_login_in', 'message'=>'The user is not logged in,  <a href="'.base_url('home/login').'">click here</a> to login', 'login_url'=>$login_url);

        }

        echo json_encode($response);

    }

	public function save_exprince_like_unlike() { 

        $response = array('status'=>'true', 'message'=>'');    

        if (user_logged_in()) {     

            if($this->input->get('exprience_id')){

                $whrr = array('exprience_id'=>$this->input->get('exprience_id'), 'user_id'=>user_id());

                if($this->common_model->get_row('exprience_likes', $whrr)){

                    $this->common_model->delete('exprience_likes', $whrr);

                    $likes = get_all_count('exprience_likes', array('exprience_id'=>$this->input->get('exprience_id')));

                    $likes = !empty($likes)?number_format($likes, 0):'';

                    $html  = '<span class="fa fa-heart-o" aria-hidden="true"></span><strong>&nbsp;&nbsp;'.$likes.'</strong>';

                    $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                    /********** activity Report *******************/

                    $exprience_id = $this->input->get('exprience_id');

                    $notified_user = $this->developer_model->get_exprience_user($exprience_id);

                    $notified_user = $notified_user->user_id;

                    $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'exprience_unlike', 'activity_id'=>$exprience_id, 'created_date'=>date('Y-m-d H:i:s'));

                    $this->common_model->insert('guest_activities', $inserted_data);

                    /********** activity Report *******************/

                }else{                    

                    $this->common_model->insert('exprience_likes', $whrr);

                    $likes = get_all_count('exprience_likes', array('exprience_id'=>$this->input->get('exprience_id')));

                    $likes = !empty($likes)?number_format($likes, 0):'';

                    $html = '<span class="fa fa-heart" aria-hidden="true"></span><strong>&nbsp;&nbsp;'.$likes.'</strong>';

                    /********** activity Report *******************/

                    $exprience_id = $this->input->get('exprience_id');

                    $notified_user = $this->developer_model->get_exprience_user($exprience_id);

                    $notified_user = $notified_user->user_id;

                    $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'exprience_like', 'activity_id'=>$exprience_id, 'created_date'=>date('Y-m-d H:i:s'));

                    $this->common_model->insert('guest_activities', $inserted_data);

                    /********** activity Report *******************/

                    $response = array('status'=>'true', 'html'=>$html, 'message'=>'');          

                }

            }

        }else{

			$login_url = base_url().'login?type=experince_like&experince_id='.base64_encode($this->input->get('exprience_id'));

            $response = array('status'=>'not_login_in', 'message'=>'The user is not logged in,  <a href="'.base_url('home/login').'">click here</a> to login', 'login_url'=>$login_url);

        }

        echo json_encode($response);

    }

    public function accommodation_form_filter() {    

        $data                        = array();

        $data['accommodations']      = $this->developer_model->resort_accommodation($this->input->post('resort_id'));

        $data['accommodation_count'] = $this->developer_model->resort_accommodation($this->input->post('resort_id'), 0, 'count');
        
        $data['resort'] = $this->developer_model->resort_detail($this->input->post('resort_id'));
                
        // echo $data['accommodations']; exit();

        $this->load->view('frontend/accommodation_result', $data);

    }

    public function show_all_accommodation() {

        if($this->input->get('resort_id')){            
            
            $data['resort'] = $this->developer_model->resort_detail($this->input->get('resort_id'));
                
            $data['accommodations'] = $this->developer_model->resort_accommodation($this->input->get('resort_id'));

            $this->load->view('frontend/accommodation_result', $data);

        }

    }    

    public function amenities_details($amenities) {    

        $data       = array();

        $amenities  = $this->common_model->get_result('amenities', array('status'=>1));

        $row        = $this->common_model->get_row('resorts', array('id'=>$this->input->get('resort_id')));

        $resortAmenities = array();

        if(!empty($row->amenities)){

           $resortAmenities = explode(',', $row->amenities);

        }

        if(!empty($amenities)&&!empty($resortAmenities)){

            echo '<ul class="facility_list_data">';

            foreach ($amenities as $amenitie) {

                if(!empty($amenitie->amenitie_icon)&&file_exists('uploads/amenities/thumbnails/'.$amenitie->amenitie_icon)&&in_array($amenitie->id, $resortAmenities)){

                    echo '<li><img src="'.base_url().'uploads/amenities/thumbnails/'.$amenitie->amenitie_icon.'"><div class="amenities-title">'.$amenitie->amenitie_name.'</div></li>';



                }

            }

            echo '</ul>';  

        }else{

        echo    '<div class="not-found">

                    

                    <div class="clearfix"></div>

                        <h4>No Resort Amenities!</h4>

                        <span>We couldn’t find any resort amenity matching the criteria.</span>

                    </div>

                ';

        }     

    } 

	public function facilities_details() {    

        $data       = array();

        $facilities  = $this->common_model->get_result('facilities', array('status'=>1));

        $row        = $this->common_model->get_row('resorts', array('id'=>$this->input->get('resort_id')));

        $resortAmenities = array();

        if(!empty($row->facilities)){

           $resortFacilities = explode(',', $row->facilities);

        }

		

        if(!empty($facilities) && !empty($resortFacilities)){

            echo '<ul class="facility_list_data">';

            foreach ($facilities as $facilitie) {

				if(in_array($facilitie->id, $resortFacilities)){

                    echo '<li><div class="amenities-title">'.$facilitie->facility_name.'</div></li>';

				}



            }

            echo '</ul>';  

        }else{

        echo    '<div class="not-found">

                    

                    <div class="clearfix"></div>

                        <h4>No Resort Amenities!</h4>

                        <span>We couldn’t find any resort amenity.</span>

                    </div>

                ';

        }     

    }
    
    
	public function resort_map() {    

        $data       = array();

        $facilities  = $this->common_model->get_result('facilities', array('status'=>1));

        $row        = $this->common_model->get_row('resorts', array('id'=>$this->input->get('resort_id')));
        

        if(!empty($row->resort_map)){

            echo '<img src="'.base_url().'uploads/resorts/'.$row->resort_map.'">';

        }else{

        echo    '<div class="not-found">

                    

                    <div class="clearfix"></div>

                        <h4>No Resort Map!</h4>

                        <span>We couldn’t find any resort map.</span>

                    </div>

                ';

        }     

    }
    
    
	public function dining_menu() {    

        $data       = array();

        $row        = $this->common_model->get_row('dinnings_meal_served', array('id'=>$this->input->get('dinning_id')));

        if(!empty($row->menu_chart)){

            echo '<embed src="'.base_url().'uploads/resorts/'.$row->menu_chart.'" class="menu_ebmed"/>';

        }else{

        echo    '<div class="not-found">

                    

                    <div class="clearfix"></div>

                        <h4>No Menu Chart!</h4>

                        <span>We couldn’t find any menu chart.</span>

                    </div>

                ';

        }     

    }

    public function accommodation_amenities_details() {    

        $data       = array();

		$amenities = $this->common_model->get_result('amenities', array('status'=>1));

        $row        =  $this->common_model->get_row('accommodation', array('id'=>$this->input->get('id')));

		//echo $this->db->last_query();

        $resortAmenities = array();

        if(!empty($row->amenities)){

           $resortAmenities = explode(',', $row->amenities);

        }

        echo '<ul class="facility_list_data">';

        if(!empty($amenities)){

            foreach ($amenities as $aminity) {

                if(in_array($aminity->id, $resortAmenities)){

                    echo '<li>';

                    if(!empty($aminity->amenitie_icon)&& file_exists('uploads/amenities/thumbnails/'.$aminity->amenitie_icon)){

                        echo '<div><img src="'.base_url().'uploads/amenities/thumbnails/'.$aminity->amenitie_icon.'" width="50" height="50"/></div>';

                    }else{

                        echo '<div class=""><img src="'.base_url().'img/amenities-icon1.png" /></div>';

                    }

                    echo '<div class="amenities-title">'.$aminity->amenitie_name.'</div></li>';

                }

            }

        }  

        echo '</ul>';      

    }

    public function dinning_form_filter() {

        $data                   = array();
        
        $data['dinnings']       = $this->developer_model->resort_dinnings($this->input->post('resort_id'), 3); 

        $data['dinning_count']  = $this->developer_model->resort_dinnings($this->input->post('resort_id'), 0, 'count');

        $data['template']       = 'frontend/dinning_result';

        $this->load->view('frontend/dinning_result', $data);

    }    

    public function show_all_dinnings() {

        if($this->input->get('resort_id')){            

            $data['dinnings'] = $this->developer_model->resort_dinnings($this->input->get('resort_id'));

            //echo $this->db->last_query(); exit();

            $this->load->view('frontend/dinning_result', $data);

        }

    }      

    public function save_comment() { 

    	$response = array('status'=>'true', 'message'=>'');    

    	if (user_logged_in()) { 	

	    	if($this->input->post('blog_id')){

	    		$whrr['user_id'] 	  = user_id();

	    		$whrr['new_blog_id']  = $this->input->post('blog_id');

	    		$whrr['comment_name'] = $this->input->post('comment');

	    		$comment_id = $this->common_model->insert('blog_comments', $whrr);

                /********** activity Report *******************/

                $blog_id       = $this->input->post('blog_id');

                $row           = $this->common_model->get_row('news_blog', array('id'=>$blog_id));

                $notified_user = $row->news_added_user;

                $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'blog_comment', 'activity_id'=>$comment_id, 'created_date'=>date('Y-m-d H:i:s'));

                $this->common_model->insert('guest_activities', $inserted_data);

                /********** activity Report *******************/        

	    		$data['total_comments'] = $this->developer_model->getBlogComments($this->input->post('blog_id'),0,0);

	    		$data['comments'] = $this->developer_model->getBlogComments($this->input->post('blog_id'),0, PER_PAGE_COMMENTS);

	    		if(!empty($data['total_comments'])&&$data['total_comments']>PER_PAGE_COMMENTS){

		    		$data['more_comment'] = 'show';

		    	}else{

		    		$data['more_comment'] = 'hide';

		    	} 

		    	$data['blog_id']  	    = $this->input->post('blog_id');

    			$html     = $this->load->view('frontend/blog_comment_list', $data, TRUE);

    			$response = array('status'=>'true', 'html'=>$html, 'message'=>'Your comment is saved successfully');

	    	}

	    }else{

	    	$response = array('status'=>'false', 'message'=>'The user is not logged in,  <a href="'.base_url('login?type=blog_comment&blog_id='.base64_encode($this->input->post('blog_id'))).'">click here</a> to login');

	    }

	    echo json_encode($response);

    }

    public function blogs($offset=NULL) {    

        $custags = "";
        if($this->input->get('custags')){
            $custags = $this->input->get('custags');
        }
        $data               = $this->blog_filter_list($offset,$custags);
        
        $category = "";
        if($this->input->get('category')){
            $category = $this->input->get('category');
        }
        $data               = $this->blog_filter_list($offset,$category);

        $data['caption']    = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/blogs'));

        if(!empty($data['caption']->id)){

            $data['caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption','item_id'=>$data['caption']->id));

        }  
        $data['tags']       = $this->developer_model->get_blogs_tags();
        
        $data['blog_cats']       = $this->developer_model->get_blogs_cats();

        
        
        // echo '<pre>';

        // print_r($data['blog_cats']);

        // die();

        $data['template']   = 'frontend/blog';

        $this->load->view('templates/frontend_template', $data);

    } 

    public function blog_details($offset=NULL) {      	

    	$data = $this->blog_filter_list($offset,"");  

		

    	if($this->input->get('blog_id')){

            if(is_numeric($this->input->get('blog_id'))){

                $blog_id    = $this->input->get('blog_id');

            }else{

    		    $blog_id    = base64_decode($this->input->get('blog_id'));

            }
            
    		$data['row'] 			= $this->developer_model->news_blog_details($blog_id);

			$data['total_comments'] = $this->developer_model->getBlogComments($blog_id, 0, 0);

            $data['comments']       = $this->developer_model->getBlogComments($blog_id, 0, PER_PAGE_COMMENTS);

           	$data['images'] 		= $this->common_model->get_result('images', array('item_id'=>$blog_id, 'type'=>'blog'));

	    	$data['blog_id']  	    = $blog_id;

    	}else{

            $data['row']            = $this->developer_model->news_blog_details();

    		$data['total_comments'] = $this->developer_model->getBlogComments($data['row']->id, 0, 0);

            $data['comments']       = $this->developer_model->getBlogComments($data['row']->id, 0, PER_PAGE_COMMENTS);

	    	$data['images'] 		= $this->common_model->get_result('images', array('item_id'=>$data['row']->id, 'type'=>'blog'));

	    	$data['blog_id']  	    = $data['row']->id;

    	}  

    	if(!empty($data['total_comments'])&&$data['total_comments']>PER_PAGE_COMMENTS){

    		$data['more_comment'] = 'show';

    	}else{

    		$data['more_comment'] = 'hide';

    	}     

        $data['caption']    = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/blogs'));	

        $data['tags']       = $this->developer_model->get_blogs_tags();
        
        $custags = "";
        if($data['row']->tags){
			$tagArr = [];
			if(strpos($data['row']->tags,",") >-1) {
				$splitTags = explode(",",$data['row']->tags);
				foreach($splitTags as $key=>$val) {
					if(!array_search($val,$tagArr)) {
						$tagArr[] = $val;
					}
				}
			} else {
				$tagArr[] = $data['row']->tags;
			}
			if(!empty($tagArr)) {
				foreach($tagArr as $k=>$v) {
				    $custags = $v;
				}		
			}
        }
        
        $category = "";
        if($data['row']->blog_category){
            $category = $data['row']->blog_category;
        }
        // $data['recent_blogs'] = $this->blog_filter_list($offset,$custags);
        
        // $data['recent_blogs'] = $this->developer_model->get_recent_blogs($custags);
        $data['recent_blogs'] = $this->developer_model->get_similar_blogs($category);
        
        $data['blog_cats']       = $this->developer_model->get_blogs_cats();
        $data['template']   = 'frontend/blog_details';

        // echo '<pre>';

        // print_r($data['recent_blogs']);

        // die();

        $this->load->view('templates/frontend_template', $data);

    }

    public function loadBlogMoreComment() { 

        if($this->input->get('current_page')&&$this->input->get('total_comments')){

            $offset = $this->input->get('current_page');

            $data['total_comments'] = $this->input->get('total_comments');

            $data['comments']       = $this->developer_model->getBlogComments($this->input->get('blog_id'), $offset, PER_PAGE_COMMENTS);

            $data['blog_id']       = $this->input->get('blog_id');

        }

        $pages['current_page'] = !empty($offset)?$offset+PER_PAGE_COMMENTS:PER_PAGE_COMMENTS;

        if(!empty($data['total_comments'])&&$data['total_comments']<$pages['current_page']){

            $pages['more_comment'] = 'hide';

        }else{          

            $pages['more_comment'] = 'show';

        }       

        $pages['html'] = $this->load->view('frontend/blog_comment_list', $data, TRUE);

        echo json_encode($pages);        

    }   

    public function delete_favorites_resort() { 

        $response = array('status'=>'true', 'message'=>'');    

        if (user_logged_in()) {     

            if($this->input->get('resort_id')){

                $whrr = array('resort_id'=>$this->input->get('resort_id'), 'user_id'=>user_id());

                if($this->common_model->get_row('resorts_likes', $whrr)){

                    $this->common_model->delete('resorts_likes', $whrr);

                    /********** activity Report *******************/

                    $html  = '<span class="fa fa-heart-o" aria-hidden="true"></span><strong>&nbsp;&nbsp;'.$likes.'</strong>';

                    $response = array('status'=>'true', 'html'=>$html, 'message'=>'');

                }

            }

        }else{

            $response = array('status'=>'not_login_in', 'message'=>'The user is not logged in,  <a href="'.base_url('home/login').'">click here</a> to login', 'login_url'=>base_url().'login?type=resort_like&resort_id='.base64_encode($this->input->get('resort_id')));

        }

        echo json_encode($response);

    } 

    public function delete_story() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('story_id', 'story id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $ajaxResponce        = array('status' => 'true');

            if($this->input->post('story_id')){

                $this->common_model->delete('traveller_stories', array('id'=>$this->input->post('story_id')));

            }  

            $ajaxResponce['message']  = 'Story is deleted successfully';

        }

        echo json_encode($ajaxResponce);

    }

    public function delete_blog() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('blog_id', 'blog id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $ajaxResponce        = array('status' => 'true');

            if($this->input->post('blog_id')){

                $this->common_model->delete('news_blog', array('id'=>$this->input->post('blog_id')));

            }  

            $ajaxResponce['message']  = 'Blog is deleted successfully';

        }

        echo json_encode($ajaxResponce);

    }

    public function delete_resort_story() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('story_id', 'story id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $ajaxResponce        = array('status' => 'true');

            if($this->input->post('story_id')){

                $this->common_model->delete('resort_stories', array('id'=>$this->input->post('story_id')));

            }  

            $ajaxResponce['message']  = 'Story is deleted successfully';

        }

        echo json_encode($ajaxResponce);

    } 

    public function reject_now() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('story_id', 'story id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $ajaxResponce = array('status' => 'true');

            if($this->input->post('story_id')){

                $this->common_model->update('traveller_stories', array('verified_status'=>3), array('id'=>$this->input->post('story_id')));

                $user = $this->developer_model->get_traveller_story_row();

                //print_r($user); exit();

                $email_template = $this->cimail_email->get_email_template('reject_reviews');

				$param = array(

				            'template'  => array(

				            'temp'      => $email_template->template_body,

				            'var_name'  => array(

			                                    'name' => $user->first_name,

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

            $ajaxResponce['message']  = 'Story is rejected successfully';

        }

        echo json_encode($ajaxResponce);

    }    

    public function blog_filter_list($offset=null,$custag = null) {

        $config               = ajax_pagination();

        $config['base_url']   = base_url()."home/blog_list"; 

        $config['total_rows'] = $this->developer_model->home_blogs(0, 0); 

        $config['per_page']   = site_info('blog_page_limit');

        $this->pagination->initialize($config);

        $offSet               = 0;

        if($offset){

            $offSet = $config['per_page']*($offset-1);

        } 

        $data['offset']      = $offset;

        $data['total_rows']  = $config['total_rows'];
        
        $data['per_page']    = $config['per_page'];        

        $data['blogs']       = $this->developer_model->home_blogs($offSet, $config['per_page']);

        return $data;

    } 

    public function blog_list($offset=null) { 

        $data = $this->blog_filter_list($offset,"");

        $this->load->view('frontend/blog_list', $data);

    }   

    public function login() {     

        if(user_logged_in()){ 

            if($this->input->get('type')&&$this->input->get('type')=='story_list'){

                redirect(base_url('user/dashboard?type=story_list'));

            }else{

                redirect(base_url('user/dashboard'));

            }

        }  

        $data['countrys'] = $this->common_model->get_result('countries');

        $data['template'] = 'frontend/login';

        $this->load->view('templates/frontend_template', $data);

    }

    public function hotel_login() {     

        if(user_logged_in()){ 

            if($this->input->get('type')&&$this->input->get('type')=='story_list'){

                redirect(base_url('user/dashboard?type=story_list'));

            }else{

                redirect(base_url('user/dashboard'));

            }

        }  

        $data['user_type']  = '2';

        $data['template']   = 'frontend/hotel_login';

        $this->load->view('templates/frontend_template', $data);

    } 

    public function sendForgotPasswordMail(){

    	$mailResponse = array('status' =>'false', 'message'=>'The email is invalid');

    	$this->form_validation->set_rules('forgot_email', 'Email', 'trim|xss_clean|required|valid_email');

    	if ($this->form_validation->run() == TRUE){

        	$forgotEmail = $this->input->post('forgot_email', TRUE); 

        	$user 	= $this->common_model->get_row('users', array('email' =>$forgotEmail),array('id','email','first_name')); 

           if($user){

           	  $activationCode = substr(time().$user->id,-6);

           	  if($this->common_model->update('users',array('activation_code'=>$activationCode), array('id'=>$user->id))){

           	  	$mailResponse = array(

           	  						'status' =>'true',

		           	  				'message'=>'A password reset link will be sent to your email.'

		           	  				);	

           	  	$linkUrl 		=  base_url('home/reset_password/'.$activationCode);

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
    
    

    public function reset_password($activation_key=''){   

      	$data['title']   = 'Reset password';  

      	if(empty($activation_key)){ redirect(base_url('home/login?actType=forgotPassword')); }

      	if(!empty($activation_key)){

	      	$user 			= $this->common_model->get_row('users', array('activation_code'=>trim($activation_key)));

	      	$data['user'] 	= $user;

	      	if($user==FALSE){

	          	$this->session->set_flashdata('msg_error','Your activation key expired.');

	          	redirect(base_url('home/login?actType=forgotPassword'));

	       	} 

    	}

      $data['template'] 		= 'frontend/reset_password';

	  $this->load->view('templates/frontend_template', $data);

    }  //token is expired try again callback_resetPassword

     /*validation function*/
     
     
     public function reset_password_admin($activation_key=''){  
      	$data['title'] 	= 'Reset password';  
      	if(empty($activation_key)){ redirect('login'); }
      	if(!empty($activation_key)){
      		$user = $this->common_model->get_row('admin_users',array('activationCode'=>trim($activation_key)));
	      	if(empty($user)){
	          	$this->session->set_flashdata('msg_error','Your activation key expired.');
	          	redirect(ADMIN_DIR.'login');
	       	} 
      	}
      	$this->form_validation->set_rules('password', 'New Password', 'trim|required|min_length[6]|matches[confpassword]');
      	$this->form_validation->set_rules('confpassword','Confirm Password', 'trim|required');
      	$this->form_validation->set_error_delimiters('<div class="error">', '</div>');
      	if ($this->form_validation->run() == TRUE){
          	$user = $this->common_model->get_row('admin_users',array('activationCode'=>trim($activation_key)));
          	if(empty($user)){
              	$this->session->set_flashdata('msg_error','Your activation key expired.');
              	redirect(ADMIN_DIR.'login');
            } 
            $salt = salt();
		    $user_data  = array('salt'=>$salt,
								'password' => sha1($salt.sha1($salt.sha1($this->input->post('password')))),
								'activationCode'=>''
								);
            if($this->common_model->update('admin_users',$user_data,array('id'=>$user->id))){
                $this->session->set_flashdata('msg_success','Your Password has reset successfully <br/> now you can Login.');
                redirect(ADMIN_DIR.'login');
            }
      	} 
      	$this->load->view(ADMIN_DIR.'admin_new_password');
    }
     
     
     

    public function reset_password_res(){  
    	$array 	  = array('status'=>'false', 'message'=>'');

		$this->form_validation->set_rules('password', 'New Password', 'trim|required|xss_clean|min_length[6]|matches[confirm_password]');

        $this->form_validation->set_rules('confirm_password','Confirm Password', 'trim|xss_clean|required');

      	$this->form_validation->set_rules('user_token','', 'trim|xss_clean|callback_check_token');

      	$this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

      	if ($this->form_validation->run() == TRUE){

      		$user_id 	= base64_decode($this->input->post('user_token'));

            $salt 	 	= salt();

		    $user_data  = array('salt'=>$salt,

								'password' => sha1($salt.sha1($salt.sha1($this->input->post('password', TRUE)))),

								'activation_code'=>''

								);

            if($this->common_model->update('users', $user_data, array('id'=>$user_id))){

            	$array 	  = array('status'=>'true', 'message'=>'Password is updated successfully');             	

            }else{

            	$array 	  = array('status'=>'false', 'message'=>'Password did not update, try again'); 

            }

      	}else{      		

      		$array 	  = array('status'=>'false', 'message'=>validation_errors());

      	}

      	echo json_encode($array);

    } 

    public function error_404() {       

        $data['template']    = 'frontend/error_404';

        $this->load->view('templates/frontend_template', $data);

    } 

    public function get_story_imgs() {

        if($this->input->get('story_id')){

            $data['images'] = $this->common_model->get_result('images', array('status'=>'1', 'item_id'=>$this->input->get('story_id'), 'type'=>'traveller_story')); 

            $this->load->view('frontend/get_story_imgs', $data);

        }

    }

    /********************* resort section *********************************/ 

    public function add_resort() {  

        if($this->input->get('resort_id')){

            $data 	= $this->get_resort_1(base64_decode($this->input->get('resort_id')));

        }else{

        	$data 	= $this->get_resort_1();

        } 

        $data['template']      = 'frontend/add_resort';

        $this->load->view('templates/frontend_template', $data);

    } 

    public function edit_resort_1() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('resort_id', 'resort id', 'required');

        if ($this->form_validation->run() == TRUE) {

        	$data 	= $this->get_resort_1($this->input->post('resort_id'));
            //print_r($data);exit;

            $ajaxResponce['nexthtml']  = $this->load->view('frontend/add_resort_1', $data, true);

	        $ajaxResponce['resort_id'] = $this->input->post('resort_id');            

	        $ajaxResponce['status']    = 'true'; 

        }

        echo json_encode($ajaxResponce);

    }

    public function get_resort_1($resort_id='') {

    	$data = array();

    	if(!empty($resort_id)){

			$data['row'] = $this->common_model->get_row('resorts', array('id'=>$resort_id));

    	}

        $data['resort_highlights'] = $this->common_model->get_result('resort_highlights', array('status'=>1, 'resort_id'=>$resort_id), array(), array('id', 'asc'));

        $data['brands']  = $this->common_model->get_result('brand', array('status'=>1), array(), array('brand_name', 'asc'));

        $data['states']  = $this->common_model->get_result('states', array('status'=>1), array(), array('state_name', 'asc'));       
        

        return $data;

    }   

    public function test_search() {

        $resorts = $this->common_model->get_result('resorts');

        if(!empty($resorts)){

            foreach($resorts as $resort){

                $this->common_model->update('resorts', array('resort_name'=>$resort->resort_name.' '), array('id'=>$resort->id));

            }

        }

    } 

    public function test_owner() {

         $this->db->select("traveller_stories.*, resorts.user_id as owner_id");

        $this->db->from('traveller_stories');

        $this->db->join('resorts resorts', 'traveller_stories.resort_id=resorts.id', 'left');

        $this->db->order_by('traveller_stories.id', 'DESC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            $results = $getdata->result();

            if(!empty($results)){

                foreach($results as $result){

                    $this->common_model->update('traveller_stories', array('owner_id'=>$result->owner_id.' '), array('id'=>$result->id));

                }

            }

        } else {

            return false;

        }

    } 



    public function save_resort_1() {
        
        $ajaxResponce  = array();

        if(empty($this->input->post('resort_id'))){

            $this->form_validation->set_rules('logo_name', 'logo', 'required');

        }

        if($this->input->post('resort_name')==$this->input->post('old_resort_name')){

            $this->form_validation->set_rules('resort_name', 'resort name', 'required');

        }else{

            $this->form_validation->set_rules('resort_name', 'resort name', 'required|is_unique[resorts.resort_name]');

        }

        $this->form_validation->set_rules('brand_id', 'brand', 'required');

        $this->form_validation->set_rules('resort_description', 'description', 'required');

        // $this->form_validation->set_rules('physical_lat', 'latitude', 'required');

        // $this->form_validation->set_rules('physical_lng', 'longitude', 'required');

        $this->form_validation->set_rules('physical_state', 'state', 'required');

        $this->form_validation->set_rules('island_name', 'island name', 'required');

        if ($this->form_validation->run() == TRUE) {

            $insertData = array();

            if($this->input->post('resort_name')){

                $insertData['resort_name'] = $this->input->post('resort_name').' ';

            }

            if($this->input->post('resort_description')){

                $insertData['resort_description'] = $this->input->post('resort_description');

            }

            if($this->input->post('brand_id')){

                $insertData['brand_id'] = $this->input->post('brand_id');

            }

            if($this->input->post('physical_lat')){
                $insertData['physical_lat'] = $this->input->post('physical_lat');
            }

            if($this->input->post('physical_lng')){
                $insertData['physical_lng'] = $this->input->post('physical_lng');
            }

            if($this->input->post('physical_state')){

                $insertData['physical_state'] = $this->input->post('physical_state');

            }

            if($this->input->post('island_name')){

                $insertData['island_name'] = $this->input->post('island_name');

            }

            if($this->input->post('agoda_url')){

                $insertData['agoda_url'] = $this->input->post('agoda_url');

            }

            if($this->input->post('logo_name')){

                $insertData['resort_logo'] = $this->input->post('logo_name');

            }    

            if(user_logged_in()){

                $insertData['user_id'] = user_id();

            }
            $resort_id = $this->input->post('resort_id');

            

            if($this->input->post('resort_id')){

                $insertData['updated_date'] = date('Y-m-d H:i:s');

                $this->common_model->update('resorts', $insertData, array('id'=>$this->input->post('resort_id')));

                $resort_id    = $this->input->post('resort_id'); 

                $ajaxResponce =  $this->get_resort_2($resort_id);               

                $ajaxResponce['message'] = 'Resort is updated successfully';

            }else{                

                $total_acount = get_all_count('resorts')+1;

                $insertData['order_priority'] = $total_acount;

                $resort_id    = $this->common_model->insert('resorts', $insertData);

                $ajaxResponce = $this->get_resort_2($resort_id);    

                $ajaxResponce['message'] = 'Resort is added successfully';

            }            

            if($this->input->post('resort_highlights')){

                $this->common_model->delete('resort_highlights',  array('resort_id'=>$resort_id));

                $resort_highlights = $this->input->post('resort_highlights');

                foreach ($resort_highlights as $resort_highlight) {
                    if($resort_highlight!="") {
                        $this->common_model->insert('resort_highlights', array('resort_id'=>$resort_id, 'resort_highlights'=>$resort_highlight));
                    }
                }
            }


        } else {

            $ajaxResponce = array('status' => 'false', 'message' => validation_errors());

        }

        echo json_encode($ajaxResponce);

    }

    public function edit_resort_2() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('resort_id', 'resort id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $ajaxResponce =  $this->get_resort_2($this->input->post('resort_id'));    

            $ajaxResponce['message'] = 'Resort is data fetched successfully';   

        }

        echo json_encode($ajaxResponce);

    }

    public function get_resort_2($resort_id='') {

        $ajaxResponce           = array('status' => 'true');

        $data                  = array();

        $data['affiliations']  = $this->common_model->get_result('affiliation', array('status'=>1), array(), array('affiliation_name', 'asc'));

        $data['categorys']     = $this->common_model->get_result('category', array('status'=>1), array(), array('category_name', 'asc'));

        $data['airports']      = $this->common_model->get_result('international_airport_type', array('status'=>1), array(), array('id', 'asc'));

        $data['villa_types']   = $this->common_model->get_result('villa_type', array('status'=>1), array(), array('id', 'asc'));

        $data['meal_plans']    = $this->common_model->get_result('meal_plans', array('status'=>1), array(), array('id', 'asc'));

        $data['row']           	   = $this->common_model->get_row('resorts', array('id'=>$resort_id));

        $data['resort_id']     	   = $resort_id;

        $ajaxResponce['nexthtml']  = $this->load->view('frontend/add_resort_2', $data, true);

        $ajaxResponce['resort_id'] = $resort_id;

        return $ajaxResponce;

    }

    public function checkTotalNoOfVillas(){

        $villa_types = $this->common_model->get_result('villa_type', array('status'=>1));

        $total_no_villas = $villa_counter = 0;

        if($this->input->post('total_no_villas')){

            $total_no_villas = $this->input->post('total_no_villas');

        }

        $zeroError = array();

        if(!empty($villa_types)){
            
            foreach($villa_types as $villa_type){


                if($this->input->post('villa_counter_status_'.$villa_type->id)&&$this->input->post('villa_counter_'.$villa_type->id)){

                    $villa_counter += $this->input->post('villa_counter_'.$villa_type->id);

                }

                if($this->input->post('villa_counter_status_'.$villa_type->id)){

                    if($this->input->post('villa_counter_'.$villa_type->id)<1){

                        $zeroError[] = $villa_type->id;

                    }

                }

            }

        }

		

        if($this->input->post('total_no_villas')&&$villa_counter==$this->input->post('total_no_villas')){

            echo json_encode(array('status'=>'true'));

        }else{

            echo json_encode(array('status'=>'false', 'villas_error'=>$zeroError));

        }

    }

    public function save_resort_2() {

        $ajaxResponce  = array();

        //$this->form_validation->set_rules('resort_affiliation', 'affiliation', 'required');

        $this->form_validation->set_rules('resort_id', 'resort id', 'required');

        $this->form_validation->set_rules('resort_category', 'category', 'required');

        $this->form_validation->set_rules('contact_email', 'contact email', 'valid_email');

        if ($this->form_validation->run() == TRUE) {

            $insertData = array();

            if($this->input->post('resort_affiliation')){

                $insertData['resort_affiliation'] = $this->input->post('resort_affiliation');

            }else{

                $insertData['resort_affiliation'] = 0;

            } 

            if($this->input->post('resort_category')){

                $insertData['resort_category'] = $this->input->post('resort_category');

            }

            if($this->input->post('contact_name')){

                $insertData['contact_name'] = $this->input->post('contact_name');

            }

            if($this->input->post('contact_number')){

                $insertData['contact_number'] = $this->input->post('contact_number');

            }

            if($this->input->post('contact_email')){

                $insertData['contact_email'] = $this->input->post('contact_email');

            }

            if($this->input->post('contact_website')){

                $insertData['contact_website'] = $this->input->post('contact_website');

            }

            if($this->input->post('island_size_length')){

                $insertData['island_size_length'] = $this->input->post('island_size_length');

            }

            if($this->input->post('island_size_width')){

                $insertData['island_size_width'] = $this->input->post('island_size_width');

            }

            if($this->input->post('total_no_villas')){

                $insertData['total_no_villas'] = $this->input->post('total_no_villas');

            } 

            if($this->input->post('meal_plans')){

                $insertData['meal_plans'] = implode(',', $this->input->post('meal_plans'));

            } 

            if($this->input->post('guests_fly_drones')){

                $insertData['guests_fly_drones'] = $this->input->post('guests_fly_drones');

            } 

            if($this->input->post('drone_policy')){

                $insertData['drone_policy'] = $this->input->post('drone_policy');

            }    

            if($this->input->post('affiliation_img')){

                $insertData['affiliation_img'] = $this->input->post('affiliation_img');

            } 

            $insertData['updated_date'] = date('Y-m-d H:i:s');        

            if($this->input->post('resort_id')){

                $this->common_model->update('resorts', $insertData, array('id'=>$this->input->post('resort_id')));

                $resort_id    = $this->input->post('resort_id');   

            }

            $this->common_model->delete('international_airports', array('resort_id'=>$resort_id));

            $international_airports = $this->common_model->get_result('international_airport_type', array('status'=>1));

            $airports = $this->input->post('airports');

            //print_r($airports); exit();

            if(!empty($international_airports)){

                foreach($international_airports as $international_airport){

                    $international = array();  

                    $international['resort_id']    = $this->input->post('resort_id');

                    $international['airport_type'] = $international_airport->id;

                    $international_counter_row = $this->common_model->get_row('international_airports', $international);

                    if($this->input->post('hour1_'.$international_airport->id)){

                        $international['hour1'] = $this->input->post('hour1_'.$international_airport->id);

                    }else{

                        $international['hour1'] = 0;

                    }

                    if($this->input->post('minuts1_'.$international_airport->id)){

                        $international['minuts1'] = $this->input->post('minuts1_'.$international_airport->id);

                    }else{

                        $international['minuts1'] = 0;

                    }

                    if($this->input->post('hour2_'.$international_airport->id)){

                        $international['hour2'] = $this->input->post('hour2_'.$international_airport->id);

                    }else{

                         $international['hour2'] = 0;

                    }

                    if($this->input->post('minuts2_'.$international_airport->id)){

                        $international['minuts2'] = $this->input->post('minuts2_'.$international_airport->id);

                    }else{

                        $international['minuts2'] = 0;

                    }

                    if(!empty($airports)&&in_array($international_airport->id, $airports)){

                        $international['check_option'] = 1;

                    }

                    if(!empty($international_counter_row->id)){

                        $this->common_model->update('international_airports', $international, array('id'=>$international_counter_row->id));

                    }else if(!empty($airports)&&in_array($international_airport->id, $airports)){

                        $this->common_model->insert('international_airports', $international);

                    }

                }

            }

            $villa_types = $this->common_model->get_result('villa_type', array('status'=>1));

            if(!empty($villa_types)){

                foreach($villa_types as $villa_type){

                    $villas                 = array();  

                    $villas['resort_id']    = $this->input->post('resort_id');

                    $villas['villas_type']  = $villa_type->id;

                    $villa_counter_row      = $this->common_model->get_row('villas', $villas);

                    if($this->input->post('villa_type_other_label')&&$villa_type->villa_type=='Other'){

                        $villas['villa_name'] = $this->input->post('villa_type_other_label');

                    }

                    if($this->input->post('villa_counter_'.$villa_type->id)){

                        $villas['villas_type_counter'] = $this->input->post('villa_counter_'.$villa_type->id);

                    }

                    if($this->input->post('villa_counter_status_'.$villa_type->id)){

                        $villas['villa_counter_status'] = $this->input->post('villa_counter_status_'.$villa_type->id);

                    }

                    if(!empty($villa_counter_row->id)){

                        $this->common_model->update('villas', $villas, array('id' => $villa_counter_row->id));

                    }else{

                        $this->common_model->insert('villas', $villas);

                    }

                }

            }

            $ajaxResponce =  $this->get_resort_3($resort_id);               

            $ajaxResponce['message'] = 'Resort is updated successfully';

        } else {

            $ajaxResponce = array('status' => 'false', 'message' => validation_errors());

        }

        echo json_encode($ajaxResponce);

    }

    public function edit_resort_3() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('resort_id', 'resort id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $ajaxResponce =  $this->get_resort_3($this->input->post('resort_id'));    

            $ajaxResponce['message'] = 'Resort is data fetched successfully';   

        }

        echo json_encode($ajaxResponce);

    }

    public function get_resort_3($resort_id='') {

    	$ajaxResponce          = array('status' => 'true');

        $data                  = array();

        $data['attractions']   = $this->common_model->get_result('attractions', array('status'=>1), array(), array('attraction_name', 'asc'));

        $data['holidays']      = $this->common_model->get_result('holidays', array('status'=>1), array(), array('holiday_name', 'asc'));

        $data['images']        = $this->common_model->get_result('images', array('status'=>1, 'item_id'=>$resort_id, 'type'=>'resort'), array(), array('id', 'asc'));

        $data['row']              = $this->common_model->get_row('resorts', array('id'=>$resort_id));

        $data['resort_id']        = $resort_id;

        $ajaxResponce['nexthtml'] = $this->load->view('frontend/add_resort_3', $data, true);

        return $ajaxResponce;

    }

    public function save_resort_3() {

        $ajaxResponce  = array();

        //$this->form_validation->set_rules('opening_date', 'opening date', 'required');

        if (1) {

            $insertData = array();

            if($this->input->post('opening_date')){

                $insertData['opening_date'] = $this->input->post('opening_date');

            }

            if($this->input->post('renovated_date')){

                $insertData['renovated_date'] = $this->input->post('renovated_date');

            }

            if($this->input->post('maps_location')){

                $insertData['maps_location'] = $this->input->post('maps_location');

            }

            if($this->input->post('distance_to_closest_international_airport')){

                $insertData['distance_to_closest_international_airport'] = $this->input->post('distance_to_closest_international_airport');

            }

            if($this->input->post('distance_to_closest_domestic_airport')){

                $insertData['distance_to_closest_domestic_airport'] = $this->input->post('distance_to_closest_domestic_airport');

            }
            
            if($this->input->post('name_to_closest_domestic_airport')){

                $insertData['name_to_closest_domestic_airport'] = $this->input->post('name_to_closest_domestic_airport');

            }

            if($this->input->post('transfers_for_night_international_flights')){

                $insertData['transfers_for_night_international_flights'] = $this->input->post('transfers_for_night_international_flights');

            }

            if($this->input->post('diving_centre_name')){

                $insertData['diving_centre_name'] = $this->input->post('diving_centre_name');

            }

            if($this->input->post('factsheet')){

                $insertData['factsheet'] = $this->input->post('factsheet');

            } 

            if($this->input->post('resort_map')){

                $insertData['resort_map'] = $this->input->post('resort_map');

            }  

            if($this->input->post('resort_brochure')){

                $insertData['resort_brochure'] = $this->input->post('resort_brochure');

            }

            if($this->input->post('resort_caption')){

                $insertData['resort_caption'] = $this->input->post('resort_caption');

            }

            if($this->input->post('resort_caption_description')){

                $insertData['resort_caption_description'] = $this->input->post('resort_caption_description');

            }

            if($this->input->post('points_of_attractions')){

                $insertData['points_of_attractions'] = implode(',', $this->input->post('points_of_attractions'));

            } 

            if($this->input->post('holiday_styles')){

                $insertData['holiday_styles'] = implode(',', $this->input->post('holiday_styles'));

            }         

            if($this->input->post('resort_id')){

                $this->common_model->update('resorts', $insertData, array('id'=>$this->input->post('resort_id')));

                $resort_id    = $this->input->post('resort_id'); 

            }

            if($this->input->post('resort_images')){

                $resort_images = explode(',', $this->input->post('resort_images'));

                if(!empty($resort_images)){

                    foreach($resort_images as $resort_image){

                        $imgArr = array('type'=>'resort', 'item_id' =>$resort_id, 'image_name'=>$resort_image); 

                        $this->common_model->insert('images', $imgArr);

                    }

                }

            }            

            $ajaxResponce =  $this->get_resort_4($resort_id);               

            $ajaxResponce['message'] = 'Resort is updated successfully';

        } else {

            $ajaxResponce = array('status' => 'false', 'message' => validation_errors());

        }

        echo json_encode($ajaxResponce);

    }

    public function edit_resort_4() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('resort_id', 'resort id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $ajaxResponce =  $this->get_resort_4($this->input->post('resort_id'));    

            $ajaxResponce['message'] = 'Resort is data fetched successfully';   

        }

        echo json_encode($ajaxResponce);

    }

    public function get_resort_4($resort_id='') {
        
        $ajaxResponce      = array('status' => 'true');

        $data              = array();

        $data['amenities'] = $this->common_model->get_result('amenities', array('status'=>1), array(), array('amenitie_name', 'asc'));

	    $data['facilities'] = $this->common_model->get_result('facilities', array('status'=>1), array(), array('facility_name', 'asc'));

        $data['complimentary_services'] = $this->common_model->get_result('complimentary_services', array('status'=>1, 'resort_id'=>$resort_id), array(), array('id', 'asc'));

        $data['row']       = $this->common_model->get_row('resorts', array('id'=>$resort_id));

        $data['kids_club']       = $this->common_model->get_row('kids_club', array('resort_id'=>$resort_id));

        $data['divecenter_club']       = $this->common_model->get_row('divecenter_club', array('resort_id'=>$resort_id));

        $data['watersports_club']       = $this->common_model->get_row('watersports_club', array('resort_id'=>$resort_id));

        $data['images']    = $this->common_model->get_result('images', array('type'=>'facility', 'item_id' => $resort_id), array(), array('id', 'asc'));

        $data['row']         = $this->common_model->get_row('resorts', array('id'=>$resort_id));
        
        $data['resort_id'] = $resort_id;

        $ajaxResponce['nexthtml'] = $this->load->view('frontend/add_resort_4', $data, true);

        return $ajaxResponce;

    }

	

    public function save_resort_4() {

        $this->form_validation->set_rules('facilities[]', 'facility', 'required');

        if ($this->form_validation->run() == TRUE) {
            

            $ajaxResponce  = array();

            $insertData    = array();        

            if($this->input->post('amenities')){

                $insertData['amenities'] = implode(',', $this->input->post('amenities'));

            }

			if($this->input->post('facilities')){

                $insertData['facilities'] = implode(',', $this->input->post('facilities'));

            }               

            if($this->input->post('facilities_img')){

                $insertData['facilities_img'] = $this->input->post('facilities_img');

            } 
            
            if($this->input->post('resort_id')){

                $this->common_model->update('resorts', $insertData, array('id'=>$this->input->post('resort_id')));

                $resort_id    = $this->input->post('resort_id');  

            }    

            if($this->input->post('complimentary_services')){

                $this->common_model->delete('complimentary_services',  array('resort_id'=>$resort_id));

                $complimentary_services = $this->input->post('complimentary_services');

                foreach ($complimentary_services as $complimentary_service) {

                    $this->common_model->insert('complimentary_services', array('resort_id'=>$resort_id, 'complimentary_name'=>$complimentary_service));

                }

            }
            
            
            if($this->input->post('fac_images')){

            $resort_images = explode(',', $this->input->post('fac_images'));

            if(!empty($resort_images)){

                foreach($resort_images as $resort_image){

                    $imgArr = array('type'=>'facility', 'item_id' =>$resort_id, 'image_name'=>$resort_image); 

                    $this->common_model->insert('images', $imgArr);

                }

            }

        }  
            

			$resort_id = $this->input->post('resort_id')?$this->input->post('resort_id'):'';

			// Kids club Start

			$kidsInsertData = array();

			$kidsInsertData['resort_id'] = $resort_id;

			$kids_club_id = $this->input->post('kids_club_id')?$this->input->post('kids_club_id'):'';

			 if($this->input->post('kids_club_title')) 

                $kidsInsertData['kids_club_title'] = $this->input->post('kids_club_title');    

   			if($this->input->post('kids_club_description')) 

                $kidsInsertData['kids_club_description'] = $this->input->post('kids_club_description'); 

			if($this->input->post('kids_club_highlights')) 

                $kidsInsertData['kids_club_highlights'] = $this->input->post('kids_club_highlights'); 

			if($this->input->post('kids_club_opning_hrs')) 

                $kidsInsertData['kids_club_opning_hrs'] = $this->input->post('kids_club_opning_hrs'); 

		     $kids_old_image = $this->input->post('kids_old_image')?$this->input->post('kids_old_image'):''; 

			if($_FILES['kids_club_image']['name'] != '')

            {

				$imageExts = array("gif", "jpeg", "jpg", "png");

				$data['error'] = true;

				$config['allowed_types'] = 'jpeg|gif|jpg|png';

				$config['overwrite']     = FALSE;

				$fileName = $_FILES['kids_club_image']['name'];

				$str = 'image_'.substr(md5(rand()),0,7);

				$ext = pathinfo($fileName, PATHINFO_EXTENSION);

				$new_name = $fileName = time() . $str . "." . $ext;

				$config['upload_path'] = './uploads/club/kids_club';

				$config['file_name'] = $new_name;

               // load upload library

               $this->load->library('upload', $config);

               // initialize file data

               $this->upload->initialize($config);

               if($this->upload->do_upload('kids_club_image'))

               {

                   $fileData = $this->upload->data();

                   $kidsimage = $fileData['file_name'];

				    if($kids_old_image!=''){

				    unlink('./uploads/club/kids_club/'.$kids_old_image);

					}

               }

            }else{

				$kidsimage = $kids_old_image;

			}

			$kidsInsertData['kids_club_image '] = $kidsimage;

			

            if(!empty($kids_club_id)){

                $this->common_model->update('kids_club', $kidsInsertData, array('kids_club_id' => $kids_club_id));

                

            }else{

                $kids_club_id = $this->common_model->insert('kids_club', $kidsInsertData);

			}



			// Kids club End

			// Water sports club Start

			$waterInsertData = array();

			$waterInsertData['resort_id'] = $resort_id;

			$watersports_club_id = $this->input->post('watersports_club_id')?$this->input->post('watersports_club_id'):'';

			 if($this->input->post('watersports_club_title')) 

                $waterInsertData['watersports_club_title'] = $this->input->post('watersports_club_title');    

   			if($this->input->post('watersports_club_description')) 

                $waterInsertData['watersports_club_description'] = $this->input->post('watersports_club_description'); 

			if($this->input->post('watersports_club_highlights')) 

                $waterInsertData['watersports_club_highlights'] = $this->input->post('watersports_club_highlights'); 

			if($this->input->post('watersports_club_opning_hrs')) 

                $waterInsertData['watersports_club_opning_hrs'] = $this->input->post('watersports_club_opning_hrs'); 

		     $watersports_old_image = $this->input->post('watersports_old_image')?$this->input->post('watersports_old_image'):''; 

			if($_FILES['watersports_club_image']['name'] != '')

            {

				$imageExts = array("gif", "jpeg", "jpg", "png");

				$data['error'] = true;

				$config['allowed_types'] = 'jpeg|gif|jpg|png';

				$config['overwrite']     = FALSE;

				$fileName = $_FILES['watersports_club_image']['name'];

				$str = 'image_'.substr(md5(rand()),0,7);

				$ext = pathinfo($fileName, PATHINFO_EXTENSION);

				$new_name = $fileName = time() . $str . "." . $ext;

				$config['upload_path'] = './uploads/club/water_sports_club';

				$config['file_name'] = $new_name;

               // load upload library

               $this->load->library('upload', $config);

               // initialize file data

               $this->upload->initialize($config);

               if($this->upload->do_upload('watersports_club_image'))

               {

                   $fileData = $this->upload->data();

                   $watersports_images = $fileData['file_name'];

				    if($watersports_old_image!=''){

				    unlink('./uploads/club/water_sports_club/'.$watersports_old_image);

					}

               }

            }else{

				$watersports_images = $watersports_old_image;

			}

			$waterInsertData['watersports_club_image'] = $watersports_images;

            if(!empty($watersports_club_id)){

                $this->common_model->update('watersports_club', $waterInsertData, array('watersports_club_id' => $watersports_club_id));

                

            }else{

                $watersports_club_id = $this->common_model->insert('watersports_club', $waterInsertData);

			}

			// watersports club End

			// Dive Center club Start

			$divecenterInsertData = array();

			$divecenterInsertData['resort_id'] = $resort_id;

			$watersports_club_id = $this->input->post('divecenter_club_id')?$this->input->post('divecenter_club_id'):'';

			 if($this->input->post('divecenter_club_title')) 

                $divecenterInsertData['divecenter_club_title'] = $this->input->post('divecenter_club_title');    

   			if($this->input->post('divecenter_club_description')) 

                $divecenterInsertData['divecenter_club_description'] = $this->input->post('divecenter_club_description'); 

			if($this->input->post('divecenter_club_highlights')) 

                $divecenterInsertData['divecenter_club_highlights'] = $this->input->post('divecenter_club_highlights'); 

			if($this->input->post('divecenter_club_opning_hrs')) 

                $divecenterInsertData['divecenter_club_opning_hrs'] = $this->input->post('divecenter_club_opning_hrs'); 

		     $divecenter_old_image = $this->input->post('divecenter_old_image')?$this->input->post('divecenter_old_image'):''; 

			if($_FILES['divecenter_club_image']['name'] != '')

            {

				$imageExts = array("gif", "jpeg", "jpg", "png");

				$data['error'] = true;

				$config['allowed_types'] = 'jpeg|gif|jpg|png';

				$config['overwrite']     = FALSE;

				$fileName = $_FILES['divecenter_club_image']['name'];

				$str = 'image_'.substr(md5(rand()),0,7);

				$ext = pathinfo($fileName, PATHINFO_EXTENSION);

				$new_name = $fileName = time() . $str . "." . $ext;

				$config['upload_path'] = './uploads/club/dive_center_club';

				$config['file_name'] = $new_name;

               // load upload library

               $this->load->library('upload', $config);

               // initialize file data

               $this->upload->initialize($config);

               if($this->upload->do_upload('divecenter_club_image'))

               {

                   $fileData = $this->upload->data();

                   $divecenter_image = $fileData['file_name'];

				    if($divecenter_old_image!=''){

				    unlink('./uploads/club/dive_center_club/'.$divecenter_old_image);

					}

               }

            }else{

				$divecenter_image = $divecenter_old_image;

			}

			$divecenterInsertData['divecenter_club_image'] = $divecenter_image;

            if(!empty($divecenter_club_id)){

                $this->common_model->update('divecenter_club', $divecenterInsertData, array('divecenter_club_id' => $divecenter_club_id));

                

            }else{

                $divecenter_club_id = $this->common_model->insert('divecenter_club', $divecenterInsertData);

			}

			// divecenter club End

            $ajaxResponce =  $this->get_resort_5($resort_id);               

            $ajaxResponce['message'] = 'Resort is updated successfully';  

        }else {

            $ajaxResponce = array('status' => 'false', 'message' => validation_errors());

        }                    

        echo json_encode($ajaxResponce);

    }

    public function paypal_proccess_tessts($id=''){

        //for testing 

        $sandbox = TRUE; 

        // for live payment

        //$sandbox = FALSE; 

        // Set PayPal API version and credentials.

        $api_version = '85.0';

        $api_endpoint = $sandbox ? 'https://api-3t.sandbox.paypal.com/nvp' : 'https://api-3t.paypal.com/nvp';

           

        $api_username = $sandbox ? 'ajay1_api1.mailinator.com' : 'LIVE_USERNAME_GOES_HERE';

        $api_password = $sandbox ? 'RU7V5AYCQQ5HZ9AY' : 'LIVE_PASSWORD_GOES_HERE';

        $api_signature = $sandbox ? 'A-4yj26urklWIQLsKq1SlsKUSKS2ASjvqLDziDoHAXOqDKgMwxSJ48kZ' : 'LIVE_SIGNATURE_GOES_HERE';                

        // client paypal  

        /*$api_username = $sandbox ? 'chawra_api1.gmail.com' : 'chawra_api1.gmail.com';

        $api_password = $sandbox ? 'W4T65QY348AV27MW' : '4YKZNKKLZYUPD9AM';

        $api_signature = $sandbox ? 'ArFZ5DF1pEd4euI2jpvbEwe5Q4BiA4vtTNTVByzxzpfdmUIl-8gtWapZ' : 'AKCSjTfp4QkOnuznw4UPaCrHqMybACZcJsjB2ZsZd.qwbi9OXOV9CBL5';*/

        $user = $this->common_model->get_row('users', array('id'=>1));

        $user_city = !empty($user->user_city)?$user->user_city:'ttetss';

        $user_state = !empty($user->user_state)?$user->user_state:'ssd';

        $user_zip = !empty($user->user_zip)?$user->user_zip:'123546';

        $user_country = !empty($user->user_country)?$user->user_country:'In';

        $street_number = !empty($user->street_number)?$user->street_number:'fdvsdfdf';

        $first_name = !empty($user->first_name)?$user->first_name:'dfdf';

        $last_name = !empty($user->last_name)?$user->last_name:'fdf';

        $request_params = array(

                'METHOD'        => 'DoDirectPayment', 

                'USER'          => $api_username, 

                'PWD'           => $api_password, 

                'SIGNATURE'     => $api_signature, 

                'VERSION'       => $api_version, 

                'PAYMENTACTION' => 'Sale',                   

                'IPADDRESS'     => $_SERVER['REMOTE_ADDR'],

                'CREDITCARDTYPE' => 'Visa', 

                'ACCT' => '4111111111111111',                        

                'EXPDATE' => '022020',           

                'CVV2' => '123', 

                'FIRSTNAME' => $first_name, 

                'LASTNAME' => $last_name, 

                'STREET' => $street_number, 

                'CITY'  => $user_city, 

                'STATE' => $user_state,                     

                'COUNTRYCODE' => $user_country, 

                'ZIP' => $user_zip, 

                'AMT' => 20, 

                'CURRENCYCODE' => 'USD', 

                'DESC' => 'Membership Plan '

                );

        $nvp_stringA = array();

        print_r($request_params); //exit();

        foreach($request_params as $var=>$val)

        {

            $nvp_stringA[] = $var.'='.urlencode($val);    

        }

        $nvp_string = implode('&', $nvp_stringA); 

        $curl = curl_init();

        curl_setopt($curl, CURLOPT_VERBOSE, 1);

        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, TRUE);

        curl_setopt($curl, CURLOPT_TIMEOUT, 30);

        curl_setopt($curl, CURLOPT_URL, $api_endpoint);

        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

        curl_setopt($curl, CURLOPT_POSTFIELDS, $nvp_string);

        $result = curl_exec($curl);  

        $results = urldecode($result);

        $resultsA = explode('&', $results);

        echo '<pre>';print_r($resultsA);

        $payment      = 0; 

        $paymentError = '';

        if(!empty($resultsA)){

            foreach($resultsA as $resultA){ 

                $status = explode('=', $resultA);  

                if(!empty($status[0])&&!empty($status[1])&&strtolower($status[0])=='ack'&&strtolower($status[1])=='success'){

                    $payment = 1;

                }

                if(!empty($status[0])&&!empty($status[1])&&strtolower($status[0])=='l_longmessage0'){

                    $paymentError = $status[1];

                }

            }

        }

        echo $payment;

    } 

    public function edit_resort_5() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('resort_id', 'resort id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $ajaxResponce =  $this->get_resort_5($this->input->post('resort_id'));    

            $ajaxResponce['message'] = 'Resort is data fetched successfully';   

        }

        echo json_encode($ajaxResponce);

    }

    public function get_resort_5($resort_id='') {

        $ajaxResponce        = array('status' => 'true');

        $data                = array();

        $data['villa_types'] = $this->common_model->get_result('villa_type', array('status'=>1), array(), array('id', 'asc'));

        $data['ideals']      = $this->common_model->get_result('ideals', array('status'=>1), array(), array('ideal_name', 'asc'));        

        $data['accommodation_heading'] = $this->common_model->get_result('resorts', array('id'=>$resort_id));
        $data['accommodation_heading'] = $data['accommodation_heading'][0];

        if($this->input->post('accommodation_id')){

            $data['row']     = $this->common_model->get_row('accommodation', array('id'=>$this->input->post('accommodation_id')));

        }

        $data['accommodations']   = $this->developer_model->get_accommodation($resort_id); 

		$data['amenities'] = $this->common_model->get_result('amenities', array('status'=>1), array(), array('amenitie_name', 'asc'));

        $data['resort_id']        = $resort_id;

        $ajaxResponce['nexthtml'] = $this->load->view('frontend/add_resort_5', $data, true);

        return $ajaxResponce;

    }

    public function save_resort_5() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('name_of_villa', 'name of villa', 'required');

        $this->form_validation->set_rules('description', 'description', 'required');

        $this->form_validation->set_rules('villa_type', 'villa type', 'required');

        $this->form_validation->set_rules('number_of_rooms_per_villa', 'number of rooms per villa', 'required');

        if ($this->form_validation->run() == TRUE) {

            $priority_order = 1;

	    	if($this->input->post('resort_id')){

	    		$priority_order = get_all_count('accommodation', array('resort_id'=>$this->input->post('resort_id')));

	    		$priority_order++;

	    	}

            $insertData = array();

            if($this->input->post('name_of_villa')){

                $insertData['name_of_villa'] = $this->input->post('name_of_villa');

            }

            if($this->input->post('description')){

                $insertData['description'] = $this->input->post('description');

            }

            if($this->input->post('villa_type')){

                $insertData['villa_type'] = $this->input->post('villa_type');

            }

            if($this->input->post('number_of_rooms_per_villa')){

                $insertData['number_of_rooms_per_villa'] = $this->input->post('number_of_rooms_per_villa');

            }

            if($this->input->post('number_of_units')){

                $insertData['number_of_units'] = $this->input->post('number_of_units');

            }

            if($this->input->post('room_size')){

                $insertData['room_size'] = $this->input->post('room_size');

            }

            if($this->input->post('villa_with_pool')){

                $insertData['villa_with_pool'] = $this->input->post('villa_with_pool');

            }

            if($this->input->post('is_living_status')&&$this->input->post('is_living_status')==1){

                $insertData['is_living_status'] = 1;

            }else{

                $insertData['is_living_status'] = 2;

            }

            if($this->input->post('villa_location')){

                $insertData['villa_location'] = $this->input->post('villa_location');

            } 

            if($this->input->post('ideal_for')){

                $insertData['ideal_for'] = implode(',', $this->input->post('ideal_for'));

            }

            if($this->input->post('amenities')){

                $insertData['amenities'] = implode(',', $this->input->post('amenities'));
    
            }

            if($this->input->post('facilities')){

                $insertData['facilities'] = implode(',', $this->input->post('facilities'));

            }             

            if($this->input->post('floor_plan')){

                $insertData['floor_plan'] = $this->input->post('floor_plan');

            }

            if($this->input->post('resort_id')){

                $insertData['resort_id'] = $this->input->post('resort_id');

                $resort_id               = $this->input->post('resort_id');   

            }       

            if($this->input->post('accommodation_id')){

                $this->common_model->update('accommodation', $insertData, array('id'=>$this->input->post('accommodation_id')));

                $accommodation_id = $this->input->post('accommodation_id');

            }else{

            	$insertData['priority_order'] =  $priority_order;

                $accommodation_id = $this->common_model->insert('accommodation', $insertData);

            }         

            if($this->input->post('photos')){

                $photos = explode(',', $this->input->post('photos'));

                if(!empty($photos)){

                    foreach($photos as $photo){

                        $accommodationArr = array('type' => 'accommodation', 

                                                'item_id'   => $accommodation_id,

                                                'image_name' => $photo

                                            );

                        $this->common_model->insert('images', $accommodationArr);

                    }

                }

            }  

            $ajaxResponce =  $this->get_resort_7($resort_id);               

            $ajaxResponce['message'] = 'Accommodation is saved successfully'; 

        } else {

            $ajaxResponce = array('status' => 'false', 'message' => validation_errors());

        }

        echo json_encode($ajaxResponce);

    }

    public function save_resort_without_validate_5() {

    	$priority_order = 1;

    	if($this->input->post('resort_id')){

    		$priority_order = get_all_count('accommodation', array('resort_id'=>$this->input->post('resort_id')));

    		$priority_order++;

    	}

        $ajaxResponce  = array();

        //print_r($_POST); exit();

        $insertData = array();

        if($this->input->post('name_of_villa')){

            $insertData['name_of_villa'] = $this->input->post('name_of_villa');

        }

        if($this->input->post('description')){

            $insertData['description'] = $this->input->post('description');

        }

        if($this->input->post('villa_type')){

            $insertData['villa_type'] = $this->input->post('villa_type');

        }

        if($this->input->post('number_of_rooms_per_villa')){

            $insertData['number_of_rooms_per_villa'] = $this->input->post('number_of_rooms_per_villa');

        }

        if($this->input->post('number_of_units')){

            $insertData['number_of_units'] = $this->input->post('number_of_units');

        }

        if($this->input->post('room_size')){

            $insertData['room_size'] = $this->input->post('room_size');

        }

        if($this->input->post('villa_with_pool')){

            $insertData['villa_with_pool'] = $this->input->post('villa_with_pool');

        }

        if($this->input->post('villa_location')){

            $insertData['villa_location'] = $this->input->post('villa_location');

        } 

        if($this->input->post('ideal_for')){

            $insertData['ideal_for'] = implode(',', $this->input->post('ideal_for'));

        }

        if($this->input->post('facilities')){

            $insertData['facilities'] = implode(',', $this->input->post('facilities'));

        } 

		if($this->input->post('amenities')){

            $insertData['amenities'] = implode(',', $this->input->post('amenities'));

        }             

        if($this->input->post('floor_plan')){

            $insertData['floor_plan'] = $this->input->post('floor_plan');

        }

        if($this->input->post('resort_id')){

            $insertData['resort_id'] = $this->input->post('resort_id');

            $resort_id               = $this->input->post('resort_id');   

        }       
        
        if($this->input->post('accommodation_id')){
            
            
            $this->common_model->update('accommodation', $insertData, array('id'=>$this->input->post('accommodation_id')));

            $accommodation_id = $this->input->post('accommodation_id');

        }elseif(!empty($insertData)&&$this->input->post('name_of_villa')&&$this->input->post('description')&&$this->input->post('villa_type')&&$this->input->post('number_of_rooms_per_villa')){

        	$insertData['priority_order'] =  $priority_order;

            $accommodation_id = $this->common_model->insert('accommodation', $insertData);

        }         

        if($this->input->post('photos')){

            $photos = explode(',', $this->input->post('photos'));

            if(!empty($photos)){

                foreach($photos as $photo){

                    $accommodationArr = array('type' 	 => 'accommodation', 

                                            'item_id'    => $accommodation_id,

                                            'image_name' => $photo

                                        );

                    $this->common_model->insert('images', $accommodationArr);

                }

            }

        }  

        $ajaxResponce =  $this->get_resort_7($resort_id);               

        $ajaxResponce['message'] = 'Accommodation is saved successfully';

        echo json_encode($ajaxResponce);

    }

    public function update_accommodation_heading(){

        if($this->input->post('resort_id')){  

            $this->common_model->update('resorts', array('accommodation_heading'=>$this->input->post('accommodation_heading')), array('id'=> $this->input->post('resort_id')));

        }

    }

    public function update_dinning_heading(){


        if($this->input->post('resort_id')){  

            $this->common_model->update('resorts', array('dinning_heading'=>$this->input->post('dinning_heading')), array('id'=> $this->input->post('resort_id')));

        }

    }

    public function update_activities_description(){


        if($this->input->post('resort_id')){  

            $this->common_model->update('resorts', array('activities_description'=>$this->input->post('desc_Activities')), array('id'=> $this->input->post('resort_id')));

        }

    }

    public function edit_accommodation() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('resort_id', 'resort id', 'required');

        if ($this->form_validation->run() == TRUE) {

            // $ajaxResponce        = array('status' => 'true');

            $data                = array();

            $data['villa_types'] = $this->common_model->get_result('villa_type', array('status'=>1), array(), array('id', 'asc'));

            $data['ideals']      = $this->common_model->get_result('ideals', array('status'=>1), array(), array('id', 'asc'));

            if($this->input->post('accommodation_id')){

                $data['accommodationRow']     = $this->common_model->get_row('accommodation', array('id'=>$this->input->post('accommodation_id')));

                $data['images']  = $this->common_model->get_result('images', array('item_id'=>$this->input->post('accommodation_id'), 'type'=>'accommodation'));

            }

            $ajaxResponce = $this->load->view('frontend/edit_accommodation_data', $data, true);   

        $data['template']       = 'frontend/index';

        $this->load->view('frontend/edit_accommodation_data', $data);  
        
            // $ajaxResponce['message']  = 'Accommodation is data fetched successfully';

        }
        echo json_encode($ajaxResponce);

    }

    public function accommodation_priority_order(){

        if($this->input->post('orders')){  

            $orders  = $this->input->post('orders');

            $co = 1;

            if(!empty($orders)){

                foreach($orders as $order){

                    $this->common_model->update('accommodation', 

                            array('priority_order'=>$co), 

                            array('id'=>$order));

                    $co++;

                }

            }

        }

    }

    public function delete_accommodation() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('accommodation_id', 'resort id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $ajaxResponce        = array('status' => 'true');

            if($this->input->post('accommodation_id')){

                $this->common_model->delete('accommodation', array('id'=>$this->input->post('accommodation_id')));

            }  

            $ajaxResponce['message']  = 'Accommodation is deleted successfully';

        }

        echo json_encode($ajaxResponce);

    }    

    public function old_aminity() {

        //print_r($_GET);

		

		$resort_id = $this->input->post('resort_id');

        if($this->input->post('old_aminity')){            

            $oldAccommodation = $this->common_model->get_row('accommodation', array('resort_id'=>$resort_id), array('GROUP_CONCAT(amenities) as amenities'), array('id','desc'));

    

			 if(!empty($oldAccommodation->amenities)){

                $data['resortAminities'] = explode(',', $oldAccommodation->amenities);

            }

        }
        

        $data['amenities']       = $this->common_model->get_result('amenities', array('status'=>1), array(), array('id', 'asc'));

        $this->load->view('frontend/resortAminities', $data);

    } 

    public function dinning_priority_order(){

        if($this->input->post('orders')){  

            $orders = $this->input->post('orders');

            $co 	= 1;

            if(!empty($orders)){

                foreach($orders as $order){

                    $this->common_model->update('dinnings', array('priority_order'=>$co), array('id'=>$order));

                    $co++;

                }

            }

        }

    }    

    public function edit_resort_7() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('resort_id', 'resort id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $ajaxResponce =  $this->get_resort_7($this->input->post('resort_id'));    

            $ajaxResponce['message'] = 'Resort is data fetched successfully';   

        }

        echo json_encode($ajaxResponce);

    }

    public function get_resort_7($resort_id='') {

        $ajaxResponce         = array('status' => 'true');

        $data                 = array();

        $data['sports']       = $this->common_model->get_result('sport', array('status'=>1), array(), array('sport_name', 'asc'));
        
        $data['images']    = $this->common_model->get_result('images', array('type'=>'sport', 'item_id' => $resort_id), array(), array('id', 'asc'));

        $data['water_sports'] = $this->common_model->get_result('water_sports', array('status'=>1), array(), array('water_sports_name', 'asc'));

        $data['row']         = $this->common_model->get_row('resorts', array('id'=>$resort_id));

        $data['resort_id']   = $resort_id;

        $ajaxResponce['nexthtml'] = $this->load->view('frontend/add_resort_7', $data, true);

        return $ajaxResponce;

    }

    public function save_resort_7() {

        $ajaxResponce  = array();

        //print_r($_POST); exit();

        if($this->input->post('resort_id')){

            $resort_id = $this->input->post('resort_id'); 

        }

        $insertData = array();        

        if($this->input->post('sports')){

            $insertData['sports'] = implode(',', $this->input->post('sports'));

        }

        if($this->input->post('water_sports')){

            $insertData['water_sports'] = implode(',', $this->input->post('water_sports'));

        }               

        if($this->input->post('resort_id')&&!empty($insertData)){

            $this->common_model->update('resorts', $insertData, array('id'=>$this->input->post('resort_id')));            

        } 
        
        if($this->input->post('sport_images')){

            $resort_images = explode(',', $this->input->post('sport_images'));

            if(!empty($resort_images)){

                foreach($resort_images as $resort_image){

                    $imgArr = array('type'=>'sport', 'item_id' =>$resort_id, 'image_name'=>$resort_image); 

                    $this->common_model->insert('images', $imgArr);

                }

            }

        }  

        $ajaxResponce =  $this->get_resort_8($resort_id);               

        $ajaxResponce['message'] = 'Resort is updated successfully'; 

        echo json_encode($ajaxResponce);

    }

    public function edit_resort_8() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('resort_id', 'resort id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $ajaxResponce =  $this->get_resort_8($this->input->post('resort_id'));    

            $ajaxResponce['message'] = 'Resort is data fetched successfully';   

        }

        echo json_encode($ajaxResponce);

    }

    public function get_resort_8($resort_id='') {

        $ajaxResponce           = array('status' => 'true');

        $data['meal_serveds']   = $this->common_model->get_result('meal_served', array('status'=>1), array(), array('id', 'asc'));

        $data['dinnings_type'] = $this->common_model->get_result('dinnings_type', array('status'=>1), array(), array('dinnings_type', 'asc'));

        $data['meal_plans']  = $this->common_model->get_result('meal_plans', array('status'=>1), array(), array('id', 'asc'));

        $data['dress_codes'] = $this->common_model->get_result('dress_codes', array('status'=>1), array(), array('id', 'asc'));

        $data['dinning_heading'] = $this->common_model->get_result('resorts', array('id'=>$resort_id));
        $data['dinning_heading'] = $data['dinning_heading'][0];
        

        $data['dinnings']  = $this->developer_model->get_user_dinnings($resort_id);

        //echo '<pre>';print_r($data['dinnings']); exit();

        $data['resort_id'] = $this->input->get('resort_id');

        $data['resort_id'] = $resort_id;

        $ajaxResponce['nexthtml'] = $this->load->view('frontend/add_resort_8', $data, true);

        return $ajaxResponce;

    }

    public function edit_dinning() {
        
        // $ajaxResponce  = array();

        $this->form_validation->set_rules('resort_id', 'resort id', 'required');

        if ($this->form_validation->run() == TRUE) {

            // $ajaxResponce        = array('status' => 'true');

            $data                = array();

            $data['meal_serveds']   = $this->common_model->get_result('meal_served', array('status'=>1), array(), array('id', 'asc'));
// echo "<pre>"; var_dump($data['meal_serveds']); die;
            $data['dinnings_type']  = $this->common_model->get_result('dinnings_type', array('status'=>1), array(), array('id', 'asc'));

            $data['meal_plans']     = $this->common_model->get_result('meal_plans', array('status'=>1), array(), array('id', 'asc'));

            $data['dress_codes']    = $this->common_model->get_result('dress_codes', array('status'=>1), array(), array('id', 'asc'));

            if($this->input->post('dinning_id')){

                $data['row'] = $this->common_model->get_row('dinnings', array('id'=>$this->input->post('dinning_id')));

                $data['images']  = $this->common_model->get_result('images', array('item_id'=>$this->input->post('dinning_id'), 'type'=>'dinning'));

            }

            // $ajaxResponce['nexthtml'] = $this->load->view('frontend/edit_dinning_data', $data, true);   

        $data['template']       = 'frontend/index';

        $ajaxResponce = $this->load->view('frontend/edit_dinning_data', $data);  
        
            // $ajaxResponce['message']  = 'Accommodation is data fetched successfully';

        }
        echo json_encode($ajaxResponce);
        
    }

    public function delete_dinning() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('dinning_id', 'dinning id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $ajaxResponce        = array('status' => 'true');

            if($this->input->post('dinning_id')){

                $this->common_model->delete('dinnings', array('id'=>$this->input->post('dinning_id')));

                $this->common_model->delete('dinnings_meal_served', array('dinning_id'=>$this->input->post('dinning_id')));

            }  

            $ajaxResponce['message']  = 'Dinning is deleted successfully';

        }

        echo json_encode($ajaxResponce);

    }

    public function save_resort_8() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('name_of_restaurant', 'name of restaurant', 'required');

        $this->form_validation->set_rules('description', 'description', 'required');

        if ($this->form_validation->run() == TRUE) {//die("here");

        	$priority_order = 1;

	    	if($this->input->post('resort_id')){

	    		$priority_order = get_all_count('dinnings', array('resort_id'=>$this->input->post('resort_id')));

	    		$priority_order++;

	    	}

            //print_r($_POST); exit();

            $food_types_ids = array();

            $food_types     = $this->common_model->get_result('food_types', array('status'=>1));

            if(!empty($food_types)){

                foreach($food_types as $food_type){

                    if($this->input->post('food_type_'.$food_type->id)){

                        $food_types_ids[]  = $food_type->id;

                    }

                }

            }

            $insertData = array();

            if($this->input->post('name_of_restaurant')){

                $insertData['name_of_restaurant'] = $this->input->post('name_of_restaurant');

            }

            if($this->input->post('description')){

                $insertData['description'] = $this->input->post('description');

            }

            if($this->input->post('restaurant_type')){

                $insertData['restaurant_type'] = implode(',', $this->input->post('restaurant_type'));

            }

            if($this->input->post('meal_plans_applicables')){

                $insertData['meal_plans_applicable'] = implode(',', $this->input->post('meal_plans_applicables'));

            }  

            if($this->input->post('dress_codes')){

                $insertData['dress_code'] = implode(',', $this->input->post('dress_codes'));

            }    

            if(!empty($food_types_ids)){

                $food_types_id = implode(',', $food_types_ids);

                $insertData['food_type'] = $food_types_id;

            }       

            if($this->input->post('dinning_menu')){

                $insertData['dinning_menu'] = $this->input->post('dinning_menu');

            }            

            if($this->input->post('resort_id')){

                $insertData['resort_id'] = $this->input->post('resort_id');

                $resort_id               = $this->input->post('resort_id');   

            }       

            if($this->input->post('dinning_id')){            	

                $this->common_model->update('dinnings', $insertData, array('id'=>$this->input->post('dinning_id'))); 

                $dinning_id   = $this->input->post('dinning_id');

                $ajaxResponce = array('status' => 'true', 'message' => 'Dinning is updated successfully');

            }else {

            	$insertData['priority_order'] = $priority_order; 

                $dinning_id   = $this->common_model->insert('dinnings', $insertData);

            }  

            $meal_plans       = $this->common_model->get_result('meal_plans', array('status'=>1), array(), array('id', 'asc'));

            if($this->input->post('resort_images')){

                $photos = explode(',', $this->input->post('resort_images'));

                if(!empty($photos)){

                    foreach($photos as $photo){

                        $dinningArr = array('type'       => 'dinning', 

                                            'item_id'    => $dinning_id,

                                            'image_name' => $photo

                                        );

                        $this->common_model->insert('images', $dinningArr);

                    }

                }

            }  

            //$this->common_model->delete('dinnings_meal_served', array('dinning_id'=>$dinning_id));

            if(!empty($dinning_id)){

                if(!empty($meal_plans)){

                    foreach($meal_plans as $meal_plan){

                        if($this->input->post('meal_served_status_'.$meal_plan->id)){

                            $meal_plan_data = array();

                            $meal_plan_data['dinning_id'] = $dinning_id;

                            if($this->input->post('meal_served_status_'.$meal_plan->id)){

                                $meal_plan_data['meal_served_status'] = $this->input->post('meal_served_status_'.$meal_plan->id);

                            }

                            $meal_row = $this->common_model->get_row('dinnings_meal_served', $meal_plan_data); 

                            if($this->input->post('open_hour_'.$meal_plan->id)){

                                $meal_plan_data['open_hour'] = $this->input->post('open_hour_'.$meal_plan->id);

                            }

                            if($this->input->post('open_minut_'.$meal_plan->id)){

                                $meal_plan_data['open_minut'] = $this->input->post('open_minut_'.$meal_plan->id);

                            }

                            if($this->input->post('closing_hour_'.$meal_plan->id)){

                                $meal_plan_data['closing_hour'] = $this->input->post('closing_hour_'.$meal_plan->id);

                            }

                            if($this->input->post('closing_minut_'.$meal_plan->id)){

                                $meal_plan_data['closing_minut'] = $this->input->post('closing_minut_'.$meal_plan->id);

                            }

                            if($this->input->post('meal_style_'.$meal_plan->id)){

                                $meal_plan_data['meal_type'] = $this->input->post('meal_style_'.$meal_plan->id);

                            }

                            if($this->input->post('menu_chart_'.$meal_plan->id)){

                                $meal_plan_data['menu_chart'] = $this->input->post('menu_chart_'.$meal_plan->id);

                            }

                            if(!empty($resort_id)){

                                $meal_plan_data['resort_id'] = $resort_id;

                            }

                            if(!empty($meal_row->id)){

                                $this->common_model->update('dinnings_meal_served', $meal_plan_data, array('id'=>$meal_row->id));

                            }else{

                                $this->common_model->insert('dinnings_meal_served', $meal_plan_data);

                            }

                        }

                    }

                }

            }

            $ajaxResponce =  $this->get_resort_9($resort_id);               

            $ajaxResponce['message'] = 'Dinning is saved successfully';  

        } else {
// die("here1");
            $ajaxResponce = array('status' => 'false', 'message' => validation_errors());

        }

        echo json_encode($ajaxResponce);

    }

    public function save_resort_with_out_8() {

    	$priority_order = 0;

    	if($this->input->post('resort_id')){

    		$priority_order = get_all_count('accommodation', array('resort_id'=>$this->input->post('resort_id')));

    	}

        $ajaxResponce  = array();

        // print_r($_POST); exit();

        $food_types_ids = array();

        $food_types     = $this->common_model->get_result('food_types', array('status'=>1));

        if(!empty($food_types)){

            foreach($food_types as $food_type){

                if($this->input->post('food_type_'.$food_type->id)){

                    $food_types_ids[]  = $food_type->id;

                }

            }

        }

        $insertData = array();

        if($this->input->post('name_of_restaurant')){

            $insertData['name_of_restaurant'] = $this->input->post('name_of_restaurant');

        }

        if($this->input->post('description')){

            $insertData['description'] = $this->input->post('description');

        }

        if($this->input->post('restaurant_type')){

            $insertData['restaurant_type'] = implode(',', $this->input->post('restaurant_type'));

        }

        if($this->input->post('meal_plans_applicables')){

            $insertData['meal_plans_applicable'] = implode(',', $this->input->post('meal_plans_applicables'));

        }  

        if($this->input->post('dress_codes')){

            $insertData['dress_code'] = implode(',', $this->input->post('dress_codes'));

        }    

        if(!empty($food_types_ids)){

            $food_types_id = implode(',', $food_types_ids);

            $insertData['food_type'] = $food_types_id;

        }       

        if($this->input->post('dinning_menu')){

            $insertData['dinning_menu'] = $this->input->post('dinning_menu');

        }            

        if($this->input->post('resort_id')){

            $insertData['resort_id'] = $this->input->post('resort_id');

            $resort_id               = $this->input->post('resort_id');   

        }       

        if($this->input->post('dinning_id')){

            $this->common_model->update('dinnings', $insertData, array('id'=>$this->input->post('dinning_id'))); 

            $dinning_id   = $this->input->post('dinning_id');

            $ajaxResponce = array('status' => 'true', 'message' => 'Dinning is updated successfully');

        }else if(!empty($insertData)&&$this->input->post('name_of_restaurant')&&$this->input->post('description')){

        	$insertData['priority_order'] = $priority_order; 

            $dinning_id   = $this->common_model->insert('dinnings', $insertData);

        }  

        $meal_plans       = $this->common_model->get_result('meal_plans', array('status'=>1), array(), array('id', 'asc'));

        if($this->input->post('resort_images')){

            $photos = explode(',', $this->input->post('resort_images'));

            if(!empty($photos)){

                foreach($photos as $photo){

                    $dinningArr = array('type'       => 'dinning', 

                                        'item_id'    => $dinning_id,

                                        'image_name' => $photo

                                    );

                    $this->common_model->insert('images', $dinningArr);

                }

            }

        }  

        if(!empty($dinning_id)){

            if(!empty($meal_plans)){

                foreach($meal_plans as $meal_plan){

                    if($this->input->post('meal_served_status_'.$meal_plan->id)){

                        $meal_plan_data = array();

                        $meal_plan_data['dinning_id'] = $dinning_id;

                        if($this->input->post('meal_served_status_'.$meal_plan->id)){

                            $meal_plan_data['meal_served_status'] = $this->input->post('meal_served_status_'.$meal_plan->id);

                        }

                        $meal_row = $this->common_model->get_row('dinnings_meal_served', $meal_plan_data); 

                        if($this->input->post('open_hour_'.$meal_plan->id)){

                            $meal_plan_data['open_hour'] = $this->input->post('open_hour_'.$meal_plan->id);

                        }

                        if($this->input->post('open_minut_'.$meal_plan->id)){

                            $meal_plan_data['open_minut'] = $this->input->post('open_minut_'.$meal_plan->id);

                        }

                        if($this->input->post('closing_hour_'.$meal_plan->id)){

                            $meal_plan_data['closing_hour'] = $this->input->post('closing_hour_'.$meal_plan->id);

                        }

                        if($this->input->post('closing_minut_'.$meal_plan->id)){

                            $meal_plan_data['closing_minut'] = $this->input->post('closing_minut_'.$meal_plan->id);

                        }

                        if($this->input->post('no_time_'.$meal_plan->id)){

                            $meal_plan_data['no_time'] = $this->input->post('no_time_'.$meal_plan->id);

                        }

                        if($this->input->post('meal_style_'.$meal_plan->id)){

                            $meal_plan_data['meal_type'] = $this->input->post('meal_style_'.$meal_plan->id);

                        }

                        if($this->input->post('menu_chart_'.$meal_plan->id)){

                            $meal_plan_data['menu_chart'] = $this->input->post('menu_chart_'.$meal_plan->id);

                        }

                        if(!empty($resort_id)){

                            $meal_plan_data['resort_id'] = $resort_id;

                        }

                        if(!empty($meal_row->id)){

                            $this->common_model->update('dinnings_meal_served', $meal_plan_data, array('id'=>$meal_row->id));

                        }else{

                            $this->common_model->insert('dinnings_meal_served', $meal_plan_data);

                        }

                    }

                }

            }

        }

        $ajaxResponce 			 = $this->get_resort_9($resort_id);               

        $ajaxResponce['message'] = 'Dinning is saved successfully';  

        echo json_encode($ajaxResponce);

    }

    public function edit_resort_9() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('resort_id', 'resort id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $ajaxResponce =  $this->get_resort_9($this->input->post('resort_id'));    

            $ajaxResponce['message'] = 'Resort is data fetched successfully';   

        }

        echo json_encode($ajaxResponce);

    }

    public function get_resort_9($resort_id='') {

        $ajaxResponce      = array('status' => 'true');

        $data              = array();

        $data['images']    = $this->common_model->get_result('images', array('type'=>'spa', 'item_id' => $resort_id), array(), array('id', 'asc'));

        $data['row']       = $this->common_model->get_row('resorts', array('id'=>$resort_id));

        $data['resort_id'] = !empty($resort_id)?$resort_id:'';

        $ajaxResponce['nexthtml'] = $this->load->view('frontend/add_resort_9', $data, true);

        return $ajaxResponce;

    }    

    public function save_resort_9() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('name_of_the_spa', 'name of restaurant', 'required');

        $this->form_validation->set_rules('spa_description', 'description', 'required');

        if ($this->form_validation->run() == TRUE) {

            //print_r($_POST); exit();

            $insertData = array();

            if($this->input->post('name_of_the_spa')){

                $insertData['name_of_the_spa'] = $this->input->post('name_of_the_spa');

            }

            if($this->input->post('spa_description')){

                $insertData['spa_description'] = $this->input->post('spa_description');

            }     

            if($this->input->post('signature_treatment')){

                $insertData['signature_treatment'] = $this->input->post('signature_treatment');

            }

            if($this->input->post('signature_treatment_description')){

                if(!empty($this->input->post('signature_treatment_description'))) {
                    $insertData['signature_treatment_description'] = implode("###",$this->input->post('signature_treatment_description'));
                } else {
                    $insertData['signature_treatment_description'] = "";
                }
            }            

            if($this->input->post('resort_spa_menu')){

                $insertData['spa_menu'] = $this->input->post('resort_spa_menu');

            }      

            if($this->input->post('resort_id')){

                $this->common_model->update('resorts', $insertData, array('id'=>$this->input->post('resort_id'))); 

                $resort_id   = $this->input->post('resort_id');

                $ajaxResponce = array('status' => 'true', 'message' => 'Resort is updated successfully');

            }

            if($this->input->post('spa_images')){

                $resort_images = explode(',', $this->input->post('spa_images'));

                if(!empty($resort_images)){

                    foreach($resort_images as $resort_image){

                        $imgArr = array('type'=>'spa', 'item_id' =>$resort_id, 'image_name'=>$resort_image); 

                        $this->common_model->insert('images', $imgArr);

                    }

                }

            }          

            $ajaxResponce      = array('status' => 'true');

            $data              = array();

            $data['activitys'] = $this->common_model->get_result('activitie_excursions', array('resort_id'=>$resort_id), array(), array('priority_order', 'ASC'));

			$data['experience_categories'] = $this->common_model->get_result('experience_category', array('status'=> 1), array(), array('exp_cat_id', 'ASC'));

            $data['resort_id'] = !empty($resort_id)?$resort_id:'';

            $ajaxResponce['nexthtml'] = $this->load->view('frontend/add_resort_10', $data, true);              

            $ajaxResponce['message'] = 'Resort is updated successfully'; 

        } else {

            $ajaxResponce = array('status' => 'false', 'message' => validation_errors());

        }

        echo json_encode($ajaxResponce);

    }

    public function get_resort_10() {

        $ajaxResponce      = array('status' => 'true');

        if($this->input->post('resort_id')){

            $data              = array();

            $resort_id         = $this->input->post('resort_id');

            $data['resort'] = $this->common_model->get_row('resorts', array('id'=> $resort_id));
            
            $data['activitys'] = $this->common_model->get_result('activitie_excursions', array('resort_id'=> $resort_id), array(), array('priority_order', 'ASC'));

			$data['experience_categories'] = $this->common_model->get_result('experience_category', array('status'=> 1), array(), array('exp_cat_id', 'ASC'));

            $data['resort_id'] = !empty($resort_id)?$resort_id:'';

            $ajaxResponce['nexthtml'] = $this->load->view('frontend/add_resort_10', $data, true);

        }

        echo json_encode($ajaxResponce);

    }

    public function get_resort_11($resort_id = null) {

        
        if($this->input->post('resort_id')){

            $data              = array();

            $resort_id         = $this->input->post('resort_id');

            $ajaxResponce           = array('status' => 'true');

            $data['faqs'] = $this->common_model->get_result('resorts_faq', array('resort_id'=> $resort_id));
            $data['admin_faqs'] = $this->common_model->get_result('faq');
            
            $data['resort_id'] = !empty($resort_id)?$resort_id:'';

            $ajaxResponce['nexthtml'] = $this->load->view('frontend/add_resort_11', $data, true);

        }

        echo json_encode($ajaxResponce);

    }

    public function edit_activity() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('activity_id', 'activity id', 'required');

        $this->form_validation->set_rules('resort_id', 'resort id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $ajaxResponce           = array('status' => 'true');

            $data                   = array();

            if($this->input->post('activity_id')){

                $data['row'] = $this->common_model->get_row('activitie_excursions', array('id'=>$this->input->post('activity_id')));

            }

		

            $data['activitys']        = $this->common_model->get_result('activitie_excursions', array('resort_id' => $this->input->post('resort_id')));

			$data['experience_categories'] = $this->common_model->get_result('experience_category', array('status'=> 1), array(), array('exp_cat_id', 'ASC'));

            $ajaxResponce['nexthtml'] = $this->load->view('frontend/add_activity_data', $data, true);   

            $ajaxResponce['message']  = 'Activity is data fetched successfully';

        }

        echo json_encode($ajaxResponce);

    }

    public function edit_FAQ() {

        $ajaxResponce  = array();
        
        //$this->form_validation->set_rules('faq_id', 'faq id', 'required');
        //echo "asd";exit;
        
                

            $ajaxResponce           = array('status' => 'true');

            $data                   = array();
            if($this->input->post('FAQ_id')){

                $data['row'] = $this->common_model->get_row('mal_resorts_faq', array('id'=>$this->input->post('FAQ_id')));

            }
            
            $data['faqs']        = $this->common_model->get_result('mal_resorts_faq', array('id' => $this->input->post('FAQ_id')));
            $data['admin_faqs'] = $this->common_model->get_result('faq');


			$ajaxResponce['nexthtml'] = $this->load->view('frontend/add_faq_data', $data, true);   

            $ajaxResponce['message']  = 'FAQ is data fetched successfully';

        

        echo json_encode($ajaxResponce);

    }

    public function delete_activity() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('activity_id', 'activity id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $ajaxResponce = array('status' => 'true');

            if($this->input->post('activity_id')){

                $this->common_model->delete('activitie_excursions', array('id'=>$this->input->post('activity_id')));

            }  

            $ajaxResponce['message']  = 'Activity is deleted successfully';

        }

        echo json_encode($ajaxResponce);

    }

    public function delete_FAQ() {

        $ajaxResponce  = array();
        
        $ajaxResponce = array('status' => 'true');

        if($this->input->post('FAQ_id')){

            $this->common_model->delete('mal_resorts_faq', array('id'=>$this->input->post('FAQ_id')));

        }  

        $ajaxResponce['message']  = 'FAQ is deleted successfully';

        
        echo json_encode($ajaxResponce);

    }

    public function save_resort_10() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('name_of_activities', 'name of activity', 'required');

        $this->form_validation->set_rules('activities_description', 'description', 'required');

        if ($this->form_validation->run() == TRUE) {

        	$priority_order = 1;

	    	if($this->input->post('resort_id')){

	    		$priority_order = get_all_count('activitie_excursions', array('resort_id'=>$this->input->post('resort_id')));

	    		$priority_order++;

	    	}

            $insertData = array();

            if($this->input->post('name_of_activities')){

                $insertData['name_of_activities'] = $this->input->post('name_of_activities');

            }

            if($this->input->post('activities_description')){

                $insertData['activities_description'] = $this->input->post('activities_description');

            }     

            if($this->input->post('resort_activities_image')){

                $insertData['activities_image'] = $this->input->post('resort_activities_image');

            } 

            if($this->input->post('resort_id')){

                $insertData['resort_id'] = $this->input->post('resort_id');

            }

			if($this->input->post('exp_cat_ids')){

				$exp_cat_ids = implode(",",$this->input->post('exp_cat_ids'));

				$insertData['experience_category'] = $exp_cat_ids;

            }     

            if($this->input->post('activity_id')){

                $this->common_model->update('activitie_excursions', $insertData, array('id'=>$this->input->post('activity_id'))); 

                $ajaxResponce = array('status' => 'true', 'message' => 'Activity is updated successfully');

            }else{

            	$insertData['priority_order'] =  $priority_order;

                $this->common_model->insert('activitie_excursions', $insertData);

                $ajaxResponce = array('status' => 'true', 'message' => 'Activity is added successfully');

            }

            $resort_id         = $this->input->post('resort_id');

            $data              = array();

            $data['activitys'] = $this->common_model->get_result('activitie_excursions', array('resort_id' => $resort_id));

            $data['resort_id'] = !empty($resort_id)?$resort_id:'';

			$data['experience_categories'] = $this->common_model->get_result('experience_category', array('status'=> 1), array(), array('exp_cat_id', 'ASC'));

            $ajaxResponce['nexthtml']     = $this->load->view('frontend/add_activity_data', $data, true);             

        } else {

            $ajaxResponce = array('status' => 'false', 'message' => validation_errors());

        }

        echo json_encode($ajaxResponce);

    }

    public function save_resort_11() {

        $ajaxResponce  = array();

        //$this->form_validation->set_rules('name_of_activities', 'name of activity', 'required');

        $this->form_validation->set_rules('question', 'Question', 'required');

        if ($this->form_validation->run() == TRUE) {

            $insertData = array();

            if($this->input->post('question')){

                $insertData['question'] = $this->input->post('question');

            }

            if($this->input->post('answer')){

                $insertData['answer'] = $this->input->post('answer');

            }     

            if($this->input->post('resort_id')){

                $insertData['resort_id'] = $this->input->post('resort_id');

            }

			
            if($this->input->post('faq_id')){

                $this->common_model->update('resorts_faq', $insertData, array('id'=>$this->input->post('faq_id'))); 

                $ajaxResponce = array('status' => 'true', 'message' => 'FAQ is updated successfully');

            }else{

                $this->common_model->insert('resorts_faq', $insertData);

                $ajaxResponce = array('status' => 'true', 'message' => 'FAQ is added successfully');

            }

            $resort_id         = $this->input->post('resort_id');

            $data              = array();

            $data['faqs'] = $this->common_model->get_result('resorts_faq', array('resort_id' => $resort_id));
            $data['admin_faqs'] = $this->common_model->get_result('faq');

            $data['resort_id'] = !empty($resort_id)?$resort_id:'';

            $ajaxResponce['nexthtml']     = $this->load->view('frontend/add_faq_data', $data, true);             

        } else {

            $ajaxResponce = array('status' => 'false', 'message' => validation_errors());

        }

        echo json_encode($ajaxResponce);

    }

    public function go_to_approval() {

        $ajaxResponce  = array();

        $this->form_validation->set_rules('resort_id', 'resort id', 'required');

        if ($this->form_validation->run() == TRUE) {

            $this->common_model->update('resorts', array('is_user_approval'=>2,'status'=>2), array('id'=>$this->input->post('resort_id')));

        }

    }

    public function activity_priority_order(){

        if($this->input->post('orders')){  

            $orders = $this->input->post('orders');

            $co 	= 1;

            if(!empty($orders)){

                foreach($orders as $order){

                    $this->common_model->update('activitie_excursions', array('priority_order'=>$co), array('id'=>$order));

                    $co++;

                }

            }

        }

    }

    public function save_resort_with_out_10() {

    	$priority_order = 1;

    	if($this->input->post('resort_id')){

    		$priority_order = get_all_count('activitie_excursions', array('resort_id'=>$this->input->post('resort_id')));

    		$priority_order++;

    	}

        $ajaxResponce  = array();

        $insertData = array();

        if($this->input->post('name_of_activities')){

            $insertData['name_of_activities'] = $this->input->post('name_of_activities');

        }

        if($this->input->post('activities_description')){

            $insertData['activities_description'] = $this->input->post('activities_description');

        }     

        if($this->input->post('resort_activities_image')){

            $insertData['activities_image'] = $this->input->post('resort_activities_image');

        } 

        if($this->input->post('resort_id')){

            $insertData['resort_id'] = $this->input->post('resort_id');

        }     

        if($this->input->post('activity_id')){

            $this->common_model->update('activitie_excursions', $insertData, array('id'=>$this->input->post('activity_id'))); 

            //$ajaxResponce = array('status' => 'true', 'message' => 'Activity is updated successfully');

        }else if(!empty($insertData)&&$this->input->post('name_of_activities')&&$this->input->post('activities_description')){

        	$insertData['priority_order'] =  $priority_order;

            $this->common_model->insert('activitie_excursions', $insertData);

            //$ajaxResponce = array('status' => 'true', 'message' => 'Activity is added successfully');

        }else{

        	//$ajaxResponce = array('status' => 'true', 'message' => 'Resort is updated successfully');

        }

        $resort_id         = $this->input->post('resort_id');

        $data              = array();

        $data['activitys'] = $this->common_model->get_result('activitie_excursions', array('resort_id' => $resort_id), array(), array('priority_order', 'ASC'));

        $data['resort_id'] = !empty($resort_id)?$resort_id:'';

        //$ajaxResponce  = $this->load->view('frontend/add_activity_data', $data, true);
        //$ajaxResponce['nexthtml'] 			 = $this->get_resort_11($resort_id);               

        $ajaxResponce      = array('status' => 'true');
        if($resort_id!="") {
            $data              = array();

            $data['faqs'] = $this->common_model->get_result('resorts_faq', array('resort_id'=> $resort_id));
            $data['admin_faqs'] = $this->common_model->get_result('faq');

            $data['resort_id'] = !empty($resort_id)?$resort_id:'';

            $ajaxResponce['nexthtml'] = $this->load->view('frontend/add_resort_11', $data, true);
        }



        echo json_encode($ajaxResponce);

    }

    public function save_resort_with_out_11() {

    	
        $ajaxResponce  = array();

        $insertData = array();

        if($this->input->post('question')){

            $insertData['question'] = $this->input->post('question');

        }

        if($this->input->post('answer')){

            $insertData['answer'] = $this->input->post('answer');

        }     

        
        if($this->input->post('resort_id')){

            $insertData['resort_id'] = $this->input->post('resort_id');

        }     
        if($this->input->post('faq_id')){

            $this->common_model->update('resorts_faq', $insertData, array('id'=>$this->input->post('id'))); 

            $ajaxResponce = array('status' => 'true', 'message' => 'FAQ is updated successfully');

        }else if(!empty($insertData)&&$this->input->post('question')&&$this->input->post('answer')){

            $this->common_model->insert('resorts_faq', $insertData);

            $ajaxResponce = array('status' => 'true', 'message' => 'FAQ is added successfully');

        }else{

        	$ajaxResponce = array('status' => 'true', 'message' => 'Resort is updated successfully');

        }

        $resort_id         = $this->input->post('resort_id');

        $data              = array();

        $data['faq'] = $this->common_model->get_result('resorts_faq', array('resort_id' => $resort_id));

        $data['resort_id'] = !empty($resort_id)?$resort_id:'';

        $ajaxResponce['nexthtml']  = $this->load->view('frontend/add_faq_data', $data, true);

        echo json_encode($ajaxResponce);

    }

    /*upload images*/

    public function uploadPics() {

       //print_r($_POST); //exit();

        $array = array('statuss' => 'false', 'message' => '');

        if($this->input->post('pdf_file')){

            $this->form_validation->set_rules('user_img', '', 'callback_uploadImg['.$this->input->post('pdf_file').']');

        }else{

            $this->form_validation->set_rules('user_img', '', 'callback_uploadImg');

        }        

        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');

        if ($this->form_validation->run() == TRUE) {

            //echo 'yes'; exit();

            $userdata = array();

            if ($this->session->userdata('uploadImg') != '') {

                $uploadImg = $this->session->userdata('uploadImg');

                $userdata['file'] = $uploadImg['user_img'];

                $this->session->unset_userdata('uploadImg'); 

                $fileTypes  = explode('.', $uploadImg['user_img']);

                $fileType   = strtolower(end($fileTypes));                

                
                if($this->input->post('profile_pic')){

                    $html     = '';

                    $array    = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img']);

                    $this->common_model->update('users', array('profile_pic'=>$uploadImg['user_img']), array('id'=>user_id()));

                }

                if($this->input->post('logo_pic')){

                    $randT      = rand(000,999).time();

                    $deletImg   = "deleteLogo('".$randT."','".$uploadImg['user_img']."')"; 

                    $html       = '<div id="'.$randT.'" class="file-upload-content"><img class="file-upload-image" src="'.base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img'].'" alt="resort logo"><div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                    $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img']);

                }

                if($this->input->post('fac_pic')){

                    $randT      = rand(000,999).time();

                    $deletImg   = "deleteFac('".$randT."','".$uploadImg['user_img']."')"; 

                    $html       = '<div id="'.$randT.'" class="file-upload-fac"><img class="file-upload-image" src="'.base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img'].'" alt="resort logo"><div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                    $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img']);

                }


            // if($this->input->post('fac_pic')){

            //     $randT      = rand(000,999).time();

            //     $deletImg   = "deleteFac('".$randT."','".$uploadImg['user_img']."')"; 

            //   $html       = '<div id="'.$randT.'" class="file-upload-fac">';

            //   if($fileType=='pdf'){

            //         $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation"></iframe>';

            //     }else{

            //         $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation">';

            //     } 

            //     $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

            //     $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img']);

            // }



                if($this->input->post('affiliation_pic')){

                    $randT      = rand(000,999).time();

                    $deletImg   = "deleteAffiliation('".$randT."','".$uploadImg['user_img']."')";

                    $html       = '<div id="'.$randT.'" class="file-upload-content">';

                    if($fileType=='pdf'){

                        $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation"></iframe>';

                    }else{                        

                        $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$uploadImg['user_img'].'" alt="resort affiliation">';

                    }                  

                    $html   .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                    $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/thumbnails/150_'.$uploadImg['user_img']);

                }

                if($this->input->post('factsheet_pic')){

                    $randT      = rand(000,999).time();

                    $deletImg   = "deletefactsheet('".$randT."','".$uploadImg['user_img']."')"; 

                    $html       = '<div id="'.$randT.'" class="file-upload-content">';

                    if($fileType=='pdf'){

                        $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation"></iframe>';

                    }else{

                        $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$uploadImg['user_img'].'" alt="resort affiliation">';

                    }                  

                    $html   .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                    $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img']);

                }

                if($this->input->post('resort_map_pic')){

                    $randT      = rand(000,999).time();

                    $deletImg   = "deleteResortMap('".$randT."','".$uploadImg['user_img']."')"; 

                    $html       = '<div id="'.$randT.'" class="file-upload-content">';

                    if($fileType=='pdf'){

                        $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation"></iframe>';

                    }else{

                        $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation">';

                    }  

                    $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                    $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/thumbnails/150_'.$uploadImg['user_img']);

                }

                if($this->input->post('resort_brochure_pic')){

                    $randT      = rand(000,999).time();

                    $deletImg   = "deleteResortBrochure('".$randT."','".$uploadImg['user_img']."')"; 

                    $html       = '<div id="'.$randT.'" class="file-upload-content">';

                    if($fileType=='pdf'){

                        $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation"></iframe>';

                    }else{

                        $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$uploadImg['user_img'].'" alt="resort affiliation">';

                    }  

                    $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                    $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img']);

                } 

                if($this->input->post('resort_image_pic')){

                    $randT      = rand(000,999).time();

                    $deletImg   = "deleteResortImage('".$randT."','".$uploadImg['user_img']."')"; 

                    $html       = '<div id="'.$randT.'" class="file-upload-content">';

                    if($fileType=='pdf'){

                        $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation"></iframe>';

                    }else{

                        $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$uploadImg['user_img'].'" alt="resort affiliation">';

                    }  

                    $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                    $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/thumbnails/150_'.$uploadImg['user_img']);

                }
                
                if($this->input->post('sport_image_pic')){

                    $randT      = rand(000,999).time();

                    $deletImg   = "deleteResortImage('".$randT."','".$uploadImg['user_img']."')"; 

                    $html       = '<div id="'.$randT.'" class="file-upload-content">';

                    if($fileType=='pdf'){

                        $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation"></iframe>';

                    }else{

                        $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$uploadImg['user_img'].'" alt="resort affiliation">';

                    }  

                    $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                    $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/thumbnails/150_'.$uploadImg['user_img']);

                }
                
                if($this->input->post('fac_image_pic')){

                    $randT      = rand(000,999).time();

                    $deletImg   = "deleteResortImage('".$randT."','".$uploadImg['user_img']."')"; 

                    $html       = '<div id="'.$randT.'" class="file-upload-content">';

                    if($fileType=='pdf'){

                        $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation"></iframe>';

                    }else{

                        $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$uploadImg['user_img'].'" alt="resort affiliation">';

                    }  

                    $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                    $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/thumbnails/150_'.$uploadImg['user_img']);

                }

                if($this->input->post('accommodation_photos_pic')){

                    $randT      = rand(000,999).time();

                    $deletImg   = "deleteAcommodationImage('".$randT."','".$uploadImg['user_img']."')"; 

                    $html       = '<div id="'.$randT.'" class="file-upload-content">';

                    if($fileType=='pdf'){

                        $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation"></iframe>';

                    }else{

                        $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$uploadImg['user_img'].'" alt="resort affiliation">';

                    } 

                    $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                    $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img']);

                }

                if($this->input->post('floor_plan_pic')){

                    $randT      = rand(000,999).time();

                    $deletImg   = "delete_accommodation_floor_plan('".$randT."','".$uploadImg['user_img']."')"; 

                    $html       = '<div id="'.$randT.'" class="file-upload-content">';

                    if($fileType=='pdf'){

                        $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="floor plan"></iframe>';

                    }else if($fileType=='doc'||$fileType=='docx'){

                        $html   .= '<a href="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" target="_blank"><img class="file-upload-image" src="'.base_url().'assets/front/img/document_icon.png" alt="floor plan"></a>';

                    }else{

                        $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="floor plan">';

                    } 

                    $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                    $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/'.$uploadImg['user_img']);

                }

            }

            if($this->input->post('meal_served_menu')){

                $randT      = rand(000,999).time();

                $deletImg   = "deleteMealServedMenu('".$randT."','".$uploadImg['user_img']."')"; 

                $html       = '<div id="'.$randT.'" class="file-upload-content">';

                if($fileType=='pdf'){

                    $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation"></iframe>';

                }else{

                    $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation">';

                } 

                $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img']);

            } 

            if($this->input->post('dinning_menu')){

                $randT      = rand(000,999).time();

                $deletImg   = "deleteDinningMenu('".$randT."','".$uploadImg['user_img']."')"; 

                $html       = '<div id="'.$randT.'" class="file-upload-content">';

                if($fileType=='pdf'){

                    $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation"></iframe>';

                }else{

                    $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$uploadImg['user_img'].'" alt="resort affiliation">';

                } 

                $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img']);

            }

            if($this->input->post('spa_menu_pic')){

                $randT      = rand(000,999).time();

                $deletImg   = "deleteSpaMenu('".$randT."','".$uploadImg['user_img']."')"; 

               $html       = '<div id="'.$randT.'" class="file-upload-content">';

               if($fileType=='pdf'){

                    $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation"></iframe>';

                }else{

                    $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation">';

                } 

                $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img']);

            }

            if($this->input->post('activities_image_pic')){

                $randT      = rand(000,999).time();

                $deletImg   = "deleteActivityMenu('".$randT."','".$uploadImg['user_img']."')"; 

                $html       = '<div id="'.$randT.'" class="file-upload-content">';

                if($fileType=='pdf'){

                    $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation"></iframe>';

                }else{

                    $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$uploadImg['user_img'].'" alt="resort affiliation">';

                } 

                $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img']);

            }            

            if($this->input->post('resort_story_pic')){

                $randT      = rand(000,999).time();

                $deletImg   = "deleteLogo('".$randT."','".$uploadImg['user_img']."')"; 

                $html       = '<div id="'.$randT.'" class="file-upload-content"><img class="file-upload-image" src="'.base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img'].'" alt="resort logo"><div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img']);

            } 

            if($this->input->post('traveller_story_image_pic')){

                $randT      = rand(000,999).time();

                $deletImg   = "deleteStoryImage('".$randT."','".$uploadImg['user_img']."')"; 

                $html       = '<div id="'.$randT.'" class="file-upload-content">';

                if($fileType=='pdf'){

                    $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/resorts/'.$uploadImg['user_img'].'" alt="resort affiliation"></iframe>';

                }else{

                    $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/resorts/thumbnails/150_'.$uploadImg['user_img'].'" alt="traveller story image">';

                }  

                $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/resorts/thumbnails/150_'.$uploadImg['user_img']);

            }

            if($this->input->post('blog_img')){

                $randT      = rand(000,999).time();

                $deletImg   = "deleteStoryImage('".$randT."','".$uploadImg['user_img']."')"; 

                $html       = '<div id="'.$randT.'" class="file-upload-content">';

                if($fileType=='pdf'){

                    $html   .= '<iframe class="file-upload-image" src="' .base_url() . 'uploads/blogs/'.$uploadImg['user_img'].'" alt="resort affiliation"></iframe>';

                }else{

                    $html   .= '<img class="file-upload-image" src="' .base_url() . 'uploads/blogs/thumbnails/150_'.$uploadImg['user_img'].'" alt="traveller story image">';

                }  

                $html       .= '<div class="image-title-wrap"><button type="button" onclick="'.$deletImg.'" class="remove-image">Remove</button></div></div>';

                $array      = array('statuss' => 'true', 'message' => 'Image is uploaded', 'file_name' => $uploadImg['user_img'], 'html' =>$html, 'imgFullPath'=>base_url().'uploads/blogs/thumbnails/150_'.$uploadImg['user_img']);

            }

        } else {

            $array = array('statuss' => 'false', 'message' => form_error('user_img'));

        }

        echo json_encode($array);

    } 

    public function test_images() { 

        $images = $this->developer_model->get_images();



        // echo $this->db->last_query().' last_query .........<br/>';

        ini_set('memory_limit', '-1');      

        if(!empty($images)){

            foreach($images as $image){

                if($this->input->get('create')){                    

                    $config_img_p['source_path']        = 'uploads/resorts/full_image/';

                    $config_img_p['destination_path']   = 'uploads/resorts/thumbnails/';

                    $config_img_p['width']              = '150';

                    $config_img_p['height']             = '150';

                    $config_img_p['file_name']          = $image->activities_image;

                    if(file_exists('uploads/resorts/full_image/1300_'.$image->activities_image)){

                        if(!file_exists('uploads/resorts/thumbnails/150_'.$image->activities_image)){

                            create_thumbnail_new($config_img_p, NULL, '150');

                            echo '<br/> thumb file = '.base_url().'uploads/resorts/thumbnails/150_'.$image->activities_image;

                        }

                    }

                }

                if($this->input->get('create_500')){                    

                    $config_img_p['source_path']        = 'uploads/resorts/full_image/';

                    $config_img_p['destination_path']   = 'uploads/resorts/thumbnails/';

                    $config_img_p['width']              = '500';

                    $config_img_p['height']             = '400';

                    $config_img_p['file_name']          = $image->activities_image;

                    if(file_exists('uploads/resorts/full_image/1300_'.$image->activities_image)){

                        if(!file_exists('uploads/resorts/thumbnails/500_'.$image->activities_image)){

                            create_thumbnail_new($config_img_p, NULL, '500');

                            echo '<br/> thumb file = '.base_url().'uploads/resorts/thumbnails/500_'.$image->activities_image;

                        }

                    }

                }

                if($this->input->get('create_1300')){                    

                    $config_img_p['source_path']        = 'uploads/resorts/';

                    $config_img_p['destination_path']   = 'uploads/resorts/full_image/';

                    $config_img_p['width']              = '1300';

                    $config_img_p['height']             = '1300';

                    $config_img_p['file_name']          = $image->activities_image;

                    if(file_exists('uploads/resorts/'.$image->activities_image)){

                        if(!file_exists('uploads/resorts/full_image/1300_'.$image->activities_image)){

                            create_thumbnail_new($config_img_p, NULL, '1300');

                        }

                    }

                }                

                if($this->input->get('delete')){   

                    if(file_exists('uploads/resorts/'.$image->activities_image)){

                        if(file_exists('uploads/resorts/full_image/1300_'.$image->activities_image)){

                           unlink('uploads/resorts/'.$image->activities_image);

                           echo '<br/>file data 1 '.base_url().'uploads/resorts/full_image/1300_'.$image->activities_image;

                        }

                    }

                }

            }

        }else{

            echo 'No Result ';

        }

    }

    public function uploadImg($str, $pdf_file='') {
        
        ini_set('memory_limit', '-1');

        //echo $pdf_file.' pdf_file.................<br/>'; exit();

        if(!empty($pdf_file)){            

            /*if (empty($_FILES['user_img']['name'])) {

                $this->form_validation->set_message('uploadImg', 'Choose file');

                return FALSE;

            }*/

            if(!empty($pdf_file)&&$pdf_file=='pdf_word'){

                $allowed = array("image/jpeg", "image/jpg", "image/png", "application/pdf", 'application/msword', 'application/vnd.ms-office','application/vnd.oasis.opendocument.text','application/vnd.openxmlformats-officedocument.wordprocessingml.document');

                if (!in_array($_FILES['user_img']['type'], $allowed)) {

                    $this->form_validation->set_message('uploadImg', 'Only jpg, jpeg, png, pdf and doc  files are allowed');

                    return FALSE;

                }

            }else if(!empty($pdf_file)&&$pdf_file=='only_pdf'){

                $allowed = array("application/pdf");

                if (!in_array($_FILES['user_img']['type'], $allowed)) {

                    $this->form_validation->set_message('uploadImg', 'Only pdf file is allowed');

                    return FALSE;

                }

            }else{

                $allowed = array("image/jpeg", "image/jpg", "image/png", "application/pdf");

                if (!in_array($_FILES['user_img']['type'], $allowed)) {

                    $this->form_validation->set_message('uploadImg', 'Only jpg, jpeg, png and pdf files are allowed');

                    return FALSE;

                }

            }            

            if (!empty($_FILES['user_img']['name'])):

                $config['encrypt_name']  = TRUE;

                $new_name                = 'image_'.substr(md5(rand()), 0, 7).$_FILES["user_img"]['name'];

                $config['file_name']     = $new_name;

                if(!empty($pdf_file)&&$pdf_file=='only_pdf'){

                    $config['allowed_types'] = 'pdf';

                }else{

                    $config['allowed_types'] = 'jpeg|jpg|png|pdf|docx|doc|DOC|DOCX';

                }

                if($this->input->post('blog_img')){

                    $config['upload_path']   = 'uploads/blogs/';

                }else{

                    $config['upload_path']   = 'uploads/resorts/';

                }

                $config['max_size']      = '11264';

                $this->load->library('upload', $config);

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('user_img')) {

                    $this->form_validation->set_message('uploadImg', $this->upload->display_errors());

                    return FALSE;

                } else {

                    $data                               = $this->upload->data(); 

                    // upload image                    

                    $this->session->set_userdata('uploadImg', array('user_img' => $data['file_name']));

                    return TRUE;

                } else:

                    $this->form_validation->set_message('uploadImg', 'The %s field required.');

                    return FALSE;

                endif;

        }else{

            $allowed = array("image/jpeg", "image/jpg", "image/png");

            $width   = 50; 

            $height  = 50;

            /*if (empty($_FILES['user_img']['name'])) {

                $this->form_validation->set_message('uploadImg', 'Choose file');

                return FALSE;

            }*/

            if (!in_array($_FILES['user_img']['type'], $allowed)) {

                $this->form_validation->set_message('uploadImg', 'Only jpg, jpeg, and png files are allowed');

                return FALSE;

            }

            $image = getimagesize($_FILES['user_img']['tmp_name']);
            
            if ($image[0] < $width || $image[1] < $height) {

                $this->form_validation->set_message('uploadImg', 'Oops! Your image needs to be atleast '.$width.' x '.$height.' pixels');

                return FALSE;

            }

            // if ($image[0] > 3000 || $image[1] > 3000) {

            //     $this->form_validation->set_message('uploadImg', 'Oops! Your image needs to be maximum of 3,000 x 3,000 pixels');

            //     return FALSE;

            // }
            if ($image[0] > 10000 || $image[1] > 10000) {

                $this->form_validation->set_message('uploadImg', 'Oops! Your image needs to be maximum of 10,000 x 10,000 pixels');

                return FALSE;

            }

            if (!empty($_FILES['user_img']['name'])):

                $config['encrypt_name']  = TRUE;

                $new_name                = 'image_'.substr(md5(rand()), 0, 7).$_FILES["user_img"]['name'];

                $config['file_name']     = $new_name;

                if($this->input->post('blog_img')){

                    $config['upload_path']   = 'uploads/blogs/';

                }else{

                    $config['upload_path']   = 'uploads/resorts/';

                }

                $config['allowed_types'] = 'jpeg|jpg|png';

                $config['max_size']      = '10000';

                $config['max_width']     = '10000';

                $config['max_height']    = '10000';

                $this->load->library('upload', $config);

                $this->upload->initialize($config);

                if (!$this->upload->do_upload('user_img')) {

                    $this->form_validation->set_message('uploadImg', $this->upload->display_errors());

                    return FALSE;

                } else {

                    $data = $this->upload->data(); // upload image

                    if($this->input->post('blog_img')){

                        $config_img_p['source_path']        = 'uploads/blogs/';

                        $config_img_p['destination_path']   = 'uploads/blogs/thumbnails/';

                    }else{

                        $config_img_p['source_path']        = 'uploads/resorts/';

                        $config_img_p['destination_path']   = 'uploads/resorts/thumbnails/';

                    }

                    if(!file_exists($config_img_p['destination_path'].'150_'.$data['file_name'])){

                        $config_img_p['width']              = '150';

                        $config_img_p['height']             = '150';

                        $config_img_p['file_name']          = $data['file_name'];

                        $status                             = create_thumbnail($config_img_p, NULL, '150');   

                    }                 

                    if(!file_exists($config_img_p['destination_path'].'500_'.$data['file_name'])){

                        $config_img_p['width']              = '500';

                        $config_img_p['height']             = '400';

                        $config_img_p['file_name']          = $data['file_name'];

                        $status   = create_thumbnail($config_img_p, NULL, '500');

                    }

                    $config_img_p['destination_path']   = $config_img_p['source_path'].'full_image/';

                    if(!file_exists($config_img_p['destination_path'].'1300_'.$data['file_name'])){

                        $config_img_p['width']              = '1300';

                        $config_img_p['height']             = '1300';

                        $config_img_p['file_name']          = $data['file_name'];

                        $status   = create_thumbnail($config_img_p, NULL, '1300');

                    }  

                    if(file_exists($config_img_p['destination_path'].'1300_'.$data['file_name'])){

                       unlink($config_img_p['source_path'].$data['file_name']);

                    }                  

                    $this->session->set_userdata('uploadImg', array('user_img' => $data['file_name']));

                    return TRUE;

                } else:

                    $this->form_validation->set_message('uploadImg', 'The %s field required.');

                    return FALSE;

                endif;

        }

    }

    public function deleteResortImage($imageID=''){

        $imgRow = $this->common_model->get_row('images', array('id'=> $imageID), array('image_name'));

        if(!empty($imgRow->image_name)){

            $this->common_model->delete('images', array('id'=> $imageID));

            if(!empty($imgRow->image_name)&&file_exists('uploads/resorts/'.$imgRow->image_name)){

                unlink('uploads/resorts/'.$imgRow->image_name);

            }   

            if(!empty($imgRow->image_name)&&file_exists('uploads/resorts/thumbnails/'.$imgRow->image_name)){

                unlink('uploads/resorts/thumbnails/'.$imgRow->image_name);

            }              

        }

    } 

    public function deleteLogo_img($productID=''){

        $this->common_model->update('products', array('profile_img'=>''), array('id'=>$productID));        

    } 

    public function delete_resort(){

        if($this->input->post('resort_id')){            

            $resortID = $this->input->post('resort_id');

            $this->common_model->delete('resorts', array('id'=>$resortID));   

            $array = array('statuss' => 'true', 'message' => 'Resort is deleted successfully');

            echo json_encode($array);

        }

    } 

    public function approve_traveller_story() {

        if($this->input->get('story_id')){

            $this->common_model->update('traveller_stories', array('verified_by'=>'Resort', 'verified_status'=>1), array('id'=>$this->input->get('story_id'))); 

			$this->common_model->update('guest_activities', array('verified_status'=>1), array('type'=>'traveller_story','activity_id'=>$this->input->get('story_id')));

            /********** activity Report *******************/

            $story_id      = $this->input->get('story_id');

            $row           = $this->common_model->get_row('mal_traveller_stories', array('id'=>$story_id));

            $notified_user = $row->user_id;            

            $inserted_data = array('user_id'=>user_id(), 'notified_user'=>$notified_user, 'type'=>'approve_traveller_story', 'activity_id'=>$story_id, 'created_date'=>date('Y-m-d H:i:s'));

            $this->common_model->insert('guest_activities', $inserted_data);

            /********** activity Report *******************/       

            $this->session->set_flashdata('msg_success', 'Traveller story is approved successfully');

            redirect($_SERVER['HTTP_REFERER']);

        }

    }

	// compare page

	public function compare_resorts(){

		$data['villa_type'] = $this->common_model->get_result('villa_type', array('status'=>1));     

		$data['holidays'] = $this->common_model->get_result('holidays', array('status'=>1));     

		$data['resorts']  = $this->common_model->get_result('resorts', array('status'=>1, 'admin_approved'=>1), array(), array('resort_name','asc')); 

		$data['villa_type_name'] = $this->developer_model->get_compare_villa($id_array = '', $in_data='');

		$data['caption']        = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/compare'));
		$data['banner_caption']        = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/compare#banner'));

		if(!empty($data['caption']->id)){

		$data['caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['caption']->id));

		}   
		

		if(!empty($data['banner_caption']->id)){

            $data['banner_caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['banner_caption']->id));

        }



		$data['template'] = 'frontend/compare_resorts';

		$this->load->view('templates/frontend_template', $data);

	}

	public function community(){

		$data['title']	  = 'Comunity';

		$data['template'] = 'frontend/community';

		$this->load->view('templates/frontend_template', $data);

	}

	public function transfers(){

		$data['title']	  = 'Transfers';

		$data['caption']        = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/transfers'));

		if(!empty($data['caption']->id)){

            $data['caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['caption']->id));

        } 

		$data['resorts_places']   = $this->developer_model->maldives_resorts_places();

		$data['travel_partner']   = $this->common_model->get_result('travel_partner', array('status'=>1));

		$data['international_airports']   = $this->common_model->get_result('maldives_airports', array('airport_type'=>1,'status'=>1));

		$data['domestic_airports']   = $this->common_model->get_result('maldives_airports', array('airport_type'=>2,'status'=>1));

		$data['airlines']   = $this->common_model->get_result('airlines_travling', array());

		$data['template'] = 'frontend/transfers';

		$this->load->view('templates/frontend_template', $data);

	}

	public function faq(){

		$data['title']	  = 'FAQ';

		

		$data['faqs']   = $this->common_model->get_result('faq', array('status'=>1));
        
		//echo "<pre>"; print_r($data['faqs']);die;

		$data['template'] = 'frontend/faq';

		$this->load->view('templates/frontend_template', $data);

	}

	public function galllery(){

		$data['title']	  = 'Galllery';

		$data['caption']        = $this->common_model->get_row('captions', array('status'=>1, 'page_url'=>'home/galllery'));

		

		if(!empty($data['caption']->id)){

            $data['caption_imgs']   = $this->common_model->get_result('images', array('status'=>1, 'type'=>'caption', 'type'=>'caption', 'item_id'=>$data['caption']->id));

        } 		

		$data['galllery_images']   = $this->developer_model->galllery_images(6,1);

		//echo "<pre>"; print_r($data['faqs']);die;

		$data['template'] = 'frontend/galllery';

		$this->load->view('templates/frontend_template', $data);

	}

	public function get_more_images(){

		$prev_record_count = $this->input->post('prev_record_count')?$this->input->post('prev_record_count')+1:6;

		$galllery_images   = $this->developer_model->galllery_images(6,$prev_record_count);

		$html='';

        if(!empty($galllery_images)) {
		    foreach($galllery_images as $gal){
                $html .='<div class="col-md-4 col-6 my-3  gallery_item">
                <div class="insta-feed-wrapper">
                <div class="img-container bg-success">'; 
                if(!empty($gal->image_name)&&file_exists('uploads/resorts/full_image/1300_'.$gal->image_name)){
                    $href= base_url("resort-detail?&resort_id=".base64_encode($gal->item_id));
                    $html .='<a href="'.$href.'">';
                    $html .='<img src="'.base_url().'uploads/resorts/full_image/1300_'.$gal->image_name.'" alt="" class="img-fluid HomeImage">';
                    $html .='</a>';

                }
                $html .=	'</div></div></div>';
            }
		}
		echo $html;
		exit;
	}

    //experinces_filterhtml

    public function experinces_filterhtml(){
        $resort_id=$this->input->get('resort_id');
        $data['resort'] = $this->developer_model->resort_detail($resort_id);
        $data['experience_categories'] = $this->common_model->get_result('experience_category', array('status'=> 1), array(), array('exp_cat_id', 'ASC'));
        // Experience
        $join1  = array(
            array('join_table'=>'mal_resorts AS resorts','join_on'=>'resorts.id = act.resort_id','join_type'=>'inner'),
            array('join_table'=>'mal_brand AS brand','join_on'=>'brand.id = resorts.brand_id','join_type'=>'inner'),
            array('join_table'=>'mal_states AS state','join_on'=>'state.id = resorts.physical_state','join_type'=>'inner')); 
        $where = array('resort_id'=>$data['resort']->id);
        $groupby = "act.id";
        $orderby = "act.id";
        $limit = 6;
        $expriences  = $this->common_model->getjoinwhere("act.*,resort_name,state_name,resort_category,resort_description,island_name,brand_name",'mal_activitie_excursions'." as act",$join1,$where,$groupby,$orderby,$limit); 
        if($this->input->get('category_id'))
        {
            $category_id=explode(',',$this->input->get('category_id'));
            $target=array();
            foreach ($expriences as $key => $value) 
            {
                $array = explode(',', $value->experience_category);
                if(count(array_intersect($category_id, $array)) > 0){
                  $target[]=$value; 
                }
            } 
        }else{
             $target=$expriences;
        }
        // echo '<pre>';
        // print_r($data);die();
        $data['activitys']      = $target;
        $this->load->view('frontend/experinces_filterhtml', $data);
    }
    public function setCoverImage(){
        $resort_id=$this->input->post('resort_id');
        $image_id=$this->input->post('image_id');
        
        $this->common_model->update('images', array('iscoverImage'=>0), array('id'=>$image_id,'type'=>'resort'));
        $this->common_model->update('images', array('iscoverImage'=>1), array('id'=>$image_id));
    } 
    
    
    
    
	public function villas_suites($offset=NULL){

        $data                   = $this->feachered_resort_filter_list($offset); 

		// accommodation		

		$join  = array(array('join_table'=>'mal_resorts AS resorts','join_on'=>	

			'resorts.id = acc.resort_id','join_type'=>'inner'),array('join_table'=>'mal_brand AS brand','join_on'=>	

			'brand.id = resorts.brand_id','join_type'=>'inner'),array('join_table'=>'mal_states AS state','join_on'=>	

			'state.id = resorts.physical_state','join_type'=>'inner')); 

		$where = array();

        $where = array('acc.is_featured'=>1);            

		$groupby = "acc.id";

		$orderby = "acc.priority_order";

        // $limit = site_info('accommodation_page_limit');

		$accommodations  = $this->common_model->getjoinwhere("acc.*,resort_category,resort_name,name_of_villa,state_name,resort_description,island_name,brand_name,max_occupancy,(SELECT GROUP_CONCAT(".DB_PRE."holidays.holiday_name SEPARATOR ', ') FROM ".DB_PRE."holidays 

		WHERE FIND_IN_SET(".DB_PRE."holidays.id, acc.ideal_for)) as ideal_for",'mal_accommodation'." as acc",$join,$where,$groupby,$orderby); 
// 		WHERE FIND_IN_SET(".DB_PRE."holidays.id, acc.ideal_for)) as ideal_for",'mal_accommodation'." as acc",$join,$where,$groupby,$orderby,$limit); 

		$data['accommodations'] = $accommodations;

		// accommodations


		$data['template'] = 'frontend/villas_suites';

		$this->load->view('templates/frontend_template', $data);

	}
    
    
	public function experiences($offset=NULL){

        $data                   = $this->feachered_resort_filter_list($offset); 

		

		$join1  = array(array('join_table'=>'mal_resorts AS resorts','join_on'=>	

			'resorts.id = act.resort_id','join_type'=>'inner'),array('join_table'=>'mal_brand AS brand','join_on'=>	

			'brand.id = resorts.brand_id','join_type'=>'inner'),array('join_table'=>'mal_states AS state','join_on'=>	

			'state.id = resorts.physical_state','join_type'=>'inner')); 

			

		$where = array();

		$groupby = "act.id";

		$orderby = "act.id";

// 		$limit = 6;

// 		$expriences  = $this->common_model->getjoinwhere("act.*,resort_name,state_name,resort_category,resort_description,island_name,brand_name",'mal_activitie_excursions'." as act",$join1,$where,$groupby,$orderby,$limit); 
		$expriences  = $this->common_model->getjoinwhere("act.*,resort_name,state_name,resort_category,resort_description,island_name,brand_name",'mal_activitie_excursions'." as act",$join1,$where,$groupby,$orderby); 
       
		$data['expriences'] = $expriences;

		$blogs_arr =  $this->blog_filter_list(0,"");

		$data['blogs']= $blogs_arr['blogs'];

        $data['resort_highlights'] = $this->common_model->get_result('resort_highlights', array('status'=>1), array(), array('id', 'asc'));
        $highlights = [];
        if(is_array($data['resort_highlights'])){
            foreach($data['resort_highlights'] as $resort_highlight) {
                if(!isset($highlights[$resort_highlight->resort_id])) {
                    $highlights[$resort_highlight->resort_id] = [];
                }
                array_push($highlights[$resort_highlight->resort_id],$resort_highlight->resort_highlights);
            }
        }
        $data['resort_highlights'] = $highlights;

		


		$data['template'] = 'frontend/expriences';

		$this->load->view('templates/frontend_template', $data);

	}
	
	public function faq_filter_more()
	{
        $limit = $this->input->post('limit');
        $offset = $this->input->post('offset');
        // echo $limit;
        // echo $offset;
        // die();
		$data['faqs'] = $this->common_model->get_faq_result($limit,$offset);
        //var_dump($this->db->last_query()); die;
        
        // var_dump($data['faqs']); die;
        $result=null;
        if(!empty(count($data['faqs'])>0)){
            foreach($data['faqs'] as $faq){
                $result .= '<div class="accordion-content">
							<div class="accordion_head">'.$faq->question.'
    							<span class="plusminus">
    							    <i class="fa fa-plus"></i>
    							</span>
    							<input type="hidden" name="offset" class="faq_offset" value="'.$offset.'"/>
							</div>
						<div class="accordion_body" style="display: none;">'.$faq->answer.'</div></div>';
            }
        }
        
        echo json_encode($result);
          
	}
    
}?>