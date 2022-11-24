<div class="pb-5 pt-5">
    <div class="container-fluid">
        <div class="display-flex flex-justify-between">
            <ul class="crumb text-medium crumb-text">
                <?php 
                    //print_r($info);
                    $update_time = get_date($info->update_time);
                    $url_tim_kiem      = base_url('danh-sach-bds/?');

                    $loai_hinh_mua_ban = '';
                    if(json_decode($info->loai_hinh_1)){
                        $loai_hinh_mua_ban          = json_decode($info->loai_hinh_1);
                        $url_tim_kiem              .= '&loai_hinh_mua_ban_bds='.$loai_hinh_mua_ban;
                    }
                    if($loai_hinh_mua_ban !== ''){
                        echo '<li><a href="'.$url_tim_kiem.'"><span>'.$loai_hinh_mua_ban.'</span></a></li>';
                    }

                    // Hình Thức nhà đất / dự án
                    $hinh_thuc_bds = '';
                    if(isset($info->du_an_status)){
                        if($info->du_an_status == '0'){
                            $hinh_thuc_bds  = 'Nhà Đất';
                            $url_tim_kiem   .= '&du_an_status=0';
                        }
                        if($info->du_an_status == '1'){
                            $hinh_thuc_bds  = 'Dự Án';
                            $url_tim_kiem   .= '&du_an_status=1';
                        }
                    }
                    if($hinh_thuc_bds !== ''){
                        echo '<li><a href="'.$url_tim_kiem.'"><span>'.$hinh_thuc_bds.'</span></a></li>';
                    }


                    $loai_hinh_bds = '';
                    if(isset($info->loai_hinh_2) && (json_decode($info->loai_hinh_2) !== '')){
                        $loai_hinh_bds      = json_decode($info->loai_hinh_2);
                        $url_tim_kiem      .= '&loai_hinh_bds='.$loai_hinh_bds;
                    }
                    if($loai_hinh_bds !== ''){
                        echo '<li><a href="'.$url_tim_kiem.'"><span>'.$loai_hinh_bds.'</span></a></li>';
                    }

                    $thanh_pho      = '';
                    if(isset($info->city_id) && ($info->city_id !== '') && ($info->city_id !== '0')){
                        $this->db->select('name');
                        $thanh_pho      = json_decode($this->city_model->get_info($info->city_id)->name);
                        $url_tim_kiem  .= '&city_id='.$info->city_id;
                    }
                    if($thanh_pho !== ''){
                        echo '<li><a href="'.$url_tim_kiem.'"><span>'.$thanh_pho.'</span></a></li>';
                    }

                    $quan_huyen     = '';
                    if(isset($info->districts_id) && ($info->districts_id !== '') && ($info->districts_id !== '0')){
                        $this->db->select('name');
                        $quan_huyen    = json_decode($this->districts_model->get_info($info->districts_id)->name);
                        $url_tim_kiem  .= '&districts_id='.$info->districts_id;
                    }
                    if($quan_huyen !== ''){
                        echo '<li><a href="'.$url_tim_kiem.'"><span>'.$quan_huyen.'</span></a></li>';
                    }

                    $phuong_xa      = '';
                    if(isset($info->wards_id) && ($info->wards_id !== '') && ($info->wards_id !== '0')){
                        $this->db->select('name, prefix');
                        $wards_info      = $this->wards_model->get_info($info->wards_id);
                        $phuong_xa       = json_decode($wards_info->prefix).' '.json_decode($wards_info->name);
                        $url_tim_kiem   .= '&wards_id='.$info->wards_id;
                    }
                    if($phuong_xa !== ''){
                        echo '<li><a href="'.$url_tim_kiem.'"><span>'.$phuong_xa.'</span></a></li>';
                    }

                ?>
            </ul>
            <div class="text-gray text-100 time-since footer_hidden_on_mobile" data-time="<?php echo $update_time; ?>"><?php echo $update_time; ?></div>
        </div>
    </div>
