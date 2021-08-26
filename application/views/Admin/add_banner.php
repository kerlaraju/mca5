<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Banner</title>

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
                        <a href="<?= base_url('index.php/banners') ?>">
                            <Button class="btn btn-primary">
                                <i class="fa fa-arrow-left"> Back </i>
                            </Button>
                        </a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Banner</li>
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
                    <h3 class="card-title">Add Banner</h3>

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
                                    <label for="exampleInputEmail1">Banner Screen</label>
                                    <select name='screen' class="form-control" id='screen' required>
                                        <option value="">Select Screen </option>
                                        <option value="1">Category Screen</option>
                                        <option value="2">Brand Screen</option>
                                    </select>
                                    
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Banner Name</label>
                                    <input type="text" value="<?PHP if(isset($banner_info)){ echo $banner_info->banner_name;}else{ echo ""; } ?>" class="form-control" placeholder="Enter Banner Name" name="banner_name" required>
                                </div>
                            </div>
                        </div> 
                        
                         <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Is Active?</label><br>
                                    <input type="checkbox" class="form-control" name="is_active" <?PHP if(isset($banner_info) && ($banner_info->is_active==1)){ echo "checked";}else{ echo ""; } ?> data-bootstrap-switch data-off-color="danger" data-on-color="success">
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Banner Navigation</label>
                                    <input type="text" value="<?PHP if(isset($banner_info)){ echo $banner_info->navigation_url;}else{ echo ""; } ?>" class="form-control" placeholder="Enter navigation" name="navigation_url" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">banner order</label>
                                    <select name="banner_order" class="form-control" id='banner_order' required>
                                        <option value="">Select Order </option>
                                       
                                    </select>
                                    
                                </div>
                            </div>
                        </div>  
                            
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Upload Image</label>
                                    <input type=hidden value="<?PHP if(isset($banner_info)){ echo $banner_info->banner_image;}else{ echo "";}?>" name="old_file">
                                    <input type="file" class="form-control" id="banner_image" name="banner_image"  <?PHP if(isset($banner_info)){ echo ""; }else{ echo "required";} ?>>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <img id="output" width="100" height="80" <?PHP if(isset($banner_info)){ echo "src=".base_url($banner_info->banner_image);}else{ echo ""; } ?>>
                                </div>
                            </div>
                        </div>     
                            

                        </div>

                    </div>
                    <!-- /.card-body -->

                    <div class="card-footer">
                       
                        <input type="submit" class="btn btn-primary" value="submit">
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

    
   $("#banner_image").change(function () {
        if (this.files && this.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $('#output').attr('src', e.target.result);
            }
            reader.readAsDataURL(this.files[0]);
        }
    });


    $('#screen').change(function(){ 
                var id=$(this).val();
                //console.log(id);
                $.ajax({
                    url : "<?php echo base_url('index.php/get_banner_order');?>",
                    method : "POST",
                    data : {screen: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                        // console.log(data)
                        var html = '<option value="">Select Banner Order</option>';
                        var i,n,flag;
                         for(n=1;n<=10;n++){
                             flag=0;
                             for(i=0;i<data.length;i++){
                                 if(n==data[i].banner_order)
                                 flag=1;
                             }
                             if(flag==0){
                                html+='<option value='+n+'>'+n+'</option>';
                             }
                         }
                        
                        $('#banner_order').html(html);
 
                    }
                });
                return false;
            });

    });
</script>
</body>

</html>