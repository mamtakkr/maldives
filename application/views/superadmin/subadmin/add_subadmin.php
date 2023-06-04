<!-- Content Header (Page header) -->
<style type="text/css">
  .list-inline {
    padding-left: 0;
    margin-left: -5px;
    list-style: none;
    border: 1px solid #dad7d7;
    padding: 10px 0px 10px 10px;
    border-radius: 5px;
    min-height: 105px;
  }
  .main_module label { cursor: pointer; }
  input[type=checkbox], input[type=radio] {    
    margin-top: 1px\9;
    line-height: normal;
  } 
</style>
<section class="content-header">
  <h1>
   <?php echo !empty($type)?$type:''; ?>       
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL; ?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li>
      <a href="<?php echo ADMIN_URL; ?>subadmin">
        <i class="fa fa-dashboard"></i> Subadmin List
      </a>
    </li>
    <li class="active"><?php echo !empty($type)?$type:''; ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
  <form action="" method="post" enctype="multipart/form-data">
    <!-- left column -->
    <div class="col-md-6 col-md-offset-1">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border"> Login Details</div>
        <!-- /.box-header -->
        <!-- form start -->
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">
                First Name
              </label>   
              <?php 
                if(!empty($user->email)){
                  echo '<input type="hidden" name="oldEmail" value="'.$user->email.'">';
                }  
                if(!empty($user->id)){
                  echo '<input type="hidden" name="id" value="'.$user->id.'">';
                } 
              ?>                
              <input type="text" placeholder="First Name" class="form-control" name="first_name" value="<?php if(set_value('first_name')){echo set_value('first_name');}else{ if(!empty($user->first_name)){ echo $user->first_name;}}   ?>" maxlength="50">
                 <?php echo form_error('first_name'); ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                Last Name
              </label>                  
              <input type="text" placeholder="Last Name" class="form-control" name="  last_name" value="<?php if(set_value('last_name')){echo set_value('last_name');}else{ if(!empty($user->last_name)){ echo $user->last_name;}}   ?>" maxlength="50">
                <?php echo form_error('last_name'); ?>
            </div>
            <div class="form-group">
              <label for="exampleInputEmail1">
                Email Address
              </label>                  
               <input type="text" placeholder="Email Address" class="form-control" name="email" value="<?php if(set_value('email')){echo set_value('email');}else{ if(!empty($user->email)){ echo $user->email;}}   ?>">
                <?php echo form_error('email'); ?>
            </div>  
            <?php 
            if(empty($user)){?>
            <div class="form-group">
              <label for="exampleInputEmail1">
                Password
              </label>                  
               <input type="password" placeholder="Password" class="form-control" name="password" >
                <?php echo form_error('password'); ?>
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                Confirm Password
              </label>                  
              <input type="password" placeholder="Confirm Password" class="form-control" name="confirm_password">
                <?php echo form_error('confirm_password'); ?>
            </div> 
            <?php } ?>
            <div class="form-group">
              <?php 
                if(!empty($user->image)&&file_exists('assets/uploads/admin/images/'.$user->image)){
                  $profilePic = base_url('assets/uploads/admin/images/'.$user->image);
                  echo '<img src="'.$profilePic.'" width="150">';
                }
              ?>              
            </div>      
            <input type="hidden" name="submit" value="submit">
          </div>
          <!-- /.box-body -->          
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
    </div>
    <div class="clearfix"></div>
    <br/>
        <div class="box-footer">
            <button style="text-align: center;display: block;margin: 0em auto;padding: 9px 19px;" type="submit" class="btn btn-primary"><?php echo !empty($type)?$type:''; ?></button>
          </div>
    </form>

  </div>
  <!-- /.row -->
</section>   