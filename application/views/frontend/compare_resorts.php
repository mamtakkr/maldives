<?php 
if(!empty($caption_imgs)) {
foreach($caption_imgs as $caption_img) {
	$bannerImaage = $caption_img->image_name;
}
}
?>
<style>
/*scroll sections*/
section#scroll-tabs .tabs {
    display: flex;
    justify-content: center;
    width: 100%;
}
#scroll-tabs .warpper{
  display:flex;
  flex-direction: column;
  align-items: center;
  padding-top:50px;
}
#scroll-tabs .tab{
  cursor: pointer;
  padding:10px 20px;
  margin:0px 90px;
  display:inline-block;
  color:#444;
  font-weight:bold;
}
#scroll-tabs  .panels{
  min-height:200px;
  width:100%;
  max-width:500px;
  border-radius:3px;
  overflow:hidden;
  padding:20px;  
}
#scroll-tabs  .panel{
  display:none;
  animation: fadein .8s;
}

#scroll-tabs  .radio{
  display:none;
}
#scroll-tabs .warpper .scroll-tab{
    color:#444;
    font-size:20px;
}
form#compare_frm select#select_resort_one,
select#select_resort_two,
select#select_resort_three{
    background:#dce3ef;
    border-radius: 50px;
    text-transform: uppercase;
    font-weight: 600;
    text-align:center;
}
form#compare_frm select{
    border:none !important;
}
#resort-filter .compare-hotel-container .hotel-caption{
    text-transform: uppercase;
}
#resort-filter .compare-hotel-container .compare-hotel-title{
    background-color:#fff;
    text-transform: uppercase;
    font-weight: 800;
}
#resort-filter .compare-hotel-container .col-border{
    border:none;
}
#resort-filter .compare-hotel-container .resort-category-container {
    padding: 10px 10px;
    display: table-footer-group ;
    line-height: 2;
}
/*=====villas css
========*/
section#villas-types {
    padding-bottom: 40px;
    padding-top: 10px;
}
section#villas-types .compare-hotel-container .villas-pill {
    display: flex;
    justify-content: flex-start;
}
section#villas-types .compare-hotel-container select#villa_rooms{
    background: #dce3ef;
    border-radius: 50px;
    font-weight:700;
    width:10rem;
}
section#villas-types .compare-hotel-container select{
    border:none !important;
    text-align:center;
}
section#villas-types .compare-hotel-container select#select_villa_1,
select#select_villa_2, 
select#select_villa_3 {
    background:#dce3ef;
    border-radius: 50px;
    text-transform: uppercase;
    font-weight: 600;
     text-align:center;
}
section#villas-types .compare-hotel-container label.btn.expbutton {
    color: #444;
    border: none;
    background:transparent;
}
section#villas-types .compare-hotel-container label.btn.expbutton:hover {
    text-decoration: underline;
}
section#villas-types .compare-hotel-container label.btn.expbutton{
        box-shadow: 0px 0px 0px #7682b72e;
        text-transform: uppercase;
        font-weight:700;
}
section#villas-types .compare-hotel-container .badgebox:checked + span{
    background:#2ec4bb;
    border-radius:50px;
}
section#villas-types .compare-hotel-container .badgebox:checked + span:hover{
    text-decoration:none;
}
/*.compare-hotel-container label.btn.expbutton:nth-child(3){*/
/*   display:none;*/
/*}*/
/*.compare-hotel-container label.btn.expbutton:nth-child(4){*/
/*   display:none;*/
/*}*/
section#villas-types .compare-hotel-container .resort-category-name.resort-star {
    margin-left: 0 !important;
    display:inline-block;
}
section#villas-types .compare-hotel-container label.btn.expbutton:nth-child(1){
    order:1;
}
section#villas-types .compare-hotel-container label.btn.expbutton:nth-child(2){
    order:2;
}
section#villas-types .compare-hotel-container label.btn.expbutton:nth-child(3){
    order:3;
    display:none
}
section#villas-types .compare-hotel-container label.btn.expbutton:nth-child(4){
    order:6;
        display:none
}
section#villas-types .compare-hotel-container label.btn.expbutton:nth-child(5){
    order:7;
}
section#villas-types .compare-hotel-container label.btn.expbutton:nth-child(6){
    order:4;
}
section#villas-types .compare-hotel-container label.btn.expbutton:nth-child(7){
    order:6;
}
section#villas-types .compare-hotel-container .compare-hotel-title {
    background: #fff;
}
@media screen and (max-width: 768px){
    section#nav-tabs .navTab-wrapper{
        flex-direction:column;
        width:100%;
    }
    section#villas-types .compare-hotel-container label.btn.expbutton{
        margin:5px;
    }
   section#villas-types .compare-hotel-container .HomeImage{
        height: 100px;
        max-width: 100px;
        object-fit: cover;
  }
   #scroll-tabs .tab{
       margin:0px 0px;
       padding:10px 10px;
   }
   #scroll-tabs .tab-content>.tab-pane{
       padding-top:0;
   }
  .compare-hotel-container .compare-hotel-title{
      padding:0;
  }
   #resort-filter .HomeImage{
       height:100px;
   }
}
</style>
<section>
		<div class="header-banner" style="background-image:url('<?php echo base_url('uploads/caption/' . $bannerImaage); ?>')">
			<div class="header-title">
				<h1><?php echo !empty($caption->caption_sub_title) ? $caption->caption_sub_title : ''; ?></h1>
				<h2><?php echo !empty($caption->caption_title) ? ucwords($caption->caption_title) : ''; ?></h2>
				<!--<h2><?php //echo !empty($caption->caption_title) ? strtoupper($caption->caption_title) : ''; ?></h2>-->
				
				<button type="button" class="btn header-search-btn">
					<span id="mySeachButton">
						<span><img src="<?php echo  FRONT_THEAM_PATH ;?>images/Search.png" alt="Search.png" class="img-fluid mr-3" /></span>
						Where would you like to go
					</span>
					<span id="divmySeachTextBox" style="display: none;">
						<form action="<?php echo base_url();?>resorts">
							<input type="text"  id="mySeachTextBox" name="search" placeholder="Search resort name...">
						</form>
					</span>
				</button>
			</div>
		</div>
