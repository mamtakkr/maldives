<!-- Content Header (Page header) -->
<style type="text/css">
  .hide_input{ display: none; }
  .openorder_tab{ cursor: pointer; }
</style>
<section class="content-header tab_header">
  <h1>Resorts List</h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li class="active"> Resorts List</li>
  </ol>
</section>
<section class="content-header" id="filter_main">
  <form action="<?php echo ADMIN_URL.'resorts'; ?>" method="get">
    <div class="filter_box" style="width:150px">
      <label>Resort ID</label>
      <input type="text" name="resort_id" value="<?php if($this->input->get('resort_id')){echo $this->input->get('resort_id');}?>" class="form-control"  placeholder="Search Resort ID">
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
  $status_array = array('1'=>'Approved','2'=>'Deactive','4'=>'Pending');
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
                <th class="text-center" width="90">Resort ID</th> 
                <th class="text-center" width="90">Order</th> 
                <th class="text-left" width="150">User Name</th> 
                <th class="text-center" width="80">Resort Pic</th>
                <th class="text-left">Resort Name</th>
                <th class="text-left">Resort Address</th>
                <th class="text-left">Contact</th>
                <th class="text-left" width="150">Created Date</th>     
                <th width="70" class="text-center">Status</th>   
                <th class="text-center" width="200">Action</th>      
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
                  <td class="text-center">
                    <div class="openorder_tab" onclick="openorder_tab('<?php  echo !empty($res_data->id)?$res_data->id:'';?>');" id="order_span_<?php  echo !empty($res_data->id)?$res_data->id:'';?>">
                    <!--<div class="openorder_tab" id="order_span_<?php  echo !empty($res_data->id)?$res_data->id:'';?>">-->
                      <?php 
                        echo !empty($res_data->order_priority)? ucfirst($res_data->order_priority):'1';
                      ?>
                    </div >
                    <input type="text" id="order_input_<?php  echo !empty($res_data->id)?$res_data->id:'';?>" name="order_<?php  echo !empty($res_data->id)?$res_data->id:'';?>" value="<?php echo !empty($res_data->order_priority)? ucfirst($res_data->order_priority):'1'; ?>" onchange="save_order('<?php  echo !empty($res_data->id)?$res_data->id:'';?>');" class="hide_input form-control">
                  </td> 
                  <td class="text-left">
                    <?php echo !empty($res_data->user_name)? ucfirst($res_data->user_name):'-';?>
                  </td> 
                  <td class="text-center"><?php  echo (!empty($res_data->resort_logo)&&file_exists('uploads/resorts/thumbnails/'.$res_data->resort_logo))?'<img src="'.base_url().'uploads/resorts/thumbnails/'.$res_data->resort_logo.'" width="50"/>':'-';
                  ?></td> 
                  <td class="text-left">
                    <?php echo !empty($res_data->resort_name)? ucfirst($res_data->resort_name):'-';?>
                  </td>  
                  <td class="text-left" style="width: 150px; word-break: break-all;">
                    <?php echo !empty($res_data->maps_location)? ucfirst($res_data->maps_location):'-';?>
                  </td>  
                  <td class="text-left">
                    <?php 
                    echo !empty($res_data->contact_name)?$res_data->contact_name:'';
                    echo !empty($res_data->contact_number)?'<br/>'.$res_data->contact_number:'';
                    ?>
                  </td>                  
                  <td class="text-left">
                    <?php echo !empty($res_data->created_date)? date('Y-m-d H:i A', strtotime($res_data->created_date)):'-';?>
                  </td>    
                  <td class="text-center"> 
                    <div class="dropdown">
                      <button class="<?php echo btnOrder($res_data->status);?> btn-xs  dropdown-toggle_get_val" id="menu1" type="button" data-toggle="dropdown"><?php
                      if(!empty($res_data->admin_approved)&&$res_data->admin_approved==1&&$res_data->status==1){
                        echo 'Approved';
                      }else{                        
                        foreach($status_array as $k => $status_a){
                          if(!empty($res_data->status) && $k == $res_data->status) 
                            echo $status_a;
                        }
                      } 
                       ?> 
                      <span class="caret"></span></button>  
                      <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                        <?php
                         foreach($status_array as $k => $status_a){
                          if(!empty($res_data->status) && $k != $res_data->status&&$k != 4){
                        ?>
                        <li role="presentation">
                          <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="changeStatus('resorts','resort','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','<?php echo $k; ?>','<?php if($k==1){ echo 'activate';}else if($k==3){ echo 'delete';}else{ echo 'deactive';}?>','id','status');">
                            <?php echo $status_a; ?>
                          </a>
                        </li>
                        <?php 
                        } 
                      }
                      if(!empty($res_data->admin_approved)&&$res_data->admin_approved==2){?>
                        <li role="presentation">
                          <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="changeStatus('resorts','resort','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','1','approve','id','admin_approved');">
                            Approve
                          </a>
                        </li>
                      <?php 
                      }
                      ?>          
                      </ul>
                    </div>
                  </td>             
                  <td class="text-center"> 
                    <?php 
                    if(!empty($res_data->feachered)&&$res_data->feachered==1){ ?>
                     <a class="btn btn-sm btn-warning" href="javascript:void(0);" onclick="changeFavStatus('<?php if(!empty($res_data->id)) echo $res_data->id; ?>','2', 'remove this resort from favorites list.');") title="Remove from favorites list">
                        <i class="fa fa-times" aria-hidden="true"></i>
                     </a>
                    <?php }else{?>
                      <a class="btn btn-sm btn-primary" href="javascript:void(0);" onclick="changeFavStatus('<?php if(!empty($res_data->id)) echo $res_data->id; ?>','1','add this resort in favorites list.');") title="Add in favorites list">
                        <i class="fa fa-check" aria-hidden="true"></i>
                     </a>
                     <?php }?>
                      <a class="btn btn-sm btn-info" href="<?php echo base_url().'home/resort_detail?resort_id='.base64_encode($res_data->id);?>"  target="_blank">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                      </a> 
                       <a class="btn btn-sm btn-primary" href="<?php echo ADMIN_URL.'resorts/resort_story?resort_id='.$res_data->id.'&resort_name='.$res_data->resort_name;?>" title="Resort Story">
                        <i class="fa fa-commenting" aria-hidden="true"></i>
                      </a> 
                      <a class="btn btn-sm btn-info" href="<?php echo ADMIN_URL.'resorts/traveller_story?resort_id='.$res_data->id.'&resort_name='.$res_data->resort_name;?>" title="Traveller Story">
                        <i class="fa fa-commenting-o" aria-hidden="true"></i>
                      </a> 
                      <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="changeStatus('resorts','resort','<?php if(!empty($res_data->id)) echo $res_data->id; ?>','3','delete','id','status');")>
                          <i class="fa fa-trash" aria-hidden="true"></i>
                       </a>                                              
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
<script type="text/javascript">
  function openorder_tab(order_id){
    $('#order_span_'+order_id).toggle();
    $('#order_input_'+order_id).toggle();
  }
  function save_order(order_id){    
    var order = $('#order_input_'+order_id).val();
    $.ajax({ 
      url:"<?php echo ADMIN_URL.'resorts/save_order' ?>",
      type:"POST",
      data:{order_id:order_id,order:order}, 
      success: function(res){
        var result=JSON.parse(res);
        if(result.error==1){
            alert('This order number is already exists.');
        }
        if(result.error==0){
            $('#order_input_'+order_id).toggle();
            $('#order_span_'+order_id).toggle();
            $('#order_span_'+order_id).text(order);
        }
      }
    });
  }
  
</script>