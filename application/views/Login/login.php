<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?= base_url("assets/")?>plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="<?= base_url("assets/")?>plugins/icheck-bootstrap/icheck-bootstrap.min.css">
   <link rel="stylesheet" href="<?= base_url("assets/")?>plugins/select2/css/select2.min.css">
     <link rel="stylesheet" href="<?= base_url("assets/")?>plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?= base_url("assets/")?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#"><img src="<?= base_url('assets/images/logo.png');?>" width='250' height='60' /></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>
      <?PHP 
        if(!empty($this->session->flashdata('swmsg'))){
            echo "<div class='alert alert-danger'>". $this->session->flashdata('swmsg')."</div>";
        }
      ?>
      <form action="#" method="post">
        <!--
        <div class="input-group mb-3">
             <select class="form-control select2 select2-danger" data-dropdown-css-class="select2-danger" style="width: 100%;" required>
                    <option selected="selected">Select</option>
                    <option value="1">Vendor</option>
                    <option value='2'>Administrator</option>
                    
            </select>
        </div> -->
        <div class="input-group mb-3 id_email">
          <input type="text" class="form-control" placeholder="User name" name='userid' required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-user"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3 id_password">
          <input type="password" class="form-control" placeholder="Password" name='password' required>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
   
      <p class="mb-1">
        <a href="forgot-password.html">I forgot my password</a>
      </p>
     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->


<script src="<?= base_url("assets/")?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?= base_url("assets/")?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?= base_url("assets/")?>dist/js/adminlte.min.js"></script>
<script src="<?= base_url("assets/")?>plugins/select2/js/select2.full.min.js"></script>
<script>
    $(function(){
        $('.select2').select2();
    })
</script>
</body>
</html>