</section>
	 <div class="container">
	     	<div class="py-2">
			<div class="inspiration">
				<div class="inspiration-title">
					<h2>COMPARISON</h2>
					<img src="<?php echo  FRONT_THEAM_PATH ;?>images/Rectangle6.png" alt="" class="img-fluid">
				</div>
				<div class="inspiration-description">
					<span class="more">
						Come, kick off your shoes and let us tell you a story . . . once upon a time there was a tiny tropical island, an emerald drop of paradise wrapped in soft white sands, surrounded by a vibrant coral reef, lapped by warm turquoise waters and hidden in the heart of a UNESCO biosphere reserve.
					</span>
				</div>
				<!--<ul class="nav nav-tabs mx-auto" id="inspiration-tab" role="tablist">-->
				<!--	<li class="nav-item" role="presentation">-->
				<!--		<a class="nav-link  active" id="resort-tab" data-toggle="tab" href="#resort" role="tab" aria-controls="resort" aria-selected="true">Resorts</a>-->
				<!--	</li>-->
				<!--	<li class="nav-item" role="presentation">-->
				<!--		<a class="nav-link" id="villa-resorts-tab" data-toggle="tab" href="#villa-resorts" role="tab" aria-controls="villa-resorts" aria-selected="false">Villa & Suites</a>-->
				<!--	</li>-->
				<!--</ul>-->
				
<!-tab section--->
<section id="scroll-tabs">				
        <div class="warpper">
          <div class="tabs">
              <!--scroll-tab-->
          <label class="tab" id="one-tab" for="one"><a href="#resort-filter" class="new_one_btn">RESORTS</a></label>
          <label class="tab" id="two-tab" for="two"><a href="#villas-types" class="new_one_btn">VILLA TYPES</a></label>
            </div>
          </div>
        </div>
</section>
				
<!--<section id="nav-tabs" id="compare-tabs">-->
<!--               <div class="row mb-4 navTab-wrapper">-->
<!--                   <div class="col-md-4">-->
                       
<!--                   </div>-->
<!--                   <div class="col-md-2">-->
<!--                            <ul class="nav nav-pills">-->
<!--                                  <li class="nav-item">-->
<!--                                    <a class="nav-link" id="tab-Resort" aria-current="page" href="#resort-filter">Resorts</a>-->
<!--                                  </li>-->
<!--                            </ul>-->
<!--                   </div>-->
<!--                   <div class="col-md-2">-->
<!--                            <ul class="nav nav-pills">-->
<!--                                  <li class="nav-item">-->
<!--                                    <a class="nav-link" id="tab-villas" href="#villas-types">Villa Types</a>-->
<!--                                  </li>-->
<!--                            </ul>-->
<!--                   </div>-->
<!--                   <div class="col-md-4">-->
                       
