<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Anvangu.com | Danh Sách QTV</title>
  <META HTTP-EQUIV="Pragma" CONTENT="no-cache">
  <META HTTP-EQUIV="Expires" CONTENT="-1">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/fontawesome-free/css/all.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/datatables-buttons/css/buttons.bootstrap4.min.css">
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
          <div class="col-sm-8">
            <h1>Danh sách QTV</h1>
          </div>
          <div class="col-sm-2">
            <a href="<?php echo admin_url('admin/add') ?>" type="button" class="btn btn-block btn-success">Tạo mới QTV</a>
          </div>
          <div class="col-sm-2">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Danh sách QTV</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                    <?php 
                        if($this->session->userdata('group_id') < '2'){
                            echo 'Tài khoản có toàn quyền thao tác trong mục này';
                        }else{
                            echo 'Tài khoản chỉ có quyền xem';
                        }
                    ?>
                </h3>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr style="text-align:center;">
                    <th style="width:10%;">STT</th>
                    <th style="width:25%;">Tên</th>
                    <th style="width:25%;">User Name</th>
                    <th style="width:10%;">Phân Quyền</th>
                    <th style="width:10%;">Trạng Thái</th>
                    <th style="width:20%;">Thao Tác</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $admin_group_id = $this->session->userdata('group_id');
                      
                      $list = $this->db->query('
                          SELECT 	id, name, status, group_id, username
                          From admin
                          ORDER BY id DESC
                      ')->result_array();
                      $count = '0';
                      foreach($list as $row){
                        $count++;
                        if($row['group_id'] == '0') $group_id = 'Chief';
                        if($row['group_id'] == '1') $group_id = 'Admin';
                        if($row['group_id'] == '2') $group_id = 'Editor';
                        if($row['status']   == '0'){$status = '<span class="badge bg-success">Active</span>';}else{$status = '<span class="badge bg-danger">Deactive</span>';}
                        if($admin_group_id < '2'){
                          $action = '<a href="'.admin_url('admin/edit/'.$row['id']).'"><span class="badge bg-primary" style="margin-right: 20px;">Sửa</span></a> <span class="badge bg-danger">Xóa</span>';
                        }else{
                          $action = 'Không Có Quyền Thao Tác';
                        }
                        echo 
                        '<tr style="text-align:center;">'.
                        '<td>'.$count.'</td>'.
                        '<td>'.($row['name']).'</td>'.
                        '<td>'.($row['username']).'</td>'.
                        '<td>'.$group_id.'</td>'.
                        '<td>'.$status.'</td>'.
                        '<td>'.$action.'</td>'.
                        '</tr>'
                        ;
                      }

                    ?>
                  </tbody>                  
                  <tfoot>
                  <tr style="text-align:center;">
                    <th style="width:10%;">STT</th>
                    <th style="width:25%;">Tên</th>
                    <th style="width:25%;">User Name</th>
                    <th style="width:10%;">Phân Quyền</th>
                    <th style="width:10%;">Trạng Thái</th>
                    <th style="width:20%;">Thao Tác</th>
                  </tr>
                  </tfoot>
                </table>
                    
                <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
                <script>
                  //filter table    
                  $(function () {
                    $("#example1").DataTable({
                      "responsive": true, "lengthChange": false, "autoWidth": false,
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
                  });
              </script>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->
    </section>
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
<!-- DataTables  & Plugins -->
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/datatables/jquery.dataTables.min.js"></script>
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/jszip/jszip.min.js"></script>
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/pdfmake/pdfmake.min.js"></script>
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/pdfmake/vfs_fonts.js"></script>
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<!-- AdminLTE App -->
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?php echo public_url('admin/AdminLTE-master/'); ?>dist/js/demo.js"></script>
<!-- Page specific script -->

</body>
</html>
