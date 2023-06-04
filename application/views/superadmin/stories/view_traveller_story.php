<style type="text/css">
.add-resort-card {
   width: 100%;
   float: left;
   border: solid 1px #eee;
   border-radius: 6px;
   padding: 10px;
   box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
   -moz-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
   -webkit-box-shadow: 0px 0px 10px 0px rgba(0, 0, 0, 0.2);
   background-color: #fff;
   margin-bottom: 20px;
}
.add-resort-card-left {
   width: 220px;
   float: left;
   border: solid 1px #ddd;
   height: 180px;
}
.add-resort-card-right {
   float: right;
   width: calc(100% - 235px);
   color: #1F344B;
   position: relative;
   }
.add-resort-card-left img {
   height: 180px;
   max-width: 100%;
}
.villa-name-title {
   width: 100%;
   float: left;
   font-family: 'brandon_textbold';
   font-size: 17px;
   color: #1F344B;
}
.add-resort-card-right ul {
   margin: 5px 0 0 0;
   padding: 0;
   width: 100%;
   float: left;
}
.add-resort-card-right li {
   float: left;
   width: 20%;
   padding: 0px 15px 0px 0;
   margin-top: 10px;
   list-style-type: none;
   font-family: 'brandon_textbold';
   font-size: 15px;
}
.add-resort-card-right li span {
   font-family: 'brandon_text_regularregular';
   color: #858585;
   float: left;
   width: 100%;
}
.traveller_contribution .traveller_star_rate ul li .fa-star {
   color: orange;
}
.add-resort-card-right ul {
   margin: 5px 0 0 0;
   padding: 0;
   width: 100%;
   float: left;
}
.traveller_contribution h6 {
   margin: 0 !important;
   padding: 0;
   float: left;
   width: 100%;
   font-size: 18px;
   margin-bottom: 30px;
   color: #35C1BA;
   text-transform: capitalize;
   font-family: 'brandon_textbold';
}
.traveller_contribution .traveller_star_rate ul li {
   margin: 0;
   width: 11px;
   padding: 9px !important;
}
.add-resort-card-right p {
   line-height: 20px;
   float: left;
   margin: 0;
   padding: 0;
   font-size: 16px;
}
</style>
<div class="row traveller_contribution">
   <div class="col-md-12" id="story_<?php 
      echo !empty($story->id)?$story->id:'';
      ?>">
      <div class="add-resort-card">
      <div class="add-resort-card-left">
   <?php 
      echo (!empty($story->profile_pic)&&file_exists('uploads/resorts/'.$story->profile_pic))?'<img src="'.base_url('uploads/resorts/'.$story->profile_pic).'" />':'<img src="'.base_url('assets/front/img/upload-photo.png').'" />';
   ?>
   </div>
      <div class="add-resort-card-right">
   <span class="villa-name-title">
      <?php 
      echo !empty($story->story_title)?$story->story_title:'';
      ?>
   </span>
   <h6 class="story_head">My Experience</h6>
   <p>
      <?php 
      echo !empty($story->my_experience)?$story->my_experience:'';
      ?>
   </p>
   <h6 class="story_head">What Can Be Improved</h6>
   <p>
      <?php 
         echo !empty($story->improved)?$story->improved:'';
      ?>
   </p>
   <ul>
   <li>
      Resort : 
      <span>
      <?php 
         echo !empty($story->resort_name)?$story->resort_name:'';
      ?>                              
      </span> 
   </li>                        
   <li>
      User : 
      <span>
      <?php 
         echo !empty($story->first_name)?ucfirst($story->first_name):'';
         echo !empty($story->last_name)?' '.ucfirst($story->last_name):'';
      ?>                                                   
      </span> 
      </li>                         
     <li>
         Category : 
        <span>
         <?php 
            echo !empty($story->category_name)?ucfirst($story->category_name):'';
         ?>    
         </span> 
   </li>  
   <li>
      Staff Friendliness: 
      <span>
         <div class="traveller_star_rate">
            <ul class="list-inline">
         <?php 
         for($nu=1;$nu<=5;$nu++){
            echo ($nu<=$story->staff_friendliness&&!empty($story->staff_friendliness))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
         }
         ?> 
         </ul>
      </div>
      </span> 
   </li>                        
   <li>
      Services : 
      <span>
         <div class="traveller_star_rate">
            <ul class="list-inline">
         <?php 
         for($nu=1;$nu<=5;$nu++){
            echo ($nu<=$story->services&&!empty($story->services))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
         }
         ?> 
         </ul>
      </div>
      </span> 
   </li>
   <li>Villa & Suites : 
      <span>
         <div class="traveller_star_rate">
            <ul class="list-inline">
         <?php 
         for($nu=1;$nu<=5;$nu++){
            echo ($nu<=$story->villa&&!empty($story->villa))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
         }
         ?>
         </ul>
      </div>
      </span> 
   </li>                        
    <li>
      Dine & Wine : 
      <span>
         <div class="traveller_star_rate">
            <ul class="list-inline">
         <?php 
         for($nu=1;$nu<=5;$nu++){
            echo ($nu<=$story->dine_wine&&!empty($story->dine_wine))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
         }
         ?>
         </ul>
      </div> 
      </span> 
   </li>                         
   <li>
      Spa  : 
     <span> 
      <div class="traveller_star_rate">
         <ul class="list-inline">
      <?php 
      for($nu=1;$nu<=5;$nu++){
         echo ($nu<=$story->spa&&!empty($story->spa))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
      }
      ?>
      </ul>
      </div>
      </span> 
   </li>
   <li>
      Facilities  : 
     <span> 
         <div class="traveller_star_rate">
            <ul class="list-inline">
         <?php 
         for($nu=1;$nu<=5;$nu++){
            echo ($nu<=$story->facilities&&!empty($story->facilities))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
         }
         ?>
         </ul>
      </div>
      </span> 
   </li>
   <li>
      Location  : 
     <span> 
      <div class="traveller_star_rate">
         <ul class="list-inline">
         <?php 
            for($nu=1;$nu<=5;$nu++){
               echo ($nu<=$story->location&&!empty($story->location))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
            }
         ?>
         </ul>
      </div>
      </span> 
   </li>
   <li>
      Beach  : 
     <span> 
      <div class="traveller_star_rate">
         <ul class="list-inline">
      <?php 
         for($nu=1;$nu<=5;$nu++){
            echo ($nu<=$story->beach&&!empty($story->beach))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
         }
      ?>
         </ul>
      </div>
      </span> 
   </li>
   <li>
      Kids Facilities  : 
     <span> 
      <div class="traveller_star_rate">
         <ul class="list-inline">
         <?php 
         for($nu=1;$nu<=5;$nu++){
            echo ($nu<=$story->kids_facilities&&!empty($story->kids_facilities))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
         }
         ?>
         </ul>
      </div>
      </span> 
   </li>
   <li>
      Snorkeling  : 
     <span> 
      <div class="traveller_star_rate">
         <ul class="list-inline">
            <?php 
            for($nu=1;$nu<=5;$nu++){
               echo ($nu<=$story->over_all&&!empty($story->over_all))?'<li class="list-inline-item"><i class="fa fa-star"></i></li>':'<li class="list-inline-item"><i class="fa fa-star-o"></i></li>';
            }
            ?>
         </ul>
      </div>
      </span> 
   </li>
   <li>
      Verified By  : 
     <span> 
      <?php 
         echo !empty($story->verified_by)?$story->verified_by:'Pending';
      ?>
      </span> 
   </li>
   </ul>      
   </div>
   </div>
   </div>
</div>
<h4>Images </h4>
<div class="row">
   <?php 
   if(!empty($images)){
      foreach($images as $image){?>
         <div class="col-md-3">
            <img src="<?php echo base_url('uploads/resorts/'.$image->image_name); ?>" class="img img-responsive">
         </div>
      <?php
      }
   }
   ?>
</div>