</div>

            <?php 
                //Trích dữ liệu
                $name               = json_decode($info->name);
                
                $location           = json_decode($info->location);
                $chi_tiet_nha_dat   = json_decode($info->chi_tiet_nha_dat);
                if(isset($chi_tiet_nha_dat->dia_chi_cu_the) && ($chi_tiet_nha_dat->dia_chi_cu_the !== '')){
                    $location       = $chi_tiet_nha_dat->dia_chi_cu_the.', '.$location;
                }

                $dien_tich  = '--';
                $gia_ban_du_an      = 'Đang Cập Nhật';
                $gia_thue_du_an     = 'Đang Cập Nhật';
                $gia_tien           = 'Đang Cập Nhật';
                //Giá Tiền Bán / Cho Thuê -- Hiển thị giá min hoặc max
                if($info->loai_hinh_1 == json_encode('Cho Thuê')){
                    //Hiển thị giá cho thuê
                    $gia_tien       = 'Đang Cập Nhật';
                    $dien_tich      = number_format($info->dien_tich);
                    if($info->gia_tien_thue > '0'){
                        $gia_tien = price_format($info->gia_tien_thue);
                    }
                    if($info->gia_tien_thue_option > '0'){
                        $gia_tien .= '~'.price_format($info->gia_tien_thue_option);
                    }
                    $gia_thue_du_an = $gia_tien;
                    
                }
                if($info->loai_hinh_1 == json_encode('Mua Bán')){
                    //Hiển thị giá bán
                    $gia_tien   = 'Đang Cập Nhật';
                    if($info->gia_tien > '0'){
                        $gia_tien = price_format($info->gia_tien);
                    }
                    if($info->gia_tien_option > '0'){
                        $gia_tien .= '~'.price_format($info->gia_tien_option);
                    }
                    $gia_ban_du_an  = $gia_tien;
                    
                    //Hiển thị giá bán trên từng m2
                    $total_price = '0';
                    $dien_tich   = number_format($info->dien_tich);
                    if($info->dien_tich > '0'){
                        if(isset($info->gia_tien) && ($info->gia_tien >'0')){
                            $total_price = $info->gia_tien;
                        }else{
                            if(isset($info->gia_tien_option) && ($info->gia_tien_option > '0')){
                                $total_price = $info->gia_tien_option;
                            }
                        }
                        if(($total_price > '0') && ($info->dien_tich > '0')){ 
                            $gia_tien_tren_tung_m2 = price_format($total_price / $info->dien_tich);
                        }
                    }

                }

                //Chi Tiết Nhà Đất
                if(isset($info->chieu_dai)   && ($info->chieu_dai > '0'))                   {$chieu_dai     = number_format($info->chieu_dai).'m';}else{$chieu_dai = '--';}
                if(isset($info->chieu_rong)  && ($info->chieu_rong > '0'))                  {$chieu_rong    = number_format($info->chieu_rong).'m';}else{$chieu_rong = '--';}
                if(isset($info->phong_ngu)   && ($info->phong_ngu > '0'))                   {$phong_ngu     = $info->phong_ngu;}else{$phong_ngu = '--';}
                if(isset($info->phong_tam)   && ($info->phong_tam > '0'))                   {$phong_tam     = $info->phong_tam;}else{$phong_tam = '--';}
                if(isset($info->so_tang)     && ($info->so_tang > '0'))                     {$so_tang       = $info->so_tang;}else{$so_tang = '--';}
                if(isset($info->loai_hinh_3) && (json_decode($info->loai_hinh_3) !== ''))   {$huong_nha     = json_decode($info->loai_hinh_3);}else{$huong_nha = '--';}

                //Thông tin dự án
                $trang_thai_du_an = 'Đang Cập Nhật';
                if(isset($chi_tiet_nha_dat->trang_thai_bds) && ($chi_tiet_nha_dat->trang_thai_bds !== '')){
                    $trang_thai_du_an = $chi_tiet_nha_dat->trang_thai_bds;
                }

                $chu_dau_tu      = 'Đang Cập Nhật';
                if($info->chu_dau_tu_id !== '0'){
                    $this->db->select('id, prefix, name, alias');
                    $chu_dau_tu_info    = $this->chu_dau_tu_model->get_info($info->chu_dau_tu_id);
                    $chu_dau_tu_name    = json_decode($chu_dau_tu_info->prefix).' '.json_decode($chu_dau_tu_info->name);
                    $chu_dau_tu_url     = base_url($chu_dau_tu_info->alias.'-cdt'.$chu_dau_tu_info->id);   
                    $chu_dau_tu = '<a href="'.$chu_dau_tu_url.'">'.$chu_dau_tu_name.'</a>';
                }else{
                    $chu_dau_tu = 'Đang Cập Nhật';
                }


                $loai_hinh_du_an = '';
                $danh_sach_loai_hinh_bds    = array();
                $danh_sach_loai_hinh_bds[]  = json_decode($info->loai_hinh_2);
                if(isset($chi_tiet_nha_dat->loai_hinh_bds_phu)){
                    foreach($chi_tiet_nha_dat->loai_hinh_bds_phu as $loai_hinh_bds_phu){
                        $danh_sach_loai_hinh_bds[]  = $loai_hinh_bds_phu;
                    }
                }
                $danh_sach_loai_hinh_bds = array_unique($danh_sach_loai_hinh_bds);
                if(count($danh_sach_loai_hinh_bds) == '0'){
                    $loai_hinh_du_an = 'Đang Cập Nhật';
                }else{
                    foreach($danh_sach_loai_hinh_bds as $loai_hinh_bds){
                        $loai_hinh_du_an .= $loai_hinh_bds.', ';
                    }
                }

                $so_block       = 'Đang Cập Nhật';
                if(isset($chi_tiet_nha_dat->so_block) && ($chi_tiet_nha_dat->so_block > '0')){
                    $so_block   = $chi_tiet_nha_dat->so_block;
                }

                $so_can_ho      = 'Đang Cập Nhật';
                if(isset($chi_tiet_nha_dat->so_can_ho) && ($chi_tiet_nha_dat->so_can_ho > '0')){
                    $so_can_ho  = number_format($chi_tiet_nha_dat->so_can_ho);
                }

                $mat_do_xay_dung = 'Đang Cập Nhật';
                if(isset($chi_tiet_nha_dat->mat_do_xay_dung) && ($chi_tiet_nha_dat->mat_do_xay_dung > '0')){
                    $mat_do_xay_dung  = $chi_tiet_nha_dat->mat_do_xay_dung.'%';
                }

                $tong_dien_tich_du_an   = 'Đang Cập Nhật';
                if(isset($chi_tiet_nha_dat->tong_dien_tich_du_an) && ($chi_tiet_nha_dat->tong_dien_tich_du_an > '0')){
                    $tong_dien_tich_du_an  = number_format($chi_tiet_nha_dat->tong_dien_tich_du_an).'m²';
                }

                $so_nen_dat   = 'Đang Cập Nhật';
                if(isset($chi_tiet_nha_dat->so_nen_dat) && ($chi_tiet_nha_dat->so_nen_dat > '0')){
                    $so_nen_dat  = number_format($chi_tiet_nha_dat->so_nen_dat).'m²';
                }

                $nam_xay_dung   = 'Đang Cập Nhật';
                if(isset($chi_tiet_nha_dat->nam_xay_dung) && ($chi_tiet_nha_dat->nam_xay_dung > '0')){
                    $nam_xay_dung  = $chi_tiet_nha_dat->nam_xay_dung;
                }

                $nam_ban_giao   = 'Đang Cập Nhật';
                if(isset($chi_tiet_nha_dat->nam_ban_giao) && ($chi_tiet_nha_dat->nam_ban_giao > '0')){
                    $nam_ban_giao  = $chi_tiet_nha_dat->nam_ban_giao;
                }

                $nguoi_lien_he   = 'Đang Cập Nhật';
                if(isset($chi_tiet_nha_dat->nguoi_lien_he) && ($chi_tiet_nha_dat->nguoi_lien_he !== '')){
                    $nguoi_lien_he  = $chi_tiet_nha_dat->nguoi_lien_he;
                }

                $sdt_lien_he   = 'Đang Cập Nhật';
                if(isset($chi_tiet_nha_dat->sdt_lien_he) && ($chi_tiet_nha_dat->sdt_lien_he !== '')){
                    $sdt_lien_he  = $chi_tiet_nha_dat->sdt_lien_he;
                }

                $google_map    = '';
                if(isset($info->google_map) && ($info->google_map !== '')){
                    $google_map = $info->google_map;
                }



                //ảnh
                $list_image = array();
                if(isset($info->image_link) && ($info->image_link !== '')){
                    $list_image[] = $info->image_link;
                }
                $image_list = json_decode($info->image_list);
                if(is_array($image_list)){
                    foreach($image_list as $img){
                        $list_image[] = $img;
                    }
                }
                $list_image = array_unique($list_image);
            ?>

<div class="mb-4" id="image_area">   
</div>


