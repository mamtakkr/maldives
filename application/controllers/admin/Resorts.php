<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Resorts extends CI_Controller {
    public function __construct() {
        parent::__construct();
        clear_cache();
        if (!superadmin_logged_in()) {
            redirect(ADMIN_URL.'login');
        }
    }
    /*user list with filters*/
    public function index() {
        $data                           = array();
        $config                         = admin_pagination();
        $config['enable_query_strings'] = TRUE;
        if (!empty($_SERVER['QUERY_STRING'])) {
            $config['suffix'] = "?" . $_SERVER['QUERY_STRING'];
        } else {
            $config['suffix'] = '';
        }
        $config['base_url']         = ADMIN_URL."resorts/index/";
        $counts                     = $this->developer_model->getResorts(0, 0);
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
        $data['rows']       = $this->developer_model->getResorts($offSet, PER_PAGE);
        
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/resorts/resorts';
        // echo '<pre>';
        // print_r($data);
        // die();
    
        $this->load->view('templates/superadmin_template', $data);
    }
    public function villalist()
    {
     $data                           = array();
        $config                         = admin_pagination();
        $config['enable_query_strings'] = TRUE;
        if (!empty($_SERVER['QUERY_STRING'])) {
            $config['suffix'] = "?" . $_SERVER['QUERY_STRING'];
        } else {
            $config['suffix'] = '';
        }
        $config['base_url']         = ADMIN_URL."resorts/villalist/";
        $counts                     = $this->developer_model->get_villalist(0, 0);
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
        $data['rows']       = $this->developer_model->get_villalist($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/villalist/villalist';
        // echo '<pre>';
        // print_r($data);
        // die();
        $this->load->view('templates/superadmin_template', $data);   
    }
    public function changestatus_villa()
    {
        $villa_id=$this->input->post('villa_id');
        $is_featured=$this->input->post('is_featured');
        $upisfe=($is_featured==1)?0:1;
         // echo '<pre>';
         // print_r($villa_id);
         //    echo '<pre>';
         // print_r($is_featured);
         // die();
        $status=$this->db->where('id',$villa_id)->update('mal_accommodation',array('is_featured'=>$upisfe));
       if($status)
       {
        $this->session->set_flashdata('msg_success', 'status chnaged successfully');
        redirect(ADMIN_URL.'resorts/villalist');
          
       }else{
        $this->session->set_flashdata('msg_error', 'somthing is wrong');
       }

    }
    public function changevillaorder()
    {
        $villa_id=$this->input->post('villa_id');
        $priority_order=$this->input->post('priority_order');
        $status=$this->db->where('id',$villa_id)->update('mal_accommodation',array('priority_order'=>$priority_order));
       if($status)
       {
        $this->session->set_flashdata('msg_success', 'status chnaged successfully');
        redirect(ADMIN_URL.'resorts/villalist');
          
       }else{
        $this->session->set_flashdata('msg_error', 'somthing is wrong');
       }

    }
    
    
    public function approve_reort_story($story_id='') {
        if(!empty($story_id)){
            $storyInfo = $this->common_model->get_row('resort_stories', array('id' => $story_id));
            if($storyInfo->status == 4 || $storyInfo->status == 2) {
            //$this->common_model->update('traveller_stories', array('verified_by'=>'Admin', 'verified_status'=>1), array('id'=>$story_id));
            $this->common_model->update('resort_stories', array('status'=>1), array('id'=>$story_id));
             $this->session->set_flashdata('msg_success', 'Traveller story is approved successfully');
            }else{
             //$this->common_model->update('traveller_stories', array('verified_by'=>'Admin', 'verified_status'=>2), array('id'=>$story_id));
             $this->common_model->update('resort_stories', array('status'=>2), array('id'=>$story_id));
             $this->session->set_flashdata('msg_success', 'Traveller story is rejected successfully');
            }
          redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    
     public function approve_traveller_story($story_id='') {
        if(!empty($story_id)){
            $storyInfo = $this->common_model->get_row('traveller_stories', array('id' => $story_id));
            
            if($storyInfo->verified_status != 1) {
            $this->common_model->update('traveller_stories', array('verified_by'=>'Admin', 'verified_status'=>1), array('id'=>$story_id));
             $this->session->set_flashdata('msg_success', 'Traveller story is approved successfully');
            }else{
                $this->common_model->update('traveller_stories', array('verified_by'=>'Admin', 'verified_status'=>2), array('id'=>$story_id));
             $this->session->set_flashdata('msg_success', 'Traveller story is rejected successfully');
            }
            
            
           
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
    
    public function save_order() {
        if($this->input->post('order_id')&&$this->input->post('order')){
            
            $this->db->where('order_priority',$this->input->post('order'));
            $this->db->where_not_in('status', 3);
            $query = $this->db->get('resorts');
            if($query->num_rows()>0)
            {
                echo json_encode(['error' => 1]);
            }else{
                $this->common_model->update('resorts', array('order_priority'=>$this->input->post('order')),array('id'=>$this->input->post('order_id')));
                echo json_encode(['error' => 0]);
            }
        }
    }
    public function review_details_modal() {
        if($this->input->post('story_id')){
            $data['story'] = $this->developer_model->get_traveller_stories_details($this->input->post('story_id'));
            $data['images'] = $this->common_model->get_result('images', array('status'=>'1', 'item_id'=>$this->input->post('story_id'), 'type'=>'traveller_story'));
            //echo $this->db->last_query();
            $this->load->view('superadmin/resorts/review_details', $data);
        }
    }
    public function story_comment_status() {
        $data = array('comment_type'=>'', 'comment_message'=>'');
        if($this->input->get('comment_id')){
            if(!empty($this->input->get('comment_type'))&&$this->input->get('comment_type')=='active'){
                $comment_type = 1;
                $data = array('comment_type'=>'2', 'comment_message'=>'block');
            }else{
                $comment_type = 2;
                $data = array('comment_type'=>'1', 'comment_message'=>'active');
            }
            $this->common_model->update('traveller_stories_comments', array('status'=>$comment_type), array('id'=>$this->input->get('comment_id')));
        }
        echo json_encode($data);
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
        $pages['html'] = $this->load->view('superadmin/resorts/resort_comment_list', $data, TRUE);
        echo json_encode($pages);        
    } 
   
    public function traveller_story() {
        $data                           = array();
        $config                         = admin_pagination();
        $config['enable_query_strings'] = TRUE;
        if (!empty($_SERVER['QUERY_STRING'])) {
            $config['suffix'] = "?" . $_SERVER['QUERY_STRING'];
        } else {
            $config['suffix'] = '';
        }
        $config['base_url']         = ADMIN_URL."resorts/traveller_story/";
        $counts                     = $this->developer_model->get_admin_traveller_stories_list(0, 0);
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
        $data['rows']       = $this->developer_model->get_admin_traveller_stories_list($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/resorts/traveller_story';
        $this->load->view('templates/superadmin_template', $data);
    }
    
    
    
    public function resort_story() {
        $data                           = array();
        $config                         = admin_pagination();
        $config['enable_query_strings'] = TRUE;
        if (!empty($_SERVER['QUERY_STRING'])) {
            $config['suffix'] = "?" . $_SERVER['QUERY_STRING'];
        } else {
            $config['suffix'] = '';
        }
        $config['base_url']         = ADMIN_URL."resorts/resort_story/";
        $counts                     = $this->developer_model->get_admin_resort_stories_list(0, 0);
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
        $data['rows']       = $this->developer_model->get_admin_resort_stories_list($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/resorts/resort_story';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*public function add_resort_story() {
        $data['template']   = 'superadmin/resorts/add_resort_story';
        $this->load->view('templates/superadmin_template', $data);
    }*/
    public function add_resort_story($id =''){
        $this->form_validation->set_rules('user_id', 'user', 'trim|required');
        $this->form_validation->set_rules('resort_id', 'resort', 'trim|required');
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_rules('description', 'description', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            $insertData = array();
            if ($this->input->post('user_id')) 
                $insertData['user_id'] = $this->input->post('user_id');
            if ($this->input->post('resort_id')) 
                $insertData['resort_id'] = $this->input->post('resort_id'); 
            if ($this->input->post('title')) 
                $insertData['title'] = $this->input->post('title'); 
            if ($this->input->post('description')) 
                $insertData['description'] = $this->input->post('description');
            if(!empty($id)){
                $this->common_model->update('resort_stories', $insertData, array('id' => $id));
                $story_id = $id;
                if($this->input->post('resort_stories')){
                    $resort_stories = explode(',', $this->input->post('resort_stories'));
                    if(!empty($resort_stories)){
                        foreach($resort_stories as $blog_file){
                            $this->common_model->insert('images', array('type'=>'resort_story', 'item_id'=>$story_id,'image_name'=>$blog_file));
                        }
                    }
                }                
                $this->session->set_flashdata('msg_success', 'Resort story is updated successfully');
                redirect(ADMIN_URL.'resorts/resort_story');
            }else{
                $story_id = $this->common_model->insert('resort_stories', $insertData);
                if($this->input->post('resort_stories')){
                    $resort_stories = explode(',', $this->input->post('resort_stories'));
                    if(!empty($resort_stories)){
                        foreach($resort_stories as $blog_file){
                            $this->common_model->insert('images', array('type'=>'resort_story', 'item_id'=>$story_id,'image_name'=>$blog_file));
                        }
                    }
                }  
                $this->session->set_flashdata('msg_success', 'Resort story is added successfully');
                redirect(ADMIN_URL.'resorts/add_resort_story');
            }
        }
        $data['title'] = 'Add Resort story';
        if (!empty($id)) {
            $data['title']  = 'Edit Resort story';
            $data['row']    = $this->common_model->get_row('resort_stories', array('id' => $id));
            $data['images'] = $this->common_model->get_result('images', array('type'=>'resort_story', 'item_id'=>$id));
        }
        $data['users']    = $this->common_model->get_result('users', array('status' => 1, 'user_type'=>2));
        $data['resorts']  = $this->common_model->get_result('resorts', array('status' => 1));
        $data['template'] = 'superadmin/resorts/add_resort_story';
        $this->load->view('templates/superadmin_template', $data);
    }
    public function resort_story_details() {
        if($this->input->post('story_id')){
            $data['story'] = $this->developer_model->get_resort_stories_details($this->input->post('story_id'));
            //echo $this->db->last_query();
            $this->load->view('superadmin/resorts/resort_story_details', $data);
        }
    }
    public function loadResortStoryMoreComment() { 
        $data = array();
        if($this->input->get('current_page')&&$this->input->get('total_comments')){
            $offset                  = $this->input->get('current_page');
            $data['total_comments']  = $this->input->get('total_comments');
            $data['comments']        = $this->developer_model->getResortStoryComments($this->input->get('story_id'), $offset, PER_PAGE_COMMENTS, 1);
            $data['story_id']   = $this->input->get('story_id');
        }
        $pages['current_page']  = !empty($offset)?$offset+PER_PAGE_COMMENTS:1;
        if(!empty($data['total_comments'])&&$data['total_comments']<=$pages['current_page']){
            $pages['more_comment'] = 'hide';
        }else{          
            $pages['more_comment'] = 'show';
        }  
        $data['type'] = '1';  
        $pages['html'] = $this->load->view('superadmin/resorts/resort_comment_list', $data, TRUE);
        echo json_encode($pages);        
    }
    public function resort_story_comment_status() {
        $data = array('comment_type'=>'', 'comment_message'=>'');
        if($this->input->get('comment_id')){
            if(!empty($this->input->get('comment_type'))&&$this->input->get('comment_type')=='active'){
                $comment_type = 1;
                $data = array('comment_type'=>'2', 'comment_message'=>'block');
            }else{
                $comment_type = 2;
                $data = array('comment_type'=>'1', 'comment_message'=>'active');
            }
            $this->common_model->update('resort_story_comments', array('status'=>$comment_type), array('id'=>$this->input->get('comment_id')));
        }
        echo json_encode($data);
    }    
}
