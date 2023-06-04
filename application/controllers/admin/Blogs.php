<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Blogs extends CI_Controller {
    public function __construct() {
        parent::__construct();
        clear_cache();
        if (!superadmin_logged_in()) {
            redirect(ADMIN_URL.'login');
        }
    }
    /*user list with filters*/
    function index() {
        $data = array();
        $config = admin_pagination();
        $config['enable_query_strings'] = TRUE;
        if (!empty($_SERVER['QUERY_STRING'])) {
            $config['suffix'] = "?" . $_SERVER['QUERY_STRING'];
        } else {
            $config['suffix'] = '';
        }
        $config['base_url']         = ADMIN_URL."blogs/index/";
        $counts                     = $this->developer_model->get_blogs(0, 0);
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
        $data['rows']       = $this->developer_model->get_blogs($offSet, PER_PAGE);
        // var_dump($data['rows']); die;
        $data['offset']     = $offSet;
        $data['users']      = $this->common_model->get_result('admin_users', array('status' => 1,'user_role' => 3));
        $data['template']   = 'superadmin/blogs/blogs';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_blog($id =''){
        // echo '<pre>';
        // print_r($_POST);
        // die();
        // $this->form_validation->set_rules('page_banner_title', 'banner title', 'trim|required');
        $this->form_validation->set_rules('news_title', 'news title', 'trim|required');
        $this->form_validation->set_rules('news_description', 'news description', 'trim|required');
        $this->form_validation->set_rules('news_added_user', 'user', 'trim|required');
        $this->form_validation->set_rules('blog_category', 'blog category', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            
            $insertData = array();
            if ($this->input->post('news_title')) 
                $insertData['news_title'] = $this->input->post('news_title');
            if ($this->input->post('news_description')) 
                $insertData['news_description'] = $this->input->post('news_description'); 
            if ($this->input->post('blog_category')) 
                $insertData['blog_category'] = $this->input->post('blog_category'); 
            if ($this->input->post('news_added_user')) 
                $user_id = $this->input->post('news_added_user');
                $userData = $this->common_model->get_row('admin_users', array('id'=>$user_id));
                
                if($userData->user_role == 1){
                    $insertData['role'] = 'admin';
                }elseif($userData->user_role == 3){
                    $insertData['role'] = 'Subadmin';
                }
            
                $insertData['news_added_user'] = $this->input->post('news_added_user');
            if ($this->input->post('tags')) 
                $insertData['tags'] = $this->input->post('tags');
             if ($this->input->post('page_banner_title')) 
                $insertData['page_banner_title'] = $this->input->post('page_banner_title');
            if(isset($_FILES['page_banner_image'])){
                if (!file_exists('assets/front/blogimage')) {
                    mkdir('assets/front/blogimage', 0777, true);
                }
                $file_name ='assets/front/blogimage/banner-'.date('d_m_Y_H_i_s').'.jpg';
                $file_tmp = $_FILES['page_banner_image']['tmp_name'];
                $moved=move_uploaded_file($file_tmp,$file_name);
                if($moved)
                {
                   $insertData['page_banner_image'] = $file_name;  
                }
            }

            if(!empty($id)){
                $this->common_model->update('news_blog', $insertData, array('id' => $id));
                $blog_id = $id;
     
                if($this->input->post('blog_files')){
                    $blog_files = explode(',', $this->input->post('blog_files'));
                    if(!empty($blog_files)){
                        foreach($blog_files as $blog_file){
                            $this->common_model->insert('images', array('type'=>'blog', 'item_id'=>$id,'image_name'=>$blog_file));
                        }
                    }
                }                
                $this->session->set_flashdata('msg_success', 'Blog is updated successfully');
                redirect(ADMIN_URL.'blogs');
            }else{
                $blog_id = $this->common_model->insert('news_blog', $insertData);
                $id = $this->db->insert_id();
                if($this->input->post('blog_files')){
                    $blog_files = explode(',', $this->input->post('blog_files'));
                    if(!empty($blog_files)){
                        foreach($blog_files as $blog_file){
                            $this->common_model->insert('images', array('type'=>'blog', 'item_id'=>$id,'image_name'=>$blog_file));
                        }
                    }
                }  
                $this->session->set_flashdata('msg_success', 'Blog is added successfully');
                redirect(ADMIN_URL.'blogs/add_blog');
            }
        }
        $data['title'] = 'Add Blog';
        if (!empty($id)) {
            $data['title']  = 'Edit Blog';
            $data['row']    = $this->common_model->get_row('news_blog', array('id' => $id));
            $data['images'] = $this->common_model->get_result('images', array('type'=>'blog', 'item_id'=>$id));
        }
        
        $data['users']    = $this->common_model->get_result('admin_users', array('status' => 1,'user_role' => 3));
        
        $data['template'] = 'superadmin/blogs/add_blog';
        $this->load->view('templates/superadmin_template', $data);
    }
    public function uploadFile($str){
        $allowed = array("image/jpeg", "image/jpg", "image/png");       
        if(empty($_FILES['user_img']['name'])){
            $this->form_validation->set_message('uploadFile', 'Choose logo');
            return FALSE;
         }
        if(!in_array($_FILES['user_img']['type'], $allowed)) {        
            $this->form_validation->set_message('uploadFile', 'Only jpg, jpeg, and png files are allowed');
            return FALSE;
        }
        $image = getimagesize($_FILES['user_img']['tmp_name']);
        if ($image[0] < 30 || $image[1] < 30) {
            $this->form_validation->set_message('uploadFile', 'Oops! Your logo needs to be atleast 30 x 30 pixels');
            return FALSE;
        }
        if ($image[0] > 2000 || $image[1] > 2000) {
            $this->form_validation->set_message('uploadFile', 'Oops! Your logo needs to be maximum of 2000 x 2000 pixels');
            return FALSE;
        }
        if(!empty($_FILES['user_img']['name'])):
            $config['encrypt_name']  = TRUE;
            $new_name                = 'image_'.substr(md5(rand()),0,7).$_FILES["user_img"]['name'];
            $config['file_name']     = $new_name;
            $config['upload_path']   = 'uploads/blogs/';
            $config['allowed_types'] = 'jpeg|jpg|png';
            $config['max_size']      = '5024';
            $config['max_width']     = '2000';
            $config['max_height']    = '2000';
            $this->load->library('upload', $config);
        if ( ! $this->upload->do_upload('user_img')){
            $this->form_validation->set_message('uploadFile', $this->upload->display_errors());
            return FALSE;
        }
        else{
            $data = $this->upload->data(); // upload image
            $config_img_p['source_path']        = 'uploads/blogs/';
            $config_img_p['destination_path']   = 'uploads/blogs/thumbnails/';
            $config_img_p['width']              = '100';
            $config_img_p['height']             = '100';
            $config_img_p['file_name']          = $data['file_name'];
            $status=create_thumbnail($config_img_p);
            $this->session->set_userdata('uploadFile', $data['file_name']);
            return TRUE;
        }else:
            $this->form_validation->set_message('uploadFile', 'The %s field required.');
            return FALSE;
        endif;
    }
    public function blog_details() {
        if($this->input->post('blog_id')){
            $data['blog'] = $this->developer_model->get_blog_details($this->input->post('blog_id'));
            $data['images'] = $this->common_model->get_result('images', array('status'=>'1', 'item_id'=>$this->input->post('blog_id'), 'type'=>'blog'));
            $this->load->view('superadmin/blogs/blog_details', $data);
        }
    }
    public function loadBlogMoreComment() { 
        $data = array();
        if($this->input->get('current_page')&&$this->input->get('total_comments')){
            $offset                  = $this->input->get('current_page');
            $data['total_comments']  = $this->input->get('total_comments');
            $data['comments']        = $this->developer_model->getBlogComments($this->input->get('blog_id'), $offset, PER_PAGE_COMMENTS, 1);
            $data['blog_id']   = $this->input->get('blog_id');
        }
        $pages['current_page']  = !empty($offset)?$offset+PER_PAGE_COMMENTS:1;
        if(!empty($data['total_comments'])&&$data['total_comments']<=$pages['current_page']){
            $pages['more_comment'] = 'hide';
        }else{          
            $pages['more_comment'] = 'show';
        }  
        $pages['html'] = $this->load->view('superadmin/blogs/blog_comment_list', $data, TRUE);
        echo json_encode($pages);        
    }
    public function blog_comment_status() {
        $data = array('comment_type'=>'', 'comment_message'=>'');
        if($this->input->get('comment_id')){
            if(!empty($this->input->get('comment_type'))&&$this->input->get('comment_type')=='active'){
                $comment_type = 1;
                $data = array('comment_type'=>'2', 'comment_message'=>'block');
            }else{
                $comment_type = 2;
                $data = array('comment_type'=>'1', 'comment_message'=>'active');
            }
            $this->common_model->update('blog_comments', array('status'=>$comment_type), array('id'=>$this->input->get('comment_id')));
        }
        echo json_encode($data);
    } 
        public function blogdetails() {
        $data = array();
        $config = admin_pagination();
        $config['enable_query_strings'] = TRUE;
        if (!empty($_SERVER['QUERY_STRING'])) {
            $config['suffix'] = "?" . $_SERVER['QUERY_STRING'];
        } else {
            $config['suffix'] = '';
        }
        $config['base_url']         = ADMIN_URL."blogs/index/";
        $counts                     = $this->developer_model->get_blogs(0, 0);
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
        $data['rows']       = $this->developer_model->getblogdetails($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/blogs/blogdetails';

        $this->load->view('templates/superadmin_template', $data);
    }
    public function add_blogdetails($id =''){
        $this->form_validation->set_rules('banner_title', 'banner title', 'trim|required');
        $this->form_validation->set_rules('details_html', 'details html', 'trim|required');
        $this->form_validation->set_rules('news_blog_id', 'select blog', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            $insertData = array();
            if ($this->input->post('banner_title')) 
                $insertData['banner_title'] = $this->input->post('banner_title');
            if ($this->input->post('details_html')) 
                $insertData['details_html'] = $this->input->post('details_html'); 
            if ($this->input->post('news_blog_id')) 
                $insertData['news_blog_id'] = $this->input->post('news_blog_id');
            if(isset($_FILES['banner_image'])){
                if (!file_exists('assets/front/blogimage')) {
                    mkdir('assets/front/blogimage', 0777, true);
                }
                $file_name ='assets/front/blogimage/banner-'.date('d_m_Y_H_i_s').'.jpg';
                $file_tmp = $_FILES['banner_image']['tmp_name'];
                $moved=move_uploaded_file($file_tmp,$file_name);
                if($moved)
                {
                   $insertData['banner_image'] = $file_name;  
                }
            }
            if(!empty($id)){
                if($_FILES['banner_image']['name'] !==""){
                    if (!file_exists('assets/front/blogimage')) {
                        mkdir('assets/front/blogimage', 0777, true);
                    }
                    $file_name ='assets/front/blogimage/banner-'.date('d_m_Y_H_i_s').'.jpg';
                    $file_tmp = $_FILES['banner_image']['tmp_name'];
                    $moved=move_uploaded_file($file_tmp,$file_name);
                    if($moved)
                    {
                       $insertData['banner_image'] = $file_name;  
                    }
                }
                $this->common_model->update('news_blog_details', $insertData, array('newsblogdetails_id' => $id));
                $blog_id = $id;
                               
                $this->session->set_flashdata('msg_success', 'Blog details is updated successfully');
                redirect(ADMIN_URL.'blogs/blogdetails');
            }else{
                $this->common_model->insert('news_blog_details', $insertData);
                $this->session->set_flashdata('msg_success', 'Blog is added successfully');
                redirect(ADMIN_URL.'blogs/blogdetails');
            }
        }
        $data['title'] = 'Blog Details';
        if (!empty($id)) {
            $data['title']  = 'Edit Blog Details';
            $data['row']    = $this->common_model->get_row('news_blog_details', array('newsblogdetails_id' => $id));
        }
       
        $data['blogs_list']    = $this->common_model->get_result('news_blog', array('status' => 1));
        // $data['users']    = $this->common_model->get_result('users', array('status' => 1));
       
        $data['template'] = 'superadmin/blogs/add_blog_details';
        $this->load->view('templates/superadmin_template', $data);

    }
}
