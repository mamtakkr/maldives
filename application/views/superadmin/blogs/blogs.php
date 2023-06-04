<!-- Content Header (Page header) -->
<?php $admin_type = admin_type();?>
<section class="content-header tab_header">
  <h1>Blog & News List</h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li class="active">Blog & News List</li>
  </ol>
</section>
<section class="content-header" id="filter_main">
  <form action="<?php echo ADMIN_URL.'blogs';?>" method="get">
    <div class="filter_box" style="width:180px;">
      <label>News ID</label>
      <input type="text" name="news_id" value="<?php if($this->input->get('news_id')){echo $this->input->get('news_id');}?>" class="form-control"  placeholder="Search News ID">
    </div>
    <div class="filter_box" style="width:220px;">
      <label>News Title</label>
      <input type="text" name="news_title" value="<?php if($this->input->get('news_title')){echo $this->input->get('news_title');}?>" class="form-control"  placeholder="Search news title">
    </div>
    <div class="filter_box" style="width:220px;">
      <label>News Title</label>
      <select name="user_id" class="form-control">
        <option value="">All User</option>
        <?php 
        if(!empty($users)){
          foreach($users as $user){
            if($this->input->get('user_id')&&$this->input->get('user_id')==$user->id){
              echo '<option selected="selected" value="'.$user->id.'">'.ucfirst($user->first_name).' '.ucfirst($user->last_name).'</option>';
            }else{
              echo '<option value="'.$user->id.'">'.ucfirst($user->first_name).' '.ucfirst($user->last_name).'</option>';
            }                    
          }
        }
        ?>
      </select>
    </div>
    <div class="filter_box" style="width:">
      <label>Order</label>
      <select class="form-control" name="order">
        <option value="DESC" <?php if($this->input->get('order')&&$this->input->get('order')=='DESC'){echo 'selected';} ?>>New</option>
        <option value="ASC" <?php if($this->input->get('order')&&$this->input->get('order')=='ASC'){echo 'selected';} ?>>Old</option>
      </select>
    </div> 
    <div class="filter_box" style="width: 80px;">
      <button type="submit" class="btn btn-primary search_btn">
        <i class="fa fa-search" aria-hidden="true"></i>
      </button>
      <a href="<?php echo current_url();?>" class="btn btn-danger search_btn">
        <i class="fa fa-refresh" aria-hidden="true"></i>
      </a>
    </div>
  </form>
</section>
<?php
$status_array = array('1'=>'Active','2'=>'Deactive','4'=>'Pending');?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">            
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-bordered">
            <tr>
              <head>
                <th class="text-center">S.No.</th> 
                <th class="text-center">News ID</th> 
                <th class="text-center">News Image</th>
                <th class="text-left">News Name</th>
                <th class="text-left">News User</th>
                <th class="text-center">Status</th>   
                <th class="text-center">Action</th> 
              </tr>
            </head>  
            <tbody>
            <?php
            $i = $offset + 1;
            if(!empty($rows)){
              foreach ($rows as $res_data){ 
              ?>
                <tr>
                  <td class="text-center"><?php echo $i; ?></td> 
                  <td class="text-center">
                    <?php  echo !empty($res_data->id)? ucfirst($res_data->id):'-';?>
                  </td> 
                  <td class="text-center">
                    <?php  
                      //echo !empty($res_data->news_image)? '<img src="'.base_url('uploads/blogs/thumbnails/'.$res_data->news_image).'" width="50"/>':'-';
                    ?>
                    
                    <?php
                    $images=$this->common_model->get_result('images', array('status'=>1, 'type'=>'blog','item_id'=>$res_data->id));
                    if(!empty($images)){
                        foreach($images as $image){ 
                            if(!empty($image->image_name) && file_exists('uploads/blogs/thumbnails/150_'.$image->image_name)){
                                echo '<img src="'.base_url().'uploads/blogs/thumbnails/150_'.$image->image_name.'" width="50"/>';
                            }else{
                                echo '<img src="'.base_url().'uploads/blogs/thumbnails/'.$image->image_name.'" width="50"/>';
                            }
                        }
                    }
                ?> 
                    
                  </td> 
                  <td class="text-left">
                    <?php  
                      echo !empty($res_data->news_title)? ucfirst($res_data->news_title):'-';
                    ?>
                  </td> 
                  <td class="text-left">
                    <?php  
                    if($res_data->role=='Hotel User' || $res_data->role=='User'){
                        $userData = $this->developer_model->getUserDetails(user_id());
                      echo !empty($userData->first_name)? ucfirst($userData->first_name).' '.ucfirst($userData->last_name):'-';
                    }else{
                      echo !empty($res_data->user_name)? ucfirst($res_data->user_name):'-';
                    }
                    ?>
                  </td>                                             
                  <td class="text-center"> 
                    <div class="dropdown">
                      <button class="<?php echo btnOrder($res_data->status);?> btn-xs  dropdown-toggle_get_val" id="menu1" type="button" data-toggle="dropdown"><?php 
                      foreach($status_array as $k => $status_a)
                      {
                        if(!empty($res_data->status) && $k == $res_data->status) 
                          echo $status_a;
                      }
                       ?>
                      <span class="caret"></span></button>  
                      <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                        <?php
                         foreach($status_array as $k => $status_a){
                            if(!empty($res_data->status) && $k != $res_data->status&&$k != 4){
                        ?>
                        <li role="presentation">
                          <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="changeStatus('news_blog','blog','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','<?php echo $k; ?>','<?php if($k==1){ echo 'activate';}else if($k==3){ echo 'delete';}else{ echo 'deactive';}?>','id','status');">
                            <?php echo $status_a; ?>
                          </a>
                        </li>
                        <?php } 
                       } ?>          
                      </ul>
                    </div>
                  </td>
                  <td class="text-center"> 
                    <a class="btn btn-sm btn-primary" href="<?php echo ADMIN_URL.'blogs/add_blog/';?><?php if(!empty($res_data->id)) echo $res_data->id;?>">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                     </a>   
                     <a class="btn btn-sm btn-info" href="javascript:void(0);"  data-toggle="modal" data-target="#review_details_modal" onclick="review_details_modal('<?php if(!empty($res_data->id)) echo $res_data->id; ?>');">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                      </a> 
                      <?php if(!empty($admin_type) && $admin_type==1){?>
                       <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="changeStatus('news_blog','blog','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','3','delete','id','status');">
                          <i class="fa fa-trash" aria-hidden="true"></i>
                       </a>    
                     <?php }?>                                    
                  </td>
                </tr>
                <?php $i++;
                    } 
                  }else{?>
                  <tr >
                    <td colspan="8" class="text-center text-danger">
                      <span class="data-not-present">
                        <?php echo 'No blog records found'; ?>                
                      </span>
                    </td>
                  </tr>              
              <?php } ?> 
             <tbody>         
          </table>
        </div>
        <!-- /.box-body -->
        <div class="box-footer clearfix">         
          <div class="text-right">
            <?php if(!empty($pagination)) echo $pagination; ?>
          </div>
        </div>
      </div>          
    </div>        
  </div>
</section>
<div class="modal fade" id="review_details_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Blog Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="story_details_modal" style="min-height: 800px;"></div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function  review_details_modal(blog_id) {
     $.ajax({ 
      url:"<?php echo ADMIN_URL;?>blogs/blog_details",
      type:"POST",
      data:{blog_id:blog_id}, 
      success: function(html){
        $('#story_details_modal').html(html)
      }
    });
  }
</script>