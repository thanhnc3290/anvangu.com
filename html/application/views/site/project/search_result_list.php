                <div class="main-search-product">

                    <div class="mt-3 left-search-product box-show-container">
                        <div class="box-container-inner grid-auto mb-3">
                            <?php //print_r($list); ?>
                            <?php foreach($list as $row): ?>
                                <?php 
                                    $name                   = json_decode($row->name);
                                    $url_of_row             = base_url($row->alias.'-pr'.$row->id);
                                    $update_time            = get_date($row->update_time);
                                    $chi_tiet_nha_dat       = json_decode($row->chi_tiet_nha_dat);
                                    $dien_tich              = '-';
                                    $huong_nha              = '-';
                                    $loai_hinh_mua_ban      = 'Đang Cập Nhật';
                                    if(json_decode($row->loai_hinh_1)){
                                        $loai_hinh_mua_ban          = json_decode($row->loai_hinh_1);
                                    }

                                    //Giá Tiền Bán / Cho Thuê -- Hiển thị giá min hoặc max
                                    if($row->loai_hinh_1 == json_encode('Cho Thuê')){
                                        //Hiển thị giá cho thuê
                                        $gia_tien   = 'Đang Cập Nhật';
                                        $dien_tich   = number_format($row->dien_tich);
                                        if($row->gia_tien_thue !== '0'){$gia_tien = price_format($row->gia_tien_thue);}else{if($row->gia_tien_thue_option !== '0'){$gia_tien = price_format($row->gia_tien_thue_option);}}
                                    }
                                    if($row->loai_hinh_1 == json_encode('Mua Bán')){
                                        //Hiển thị giá bán
                                        $gia_tien   = 'Đang Cập Nhật';
                                        if($row->gia_tien !== '0'){$gia_tien = price_format($row->gia_tien);}else{if($row->gia_tien_option !== '0'){$gia_tien = price_format($row->gia_tien_option);}}
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
                                    $chut_dau_tu = 'Đang Cập Nhật';
                                    if(isset($chi_tiet_nha_dat->chu_dau_tu_name) && ($chi_tiet_nha_dat->chu_dau_tu_name !== '') && ($row->chu_dau_tu_id !== '0')){
                                        $this->db->select('id, alias, ');
                                        $chut_dau_tu_info   = $this->chu_dau_tu_model->get_info($row->chu_dau_tu_id);
                                        $url_chu_dau_tu     = base_url($chut_dau_tu_info->alias.'-cdt'.$chut_dau_tu_info->id);
                                        $chut_dau_tu = '<a href="'.$url_chu_dau_tu.'">'.$chi_tiet_nha_dat->chu_dau_tu_name.'</a>';
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
                                    
                                    $list_image = array();
                                    if(isset($row->image_link) && ($row->image_link !== '')){
                                        $list_image[] = $row->image_link;
                                    }
                                    $image_list = json_decode($row->image_list);
                                    if(is_array($image_list)){
                                        foreach($image_list as $img){
                                            $list_image[] = $img;
                                        }
                                    }
                                    $list_image = array_unique($list_image);
                                ?>
                            <div class="box-item box-shadow rounded bg-white">
                                <div class="image text-center rounded-top display-grid">
                                    <div class="div-relative hidden rounded-top h-full counterOwlContainer">
                                        <div class="slider-product-item owl-carousel owl-theme owl-has-dot owl-loaded owl-drag" id="slider-product-item-<?php echo $row->id ?>">
                                            <div class="owl-stage-outer">
                                                <div class="owl-stage">
                                                    <?php foreach($list_image as $img): ?>
                                                        <?php $image_link = base_url('upload/project/'.$img); ?>
                                                    <div class="owl-item">
                                                        <a class="img" target="_blank" href="<?php echo $url_of_row; ?>">
                                                            <img alt="<?php echo $name; ?>" class="image-hover lazy" src="<?php echo $image_link ?>">
                                                        </a>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                            <div class="owl-nav">
                                                <button type="button" role="presentation" class="owl-prev disabled"><span aria-label="Previous">‹</span></button>
                                                <button type="button" role="presentation" class="owl-next"><span aria-label="Next">›</span></button>
                                            </div>
                                            <div class="owl-dots disabled"></div>
                                        </div>
                                        <div class="counterOwl">
                                            <span></span>
                                            <i class="fa fa-picture-o ml-1"></i>
                                        </div>
                                    </div>
                                    <div class="bags-fixed-bottom-with-inner text-small">
                                        <span class="bags bags-round bags-white-green mr-2"><?php echo $loai_hinh_mua_ban ?></span>
                                    </div>
                                    <div class="created-at-fixed rounded">
                                        <div class="text-tiny text-100 time-since" data-time="<?php echo $update_time ?>"><?php echo $update_time ?></div>
                                    </div>
                                </div>
                                <div class="pl-2 pr-2 pt-2 pb-3">
                                    <div class="mt-2">
                                        <div class="display-flex flex-justify-between flex-center">
                                            <div class="price-box-list">
                                                <span class="price"><?php echo $gia_tien ?></span>
                                            </div>
                                            <div>
                                                <!--diện tích, phòng ngủ, p tắm, hướng-->
                                                <ul class="product-infomation-list text-small">
                                                    <li class="display-flex flex-center"><i class="fa fa-icon-me fa-custom-square mr-1"></i><span><?php echo $dien_tich ?> m²</span></li>
                                                    <li><i class="fa fa-icon-me fa-custom-bedroom mr-1"></i><span><?php echo $phong_ngu ?></span></li>
                                                    <li><i class="fa fa-icon-me fa-custom-bathroom mr-1"></i><span><?php echo $phong_tam ?></span></li>
                                                    <li class="display-flex"><i class="fa fa-custom-direction fa-icon-me mr-1"></i><span><?php echo $huong_nha ?></span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>

                                    <p class="text-large-s m-0 mt-2 name-product">
                                        <a target="_blank" title="<?php echo $name ?>" href="<?php echo $url_of_row ?>" class="limit-line limit-line-2 color-name line-24 text-400  ">
                                            <?php echo $name ?>
                                        </a>
                                    </p>

                                    <div class="mt-2">
                                        <p class="display-flex flex-center text-gray text-medium-s">
                                            <i class="fa fa-icon-me fa-custom-pin1"></i>
                                            <span class="limit-line limit-line-1" title="<?php echo $location ?>"><?php echo $location ?></span>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <?php endforeach; ?>
                        </div>
                    </div>

                    <!-- Khoảng Giá & Diện Tích -->         
                                            
                    <div class="right-search-product mt-3 footer_hidden_on_mobile">
                        <div class="box-search-setting">
                            <p class="mb-3 text-large-s text-400">Lọc theo khoảng giá</p>
                            <ul>
                                <!-- Khoảng Giá Bán BDS-->
                                <?php if(json_decode($query_loai_hinh_mua_ban_bds) !== 'Cho Thuê'): ?>
                                    <?php 
                                        //url hiện tại cho khoảng giá
                                        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
                                        $parsed = parse_url($actual_link);
                                        $query = $parsed['query'];
                                        parse_str($query, $params);

                                        //tạo url để lọc theo giá bán
                                        $url_to_query = $actual_link;
                                        if(isset($params['khoang_gia_bds'])){
                                            unset($params['khoang_gia_bds']);
                                            unset($params['phan_trang']);
                                            $uri_to_query = http_build_query($params);
                                            $url_to_query = base_url('danh-sach-bds/?').$uri_to_query;
                                        }    
                                    ?>  
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_bds=Tất Cả'; ?>" class="filter-search-btn-right text-gray <?php if(($query_khoang_gia_bds) == ''){ echo 'text-500 text-blue'; } ?> ">Tất Cả</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_bds=Đến 500 triệu'; ?>" class="filter-search-btn-right text-gray <?php if(($query_khoang_gia_bds) == 'Đến 500 triệu'){ echo 'text-500 text-blue'; } ?> "> < 500 triệu</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_bds=Từ 500 - Đến 800 triệu'; ?>" class="filter-search-btn-right text-gray <?php if(($query_khoang_gia_bds) == 'Từ 500 - Đến 800 triệu'){ echo 'text-500 text-blue'; } ?>">500 - 800 triệu</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_bds=Từ 800 triệu - Đến 1 tỷ'; ?>" class="filter-search-btn-right text-gray <?php if(($query_khoang_gia_bds) == 'Từ 800 triệu - Đến 1 tỷ'){ echo 'text-500 text-blue'; } ?>">800 triệu - 1 tỷ</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_bds=Từ 1 tỷ - Đến 2 tỷ'; ?>" class="filter-search-btn-right text-gray <?php if(($query_khoang_gia_bds) == 'Từ 1 tỷ - Đến 2 tỷ'){ echo 'text-500 text-blue'; } ?>">1 - 2 tỷ</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_bds=Từ 2 tỷ - Đến 3 tỷ'; ?>" class="filter-search-btn-right text-gray <?php if(($query_khoang_gia_bds) == 'Từ 2 tỷ - Đến 3 tỷ'){ echo 'text-500 text-blue'; } ?>">2 - 3 tỷ</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_bds=Từ 3 tỷ - Đến 5 tỷ'; ?>" class="filter-search-btn-right text-gray <?php if(($query_khoang_gia_bds) == 'Từ 3 tỷ - Đến 5 tỷ'){ echo 'text-500 text-blue'; } ?>">3 - 5 tỷ</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_bds=Từ 5 tỷ - Đến 7 tỷ'; ?>" class="filter-search-btn-right text-gray <?php if(($query_khoang_gia_bds) == 'Từ 5 tỷ - Đến 7 tỷ'){ echo 'text-500 text-blue'; } ?>">5 - 7 tỷ</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_bds=Từ 7 tỷ - Đến 10 tỷ'; ?>" class="filter-search-btn-right text-gray <?php if(($query_khoang_gia_bds) == 'Từ 7 tỷ - Đến 10 tỷ'){ echo 'text-500 text-blue'; } ?>">7 - 10 tỷ</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_bds=Từ 10 tỷ - Đến 20 tỷ'; ?>" class="filter-search-btn-right text-gray <?php if(($query_khoang_gia_bds) == 'Từ 10 tỷ - Đến 20 tỷ'){ echo 'text-500 text-blue'; } ?>">10 - 20 tỷ</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_bds=Từ 20 tỷ - Đến 30 tỷ'; ?>" class="filter-search-btn-right text-gray <?php if(($query_khoang_gia_bds) == 'Từ 20 tỷ - Đến 30 tỷ'){ echo 'text-500 text-blue'; } ?>">20 - 30 tỷ</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_bds=Từ 30 tỷ - Đến 50 tỷ'; ?>" class="filter-search-btn-right text-gray <?php if(($query_khoang_gia_bds) == 'Từ 30 tỷ - Đến 50 tỷ'){ echo 'text-500 text-blue'; } ?>">30 - 50 tỷ</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_bds=Từ 50 tỷ'; ?>" class="filter-search-btn-right text-gray <?php if(($query_khoang_gia_bds) == 'Từ 50 tỷ'){ echo 'text-500 text-blue'; } ?>"> > 50 tỷ</a>
                                    </li>
                                <?php endif; ?>
                                <!-- END Khoảng Giá Bán BDS-->
                                <!-- Khoảng Giá cho thuê BDS-->
                                <?php if(json_decode($query_loai_hinh_mua_ban_bds) == 'Cho Thuê'): ?>
                                    <?php 
                                        //url hiện tại cho khoảng giá
                                        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
                                        $parsed = parse_url($actual_link);
                                        $query = $parsed['query'];
                                        parse_str($query, $params);

                                        //tạo url để lọc theo giá thuê
                                        $url_to_query = $actual_link;
                                        if(isset($params['khoang_gia_cho_thue_bds'])){
                                            unset($params['khoang_gia_cho_thue_bds']);
                                            unset($params['phan_trang']);
                                            $uri_to_query = http_build_query($params);
                                            $url_to_query = base_url('danh-sach-bds/?').$uri_to_query;
                                        }    
                                    ?>  
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_cho_thue_bds=Tất Cả'; ?>" class="filter-search-btn-right text-gray <?php if($query_khoang_gia_cho_thue_bds == ''){echo 'text-500 text-blue';} ?> ">Tất Cả</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_cho_thue_bds=< 1 triệu'; ?>" class="filter-search-btn-right text-gray <?php if($query_khoang_gia_cho_thue_bds == '< 1 triệu'){echo 'text-500 text-blue';} ?> ">< 1 triệu</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_cho_thue_bds=1 - 3 triệu'; ?>" class="filter-search-btn-right text-gray <?php if($query_khoang_gia_cho_thue_bds == '1 - 3 triệu'){echo 'text-500 text-blue';} ?> ">1 - 3 triệu</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_cho_thue_bds=3 - 5 triệu'; ?>" class="filter-search-btn-right text-gray <?php if($query_khoang_gia_cho_thue_bds == '3 - 5 triệu'){echo 'text-500 text-blue';} ?>">3 - 5 triệu</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_cho_thue_bds=5 - 7 triệu'; ?>" class="filter-search-btn-right text-gray <?php if($query_khoang_gia_cho_thue_bds == '5 - 7 triệu'){echo 'text-500 text-blue';} ?>">5 - 7 triệu</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_cho_thue_bds=7 - 10 triệu'; ?>" class="filter-search-btn-right text-gray <?php if($query_khoang_gia_cho_thue_bds == '7 - 10 triệu'){echo 'text-500 text-blue';} ?>">7 - 10 triệu</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_cho_thue_bds=10 - 30 triệu'; ?>" class="filter-search-btn-right text-gray <?php if($query_khoang_gia_cho_thue_bds == '10 - 30 triệu'){echo 'text-500 text-blue';} ?>">10 - 30 triệu</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_cho_thue_bds=30 - 50 triệu'; ?>" class="filter-search-btn-right text-gray <?php if($query_khoang_gia_cho_thue_bds == '30 - 50 triệu'){echo 'text-500 text-blue';} ?>">30 - 50 triệu</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_cho_thue_bds=50 - 100 triệu'; ?>" class="filter-search-btn-right text-gray <?php if($query_khoang_gia_cho_thue_bds == '50 - 100 triệu'){echo 'text-500 text-blue';} ?>">50 - 100 triệu</a>
                                    </li>
                                    <li class="mt-3 mb-3">
                                        <a href="<?php echo $url_to_query.'&khoang_gia_cho_thue_bds=> 100 triệu'; ?>" class="filter-search-btn-right text-gray <?php if($query_khoang_gia_cho_thue_bds == '> 100 triệu'){echo 'text-500 text-blue';} ?>">> 100 triệu</a>
                                    </li>
                                <?php endif; ?>
                                <!-- END Khoảng Giá cho thuê BDS-->
                            </ul>
                        </div>
                        <div class="box-search-setting">
                            <p class="mb-3 text-large-s text-400">Lọc theo diện tích</p>
                                    <?php 
                                        //url hiện tại cho khoảng giá
                                        $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
                                        $parsed = parse_url($actual_link);
                                        $query = $parsed['query'];
                                        parse_str($query, $params);

                                        //tạo url để lọc theo diện tích
                                        $url_to_query = $actual_link;
                                        if(isset($params['dien_tich_bds'])){
                                            unset($params['dien_tich_bds']);
                                            unset($params['phan_trang']);
                                            $uri_to_query = http_build_query($params);
                                            $url_to_query = base_url('danh-sach-bds/?').$uri_to_query;
                                        }    
                                    ?>  
                            <ul>
                                <li class="mt-3 mb-3">
                                    <a href="<?php echo $url_to_query.'&dien_tich_bds=Tất Cả' ?>" class="filter-search-btn-right text-gray <?php if($query_dien_tich_bds == ''){echo 'text-500 text-blue';} ?>">Tất Cả</a>
                                </li>
                                <li class="mt-3 mb-3">
                                    <a href="<?php echo $url_to_query.'&dien_tich_bds=Đến 30 m²' ?>" class="filter-search-btn-right text-gray <?php if($query_dien_tich_bds == 'Đến 30 m'){echo 'text-500 text-blue';} ?>">< 30 m²</a>
                                </li>
                                <li class="mt-3 mb-3">
                                    <a href="<?php echo $url_to_query.'&dien_tich_bds=Từ 30 m² - Đến 50 m²' ?>" class="filter-search-btn-right text-gray <?php if($query_dien_tich_bds == 'Từ 30 m² - Đến 50 m²'){echo 'text-500 text-blue';} ?>">30 - 50 m²</a>
                                </li>
                                <li class="mt-3 mb-3">
                                    <a href="<?php echo $url_to_query.'&dien_tich_bds=Từ 50 m² - Đến 80 m²' ?>" class="filter-search-btn-right text-gray <?php if($query_dien_tich_bds == 'Từ 50 m² - Đến 80 m²'){echo 'text-500 text-blue';} ?>">50 - 80 m²</a>
                                </li>
                                <li class="mt-3 mb-3">
                                    <a href="<?php echo $url_to_query.'&dien_tich_bds=Từ 80 m² - Đến 100 m²' ?>" class="filter-search-btn-right text-gray <?php if($query_dien_tich_bds == 'Từ 80 m² - Đến 100 m²'){echo 'text-500 text-blue';} ?>">80 - 100 m²</a>
                                </li>
                                <li class="mt-3 mb-3">
                                    <a href="<?php echo $url_to_query.'&dien_tich_bds=Từ 100 m² - Đến 300 m²' ?>" class="filter-search-btn-right text-gray <?php if($query_dien_tich_bds == 'Từ 100 m² - Đến 300 m²'){echo 'text-500 text-blue';} ?>">100 - 300 m²</a>
                                </li>
                                <li class="mt-3 mb-3">
                                    <a href="<?php echo $url_to_query.'&dien_tich_bds=Từ 300 m² - Đến 500 m²' ?>" class="filter-search-btn-right text-gray <?php if($query_dien_tich_bds == 'Từ 300 m² - Đến 500 m²'){echo 'text-500 text-blue';} ?>">300 - 500 m²</a>
                                </li>
                                <li class="mt-3 mb-3">
                                    <a href="<?php echo $url_to_query.'&dien_tich_bds=Từ 500 m²' ?>" class="filter-search-btn-right text-gray <?php if($query_dien_tich_bds == 'Từ 500 m²'){echo 'text-500 text-blue';} ?>">> 500 m²</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <!-- END Khoảng Giá & Diện Tích -->
                </div>