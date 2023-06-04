<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*this controller for making manage cms in superadmin */
class Cms extends CI_Controller {
    public function __construct(){
        parent::__construct();  
        clear_cache();  
        $this->load->model('common_model');  
        if(!superadmin_logged_in()){
            redirect(ADMIN_URL.'login');
        }
    }
    public function index($id=''){        
        if(!empty($id)){
            $data['rows']   = $this->common_model->get_result('web_info', array('status'=>1, 'category_id'=>$id), array(), array('id','ASC'));
            $error = array();
            if(isset($_POST['submit'])){  
                ini_set('memory_limit', '-1');
                if(!empty($data['rows'])){
                    foreach($data['rows'] as $row){
                       if($this->input->post($row->meta_key)){
                            $update = $this->common_model->update('web_info', array('meta_data'=>$this->input->post($row->meta_key)), array('meta_key'=>$row->meta_key));
                            $this->session->set_flashdata('msg_success', 'Data is updated successfull');
                        } 
                        if(!empty($_FILES[$row->meta_key]['name'])){
                            $allowed = array("image/jpeg", "image/jpg", "image/png", "video/mp4");
                            $allowedImg = array("image/jpeg", "image/jpg", "image/png");
                            if(!in_array($_FILES[$row->meta_key]['type'], $allowed)) {    
                                $error[] = $row->title.' : only jpg, jpeg, png and mp4 files are allowed';
                            }
                            if(in_array($_FILES[$row->meta_key]['type'], $allowedImg)) { 
                                $image = getimagesize($_FILES[$row->meta_key]['tmp_name']);
                                if ($image[0] < 150 || $image[1] < 150) {
                                    $error[] = $row->title.' : needs to be atleast 150 x 150 pixels';
                                }
                                if ($image[0] > 3000 || $image[1] > 3000) {
                                    $error[] = $row->title.' : needs to be maximum of 6000 x 6000 pixels';
                                }
                            }
                            if(!empty($_FILES[$row->meta_key]['name'])):
                                $config['encrypt_name']  = TRUE;
                                $new_name                = 'image_'.substr(md5(rand()),0,7).$_FILES[$row->meta_key]['name'];
                                $config['file_name']     = $new_name;
                                $config['upload_path']   = 'uploads/cms/';
                                $config['allowed_types'] = 'jpeg|jpg|png|mp4|gif';
                                if(in_array($_FILES[$row->meta_key]['type'], $allowedImg)) {
                                    $config['max_width']     = '6000';
                                    $config['max_height']    = '6000';
                                }
                                $config['max_size']      = '11264';
                                $this->load->library('upload', $config);
                            if ( ! $this->upload->do_upload($row->meta_key)){
                                $error[] = $row->title.' : '.$this->upload->display_errors();
                            }else{
                                $data = $this->upload->data(); // upload image   
                                if(in_array($_FILES[$row->meta_key]['type'], $allowedImg)) {
                                    $config_img_p['source_path']        = 'uploads/cms/';
                                    $config_img_p['destination_path']   = 'uploads/cms/thumbnails/';
                                    /*$config_img_p['width']              = '100';
                                    $config_img_p['height']             = '100';
                                    $config_img_p['file_name']          = $data['file_name'];
                                    $status = create_thumbnail($config_img_p);*/
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
                                }
                                if(!empty($error)){
                                    $this->session->set_flashdata('msg_error', implode(', ', $error));
                                }else{ 
                                    $this->common_model->update('web_info', array('meta_data'=>$data['file_name']), array('meta_key'=>$row->meta_key));
                                    $this->session->set_flashdata('msg_success', 'Data is updateds successfull');
                                }
                            }
                            endif;
                        }
                    }
                    redirect($_SERVER['HTTP_REFERER']);
                }                
            }
            $data['title']      =  'Update Setting';    
            $data['template']   = 'superadmin/cms/edit_containt';
            $this->load->view('templates/superadmin_template', $data);
        } else{
            redirect(ADMIN_URL.'superadmin/error_404');
        }       
    }  
    /*user list with filters*/
    public function caption() {
        $data = array();
        $config = admin_pagination();
        $config['enable_query_strings'] = TRUE;
        if (!empty($_SERVER['QUERY_STRING'])) {
            $config['suffix'] = "?" . $_SERVER['QUERY_STRING'];
        } else {
            $config['suffix'] = '';
        }
        $config['base_url']         = ADMIN_URL."cms/caption/";
        $counts                     = $this->developer_model->get_caption(0, 0);
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
        $data['rows']       = $this->developer_model->get_caption($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['users']      = $this->common_model->get_result('users', array('status' => 1));
        $data['template']   = 'superadmin/cms/caption_list';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_caption($id =''){
        $this->form_validation->set_rules('page_url', 'page', 'trim|required');
        $this->form_validation->set_rules('caption_title', 'caption title', 'trim|required');
        $this->form_validation->set_rules('caption_sub_title', 'caption sub title', 'trim');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            $insertData = array();
            if($this->input->post('page_url')) 
                $insertData['page_url'] = $this->input->post('page_url'); 
            if($this->input->post('caption_title')) 
                $insertData['caption_title'] = $this->input->post('caption_title');
            if($this->input->post('caption_sub_title')){
                $insertData['caption_sub_title'] = $this->input->post('caption_sub_title'); 
            }else{
                $insertData['caption_sub_title'] = '';
            }
            if($this->input->post('news_added_user')) 
                $insertData['news_added_user'] = $this->input->post('news_added_user');
            if($this->input->post('tags')) 
                $insertData['tags'] = $this->input->post('tags');
            if(!empty($id)){
                $this->common_model->update('captions', $insertData, array('id' => $id));
                $caption_id = $id;
                if($this->input->post('caption_files')){
                    $caption_files = explode(',', $this->input->post('caption_files'));
                    if(!empty($caption_files)){
                        foreach($caption_files as $caption_file){
                            $this->common_model->insert('images', array('type'=>'caption', 'item_id'=>$id,'image_name'=>$caption_file));
                        }
                    }
                }                
                $this->session->set_flashdata('msg_success', 'Caption is updated successfully');
                redirect(ADMIN_URL.'cms/caption');
            }else{
                $caption_id = $this->common_model->insert('captions', $insertData);
                if($this->input->post('caption_files')){
                    $caption_files = explode(',', $this->input->post('caption_files'));
                    if(!empty($caption_files)){
                        foreach($caption_files as $caption_file){
                            $this->common_model->insert('images', array('type'=>'caption', 'item_id'=>$caption_id,'image_name'=>$caption_file));
                        }
                    }
                }  
                $this->session->set_flashdata('msg_success', 'Caption is added successfully');
                redirect(ADMIN_URL.'cms/add_caption');
            }
        }
        $data['title'] = 'Add Caption';
        if (!empty($id)) {
            $data['title']  = 'Edit Caption';
            $data['row']    = $this->common_model->get_row('captions', array('id' => $id));
            $data['images'] = $this->common_model->get_result('images', array('type'=>'caption', 'item_id'=>$id));
        }
        $data['template'] = 'superadmin/cms/add_caption';
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
    public function middile_image_check($str){
        $allowed = array("image/jpeg", "image/jpg", "image/png"); 
        $images  = explode('.', $_FILES["user_img"]['name']);
        $ext     = end($images); 
        $imageVideo = 'content image ';  
        if($ext=='mp4'){
            $imageVideo = 'content video ';
        }
        if(empty($_FILES['user_img']['name'])){
            $this->form_validation->set_message('middile_image_check', 'The '.$imageVideo.'  is required');
            return FALSE;
        }
        if(!in_array($_FILES['user_img']['type'], $allowed)) {
            $this->form_validation->set_message('middile_image_check', 'Only jpg, jpeg and png files are allowed');
            return FALSE;
        }
        if($ext!='mp4'){
            $image = getimagesize($_FILES['user_img']['tmp_name']);
            if ($image[0] < 1000 || $image[1] < 360) {
                $this->form_validation->set_message('middile_image_check', 'Oops! Your logo needs to be atleast 1000 x 360 pixels');
                return FALSE;
            }
            if ($image[0] > 2000 || $image[1] > 2000) {
                $this->form_validation->set_message('middile_image_check', 'Oops! Your logo needs to be maximum of 2000 x 2000 pixels');
                return FALSE;
            }
        }
        if(!empty($_FILES['user_img']['name'])):
            $config['encrypt_name']     = TRUE;
            $max_size                   = 1024*20;
            $new_name                   = 'image_'.substr(md5(rand()),0,7).$_FILES["user_img"]['name'];
            $config['file_name']        = $new_name;
            $config['upload_path']      = 'assets/uploads/middle/';
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
                $config_img_p['source_path'] = 'assets/uploads/middle/';
                $config_img_p['destination_path'] = 'assets/uploads/middle/thumbnails/';
                $config_img_p['width']      = '360';
                $config_img_p['height']     = '360';
                $config_img_p['file_name']  = $data['file_name'];
                $status=create_thumbnail($config_img_p);                
                $update = $this->common_model->update('web_info', array('meta_data'=>$data['file_name']), array('meta_key'=>'moddile_banner'));                
                $this->session->set_flashdata('msg_success', 'Content is updated successfull');
                return TRUE;
            } 
        else:
            $this->form_validation->set_message('blog_image_check', 'The %s field required.');
            return FALSE;
            endif;
    }   
    public function blog_image_check($str){
        $allowed = array("image/jpeg", "image/jpg", "image/png"); 
        $images  = explode('.', $_FILES["user_img"]['name']);
        $ext     = end($images); 
        $imageVideo = 'content image ';  
        if($ext=='mp4'){
            $imageVideo = 'content video ';
        }
        if(empty($_FILES['user_img']['name'])){
            $this->form_validation->set_message('blog_image_check', 'The '.$imageVideo.'  is required');
            return FALSE;
        }
        if(!in_array($_FILES['user_img']['type'], $allowed)) {
            $this->form_validation->set_message('blog_image_check', 'Only jpg, jpeg and png files are allowed');
            return FALSE;
        }
        if($ext!='mp4'){
            $image = getimagesize($_FILES['user_img']['tmp_name']);
            if ($image[0] < 1000 || $image[1] < 360) {
                $this->form_validation->set_message('blog_image_check', 'Oops! Your logo needs to be atleast 1000 x 360 pixels');
                return FALSE;
            }
            if ($image[0] > 2000 || $image[1] > 2000) {
                $this->form_validation->set_message('blog_image_check', 'Oops! Your logo needs to be maximum of 2000 x 2000 pixels');
                return FALSE;
            }
        }
        if(!empty($_FILES['user_img']['name'])):
            $config['encrypt_name']     = TRUE;
            $max_size                   = 1024*20;
            $new_name                   = 'image_'.substr(md5(rand()),0,7).$_FILES["user_img"]['name'];
            $config['file_name']        = $new_name;
            $config['upload_path']      = 'assets/uploads/slider/';
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
                $config_img_p['source_path'] = 'assets/uploads/slider/';
                $config_img_p['destination_path'] = 'assets/uploads/slider/thumbnails/';
                $config_img_p['width']      = '360';
                $config_img_p['height']     = '360';
                $config_img_p['file_name']  = $data['file_name'];
                $status=create_thumbnail($config_img_p);                
                $update = $this->common_model->update('web_info', array('meta_data'=>$data['file_name']), array('meta_key'=>'home_banner'));                
                $this->session->set_flashdata('msg_success', 'Content is updated successfull');
                return TRUE;
            } 
        else:
            $this->form_validation->set_message('blog_image_check', 'The %s field required.');
            return FALSE;
            endif;
    } 
    public function cms_single() {
        $data = array();
        $config = admin_pagination();
        $config['enable_query_strings'] = TRUE;
        if (!empty($_SERVER['QUERY_STRING'])) {
            $config['suffix'] = "?" . $_SERVER['QUERY_STRING'];
        } else {
            $config['suffix'] = '';
        }
        $config['base_url']         = ADMIN_URL."cms/cms_single/";
        $counts                     = $this->developer_model->get_cms_single(0, 0);
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
        $data['rows']       = $this->developer_model->get_cms_single($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/cms/cms_single_list';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_cms_single($id =''){
        $this->form_validation->set_rules('title', 'title', 'trim|required');
        $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
        if ($this->form_validation->run() == TRUE) {
            $insertData = array();
            if($this->input->post('title')) 
                $insertData['hear_by'] = $this->input->post('title');             
            if(!empty($id)){
                $this->common_model->update('hear_by', $insertData, array('id' => $id));
                $caption_id = $id;            
                $this->session->set_flashdata('msg_success', 'Hear by is updated successfully');
                redirect(ADMIN_URL.'cms/cms_single');
            }else{
                $caption_id = $this->common_model->insert('hear_by', $insertData);
                $this->session->set_flashdata('msg_success', 'Hear by is added successfully');
                redirect(ADMIN_URL.'cms/add_cms_single');
            }
        }
        $data['title'] = 'Add Hear by';
        if (!empty($id)) {
            $data['title']  = 'Edit Hear by';
            $data['row']    = $this->common_model->get_row('hear_by', array('id' => $id));
        }
        $data['template'] = 'superadmin/cms/add_cms_single';
        $this->load->view('templates/superadmin_template', $data);
    } 
}