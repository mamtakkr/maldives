<!-- Content Header (Page header) -->
<?php
$blog_category = $this->common_model->get_result('blog_category', array('status' => 1));
?>
<section class="content-header tab_header">
  <h1>
    <?php if(!empty($title)) echo $title; ?>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL; ?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li><a href="<?php echo ADMIN_URL.'blogs'; ?>">Blogs List</a></li>
    <li class="active"><?php if(!empty($title)) echo $title; ?></li>
  </ol>
</section>
<style type="text/css">
  .bootstrap-tagsinput {
    width: 100% !important;
    height: calc(4.25rem + 2px) !important;
    padding: .375rem .75rem !important;
    background-clip: padding-box !important;
    transition: border-color .15s ease-in-out,box-shadow .15s ease-in-out;
    line-height: 1.5 !important;
    font-size: 2.1rem !important;
    font-weight: 400;
}
  .label-info {
      background-color: #5bc0de;
  }
  .bootstrap-tagsinput .label {
      display: inline;
      padding: .2em .6em .3em;
      font-size: 75%;
      font-weight: 700;
      line-height: 1;
      color: #fff;
      text-align: center;
      white-space: nowrap;
      vertical-align: baseline;
      border-radius: .25em;
  }
</style>
<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-10 col-md-offset-1">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">              
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="" method="post" enctype="multipart/form-data">
          <div class="box-body">  
            <div class="form-group">
              <label for="exampleInputEmail1">
                Blog User 
              </label>    
              <select name="news_added_user" class="form-control">
                <option value="">Select User</option>
                <?php 
                if(!empty($users)){
                  foreach($users as $user){
                    if(set_value('news_added_user')&&set_value('news_added_user')==$user->id){
                      echo '<option selected="selected" value="'.$user->id.'">'.ucfirst($user->first_name).' '.ucfirst($user->last_name).'</option>';
                    }elseif(!empty($row->news_added_user)&&$row->news_added_user==$user->id){ 
                      echo '<option selected="selected" value="'.$user->id.'">'.ucfirst($user->first_name).' '.ucfirst($user->last_name).'</option>';
                    }else{
                      echo '<option value="'.$user->id.'">'.ucfirst($user->first_name).' '.ucfirst($user->last_name).'</option>';
                    }                    
                  }
                }
                ?>
              </select>
              <?php echo form_error('news_added_user'); ?>
            </div>
            <!--<div class="form-group">-->
            <!--  <label for="exampleInputEmail1">-->
            <!--  Page Banner Title-->
            <!--  </label>     -->
            <!--  <input type="text" placeholder="News Title" class="form-control" name="page_banner_title" required value="<?php if(set_value('page_banner_title')){echo set_value('page_banner_title');}else{ if(!empty($row->page_banner_title)){ echo $row->page_banner_title;}}   ?>">-->
            <!--  <?php echo form_error('banner_title'); ?>-->
            <!--</div>-->
            <div class="form-group">
              <label for="exampleInputEmail1">
              Page Banner Image
              </label>     
              <!-- <input type="file" class="form-control" name="user_img" multiple=""> -->
              <?php 
                if(!empty($row->page_banner_image))
                {
                   ?>
                    <input type="file" class="form-control"  name="page_banner_image" >
                   <?php
                }else{
                  ?>
                    <input type="file" class="form-control"  name="page_banner_image" >
                  <?php
                }
              ?>       
               <!-- News image need to be atleast <font>30 x 30</font> pixels and maximum <font>2000 x 2000</font> pixels -->
              <?php echo form_error('page_banner_image'); ?>
            </div>  
            <div class="form-group">
              <label for="exampleInputEmail1">
                News Title
              </label>     
              <input type="text" placeholder="News Title" class="form-control" name="news_title" value="<?php if(set_value('news_title')){echo set_value('news_title');}else{ if(!empty($row->news_title)){ echo $row->news_title;}}   ?>">
              <?php echo form_error('news_title'); ?>
            </div>
            
            <div class="form-group">
              <label for="exampleInputEmail1">
                Blog Category 
              </label>    
              <select name="blog_category" class="form-control">
                <option value="">Select Category</option>
                <?php 
                if(!empty($blog_category)){
                  foreach($blog_category as $b_cat){
                    if(set_value('blog_category')&&set_value('blog_category')==$b_cat->blog_cat_id){
                      echo '<option selected="selected" value="'.$b_cat->blog_cat_id.'">'.ucfirst($b_cat->blog_cat_name).'</option>';
                    }elseif(!empty($row->blog_category)&&$row->blog_category==$b_cat->blog_cat_id){ 
                      echo '<option selected="selected" value="'.$b_cat->blog_cat_id.'">'.ucfirst($b_cat->blog_cat_name).'</option>';
                    }else{
                      echo '<option value="'.$b_cat->blog_cat_id.'">'.ucfirst($b_cat->blog_cat_name).'</option>';
                    }                    
                  }
                }
                ?>
              </select>
              <?php echo form_error('blog_category'); ?>
            </div>
            
            <div class="form-group">
              <label for="exampleInputEmail1">
                News Description
              </label>   
              <textarea placeholder="News Description" rows="15" class="form-control tinymce_edittor" name="news_description">
                  <?php if(set_value('news_description')){echo set_value('news_description');}elseif(!empty($row->news_description)){ echo $row->news_description;}?></textarea>
              <?php echo form_error('news_description'); ?>
            </div>   
            <div class="form-group">
              <label for="exampleInputEmail1">
                Tag
              </label>     
              <input type="text" placeholder="Tags....." class="form-control" name="tags" value="<?php if(set_value('tags')){echo set_value('tags');}else{ if(!empty($row->tags)){ echo $row->tags;}}   ?>" data-role="tagsinput">
              <?php echo form_error('tags'); ?>
            </div>           
            <div class="form-group">
              <div id="file_html_1" style="width: 100%; float: left;">
                <?php
                if(!empty($images)){
                  foreach($images as $image){ 
                    $del_fun  = "deleteImages('".$image->id."','".$image->image_name."','1');";
                    echo '<div class="image_li" id="'.$image->id.'"><img src="'.base_url().'uploads/blogs/'.$image->image_name.'" class="img_banner thumimgs"><a href="javascript:void(0);" onclick="'.$del_fun.'" class="btn btn-sm btn-danger deleteSchoolImg"><i class="fa fa-trash" aria-hidden="true"></i></a></div>';
                  }
                }
                ?>                  
                </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
               News Image
              </label>     
              <!-- <input type="file" class="form-control" name="user_img" multiple=""> -->
              <!--<input type="file" class="form-control" id="uploadFile1" name="user_img[]" onchange="uploadMultipleFileImage('1', 'blogs');" multiple="">-->
              <input type="file" class="form-control" id="uploadFile1" name="user_img[]" onchange="uploadMultipleFileImage('1', 'blogs');">
              <input type="hidden" name="blog_files" id="file_name_1" />
              <div id="file_html_1"></div>
              <div class="note-msg">
               News image need to be atleast <font>30 x 30</font> pixels and maximum <font>2000 x 2000</font> pixels
              </div>
              <?php echo form_error('user_img'); ?>
            </div>   
            <input type="hidden" name="submit" value="submit">
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
  </div>
  <!-- /.row -->
</section>   