<!--                   </div>-->
<!--               </div>-->
<!--    </section>-->
	<!--End tabs html-->
	<section id="resort-filter">
				<div class="tab-content" id="myTabContent">
					<div class="tab-pane fade show active pt-5 pb-5 " id="resort" role="tabpanel" aria-labelledby="resort-tab">
                        <div class="compare-hotel-container">
                            <div class="container-fluid">
                                <div id="compare_htm">
				                    <form id="compare_frm" method="post" onsubmit="return false;">
                                        <div class="row my-3">

                                            <div class="col-lg-4 col-md-12 mb-2">
                                                <div>
                                                    <select class="custom-select mr-sm-2" name="resort_1" id="select_resort_one" onchange="resort_new_1();">
                                                        <option value="">Choose.....</option>
                                                        <?php 
                                                            if(!empty($resorts)){
                                                                foreach($resorts as $resort){
                                                                    if($this->input->post('resort_1')&&$this->input->post('resort_1')==$resort->id){
                                                                        echo '<option selected value="'.$resort->id.'">'.$resort->resort_name.'</option>';
                                                                    }else{
                                                                        
                                                                        echo '<option value="'.$resort->id.'">'.$resort->resort_name.'</option>';
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 mb-2">
                                                <div>
                                                    <select class="custom-select mr-sm-2" name="resort_2" id="select_resort_two" onchange="resort_new_2();">
                                                        <option value="">Choose...</option>
                                                        <?php 
                                                        if(!empty($resorts)){
                                                            foreach($resorts as $resort){
                                                                if($this->input->post('resort_2')&&$this->input->post('resort_2')==$resort->id){
                                                                    echo '<option selected value="'.$resort->id.'">'.$resort->resort_name.'</option>';
                                                                }else{
                                                                    echo '<option value="'.$resort->id.'">'.$resort->resort_name.'</option>';
                                                                }
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-4 col-md-12 mb-2">
                                                <div>
                                                    <select class="custom-select mr-sm-2" name="resort_3" id="select_resort_three" onchange="resort_new_3();">
                                                        <option value="">Choose...</option>
                                                        <?php 
                                                            if(!empty($resorts)){
                                                                foreach($resorts as $resort){
                                                                    if($this->input->post('resort_3')&&$this->input->post('resort_3')==$resort->id){
                                                                        echo '<option selected value="'.$resort->id.'">'.$resort->resort_name.'</option>';
                                                                    }else{
                                                                        echo '<option value="'.$resort->id.'">'.$resort->resort_name.'</option>';
                                                                    }
                                                                }
                                                            }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div id="resort_data"></div>
                                <div id="table_data"></div>
                            </div>
                        </div>
					</div>
					<!--<div class="tab-pane fade pt-5" id="villa-resorts" role="tabpanel" aria-labelledby="villa-resorts-tab">-->
                       
                    <!--</div>-->
				</div>
			</div>
		</div>
	 </div>
	</section>
	<!--End resort section-->
	

<?php 
    if(!empty($banner_caption_imgs)) {
    foreach($banner_caption_imgs as $caption_img1) {
    	$bannerImaage1 = $caption_img1->image_name;
    }
    }
?>

	<section class="new_slider_img" style="background-image:url('<?php echo base_url('uploads/caption/' . $bannerImaage1); ?>');background-size: cover;background-position: left center;"> 
	   <div class="text_new">
	       <h2><?php if(!empty($banner_caption->caption_title)) { echo $banner_caption->caption_title, " "; } ?></h2>
	   </div>     
	</section>    
	
	
	<!--villa types section-->
	<div class="featured_resorts" style="text-align:center;margin-top:80px;margin-top: 80px;
    text-transform: uppercase;">
				<h2>Villas & Suites</h2>
				<img src="https://demogswebtech.com/maldives/assets/front/images/Rectangle6.png" alt="" class="img-fluid">
	<section id="villas-types">
	    <div class="container">
	         <div class="compare-hotel-container">
                            <div class="container-fluid">
                                <div class="villas-pill villas-numbers mb-4">
                                    <div>
                                        <div>
                                            <select class="custom-select" name="villa_rooms" id="villa_rooms">
                                              <option value="">No. of Villas</option>
                                                  <?php 
                                                    for($i=1;$i<10;$i++) {
                                                      ?>
                                                        <option value="<?php echo $i;?>"><?php echo $i;?></option>
                                                      <?php
                                                    }
                                                  ?>
                                                  <option value="10+">10+</option>
                                            </select>                                                                  
                                            <!-- <select class="custom-select" id="villa_rooms" >-->
                                            <!--    <option value="">Choose Rooms</option>-->
                                            <!--    <option value="1_10">1 - 10 Rooms</option>-->
                                            <!--    <option value="11_50">11 - 50 Rooms</option>-->
                                            <!--    <option value="51_100">51 - 100 Rooms</option>-->
                                            <!--    <option value="100_150">100 - 150 Rooms</option>-->
                                            <!--    <option value="151"> More than 151 Rooms</option>-->
                                            <!--</select>-->
                                        </div>
                                    </div>
                                    <div class="pill-container" id="tab-right">
                                        <?php 
                                            foreach($villa_type as $villa){ ?>
                                                <label for="<?php echo $villa->id;?>" class="btn expbutton" onclick="select_villa_type('<?php echo $villa->id; ?>');">
                                                    <input type="checkbox" id="<?php echo $villa->id;?>" name="test[]" value="<?= $villa->id; ?>"  class="badgebox">
                                                    <span><?php echo $villa->villa_type; ?><i class="fa fa-close"></i></span>
                                                </label>
                                                <?php 
                                            }
                                        ?>
                                    </div>
                                </div>
                                <form id="compare_villa_frm" method="post" onsubmit="return false;">
                                <div class="row my-3">
                                    <div class="col-lg-4 col-md-12 mb-2">
                                        <div>
                                            <select class="custom-select" name="villa_type_1" id="select_villa_1" onchange="fun_villa_type_1();">
                                                <option value="">Choose...</option>
                                                <?php  foreach($villa_type_name as $villaname){ ?>
                                                <option value="<?php echo $villaname->id;?>"><?php echo $villaname->name_of_villa;?></option>
                                                
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 mb-2">
                                        <div>
                                            <select class="custom-select" name="villa_type_2" id="select_villa_2" onchange="fun_villa_type_2();">
                                                <option value="">Choose...</option>
                                                <?php  foreach($villa_type_name as $villaname){ ?>
                                                <option value="<?php echo $villaname->id;?>"><?php echo $villaname->name_of_villa;?></option>
                                                
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 mb-2">
                                        <div>
                                            <select class="custom-select" name="villa_type_3" id="select_villa_3" onchange="fun_villa_type_3();">
                                                <option value="">Choose...</option>
                                                <?php  foreach($villa_type_name as $villaname){ ?>
                                                <option value="<?php echo $villaname->id;?>"><?php echo $villaname->name_of_villa;?></option>
                                                
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                </form>
                                <div class="compare-card" id="villa_data"></div>
                                <div id="villa_table_data"></div>

                                
                                
                            </div>
                        </div>
                    	
	    </div>
	</section>
	</div>
	<!--Title-->
	<!--villas section-->
	
	
	

<script type="text/javascript">
    function resort_new_1(){
      $.ajax({ 
        url:base_url+"home/resort_com?type=1",
        type:"POST",
        data:$("#compare_frm").serialize(),  
        success: function(html){
          var response = $.parseJSON(html);   
          //console.log('secound_sql ='+response.secound_sql);
          //console.log('third_sql ='+response.third_sql);
          if(response.secound_html){ 
            $('#select_resort_two').show().html(response.secound_html);
          }
          if(response.third_html){ 
            $('#select_resort_three').show().html(response.third_html);
          }
          compare_htm();
        }
      });
    }
    function resort_new_2(){
      $.ajax({ 
        url:base_url+"home/resort_com?type=2",
        type:"POST",
        data:$("#compare_frm").serialize(), 
        success: function(html){
          var response = $.parseJSON(html);   
          //console.log('secound_sql ='+response.secound_sql);
          //console.log('third_sql ='+response.third_sql);
          if(response.first_html){ 
            $('#select_resort_one').show().html(response.first_html);
          }
          if(response.third_html){ 
            $('#select_resort_three').show().html(response.third_html);
          }
          compare_htm();
        }
      });
    }
    function resort_new_3(){
      $.ajax({ 
        url:base_url+"home/resort_com?type=3",
        type:"POST",
        data:$("#compare_frm").serialize(), 
        success: function(html){
          var response = $.parseJSON(html);   
          //console.log('secound_sql ='+response.secound_sql);
          //console.log('third_sql ='+response.third_sql);
          if(response.first_html){ 
            $('#select_resort_one').show().html(response.first_html);
          }
          if(response.secound_html){ 
            $('#select_resort_two').show().html(response.secound_html);
          }
          compare_htm();
        }
      });
    }
    function compare_htm() {
      $.ajax({ 
        url:base_url+"home/compare_htm",
        type:"POST",
        data:$("#compare_frm").serialize(), 
        success: function(html){
          var response = $.parseJSON(html);  
          $('#resort_data').html(response.resort_data);
          $('#table_data').html(response.compair_data); 
        }                
      }); 
    }
  </script>
  <!-- Vill Section ---->
  
  <script type="text/javascript">
	function select_villa_type(villa_type){
    var villa_rooms = $('#villa_rooms').val();
    
		$.ajax({ 
        url:base_url+"home/villa_type_accomandation?villa_type="+villa_type+"&villa_rooms="+villa_rooms,
        type:"POST",
       data:$("#compare_villa_frm").serialize(),
        success: function(html){
          $('#villa_data').html('');
			var response = $.parseJSON(html); 
			$('#select_villa_1').html(response.villa_select_html);
			$('#select_villa_2').html(response.villa_select_html);
			$('#select_villa_3').html(response.villa_select_html);
			$('#villa_table_data').html(''); 
			
        }
      });
	}
	
	
    function fun_villa_type_1(){
      $.ajax({ 
        url:base_url+"home/villa_compare?type=1",
        type:"POST",
        data:$("#compare_villa_frm").serialize(),  
        success: function(html){
          var response = $.parseJSON(html);   
          if(response.villa_secound_html){ 
            //$('#select_villa_2').show().html(response.villa_secound_html);
          }
          if(response.villa_third_html){ 
            //$('#select_villa_3').show().html(response.villa_third_html);
          }
          compare_vill_htm();
        }
      });
    }
    function fun_villa_type_2(){
      $.ajax({ 
        url:base_url+"home/villa_compare?type=2",
        type:"POST",
        data:$("#compare_villa_frm").serialize(), 
        success: function(html){
          var response = $.parseJSON(html);   
         if(response.villa_first_html){ 
            //$('#select_villa_1').show().html(response.villa_first_html);
          }
          if(response.villa_third_html){ 
            //$('#select_villa_3').show().html(response.villa_third_html);
          }
          compare_vill_htm();
        }
      });
    }
    function fun_villa_type_3(){
      $.ajax({ 
        url:base_url+"home/villa_compare?type=3",
        type:"POST",
        data:$("#compare_villa_frm").serialize(), 
        success: function(html){
          var response = $.parseJSON(html);   
          if(response.villa_first_html){ 
            //$('#select_villa_1').show().html(response.villa_first_html);
          }
          if(response.secound_html){ 
            //$('#select_villa_2').show().html(response.villa_secound_html);
          }
          compare_vill_htm();
        }
      });
    }
    function compare_vill_htm() {
      $.ajax({ 
        url:base_url+"home/compare_villa_htm",
        type:"POST",
        data:$("#compare_villa_frm").serialize(), 
        success: function(html){
          var response = $.parseJSON(html);  
          if(response.villa_data){            
            $('#villa_data').html(response.villa_data);
          }
           $('#villa_table_data').html(response.villa_compare_data); 

        //   if(response.villa_data){            
        //     $('#villa_data').html(response.villa_data);
        //   }
        //   if(response.villa_data_2){            
        //     $('#villa_data_2').html(response.villa_data_2);
        //   }
        //   if(response.villa_data_3){            
        //     $('#villa_data_3').html(response.villa_data_3);
        //   }
        }                
      }); 
    }
	$(document).ready(function(){
    $( "#mySeachTextBox" ).blur(function() {
      $('#mySeachButton').show();
        $('#divmySeachTextBox').hide();
    });
    $("#mySeachButton").click(function(){
      $('#mySeachButton').hide();
      $('#divmySeachTextBox').show();
      $('#mySeachTextBox').focus();

    });
		$('#villa_rooms').change(function(){			
    var villa_rooms = $(this).val();
		$.ajax({ 
			url:base_url+"home/villa_type_accomandation?villa_rooms="+villa_rooms,
			type:"POST",
			data:{'room_min_val':villa_rooms},
			success: function(html){
        $('#villa_data').html('');
				var response = $.parseJSON(html); 
				$('#select_villa_1').html(response.villa_select_html);
				$('#select_villa_2').html(response.villa_select_html);
				$('#select_villa_3').html(response.villa_select_html);
				$('#villa_table_data').html(''); 
				
			}
		  });
		});
	});
  </script>
  <script src="<?php echo  FRONT_THEAM_PATH ;?>js/owl.carousel.min.js"></script>
