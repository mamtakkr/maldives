<style type="text/css">
  .compare td {
    vertical-align: top;
  }

  
</style>
<div class="hero">
  <div class="hero-image">
    <div class="custom1 owl-carousel owl-theme">
      <?php 
      if(!empty($caption_imgs)){
        foreach($caption_imgs as $caption_img){
           if(!empty($caption_img->image_name)&&file_exists('uploads/caption/full_image/1300_'.$caption_img->image_name)){?>
              <div class="item"> 
                <div class="caption_heading">
                  <?php 
                  echo !empty($caption->caption_title)?'<div class="text_holder">'.$caption->caption_title.'</div>':''; 
                  echo !empty($caption->caption_sub_title)?'<div class="text_sub_holder">'.$caption->caption_sub_title.'</div>':'';  
                  ?>
               </div>
                <img src="<?php echo  base_url('uploads/caption/full_image/1300_'.$caption_img->image_name); ;?>"> 
              </div>
           <?php 
           }
        }
      }
     ?>
    </div>
  </div>
</div>  
  <!--== RESORT START ==-->
  <section class="resort bg-transparent">
    <div class="container-fluid p-0">
      <div class="container">
        <div class="compare-card-wrapp pt-1">
          <section class="holidays pt-0">
            <div class="title text-center mb-4">
              <h2>Inspire Me</h2>
            </div>


            <div class="dis_show">
                <!--  Demos -->
                <section id="demos">
                  <div class="row">
                    <div class="container">
                      <div class="owl-carousel owl-theme">
                        <?php 
                        if(!empty($holidays)){
                          foreach($holidays as $holiday){
                            if(!empty($holiday->holiday_image)&&file_exists('uploads/holidays/thumbnails/500_'.$holiday->holiday_image)){?>
                              <div class="item">
                                <img src="<?php echo base_url('uploads/holidays/thumbnails/500_'.$holiday->holiday_image); ?>" alt="">
                                <center><h4><?php echo !empty($holiday->holiday_name)?ucfirst($holiday->holiday_name):''; ?></h4></center>
                              </div>
                              <?php 
                            }
                          }
                        }?>
                      </div>
                      
                     </div>
                  </div>
                </section>
            </div>
          <div class="dis_show1">
            <div class="row">
              <?php 
              if(!empty($holidays)){
                foreach($holidays as $holiday){
                  if(!empty($holiday->holiday_image)&&file_exists('uploads/holidays/thumbnails/500_'.$holiday->holiday_image)){?>
                    <div class="col-md-4 col-sm-6 col-12">
                      <a href="<?php echo base_url('home/resorts?holiday_id='.$holiday->id); ?>" class="holiday_thumb_main">
                        <img src="<?php echo  base_url('uploads/holidays/thumbnails/500_'.$holiday->holiday_image) ;?>" alt=""/>
                        <h4><?php echo !empty($holiday->holiday_name)?ucfirst($holiday->holiday_name):''; ?></h4>
                      </a>
                    </div>
                  <?php 
                  }
                }
              }
              ?> 
            </div></div>
          </section>
          <div class="clearfix"></div>
          <h2>Compare Resorts</h2>
          <div class="compare" id="compare_htm">
            <form id="compare_frm" method="post" onsubmit="return false;">
              <div class="table-responsive">
                <table width="100%" border="0" class="table">                  
                  <thead>
                    <tr>
                      <td><div class="compare-title">&nbsp;</div></td>
                      <td valign="top">
                        <div class="resort-name-com">            
                          <select class="custom-select mr-sm-2" name="resort_1" id="select_resort_one" onchange="resort_new_1();">
                            <option value="">Choose...</option>
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
                      </td>
                      <td valign="top">
                        <div class="resort-name-com">
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
                      </td>                 
                      <td valign="top">
                        <div class="resort-name-com">
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
                      </td>
                    </tr>
                    <tr>
                      <td><div class="compare-title">&nbsp;</div></td>
                      <td valign="top">
                        <div class="compare-card" id="resort_data_1"></div>
                      </td>
                      <td valign="top">
                        <div class="compare-card" id="resort_data_2"></div>
                      </td>                 
                      <td valign="top">
                        <div class="compare-card" id="resort_data_3"></div>
                      </td>
                    </tr>
                  </thead>
                 <tbody id="table_data"></tbody>
                </table>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
    <div class="clearfix"></div>
  </section>
  <div class="clearfix"> </div>
  <script type="text/javascript">
    function resort_new_1(){
      $.ajax({ 
        url:base_url+"home/resort_com?type=1",
        type:"POST",
        data:$("#compare_frm").serialize(),  
        success: function(html){
          var response = $.parseJSON(html);   
          console.log('secound_sql ='+response.secound_sql);
          console.log('third_sql ='+response.third_sql);
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
          console.log('secound_sql ='+response.secound_sql);
          console.log('third_sql ='+response.third_sql);
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
          console.log('secound_sql ='+response.secound_sql);
          console.log('third_sql ='+response.third_sql);
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
          $('#table_data').html(response.compair_data); 
          if(response.resort_data_1){            
            $('#resort_data_1').html(response.resort_data_1);
          }
          if(response.resort_data_2){            
            $('#resort_data_2').html(response.resort_data_2);
          }
          if(response.resort_data_3){            
            $('#resort_data_3').html(response.resort_data_3);
          }
        }                
      }); 
    }
  </script>

  <script>
            $(document).ready(function() {
              var owl = $('.owl-carouse');
              owl.owlCarouse({
                items: 3,
                loop: true,
                margin: 10,
                autoplay: false,
                autoplayTimeout: 1000,
                autoplayHoverPause: true
              });
              $('.play').on('click', function() {
                owl.trigger('play.owl.autoplay', [1000])
              })
              $('.stop').on('click', function() {
                owl.trigger('stop.owl.autoplay')
              })
            })
          </script>

         <script>
            $(document).ready(function() {
              var owl = $('.owl-carousel');
              owl.owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                autoplay: false,
                autoplayTimeout: 2000,
                autoplayHoverPause: true
              });
              $('.play').on('click', function() {
                owl.trigger('play.owl.autoplay', [2000])
              })
              $('.stop').on('click', function() {
                owl.trigger('stop.owl.autoplay')
              })
            })
          </script>