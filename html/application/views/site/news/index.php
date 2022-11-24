<div id="wrapper" class="wrapper-no-search">
    <?php $this->load->view('site/news/menu_news'); ?>
    <div class="pb-3 pt-3">
        <div class="container-fluid">
            <ul class="crumb text-medium crumb-text flex-first">
                <li><a href="<?php echo base_url('tin-tuc') ?>"><span>Tin tức</span></a></li>
                <?php if(isset($key_search)): ?>
                <li>Tìm kiếm: <span><?php echo $key_search ?></span></li>
                <?php else: ?>
                    <?php if(isset($id_danh_muc)): ?>
                        <?php foreach($catalog_news_list as $row): ?>
                            <?php if($row['id'] == $id_danh_muc):  ?>
                <li><a href="<?php echo $row['url'] ?>"><span><?php echo $row['name'] ?></span></a></li>
                
                            <?php endif; ?>
                        <?php endforeach; ?>
                        
                    <?php endif; ?>
                <?php endif; ?>
            </ul>
            <br/>
            <?php if(isset($id_danh_muc)): ?>
                <?php foreach($catalog_news_list as $row): ?>
                    <?php if($row['id'] == $id_danh_muc):  ?>               
            <h1 class="text-title-group-home m-0 mb-3 color-name flex-first text-500"><?php echo $row['name'] ?></h1>
                    <?php endif; ?>
                <?php endforeach; ?>
            <?php endif; ?>
            <div id="news_list">
                
            </div>
        </div>
    </div>
 
    
    <script>
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            document.getElementById("news_list").setAttribute('class','mt-3');
            document.getElementById("news_list").innerHTML = `
                <div class="row">
                    <div class="col-8">
                        <div class="article-type-item mb-3">
                            <?php foreach($list as $row): ?>
                                        <?php 
                                            $name_of_row = json_decode($row->name);
                                            $url_of_row  = base_url($row->alias.'-news'.$row->id);
                                            $desc_of_row = json_decode($row->meta_desc);
                                            $image_of_row   = public_url('site/images/no-image.jpg');
                                            if($row->image_link!==''){
                                                $image_of_row = base_url('upload/news/'.$row->image_link);
                                            }   
                                        ?>
                                <div class="item-article-mobile mb-3 border-bottom pb-3">
									<a class="text-large line-24 color-name text-500" href="<?php echo $url_of_row?>"><?php echo $name_of_row?></a>
									
									<div class="item-article-mobile-img-content mt-3">
										<a href="<?php echo $url_of_row?>">
                                            <img src="<?php echo $image_of_row ?>" alt="<?php echo $name_of_row?>" class="article-image-item-mobile rounded">
                                        </a>
										<div class="article-item-content-mobile">
											<div class="line-26 text-300 limit-line limit-line-4 text-gray"><?php echo $desc_of_row?></div>
										</div>
									</div>
								</div>
                            <?php endforeach;?>
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
                            <div class="mt-2 mb-4">
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
                    <?php $this->load->view('site/news/tin_tuc_noi_bat'); ?>
                </div>
            `;
        }else{
            <?php if($check_page > '0'): // trang danh mục hoặc tin tức?>
            document.getElementById("news_list").setAttribute('class','');
            document.getElementById("news_list").innerHTML = `
                <div class="article-container">
                        <div id="tin-tuc-list" class="left-article-page">
                            <div class="article-type-item mb-3">
                                <ul class="ul-list-new-home">

                                    <?php foreach($list as $row): ?>
                                        <?php 
                                            $name_of_row = json_decode($row->name);
                                            $url_of_row  = base_url($row->alias.'-news'.$row->id);
                                            $desc_of_row = json_decode($row->meta_desc);
                                            $image_of_row   = public_url('site/images/no-image.jpg');
                                            if($row->image_link!==''){
                                                $image_of_row = base_url('upload/news/'.$row->image_link);
                                            }   
                                        ?>
                                    <li >
                                        <div class="left-ul-list-item">
                                            <a class="text-large line-26 text-500 color-name" href="<?php echo $url_of_row ?>"><?php echo $name_of_row ?></a>
                                            <div class="mt-2 text-gray line-24 text-100 limit-line limit-line-2"><?php echo $desc_of_row ?></div>
                                        </div>
                                        <div>
                                            <a class="display-flex" href="<?php echo $url_of_row ?>">
                                                <img src="<?php echo $image_of_row ?>" alt="<?php echo $name_of_row ?>" class="article-image-item-second">
                                            </a>
                                        </div>
                                        <p></p>
                                    </li>

                                    

                                    <?php endforeach; ?>

                                </ul>
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

                        <?php $this->load->view('site/news/tin_tuc_noi_bat'); ?>
                    </div>
            `;
            <?php else: // trang index?>
            document.getElementById("news_list").setAttribute('class','mt-4');
            document.getElementById("news_list").innerHTML = `
                <div class="article-container">
					<div class="left-article-page">
                        <?php foreach($catalog_news_list as $cat): ?>
                            <?php if($cat['id'] < '100'): ?>
                        <div class="article-type-item mb-5">
                            <div class="display-flex mb-3">	
                                <h1 class="text-title-group-home m-0 flex-first text-500">
                                    <a class="color-name" href="<?php echo $cat['url'] ?>"><?php echo $cat['name'] ?></a>
                                </h1>
                            </div>
                            <?php 
                                $input_news_of_cat = array();
                                $input_news_of_cat['where'] = array('status' => '0','catalog_id' => $cat['id']);
                                $input_news_of_cat['order'] = array('id','desc');
                                $input_news_of_cat['limit'] = array('3','0');
                                $this->db->select('id, name, alias, meta_desc, image_link');
                                $news_list_of_cat = $this->news_model->get_list($input_news_of_cat);
                                $count_news_of_cat = '0';

                                //print_r($news_list_of_cat);
                            ?>
                            
                            <div class="mt-2 mb-4">
                                <?php foreach($news_list_of_cat as $row): ?>
                                    <?php 
                                        $name_of_row = json_decode($row->name);
                                        $url_of_row  = base_url($row->alias.'-news'.$row->id);
                                        $desc_of_row = json_decode($row->meta_desc);
                                        $image_of_row   = public_url('site/images/no-image.jpg');
                                        if($row->image_link!==''){
                                            $image_of_row = base_url('upload/news/'.$row->image_link);
                                        }  
                                        $count_news_of_cat++; 
                                    ?>
                                    <?php if($count_news_of_cat == '1'):?>
                                        <div class="display-flex">	
                                            <div class="item-article-first w-full">
                                                <a class="display-flex" href="<?php echo $url_of_row ?>">	
                                                    <img src="<?php echo $image_of_row ?>" alt="<?php echo $name_of_row ?>" class="article-image-item-first">
                                                </a>
                                                <div class="article-item-content bg-gray-opacity pt-3 pr-3 pb-2 w-full">
                                                    <a class="text-large color-name line-28 limit-line limit-line-3 text-500" href="<?php echo $url_of_row ?>">
                                                        <?php echo $name_of_row ?>
                                                    </a>
                                                    <div class="mt-2 text-gray line-24 text-100 limit-line limit-line-4">
                                                        <?php echo $desc_of_row ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <ul class="ul-list-new-home">
                                            <li>
                                                <div class="left-ul-list-item">
                                                    <a class="text-large line-26 text-500 color-name" href="<?php echo $url_of_row ?>">
                                                        <?php echo $name_of_row ?>
                                                    </a>
                                                    <div class="mt-2 text-gray line-24 text-100 limit-line limit-line-2"><?php echo $desc_of_row ?></div>
                                                </div>
                                                <div>
                                                    <a class="display-flex" href="<?php echo $url_of_row ?>">
                                                        <img src="<?php echo $image_of_row ?>" alt="<?php echo $name_of_row ?>" class="article-image-item-second">
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    <?php endif;?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                            <?php endif; ?>
                        <?php endforeach; ?>

                    </div>

					<?php $this->load->view('site/news/tin_tuc_noi_bat'); ?>
				</div>
            `;
            <?php endif; ?>
        }
    </script>
    
    
    <?php $this->load->view('site/footer'); ?>
</div>