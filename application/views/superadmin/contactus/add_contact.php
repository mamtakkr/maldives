<style>
  #description {
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
  }

  #infowindow-content .title {
    font-weight: bold;
  }

  #infowindow-content {
    display: none;
  }

  #map #infowindow-content {
    display: inline;
  }

  .pac-card {
    margin: 10px 10px 0 0;
    border-radius: 2px 0 0 2px;
    box-sizing: border-box;
    -moz-box-sizing: border-box;
    outline: none;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.3);
    background-color: #fff;
    font-family: Roboto;
    right: -10px;
  top: -11px;
  }

  #pac-container {
    padding-bottom: 0px;
    margin-right: 0px;
  }

  .pac-controls {
    display: inline-block;
    padding: 5px 11px;
  }

  .pac-controls label {
    font-family: Roboto;
    font-size: 13px;
    font-weight: 300;
  }

  #pac-input {
    margin: 5px 0px;
  height: 34px;
    background-color: #fff;
    font-family: Roboto;
    font-size: 15px;
    font-weight: 300;
    margin-left: 12px;
    padding: 0 11px 0 13px;
    text-overflow: ellipsis;
    width: 400px;
  }

  #pac-input:focus {
    border-color: #4d90fe;
  }

  #title {
    color: #fff;
    background-color: #4d90fe;
    font-size: 25px;
    font-weight: 500;
    padding: 6px 12px;
  }
  #map {height: 300px;width: 100%;} .error{ color:red; font-weight: normal; }
</style>
<!-- Content Header (Page header) -->
<section class="content-header tab_header">
  <h1>
    <?php if(!empty($title)) echo $title; ?>
  </h1>
  <ol class="breadcrumb">
    <li>
      <a href="<?php echo ADMIN_URL; ?>">
        <i class="fa fa-dashboard"></i> Dashboard
      </a>
    </li>
    <li><a href="<?php echo ADMIN_URL.'contactus/contact_details'; ?>">Contact Details List</a></li>
    <li class="active"><?php if(!empty($title)) echo $title; ?></li>
  </ol>
</section>
<!-- Main content -->
<section class="content">
  <div class="row">
    <!-- left column -->
    <div class="col-md-10 col-md-offset-1">
      <!-- general form elements -->
      <div class="box box-primary">
        <div class="box-header with-border">              
        </div>
        <!-- /.box-header -->
        <!-- form start -->
        <form action="" method="post" enctype="multipart/form-data">
          <div class="box-body"> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                Country
              </label>     
              <select name="country_id" class="form-control">
                <option value="">Select Country</option>
                <?php 
                if(!empty($countrys)){
                  foreach($countrys as $country){
                     if(set_value('country_id')&&set_value('country_id')){
                        echo '<option selected value="'.$country->id.'">'.$country->en_country_name.'</option>';
                     }else if(!empty($row->country_id)&&$row->country_id==$country->id){ 
                        echo '<option selected value="'.$country->id.'">'.$country->en_country_name.'</option>';
                     }else{ 
                        echo '<option value="'.$country->id.'">'.$country->en_country_name.'</option>';
                     }
                  }
                }?>
              </select>
                <?php echo form_error('country_id'); ?>
            </div>  
            <div class="form-group">
              <label for="exampleInputEmail1">
                Conatct Name(Arabic)
              </label>     
              <textarea name="conatct_us_name_ab" id="conatct_us_name_ab" placeholder="Enter Conatct Name(Arabic)" class="form-control tinymce_edittor"><?php if(set_value('conatct_us_name_ab')){ echo set_value('conatct_us_name_ab');} else if(!empty($row->conatct_us_name_ab)){ echo $row->conatct_us_name_ab; } ?></textarea>  
                <?php echo form_error('conatct_us_name_ab'); ?> 
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                Conatct Name(English)
              </label> 
              <textarea name="conatct_us_name_en" id="conatct_us_name_en" placeholder="Enter Conatct Name(English)" class="form-control input-medium tinymce_edittor" ><?php if(set_value('conatct_us_name_en')){ echo set_value('conatct_us_name_en');} else if(!empty($row->conatct_us_name_en)){ echo $row->conatct_us_name_en; } ?></textarea>
                  <?php echo form_error('conatct_us_name_en'); ?>
            </div> 
            <div class="form-group">
              <label for="exampleInputEmail1">
                Conatct Name(Turkish)
              </label> 
              <textarea name="conatct_us_name_tr" id="conatct_us_name_tr" placeholder="Enter Conatct Name(Turkish)" class="form-control input-medium tinymce_edittor" ><?php if(set_value('conatct_us_name_tr')){ echo set_value('conatct_us_name_tr');} else if(!empty($row->conatct_us_name_tr)){ echo $row->conatct_us_name_tr; } ?></textarea>
              <?php echo form_error('conatct_us_name_tr'); ?>
            </div> 
            <div class="pac-card" id="pac-card">
              <div>
                <div id="title" style="display: none">
                  Search
                </div>
                <div id="type-selector" class="pac-controls" style="display: none">
                  <input type="radio" name="type" id="changetype-all" checked="checked">
                  <label for="changetype-all">All</label>

                  <input type="radio" name="type" id="changetype-establishment">
                  <label for="changetype-establishment">Establishments</label>

                  <input type="radio" name="type" id="changetype-address">
                  <label for="changetype-address">Addresses</label>

                  <input type="radio" name="type" id="changetype-geocode">
                  <label for="changetype-geocode">Geocodes</label>
                </div> 
                <div id="strict-bounds-selector" class="pac-controls" style="display: none">
                  <input type="checkbox" id="use-strict-bounds" value="">
                  <label for="use-strict-bounds">Strict Bounds</label>
                </div> 
              </div>
              <div id="pac-container" >
                <input id="pac-input" type="text" name="address_location" value="<?php echo !empty($row->address_location)?$row->address_location:''; ?>" placeholder="Enter a location">
              </div>
            </div>
            <div id="map"></div>
            <div id="infowindow-content">
              <img src="" width="16" height="16" id="place-icon">             
              <span id="place-name"  class="title"></span><br>
              <span id="place-address"></span>
            </div>
            <?php echo form_error('latitude'); ?>
            <?php echo form_error('longitude'); ?>
          <!-- /.box-body -->
          <div class="box-footer">
            <input type="hidden" id="latbox" name="latitude" value="<?php echo !empty($row->latitude)?$row->latitude:'21.422510'; ?>" />
            <input type="hidden" id="lngbox" name="longitude" value="<?php echo !empty($row->longitude)?$row->longitude:'39.826168'; ?>"/>
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </form>
      </div>
      <!-- /.box -->
    </div>
    <!--/.col (left) -->
  </div>
  <!-- /.row -->
