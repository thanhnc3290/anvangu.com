
<div id="home_nha_dat_cho_thue_moi_nhat" class="row">
    
</div>

<script>
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        document.getElementById('home_nha_dat_cho_thue_moi_nhat').innerHTML = `
            <div class="col-12">
				<div class="mt-5 mb-3">
					<h2 class="m-0 display-flex flex-center">
						<a class="flex-first text-title-group-home color-name" href="<?php echo base_url('danh-sach-bds-bds-nha-dat-cho-thue/?du_an_status=0&loai_hinh_mua_ban_bds=Cho Thuê') ?>">
							Nhà đất cho thuê mới nhất
						</a>
						
					</h2>					
				</div>
				<div class="mt-2">
					<div id="product-for-buy-sale-1" class="box-show-container ProductForSale">
                        <div class="">
                            <div class="re-slider no-scrollbar" id="popular-slider-1">
                                <?php foreach($nha_data_cho_thue_moi_nhat as $row): ?>
                                                <?php 
                                                    $name                   = json_decode($row->name);
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
                                                   
                                                    

                                                ?>
                                <div class="re-slider-item re-slider-product">
                                    <div class="box-item-slider border rounded hidden bg-white item">
                                        <div class="image text-center">
                                            <a class="img" href="<?php echo $url_of_row ?>">
                                                <img 
                                                    alt="<?php echo $name ?>" 
                                                    class="image-hover lazy" 
                                                    src="<?php echo $image_of_row ?>">
                                            </a>
                                            <span class="bags bags-round bags-white-green bags-fixed-bottom"><span><?php echo $loai_hinh_mua_ban ?></span></span>
                                            <div class="created-at-fixed rounded">
                                                <div class="text-tiny text-100"><?php echo $update_time ?></div>
                                            </div>
                                        </div>
                                        <div class="pl-2 pr-2 pt-2 pb-3">
                                            <div class="mt-2 price-box-list">
                                                <span>
                                                    <span class="price mr-2"><?php echo $gia_tien ?></span>
                                                    <?php if(isset($gia_tien_tren_tung_m2)): ?>
                                                    <span class="text-gray text-small"><?php echo $gia_tien_tren_tung_m2 ?>/m²</span>
                                                    <?php endif; ?>
                                                </span>
                                            </div>
                                            <div class="mt-3">
                                                <ul class="product-infomation-list text-gray text-medium-s">
                                                    <li><i class="fa fa-custom-square fa-icon-me mr-1"></i><span><?php echo $dien_tich ?> m²</span></li>
                                                    <li><i class="fa fa-custom-bedroom fa-icon-me mr-1"></i><span><?php echo $phong_ngu ?></span></li>
                                                    <li><i class="fa fa-custom-bathroom fa-icon-me mr-1"></i><span><?php echo $phong_tam ?></span></li>
                                                    <li class="display-flex"><i class="fa-custom-direction fa-icon-me mr-1"></i><span><?php echo $huong_nha ?></span></li>
                                                </ul>
                                            </div>
                                            <p class="text-large-s m-0 mt-2 name-product ">
                                                <a href="<?php echo $url_of_row ?>" class="limit-line limit-line-2 line-24 text-blue-header"><?php echo $name ?></a>
                                            </p>
                                            <div class="mt-2">
                                                <p class=" display-flex flex-center text-gray text-medium-s text-100">
                                                    <i class="fa fa-icon-me fa-custom-pin1"></i>
                                                    <span class="limit-line limit-line-1" title="<?php echo $location ?>"><?php echo $location ?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
				</div>
			</div>
        `;
    }else{
        //giao diện PC

        document.getElementById('home_nha_dat_cho_thue_moi_nhat').innerHTML = `
            <div class="col-12">
                <div class="mt-3 mb-3">
                    <h2 class="m-0 display-flex flex-center">
                        <a class="flex-first text-title-group-home text-gray" href="<?php echo base_url('danh-sach-bds-bds-nha-dat-cho-thue/?du_an_status=0&loai_hinh_mua_ban_bds=Cho Thuê') ?>">Nhà đất cho thuê mới nhất</a>
                        <a class="btn btn-outline-success btn-rounded view-all-group-home" href="<?php echo base_url('danh-sach-bds-bds-nha-dat-cho-thue/?du_an_status=0&loai_hinh_mua_ban_bds=Cho Thuê') ?>">Xem tất cả</a>
                    </h2>
                </div>
                <div class="mt-2">
                    <div id="" class="box-show-container">
                        <div class="pt-2 pb-3 mb-3">
                            <div class="by-category-slider owl-carousel owl-theme owl-has-dot owl-loaded owl-drag mixedSlider_2" id="">
                                <div class="owl-stage-outer">
                                    <div class="owl-stage MS-content">
                                        <?php foreach($nha_data_cho_thue_moi_nhat as $row): ?>
                                                        <?php 
                                                            $name                   = json_decode($row->name);
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
                                                        
                                                            

                                                        ?>
                                        <div class="item owl-item active" >
                                            <div class="box-item-slider border rounded hidden bg-white">
                                                <div class="image text-center">
                                                    <a class="img" href="<?php echo $url_of_row; ?>">
                                                        <img alt="<?php echo $name ?>" class="image-hover lazy" src="<?php echo $image_of_row ?>">
                                                    </a>
                                                    <span class="bags bags-round bags-white-green bags-fixed-bottom">
                                                        <span><?php echo $loai_hinh_mua_ban ?></span>
                                                    </span>
                                                    <div class="like-fixed-top icon-heart-31244">
                                                        <span><i class="fa fa-icon-me fa-custom-icon-heart-white"></i></span>
                                                    </div>
                                                    <div class="created-at-fixed rounded">
                                                        <div class="text-tiny text-100"><?php echo $update_time ?></div>
                                                    </div>
                                                </div>
                                                <div class="pl-2 pr-2 pt-2 pb-3">
                                                    <div class="mt-2 price-box-list">
                                                        <span>
                                                            <span class="price mr-2"><?php echo $gia_tien ?></span>
                                                            <?php if(isset($gia_tien_tren_tung_m2)): ?>
                                                            <span class="text-gray text-small"><?php echo $gia_tien_tren_tung_m2 ?>/m²</span>
                                                            <?php endif; ?>
                                                        </span>
                                                    </div>
                                                    <div class="mt-3">
                                                        <ul class="product-infomation-list text-gray text-medium-s">
                                                            <li><i class="fa fa-custom-square fa-icon-me mr-1"></i><span><?php echo $dien_tich ?> m²</span></li>
                                                            <li><i class="fa fa-custom-bedroom fa-icon-me mr-1"></i><span><?php echo $phong_ngu ?></span></li>
                                                            <li><i class="fa fa-custom-bathroom fa-icon-me mr-1"></i><span><?php echo $phong_tam ?></span></li>
                                                            <li class="display-flex"><i class="fa-custom-direction fa-icon-me mr-1"></i><span><?php echo $huong_nha ?></span></li>
                                                        </ul>
                                                    </div>
                                                    <p class="text-large-s m-0 mt-2 name-product ">
                                                        <a href="<?php $url_of_row ?>" class="limit-line limit-line-2 line-24 text-blue-header">
                                                            <?php echo $name; ?>
                                                        </a></p>
                                                    <div class="mt-2">
                                                        <p class=" display-flex flex-center text-gray text-medium-s text-100">
                                                            <i class="fa fa-icon-me fa-custom-pin1"></i>
                                                            <span class="limit-line limit-line-1" title="<?php echo $location ?>"><?php echo $location ?></span></p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <?php endforeach; ?>
                                    </div>
                                </div>
                                <div class="owl-nav MS-controls">
                                    <button type="button" role="presentation" class="owl-prev MS-left"  style="display:block!important;display: block!important;background: #fff!important;border: 1px solid #ccc!important;border-radius: 50%;font: normal normal normal 14px/1 FontAwesome!important;height: 35px;transform: inherit;width: 35px;"><span aria-label="Previous">‹</span></button>
                                    <button type="button" role="presentation" class="owl-next MS-right" style="display:block!important;display: block!important;background: #fff!important;border: 1px solid #ccc!important;border-radius: 50%;font: normal normal normal 14px/1 FontAwesome!important;height: 35px;transform: inherit;width: 35px;"><span aria-label="Next">›</span></button>
                                </div>
                                <div class="owl-dots disabled"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        `;
        $('.mixedSlider_2').multislider({
            duration: 750, //750
            interval: 50000 //50000
        });
        
    }
</script>

