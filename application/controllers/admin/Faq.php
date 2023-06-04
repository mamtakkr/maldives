<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class Faq extends CI_Controller {
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
        $config['base_url']         = ADMIN_URL."faq/index/";
        $counts                     = $this->developer_model->get_faq(0, 0);
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
        $data['rows']       = $this->developer_model->get_faq($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/faq/faq_list';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function add_faq($faq_id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('question', 'question', 'trim|required');
            $this->form_validation->set_rules('answer', 'answer', 'trim|required');
            
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if ($this->input->post('question')) 
                    $insertData['question'] = $this->input->post('question'); 
                if ($this->input->post('answer')) 
                    $insertData['answer'] = $this->input->post('answer'); 
                if(!empty($faq_id)){
                    $this->common_model->update('faq', $insertData, array('faq_id' => $faq_id));
                    $this->session->set_flashdata('msg_success', 'FAQ updated successfully');
                    redirect(ADMIN_URL.'faq');
                }else{
                    $this->common_model->insert('faq', $insertData);
					$this->session->set_flashdata('msg_success', 'FAQ is added successfully');
                    redirect(ADMIN_URL.'faq/add_faq');
                }
            }
        }
        $data['title'] = 'Add FAQ';
        if (!empty($faq_id)) {
            $data['title'] = 'Edit FAQ';
            $data['row']   = $this->common_model->get_row('faq', array('faq_id' => $faq_id));
        }
        $data['template'] = 'superadmin/faq/add_faq';
        $this->load->view('templates/superadmin_template', $data);
    }
}
