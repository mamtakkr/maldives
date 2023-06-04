<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
function distance($lat1, $lon1, $lat2, $lon2, $unit) {
  if (($lat1 == $lat2) && ($lon1 == $lon2)) {
    return 0;
  }
  else {
    $theta = $lon1 - $lon2;
    $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
    $dist = acos($dist);
    $dist = rad2deg($dist);
    $miles = $dist * 60 * 1.1515;
    $unit = strtoupper($unit);

    if ($unit == "K") {
      return ($miles * 1.609344);
    } else if ($unit == "N") {
      return ($miles * 0.8684);
    } else {
      return $miles;
    }
  }
}

if (!function_exists('get_rating')) {
    function get_rating($id='', $story_id='') {
        $CI = & get_instance();
        $where_data = array('resort_id' => $id, 'verified_status'=>1);
        if(!empty($story_id)){
          $where_data['id'] = $story_id;
        }
        $results    = $CI->common_model->get_result('traveller_stories', $where_data);
        if (!empty($results)) {
            $total_review = 0;
            $total_reviews_count = 0;
            foreach($results as $result){
                $total_review_count = $review_count = 0;
                if(!empty($result->staff_friendliness)){
                  $total_review_count +=  $result->staff_friendliness;
                  $review_count++;
                }
                if(!empty($result->services)){
                  $total_review_count +=  $result->services;
                  $review_count++;
                }
                if(!empty($result->villa)){
                  $total_review_count +=  $result->villa;
                  $review_count++;
                }
                if(!empty($result->dine_wine)){
                  $total_review_count +=  $result->dine_wine;
                  $review_count++;
                }
                if(!empty($result->spa)){
                  $total_review_count +=  $result->spa;
                  $review_count++;
                }
                if(!empty($result->facilities)){
                  $total_review_count +=  $result->facilities;
                  $review_count++;
                }
                if(!empty($result->location)){
                  $total_review_count +=  $result->location;
                  $review_count++;
                } 
                if(!empty($result->beach)){
                  $total_review_count +=  $result->beach;
                  $review_count++;
                }
                if(!empty($result->kids_facilities)){
                  $total_review_count +=  $result->kids_facilities;
                  $review_count++;
                }
                if(!empty($result->over_all)){
                  $total_review_count +=  $result->over_all;
                  $review_count++;
                }             
                if(!empty($total_review_count)&&!empty($review_count)){
                   $total_reviews_count = $total_reviews_count + ($total_review_count/$review_count);
                }              
                $total_review++;
            }
            $avg_rates      = (!empty($total_reviews_count)&&!empty($total_review))?($total_reviews_count / $total_review):0;
            $cal_avg_rates  = $avg_rates*2;
            $cal_avg_rates  = (!empty($cal_avg_rates)&&$cal_avg_rates==10)?$cal_avg_rates:number_format($cal_avg_rates, 1);
            $rate_text      = "Poor";
            if($cal_avg_rates>=9.5){
              $rate_text    = "Exceptional";
            }else if($cal_avg_rates>=9){
              $rate_text    = "Outstanding";
            }else if($cal_avg_rates>=8){
              $rate_text    = "Fabulous ";
            }else if($cal_avg_rates>=7){
              $rate_text    = "Very good";
            }else if($cal_avg_rates>=6){
              $rate_text    = "Good";
            }else if($cal_avg_rates>=5){
              $rate_text    = "Satisfactory";
            }
            return array('total_review'=>$total_review, 'cal_avg_rates'=>$cal_avg_rates, 'avg_rates'=>$avg_rates, 'rate_text'=>$rate_text);
        } else {
            return '';
        }
    }
}