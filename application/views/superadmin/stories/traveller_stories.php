<!-- Content Header (Page header) -->
<section class="content-header tab_header">
  <h1>Traveller Stories List</h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li class="active">Traveller Stories List</li>
  </ol>
</section>
<section class="content-header" id="filter_main">
  <form action="<?php echo ADMIN_URL.'stories/traveller_stories';?>" method="get">
    <div class="filter_box" style="width:170px">
      <label>Traveller Story ID</label>
      <input type="text" name="story_id" value="<?php if($this->input->get('story_id')){echo $this->input->get('story_id');}?>" class="form-control"  placeholder="Search Traveller Story ID">
    </div>
    <div class="filter_box" style="width:">
      <label>User Name</label>
      <input type="text" name="user_name" value="<?php if($this->input->get('user_name')){echo $this->input->get('user_name');}?>" class="form-control"  placeholder="Search User Name">
    </div>
    <div class="filter_box" style="width:">
      <label>Resort</label>
      <input type="text" name="resort" value="<?php if($this->input->get('resort')){echo $this->input->get('resort');}?>" class="form-control"  placeholder="Search Resort">
    </div>
    <div class="filter_box" style="width:">
      <label>Title</label>
      <input type="text" name="title" value="<?php if($this->input->get('title')){echo $this->input->get('title');}?>" class="form-control"  placeholder="Search  Title">
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
  $status_array  = array('1'=>'Verify','2'=>'Cancel','4'=>'Pending');
  $status_arrays = array('1'=>'Verified','2'=>'Cancelled','4'=>'Pending');
?>
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
                <th class="text-center">Traveller Story ID</th>                
                <th class="text-left">User Name</th>
                <th class="text-left">Resort</th>
                <th class="text-left">Title</th>
                <th class="text-center">Verified By</th>   
                <th class="text-center">Status</th>   
                <th class="text-center">Action</th> 
              </tr>
            </head>  
            <tbody>
            <?php
            $i = $offset + 1;
            if(!empty($rows)){
              foreach ($rows as $res_data){?>
                <tr>
                  <td class="text-center"><?php echo $i; ?></td> 
                  <td class="text-center">
                    <?php  echo !empty($res_data->id)? ucfirst($res_data->id):'-';?>
                  </td>  
                  <td class="text-left">
                    <?php  
                    echo !empty($res_data->first_name)? ucfirst($res_data->first_name):'-';
                    echo !empty($res_data->last_name)? ' '.ucfirst($res_data->last_name):'-';
                    ?>
                  </td> 
                  <td class="text-left">
                    <?php  echo !empty($res_data->resort_name)? ucfirst($res_data->resort_name):'-';?>
                  </td> 
                  <td class="text-left">
                    <?php  echo !empty($res_data->story_title)? ucfirst($res_data->story_title):'-';?>
                  </td> 
                  <td class="text-center">
                    <?php  echo (!empty($res_data->verified_by)&&!empty($res_data->verified_status)&&$res_data->verified_status==1)? ucfirst($res_data->verified_by):'-';?>
                  </td>                              
                  <td class="text-center"> 
                    <div class="dropdown">
                      <button class="<?php echo btnOrder($res_data->verified_status);?> btn-xs  dropdown-toggle_get_val" id="menu1" type="button" data-toggle="dropdown"><?php 
                      foreach($status_arrays as $k => $status_a)
                      {
                        if(!empty($res_data->verified_status) && $k == $res_data->verified_status) 
                          echo $status_a;
                      }
                      if($res_data->verified_status!=1){?>
                        <span class="caret"></span></button>  
                          <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                            <?php
                             foreach($status_array as $k => $status_a){
                                if(!empty($res_data->verified_status) && $k != $res_data->verified_status&&$k != 4){
                            ?>
                            <li role="presentation">
                              <?php 
                              if($k==1){?>
                                <a data-toggle="modal" data-target="#verifyStory" href="javascript:void(0);" onclick="verifyStory('<?php if(!empty($res_data->id)) echo $res_data->id; ?>');">
                                    <?php echo $status_a; ?>
                                  </a>
                              <?php }else{?>
                                <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="changeStatus('traveller_stories','traveller story','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','<?php echo $k; ?>','<?php if($k==1){ echo 'verify';}else if($k==3){ echo 'delete';}else{ echo 'cancel';}?>','id','verified_status');">
                                  <?php echo $status_a; ?>
                                </a>
                              <?php }?>
                            </li>
                            <?php } 
                           } ?>          
                          </ul>
                      <?php }?>
                    </div>
                  </td>
                  <td class="text-center">
                     <a data-toggle="modal" data-target="#viewStory" href="javascript:void(0);" onclick="viewStory('<?php if(!empty($res_data->id)) echo $res_data->id; ?>');" class="btn btn-sm btn-info">
                      <i class="fa fa-eye" aria-hidden="true"></i>
                    </a>
                     <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="changeStatus('traveller_stories','traveller story','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','3','delete','id','status');");">
                        <i class="fa fa-trash" aria-hidden="true"></i>
                     </a>                                         
                  </td>
                </tr>
                <?php $i++;
                    } 
                  }else{?>
                  <tr >
                    <td colspan="8" class="text-center text-danger">
                      <span class="data-not-present">
                        <?php echo 'No traveller stories records found'; ?>
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
<div class="modal fade" id="verifyStory" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Verify Traveller Story</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body">
        <form onsubmit="return false" method="post">         
          <div class="form-group">
            <label for="pwd"> Verified By:</label>
            <select class="form-control" name="verified_by" id="verified_by">
              <option value="">--Select--</option>
              <option value="Traveller">Traveller</option>
              <option value="Resort">Resort</option>
            </select>
            <div id="verified_by_error" class="text-danger"></div>
            <input type="hidden" name="story_id" id="story_id">
          </div>           
          <br/>
          <button type="button" class="btn btn-primary" onclick="verifyUser();">
            Verify
          </button>
        </form>
      </div>
      <div class="modal-footer">
       
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="viewStory" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
  <div class="modal-dialog" style="width: 1200px;">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title" id="myModalLabel">Traveller Story Details</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">×</span>
        </button>
      </div>
      <div class="modal-body" id="travellerStoryDetails"></div>
      <div class="modal-footer"></div>
    </div>
  </div>
</div>
<script type="text/javascript">
  function verifyStory(story_id=''){
    $('#story_id').val(story_id);
  }
  function verifyUser(){
    var verified_by = $('#verified_by').val();
    var story_id    = $('#story_id').val();
    if(verified_by==''){
      $('#verified_by_error').show().html('The verified user is required');
    }else{      
      if(story_id&&verified_by){
        $.ajax({ 
          url:"<?php echo ADMIN_URL.'stories/verifyStory';?>",
          type:"GET",
          data:{'verified_by':verified_by,'story_id':story_id},
          success: function(html){
            location.reload();
          }                 
        });
      }
    }
  }
  function viewStory(story_id=''){
    $.ajax({ 
      url:"<?php echo ADMIN_URL.'stories/viewStory';?>",
      type:"GET",
      data:{'story_id':story_id},
      success: function(html){
        $('#travellerStoryDetails').show().html(html);
      }                 
    });
  }
</script>
