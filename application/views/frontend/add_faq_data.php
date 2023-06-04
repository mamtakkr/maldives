<?php
if(!empty($row->activities_image)){ 
   echo '<style type="text/css">
      #resort_activities_image_main_i .image-upload-wrap{ display:none;}
      #activities_image_main{ display:block;}
      #activities_image_main .file-upload-content{ display:block;}
   </style>';
}
?>
<div class="row" id="sortable">
   <?php 
   if(!empty($faqs)){
      foreach($faqs as $faq){?>
         <div class="col-md-12 cus_mov" id="faq_<?php 
               echo !empty($faq->id)?$faq->id:'';
               ?>">
            <div class="add-resort-card">
            <div class="add-resort-card-right1">
            <span class="villa-name-title">
               <?php 
                  echo !empty($faq->question)?$faq->question:'';
               ?>
            </span>
            <p>
               <?php 
               echo !empty($faq->answer)?$faq->answer:'';
               ?>
            </p>
            <a href="javascript:void(0);" onclick="edit_faq('<?php 
               echo !empty($faq->id)?$faq->id:'';
               ?>');" class="edit-icon">
               <i class="fa fa-pencil" aria-hidden="true"></i>
            </a>
            <a href="javascript:void(0);" onclick="delete_faq('<?php 
               echo !empty($faq->id)?$faq->id:'';
               ?>');" class="delete-icon">
               <i class="fa fa-times-circle" aria-hidden="true"></i>
            </a>
         </div>
            </div>
         </div>
         <?php                     
      }
   }
   ?>
</div>
<?php if(!empty($admin_faqs)) {?>
<div>
   <label for="exampleInputEmail1">Recommend FAQ Question</label>
   <?php 
         $cnt=0;
         foreach($admin_faqs as $k=>$v) {
            $cnt++;?>
            <div class="add-resort-card AdminFaq"><span style="font-weight:bold;"><?php echo $cnt.". ";?></span><span><?php echo $admin_faqs[$k]->question;?></span></div>
   <?php }
      ?>
</div>
<?php }?>
<div class="row">
   <div class="col-sm-12">
      <div class="resort-option">
         <div class="form-group">
            <label for="exampleInputEmail1">Question </label>
            <input type="text" name="question" id="questionNew" value="<?php if(!empty($row->question)){echo $row->question;} ?>" class="form-control" placeholder="Enter here">
            <input type="hidden" name="faq_id" value="<?php if(!empty($row->id)){echo $row->id;} ?>">
         </div>
      </div>
      <div class="resort-option">
         <div class="form-group">
            <label for="exampleInputEmail1">Answer</label>
            <textarea rows="3" cols="40" type="text" name="answer" class="form-control" placeholder="Enter here" maxlength="400"><?php if(!empty($row->answer)){echo $row->answer;} ?></textarea>
         </div>
      </div> 
   </div>
</div>
<style>
   .AdminFaq{
      cursor: pointer;
   }
</style>
<script>
   $('.AdminFaq').click(function(event) {
      $('#questionNew').val($(this).find('span:last').html());
   });
</script>