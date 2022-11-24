<div class="container-fluid pt-3">
    <div class="display-flex flex-center flex-justify-between">
        <h1 class="mt-2 pt-1 text-title-group-home m-0 mb-3">Giới thiệu tỉnh thành Việt Nam</h1>
    </div>

    <p class="text-400 text-gray">
        Thông tin dân số, diện tích, giá bán nhà đất trung bình và giá nhà đất cho thuê trung bình.
    </p>

    <div class="main-search-product">
        <div class="location-utility-list left-search-product">
            <?php foreach($list as $row): ?>
                <?php 
                    $name_of_row    = json_decode($row->name);
                    $url_of_row     = base_url('danh-sach-bds-bds-tai-'.create_alias($name_of_row).'/?city_id='.$row->id);
                    $image_link     = public_url('site/images/no-image.jpg');
                    if(isset($row->image_link) && ($row->image_link !== '')){
                        $image_link = base_url('upload/city/'.$row->image_link);
                    }

                    $input_total_project            = array();
                    $input_total_project['where']   = array('status' => '0', 'city_id' => $row->id);
                    $total_project = number_format($this->project_model->get_total($input_total_project));
                ?>
            <a class="lo-item" href="<?php echo $url_of_row ?>">
                <img src="<?php echo $image_link ?>" alt="<?php echo $name_of_row ?>" class="lazy">
                <div class="lo-item-name-count">
                    <p class="lo-item-name"><?php echo $name_of_row ?></p>
                    <p class="lo-item-count"><?php echo $total_project ?> tin đăng</p>
                </div>
            </a>
            <?php endforeach; ?>
            
        </div>

        <div class="right-search-product location-right-filter footer_hidden_on_mobile">
            <div class="border rounded p-3 mb-5">
                <p class="text-large-s text-400">Mua bán nhà đất</p>
                <div class="custom-scroll-bar pl-list">
                    <ul>
                        <?php foreach($city_list as $row): ?>
                        <?php 
                            $name_of_row = json_decode($row->name);
                            //$url_of_row = base_url($row->alias.'-city'.$row->id);
                            $url_of_row = base_url('danh-sach-bds-bds-tai-'.create_alias($name_of_row).'/?city_id='.$row->id);
                            $input_total_project            = array();
                            $input_total_project['where']   = array('status' => '0', 'city_id' => $row->id);
                            $total_project = number_format($this->project_model->get_total($input_total_project));
                        ?>
                        <li class="mt-3 mb-3">
                            <a target="_blank" href="<?php echo $url_of_row ?>">
                                <?php echo $name_of_row ?>(<span class="text-blue"><?php echo $total_project ?></span>)
                            </a>
                        </li>
                        <?php endforeach; ?>

                    </ul>
                    <div class="text-center">
							<span class="text-danger cursor show-more-pl text-medium-s">
								<span>Xem thêm</span>
								<i class="fa ml-1 fa-angle-down"></i>
							</span>
						</div>
                </div>
            </div>

        </div>
    </div>

            <!-- Phân Trang-->
            <?php 
                //url hiện tại
                $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 
                //lấy url Gốc Không Phân Trang
                $current_url_with_out_pagination = str_replace(array('?&phan_trang='.$query_phan_trang,'&phan_trang='.$query_phan_trang),'',$actual_link);
                
                $prev_page_number   = $query_phan_trang - '1';
                $prev_page_link     = $current_url_with_out_pagination.'?&phan_trang='.$prev_page_number;
                if($prev_page_number < '0'){
                    $prev_page_link     = $current_url_with_out_pagination.'?&phan_trang=0';
                }
                
                $current_page_number    = $query_phan_trang;
                $current_page_link      = $current_url_with_out_pagination;

                $next_page_number       = $query_phan_trang + '1';
                $next_page_link         = $current_url_with_out_pagination.'?&phan_trang='.$next_page_number;
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
</div>