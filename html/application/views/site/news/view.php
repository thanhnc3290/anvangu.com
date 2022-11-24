	<div id="wrapper" class="wrapper-no-search">
        <?php $this->load->view('site/news/menu_news') ?>
		<?php if($info->catalog_id < '100'): ?>
        <div class="pb-3 pt-3">
			<div class="container-fluid">
				<div class="article-container">
					<div class="left-article-page display-flex">	
						<ul class="crumb text-medium crumb-text flex-first">
							<li><a href="<?php echo base_url('tin-tuc') ?>"><span>Tin tức</span></a></li>
							<?php if($catalog_info['name'] !==''): ?>
							<li><a href="<?php echo $catalog_info['url'] ?>"><span><?php echo $catalog_info['name']; ?></span></a></li>
							<?php endif; ?>
						</ul>
					</div>	
				</div>

				<div class="mt-3">
					<div class="article-container row">
						<div id="news_content" class="left-article-page col-8">	
							<div class="display-flex flex-center flex-justify-between">
								<span class="text-small text-gray text-100">
									<i class="fa fa-clock-o"></i>
									<span>									
										<?php echo get_date($info->update_time) ?>
									</span>
								</span>
								<span class="display-flex flex-center">
									<span class="display-flex flex-center text-gray cursor mr-3 btn-scroll-comment">
										<span title="Bình luận" class="icon-rounded mr-2 ">
											<i class="fa fa-icon-me fa-custom-message"></i>
										</span>
										0
									</span>
									<span title="Lưu tin" data-id="497" class="icon-rounded mr-3 cursor btn-bookmark">
										<i class="fa fa-bookmark-o desktop" id="icon-bookmark-show"></i>
									</span>
									<span title="Chia sẻ" class="icon-rounded cursor btn-share">
										<i class="fa-icon-me fa-custom-icon-share"></i>
									</span>
								</span>	
							</div>

							<div class="mt-3 mb-3">	
								<h1 class="text-title-article m-0 line-32 text-500">
									<?php echo json_decode($info->name); ?>
								</h1>	
								<div class="show-article mt-3">
									<div class="mt-3 line-28 text-300 text-large detail-content">
										<?php echo json_decode($info->content); ?>
									</div>	
								</div>										
							</div>	

						</div>
						<?php $this->load->view('site/news/tin_tuc_noi_bat'); ?>
					</div>						
				</div>

				<div class="mt-4 ad-image ad-image-article-show"></div>
				<div id="tin_tuc_moi_list"></div>
				<script>
					if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
						//giao diện mobile
						document.getElementById("news_content").setAttribute('style','width:100%!important');
						document.getElementById("tin_tuc_moi_list").setAttribute('class','mt-3');
						document.getElementById("tin_tuc_moi_list").innerHTML = `
							<h2 class="m-0 mb-3 text-title-group-home text-500 line-24">Tin mới</h2>
							<div class="re-slider no-scrollbar">
								<?php foreach($tin_tuc_moi_list as $row): ?>
									<?php if($row->id !== $info->id): ?>
										<?php 
											$name_of_row = json_decode($row->name);	
											$url_of_row  = base_url($row->alias.'-news'.$row->id);
											$image_of_row   = public_url('site/images/no-image.jpg');
											if($row->image_link!==''){
												$image_of_row = base_url('upload/news/'.$row->image_link);
											}
										?>
								<div class="re-slider-article re-slider-item">
									<a class="display-grid color-name" href="<?php echo $url_of_row ?>">
										<div>
											<img src="<?php echo $image_of_row ?>" alt="<?php echo $name_of_row ?>" class="rounded">
										</div>
										<div class="mt-2">
											<p class="text-large-s text-400 line-24 limit-line limit-line-2"><?php echo $name_of_row ?></p>
										</div>
									</a>
								</div>
									<?php endif; ?>
								<?php endforeach; ?>

							</div>
						`;
					}else{
						//giao diện pc
						document.getElementById("tin_tuc_moi_list").setAttribute('class','mt-4');
						document.getElementById("tin_tuc_moi_list").innerHTML = `
							<h2 class="m-0 mb-3 text-title-group-home text-500 line-24">Tin mới</h2>
							<div class="mt-4 owl-carousel owl-theme by-category-slider owl-loaded owl-drag" id="other-article">
								<div class="owl-stage-outer">
									<div class="owl-stage" style="transform: translate3d(-1190px, 0px, 0px); transition: all 0s ease 0s; width: 2380px;">
										<?php foreach($tin_tuc_moi_list as $row): ?>
											<?php if($row->id !== $info->id): ?>
											<?php 
												$name_of_row = json_decode($row->name);	
												$url_of_row  = base_url($row->alias.'-news'.$row->id);
												$image_of_row   = public_url('site/images/no-image.jpg');
												if($row->image_link!==''){
													$image_of_row = base_url('upload/news/'.$row->image_link);
												}
											?>
										<div class="owl-item" style="width: 218px; margin-right: 20px;">
											<div class="other-article">
												<a class="color-name" href="<?php echo $url_of_row ?>">
													<img src="<?php echo $image_of_row ?>" alt="<?php echo $name_of_row ?>" class="rounded">
													<p class="mt-3 text-large line-26 limit-line limit-line-2 text-400"><?php echo $name_of_row ?></p>
												</a>
											</div>
										</div>
											<?php endif;?>
										<?php endforeach; ?>
									</div>
								</div>
								<div class="owl-nav">
									<button type="button" role="presentation" class="owl-prev"><span aria-label="Previous">‹</span></button>
									<button type="button" role="presentation" class="owl-next disabled"><span aria-label="Next">›</span></button>
								</div>
								<div class="owl-dots disabled"></div>
							</div>
						`;
					}
				</script>
			</div>

		</div>
		<?php else: ?>
			<div class="menu-news">
				<div class="container-fluid">
					<div class="display-flex flex-center menu-news-overflow">
						<ul class="flex-first">
							<?php 
								$input_relate_news = array();
								$input_relate_news['where'] = array('catalog_id' => $info->catalog_id, 'status' => '0');
								$input_relate_news['order'] = array('id','desc');
								$this->db->select('id, name, alias, meta_desc, image_link');
								$relate_news_list = $this->news_model->get_list($input_relate_news);
							?>

							<?php foreach($relate_news_list as $row): ?>
								<?php 
									$name_of_row = json_decode($row->name);	
									$url_of_row  = base_url($row->alias.'-news'.$row->id);
									$image_of_row   = public_url('site/images/no-image.jpg');
									if($row->image_link!==''){
										$image_of_row = base_url('upload/news/'.$row->image_link);
									}
								?>
								<li><a <?php if($row->id == $info->id): ?>class="current"<?php endif; ?> href="<?php echo $url_of_row ?>"><?php echo $name_of_row ?></a></li>
							<?php endforeach; ?>
						</ul>
					</div>
				</div>
			</div>
			<div class="pb-3 pt-3">
				<div class="container-fluid">
					<div class="mt-3">
						<div class="row-pages">
							<div class="col-pages-left">
								<h1 class="text-title-article m-0 line-32 text-500">
									<?php echo json_decode($info->name); ?>
								</h1>
								<div class="mt-2 detail-content show-page line-28"><?php echo json_decode($info->content); ?></div>											
													
							</div>
							<div class="col-pages-right">
								<div class="menu-right-page">	
								<?php foreach($catalog_news_list as $row): ?>
									<?php if($row['id'] >= '100'): ?>
									<div class="page-item-menu-right">
										<a class="color-name" href="<?php echo $row['url'] ?>">
											<?php echo $row['name'] ?>
										</a>								
									</div>
									<?php endif; ?>
								<?php endforeach; ?>				
									

								</div>
							</div>
						</div>	
					</div>
				</div>
			</div>
		<?php endif; ?>
        <?php $this->load->view('site/footer'); ?>
    </div>