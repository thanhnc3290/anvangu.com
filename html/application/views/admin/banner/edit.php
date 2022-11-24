<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anvangu.com | Chỉnh Sửa Banner</title>

    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">

    <link rel="stylesheet"
        href="<?php echo public_url('admin/AdminLTE-master/') ?>plugins/fontawesome-free/css/all.min.css">

    <link rel="stylesheet" href="<?php echo public_url('admin/AdminLTE-master/') ?>dist/css/adminlte.min.css">
     
</head>

<body class="hold-transition sidebar-collapse dark-mode">
<div class="wrapper">
    <?php $this->load->view('admin/header'); ?>
    <?php $this->load->view('admin/left_side_bar');?>

        <div class="content-wrapper">

            <section class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1>Chỉnh Sửa Banner</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Chỉnh Sửa Banner</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <form action="" method="post" enctype="multipart/form-data">
                <section class="content">
                    <div class="row">
                     
                        <div class="col-md-8">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Nội Dung</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        <input type="text" name="author_id" class="form-control" value="<?php echo $this->session->userdata('id'); ?>" style="display:none;">
                                        <div class="form-group col-6">
                                            <label for="inputName">Tên Dự Án</label>
                                            <input type="text" id="input_name" name="name" class="form-control" value="<?php echo json_decode($info->name) ?>">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="inputName">Thử Tự Hiển Thị</label>
                                            <input type="number" name="sort_order" class="form-control" value="<?php echo $info->sort_order ?>">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="inputName">Link (nếu có):</label>
                                            <input type="text" name="link" class="form-control" value="<?php echo $info->link ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Hình Ảnh & Danh Mục, Trạng Thái</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                            title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="inputStatus">Trạng Thái:</label>
                                        <select id="inputStatus" class="form-control custom-select" name="status">
                                            <option value="0" <?php if($info->status == '0') echo 'selected';?>>Hiển Thị</option>
                                            <option value="1" <?php if($info->status == '1') echo 'selected';?>>Ẩn</option>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputFile">Ảnh (1 ảnh):</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" id="image_link" onchange="preview_image_link();" name="image_link">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="image_link_preview">
                                        <center><img style='max-height:200px;' src='<?php echo base_url('upload/banner/'.$info->image_link) ?>'/></center>
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
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <a onclick="history.back()"  class="btn btn-secondary">Cancel</a>
                            <input type="submit" value="Update Project" class="btn btn-success float-right">
                        </div>
                    </div>
                </section>
            </form>

        </div>

        <footer class="main-footer"></footer>

        <aside class="control-sidebar control-sidebar-dark">

        </aside>

    </div>


    <script src="<?php echo public_url('admin/AdminLTE-master/') ?>plugins/jquery/jquery.min.js"></script>

    <script src="<?php echo public_url('admin/AdminLTE-master/') ?>plugins/bootstrap/js/bootstrap.bundle.min.js">
    </script>

    <script src="<?php echo public_url('admin/AdminLTE-master/') ?>dist/js/adminlte.min.js"></script>

    <script src="<?php echo public_url('admin/AdminLTE-master/') ?>dist/js/demo.js"></script>
</body>

</html>
