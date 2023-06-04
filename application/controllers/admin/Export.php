<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Export extends CI_Controller {
	public function __construct(){
	    parent::__construct();  
	    clear_cache();  	
		$this->load->model('common_model');	
	    if(!superadmin_logged_in()){
	     	redirect(ADMIN_URL.'login');
	    } 	      
	}		
    /*export data with .csv file*/
    public function member_csv_export(){   
        ob_start();        
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $ownerId = superadmin_id();
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "./uploads/export_csv/member_".time().rand().".csv";
        $result = $this->developer_model->get_member_export();
        $fp = fopen($filename, 'w');
        foreach ($result as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        if (file_exists($filename)) {
            $contenttype = "application/force-download";
            header("Content-Type: " . $contenttype);
            header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
            readfile($filename);
        } else {
            echo "The file $filename does not exist";
        }       
        ob_end_flush();
        exit; 
    }
    /*export data with .xls file*/
    public function  member_xls_export(){ 
        ob_start();
        require_once APPPATH . 'third_party/Classes/PHPExcel.php';
        //require_once dirname(__FILE__) . '/Classes/PHPExcel.php';  
        $result = $this->developer_model->get_member_export();
        $data = array();
        $data = $result;
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Fill worksheet from values in array
        $objPHPExcel->getActiveSheet()->fromArray($data, null, 'A1'); 
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Members'); 
        // Set AutoSize for name and email fields
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $filename = './uploads/export_csv/member_'.time().rand().'.xlsx';
        $objWriter->save($filename);
        if (file_exists($filename)) {
            $contenttype = "application/force-download";
            header("Content-Type: " . $contenttype);
            header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
            readfile($filename);
        } else {
            echo "The file $filename does not exist";
        }       
        ob_end_flush();
        exit;  
    }
    /*export data with .csv file*/
    public function user_csv_export(){   
        ob_start();        
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $ownerId = superadmin_id();
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "./uploads/export_csv/user_".time().rand().".csv";
        $result = $this->developer_model->get_user_export();
        $fp = fopen($filename, 'w');
        foreach ($result as $fields) {
            fputcsv($fp, $fields);
        }
        fclose($fp);
        if (file_exists($filename)) {
            $contenttype = "application/force-download";
            header("Content-Type: " . $contenttype);
            header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
            readfile($filename);
        } else {
            echo "The file $filename does not exist";
        }       
        ob_end_flush();
        exit; 
    }
    /*export data with .xls file*/
    public function  user_xls_export(){ 
        ob_start();
        require_once APPPATH . 'third_party/Classes/PHPExcel.php';
        //require_once dirname(__FILE__) . '/Classes/PHPExcel.php';  
        $result = $this->developer_model->get_user_export();
        $data = array();
        $data = $result;
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Fill worksheet from values in array
        $objPHPExcel->getActiveSheet()->fromArray($data, null, 'A1'); 
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Members'); 
        // Set AutoSize for name and email fields
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $filename = './uploads/export_csv/user_'.time().rand().'.xlsx';
        $objWriter->save($filename);
        if (file_exists($filename)) {
            $contenttype = "application/force-download";
            header("Content-Type: " . $contenttype);
            header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
            readfile($filename);
        } else {
            echo "The file $filename does not exist";
        }       
        ob_end_flush();
        exit;  
    }
    public function  session_xls_export(){ 
        ob_start();
        require_once APPPATH . 'third_party/Classes/PHPExcel.php';
        //require_once dirname(__FILE__) . '/Classes/PHPExcel.php';  
        $result = $this->developer_model->get_session_export();
        $data = array();
        $data = $result;
        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();
        // Fill worksheet from values in array
        $objPHPExcel->getActiveSheet()->fromArray($data, null, 'A1'); 
        // Rename worksheet
        $objPHPExcel->getActiveSheet()->setTitle('Members'); 
        // Set AutoSize for name and email fields
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setAutoSize(true);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setAutoSize(true);
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
        $filename = './uploads/export_csv/session_'.time().rand().'.xlsx';
        $objWriter->save($filename);
        if (file_exists($filename)) {
            $contenttype = "application/force-download";
            header("Content-Type: " . $contenttype);
            header("Content-Disposition: attachment; filename=\"" . basename($filename) . "\";");
            readfile($filename);
        } else {
            echo "The file $filename does not exist";
        }       
        ob_end_flush();
        exit;  
    }    
}