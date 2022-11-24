            <div class="row mb-4">
                <div class="col-12 ">
                    <div class="mb-3">
                        <h4 class="m-0 mt-3 display-flex flex-center text-title-group-home">
                            <a href="<?php echo base_url('#') ?>" class="text-gray">
                                Doanh nghiệp nổi bật
                            </a>
                        </h4>
                    </div>
                    <div class="mt-2" id="danh-sach-chu-dau-tu"></div>
                </div>
            </div>
            

            <script>
                if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                    //Giao diện mobile
                    document.getElementById("danh-sach-chu-dau-tu").innerHTML = `
                        <div class="re-slider no-scrollbar">
                            <?php foreach($danh_sach_chu_dau_tu as $row): ?>
                                <?php 
                                    $name           = json_decode($row->prefix).' '.json_decode($row->name);
                                    $url_of_row     = base_url($row->alias.'-cdt'.$row->id);    
                                    $image_of_row   = public_url('site/images/no-image.jpg');
                                    if($row->image_link!==''){
                                        $image_of_row = base_url('upload/chu_dau_tu/'.$row->image_link);
                                    }
                                    $tota_project   = number_format($row->total_project);
                                ?>
                            <a href="<?php echo $url_of_row ?>">					
								<div class="item-investor-home border rounded re-slider-investor">
									<div class="item-investor-home-image">
                                        <img src="<?php echo $image_of_row ?>" alt="<?php echo $name ?>">
									</div>
									<div class="p-2 bg-gray-opacity display-flex flex-center">
										<i class="fa fa-icon-me fa-u-noname-1 mr-1"></i>
										<span><?php echo $tota_project ?> dự án</span>
									</div>
								</div>
							</a>
                            <?php endforeach; ?>
					    </div>
                    `;
                }else{
                    //giao diện pc
                    document.getElementById("danh-sach-chu-dau-tu").innerHTML = `
                         <div id="investors-slider-home" class='by-category-slider owl-carousel owl-theme owl-has-dot'>
                            <?php foreach($danh_sach_chu_dau_tu as $row): ?>
                                <?php 
                                    $name           = json_decode($row->prefix).' '.json_decode($row->name);
                                    $url_of_row     = base_url($row->alias.'-cdt'.$row->id);    
                                    $image_of_row   = public_url('site/images/no-image.jpg');
                                    if($row->image_link!==''){
                                        $image_of_row = base_url('upload/chu_dau_tu/'.$row->image_link);
                                    }
                                    $tota_project   = number_format($row->total_project);
                                ?>
                            <a href="<?php echo $url_of_row ?>" target="_blank">
                                <div class="item-investor-home border rounded">
                                    <div class="item-investor-home-image">
                                        <img src="<?php echo $image_of_row ?>" alt="<?php echo $name ?>">
                                    </div>
                                    <div class="p-2  bg-gray-opacity display-flex flex-center">
                                        <i class="fa fa-icon-me fa-u-noname-1 mr-1"></i>
                                        <span><?php echo $tota_project ?> dự án</span>
                                    </div>
                                </div>
                            </a>
                            <?php endforeach; ?>
                        </div>
                    `;
                }
            </script>