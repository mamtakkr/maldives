<!-- Content Header (Page header) -->
<section class="content-header tab_header">
  <h1>
    Contact Us Detail
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL; ?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li><a href="<?php echo ADMIN_URL.'contactus'; ?>">Contact Us</a></li>
    <li class="active">Contact Us Detail</li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border"> 
          <table class="table table-hover table-bordered">
              <tbody>
                <tr>
                    <td width="50%"><strong>Name:</strong></td>
                     
                    <td width="50%"><?php if(isset($contacts[0]->name)){ echo ucwords($contacts[0]->name);  }else{ echo '-';} ?></td>
                </tr>
              
                <tr>                                    
                    <td><strong>Email:</strong></td>
                    <td><?php if(isset($contacts[0]->email)){ echo $contacts[0]->email;  }else{ echo '-';} ?></td>
                </tr>
                <tr>                                    
                    <td><strong>Created Date & Time:</strong></td>
                    <td> <?php if(isset($contacts[0]->created)){ echo date('d M Y,h:i  A',strtotime($contacts[0]->created ));  }else{ echo '-';} ?></td>
                </tr>
                 <tr>                                    
                    <td style="vertical-align: top !important;" ><strong>Message:</strong></td>
                    <td><?php if(isset($contacts[0]->message)){ echo $contacts[0]->message;  }else{ echo '-';} ?></td>
                </tr>

                 <tr>                                    
                    <td style="vertical-align: top !important;"><strong>Reply Message:</strong></td>
                    <td><?php if(isset($contacts[0]->reply)){ echo $contacts[0]->reply;  }else{ echo '-';} ?></td>
                </tr>
               

              </tbody>
          </table>             
        </div>
        <!-- /.box-header -->
        <!-- form start -->        
      </div>
      <!-- /.box -->
    </div>
    <!-- left column -->
    <div class="col-md-6">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border"> 
            <h1>Reply</h1>   
           <form action="" method="post" enctype="multipart/form-data">
          <div class="box-body">
            <div class="form-group">
              <label for="exampleInputEmail1">
                Message
              </label>     
              <textarea placeholder="Your Message" name="message"   rows="6" class="form-control" value=""></textarea>
                 <?php echo form_error('message'); ?>
            </div>               
            <input type="hidden" name="submit" value="submit">
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>             
        </div>
        <!-- /.box-header -->
        <!-- form start -->        
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
  </div>
  <!-- /.row -->
</section>   