<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
class EmailTemplate extends CI_Controller {
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
        $config['base_url']         = base_url() . "superadmin/emailTemplate/index/";
        $counts                     = $this->developer_model->getEmailTemplate(0, 0);
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
        $data['rows']       = $this->developer_model->getEmailTemplate($offSet, PER_PAGE);
        $data['offset']     = $offSet;
        $data['template']   = 'superadmin/email_template/email_template';
        $this->load->view('templates/superadmin_template', $data);
    }
    /*superadmin dashboard*/
    public function addEmailTemplate($id =''){
        if (isset($_POST['submit'])) {
            $this->form_validation->set_rules('template_subject', 'Subject Name', 'trim|required');
            $this->form_validation->set_rules('template_body', 'email template', 'trim|required');
            $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
            if ($this->form_validation->run() == TRUE) {
                $insertData = array();
                if($this->input->post('template_subject')) 
                    $insertData['template_subject'] = $this->input->post('template_subject');
                if($this->input->post('template_body')) 
                    $insertData['template_body'] = $this->input->post('template_body');
                if(!empty($id)){
                    $this->common_model->update('email_templates', $insertData, array('id' => $id));
                    $this->session->set_flashdata('msg_success', 'Email template is updated successfully');
                    redirect(ADMIN_URL . 'emailTemplate');
                }else{
                    $this->common_model->insert('email_templates', $insertData);
                    $this->session->set_flashdata('msg_success', 'Email template is added successfully');
                    redirect(ADMIN_URL . 'emailTemplate/addEmailTemplate');
                }
            }
        }
        $data['title'] = 'Add Email Template';
        if (!empty($id)) {
            $data['title'] = 'Edit Email Template';
            $data['row']   = $this->common_model->get_row('email_templates', array('id' => $id));
        }
        $data['template'] = 'superadmin/email_template/addemail_template';
        $this->load->view('templates/superadmin_template', $data);
    }
}
