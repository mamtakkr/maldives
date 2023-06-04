<?php

if (!defined('BASEPATH')) exit('No direct script access allowed');

class Developer_model extends CI_Model {  

    public function getSubadmin($offSet = 0, $perPage = 0) {

        $UserName   = trim($this->input->get('title', TRUE));

        $email      = trim($this->input->get('email', TRUE));

        $userId     = trim($this->input->get('id', TRUE));      

        $order      = trim($this->input->get('order', TRUE));

        $this->db->select('admin_users.*');

        $this->db->from('admin_users');

         $this->db->where("admin_users.user_role", 3);

        if (isset($UserName) && !empty($UserName)) {

            $this->db->like('admin_users.first_name', $UserName);

        }

        if (isset($email) && !empty($email)) {

           $this->db->like('admin_users.email', $email);         

        }         

        if ($userId) {

            $this->db->where("admin_users.id", $userId);

        }

        if ($this->input->get('start')) {

            $this->db->where("admin_users.created_date >", $this->input->get('start'));

        }

        if ($this->input->get('end')) {

            $this->db->where("admin_users.created_date <", $this->input->get('end'));

        }

        if (!empty($order)) {

            if ($order == 'NameAtoZ') {

                $this->db->order_by('admin_users.first_name', 'ASC');

            } else if ($order == 'NameZtoA') {

                $this->db->order_by('users.first_name', 'DESC');

            } else if ($order == 'ASC') {

                $this->db->order_by('admin_users.id', 'ASC');

            } else {

                $this->db->order_by('admin_users.id', 'DESC');

            }

        } else {

            $this->db->order_by('admin_users.id', 'DESC');

        }      

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    } 

