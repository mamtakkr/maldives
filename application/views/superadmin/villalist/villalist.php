<!-- Content Header (Page header) -->
<style type="text/css">
  .hide_input{ display: none; }
  .openorder_tab{ cursor: pointer; }
</style>
<section class="content-header tab_header">
  <h1>Villa List</h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li class="active"> Villa List</li>
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
            <head>
              <tr>              
                <th class="text-center">S.No.</th> 
                <th class="text-center" width="90">Villa ID</th> 
                <th class="text-left">Resort Name</th>
                <th class="text-left">Villa name</th>
                <th class="text-left">Created Date</th>
                <th width="70" class="text-center">Is Featured </th>   
                <th class="text-left" width="150">Order</th>     

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
                  <td class="text-center"><?= $res_data->resort_name ?></td> 
                  <td class="text-center"><?= $res_data->name_of_villa ?></td> 
                  <td class="text-center"><?= $res_data->created_at ?></td> 
                  <td class="text-center">
                    <form action="<?php echo site_url('admin/resorts/changestatus_villa'); ?>" method="post">
                        <input type="hidden" name="villa_id" value="<?= $res_data->id; ?>" />
                        <input type="hidden" name="is_featured" value="<?= $res_data->is_featured ?>">
                        <?php
                        if($res_data->is_featured==0)
                        {
                        ?> <button title="deactve" ype="submit" class="button_small btn btn-xs btn-danger fa fa-ban">  No</button>
                        <?php  
                        }else{
                        ?> <button title="active" ype="submit" class="button_small btn btn-xs btn-info fa fa-check">  Yes</button>
                        <?php 
                        }
                        ?>
                    </form>
                  </td>
                  <td class="text-center">
                    <form action="<?php echo site_url('admin/resorts/changevillaorder'); ?>" method="post">
                      <input type="hidden" name="villa_id" value="<?= $res_data->id; ?>" />
                      <div class="row"> 
                        <div class="col-md-12 d-flex" style="display: flex">
                           <div class="col">
                              <input type="number" name="priority_order" value="<?= $res_data->priority_order ?>">
                            </div>
                            <div class="col">
                              <input type="submit" name="submit" class="update btn-success"> 
                            </div>
                        </div>

                      </div>
                      
                       
                    </form>
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
      success: function(){
        $('#order_input_'+order_id).toggle();
        $('#order_span_'+order_id).toggle();
        $('#order_span_'+order_id).text(order);
      }
    });
  }
  
</script>