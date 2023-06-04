<!-- Content Header (Page header) -->
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
                Select blog
              </label>    
              <select name="news_blog_id" class="form-control" required="">
                <option value="">Select Blog</option>
                <?php 
                if(!empty($blogs_list)){
                  foreach($blogs_list as $blogvalue){
                    ?>
                    '<option 
                        <?php
                         if(!empty($row->news_blog_id)&&$row->news_blog_id==$blogvalue->id){ 
                          echo 'selected';
                         }
                        ?>
                       value='<?= $blogvalue->id ?>'><?= ucfirst($blogvalue->news_title).'('.ucfirst($blogvalue->tags).')' ?></option>';                  
                    <?php
                  }
                }
                ?>
              </select>
              <?php echo form_error('news_blog_id'); ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                Banner Title
              </label>     
              <input type="text" placeholder="News Title" class="form-control" name="banner_title" required value="<?php if(set_value('banner_title')){echo set_value('banner_title');}else{ if(!empty($row->banner_title)){ echo $row->banner_title;}}   ?>">
              <?php echo form_error('banner_title'); ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
               Banner Image
              </label>     
              <!-- <input type="file" class="form-control" name="user_img" multiple=""> -->
              <?php 
                if(!empty($row->banner_image))
                {
                   ?>
                    <input type="file" class="form-control"  name="banner_image" >
                   <?php
                }else{
                  ?>
                    <input type="file" class="form-control"  name="banner_image"  required="">
                  <?php
                }
              ?>       
               <!-- News image need to be atleast <font>30 x 30</font> pixels and maximum <font>2000 x 2000</font> pixels -->
              <?php echo form_error('banner_image'); ?>
            </div>   
            <div class="form-group">
              <label for="exampleInputEmail1">
                News Description
              </label>   
              <textarea placeholder="News Description"   rows="15" class="form-control tinymce_edittor" name="details_html"><?php if(set_value('details_html')){echo set_value('details_html');}elseif(!empty($row->details_html)){ echo $row->details_html;}   ?></textarea>
              <?php echo form_error('details_html'); ?>
            </div>   
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