                        <div class="right-article-page col-4">					
							<div class="inner-article-right-page">
								<div class="box-article-popular">
									<h2 class="m-0 mb-3 text-title-group-home text-500 line-24">Tin nổi bật</h2>
									<?php foreach($tin_tuc_noi_bat_list as $row): ?>
										<?php 
											$name_of_row = json_decode($row->name);	
											$url_of_row  = base_url($row->alias.'-news'.$row->id);
											$image_of_row   = public_url('site/images/no-image.jpg');
											if($row->image_link!==''){
												$image_of_row = base_url('upload/news/'.$row->image_link);
											}
										?>
									<div class="popular-article mb-5">
										<a class="display-flex color-name" href="<?php echo $url_of_row ?>">
											<div>
												<img src="<?php echo $image_of_row ?>" alt="<?php echo $name_of_row ?>" class="rounded">
											</div>
											<div>
												<p class="text-large text-500 line-24 limit-line limit-line-3"><?php echo $name_of_row ?></p>
											</div>
										</a>
									</div>
									<?php endforeach; ?>

								</div>
							</div>
						</div>