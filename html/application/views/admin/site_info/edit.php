
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Anvangu.com | Edit Thông Tin Website</title>

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
            <h1>Sửa Thông Tin Website</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Sửa thông tin Website</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
    <?php 
        $admin_id       = $this->session->userdata('id');
        $admin_group_id = $this->session->userdata('group_id');
        $check          = '1';
        if(($admin_group_id < '2')){
          $check = '0';
        }else{
          if($admin_id == $info->id){
            $check = '0';
          }
        }
        if($check == '1'){
          redirect(admin_url());
        }
    ?>
    <!-- Main content -->
    <form action="" method="post" enctype="multipart/form-data"> 
    <section class="content">
      <div class="row">
        <div class="col-md-12">
          <div class="card card-primary">
            <div class="card-header">
              <h3 class="card-title">Thông tin Website</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <?php 
                 $data = json_decode($info->sife_info_data);
            ?>
            <div class="card-body">
                <div class="row" style="font-size:80%;">
                    <div class="form-group col-12">
                        <label for="inputName">Site Title:</label>
                        <input type="text" id="inputName" class="form-control" name="site_title" value="<?php if(isset($data->site_title)){echo $data->site_title;} ?>">
                    </div>
                    <div class="form-group col-3">
                        <label for="inputName">Hotline:</label>
                        <input type="text" id="inputName" class="form-control" name="hotline" value="<?php if(isset($data->hotline)){echo $data->hotline;} ?>">
                    </div>
                    <div class="form-group col-3">
                        <label for="inputName">Mail:</label>
                        <input type="text" id="inputName" class="form-control" name="email" value="<?php if(isset($data->email)){echo $data->email;} ?>">
                    </div>
                    <div class="form-group col-3">
                        <label for="inputName">Địa Chỉ:</label>
                        <input type="text" id="inputName" class="form-control" name="dia_chi" value="<?php if(isset($data->dia_chi)){echo $data->dia_chi;} ?>">
                    </div>
                    <div class="form-group col-3">
                        <label for="inputName">Thông Tin Doanh Nghiệp:</label>
                        <input type="text" id="inputName" class="form-control" name="ma_so_thue" value="<?php if(isset($data->ma_so_thue)){echo $data->ma_so_thue;} ?>">
                    </div>
                    <div class="form-group col-4">
                        <label for="inputName">Zalo:</label>
                        <input type="text" id="inputName" class="form-control" name="zalo" value="<?php if(isset($data->zalo)){echo $data->zalo;} ?>">
                    </div>
                    <div class="form-group col-4">
                        <label for="inputName">Skype:</label>
                        <input type="text" id="inputName" class="form-control" name="skype" value="<?php if(isset($data->skype)){echo $data->skype;} ?>">
                    </div>
                    <div class="form-group col-4">
                        <label for="inputName">Messenger:</label>
                        <input type="text" id="inputName" class="form-control" name="messenger" value="<?php if(isset($data->messenger)){echo $data->messenger;} ?>">
                    </div>
                    <div class="form-group col-4">
                        <label for="inputName">Facebook:</label>
                        <input type="text" id="inputName" class="form-control" name="facebook" value="<?php if(isset($data->facebook)){echo $data->facebook;} ?>">
                    </div>
                    <div class="form-group col-4">
                        <label for="inputName">Youtube:</label>
                        <input type="text" id="inputName" class="form-control" name="youtube" value="<?php if(isset($data->youtube)){echo $data->youtube;} ?>">
                    </div>
                    <div class="form-group col-4">
                        <label for="inputName">Pinterest:</label>
                        <input type="text" id="inputName" class="form-control" name="pinterest" value="<?php if(isset($data->pinterest)){echo $data->pinterest;} ?>">
                    </div>
                    <div class="form-group col-4">
                        <label for="inputName">Twitter:</label>
                        <input type="text" id="inputName" class="form-control" name="twitter" value="<?php if(isset($data->twitter)){echo $data->twitter;} ?>">
                    </div>
                    <div class="form-group col-4">
                        <label for="inputName">Instagram:</label>
                        <input type="text" id="inputName" class="form-control" name="instagram" value="<?php if(isset($data->instagram)){echo $data->instagram;} ?>">
                    </div>
                    <div class="form-group col-4">
                        <label for="inputName">LinkedIn:</label>
                        <input type="text" id="inputName" class="form-control" name="linkedin" value="<?php if(isset($data->linkedin)){echo $data->linkedin;} ?>">
                    </div>
                    <div class="form-group col-6">
                        <label for="inputDescription">Meta Key:</label>
                        <textarea class="form-control" rows="4" name="meta_key"><?php if(isset($data->meta_key)){echo $data->meta_key;} ?></textarea>
                    </div>
                    <div class="form-group col-6">
                        <label for="inputDescription">Meta Desc:</label>
                        <textarea class="form-control" rows="4" name="meta_desc"><?php if(isset($data->meta_desc)){echo $data->meta_desc;} ?></textarea>
                    </div>
                    <div class="form-group col-4">
                        <label for="inputDescription">Các Mã Gán vào thẻ < head>< /head>:</label>
                        <textarea class="form-control" rows="4" name="head_script"><?php if(isset($data->head_script)){echo $data->head_script;} ?></textarea>
                    </div>
                    <div class="form-group col-4">
                        <label for="inputDescription">Các Mã Gán vào thẻ < body>< /body>:</label>
                        <textarea class="form-control" rows="4" name="body_script"><?php if(isset($data->body_script)){echo $data->body_script;} ?></textarea>
                    </div>
                    <div class="form-group col-4">
                        <label for="inputDescription">Các Mã Gán vào thẻ Trang Chuyển Đổi thành công:</label>
                        <textarea class="form-control" rows="4" name="success_script"><?php if(isset($data->success_script)){echo $data->success_script;} ?></textarea>
                    </div>
                    <div class="form-group col-6">
                        <label for="exampleInputFile">Ảnh Logo (jpg png) - chú ý re-format ảnh trước khi up:</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="logo_image_link" onchange="preview_logo_image_link()" name="logo_image_link">
                            </div>
                        </div>
                        <div class="form-group col-12" id="logo_image_link_preview">
                            <center><img style='max-height:200px;' src='<?php echo base_url('upload/site_info/'.$info->logo_image_link) ?>'/></center>
                        </div>
                        <script>
                            function preview_logo_image_link(){
                                var total_file=document.getElementById("logo_image_link").files.length;
                                $('#logo_image_link_preview').html('');
                                for(var i=0;i<total_file;i++){
                                    $('#logo_image_link_preview').append("<div class='col-md-12'><center><img style='max-height:200px;' src='"+URL.createObjectURL(event.target.files[i])+"'></center></div>");
                                }
                            }
                        </script>
                    </div>
                    
                    <div class="form-group col-6">
                        <label for="exampleInputFile">Ảnh Favicon (jpg png) - chú ý re-format ảnh trước khi up:</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="favicon_image_link" onchange="preview_favicon_image_link()" name="favicon_image_link">
                            </div>
                        </div>
                        <div class="form-group col-12" id="favicon_image_link_preview">
                            <center><img style='max-height:200px;' src='<?php echo base_url('upload/site_info/'.$info->favicon_image_link) ?>'/></center>
                        </div>
                        <script>
                            function preview_favicon_image_link(){
                                var total_file=document.getElementById("favicon_image_link").files.length;
                                $('#favicon_image_link_preview').html('');
                                for(var i=0;i<total_file;i++){
                                    $('#favicon_image_link_preview').append("<div class='col-md-12'><center><img style='max-height:200px;' src='"+URL.createObjectURL(event.target.files[i])+"'></center></div>");
                                }
                            }
                        </script>
                    </div>

                    <div class="form-group col-12">
                        <label for="exampleInputFile">Ảnh Social - Trang Chủ (1 ảnh) - chú ý re-format ảnh trước khi up:</label>
                        <div class="input-group">
                            <div class="custom-file">
                                <input type="file" id="image_link" onchange="preview_image_link();" name="image_link">
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-12" id="image_link_preview">
                        <center><img style='max-height:200px;' src='<?php echo base_url('upload/site_info/'.$info->image_link) ?>'/></center>
                    </div>
                    <script>
                        function preview_image_link(){
                            var total_file=document.getElementById("image_link").files.length;
                            $('#image_link_preview').html('');
                            for(var i=0;i<total_file;i++){
                                $('#image_link_preview').append("<div class='col-md-12'><center><img style='max-height:200px;' src='"+URL.createObjectURL(event.target.files[i])+"'></center></div>");
                            }
                        }
                    </script>
                </div>
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
