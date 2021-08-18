<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>View Users</title>

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
                        <a href="<?= base_url('index.php/vendors'); ?>"><button class="btn btn-sm btn-danger">Main Page</button></a>
                         User Info
                       
                        
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Vendors</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card">

        <!-- /.card-header -->
        <div class="card-body">
        <section class="content">
         <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-3">
                   <img src="<?= base_url('assets/images/buildup_long.png');?>" width="auto" height="80"></img> 
                </div>
                <div class="col-6 text-center">
                   <label class="text-center text-danger"> User Information </label><br>
                   <label ><?PHP if($userinfo->role==1){ echo "Bulk Vendor"; }else if($userinfo->role==2){ echo "Retail Vendor";}else if($userinfo->role==3){ echo "Special Customer";}else{ echo "Regular Customer";} ?></label>
                </div>
                <div class="col-3">
                    <label class="text-danger"> Member_id:&nbsp;&nbsp; </label><label> <?= $userinfo->member_id; ?> </label>
                </div>
            </div>
            <hr style="border:2px solid #DD364A">
            <div class="row">
                <div class="col-md-3">

            <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <h3> About</h3>
                                <img class="profile-user-img img-fluid img-circle zoom"
                                 src="<?= base_url($userinfo->profilepic);?>" 
                                alt="User profile picture">
                            </div>

                            <h3 class="profile-username text-center"><?= $userinfo->name;?></h3>

                            <p class="text-muted text-center"><?PHP if($userinfo->role==1){ echo "Bulk Vendor"; }else if($userinfo->role==2){ echo "Retail Vendor";}else if($userinfo->role==3){ echo "Special Customer";}else{ echo "Regular Customer";} ?></p>
                        </div>
              
                    </div>
                        <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <h3> About GST</h3>
                                <img class="profile-user-img img-fluid img-circle zoom"
                                 src="<?= base_url($userinfo->gstimg);?>" 
                                alt="GST Not Uploaded">
                            </div>

                            <h3 class="profile-username text-center"><?= $userinfo->gstno;?></h3>

                            
                        </div>
              
                    </div>
           
                </div>
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                           <div class="row">
                               <div class="col-md-6">
                                   Email:
                               </div>
                               <div class="col-md-6">
                                   <?= $userinfo->email; ?>
                               </div>
                           </div> 
                           <p></p>
                           <div class="row">
                               <div class="col-md-6">
                                   Mobile No
                               </div>
                               <div class="col-md-6">
                                   <?= $userinfo->mobileno; ?>
                               </div>
                           </div>
                           <p></p>
                           <div class="row">
                               <div class="col-md-6">
                                   Address
                               </div>
                               <div class="col-md-6">
                                   <?= $userinfo->location; ?>
                               </div>
                           </div>
                           <p></p>
                           <div class="row">
                               <div class="col-md-6">
                                   District
                               </div>
                               <div class="col-md-6">
                                   <?= $userinfo->district; ?>
                               </div>
                           </div>
                           <p></p>
                           <div class="row">
                               <div class="col-md-6">
                                   State
                               </div>
                               <div class="col-md-6">
                                   <?= $userinfo->state; ?>
                               </div>
                           </div>
                           <p></p>
                           <div class="row">
                               <div class="col-md-6">
                                   Pincode
                               </div>
                               <div class="col-md-6">
                                   <?= $userinfo->pincode; ?>
                               </div>
                           </div>
                           <p></p>
                           <div class="row">
                               <div class="col-md-6">
                                   Member Since
                               </div>
                               <div class="col-md-6">
                                   <?= $userinfo->created_date; ?>
                               </div>
                           </div>
                           
                           
                        </div>
              
                    </div>
                </div>
                
               
            </div>
            
         
            
          
        </div><!-- /.container-fluid -->
    </section>
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



    });
</script>
</body>
<style>


.zoom:hover {
  transform: scale(2.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
  border:1px solid #BD4A58;
  border-radius:50%;
}
</style>
</html>