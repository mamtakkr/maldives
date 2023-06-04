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
    <li><a href="<?php echo ADMIN_URL.'categorys'; ?>">category List</a></li>
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
                Category Name
              </label>     
              <input type="text" placeholder="Category Name" class="form-control" name="category_name" value="<?php if(set_value('category_name')){echo set_value('category_name');}else{ if(!empty($row->category_name)){ echo $row->category_name;}}   ?>">
                 <?php echo form_error('category_name'); ?>
            </div>    
            <div class="form-group">
              <label for="exampleInputEmail1">
                Number of Star
              </label>     
              <input type="text" placeholder="Number of Star" class="form-control" name="no_of_star" value="<?php if(set_value('no_of_star')){echo set_value('no_of_star');}else{ if(!empty($row->no_of_star)){ echo $row->no_of_star;}}   ?>">
                 <?php echo form_error('no_of_star'); ?>
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