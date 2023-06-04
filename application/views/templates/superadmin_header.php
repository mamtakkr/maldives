<?php 

$segment1   =   $this->uri->segment(2);

$segment2   =   $this->uri->segment(3);

$segment3   =   $this->uri->segment(4);

if(!empty($segment2)){

  $urlSegment = strtolower($segment1)."/".strtolower($segment2);

}else{

  $urlSegment = strtolower($segment1);

}

if($segment1=='cms'){

  $urlSegment .= '/'.strtolower($segment3);

}

$urlSegment = str_replace('/index', '', $urlSegment);

//echo $urlSegment; exit();

$site_title = site_info('site_title');

$admin_type = admin_type();

$admin_text = 'Maldives Admin';

if($admin_type==1) $admin_text = 'Developer admin';

if($admin_type==2) $admin_text = 'Admin';

if(!empty($admin_type)&&$admin_type!=1){

  $sub_admin_module = site_info('sub_admin_access');

  $sub_admin_modules = explode(',', $sub_admin_module);

  if(!in_array($urlSegment, $sub_admin_modules)){

    redirect(ADMIN_URL.'superadmin/dashboard');

  }

}

//echo $main_module_param; exit();

switch($urlSegment){    



  case 'hear_by/add_hear_by':        

    $hear_byMainAct       = $add_hear_by = 'active';         

    $title                = 'Add hear by | '.$site_title;

    break;  

  case 'hear_by':        

    $hear_byMainAct       = $hear_by = 'active';         

    $title                = 'Hear by list  | '.$site_title;

    break;   

  case 'openings/add_opening':        

    $openingsMainAct      = $add_opening = 'active';         

    $title                = 'Add Opening | '.$site_title;

    break;  

  case 'openings':        

    $openingsMainAct      = $openings = 'active';         

    $title                = 'Openings List  | '.$site_title;

    break;   

  case 'superadmin/profile':

    $dashboardAct         = 'active';         

    $title                = 'Profile  | '.$site_title;

    break; 

  case 'superadmin/change_password':

    $dashboardAct         = 'active';         

    $title                = 'Change Password  | '.$site_title;

    break;   

  case 'customer/users':        

    $usersMainAct         = $buyer = 'active';         

    $title                = 'Users List  | '.$site_title;

    break;

  case 'customer/hotels':        

    $usersMainAct         = $hotel = 'active';         

    $title                = 'Hotel List  | '.$site_title;

    break;

  case 'resorts':        

    $resortsMainAct        = 'active';         

    $title                 = 'Resorts List  | '.$site_title;

    break;

  case 'resorts/index':        

    $resortsMainAct        = 'active';         

    $title                 = 'Resorts List  | '.$site_title;

    break; 

 

//   case 'resorts/index':        

//     $resortsMainAct        = 'active';         

//     $title                 = 'Resorts List  | '.$site_title;

//     break; 

  case 'resorts/traveller_story':        

    $traveller_storyMainAct = 'active';         

    $title                  = 'Traveller Story List  | '.$site_title;

    break;

  case 'resorts/resort_story':        

    $resort_storyMainAct = $resort_storyAct = 'active';         

    $title                  = 'Resort Story List  | '.$site_title;

    break;

   case 'resorts/add_resort_story':        

    $resort_storyMainAct    = $add_resort_story =  'active';         

    $title                  = 'Add Resort Story  | '.$site_title;

    break;

  case 'emailtemplate/addemailtemplate':        

    $emailtemplateMainAct  = 'active';         

    $title                 = 'Email Template  | '.$site_title;

    break;

  case 'emailtemplate':        

    $emailtemplateMainAct  = 'active';         

    $title                 = 'Email Template  | '.$site_title;

    break; 

  case 'resorts/villalist':        

    $resortDataMainAct    = $villaMainAct =  $villlist = 'active';         

    $title                = 'Villa list  | '.$site_title;

    break; 

  case 'brands':        

    $resortDataMainAct    = $brandMainAct =  $brands = 'active';         

    $title                = 'Brand List  | '.$site_title;

    break;

  case 'brands/index':        

    $resortDataMainAct    = $brandMainAct =  $brands = 'active';         

    $title                = 'Brand List  | '.$site_title;

    break;   

  case 'brands/addbrand':        

    $resortDataMainAct    = $brandMainAct =  $add_brand  = 'active';         

    $title                = 'Add brand  | '.$site_title;

    break;  

  case 'atolls':        

    $resortDataMainAct    = $atollsMainAct =  $atolls = 'active';         

    $title                = 'Atolls List  | '.$site_title;

    break;

  case 'atolls/index':        

    $resortDataMainAct    = $atollsMainAct =  $atolls = 'active';         

    $title                = 'Atolls List  | '.$site_title;

    break;   

  case 'atolls/addatoll':        

    $resortDataMainAct    = $atollsMainAct =  $add_atoll  = 'active';         

    $title                = 'Add  Atoll  | '.$site_title;

    break;  

  case 'affiliations':        

    $resortDataMainAct    = $affiliationsMainAct =  $affiliations = 'active';         

    $title                = 'Affiliation List  | '.$site_title;

    break;

  case 'affiliations/index':        

    $resortDataMainAct    = $affiliationsMainAct =  $affiliations = 'active';         

    $title                = 'Affiliation List  | '.$site_title;

    break;   

  case 'affiliations/addaffiliation':        

    $resortDataMainAct    = $affiliationsMainAct =  $add_affiliation  = 'active';         

    $title                = 'Add Affiliation  | '.$site_title;

    break;  

  case 'categorys':        

    $resortDataMainAct    = $categorysMainAct =  $categorysAct = 'active';         

    $title                = 'Category List  | '.$site_title;

    break;

  case 'categorys/index':        

    $resortDataMainAct    = $categorysMainAct =  $categorysAct = 'active';         

    $title                = 'Category List  | '.$site_title;

    break;   

  case 'categorys/add_category':        

    $resortDataMainAct    = $categorysMainAct =  $add_category  = 'active';         

    $title                = 'Add Category  | '.$site_title;

    break;       

  case 'transfer_modes':        

    $resortDataMainAct    = $transfer_modesMainAct =  $transfer_modes = 'active';         

    $title                = 'Transfer Mode List  | '.$site_title;

    break;

  case 'transfer_modes/index':        

    $resortDataMainAct    = $transfer_modesMainAct =  $transfer_modes = 'active';         

    $title                = 'Transfer Mode List  | '.$site_title;

    break;   

  case 'transfer_modes/add_transfer_mode':        

    $resortDataMainAct    = $transfer_modesMainAct =  $add_transfer_mode  = 'active';         

    $title                = 'Add Transfer Mode  | '.$site_title;

    break;  

  case 'distance_places':        

    $distance_placesMainAct =  $distance_places = 'active';         

    $title                = 'Distance places | '.$site_title;

    break;

  case 'distance_places/index':        

    $distance_placesMainAct =  $distance_places = 'active';         

    $title                = 'Distance places | '.$site_title;

    break;   

  case 'distance_places/add_distance_place':        

    $distance_placesMainAct =  $add_distance_places  = 'active';         

    $title                = 'Add Distance place  | '.$site_title;

    break;  

  case 'villa_types':        

    $resortDataMainAct    = $villa_typesMainAct =  $villa_types = 'active';         

    $title                = 'Transfer Mode List  | '.$site_title;

    break;

  case 'villa_types/index':        

    $resortDataMainAct    = $villa_typesMainAct =  $villa_types = 'active';         

    $title                = 'Villa Type List  | '.$site_title;

    break;   

  case 'villa_types/add_villa_type':        

    $resortDataMainAct    = $villa_typesMainAct =  $add_villa_type  = 'active';         

    $title                = 'Add Villa Type  | '.$site_title;

    break;  

  case 'experience_category/index':        

    $resortDataMainAct    = $experience_categoryMainAct =  $experience_category = 'active';         

    $title                = 'Experience Category List  | '.$site_title;

    break;   

  case 'blog_category/index':        

    $resortDataMainAct    = $blog_categoryMainAct =  $blog_category = 'active';         

    $title                = 'Blog Category List  | '.$site_title;

    break;   

  case 'blog_category/add_blog_category':        

    $resortDataMainAct    = $blog_categoryMainAct =  $add_blog_category  = 'active';         

    $title                = 'Add Villa Type  | '.$site_title;

    break;  
  
  case 'experience_category/add_experience_category':        

    $resortDataMainAct    = $experience_categoryMainAct =  $add_experience_category  = 'active';         

    $title                = 'Add Villa Type  | '.$site_title;

    break;  

  case 'meal_plans':        

    $resortDataMainAct    = $meal_plansMainAct =  $meal_plansAct = 'active';         

    $title                = 'Meal Plan List  | '.$site_title;

    break;

  case 'meal_plans/index':        

    $resortDataMainAct    = $meal_plansMainAct =  $meal_plansAct = 'active';         

    $title                = 'Meal Plan List  | '.$site_title;

    break;   

  case 'meal_plans/add_meal_plans':        

    $resortDataMainAct    = $meal_plansMainAct =  $add_meal_plan  = 'active';         

    $title                = 'Add Meal Plan  | '.$site_title;

    break;

  case 'attractions':        

    $resortDataMainAct    = $attractionsMainAct =  $attractions = 'active';         

    $title                = 'Attraction List  | '.$site_title;

    break;

  case 'attractions/index':        

    $resortDataMainAct    = $attractionsMainAct =  $attractions = 'active';         

    $title                = 'Attraction List  | '.$site_title;

    break;   

  case 'attractions/add_attraction':        

    $resortDataMainAct    = $attractionsMainAct =  $add_attraction  = 'active';         

    $title                = 'Add Attraction  | '.$site_title;

    break;  

  case 'holiday_styles':        

    $resortDataMainAct    = $holiday_stylesMainAct =  $holiday_styles = 'active';         

    $title                = 'Holiday Style List  | '.$site_title;

    break;

  case 'holiday_styles/index':        

    $resortDataMainAct    = $holiday_stylesMainAct =  $holiday_styles = 'active';         

    $title                = 'Holiday Style List  | '.$site_title;

    break;   

  case 'holiday_styles/add_holiday_style':        

    $resortDataMainAct    = $holiday_stylesMainAct =  $add_holiday_style  = 'active';         

    $title                = 'Add Holiday Style  | '.$site_title;

    break;  

  case 'amenities':        

    $resortDataMainAct    = $amenitiesMainAct =  $amenities = 'active';         

    $title                = 'Amenity List  | '.$site_title;

    break;

  case 'amenities/index':        

    $resortDataMainAct    = $amenitiesMainAct =  $amenities = 'active';         

    $title                = 'Amenity List  | '.$site_title;

    break;   

  case 'amenities/add_amenity':        

    $resortDataMainAct    = $amenitiesMainAct =  $add_amenity  = 'active';         

    $title                = 'Add Amenity  | '.$site_title;

    break; 

  case 'amenities/categorys':        

    $resortDataMainAct    = $amenitiesMainAct =  $amenitiesCategorys = 'active';         

    $title                = "Amenity's Category List  | ".$site_title;

    break;   

  case 'amenities/add_category':        

    $resortDataMainAct    = $amenitiesMainAct =  $add_amenity_category  = 'active';         

    $title                = "Add Amenity's Category  | ".$site_title;

    break;   

  case 'ideals':        

    $resortDataMainAct    = $idealsMainAct =  $ideals = 'active';         

    $title                = 'Ideal List  | '.$site_title;

    break;

  case 'ideals/index':        

    $resortDataMainAct    = $idealsMainAct =  $ideals = 'active';         

    $title                = 'Ideal List  | '.$site_title;

    break;   

  case 'ideals/add_ideal':        

    $resortDataMainAct    = $idealsMainAct =  $add_ideal  = 'active';         

    $title                = 'Add Ideal  | '.$site_title;

    break; 

  case 'facility':        

    $resortDataMainAct    = $facilityMainAct =  $facility = 'active';         

    $title                = 'Facility List  | '.$site_title;

    break;

  case 'facility/index':        

    $resortDataMainAct    = $facilityMainAct =  $facility = 'active';         

    $title                = 'Facility List  | '.$site_title;

    break;   

  case 'facility/addfacility':        

    $resortDataMainAct    = $facilityMainAct =  $addfacility  = 'active';         

    $title                = 'Add Facility  | '.$site_title;

    break;  

  case 'sports':        

    $resortDataMainAct    = $sportsMainAct =  $sports = 'active';         

    $title                = 'Sport List  | '.$site_title;

    break;

  case 'sports/index':        

    $resortDataMainAct    = $sportsMainAct =  $sports = 'active';         

    $title                = 'Sport List  | '.$site_title;

    break;   

  case 'sports/add_sport':        

    $resortDataMainAct    = $sportsMainAct =  $add_sport  = 'active';         

    $title                = 'Add Sport  | '.$site_title;

    break; 

  case 'water_sports':        

    $resortDataMainAct    = $water_sportsMainAct =  $water_sports = 'active';         

    $title                = 'Water Sport List  | '.$site_title;

    break;

  case 'water_sports/index':        

    $resortDataMainAct    = $water_sportsMainAct =  $water_sports = 'active';         

    $title                = 'Water Sport List  | '.$site_title;

    break;   

  case 'water_sports/add_water_sports':        

    $resortDataMainAct    = $water_sportsMainAct =  $add_water_sports  = 'active';         

    $title                = 'Add Water Sport  | '.$site_title;

    break; 

  case 'meal_served':        

    $resortDataMainAct    = $meal_servedMainAct =  $meal_served = 'active';         

    $title                = 'Meal Served List  | '.$site_title;

    break;

  case 'meal_served/index':        

    $resortDataMainAct    = $meal_servedMainAct =  $meal_served = 'active';         

    $title                = 'Meal Served List  | '.$site_title;

    break;   

  case 'meal_served/add_meal_served':        

    $resortDataMainAct    = $meal_servedMainAct =  $add_meal_served  = 'active';         

    $title                = 'Add Meal Served  | '.$site_title;

    break;  

  case 'opening_hours':        

    $resortDataMainAct    = $opening_hoursMainAct =  $opening_hoursLink = 'active';         

    $title                = 'Opening Hours List  | '.$site_title;

    break;

  case 'opening_hours/index':        

    $resortDataMainAct    = $opening_hoursMainAct =  $opening_hoursLink = 'active';         

    $title                = 'Opening Hours List  | '.$site_title;

    break;   

  case 'opening_hours/add_opening_hour':        

    $resortDataMainAct    = $opening_hoursMainAct =  $add_opening_hour  = 'active';         

    $title                = 'Add Opening Hour  | '.$site_title;

    break;  

  case 'blogs':        

    $blogsMainAct         =  $blogs = 'active';         

    $title                = 'Blogs List  | '.$site_title;

    break;

  case 'blogs/index':        

    $blogsMainAct         =  $blogs = 'active';         

    $title                = 'Blogs List  | '.$site_title;

    break;   

  case 'blogs/add_blog':        

    $blogsMainAct         =  $add_blog  = 'active';         

    $title                = 'Add Blog | '.$site_title;

    break;

  case 'blogs/blogdetails':        

    $blogsMainAct         =  $blogdetails  = 'active';         

    $title                = 'Blog Details List| '.$site_title;

    break;

  case 'blogs/add_blogdetails':        

    $blogsMainAct         =  $add_blogdetails  = 'active';         

    $title                = 'Add Blog Details| '.$site_title;

    break;

  case 'maldives':        

    $maldivesMainAct      = 'active';         

    $title                = 'About Maldives | '.$site_title;

    break; 

	case 'maldives/':        

    $maldivesMainAct      = $maldivesAboutMainAct    = 'active';         

    $title                = 'About Maldives | '.$site_title;

    break;	

  case 'maldives/arrival_immigration':        

    $maldivesMainAct = $immegrationMainAct      = 'active';         

    $title                = 'Arrival Immigration | '.$site_title;

    break;  

  case 'maldives/what_to_wear':        

     $maldivesMainAct = $whatToWearMainAct      = 'active';         

    $title                = 'What To Wear| '.$site_title;

    break;

  case 'maldives/local_environment':        

     $maldivesMainAct = $LocalEnvironmentMainAct      = 'active';         

    $title                = 'Local Environment| '.$site_title;

    break;

  case 'maldives/maldives_people':        

     $maldivesMainAct = $MaldivesPeopleMainAct      = 'active';         

    $title                = 'People| '.$site_title;

    break; 

  case 'maldives/climate_weather':        

    $maldivesMainAct =  $ClimateWeatherMainAct      = 'active';         

    $title                = 'Climate Weather| '.$site_title;

    break;

 case 'maldives/maldives_diving':        

     $maldivesMainAct =  $MaldivesDivingMainAct      = 'active';         

    $title                = 'Diving| '.$site_title;

    break;

  case 'food_types':        

    $resortDataMainAct    = $food_typesMainAct =  $food_types = 'active';         

    $title                = 'Food Types List  | '.$site_title;

    break;

  case 'food_types/index':        

    $resortDataMainAct    = $food_typesMainAct =  $food_types = 'active';         

    $title                = 'Food Types List  | '.$site_title;

    break;   

  case 'food_types/add_food_type':        

    $resortDataMainAct    = $food_typesMainAct =  $add_food_type  = 'active';         

    $title                = 'Add Food Type | '.$site_title;

    break; 

  case 'dinings_types':        

    $resortDataMainAct    = $dinings_typesMainAct =  $dinings_types = 'active';         

    $title                = 'Dining Type List  | '.$site_title;

    break;

  case 'dinings_types/index':        

    $resortDataMainAct    = $dinings_typesMainAct =  $dinings_types = 'active';         

    $title                = 'Dining Type List  | '.$site_title;

    break;   

  case 'dinings_types/add_dinings_type':        

    $resortDataMainAct    = $dinings_typesMainAct =  $add_dinings_type  = 'active';         

    $title                = 'Add Dining Type| '.$site_title;

    break; 

  case 'meal_styles':        

    $resortDataMainAct    = $meal_stylesMainAct =  $meal_styles = 'active';         

    $title                = 'Meal Style List  | '.$site_title;

    break;

  case 'meal_styles/index':        

    $resortDataMainAct    = $meal_stylesMainAct =  $meal_styles = 'active';         

    $title                = 'Meal Style List  | '.$site_title;

    break;   

  case 'meal_styles/add_meal_styles':        

    $resortDataMainAct    = $meal_stylesMainAct =  $add_meal_styles  = 'active';         

    $title                = 'Add Meal Style| '.$site_title;

    break; 

  case 'cms/setting':        

    $settingMainAct       = 'active';         

    $title                = 'Setting | '.$site_title;

    break; 

  case 'cms/editor':        

    $editorMainAct       = 'active';         

    $title                = 'Setting | '.$site_title;

    break; 

  case 'cms/caption':        

    $captionMainAct       = 'active';         

    $title                = 'Setting | '.$site_title;

    break; 

  case 'cms/add_caption':        

    $captionMainAct       = 'active';         

    $title                = 'Setting | '.$site_title;

    break; 

  case 'cms/index':        

    $Follow_UsMainAct     = 'active';         

    $title                = 'Follow Us | '.$site_title;

    break;  

  case 'subadmin':        

    $subadminMainAct      =  $subadmin = 'active';         

    $title                = 'Sub admin List  | '.$site_title;

    break; 

  case 'subadmin/addsubadmin':        

    $subadminMainAct      =  $addsubadmin  = 'active';         

    $title                = 'Add sub admin  | '.$site_title;

    break; 

  case 'faq':        

    $faqMainAct =  $faq_list = 'active';         

    $title                = 'FAQ List | '.$site_title;

    break;

  case 'faq/index':        

    $faqMainAct =  $faq_list = 'active';         

    $title                = 'FAQ List | '.$site_title;

    break;   

  case 'faq/add_faq':        

    $faqMainAct =  $add_faq  = 'active';         

    $title                = 'Add FAQ  | '.$site_title;

    break; 
   /*-- hem dev --*/
   case 'pages/index':        

    $insipirationMainAct =  $insipiration_list = 'active';         

    $title                = 'Insipiration List | '.$site_title;

    break;   

  case 'pages/accommodation_list':        

    $acommodationMainAct =  $add_acommodation  = 'active';         

    $title                = 'Add Acommodation  | '.$site_title;

    break;

     case 'pages/accommodation_list':        

    $accommodationMainAct =  $accommodation_list = 'active';         

    $title                = 'Accommodation List | '.$site_title;

    break;   

  case 'pages/add_acommodation':        

    $accommodationMainAct =  $add_accommodation  = 'active';         

    $title                = 'Add Accommodation  | '.$site_title;

    break;


   case 'pages/experience_list':        

    $experienceMainAct =  $add_experince  = 'active';         

    $title                = 'Add Experience  | '.$site_title;

    break;

     case 'pages/experience_list':        

    $experienceMainAct =  $experince_list = 'active';         

    $title                = 'Experience List | '.$site_title;

    break;   

  case 'pages/add_acommodation':        

    $experienceMainAct =  $add_experience  = 'active';         

    $title                = 'Add Experience  | '.$site_title;

    break;

/*-- hem dev --*/

  case 'travel_partner/add_travel_partner':        

    $travel_partnerMainAct       = $add_travel_partner = 'active';         

    $title                = 'Add Travel Partner | '.$site_title;

    break;  

  case 'travel_partner':        

    $travel_partnerMainAct = $travel_patner = 'active';         

    $title                 = 'Travel Partner list  | '.$site_title;

    break;

 case 'airport/add_airport':        

    $airportsMainAct       = $add_airport = 'active';         

    $title                = 'Add Airport | '.$site_title;

    break;  

  case 'travel_partner':        

    $airportsMainAct = $airport = 'active';         

    $title                 = 'Airport list  | '.$site_title;

    break;	

 case 'airlines/add_airline':        

    $airlinesMainAct       = $add_airline = 'active';         

    $title                = 'Add Airline | '.$site_title;

    break;  

  case 'airlines':        

    $airportsMainAct = $airport = 'active';         

    $title                 = 'Airline list  | '.$site_title;

    break;	

  default : 

    $dashboardAct       = 'active';

    $title              = $admin_text.' | Dashboard';  

} 

