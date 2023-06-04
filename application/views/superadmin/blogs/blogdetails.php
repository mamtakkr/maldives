<!-- Content Header (Page header) -->
<?php $admin_type = admin_type();?>
<section class="content-header tab_header">
  <h1>Blog Details List</h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL.'superadmin/dashboard';?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li class="active">Blog Details List</li>
  </ol>
</section>
<section class="content-header" id="filter_main">
  <form action="<?php echo ADMIN_URL.'blogs/blogdetails';?>" method="get">
    <div class="filter_box" style="width:180px;">
      <label>News ID</label>
      <input type="text" name="news_blog_id" value="<?php if($this->input->get('news_blog_id')){echo $this->input->get('news_blog_id');}?>" class="form-control"  placeholder="Search News ID">
    </div>
    <div class="filter_box" style="width:180px;">
      <label>News Details ID</label>
      <input type="text" name="newsblogdetails_id" value="<?php if($this->input->get('newsblogdetails_id')){echo $this->input->get('newsblogdetails_id');}?>" class="form-control"  placeholder="Search News Details ID">
    </div>
    <div class="filter_box" style="width:220px;">
      <label>News Title</label>
      <input type="text" name="news_title" value="<?php if($this->input->get('news_title')){echo $this->input->get('news_title');}?>" class="form-control"  placeholder="Search news title">
    </div>
    <div class="filter_box" style="width:220px;">
      <label>Banner Title</label>
      <input type="text" name="banner_title" value="<?php if($this->input->get('banner_title')){echo $this->input->get('banner_title');}?>" class="form-control"  placeholder="Search Banner title">
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
                <th class="text-center">News Details ID</th> 
                <th class="text-center">News title</th>
                <th class="text-center">Banner title</th>
                <th class="text-center">Banner image</th>

                <th class="text-left" width="23%">News Details</th>
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
                    <?= $res_data->news_blog_id ?>
                  </td> 
                  <td class="text-center">
                    <?=  $res_data->newsblogdetails_id ?>
                  </td> 
                  <td class="text-left">
                    <?php  
                      echo  ucfirst($res_data->news_title);
                    ?>
                  </td>
                  <td class="text-center">
                    <?=  $res_data->banner_title ?>
                  </td> 
                  <td class="text-center">
                    <img src="<?=  base_url($res_data->banner_image); ?>" height="50px" width="100px">
                  </td> 
                  <td class="text-left"  style="height:200px;display:block;overflow:scroll">
                    <?php  
                      echo  ucfirst($res_data->details_html);
                    ?>
                  </td>  
                   <td class="text-center"> 
                    <a class="btn btn-sm btn-primary" href="<?php echo ADMIN_URL.'blogs/add_blogdetails/';?><?php if(!empty($res_data->newsblogdetails_id)) echo $res_data->newsblogdetails_id;?>">
                      <i class="fa fa-pencil" aria-hidden="true"></i>
                    </a>   
                    
                      <?php if(!empty($admin_type)&&$admin_type==1){?>
                       <a class="btn btn-sm btn-danger" href="javascript:void(0);" onclick="changeStatus('news_blog_details','blog details','<?php if(!empty($res_data->newsblogdetails_id)) echo $res_data->newsblogdetails_id; ?>','3','delete','newsblogdetails_id','status','yes');">
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