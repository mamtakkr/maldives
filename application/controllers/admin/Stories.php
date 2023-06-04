<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Stories extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."stories/index/";
        $counts                     = $this->developer_model->getResortStories(0, 0);
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
        $data['rows']       = $this->developer_model->getResortStories($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/stories/resort_stories';
        $this->load->view('templates/superadmin_template', $data);
    }
    public function traveller_stories() {
        $data = array();
        $config = admin_pagination();
        $config['enable_query_strings'] = TRUE;
        if (!empty($_SERVER['QUERY_STRING'])) {
            $config['suffix'] = "?" . $_SERVER['QUERY_STRING'];
        } else {
            $config['suffix'] = '';
        }
        $config['base_url']         = ADMIN_URL."stories/traveller_stories/";
        $counts                     = $this->developer_model->getTravellerStories(0, 0);
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
        $data['rows']       = $this->developer_model->getTravellerStories($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/stories/traveller_stories';
        $this->load->view('templates/superadmin_template', $data);
    }
    public function verifyStory() {
        if($this->input->get('verified_by')&&$this->input->get('story_id')){
            $this->common_model->update('traveller_stories', 
                    array('verified_by'=>$this->input->get('verified_by'), 'verified_status'=>1),
                    array('id'=>$this->input->get('story_id'))
                );
        }
    }
    public function viewStory() {
        if($this->input->get('story_id')){
            $data['story'] = $this->developer_model->get_traveller_stories_details($this->input->get('story_id'));
            $data['images'] = $this->common_model->get_result('images', array('status'=>'1', 'item_id'=>$this->input->get('story_id'), 'type'=>'traveller_story')); 
            $this->load->view('superadmin/stories/view_traveller_story', $data);
        }
    }    
}
