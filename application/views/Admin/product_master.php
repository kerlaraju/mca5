<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>product</title>

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
                    <h1 class="m-0">product List
                        <a href="<?= base_url('index.php/add_pro')?>">
                        <Button class="btn btn-primary">
                             <i class="fa fa-plus"> New </i>
                        </Button>
                        </a>
                        
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div class="card">

        <!-- /.card-header -->
        <div class="card-body">
            <?PHP
                if(!empty($this->session->flashdata('smsg'))){
                    $smsg=$this->session->flashdata('smsg');
                        echo "<div class='alert alert-success'>".$smsg."</div>";

                }

            ?>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th> SNO </th>
                        <th>Action</th>
                        <th>Category Name</th>
                        <th>Brand Name</th>
                        <th>Product Name</th>
                        <th>Product Description</th>
                        <th>Product Image</th>
                        <th>Product Video</th>
                        <th>CGST</th>
                        <th>SGST</th>
                        <th>IGST</th>
                        <th>HSN_CODE</th>
                        <th>Status</th>


                    </tr>
                </thead>
                <tbody>
             <?PHP
                $n=1;
                foreach($product_master as $x){?>
                    <tr>
                        <td><?PHP  echo $n; ?></td>
                        <td>
                            <div>
                                    <a href="<?= base_url('index.php/edit_pro/'.$x->pid); ?>"><i class="fa fa-edit"> </i></a>
                    
                                    <a href="<?= base_url('index.php/delete_pro/'.$x->pid); ?>"><i class="fa fa-trash"> </i></a>
                            </div>

                        </td>
            
                        <td> <?PHP echo $x->cat_name; ?> </td>
                        <td> <?PHP echo $x->brand_name; ?> </td>
                        <td> <?PHP echo $x->product_name; ?> </td>
                        <td> <?PHP echo $x->description; ?> </td>
                       <td align="center"> <img class='zoom' src="<?PHP echo isset($x->product_img)?base_url($x->product_img):base_url("assets/images/logo.png"); ?>" ></img> </td>
                        <td align="center"><video width="160" height="120" src="<?PHP echo base_url($x->product_video); ?>" controls></video></td>
                        <td> <?PHP echo $x->CGST; ?> </td>
                        <td> <?PHP echo $x->SGST; ?> </td>
                        <td> <?PHP echo $x->IGST; ?> </td>
                        <td> <?PHP echo $x->HSN_CODE; ?> </td>
                        <td> <?PHP echo ($x->is_active==1)?"Active":"In-Active"; ?> </td>
                    </tr>
                    <?PHP 
                    $n++;
                }
                ?>
                

                </tbody>

            </table>

        </div>

        <!-- /.card-body -->
    </div>

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

<div class="modal fade" id="modal-lg">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Product List</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="form" action="" method="post">
                <div class="modal-body">
                    <input type="hidden" id="flag" value="" />
                    <div id="pid_block" style="display:none" class="form-group">
                        <label>Product Id</label>
                        <input type="text" id="pid" class="form-control" placeholder="Product ID" disabled>
                    </div>
                    <div class="form-group">
                        <label>Category Id</label>
                        <input type="text" id="cat_id" class="form-control" placeholder="Enter Category Id">
                    </div>
                    <div class="form-group">
                        <label>Brand Id</label>
                        <input type="text" id="brand_id" class="form-control" placeholder="Enter Brand Id">
                    </div>
                    <div class="form-group">
                        <label>product Name</label>
                        <input type="text" id="product_name" class="form-control" placeholder="Enter Product Name">
                    </div>
                    <div class="form-group">
                        <label>Product Description</label>
                        <input type="text" id="description" class="form-control" placeholder="Enter Product Description">
                    </div>

                    <div class="form-group">
                        <label>Product Image</label>
                        <input type="file" id="product_img" class="form-control" placeholder="Enter Product Image">
                    </div>
                    <div class="form-group">
                        <label>Product Video</label>
                        <input type="file" id="product_video" class="form-control" placeholder="Enter Product Video">
                    </div>
                    <div class="form-group">
                        <label>CGST</label>
                        <input type="text" id="CGST" class="form-control" placeholder="Enter CGST ">
                    </div>
                    <div class="form-group">
                        <label>SGST </label>
                        <input type="text" id="SGST" class="form-control" placeholder="Enter  SGST">
                    </div>
                    <div class="form-group">
                        <label>IGST </label>
                        <input type="text" id="IGST" class="form-control" placeholder="Enter  IGST">
                    </div>
                    <div class="form-group">
                        <label>HSN CODE</label>
                        <input type="text" id="HSN_CODE" class="form-control" placeholder="Enter HSN CODE ">
                    </div>


                </div>
                <div class="modal-footer justify-content-between">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="reset" class="btn btn-danger reset" id="reset">Reset</button>
                    <button type="button" id="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

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
</body>

</html>