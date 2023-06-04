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
    <li><a href="<?php echo ADMIN_URL.'cms/caption'; ?>">Caption List</a></li>
    <li class="active"><?php if(!empty($title)) echo $title; ?></li>
  </ol>
</section>
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
        <?php 
        $pages = array('home'=>'Home', 'home/resorts' =>'Resorts', 'home/inspire_me' =>'Inspire Me', 'home/maldives' =>'Maldives','home/reviews' =>'Reviews', 
                        'home/term_and_services' =>'Term & Services', 'home/blogs' =>'Blogs', 'home/privacy_policy'=>'Privacy Policy','home/transfers' =>'Transfer',
                        'home/galllery'=>'Galllery','home/compare'=>'Compare','home#banner'=>'Home/banner','home/compare#banner'=>'Compare/banner');
        ?>
        <form action="" method="post" enctype="multipart/form-data">
          <div class="box-body">  
            <div class="form-group">
              <label for="exampleInputEmail1">
                Page Name 
              </label>    
              <select name="page_url" class="form-control">
                <option value="">Select Page</option>
                <?php 
                if(!empty($pages)){
                  foreach($pages as $key => $page){
                    if(set_value('page_url')&&set_value('page_url')==$key){
                      echo '<option selected="selected" value="'.$key.'">'.ucfirst($page).'</option>';
                    }elseif(!empty($row->page_url)&&$row->page_url==$key){ 
                      echo '<option selected="selected" value="'.$key.'">'.ucfirst($page).'</option>';
                    }else{
                      echo '<option value="'.$key.'">'.ucfirst($page).'</option>';
                    }                    
                  }
                }
                ?>
              </select>
              <?php echo form_error('page_url'); ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                Caption Title
              </label>   
              <textarea placeholder="caption title" rows="5" class="form-control" name="caption_title"><?php if(set_value('caption_title')){echo set_value('caption_title');}elseif(!empty($row->caption_title)){ echo $row->caption_title;}   ?></textarea>
              <?php echo form_error('caption_title'); ?>
            </div>  
            <div class="form-group">
              <label for="exampleInputEmail1">
                Caption Sub Title
              </label>   
              <textarea placeholder="caption sub title" rows="5" class="form-control" name="caption_sub_title"><?php if(set_value('caption_sub_title')){echo set_value('caption_sub_title');}elseif(!empty($row->caption_sub_title)){ echo $row->caption_sub_title;}   ?></textarea>
              <?php echo form_error('caption_sub_title'); ?>
            </div>         
            <div class="form-group">
              <div id="file_html_1" style="width: 100%; float: left;">
                <?php
                //echo '<pre>';print_r($images); 
                if(!empty($images)){
                  foreach($images as $image){ 
                    if(!empty($image->image_name)&&file_exists('uploads/caption/'.$image->image_name)){
                      $fileNames = explode('.', $image->image_name);
                      $fileNames = end($fileNames);
                      $fileNames = strtolower($fileNames);
                      $del_fun   = "deleteImages('".$image->id."','".$image->image_name."','1');";
                      $fileHtml  = '';
                      if(!empty($fileNames)&&($fileNames=='png'||$fileNames=='jpeg'||$fileNames=='jpg')){
                        $fileHtml .= '<img src="'.base_url('uploads/caption/'.$image->image_name).'" class="img_banner thumimgs"/>';
                      }else if(!empty($fileNames)&&($fileNames=='pdf'||$fileNames=='mp4')){ 
                        $fileHtml .= '<iframe src="'.base_url('uploads/caption/'.$image->image_name).'" width="230"></iframe>';
                      } else if(!empty($fileNames)&&($fileNames=='doc'||$fileNames=='docx')){
                        $fileHtml .= '<a href="'.base_url('uploads/caption/'.$image->image_name).'"><img src="'.base_url('assets/front/images/word-download.png').'"/></a>';
                      }
                      echo '<div class="image_li" id="'.$image->id.'">'.$fileHtml.' <a href="javascript:void(0);" onclick="'.$del_fun.'" class="btn btn-sm btn-danger deleteSchoolImg"><i class="fa fa-trash" aria-hidden="true"></i></a></div>';
                    }
                  }
                }
                ?>                  
                </div>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
               Images 
              </label>     
              <!-- <input type="file" class="form-control" name="user_img" multiple=""> -->
              <input type="file" class="form-control" id="uploadFile1" name="user_img[]" onchange="uploadMultipleFileImage('1', 'caption');" multiple="">
              <input type="hidden" name="caption_files" id="file_name_1" />
              <div id="file_html_1"></div>
              <div id="file_html_1_error"></div>
              <div class="note-msg">
               Image need to be atleast <font>30 x 30</font> pixels and maximum <font>2000 x 2000</font> pixels
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