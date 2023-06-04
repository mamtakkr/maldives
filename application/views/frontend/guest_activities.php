<style type="text/css">
   	.story_head{margin-bottom: 0px !important; }
   	.activity-list{ width: 100%;  border:1px solid #ddd;}
   	.activity-list li {float: left;width: 100%; border: 1px solid #ddd; padding: 25px; margin-bottom:20px; position: relative;}
	.user-info {float: left;margin-left: 39px;}
	.user-info img {width: 50px;height: 50px;border-radius: 100%;}
	.user-name{ padding-left: 20px; }
	.activity-list li .fa { position: absolute;top: 0px;left: 0px;font-size: 30px;color: #35C2BD;} 
	.times{ float: right; }
	.resort-info img{ width: 150px; float: left;}
	.resort-info .activity_name{ float: right;  width: calc(100% - 160px);}
	.experience .hide_btn{ display: none; }
</style>
<?php
   $user = user_info();
?>
<div class="pr-0">
    <div class="resort-title-card">
        <div class="row">
           <div class="col-7">
              <h6 id="guest_tab_title"><?php echo (!empty($user_type)&&$user_type==1)?'Activities':'Guest Activities'; ?></h6>
           </div>
           <div class="col-5 add-resort"></div>
        </div>
     </div>
     <div class="clearfix"></div>
     	<form onsubmit="return false;" method="POST" action="" id="activity_frm">
			<input type="hidden" id="page_num" name="page_num"  value="0">
			<input type="hidden" id="total_pages" name="total_pages" value="<?php echo !empty($activity_count)?$activity_count:""; ?>">
		    <div class="row">
		    	<div class="col-sm-12">
                    <ul class="activity-list" id="activity_list"><?php include('activity_list.php'); ?>
                    </ul>
	                <?php 
	                if(!empty($activity_count)&&$activity_count>PER_PAGE_STORY){ ?>
	                <div class="experience text-center mb-4">
	                   <div style="display: inline-block; width: auto; float: none;">
	                      <a href="javascript:void(0);" onclick="read_back_activity();" class="btn hide_btn" id="read_back_activity" style="float: left">Back</a>
	                      <a href="javascript:void(0);" onclick="read_more_activity();" class="btn" id="read_more_activity" style="float: left; margin-left: 20px;">Read More</a>
	                   </div>
	                </div>
	                <?php }?>
              	</div> 
		    </div>
	    </form>
     <div class="clearfix"></div>
</div>
<script type="text/javascript">
	function read_more_activity(){
      var page_num 	  = $('#page_num').val();
      var total_pages = parseInt($('#total_pages').val());
      page_num 	= parseInt(page_num) + parseInt('<?php echo PER_PAGE_STORY; ?>');        
      $('#page_num').val(page_num);
      $.ajax({
         url:'<?php echo base_url(); ?>user/read_more_activity?page_num='+page_num,
         type:'POST',
         data:$("#activity_frm").serialize(),
         success:function(html){
            var json_obj = $.parseJSON(html);
            $('#activity_list').show().html(json_obj.html);
            $('#read_back_activity').css({'display':'block'});  
            page_num        = parseInt(page_num) + parseInt('<?php echo PER_PAGE_STORY; ?>');         
            console.log('total_pages = '+total_pages+', page_num = '+page_num);  
            if(total_pages<=page_num){
               $('#read_more_activity').hide();
            }
         }
      });
   }
   function read_back_activity(){
      var page_num  = $('#page_num').val();
      var total_pages = parseInt($('#total_pages').val());
      page_num      = parseInt(page_num) - parseInt('<?php echo PER_PAGE_STORY; ?>');
      $.ajax({
         url:'<?php echo base_url(); ?>user/read_more_activity?page_num='+page_num,
         type:'POST',
         data:$("#activity_frm").serialize(),
         success:function(html){ 
            var json_obj = $.parseJSON(html);
            $('#activity_list').show().html(json_obj.html);
            $('#total_pages').val(total_pages);            
            $('#page_num').val(page_num);
            if(parseInt(page_num)<=parseInt(0)){
               $('#read_back_activity').hide();
            }
            $('#read_more_activity').show();
         }
      });
   } 
</script>