<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Product</title>

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
                        <a href="<?= base_url('index.php/product_master') ?>">
                            <Button class="btn btn-primary">
                                <i class="fa fa-arrow-left"> Back </i>
                            </Button>
                        </a>
                    </h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Add Product</li>
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
                    <h3 class="card-title">Add product</h3>

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
                            <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Select Category</label>
                                    <select class="form-control" name="cat_id" id="cat_id" required>
                                        <option value="">Select Category</option>
                                        <?PHP 
                                          foreach($category_list as $category){
                                              if($category->is_active==0) continue;
                                              if(isset($pinfo) && $category->cat_id==$pinfo->cat_id)
                                              echo "<option value=".$category->cat_id." selected>".$category->cat_name."</option>";
                                              else
                                              echo "<option value=".$category->cat_id.">".$category->cat_name."</option>";
                                          }
                                        ?>
                                    </select>
                                   
                                </div>
                            </div>
                                   <div class="col-md-6">
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Select Brand</label>
                                    <select class="form-control" name="brand_id" id="brand_id" required>
                                        <?PHP if(isset($pinfo)){ 
                                              foreach($brandinfo as $b ){
                                                  if($pinfo->brand_id==$b->brand_id){
                                                    echo "<option value='".$b->brand_id."' selected>".$b->brand_name."</option>";
                                                  }
                                              }
                                            
                                        }
                                        else{
                                            echo "<option value=''>Select Brand</option>";
                                        }
                                        
                                        ?>
                                        
                                    </select>
                                   
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Product Name</label>
                                    <input type="text" value="<?PHP if(isset($pinfo)){ echo $pinfo->product_name;}else{ echo ""; } ?>" class="form-control" placeholder="title" name="product_name" required>
                                </div>
                            </div>
                            <div class="col-6">
                                 <div class="form-group">
                                    <label for="exampleInputEmail1">Product Description</label>
                                    <input type="text" value="<?PHP if(isset($pinfo)){ echo $pinfo->description;}else{ echo ""; } ?>" class="form-control" placeholder="Description" name="description" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">CGST</label>
                                    <input type="number" value="<?PHP if(isset($pinfo)){ echo $pinfo->CGST;}else{ echo ""; } ?>" class="form-control" placeholder="CGST" name="CGST" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">SGST</label>
                                    <input type="number" value="<?PHP if(isset($pinfo)){ echo $pinfo->SGST;}else{ echo ""; } ?>" class="form-control" placeholder="SGST" name="SGST" required>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">IGST</label>
                                    <input type="number" value="<?PHP if(isset($pinfo)){ echo $pinfo->IGST;}else{ echo ""; } ?>" class="form-control" placeholder="IGST" name="IGST" required>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">HSN Code</label>
                                    <input type="text" value="<?PHP if(isset($pinfo)){ echo $pinfo->HSN_CODE;}else{ echo ""; } ?>" class="form-control" placeholder="HSN Code" name="HSN_CODE" required>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Upload Image</label>
                                    <input type=hidden value="<?PHP if(isset($pinfo)){ echo $pinfo->product_img;}else{ echo "";}?>" name="old_image">
                                    <input type="file" class="form-control" id="product_image" name="product_image" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Image Preview</label><br>
                                    <img id="output"  width="100" height="80" <?PHP if(isset($pinfo)){ echo "src=".base_url($pinfo->product_img);}else{ echo ""; } ?>>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Upload Video</label>
                                    <input type=hidden value="<?PHP if(isset($pinfo)){ echo $pinfo->product_video;}else{ echo "";}?>" name="old_video">
                                    <input type="file" class="form-control" id="product_video" name="product_video" >
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Video Preview</label><br>
                                    <video id="voutput" width="200" height="120" <?PHP if(isset($pinfo)){ echo "src=".base_url($pinfo->product_video);}else{ echo ""; } ?> controls>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Is Active?</label><br>
                                    <input type="checkbox" class="form-control" name="is_active" <?PHP if(isset($pinfo) && ($pinfo->is_active==1)){ echo "checked";}else{ echo ""; } ?> data-bootstrap-switch data-off-color="danger" data-on-color="success">
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
    

        $('#cat_id').change(function(){ 
                var id=$(this).val();
                console.log(id);
                $.ajax({
                    url : "<?php echo base_url('index.php/get_brands');?>",
                    method : "POST",
                    data : {cat_id: id},
                    async : true,
                    dataType : 'json',
                    success: function(data){
                         console.log(data[0]);
                        var html = '<option value="">Select Brand</option>';
                        var i;
                        if(data.length==0){
                            html+='<option value="">No Brands found in this Category</option>';
                        }
                        for(i=0; i<data.length; i++){
                            console.log(data[i].brand_name);
                            html += '<option value='+data[i].brand_id+'>'+data[i].brand_name+'</option>';
                        }
                        $('#brand_id').html(html);
 
                    }
                });
                return false;
            }); 
            
            
           $("#product_image").change(function () {
                if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                $('#output').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
                }
            });
            
            $("#product_video").change(function () {
                if (this.files && this.files[0]) {
                var reader = new FileReader();
                reader.onload = function (e) {
                $('#voutput').attr('src', e.target.result);
                }
                reader.readAsDataURL(this.files[0]);
                }
            });


    });
</script>
</body>

</html>