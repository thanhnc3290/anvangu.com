<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anvangu.com | Thêm mới Chủ Đầu Tư</title>

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
                            <h1>Thêm mới Chủ Đầu Tư</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Thêm mới Chủ Đầu Tư</li>
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
                                            <label for="inputName">Loại Hình Doanh Nghiệp</label>
                                            <input type="text" id="" name="prefix" class="form-control">
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="inputName">Tên Chủ Đầu Tư</label>
                                            <input type="text" id="input_name" name="name" class="form-control" onkeyup="create_alias();">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="inputName">Đường dẫn (url):</label>
                                            <input type="text" id="input_alias" name="alias" class="form-control" onchange="edit_alias();">
                                            <script>
                                                function create_alias(){
                                                    var title, slug;
                                                
                                                    //Lấy text từ thẻ input title 
                                                    title = document.getElementById("input_name").value;
                                                
                                                    //Đổi chữ hoa thành chữ thường
                                                    slug = title.toLowerCase();
                                                
                                                    //Đổi ký tự có dấu thành không dấu
                                                    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                                                    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                                                    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                                                    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                                                    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                                                    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                                                    slug = slug.replace(/đ/gi, 'd');
                                                    //Xóa các ký tự đặt biệt
                                                    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                                                    //Đổi khoảng trắng thành ký tự gạch ngang
                                                    slug = slug.replace(/ /gi, "-");
                                                    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                                                    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                                                    slug = slug.replace(/\-\-\-\-\-/gi, '-');
                                                    slug = slug.replace(/\-\-\-\-/gi, '-');
                                                    slug = slug.replace(/\-\-\-/gi, '-');
                                                    slug = slug.replace(/\-\-/gi, '-');
                                                    //Xóa các ký tự gạch ngang ở đầu và cuối
                                                    slug = '@' + slug + '@';
                                                    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                                                    //In slug ra textbox có id “slug”
                                                    document.getElementById('input_alias').value = slug;
                                                }
                                                function edit_alias(){
                                                    var title, slug;
                                                
                                                    //Lấy text từ thẻ input title 
                                                    title = document.getElementById("input_alias").value;
                                                
                                                    //Đổi chữ hoa thành chữ thường
                                                    slug = title.toLowerCase();
                                                
                                                    //Đổi ký tự có dấu thành không dấu
                                                    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
                                                    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
                                                    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
                                                    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
                                                    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
                                                    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
                                                    slug = slug.replace(/đ/gi, 'd');
                                                    //Xóa các ký tự đặt biệt
                                                    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
                                                    //Đổi khoảng trắng thành ký tự gạch ngang
                                                    slug = slug.replace(/ /gi, "-");
                                                    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
                                                    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
                                                    slug = slug.replace(/\-\-\-\-\-/gi, '-');
                                                    slug = slug.replace(/\-\-\-\-/gi, '-');
                                                    slug = slug.replace(/\-\-\-/gi, '-');
                                                    slug = slug.replace(/\-\-/gi, '-');
                                                    //Xóa các ký tự gạch ngang ở đầu và cuối
                                                    slug = '@' + slug + '@';
                                                    slug = slug.replace(/\@\-|\-\@|\@/gi, '');
                                                    //In slug ra textbox có id “slug”
                                                    document.getElementById('input_alias').value = slug;
                                                }
                                            </script>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="inputDescription">Meta Key:</label>
                                            <textarea class="form-control" rows="4" name="meta_key"></textarea>
                                        </div>
                                        <div class="form-group col-6">
                                            <label for="inputDescription">Meta Desc:</label>
                                            <textarea class="form-control" rows="4" name="meta_desc"></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Nội dung Giới Thiệu:</label>
                                        <textarea id="editor" class="form-control" rows="4" name="content"></textarea>
                                        <script type="text/javascript" src="<?php echo public_url()?>js/ckeditor/ckeditor.js"></script> 
                                        <script type="text/javascript" src="<?php echo public_url()?>js/ckfinder/ckfinder.js"></script> 
                                        <script>CKEDITOR.replace('editor');</script>
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
                                            <option value="0">Hiển Thị</option>
                                            <option value="1">Ẩn</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="exampleInputFile">Ảnh Đại Diện (1 ảnh):</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" id="image_link" onchange="preview_image_link();" name="image_link">
                                            </div>
                                        </div>
                                    </div>
                                    <div id="image_link_preview"></div>
                                    

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
                            <input type="submit" value="Create new Project" class="btn btn-success float-right">
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