<?php   if($info->du_an_status == '0'): //View cho nội dung nhà đất ?>
    <div class="mb-4">
        <div class="container-fluid">
            <div class="product-show-container">
                <div class="product-show-left">
                    <div class="product-title-price">
                        <div class="left-title-price" id="info_bds"></div>
                    </div>
                    <div class="mt-3">
                        <div class="bg-property rounded p-3">
                            <ul class="product-infomation text-300">
                                <li><span class="i-f1"><i class="fa fa-icon-me fa-custom-square"></i><?php echo $dien_tich ?> m²</span><span class="footer_hidden_on_mobile">Diện tích</span></li>
                                <li><span class="i-f1"><i class="fa fa-icon-me fa-custom-height"></i><?php echo $chieu_dai ?></span><span class="footer_hidden_on_mobile">Chiều dài</span></li>
                                <li><span class="i-f1"><i class="fa fa-icon-me fa-custom-width"></i><?php echo $chieu_rong ?></span><span class="footer_hidden_on_mobile">Chiều rộng</span></li>
                                <li><span class="i-f1"><i class="fa fa-icon-me fa-custom-direction"></i><?php echo $huong_nha ?></span><span class="footer_hidden_on_mobile">Hướng</span></li>
                                <li><span class="i-f1"><i class="fa fa-icon-me fa-custom-bedroom"></i><?php echo $phong_ngu ?></span><span class="footer_hidden_on_mobile">Phòng ngủ</span></li>
                                <li><span class="i-f1"><i class="fa fa-icon-me fa-custom-bathroom"></i><?php echo $phong_tam ?></span><span class="footer_hidden_on_mobile">Phòng tắm</span></li>
                            </ul>
                        </div>
                    </div>

                    <div class="mt-5">
                        <div class="tabs-product">
                            <div id="tab-custom">
                                <h2 class="text-normal">Giới thiệu</h2>
                                <div class="detail-content tab-content line-28 pb-2  text-300" id="content-tab-custom">
                                    <?php echo json_decode($info->content); ?>
                                </div>
                            </div>
                            <div id="tab-info" class="">
                                <h2 class="text-normal">Chi tiết nhà đất</h2>
                                <div class="tab-content pb-3" id="content-tab-info">
                                    <div class="row flex-justify-between text-300">
                                        <div class="col-12">
                                            <ul class="p-0 list-full-info-product">
                                                <li class="display-flex"><span class="flex-first display-flex flex-center"><i class="fa fa-icon-me fa-custom-square"></i><span>Diện tích</span></span><span class=""><?php echo $dien_tich ?> m²</span></li>
                                                <li class="display-flex"><span class="flex-first display-flex flex-center"><i class="fa fa-icon-me fa-custom-height"></i><span>Chiều dài</span></span><span class=""><?php echo $chieu_dai ?></span></li>
                                                <li class="display-flex"><span class="flex-first display-flex flex-center"><i class="fa fa-icon-me fa-custom-width"></i><span>Chiều rộng</span></span><span class=""><?php echo $chieu_rong ?></span></li>
                                                <li class="display-flex"><span class="flex-first display-flex flex-center"><i class="fa fa-icon-me fa-u-noname-7"></i><span>Số tầng</span></span><span class=""><?php echo $so_tang ?></span></li>
                                                <li class="display-flex"><span class="flex-first display-flex flex-center"><i class="fa fa-icon-me fa-u-bed"></i><span>Phòng ngủ</span></span><span class=""><?php echo $phong_ngu ?></span></li>
                                                <li class="display-flex"><span class="flex-first display-flex flex-center"><i class="fa fa-icon-me fa-custom-bathroom"></i><span>Phòng tắm</span></span><span class=""><?php echo $phong_tam ?></span></li>
                                                <li class="display-flex"><span class="flex-first display-flex flex-center"><i class="fa fa-icon-me fa-custom-direction"></i><span>Hướng</span></span><span class=""><?php echo $huong_nha ?></span></li>
                                                
                                                <?php if(isset($chi_tiet_nha_dat->giay_to_phap_ly)): ?>
                                                <li class="display-flex"><span class="flex-first display-flex flex-center"><i class="fa fa-file-text-o"></i><span>Giấy tờ pháp lý</span></span><span class="">Sổ Hồng</span></li>
                                                <?php endif; ?>
                                                <?php if(isset($chi_tiet_nha_dat->vi_tri_mat_tien)): ?>
                                                <li class="display-flex"><span class="flex-first display-flex flex-center"><i class="fa fa-icon-me fa-custom-pin1"></i><span>Vị trí</span></span><span class="">Mặt tiền</span></li>
                                                <?php endif; ?>
                                                <?php if(isset($chi_tiet_nha_dat->vi_tri_mat_hem)): ?>
                                                <li class="display-flex"><span class="flex-first display-flex flex-center"><i class="fa fa-icon-me fa-custom-pin1"></i><span>Vị trí</span></span><span class="">Mặt hẻm</span></li>
                                                <?php endif; ?>
                                                <?php if(isset($chi_tiet_nha_dat->duong_nhua)): ?>
                                                <li class="display-flex"><span class="flex-first display-flex flex-center"><i class="fa fa-icon-me fa-u-main-road"></i><span>Đường vào</span></span><span class="">Đường trải nhựa</span></li>
                                                <?php endif; ?>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h2 class="text-very-large m-0 mb-2 pt-4 left full-width text-normal">
                                Tiện ích lân cận
                            </h2>
                            <ul class="product-other-utilities text-100">
                                <?php if(isset($chi_tiet_nha_dat->gan_cho)): ?>
                                <li><i class="fa fa-icon-me fa-u-market mr-2"></i><span>Chợ</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->nha_tre)): ?>
                                <li><i class="fa fa-icon-me fa-u-preschool mr-2"></i><span>Nhà Trẻ</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->truong_cap_2)): ?>
                                <li><i class="fa fa-icon-me fa-u-school mr-2"></i><span>Trường Cấp 2</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->truong_cap_3)): ?>
                                <li><i class="fa fa-icon-me fa-u-university mr-2"></i><span>Trường Cấp 3</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->dai_hoc)): ?>
                                <li><i class="fa fa-icon-me fa-u-university mr-2"></i><span>Trường Đại Học</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->ho_boi)): ?>
                                <li><i class="fa fa-icon-me fa-u-pool mr-2"></i><span>Hồ Bơi</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->khu_dan_cu)): ?>
                                <li><i class="fa fa-icon-me fa-u-residential mr-2"></i><span>Khu Dân Cư</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->sieu_thi)): ?>
                                <li><i class="fa fa-icon-me fa-u-mini-shop mr-2"></i><span>Siêu Thị</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->benh_vien)): ?>
                                <li><i class="fa fa-icon-me fa-u-utility-6 mr-2"></i><span>Bệnh Viện</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->cho_dau_oto)): ?>
                                <li><i class="fa fa-icon-me fa-u-park mr-2"></i><span>Chỗ Đậu Ô Tô</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->camera_an_ninh)): ?>
                                <li><i class="fa fa-icon-me fa-u-camera mr-2"></i><span>Camera An Ninh</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->view_bien)): ?>
                                <li><i class="fa fa-icon-me fa-u-anchor mr-2"></i><span>View Biển</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->trung_tam_hanh_chinh)): ?>
                                <li><i class="fa fa-icon-me fa-u-neighbor mr-2"></i><span>Trung Tâm Hành Chính</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->trung_tam_hanh_chinh)): ?>
                                <li><i class="fa fa-icon-me fa-u-airport mr-2"></i><span>Sân Bay</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->san_golf)): ?>
                                <li><i class="fa fa-icon-me fa-u-person-forest mr-2"></i><span>Sân Golf</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->cong_vien)): ?>
                                <li><i class="fa fa-icon-me fa-u-person-forest mr-2"></i><span>Công Viên</span></li>
                                <?php endif; ?>
                                <?php if(isset($chi_tiet_nha_dat->trung_tam_mua_sam)): ?>
                                <li><i class="fa fa-icon-me fa-u-person-forest mr-2"></i><span>Trung Tâm Mua Sắm</span></li>
                                <?php endif; ?>
                            </ul>
                            


                            <div class="clear"></div>
                        </div>
                    </div>

                    <?php if($thanh_pho !== ''): ?>
                    <div class="product-show-desktop">
                        <div class="mt-4" id="RelativeEstate">
                            <h3 class="text-very-large m-0 text-400">BDS tại <?php echo $thanh_pho ?></h3>
                            <div class="mt-4">
                                <ul class="other-estate-by text-300">
                                    <!--foreach-->
                                    <?php 
                                        $input          = array();
                                        $input['where'] = array('city_id' => $info->city_id);
                                        $input['order'] = array('name','grade');
                                        $this->db->select('id, name');
                                        $districts_list  = $this->districts_model->get_list($input);
                                    ?>
                                    <?php foreach($districts_list as $row): ?>
                                        <?php
                                            $input = array();
                                            $input['where'] = array('status'=>'0', 'districts_id' => $row->id);
                                            $total_project = number_format($this->project_model->get_total($input));
                                            $row_name   = json_decode($row->name);
                                        ?>
                                    <li><a href="<?php echo base_url('danh-sach-bds-tai-'.create_alias($row_name).'-'.create_alias($thanh_pho).'/') ?>?districts_id=<?php echo $row->id ?>"><?php echo $row_name; ?> <span class="text-blue">(<?php echo $total_project ?>)</span></a></li>
                                    <?php endforeach; ?>
                                    <!--end foreach-->
                                </ul>
                                <div class="clear"></div>
                            </div>
                        </div>
                    </div>
                    <?php endif; ?>
                </div>
                <?php if(isset($chi_tiet_nha_dat->nguoi_lien_he) && ($chi_tiet_nha_dat->nguoi_lien_he !== '')): ?>        
                <div class="product-show-right">
                    <div class="rounded border mb-5 pt-3 pb-3 box-shadow top-140">
                        <div class="pr-3 pl-3">
                            <div>
                                <div class="show-user-info">
                                    <div class="user-info-name display-grid">
                                        <a class=" text-large-s  text-black text-400 line-22"><?php echo $chi_tiet_nha_dat->nguoi_lien_he ?></a>
                                    </div>
                                </div>
                                <?php if(isset($chi_tiet_nha_dat->sdt_lien_he) && ($chi_tiet_nha_dat->sdt_lien_he !== '')): ?>
                                <div class="mt-3 user display-flex flex-justify-between ">
                                    <span id="btn-click-statistic" class="display-flex flex-center btn-phone-user btn-call radius-30" data-phone="<?php echo $chi_tiet_nha_dat->sdt_lien_he ?>" data-id="27967">
                                        <i class="fa fa-icon-me fa-custom-phone-green"></i>
                                        <span class="ml-2 phone-hiden">
                                            <span class="hidden-phone">Gọi Số Di Động</span>
                                            <span class="click-to-show-phone">Bấm để hiện số</span>
                                        </span>
                                    </span>
                                    <a class="display-flex flex-center btn-phone-user btn-call-2 off radius-30"href="tel:<?php echo $chi_tiet_nha_dat->sdt_lien_he ?>">
                                        <i class="fa fa-icon-me fa-custom-phone-green"></i>
                                        <span class="ml-2 phone-hiden display-grid">
                                            <span class="hidden-phone"><?php echo $chi_tiet_nha_dat->sdt_lien_he ?></span>
                                            <span class="click-to-show-phone">Gọi ngay</span>
                                        </span>
                                    </a>
                                </div>
                                <?php endif; ?>
                            </div>

                        </div>
                    </div>


                    
                </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    
                    <!--js render #info_bds -->
                    <script>
                        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
                            document.getElementById('info_bds').innerHTML = `
                                <h1 class="text-very-large m-0 line-28 text-500"><?php echo $name ?></h1>
                                <div class="mt-3 text-gray line-24 display-flex flex-center text-300">
                                    <i class="fa fa-icon-me fa-custom-pin1"></i>
                                    <span><?php echo $location ?></span>
                                </div>
                                <div class="mt-3 price-box display-flex flex-center justify-content-between">
                                    <div class="flex-first">								
                                        <span class="price"><?php echo $gia_tien ?></span>
                                        <?php if(isset($gia_tien_tren_tung_m2)): ?>
                                        <span class="text-gray text-small ml-2"><?php echo $gia_tien_tren_tung_m2  ?>/m²</span>
                                        <?php endif; ?>
                                    </div>
                                    <?php if(isset($info->google_map) && ($info->google_map !== '')): ?>
                                    <!--
                                    <a href="<?php echo base_url('map/'.$info->id) ?>" class="bags bags-round border-blue bags-blue display-flex flex-center view-map-btn" target="_blank">
                                        <i class="fa fa-icon-me fa-custom-map"></i>
                                        <span class="ml-2">Bản đồ</span>
                                    </a>
                                    -->
                                    <?php endif; ?>
                                </div>
                            `;
                        }else{
                            document.getElementById('info_bds').innerHTML = `
                                <h1 class="text-very-large m-0 line-26 text-500"><?php echo $name; ?></h1>
                                <div class="mt-4 text-100 display-flex flex-justify-between flex-center">
                                    <div class="display-flex flex-center line-22 ">
                                        <i class="fa fa-icon-me fa-custom-pin1"></i>
                                        <span><?php echo $location ?></span>
                                    </div>
                                    <?php if(isset($info->google_map) && ($info->google_map !== '')): ?>
                                    <!--
                                    <a href="<?php echo base_url('map/'.$info->id) ?>" class="bags bags-round border-blue bags-blue cursor display-flex flex-center hidden-sm view-map-btn" target="_blank">
                                        <i class="fa fa-icon-me fa-custom-map-large"></i>
                                        <span class="ml-2">Bản đồ</span>
                                    </a>
                                    -->
                                    <?php endif; ?>
                                </div>

                                <div class="mt-4 display-flex flex-justify-between text-medium-s">
                                    <div class="price-box">
                                        <span class='price'><?php echo $gia_tien ?></span>
                                        <?php if(isset($gia_tien_tren_tung_m2)): ?>
                                        <span class='text-gray text-small ml-2'><?php echo $gia_tien_tren_tung_m2 ?>/m²</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="product-status display-flex">
                                        <div class="display-flex">
                                            <span class="mr-1">Mã tin: </span>
                                            <span class="text-gray"><?php echo $info->update_time.'-'.$info->id; ?></span>
                                        </div>
                                    </div>
                                </div>
                            `;
                        }
                    </script>
                    <!-- end js render #info_bds -->
