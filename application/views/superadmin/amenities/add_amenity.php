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
    <li><a href="<?php echo ADMIN_URL.'amenities'; ?>">Amenity List</a></li>
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
        <form action="" method="post" enctype="multipart/form-data">
          <div class="box-body">  
            <div class="form-group">
              <label for="exampleInputEmail1">
                Amenity Category
              </label>    
              <select name="category_id" class="form-control">
                <option value="">Select Category</option>
                <?php 
                if(!empty($categorys)){
                  foreach($categorys as $category){
                    if(set_value('category_id')&&set_value('category_id')==$category->id){
                      echo '<option selected="selected" value="'.$category->id.'">'.ucfirst($category->category_name).'</option>';
                    }elseif(!empty($row->category_id)&&$row->category_id==$category->id){ 
                      echo '<option selected="selected" value="'.$category->id.'">'.ucfirst($category->category_name).'</option>';
                    }else{
                      echo '<option value="'.$category->id.'">'.ucfirst($category->category_name).'</option>';
                    }                    
                  }
                }
                ?>
              </select>
              <?php echo form_error('category_id'); ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                Amenity Name
              </label>     
              <input type="text" placeholder="Amenity Name" class="form-control" name="amenitie_name" value="<?php if(set_value('amenitie_name')){echo set_value('amenitie_name');}else{ if(!empty($row->amenitie_name)){ echo $row->amenitie_name;}}   ?>">
              <input type="hidden" name="is_image" value="<?php echo !empty($row->amenitie_icon)?$row->amenitie_icon:''; ?>">
              <?php echo form_error('amenitie_name'); ?>
            </div>              
            <div class="form-group">
              <?php  echo (!empty($row->amenitie_icon)&&file_exists('uploads/amenities/thumbnails/'.$row->amenitie_icon))?'<img src="'.base_url().'uploads/amenities/thumbnails/'.$row->amenitie_icon.'" style="max-width:150px"/>':'';
                  ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
               Amenity Icon
              </label>     
              <input type="file" class="form-control" name="user_img">
              <div class="note-msg">
               Amenity Icon need to be atleast <font>30 x 30</font> pixels and maximum <font>2000 x 2000</font> pixels
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