$adminInfo = get_admin_info(superadmin_id());

?> 

<!DOCTYPE html>

<html>

<head>

  <meta charset="utf-8">

  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <title><?php echo $title; ?></title>

  <!-- Tell the browser to be responsive to screen width -->

  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/front/images/favicon-96x96.png" type="image/x-icon" />

  <!-- Bootstrap 3.3.7 -->

  <link rel="stylesheet" href="<?php echo  ADMIN_THEAM_PATH ;?>bower_components/bootstrap/dist/css/bootstrap.min.css">

  <!-- Font Awesome -->

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

  <!-- Ionicons -->

  <link rel="stylesheet" href="<?php echo  ADMIN_THEAM_PATH ;?>bower_components/Ionicons/css/ionicons.min.css">

  <!-- Theme style -->

  <link rel="stylesheet" href="<?php echo  ADMIN_THEAM_PATH ;?>dist/css/AdminLTE.min.css">

  <!-- AdminLTE Skins. Choose a skin from the css/skins -->

  <link rel="stylesheet" href="<?php echo  ADMIN_THEAM_PATH ;?>dist/css/skins/_all-skins.min.css">

  <link rel="stylesheet" href="<?php echo  ADMIN_THEAM_PATH ;?>css/custom.css">

  <link rel="stylesheet" href="<?php echo  ADMIN_THEAM_PATH ;?>css/alertify.core.css"> 

  <link rel="stylesheet" type="text/css" href="<?php echo  ADMIN_THEAM_PATH ;?>css/jquery.fancybox.css">

  <link rel="stylesheet" href="https://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.css">

  <link rel="shortcut icon" href="<?php echo base_url('assets/front/img/favicon.png'); ?>" type="image/png"/>

  <!-- Google Font -->

  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

  <!-- datepicker css -->

  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

  <!-- jQuery 3 -->

  <script src="<?php echo  ADMIN_THEAM_PATH ;?>bower_components/jquery/dist/jquery.min.js"></script>

