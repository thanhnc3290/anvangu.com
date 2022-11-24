<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Anvangu.com | Danh Sách Tin Tức</title>
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
            <h1>Danh sách Tin Tức</h1>
          </div>
          <div class="col-sm-2">
            <a href="<?php echo admin_url('news/add') ?>" type="button" class="btn btn-block btn-success">Tạo mới Tin Tức</a>
          </div>
          <div class="col-sm-2">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Danh sách Tin Tức</li>
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
                    <th style="width:25%;">Danh Mục</th>
                    <th style="width:10%;">Trạng Thái</th>
                    <th style="width:10%;">Nổi Bật</th>
                    <th style="width:10%;">Lượt Xem</th>
                    <th style="width:20%;">Thao Tác</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?php 
                      $list = $this->db->query('
                          SELECT 	id, name, status, hot, catalog_id, view
                          From news
                          ORDER BY id DESC
                      ')->result_array();
                      $count = '0';
                      foreach($list as $row){
                        $count++;
                        if($row['status']   == '0'){$status = '<span class="badge bg-success">Active</span>';}else{$status = '<span class="badge bg-danger">Deactive</span>';}
                        if($row['hot']   == '0'){$hot_status = '<span class="badge bg-success">Active</span>';}else{$hot_status = '<span class="badge bg-danger">Deactive</span>';}
                        $action     = '<a href="'.admin_url('news/edit/'.$row['id']).'"><span class="badge bg-primary" style="margin-right: 20px;">Sửa</span></a> <a href="'.admin_url('news/delete/'.$row['id']).'" class="confirmation"><span class="badge bg-danger">Xóa</span></a>';
                        $catalog    = 'N/a';
                        if($row['catalog_id'] == '1'){$catalog = 'Thị Trường';}
                        if($row['catalog_id'] == '2'){$catalog = 'Kiến Thức';}
                        if($row['catalog_id'] == '3'){$catalog = 'Xây Dựng, Phong Thủy';}
                        if($row['catalog_id'] == '4'){$catalog = 'Góc Tư Vấn';}
                        if($row['catalog_id'] == '5'){$catalog = 'Phân Tích, Nhận Định';}
                        if($row['catalog_id'] == '6'){$catalog = 'Thông Tin Quy Hoạch';}
                        if($row['catalog_id'] == '7'){$catalog = 'Tài Chính';}
                        if($row['catalog_id'] == '100'){$catalog = 'Giới Thiệu';}
                        if($row['catalog_id'] == '101'){$catalog = 'Hỗ Trợ Khách Hàng';}
                        if($row['catalog_id'] == '102'){$catalog = 'Quảng Cáo';}
                        echo 
                        '<tr style="text-align:center;">'.
                        '<td>'.$count.'</td>'.
                        '<td>'.json_decode($row['name']).'</td>'.
                        '<td>'.$catalog.'</td>'.
                        '<td>'.$status.'</td>'.
                        '<td>'.$hot_status.'</td>'.
                        '<td>'.number_format($row['view']).'</td>'.
                        '<td>'.$action.'</td>'.
                        '</tr>';
                      }

                    ?>
                  </tbody>                  
                  <tfoot>
                  <tr style="text-align:center;">
                    <th style="width:10%;">STT</th>
                    <th style="width:25%;">Tên</th>
                    <th style="width:25%;">Danh Mục</th>
                    <th style="width:10%;">Trạng Thái</th>
                    <th style="width:10%;">Nổi Bật</th>
                    <th style="width:10%;">Lượt Xem</th>
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
                    //confirm trước khi xóa
                    $('.confirmation').on('click', function () {
                        return confirm('Are you sure?');
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
