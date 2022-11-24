<div class="footer" id="FooterApp">
    <div class="container-fluid pb-2  div-relative bg-white text-gray">
        <div class="border-top pt-4"></div>
        <div class="row">
            <div class="col-6 col-left-info-footer">
                <div class="logo-footer">
                    <img src = "<?php echo $data_site_info['logo_image_link']  ?>" alt="<?php echo $data_site_info['site_title'] ?>"/>
                </div>
                <div class="mt-4 mb-2">
                    <?php echo $data_site_info['site_title'] ?>
                </div>
                <div class="mt-3">
                    MSDN: <?php echo $data_site_info['ma_so_thue'] ?>
                </div>

                <div class="mt-3 mb-2 display-flex flex-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                    </svg>
                    <?php echo $data_site_info['dia_chi'] ?>
                </div>
                <p class="mb-2 pt-1 display-flex flex-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <?php echo $data_site_info['hotline'] ?>
                </p>
                <p class="mb-2 pt-1 display-flex flex-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                    </svg>
                    <?php echo $data_site_info['email'] ?>
                </p>
                
                <div class="mt-3 display-flex flex-center pl-1">
                    <p class="text-medium-s mr-3 footer_hidden_on_mobile">Kết nối với chúng tôi</p>
                    <ul class="blog-item-social display-flex">
                        <li>
                            <a rel="noreferrer" class="item" title="" target="_blank" href="<?php echo $data_site_info['facebook'] ?>">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>

                        <li>
                            <a rel="noreferrer" class="item" title="" target="_blank" href="<?php echo $data_site_info['twitter'] ?>">
                                <i class="fa fa-twitter-square"></i>
                            </a>
                        </li>
                        <li>
                            <a rel="noreferrer" class="item" title="" target="_blank" href="<?php echo $data_site_info['youtube'] ?>">
                                <i class="fa fa-youtube"></i>
                            </a>
                        </li>
                        <li>
                            <a rel="noreferrer" class="item" title="" target="_blank" href="<?php echo $data_site_info['linkedin'] ?>">
                                <i class="fa fa-linkedin-square"></i>
                            </a>
                        </li>
                        <li>
                            <a rel="noreferrer" class="item" title="" target="_blank" href="<?php echo $data_site_info['instagram'] ?>">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
                        <li>
                            <a rel="noreferrer" class="item" title="" target="_blank" href="<?php echo $data_site_info['pinterest'] ?>">
                                <i class="fa fa-pinterest"></i>
                            </a>
                        </li>
                    </ul>

                </div>
            </div>
            <div class="col-6 footer_hidden_on_mobile">
                <ul class="footer-link">
                    <?php foreach($catalog_news_list as $cat): ?>
                        <?php if($cat['id'] >= '100'): ?>
                    <li class="ul-title">
                        <span><?php echo $cat['name'] ?></span>
                        <ul>
                            <?php 
                                $input_news_of_cat = array();
                                $input_news_of_cat['where'] = array('status' => '0','catalog_id' => $cat['id']);
                                $input_news_of_cat['order'] = array('id','desc');
                                $this->db->select('id, name, alias, meta_desc, image_link');
                                $news_list_of_cat = $this->news_model->get_list($input_news_of_cat);
                            ?>
                            <?php foreach($news_list_of_cat as $row): ?>
                                    <?php 
                                        $name_of_row = json_decode($row->name);
                                        $url_of_row  = base_url($row->alias.'-news'.$row->id);
                                        $desc_of_row = json_decode($row->meta_desc);
                                        $image_of_row   = public_url('site/images/no-image.jpg');
                                        if($row->image_link!==''){
                                            $image_of_row = base_url('upload/news/'.$row->image_link);
                                        }  
                                    ?>
                            <li>
                                <a href="<?php echo $url_of_row ?>">
                                    <?php echo $name_of_row ?>
                                </a>
                            </li>
                            <?php endforeach; ?>


                        </ul>
                    </li>
                        <?php endif; ?>
                    <?php endforeach; ?>

                </ul>
            </div>
        </div>
        <div class="mt-3"></div>

    </div>


         
</div>