<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*this controller for making manage conatact us in  superadmin */
class Contactus extends CI_Controller {
  	public function __construct(){
  	    parent::__construct();  
  	     clear_cache();         
        $this->load->model('common_model');        
  	}
  /*check login superadmin*/
   private function _check_login(){
		  if(superadmin_logged_in()===FALSE)
			redirect(ADMIN_URL.'login');
	}
  /*show all contact us messages*/ 
  public function index($offset=0){
    $this->_check_login(); //check login authentication
    $data['title']='Contact Us';    
    $per_page = PER_PAGE;   
    $pageNo                = $this->uri->segment(4); 
    $config                = frontend_pagination();
    $config['base_url']    = base_url().'superadmin/contactus/index';
    $config['total_rows']  = $this->common_model->contactus_model(0,0);
    $config['per_page']    = $per_page;
    $config['uri_segment'] = 4;
    $config['use_page_numbers'] = TRUE;
    if(!empty($_SERVER['QUERY_STRING'])){
      $config['suffix']     = "?".$_SERVER['QUERY_STRING'];
    }else{
      $config['suffix']     ='';
    }
    $data['total_records']        = $config['total_rows'];
    if($config['total_rows'] < $offset){
       $this->session->set_flashdata('msg_warning','Something went wrong ..! Please check it ');    
       redirect('superadmin/contactus/index/0');
    }
    $config['first_url']  = $config['base_url'].$config['suffix'];
    $this->pagination->initialize($config);    
    if($pageNo){
            $offset   = $config['per_page']*($pageNo-1);
    }
    $data['offset']   = $offset;
    $data['contacts'] = $this->common_model->contactus_model($offset,$per_page);
    $data['pagination']   = $this->pagination->create_links(); 
    $data['template']     = 'superadmin/contactus/index';
    $this->load->view('templates/superadmin_template', $data);
  }
  public function contact_us_details($id=''){
    $row = $this->common_model->get_row('contact_us', array('id'=>$id));
    echo '<b>Name</b> : <span id="ContactName">'.$row->name.'</span><br/><br/>
          <b>Email</b> : <span id="ContactEmail">'.$row->email.'</span><br/><br/>
          <b>Message</b> : <span id="ContactMessage">'.$row->message.'</span><br/><br/>
          <b>Sent Date & Time</b> : <span id="ContactCreated">'.date('d M Y h:i A', strtotime($row->created)).'</span>';
  }
  public function add_contact($id=''){
    $this->form_validation->set_rules('country_id', 'country', 'trim|required');
      $this->form_validation->set_rules('conatct_us_name_ab', 'conatct us name(arabic)', 'trim|required');
      $this->form_validation->set_rules('conatct_us_name_en', 'conatct us name(english)', 'trim|required');
      $this->form_validation->set_rules('conatct_us_name_tr', 'conatct us name(turkish)', 'trim|required');
      $this->form_validation->set_rules('address_location', 'address location', 'trim');
      $this->form_validation->set_rules('latitude', 'latitude', 'trim|required');
      $this->form_validation->set_rules('longitude', 'longitude', 'trim|required');
      $this->form_validation->set_error_delimiters('<div class="text-danger">', '</div>');
      if ($this->form_validation->run() == TRUE) {
        $insertData = array();
        if($this->input->post('country_id')) 
          $insertData['country_id'] = $this->input->post('country_id');
        if($this->input->post('conatct_us_name_ab')) 
          $insertData['conatct_us_name_ab'] = $this->input->post('conatct_us_name_ab');
        if($this->input->post('conatct_us_name_en')) 
          $insertData['conatct_us_name_en'] = $this->input->post('conatct_us_name_en');
        if($this->input->post('conatct_us_name_tr')) 
          $insertData['conatct_us_name_tr'] = $this->input->post('conatct_us_name_tr');
        if($this->input->post('address_location')) 
          $insertData['address_location'] = $this->input->post('address_location');
        if($this->input->post('latitude')) 
          $insertData['latitude'] = $this->input->post('latitude');
        if($this->input->post('longitude')) 
          $insertData['longitude'] = $this->input->post('longitude');
        if(!empty($id)) {
          $this->common_model->update('contact_details', $insertData, array('id' => $id));
          $this->session->set_flashdata('msg_success', 'Contact details is updated successfully');
          redirect(ADMIN_URL.'contactus/contact_details');
        }else{
          $this->common_model->insert('contact_details', $insertData);
          $this->session->set_flashdata('msg_success', 'Contact details is added successfully');
          redirect(ADMIN_URL.'contactus/add_contact');
        }
      }
    $data['title'] = 'Add Contact Detail';
    if(!empty($id)){
      $data['title'] = 'Edit Contact Detail';
      $data['row']   = $this->common_model->get_row('contact_details', array('id' => $id));
    }
    $data['template']   = 'superadmin/contactus/add_contact';
    $this->load->view('templates/superadmin_template', $data);
  }  
  public function contact_details($offset=0){ 
    $this->_check_login(); //check login authentication
    $data['title']='Contact Us';    
    $per_page = PER_PAGE;   
    $pageNo                = $this->uri->segment(4); 
    $config                = frontend_pagination();
    $config['base_url']    = base_url().'superadmin/contactus/contact_details';
    $config['total_rows']  = $this->developer_model->contactus_list(0, 0);
    $config['per_page']    = $per_page;
    $config['uri_segment'] = 4;
    $config['use_page_numbers'] = TRUE;
    if(!empty($_SERVER['QUERY_STRING'])){
      $config['suffix']     = "?".$_SERVER['QUERY_STRING'];
    }else{
      $config['suffix']     ='';
    }
    $data['total_records']        = $config['total_rows'];
    if($config['total_rows'] < $offset){
       $this->session->set_flashdata('msg_warning','Something went wrong ..! Please check it ');    
       redirect('superadmin/contactus/contact_details/0');
    }
    $config['first_url']  = $config['base_url'].$config['suffix'];
    $this->pagination->initialize($config);    
    if($pageNo){
            $offset   = $config['per_page']*($pageNo-1);
    }
    $data['offset']   = $offset;
    $data['contacts'] = $this->developer_model->contactus_list($offset, $per_page);
    $data['countrys']   = $this->common_model->get_result('countries', array('status' =>1));
    $data['pagination']   = $this->pagination->create_links(); 
    $data['template']     = 'superadmin/contactus/contact';
    $this->load->view('templates/superadmin_template', $data);
  }
  /*reply contact messages*/  
  public function contactus_reply($id=''){  
    if($id == ''){ redirect('superadmin/contactus/index/0'); }
    if(preg_match('/^\d+$/', $id)){ 
      $data['title']    = 'Edit membership';
      $data['contacts'] = $this->common_model->get_result('contact_us',array('id' => $id));
      if(empty($data['contacts'])){
          redirect('superadmin/superadmin/error_404');
      }
      $this->common_model->update('contact_us',array('read_status'=>1),array('id' => $id));
      $this->form_validation->set_rules('message', 'Message', 'required');
     
      $this->form_validation->set_error_delimiters('<div class="error">', '</div>');

      if ($this->form_validation->run() == TRUE)
      {   
        $data_insert['reply'] = $data['contacts'][0]->reply." ".$this->input->post('message');
        $data_insert['status'] = 1;       
        $this->common_model->update('contact_us',$data_insert,$array = array('id' => $id));
         /*  mail function start */
          $this->load->library('cimail_email');
          $email_template = $this->cimail_email->get_email_template('contact_us_replay');
          $param=array(
            'template'  =>  array(
                    'temp'  =>  $email_template->template_body,
                    'var_name'  =>  array(
                            'username'  => $data['contacts'][0]->name,
                            'reply' => $this->input->post('message'),
                            'contact_us_mobile'  => site_info('contact_us_mobile'),
                            'contact_us_email' => site_info('contact_us_email'), 
                            'site_url'    =>  base_url(),   
                            'site_name'   =>  site_info('site_name_not_http'),    
                            'site_logo'   =>  base_url().'assets/front/images/logo.png'
                            )
            ),      
            'email' =>  array(
                'to'    =>   $data['contacts'][0]->email,
                'from'      =>  site_info('mail_from_email'),
                'from_name' =>  site_info('mail_from_name'),
                'subject'   =>  $email_template->template_subject,
              )
            );  
            $status=$this->cimail_email->send_mail($param);
           /*  mail function end */ 
          $this->session->set_flashdata('msg_success','Reply successfully.');
          redirect('superadmin/contactus/contactus_reply/'.$id);
      }
      $data['template']='superadmin/contactus/reply';
      $this->load->view('templates/superadmin_template',$data);
    }else{
      redirect('superadmin/superadmin/error_404');
    }
  }
}