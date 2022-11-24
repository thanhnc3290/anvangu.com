<?php 
    $name               = json_decode($info->prefix).' '.json_decode($info->name);
    $image_link         = public_url('site/images/no-image.jpg');
    $url_of_info        = base_url($info->alias.'-cdt'.$info->id);
	if($info->image_link!==''){
		$image_link     = base_url('upload/chu_dau_tu/'.$info->image_link);
	}
    
    
    $input = array();
    $input['where'] = array('status' => '0', 'chu_dau_tu_id' => $info->id);
    $input['order'] = array('id','desc');
    $this->db->select('id, name, alias, meta_desc, loai_hinh_1, loai_hinh_2, loai_hinh_3, location, gia_tien, gia_tien_option, gia_tien_thue, gia_tien_thue_option, dien_tich, chu_dau_tu_id, phong_ngu, phong_tam, chi_tiet_nha_dat, image_link, image_list, update_time');
    $du_an_list_of_info = $this->project_model->get_list($input);
?>

<div class="bg-white pb-3 pt-2">
    <div class="container-fluid">
        <div class="crumb-box mt-3">
            <ul class="crumb text-medium crumb-text flex-first">
                <li><a href="<?php echo base_url('chu-dau-tu') ?>"><span>Doanh nghiệp bất động sản</span></a></li>
                <li><?php echo $name ?></li>
            </ul>
        </div>

        <div class="mt-3">
            <div class="investor-item">
                <div class="first-investor-item">
                    <div class="image-investor-item mt-2">
                        <img alt="<?php echo $name ?>" class="lazy" src="<?php echo $image_link ?>">
                    </div>
                    <div class="content-investor-item mt-1">
                        <h2 class="text-title-ml text-500 line-32 m-0 mb-3 color-name"><?php echo $name ?></h2>
                        <div class="text-300 line-28 detail-content mt-3">
                            <?php echo json_decode($info->content); ?>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <h3 class="line-28 text-very-large text-500">
                        <a class="color-name" href="<?php echo $url_of_info ?>">Dự án BĐS của <?php echo $name ?></a>
                    </h3>
                </div>
                <div class="mt-3">
                    <div class="box-show-container">
                        <div class="box-container-inner grid-auto-project pb-3 mb-3">
                            <?php foreach($du_an_list_of_info as $row): ?>
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
                            <div class="re-slider-project re-slider-item">
                                <div class="box-item rounded hidden bg-white border h-full project-item-slider">
                                    <div class="image project-item-image div-relative text-center">
                                        <a href="<?php echo $url_of_row ?>" target="_blank">
                                            <img alt="Cityland Garden Hills - Gò Vấp" class="image-hover image-resize lazy" src="<?php echo base_url('upload/project/'.$list_image['0']) ?>">
                                        </a>
                                        <div class="product-type">
                                            <span class="text-small bags bags-round bags-white text-pink mr-2 project-status-bags"><?php echo $trang_thai_du_an ?></span>
                                        </div>
                                        <div class="project-status">
                                            <span class="text-small bags bags-round bags-white text-success mr-1"><?php echo $loai_hinh_mua_ban ?></span>
                                        </div>
                                    </div>
                                    <div class="pl-2 pr-2 pt-3 pb-3">
                                        <h2 class="text-large m-0 name-project">
                                            <a href="<?php echo $url_of_row ?>" title="<?php echo $name ?>" target="_blank" class="limit-line limit-line-1 color-name text-500 line-26"><?php echo $name ?></a>
                                        </h2>
                                        <div class="mt-2 text-500 text-gray limit-line limit-line-1">
                                            <span>Chủ đầu tư: <?php echo $chut_dau_tu ?></span>
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
                                                <span class="limit-line-1 limit-line"> <?php echo $loai_hinh_du_an ?></span>
                                            </div>
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
        <div class="mt-3">
            <div class="paginate-container">

            </div>
        </div>
    </div>
</div>