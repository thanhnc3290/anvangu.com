
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Anvangu.com | Edit QTV</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/fontawesome-free/css/all.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?php echo public_url('admin/AdminLTE-master/'); ?>dist/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-collapse dark-mode">
<div class="wrapper">
    <?php $this->load->view('admin/header'); ?>
    <?php $this->load->view('admin/left_side_bar'); ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Sửa Thông Tin QTV</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sửa thông tin QTV</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php 
        $admin_id       = $this->session->userdata('id');
        $admin_group_id = $this->session->userdata('group_id');
        $check          = '1';
        if(($admin_group_id < '2') && ($admin_group_id <= $info->group_id)){
          $check = '0';
        }else{
          if($admin_id == $info->id){
            $check = '0';
          }
        }
        if($check == '1'){
          redirect(admin_url('admin/index'));
        }
    ?>
    <!-- Main content -->
    <form action="" method="post">
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Thông tin</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <div class="form-group">
                <label for="inputName">Tên:</label>
                <input type="text" id="inputName" class="form-control" name="name" value="<?php echo $info->name; ?>">
              </div>
              <div class="form-group">
                <label for="inputName">Username (Không thay đổi):</label>
                <input type="text" id="inputName" class="form-control" value="<?php echo $info->username; ?>" disabled>
              </div>
              <?php if(($admin_group_id <= $info->group_id) && ($admin_group_id < '2')): ?>
              <div class="form-group">
                <label for="inputStatus">Phân Quyền:</label>
                <select id="inputStatus" class="form-control custom-select" name="group_id">
                    <option value='2' <?php if($info->group_id == '2') echo 'selected' ?>>Editor</option>
                    <option value='1' <?php if($info->group_id == '1') echo 'selected' ?>>Admin</option>
                </select>
              </div>
              <div class="form-group">
                <label for="inputName">Mật Khẩu Mới:</label>
                <input type="password" id="inputName" class="form-control" value="" name="password">
              </div>
              <div class="form-group">
                <label for="inputName">Xác nhận Mật Khẩu Mới:</label>
                <input type="password" id="inputName" class="form-control" value="" name="re_password">
              </div>
              <div class="form-group">
                <label for="inputStatus">Trạng Thái:</label>
                <select id="inputStatus" class="form-control custom-select" name="status">
                    <option value='0' <?php if($info->status == '0') echo 'selected' ?>>Active</option>
                    <option value='1' <?php if($info->status == '1') echo 'selected' ?>>DeActive</option>
                </select>
              </div>
              <?php else: ?>
                <?php if($admin_id == $info->id): ?>
                <div class="form-group">
                    <label for="inputName">Mật Khẩu Mới:</label>
                    <input type="password" id="inputName" class="form-control" value="" name="password">
                </div>
                <div class="form-group">
                    <label for="inputName">Xác nhận Mật Khẩu Mới:</label>
                    <input type="password" id="inputName" class="form-control" value="" name="re_password">
                </div>
                <input name="status" value="<?php $info->status ?>" style="display:none;" />
                <?php else: ?>
                <input name="password" value="" style="display:none;" />
                <input name="status" value="<?php $info->status ?>" style="display:none;" />
                <?php endif; ?>
              <?php endif; ?>
            </div>
            <!-- /.card-body -->
          </div>
          <!-- /.card -->
        </div>
      </div>
      
      <div class="row">
        <div class="col-12">
          <a onclick="history.back()" class="btn btn-secondary">Quay Lại</a>
          <input type="submit" value="Cập Nhật" class="btn btn-success float-right">
        </div>
      </div>
    </section>
    </form>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer"></footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>dist/js/demo.js"></script>
</body>
</html>