<?php   endif; ?>


<?php   if($info->du_an_status == '1'): //View cho nội dung dự án ?>
    <div class="container-fluid" id="info_bds_du_an"></div>
    <script>
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
            document.getElementById('info_bds_du_an').innerHTML = `
                <div class="mt-4">
                    <div class="product-show-container">
                        <div class="product-show-left">
                            <h1 class="text-very-large m-0 mb-3 line-22"><?php echo $name ?></h1>
                            <div class="mb-3 display-flex flex-center line-22">
                                <i class="fa fa-icon-me fa-custom-pin1"></i> 
                                <span><?php echo $location ?></span>
                            </div>
                            <div class="mb-1">
                                <div class="display-flex">
                                    <ul class="project-show-info-list text-100">
                                        <li><span>Trạng thái:</span><b><?php echo $trang_thai_du_an ?></b></li>					
                                        <li><span>Loại hình:</span><b> <?php echo $loai_hinh_du_an ?></b></li>
                                        <li><span>Diện tích xây dựng:</span><b><?php echo $dien_tich ?>m²</b></li>
                                        <li><span>Diện tích đất:</span><b><?php echo $tong_dien_tich_du_an ?></b></li>
                                        <li><span>Số nền đất:</span><b><?php echo $so_nen_dat ?></b></li>
                                        
                                        <li><span>Số block:</span><b><?php echo $so_block ?></b></li>
                                        <li><span>Số căn hộ:</span><b><?php echo $so_can_ho ?></b></li>
                                        <li><span>Mật độ xây dựng:</span><b><?php echo $mat_do_xay_dung ?></b></li>
                                        <li><span>Năm xây dựng:</span><b><?php echo $nam_xay_dung ?></b></li>
                                        <li><span>Năm bàn giao:</span><b><?php echo $nam_ban_giao ?></b></li>

                                        <li><span>Giá bán:</span><b class="text-price"><?php echo $gia_ban_du_an ?></b></li>
                                        <li><span>Giá thuê:</span><b class="text-price"><?php echo $gia_thue_du_an ?></b></li>
                                        <li><span>Liên hệ:</span><b><?php echo $nguoi_lien_he ?></b></li>
                                        <li><span>SĐT:</span><b><?php echo $sdt_lien_he ?></b></li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="nav-link-scroll nav-mobile">
                                <div class="container-nav-scroll-mobile no-scrollbar">
                                    <ul>
                                        <li class="" data-id="scrollbox-content">Tổng quan</li>
                                        <li data-id="scrollbox-utilities" class="">Tiện ích</li>
                                        <?php if($google_map !== ''): ?>
                                        <li data-id="scrollbox-map" class="">Vị trí</li>
                                        <?php endif; ?>
                                        <li data-id="scrollbox-other-project" class="current">Dự án lân cận</li>
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="mt-2 pt-3 scrollbox-container" id="scrollbox-content">
                                <h3 class="text-very-large m-0 text-normal">Giới thiệu</h3>
                                <div class="mt-3 line-26 text-100 detail-content">
                                    <?php echo json_decode($info->content); ?>
                                </div>
                            </div>
                            <div class="scrollbox-container mt-2" id="scrollbox-utilities">
                                <h4 class="text-very-large mt-3 mb-2 full-width left m-0 text-normal">Tiện ích tòa nhà và lân cận</h4>
                                <ul class="product-other-utilities text-100">
                                    <?php if(isset($chi_tiet_nha_dat->gan_cho)): ?>
                                    <li><i class="fa fa-icon-me fa-u-market mr-2"></i><span>Chợ</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->nha_tre)): ?>
                                    <li><i class="fa fa-icon-me fa-u-preschool mr-2"></i><span>Nhà Trẻ</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->truong_cap_2)): ?>
                                    <li><i class="fa fa-icon-me fa-u-school mr-2"></i><span>Trường Cấp 2</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->truong_cap_3)): ?>
                                    <li><i class="fa fa-icon-me fa-u-university mr-2"></i><span>Trường Cấp 3</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->dai_hoc)): ?>
                                    <li><i class="fa fa-icon-me fa-u-university mr-2"></i><span>Trường Đại Học</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->ho_boi)): ?>
                                    <li><i class="fa fa-icon-me fa-u-pool mr-2"></i><span>Hồ Bơi</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->khu_dan_cu)): ?>
                                    <li><i class="fa fa-icon-me fa-u-residential mr-2"></i><span>Khu Dân Cư</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->sieu_thi)): ?>
                                    <li><i class="fa fa-icon-me fa-u-mini-shop mr-2"></i><span>Siêu Thị</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->benh_vien)): ?>
                                    <li><i class="fa fa-icon-me fa-u-utility-6 mr-2"></i><span>Bệnh Viện</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->cho_dau_oto)): ?>
                                    <li><i class="fa fa-icon-me fa-u-park mr-2"></i><span>Chỗ Đậu Ô Tô</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->camera_an_ninh)): ?>
                                    <li><i class="fa fa-icon-me fa-u-camera mr-2"></i><span>Camera An Ninh</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->view_bien)): ?>
                                    <li><i class="fa fa-icon-me fa-u-anchor mr-2"></i><span>View Biển</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->trung_tam_hanh_chinh)): ?>
                                    <li><i class="fa fa-icon-me fa-u-neighbor mr-2"></i><span>Trung Tâm Hành Chính</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->trung_tam_hanh_chinh)): ?>
                                    <li><i class="fa fa-icon-me fa-u-airport mr-2"></i><span>Sân Bay</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->san_golf)): ?>
                                    <li><i class="fa fa-icon-me fa-u-person-forest mr-2"></i><span>Sân Golf</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->cong_vien)): ?>
                                    <li><i class="fa fa-icon-me fa-u-person-forest mr-2"></i><span>Công Viên</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->trung_tam_mua_sam)): ?>
                                    <li><i class="fa fa-icon-me fa-u-person-forest mr-2"></i><span>Trung Tâm Mua Sắm</span></li>
                                    <?php endif; ?>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            <?php if($google_map !== ''): ?>
                            <div class="mt-4 scrollbox-container" id="scrollbox-map">
                                <h4 class="text-very-large m-0 text-normal mb-3">Vị trí dự án</h4>
                                <div class="map-container-project div-relative">
                                    <iframe src="<?php echo $google_map ?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                </div>
                            </div>
                            <?php endif; ?>
                        
                        </div>
                    </div>
                </div>
                <div class="mt-3 pt-2 pb-2 mb-2 scrollbox-container" id="scrollbox-other-project">
                    <h3 class="text-very-large m-0 text-normal display-flex flex-center"><span>Dự án lân cận</span></h3>
                    <div class="mt-4 box-show-container pb-1">
                        <div class="re-slider re-project-index no-scrollbar">
                                <?php  
                                     $input = array();
                                     $input['where'] = array('status' => '0', 'du_an_status' => '1', 'city_id' => $info->city_id);
                                     $this->db->select('id, name, alias, meta_desc, loai_hinh_1, loai_hinh_2, loai_hinh_3, location, gia_tien, gia_tien_option, gia_tien_thue, gia_tien_thue_option, dien_tich, chu_dau_tu_id, phong_ngu, phong_tam, chi_tiet_nha_dat, image_link, update_time');
                                     $du_an_lan_can_list = $this->project_model->get_list($input);
                                     shuffle($du_an_lan_can_list);
                                     $count = '0';
                                ?>
                                <?php foreach($du_an_lan_can_list as $row):?>
                                    <?php if($row->id !== $info->id): ?>
                                        <?php $count++; ?>
                                        <?php if($count <= '12'): ?>
                                                <?php 
                                                    $row_name                   = json_decode($row->name);
                                                    $chi_tiet_nha_dat       = json_decode($row->chi_tiet_nha_dat);
                                                    $url_of_row             = base_url($row->alias.'-pr'.$row->id);
                                                    if($row->image_link !== ''){$image_of_row = base_url('upload/project/'.$row->image_link);}else{$image_of_row = base_url('public/site/images/no-image.jpg');}
                                                    if($row->loai_hinh_1 == json_encode('Mua Bán')){    $loai_hinh_mua_ban = 'Mua Bán';}
                                                    if($row->loai_hinh_1 == json_encode('Cho Thuê')){   $loai_hinh_mua_ban = 'Cho Thuê';}
                                                    $update_time            = get_date($row->update_time);
                                                    $dien_tich      = '--';
                                                    //Giá Tiền Bán / Cho Thuê -- Hiển thị giá min hoặc max
                                                    if($row->loai_hinh_1 == json_encode('Cho Thuê')){
                                                        //Hiển thị giá cho thuê
                                                        $gia_tien   = 'Đang Cập Nhật';
                                                        $dien_tich   = number_format($row->dien_tich);
                                                        if($row->gia_tien_thue > '0'){$gia_tien = price_format($row->gia_tien_thue);}else{if($row->gia_tien_thue_option > '0'){$gia_tien = price_format($row->gia_tien_thue_option);}}
                                                    }
                                                    if($row->loai_hinh_1 == json_encode('Mua Bán')){
                                                        //Hiển thị giá bán
                                                        $gia_tien   = 'Đang Cập Nhật';
                                                        if($row->gia_tien > '0'){$gia_tien = price_format($row->gia_tien);}else{if($row->gia_tien_option > '0'){$gia_tien = price_format($row->gia_tien_option);}}
                                                        //Hiển thị giá bán trên từng m2
                                                        $total_price = '0';
                                                        $dien_tich   = number_format($row->dien_tich);
                                                        if($row->dien_tich > '0'){
                                                            if(isset($row->gia_tien) && ($row->gia_tien >'0')){
                                                                $total_price = $row->gia_tien;
                                                            }else{
                                                                if(isset($row->gia_tien_option) && ($row->gia_tien_option > '0')){
                                                                    $total_price = $row->gia_tien_option;
                                                                }
                                                            }
                                                            if(($total_price > '0') && ($row->dien_tich > '0')){ 
                                                                $gia_tien_tren_tung_m2 = price_format($total_price / $row->dien_tich);
                                                            }
                                                        }

                                                    }

                                                    //Thông tin tiện ích
                                                    if($row->phong_ngu > '0'){$phong_ngu = $row->phong_ngu;}else{$phong_ngu = '--';}
                                                    if($row->phong_tam > '0'){$phong_tam = $row->phong_tam;}else{$phong_tam = '--';}
                                                    if(json_decode($row->loai_hinh_3) !== ''){$huong_nha = json_decode($row->loai_hinh_3);}else{$huong_nha = '--';}

                                                    //Mô tả - vị trí
                                                    $meta_desc = json_decode($row->meta_desc);
                                                    $location  = 'Đang Cập Nhật';
                                                    if($row->location !== ''){$location = json_decode($row->location);}

                                                    //Thông tin dự án
                                                    $chu_dau_tu_of_row = 'Đang Cập Nhật';
                                                    if(isset($chi_tiet_nha_dat->chu_dau_tu_name) && ($chi_tiet_nha_dat->chu_dau_tu_name !== '') && ($row->chu_dau_tu_id !== '0')){
                                                        $this->db->select('id, alias, ');
                                                        $chut_dau_tu_info   = $this->chu_dau_tu_model->get_info($row->chu_dau_tu_id);
                                                        $url_chu_dau_tu     = base_url($chut_dau_tu_info->alias.'-cdt'.$chut_dau_tu_info->id);
                                                        $chu_dau_tu_of_row = '<a href="'.$url_chu_dau_tu.'">'.$chi_tiet_nha_dat->chu_dau_tu_name.'</a>';
                                                    }

                                                    $trang_thai_du_an = 'Đang Cập Nhật';
                                                    if(isset($chi_tiet_nha_dat->trang_thai_bds) && ($chi_tiet_nha_dat->trang_thai_bds !== '')){
                                                        $trang_thai_du_an = $chi_tiet_nha_dat->trang_thai_bds;
                                                    }

                                                    $quy_mo_du_an = '';
                                                    $check_trang_thai_update_quy_mo = '0';
                                                    if(isset($chi_tiet_nha_dat->so_block) && ($chi_tiet_nha_dat->so_block > '0')){
                                                        $quy_mo_du_an .= '<span>'.$chi_tiet_nha_dat->so_block.' Block</span>, ';
                                                        $check_trang_thai_update_quy_mo++;
                                                    }
                                                    if(isset($chi_tiet_nha_dat->so_can_ho) && ($chi_tiet_nha_dat->so_can_ho > '0')){
                                                        $quy_mo_du_an .= '<span>'.$chi_tiet_nha_dat->so_can_ho.' Căn Hộ</span>';
                                                        $check_trang_thai_update_quy_mo++;
                                                    }
                                                    if($check_trang_thai_update_quy_mo == '0'){
                                                        $quy_mo_du_an = '<span>Đang Cập Nhật</span>';
                                                    }


                                                    $loai_hinh_du_an = '';
                                                    $danh_sach_loai_hinh_bds    = array();
                                                    $danh_sach_loai_hinh_bds[]  = json_decode($row->loai_hinh_2);
                                                    if(isset($chi_tiet_nha_dat->loai_hinh_bds_phu)){
                                                        foreach($chi_tiet_nha_dat->loai_hinh_bds_phu as $loai_hinh_bds_phu){
                                                            $danh_sach_loai_hinh_bds[]  = $loai_hinh_bds_phu;
                                                        }
                                                    }
                                                    $danh_sach_loai_hinh_bds = array_unique($danh_sach_loai_hinh_bds);
                                                    if(count($danh_sach_loai_hinh_bds) == '0'){
                                                        $loai_hinh_du_an = 'Đang Cập Nhật';
                                                    }else{
                                                        foreach($danh_sach_loai_hinh_bds as $loai_hinh_bds){
                                                            $loai_hinh_du_an .= $loai_hinh_bds.', ';
                                                        }
                                                    }
                                                   
                                                    

                                                ?>

                                                
                                <div class="re-slider-project re-slider-item">
                                    <div class="box-item rounded hidden bg-white border h-full project-item-slider">
                                        <div class="image project-item-image div-relative text-center"> 
                                            <a href="<?php echo $url_of_row ?>" target="_blank">
                                                <img alt="<?php echo $row_name ?>" class="image-hover image-resize lazy" src="<?php echo $image_of_row ?>">
                                            </a>
                                            <div class="product-type">
                                                <span class="text-small bags bags-round bags-white text-pink mr-2 project-status-bags"><?php echo $trang_thai_du_an ?></span>
                                            </div>
                                            <div class="project-status"></div>
                                            <div class="number-photo-product cursor"><i class="fa fa-picture-o"></i></div>
                                        </div>
                                        <div class="pl-2 pr-2 pt-3 pb-3">
                                            <h2 class="text-large m-0 name-project">
                                                <a href="<?php echo $url_of_row ?>" title="<?php echo $row_name ?>" target="_blank" class="limit-line limit-line-1 color-name text-500 line-26"><?php echo $row_name ?></a>
                                            </h2>
                                            <div class="mt-2 text-500 text-gray limit-line limit-line-1">
                                                <span>Chủ đầu tư: <?php echo $chu_dau_tu_of_row ?></span>
                                            </div>
                                            <div class="list-option-project-index text-medium-s">
                                                <div class="mt-2 display-flex flex-center text-gray line-22">
                                                    <i class="fa fa-icon-me fa-custom-pin1"></i>
                                                    <span class="limit-line-1 limit-line" title="<?php echo $location ?>"><?php echo $location ?></span>
                                                </div>
                                                <div class="mt-2 text-gray display-flex flex-center">
                                                    <i class="fa fa-icon-me fa-custom-scale mr-1"></i>
                                                    <span class="limit-line-1 limit-line">Quy mô: <?php echo $quy_mo_du_an ?></span>
                                                </div>
                                                <div class="mt-2 text-gray display-flex flex-center">
                                                    <i class="fa fa-list mr-1"></i>
                                                    <span class="limit-line-1 limit-line"><?php echo $loai_hinh_du_an ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                        </div>
                    </div>
                </div>
            `;
        }else{
            //giao diện pc 
            document.getElementById('info_bds_du_an').innerHTML = `
                <div class="mt-4">
                    <div class="mb-3 display-flex">
                        <h1 class="text-very-large text-500 m-0 line-22 flex-first"><?php echo $name ?></h1>
                        <!--
                        <a href="<?php echo base_url('map') ?>" class="bags bags-round border-blue bags-blue cursor display-flex flex-center hidden-sm view-map-btn" target="_blank">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 0c-69.59 0-126 56.41-126 126 0 56.26 82.35 158.8 113.9 196.02 6.39 7.54 17.82 7.54 24.2 0C331.65 284.8 414 182.26 414 126 414 56.41 357.59 0 288 0zm0 168c-23.2 0-42-18.8-42-42s18.8-42 42-42 42 18.8 42 42-18.8 42-42 42zM20.12 215.95A32.006 32.006 0 0 0 0 245.66v250.32c0 11.32 11.43 19.06 21.94 14.86L160 448V214.92c-8.84-15.98-16.07-31.54-21.25-46.42L20.12 215.95zM288 359.67c-14.07 0-27.38-6.18-36.51-16.96-19.66-23.2-40.57-49.62-59.49-76.72v182l192 64V266c-18.92 27.09-39.82 53.52-59.49 76.72-9.13 10.77-22.44 16.95-36.51 16.95zm266.06-198.51L416 224v288l139.88-55.95A31.996 31.996 0 0 0 576 426.34V176.02c0-11.32-11.43-19.06-21.94-14.86z"></path></svg>
                            <span class="ml-2">Bản đồ</span>
                        </a>
                        -->
                    </div>

                    <div class="mb-3">				
                        <span class="mr-2">Chủ đầu tư: </span>
                        <b><?php echo $chu_dau_tu;?></b>
                    </div>
                    
                    <div class="mb-3 display-flex flex-center">
                        <i class="fa fa-icon-me fa-custom-pin1"></i><?php echo $location ?>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="project-info-header">
                        <ul class="first">
                            <li><span>Trạng thái:</span><b><?php echo $trang_thai_du_an ?></b></li>					
                            <li><span>Loại hình:</span><b> <?php echo $loai_hinh_du_an ?></b></li>
                            <li><span>Diện tích xây dựng:</span><b><?php echo $dien_tich ?>m²</b></li>
                            <li><span>Diện tích đất:</span><b><?php echo $tong_dien_tich_du_an ?></b></li>
                            <li><span>Số nền đất:</span><b><?php echo $so_nen_dat ?></b></li>
                        </ul>
                        <ul class="second">
                            <li><span>Số block:</span><b><?php echo $so_block ?></b></li>
                            <li><span>Số căn hộ:</span><b><?php echo $so_can_ho ?></b></li>
                            <li><span>Mật độ xây dựng:</span><b><?php echo $mat_do_xay_dung ?></b></li>
                            <li><span>Năm xây dựng:</span><b><?php echo $nam_xay_dung ?></b></li>
                            <li><span>Năm bàn giao:</span><b><?php echo $nam_ban_giao ?></b></li>
                        </ul>

                        <ul class="thirdly">
                            <li><span>Giá bán:</span><b class="text-price"><?php echo $gia_ban_du_an ?></b></li>
                            <li><span>Giá thuê:</span><b class="text-price"><?php echo $gia_thue_du_an ?></b></li>
                            <li><span>Liên hệ:</span><b><?php echo $nguoi_lien_he ?></b></li>
                            <li><span>SĐT:</span><b><?php echo $sdt_lien_he ?></b></li>
                        </ul>
                    </div>
                </div>
                <div class="mt-4">
                    <div class="product-show-container">
                        <div class="div-full">	
                            <div class="nav-link-scroll relative">
                                <div class="container-fluid">
                                    <ul>
                                        <li class="current" data-id="scrollbox-content">Tổng quan</li>
                                        <li data-id="scrollbox-utilities" class="">Tiện ích</li>
                                        <?php if($google_map !== ''): ?>
                                        <li data-id="scrollbox-map" class="">Vị trí</li>
                                        <?php endif; ?>
                                        <li data-id="scrollbox-other-project">Dự án lân cận</li>
                                    </ul>
                                </div> 
                            </div>
                            <div class="mt-2 pt-3 scrollbox-container" id="scrollbox-content">
                                <h3 class="text-very-large m-0 text-normal">Giới thiệu <?php echo $name ?></h3>
                                <div class="mt-3 line-28 text-300 detail-content">
                                    <?php echo json_decode($info->content); ?>
                                </div>
                            </div>
                            <div class="scrollbox-container mt-2" id="scrollbox-utilities">
                                <h4 class="text-very-large mt-4 mb-2 full-width left m-0 text-normal">Tiện ích tòa nhà và lân cận</h4>
                                <ul class="product-other-utilities text-100">
                                    <?php if(isset($chi_tiet_nha_dat->gan_cho)): ?>
                                    <li><i class="fa fa-icon-me fa-u-market mr-2"></i><span>Chợ</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->nha_tre)): ?>
                                    <li><i class="fa fa-icon-me fa-u-preschool mr-2"></i><span>Nhà Trẻ</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->truong_cap_2)): ?>
                                    <li><i class="fa fa-icon-me fa-u-school mr-2"></i><span>Trường Cấp 2</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->truong_cap_3)): ?>
                                    <li><i class="fa fa-icon-me fa-u-university mr-2"></i><span>Trường Cấp 3</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->dai_hoc)): ?>
                                    <li><i class="fa fa-icon-me fa-u-university mr-2"></i><span>Trường Đại Học</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->ho_boi)): ?>
                                    <li><i class="fa fa-icon-me fa-u-pool mr-2"></i><span>Hồ Bơi</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->khu_dan_cu)): ?>
                                    <li><i class="fa fa-icon-me fa-u-residential mr-2"></i><span>Khu Dân Cư</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->sieu_thi)): ?>
                                    <li><i class="fa fa-icon-me fa-u-mini-shop mr-2"></i><span>Siêu Thị</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->benh_vien)): ?>
                                    <li><i class="fa fa-icon-me fa-u-utility-6 mr-2"></i><span>Bệnh Viện</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->cho_dau_oto)): ?>
                                    <li><i class="fa fa-icon-me fa-u-park mr-2"></i><span>Chỗ Đậu Ô Tô</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->camera_an_ninh)): ?>
                                    <li><i class="fa fa-icon-me fa-u-camera mr-2"></i><span>Camera An Ninh</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->view_bien)): ?>
                                    <li><i class="fa fa-icon-me fa-u-anchor mr-2"></i><span>View Biển</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->trung_tam_hanh_chinh)): ?>
                                    <li><i class="fa fa-icon-me fa-u-neighbor mr-2"></i><span>Trung Tâm Hành Chính</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->trung_tam_hanh_chinh)): ?>
                                    <li><i class="fa fa-icon-me fa-u-airport mr-2"></i><span>Sân Bay</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->san_golf)): ?>
                                    <li><i class="fa fa-icon-me fa-u-person-forest mr-2"></i><span>Sân Golf</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->cong_vien)): ?>
                                    <li><i class="fa fa-icon-me fa-u-person-forest mr-2"></i><span>Công Viên</span></li>
                                    <?php endif; ?>
                                    <?php if(isset($chi_tiet_nha_dat->trung_tam_mua_sam)): ?>
                                    <li><i class="fa fa-icon-me fa-u-person-forest mr-2"></i><span>Trung Tâm Mua Sắm</span></li>
                                    <?php endif; ?>
                                </ul>
                                <div class="clear"></div>
                            </div>
                            
                            <?php if($google_map !== ''): ?>
                            <div class="mt-4 scrollbox-container" id="scrollbox-map">
                                <h4 class="text-very-large m-0 text-normal mb-3">Vị trí dự án</h4>
                                <div class="map-container-project div-relative">
                                    <div class="div-relative project-show-map show">
                                        <div id="map-project" class="leaflet-container leaflet-touch leaflet-fade-anim leaflet-grab leaflet-touch-drag leaflet-touch-zoom" tabindex="0">
                                            <div class="leaflet-pane leaflet-map-pane" style="transform: translate3d(0px, 0px, 0px);">
                                                <div class="leaflet-pane leaflet-tile-pane">
                                                    <div class="leaflet-layer " style="z-index: 1; opacity: 1;">
                                                        <div class="leaflet-tile-container leaflet-zoom-animated" style="z-index: 18; transform: translate3d(0px, 0px, 0px) scale(1);">
                                                            <iframe src="<?php echo $google_map ?>" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="mt-3 pt-3 scrollbox-container" id="scrollbox-other-project">
                    <h3 class="text-very-large m-0 text-normal">Dự án lân cận</h3>
                    <div class="mt-3">
                        <div class="box-show-container">
                            <div class="box-container-inner grid-auto-project pb-4 mb-3">
                                <?php  
                                     $input = array();
                                     $input['where'] = array('status' => '0', 'du_an_status' => '1', 'city_id' => $info->city_id);
                                     $this->db->select('id, name, alias, meta_desc, loai_hinh_1, loai_hinh_2, loai_hinh_3, location, gia_tien, gia_tien_option, gia_tien_thue, gia_tien_thue_option, dien_tich, chu_dau_tu_id, phong_ngu, phong_tam, chi_tiet_nha_dat, image_link, update_time');
                                     $du_an_lan_can_list = $this->project_model->get_list($input);
                                     shuffle($du_an_lan_can_list);
                                     $count = '0';
                                ?>
                                <?php foreach($du_an_lan_can_list as $row):?>
                                    <?php if($row->id !== $info->id): ?>
                                        <?php $count++; ?>
                                        <?php if($count <= '3'): ?>
                                                <?php 
                                                    $row_name               = json_decode($row->name);
                                                    $chi_tiet_nha_dat       = json_decode($row->chi_tiet_nha_dat);
                                                    $url_of_row             = base_url($row->alias.'-pr'.$row->id);
                                                    if($row->image_link !== ''){$image_of_row = base_url('upload/project/'.$row->image_link);}else{$image_of_row = base_url('public/site/images/no-image.jpg');}
                                                    if($row->loai_hinh_1 == json_encode('Mua Bán')){    $loai_hinh_mua_ban = 'Mua Bán';}
                                                    if($row->loai_hinh_1 == json_encode('Cho Thuê')){   $loai_hinh_mua_ban = 'Cho Thuê';}
                                                    $update_time            = get_date($row->update_time);
                                                    $dien_tich      = '--';
                                                    //Giá Tiền Bán / Cho Thuê -- Hiển thị giá min hoặc max
                                                    if($row->loai_hinh_1 == json_encode('Cho Thuê')){
                                                        //Hiển thị giá cho thuê
                                                        $gia_tien   = 'Đang Cập Nhật';
                                                        $dien_tich   = number_format($row->dien_tich);
                                                        if($row->gia_tien_thue > '0'){$gia_tien = price_format($row->gia_tien_thue);}else{if($row->gia_tien_thue_option > '0'){$gia_tien = price_format($row->gia_tien_thue_option);}}
                                                    }
                                                    if($row->loai_hinh_1 == json_encode('Mua Bán')){
                                                        //Hiển thị giá bán
                                                        $gia_tien   = 'Đang Cập Nhật';
                                                        if($row->gia_tien > '0'){$gia_tien = price_format($row->gia_tien);}else{if($row->gia_tien_option > '0'){$gia_tien = price_format($row->gia_tien_option);}}
                                                        //Hiển thị giá bán trên từng m2
                                                        $total_price = '0';
                                                        $dien_tich   = number_format($row->dien_tich);
                                                        if($row->dien_tich > '0'){
                                                            if(isset($row->gia_tien) && ($row->gia_tien >'0')){
                                                                $total_price = $row->gia_tien;
                                                            }else{
                                                                if(isset($row->gia_tien_option) && ($row->gia_tien_option > '0')){
                                                                    $total_price = $row->gia_tien_option;
                                                                }
                                                            }
                                                            if(($total_price > '0') && ($row->dien_tich > '0')){ 
                                                                $gia_tien_tren_tung_m2 = price_format($total_price / $row->dien_tich);
                                                            }
                                                        }

                                                    }

                                                    //Thông tin tiện ích
                                                    if($row->phong_ngu > '0'){$phong_ngu = $row->phong_ngu;}else{$phong_ngu = '--';}
                                                    if($row->phong_tam > '0'){$phong_tam = $row->phong_tam;}else{$phong_tam = '--';}
                                                    if(json_decode($row->loai_hinh_3) !== ''){$huong_nha = json_decode($row->loai_hinh_3);}else{$huong_nha = '--';}

                                                    //Mô tả - vị trí
                                                    $meta_desc = json_decode($row->meta_desc);
                                                    $location  = 'Đang Cập Nhật';
                                                    if($row->location !== ''){$location = json_decode($row->location);}

                                                    //Thông tin dự án
                                                    $chu_dau_tu_of_row = 'Đang Cập Nhật';
                                                    if(isset($chi_tiet_nha_dat->chu_dau_tu_name) && ($chi_tiet_nha_dat->chu_dau_tu_name !== '') && ($row->chu_dau_tu_id !== '0')){
                                                        $this->db->select('id, alias, ');
                                                        $chut_dau_tu_info   = $this->chu_dau_tu_model->get_info($row->chu_dau_tu_id);
                                                        $url_chu_dau_tu     = base_url($chut_dau_tu_info->alias.'-cdt'.$chut_dau_tu_info->id);
                                                        $chu_dau_tu_of_row = '<a href="'.$url_chu_dau_tu.'">'.$chi_tiet_nha_dat->chu_dau_tu_name.'</a>';
                                                    }

                                                    $trang_thai_du_an = 'Đang Cập Nhật';
                                                    if(isset($chi_tiet_nha_dat->trang_thai_bds) && ($chi_tiet_nha_dat->trang_thai_bds !== '')){
                                                        $trang_thai_du_an = $chi_tiet_nha_dat->trang_thai_bds;
                                                    }

                                                    $quy_mo_du_an = '';
                                                    $check_trang_thai_update_quy_mo = '0';
                                                    if(isset($chi_tiet_nha_dat->so_block) && ($chi_tiet_nha_dat->so_block > '0')){
                                                        $quy_mo_du_an .= '<span>'.$chi_tiet_nha_dat->so_block.' Block</span>, ';
                                                        $check_trang_thai_update_quy_mo++;
                                                    }
                                                    if(isset($chi_tiet_nha_dat->so_can_ho) && ($chi_tiet_nha_dat->so_can_ho > '0')){
                                                        $quy_mo_du_an .= '<span>'.$chi_tiet_nha_dat->so_can_ho.' Căn Hộ</span>';
                                                        $check_trang_thai_update_quy_mo++;
                                                    }
                                                    if($check_trang_thai_update_quy_mo == '0'){
                                                        $quy_mo_du_an = '<span>Đang Cập Nhật</span>';
                                                    }


                                                    $loai_hinh_du_an = '';
                                                    $danh_sach_loai_hinh_bds    = array();
                                                    $danh_sach_loai_hinh_bds[]  = json_decode($row->loai_hinh_2);
                                                    if(isset($chi_tiet_nha_dat->loai_hinh_bds_phu)){
                                                        foreach($chi_tiet_nha_dat->loai_hinh_bds_phu as $loai_hinh_bds_phu){
                                                            $danh_sach_loai_hinh_bds[]  = $loai_hinh_bds_phu;
                                                        }
                                                    }
                                                    $danh_sach_loai_hinh_bds = array_unique($danh_sach_loai_hinh_bds);
                                                    if(count($danh_sach_loai_hinh_bds) == '0'){
                                                        $loai_hinh_du_an = 'Đang Cập Nhật';
                                                    }else{
                                                        foreach($danh_sach_loai_hinh_bds as $loai_hinh_bds){
                                                            $loai_hinh_du_an .= $loai_hinh_bds.', ';
                                                        }
                                                    }
                                                   
                                                    

                                                ?>
                                <div class="re-slider-project re-slider-item">
                                    <div class="box-item rounded hidden bg-white border h-full project-item-slider">
                                        <div class="image project-item-image div-relative text-center"> 
                                            <a href="<?php echo $url_of_row ?>" target="_blank">
                                                <img alt="<?php echo $row_name ?>" class="image-hover image-resize lazy" src="<?php echo $image_of_row ?>">
                                            </a>
                                            <div class="product-type">
                                                <span class="text-small bags bags-round bags-white text-pink mr-2 project-status-bags"><?php echo $trang_thai_du_an ?></span>
                                            </div>
                                            <div class="project-status"></div>
                                            <div class="number-photo-product cursor"><i class="fa fa-picture-o"></i></div>
                                        </div>
                                        <div class="pl-2 pr-2 pt-3 pb-3">
                                            <h2 class="text-large m-0 name-project">
                                                <a href="<?php echo $url_of_row ?>" title="<?php echo $row_name ?>" target="_blank" class="limit-line limit-line-1 color-name text-500 line-26"><?php echo $row_name ?></a>
                                            </h2>
                                            <div class="mt-2 text-500 text-gray limit-line limit-line-1">
                                                <span>Chủ đầu tư: <?php echo $chu_dau_tu_of_row ?></span>
                                            </div>
                                            <div class="list-option-project-index text-medium-s">
                                                <div class="mt-2 display-flex flex-center text-gray line-22">
                                                    <i class="fa fa-icon-me fa-custom-pin1"></i>
                                                    <span class="limit-line-1 limit-line" title="<?php echo $location ?>"><?php echo $location ?></span>
                                                </div>
                                                <div class="mt-2 text-gray display-flex flex-center">
                                                    <i class="fa fa-icon-me fa-custom-scale mr-1"></i>
                                                    <span class="limit-line-1 limit-line">Quy mô: <?php echo $quy_mo_du_an ?></span>
                                                </div>
                                                <div class="mt-2 text-gray display-flex flex-center">
                                                    <i class="fa fa-list mr-1"></i>
                                                    <span class="limit-line-1 limit-line"><?php echo $loai_hinh_du_an ?></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            `;
        }
    </script>
