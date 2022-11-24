<div id="danh-sach-khu-vuc">
    
</div>



<script>
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        //giao diện Mobile
        document.getElementById("danh-sach-khu-vuc").innerHTML = `
            <div class="re-slider-container mb-3">
                <h1 class="text-title-group-home m-0 mt-5 mb-4 text-gray">
                    <a href="<?php echo base_url('khu-vuc') ?>" class="text-gray">Nhà đất theo địa điểm</a>
                </h1>
                
                <div id="re-slider" class="re-slider no-scrollbar">
                    <?php $count_city = '0'; ?>
                    <?php foreach($city_list as $row): ?>
                                    <?php 
                                        $count_city++;
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
                                    <?php if($count_city == '1'): ?>
                        <div class="re-slider-item">
                            <div class="re-li-div">
                                <a href="<?php echo $url_of_row ?>" target="_blank" class="re-first-slider">
                                    <div class="re-name-and-count">
                                        <span class="re-name"><?php echo $name ?></span>
                                        <span class="re-count"><?php echo $total_project ?> tin đăng</span>
                                    </div>
                                    <img src="<?php echo $image_link ?>">
                                </a>
                            </div>
                        </div>
                                    <?php else: ?>
                                        <?php if($count_city == '2'): ?>
                    <div class="re-slider-item">
                        <div class="re-li-div re-grid">
                            <div>
                                <a href="<?php echo $url_of_row ?>" target="_blank" class="re-second-slider">
                                    <div class="re-name-and-count">
                                        <span class="re-name"><?php echo $name ?></span>
                                        <span class="re-count"><?php echo $total_project ?> tin đăng</span>
                                    </div>
                                    <img src="<?php echo $image_link ?>">
                                </a>
                            </div>
                                        <?php endif; ?>
                                        <?php if($count_city == '3'): ?>
                            <div>
                                <a href="<?php echo $url_of_row ?>" target="_blank" class="re-second-slider">
                                    <div class="re-name-and-count">
                                        <span class="re-name"><?php echo $name ?></span>
                                        <span class="re-count"><?php echo $total_project ?> tin đăng</span>
                                    </div>
                                    <img src="<?php echo $image_link ?>">
                                </a>
                            </div>
                        </div>
                    </div> 
                                        <?php $count_city = '0'; ?>
                                        <?php endif; ?>
                                    <?php endif; ?>
                    <?php endforeach; ?>
                    <?php if($count_city == '2'): //Đóng thẻ nếu chuỗi city_list dừng lại ở $count_city = '2' ?>
                                    
                            </div>
                        </div>
                    </div>  
                    <?php endif; ?>   
                </div>
        `;
    }else{
        //giao diện PC
        document.getElementById("danh-sach-khu-vuc").innerHTML = `
            <div class="re-slider-container mb-4">
                <h1 class="text-title-group-home m-0 mt-5 mb-4 text-gray">
                    <a href="<?php echo base_url('khu-vuc') ?>" class="text-gray">Nhà đất theo địa điểm</a>
                </h1>
                <div id="re-slider" class="re-slider by-category-slider owl-carousel owl-theme owl-has-dot owl-loaded owl-drag mixedSlider_5">
                    <div class="owl-stage-outer">
                        <div class="owl-stage MS-content">
                            <?php $count_city = '0'; ?>
                            <?php foreach($city_list as $row): ?>
                                <?php 
                                    $count_city++;
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
                                <?php if($count_city == '1'): ?>
                            <div class=" item owl-item" style="width: 218px; margin-right: 20px;">
                                <div class="re-slider-item">
                                    <div class="re-li-div">
                                        <a href="<?php echo $url_of_row ?>" target="_blank" class="re-first-slider">
                                            <div class="re-name-and-count">
                                                <span class="re-name"><?php echo $name ?></span>
                                                <span class="re-count"><?php echo $total_project ?> tin đăng</span>
                                            </div>
                                            <img src="<?php echo $image_link ?>">
                                        </a>
                                    </div>
                                </div>
                            </div>
                                <?php else: ?>
                                    <?php if($count_city == '2'): ?>
                            <div class=" item owl-item" style="width: 218px; margin-right: 20px;">
                                <div class="re-slider-item">
                                    <div class="re-li-div re-grid">
                                        <div>
                                            <a href="<?php echo $url_of_row ?>" target="_blank" class="re-second-slider">
                                                <div class="re-name-and-count">
                                                    <span class="re-name"><?php echo $name ?></span>
                                                    <span class="re-count"><?php echo $total_project ?> tin đăng</span>
                                                </div>
                                                <img src="<?php echo $image_link ?>">
                                            </a>
                                        </div>
                                        <?php endif; ?>
                                    <?php if($count_city == '3'): ?>
                                        <div>
                                            <a href="<?php echo $url_of_row ?>" target="_blank" class="re-second-slider">
                                                <div class="re-name-and-count">
                                                    <span class="re-name"><?php echo $name ?></span>
                                                    <span class="re-count"><?php echo $total_project ?> tin đăng</span>
                                                </div>
                                                <img src="<?php echo $image_link ?>">
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>  
                                        <?php $count_city = '0'; ?>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endforeach; ?>
                            <?php if($count_city == '2'): //Đóng thẻ nếu chuỗi city_list dừng lại ở $count_city = '2' ?>
                                
                                    </div>
                                </div>
                            </div>  
                            <?php endif; ?>
                            
                        </div>
                    </div>
                    <div class="owl-nav MS-controls">
                        <button type="button" role="presentation" class="owl-prev MS-left"  style="display:block!important;display: block!important;background: #fff!important;border: 1px solid #ccc!important;border-radius: 50%;font: normal normal normal 14px/1 FontAwesome!important;height: 35px;transform: inherit;width: 35px;"><span aria-label="Previous">‹</span></button>
                        <button type="button" role="presentation" class="owl-next MS-right" style="display:block!important;display: block!important;background: #fff!important;border: 1px solid #ccc!important;border-radius: 50%;font: normal normal normal 14px/1 FontAwesome!important;height: 35px;transform: inherit;width: 35px;"><span aria-label="Next">›</span></button>
                    </div>
                    <div class="owl-dots disabled"></div>
                </div>
            </div>
        `;
        $('.mixedSlider_5').multislider({
            duration: 750, //750
            interval: 50000 //50000
        });
    }
    
</script>
