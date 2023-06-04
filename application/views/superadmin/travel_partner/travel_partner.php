<!-- Content Header (Page header) -->
<section class="content-header tab_header">
  <h1>Travel Partner List</h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li class="active">Travel Partner List</li>
  </ol>
</section>

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
                <th class="text-center">Title</th> 
                <th class="text-left">Description</th>
                <th class="text-left">Image</th>
                <th class="text-left">Status</th>
                <th class="text-left">Action</th>
                
              </tr>
            </head>  
            <tbody>
            <?php
            $i = $offset + 1;
            if(!empty($rows)){
              foreach ($rows as $row){?>
                <tr>
                  <td class="text-center"><?php echo $i; ?></td> 
                  <td class="text-center">
                    <?php  echo !empty($row->title)? ucfirst($row->title):'-';?>
                  </td>  
                  <td class="text-left">
                    <?php  echo !empty($row->description)? ucfirst($row->description):'-';?>
                  </td> 
				  <td class="text-left">
                    <?php  if(!empty($row->image)&&file_exists('uploads/transfer/travel_partner/'.$row->image)){ 
					echo '<img src="'.base_url('uploads/transfer/travel_partner/'.$row->image).'" height="60px" width="60px"  />'; 
					} ?>
                  </td> 
                             
                  <td class="text-center"> 
                    <div class="dropdown">
                      <button class="<?php echo btnOrder($row->status);?> btn-xs  dropdown-toggle_get_val" id="menu1" type="button" data-toggle="dropdown"><?php 
                      if($row->status!=1){$k=1;}else{$k=0;} if($row->status==1){ echo 'Activate';}else{ echo 'Deactive';}?>
                      <span class="caret"></span></button>  
                      <ul class="dropdown-menu" role="menu" aria-labelledby="menu1">
                       <li role="presentation">
                          <a role="menuitem" tabindex="-1" href="javascript:void(0);" onclick="changeStatus('travel_partner','Travel Partner','<?php if(!empty($row->travel_partner_id)) echo $row->travel_partner_id; ?>','<?php echo $k; ?>','<?php if($k==1){ echo 'activate';}else{ echo 'deactive';}?>','travel_partner_id','status');">
                           <?php if($k==1){ echo 'Activate';}else{ echo 'Deactive';}?>
                          </a>
                        </li>
                               
                      </ul>
                    </div>
                  </td>
                  <td class="text-center"> 
                    <a class="btn btn-sm btn-primary" href="<?php echo ADMIN_URL.'travel_partner/add_travel_partner/';if(!empty($row->travel_partner_id)) echo $row->travel_partner_id;?>">
                        <i class="fa fa-pencil" aria-hidden="true"></i>
                     </a>   
                     <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="changeStatus('travel_partner','Travel Partner','<?php if(!empty($row->travel_partner_id)) echo $row->travel_partner_id; ?>','3','delete','travel_partner_id','status',1);">
                        <i class='fa fa-trash' aria-hidden='true'></i>
                     </a>                                        
                  </td>
                </tr>
                <?php $i++;
                    } 
                  }else{?>
                  <tr >
                    <td colspan="11" class="text-center text-danger">
                      <span class="data-not-present">
                        <?php echo 'No distance place records found'; ?>                
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