<?php   endif;?>






<!--Modal slider PC-->
<div class="off" style="width: 0;height: 0;">
    <?php foreach($list_image as $row): ?>
        <?php $image_link = base_url('upload/project/'.$row); ?>
    <img alt="Slider" data-id="lightbox" class="lightbox forlightbox" src="<?php echo $image_link ?>" />
    <?php endforeach;?>
    
</div>
<!--END Modal slider PC-->

<div class="mobile-slider-popup" style="display: none;">
    <div class="mobile-slider-popup-header">
    	<span id="page-slider"></span>
        <span class="x-slider" onclick="hide_modal_mobile()" style="z-index:999;"></span>
    </div>
    <div class="slider-mobile-container" style="transform: translateX(0px);">
        <?php foreach($list_image as $row): ?>
            <?php $image_link = base_url('upload/project/'.$row); ?>
        <div class="slide-item">
            <img src="<?php echo $image_link ?>" alt="<?php echo $name; ?>">
        </div>
        <?php endforeach;?>
    </div>
</div>
<script>
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        //Giao diện Mobile
        document.getElementById('image_area').innerHTML = `
            <div class="display-relative">
                <div class="div-relative counterOwlContainer img-product-mobile-show">
                    <div id="image-product-slider" class="slider-product-item owl-carousel owl-theme owl-has-dot owl-loaded owl-drag">
                        <div class="owl-stage-outer">
                            <div class="owl-stage">
                                <?php 
                                    $count = '0'; 
                                    ++$count; 
                                    $image_link = base_url('upload/project/'.$row);
                                    $number_image = $count - 1;
                                ?>
                                <?php foreach($list_image as $row):?>
                                <div class="owl-item">
                                    <div class="img">
                                        <img src="<?php echo $image_link ?>" alt="<?php echo $name ?>" class="cursor image-to-slider image-resize">
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                        <div class="owl-nav">
                            <button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button>
                            <button type="button" role="presentation" class="owl-next disabled"><span aria-label="Next">›</span></button>
                        </div>
                        <div class="owl-dots disabled"></div>
                    </div>
                    <div class="counterOwl">
                        <span></span>
                        <i class="fa fa-picture-o ml-1"></i>
                    </div>
                </div>
                <div class="bags-fixed-bottom">
                    <span class="bags bags-round bags-white-green mr-2"><?php echo $loai_hinh_mua_ban ?></span>
                </div>
                <div class="created-at-fixed rounded">
                    <div class="text-tiny text-100 text-gray time-since" data-time="<?php echo $update_time ?>"><?php echo $update_time ?></div>
                </div>
            </div>
        `;
    }else{
        //Giao Diện PC
        document.getElementById('image_area').innerHTML = `
            <div class="container-fluid">
                <div class="display-relative">
                    <div class="product-images-grid-half">
                        <?php $count = '0'; ?>
                        <?php foreach($list_image as $row):?>
                            <?php 
                                ++$count; 
                                $image_link = base_url('upload/project/'.$row);
                                $number_image = $count - 1;
                            ?>
                            <?php if($count == '1'): ?>
                        <div class="product-image-large-show">
                            <img data-id="lightbox" src="<?php echo $image_link ?>" alt="<?php echo $name ?>" class="lightbox forlightbox cursor image-resize image-to-slider">
                        </div>
                            <?php else: ?>
                                <?php if($count <= '3'): ?>
                        <div data-id="lightbox" class="product-images-small-show grid-<?php echo $number_image ?>">
                            <img src="<?php echo $image_link ?>" alt="<?php echo $name ?>" class="lightbox forlightbox cursor image-resize image-to-slider">
                        </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endforeach; ?>
                        
                        <div class="number-photo-product cursor">
                            <i class="fa fa-picture-o"></i> <?php echo count($list_image); ?>
                        </div>
                    </div>
                    <div class="product-type">
                        <span class='bags bags-round bags-white-green mr-2'><?php echo $loai_hinh_mua_ban ?></span>
                    </div>
                </div>
            </div>
        `;
    }


    $(document).ready(function() {
        $('.image-to-slider').click(function(e) {
            $('.lightbox').click();
        })

        $(".number-photo-product").click(function(e) {
            $('.lightbox').click();
        })

        $(".lightbox").lightbox();
        $(".li-appointment").click(function() {
            $("#modal-appointment-main").modal('show')
        })
    })

    function hide_modal_mobile(){
        document.getElementById('hide_modal_mobile').setAttribute('style','display:none;');
    }
</script>


