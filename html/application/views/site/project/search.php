


<div>
    <div>
        <div class="container-fluid bg-white div-relative pt-3 pb-4">
            <div id="head_search_sectioon"></div>
            <div id="head_search_sectioon_info">
                
            </div>
            <?php 
                //url hiện tại cho khoảng giá
                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
                $parsed = parse_url($actual_link);
                $query = $parsed['query'];
                parse_str($query, $params);

                //tạo url để sort_by
                $url_to_sort_by = $actual_link;
                if(isset($params['sort_by'])){
                    unset($params['sort_by']);
                    unset($params['phan_trang']);
                    $uri_to_sort_by = http_build_query($params);
                    $url_to_sort_by = base_url('danh-sach-bds/?').$uri_to_sort_by;
                }

                //link cố định
                $link_co_dinh_1 = base_url('danh-sach-bds?loai_hinh_mua_ban_bds='.urlencode(json_decode($query_loai_hinh_mua_ban_bds)));
                $link_co_dinh_2 = $link_co_dinh_1.'&du_an_status='.json_decode($query_du_an_status);
            ?>  
            <script>
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
                    //Giao diện MObile
                    document.getElementById('head_search_sectioon').innerHTML = `
                        <div class="row">
                            <div class="col-12">
                                <div class="crumb-box mt-2">					
                                    <ul class="crumb text-medium crumb-text flex-first">	
                                        <?php if(isset($query_loai_hinh_mua_ban_bds) && (strlen(json_decode($query_loai_hinh_mua_ban_bds)) > '0')): ?>
                                        <li><a href="<?php echo $link_co_dinh_1 ?>"><span><?php echo json_decode($query_loai_hinh_mua_ban_bds)?></span></a></li>
                                        <?php endif; ?>
                                        <li><a href="<?php echo $link_co_dinh_2 ?>"><span><?php if(json_decode($query_du_an_status) == '0'){echo 'Nhà Đất';}else{ echo 'Dự Án';} ?></span></a></li>
                                        <?php if(isset($query_loai_hinh_bds) && (strlen(json_decode($query_loai_hinh_bds)) > '0')): ?>
                                        <li><a href="#"><span><?php echo json_decode($query_loai_hinh_bds) ?></span></a></li>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    `;
                    document.getElementById('head_search_sectioon_info').innerHTML = `
                        <div class="row">
                            <div class="col-12">
                                <h1 class="flex-first mt-2 mb-0 text-large text-normal line-26">
                                    <?php if(isset($query_loai_hinh_mua_ban_bds)): ?><?php echo json_decode($query_loai_hinh_mua_ban_bds)?><?php endif; ?> 
                                    <?php if(json_decode($query_du_an_status) == '0'){echo 'Nhà Đất';}else{ echo 'Dự Án';} ?>
                                    <?php if(isset($query_loai_hinh_bds)){echo ' '.json_decode($query_loai_hinh_bds);} ?>: 
                                    <?php if(isset($_GET['chu_dau_tu_id']) && ($_GET['chu_dau_tu_id'] > '0')){echo json_decode($this->chu_dau_tu_model->get_info($_GET['chu_dau_tu_id'])->name).' - '; }?>
                                    <?php 
                                        if(isset($show_location_1) && (strlen($show_location_1) > '0')){
                                            echo $show_location_1;
                                        }else{
                                            if(isset($show_location_2) && (strlen($show_location_2) > '0')){
                                                echo $show_location_2;
                                            }else{
                                                echo 'Toàn Quốc';
                                            }
                                        }
                                    ?>
                                </h1>

                                <div class="mt-2 text-medium">				
                                    <span>Hiện có <?php echo count($list) ?> bất động sản</span>
                                </div>
                            </div>
                        </div>
                        <div class="row sort-and-view-box">
                            <div class="col-12">
                                <div class="display-flex">					
                                    <div class="flex-first display-flex ">
                                        <div id="SortSearch">
                                            <div class="searchSortBoxContainer">
                                                <span class="display-flex flex-center showSearchSort" id="sort_order_search_page">
                                                    <span class="flex-first"><?php if($query_sort_by !== ''){ echo $query_sort_by;}else{ echo 'Mới nhất';} ?></span>
                                                    <i class="fa fa-angle-down ml-2"></i>
                                                </span>
                                                <div class="searchSortBox off" id="list_sort_order_search_page">
                                                    <div><div class="icheck-success "><input class="sort_order_search_page_check_box" value="Mới nhất"           <?php if($query_sort_by == '') echo 'checked'; ?>                      type="radio" id="Mới nhất"><label for="Mới nhất">Mới nhất</label></div></div>
                                                    <div><div class="icheck-success "><input class="sort_order_search_page_check_box" value="Giá giảm dần"       <?php if($query_sort_by == 'Giá giảm dần') echo 'checked'; ?>          type="radio" id="Giá giảm dần"><label for="Giá giảm dần">Giá giảm dần</label></div></div>
                                                    <div><div class="icheck-success "><input class="sort_order_search_page_check_box" value="Giá tăng dần"       <?php if($query_sort_by == 'Giá tăng dần') echo 'checked'; ?>          type="radio" id="Giá tăng dần"><label for="Giá tăng dần">Giá tăng dần</label></div></div>
                                                    <div><div class="icheck-success "><input class="sort_order_search_page_check_box" value="Diện tích giảm dần" <?php if($query_sort_by == 'Diện tích giảm dần') echo 'checked'; ?>    type="radio" id="Diện tích giảm dần"><label for="Diện tích giảm dần">Diện tích giảm dần</label></div></div>
                                                    <div><div class="icheck-success "><input class="sort_order_search_page_check_box" value="Diện tích tăng dần" <?php if($query_sort_by == 'Diện tích tăng dần') echo 'checked'; ?>    type="radio" id="Diện tích tăng dần"><label for="Diện tích tăng dần">Diện tích tăng dần</label></div></div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="text-medium">
                                        <!--
                                        <a href="<?php echo base_url('map') ?>" class="h-full pl-2 pr-2 rounded-xl border-blue bags-blue cursor display-flex flex-center view-map-btn" target="_blank">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M288 0c-69.59 0-126 56.41-126 126 0 56.26 82.35 158.8 113.9 196.02 6.39 7.54 17.82 7.54 24.2 0C331.65 284.8 414 182.26 414 126 414 56.41 357.59 0 288 0zm0 168c-23.2 0-42-18.8-42-42s18.8-42 42-42 42 18.8 42 42-18.8 42-42 42zM20.12 215.95A32.006 32.006 0 0 0 0 245.66v250.32c0 11.32 11.43 19.06 21.94 14.86L160 448V214.92c-8.84-15.98-16.07-31.54-21.25-46.42L20.12 215.95zM288 359.67c-14.07 0-27.38-6.18-36.51-16.96-19.66-23.2-40.57-49.62-59.49-76.72v182l192 64V266c-18.92 27.09-39.82 53.52-59.49 76.72-9.13 10.77-22.44 16.95-36.51 16.95zm266.06-198.51L416 224v288l139.88-55.95A31.996 31.996 0 0 0 576 426.34V176.02c0-11.32-11.43-19.06-21.94-14.86z"></path></svg>
                                            <span class="ml-2">Bản đồ</span>
                                        </a>
                                        -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    `;

                }else{
                    //giao diện PC
                    document.getElementById('head_search_sectioon').innerHTML = `
                        <div class="crumb-box mt-1 mb-3">
                            <ul class="crumb text-medium crumb-text flex-first">
                                <?php if(isset($query_loai_hinh_mua_ban_bds) && (strlen(json_decode($query_loai_hinh_mua_ban_bds)) > '0')): ?>
                                <li><a href="<?php echo $link_co_dinh_1 ?>"><span><?php echo json_decode($query_loai_hinh_mua_ban_bds)?></span></a></li>
                                <?php endif; ?>
                                <li><a href="<?php echo $link_co_dinh_2 ?>"><span><?php if(json_decode($query_du_an_status) == '0'){echo 'Nhà Đất';}else{ echo 'Dự Án';} ?></span></a></li>
                                <?php if(isset($query_loai_hinh_bds) && (strlen(json_decode($query_loai_hinh_bds)) > '0')): ?>
                                <li><a href="#"><span><?php echo json_decode($query_loai_hinh_bds) ?></span></a></li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    `;
                    document.getElementById('head_search_sectioon_info').innerHTML = `
                        <div class="display-flex  mt-1">
                            <h1 class="flex-first line-26 display-flex flex-center text-very-large text-normal m-0">
                                <?php if(isset($query_loai_hinh_mua_ban_bds)): ?><?php echo json_decode($query_loai_hinh_mua_ban_bds)?><?php endif; ?> 
                                <?php if(json_decode($query_du_an_status) == '0'){echo 'Nhà Đất';}else{ echo 'Dự Án';} ?>
                                <?php if(isset($query_loai_hinh_bds)){echo ' '.json_decode($query_loai_hinh_bds);} ?>: 
                                <?php if(isset($_GET['chu_dau_tu_id']) && ($_GET['chu_dau_tu_id'] > '0')){echo json_decode($this->chu_dau_tu_model->get_info($_GET['chu_dau_tu_id'])->name).' - '; }?>
                                <?php 
                                    if(isset($show_location_1) && (strlen($show_location_1) > '0')){
                                        echo $show_location_1;
                                    }else{
                                        if(isset($show_location_2) && (strlen($show_location_2) > '0')){
                                            echo $show_location_2;
                                        }else{
                                             echo 'Toàn Quốc';
                                        }
                                    }
                                ?>
                            </h1>
                        </div>

                        <div class="mt-3 display-flex flex-center">
                            <div class="flex-first">
                                <span>
                                    Hiện có <?php echo count($list) ?> bất động sản
                                </span>
                            </div>
                            
                            <div class="display-flex sort-and-view-box">
                                <div id="SortSearch" class="mr-3">
                                    <div class="searchSortBoxContainer">
                                        <span class="display-flex flex-center showSearchSort" id="sort_order_search_page">
                                            <span class="flex-first"><?php if($query_sort_by !== ''){ echo $query_sort_by;}else{ echo 'Mới nhất';} ?></span>
                                            <i class="fa fa-angle-down ml-2"></i>
                                        </span>
                                        <div id="list_sort_order_search_page" class="searchSortBox off">
                                            <div><div class="icheck-success "><input class="sort_order_search_page_check_box" value="Mới nhất"           <?php if($query_sort_by == '') echo 'checked'; ?>                      type="radio" id="Mới nhất"><label for="Mới nhất">Mới nhất</label></div></div>
                                            <div><div class="icheck-success "><input class="sort_order_search_page_check_box" value="Giá giảm dần"       <?php if($query_sort_by == 'Giá giảm dần') echo 'checked'; ?>          type="radio" id="Giá giảm dần"><label for="Giá giảm dần">Giá giảm dần</label></div></div>
                                            <div><div class="icheck-success "><input class="sort_order_search_page_check_box" value="Giá tăng dần"       <?php if($query_sort_by == 'Giá tăng dần') echo 'checked'; ?>          type="radio" id="Giá tăng dần"><label for="Giá tăng dần">Giá tăng dần</label></div></div>
                                            <div><div class="icheck-success "><input class="sort_order_search_page_check_box" value="Diện tích giảm dần" <?php if($query_sort_by == 'Diện tích giảm dần') echo 'checked'; ?>    type="radio" id="Diện tích giảm dần"><label for="Diện tích giảm dần">Diện tích giảm dần</label></div></div>
                                            <div><div class="icheck-success "><input class="sort_order_search_page_check_box" value="Diện tích tăng dần" <?php if($query_sort_by == 'Diện tích tăng dần') echo 'checked'; ?>    type="radio" id="Diện tích tăng dần"><label for="Diện tích tăng dần">Diện tích tăng dần</label></div></div>
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="text-medium">
                                    <!--
                                    <a href="<?php echo base_url('map') ?>" class="bags bags-round border-blue bags-blue cursor display-flex flex-center hidden-sm view-map-btn" target="_blank">
                                        <i class="fa fa-icon-me fa-custom-map-large"></i>
                                        <span class="ml-2">Bản đồ</span>
                                    </a>
                                    -->
                                </div>
                            </div>
                        </div>
                    `;
                }
                $("#sort_order_search_page").click(function(){
                    //Thực hiện Select
                    $("#list_sort_order_search_page").removeClass("off");
                });

                $(".sort_order_search_page_check_box").click(function(evt){
                    $("#list_sort_order_search_page").addClass("off");
                    $("#list_sort_order_search_page").removeAttr("checked");
                    $(this).attr('checked','checked');
                    var value = $(this).val();
                    var url_to_redirect = '<?php echo $url_to_sort_by ?>' + '&sort_by=' + value;
                    console.log(value);
                    console.log(url_to_redirect);
                    window.location.assign(url_to_redirect);
                });

                //Ẩn khi click ra ngoài div
                $(document).mouseup(function(e)
                {
                    var search_box_1 = $("#sort_order_search_page");
                    if (!search_box_1.is(e.target) && search_box_1.has(e.target).length === 0)
                    {
                        $("#list_sort_order_search_page").addClass('off');
                        
                    }
                });
            </script>


            
            <?php if($query_du_an_status == '1'): //Nếu là search cho Dự Án -- Truyền ra view riêng ?>
                <?php $this->load->view('site/project/search_result_list_du_an'); ?>
            <?php else: // Còn lại Dùng View Chung ?>
                <?php $this->load->view('site/project/search_result_list') ?>
            <?php endif; ?>

            
            <!-- Phân Trang-->
            <?php 
                //url hiện tại
                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
                //lấy url Gốc Không Phân Trang
                $current_url_with_out_pagination = str_replace(array('?&phan_trang='.$query_phan_trang,'&phan_trang='.$query_phan_trang),'',$actual_link);
                
                $prev_page_number   = $query_phan_trang - '1';
                $prev_page_link     = $current_url_with_out_pagination.'&phan_trang='.$prev_page_number;
                if($prev_page_number < '0'){
                    $prev_page_link     = $current_url_with_out_pagination.'&phan_trang=0';
                }
                
                $current_page_number    = $query_phan_trang;
                $current_page_link      = $current_url_with_out_pagination;

                $next_page_number       = $query_phan_trang + '1';
                $next_page_link         = $current_url_with_out_pagination.'&phan_trang='.$next_page_number;
            ?>
            <div class="mt-3">
                <div class="paginate-container">
                    <nav>
                        <ul class="pagination">
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $prev_page_link ?>" rel="prev" aria-label="pagination.previous">‹</a>
                            </li>
                            <li class="page-item"><a class="page-link" href="<?php echo $prev_page_link ?>"><?php echo $prev_page_number+1; ?></a></li>
                            
                            <li class="page-item active" aria-current="page"><span class="page-link"><?php echo $current_page_number+1; ?></span></li>
                            <li class="page-item"><a class="page-link" href="<?php echo $next_page_link ?>"><?php echo $next_page_number+1; ?></a></li>
                            <li class="page-item">
                                <a class="page-link" href="<?php echo $next_page_link ?>" rel="next" aria-label="pagination.next">›</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <!-- END Phân Trang-->
            <div class="mt-4" id="RelativeEstate">
                <h3 class="text-very-large m-0 text-400">
                    BĐS Toàn Quốc
                </h3>
                <div class="mt-3">
                    <ul class="other-estate-by text-300">
                        <?php foreach($city_list as $row): ?>
                            <?php 
                                $name = json_decode($row->name);
                                //$url_of_row = base_url($row->alias.'-city'.$row->id);
                                $url_of_row = base_url('danh-sach-bds-bds-tai-'.create_alias($name).'/?city_id='.$row->id);
                                $image_link = public_url('site/images/no-image.jpg');
                                if(isset($row->image_link) && ($row->image_link !== '')){
                                    $image_link = base_url('upload/city/'.$row->image_link);
                                }
                                $input_total_project            = array();
                                $input_total_project['where']   = array('status' => '0', 'city_id' => $row->id);
                                $total_project = number_format($this->project_model->get_total($input_total_project));
                            ?>
                        <li><a href="<?php echo $url_of_row ?>"><?php echo $name ?> <span class="text-blue">(<?php echo $total_project ?>)</span></a></li>
                        <?php endforeach; ?>
                    </ul>
                    <div class="clear"></div>
                </div>
            </div>

        </div>
    </div>
</div>