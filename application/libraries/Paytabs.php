<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 *  Paytabs Codeigniter PHP Library
 *
 * Paytabs payment gateway Php Codeigniter library
 *
 * @package			Paytabs Codeigniter PHP Library
 * @subpackage		PHP
 * @category		Paytabs Payment gateway
 * @author			Naseem fasal - naseem at infiyo.com  - +973 33495489
 * @license			None
 * @link			https://github.com/naseemfasal
 */

  
  define("AUTHENTICATION", "https://www.paytabs.com/apiv2/validate_secret_key");
  define("PAYPAGE_URL", "https://www.paytabs.com/apiv2/create_pay_page");
  define("VERIFY_URL", "https://www.paytabs.com/apiv2/verify_payment");


class Paytabs
{

    public $secret_key;
    public $api_key;
  
    public function __construct($params)
    {
      	//parent::__construct($base_url,$api_key,$timeout='');
        if(!function_exists('curl_init')) 
        {
            throw new RuntimeException('Paytabs requires cURL module');
        }
        $this->merchant_email = $params['merchant_email'];
        $this->secret_key = $params['secret_key'];
        $this->api_key = "";
    }
  



    
    function authentication(){
       // echo '<br/> merchant_email = '.$this->merchant_email;
        //echo '<br/> secret_key ='.$this->secret_key;
        $rests = $this->runPost(AUTHENTICATION, array("merchant_email"=> $this->merchant_email, "secret_key"=>  $this->secret_key));
        //echo '<br/><br/><br/>authentication  rests <pre>';
       // print_r($rests);
        $obj = json_decode($rests);
        if(!empty($obj->response_code)&&$obj->response_code == "4000"){
          return TRUE;
        }
        return FALSE;
    }
    function create_pay_page($values) {
        $values['merchant_email'] = $this->merchant_email;
        $values['secret_key'] = $this->secret_key;
        $values['ip_customer'] = $_SERVER['REMOTE_ADDR'];
        $values['ip_merchant'] = $_SERVER['SERVER_ADDR'];
        return json_decode($this->runPost(PAYPAGE_URL, $values));
    }     
    function verify_payment($payment_reference){
        $values['merchant_email'] = $this->merchant_email;
        $values['secret_key'] = $this->secret_key;
        $values['payment_reference'] = $payment_reference;
        //$res = $this->runPost(VERIFY_URL, $values);
        //echo '<pre>';print_r($res);
        //return 0;
        return json_decode($this->runPost(VERIFY_URL, $values));
    }    
    function runPost($url, $fields) {
        $fields_string = "";
        foreach ($fields as $key => $value) {
            $fields_string .= $key . '=' . $value . '&';
        }
        $fields_string = rtrim($fields_string, '&');
        $ch = curl_init();
        $ip = $_SERVER['REMOTE_ADDR'];
        $ip_address = array(
            "REMOTE_ADDR" => $ip,
            "HTTP_X_FORWARDED_FOR" => $ip
        );
       /* curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $ip_address);
        curl_setopt($ch, CURLOPT_POST, count($fields));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_REFERER, 1);
        $result = curl_exec($ch);
        echo '<pre>';print_r($result);
        curl_close($ch);  */      



        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $fields_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec ($ch);
        //echo '<pre>';print_r($result);
        curl_close ($ch);
        return $result;
    }
  
  
  
}
