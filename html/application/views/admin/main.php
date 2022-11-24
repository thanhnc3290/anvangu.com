
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Anvangu.com | Dashboard</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/fontawesome-free/css/all.min.css">
  <!-- IonIcons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo public_url('admin/AdminLTE-master/'); ?>dist/css/adminlte.min.css">
</head>
<!--
`body` tag options:

  Apply one or more of the following classes to to the body tag
  to get the desired effect

  * sidebar-collapse
  * sidebar-mini
-->
<body class="hold-transition sidebar-collapse dark-mode">
<div class="wrapper">
    <?php $this->load->view('admin/header'); ?>
    <?php $this->load->view('admin/left_side_bar');?>
  

  <?php $this->load->view($temp, $this->data); ?>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->
  <footer class="main-footer"></footer>
</div>
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<!-- jQuery -->
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE -->
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>dist/js/adminlte.js"></script>

<!-- OPTIONAL SCRIPTS -->
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/chart.js/Chart.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>dist/js/pages/dashboard3.js"></script>
</body>
</html>
