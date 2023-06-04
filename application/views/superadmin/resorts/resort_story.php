<!-- Content Header (Page header) -->
<?php $admin_type = admin_type();?>
<section class="content-header tab_header">
  <h1>Resort Stories List</h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li class="active"> Resort Stories List</li>
  </ol>
</section>
<section class="content-header" id="filter_main">
  <form action="<?php echo ADMIN_URL."resorts/resort_story" ?>" method="get">
    <div class="filter_box" style="width:150px">
      <label>Story ID</label>
      <input type="text" name="story_id" value="<?php if($this->input->get('story_id')){echo $this->input->get('story_id');}?>" class="form-control"  placeholder="Search Story ID">
    </div>
    <div class="filter_box" style="width:">
      <label>User Name</label>
      <input type="text" name="user_name" value="<?php if($this->input->get('user_name')){echo $this->input->get('user_name');}?>" class="form-control"  placeholder="Search Resort Name">
    </div>
    <div class="filter_box" style="width:">
      <label>Resort Name</label>
      <input type="text" name="resort_name" value="<?php if($this->input->get('resort_name')){echo $this->input->get('resort_name');}?>" class="form-control"  placeholder="Search Resort Name">
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
  $status_array  = array('1'=>'Approve','2'=>'Reject','4'=>'Pending');
  $status_arrayA = array('1'=>'Approved','2'=>'Rejected','4'=>'Pending');
?>
<!-- Main content -->
<section class="content">
  <div class="row">
    <div class="col-md-12">
      <div class="box">            
        <!-- /.box-header -->
        <div class="box-body table-responsive">
          <table class="table table-bordered">
            <head>
              <tr>              
                <th class="text-center">S.No.</th> 
                <th class="text-center" width="90">Story ID</th> 
                <th class="text-left" width="150">User Name</th> 
                <th class="text-left">Resort Name</th>
                <th class="text-left">Title</th>
                <th class="text-left" width="150">Created Date</th>     
                <th width="70" class="text-center">Status</th>   
                <th class="text-center" width="130">Action</th>      
              </tr>
            </head>  
            <tbody>
            <?php
            $i = $offset + 1;
            if(!empty($rows)){
              foreach ($rows as $res_data){?>
                <tr>
                  <td class="text-center"><?php echo $i; ?></td> 
                  <td class="text-center"><?php  echo !empty($res_data->id)?'#'.$res_data->id:'-';?></td> 
                  <td class="text-left">
                    <?php 
                      echo !empty($res_data->first_name)? ucfirst($res_data->first_name):'-';
                      echo !empty($res_data->last_name)? ' '.ucfirst($res_data->last_name):'-';
                    ?>
                  </td>  
                  <td class="text-left">
                    <?php echo !empty($res_data->resort_name)? ucfirst($res_data->resort_name):'-';?>
                  </td> 
                  <td class="text-left">
                    <?php echo !empty($res_data->title)? ucfirst($res_data->title):'-';?>
                  </td>             
                  <td class="text-left">
                    <?php echo !empty($res_data->created_date)? date('Y-m-d H:i A', strtotime($res_data->created_date)):'-';?>
                  </td>    
                  <td class="text-center"> 
                    <div class="dropdown">
                      <button class="<?php echo btnOrder($res_data->status);?> btn-xs  dropdown-toggle_get_val" id="menu1" type="button" data-toggle="dropdown">
                      <?php
                        foreach($status_arrayA as $k => $status_a){
                          if(!empty($res_data->status) && $k == $res_data->status) 
                            echo $status_a;
                        }
                      ?> 
                      <span class="caret"></span></button>  
                      <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                        <?php
                        foreach($status_array as $k => $status_a){
                          if(!empty($res_data->status) && $k != $res_data->status && $k != 4){
                            if($k==1){?>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="ApproveReviewStatus('<?php if(!empty($res_data->id)) echo $res_data->id; ?>');">
                                  <?php echo $status_a; ?>
                                </a>
                              </li>
                        <?php 
                            }else{?>
                              <li role="presentation">
                                <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="changeStatus('resort_stories','story','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','<?php echo $k; ?>','<?php if($k==3){ echo 'delete';}else{ echo 'reject';}?>','id','status');">
                                  <?php echo $status_a; ?>
                                </a>
                              </li>
                            <?php 
                            }
                        } 
                      }
                      ?>          
                      </ul>
                    </div>
                  </td>             
                  <td class="text-center"> 
                      <a class="btn btn-sm btn-info" href="javascript:void(0);"  data-toggle="modal" data-target="#review_details_modal" onclick="review_details_modal('<?php if(!empty($res_data->id)) echo $res_data->id; ?>');">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                      </a> 
                      <?php if(!empty($admin_type)&&$admin_type==1){?>
                      <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="changeStatus('resort_stories','story','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','3','delete','id','status');")>
                        <i class="fa fa-trash" aria-hidden="true"></i>
                      </a>  
                      <?php }?>                                            
                    </td>
                </tr>
                <?php $i++;
                    } 
                  }else{?>
                  <tr >
                    <td colspan="10" class="text-center text-danger">
                      <span class="data-not-present">
                        <?php echo 'No Resort records found'; ?>                
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
        <h4 class="modal-title" id="myModalLabel">Resort Story Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="story_details_modal" style="min-height: 800px;"></div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function  review_details_modal(story_id) {
     $.ajax({ 
      url:"<?php echo ADMIN_URL;?>resorts/resort_story_details",
      type:"POST",
      data:{story_id:story_id}, 
      success: function(html){
        $('#story_details_modal').html(html)
      }
    });
  }
</script>