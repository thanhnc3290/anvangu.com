<div class="menu-news">
	<div class="container-fluid">
		<div class="div-relative scroll-container">
			<div class="scroll-content menu-news-overflow">
				<div class="display-flex flex-center menu-news-overflow-children">
					<ul class="flex-first">
				
						
						<li class="icon-home-menu-news">
							<a class="home" href="<?php echo base_url('tin-tuc') ?>">				
								<svg xmlns="http://www.w3.org/2000/svg" height="24" viewBox="0 0 24 24" width="24"><path d="M0 0h24v24H0z" fill="none"></path><path d="M10 20v-6h4v6h5v-8h3L12 3 2 12h3v8z"></path></svg>
							</a>
						</li>
						<?php foreach($catalog_news_list as $row): ?>
							<?php if($row['id'] < '100'): ?>
							<?php if(isset($info) && ($info->catalog_id == $row['id'])){$current = 'current';}else{$current = '';} ?>
                        <li><a class="<?php echo $current ?>" href="<?php echo $row['url']; ?>"><?php echo $row['name']; ?></a></li>
							<?php endif; ?>
						<?php endforeach; ?>
									
						
					</ul>
					<div class="search-box-right">
						<form class="search-news-form" action="<?php echo base_url('tin-tuc') ?>">
							<input type="text" name="key_search" id="search-news" placeholder="Tìm tin tức">
							<span class="btn-search-toogle btn-orange">
								<i class="fa fa-search"></i>
							</span>
						</form>
					</div>
				</div>
			</div>
			<span class="next-mask-btn">
				
			</span>
			<span class="prev-mask-btn">
				
			</span>
		</div>
	</div>
</div>