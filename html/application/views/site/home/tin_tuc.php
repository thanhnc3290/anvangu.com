            <div id ="home_tin_tuc">
                
            </div>

            <script>
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                    //Giao diện trên di động
                    document.getElementById("home_tin_tuc").innerHTML = `
                        <div class="row">
                            <div class="col-12">				
                                <h3 class="m-0 mt-5 text-title-group-home">
                                    <a href="<?php echo base_url('tin-tuc') ?>" class="color-name">
                                        Tin nhà đất						
                                    </a>
                                </h3>
                            </div>
                        </div>
                        <div class="mt-4 mb-4 pb-2">			
                            <div class="re-slider no-scrollbar">
                                <?php $count = '0'; ?>
                                <?php foreach($tin_tuc_moi_nhat as $row): ?>
                                    <?php 
                                        ++$count; 
                                        $url_of_row     = base_url($row->alias.'-news'.$row->id);  
                                        $name           = json_decode($row->name);
                                        $meta_desc      = json_decode($row->meta_desc);
                                        $image_of_row   = public_url('site/images/no-image.jpg'); 
                                        if($row->image_link !== ''){
                                            $image_of_row = base_url('upload/news/'.$row->image_link);
                                        }
                                    ?>
                                <div class="item-article-home-first re-slider-item re-slider-article">		
                                    <a class="img" href="<?php echo $url_of_row ?>">
                                        <img src="<?php echo $image_of_row ?>" alt="<?php echo $name ?>">
                                    </a>
                                    <div class="item-art-content mt-2">							
                                        <a class="limit-line limit-line-2 line-26 text-large-s color-name" href="<?php echo $url_of_row ?>">					
                                            <?php echo $name ?>
                                        </a>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    `;
                    
                }else{
                    //Giao diện trên PC
                    document.getElementById("home_tin_tuc").innerHTML = `
                    <div class="row mt-3">
                        <div class="col-12">
                            <h3 class="text-title-group-home m-0 mt-5 mb-4">
                                <a class="text-gray" href="<?php echo base_url('tin-tuc') ?>">Tin nhà đất</a>
                            </h3>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="section-news" id="home_news_list">

                                <?php $count = '0'; ?>
                                <?php foreach($tin_tuc_moi_nhat as $row): ?>
                                    <?php 
                                        ++$count; 
                                        $url_of_row     = base_url($row->alias.'-news'.$row->id);  
                                        $name           = json_decode($row->name);
                                        $meta_desc      = json_decode($row->meta_desc);
                                        $image_of_row   = public_url('site/images/no-image.jpg'); 
                                        if($row->image_link !== ''){
                                            $image_of_row = base_url('upload/news/'.$row->image_link);
                                        }
                                    ?>
                                    <?php if($count == '1'): ?>
                                
                                <div class="item-news featured">
                                    <div class="inner-news">
                                        <div class="thumb-news">
                                            <a class="img" href="<?php echo $url_of_row; ?>">
                                                <img src="<?php echo $image_of_row ?>" alt="<?php echo $name ?>">
                                            </a>
                                        </div>
                                        <div class="content">
                                            <h3 class="title-news">
                                                <a class="limit-line limit-line-2 line-24 text-very-large color-name text-500" href="<?php echo $url_of_row; ?>"><?php echo $name ?></a>
                                            </h3>
                                            <p class="line-24 limit-line limit-line-2 text-100"><?php echo $meta_desc ?></p>
                                        </div>
                                    </div>
                                </div>
                                    <?php else: ?>
                                <div class="item-news">
                                    <div class="inner-news">
                                        <div class="thumb-news">
                                            <a class="img-second" href="<?php echo $url_of_row; ?>">
                                                <img src="<?php echo $image_of_row ?>" alt="<?php echo $name ?>">
                                            </a>
                                        </div>
                                        <h3 class="title-news">
                                            <a class="limit-line limit-line-2 line-24 text-large color-name" href="<?php echo $url_of_row; ?>"><?php echo $name ?></a>
                                        </h3>
                                    </div>
                                </div>

                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                    `;
                }
            </script>

        