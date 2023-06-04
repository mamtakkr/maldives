<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Food_types extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."food_types/index/";
        $counts                     = $this->developer_model->get_food_types(0, 0);
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
        $data['rows']       = $this->developer_model->get_food_types($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/food_types/food_types';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_food_type($id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('food_type', 'food type', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('food_type')) 
                    $insertData['food_type'] = $this->input->post('food_type'); 
                if(!empty($id)){
                    $this->common_model->update('food_types', $insertData, array('id' => $id));
                    $this->session->set_flashdata('msg_success', 'Food type is updated successfully');
                    redirect(ADMIN_URL.'food_types');
                }else{
                    $this->common_model->insert('food_types', $insertData);
                    $this->session->set_flashdata('msg_success', 'Food type is added successfully');
                    redirect(ADMIN_URL.'food_types/add_food_type');
                }
            }
        }
        $data['title'] = 'Add Food Type';
        if (!empty($id)) {
            $data['title'] = 'Edit Food Type';
            $data['row']   = $this->common_model->get_row('food_types', array('id' => $id));
        }
        $data['template'] = 'superadmin/food_types/add_food_type';
        $this->load->view('templates/superadmin_template', $data);
    }
}
