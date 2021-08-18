<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Category</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="<?= base_url("assets/"); ?>plugins/fontawesome-free/css/all.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Tempusdominus Bootstrap 4 -->
    <link rel="stylesheet" href="<?= base_url("assets/"); ?>plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?= base_url("assets/"); ?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
    <!-- JQVMap -->
    <link rel="stylesheet" href="<?= base_url("assets/"); ?>plugins/bs-stepper/css/bs-stepper.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?= base_url("assets/"); ?>dist/css/adminlte.min.css">
    <!-- overlayScrollbars -->

    <!-- Daterange picker -->
    <link rel="stylesheet" href="<?= base_url("assets/"); ?>plugins/daterangepicker/daterangepicker.css">
    <!-- summernote -->

<script src="https://maps.googleapis.com/maps/api/js?libraries=places&key=AIzaSyDFrl_WzEA9GKKtFCk52ealyMPoS9akd4U" type="text/javascript"></script>


    <link rel="stylesheet" href="<?= base_url("assets/"); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url("assets/"); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
    <link rel="stylesheet" href="<?= base_url("assets/"); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
    
</head>

<?PHP $this->load->view("Admin/header") ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">
                        <a href="<?= base_url('index.php/vendors') ?>">
                            <Button class="btn btn-primary">
                                <i class="fa fa-arrow-left"> Back </i>
                            </Button>
                        </a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <div class="card">

        <!-- /.card-header -->
        <div class="card-body">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">Vendor Information</h3>

                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form action="#" method="post" enctype="multipart/form-data">
                    <div class="card-body">
                        <?PHP
                        if (!empty($this->session->flashdata('smsg'))) {
                           
                            $msg=$this->session->flashdata('smsg');
                           
                            
                                echo "<div class='alert alert-info'>".$msg."</div>";
                            
                        }
                        ?>
                            
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Vendor Type</label>
                                    <select class="form-control" required name="role" <?PHP if(isset($userinfo)){ echo "disabled"; }?>>
                                        <option value=""> Select Vendor Type</option>
                                        <option value="1" <?PHP if(isset($userinfo) && $userinfo->role==1){ echo "selected"; } ?>>Bulk Vendor</option>
                                        <option value="2" <?PHP if(isset($userinfo) && $userinfo->role==1){ echo "selected"; } ?>>Retail Vendor</option>
                                        <?PHP if(isset($userinfo) && $userinfo->role==3){
                                            echo "<option value='3' selected>Special Customer</option>";
                                        }
                                        else if(isset($userinfo) && $userinfo->role==4){
                                             echo "<option value='4' selected>Regular Customer</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile Number</label>
                                    <input pattern=".{10,10}" required value="<?PHP if(isset($userinfo)){ echo $userinfo->mobileno;}else{ echo ""; } ?>" <?PHP if(isset($userinfo)){ echo "disabled"; }?> class="form-control" placeholder="Enter mobile number" name="mobileno" id="mobileno" >
                                    <div class="alert alert-danger alert-dismissible" style="display:none" id="error">Mobile number already registered</div>
                                </div>
                            </div>
                        </div> 
                        
                         <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Name</label><br>
                                    <input type="text" class="form-control" name="name"  VALUE="<?PHP if(isset($userinfo)){ echo $userinfo->name;}else{ echo ""; } ?>" required />
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email Address</label><br>
                                    <input type="email" class="form-control" name="email" value="<?PHP if(isset($userinfo)){ echo $userinfo->email;}else{ echo ""; } ?>" required />
                                </div>
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Location/Address</label><br>
                                    <input type="text" class="form-control" name="location" value="<?PHP if(isset($userinfo)){ echo $userinfo->location;}else{ echo ""; } ?>" id="location">
                                    <input type="hidden" name="lat" value="" id="lat">
                                    <input type="hidden" name="lang" value="" id="lang">
                                </div>
                              
                            </div>
                            <div class="col-6">
                                  <div class="form-group">
                                    <label for="exampleInputEmail1">State</label><br>
                                    <select class="form-control" name="state_id" id="state_id" required>
                                        <option value="">Select State</option>
                                        <?PHP
                                        foreach($states as $state){
                                            if(isset($userinfo)){
                                                if($state->state_id==$userinfo->state_id){
                                                    echo "<option value='$state->state_id' selected>$state->state</option>";
                                                }
                                            }
                                            else
                                            {
                                                echo "<option value='$state->state_id'>$state->state</option>";
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                
                            </div>
                        </div>  
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">District/City</label><br>
                                    <select class="form-control" name="district_id" id="district_id" required>
                                        <?PHP
                                           if(isset($userinfo)){
                                               foreach($districts as $d){
                                                   if($userinfo->district_id==$d->district_id){
                                                       echo "<option value='$d->district_id' selected>$d->district</option>";
                                                   }
                                               }
                                           }else{
                                               echo "<option value=''>Select District</option>";
                                           }
                                        ?>
                                        
                                    </select>
                                </div>
                                
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">GSTNO</label><br>
                                    <input type="text" class="form-control" name="gstno" value="<?PHP if(isset($userinfo)){ echo $userinfo->gstno;}else{ echo ""; } ?>" required />
                                </div>
                                
                            </div>
                        </div>  
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Pincode</label><br>
                                    <input type="pincode" class="form-control" value="<?PHP if(isset($userinfo)){ echo $userinfo->pincode;}else{ echo ""; } ?>" placeholder="pincode" name="pincode" />
                                </div>
                                
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Is_active?</label><br>
                                    <input type="checkbox" class="form-control" name="is_active" <?PHP if(isset($userinfo) && ($userinfo->is_active==1)){ echo "checked";}else{ echo ""; } ?> data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                </div>
                                
                            </div>
                        </div>  
                        
                            
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Upload GST IMAGE</label>
                                    <input type=hidden value="<?PHP if(isset($userinfo)){ echo $userinfo->gstimg;}else{ echo "";}?>" name="old_gst">
                                    <input type="file" class="form-control" id="gstimg" name="gstimg"  <?PHP if(isset($userinfo)){ echo ""; }else{ echo "required";} ?>>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <img id="output" width="100" height="80" <?PHP if(isset($userinfo)){ echo "src=".base_url($userinfo->gstimg);}else{ echo ""; } ?>>
                                </div>
                            </div>
                        </div>  
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Upload Profile Image</label>
                                    <input type=hidden value="<?PHP if(isset($userinfo)){ echo $userinfo->profilepic;}else{ echo "";}?>" name="old_profilepic">
                                    <input type="file" class="form-control" id="profilepic" name="profilepic"  <?PHP if(isset($userinfoinfo)){ echo ""; }else{ echo "required";} ?>>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <img id="output2" width="100" height="80" <?PHP if(isset($userinfo)){ echo "src=".base_url($userinfo->profilepic);}else{ echo ""; } ?>>
                                </div>
                            </div>
                        </div>  
                        
                        
                            

                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                       
                        <input type="submit" class="btn btn-primary" id="submit" value="submit">
                    </div>
                </form>
            </div>

        </div>

        <!-- /.card-body -->
    </div>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->



<?PHP $this->load->view("Admin/footer"); ?>

<!-- jQuery -->
<script src="<?= base_url("assets/"); ?>plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="<?= base_url("assets/"); ?>plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="<?= base_url("assets/"); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?= base_url("assets/"); ?>plugins/bootstrap-colorpicker/js/bootstrap-colorpicker.min.js"></script>
<!-- ChartJS -->

<!-- Sparkline -->

<!-- JQVMap -->


<!-- jQuery Knob Chart -->

<!-- daterangepicker -->

<script src="<?= base_url("assets/"); ?>plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->

<!-- Summernote -->

<!-- overlayScrollbars -->

<!-- AdminLTE App -->
<script src="<?= base_url("assets/"); ?>dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?= base_url("assets/"); ?>dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?= base_url("assets/"); ?>plugins/bootstrap-switch/js/bootstrap-switch.min.js"></script>



<script src="<?= base_url("assets/"); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?= base_url("assets/"); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?= base_url("assets/"); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?= base_url("assets/"); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?= base_url("assets/"); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?= base_url("assets/"); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?= base_url("assets/"); ?>plugins/jszip/jszip.min.js"></script>
<script src="<?= base_url("assets/"); ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?= base_url("assets/"); ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?= base_url("assets/"); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?= base_url("assets/"); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?= base_url("assets/"); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>


<script>
    $(function() {
        $("#example1").DataTable({
            "responsive": true,
            "lengthChange": false,
            "autoWidth": false,
            "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true,
        });
        $('.my-colorpicker1').colorpicker();
        
         $("input[data-bootstrap-switch]").each(function(){
      $(this).bootstrapSwitch('state', $(this).prop('checked'));
      state=$(this).bootstrapSwitch('state');
      console.log("state",state);
    })

    
   $("#gstimg").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#output').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    $("#profilepic").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#output2').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });
    
    
    
        $('#mobileno').change(function(){ 
                var id=$(this).val();
                console.log(id);
                $.ajax({
                    url : "<?php echo base_url('index.php/check_mobileno');?>",
                    method : "POST",
                    data : {mobileno: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        console.log(data);
                         if(data.code==1){
                             $('#error').css("display","block");
                             $('#submit').attr("disabled","disabled");
                             
                         }else
                         {
                              $('#error').css("display","none");
                             $('#submit').removeAttr("disabled");
                         }
                        
                       
 
                    }
                });
                return false;
            }); 
            
            
            
            
            
             $('#state_id').change(function(){ 
                var id=$(this).val();
                console.log(id);
                $.ajax({
                    url : "<?php echo base_url('index.php/get_districts');?>",
                    method : "POST",
                    data : {state_id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         var html = '<option value="">Select District</option>';
                        var i;
                        if(data.length==0){
                            html+='<option value="">No districts found in this state</option>';
                        }
                        for(i=0; i<data.length; i++){
                            console.log(data[i].brand_name);
                            html += '<option value='+data[i].district_id+'>'+data[i].district+'</option>';
                        }
                        $('#district_id').html(html);
                       
 
                    }
                });
                return false;
            }); 

    });
    
    

</script>

<script>
    function initialize() {
         var input = document.getElementById('location');
        var autocomplete = new google.maps.places.Autocomplete(input,{
             componentRestrictions: {
                                    country: "IN"
                                    }
        });
        google.maps.event.addListener(autocomplete, 'place_changed', function () {
            var place = autocomplete.getPlace();
           console.log(place.formatted_address);
            console.log(place.geometry.location.lat());
            console.log(place.geometry.location.lng());
            document.getElementById('lat').value=place.geometry.location.lat();
            document.getElementById('lang').value=place.geometry.location.lng();
            //alert("This function is working!");
            //alert(place.name);
           // alert(place.address_components[0].long_name);

        });
  
    }
     google.maps.event.addDomListener(window, 'load', initialize); 
 
</script>
</body>

</html>