<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Meal_styles extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."meal_styles/index/";
        $counts                     = $this->developer_model->get_meal_styles(0, 0);
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
        $data['rows']       = $this->developer_model->get_meal_styles($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/meal_styles/meal_styles';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_meal_styles($id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('meals_styles_title', 'meal style name', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('meals_styles_title')) 
                    $insertData['meals_styles_title'] = $this->input->post('meals_styles_title'); 
                if(!empty($id)){
                    $this->common_model->update('meals_styles', $insertData, array('id' => $id));
                    $this->session->set_flashdata('msg_success', 'Meal style is updated successfully');
                    redirect(ADMIN_URL.'Meal_styles');
                }else{
                    $this->common_model->insert('meals_styles', $insertData);
                    $this->session->set_flashdata('msg_success', 'Meal style is added successfully');
                    redirect(ADMIN_URL.'Meal_styles/add_meal_styles');
                }
            }
        }
        $data['title'] = 'Add Meal Style';
        if (!empty($id)) {
            $data['title'] = 'Edit Meal Style';
            $data['row']   = $this->common_model->get_row('meals_styles', array('id' => $id));
        }
        $data['template'] = 'superadmin/meal_styles/add_meal_styles';
        $this->load->view('templates/superadmin_template', $data);
    }
}