</section>   
<script>
  var marker ='';
  var myLatlng  = null;
  function initMap() {
    var map = new google.maps.Map(document.getElementById('map'), {
      center: {lat: <?php echo !empty($row->latitude)?$row->latitude:'21.422510'; ?>, lng: <?php echo !empty($row->longitude)?$row->longitude:'39.826168'; ?>},
      zoom: 18
    });
    var card = document.getElementById('pac-card');
    var input = document.getElementById('pac-input');
    var types = document.getElementById('type-selector');
    var strictBounds = document.getElementById('strict-bounds-selector');
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(card);
    var autocomplete = new google.maps.places.Autocomplete(input);
    // Bind the map's bounds (viewport) property to the autocomplete object,
    // so that the autocomplete requests use the current map bounds for the
    // bounds option in the request.
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();
    var infowindowContent = document.getElementById('infowindow-content');
    infowindow.setContent(infowindowContent);
    var marker = new google.maps.Marker({
      map: map,
      draggable: true,
      anchorPoint: new google.maps.Point(0, -29)
    });
    google.maps.event.addListener(marker, 'dragend', function (event) {
      console.log(' dragend test');
      document.getElementById("latbox").value = this.getPosition().lat();
      document.getElementById("lngbox").value = this.getPosition().lng();
    });
    autocomplete.addListener('place_changed', function() {
      infowindow.close();
      marker.setVisible(false);
      var place = autocomplete.getPlace();
      if (!place.geometry) {
        // User entered the name of a Place that was not suggested and
        // pressed the Enter key, or the Place Details request failed.
        window.alert("No details available for input: '" + place.name + "'");
        return;
      }
      // If the place has a geometry, then present it on a map.
      if (place.geometry.viewport) {
        map.fitBounds(place.geometry.viewport);
      } else {
        map.setCenter(place.geometry.location);
        map.setZoom(17);  // Why 17? Because it looks good.
        //console.log('place.geometry.location = '+place.geometry.location);
      }
      console.log('place.geometry.location = '+place.geometry.location);
      $('#latbox').val(place.geometry.location.lat());
      $('#lngbox').val(place.geometry.location.lng());
     /* console.log('place.geometry.location lat = '+place.geometry.location.lat());
      console.log('place.geometry.location lng = '+place.geometry.location.lng());*/
      marker.setPosition(place.geometry.location);
      marker.setVisible(true);
      var address = '';
      if (place.address_components) {
        address = [
          (place.address_components[0] && place.address_components[0].short_name || ''),
          (place.address_components[1] && place.address_components[1].short_name || ''),
          (place.address_components[2] && place.address_components[2].short_name || '')
        ].join(' ');
      }
      infowindowContent.children['place-icon'].src = place.icon;
      infowindowContent.children['place-name'].textContent = place.name;
      infowindowContent.children['place-address'].textContent = address;
      infowindow.open(map, marker);
     // console.log('address = '+address);     

    });
    function setPosss(){
      myLatlng = new google.maps.LatLng(<?php echo !empty($row->latitude)?$row->latitude:'21.422510'; ?>,<?php echo !empty($row->longitude)?$row->longitude:'39.826168'; ?>);
      marker.setPosition(myLatlng);
      marker.setVisible(true);
    }
    // Sets a listener on a radio button to change the filter type on Places
    // Autocomplete.
    function setupClickListener(id, types) {
      var radioButton = document.getElementById(id);
      radioButton.addEventListener('click', function() {
        autocomplete.setTypes(types);
      });
    }
    setupClickListener('changetype-all', []);
    setupClickListener('changetype-address', ['address']);
    setupClickListener('changetype-establishment', ['establishment']);
    setupClickListener('changetype-geocode', ['geocode']);
    document.getElementById('use-strict-bounds')
        .addEventListener('click', function() {
          console.log('Checkbox clicked! New state=' + this.checked);
          autocomplete.setOptions({strictBounds: this.checked});
        });
   <?php if(!empty($row->latitude)&&!empty($row->longitude)){ ?>
      setTimeout(function(){  setPosss(); }, 1000);
    <?php }?>
  }  
</script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyARP7_RoFLcsbcvkSnMvKjwe1pNWOwZQE0&libraries=places&callback=initMap"
        async defer></script>