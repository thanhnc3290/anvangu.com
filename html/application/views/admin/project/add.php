<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Anvangu.com | Thêm mới Dự Án</title>

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
                            <h1>Thêm mới Dự Án</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Thêm mới Dự Án</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </section>

            <form action="" method="post" enctype="multipart/form-data">
                <section class="content">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="card card-primary">
                                <div class="card-header">
                                    <h3 class="card-title">Thông Tin Chung</h3> 
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <input type="text" name="author_id" class="form-control" value="<?php echo $this->session->userdata('id'); ?>" style="display:none;">
                                    <div class="row" style="font-size: 80%;">
                                        <div class="form-group col-4">
                                            <label for="inputName">Tỉnh / Thành Phố</label>
                                            <select id="city_list" class="form-control custom-select" onchange="show_districts_list()" name="city_id" required>
                                                <option value="" selected disabled>Lựa Chọn</option>
                                                <?php 
                                                    $api_url  = base_url('api_project_city_list.json');
                                                    $data     = json_decode(file_get_contents($api_url));
                                                    foreach($data as $row){
                                                        echo '<option onclick="show_districts_list('.$row->city_id.')" value="'.$row->id.'">'.$row->name.'</option>';
                                                    }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="inputName">Quận / Huyện</label>
                                            <select id="districts_list" class="form-control custom-select" onchange="show_wards_list()" name="districts_id">
                                                <option selected disabled>Chọn Tỉnh / TP trước</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-4">
                                            <label for="inputName">Phường / Xã / Ấp</label>
                                            <select id="wards_list" class="form-control custom-select" name="wards_id">
                                                <option selected disabled>Chọn Quận / Huyện trước</option>
                                            </select>
                                        </div>

                                        <script>
                                            function appendData_districts_list(data) {
                                                var data_list = document.getElementById("districts_list");
                                                //Tạo option mặc định
                                                data_list.innerHTML = '<option selected disabled>Lựa chọn Quận / Huyện</option>';
                                                //Tạo option bên dưới
                                                for (var i = 0; i < data.length; i++) {
                                                    var item = document.createElement("option");
                                                    item.value      =  data[i].districts_id;
                                                    item.innerHTML  =  data[i].name;
                                                    data_list.appendChild(item);
                                                }

                                                document.getElementById("wards_list").innerHTML = '<option selected disabled>Chọn Quận / Huyện trước</option>';
                                                //console.log(data);
                                            }
                                            
                                            function show_districts_list(){
                                                let city_id = document.getElementById('city_list').value;
                                                let api_url = '<?php echo base_url() ?>/api_project_districts_list_of_city_' + city_id +'.json';
                                                console.log(api_url);
                                                fetch(api_url)
                                                .then(function (response) {
                                                    return response.json();
                                                })
                                                .then(function (data) {
                                                    appendData_districts_list(data);
                                                })
                                                .catch(function (err) {
                                                    console.log('Không có quyền truy cập: ' + err);
                                                });
                                            }

                                            function appendData_wards_list(data) {
                                                var data_list = document.getElementById("wards_list");
                                                //Tạo option mặc định
                                                data_list.innerHTML = '<option selected disabled>Lựa chọn Phường / Xã / Ấp</option>';
                                                //Tạo option bên dưới
                                                for (var i = 0; i < data.length; i++) {
                                                    var item = document.createElement("option");
                                                    item.value      =  data[i].wards_id;
                                                    item.innerHTML  =  data[i].name;
                                                    data_list.appendChild(item);
                                                }

                                                //console.log(data);
                                            }

                                            function show_wards_list(){
                                                let districts_id = document.getElementById('districts_list').value;
                                                let api_url = '<?php echo base_url() ?>/api_project_wards_list_of_districts_' + districts_id +'.json';
                                                console.log(api_url);
                                                fetch(api_url)
                                                .then(function (response) {
                                                    return response.json();
                                                })
                                                .then(function (data) {
                                                    appendData_wards_list(data);
                                                })
                                                .catch(function (err) {
                                                    console.log('Không có quyền truy cập: ' + err);
                                                });
                                            }
                                        </script>
                                    </div>

                                    <div class="form-group">
                                        <label for="inputStatus">Địa chỉ cụ thể (nếu có):</label>
                                        <input type="text" id="" name="dia_chi_cu_the" class="form-control" placeholder="Địa chỉ cụ thể của BDS">
                                    </div>

                                    <div class="form-group">
                                        <label for="inputStatus">Đường dẫn GGmap:</label>
                                        <input type="text" id="input_gg_map" name="google_map" class="form-control" onchange="preview_gg_map()" placeholder="đường dẫn iframe của GGmap, bên dưới hiện map thì là nhập đúng">
                                        <div id="gg_map_preview"></div>
                                        <script>
                                            function preview_gg_map(){
                                            var link_gg_map  =   document.getElementById("input_gg_map").value.replace('<iframe src="','');
                                            link_gg_map      = link_gg_map.replace('" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>','');
                                            $('#gg_map_preview').html('');
                                            $('#gg_map_preview').append("<div class='col-md-12'><center><iframe style='max-height:200px;' src='"+ link_gg_map +"'></iframe></center></div>");
                                                
                                            }
                                        </script>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="inputStatus">Trạng Thái Hiển Thị:</label>
                                        <select id="inputStatus" class="form-control custom-select" name="status">
                                            <option value="0">Hiển Thị</option>
                                            <option value="1">Ẩn</option>
                                        </select>
                                    </div>

                                    
                                </div>
                            </div>

                            

                        </div>
                        <div class="col-md-4">
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h3 class="card-title">Giá, Diện Tich và Loại Hình</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row" style="font-size: 80%;">
                                            <div class="form-group col-4">
                                                <label for="inputEstimatedBudget">Diện tích:</label>
                                                <input type="text" id="input_dien_tich" name="dien_tich" class="form-control" placeholder="Đơn vị m2" required>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="inputEstimatedBudget">Chiều dài:</label>
                                                <input type="text" id="" name="chieu_dai" class="form-control" placeholder="Đơn vị m">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="inputEstimatedBudget">Chiều rộng:</label>
                                                <input type="text" id="" name="chieu_rong" class="form-control" placeholder="Đơn vị m">
                                            </div>
                                            <div class="form-group col-6" style="">
                                                <label for="inputEstimatedBudget">Giá Bán 1<br/>(giá tối thiểu / giá cố định):</label>
                                                <input type="number" id="inputEstimatedBudget" name="gia_tien" class="form-control" placeholder="Để 0 thì thành giá liên hệ">
                                            </div>
                                            <div class="form-group col-6" style="">
                                                <label for="inputEstimatedBudget">Giá Bán 2<br/>(giá tối đa - Nếu có):</label>
                                                <input type="number" id="inputEstimatedBudget" name="gia_tien_option" class="form-control" placeholder="Nhập giá bán tối đa nếu có">
                                            </div>
                                            <div class="form-group col-6" style="">
                                                <label for="inputEstimatedBudget">Giá Thuê 1<br/>(giá tối thiểu / giá cố định):</label>
                                                <input type="number" id="inputEstimatedBudget" name="gia_thue_1" class="form-control" placeholder="Nhập giá cho thuê nếu có">
                                            </div>
                                            <div class="form-group col-6" style="">
                                                <label for="inputEstimatedBudget">Giá Thuê 2<br/>(giá tối đa - Nếu có):</label>
                                                <input type="number" id="inputEstimatedBudget" name="gia_thue_2" class="form-control" placeholder="Nhập giá cho thuê nếu có">
                                            </div>

                                        </div>
                                        <div class="row" style="font-size: 80%;">
                                            <div class="form-group col-6">
                                                <label for="inputStatus">Loại Hình Mua Bán:</label>
                                                <select id="inputStatus" class="form-control custom-select" name="loai_hinh_1" required>
                                                    <option value="" selected disabled>Lựa chọn 1 loại hình</option>
                                                    <option value="Mua Bán">Mua Bán</option>
                                                    <option value="Cho Thuê">Cho Thuê</option>
                                                    <!-- <option value="Dự Án">Dự Án</option> -->
                                                </select>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="inputStatus">Trong Dự Án?:</label>
                                                <select id="inputStatus" class="form-control custom-select" name="du_an_status">
                                                    <option value="0">Không phải Dự Án</option>
                                                    <option value="1">Là Dự Án</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-6">
                                                <label for="inputStatus">Hướng Nhà:</label>
                                                <select id="inputStatus" class="form-control custom-select" name="loai_hinh_3">
                                                    <option value="" Selected disabled>Lựa chọn 1 loại hình</option>
                                                    <option value="Đông">Đông</option>
                                                    <option value="Tây">Tây</option>
                                                    <option value="Nam">Nam</option>
                                                    <option value="Bắc">Bắc</option>
                                                    <option value="Đông Bắc">Đông Bắc</option>
                                                    <option value="Đông Nam">Đông Nam</option>
                                                    <option value="Tây Bắc">Tây Bắc</option>
                                                    <option value="Tây Nam">Tây Nam</option>
                                                </select>
                                            </div>

                                            
                                            <div class="form-group col-6">
                                                <label for="inputStatus">Loại Hình BDS (chính):</label>
                                                <select id="inputStatus" class="form-control custom-select" name="loai_hinh_2" required>
                                                    <option value= "" selected disabled>Lựa chọn 1 loại hình</option>
                                                    <option disabled>Nhà</option>
                                                    <option value="Nhà Riêng">Nhà Riêng</option>
                                                    <option value="Nhà Căn Hộ">Căn Hộ</option>
                                                    <option value="Nhà Biệt Thự">Biệt Thự</option>
                                                    <option disabled>Đất</option>
                                                    <option value="Đất Bán">Đất Bán</option>
                                                    <option value="Đất Nền">Đất Nền</option>
                                                    <option value="Đất Cho Thuê">Đất Cho Thuê</option>
                                                    <option disabled>BDS Các Loại</option>
                                                    <option value="Office-tel">Office-tel</option>
                                                    <option value="Pent-house">Pent-house</option>
                                                    <option value="Shophouse">Shophouse</option>
                                                    <option value="Condotel">Condotel</option>
                                                    <option value="Kho, Nhà Xưởng">Kho, Nhà Xưởng</option>
                                                    <option value="Khu Nghỉ Dưỡng, Trang Trại">Khu Nghỉ Dưỡng, Trang Trại</option>
                                                    <option value="Văn Phòng">Văn Phòng</option>
                                                    <option value="Mặt Bằng, Cửa Hàng">Mặt Bằng, Cửa Hàng</option>
                                                    <option value="Nhà Trọ, Phòng Trọ">Nhà Trọ, Phòng Trọ</option>
                                                    <option value="BDS loại khác">BDS loại khác</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-12">
                                                <label for="inputStatus">Loại Hình BDS (Phụ):</label>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_1" name="loai_hinh_bds_phu[]" value="Nhà Riêng">
                                                    <label for="loai_hinh_bds_phu_1" class="custom-control-label">Nhà Riêng</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_2" name="loai_hinh_bds_phu[]" value="Nhà Căn Hộ">
                                                    <label for="loai_hinh_bds_phu_2" class="custom-control-label">Nhà Căn Hộ</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_3" name="loai_hinh_bds_phu[]" value="Nhà Biệt Thự">
                                                    <label for="loai_hinh_bds_phu_3" class="custom-control-label">Nhà Biệt Thự</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_4" name="loai_hinh_bds_phu[]" value="Đất Bán">
                                                    <label for="loai_hinh_bds_phu_4" class="custom-control-label">Đất Bán</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_5" name="loai_hinh_bds_phu[]" value="Đất Nền">
                                                    <label for="loai_hinh_bds_phu_5" class="custom-control-label">Đất Nền</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_13" name="loai_hinh_bds_phu[]" value="Đất Cho Thuê">
                                                    <label for="loai_hinh_bds_phu_13" class="custom-control-label">Đất Cho Thuê</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_6" name="loai_hinh_bds_phu[]" value="Office-tel">
                                                    <label for="loai_hinh_bds_phu_6" class="custom-control-label">Office-tel</label>
                                                </div>
                                            </div>
                                            

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_7" name="loai_hinh_bds_phu[]" value="Shophouse">
                                                    <label for="loai_hinh_bds_phu_7" class="custom-control-label">Shophouse</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_8" name="loai_hinh_bds_phu[]" value="Condotel">
                                                    <label for="loai_hinh_bds_phu_8" class="custom-control-label">Condotel</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_9" name="loai_hinh_bds_phu[]" value="Kho, Nhà Xưởng">
                                                    <label for="loai_hinh_bds_phu_9" class="custom-control-label">Kho, Nhà Xưởng</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_10" name="loai_hinh_bds_phu[]" value="Khu Nghỉ Dưỡng, Trang Trại">
                                                    <label for="loai_hinh_bds_phu_10" class="custom-control-label">Khu Nghỉ Dưỡng, Trang Trại</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_11" name="loai_hinh_bds_phu[]" value="BDS loại khác">
                                                    <label for="loai_hinh_bds_phu_11" class="custom-control-label">BDS loại khác</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_14" name="loai_hinh_bds_phu[]" value="Văn Phòng">
                                                    <label for="loai_hinh_bds_phu_14" class="custom-control-label">Văn Phòng</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_15" name="loai_hinh_bds_phu[]" value="Mặt Bằng, Cửa Hàng">
                                                    <label for="loai_hinh_bds_phu_15" class="custom-control-label">Mặt Bằng, Cửa Hàng</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_16" name="loai_hinh_bds_phu[]" value="Nhà Trọ, Phòng Trọ">
                                                    <label for="loai_hinh_bds_phu_16" class="custom-control-label">Nhà Trọ, Phòng Trọ</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="loai_hinh_bds_phu_12" name="loai_hinh_bds_phu[]" value="Pent-house">
                                                    <label for="loai_hinh_bds_phu_12" class="custom-control-label">Pent-house</label>
                                                </div>
                                            </div>
                                            

                                        </div>
                                    </div>
                                            
                                </div>
                        </div>
                        <div class="col-md-4">
                            
                                <div class="card card-secondary">
                                    <div class="card-header">
                                        <h3 class="card-title">Thông tin bổ sung & Tiện ích</h3>
                                        <div class="card-tools">
                                            <button type="button" class="btn btn-tool" data-card-widget="collapse"
                                                title="Collapse">
                                                <i class="fas fa-minus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <div class="row" style="font-size:80%;">
                                            <div class="form-group col-4">
                                                <label for="inputStatus">Phòng Ngủ:</label>
                                                <select id="inputStatus" class="form-control custom-select" name="phong_ngu">
                                                    <option value="0">0 Phòng</option>
                                                    <option value="1">1 Phòng</option>
                                                    <option value="2">2 Phòng</option>
                                                    <option value="3">3 Phòng</option>
                                                    <option value="4">4 Phòng</option>
                                                    <option value="5">5 Phòng</option>
                                                    <option value="6">6 Phòng</option>
                                                    <option value="7">7 Phòng</option>
                                                    <option value="8">8 Phòng</option>
                                                    <option value="9">9 Phòng</option>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="inputStatus">Phòng Tắm:</label>
                                                <select id="inputStatus" class="form-control custom-select" name="phong_tam">
                                                    <option value="0">0 Phòng</option>
                                                    <option value="1">1 Phòng</option>
                                                    <option value="2">2 Phòng</option>
                                                    <option value="3">3 Phòng</option>
                                                    <option value="4">4 Phòng</option>
                                                    <option value="5">5 Phòng</option>
                                                    <option value="6">6 Phòng</option>
                                                    <option value="7">7 Phòng</option>
                                                    <option value="8">8 Phòng</option>
                                                    <option value="9">9 Phòng</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="inputStatus">Số Tầng:</label>
                                                <select id="inputStatus" class="form-control custom-select" name="so_tang">
                                                    <option value="0">0 Tầng</option>
                                                    <option value="1">1 Tầng</option>
                                                    <option value="2">2 Tầng</option>
                                                    <option value="3">3 Tầng</option>
                                                    <option value="4">4 Tầng</option>
                                                    <option value="5">5 Tầng</option>
                                                    <option value="6">6 Tầng</option>
                                                    <option value="7">7 Tầng</option>
                                                    <option value="8">8 Tầng</option>
                                                    <option value="9">9 Tầng</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="giay_to_phap_ly" name="giay_to_phap_ly" value="1">
                                                    <label for="giay_to_phap_ly" class="custom-control-label">Giấy tờ pháp lý: Sổ Hồng</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="vi_tri_mat_tien" name="vi_tri_mat_tien" value="1">
                                                    <label for="vi_tri_mat_tien" class="custom-control-label">Vị trí: Mặt Tiền</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="vi_tri_mat_hem" name="vi_tri_mat_hem" value="1">
                                                    <label for="vi_tri_mat_hem" class="custom-control-label">Vị trí: Mặt Hẻm</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="gan_cho" name="gan_cho" value="1">
                                                    <label for="gan_cho" class="custom-control-label">Gần Chợ</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="nha_tre" name="nha_tre" value="1">
                                                    <label for="nha_tre" class="custom-control-label">Gần Nhà Trẻ</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="truong_cap_2" name="truong_cap_2" value="1">
                                                    <label for="truong_cap_2" class="custom-control-label">Gần Trường Cấp 2</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="truong_cap_3" name="truong_cap_3" value="1">
                                                    <label for="truong_cap_3" class="custom-control-label">Gần Trường Cấp 3</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="dai_hoc" name="dai_hoc" value="1">
                                                    <label for="dai_hoc" class="custom-control-label">Gần Trường Đại Học</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="ho_boi" name="ho_boi" value="1">
                                                    <label for="ho_boi" class="custom-control-label">Gần Hồ Bơi</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="khu_dan_cu" name="khu_dan_cu" value="1">
                                                    <label for="khu_dan_cu" class="custom-control-label">Gần Khu Dân Cư</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="sieu_thi" name="sieu_thi" value="1">
                                                    <label for="sieu_thi" class="custom-control-label">Gần Siêu Thị</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="benh_vien" name="benh_vien" value="1">
                                                    <label for="benh_vien" class="custom-control-label">Gần Bệnh Viện</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="cho_dau_oto" name="cho_dau_oto" value="1">
                                                    <label for="cho_dau_oto" class="custom-control-label">Có Chỗ Đậu Ô Tô</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="duong_nhua" name="duong_nhua" value="1">
                                                    <label for="duong_nhua" class="custom-control-label">Đường Trải Nhựa</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="camera_an_ninh" name="camera_an_ninh" value="1">
                                                    <label for="camera_an_ninh" class="custom-control-label">Camera An Ninh</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="view_bien" name="view_bien" value="1">
                                                    <label for="view_bien" class="custom-control-label">View Biển</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="trung_tam_hanh_chinh" name="trung_tam_hanh_chinh" value="1">
                                                    <label for="trung_tam_hanh_chinh" class="custom-control-label">Gần Trung Tâm Hành Chính</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="san_bay" name="san_bay" value="1">
                                                    <label for="san_bay" class="custom-control-label">Gần Sân Bay</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="san_golf" name="san_golf" value="1">
                                                    <label for="san_golf" class="custom-control-label">Gần Sân Golf</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="cong_vien" name="cong_vien" value="1">
                                                    <label for="cong_vien" class="custom-control-label">Gần Công Viên</label>
                                                </div>
                                            </div>

                                            <div class="form-group col-4">
                                                <div class="custom-control custom-checkbox">
                                                    <input class="custom-control-input" type="checkbox" id="trung_tam_mua_sam" name="trung_tam_mua_sam" value="1">
                                                    <label for="trung_tam_mua_sam" class="custom-control-label">Gần Trung Tâm Mua Sắm</label>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Thông tin bổ sung Nhóm 1</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row" style="font-size:80%;">
                                            <div class="form-group col-12">
                                                <label for="inputStatus">Chủ Đầu Tư (nếu có):</label>
                                                <select id="inputStatus" class="form-control custom-select" name="chu_dau_tu">
                                                    <option selected disabled>Lựa Chọn Nếu Có</option>
                                                    <?php foreach($chu_dau_tu_list as $row): ?>
                                                        <?php 
                                                            $name  = json_decode($row->prefix).' '.json_decode($row->name);
                                                            $value = $row->id.'||||'.$name;  
                                                            $disabled   = 'disabled';
                                                            if($row->status == '0'){$disabled = '';}
                                                        ?>
                                                        <option value="<?php echo $value ?>" <?php echo $disabled ?>><?php echo $name ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="inputStatus">Trạng Thái BDS:</label>
                                                <select id="inputStatus" class="form-control custom-select" name="trang_thai_bds">
                                                    <option Selected disabled>Lựa chọn 1 loại hình</option>
                                                    <option value="Đang Cập Nhật">Đang Cập Nhật</option>
                                                    <option value="Sắp Mở Bán">Sắp Mở Bán</option>
                                                    <option value="Đang Mở Bán">Đang Mở Bán</option>
                                                    <option value="Đã Bàn Giao">Đã Bàn Giao</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-5">
                                                <label for="inputStatus">Tổng Diện Tích Dự Án / Diện tích đất:</label>
                                                <input type="number" id="inputEstimatedBudget" name="tong_dien_tich_du_an" class="form-control" placeholder="Nhập nếu có">
                                            </div>

                                            <div class="form-group col-3">
                                                <label for="inputStatus">Mật Độ Xây Dựng (%):</label>
                                                <input type="number" id="inputEstimatedBudget" name="mat_do_xay_dung" class="form-control" placeholder="Nhập nếu có">
                                            </div>

                                            
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Thông tin bổ sung Nhóm 2</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row" style="font-size:80%;">
                                            <div class="form-group col-4">
                                                <label for="inputStatus">Số Block:</label>
                                                <input type="number" id="inputEstimatedBudget" name="so_block" class="form-control" placeholder="Nhập nếu có">
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="inputStatus">Số Căn Hộ:</label>
                                                <input type="number" id="inputEstimatedBudget" name="so_can_ho" class="form-control" placeholder="Nhập nếu có">
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="inputStatus">Số Tầng:</label>
                                                <input type="number" id="inputEstimatedBudget" name="so_tang" class="form-control" placeholder="Nhập nếu có">
                                            </div>
                                            <div class="form-group col-4">
                                                <label for="inputStatus">Số Nền Đất:</label>
                                                <input type="number" id="inputEstimatedBudget" name="so_nen_dat" class="form-control" placeholder="Nhập nếu có">
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="inputStatus">Năm Xây Dựng:</label>
                                                <input type="number" id="inputEstimatedBudget" name="nam_xay_dung" class="form-control" placeholder="Nhập nếu có">
                                            </div>

                                            <div class="form-group col-4">
                                                <label for="inputStatus">Năm Bàn Giao:</label>
                                                <input type="number" id="inputEstimatedBudget" name="nam_ban_giao" class="form-control" placeholder="Nhập nếu có">
                                            </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card card-secondary">
                                <div class="card-header">
                                    <h3 class="card-title">Thông tin bổ sung Nhóm 3</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse"><i class="fas fa-minus"></i></button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="row" style="font-size:80%;">
                                        <div class="form-group col-12">
                                            <label for="inputEstimatedBudget">Người Liên Hệ (nếu có):</label>
                                            <input type="text" id="" name="nguoi_lien_he" class="form-control" placeholder="Tên Người Liên Hệ">
                                        </div>
                                        <div class="form-group col-12">
                                            <label for="inputEstimatedBudget">SĐT Liên Hệ (nếu có):</label>
                                            <input type="text" id="" name="sdt_lien_he" class="form-control" placeholder="SĐT Cá Nhân">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

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
                                        <div class="form-group col-6">
                                            <label for="inputName">Tên Dự Án</label>
                                            <input type="text" id="input_name" name="name" class="form-control" onkeyup="create_alias();" required>
                                        </div>
                                        <div class="form-group col-6">
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
                                            <textarea class="form-control" rows="4" name="meta_desc" required></textarea>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="inputDescription">Nội dung Giới Thiệu:</label>
                                        <textarea id="editor" class="form-control" rows="4" name="content" required></textarea>
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
                                    <h3 class="card-title">Hình Ảnh</h3>
                                    <div class="card-tools">
                                        <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                                            <i class="fas fa-minus"></i>
                                        </button>
                                    </div>
                                </div>
                                <div class="card-body">
                                    <div class="form-group">
                                        <label for="exampleInputFile">Ảnh Đại Diện (1 ảnh) jpg, png:</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" id="image_link" onchange="preview_image_link();" name="image_link" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="image_link_preview"></div>
                                    

                                    <div class="form-group">
                                        <label for="exampleInputFile">Ảnh Kèm Theo (tối đa 20 ảnh) jpg, png:</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input id="image_list" type="file" onchange="preview_image_list();" multiple name="image_list[]" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div id="image_list_preview" class="row"></div>

                                    <script>
                                        function preview_image_link(){
                                            var total_file=document.getElementById("image_link").files.length;
                                            $('#image_link_preview').html('');
                                            for(var i=0;i<total_file;i++){
                                                $('#image_link_preview').append("<div class='col-md-12'><center><img style='max-height:200px;' src='"+URL.createObjectURL(event.target.files[i])+"'></center></div>");
                                            }
                                        }
                                        function preview_image_list(){
                                            var total_file=document.getElementById("image_list").files.length;
                                            $('#image_list_preview').html('');
                                            for(var i=0;i<total_file;i++){
                                                $('#image_list_preview').append("<div class='col-md-4'><img style='max-width:100%;' src='"+URL.createObjectURL(event.target.files[i])+"'></div>");
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
