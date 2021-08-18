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
                     <a href=""><button class="btn btn-sm btn-danger">Back</button></a>  
                        Vendors Operations
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
                <div class="col-lg-3 col-6">
           
                    <div class="info-box shadow-lg">
                        <span class="info-box-icon bg-primary"><i class="far fa-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Users Info</span>
                            <span class="info-box-number">
                                <a href="<?= base_url("index.php/view_users"); ?>">
                                    <button class="btn btn-small btn-primary">View Users</button>
                                </a>
                            </span>
                        </div>
              
                    </div>
                </div>
                <div class="col-lg-3 col-6">
           
                    <div class="info-box shadow-lg">
                        <span class="info-box-icon bg-danger"><i class="far fa-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Bulk Vendors</span>
                            <span class="info-box-number">
                                <a href="<?= base_url("index.php/bulk_vendors"); ?>">
                                    <button class="btn btn-small btn-danger">View Vendors</button>
                                </a>
                            </span>
                        </div>
              
                    </div>
                </div>
                
                 <div class="col-lg-3 col-6">
           
                    <div class="info-box shadow-lg">
                        <span class="info-box-icon bg-warning"><i class="far fa-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Retail Vendors</span>
                            <span class="info-box-number">
                                <a href="<?= base_url("index.php/retail_vendors"); ?>">
                                    <button class="btn btn-small btn-warning">View Vendors</button>
                                </a>
                            </span>
                        </div>
              
                    </div>
                </div>
                
                <div class="col-lg-3 col-6">
           
                    <div class="info-box shadow-lg">
                        <span class="info-box-icon bg-info"><i class="far fa-user"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Special Customers</span>
                            <span class="info-box-number">
                                <a href="<?= base_url("index.php/special_vendors"); ?>">
                                    <button class="btn btn-small btn-info">View Customers</button>
                                </a>
                            </span>
                        </div>
              
                    </div>
                </div>
                
                
                
          
                
        
            </div>
            <div class="row">
                 <div class="col-lg-3 col-6">
           
                    <div class="info-box shadow-lg">
                        <span class="info-box-icon bg-info"><i class="fa fa-plus"></i></span>

                        <div class="info-box-content">
                            <span class="info-box-text">Add Vendor</span>
                            <span class="info-box-number">
                                <a href="<?= base_url("index.php/add_vendor"); ?>">
                                    <button class="btn btn-small btn-info">Register</button>
                                </a>
                            </span>
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
.zoom {
  padding: 0px;
  transition: transform .2s; /* Animation */
  width: 100px;
  height: 80px;
  margin: 0 auto;
  border-radius:8px;
}

.zoom:hover {
  transform: scale(2.5); /* (150% zoom - Note: if the zoom is too large, it will go outside of the viewport) */
  border:1px solid #BD4A58;
  border-radius:10px;
}
</style>
</html>