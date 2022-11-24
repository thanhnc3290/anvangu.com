<div class="bg-white pb-3 pt-2">
    <div class="container-fluid">
        <div class="crumb-box mt-3">
            <ul class="crumb text-medium crumb-text flex-first">
                <li>
                    <a href="<?php echo base_url('chu-dau-tu') ?>">
                        <span>Doanh nghiệp bất động sản</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="mt-3">
            <div class="form-search-investor">
                <h1 class="m-0 text-very-large text-500 color-name">
                    <?php if(isset($key_search) && ($key_search !== '')): ?>
                    Từ khóa tìm kiếm: "<?php echo $key_search; ?>"
                    <?php else: ?>
                    Danh sách Doanh nghiệp bất động sản
                    <span class="text-blue text-400">(<?php echo number_format($total_list) ?>)</span>
                    <?php endif; ?>
                </h1>

                <form class="search-news-form " action="<?php echo base_url('chu-dau-tu') ?>">
                    <input type="text" name="key_search" id="search-news" placeholder="Tìm doanh nghiệp">
                    <span class="btn-search-toogle btn-orange">
                        <i class="fa fa-search"></i>
                    </span>

                </form>
            </div>
            <div class="mt-3"></div>
            <div class="mt-3">
                <ul class="investor-list">
                    <?php foreach($list as $row): ?>
                        <?php 
                            $name_of_row = json_decode($row->prefix).' '.json_decode($row->name);
                            $url_of_row  = base_url($row->alias.'-cdt'.$row->id);   
                        ?>
                    <li class="investor-item">
                        <a href="<?php echo $url_of_row ?>"><?php echo $name_of_row ?></a>
                    </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        
                        <!-- Phân Trang-->
                        <?php 
                            //url hiện tại
                            $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]"; 

                            //kiểm tra có đang query hay không
                            $query_pagination = '?&phan_trang=';
                            if($query_key_search !== ''){ //đang query
                                $query_pagination = '&phan_trang=';
                            }

                            //lấy url Gốc Không Phân Trang
                            $current_url_with_out_pagination = str_replace(array('?&phan_trang='.$query_phan_trang,'&phan_trang='.$query_phan_trang),'',$actual_link);
                            
                            $prev_page_number   = $query_phan_trang - '1';
                            $prev_page_link     = $current_url_with_out_pagination.$query_pagination.$prev_page_number;
                            if($prev_page_number < '0'){
                                $prev_page_link     = $current_url_with_out_pagination.$query_pagination.'0';
                            }
                            
                            $current_page_number    = $query_phan_trang;
                            $current_page_link      = $current_url_with_out_pagination;

                            $next_page_number       = $query_phan_trang + '1';
                            $next_page_link         = $current_url_with_out_pagination.$query_pagination.$next_page_number;
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
</div>