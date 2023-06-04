<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Meal_served extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."meal_served/index/";
        $counts                     = $this->developer_model->get_meal_served_admin(0, 0);
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
        $data['rows']       = $this->developer_model->get_meal_served_admin($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/meal_served/meal_served';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_meal_served($id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('meal_served_title', 'meal served title', 'trim|required');
            //$this->form_validation->set_rules('opening_hours[]', 'opening hour', 'trim|required');
            //$this->form_validation->set_rules('meal_plans[]', 'meal type', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('meal_served_title')) 
                    $insertData['meal_served_title'] = $this->input->post('meal_served_title');
                if(!empty($id)){
                    $this->common_model->update('meal_served', $insertData, array('id' => $id));
                    $this->session->set_flashdata('msg_success', 'Meal served is updated successfully');
                    redirect(ADMIN_URL.'meal_served');
                }else{
                    $this->common_model->insert('meal_served', $insertData);
                    $this->session->set_flashdata('msg_success', 'Meal served is added successfully');
                    redirect(ADMIN_URL.'meal_served/add_meal_served');
                }
            }
        }
        $data['title'] = 'Add meal served';
        if (!empty($id)) {
            $data['title'] = 'Edit meal served';
            $data['row']   = $this->common_model->get_row('meal_served', array('id' => $id));
        }
        $data['meal_plans']    = $this->common_model->get_result('meals_styles', array('status' =>1));
        $data['template'] = 'superadmin/meal_served/add_meal_served';
        $this->load->view('templates/superadmin_template', $data);
    }
}
