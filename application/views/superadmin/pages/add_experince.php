
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
    <li><a href="<?php echo ADMIN_URL.'pages/acommodation_list'; ?>">Experince List</a></li>
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
               Title         
              </label>  
              <input  type="text" placeholder="Title" class="form-control" name="title" value="<?php if(set_value('title')){echo set_value('title');}else if(!empty($row->title)){ echo $row->title;}?>"></textarea>
              <?php echo form_error('title'); ?>
            </div>

            <div class="form-group">
              <label for="exampleInputEmail1">
               Description         
              </label>  
              <textarea  placeholder="description" class="form-control tinymce_edittor" name="description"><?php if(set_value('question')){echo set_value('description');}else if(!empty($row->description)){ echo $row->description;}?></textarea>
              <?php echo form_error('description'); ?>
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