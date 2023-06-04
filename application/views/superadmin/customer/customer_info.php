<div style="margin:20px;">    
    <?php
    if(!empty($res_data->profile_pic)&&file_exists('uploads/users/thumbnails/'.$res_data->profile_pic)){
        $imageUrl = base_url().'uploads/users/thumbnails/'.$res_data->profile_pic;?>
      <div class="col-md-4 text-center"><img src="<?php echo  $imageUrl ;?>" style="width: 250px "> 
        <h4><?php echo (!empty($res_data->user_type)&&$res_data->user_type==2)?'Member':'User'; ?> Profile Pic</h4>   
      </div>  
    <?php } ?>  
  <div class="col-md-12">
  <table class="table table-hover table-bordered">
    <tr class="userNameM">
      <th>
          <?php echo (!empty($res_data->user_type)&&$res_data->user_type==2)?'Member':'User'; ?> Name
        </th>
        <td class="customerName" colspan="3">
          <?php      
            if(!empty($res_data->first_name)){
              echo ucfirst($res_data->first_name);
              echo !empty($res_data->last_name)?' '.ucfirst($res_data->last_name):'';
            }else{
              echo '-';
            }                
          ?> 
        </td>
      </tr>                   
      <tr class="emailM">
        <th>Email ID
        </th>
        <td class="email">
          <?php      
            if(!empty($res_data->email)){
              echo $res_data->email;
            }else{
              echo '-';
            }               
          ?> 
        </td>    
        <th>Registered Date
        </th>
        <td class="created">
          <?php 
          if(!empty($res_data->created_date)){        
            echo date('d M Y h:i A', strtotime($res_data->created_date)); 
          }else{ echo '-';} ?>  
        </td>
      </tr>
      <tr class="createdM">
        <th>Last Login
        </th>
        <td class="last_login">
          <?php if(!empty($res_data->last_login)&&$res_data->last_login!='0000-00-00 00:00:00'){
                               echo date('d M Y h:i A', strtotime($res_data->last_login));
                      }else{ echo '-';} ?>   
        </td>
        <th>Last IP
        </th>
        <td class="last_ip">
          <?php      
            if(!empty($res_data->last_ip)){
              echo $res_data->last_ip;
            }else{
              echo '-';
            }                
          ?>
        </td>
      </tr>    
    </table>
  </div>  
</div>