    public function  getResorts($offSet = 0, $perPage = 0) {      

        $this->db->select("resorts.*, CONCAT(".DB_PRE."users.first_name, ' ', ".DB_PRE."users.last_name) AS user_name");

        $this->db->from('resorts');          

        $this->db->join('users', 'resorts.user_id=users.id', 'left'); 

        $where = array();

        if($this->input->get('user_name')){

            $user_names = explode(' ', $this->input->get('user_name'));

            foreach($user_names as $user_name){

                if(!empty($user_name)){

                    $where[] = "users.first_name LIKE '%".$user_name."%' OR users.last_name LIKE '%".$user_name."%'";

                }

            }

           $this->db->where("( ".implode(' OR ', $where)." )");

        } 

        if($this->input->get('resort_id')){

            $this->db->where("resorts.id", $this->input->get('resort_id'));

        }

        if($this->input->get('user_id')){

            $this->db->where("resorts.user_id", $this->input->get('user_id'));

        }

        if($this->input->get('resort_name')){

            $this->db->like("resorts.resort_name", $this->input->get('resort_name'));

        }    

        $this->db->where("resorts.status !=", 3);

        $this->db->order_by('resorts.order_priority', 'ASC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_villalist($offSet = 0, $perPage = 0) {      

        $this->db->select("resorts.id as resort_id,resorts.resort_name, accommodation.*");

        $this->db->from('accommodation');

        $this->db->join('resorts', 'resorts.id=accommodation.resort_id');  

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

               

            } else {

              return false;

            }

        } else {

          return  $this->db->get()->num_rows();

        }

    }

    public function get_openings($offSet = 0, $perPage = 0) {      

        $this->db->select("new_openings.*, resorts.resort_name");

        $this->db->from('new_openings');          

        $this->db->join('resorts', 'new_openings.resort_id=resorts.id', 'left'); 

        $where = array(); 

        if($this->input->get('opening_id')){

            $this->db->where("new_openings.id", $this->input->get('opening_id'));

        }

        if($this->input->get('resort_name')){

            $this->db->like("resorts.resort_name", $this->input->get('resort_name'));

        }    

        $this->db->where("new_openings.status !=", 3);

        $this->db->order_by('new_openings.id', 'DESC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function getCustomer($offSet = 0, $perPage = 0, $userType="", $owner_id='') {

        $UserName   = trim($this->input->get('user_name', TRUE));

        $userId     = trim($this->input->get('user_id', TRUE));

        $email      = trim($this->input->get('email', TRUE));

        $order      = trim($this->input->get('order', TRUE));

        $this->db->select("users.*, CONCAT(".DB_PRE."users.first_name, ' ', ".DB_PRE."users.last_name) AS user_name");

        $this->db->from('users');  

        $this->db->where("users.status !=", 3); 

        if(!empty($userType)){

           $this->db->where('users.user_type', $userType);

        } 

       /*if($this->input->get('user_name')){

            $where = "user_name LIKE '%".$this->input->get('user_name')."%'";

           $this->db->having($where);

        }*/

        $where = array();

        if($this->input->get('user_name')){

            $user_names = explode(' ', $this->input->get('user_name'));

            foreach($user_names as $user_name){

                if(!empty($user_name)){

                    $where[] = "users.first_name LIKE '%".$user_name."%' OR users.last_name LIKE '%".$user_name."%'";

                }

            }

           $this->db->where("( ".implode(' OR ', $where)." )");

        } 

        if(!empty($email)){

           $this->db->like('users.email', $email);

        }       

        if(!empty($userId)){

            $this->db->where("users.id", $userId);

        } 

        if($this->input->get('start')) {

            $this->db->where("users.created_date >", $this->input->get('start').' 00:00:00');

        }

        if($this->input->get('end')) {

            $this->db->where("users.created_date <", $this->input->get('end').' 23:59:59');

        }

        if (!empty($order)) {

            if ($order == 'NameAtoZ') {

                $this->db->order_by('users.first_name', 'ASC');

            } else if ($order == 'NameZtoA') {

                $this->db->order_by('user.first_name', 'DESC');

            } else if ($order == 'ASC') {

                $this->db->order_by('users.id', 'ASC');

            } else {

                $this->db->order_by('users.id', 'DESC');

            }

        } else {

            $this->db->order_by('users.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            //echo $this->db->last_query();exit();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function getBrands($offSet = 0, $perPage = 0) {

        $this->db->select("brand.*");

        $this->db->from('brand');

        $this->db->where("brand.status !=", 3); 

        if($this->input->get('brand_id')){

           $this->db->where('brand.id', $this->input->get('brand_id'));

        }       

        if($this->input->get('brand_name')){

            $this->db->like("brand.brand_name", $this->input->get('brand_name'));

        } 

        if($this->input->get('start')) {

            $this->db->where("brand.created_date >", $this->input->get('start').' 00:00:00');

        }

        if($this->input->get('end')) {

            $this->db->where("brand.created_date <", $this->input->get('end').' 23:59:59');

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('brand.first_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('brand.first_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('brand.id', 'ASC');

            } else {

                $this->db->order_by('brand.id', 'DESC');

            }

        } else {

            $this->db->order_by('brand.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function getAtolls($offSet = 0, $perPage = 0) {

        $this->db->select("states.*");

        $this->db->from('states');

        $this->db->where("states.status !=", 3); 

        if($this->input->get('Atoll_id')){

           $this->db->where('states.id', $this->input->get('Atoll_id'));

        }       

        if($this->input->get('Atoll_name')){

            $this->db->like("states.state_name", $this->input->get('Atoll_name'));

        } 

        if($this->input->get('start')) {

            $this->db->where("states.created_date >", $this->input->get('start').' 00:00:00');

        }

        if($this->input->get('end')) {

            $this->db->where("states.created_date <", $this->input->get('end').' 23:59:59');

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('states.state_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('states.state_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('states.id', 'ASC');

            } else {

                $this->db->order_by('states.id', 'DESC');

            }

        } else {

            $this->db->order_by('states.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_distance_places($offSet = 0, $perPage = 0) {

        $this->db->select("distance_place.*");

        $this->db->from('distance_place');

        $this->db->where("distance_place.status !=", 3); 

        if($this->input->get('id')){

            $this->db->where('distance_place.id', $this->input->get('id'));

        }

        if($this->input->get('title')){

            $this->db->like('distance_place.title', $this->input->get('title'));

        }

        $this->db->order_by('distance_place.id', 'DESC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_transfer_modes($offSet = 0, $perPage = 0) {

        $this->db->select("international_airport_type.*");

        $this->db->from('international_airport_type');

        $this->db->where("international_airport_type.status !=", 3); 

        if($this->input->get('Transfer_Mode_ID')){

           $this->db->where('international_airport_type.id', $this->input->get('Transfer_Mode_ID'));

        }       

        if($this->input->get('Transfer_Mode_Name')){

            $this->db->like("international_airport_type.airport_type_name", $this->input->get('Transfer_Mode_Name'));

        }

        if($this->input->get('airport_type')){

            $this->db->where("international_airport_type.airport_type", $this->input->get('airport_type'));

        } 

        if($this->input->get('start')) {

            $this->db->where("international_airport_type.created_date >", $this->input->get('start').' 00:00:00');

        }

        if($this->input->get('end')) {

            $this->db->where("international_airport_type.created_date <", $this->input->get('end').' 23:59:59');

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('international_airport_type.airport_type_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('international_airport_type.airport_type_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('international_airport_type.id', 'ASC');

            } else {

                $this->db->order_by('international_airport_type.id', 'DESC');

            }

        } else {

            $this->db->order_by('international_airport_type.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_hear_by($offSet = 0, $perPage = 0) {

        $this->db->select("hear_by.*");

        $this->db->from('hear_by');

        $this->db->where("hear_by.status !=", 3); 

        if($this->input->get('hear_by_id')){

           $this->db->where('hear_by.id', $this->input->get('hear_by_id'));

        }       

        if($this->input->get('hear_by')){

            $this->db->like("hear_by.hear_by", $this->input->get('hear_by'));

        }         

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('hear_by.hear_by', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('hear_by.hear_by', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('hear_by.id', 'ASC');

            } else {

                $this->db->order_by('hear_by.id', 'DESC');

            }

        } else {

            $this->db->order_by('hear_by.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_villa_types($offSet = 0, $perPage = 0) {

        $this->db->select("villa_type.*");

        $this->db->from('villa_type');

        $this->db->where("villa_type.status !=", 3); 

        if($this->input->get('villa_type_id')){

           $this->db->where('villa_type.id', $this->input->get('villa_type_id'));

        }       

        if($this->input->get('villa_type')){

            $this->db->like("villa_type.villa_type", $this->input->get('villa_type'));

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('villa_type.villa_type', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('villa_type.villa_type', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('villa_type.id', 'ASC');

            } else {

                $this->db->order_by('villa_type.id', 'DESC');

            }

        } else {

            $this->db->order_by('villa_type.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }  

    public function get_food_types($offSet = 0, $perPage = 0) {

        $this->db->select("food_types.*");

        $this->db->from('food_types');

        $this->db->where("food_types.status !=", 3); 

        if($this->input->get('food_type_id')){

           $this->db->where('food_types.id', $this->input->get('food_type_id'));

        }       

        if($this->input->get('food_type')){

            $this->db->like("food_types.food_type", $this->input->get('food_type'));

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('food_types.food_type', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('food_types.food_type', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('food_types.id', 'ASC');

            } else {

                $this->db->order_by('food_types.id', 'DESC');

            }

        } else {

            $this->db->order_by('food_types.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_dinnings_types($offSet = 0, $perPage = 0) {

        $this->db->select("dinnings_type.*");

        $this->db->from('dinnings_type');

        $this->db->where("dinnings_type.status !=", 3);

        if($this->input->get('dining_type_id')){

           $this->db->where('dinnings_type.id', $this->input->get('dining_type_id'));

        }       

        if($this->input->get('dinnings_type')){

            $this->db->like("dinnings_type.dinnings_type", $this->input->get('dinnings_type'));

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('dinnings_type.dinnings_type', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('dinnings_type.dinnings_type', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('dinnings_type.id', 'ASC');

            } else {

                $this->db->order_by('dinnings_type.id', 'DESC');

            }

        } else {

            $this->db->order_by('dinnings_type.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_meal_styles($offSet = 0, $perPage = 0) {

        $this->db->select("meals_styles.*");

        $this->db->from('meals_styles');

        $this->db->where("meals_styles.status !=", 3);

        if($this->input->get('meal_plans_id')){

           $this->db->where('meals_styles.id', $this->input->get('meal_plans_id'));

        }       

        if($this->input->get('meal_style_name')){

            $this->db->like("meals_styles.meals_styles_title", $this->input->get('meal_style_name'));

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('meals_styles.meals_styles_title', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('meals_styles.meals_styles_title', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('meals_styles.id', 'ASC');

            } else {

                $this->db->order_by('meals_styles.id', 'DESC');

            }

        } else {

            $this->db->order_by('meals_styles.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_meal_plans($offSet = 0, $perPage = 0) {

        $this->db->select("meal_plans.*");

        $this->db->from('meal_plans');

        $this->db->where("meal_plans.status !=", 3);

        if($this->input->get('meal_plans_id')){

           $this->db->where('meal_plans.id', $this->input->get('meal_plans_id'));

        }       

        if($this->input->get('meal_plans_name')){

            $this->db->like("meal_plans.meal_plans_name", $this->input->get('meal_plans_name'));

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('meal_plans.meal_plans_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('meal_plans.meal_plans_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('meal_plans.id', 'ASC');

            } else {

                $this->db->order_by('meal_plans.id', 'DESC');

            }

        } else {

            $this->db->order_by('meal_plans.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_attractions($offSet = 0, $perPage = 0) {

        $this->db->select("attractions.*");

        $this->db->from('attractions');

        $this->db->where("attractions.status !=", 3);

        if($this->input->get('attraction_id')){

           $this->db->where('attractions.id', $this->input->get('attraction_id'));

        }       

        if($this->input->get('attraction_name')){

            $this->db->like("attractions.attraction_name", $this->input->get('attraction_name'));

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('attractions.attraction_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('attractions.attraction_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('attractions.id', 'ASC');

            } else {

                $this->db->order_by('attractions.id', 'DESC');

            }

        } else {

            $this->db->order_by('attractions.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_holiday_styles($offSet = 0, $perPage = 0) {

        $this->db->select("holidays.*");

        $this->db->from('holidays');

        $this->db->where("holidays.status !=", 3);

        if($this->input->get('holiday_id')){

           $this->db->where('holidays.id', $this->input->get('holiday_id'));

        }       

        if($this->input->get('holiday_name')){

            $this->db->like("holidays.holiday_name", $this->input->get('holiday_name'));

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('holidays.holiday_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('holidays.holiday_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('holidays.id', 'ASC');

            } else {

                $this->db->order_by('holidays.id', 'DESC');

            }

        } else {

            $this->db->order_by('holidays.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_amenities($offSet = 0, $perPage = 0) {

        $this->db->select("amenities.*, amenities_category.category_name");

        $this->db->from('amenities');

        $this->db->join('amenities_category', 'amenities.category_id=amenities_category.id', 'left');

        $this->db->where("amenities.status !=", 3);

        if($this->input->get('amenity_id')){

           $this->db->where('amenities.id', $this->input->get('amenity_id'));

        }       

        if($this->input->get('amenity_name')){

            $this->db->like("amenities.amenitie_name", $this->input->get('amenity_name'));

        }

        if($this->input->get('category_id')){ 

            $this->db->like("amenities.category_id", $this->input->get('category_id'));

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('amenities.amenitie_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('amenities.amenitie_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('amenities.id', 'ASC');

            } else {

                $this->db->order_by('amenities.id', 'DESC');

            }

        } else {

            $this->db->order_by('amenities.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_categorys($offSet = 0, $perPage = 0) {

        $this->db->select("amenities_category.*");

        $this->db->from('amenities_category');

        $this->db->where("amenities_category.status !=", 3);

        if($this->input->get('categorty_id')){

           $this->db->where('amenities_category.id', $this->input->get('categorty_id'));

        }       

        if($this->input->get('category_name')){

            $this->db->like("amenities_category.category_name", $this->input->get('category_name'));

        }

        if($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('amenities_category.category_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('amenities_category.category_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('amenities_category.id', 'ASC');

            } else {

                $this->db->order_by('amenities_category.id', 'DESC');

            }

        }else{

            $this->db->order_by('amenities_category.id', 'DESC');

        }

        if($offSet >= 0 && $perPage > 0){

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_facility($offSet = 0, $perPage = 0) {

        $this->db->select("facilities.*");

        $this->db->from('facilities');

        $this->db->where("facilities.status !=", 3);

        if($this->input->get('facility_id')){

           $this->db->where('facilities.id', $this->input->get('facility_id'));

        }       

        if($this->input->get('facility_name')){

            $this->db->like("facilities.facility_name", $this->input->get('facility_name'));

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('facilities.facility_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('facilities.facility_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('facilities.id', 'ASC');

            } else {

                $this->db->order_by('facilities.id', 'DESC');

            }

        } else {

            $this->db->order_by('facilities.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_ideals($offSet = 0, $perPage = 0) {

        $this->db->select("ideals.*");

        $this->db->from('ideals');

        $this->db->where("ideals.status !=", 3);

        if($this->input->get('ideal_id')){

           $this->db->where('ideals.id', $this->input->get('ideal_id'));

        }       

        if($this->input->get('ideal_name')){

            $this->db->like("ideals.ideal_name", $this->input->get('ideal_name'));

        } 

        if($this->input->get('start')) {

            $this->db->where("ideals.created_date >", $this->input->get('start').' 00:00:00');

        }

        if($this->input->get('end')) {

            $this->db->where("ideals.created_date <", $this->input->get('end').' 23:59:59');

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('ideals.ideal_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('ideals.ideal_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('ideals.id', 'ASC');

            } else {

                $this->db->order_by('ideals.id', 'DESC');

            }

        } else {

            $this->db->order_by('ideals.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_sports($offSet = 0, $perPage = 0) {

        $this->db->select("sport.*");

        $this->db->from('sport');

        $this->db->where("sport.status !=", 3);

        if($this->input->get('sport_id')){

           $this->db->where('sport.id', $this->input->get('sport_id'));

        }       

        if($this->input->get('sport_name')){

            $this->db->like("sport.sport_name", $this->input->get('sport_name'));

        } 

        if($this->input->get('start')) {

            $this->db->where("sport.created_date >", $this->input->get('start').' 00:00:00');

        }

        if($this->input->get('end')) {

            $this->db->where("sport.created_date <", $this->input->get('end').' 23:59:59');

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('sport.sport_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('sport.sport_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('sport.id', 'ASC');

            } else {

                $this->db->order_by('sport.id', 'DESC');

            }

        } else {

            $this->db->order_by('sport.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_water_sports($offSet = 0, $perPage = 0) {

        $this->db->select("water_sports.*");

        $this->db->from('water_sports');

        $this->db->where("water_sports.status !=", 3);

        if($this->input->get('water_sports_id')){

           $this->db->where('water_sports.id', $this->input->get('water_sports_id'));

        }       

        if($this->input->get('water_sports_name')){

            $this->db->like("water_sports.water_sports_name", $this->input->get('water_sports_name'));

        } 

        if($this->input->get('start')) {

            $this->db->where("water_sports.created_date >", $this->input->get('start').' 00:00:00');

        }

        if($this->input->get('end')) {

            $this->db->where("water_sports.created_date <", $this->input->get('end').' 23:59:59');

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('water_sports.water_sports_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('water_sports.water_sports_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('water_sports.id', 'ASC');

            } else {

                $this->db->order_by('water_sports.id', 'DESC');

            }

        } else {

            $this->db->order_by('water_sports.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_opening_hour($offSet = 0, $perPage = 0) {

        $this->db->select("opening_hours.*");

        $this->db->from('opening_hours');

        $this->db->where("opening_hours.status !=", 3);

        if($this->input->get('opening_hours_id')){

           $this->db->where('opening_hours.id', $this->input->get('opening_hours_id'));

        }       

        if($this->input->get('opening_hour_title')){

            $this->db->like("opening_hours.opening_hour_title", $this->input->get('opening_hour_title'));

        } 

        if($this->input->get('start')) {

            $this->db->where("opening_hours.created_date >", $this->input->get('start').' 00:00:00');

        }

        if($this->input->get('end')) {

            $this->db->where("opening_hours.created_date <", $this->input->get('end').' 23:59:59');

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('opening_hours.opening_hour_title', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('opening_hours.opening_hour_title', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('opening_hours.id', 'ASC');

            } else {

                $this->db->order_by('opening_hours.id', 'DESC');

            }

        } else {

            $this->db->order_by('opening_hours.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_meal_served_admin($offSet = 0, $perPage = 0) {

        $this->db->select("meal_served.*");

        $this->db->from('meal_served');

        $this->db->where("meal_served.status !=", 3);

        if($this->input->get('meal_served_id')){

           $this->db->where('meal_served.id', $this->input->get('meal_served_id'));

        }       

        if($this->input->get('meal_served_title')){

            $this->db->like("meal_served.meal_served_title", $this->input->get('meal_served_title'));

        } 

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('meal_served.meal_served_title', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('meal_served.meal_served_title', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('meal_served.id', 'ASC');

            } else {

                $this->db->order_by('meal_served.id', 'DESC');

            }

        } else {

            $this->db->order_by('meal_served.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function getAffiliations($offSet = 0, $perPage = 0) {

        $this->db->select("affiliation.*");

        $this->db->from('affiliation');

        $this->db->where("affiliation.status !=", 3);

        if($this->input->get('affiliation_id')){

           $this->db->where('affiliation.id', $this->input->get('affiliation_id'));

        }       

        if($this->input->get('affiliation_name')){

            $this->db->like("affiliation.affiliation_name", $this->input->get('affiliation_name'));

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('affiliation.affiliation_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('affiliation.affiliation_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('affiliation.id', 'ASC');

            } else {

                $this->db->order_by('affiliation.id', 'DESC');

            }

        } else {

            $this->db->order_by('affiliation.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_resort_category($offSet = 0, $perPage = 0) {

        $this->db->select("category.*");

        $this->db->from('category');

        $this->db->where("category.status !=", 3);

        if($this->input->get('category_id')){

           $this->db->where('category.id', $this->input->get('category_id'));

        }       

        if($this->input->get('category_name')){

            $this->db->like("category.category_name", $this->input->get('category_name'));

        }

        if($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('category.category_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('category.category_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('category.id', 'ASC');

            } else {

                $this->db->order_by('category.id', 'DESC');

            }

        }else{

            $this->db->order_by('category.id', 'DESC');

        }

        if($offSet >= 0 && $perPage > 0){

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_blogs($offSet = 0, $perPage = 0) {

        $this->db->select("news_blog.*, CONCAT(".DB_PRE."admin_users.first_name, ' ', ".DB_PRE."admin_users.last_name) AS user_name");

        $this->db->join('admin_users', 'news_blog.news_added_user=admin_users.id', 'left'); 

        $this->db->from('news_blog');

        $this->db->where("news_blog.status !=", 3);

        if($this->input->get('news_id')){

           $this->db->where('news_blog.id', $this->input->get('news_id'));

        }

        if($this->input->get('user_name')){

           $this->db->where('news_blog.id', $this->input->get('user_name'));

        } 

        if($this->input->get('user_id')){

           $this->db->where('news_blog.news_added_user', $this->input->get('user_id'));

        }               

        if($this->input->get('news_title')){

            $this->db->like("news_blog.news_title", $this->input->get('news_title'));

        }

        if($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('news_blog.news_title', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('news_blog.news_title', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('news_blog.id', 'ASC');

            } else {

                $this->db->order_by('news_blog.id', 'DESC');

            }

        }else{

            $this->db->order_by('news_blog.id', 'DESC');

        }

        if($offSet >= 0 && $perPage > 0){

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function getEmailTemplate($offSet = 0, $perPage = 0) {

        $this->db->select("email_templates.*");

        $this->db->from('email_templates');

        if($this->input->get('opening_hours_id')){

           $this->db->where('email_templates.id', $this->input->get('opening_hours_id'));

        }       

        if($this->input->get('opening_hour_title')){

            $this->db->like("email_templates.opening_hour_title", $this->input->get('opening_hour_title'));

        } 

        if($this->input->get('start')) {

            $this->db->where("email_templates.created_date >", $this->input->get('start').' 00:00:00');

        }

        if($this->input->get('end')) {

            $this->db->where("email_templates.created_date <", $this->input->get('end').' 23:59:59');

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('email_templates.opening_hour_title', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('email_templates.opening_hour_title', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('email_templates.id', 'ASC');

            } else {

                $this->db->order_by('email_templates.id', 'DESC');

            }

        } else {

            $this->db->order_by('email_templates.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    /************************  front end data *********************************************/

    public function getUserDetails($user_id = '') {

        $this->db->select("users.*");

        $this->db->from('users');

        if (!empty($user_id)) {

            $this->db->where("users.id", $user_id);

        } else {

            $this->db->where("users.id", user_id());

        }

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            $data = $getdata->row();

            return $data;

        } else {

            return false;

        }

    } 

    public function user_resorts($offSet = 0, $perPage = 0) {

        $this->db->select("resorts.*");

        $this->db->from('resorts');

        /*if($this->input->get('user_id')){ 

            $this->db->where('resorts.user_id', $this->input->get('user_id'));

        }*/

        $this->db->where('resorts.user_id', user_id());

        $this->db->order_by('resorts.id', 'DESC');

        //echo $this->db->last_query();

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

     public function get_favorites_resorts($offSet = 0, $perPage = 0) {

        $this->db->select("resorts.*");

        $this->db->from('resorts_likes');

        $this->db->join('resorts', 'resorts_likes.resort_id = resorts.id');

        $this->db->where('resorts_likes.user_id', user_id());

        $this->db->order_by('resorts_likes.id', 'DESC');

        //echo $this->db->last_query();

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_meal_served_resort($meal_served_where=array()) {

        $this->db->select("dinnings_meal_served.*");

        $this->db->from('dinnings_meal_served');

        $this->db->where("(".implode(' OR ', $meal_served_where).")");

        $getdata    = $this->db->get();

        $num        = $getdata->num_rows();

        $resort_ids = array();

        if ($num) {

            $meal_served = $getdata->result();

            if(!empty($meal_served)){

                foreach ($meal_served as $meal_served) {

                    $resort_ids[] = $meal_served->resort_id;

                }

            }

            $resort_ids = array_unique($resort_ids);

            return implode(',', $resort_ids);

        } else {

            return false;

        }

    }

    public function get_airport_resort($airport_where=array()) {

        $this->db->select("international_airports.*");

        $this->db->from('international_airports');

        $this->db->where("(".implode(' OR ', $airport_where).")");

        $getdata    = $this->db->get();

        $num        = $getdata->num_rows();

        $resort_ids = array();

        if ($num) {

            $international_airports = $getdata->result();

            if(!empty($international_airports)){

                foreach ($international_airports as $international_airport) {

                    $resort_ids[] = $international_airport->resort_id;

                }

            }

            $resort_ids = array_unique($resort_ids);

            return implode(',', $resort_ids);

        } else {

            return false;

        }

    }

    public function get_dinnings_resort($type) {

        $this->db->select("dinnings.*");

        $this->db->from('dinnings');

        $this->db->where($type);

        $getdata    = $this->db->get();

        //echo $this->db->last_query(); //exit();

        $num        = $getdata->num_rows();

        $resort_ids = array();

        if ($num) {

            $meal_served = $getdata->result();

            if(!empty($meal_served)){

                foreach ($meal_served as $meal_served) {

                    $resort_ids[] = $meal_served->resort_id;

                }

            }

            $resort_ids = array_unique($resort_ids);

            return implode(',', $resort_ids);

        } else {

            return false;

        }

    }

    public function maldives_resort(){ 

        $this->db->select("resorts.*, states.state_name, (SELECT COUNT(*) FROM ".DB_PRE."international_airports  WHERE ".DB_PRE."international_airports.resort_id = ".DB_PRE."resorts.id AND ".DB_PRE."international_airports.airport_type=1) as speedboat, (SELECT COUNT(*) FROM ".DB_PRE."international_airports  WHERE ".DB_PRE."international_airports.resort_id = ".DB_PRE."resorts.id AND ".DB_PRE."international_airports.airport_type=2) as seaplane, (SELECT COUNT(*) FROM ".DB_PRE."international_airports  WHERE ".DB_PRE."international_airports.resort_id = ".DB_PRE."resorts.id AND ".DB_PRE."international_airports.airport_type=3) as domestic, (SELECT COUNT(*) FROM ".DB_PRE."accommodation  WHERE ".DB_PRE."accommodation.resort_id = ".DB_PRE."resorts.id) as accommodation_count, (SELECT COUNT(*) FROM ".DB_PRE."dinnings  WHERE ".DB_PRE."dinnings.resort_id = ".DB_PRE."resorts.id) as dinning_count");

        $this->db->from('resorts'); 

        $this->db->join('states', 'resorts.physical_state = states.id', 'left');

        $this->db->where('resorts.admin_approved', 1);

        $this->db->where('resorts.status', 1);

        $this->db->order_by('resorts.resort_name', 'ASC');

        if(!empty($limit)){

            $this->db->limit($limit, 0);

        }

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function maldives_resorts_places(){ 

        $this->db->select("resorts.resort_name as title, resorts.id, 'resort' as 'type'");

        $this->db->from('resorts');

        $this->db->where('resorts.admin_approved', 1);

        $this->db->where('resorts.status', 1);

        $query1 = $this->db->get_compiled_select();

        $this->db->select("distance_place.title, distance_place.id, , 'place' as 'type'");

        $this->db->from('distance_place');

        $this->db->where('distance_place.status', 1);

        $query2  = $this->db->get_compiled_select(); 

        $getdata = $this->db->query($query1." UNION ".$query2." ORDER BY title ASC"); 

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function inspiration_resort_filter() {

        $this->db->select("
        (SELECT COUNT(restaurant_type) from 
        mal_resorts where mal_dinnings.resort_id = mal_resorts.id AND FIND_IN_SET('42',mal_resorts.facilities)) as spa,
        (SELECT COUNT(restaurant_type) from mal_resorts where mal_dinnings.resort_id = mal_resorts.id AND FIND_IN_SET('41',mal_resorts.facilities)) as divingcenter,
        (SELECT COUNT(restaurant_type) from mal_resorts where mal_dinnings.resort_id = mal_resorts.id AND FIND_IN_SET('35',mal_resorts.facilities)) as kidsclub,
        (SELECT COUNT(restaurant_type) from mal_dinnings where mal_dinnings.resort_id=mal_resorts.id AND FIND_IN_SET('3',mal_dinnings.restaurant_type)) as bars ,
        count(mal_dinnings.id) as diningcount,resorts.*,
        (SELECT state_name from mal_states where mal_states.id=mal_resorts.physical_state) as atoll,
        (SELECT GROUP_CONCAT(".DB_PRE."holidays.holiday_name SEPARATOR ', ') FROM ".DB_PRE."holidays 

		WHERE FIND_IN_SET(".DB_PRE."holidays.id, ".DB_PRE."resorts.holiday_styles)) as holidays, 

		(SELECT GROUP_CONCAT(".DB_PRE."amenities.amenitie_name SEPARATOR ', ') FROM ".DB_PRE."amenities WHERE FIND_IN_SET(".DB_PRE."amenities.id, ".DB_PRE."resorts.amenities)) as amenities_txt,

		(SELECT GROUP_CONCAT(".DB_PRE."facilities.facility_name SEPARATOR ', ') FROM ".DB_PRE."facilities WHERE FIND_IN_SET(".DB_PRE."facilities.id, ".DB_PRE."resorts.facilities)) as facilities_txt,
		
		(SELECT GROUP_CONCAT(".DB_PRE."international_airports.airport_type SEPARATOR ', ') FROM ".DB_PRE."international_airports WHERE FIND_IN_SET(".DB_PRE."international_airports.id, ".DB_PRE."resorts.id)) as airport_type,

		(SELECT COUNT(*) FROM ".DB_PRE."traveller_stories WHERE ".DB_PRE."traveller_stories.resort_id = ".DB_PRE."resorts.id AND ".DB_PRE."traveller_stories.verified_status='1') as total_reviews");

        $this->db->from('resorts');
        
        $this->db->join('dinnings', 'dinnings.resort_id = resorts.id', 'left'); 
        
        $this->db->join('international_airports', 'international_airports.resort_id = mal_resorts.id', 'left'); 
        $this->db->where('resorts.admin_approved', '1');

        $this->db->where('resorts.status', '1');
        
        if($this->input->post('exp_resort') > 0) {
            $this->db->where('resorts.id', $this->input->post('exp_resort'));
        }

        if($this->input->post('holidays')){

            $holidays = $this->input->post('holidays');

            if(!empty($holidays)){

                foreach($holidays as $holiday){

                    $holiday_where[] = "  FIND_IN_SET('".$holiday."', ".DB_PRE."resorts.holiday_styles)";;

                }

            }

            $this->db->where("(".implode(' OR ', $holiday_where).")");

        }

        if($this->input->post('holiday_id')){

            $holiday_where = "  FIND_IN_SET('".$this->input->get('holiday_id')."', ".DB_PRE."resorts.holiday_styles)";;

            $this->db->where("(".$holiday_where.")");

        }

        if($this->input->post('categorys')){

            $categorys = $this->input->post('categorys');

            if(!empty($categorys)){

                foreach($categorys as $category){

                    $categorys_where[] = " resorts.resort_category = '".$category."'";

                }

            }

            $this->db->where("(".implode(' OR ', $categorys_where).")");

        }        
        
		if($this->input->post('atoll')){

            $atoll = $this->input->post('atoll');

            if(!empty($atoll)){

                foreach($atoll as $atol){

                    $atoll_where[] = " FIND_IN_SET('".$atol."', ".DB_PRE."resorts.physical_state)";

                }

            }

            $this->db->where("(".implode(' OR ', $atoll_where).")");

        }
        
        if($this->input->post('airports')){
            
            $airports = $this->input->post('airports');
            if(!empty($airports)){

                foreach($airports as $airport){
                    $airport_where[] = " FIND_IN_SET('".$airport."', ".DB_PRE."international_airports.airport_type)";
                }
            }        
            

            $this->db->where("(".implode(' OR ', $airport_where).")");
        }
        
        if($this->input->post('facilities')){

            $facilities = $this->input->post('facilities');

            if(!empty($facilities)){

                foreach($facilities as $facility){

                    $facilities_where[] = " FIND_IN_SET('".$facility."', ".DB_PRE."resorts.facilities)";

                }

            }

            $this->db->where("(".implode(' OR ', $facilities_where).")");

        }

        if($this->input->post('sports')){

            $sports = $this->input->post('sports');

            if(!empty($sports)){

                foreach($sports as $sport){

                    $sport_where[] = " FIND_IN_SET('".$sport."', ".DB_PRE."resorts.sports)";

                }

            }

            $this->db->where("(".implode(' OR ', $sport_where).")");

        }

        if($this->input->post('no_of_villas')){

            $no_of_villas = $this->input->post('no_of_villas');

            if(!empty($no_of_villas)){

                foreach($no_of_villas as $no_of_villa){

                    $no_of_villaS = explode(',', $no_of_villa);

                    $whereMinMax  = ''; 

                    $whereMinMax  .= !empty($no_of_villaS[0])?' total_no_villas >='.$no_of_villaS[0]:'';

                    $whereMinMax  .= !empty($no_of_villaS[1])?' AND total_no_villas <='.$no_of_villaS[1]:'';

                    $sport_where[] = " ( ".$whereMinMax." ) ";

                }

            }

            $this->db->where("(".implode(' OR ', $sport_where).")");

        }     
        $this->db->group_by('resorts.id');
        $this->db->order_by('resorts.order_priority', 'ASC');
        $getdata = $this->db->get();
        $num = $getdata->num_rows();
        //echo $this->db->last_query(); exit();
        if ($num) {
            return $getdata->result();
        } else {
            return false;
        }
        
    }
    
    public function home_resorts($offSet = 0, $perPage = 0, $feachered='') { 
       
        if($this->input->get('meal_plans')){

            $meal_plans = $this->input->get('meal_plans');

            if(!empty($meal_plans)){

                foreach($meal_plans as $meal_plan_row){

                    $meal_served_where[] = " dinnings_meal_served.meal_served_status = '".$meal_plan_row."'";

                }

            }            

            $meal_served_where = $this->get_meal_served_resort($meal_served_where);

            $mealStatus        = 'yes';            

        } 

        if($this->input->get('airports')){

            $airports = $this->input->get('airports');

            if(!empty($airports)){

                foreach($airports as $airport){

                    $airport_where[] = " international_airports.airport_type = '".$airport."'";

                }

            }            

            $airport_where = $this->get_airport_resort($airport_where);

            $mealStatus    = 'yes';

        }

        /*if($this->input->get('food_type')){

            $food_type_where = array();

            $food_types = $this->input->get('food_type');

            if(!empty($food_types)){

                foreach($food_types as $food_type){

                    $food_type_where[] = " dinnings.food_type = '".$food_type."'";

                }

            }            

            $meal_served_where = $this->get_dinnings_resort($food_type_where);

            $mealStatus        = 'yes';

        }*/ 

        //print_r($_GET); //exit();

        if($this->input->get('food_type')){

            $food_type_where = array();

            $food_types      = $this->input->get('food_type');

            if(!empty($food_types)){

                foreach($food_types as $food_type){

                    $food_type_where[] = "  FIND_IN_SET('".$food_type."', ".DB_PRE."dinnings.food_type)";;

                }

            }

            $vegetarianResortIDs = $this->get_dinnings_resort("(".implode(' OR ', $food_type_where).")");

            $vegetarianStatus    = 'yes';

           // echo '<pre>';print_r($vegetarianResortIDs);

        }

        //exit();

        /*if($this->input->get('vegetarian')){         

            $vegetarianResortIDs = $this->get_dinnings_resort('vegetarian_option');

            $vegetarianStatus    = 'yes';

        } 

        if($this->input->get('halal')){       

            $halalResortIDs = $this->get_dinnings_resort('halal_option');

            $halalStatus    = 'yes';

        }  */      

        $this->db->select("(SELECT COUNT(restaurant_type) from mal_resorts where resort_id = mal_resorts.id AND FIND_IN_SET('42',mal_resorts.facilities)) as spa,(SELECT COUNT(restaurant_type) from mal_resorts where resort_id = mal_resorts.id AND FIND_IN_SET('41',mal_resorts.facilities)) as divingcenter,(SELECT COUNT(restaurant_type) from mal_resorts where resort_id = mal_resorts.id AND FIND_IN_SET('35',mal_resorts.facilities)) as kidsclub,(SELECT COUNT(restaurant_type) from mal_dinnings where mal_dinnings.resort_id=mal_resorts.id AND FIND_IN_SET('3',mal_dinnings.restaurant_type)) as bars ,count(mal_dinnings.id) as diningcount,resorts.*,(SELECT state_name from mal_states where mal_states.id=mal_resorts.physical_state) as atoll,(SELECT GROUP_CONCAT(".DB_PRE."holidays.holiday_name SEPARATOR ', ') FROM ".DB_PRE."holidays 

		WHERE FIND_IN_SET(".DB_PRE."holidays.id, ".DB_PRE."resorts.holiday_styles)) as holidays, 

		(SELECT GROUP_CONCAT(".DB_PRE."amenities.amenitie_name SEPARATOR ', ') FROM ".DB_PRE."amenities WHERE FIND_IN_SET(".DB_PRE."amenities.id, ".DB_PRE."resorts.amenities)) as amenities_txt,

		(SELECT GROUP_CONCAT(".DB_PRE."facilities.facility_name SEPARATOR ', ') FROM ".DB_PRE."facilities WHERE FIND_IN_SET(".DB_PRE."facilities.id, ".DB_PRE."resorts.facilities)) as facilities_txt,

		(SELECT COUNT(*) FROM ".DB_PRE."traveller_stories WHERE resort_id = ".DB_PRE."resorts.id AND ".DB_PRE."traveller_stories.verified_status='1') as total_reviews");

        $this->db->from('resorts');
        
        $this->db->join('dinnings', 'dinnings.resort_id = resorts.id', 'left'); 
        
        //$this->db->join('resort_highlights', 'resort_highlights.resort_id = resorts.id', 'left'); 

        $this->db->where('resorts.admin_approved', '1');

        $this->db->where('resorts.status', '1');
        
        if($this->input->get('exp_resort') > 0) {
            $this->db->where('resorts.id', $this->input->get('exp_resort'));
        }
        
        if($this->input->get('search', TRUE)){
            //$this->db->where('resort_name LIKE "%anantara%"');
            $searchTitle = trim($this->input->get('search', TRUE));

            if(!empty($searchTitle)){

                $searchTitleP = explode(' ', $searchTitle);

                $searchParams = array();

                if(!empty($searchTitleP)){

                    foreach($searchTitleP as $searchTitlePn){

                        if(!empty($searchTitlePn)){                            

                            $searchParams[] =

                                "( 

                                    `resort_name` LIKE '%".$searchTitlePn."%' ESCAPE '!' 

                                )";
                        }

                    }

                }

                if(!empty($searchParams)){
                    $this->db->where('('.implode(' OR ', $searchParams).')');

                }

            }            

        }  
        if(!empty($feachered)){
            
            $this->db->where('resorts.feachered', '1');

        }
       
        if($this->input->get('holidays')){

            $holidays = $this->input->get('holidays');

            if(!empty($holidays)){

                foreach($holidays as $holiday){

                    $holiday_where[] = "  FIND_IN_SET('".$holiday."', ".DB_PRE."resorts.holiday_styles)";;

                }

            }

            $this->db->where("(".implode(' OR ', $holiday_where).")");

        }

        if($this->input->post('holidays')){

            $holidays = $this->input->post('holidays');

            if(!empty($holidays)){

                foreach($holidays as $holiday){

                    $holiday_where[] = "  FIND_IN_SET('".$holiday."', ".DB_PRE."resorts.holiday_styles)";;

                }

            }

            $this->db->where("(".implode(' OR ', $holiday_where).")");

        }

        if($this->input->get('holiday_id')){

            $holiday_where = "  FIND_IN_SET('".$this->input->get('holiday_id')."', ".DB_PRE."resorts.holiday_styles)";;

            $this->db->where("(".$holiday_where.")");

        }
        
        if(!empty($vegetarianStatus)){

            $vegetarianResort_txt = " resorts.id IN(".$vegetarianResortIDs.")";

            $this->db->where($vegetarianResort_txt);

        }
        if($this->input->post('exp_resort')){

            $exp_resorts = " resorts.id IN(".$this->input->post('exp_resort').")";

            $this->db->where($exp_resorts);

        }

        if(!empty($meal_served_where)){

            $meal_served_where_txt = " resorts.id IN(".$meal_served_where.")";

            $this->db->where($meal_served_where_txt);

        }

        if(!empty($airport_where)){

            $airport_where_txt = " resorts.id IN(".$airport_where.")";

            $this->db->where($airport_where_txt);

        }

        if($this->input->get('categorys')){

            $categorys = $this->input->get('categorys');

            if(!empty($categorys)){

                foreach($categorys as $category){

                    $categorys_where[] = " resorts.resort_category = '".$category."'";

                }

            }

            $this->db->where("(".implode(' OR ', $categorys_where).")");

        }        

        if($this->input->post('categorys')){

            $categorys = $this->input->post('categorys');

            if(!empty($categorys)){

                foreach($categorys as $category){

                    $categorys_where[] = " resorts.resort_category = '".$category."'";

                }

            }

            $this->db->where("(".implode(' OR ', $categorys_where).")");

        }        

        if($this->input->post('airports')){

            $airports = $this->input->post('airports');

            if(!empty($airports)){

                foreach($airports as $airport){

                    $airport_where[] = "  FIND_IN_SET('".$airport."', ".DB_PRE."international_airports.airport_type)";

                }

            }

            $this->db->where("(".implode(' OR ', $airport_where).")");

        }        

        if($this->input->get('facilities')){

            $facilities = $this->input->get('facilities');

            if(!empty($facilities)){

                foreach($facilities as $facility){

                    $facilities_where[] = " FIND_IN_SET('".$facility."', ".DB_PRE."resorts.facilities)";

                }

            }

            $this->db->where("(".implode(' OR ', $facilities_where).")");

        }

        if($this->input->post('facilities')){

            $facilities = $this->input->post('facilities');

            if(!empty($facilities)){

                foreach($facilities as $facility){

                    $facilities_where[] = " FIND_IN_SET('".$facility."', ".DB_PRE."resorts.facilities)";

                }

            }

            $this->db->where("(".implode(' OR ', $facilities_where).")");

        }

		if($this->input->get('atoll')){

            $atoll = $this->input->get('atoll');

            if(!empty($atoll)){

                foreach($atoll as $atol){

                    $atoll_where[] = " FIND_IN_SET('".$atol."', ".DB_PRE."resorts.physical_state)";

                }

            }

            $this->db->where("(".implode(' OR ', $atoll_where).")");

        }

        if($this->input->post('atoll')){

            $atoll = $this->input->post('atoll');

            if(!empty($atoll)){

                foreach($atoll as $atol){

                    $atoll_where[] = " FIND_IN_SET('".$atol."', ".DB_PRE."resorts.physical_state)";

                }

            }

            $this->db->where("(".implode(' OR ', $atoll_where).")");

        }

		if($this->input->get('amenities')){

            $amenities = $this->input->get('amenities');

            if(!empty($amenities)){

                foreach($amenities as $amenitie){

                    $amenities_where[] = " FIND_IN_SET('".$amenitie."', ".DB_PRE."resorts.amenities)";

                }

            }

            $this->db->where("(".implode(' OR ', $amenities_where).")");

        }

		if($this->input->get('facilities')){

            $facilities = $this->input->get('facilities');

            if(!empty($facilities)){

                foreach($facilities as $facilitie){

                    $facilities_where[] = " FIND_IN_SET('".$facilitie."', ".DB_PRE."resorts.facilities)";

                }

            }

            $this->db->where("(".implode(' OR ', $facilities_where).")");

        }

        if($this->input->get('sports')){

            $sports = $this->input->get('sports');

            if(!empty($sports)){

                foreach($sports as $sport){

                    $sport_where[] = " FIND_IN_SET('".$sport."', ".DB_PRE."resorts.sports)";

                }

            }

            $this->db->where("(".implode(' OR ', $sport_where).")");

        }

        if($this->input->post('sports')){

            $sports = $this->input->post('sports');

            if(!empty($sports)){

                foreach($sports as $sport){

                    $sport_where[] = " FIND_IN_SET('".$sport."', ".DB_PRE."resorts.sports)";

                }

            }

            $this->db->where("(".implode(' OR ', $sport_where).")");

        }

        if($this->input->get('no_of_villas')){

            $no_of_villas = $this->input->get('no_of_villas');

            if(!empty($no_of_villas)){

                foreach($no_of_villas as $no_of_villa){

                    $no_of_villaS = explode(',', $no_of_villa);

                    $whereMinMax  = ''; 

                    $whereMinMax  .= !empty($no_of_villaS[0])?' total_no_villas >='.$no_of_villaS[0]:'';

                    $whereMinMax  .= !empty($no_of_villaS[1])?' AND total_no_villas <='.$no_of_villaS[1]:'';

                    $sport_where[] = " ( ".$whereMinMax." ) ";

                }

            }

            $this->db->where("(".implode(' OR ', $sport_where).")");

        }
        
        if($this->input->post('no_of_villas')){

            $no_of_villas = $this->input->post('no_of_villas');

            if(!empty($no_of_villas)){

                foreach($no_of_villas as $no_of_villa){

                    $no_of_villaS = explode(',', $no_of_villa);

                    $whereMinMax  = ''; 

                    $whereMinMax  .= !empty($no_of_villaS[0])?' total_no_villas >='.$no_of_villaS[0]:'';

                    $whereMinMax  .= !empty($no_of_villaS[1])?' AND total_no_villas <='.$no_of_villaS[1]:'';

                    $sport_where[] = " ( ".$whereMinMax." ) ";

                }

            }

            $this->db->where("(".implode(' OR ', $sport_where).")");

        }

        $this->db->group_by('resorts.id');
        
        if(!empty($searchTitle)){             

            $searchTitleP  = explode(' ', $searchTitle);     

            $searchOrder  = !empty($searchTitleP[0])?$searchTitleP[0]:$searchTitle;     

            $firstWhere    = "".DB_PRE."resorts.`resort_name` LIKE '%".$searchOrder."%' ";  

            if(!empty($searchTitleP)){

                foreach($searchTitleP as $searchTitlePn){

                    $searchParams[] =

                        "( 

                            `resort_name` LIKE '%".$searchTitlePn."%'

                         )";

                }

            }

            if(!empty($searchParams)){

                $firstWhere = '('.implode(' AND ', $searchParams).')';

            }            

            $orderSql     = "case when (".$firstWhere.") then 1 

                                  when (

                                         ".DB_PRE."resorts.resort_name LIKE '%".$searchOrder."%' ESCAPE '!' 

                                        ) then 2 

                                when (

                                         ".DB_PRE."resorts.resort_name LIKE '%".$searchOrder."%' ESCAPE '!'

                                ) then 3 

                                else 4 end";

            $this->db->order_by($orderSql);

        }else{

            $this->db->order_by('resorts.order_priority', 'ASC');

        }
        
        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            //echo $this->db->last_query(); //exit();    
            //echo $perPage;
            //echo $offSet;
            $num = $getdata->num_rows();
            //echo $num;
            if ($num) {
                //print_R($getdata->result());
                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function home_resorts_name() {     

       /* $this->db->select("resorts.*, (SELECT GROUP_CONCAT(".DB_PRE."holidays.holiday_name SEPARATOR ', ') 

		FROM ".DB_PRE."holidays WHERE FIND_IN_SET(".DB_PRE."holidays.id, ".DB_PRE."resorts.holiday_styles)) as holidays, 

		(SELECT GROUP_CONCAT(".DB_PRE."amenities.amenitie_name SEPARATOR ', ') FROM ".DB_PRE."amenities 

		WHERE FIND_IN_SET(".DB_PRE."amenities.id, ".DB_PRE."resorts.amenities)) as amenities_txt, 

		(SELECT COUNT(*) FROM ".DB_PRE."traveller_stories WHERE resort_id = ".DB_PRE."resorts.id AND ".DB_PRE."traveller_stories.verified_status='1') as total_reviews");

        */

		$this->db->select("resorts.*,(SELECT state_name from mal_states where id=resorts.physical_state) as atoll, (SELECT GROUP_CONCAT(".DB_PRE."holidays.holiday_name SEPARATOR ', ') 

		FROM ".DB_PRE."holidays WHERE FIND_IN_SET(".DB_PRE."holidays.id, ".DB_PRE."resorts.holiday_styles)) as holidays, 

		(SELECT GROUP_CONCAT(".DB_PRE."facilities.facility_name SEPARATOR ', ') FROM ".DB_PRE."facilities 

		WHERE FIND_IN_SET(".DB_PRE."facilities.id, ".DB_PRE."resorts.facilities)) as amenities_txt, 

		(SELECT COUNT(*) FROM ".DB_PRE."traveller_stories WHERE resort_id = ".DB_PRE."resorts.id AND ".DB_PRE."traveller_stories.verified_status='1') as total_reviews");

        $this->db->from('resorts');        

        $this->db->where('resorts.admin_approved', '1');

        $this->db->where('resorts.status', '1');

        if($this->input->get('term', TRUE)){

            $searchTitle = trim($this->input->get('term', TRUE));

            if(!empty($searchTitle)){

                $searchTitleP = explode(' ', $searchTitle);

                $searchParams = array();

                if(!empty($searchTitleP)){

                    foreach($searchTitleP as $searchTitlePn){

                        if(!empty($searchTitlePn)){                            

                            $searchParams[] =

                                "( 

                                    `resort_name` LIKE '%".$searchTitlePn."%' ESCAPE '!' 

                                )";

                        }

                    }

                }

                if(!empty($searchParams)){

                    $this->db->where('('.implode(' OR ', $searchParams).')');

                }

            }            

        }          

        if(!empty($searchTitle)){             

            $searchTitleP  = explode(' ', $searchTitle);     

            $searchOrder  = !empty($searchTitleP[0])?$searchTitleP[0]:$searchTitle;     

            $firstWhere    = "".DB_PRE."resorts.`resort_name` LIKE '%".$searchOrder."%' ";  

            if(!empty($searchTitleP)){

                foreach($searchTitleP as $searchTitlePn){

                    $searchParams[] =

                        "( 

                            `resort_name` LIKE '%".$searchTitlePn." %'

                         )";

                }

            }

            if(!empty($searchParams)){

                $firstWhere = '('.implode(' AND ', $searchParams).')';

            }            

            $orderSql     = "case when (".$firstWhere.") then 1 

                                  when (

                                         ".DB_PRE."resorts.resort_name LIKE '% ".$searchOrder." %' ESCAPE '!' 

                                        ) then 2 

                                when (

                                         ".DB_PRE."resorts.resort_name LIKE '% ".$searchOrder."%' ESCAPE '!'

                                ) then 3 

                                else 4 end";

            $this->db->order_by($orderSql);

        }else{

            $this->db->order_by('resorts.order_priority', 'ASC');

        }

        $getdata = $this->db->get();

        //echo $this->db->last_query(); exit();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function resort_detail($resort_id=''){ 

        $this->db->select("resorts.*,brand.brand_name, category.category_name, users.first_name, users.last_name, (SELECT COUNT(*) FROM ".DB_PRE."traveller_stories WHERE resort_id = ".DB_PRE."resorts.id AND ".DB_PRE."traveller_stories.verified_status='1') as total_reviews,state_name");

        $this->db->from('resorts');

        $this->db->join('brand', 'resorts.brand_id = brand.id', 'left'); 

		$this->db->join('states', 'states.id = resorts.physical_state', 'left');

        $this->db->join('category', 'resorts.resort_category = category.id', 'left');

        $this->db->join('users', 'resorts.user_id = users.id', 'left');

        $this->db->where('resorts.id', $resort_id);

        $this->db->order_by('resorts.id', 'ASC');

        if(!empty($limit)){

            $this->db->limit($limit, 0);

        }

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->row();

        } else {

            return false;

        }

    }

    public function resort_compair_detail($resort_id=''){ 

        $this->db->select("resorts.*,brand.brand_name, category.category_name, (SELECT GROUP_CONCAT(".DB_PRE."holidays.holiday_name SEPARATOR ', ') 

		FROM ".DB_PRE."holidays WHERE FIND_IN_SET(".DB_PRE."holidays.id, ".DB_PRE."resorts.holiday_styles)) as holidays, 

		(SELECT GROUP_CONCAT(".DB_PRE."amenities.amenitie_name SEPARATOR ', ') FROM ".DB_PRE."amenities WHERE FIND_IN_SET(".DB_PRE."amenities.id, ".DB_PRE."resorts.amenities)) as amenities_txt,

		(SELECT GROUP_CONCAT(".DB_PRE."facilities.facility_name SEPARATOR ', ') FROM ".DB_PRE."facilities WHERE FIND_IN_SET(".DB_PRE."facilities.id, ".DB_PRE."resorts.facilities)) as facilities_txt,

		(SELECT COUNT(*) FROM ".DB_PRE."traveller_stories WHERE resort_id = ".DB_PRE."resorts.id AND ".DB_PRE."traveller_stories.verified_status='1') as total_reviews, 

		GROUP_CONCAT(sport.sport_name SEPARATOR ',') as sports_name");

        $this->db->from('resorts');

        $this->db->join('brand', 'resorts.brand_id = brand.id', 'left');

        $this->db->join('category', 'resorts.resort_category = category.id', 'left');

        $this->db->join('sport sport', 'resorts.sports = sport.id', 'left');

        $this->db->where('resorts.id', $resort_id);

        $this->db->order_by('resorts.id', 'ASC');

        
        if(!empty($limit)){

            $this->db->limit($limit, 0);

        }
        
        // $getdata = $this->db->get();
        // echo $this->db->last_query();exit();
        
        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->row();

        } else {

            return false;

        }

    }

	public function villa_compare_detail($id=''){ 

        $this->db->select("accommodation.*,resorts.maps_location,(SELECT GROUP_CONCAT(".DB_PRE."holidays.holiday_name SEPARATOR ', ') 

		FROM ".DB_PRE."holidays WHERE FIND_IN_SET(".DB_PRE."holidays.id, ".DB_PRE."accommodation.ideal_for)) as holidays, 

		(SELECT GROUP_CONCAT(".DB_PRE."amenities.amenitie_name SEPARATOR ', ') FROM ".DB_PRE."amenities WHERE FIND_IN_SET(".DB_PRE."amenities.id, ".DB_PRE."accommodation.amenities)) as amenities_txt,

		(SELECT GROUP_CONCAT(".DB_PRE."facilities.facility_name SEPARATOR ', ') FROM ".DB_PRE."facilities WHERE FIND_IN_SET(".DB_PRE."facilities.id, ".DB_PRE."accommodation.facilities)) as facilities_txt,villa_type.villa_type");

        $this->db->from('accommodation');
          
		 $this->db->join('resorts', 'resorts.id = accommodation.resort_id', 'left');

		 $this->db->join('villa_type', 'villa_type.id = accommodation.villa_type', 'left');

        $this->db->where('accommodation.id', $id);

        $this->db->order_by('accommodation.id', 'ASC');

        if(!empty($limit)){

            $this->db->limit($limit, 0);

        }

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->row();

        } else {

            return false;

        }

    }

    public function resort_accommodation($resort_id='', $limit=0, $counter='') {
        
      
        $villa_types_where = $locations_where = $facilitys_where = array();      

        $this->db->select("accommodation.*, (SELECT GROUP_CONCAT(".DB_PRE."ideals.ideal_name SEPARATOR ', ') FROM ".DB_PRE."ideals 

		WHERE FIND_IN_SET(".DB_PRE."ideals.id, ".DB_PRE."accommodation.ideal_for)) as ac_ideals, 

		(SELECT GROUP_CONCAT(".DB_PRE."amenities.amenitie_name SEPARATOR ', ') FROM ".DB_PRE."amenities WHERE FIND_IN_SET(".DB_PRE."amenities.id, ".DB_PRE."accommodation.amenities)) as ac_amenities

		, villa_type.villa_type"); 

        $this->db->from('accommodation');

		if($resort_id!=''){

			$this->db->where('accommodation.resort_id', $resort_id);
            
		}

		if($this->input->post('room_count')){

			$max_room_count = $this->input->post('room_count');
			if($max_room_count > 0) {
                
                $room_count_where[] = " accommodation.number_of_rooms_per_villa = '".$max_room_count."'";
                
			    
                $this->db->where("(".implode('', $room_count_where).")");
            }

			 

		}
            // $getdata = $this->db->get();
            // echo $this->db->last_query();exit() ;
		

        $this->db->join('villa_type', 'accommodation.villa_type = villa_type.id', 'left');

        $this->db->order_by('accommodation.number_of_rooms_per_villa', 'DESC');

        if($this->input->post('villa_types')){

            $villa_types = $this->input->post('villa_types');

            if(!empty($villa_types)){

                foreach($villa_types as $villa_type){

                    $villa_types_where[] = " accommodation.villa_type = '".$villa_type."'";

                }

            }

            $this->db->where("(".implode(' OR ', $villa_types_where).")");

        }

        if($this->input->post('villa_locations')){

            $villa_locations = $this->input->post('villa_locations');

            if(!empty($villa_locations)){

                foreach($villa_locations as $villa_location){

                    $locations_where[] = " accommodation.villa_location = '".$villa_location."'";

                }

            }

            $this->db->where("(".implode(' OR ', $locations_where).")");

        }

        if($this->input->post('amenities')){

            $amenities = $this->input->post('amenities');

            if(!empty($amenities)){

                foreach($amenities as $amenity){

                    $amenities_where[] = "  FIND_IN_SET('".$amenity."', ".DB_PRE."accommodation.amenities)";                    

                }

            }

            $this->db->where("(".implode(' OR ', $amenities_where).")");

        } 

        if($this->input->post('room_size')){

            $this->db->where("number_of_rooms_per_villa", $this->input->post('room_size'));

        }

        if(!empty($limit)){

            $this->db->limit($limit, 0);

        }

        $getdata = $this->db->get();

        
        $num     = $getdata->num_rows();

		

        if(!empty($counter)){

            return $num;

        }else if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function get_meal_served($resort_id='',$meal_served_where=array()) {

        $this->db->select("dinnings_meal_served.*");

        $this->db->from('dinnings_meal_served');

        $this->db->where('dinnings_meal_served.resort_id', $resort_id);

        $this->db->where("(".implode(' OR ', $meal_served_where).")");

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        $dinning_ids = array();

        if ($num) {

            $meal_served = $getdata->result();

            if(!empty($meal_served)){

                foreach ($meal_served as $meal_served) {

                    $dinning_ids[] = $meal_served->dinning_id;

                }

                $dinning_ids = array_unique($dinning_ids);

            }

            return implode(',', $dinning_ids);

        } else {

            return false;

        }

    }

    public function resort_dinnings($resort_id='', $limit=0, $counter='') {

        $mealStatus = 'no';

        if($this->input->post('meal_served')){

            $meal_served = $this->input->post('meal_served');

            if(!empty($meal_served)){

                foreach($meal_served as $meal_servedRow){

                    $meal_served_where[] = " dinnings_meal_served.meal_served_status = '".$meal_servedRow."'";

                }

            }            

            $meal_served_where = $this->get_meal_served($resort_id, $meal_served_where);

            $mealStatus        = 'yes';

        } 

        if(!empty($mealStatus)&&($mealStatus=='no' || !empty($meal_served_where))){

            $this->db->select("dinnings.*, (SELECT GROUP_CONCAT(".DB_PRE."dress_codes.dress_code_title SEPARATOR ', ') FROM ".DB_PRE."dress_codes WHERE FIND_IN_SET(".DB_PRE."dress_codes.id, ".DB_PRE."dinnings.dress_code)) as dn_dress_code, (SELECT GROUP_CONCAT(".DB_PRE."meal_plans.meal_plans_name SEPARATOR ', ') FROM ".DB_PRE."meal_plans WHERE FIND_IN_SET(".DB_PRE."meal_plans.id, ".DB_PRE."dinnings.meal_plans_applicable)) as dn_meal_plans");

            $this->db->from('dinnings');

            $this->db->where('dinnings.resort_id', $resort_id);

            if(!empty($meal_served_where)){

                $meal_served_where_txt = " id IN(".$meal_served_where.")";

                $this->db->where($meal_served_where_txt);

            }
            
            if($this->input->post('food_type')){

                $food_type_where = array();

                $food_types      = $this->input->post('food_type');

                if(!empty($food_types)){

                    foreach($food_types as $food_type){

                        $food_type_where[] = "  FIND_IN_SET('".$food_type."', ".DB_PRE."dinnings.food_type)";;

                    }

                }

                $vegetarianResortIDs = $this->db->where("(".implode(' OR ', $food_type_where).")");

            }

            $this->db->order_by('dinnings.id', 'ASC');

            if(!empty($limit)){

                $this->db->limit($limit, 0);

            }

            $getdata = $this->db->get();

            //echo $this->db->last_query();

            $num     = $getdata->num_rows();

            if(!empty($counter)){

                return $num;

            }else if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        }else{

            return false;

        }

    }

    public function get_dinnings_meal_served($dinning_id='', $limit=0) {

        $this->db->select("dinnings_meal_served.*,meal_served.meal_served_title, meal_served.meal_icon, meals_styles.meals_styles_title, opening_hours.opening_hour_title");

        $this->db->from('dinnings_meal_served');

        $this->db->join('meal_served', 'dinnings_meal_served.meal_served_status = meal_served.id', 'left');

        $this->db->join('opening_hours', 'dinnings_meal_served.opening_hour = opening_hours.id', 'left');

        $this->db->join('meals_styles', 'dinnings_meal_served.meal_type = meals_styles.id', 'left');

        $this->db->where('dinnings_meal_served.dinning_id', $dinning_id);

        $this->db->order_by('dinnings_meal_served.id', 'ASC');

        if(!empty($limit)){

            $this->db->limit($limit, 0);

        }

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function resort_international_airports($resort_id='', $limit=0) {

        $this->db->select("international_airports.*, international_airport_type.airport_type_name, international_airport_type.image_name, international_airport_type.airport_type, international_airport_type.tag, international_airport_type.image_name_icon");

        $this->db->from('international_airports');

        $this->db->join('international_airport_type', 'international_airports.airport_type = international_airport_type.id', 'left');

        $this->db->where('international_airports.resort_id', $resort_id);

        $this->db->order_by('international_airports.id', 'ASC');

        if(!empty($limit)){

            $this->db->limit($limit, 0);

        }

        $getdata = $this->db->get();

        //echo $this->db->last_query();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function resort_sports($sport_ids='') {

        if(!empty($sport_ids)){            

            $whereID = "id IN(".$sport_ids.")";

            $this->db->select("sport.*");

            $this->db->from('sport');

            $this->db->where($whereID);

            $this->db->order_by('sport.id', 'ASC');

            $getdata = $this->db->get();

            $num     = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        }else{

            return false;

        }

    }

    public function resort_water_sports($water_sports='') {

        if(!empty($water_sports)){            

            $whereID = "id IN(".$water_sports.")";

            $this->db->select("water_sports.*");

            $this->db->from('water_sports');

            $this->db->where($whereID);

            $this->db->order_by('water_sports.id', 'ASC');

            $getdata = $this->db->get();

            $num     = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        }else{

            return false;

        }

    }

    public function resort_holiday_style($holidays='') {

        if(!empty($holidays)){            

            $whereID = "id IN(".$holidays.")";

            $this->db->select("holidays.*");

            $this->db->from('holidays');

            $this->db->where($whereID);

            $this->db->order_by('holidays.holiday_name', 'ASC');

            $getdata = $this->db->get();

            $num     = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        }else{

            return false;

        }

    }

    public function resort_villas($resort_id='', $limit=0) {

        $this->db->select("villas.*, villa_type.villa_type as villa_type_name");

        $this->db->from('villas');

        $this->db->join('villa_type', 'villas.villas_type = villa_type.id', 'left');

        $this->db->where('villas.resort_id', $resort_id);

        $this->db->where('villas.villa_counter_status', '1');

        $this->db->order_by('villas.id', 'ASC');

        if(!empty($limit)){

            $this->db->limit($limit, 0);

        }

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function resort_villas_row($resort_id='', $villas_type=0) {

        $this->db->select("villas.*, villa_type.villa_type as villa_type_name");

        $this->db->from('villas');

        $this->db->join('villa_type', 'villas.villas_type = villa_type.id', 'left');

        $this->db->where('villas.resort_id', $resort_id);

        $this->db->where('villas.villas_type', $villas_type);

        $this->db->where('villas.villa_counter_status', '1');

        $this->db->order_by('villas.id', 'ASC');

        if(!empty($limit)){

            $this->db->limit($limit, 0);

        }

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->row();

        } else {

            return false;

        }

    }

    public function compir_resort_list($id_array='', $not_id=0) {

        $this->db->select("resorts.*");

        $this->db->from('resorts');

        $this->db->order_by('resorts.resort_name', 'ASC');

        if (!empty($id_array)):

            foreach ($id_array as $key => $value) {

                $this->db->where($key, $value);

            }

        endif;

        if(!empty($not_id)){

            

            $this->db->where($key, $value);

        }

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function resort_amenitys($amenitys_id='') {

        $categoryUsers = array();

        if(!empty($amenitys_id)){      

            $this->db->select("amenities_category.*");

            $this->db->from('amenities_category');

            $this->db->order_by('amenities_category.id', 'ASC');

            $getdata      = $this->db->get();

            $num          = $getdata->num_rows();

            $categorysArr = $categorysData = array();

            if ($num) {

                $data = $getdata->result();

                if(!empty($data)){

                    foreach($data as $dataRow){

                        $categorysArr              = array('category' => $dataRow->category_name);

                        $categorysArr['amenities'] = $this->resort_amenitys_list($dataRow->id, $amenitys_id);

                        if(!empty($categorysArr['amenities'])){

                            $categorysData[] = $categorysArr;

                        }

                    }

                    return $categorysData;

                }

            } else {

                return false;

            }

        }else{

            return false;

        }

    }

    public function resort_amenitys_list($category_id, $amenitys_id='') {

        $categoryUsers = array();

        if(!empty($amenitys_id)){      

            $whereIN   = " amenities.id IN(".$amenitys_id.")";

            $this->db->select("amenities.*");

            $this->db->from('amenities');

            $this->db->where($whereIN);

            $this->db->where('category_id', $category_id);

            $this->db->order_by('amenities.amenitie_name', 'ASC');

            $getdata      = $this->db->get();

            $num          = $getdata->num_rows();



            $categorysArr = array();

            if ($num) {

                return $getdata->result_array();

            } else {

                return false;

            }

        }else{

            return false;

        }

    }

    public function accommodationFacs($resort_id='', $limit=0) {

        $amenitieIds = $this->accommodationFacsIds();

        if(!empty($amenitieIds)){      

            $whereIN = " amenities.id IN(".$amenitieIds.")";

            $this->db->select("amenities.*");

            $this->db->from('amenities');

            $this->db->where($whereIN);

            $this->db->order_by('amenities.amenitie_name', 'ASC');

            $getdata = $this->db->get();

            $num     = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        }else{

            return false;

        }

    }

    public function accommodationAminnityIds($resort_id='') {

        $this->db->select("accommodation.*");

        $this->db->from('accommodation');

        if(!empty($resort_id)){

            $this->db->where('accommodation.resort_id', $resort_id);

        }

        $this->db->order_by('accommodation.id', 'ASC');

        $getdata     = $this->db->get();

        $num         = $getdata->num_rows();

        $facilityIDs = array();

        if ($num) {

            $accommodations = $getdata->result();

            if(!empty($accommodations)){

                foreach($accommodations as $accommodation){

                    $amenities = explode(',', $accommodation->amenities);

                    if(!empty($amenities)){

                        foreach ($amenities as $aminity) {

                            if(!empty($aminity)){

                                $aminityIDs[] = $aminity;

                            }

                        }

                    }

                }

            }

            $aminityIDs = array_unique($aminityIDs);

            return implode(',', $aminityIDs);

        } else {

            return '';

        }

    }

    public function get_filter_data($table='', $resorts_col='', $type='', $order_by=array()) {

        if(!empty($type)&&$type=='multi'){

            $this->db->select($table.".*, (SELECT COUNT(*) FROM ".DB_PRE."resorts WHERE FIND_IN_SET(".DB_PRE.$table.".id, ".DB_PRE."resorts.".$resorts_col.") AND ".DB_PRE."resorts.admin_approved = '1' AND ".DB_PRE."resorts.status = '1') as resort_count");

        }else{

            $this->db->select($table.".*, (SELECT COUNT(*) FROM ".DB_PRE."resorts WHERE ".DB_PRE.$table.".id = ".DB_PRE."resorts.".$resorts_col." AND ".DB_PRE."resorts.admin_approved = '1' AND ".DB_PRE."resorts.status = '1') as resort_count");

        }        

        $this->db->from($table);

        $this->db->having('resort_count >', 0);    

        if(!empty($order_by[0])&&!empty($order_by[1])){

            $this->db->order_by($order_by[0], $order_by[1]);

        }else{

            $this->db->order_by($table.'.id', 'ASC');

        }     

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if(!empty($counter)){

            return $num;

        }else if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function get_filter_airports() {

        $this->db->select("international_airport_type.*, (SELECT COUNT(*) FROM ".DB_PRE."international_airports WHERE ".DB_PRE."international_airport_type.id = ".DB_PRE."international_airports.airport_type) as resort_count");       

        $this->db->from('international_airport_type');

        $this->db->having('resort_count >', 0);        

        $this->db->order_by('international_airport_type.airport_type_name', 'ASC');        

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if(!empty($counter)){

            return $num;

        }else if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function get_filter_meal_plans() {

        $this->db->select("meal_served.*, (SELECT COUNT(*) FROM ".DB_PRE."dinnings_meal_served WHERE ".DB_PRE."meal_served.id = ".DB_PRE."dinnings_meal_served.meal_served_status) as resort_count");       

        $this->db->from('meal_served');

        $this->db->having('resort_count >', 0);        

        $this->db->order_by('meal_served.meal_served_title', 'ASC');        

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function get_accommodation($resort_id='') {

        if(!empty($resort_id)){            

            $this->db->select("accommodation.*, villa_type.villa_type as villa_type_name, 

			(SELECT GROUP_CONCAT(".DB_PRE."ideals.ideal_name SEPARATOR ', ') FROM ".DB_PRE."ideals 

			WHERE FIND_IN_SET(".DB_PRE."ideals.id, ".DB_PRE."accommodation.ideal_for)) as ideal_names,

			(SELECT GROUP_CONCAT(".DB_PRE."facilities.facility_name SEPARATOR ', ') FROM ".DB_PRE."facilities WHERE FIND_IN_SET(".DB_PRE."facilities.id, ".DB_PRE."accommodation.facilities)) as facility_names,

			(SELECT GROUP_CONCAT(".DB_PRE."amenities.amenitie_name SEPARATOR ', ') FROM ".DB_PRE."amenities WHERE FIND_IN_SET(".DB_PRE."amenities.id, ".DB_PRE."accommodation.amenities)) as amenitie_name");

            $this->db->from('accommodation');

            $this->db->join('villa_type', 'accommodation.villa_type=villa_type.id', 'left');

            $this->db->where('accommodation.resort_id', $resort_id);

            $this->db->order_by('accommodation.priority_order', 'asc');            

            $getdata = $this->db->get();
            //echo $this->db->last_query();

            $num     = $getdata->num_rows();

            if ($num) {

                return $getdata->result();            

            } else {

                return false;

            }

        }else{

            return false;

        }

    }

	public function home_blogs($offSet = 0, $perPage = 0) { 

        $this->db->select("news_blog.*, (SELECT image_name FROM ".DB_PRE."images WHERE ".DB_PRE."images.item_id= ".DB_PRE."news_blog.id AND type='blog' ORDER BY ".DB_PRE."images.id ASC LIMIT 1) as image_name,news_blog.*,users.first_name, users.last_name, users.profile_pic");

        $this->db->from('news_blog');       

	     $this->db->join('users', 'news_blog.news_added_user = users.id', 'left');

        $this->db->where('news_blog.status', '1');  

        if($this->input->get('custags')){
            $this->db->like('news_blog.tags', $this->input->get('custags'));
        }
        
        if($this->input->get('category')){
            $this->db->like('news_blog.blog_category', $this->input->get('category'));
        }

        

        if($this->input->get('blog_id')){

            $blog_id = base64_decode($this->input->get('blog_id'));

            $this->db->where('news_blog.id !=', $blog_id);  

        } 

        $this->db->order_by('news_blog.id', 'DESC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();
            //echo $this->db->last_query(); //exit();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    function get_blogs_tags() {
        $this->db->select("tags");

        $this->db->from('news_blog');       

        $this->db->where('news_blog.status', '1');  

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }
    }
    
    function get_blogs_cats() {
        $this->db->distinct();
        $this->db->select('b.blog_cat_id, b.blog_cat_name');
        $this->db->from('news_blog a'); 
        $this->db->join('blog_category b', 'b.blog_cat_id=a.blog_category', 'left');
        $this->db->where('a.status',1);
        $this->db->order_by('b.blog_cat_name','asc');         
        $query = $this->db->get(); 
        if($query->num_rows() != 0)
        {
            return $query->result_array();
        }
        else
        {
            return false;
        }
    }

    public function getBlogComments($blog_id='',$offSet = 0, $perPage = 0, $type='') {

        $this->db->select("blog_comments.*, users.first_name, users.last_name, users.profile_pic");

        $this->db->from('blog_comments');

        $this->db->join('users', 'blog_comments.user_id=users.id', 'left');

        if(!empty($blog_id)){

            $this->db->where('blog_comments.new_blog_id', $blog_id);

        }

        if(!empty($type)){

            $where  = "(blog_comments.status = 1 OR blog_comments.status= 2 OR blog_comments.status= 4)";

            $this->db->where($where);

        }else if($this->input->get('type')&&$this->input->get('type')=='all'){

            $where  = "(blog_comments.status = 1 OR blog_comments.status= 2 OR blog_comments.status= 4)";

            $this->db->where($where);

        }else{

            $this->db->where('blog_comments.status', 1);

        }

        $this->db->order_by('blog_comments.id', 'DESC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function news_blog_details($news_blog_id = '') {

        $this->db->select("news_blog.*,users.first_name, users.last_name, users.profile_pic");

        $this->db->from('news_blog');

        $this->db->join('users', 'news_blog.news_added_user = users.id', 'left');

        $this->db->order_by('news_blog.id', 'DESC');

        if (!empty($news_blog_id)) {

            $this->db->where("news_blog.id", $news_blog_id);

        }

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->row();

        } else {

            return false;

        }

    }

    public function get_traveller_stories($resort_id='', $category_id='', $offSet = 0, $perPage = 0) {

        if($this->input->post('airports')){

            $airports = $this->input->post('airports');

            if(!empty($airports)){

                foreach($airports as $airport){

                    $airport_where[] = " international_airports.airport_type = '".$airport."'";

                }

            }            

            $airport_where = $this->get_airport_resort($airport_where);

            $mealStatus    = 'yes';

        } 

        if($this->input->post('food_type')){

            $food_type_where = array();

            $food_types      = $this->input->post('food_type');

            if(!empty($food_types)){

                foreach($food_types as $food_type){

                    $food_type_where[] = "  FIND_IN_SET('".$food_type."', ".DB_PRE."dinnings.food_type)";;

                }

            }

            $vegetarianResortIDs = $this->get_dinnings_resort("(".implode(' OR ', $food_type_where).")");

            $vegetarianStatus    = 'yes';

        }

		$traveller_categorys      = $this->input->post('traveller_categorys')?$this->input->post('traveller_categorys'):'';

		$this->db->select("traveller_stories.*, users.first_name, users.last_name, users.profile_pic,countries.country_name, traveller_categorys.category_name, resorts.resort_name, hear_by.hear_by as hear_by_title, accommodation.name_of_villa");

        $this->db->from('traveller_stories');

        $this->db->join('hear_by', 'traveller_stories.hear_by=hear_by.id', 'left');

        $this->db->join('users', 'traveller_stories.user_id=users.id', 'left');

        $this->db->join('countries', 'users.country_id=countries.id', 'left');

        $this->db->join('traveller_categorys', 'traveller_stories.category_id=traveller_categorys.id', 'left');

        $this->db->join('mal_states', 'mal_states.id=mal_traveller_stories`.location', 'left');
        
        $this->db->join('resorts', 'traveller_stories.resort_id=resorts.id');

        $this->db->join('mal_facilities', 'mal_facilities.id=mal_resorts`.facilities', 'left');

        $this->db->join('accommodation', 'traveller_stories.villa_id=accommodation.id', 'left');

        $this->db->where('resorts.status', 1);

        if(!empty($traveller_categorys)){

            $this->db->where('traveller_stories.category_id', $traveller_categorys);

        }

		if(!empty($resort_id)){

            $this->db->where('traveller_stories.resort_id', $resort_id);

        }

        if(!empty($category_id)){

            $where = "traveller_stories.category_id IN(".$category_id.")";

            $this->db->where($where);

        }

        if($this->input->post('holidays')){

            $holidays = $this->input->post('holidays');

            if(!empty($holidays)){

                foreach($holidays as $holiday){

                    $holiday_where[] = "  FIND_IN_SET('".$holiday."', ".DB_PRE."resorts.holiday_styles)";;

                }

            }

            $this->db->where("(".implode(' OR ', $holiday_where).")");

        }

        
        if($this->input->post('holiday_id')){

            $holiday_where = "  FIND_IN_SET('".$this->input->post('holiday_id')."', ".DB_PRE."resorts.holiday_styles)";;

            $this->db->where("(".$holiday_where.")");

        }

        if($this->input->post('atoll')){

            $atolls = $this->input->post('atoll');
            
            if(!empty($atolls)){

                foreach($atolls as $atoll){

                    $atoll_where[] = " ".DB_PRE."traveller_stories.location=".$atoll;

                }

            }

            $this->db->where("(".implode(' OR ', $atoll_where).")");

        }

        if($this->input->post('facilities')){

            $facilities = $this->input->post('facilities');
            
            if(!empty($facilities)){

                foreach($facilities as $facility){

                    $facility_where[] = "  FIND_IN_SET('".$facility."', ".DB_PRE."resorts.facilities)";;

                }

            }

            $this->db->where("(".implode(' OR ', $facility_where).")");

        }

        if(!empty($vegetarianStatus)){

            $vegetarianResort_txt = " resorts.id IN(".$vegetarianResortIDs.")";

            $this->db->where($vegetarianResort_txt);

        }

        if(!empty($meal_served_where)){

            $meal_served_where_txt = " resorts.id IN(".$meal_served_where.")";

            $this->db->where($meal_served_where_txt);

        }

        if(!empty($airport_where)){

            $airport_where_txt = " resorts.id IN(".$airport_where.")";

            $this->db->where($airport_where_txt);

        }

        if($this->input->post('categorys_r')){

            $categorys = $this->input->post('categorys_r');

            if(!empty($categorys)){

                foreach($categorys as $category){

                    $categorys_where[] = " resorts.resort_category = '".$category."'";

                }

            }

            $this->db->where("(".implode(' OR ', $categorys_where).")");

        }        

        if($this->input->post('amenities')){

            $amenities = $this->input->post('amenities');

            if(!empty($amenities)){

                foreach($amenities as $amenitie){

                    $amenities_where[] = " FIND_IN_SET('".$amenitie."', ".DB_PRE."resorts.amenities)";

                }

            }

            $this->db->where("(".implode(' OR ', $amenities_where).")");

        }
        if($this->input->post('sports')){

            $sports = $this->input->post('sports');
            
            if(!empty($sports)){

                foreach($sports as $sport){

                    $sport_where[] = " FIND_IN_SET('".$sport."', ".DB_PRE."resorts.sports)";

                }

            }

            $this->db->where("(".implode(' OR ', $sport_where).")");

        }

        if($this->input->post('no_of_villas')){

            $no_of_villas = $this->input->post('no_of_villas');

            if(!empty($no_of_villas)){

                foreach($no_of_villas as $no_of_villa){

                    $no_of_villaS = explode(',', $no_of_villa);

                    $whereMinMax  = ''; 

                    $whereMinMax  .= !empty($no_of_villaS[0])?' total_no_villas >='.$no_of_villaS[0]:'';

                    $whereMinMax  .= !empty($no_of_villaS[1])?' AND total_no_villas <='.$no_of_villaS[1]:'';

                    $sport_where[] = " ( ".$whereMinMax." ) ";

                }

            }

            $this->db->where("(".implode(' OR ', $sport_where).")");

        } 

        $this->db->where('traveller_stories.verified_status', 1);

        $this->db->order_by('traveller_stories.id', 'DESC');
        //echo $this->db->last_query(); //exit();
        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            //echo $this->db->last_query(); exit();

            return $getdata->num_rows();

        }

    }

    public function get_traveller_stories2($category_id, $offSet = 0, $perPage = 0) {

        

        $this->db->select("traveller_stories.*, users.first_name, users.last_name, users.profile_pic,countries.country_name, traveller_categorys.category_name, resorts.resort_name, hear_by.hear_by as hear_by_title, accommodation.name_of_villa");

        $this->db->from('traveller_stories');

        $this->db->join('hear_by', 'traveller_stories.hear_by=hear_by.id', 'left');

        $this->db->join('users', 'traveller_stories.user_id=users.id', 'left');

        $this->db->join('countries', 'users.country_id=countries.id', 'left');

        $this->db->join('traveller_categorys', 'traveller_stories.category_id=traveller_categorys.id', 'left');

        $this->db->join('resorts', 'traveller_stories.resort_id=resorts.id');

        $this->db->join('accommodation', 'traveller_stories.villa_id=accommodation.id', 'left');

        $this->db->where('resorts.status', 1);

        if(!empty($category_id)){

            $cate=explode(',',$category_id);   

            foreach ($cate as $ckey => $cvalue) {

               $where = "traveller_stories.category_id IN(".$cvalue.")";

                $this->db->where($where);  

            }

        }

        //  if($category_id!=''){

        //     $category_id=explode(',',$category_id);   

        //     foreach ($category_id as $ckey => $cvalue) {

        //     $expcat_where[] = "  FIND_IN_SET('".$cvalue."', traveller_stories.category_id)";

        //         $this->db->where("(".implode(' OR ', $expcat_where).")");

        //     }

        // }
        
        $this->db->where('traveller_stories.verified_status', 1);

        $this->db->order_by('traveller_stories.id', 'DESC');

        

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();
            //echo "asd";
        //echo $this->db->last_query(); 
        //exit();


            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }
            

        } else {

            $getdata = $this->db->get();

            //echo $this->db->last_query(); exit();

            return $getdata->num_rows();

        }

    }

    public function get_rs_stories($resort_id='', $offSet = 0, $perPage = 0) {

        if($this->input->post('airports')){

            $airports = $this->input->post('airports');

            if(!empty($airports)){

                foreach($airports as $airport){

                    $airport_where[] = " international_airports.airport_type = '".$airport."'";

                }

            }            

            $airport_where = $this->get_airport_resort($airport_where);

            $mealStatus    = 'yes';

        } 

       
        $traveller_categorys      = $this->input->post('traveller_categorys')?$this->input->post('traveller_categorys'):'';

        $this->db->select("traveller_stories.*, users.first_name, users.last_name, users.profile_pic,countries.country_name, traveller_categorys.category_name, resorts.resort_name, hear_by.hear_by as hear_by_title, accommodation.name_of_villa");

        $this->db->from('traveller_stories');

        $this->db->join('hear_by', 'traveller_stories.hear_by=hear_by.id', 'left');

        $this->db->join('users', 'traveller_stories.user_id=users.id', 'left');

        $this->db->join('countries', 'users.country_id=countries.id', 'left');

        $this->db->join('traveller_categorys', 'traveller_stories.category_id=traveller_categorys.id', 'left');

        $this->db->join('resorts', 'traveller_stories.resort_id=resorts.id');

        $this->db->join('accommodation', 'traveller_stories.villa_id=accommodation.id', 'left');

        $this->db->where('resorts.status', 1);

        if(!empty($traveller_categorys)){

            $this->db->where('traveller_stories.category_id', $traveller_categorys);

        }

        if(!empty($resort_id)){

            $this->db->where('traveller_stories.resort_id', $resort_id);

        }

        if(!empty($category_id)){

            $where = "traveller_stories.category_id IN(".$category_id.")";

            $this->db->where($where);

        }

        if($this->input->post('holidays')){

            $holidays = $this->input->post('holidays');

            if(!empty($holidays)){

                foreach($holidays as $holiday){

                    $holiday_where[] = "  FIND_IN_SET('".$holiday."', ".DB_PRE."resorts.holiday_styles)";;

                }

            }

            $this->db->where("(".implode(' OR ', $holiday_where).")");

        }

        

        if(!empty($airport_where)){

            $airport_where_txt = " resorts.id IN(".$airport_where.")";

            $this->db->where($airport_where_txt);

        }

        if($this->input->post('categorys')){

            $categorys = $this->input->post('categorys');

            if(!empty($categorys)){

                foreach($categorys as $category){

                    $categorys_where[] = " resorts.resort_category = '".$category."'";

                }

            }

            $this->db->where("(".implode(' OR ', $categorys_where).")");

        }        

        

        if($this->input->get('sports')){

            $sports = $this->input->get('sports');

            if(!empty($sports)){

                foreach($sports as $sport){

                    $sport_where[] = " FIND_IN_SET('".$sport."', ".DB_PRE."resorts.sports)";

                }

            }

            $this->db->where("(".implode(' OR ', $sport_where).")");

        }

        if($this->input->post('no_of_villas')){

            $no_of_villas = $this->input->post('no_of_villas');

            if(!empty($no_of_villas)){

                foreach($no_of_villas as $no_of_villa){

                    $no_of_villaS = explode(',', $no_of_villa);

                    $whereMinMax  = ''; 

                    $whereMinMax  .= !empty($no_of_villaS[0])?' total_no_villas >='.$no_of_villaS[0]:'';

                    $whereMinMax  .= !empty($no_of_villaS[1])?' AND total_no_villas <='.$no_of_villaS[1]:'';

                    $sport_where[] = " ( ".$whereMinMax." ) ";

                }

            }

            $this->db->where("(".implode(' OR ', $sport_where).")");

        } 

        $this->db->where('traveller_stories.verified_status', 1);

        $this->db->order_by('traveller_stories.id', 'DESC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();
            

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            //echo $this->db->last_query(); exit();

            return $getdata->num_rows();

        }

          
       
        // $this->db->select("resort_stories.*, users.first_name, users.last_name, users.profile_pic, resorts.resort_name");

        // $this->db->from('resort_stories');

        // $this->db->join('users', 'resort_stories.user_id=users.id', 'left');

        // $this->db->join('resorts', 'resort_stories.resort_id=resorts.id', 'left');

        // if(!empty($resort_id)){

        //     $this->db->where('resort_stories.resort_id', $resort_id);

        // }

        // if($this->input->post('airports')){

        //     $airports = $this->input->post('airports');

        //     if(!empty($airports)){

        //         foreach($airports as $airport){

        //             $airport_where[] = " international_airports.airport_type = '".$airport."'";

        //         }

        //     }            

        //     $airport_where = $this->get_airport_resort($airport_where);

        //     $mealStatus    = 'yes';

        // } 
    
        // if($this->input->post('story_id')){

        //     $story_id = base64_decode($this->input->post('story_id'));

        //     $this->db->where('resort_stories.id', $story_id);

        // }
        

        // if($this->input->post('food_type')){

        //     $food_type_where = array();

        //     $food_types      = $this->input->post('food_type');

        //     if(!empty($food_types)){

        //         foreach($food_types as $food_type){

        //             $food_type_where[] = "  FIND_IN_SET('".$food_type."', ".DB_PRE."dinnings.food_type)";;

        //         }

        //     }

        //     $vegetarianResortIDs = $this->get_dinnings_resort("(".implode(' OR ', $food_type_where).")");

        //     $vegetarianStatus    = 'yes';

        // }


        // $this->db->where('resort_stories.status', 1);

        // $this->db->order_by('resort_stories.id', 'DESC');

        // if ($offSet >= 0 && $perPage > 0) {

        //     $this->db->limit($perPage, $offSet);

        //     $getdata = $this->db->get();

        //     $num = $getdata->num_rows();

        //     if ($num) {

        //         return $getdata->result();

        //     } else {

        //         return false;

        //     }

        // } else {

        //     $getdata = $this->db->get();

        //     return $getdata->num_rows();

        // }

    }

    public function resort_stories_new($resort_id='') {

        $this->db->select("title,description,image_name,resort_id,mal_resorts.resort_name,resort_id");
        $this->db->from('resort_stories');
        $this->db->join('mal_resorts', 'mal_resorts.id = mal_resort_stories.resort_id', 'inner');
        if($resort_id!="") {
            $this->db->where('resort_id', $resort_id);    
        }
        $this->db->where('mal_resort_stories.status', 1);        
        $this->db->order_by('mal_resort_stories.created_date', 'DESC');
        $getdata = $this->db->get();
        
        $num = $getdata->num_rows();
        if ($num) {
            return $getdata->result();
        } else {
            return false;
        }
    }
    
    public function get_rs_stories_new($resort_id='', $offSet = 0, $perPage = 0) {
        
        $this->db->select("title,description");

        $this->db->from('resort_stories');
        if($resort_id!="") {
            $this->db->where('resort_id', $resort_id);    
        }
        $this->db->where('resort_id', $resort_id);
        $this->db->where('status', 1);        
        $this->db->order_by('created_date', 'DESC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            //echo $this->db->last_query(); exit();

            return $getdata->num_rows();

        }
    }

    public function get_traveller_stories_list($counters='') {

        $user_info           = user_info();

        $user_data_user_id   = array();

        $user_data_user_id[] = $user_info->id;

        if(!empty($user_info->parent_id)){

            $user_data_user_id[] = $user_info->parent_id;

        }

        $childs = $this->common_model->get_result('users', array('parent_id'=>$user_info->id), array('id'));

        if(!empty($childs)){

            foreach($childs as $child){

                $user_data_user_id[] = $child->id;

            }

        }

        $where = "( resorts.user_id IN (".implode(',', $user_data_user_id).") )";

        $this->db->select("traveller_stories.*, users.first_name, users.last_name, users.profile_pic, resorts.resort_name, resorts.resort_logo, traveller_categorys.category_name, hear_by.hear_by as hear_by_title, accommodation.name_of_villa");

        $this->db->from('traveller_stories');

        $this->db->join('hear_by', 'traveller_stories.hear_by=hear_by.id', 'left');

        $this->db->join('users', 'traveller_stories.user_id=users.id');

        $this->db->join('resorts resorts', 'traveller_stories.resort_id=resorts.id');

        $this->db->join('traveller_categorys', 'traveller_stories.category_id=traveller_categorys.id', 'left');     

        $this->db->join('accommodation', 'traveller_stories.villa_id=accommodation.id', 'left');   

        $this->db->where($where);

        $this->db->where('resorts.id !=', '');

        $this->db->order_by('traveller_stories.id', 'DESC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return !empty($counters)?$getdata->num_rows():$getdata->result();

        } else {

            return false;

        }

    }

    public function get_resort_list() {

        $user_info           = user_info();

        $user_data_user_id   = array();

        $user_data_user_id[] = $user_info->id;

        if(!empty($user_info->parent_id)){

            $user_data_user_id[] = $user_info->parent_id;

        }

        $childs = $this->common_model->get_result('users', array('parent_id'=>$user_info->id), array('id'));

        if(!empty($childs)){

            foreach($childs as $child){

                $user_data_user_id[] = $child->id;

            }

        }

        $where = "( resorts.user_id IN (".implode(',', $user_data_user_id).") )";

        $this->db->select("resorts.*");

        $this->db->from('resorts');  

        $this->db->where($where);

        $this->db->where('status', '1');

        $this->db->order_by('resorts.resort_name', 'ASC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function get_activities_1() {

        $this->db->select("guest_activities.*, users.first_name, users.last_name, users.profile_pic, resorts.resort_name");

        $this->db->from('guest_activities');

        $this->db->join('users', 'guest_activities.user_id=users.id', 'left');

        $this->db->join('resorts', 'guest_activities.activity_id=resorts.id', 'left');

        $this->db->where('guest_activities.notified_user', user_id());

        $this->db->order_by('guest_activities.id', 'DESC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function get_activities($params='', $limit=0, $offset=0, $data=array()) {

        $user_info           = user_info();

        $user_data_user_id   = array();

        $user_data_user_id[] = $user_info->id;

        if(!empty($user_info->parent_id)){

            $user_data_user_id[] = $user_info->parent_id;

        }

        $childs = $this->common_model->get_result('users', array('parent_id'=>$user_info->id), array('id'));

        if(!empty($childs)){

            foreach($childs as $child){

                $user_data_user_id[] = $child->id;

            }

        }

        $whereUser = "( guest_activities.notified_user IN (".implode(',', $user_data_user_id)." ))";

        $this->db->select("guest_activities.*, users.first_name, users.last_name, users.profile_pic, resorts.resort_name as item_name, resorts.id as resort_id, (select GROUP_CONCAT(".DB_PRE."images.image_name) FROM ".DB_PRE."images WHERE item_id = ".DB_PRE."resorts.id AND type = 'resort' ORDER BY id ASC) as activity_image, resorts.resort_description as activity_desc");

        $this->db->from('guest_activities');

        $this->db->join('users', 'guest_activities.user_id=users.id', 'left');

        $this->db->join('resorts', 'guest_activities.activity_id=resorts.id');

        $this->db->where($whereUser);

        $where = "( ( type = 'resorts_like' OR type = 'resorts_unlike')";

        if(!empty($params['search']['value']) && $params['draw'] !=1){

            $where .= " AND ( first_name LIKE '%".$params['search']['value']."%'  OR last_name LIKE '%".$params['search']['value']."%'  OR resort_name LIKE '%".$params['search']['value']."%' OR type LIKE '%".$params['search']['value']."%' )";

        }

        $where .= " )";

        $this->db->where($where);

        $query1 = $this->db->get_compiled_select();

        // Query #2 accommodation

        $this->db->select("guest_activities.*, users.first_name, users.last_name, users.profile_pic, accommodation.name_of_villa as item_name, accommodation.resort_id as resort_id, (select GROUP_CONCAT(".DB_PRE."images.image_name) FROM ".DB_PRE."images WHERE item_id = ".DB_PRE."accommodation.id AND type = 'accommodation' ORDER BY id ASC) as activity_image, accommodation.description as activity_desc");

        $this->db->from('guest_activities guest_activities');

        $this->db->join('users', 'guest_activities.user_id=users.id', 'left');

        $this->db->join('accommodation', 'guest_activities.activity_id=accommodation.id');

        $this->db->where($whereUser);

        $where = "( (type = 'accommodation_like' OR type = 'accommodation_unlike' )";

        if(!empty($params['search']['value']) && $params['draw'] !=1){

            $where .= " AND (`first_name` LIKE '%".$params['search']['value']."%'  OR `last_name` LIKE '%".$params['search']['value']."%'  OR `name_of_villa` LIKE '%".$params['search']['value']."%' OR `type` LIKE '%".$params['search']['value']."%' )";

        }

        $where .= " )";

        $this->db->where($where);

        $query2 = $this->db->get_compiled_select(); 

        // Query #3 dinnings

        $this->db->select("guest_activities.*, users.first_name, users.last_name, users.profile_pic, dinnings.name_of_restaurant as item_name, dinnings.resort_id as resort_id, (select GROUP_CONCAT(".DB_PRE."images.image_name) FROM ".DB_PRE."images WHERE item_id = ".DB_PRE."dinnings.id AND type = 'dinning' ORDER BY id ASC) as activity_image, dinnings.description as activity_desc");

        $this->db->from('guest_activities');

        $this->db->join('users', 'guest_activities.user_id=users.id', 'left');

        $this->db->join('dinnings', 'guest_activities.activity_id=dinnings.id');

        $this->db->where($whereUser);

        $where = "( (type = 'dining_unlike' OR type = 'dining_like' )";

        if(!empty($params['search']['value']) && $params['draw'] !=1){

            $where .= " AND (`first_name` LIKE '%".$params['search']['value']."%'  OR `last_name` LIKE '%".$params['search']['value']."%'  OR `name_of_restaurant` LIKE '%".$params['search']['value']."%' OR `type` LIKE '%".$params['search']['value']."%' )";

        }

        $where .= " )";

        $this->db->where($where);

        $query3 = $this->db->get_compiled_select(); 

        // Query #4 traveller_stories

        $this->db->select("guest_activities.*, users.first_name, users.last_name, users.profile_pic, traveller_stories.story_title as item_name, traveller_stories.resort_id as resort_id, (select GROUP_CONCAT(".DB_PRE."images.image_name) FROM ".DB_PRE."images WHERE item_id = ".DB_PRE."traveller_stories.id AND type = 'traveller_story' ORDER BY id ASC) as activity_image, traveller_stories.my_experience as activity_desc");

        $this->db->from('guest_activities');

        $this->db->join('users', 'guest_activities.user_id=users.id', 'left');

        $this->db->join('traveller_stories', 'guest_activities.activity_id=traveller_stories.id');

        $this->db->where($whereUser);

        $where = "( (type = 'traveller_story_unlike' OR type = 'traveller_story_like' OR type='traveller_story_share' OR type='traveller_story' )";

        if(!empty($params['search']['value']) && $params['draw'] !=1){

            $where .= " AND (first_name LIKE '%".$params['search']['value']."%'  OR last_name LIKE '%".$params['search']['value']."%'  OR story_title` LIKE '%".$params['search']['value']."%' OR `type` LIKE '%".$params['search']['value']."%' )";

        }

        $where .= " )";

        $this->db->where($where);

        $query4 = $this->db->get_compiled_select(); 

        // Query #5 traveller_stories_comment

        $this->db->select("guest_activities.*, users.first_name, users.last_name, users.profile_pic, traveller_stories_comments.comment_name as item_name, traveller_stories.resort_id as resort_id, (select GROUP_CONCAT(".DB_PRE."images.image_name) FROM ".DB_PRE."images WHERE item_id = ".DB_PRE."traveller_stories.id AND type = 'traveller_story' ORDER BY id ASC) as activity_image, traveller_stories.my_experience as activity_desc");

        $this->db->from('guest_activities');

        $this->db->join('users', 'guest_activities.user_id=users.id', 'left');

        $this->db->join('traveller_stories_comments', 'guest_activities.activity_id=traveller_stories_comments.id');

        $this->db->join('traveller_stories', 'traveller_stories_comments.story_id=traveller_stories.id');

        $this->db->where($whereUser);

        $where = "( (type = 'traveller_stories_comment' )";

        if(!empty($params['search']['value']) && $params['draw'] !=1){

            $where .= " AND (`first_name` LIKE '%".$params['search']['value']."%'  OR `last_name` LIKE '%".$params['search']['value']."%'  OR `comment_name` LIKE '%".$params['search']['value']."%' OR `type` LIKE '%".$params['search']['value']."%' ) ";

        }

        $where .= " )";

        $this->db->where($where);



        $query5 = $this->db->get_compiled_select(); 

        // Query #6 resort_stories

        $this->db->select("guest_activities.*, users.first_name, users.last_name, users.profile_pic, resort_stories.title as item_name, resort_stories.resort_id as resort_id, (select GROUP_CONCAT(".DB_PRE."images.image_name) FROM ".DB_PRE."images WHERE item_id = ".DB_PRE."resort_stories.id AND type = 'resort_story' ORDER BY id ASC) as activity_image, resort_stories.description as activity_desc");

        $this->db->from('guest_activities');

        $this->db->join('users', 'guest_activities.user_id=users.id', 'left');

        $this->db->join('resort_stories', 'guest_activities.activity_id=resort_stories.id');

        $this->db->where($whereUser);

        $where = "( (type = 'resort_story_unlike' OR type = 'resort_story_like' OR type='resort_story_share' OR type = 'resort_story' ) ";

        if(!empty($params['search']['value']) && $params['draw'] !=1){

            $where .= " AND ( `first_name` LIKE '%".$params['search']['value']."%'  OR `last_name` LIKE '%".$params['search']['value']."%'  OR `title` LIKE '%".$params['search']['value']."%' OR `type` LIKE '%".$params['search']['value']."%' ) ";

        }

        $where .= " )";

        $this->db->where($where);

        $query6 = $this->db->get_compiled_select();

        // Query #7 resort_stories_comment

        $this->db->select("guest_activities.*, users.first_name, users.last_name, users.profile_pic, resort_story_comments.comment_name as item_name, resort_stories.resort_id as resort_id, (select GROUP_CONCAT(".DB_PRE."images.image_name) FROM ".DB_PRE."images WHERE item_id = ".DB_PRE."resort_stories.id AND type = 'resort_story' ORDER BY id ASC) as activity_image, resort_stories.description as activity_desc");

        $this->db->from('guest_activities');

        $this->db->join('users', 'guest_activities.user_id=users.id', 'left');

        $this->db->join('resort_story_comments', 'guest_activities.activity_id=resort_story_comments.id');

        $this->db->join('resort_stories', 'resort_story_comments.resort_story_id=resort_stories.id');

        $this->db->where($whereUser);

        $where = "( (type = 'resort_stories_comment' ) ";

        if(!empty($params['search']['value']) && $params['draw'] !=1){

            $where .= " AND (`first_name` LIKE '%".$params['search']['value']."%'  OR `last_name` LIKE '%".$params['search']['value']."%'  OR `comment_name` LIKE '%".$params['search']['value']."%' OR `type` LIKE '%".$params['search']['value']."%' )";

        }

        $where .= " )";

        $this->db->where($where);

        $query7 = $this->db->get_compiled_select();  

        // Query #8 blog_unlike

        $this->db->select("guest_activities.*, users.first_name, users.last_name, users.profile_pic, news_blog.news_title as item_name, news_blog.id as resort_id, (select GROUP_CONCAT(".DB_PRE."images.image_name) FROM ".DB_PRE."images WHERE item_id = ".DB_PRE."news_blog.id AND type = 'blog' ORDER BY id ASC) as activity_image, news_blog.news_description as activity_desc");

        $this->db->from('guest_activities');

        $this->db->join('users', 'guest_activities.user_id=users.id', 'left');

        $this->db->join('news_blog', 'guest_activities.activity_id=news_blog.id');

        $this->db->where($whereUser);

        $where = "( (type = 'blog_unlike' OR type = 'blog_like' OR type='blog_share' )";

        if(!empty($params['search']['value']) && $params['draw'] !=1){

            $where .= " AND (`first_name` LIKE '%".$params['search']['value']."%'  OR `last_name` LIKE '%".$params['search']['value']."%'  OR `news_title` LIKE '%".$params['search']['value']."%' OR `type` LIKE '%".$params['search']['value']."%' )";

        }

        $where .= " )";

        $this->db->where($where);

        $query8 = $this->db->get_compiled_select();

        // Query #8 blog_comments

        $this->db->select("guest_activities.*, users.first_name, users.last_name, users.profile_pic, blog_comments.comment_name as item_name, blog_comments.new_blog_id as resort_id, (select GROUP_CONCAT(".DB_PRE."images.image_name) FROM ".DB_PRE."images WHERE item_id = ".DB_PRE."blog_comments.new_blog_id AND type = 'blog' ORDER BY id ASC) as activity_image, news_blog.news_description as activity_desc");

        $this->db->from('guest_activities');

        $this->db->join('users', 'guest_activities.user_id=users.id', 'left');

        $this->db->join('blog_comments', 'guest_activities.activity_id=blog_comments.id');

        $this->db->join('news_blog', 'blog_comments.new_blog_id=news_blog.id');

        $this->db->where($whereUser);

        $where = "( ( type = 'blog_comment' )";

        if(!empty($params['search']['value']) && $params['draw'] !=1){

            $where .= " AND (`first_name` LIKE '%".$params['search']['value']."%'  OR `last_name` LIKE '%".$params['search']['value']."%'  OR `comment_name` LIKE '%".$params['search']['value']."%' OR `type` LIKE '%".$params['search']['value']."%' ) ";

        }

        $where .= " )";

        $this->db->where($where);

        $query9 = $this->db->get_compiled_select();



        $this->db->select("guest_activities.*, users.first_name, users.last_name, users.profile_pic, traveller_stories.story_title as item_name, traveller_stories.resort_id as resort_id, (select GROUP_CONCAT(".DB_PRE."images.image_name) FROM ".DB_PRE."images WHERE item_id = ".DB_PRE."traveller_stories.id AND type = 'traveller_story' ORDER BY id ASC) as activity_image, traveller_stories.my_experience as activity_desc");

        $this->db->from('guest_activities');

        $this->db->join('users', 'guest_activities.user_id=users.id', 'left');

        $this->db->join('traveller_stories', 'guest_activities.activity_id=traveller_stories.id');

        $this->db->where($whereUser);

        $where = "(type = 'approve_traveller_story' )";

        $this->db->where($where);

        $query10 = $this->db->get_compiled_select(); 

        $where_codition = array();

        //$sql  = $query1;  

        $sql  = $query1." UNION ".$query2 ." UNION ".$query3 ." UNION ".$query4 ." UNION ".$query5 ." UNION ".$query6 ." UNION ".$query7 ." UNION ".$query8."  UNION ".$query9."  UNION ".$query10;  

        //$sql  = $query1." UNION ".$query2; 

        if(isset($params['order'][0]['column']) && $params['draw'] !=1){

            switch($params['order'][0]['column']) {

                case '1' :

                    $sql .= " ORDER BY id ".$params['order'][0]['dir']." ";

                    break;

                case '2' :

                    $sql .= " ORDER BY first_name ".$params['order'][0]['dir']." ";

                    break;

                case '3' :

                    $sql .= " ORDER BY type ".$params['order'][0]['dir']." ";

                    break;

                case '4' :

                    $sql .= " ORDER BY first_name ".$params['order'][0]['dir']." ";

                    break; 

                case '5' :

                    $sql .= " ORDER BY created_date ".$params['order'][0]['dir']." ";

                    break;               

                default:

                    $sql .= " ORDER BY id DESC ";

            }

        }else{

            $sql .= " ORDER BY id DESC ";

        }     

        if ($offset >= 0 && $limit > 0) {            

            $sql .= " LIMIT ".$offset.", ".$limit;

            //$where_codition

            $getdata = $this->db->query($sql);  

            //print_r($data);

            //echo $this->db->last_query(); exit();

            $num = $getdata->num_rows();

            if ($num) {

                $result['res'] = $getdata->result();

            } else {

                $result['res'] = array();

            }

            return $result;

        } else {

            $getdata = $this->db->query($sql);

            return $getdata->num_rows();

        }

    } 

    public function get_admin_traveller_stories_list($offSet = 0, $perPage = 0) {

        $this->db->select("traveller_stories.*, users.first_name, users.last_name, users.profile_pic, resorts.resort_name, traveller_categorys.category_name");

        $this->db->from('traveller_stories');

        $this->db->join('users', 'traveller_stories.user_id=users.id', 'left');

        $this->db->join('resorts', 'traveller_stories.resort_id=resorts.id', 'left');

        $this->db->join('traveller_categorys', 'traveller_stories.category_id=traveller_categorys.id', 'left');        

        if($this->input->get('story_id')){

            $this->db->order_by('traveller_stories.id', $this->input->get('story_id'));  

        }

        if($this->input->get('story_id')){

            $this->db->where('traveller_stories.id', $this->input->get('story_id'));  

        }

        if($this->input->get('user_name')){

            $user_names = explode(' ', $this->input->get('user_name'));

             $where_arr = array();

            if(!empty($user_names)){

                foreach($user_names as $user_name){

                    $where_arr[] = "users.first_name ='".$user_name."' OR users.last_name = '".$user_name."'"; 

                }

            }

            $this->db->where('( '.implode(' OR ', $where_arr).' )');  

        } 

        if($this->input->get('resort_name')){

            $this->db->like('resorts.resort_name', $this->input->get('resort_name'));  

        }

        if($this->input->get('resort_id')){

            $this->db->where('traveller_stories.resort_id', $this->input->get('resort_id'));  

        }

        if($this->input->get('order')){

            $this->db->order_by('traveller_stories.id', $this->input->get('order'));  

        }else{

            $this->db->order_by('traveller_stories.id', 'DESC');

        }

        //echo $this->db->last_query();

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_admin_resort_stories_list($offSet = 0, $perPage = 0) {

        $this->db->select("resort_stories.*, users.first_name, users.last_name, users.profile_pic, resorts.resort_name");

        $this->db->from('resort_stories');

        $this->db->join('users', 'resort_stories.user_id=users.id', 'left');

        $this->db->join('resorts', 'resort_stories.resort_id=resorts.id', 'left');

        $this->db->order_by('resort_stories.id', 'DESC');

        if($this->input->get('story_id')){

            $this->db->where('resort_stories.id', $this->input->get('story_id'));  

        }

        if($this->input->get('user_name')){

            $user_names = explode(' ', $this->input->get('user_name'));

             $where_arr = array();

            if(!!empty($user_names)){

                foreach($user_names as $user_name){

                    $where_arr[] = "users.first_name ='".$user_name."' OR users.last_name = '".$user_name."'"; 

                }

            }

            $this->db->where('( '.implode(' OR ', $where_arr).' )');  

        } 

        if($this->input->get('resort_name')){

            $this->db->like('resorts.resort_name', $this->input->get('resort_name'));  

        }

        if($this->input->get('resort_id')){

            $this->db->where('resort_stories.resort_id', $this->input->get('resort_id'));  

        }

        if($this->input->get('order')){

            $this->db->order_by('resort_stories.id', $this->input->get('order'));  

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_contributions() {

        $this->db->select("traveller_stories.*, users.first_name, users.last_name, users.profile_pic, resorts.resort_name, resorts.resort_logo, traveller_categorys.category_name, hear_by.hear_by as hear_by_title, accommodation.name_of_villa");

        $this->db->from('traveller_stories');

        $this->db->join('hear_by', 'traveller_stories.hear_by=hear_by.id', 'left');

        $this->db->join('users', 'traveller_stories.user_id=users.id', 'left');

        $this->db->join('resorts', 'traveller_stories.resort_id=resorts.id');

        $this->db->join('traveller_categorys', 'traveller_stories.category_id=traveller_categorys.id', 'left');

        $this->db->join('accommodation', 'traveller_stories.villa_id=accommodation.id', 'left');

        $this->db->where('traveller_stories.user_id', user_id());

        $this->db->order_by('traveller_stories.id', 'DESC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }    

    public function get_resort_stories_list() {

        $user_info           = user_info();

        $user_data_user_id   = array();

        $user_data_user_id[] = $user_info->id;

        if(!empty($user_info->parent_id)){

            $user_data_user_id[] = $user_info->parent_id;

        }

        $childs = $this->common_model->get_result('users', array('parent_id'=>$user_info->id), array('id'));

        if(!empty($childs)){

            foreach($childs as $child){

                $user_data_user_id[] = $child->id;

            }

        }

        $whereUser = "( resort_stories.user_id IN (".implode(',', $user_data_user_id)."))";

        $this->db->select("resort_stories.*, resorts.resort_name");

        $this->db->from('resort_stories resort_stories');

        $this->db->join('resorts', 'resort_stories.resort_id=resorts.id', 'left');

        $this->db->where($whereUser);

        $this->db->order_by('resort_stories.id', 'DESC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }  

    public function get_user_blogs_list() {

        $user_info           = user_info();

        $user_data_user_id   = array();

        $user_data_user_id[] = $user_info->id;

        if(!empty($user_info->parent_id)){

            $user_data_user_id[] = $user_info->parent_id;

        }

        $childs = $this->common_model->get_result('users', array('parent_id'=>$user_info->id), array('id'));

        if(!empty($childs)){

            foreach($childs as $child){

                $user_data_user_id[] = $child->id;

            }

        }

        $whereUser = "( news_blog.news_added_user IN (".implode(',', $user_data_user_id)."))";

        $this->db->select("news_blog.*");

        $this->db->from('news_blog news_blog');

        $this->db->where($whereUser);

        $this->db->order_by('news_blog.id', 'DESC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }  

    public function get_user_sub_admins_list() {

        $this->db->select("users.*");

        $this->db->from('users');

        $this->db->where('users.parent_id', user_id());

        $this->db->order_by('users.id', 'DESC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }        

    public function getResortStoryComments($resort_id='',$offSet = 0, $perPage = 0, $type="") {

        $this->db->select("resort_story_comments.*, users.first_name, users.last_name, users.profile_pic");

        $this->db->from('resort_story_comments');

        $this->db->join('users', 'resort_story_comments.user_id=users.id', 'left');

        if(!empty($resort_id)){

            $this->db->where('resort_story_comments.resort_story_id', $resort_id);

        }

        if(!empty($type)){

            $where  = "(resort_story_comments.status = 1 OR resort_story_comments.status= 2 OR resort_story_comments.status= 4)";

            $this->db->where($where);

        }else if($this->input->get('type')&&$this->input->get('type')=='all'){

            $where  = "(resort_story_comments.status = 1 OR resort_story_comments.status= 2 OR resort_story_comments.status= 4)";

            $this->db->where($where);

        }else{

            $this->db->where('resort_story_comments.status', 1);

        }

        $this->db->order_by('resort_story_comments.id', 'DESC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function getTravellerStories($offSet = 0, $perPage = 0) {

        $this->db->select("traveller_stories.*, users.first_name, users.last_name, users.profile_pic, resorts.resort_name, resorts.resort_logo, traveller_categorys.category_name");

        $this->db->from('traveller_stories');

        $this->db->join('users', 'traveller_stories.user_id=users.id', 'left');

        $this->db->join('resorts', 'traveller_stories.resort_id=resorts.id', 'left');

        $this->db->join('traveller_categorys', 'traveller_stories.category_id=traveller_categorys.id', 'left');

        if($this->input->get('story_id')){

            $this->db->where('traveller_stories.id', $this->input->get('story_id'));

        }

        if($this->input->get('user_name')){

            $user_names = explode(' ', $this->input->get('user_name'));

            $wheres = array();

            foreach($user_names as $user_name){

                $wheres[] = DB_PRE."users.first_name LIKE '%".$user_name."%' OR  ".DB_PRE."users.last_name LIKE '%".$user_name."%'";

            }

            $this->db->where("(".implode(' OR ', $wheres).")");

        }

        if($this->input->get('title')){

            $this->db->like('traveller_stories.story_title', $this->input->get('title'));

        }

        if($this->input->get('resort')){

            $this->db->like('resorts.resort_name', $this->input->get('resort'));

        }

        if (!empty($order)) {

            if ($order == 'NameAtoZ') {

                $this->db->order_by('traveller_stories.title', 'ASC');

            } else if ($order == 'NameZtoA') {

                $this->db->order_by('traveller_stories.title', 'DESC');

            } else if ($order == 'ASC') {

                $this->db->order_by('traveller_stories.id', 'ASC');

            } else {

                $this->db->order_by('traveller_stories.id', 'DESC');

            }

        } else {

            $this->db->order_by('traveller_stories.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_traveller_stories_details($story_id='') {

        $this->db->select("traveller_stories.*, users.first_name, users.last_name, users.profile_pic, resorts.resort_name, resorts.resort_logo, traveller_categorys.category_name, hear_by.hear_by as hear_by_title");

        $this->db->from('traveller_stories');

        $this->db->join('hear_by', 'traveller_stories.hear_by=hear_by.id', 'left');

        $this->db->join('users', 'traveller_stories.user_id=users.id', 'left');

        $this->db->join('resorts', 'traveller_stories.resort_id=resorts.id', 'left');

        $this->db->join('traveller_categorys', 'traveller_stories.category_id=traveller_categorys.id', 'left');

        $this->db->where('traveller_stories.id', $story_id);

        $this->db->order_by('traveller_stories.id', 'DESC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->row();

        } else {

            return false;

        }

    }

    public function getResortStories($offSet = 0, $perPage = 0) {

        $this->db->select("resort_stories.*, resorts.resort_name, users.first_name, users.last_name");

        $this->db->from('resort_stories');

        $this->db->join('resorts', 'resort_stories.resort_id=resorts.id', 'left');

        $this->db->join('users', 'resort_stories.user_id=users.id', 'left');

        if($this->input->get('story_id')){

            $this->db->where('resort_stories.id', $this->input->get('story_id'));

        }

        if($this->input->get('user_name')){

            $user_names = explode(' ', $this->input->get('user_name'));

            $wheres = array();

            foreach($user_names as $user_name){

                $wheres[] = DB_PRE."users.first_name LIKE '%".$user_name."%' OR  ".DB_PRE."users.last_name LIKE '%".$user_name."%'";

            }

            $this->db->where("(".implode(' OR ', $wheres).")");

        }

        if($this->input->get('title')){

            $this->db->like('resort_stories.title', $this->input->get('title'));

        }

        if($this->input->get('resort')){

            $this->db->like('resorts.resort_name', $this->input->get('resort'));

        }

        if (!empty($order)) {

            if ($order == 'NameAtoZ') {

                $this->db->order_by('resort_stories.title', 'ASC');

            } else if ($order == 'NameZtoA') {

                $this->db->order_by('resort_stories.title', 'DESC');

            } else if ($order == 'ASC') {

                $this->db->order_by('resort_stories.id', 'ASC');

            } else {

                $this->db->order_by('resort_stories.id', 'DESC');

            }

        } else {

            $this->db->order_by('resort_stories.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }    

    public function get_resort_stories_details($story_id='') {

        $this->db->select("resort_stories.*, resorts.resort_name, users.first_name, users.last_name");

        $this->db->from('resort_stories');

        $this->db->join('resorts', 'resort_stories.resort_id=resorts.id', 'left');

        $this->db->join('users', 'resort_stories.user_id=users.id', 'left');

        $this->db->where('resort_stories.id', $story_id);

        $this->db->order_by('resort_stories.id', 'DESC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->row();

        } else {

            return false;

        }

    } 

    public function get_blog_details($story_id='') {

        $this->db->select("news_blog.*, users.first_name, users.last_name, users.profile_pic");

        $this->db->from('news_blog');

        $this->db->join('users', 'news_blog.news_added_user=users.id', 'left');

        $this->db->where('news_blog.id', $story_id);

        $this->db->order_by('news_blog.id', 'DESC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->row();

        } else {

            return false;

        }

    } 

    public function getTravellerStoryComments($story_id='', $offSet = 0, $perPage = 0, $type='') {

        $this->db->select("traveller_stories_comments.*, users.first_name, users.last_name, users.profile_pic");

        $this->db->from('traveller_stories_comments');

        $this->db->join('users', 'traveller_stories_comments.user_id=users.id', 'left');

        if(!empty($story_id)){

            $this->db->where('traveller_stories_comments.story_id', $story_id);

        }

        if(!empty($type)){

            $where  = "(traveller_stories_comments.status = 1 OR traveller_stories_comments.status= 2 OR traveller_stories_comments.status= 4)";

            $this->db->where($where);

        }else if($this->input->get('type')&&$this->input->get('type')=='all'){

            $where  = "(traveller_stories_comments.status = 1 OR traveller_stories_comments.status= 2 OR traveller_stories_comments.status= 4)";

            $this->db->where($where);

        }else{

            $this->db->where('traveller_stories_comments.status', 1);

        }

        $this->db->order_by('traveller_stories_comments.id', 'DESC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_user_dinnings($resort_id='') {

        $this->db->select("dinnings.*, (SELECT GROUP_CONCAT(".DB_PRE."dinnings_type.dinnings_type SEPARATOR ', ') FROM ".DB_PRE."dinnings_type WHERE FIND_IN_SET(".DB_PRE."dinnings_type.id, ".DB_PRE."dinnings.restaurant_type)) as restaurant_type_txt, (SELECT GROUP_CONCAT(".DB_PRE."meal_plans.meal_plans_name SEPARATOR ', ') FROM ".DB_PRE."meal_plans WHERE FIND_IN_SET(".DB_PRE."meal_plans.id, ".DB_PRE."dinnings.meal_plans_applicable)) as meal_plans_txt, (SELECT GROUP_CONCAT(".DB_PRE."dress_codes.dress_code_title SEPARATOR ', ') FROM ".DB_PRE."dress_codes WHERE FIND_IN_SET(".DB_PRE."dress_codes.id, ".DB_PRE."dinnings.dress_code)) as dress_codes_txt");

        $this->db->from('dinnings');

        if(!empty($resort_id)){

           $this->db->where('dinnings.resort_id', $resort_id);

        }       

        $this->db->order_by('dinnings.priority_order', 'ASC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function restaurant_meal_served($dinning_id='') {

        $this->db->select("dinnings_meal_served.*, meal_served.meal_served_title, meals_styles.meals_styles_title");

        $this->db->from('dinnings_meal_served');

        $this->db->join('meal_served', 'dinnings_meal_served.meal_served_status=meal_served.id', 'left');

        $this->db->join('meals_styles', 'dinnings_meal_served.meal_type=meals_styles.id', 'left');

        if(!empty($dinning_id)){

           $this->db->where('dinnings_meal_served.dinning_id', $dinning_id);

        }       

        $this->db->order_by('dinnings_meal_served.id', 'ASC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function user_international_airports($resort_id='') {

        $this->db->select("international_airports.*, international_airport_type.airport_type_name, international_airport_type.image_name, international_airport_type.image_name_icon");

        $this->db->from('international_airports');

        $this->db->join('international_airport_type', 'international_airports.airport_type=international_airport_type.id', 'left');



        if(!empty($resort_id)){

           $this->db->where('international_airports.resort_id', $resort_id);

        }       

        $this->db->order_by('international_airports.id', 'ASC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

    public function user_international_airport_row($resort_id='', $airport_type='') {

        $this->db->select("international_airports.*, international_airport_type.airport_type_name, international_airport_type.image_name, international_airport_type.image_name_icon");

        $this->db->from('international_airports');

        $this->db->join('international_airport_type', 'international_airports.airport_type=international_airport_type.id', 'left');



        if(!empty($resort_id)){

           $this->db->where('international_airports.resort_id', $resort_id);

        } 

        if(!empty($airport_type)){

           $this->db->where('international_airports.airport_type', $airport_type);

        }       

        $this->db->order_by('international_airports.id', 'ASC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return $getdata->row();

        } else {

            return false;

        }

    }

    public function get_compair_resort($id_array = '', $in_data='') {

        $this->db->select('resorts.*, GROUP_CONCAT(sport.sport_name SEPARATOR ",") as sports_name');

        $this->db->from('resorts');

        $this->db->join('sport sport', 'resorts.sports = sport.id', 'left');

        if (!empty($id_array)):

            foreach ($id_array as $key => $value) {

                $this->db->where($key, $value);

            }

        endif;

        if(!empty($in_data)){

            $whereData = "resorts.id NOT IN(".$in_data.")";

            $this->db->where($whereData);

        }

        $this->db->group_by('resorts.id');

        $this->db->order_by('resort_name', 'ASC');

        $query = $this->db->get();

		//echo $this->db->last_query();

        if ($query->num_rows() > 0) return $query->result();

        else return FALSE;

    }

    public function get_caption($offSet = 0, $perPage = 0) {

        $this->db->select("captions.*");

        $this->db->from('captions');

        if($this->input->get('caption_id')){

           $this->db->where('captions.id', $this->input->get('caption_id'));

        }       

        if($this->input->get('caption_title')){

            $this->db->like("captions.caption_title", $this->input->get('caption_title'));

        } 

        if($this->input->get('start')) {

            $this->db->where("captions.created_date >", $this->input->get('start').' 00:00:00');

        }

        if($this->input->get('end')) {

            $this->db->where("captions.created_date <", $this->input->get('end').' 23:59:59');

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('captions.caption_title', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('captions.caption_title', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('captions.id', 'ASC');

            } else {

                $this->db->order_by('captions.id', 'DESC');

            }

        } else {

            $this->db->order_by('captions.id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_accommodation_user($accommodation_id='') {

        $this->db->select("resorts.user_id, resorts.id");

        $this->db->from('accommodation');

        
        $this->db->join('resorts', 'accommodation.resort_id=resorts.id', 'left');

        $this->db->where('accommodation.id', $accommodation_id);           

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->row();            

        } else {

            return false;

        }

    }

	public function get_exprience_user($exprience_id='') {

        $this->db->select("resorts.user_id, resorts.id");

        $this->db->from('activitie_excursions exprience');

        $this->db->join('resorts', 'exprience.resort_id=resorts.id', 'left');

        $this->db->where('exprience.id', $exprience_id);           

        $getdata = $this->db->get();

		//echo $this->db->last_query();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->row();            

        } else {

            return false;

        }

    }

    public function get_dining_user($dinning_id='') {

        $this->db->select("resorts.user_id, resorts.id");

        $this->db->from('dinnings');

        $this->db->join('resorts', 'dinnings.resort_id=resorts.id', 'left');

        $this->db->where('dinnings.id', $dinning_id);           

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->row();            

        } else {

            return false;

        }

    }

    public function get_story_user($story_id='') {

        $this->db->select("resorts.user_id, resorts.id");

        $this->db->from('traveller_stories');

        $this->db->join('resorts', 'traveller_stories.resort_id=resorts.id', 'left');

        $this->db->where('traveller_stories.id', $story_id);           

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->row();            

        } else {

            return false;

        }

    }

    public function get_resort_story_user($story_id='') {

        $this->db->select("resorts.user_id, resorts.id");

        $this->db->from('resort_stories');

        $this->db->join('resorts', 'resort_stories.resort_id=resorts.id', 'left');

        $this->db->where('resort_stories.id', $story_id);           

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->row();            

        } else {

            return false;

        }

    }

    public function get_related_user($user_id='') {

        $where = "(id IN(".$user_id."))";

        $this->db->select("users.first_name, users.email");

        $this->db->from('users');

        $this->db->where($where);           

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->result();            

        } else {

            return false;

        }

    }

    public function get_images() {

        if($this->input->get('type')&&$this->input->get('type')=='activity'){

            $this->db->select("activitie_excursions.*");

            $this->db->from('activitie_excursions'); 

            $this->db->where('activities_image !=', '');         

        }else{

            $this->db->select("images.*");

            $this->db->from('images');

            if($this->input->get('type')){

                $this->db->where('type', $this->input->get('type'));           

            } 

            $this->db->where('image_name !=', '');           

        }

        if($this->input->get('start')&&$this->input->get('limit')){

            $this->db->limit($this->input->get('limit'), $this->input->get('start'));           

        }else{

            $this->db->limit(10, 0);

        } 

        $getdata = $this->db->get();

        $num     = $getdata->num_rows();

        if ($num) {

            return $getdata->result();            

        } else {

            return false;

        }

    }

    public function get_traveller_story_row() {

        $this->db->select("users.first_name, users.last_name, users.email");

        $this->db->from('traveller_stories');

        $this->db->join('users', 'traveller_stories.user_id=users.id');     

        $this->db->where('traveller_stories.id', $this->input->post('story_id'));

        $this->db->order_by('traveller_stories.id', 'DESC');

        $getdata = $this->db->get();

        $num = $getdata->num_rows();

        if ($num) {

            return !empty($counters)?$getdata->num_rows():$getdata->row();

        } else {

            return false;

        }

    }

	public function inspiration_accommodation($offSet, $per_page) {
        //var_dump($this->input->post()); die;
		$resort_id =  $this->input->post('acc_resort')?$this->input->post('acc_resort'):'';
		
	    $arr_acc_cat_id=$this->input->post('acc_cat_id');
	    if(is_array($arr_acc_cat_id)){
		    $acc_cat_id =  $this->input->post('acc_cat_id')?implode(',',$arr_acc_cat_id):'';
	    }else{
		    $acc_cat_id =  $this->input->post('acc_cat_id')?$arr_acc_cat_id:'';
	    }

        $villa_types_where = $locations_where = $facilitys_where = array();      

        $this->db->select("accommodation.*, resort_category, resort_name,name_of_villa, state_name, resort_description,island_name, villa_type.villa_type as villa_type_name"); 

        $this->db->from('accommodation');

		$this->db->join('resorts', 'resorts.id = accommodation.resort_id', 'inner');

        $this->db->join('mal_states AS state', 'state.id = resorts.physical_state', 'inner');

        $this->db->join('villa_type', 'accommodation.villa_type = villa_type.id', 'inner');

        $this->db->join('mal_international_airports AS transfer', 'transfer.resort_id = resorts.id', 'left');

		if($resort_id!=''){

			$this->db->where('accommodation.resort_id', $resort_id);

		}
		
		if($acc_cat_id!=''){
			$this->db->where_in('accommodation.villa_type', $acc_cat_id);
		}

		if($this->input->post('acc_holidays')){

            $holidays = $this->input->post('acc_holidays');

            if(!empty($holidays)){

                foreach($holidays as $holiday){

                    $holiday_where[] = "  FIND_IN_SET('".$holiday."', ".DB_PRE."resorts.holiday_styles)";;

                }

            }

            $this->db->where("(".implode(' OR ', $holiday_where).")");

        }

		if($this->input->post('acc_category')){

            $categorys = $this->input->post('acc_category');

            if(!empty($categorys)){

                foreach($categorys as $category){

                    $categorys_where[] = " resorts.resort_category = '".$category."'";

                }

            }

            $this->db->where("(".implode(' OR ', $categorys_where).")");

        }

        if($this->input->post('acc_location')){

            $acc_location = $this->input->post('acc_location');

            if(!empty($acc_location)){

                foreach($acc_location as $location){

                    $acc_location_where[] = " resorts.physical_state = '".$location."'";

                }

            }

            $this->db->where("(".implode(' OR ', $acc_location_where).")");

        }

		if($this->input->post('acc_transfer')){

            $acc_transfer = $this->input->post('acc_transfer');

            if(!empty($acc_transfer)){
                //var_dump($acc_transfer);die();
                foreach($acc_transfer as $transfer){
                    //$acc_transfer_where[] = " transfer.airport_type = '".$transfer."'";
                    $acc_transfer_where[] = " FIND_IN_SET('".$transfer."', transfer.airport_type)";
                    //$airport_where[] = " FIND_IN_SET('".$airport."', ".DB_PRE."international_airports.airport_type)";
                }
            }
            //var_dump($acc_transfer_where);die();
            //$this->db->where("(".implode(' OR ', $airport_where).")");
            $this->db->where("(".implode(' OR ', $acc_transfer_where).")");
        }
        
        // echo $this->db->last_query();
        // die();
        
		if($this->input->post('acc_facility')){

            $acc_facility = $this->input->post('acc_facility');

            if(!empty($acc_facility)){

                foreach($acc_facility as $facility){

                    $facility_where[] = "  FIND_IN_SET('".$facility."', ".DB_PRE."accommodation.facilities)";                    

                }

            }

            $this->db->where("(".implode(' OR ', $facility_where).")");

        } 
        
        if($this->input->post('acc_sports')){

            $acc_sports = $this->input->post('acc_sports');

            if(!empty($acc_sports)){

                foreach($acc_sports as $sport){

                    $sport_where[] = " FIND_IN_SET('".$sport."', ".DB_PRE."resorts.sports)";

                }

            }

            $this->db->where("(".implode(' OR ', $sport_where).")");

        }

        if($this->input->post('room_count')){

            $max_room_count = $this->input->post('room_count');

            if($max_room_count > 0) {
                
                $room_count_where[] = " accommodation.number_of_rooms_per_villa <= '".$max_room_count."'";
                
		        $this->db->where("(".implode('', $room_count_where).")");
            }
		}

		if($this->input->post('acc_room_count') || $this->input->post('villa_rooms')){
            if(!empty($this->input->post('villa_rooms'))){
                $min_room_count = $this->input->post('villa_rooms')?$this->input->post('villa_rooms'):'';
                if($min_room_count !='') {
        			if(isset($min_room_count) && $min_room_count!="") {
                        if($min_room_count=="10+") {
                            //$room_count_where = " resorts.total_no_villas >= 10";
                            $room_count_where = " accommodation.number_of_rooms_per_villa >= '".$min_room_count."'";
                            
                        } else {
                            //$room_count_where = " resorts.total_no_villas <= ".$min_room_count;
                            $room_count_where = " accommodation.number_of_rooms_per_villa = '".$min_room_count."'";
                        }
        			}
        			 $this->db->where($room_count_where);
        
        		}
            }
            elseif(!empty($this->input->post('acc_room_count'))){
                //var_dump(explode(",",$this->input->post('acc_room_count'))); die;
                $room_array = explode(",",$this->input->post('acc_room_count'));
                $min_room_count = min($room_array);
                $max_room_count = max($room_array);
                if(isset($min_room_count) && $max_room_count<151){
                    $room_count_where[] = " resorts.total_no_villas > ".$min_room_count;
                }
                if(isset($max_room_count))
                $room_count_where[] = " resorts.total_no_villas < ".$max_room_count;
                $this->db->where("(".implode(' AND ', $room_count_where).")");
            }
            elseif(!empty($this->input->post('acc_room_count')) && !empty($this->input->post('villa_rooms'))) {
                $room_array = explode(",",$this->input->post('acc_room_count'));
                $min_room_count = min($room_array);
                $max_room_count = max($room_array);
                if(isset($min_room_count) && $max_room_count<151){
                    $room_count_where[] = " resorts.total_no_villas > ".$min_room_count;
                }
                if(isset($max_room_count))
                $room_count_where[] = " resorts.total_no_villas < ".$max_room_count;
                $this->db->where("(".implode(' AND ', $room_count_where).")");
            }

		}
		
        //$getdata = $this->db->get();
        //echo $this->db->last_query();exit();
        
        if($this->input->post('villa_types')){

            $villa_types = $this->input->post('villa_types');

            if(!empty($villa_types)){

                foreach($villa_types as $villa_type){

                    $villa_types_where[] = " accommodation.villa_type = '".$villa_type."'";

                }

            }

            $this->db->where("(".implode(' OR ', $villa_types_where).")");

        }

        if($this->input->post('villa_locations')){

            $villa_locations = $this->input->post('villa_locations');

            if(!empty($villa_locations)){

                foreach($villa_locations as $villa_location){

                    $locations_where[] = " accommodation.villa_location = '".$villa_location."'";

                }

            }

            $this->db->where("(".implode(' OR ', $locations_where).")");

        }

        if($this->input->post('amenities')){

            $amenities = $this->input->post('amenities');

            if(!empty($amenities)){

                foreach($amenities as $amenity){

                    $amenities_where[] = "  FIND_IN_SET('".$amenity."', ".DB_PRE."accommodation.amenities)";                    

                }

            }

            $this->db->where("(".implode(' OR ', $amenities_where).")");

        } 

		$this->db->order_by('accommodation.created_at', 'DESC');
        

		
		if ($offSet >= 0 && $per_page > 0) {
            
            // $getdata = $this->db->get();
            // echo $this->db->last_query();exit();
            // echo $per_page."\n";
            // echo $offSet;
            // die();
            $this->db->limit($per_page, $offSet);
            $this->db->group_by('accommodation.id');
            $getdata = $this->db->get();
            //echo $this->db->last_query();exit();

            $num = $getdata->num_rows();
            
            if ($num) {
                //echo $this->db->last_query();

                return $getdata->result();

            } else {
                //echo $this->db->last_query();
                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

	// Exprience

	public function inspiration_experience($limit=0,$offset=0) {
	 
// 		$resort_id =  $this->input->post('exp_resort')?$this->input->post('exp_resort'):'';

		$resort_id =  $this->input->post('resort_id')?$this->input->post('resort_id'):'';

		$exp_cat_id = $this->input->post('exp_cat_id')?$this->input->post('exp_cat_id'):'';

        $villa_types_where = $locations_where = $facilitys_where = array();      

        $this->db->select("experience.*,resort_name,state_name,resort_category,resort_description,island_name,brand_name"); 

        $this->db->from('activitie_excursions as experience');

		$this->db->join('resorts', 'resorts.id = experience.resort_id', 'left');

        $this->db->join('mal_states AS state', 'state.id = resorts.physical_state', 'left');

        $this->db->join('mal_brand AS brand', 'brand.id = resorts.brand_id', 'left');

		 $this->db->join('mal_international_airports AS transfer', 'transfer.resort_id = resorts.id', 'left');

// 		if($resort_id!=''){

// 			$this->db->where('experience.resort_id', $resort_id);

// 		}

		if($exp_cat_id!=''){

			$expcat_where[] = "  FIND_IN_SET('".$exp_cat_id."', experience.experience_category)";;

			$this->db->where("(".implode(' OR ', $expcat_where).")");

		}

		if($this->input->post('exp_holidays')){

            $holidays = $this->input->post('exp_holidays');

            if(!empty($holidays)){

                foreach($holidays as $holiday){

                    $holiday_where[] = "  FIND_IN_SET('".$holiday."', ".DB_PRE."resorts.holiday_styles)";;

                }

            }

            $this->db->where("(".implode(' OR ', $holiday_where).")");

        }

		if($this->input->post('exp_category')){

            $categorys = $this->input->post('exp_category');

            if(!empty($categorys)){

                foreach($categorys as $category){

                    $categorys_where[] = " resorts.resort_category = '".$category."'";

                }

            }

            $this->db->where("(".implode(' OR ', $categorys_where).")");

        }

// 		if($this->input->post('exp_transfer')){

//             $exp_transfer = $this->input->post('exp_transfer');

//             if(!empty($exp_transfer)){

//                 foreach($exp_transfer as $airport){

//                     $airport_where[] = " international_airports.airport_type = '".$airport."'";

//                 }

//             }            

//             $airport_where = $this->get_airport_resort($airport_where);

//             $mealStatus    = 'yes';

//         } 

		if(!empty($airport_where)){

            $airport_where_txt = " resorts.id IN(".$airport_where.")";

            $this->db->where($airport_where_txt);

        }

		if($this->input->post('exp_location')){

            $exp_location = $this->input->post('exp_location');

            if(!empty($exp_location)){

                foreach($exp_location as $location){

                    $exp_location_where[] = " resorts.physical_state = '".$location."'";

                }

            }

            $this->db->where("(".implode(' OR ', $exp_location_where).")");

        }

		if($this->input->post('exp_transfer')){
            $exp_transfer = $this->input->post('exp_transfer');
            if(!empty($exp_transfer)){
                foreach($exp_transfer as $transfer){
                    $exp_transfer_where[] = "  FIND_IN_SET('".$transfer."', transfer.airport_type)";;
                    //$exp_transfer_where[] = " transfer.airport_type = '".$transfer."'";
                }
            }
            $this->db->where("(".implode(' OR ', $exp_transfer_where).")");
            $mealStatus    = 'yes';
        }
        
		if($this->input->post('exp_facility')){

            $exp_facility = $this->input->post('exp_facility');

            if(!empty($exp_facility)){

                foreach($exp_facility as $facility){

                    $facility_where[] = "  FIND_IN_SET('".$facility."', ".DB_PRE."resorts.facilities)";                    

                }

            }

            $this->db->where("(".implode(' OR ', $facility_where).")");

        } 

		if($this->input->get('exp_sports')){

            $exp_sports = $this->input->get('exp_sports');

            if(!empty($exp_sports)){

                foreach($exp_sports as $sport){

                    $sport_where[] = " FIND_IN_SET('".$sport."', ".DB_PRE."resorts.sports)";

                }

            }

            $this->db->where("(".implode(' OR ', $sport_where).")");

        }
        
        if($this->input->post('exp_room_count')!="") {  
            //var_dump(explode(',',$this->input->post('exp_room_count'))); die;
            $room_array = explode(',',$this->input->post('exp_room_count'));
            $min_room_count = min($room_array);
            $max_room_count = max($room_array);
            if(isset($min_room_count) && $max_room_count<151){
                $room_count_where[] = " resorts.total_no_villas > ".$min_room_count;
            }
            if(isset($max_room_count))
            $room_count_where[] = " resorts.total_no_villas < ".$max_room_count;
            $this->db->where("(".implode(' AND ', $room_count_where).")");
        }

       	$this->db->group_by('experience.id');
		
		$this->db->order_by('experience.id', 'ASC');
        

        if($offset >= 0 && $limit > 0){
            $this->db->limit($limit, $offset);
        }
        
        // $getdata = $this->db->get();
        // echo $this->db->last_query();exit();
        
        $getdata = $this->db->get();
        $num = $getdata->num_rows();
        
        if(!empty($counter)){
            return $num;
        }else if ($num) {
            return $getdata->result();
        } else {
            return false;
        }
    }

	public function resort_experience($offSet = 0, $perPage = 0) {
		$resort_id =  $this->input->post('resort_id')?$this->input->post('resort_id'):'';

        $this->db->select("experience.*,resort_name,state_name,resort_category,resort_description,island_name,brand_name"); 

        $this->db->from('activitie_excursions as experience');

		$this->db->join('resorts', 'resorts.id = experience.resort_id', 'left');

        $this->db->join('mal_states AS state', 'state.id = resorts.physical_state', 'left');

        $this->db->join('mal_brand AS brand', 'brand.id = resorts.brand_id', 'left');

		 $this->db->join('mal_international_airports AS transfer', 'transfer.resort_id = resorts.id', 'left');

		if($resort_id!=''){

			$this->db->where('experience.resort_id', $resort_id);

		}


       	$this->db->group_by('experience.id');

		$this->db->order_by('experience.id', 'ASC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }


    }

    public function inspiration_experience2() {

        $resort_id =  $this->input->post('resort_id');

        $exp_cat_id = $this->input->post('category_id');



        $villa_types_where = $locations_where = $facilitys_where = array();      

        $this->db->select("experience.*,resort_name,state_name,resort_category,resort_description,island_name,brand_name"); 

        $this->db->from('activitie_excursions as experience');

        $this->db->join('resorts', 'resorts.id = experience.resort_id', 'left');

        $this->db->join('mal_states AS state', 'state.id = resorts.physical_state', 'left');

        $this->db->join('mal_brand AS brand', 'brand.id = resorts.brand_id', 'left');

         $this->db->join('mal_international_airports AS transfer', 'transfer.resort_id = resorts.id', 'left');

        if($resort_id!=''){

            $this->db->where('experience.resort_id', $resort_id);

        }

        if($exp_cat_id!=''){

            $category_id=explode(',',$exp_cat_id);   

            foreach ($category_id as $ckey => $cvalue) {

            $expcat_where[] = "  FIND_IN_SET('".$cvalue."', experience.experience_category)";

                $this->db->where("(".implode(' OR ', $expcat_where).")");

            }

        }



        $this->db->group_by('experience.id');

        $this->db->order_by('experience.id', 'ASC');

        if(!empty($limit)){

            $this->db->limit($limit, 0);

        }

        $getdata = $this->db->get();

        //echo $this->db->last_query();die;

        $num     = $getdata->num_rows();

        

        if(!empty($counter)){

            return $num;

        }else if ($num) {

            return $getdata->result();

        } else {

            return false;

        }

    }

	public function get_compare_villa($id_array = '', $in_data='') { 

        $this->db->select('acc.id,acc.name_of_villa,GROUP_CONCAT(acc.room_size," ", "sqm,",acc.number_of_rooms_per_villa," ","Bedroom"," ","Villa,", villatype.villa_type) as villa_type_name');

        $this->db->from('accommodation as acc');

        $this->db->join('villa_type villatype', 'villatype.id = acc.villa_type', 'left');

	    if (!empty($id_array)):

            foreach ($id_array as $key => $value) {

                $this->db->where($key, $value);

            }

        endif;

        if(!empty($in_data)){

            $whereData = "acc.id NOT IN(".$in_data.")";

            $this->db->where($whereData);

        }

		$min_room_count = $this->input->get('villa_rooms')?$this->input->get('villa_rooms'):'';
        

		//$max_room_count = $this->input->post('room_max_val')?$this->input->post('room_max_val'):'';

		if($min_room_count !=''){

			if(isset($min_room_count) && $min_room_count!=""){
                if($min_room_count=="10+") {
                    $room_count_where = " acc.number_of_rooms_per_villa >= 10";
                } else {
                    $room_count_where = " acc.number_of_rooms_per_villa = ".$min_room_count;
                }
			}
			 $this->db->where($room_count_where);

		}

		

        $this->db->group_by('acc.id');

        $this->db->order_by('name_of_villa', 'ASC');

        $query = $this->db->get();

	    //echo $this->db->last_query();
        //die;

        if ($query->num_rows() > 0) return $query->result();

        else return FALSE;

    }

	public function get_faq($offSet = 0, $perPage = 0) {

        $this->db->select("*");

        $this->db->from('faq');

        $this->db->order_by('faq_id', 'DESC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }
    
    public function get_inspiration($offSet = 0, $perPage = 0) {

        $this->db->select("*");

        $this->db->from('inspiration');

        $this->db->order_by('id', 'DESC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();


            if ($getdata) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }
   
    public function get_admin_accommodation($offSet = 0, $perPage = 0) {
      
        $this->db->select("*");

        $this->db->from('mal_admin_accommodation');

        $this->db->order_by('id', 'DESC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();


            if ($getdata) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

    public function get_admin_experience($offSet = 0, $perPage = 0) {

        $this->db->select("*");

        $this->db->from('mal_admin_exeperince');

        $this->db->order_by('id', 'DESC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();


            if ($getdata) {

                return $getdata->result();

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

	// Travel Partner

	public function get_travel_partner($offSet = 0, $perPage = 0) {

        $this->db->select("travel_partner.*");

        $this->db->from('travel_partner');

        $this->db->order_by('travel_partner.travel_partner_id', 'DESC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

	// Airport

	public function get_airport($offSet = 0, $perPage = 0) {

        $this->db->select("maldives_airports.*");

        $this->db->from('maldives_airports');

        $this->db->order_by('maldives_airports.airport_id', 'DESC'); 

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

	// Airlines

	public function get_airlines($offSet = 0, $perPage = 0) {

        $this->db->select("airlines_travling.*");

        $this->db->from('airlines_travling');

        $this->db->order_by('airlines_travling.airlines_id', 'DESC');

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }

	public function galllery_images($perPage,$offSet){

		

		$this->db->select("*");

        $this->db->from('images');

        $this->db->where('type', 'resort');
        
      	$this->db->order_by('id', 'DESC');

		//$this->db->group_by('images.item_id');

        $this->db->limit($perPage, $offSet);

		$getdata = $this->db->get();

		$num = $getdata->num_rows();

		//echo $this->db->last_query();die;

		if ($num) {

			$data = $getdata->result();

			return $data;

		} else {

			return false;

		}

	}

	public function get_experience_category($offSet = 0, $perPage = 0) {

        $this->db->select("experience_category.*");

        $this->db->from('experience_category');

        $this->db->where("experience_category.status !=", 3); 

        if($this->input->get('exp_cat_id')){

           $this->db->where('experience_category.exp_cat_id', $this->input->get('exp_cat_id'));

        }       

        if($this->input->get('exp_cat_name')){

            $this->db->like("experience_category.exp_cat_name", $this->input->get('exp_cat_name'));

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('experience_category.exp_cat_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('experience_category.exp_cat_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('experience_category.exp_cat_id', 'ASC');

            } else {

                $this->db->order_by('experience_category.exp_cat_id', 'DESC');

            }

        } else {

            $this->db->order_by('experience_category.exp_cat_id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }
    
    
    public function get_blog_category($offSet = 0, $perPage = 0) {

        $this->db->select("blog_category.*");

        $this->db->from('blog_category');

        $this->db->where("blog_category.status", 1); 

        if($this->input->get('blog_cat_id')){

           $this->db->where('blog_category.blog_cat_id', $this->input->get('blog_cat_id'));

        }       

        if($this->input->get('blog_cat_name')){

            $this->db->like("blog_category.blog_cat_name", $this->input->get('blog_cat_name'));

        }

        if ($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('blog_category.blog_cat_name', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('blog_category.blog_cat_name', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('blog_category.blog_cat_id', 'ASC');

            } else {

                $this->db->order_by('blog_category.blog_cat_id', 'DESC');

            }

        } else {

            $this->db->order_by('blog_category.blog_cat_id', 'DESC');

        }

        if ($offSet >= 0 && $perPage > 0) {

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();
            return $getdata->num_rows();

        }

    }

	public function get_experience($resort_id,$exp_cat_id){

		 

		$sql = " SELECT `act`.*, `resort_name`, `state_name`, `resort_category`, `resort_description`, `island_name`

		FROM `mal_activitie_excursions` as `act`

		INNER JOIN `mal_resorts` AS `resorts` ON `resorts`.`id` = `act`.`resort_id`

		INNER JOIN `mal_states` AS `state` ON `state`.`id` = `resorts`.`physical_state`

		WHERE `resort_id` = '".$resort_id."' AND FIND_IN_SET('".$exp_cat_id."', act.experience_category)

		GROUP BY `act`.`id`

		ORDER BY `act`.`id`

		LIMIT 6";

		$record    		= $this->db->query($sql);

		$get_record 	= $record->result();	

		return $get_record; 

	 }

    public function getblogdetails($offSet = 0, $perPage = 0) {

        $this->db->select("news_blog_details.*,news_blog.news_title");

        $this->db->from('news_blog_details');

        $this->db->join('news_blog', 'news_blog.id=news_blog_details.news_blog_id'); 

        if($this->input->get('news_blog_id')){

           $this->db->where('news_blog_details.news_blog_id', $this->input->get('news_blog_id'));

        }

         if($this->input->get('newsblogdetails_id')){

           $this->db->where('news_blog_details.newsblogdetails_id', $this->input->get('newsblogdetails_id'));

        }

        if($this->input->get('banner_title')){

           $this->db->where('news_blog_details.banner_title', $this->input->get('banner_title'));

        } 

        if($this->input->get('news_title')){

            $this->db->like("news_blog.news_title", $this->input->get('news_title'));

        }

        if($this->input->get('order')) {

            if ($this->input->get('order') == 'NameAtoZ') {

                $this->db->order_by('news_blog.news_title', 'ASC');

            } else if ($this->input->get('order') == 'NameZtoA') {

                $this->db->order_by('news_blog.news_title', 'DESC');

            } else if ($this->input->get('order') == 'ASC') {

                $this->db->order_by('news_blog_details.newsblogdetails_id', 'ASC');

            } else {

                $this->db->order_by('news_blog_details.newsblogdetails_id', 'DESC');

            }

        }else{

            $this->db->order_by('news_blog_details.newsblogdetails_id', 'DESC');

        }

        if($offSet >= 0 && $perPage > 0){

            $this->db->limit($perPage, $offSet);

            $getdata = $this->db->get();

            $num = $getdata->num_rows();

            if ($num) {

                $data = $getdata->result();

                return $data;

            } else {

                return false;

            }

        } else {

            $getdata = $this->db->get();

            return $getdata->num_rows();

        }

    }
    
    public function get_resorts_list() {

        
        $this->db->select("resort_name,id");
        $this->db->from('mal_resorts');
        $this->db->where('admin_approved', 1);
        $this->db->where('status', 1);
        $this->db->order_by('resort_name', 'ASC');
        $getdata = $this->db->get();
        $num = $getdata->num_rows();
        if ($num) {
            $data = $getdata->result();
            return $data;
        }
    }
    
    public function get_acco_Count($resort_id) {

        $this->db->select("id");
        $this->db->from('accommodation');
        $this->db->where('resort_id', $resort_id);
        $getdata = $this->db->get();
        $num = $getdata->num_rows();
        if ($num) {
            return $num;
        }
    }
    
    public function get_recent_blogs($custags="") {
        $this->db->select("news_blog.*, CONCAT(".DB_PRE."admin_users.first_name, ' ', ".DB_PRE."admin_users.last_name) AS user_name");

        $this->db->join('admin_users', 'news_blog.news_added_user=admin_users.id', 'left'); 

        $this->db->from('news_blog');

        $this->db->where("news_blog.status !=", 3);
        $this->db->like('tags', $custags);

        $this->db->order_by('news_blog.id', 'DESC');



        $getdata = $this->db->get();

        return $getdata->result_array();

    }
    
    public function get_similar_blogs($category="") {
        $this->db->select("news_blog.*, CONCAT(".DB_PRE."admin_users.first_name, ' ', ".DB_PRE."admin_users.last_name) AS user_name");

        $this->db->join('admin_users', 'news_blog.news_added_user=admin_users.id', 'left'); 

        $this->db->from('news_blog');

        $this->db->where("news_blog.status !=", 3);
        $this->db->where('blog_category', $category);

        $this->db->order_by('news_blog.id', 'DESC');



        $getdata = $this->db->get();

        return $getdata->result_array();

    }
}