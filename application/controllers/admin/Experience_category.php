<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Experience_category extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."Experience_category/index/";
        $counts                     = $this->developer_model->get_experience_category(0, 0);
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
        $data['rows']       = $this->developer_model->get_experience_category($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/experience_category/experience_category';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_experience_category($exp_cat_id =''){ 
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('exp_cat_name', 'experience category', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('exp_cat_name')) 
                    $insertData['exp_cat_name'] = $this->input->post('exp_cat_name'); 
                if(!empty($exp_cat_id)){
                    $this->common_model->update('experience_category', $insertData, array('exp_cat_id' => $exp_cat_id));
                    $this->session->set_flashdata('msg_success', 'experience category is updated successfully');
                    redirect(ADMIN_URL.'Experience_category');
                }else{
                    $this->common_model->insert('experience_category', $insertData);
                    $this->session->set_flashdata('msg_success', 'experience category is added successfully');
                    redirect(ADMIN_URL.'experience_category/add_experience_category');
                }
            }
        }
        $data['title'] = 'Add experience category';
        if (!empty($exp_cat_id)) {
            $data['title'] = 'Edit experience category';
            $data['row']   = $this->common_model->get_row('experience_category', array('exp_cat_id' => $exp_cat_id));
        }
        $data['template'] = 'superadmin/experience_category/add_experience_category';
        $this->load->view('templates/superadmin_template', $data);
    }
}
