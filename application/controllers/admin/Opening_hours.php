<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Opening_hours extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."opening_hours/index/";
        $counts                     = $this->developer_model->get_opening_hour(0, 0);
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
        $data['rows']       = $this->developer_model->get_opening_hour($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/opening_hours/opening_hours';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_opening_hour($id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('opening_hour_title', 'Opening Hours name', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('opening_hour_title')) 
                    $insertData['opening_hour_title'] = $this->input->post('opening_hour_title');
                if(!empty($id)){
                    $this->common_model->update('opening_hours', $insertData, array('id' => $id));
                    $this->session->set_flashdata('msg_success', 'Opening hour is updated successfully');
                    redirect(ADMIN_URL.'opening_hours');
                }else{
                    $this->common_model->insert('opening_hours', $insertData);
                    $this->session->set_flashdata('msg_success', 'Opening hour is added successfully');
                    redirect(ADMIN_URL.'opening_hours/add_opening_hour');
                }
            }
        }
        $data['title'] = 'Add Opening Hours';
        if (!empty($id)) {
            $data['title'] = 'Edit Opening Hours';
            $data['row']   = $this->common_model->get_row('opening_hours', array('id' => $id));
        }
        $data['template'] = 'superadmin/opening_hours/add_opening_hours';
        $this->load->view('templates/superadmin_template', $data);
    }
}