</head>

<body class="hold-transition skin-blue  sidebar-mini">

<div class="wrapper">

  <header class="main-header">

    <!-- Logo -->

    <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>" class="logo">

      <!-- mini logo for sidebar mini 50x50 pixels -->

      <span class="logo-mini"><b>MALDIVES</b></span>

      <!-- logo for regular state and mobile devices -->

      <!-- <span class="logo-lg"><b>Admin</b>LTE</span> -->

      <?php

        echo '<span class="logo-mini">MALDIVES</span>';

        echo '<span class="logo-lg">MALDIVES</span>';

      ?>

    </a>

    <!-- Header Navbar: style can be found in header.less -->

    <nav class="navbar navbar-static-top">

      <!-- Sidebar toggle button-->

      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">

        <span class="sr-only">Toggle navigation</span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

        <span class="icon-bar"></span>

      </a>

      <div class="navbar-custom-menu">

        <ul class="nav navbar-nav">                   

          <!-- User Account: style can be found in dropdown.less -->

          <li class="dropdown user user-menu">

            <a href="#" class="dropdown-toggle" data-toggle="dropdown">

              <?php 

              if(!empty($adminInfo->image)&&file_exists('uploads/admin_user/'.$adminInfo->image)){

                $profilePic = base_url('uploads/admin_user/'.$adminInfo->image);

              }else{

                $profilePic = base_url('assets/front/img/default.png'); 

              }

              if(!empty($profilePic)){

                echo '<img src="'.$profilePic.'" class="user-image" alt="User Image">';

              } ?>              

              <span class="hidden-xs">

                <?php  

                  if(!empty($adminInfo->first_name)) 

                    echo ucwords($adminInfo->first_name);  

                  if(!empty($adminInfo->last_name)) 

                    echo ' '.ucwords($adminInfo->last_name);

                ?>

              </span>

            </a>

            <ul class="dropdown-menu">

              <li class="user-footer">

                <div class="">

                  <ul class="header-right_menu">

                    <li>

                      <a href="<?php echo ADMIN_URL.'superadmin/profile'; ?>">

                       <i class="fa fa-user" aria-hidden="true"></i> 

                        Profile

                      </a> 

                    </li>

                    <li>               

                      <a href="<?php echo ADMIN_URL.'superadmin/change_password'; ?>">

                       <i class="fa fa-pencil-square-o" aria-hidden="true"></i> Change Password

                      </a> 

                    </li>

                    <li>               

                      <a href="<?php echo ADMIN_URL.'superadmin/logout'; ?>">

                       <i class="fa fa-sign-out" aria-hidden="true"></i> Sign out

                      </a>

                    </li>

                </div>

              </li>

            </ul>

          </li>

          <?php if($admin_type==1){ ?>

            <!-- Control Sidebar Toggle Button -->

            <li>

              <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>

            </li>

          <?php }?>

        </ul>

      </div>

    </nav>

  </header>

  <!-- Left side column. contains the logo and sidebar -->

  <aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->

    <section class="sidebar">

      <!-- Sidebar user panel -->

      <div class="user-panel">

        <div class="pull-left image">

          <?php 

            if(!empty($profilePic)){?>

              <img src="<?php echo  $profilePic ;?>" class="img-circle" alt="User Image">

            <?php }?>

        </div>

        <div class="pull-left info">

          <p>

            <?php  

              if(!empty($adminInfo->first_name)) echo ucwords($adminInfo->first_name);  

              if(!empty($adminInfo->last_name)) echo ' '.ucwords($adminInfo->last_name);

            ?>

          </p>

          <a href="javascript:void(0);">

            <i class="fa fa-circle text-success"></i> 

            Online

          </a>

        </div>

      </div>      

      <!-- /.search form -->

      <!-- sidebar menu: : style can be found in sidebar.less -->

      <ul class="sidebar-menu" data-widget="tree">    

        <li class="<?php echo !empty($dashboardAct)?$dashboardAct:''; ?>">

          <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">

            <i class="fa fa-dashboard"></i> <span>Dashboard</span>            

          </a>

        </li>      

        <?php if($admin_type==1){ ?> 

          <li class="treeview <?php echo !empty($subadminMainAct)?$subadminMainAct:''; ?>">

            <a href="javascript:void(0);">

              <i class="fa fa-users" aria-hidden="true"></i> <span>Subadmins</span>

              <span class="pull-right-container">            

                <i class="fa fa-angle-left pull-right"></i>

              </span>

            </a>

            <ul class="treeview-menu"> 

              <li class="treeview <?php echo !empty($subadmin)?$subadmin:''; ?>">

                <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'subadmin'; ?>');">

                  <i class="fa fa-user" aria-hidden="true"></i>

                    Sub Admin List

                </a>

              </li> 

              <li class="treeview <?php echo !empty($addsubadmin)?$addsubadmin:''; ?>">

                <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'subadmin/addsubadmin'; ?>');">

                  <i class="fa fa-user-plus" aria-hidden="true"></i> 

                  Add Sub admin

                </a>

              </li>

            </ul>

          </li> 

          <li class="treeview <?php echo !empty($usersMainAct)?$usersMainAct:''; ?>">

            <a href="javascript:void(0);">

              <i class="fa fa-users" aria-hidden="true"></i> <span>Users</span>

              <span class="pull-right-container">            

                <i class="fa fa-angle-left pull-right"></i>

              </span>

            </a>

            <ul class="treeview-menu"> 

              <li class="treeview <?php echo !empty($buyer)?$buyer:''; ?>">

                <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'customer/users'; ?>');">

                  <i class="fa fa-user" aria-hidden="true"></i>

                    User List

                </a>

              </li> 

              <li class="treeview <?php echo !empty($hotel)?$hotel:''; ?>">

                <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'customer/hotels'; ?>');">

                  <i class="fa fa-user" aria-hidden="true"></i> 

                  Hotels List

                </a>

              </li>

            </ul>

          </li> 
          
          

          <li class="treeview <?php echo !empty($resortsMainAct)?$resortsMainAct:''; ?>">

          <a href="javascript:void(0);">

            <i class="fa fa-question-circle" aria-hidden="true"></i> <span>Resorts</span>

            <span class="pull-right-container">            

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu"> 

            <li class="treeview <?php echo !empty($resortsMainAct)?$resortsMainAct:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'resorts'; ?>');">

                <i class="fa fa-th" aria-hidden="true"></i>

                  Resorts List

              </a>

            </li> 

            <li class="treeview <?php echo !empty($accommodation_list)?$accommodation_list:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'pages/accommodation_list'; ?>');">

                <i class="fa fa-plus" aria-hidden="true"></i> 

                Accommodation List

              </a>

            </li>

          </ul>

        </li>
          
          
          
        
        
        <!--<li class="treeview <?php echo !empty($resortsMainAct)?$resortsMainAct:''; ?>" >-->

        <!--    <a href="javascript:void(0);">-->

        <!--    <i class="fa fa-question-circle" aria-hidden="true"></i> <span>Resorts</span>-->

        <!--    <span class="pull-right-container">            -->

        <!--      <i class="fa fa-angle-left pull-right"></i>-->

        <!--    </span>-->
            
        <!--    <ul class="treeview-menu"> -->
        <!--       <li class="treeview <?php echo !empty($resortsMainAct)?$resortsMainAct:''; ?>" id="inner-items">-->
        <!--           <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'resorts'; ?>');">-->
        <!--            <i class="fa fa-th" aria-hidden="true"></i>Resorts List-->
        <!--        </li>-->
        <!--       <li class="treeview <?php echo !empty($accommodation_list)?$accommodation_list:''; ?>">-->
        <!--           <a  href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'pages/accommodation_list'; ?>');">-->
        <!--            <i class="fa fa-th" aria-hidden="true"></i>Accommodation List-->
        <!--        </li>-->
                
        <!--    </ul>-->
        <!--  </li>-->
          
          
          
          
          
          
          

          <li class="treeview <?php echo !empty($resortDataMainAct)?$resortDataMainAct:''; ?>">

            <a href="javascript:void(0);">

              <i class="fa fa-cog" aria-hidden="true"></i> <span>Resort Data</span>

              <span class="pull-right-container">            

                <i class="fa fa-angle-left pull-right"></i>

              </span>

            </a>

            <ul class="treeview-menu"> 

              

               <li class="treeview <?php echo !empty($villaMainAct)?$villaMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Villa</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($villlist)?$villlist:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'resorts/villalist'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Villa List

                    </a>

                  </li> 

                </ul>

              </li>

              <li class="treeview <?php echo !empty($brandMainAct)?$brandMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Brands</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($brands)?$brands:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'brands'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Brand List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_brand)?$add_brand:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'brands/addbrand'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Brand

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($atollsMainAct)?$atollsMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Atolls</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($atolls)?$atolls:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'atolls'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Atoll List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_atoll)?$add_atoll:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'atolls/addatoll'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Atoll

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($affiliationsMainAct)?$affiliationsMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Affiliations</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($affiliations)?$affiliations:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'affiliations'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Affiliation List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_affiliation)?$add_affiliation:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'affiliations/addaffiliation'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Affiliation

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($categorysMainAct)?$categorysMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Categorys</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($categorysAct)?$categorysAct:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'categorys'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Category List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_category)?$add_category:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'categorys/add_category'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Category

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($transfer_modesMainAct)?$transfer_modesMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Transfer Modes</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($transfer_modes)?$transfer_modes:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'transfer_modes'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Transfer Mode List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_transfer_mode)?$add_transfer_mode:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'transfer_modes/add_transfer_mode'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Transfer Mode

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($villa_typesMainAct)?$villa_typesMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Villa Types</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($villa_types)?$villa_types:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'villa_types'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Villa Type List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_villa_type)?$add_villa_type:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'villa_types/add_villa_type'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Villa Type

                    </a>

                  </li>

                </ul>

              </li>

			  <li class="treeview <?php echo !empty($experience_categoryMainAct)?$experience_categoryMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Experience Category</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($experience_category)?$experience_category:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'experience_category'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                       Experience Category List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_experience_category)?$add_experience_category:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'experience_category/add_experience_category'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Experience Category

                    </a>

                  </li>

                </ul>
                
              </li>
			  
			  
			 <li class="treeview <?php echo !empty($meal_plansMainAct)?$meal_plansMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Meal Plans</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($meal_plansAct)?$meal_plansAct:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'meal_plans'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Meal Plan List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_meal_plan)?$add_meal_plan:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'meal_plans/add_meal_plans'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Meal Plan

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($attractionsMainAct)?$attractionsMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Attractions</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($attractions)?$attractions:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'attractions'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Attraction List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_attraction)?$add_attraction:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'attractions/add_attraction'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Attraction

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($holiday_stylesMainAct)?$holiday_stylesMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Holiday Styles</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($holiday_styles)?$holiday_styles:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'holiday_styles'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Holiday Style List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_holiday_style)?$add_holiday_style:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'holiday_styles/add_holiday_style'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Holiday Style

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($amenitiesMainAct)?$amenitiesMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Amenities</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($amenities)?$amenities:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'amenities'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Amenity List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_amenity)?$add_amenity:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'amenities/add_amenity'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Amenity

                    </a>

                  </li>

                  <li class="treeview <?php echo !empty($amenitiesCategorys)?$amenitiesCategorys:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'amenities/categorys'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Category List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_amenity_category)?$add_amenity_category:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'amenities/add_category'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Category

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($idealsMainAct)?$idealsMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Ideals</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($ideals)?$ideals:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'ideals'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Ideal List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_ideal)?$add_ideal:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'ideals/add_ideal'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Ideal

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($facilityMainAct)?$facilityMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Facilities</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($facility)?$facility:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'facility'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Facility List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($addfacility)?$addfacility:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'facility/addfacility'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Facility

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($sportsMainAct)?$sportsMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Sports</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($sports)?$sports:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'sports'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Sport List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_sport)?$add_sport:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'sports/add_sport'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Sport

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($water_sportsMainAct)?$water_sportsMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Water Sports</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($water_sports)?$water_sports:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'water_sports'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                        Water Sport List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_water_sports)?$add_water_sports:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'water_sports/add_water_sports'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Water Sport

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($dinings_typesMainAct)?$dinings_typesMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Dining Types</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($dinings_types)?$dinings_types:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'dinings_types'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                       Dining Types List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_meal_styles)?$add_meal_styles:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'dinings_types/add_dinings_type'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Dining Type

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($meal_servedMainAct)?$meal_servedMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Meal Served</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($meal_served)?$meal_served:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'meal_served'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                       Meal Served List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_meal_served)?$add_meal_served:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'meal_served/add_meal_served'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Meal Served

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($meal_stylesMainAct)?$meal_stylesMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Meal Styles</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($meal_styles)?$meal_styles:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'meal_styles'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                       Meal Styles List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_meal_styles)?$add_meal_styles:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'meal_styles/add_meal_styles'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Meal Styles

                    </a>

                  </li>

                </ul>

              </li>

              <li class="treeview <?php echo !empty($food_typesMainAct)?$food_typesMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Food Types</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($food_types)?$food_types:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'food_types'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                       Food Types List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_food_type)?$add_food_type:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'food_types/add_food_type'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Food Type

                    </a>

                  </li>

                </ul>

              </li>

            </ul>

          </li>

        <?php } ?>

        <!-- <li class="treeview <?php echo !empty($resort_storyMainAct)?$resort_storyMainAct:''; ?>">

          <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'resorts/resort_story'; ?>');">

            <i class="fa fa-commenting" aria-hidden="true"></i>

            <span> Resort Story List</span>

          </a>

        </li>  -->

        <li class="treeview <?php echo !empty($resort_storyMainAct)?$resort_storyMainAct:''; ?>">

          <a href="javascript:void(0);">

            <i class="fa fa-commenting" aria-hidden="true"></i> <span>Resort Stories</span>

            <span class="pull-right-container">            

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu"> 

            <li class="treeview <?php echo !empty($resort_storyAct)?$resort_storyAct:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'resorts/resort_story'; ?>');">

                <i class="fa fa-th" aria-hidden="true"></i>

                  Resort Story List

              </a>

            </li> 

            <li class="treeview <?php echo !empty($add_resort_story)?$add_resort_story:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'resorts/add_resort_story'; ?>');">

                <i class="fa fa-plus" aria-hidden="true"></i> 

                Add Resort Story

              </a>

            </li>

          </ul>

        </li>

        <li class="treeview <?php echo !empty($traveller_storyMainAct)?$traveller_storyMainAct:''; ?>">

          <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'resorts/traveller_story'; ?>');">

            <i class="fa fa-commenting-o" aria-hidden="true"></i>

            <span> Traveller Story List</span>

          </a>

        </li> 

        <li class="treeview <?php echo !empty($blogsMainAct)?$blogsMainAct:''; ?>">

          <a href="javascript:void(0);">

            <i class="fa fa-th" aria-hidden="true"></i> <span>News & Blogs</span>

            <span class="pull-right-container">            

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu"> 

            <li class="treeview <?php echo !empty($blogs)?$blogs:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'blogs'; ?>');">

                <i class="fa fa-th" aria-hidden="true"></i>

                  Blogs List

              </a>

            </li> 

            <li class="treeview <?php echo !empty($add_blog)?$add_blog:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'blogs/add_blog'; ?>');">

                <i class="fa fa-plus" aria-hidden="true"></i> 

                Add Blog

              </a>

            </li>
             <li class="treeview <?php echo !empty($blog_categoryMainAct)?$blog_categoryMainAct:''; ?>">

                <a href="javascript:void(0);">

                  <i class="fa fa-th-large" aria-hidden="true"></i> <span>Blog Category</span>

                  <span class="pull-right-container">            

                    <i class="fa fa-angle-left pull-right"></i>

                  </span>

                </a>

                <ul class="treeview-menu"> 

                  <li class="treeview <?php echo !empty($blog_category)?$blog_category:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'blog_category'; ?>');">

                      <i class="fa fa-th" aria-hidden="true"></i>

                       Blog Category List

                    </a>

                  </li> 

                  <li class="treeview <?php echo !empty($add_blog_category)?$add_blog_category:''; ?>">

                    <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'blog_category/add_blog_category'; ?>');">

                      <i class="fa fa-plus" aria-hidden="true"></i> 

                      Add Blog Category

                    </a>

                  </li>

                </ul>
                
              </li>

              

           <!--  <li class="treeview <?php echo !empty($add_blogdetails)?$add_blogdetails:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'blogs/add_blogdetails'; ?>');">

                <i class="fa fa-plus" aria-hidden="true"></i> 

                Add Blogdetails

              </a>

            </li>

            

            <li class="treeview <?php echo !empty($blogdetails)?$blogdetails:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'blogs/blogdetails'; ?>');">

                <i class="fa fa-th" aria-hidden="true"></i> 

                Blog details list

              </a>

            </li> -->

          </ul>

        </li>

        <?php if($admin_type==1){ ?>  

         <li class="treeview <?php echo !empty($hear_byMainAct)?$hear_byMainAct:''; ?>">

          <a href="javascript:void(0);">

            <i class="fa fa-th" aria-hidden="true"></i> <span>Hear By</span>

            <span class="pull-right-container">            

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu"> 

            <li class="treeview <?php echo !empty($hear_by)?$hear_by:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'hear_by'; ?>');">

                <i class="fa fa-th" aria-hidden="true"></i>

                  Hear By List

              </a>

            </li> 

            <li class="treeview <?php echo !empty($add_hear_by)?$add_hear_by:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'hear_by/add_hear_by'; ?>');">

                <i class="fa fa-plus" aria-hidden="true"></i> 

                Add Hear By

              </a>

            </li>

          </ul>

        </li>

        <li class="treeview <?php echo !empty($emailtemplateMainAct)?$emailtemplateMainAct:''; ?>">

          <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'emailTemplate'; ?>');">

            <i class="fa fa-envelope-open" aria-hidden="true"></i> 

            <span>Email Templates</span>

          </a>

        </li>

		<li class="treeview <?php echo !empty($maldivesMainAct)?$maldivesMainAct:''; ?>">

          <a href="javascript:void(0);">

            <i class="fa fa-th" aria-hidden="true"></i> <span>Maldives</span>

            <span class="pull-right-container">            

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu"> 

             <li class="treeview <?php echo !empty($maldivesAboutMainAct)?$maldivesAboutMainAct:''; ?>">

			  <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'maldives'; ?>');">

				<i class="fa fa-cog" aria-hidden="true"></i> 

				<span>About Maldives</span>

			  </a> 

			</li>

            <li class="treeview <?php echo !empty($immegrationMainAct)?$immegrationMainAct:''; ?>">

			  <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'maldives/arrival_immegration'; ?>');">

				<i class="fa fa-cog" aria-hidden="true"></i> 

				<span>Arrival & Immigration</span>

			  </a> 

			</li> 

			<li class="treeview <?php echo !empty($whatToWearMainAct)?$whatToWearMainAct:''; ?>">

			  <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'maldives/what_to_wear'; ?>');">

				<i class="fa fa-cog" aria-hidden="true"></i> 

				<span>What To Wear</span>

			  </a> 

			</li>

			<li class="treeview <?php echo !empty($LocalEnvironmentMainAct)?$LocalEnvironmentMainAct:''; ?>">

			  <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'maldives/local_environment'; ?>');">

				<i class="fa fa-cog" aria-hidden="true"></i> 

				<span>Local Environment</span>

			  </a> 

			</li>

			<li class="treeview <?php echo !empty($MaldivesPeopleMainAct)?$MaldivesPeopleMainAct:''; ?>">

			  <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'maldives/maldives_people'; ?>');">

				<i class="fa fa-cog" aria-hidden="true"></i> 

				<span>People</span>

			  </a> 

			</li>

			<li class="treeview <?php echo !empty($ClimateWeatherMainAct)?$ClimateWeatherMainAct:''; ?>">

			  <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'maldives/climate_weather'; ?>');">

				<i class="fa fa-cog" aria-hidden="true"></i> 

				<span>Climate & Weather</span>

			  </a> 

			</li>

			<li class="treeview <?php echo !empty($MaldivesDivingMainAct)?$MaldivesDivingMainAct:''; ?>">

			  <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'maldives/maldives_diving'; ?>');">

				<i class="fa fa-cog" aria-hidden="true"></i> 

				<span>Diving</span>

			  </a> 

			</li>

          </ul>

        </li>

       

        <li class="treeview <?php echo !empty($Follow_UsMainAct)?$Follow_UsMainAct:''; ?>">

          <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'cms/index/Follow_Us'; ?>');">

            <i class="fa fa-cog" aria-hidden="true"></i> 

            <span>Follow Us Link </span>

          </a>

        </li>  

        <li class="treeview <?php echo !empty($captionMainAct)?$captionMainAct:''; ?>">

          <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'cms/caption'; ?>');">

            <i class="fa fa-cog" aria-hidden="true"></i> 

            <span>Cms & Caption </span>

          </a>

        </li>  

        <li class="treeview <?php echo !empty($settingMainAct)?$settingMainAct:''; ?>">

          <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'cms/index/setting'; ?>');">

            <i class="fa fa-cog" aria-hidden="true"></i> 

            <span>Setting </span>

          </a>

        </li>  

        <li class="treeview <?php echo !empty($editorMainAct)?$editorMainAct:''; ?>">

          <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'cms/index/editor'; ?>');">

            <i class="fa fa-cog" aria-hidden="true"></i> 

            <span>Vison, Mission & About us </span>

          </a>

        </li> 

        <li class="treeview <?php echo !empty($openingsMainAct)?$openingsMainAct:''; ?>">

          <a href="javascript:void(0);">

            <i class="fa fa-cog" aria-hidden="true"></i> <span>Openings</span>

            <span class="pull-right-container">            

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu"> 

            <li class="treeview <?php echo !empty($openings)?$openings:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'openings'; ?>');">

                <i class="fa fa-list" aria-hidden="true"></i>

                  Openings List

              </a>

            </li> 

            <li class="treeview <?php echo !empty($add_opening)?$add_opening:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'openings/add_opening'; ?>');">

                <i class="fa fa-plus" aria-hidden="true"></i> 

                Add Opening

              </a>

            </li>

          </ul>

        </li>  

        <li class="treeview <?php echo !empty($distance_placesMainAct)?$distance_placesMainAct:''; ?>">

          <a href="javascript:void(0);">

            <i class="fa fa-th-large" aria-hidden="true"></i> <span>Distance Places</span>

            <span class="pull-right-container">            

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu"> 

            <li class="treeview <?php echo !empty($distance_places)?$distance_places:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'distance_places'; ?>');">

                <i class="fa fa-th" aria-hidden="true"></i>

                  Distance Places List

              </a>

            </li> 

            <li class="treeview <?php echo !empty($add_distance_places)?$add_distance_places:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'distance_places/add_distance_place'; ?>');">

                <i class="fa fa-plus" aria-hidden="true"></i> 

                Add Distance Place

              </a>

            </li>

          </ul>

        </li> 

		<li class="treeview <?php echo !empty($faqMainAct)?$faqMainAct:''; ?>">

          <a href="javascript:void(0);">

           <i class="fa fa-question-circle" aria-hidden="true"></i> <span>FAQ</span>

            <span class="pull-right-container">            

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu"> 

            <li class="treeview <?php echo !empty($faq_list)?$faq_list:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'faq'; ?>');">

                <i class="fa fa-th" aria-hidden="true"></i>

                  FAQ List

              </a>

            </li> 

            <li class="treeview <?php echo !empty($add_faq)?$add_faq:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'faq/add_faq'; ?>');">

                <i class="fa fa-plus" aria-hidden="true"></i> 

                Add FAQ

              </a>

            </li>

          </ul>

        </li> 
        <li class="treeview <?php echo !empty($insipirationMainAct)?$insipirationMainAct:''; ?>">

          <a href="javascript:void(0);">

           <i class="fa fa-question-circle" aria-hidden="true"></i> <span>PAGES</span>

            <span class="pull-right-container">            

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu"> 

            <li class="treeview <?php echo !empty($insipiration_list)?$insipiration_list:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'pages'; ?>');">

                <i class="fa fa-th" aria-hidden="true"></i>

                  INSPIRATION List

              </a>

            </li> 

            <li class="treeview <?php echo !empty($add_accommodation)?$add_accommodation:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'pages/add_accommodation'; ?>');">

                <i class="fa fa-plus" aria-hidden="true"></i> 

                Add Accommodation

              </a>

            </li>



            <!--<li class="treeview <?php echo !empty($add_accommodation)?$add_accommodation:''; ?>">-->

            <!--  <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'pages/add_accommodation'; ?>');">-->

            <!--    <i class="fa fa-plus" aria-hidden="true"></i> -->

            <!--    Add Accommodation-->

            <!--  </a>-->

            <!--</li>-->

            <li class="treeview <?php echo !empty($experince_list)?$experince_list:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'pages/experince_list'; ?>');">

                <i class="fa fa-th" aria-hidden="true"></i>

                  Experince List

              </a>

            </li> 

            <li class="treeview <?php echo !empty($add_experince)?$add_experince:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'pages/add_experince'; ?>');">

                <i class="fa fa-plus" aria-hidden="true"></i> 

                Add Experince

              </a>

            </li>


          </ul>

        </li> 

		 <li class="treeview <?php echo !empty($travel_partnerMainAct)?$travel_partnerMainAct:''; ?>">

          <a href="javascript:void(0);">

            <i class="fa fa-th" aria-hidden="true"></i> <span>Travel Partner</span>

            <span class="pull-right-container">            

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu"> 

            <li class="treeview <?php echo !empty($travel_partner)?$travel_partner:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'travel_partner'; ?>');">

                <i class="fa fa-th" aria-hidden="true"></i>

                 Travel Partner List

              </a>

            </li> 

            <li class="treeview <?php echo !empty($add_travel_partner)?$add_travel_partner:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'travel_partner/add_travel_partner'; ?>');">

                <i class="fa fa-plus" aria-hidden="true"></i> 

                Add Travel Partner

              </a>

            </li>

          </ul>

        </li>

		    <li class="treeview <?php echo !empty($airportsMainAct)?$airportsMainAct:''; ?>">

          <a href="javascript:void(0);">

            <i class="fa fa-th" aria-hidden="true"></i> <span>Airports</span>

            <span class="pull-right-container">            

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu"> 

            <li class="treeview <?php echo !empty($airport)?$airport:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'airport'; ?>');">

                <i class="fa fa-th" aria-hidden="true"></i>

                 Airport List

              </a>

            </li> 

            <li class="treeview <?php echo !empty($add_airport)?$add_airport:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'airport/add_airport'; ?>');">

                <i class="fa fa-plus" aria-hidden="true"></i> 

                Add Airport

              </a>

            </li>

          </ul>

        </li>

		    <li class="treeview <?php echo !empty($airlinesMainAct)?$airlinesMainAct:''; ?>">

          <a href="javascript:void(0);">

            <i class="fa fa-th" aria-hidden="true"></i> <span>Airlines</span>

            <span class="pull-right-container">            

              <i class="fa fa-angle-left pull-right"></i>

            </span>

          </a>

          <ul class="treeview-menu"> 

            <li class="treeview <?php echo !empty($airlines)?$airlines:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'airlines'; ?>');">

                <i class="fa fa-th" aria-hidden="true"></i>

                 Airline List

              </a>

            </li> 

            <li class="treeview <?php echo !empty($add_airline)?$add_airline:''; ?>">

              <a href="javascript:void(0);" onclick="go_link(event, '<?php echo ADMIN_URL.'airlines/add_airline'; ?>');">

                <i class="fa fa-plus" aria-hidden="true"></i> 

                Add Airline

              </a>

            </li>

          </ul>

        </li>

        <?php }?>  

      </ul>

    </section>

    <!-- /.sidebar -->

  </aside>

  <div class="content-wrapper">

    <section class="content-header">

      <div class="message_alert">

        <?php msg_alert(); ?>

      </div>

    </section>

    <style type="text/css">

      .loader_profile_left img, .ajaxloader img {padding-left: 43%;padding-top: 90px;}

      .note-msg font {

        color: #00BCD4;

        font-weight: bold;

      }

      .error{ color: red; }

    </style>

    <div class="ajaxloader" id="preloaderMainss">

       <img src="<?php echo  base_url().'assets/admin/img/loading.gif'?>">

    </div>