<div class="header-wrap main-header">
    <div class="header-top">
        <div id="main_header" class="container-fluid container-fluid-header"></div>
    </div>
</div>
<div id="menu_mobile" class="menu-bars-overlay"></div>
<!--Search Form Mobile-->
<div class="search-suggest-mobile" id="SearchMobile"></div>
<!--Search Form Mobile-->

<script>
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
        //mobile - tablet
        let header = document.getElementById("main_header");
        header.innerHTML = `
        <div class="header-row display-flex">
            <div class="header-logo header-logo-app2 mr-3 flex-first display-flex flex-center">
                <a href="<?php echo base_url() ?>" class="display-flex mr-3">
                    <img src = "<?php echo $data_site_info['favicon_image_link']  ?>" alt="<?php echo $data_site_info['site_title'] ?>"/>
                </a>
                <div onclick="show_SearchMobile()" class="div-relative show-search-box input-box-search input-box-search-app2">
                    <input class="" disabled="" type="text" name="q" value="" id="search-text-mobile" placeholder="Tìm kiếm địa điểm, khu vực...">
                    <span class="btn-search-mobile btn-search-mobile-app2"><i class="fa fa-search"></i></span>
                    <span class="x show-search-box off"><span aria-label="Xóa"></span></span>
                </div>
            </div>
            <div class="display-flex flex-center">
                <span class="menu-mobile">
                    <i class="fa fa-bars"></i>
                </span>
            </div>
        </div>
        `;

        //Render ra menu
        let menu_mobile = document.getElementById("menu_mobile");
        menu_mobile.innerHTML = `
        <div class="menu-bars">    
            <div class="border-bottom top-menu-bars display-flex flex-center">
                <a href="<?php echo base_url() ?>" class="display-flex flex-center mr-3 flex-first">    
                    <img src = "<?php echo $data_site_info['logo_image_link']  ?>" alt="<?php echo $data_site_info['site_title'] ?>"/>
                </a>
                <span class="close-menu-bars x-close-mini ml-4"></span>
            </div>
            <div class="border-bottom">    
                <div class="text-center pb-3"></div>
            </div>
            <div class="menu-slide">
                <ul class="menu-bars-ul">
                    <li class="bars-root-li bars-box">
                        <span class="display-flex text-large text-gray flex-center ">
                            <a class="flex-first text-large text-gray" href="<?php echo base_url('danh-sach-bds-mua-ban/?loai_hinh_mua_ban_bds=Mua Bán&du_an_status=0') ?>">
                                <span class="display-flex flex-center">
                                    <i class="fa fa-icon-me fa-custom-sale"></i>
                                    <span class="ml-2">Mua Bán</span>
                                </span>
                            </a>
                            <i class="fa fa-angle-down ml-1 bars-root"></i>
                        </span>
                        <ul id="info-project" class="ul-menu-top-child-bars">
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-nha-rieng/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Nhà Riêng&du_an_status=0') ?>">Nhà riêng</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-can-ho/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Căn Hộ&du_an_status=0') ?>">Căn hộ</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-biet-thu/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Biệt Thự&du_an_status=0') ?>">Biệt thự</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-shophouse/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Shophouse&du_an_status=0') ?>">Shop-house</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-penthouse/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Pent-house&du_an_status=0') ?>">Pent-house</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-dat/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Đất Bán&du_an_status=0') ?>">Đất bán</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-dat-nen/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Đất Nền&du_an_status=0') ?>">Đất nền</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-dat-cho-thue/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Đất Cho Thuê&du_an_status=0') ?>">Đất cho thuê</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-office-tel/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Office-tel&du_an_status=0') ?>">Office-tel</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-condotel/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Condotel&du_an_status=0') ?>">Condotel</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-kho-nha-xuong/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Kho, Nhà Xưởng&du_an_status=0') ?>">Kho, nhà xưởng</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-khu-nghi-duong-trang-trai/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Khu Nghỉ Dưỡng, Trang Trại&du_an_status=0') ?>">Khu nghỉ dưỡng, trang trại</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-van-phong/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Văn Phòng&du_an_status=0') ?>">Văn Phòng</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-mat-bang-cua-hang/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Mặt Bằng, Cửa Hàng&du_an_status=0') ?>">Mặt Tiền, Cửa Hàng</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-nha-tro-phong-tro/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Nhà Trọ, Phòng Trọ&du_an_status=0') ?>">Nhà Trọ, Phòng Trọ</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-mua-nha-bds-loai-khac/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=BDS loại khác&du_an_status=0') ?>">Bất động sản khác</a></li>
                        </ul>
                    </li>  
                    <li class="bars-root-li bars-box">
                        <span class="display-flex text-large text-gray flex-center ">
                            <a class="flex-first text-large text-gray" href="<?php echo base_url('danh-sach-bds-cho-thue/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0') ?>">
                                <span class="display-flex flex-center">
                                    <i class="fa fa-icon-me fa-custom-rent"></i>
                                    <span class="ml-2">Cho Thuê</span>
                                </span>
                            </a>
                            <i class="fa fa-angle-down ml-1 bars-root"></i>
                        </span>
                        <ul id="info-project" class="ul-menu-top-child-bars">
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-nha-rieng/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Nhà Riêng') ?>">Nhà riêng</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-can-ho/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Căn Hộ') ?>">Căn hộ</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-biet-thu/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Biệt Thự') ?>">Biệt thự</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-shophouse/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Shophouse') ?>">Shop-house</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-penthouse/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Pent-house') ?>">Pent-house</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-dat-ban/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Đất Bán') ?>">Đất bán</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-dat-nen/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Đất Nền') ?>">Đất nền</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-dat/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Đất Cho Thuê') ?>">Đất cho thuê</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-office-tel/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Office-tel') ?>">Office-tel</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-condotel/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Condotel') ?>">Condotel</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-kho-nha-xuong/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Kho, Nhà Xưởng') ?>">Kho, Nhà Xưởng</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-khu-nghi-duong-trang-trai/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Khu Nghỉ Dưỡng, Trang Trại') ?>">Khu nghỉ dưỡng, trang trại</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-van-phong/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Văn Phòng') ?>">Văn Phòng</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-mat-bang-cua-hang/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Mặt Bằng, Cửa Hàng') ?>">Mặt Tiền, Cửa Hàng</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-nha-tro-phong-tro/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Nhà Trọ, Phòng Trọ') ?>">Nhà Trọ, Phòng Trọ</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-bds-loai-khac/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=BDS loại khác') ?>">Bất động sản khác</a></li>
                        </ul>
                    </li> 
                    <li class="bars-root-li bars-box">
                        <span class="display-flex text-large text-gray flex-center ">
                            <a class="flex-first text-large text-gray" href="<?php echo base_url('danh-sach-bds-du-an/?du_an_status=1') ?>">
                                <span class="display-flex flex-center">
                                    <i class="fa fa-icon-me fa-custom-project"></i>
                                    <span class="ml-2">Dự án</span>
                                </span>
                            </a>
                            <i class="fa fa-angle-down ml-1 bars-root"></i>
                        </span>
                        <ul id="info-project" class="ul-menu-top-child-bars">
                            <li><a href="<?php echo base_url('danh-sach-bds-du-an-nha-pho/?du_an_status=1&loai_hinh_bds=Nhà Riêng') ?>">Nhà phố</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-du-an-can-ho/?du_an_status=1&loai_hinh_bds=Căn Hộ') ?>">Căn hộ</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-du-an-biet-thu/?du_an_status=1&loai_hinh_bds=Biệt Thự') ?>">Biệt thự</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-du-an-shophouse/?du_an_status=1&loai_hinh_bds=Shophouse') ?>">Shophouse</a></li>
                            <li><a href="<?php echo base_url('danh-sach-bds-du-an-dat-nen/?du_an_status=1&loai_hinh_bds=Đất Nền') ?>">Đất nền</a></li>
                        </ul>
                    </li>
                    <li class="bars-root-li bars-box">
                        <span class="display-flex text-large text-gray flex-center ">
                            <a class="flex-first text-large text-gray" href="<?php echo base_url() ?>khu-vuc">
                                <span class="display-flex flex-center">
                                    <i class="fa fa-icon-me fa-custom-pin3"></i>
                                    <span class="ml-2">Khu vực</span>
                                </span>
                            </a>
                        </span>
                    </li>

                    <li class="bars-root-li bars-box">
                        <span class="display-flex text-large text-gray flex-center ">
                            <a class="flex-first text-large text-gray" href="<?php echo base_url() ?>tin-tuc">
                                <span class="display-flex flex-center">
                                    <i class="fa fa-icon-me fa-custom-news"></i>
                                    <span class="ml-2">Tin tức</span>
                                </span>
                            </a> 
                            <i class="fa fa-angle-down ml-1 bars-root"></i>  
                        </span>   
                        <ul id="info-project" class="ul-menu-top-child-bars">
                            <?php foreach($catalog_news_list as $row): ?>
                            <li><a href="<?php echo $row['url']; ?>"><?php echo $row['name']; ?></a></li>
                            <?php endforeach; ?>   
                        </ul>      
                    </li>
                    
                    
                    <li class="bars-root-li">
                        <a class="text-large text-gray" href="tel:<?php echo $data_site_info['hotline'] ?>">
                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path></svg>
                            Hotline: <b class="text-orange"><?php echo $data_site_info['hotline'] ?></b>
                        </a>
                    </li>

                </ul>
            </div>
        </div>
        `;

        //render ra form tìm kiếm -- Mặc định chạy form 1 - mua bán
        render_form_mua_ban_mobile();

        //show hide form tìm kiếm trên mobile
        function show_SearchMobile(){
            let SearchMobile = document.getElementById("SearchMobile");
            SearchMobile.style.display = 'block';
        }
        function hide_SearchMobile(){
            let SearchMobile = document.getElementById("SearchMobile");
            SearchMobile.style.display = 'none';
        }

        //Render ra Form mua bán mobile
        function render_form_mua_ban_mobile(){
            document.getElementById("SearchMobile").innerHTML = `
            <div class="pb-2 search-mobile-box div-relative">
                <div class="search-mobile-box-inner">
                    
                    <div class="search-mobile-box-item item-fixed pt-2">
                        <div class="display-flex flex-center p-2 pl-3 pr-3">
                            <h2 class="text-medium m-0 flex-first text-center">Tìm kiếm bất động sản</h2>
                            <span onclick="hide_SearchMobile()" class="x-close"></span>
                        </div>
                        <div class="type-category-mobile-search">
                            <ul>
                                <li id="select_form_mua_ban_mobile" class="current">Bán</li>
                                <li id="select_form_cho_thue_mobile" class="">Cho thuê</li>
                                <li id="select_form_du_an_mobile" class="">Dự án</li>
                                <!--lua_chon_loai_hinh_mua_ban_bds-->
                                <input id="lua_chon_loai_hinh_mua_ban_bds" value="Mua Bán" style="display:none;"/>
                                <!--end lua_chon_loai_hinh_mua_ban_bds-->
                            </ul>
                        </div>
                    </div>

                    <div class="mt-box" style="margin-top:130px">
                        <!-- loại hình bds-->
                        <div class="search-mobile-box-item mb-3 mr-2 ml-2">
                            <div>
                                <div class="hasValue box-item-popup-search">
                                    <span class="display-flex flex-center div-full showBoxPopup">
                                        <div id="" class="display-grid flex-first">
                                            <span class="label-item">Loại nhà đất</span>
                                            <span  id="lua_chon_loai_hinh_bds" class="box-item-selected-name">Tất Cả</span>
                                        </div>
                                        <!--input loai_hinh_bds-->
                                        <div id="input_loai_hinh_bds" style="display:none;">Tất Cả</div>
                                        <!--END input loai_hinh_bds-->
                                        <i class="text-placeholder fa fa-angle-right"></i>
                                    </span>
                                </div>
                                <div id="danh_sach_loai_hinh_bds" class="popup-fixed off">
                                    <div class="popup-select-fixed-content show">
                                        <div class="display-flex p-2-5 flex-center border-bottom">
                                            <b class="text-center div-full">Loại nhà đất</b>
                                            <span class="x-close-mini"></span>
                                        </div>
                                        <div class="popup-select-fixed-content-body">
                                            <div class="search-mobile-box-item-expand">
                                                <div class="first-title">
                                                    <div class="first-item"><span>Lựa chọn loại hình BĐS</span></div>
                                                </div>
                                                <ul class="ul-filter-child">
                                                    <li class="select-loai-hinh-bds_mobile" rel="Tất Cả"    ><div><span>Tất Cả</span>       <span class="current check-loai-hinh-bds_mobile search-filter-item-radio"><i class="fa fa-circle"></i></span></div></li>
                                                </ul>
                                            </div>
                                            <div class="search-mobile-box-item-expand">
                                                <div class="first-title">
                                                    <div class="first-item"><span>Nhà</span></div>
                                                </div>
                                                <ul class="ul-filter-child">
                                                    <li class="select-loai-hinh-bds_mobile" rel="Nhà Riêng" ><div><span>Nhà riêng</span>     <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Căn Hộ"    ><div><span>Căn hộ</span>        <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Biệt Thự"  ><div><span>Biệt thự</span>      <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Shophouse" ><div><span>Shop-house</span>    <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Pent-house"><div><span>Pent-house</span>    <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Condotel"  ><div><span>Condotel</span>      <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                </ul>
                                            </div>
                                            <div class="search-mobile-box-item-expand">
                                                <div class="first-title">
                                                    <div class="first-item"><span>Đất</span></div>
                                                </div>
                                                <ul class="ul-filter-child">
                                                    <li class="select-loai-hinh-bds_mobile" rel="Đất Bán"       ><div><span>Đất bán</span>       <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Đất Nền"       ><div><span>Đất nền</span>       <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Đất Cho Thuê"  ><div><span>Đất cho thuê</span>  <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                </ul>
                                            </div>
                                            <div class="search-mobile-box-item-expand">
                                                <div class="first-title">
                                                    <div class="first-item"><span>Bất động sản các loại</span></div>
                                                </div>
                                                <ul class="ul-filter-child">
                                                    <li class="select-loai-hinh-bds_mobile" rel="Kho, Nhà Xưởng"                ><div><span>Kho, nhà xưởng</span>                <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Khu Nghỉ Dưỡng, Trang Trại"    ><div><span>Khu nghỉ dưỡng, Trang trại</span>    <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Văn Phòng"                     ><div><span>Văn phòng</span>                     <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Mặt Bằng, Cửa Hàng"            ><div><span>Mặt bằng, Cửa hàng</span>            <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Nhà Trọ, Phòng Trọ"            ><div><span>Nhà trọ, Phòng trọ</span>            <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="BDS loại khác"                 ><div><span>BDS loại khác</span>                 <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="popup-overlay"></div>
                                </div>
                            </div>
                        </div>
                        <!--end loại hình bds-->
                    </div>

                    <!-- location city-->
                        <div class="mt-4">
                            <div class="search-mobile-box-item mb-3 mr-2 ml-2">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">Tỉnh / Thành</span>
                                                <span id="lua_chon_city_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_city_bds" style="display:none;"></div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_city_bds" class="popup-fixed off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">Tỉnh / Thành</b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div class="p-2 mt-2">
                                                    <input id="search_city_mobile" onkeyup="search_city_mobile()" class="form-control mb-0" placeholder="Tìm kiếm">
                                                </div>
                                                <div id="city_mobile_list">
                                                    <div rel="" class="select-city-bds_mobile border-bottom item-popup-select p-2-5 current"><span>Tất Cả</span></div>
                                                    <?php foreach($city_list as $row): ?>
                                                        <?php $city_name = json_decode($row->name); ?>
                                                    <div rel="<?php echo $row->id; ?>" class="select-city-bds_mobile border-bottom item-popup-select p-2-5"><span><?php echo $city_name; ?></span></div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- end location city -->
                    
                    <!--location quận /huyện-->
                        <div class="mt-4">
                            <div id="select_districts" class="disabled-selected-item search-mobile-box-item mb-3 mr-2 ml-2">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">TP / Quận / Huyện</span>
                                                <span id="lua_chon_district_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_district_bds" style="display:none;"></div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_district_bds" class="popup-fixed display_none_important off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">TP / Quận / Huyện</b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div class="p-2 mt-2">
                                                    <input id="search_district_mobile" onkeyup="search_district_mobile()" class="form-control mb-0" placeholder="Tìm kiếm">
                                                </div>
                                                <div id="district_mobile_list">
                                                    <div rel="" class="select-district-bds_mobile border-bottom item-popup-select p-2-5 current"><span>Tất cả</span></div>
                                                    <?php 
                                                        $input = array();
                                                        $input['order'] = array('name','grade');
                                                        $this->db->select('id, name, city_id');
                                                        $district_list_search_mobile = $this->districts_model->get_list($input);
                                                    ?>
                                                    <?php foreach($district_list_search_mobile as $row): ?>
                                                    <div rel="<?php echo $row->id ?>" class="select-district-bds_mobile city_id<?php echo $row->city_id ?> district_list display_none_important border-bottom item-popup-select p-2-5"><span><?php echo json_decode($row->name); ?></span></div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- end location quận /huyện -->

                    <!-- Khoảng Giá -->
                        <div class="search-mobile-box-item mt-4 mr-2 ml-2">
                            <div class="list-category-search">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">Khoảng giá</span>
                                                <span id="lua_chon_khoang_gia_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_khoang_gia_bds" style="display:none;">Tất Cả</div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_khoang_gia_bds" class="popup-fixed off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">Khoảng giá</b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div rel="Tất Cả"                       class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5 current">Tất cả</div>
                                                <div rel="Đến 500 triệu"                class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>< 500 triệu</span></div>
                                                <div rel="Từ 500 - Đến 800 triệu"       class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>500 - 800 triệu</span></div>
                                                <div rel="Từ 800 triệu - Đến 1 tỷ"      class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>800 triệu - 1 tỷ</span></div>
                                                <div rel="Từ 1 tỷ - Đến 2 tỷ"           class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>1 - 2 tỷ</span></div>
                                                <div rel="Từ 2 tỷ - Đến 3 tỷ"           class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>2 - 3 tỷ</span></div>
                                                <div rel="Từ 3 tỷ - Đến 5 tỷ"           class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>3 - 5 tỷ</span></div>
                                                <div rel="Từ 5 tỷ - Đến 7 tỷ"           class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>5 - 7 tỷ</span></div>
                                                <div rel="Từ 7 tỷ - Đến 10 tỷ"          class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>7 - 10 tỷ</span></div>
                                                <div rel="Từ 10 tỷ - Đến 20 tỷ"         class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>10 - 20 tỷ</span></div>
                                                <div rel="Từ 20 tỷ - Đến 30 tỷ"         class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>20 - 30 tỷ</span></div>
                                                <div rel="Từ 30 tỷ - Đến 50 tỷ"         class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>30 - 50 tỷ</span></div>
                                                <div rel="Từ 50 tỷ"                     class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>> 50 tỷ</span></div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- END Khoảng Giá -->

                    <!--Diện Tích-->
                        <div class="search-mobile-box-item mt-4 mr-2 ml-2">
                            <div class="list-category-search">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">Diện tích</span>
                                                <span id="lua_chon_dien_tich_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_dien_tich_bds" style="display:none;">Tất Cả</div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_dien_tich_bds" class="popup-fixed off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">Diện tích <span class="text-100">(m2)</span></b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div rel="Tất Cả"                   class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5 current">Tất cả</div>
                                                <div rel="Đến 30 m²"                class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5"><span>< 30 m²</span></div>
                                                <div rel="Từ 30 m² - Đến 50 m²"     class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5"><span>30 - 50 m²</span></div>
                                                <div rel="Từ 50 m² - Đến 80 m²"     class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5"><span>50 - 80 m²</span></div>
                                                <div rel="Từ 80 m² - Đến 100 m²"    class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5"><span>80 - 100 m²</span></div>
                                                <div rel="Từ 100 m² - Đến 300 m²"   class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5"><span>100 - 300 m²</span></div>
                                                <div rel="Từ 300 m² - Đến 500 m²"   class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5"><span>300 - 500 m²</span></div>
                                                <div rel="Từ 500 m²"                class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5"><span>> 500 m²</span></div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--END Diện Tích-->

                    <!--Hướng Nhà -->
                        <div class="search-mobile-box-item mt-4 mr-2 ml-2">
                            <div class="list-category-search">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">Hướng</span>
                                                <span id="lua_chon_huong_nha_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_huong_nha_bds" style="display:none;">Tất Cả</div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_huong_nha_bds" class="popup-fixed off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">Hướng </b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div rel="Tất Cả"   class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5 current">Tất cả</div>
                                                <div rel="Đông"     class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Đông</span></div>
                                                <div rel="Tây"      class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Tây</span></div>
                                                <div rel="Nam"      class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Nam</span></div>
                                                <div rel="Bắc"      class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Bắc</span></div>
                                                <div rel="Đông Bắc" class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Đông Bắc</span></div>
                                                <div rel="Đông Nam" class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Đông Nam</span></div>
                                                <div rel="Tây Bắc"  class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Tây Bắc</span></div>
                                                <div rel="Tây Nam"  class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Tây Nam</span></div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--END Hướng Nhà-->

                    <!-- Vị Trí BDS-->
                        <div class="search-mobile-box-item mt-4 mr-2 ml-2">
                            <div class="list-category-search">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">Vị trí</span>
                                                <span id="lua_chon_vi_tri_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_vi_tri_bds" style="display:none;">Tất Cả</div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_vi_tri_bds" class="popup-fixed off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">Vị trí </b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div rel="Tất Cả"       class="select-vi-tri-bds_mobile border-bottom item-popup-select p-2-5 current">Tất Cả</div>
                                                <div rel="Mặt Hẻm"      class="select-vi-tri-bds_mobile border-bottom item-popup-select p-2-5"><span>Mặt Hẻm</span></div>
                                                <div rel="Mặt Tiền"     class="select-vi-tri-bds_mobile border-bottom item-popup-select p-2-5"><span>Mặt Tiền</span></div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- END Vị trí BDS-->
                    <div class="btn-box-search-mobile">
                        <span id="clear_input_search_mobile" class="btn-clear-search-mobile"><i class="fa fa-refresh mr-2"></i>Xóa bộ lọc</span>
                        <a id="button_search_mobile" class="btn-apply-search-mobile" style="color:white;"><i class="fa fa-search mr-2"></i>Áp dụng</a>
                    </div>
                </div>
            </div>
            `;

            jquery_search_mua_ban_mobile();
        }
        //Jquery Form Mua Bán mobile
        function jquery_search_mua_ban_mobile(){
            console.log('mua bán');

            //select form & lựa chọn loại hình mua ban bds
            $("#select_form_mua_ban_mobile").click(function(){
                render_form_mua_ban_mobile();
                create_url_to_search_mua_ban_mobile();
            });

            $("#select_form_cho_thue_mobile").click(function(){
                render_form_cho_thue_mobile();
                create_url_to_search_cho_thue_mobile();
            });

            $("#select_form_du_an_mobile").click(function(){
                render_form_du_an_mobile();
                create_url_to_search_du_an_mobile();
            });

            //loại hình bds
            $("#lua_chon_loai_hinh_bds").click(function(){
                $("#danh_sach_loai_hinh_bds").removeClass("off");
            });

            $(".select-loai-hinh-bds_mobile").click(function(evt){
                $("#danh_sach_loai_hinh_bds").addClass("off");
                var value = $(this).attr('rel');

                $(".check-loai-hinh-bds_mobile").html("");
                $(".check-loai-hinh-bds_mobile").removeClass("current");
                $(this).html('<div><span>' +value+'</span><span class="check-loai-hinh-bds_mobile current search-filter-item-radio"><i class="fa fa-circle"></i></span></div>');
                
                $("#lua_chon_loai_hinh_bds").html(value);
                $("#input_loai_hinh_bds").html(value);
                create_url_to_search_mua_ban_mobile();
            });

            //location city
            $("#lua_chon_city_bds").click(function(){
                $("#danh_sach_city_bds").removeClass("off");
            });

            $(".select-city-bds_mobile").click(function(evt){
                $("#danh_sach_city_bds").addClass("off");
                $(".select-city-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                if(value > '0'){ // không phải chọn tất cả
                    active_district_select();

                    //ẩn các quận / huyện của thành phố khác và hiển thị các quận của thành phố được chọn
                    var city_id = '.city_id' + value; //set class để hiển thị
                    
                    $(".district_list").addClass("display_none_important");
                    $(city_id).removeClass("display_none_important");
                }else{
                    disabled_district_select();
                }
                reset_district_id_input();

                $("#lua_chon_city_bds").html(name);
                $("#input_city_bds").html(value);
                create_url_to_search_mua_ban_mobile();
            });

            function active_district_select(){
                $("#select_districts").removeClass("disabled-selected-item");
                $("#danh_sach_district_bds").removeClass("display_none_important");
            }
            function disabled_district_select(){
                $("#select_districts").addClass("disabled-selected-item");
                $("#danh_sach_district_bds").addClass("display_none_important");
            }
            function reset_district_id_input(){
                $("#lua_chon_district_bds").html('Tất Cả');
                $("#input_district_bds").html('');
            }

            //location district
            $("#lua_chon_district_bds").click(function(){
                $("#danh_sach_district_bds").removeClass("off");
            });

            $(".select-district-bds_mobile").click(function(evt){
                $("#danh_sach_district_bds").addClass("off");
                $(".select-district-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                $("#lua_chon_district_bds").html(name);
                $("#input_district_bds").html(value);
                create_url_to_search_mua_ban_mobile();
            });

            //khoảng giá bán
            $("#lua_chon_khoang_gia_bds").click(function(){
                $("#danh_sach_khoang_gia_bds").removeClass("off");
            });

            $(".select-khoang-gia-bds_mobile").click(function(evt){
                $("#danh_sach_khoang_gia_bds").addClass("off");
                $(".select-khoang-gia-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                $("#lua_chon_khoang_gia_bds").html(name);
                $("#input_khoang_gia_bds").html(value);
                create_url_to_search_mua_ban_mobile();
            });

            //Diện tích 
            $("#lua_chon_dien_tich_bds").click(function(){
                $("#danh_sach_dien_tich_bds").removeClass("off");
            });
            $(".select-dien-tich-bds_mobile").click(function(evt){
                $("#danh_sach_dien_tich_bds").addClass("off");
                $(".select-dien-tich-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                $("#lua_chon_dien_tich_bds").html(name);
                $("#input_dien_tich_bds").html(value);
                create_url_to_search_mua_ban_mobile();
            });

            //hướng nhà 
            $("#lua_chon_huong_nha_bds").click(function(){
                $("#danh_sach_huong_nha_bds").removeClass("off");
            });
            $(".select-huong-nha-bds_mobile").click(function(evt){
                $("#danh_sach_huong_nha_bds").addClass("off");
                $(".select-huong-nha-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                $("#lua_chon_huong_nha_bds").html(name);
                $("#input_huong_nha_bds").html(value);
                create_url_to_search_mua_ban_mobile();
            });

            //vị trí bds 
            $("#lua_chon_vi_tri_bds").click(function(){
                $("#danh_sach_vi_tri_bds").removeClass("off");
            });
            $(".select-vi-tri-bds_mobile").click(function(evt){
                $("#danh_sach_vi_tri_bds").addClass("off");
                $(".select-vi-tri-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                $("#lua_chon_vi_tri_bds").html(name);
                $("#input_vi_tri_bds").html(value);
                create_url_to_search_mua_ban_mobile();
            });

            //reset form tìm kiếm 
            $("#clear_input_search_mobile").click(function(){
                
                $("#lua_chon_loai_hinh_bds").html('Tất Cả');
                $("#input_loai_hinh_bds").html('Tất Cả');

                $("#lua_chon_city_bds").html('Tất Cả');
                $("#input_city_bds").html('');

                $("#lua_chon_district_bds").html('Tất Cả');
                $("#input_district_bds").html('');

                $("#lua_chon_khoang_gia_bds").html('Tất Cả');
                $("#input_khoang_gia_bds").html('Tất Cả');

                $("#lua_chon_dien_tich_bds").html('Tất Cả');
                $("#input_dien_tich_bds").html('Tất Cả');

                $("#lua_chon_huong_nha_bds").html('Tất Cả');
                $("#input_huong_nha_bds").html('Tất Cả');

                $("#lua_chon_vi_tri_bds").html('Tất Cả');
                $("#input_vi_tri_bds").html('Tất Cả');

                disabled_district_select();
                create_url_to_search_mua_ban_mobile();
            });

            

            

            //Tắt tất cả Modal 
            $(".x-close-mini").click(function(){
                $("#danh_sach_loai_hinh_bds").addClass("off");
                $("#danh_sach_city_bds").addClass("off");
                $("#danh_sach_district_bds").addClass("off");
                $("#danh_sach_khoang_gia_bds").addClass("off");
                $("#danh_sach_dien_tich_bds").addClass("off");
                $("#danh_sach_huong_nha_bds").addClass("off");
                $("#danh_sach_vi_tri_bds").addClass("off");
            });
        }

        function create_url_to_search_mua_ban_mobile(){
            var loai_hinh_mua_ban_bds   = document.getElementById('lua_chon_loai_hinh_mua_ban_bds').value;
            var loai_hinh_bds           = document.getElementById('input_loai_hinh_bds').innerText;
            var city_id                 = document.getElementById('input_city_bds').innerText;
            var districts_id            = document.getElementById('input_district_bds').innerText;
            var khoang_gia_bds          = document.getElementById('input_khoang_gia_bds').innerText;
            var dien_tich_bds           = document.getElementById('input_dien_tich_bds').innerText;
            var huong_nha_bds           = document.getElementById('input_huong_nha_bds').innerText;
            var vi_tri_bds              = document.getElementById('input_vi_tri_bds').innerText;
            

            //Gộp uri
            var uri =
                'danh-sach-bds?'            +
                '&du_an_status=0'           +
                '&loai_hinh_mua_ban_bds='   + (loai_hinh_mua_ban_bds) + 
                '&loai_hinh_bds='           + (loai_hinh_bds)+
                '&city_id='                 + city_id +
                '&districts_id='            + districts_id+
                '&khoang_gia_bds='          + khoang_gia_bds +
                '&dien_tich_bds='           + dien_tich_bds +
                '&huong_nha_bds='           + huong_nha_bds +
                '&vi_tri_bds='              + vi_tri_bds
            ;
            
            console.log(uri);
            //Sau đó điều hướng khi nhấn vào button
            $('#button_search_mobile').attr('href','<?php echo base_url() ?>' + uri);
        }

        //Render ra Form cho thuê mobile
        function render_form_cho_thue_mobile(){
            document.getElementById("SearchMobile").innerHTML = `
            <div class="pb-2 search-mobile-box div-relative">
                <div class="search-mobile-box-inner">
                    <div class="search-mobile-box-item item-fixed pt-2">
                        <div class="display-flex flex-center p-2 pl-3 pr-3">
                            <h2 class="text-medium m-0 flex-first text-center">Tìm kiếm bất động sản</h2>
                            <span onclick="hide_SearchMobile()" class="x-close"></span>
                        </div>
                        <div class="type-category-mobile-search">
                            <ul>
                                <li id="select_form_mua_ban_mobile" class="">Bán</li>
                                <li id="select_form_cho_thue_mobile" class="current">Cho thuê</li>
                                <li id="select_form_du_an_mobile" class="">Dự án</li>
                                <!--lua_chon_loai_hinh_mua_ban_bds-->
                                <input id="lua_chon_loai_hinh_mua_ban_bds" value="Cho Thuê" style="display:none;"/>
                                <!--end lua_chon_loai_hinh_mua_ban_bds-->
                            </ul>
                        </div>
                    </div>
                    <div class="mt-box" style="margin-top:130px">
                        <!-- loại hình bds-->
                        <div class="search-mobile-box-item mb-3 mr-2 ml-2">
                            <div>
                                <div class="hasValue box-item-popup-search">
                                    <span class="display-flex flex-center div-full showBoxPopup">
                                        <div id="" class="display-grid flex-first">
                                            <span class="label-item">Loại nhà đất</span>
                                            <span  id="lua_chon_loai_hinh_bds" class="box-item-selected-name">Tất Cả</span>
                                        </div>
                                        <!--input loai_hinh_bds-->
                                        <div id="input_loai_hinh_bds" style="display:none;">Tất Cả</div>
                                        <!--END input loai_hinh_bds-->
                                        <i class="text-placeholder fa fa-angle-right"></i>
                                    </span>
                                </div>
                                <div id="danh_sach_loai_hinh_bds" class="popup-fixed off">
                                    <div class="popup-select-fixed-content show">
                                        <div class="display-flex p-2-5 flex-center border-bottom">
                                            <b class="text-center div-full">Loại nhà đất</b>
                                            <span class="x-close-mini"></span>
                                        </div>
                                        <div class="popup-select-fixed-content-body">
                                            <div class="search-mobile-box-item-expand">
                                                <div class="first-title">
                                                    <div class="first-item"><span>Lựa chọn loại hình BĐS</span></div>
                                                </div>
                                                <ul class="ul-filter-child">
                                                    <li class="select-loai-hinh-bds_mobile" rel="Tất Cả"    ><div><span>Tất Cả</span>       <span class="current check-loai-hinh-bds_mobile search-filter-item-radio"><i class="fa fa-circle"></i></span></div></li>
                                                </ul>
                                            </div>
                                            <div class="search-mobile-box-item-expand">
                                                <div class="first-title">
                                                    <div class="first-item"><span>Nhà</span></div>
                                                </div>
                                                <ul class="ul-filter-child">
                                                    <li class="select-loai-hinh-bds_mobile" rel="Nhà Riêng" ><div><span>Nhà riêng</span>     <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Căn Hộ"    ><div><span>Căn hộ</span>        <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Biệt Thự"  ><div><span>Biệt thự</span>      <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Shophouse" ><div><span>Shop-house</span>    <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Pent-house"><div><span>Pent-house</span>    <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Condotel"  ><div><span>Condotel</span>      <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                </ul>
                                            </div>
                                            <div class="search-mobile-box-item-expand">
                                                <div class="first-title">
                                                    <div class="first-item"><span>Đất</span></div>
                                                </div>
                                                <ul class="ul-filter-child">
                                                    <li class="select-loai-hinh-bds_mobile" rel="Đất Bán"       ><div><span>Đất bán</span>       <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Đất Nền"       ><div><span>Đất nền</span>       <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Đất Cho Thuê"  ><div><span>Đất cho thuê</span>  <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                </ul>
                                            </div>
                                            <div class="search-mobile-box-item-expand">
                                                <div class="first-title">
                                                    <div class="first-item"><span>Bất động sản các loại</span></div>
                                                </div>
                                                <ul class="ul-filter-child">
                                                    <li class="select-loai-hinh-bds_mobile" rel="Kho, Nhà Xưởng"                ><div><span>Kho, nhà xưởng</span>                <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Khu Nghỉ Dưỡng, Trang Trại"    ><div><span>Khu nghỉ dưỡng, Trang trại</span>    <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Văn Phòng"                     ><div><span>Văn phòng</span>                     <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Mặt Bằng, Cửa Hàng"            ><div><span>Mặt bằng, Cửa hàng</span>            <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Nhà Trọ, Phòng Trọ"            ><div><span>Nhà trọ, Phòng trọ</span>            <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="BDS loại khác"                 ><div><span>BDS loại khác</span>                 <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="popup-overlay"></div>
                                </div>
                            </div>
                        </div>
                        <!--end loại hình bds-->
                    </div>
                    <!-- location-->
                        <div class="mt-4">
                            <div class="search-mobile-box-item mb-3 mr-2 ml-2">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">Tỉnh / Thành</span>
                                                <span id="lua_chon_city_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_city_bds" style="display:none;"></div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_city_bds" class="popup-fixed off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">Tỉnh / Thành</b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div class="p-2 mt-2">
                                                    <input id="search_city_mobile" onkeyup="search_city_mobile()" class="form-control mb-0" placeholder="Tìm kiếm">
                                                </div>
                                                <div id="city_mobile_list">
                                                <div rel="" class="select-city-bds_mobile border-bottom item-popup-select p-2-5 current"><span>Tất Cả</span></div>
                                                <?php foreach($city_list as $row): ?>
                                                    <?php $city_name = json_decode($row->name); ?>
                                                <div rel="<?php echo $row->id; ?>" class="select-city-bds_mobile border-bottom item-popup-select p-2-5"><span><?php echo $city_name; ?></span></div>
                                                <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- end location -->
                    <!--location quận /huyện-->
                        <div class="mt-4">
                            <div id="select_districts" class="disabled-selected-item search-mobile-box-item mb-3 mr-2 ml-2">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">TP / Quận / Huyện</span>
                                                <span id="lua_chon_district_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_district_bds" style="display:none;"></div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_district_bds" class="popup-fixed display_none_important off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">TP / Quận / Huyện</b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div class="p-2 mt-2">
                                                    <input id="search_district_mobile" onkeyup="search_district_mobile()" class="form-control mb-0" placeholder="Tìm kiếm">
                                                </div>
                                                <div id="district_mobile_list">
                                                    <div rel="" class="select-district-bds_mobile border-bottom item-popup-select p-2-5 current"><span>Tất cả</span></div>
                                                    <?php 
                                                        $input = array();
                                                        $input['order'] = array('name','grade');
                                                        $this->db->select('id, name, city_id');
                                                        $district_list_search_mobile = $this->districts_model->get_list($input);
                                                    ?>
                                                    <?php foreach($district_list_search_mobile as $row): ?>
                                                    <div rel="<?php echo $row->id ?>" class="select-district-bds_mobile city_id<?php echo $row->city_id ?> district_list display_none_important border-bottom item-popup-select p-2-5"><span><?php echo json_decode($row->name); ?></span></div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- end location quận /huyện -->
                    <!-- Khoảng Giá -->
                        <div class="search-mobile-box-item mt-4 mr-2 ml-2">
                            <div class="list-category-search">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">Khoảng giá</span>
                                                <span id="lua_chon_khoang_gia_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_khoang_gia_bds" style="display:none;">Tất Cả</div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_khoang_gia_bds" class="popup-fixed off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">Khoảng giá</b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div rel="Tất Cả"                       class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5 current">Tất cả</div>
                                                <div rel="< 1 triệu"                    class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>< 1 triệu</span></div>
                                                <div rel="1 - 3 triệu"                  class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>1 - 3 triệu</span></div>
                                                <div rel="3 - 5 triệu"                  class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>3 - 5 triệu</span></div>
                                                <div rel="5 - 7 triệu"                  class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>5 - 7 triệu</span></div>
                                                <div rel="7 - 10 triệu"                 class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>7 - 10 triệu</span></div>
                                                <div rel="10 - 30 triệu"                class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>10 - 30 triệu</span></div>
                                                <div rel="30 - 50 triệu"                class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>30 - 50 triệu</span></div>
                                                <div rel="50 - 100 triệu"               class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>50 - 100 triệu</span></div>
                                                <div rel="> 100 triệu"                  class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>> 100 triệu</span></div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- END Khoảng Giá -->
                    <!--Diện Tích-->
                        <div class="search-mobile-box-item mt-4 mr-2 ml-2">
                            <div class="list-category-search">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">Diện tích</span>
                                                <span id="lua_chon_dien_tich_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_dien_tich_bds" style="display:none;">Tất Cả</div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_dien_tich_bds" class="popup-fixed off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">Diện tích <span class="text-100">(m2)</span></b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div rel="Tất Cả"                   class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5 current">Tất cả</div>
                                                <div rel="Đến 30 m²"                class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5"><span>< 30 m²</span></div>
                                                <div rel="Từ 30 m² - Đến 50 m²"     class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5"><span>30 - 50 m²</span></div>
                                                <div rel="Từ 50 m² - Đến 80 m²"     class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5"><span>50 - 80 m²</span></div>
                                                <div rel="Từ 80 m² - Đến 100 m²"    class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5"><span>80 - 100 m²</span></div>
                                                <div rel="Từ 100 m² - Đến 300 m²"   class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5"><span>100 - 300 m²</span></div>
                                                <div rel="Từ 300 m² - Đến 500 m²"   class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5"><span>300 - 500 m²</span></div>
                                                <div rel="Từ 500 m²"                class="select-dien-tich-bds_mobile border-bottom item-popup-select p-2-5"><span>> 500 m²</span></div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--END Diện Tích-->
                    <!--Hướng Nhà -->
                        <div class="search-mobile-box-item mt-4 mr-2 ml-2">
                            <div class="list-category-search">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">Hướng</span>
                                                <span id="lua_chon_huong_nha_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_huong_nha_bds" style="display:none;">Tất Cả</div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_huong_nha_bds" class="popup-fixed off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">Hướng </b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div rel="Tất Cả"   class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5 current">Tất cả</div>
                                                <div rel="Đông"     class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Đông</span></div>
                                                <div rel="Tây"      class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Tây</span></div>
                                                <div rel="Nam"      class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Nam</span></div>
                                                <div rel="Bắc"      class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Bắc</span></div>
                                                <div rel="Đông Bắc" class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Đông Bắc</span></div>
                                                <div rel="Đông Nam" class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Đông Nam</span></div>
                                                <div rel="Tây Bắc"  class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Tây Bắc</span></div>
                                                <div rel="Tây Nam"  class="select-huong-nha-bds_mobile border-bottom item-popup-select p-2-5"><span>Tây Nam</span></div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--END Hướng Nhà-->
                    <!-- Vị Trí BDS-->
                        <div class="search-mobile-box-item mt-4 mr-2 ml-2">
                            <div class="list-category-search">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">Vị trí</span>
                                                <span id="lua_chon_vi_tri_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_vi_tri_bds" style="display:none;">Tất Cả</div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_vi_tri_bds" class="popup-fixed off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">Vị trí </b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div rel="Tất Cả"       class="select-vi-tri-bds_mobile border-bottom item-popup-select p-2-5 current">Tất Cả</div>
                                                <div rel="Mặt Hẻm"      class="select-vi-tri-bds_mobile border-bottom item-popup-select p-2-5"><span>Mặt Hẻm</span></div>
                                                <div rel="Mặt Tiền"     class="select-vi-tri-bds_mobile border-bottom item-popup-select p-2-5"><span>Mặt Tiền</span></div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- END Vị trí BDS-->
                    <div class="btn-box-search-mobile">
                        <span id="clear_input_search_mobile" class="btn-clear-search-mobile"><i class="fa fa-refresh mr-2"></i>Xóa bộ lọc</span>
                        <a id="button_search_mobile" class="btn-apply-search-mobile" style="color:white;"><i class="fa fa-search mr-2"></i>Áp dụng</a>
                    </div>
                </div>
            </div>
            `;
            jquery_search_cho_thue_mobile();
        }
        //Jquery Form Cho Thuê mobile
        function jquery_search_cho_thue_mobile(){
            console.log('cho thuê');

            $("#select_form_mua_ban_mobile").click(function(){
                render_form_mua_ban_mobile();
                create_url_to_search_mua_ban_mobile();
            });

            $("#select_form_cho_thue_mobile").click(function(){
                render_form_cho_thue_mobile();
                create_url_to_search_cho_thue_mobile();
            });

            $("#select_form_du_an_mobile").click(function(){
                render_form_du_an_mobile();
                create_url_to_search_du_an_mobile();
            });

            //loại hình bds
            $("#lua_chon_loai_hinh_bds").click(function(){
                $("#danh_sach_loai_hinh_bds").removeClass("off");
            });

            $(".select-loai-hinh-bds_mobile").click(function(evt){
                $("#danh_sach_loai_hinh_bds").addClass("off");
                var value = $(this).attr('rel');

                $(".check-loai-hinh-bds_mobile").html("");
                $(".check-loai-hinh-bds_mobile").removeClass("current");
                $(this).html('<div><span>' +value+'</span><span class="check-loai-hinh-bds_mobile current search-filter-item-radio"><i class="fa fa-circle"></i></span></div>');

                $("#lua_chon_loai_hinh_bds").html(value);
                $("#input_loai_hinh_bds").html(value);
                create_url_to_search_cho_thue_mobile();
            });

            //location city
            $("#lua_chon_city_bds").click(function(){
                $("#danh_sach_city_bds").removeClass("off");
            });

            $(".select-city-bds_mobile").click(function(evt){
                $("#danh_sach_city_bds").addClass("off");
                $(".select-city-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                if(value > '0'){ // không phải chọn tất cả
                    active_district_select();

                    //ẩn các quận / huyện của thành phố khác và hiển thị các quận của thành phố được chọn
                    var city_id = '.city_id' + value; //set class để hiển thị
                    
                    $(".district_list").addClass("display_none_important");
                    $(city_id).removeClass("display_none_important");
                }else{
                    disabled_district_select();
                }
                reset_district_id_input();

                $("#lua_chon_city_bds").html(name);
                $("#input_city_bds").html(value);
                create_url_to_search_cho_thue_mobile();
            });

            function active_district_select(){
                $("#select_districts").removeClass("disabled-selected-item");
                $("#danh_sach_district_bds").removeClass("display_none_important");
            }
            function disabled_district_select(){
                $("#select_districts").addClass("disabled-selected-item");
                $("#danh_sach_district_bds").addClass("display_none_important");
            }
            function reset_district_id_input(){
                $("#lua_chon_district_bds").html('Tất Cả');
                $("#input_district_bds").html('');
            }

            //location district
            $("#lua_chon_district_bds").click(function(){
                $("#danh_sach_district_bds").removeClass("off");
            });

            $(".select-district-bds_mobile").click(function(evt){
                $("#danh_sach_district_bds").addClass("off");
                $(".select-district-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                $("#lua_chon_district_bds").html(name);
                $("#input_district_bds").html(value);
                create_url_to_search_cho_thue_mobile();
            });

            //khoảng giá bán
            $("#lua_chon_khoang_gia_bds").click(function(){
                $("#danh_sach_khoang_gia_bds").removeClass("off");
            });

            $(".select-khoang-gia-bds_mobile").click(function(evt){
                $("#danh_sach_khoang_gia_bds").addClass("off");
                $(".select-khoang-gia-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                $("#lua_chon_khoang_gia_bds").html(name);
                $("#input_khoang_gia_bds").html(value);
                create_url_to_search_cho_thue_mobile();
            });

            //Diện tích 
            $("#lua_chon_dien_tich_bds").click(function(){
                $("#danh_sach_dien_tich_bds").removeClass("off");
            });
            $(".select-dien-tich-bds_mobile").click(function(evt){
                $("#danh_sach_dien_tich_bds").addClass("off");
                $(".select-dien-tich-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                $("#lua_chon_dien_tich_bds").html(name);
                $("#input_dien_tich_bds").html(value);
                create_url_to_search_cho_thue_mobile();
            });

            //hướng nhà 
            $("#lua_chon_huong_nha_bds").click(function(){
                $("#danh_sach_huong_nha_bds").removeClass("off");
            });
            $(".select-huong-nha-bds_mobile").click(function(evt){
                $("#danh_sach_huong_nha_bds").addClass("off");
                $(".select-huong-nha-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                $("#lua_chon_huong_nha_bds").html(name);
                $("#input_huong_nha_bds").html(value);
                create_url_to_search_cho_thue_mobile();
            });

            //vị trí bds 
            $("#lua_chon_vi_tri_bds").click(function(){
                $("#danh_sach_vi_tri_bds").removeClass("off");
            });
            $(".select-vi-tri-bds_mobile").click(function(evt){
                $("#danh_sach_vi_tri_bds").addClass("off");
                $(".select-vi-tri-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                $("#lua_chon_vi_tri_bds").html(name);
                $("#input_vi_tri_bds").html(value);
                create_url_to_search_cho_thue_mobile();
            });

            //reset form tìm kiếm 
            $("#clear_input_search_mobile").click(function(){
                
                $("#lua_chon_loai_hinh_bds").html('Tất Cả');
                $("#input_loai_hinh_bds").html('Tất Cả');

                $("#lua_chon_city_bds").html('Tất Cả');
                $("#input_city_bds").html('');

                $("#lua_chon_district_bds").html('Tất Cả');
                $("#input_district_bds").html('');

                $("#lua_chon_khoang_gia_bds").html('Tất Cả');
                $("#input_khoang_gia_bds").html('Tất Cả');

                $("#lua_chon_dien_tich_bds").html('Tất Cả');
                $("#input_dien_tich_bds").html('Tất Cả');

                $("#lua_chon_huong_nha_bds").html('Tất Cả');
                $("#input_huong_nha_bds").html('Tất Cả');

                $("#lua_chon_vi_tri_bds").html('Tất Cả');
                $("#input_vi_tri_bds").html('Tất Cả');

                disabled_district_select();
                create_url_to_search_cho_thue_mobile();
            });

            //Tắt tất cả Modal 
            $(".x-close-mini").click(function(){
                $("#danh_sach_loai_hinh_bds").addClass("off");
                $("#danh_sach_city_bds").addClass("off");
                $("#danh_sach_district_bds").addClass("off");
                $("#danh_sach_khoang_gia_bds").addClass("off");
                $("#danh_sach_dien_tich_bds").addClass("off");
                $("#danh_sach_huong_nha_bds").addClass("off");
                $("#danh_sach_vi_tri_bds").addClass("off");
            });
        }
        function create_url_to_search_cho_thue_mobile(){
            var loai_hinh_mua_ban_bds   = document.getElementById('lua_chon_loai_hinh_mua_ban_bds').value;
            var loai_hinh_bds           = document.getElementById('input_loai_hinh_bds').innerText;
            var city_id                 = document.getElementById('input_city_bds').innerText;
            var districts_id            = document.getElementById('input_district_bds').innerText;
            var khoang_gia_cho_thue_bds = document.getElementById('input_khoang_gia_bds').innerText;
            var dien_tich_bds           = document.getElementById('input_dien_tich_bds').innerText;
            var huong_nha_bds           = document.getElementById('input_huong_nha_bds').innerText;
            var vi_tri_bds              = document.getElementById('input_vi_tri_bds').innerText;

            //Gộp uri
            var uri =
                'danh-sach-bds?'            +
                '&du_an_status=0'           +
                '&loai_hinh_mua_ban_bds='   + (loai_hinh_mua_ban_bds) + 
                '&loai_hinh_bds='           + (loai_hinh_bds) +
                '&city_id='                 + city_id +
                '&districts_id='            + districts_id +
                '&khoang_gia_cho_thue_bds=' + khoang_gia_cho_thue_bds + 
                '&dien_tich_bds='           + dien_tich_bds +
                '&huong_nha_bds='           + huong_nha_bds +
                '&vi_tri_bds='              + vi_tri_bds
            ;
            
            console.log(uri);
            //Sau đó điều hướng khi nhấn vào button
            $('#button_search_mobile').attr('href','<?php echo base_url() ?>' + uri);
        }

        //Render ra Form dự án mobile
        function render_form_du_an_mobile(){
            document.getElementById("SearchMobile").innerHTML = `
            <div class="pb-2 search-mobile-box div-relative">
                <div class="search-mobile-box-inner">
                    

                    <div class="search-mobile-box-item item-fixed pt-2">
                        <div class="display-flex flex-center p-2 pl-3 pr-3">
                            <h2 class="text-medium m-0 flex-first text-center">Tìm kiếm bất động sản</h2>
                            <span onclick="hide_SearchMobile()" class="x-close"></span>
                        </div>
                        <div class="type-category-mobile-search">
                            <ul>
                                <li id="select_form_mua_ban_mobile" class="">Bán</li>
                                <li id="select_form_cho_thue_mobile" class="">Cho thuê</li>
                                <li id="select_form_du_an_mobile" class="current">Dự án</li>
                                <!--lua_chon_loai_hinh_mua_ban_bds-->
                                <input id="lua_chon_loai_hinh_mua_ban_bds" value="Tất Cả" style="display:none;"/>
                                <!--end lua_chon_loai_hinh_mua_ban_bds-->
                            </ul>
                        </div>
                    </div>
                    <div class="mt-box" style="margin-top:130px">
                        <!--loại hình mua bán dự án-->
                        <div class="search-mobile-box-item mb-3 mr-2 ml-2">
                            <div>
                                <div class="hasValue box-item-popup-search">
                                    <span class="display-flex flex-center div-full showBoxPopup">
                                        <div class="display-grid flex-first">
                                            <span class="label-item">Loại giao dịch</span>
                                            <span id="lua_chon_loai_hinh_giao_dich_du_an_bds" class="box-item-selected-name">Tất Cả</span>
                                        </div>
                                        <!--input loai_hinh_giao_dich_du_an_bds-->
                                        <div id="input_loai_hinh_giao_dich_du_an_bds" style="display:none;">Tất Cả</div>
                                        <!--END input loai_hinh_giao_dich_du_an_bds-->
                                        <i class="text-placeholder fa fa-angle-right"></i>
                                    </span>
                                </div>
                                <div id="danh_sach_loai_hinh_giao_dich_du_an_bds" class="popup-fixed off">
                                    <div class="popup-select-fixed-content show">
                                        <div class="display-flex p-2-5 flex-center border-bottom">
                                            <b class="text-center div-full">Loại giao dịch</b>
                                            <span class="x-close-mini"></span>
                                        </div>
                                        <div class="popup-select-fixed-content-body">
                                            <div rel="Tất Cả"   class="select-loai-hinh-giao-dich-du-an-bds_mobile border-bottom item-popup-select p-2-5 current"><span>Tất cả loại giao dịch</span></div>
                                            <div rel="Mua Bán"  class="select-loai-hinh-giao-dich-du-an-bds_mobile border-bottom item-popup-select p-2-5"><span>Mua bán</span></div>
                                            <div rel="Cho Thuê" class="select-loai-hinh-giao-dich-du-an-bds_mobile border-bottom item-popup-select p-2-5"><span>Cho thuê</span></div>
                                        </div>
                                    </div>
                                    <div class="popup-overlay"></div>
                                </div>
                            </div>
                        </div>
                        <!--END loại hình mua bán dự án-->
                        <!-- loại hình bds-->
                        <div class="search-mobile-box-item mb-3 mr-2 ml-2">
                            <div>
                                <div class="hasValue box-item-popup-search">
                                    <span class="display-flex flex-center div-full showBoxPopup">
                                        <div id="" class="display-grid flex-first">
                                            <span class="label-item">Loại nhà đất</span>
                                            <span  id="lua_chon_loai_hinh_bds" class="box-item-selected-name">Tất Cả</span>
                                        </div>
                                        <!--input loai_hinh_bds-->
                                        <div id="input_loai_hinh_bds" style="display:none;">Tất Cả</div>
                                        <!--END input loai_hinh_bds-->
                                        <i class="text-placeholder fa fa-angle-right"></i>
                                    </span>
                                </div>
                                <div id="danh_sach_loai_hinh_bds" class="popup-fixed off">
                                    <div class="popup-select-fixed-content show">
                                        <div class="display-flex p-2-5 flex-center border-bottom">
                                            <b class="text-center div-full">Loại nhà đất</b>
                                            <span class="x-close-mini"></span>
                                        </div>
                                        <div class="popup-select-fixed-content-body">
                                            <div class="search-mobile-box-item-expand">
                                                <div class="first-title">
                                                    <div class="first-item"><span>Lựa chọn loại hình BĐS</span></div>
                                                </div>
                                                <ul class="ul-filter-child">
                                                    <li class="select-loai-hinh-bds_mobile" rel="Tất Cả"    ><div><span>Tất Cả</span>       <span class="current check-loai-hinh-bds_mobile search-filter-item-radio"><i class="fa fa-circle"></i></span></div></li>
                                                </ul>
                                            </div>
                                            <div class="search-mobile-box-item-expand">
                                                <div class="first-title">
                                                    <div class="first-item"><span>Nhà</span></div>
                                                </div>
                                                <ul class="ul-filter-child">
                                                    <li class="select-loai-hinh-bds_mobile" rel="Nhà Riêng" ><div><span>Nhà riêng</span>     <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Căn Hộ"    ><div><span>Căn hộ</span>        <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Biệt Thự"  ><div><span>Biệt thự</span>      <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Shophouse" ><div><span>Shop-house</span>    <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Pent-house"><div><span>Pent-house</span>    <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Condotel"  ><div><span>Condotel</span>      <span class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                </ul>
                                            </div>
                                            <div class="search-mobile-box-item-expand">
                                                <div class="first-title">
                                                    <div class="first-item"><span>Đất</span></div>
                                                </div>
                                                <ul class="ul-filter-child">
                                                    <li class="select-loai-hinh-bds_mobile" rel="Đất Bán"       ><div><span>Đất bán</span>       <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Đất Nền"       ><div><span>Đất nền</span>       <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Đất Cho Thuê"  ><div><span>Đất cho thuê</span>  <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                </ul>
                                            </div>
                                            <div class="search-mobile-box-item-expand">
                                                <div class="first-title">
                                                    <div class="first-item"><span>Bất động sản các loại</span></div>
                                                </div>
                                                <ul class="ul-filter-child">
                                                    <li class="select-loai-hinh-bds_mobile" rel="Kho, Nhà Xưởng"                ><div><span>Kho, nhà xưởng</span>                <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Khu Nghỉ Dưỡng, Trang Trại"    ><div><span>Khu nghỉ dưỡng, Trang trại</span>    <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Văn Phòng"                     ><div><span>Văn phòng</span>                     <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Mặt Bằng, Cửa Hàng"            ><div><span>Mặt bằng, Cửa hàng</span>            <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="Nhà Trọ, Phòng Trọ"            ><div><span>Nhà trọ, Phòng trọ</span>            <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                    <li class="select-loai-hinh-bds_mobile" rel="BDS loại khác"                 ><div><span>BDS loại khác</span>                 <span  class="check-loai-hinh-bds_mobile search-filter-item-radio"></span></div></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="popup-overlay"></div>
                                </div>
                            </div>
                        </div>
                        <!--end loại hình bds-->
                    </div>

                    <!-- tìm dự án theo tên-->
                        <div class="mt-4">
                            <div class="search-mobile-box-item mb-3 mr-2 ml-2">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">Tìm theo tên dự án</span>
                                                <span id="lua_chon_du_an_bds_theo_ten" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_du_an_bds_theo_ten" style="display:none;"></div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_du_an_bds_theo_ten" class="popup-fixed off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">Dự Án</b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div class="p-2 mt-2">
                                                    <input id="search_du_an_mobile" onkeyup="search_du_an_mobile()" class="form-control mb-0" placeholder="Tìm kiếm">
                                                </div>
                                                <div id="du_an_mobile_list">
                                                    <div rel="" class="select-du-an-bds-theo-ten_mobile_mobile border-bottom item-popup-select p-2-5 current"><span>Tất Cả</span></div>
                                                    <?php  
                                                        $input = array();
                                                        $input['where'] = array('status'=>'0','du_an_status' => '1');
                                                        $input['order'] = array('id','desc');
                                                        $this->db->select('id, name, alias, location');
                                                        $project_list_for_mobile_search = $this->project_model->get_list($input);
                                                    ?>
                                                    <?php foreach($project_list_for_mobile_search as $row): ?>
                                                        <?php 
                                                            $url_of_row = base_url($row->alias.'-pr'.$row->id);
                                                            $row_name = json_decode($row->name);
                                                            $row_location = json_decode($row->location); 
                                                        ?>
                                                    <div rel="<?php echo $row_name; ?>" onclick="window.location.assign('<?php echo $url_of_row ?>')" class="select-du-an-bds-theo-ten_mobile border-bottom item-popup-select p-2-5">
                                                        <span><?php echo $row_name; ?></span>
                                                        <span class="display-flex flex-center" style="font-size:10px;line-height: 10px;"><i class="fa fa-icon-me fa-custom-pin1 text-placeholder"></i><span><?php echo $row_location; ?></span></span>
                                                    </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- end tìm dự án theo tên -->

                    <!-- location-->
                        <div class="mt-4">
                            <div class="search-mobile-box-item mb-3 mr-2 ml-2">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">Tỉnh / Thành</span>
                                                <span id="lua_chon_city_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_city_bds" style="display:none;"></div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_city_bds" class="popup-fixed off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">Tỉnh / Thành</b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div class="p-2 mt-2">
                                                    <input id="search_city_mobile" onkeyup="search_city_mobile()" class="form-control mb-0" placeholder="Tìm kiếm">
                                                </div>
                                                <div id="city_mobile_list">
                                                    <div rel="" class="select-city-bds_mobile border-bottom item-popup-select p-2-5 current"><span>Tất Cả</span></div>
                                                    <?php foreach($city_list as $row): ?>
                                                        <?php $city_name = json_decode($row->name); ?>
                                                    <div rel="<?php echo $row->id; ?>" class="select-city-bds_mobile border-bottom item-popup-select p-2-5"><span><?php echo $city_name; ?></span></div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- end location -->
                    <!--location quận /huyện-->
                        <div class="mt-4">
                            <div id="select_districts" class="disabled-selected-item search-mobile-box-item mb-3 mr-2 ml-2">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">TP / Quận / Huyện</span>
                                                <span id="lua_chon_district_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_district_bds" style="display:none;"></div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_district_bds" class="popup-fixed display_none_important off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">TP / Quận / Huyện</b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div class="p-2 mt-2">
                                                    <input id="search_district_mobile" onkeyup="search_district_mobile()" class="form-control mb-0" placeholder="Tìm kiếm">
                                                </div>
                                                <div id="district_mobile_list">
                                                    <div rel="" class="select-district-bds_mobile border-bottom item-popup-select p-2-5 current"><span>Tất cả</span></div>
                                                    <?php 
                                                        $input = array();
                                                        $input['order'] = array('name','grade');
                                                        $this->db->select('id, name, city_id');
                                                        $district_list_search_mobile = $this->districts_model->get_list($input);
                                                    ?>
                                                    <?php foreach($district_list_search_mobile as $row): ?>
                                                    <div rel="<?php echo $row->id ?>" class="select-district-bds_mobile city_id<?php echo $row->city_id ?> district_list display_none_important border-bottom item-popup-select p-2-5"><span><?php echo json_decode($row->name); ?></span></div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- end location quận /huyện -->
                    <!-- Khoảng Giá -->
                        <div class="search-mobile-box-item mt-4 mr-2 ml-2">
                            <div class="list-category-search">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">Khoảng giá</span>
                                                <span id="lua_chon_khoang_gia_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input_khoang_gia_bds-->
                                            <div id="input_khoang_gia_bds" style="display:none;">Tất Cả</div>
                                            <div id="input_khoang_gia_cho_thue_bds" style="display:none;">Tất Cả</div>
                                            <!--END input_khoang_gia_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_khoang_gia_bds" class="popup-fixed off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">Khoảng giá</b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div id="select_khoang_gia_ban_bds_du_an" class="popup-select-fixed-content-body">
                                                <div rel="Tất Cả"                       class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5 current">Tất cả</div>
                                                <div rel="Đến 500 triệu"                class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>< 500 triệu</span></div>
                                                <div rel="Từ 500 - Đến 800 triệu"       class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>500 - 800 triệu</span></div>
                                                <div rel="Từ 800 triệu - Đến 1 tỷ"      class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>800 triệu - 1 tỷ</span></div>
                                                <div rel="Từ 1 tỷ - Đến 2 tỷ"           class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>1 - 2 tỷ</span></div>
                                                <div rel="Từ 2 tỷ - Đến 3 tỷ"           class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>2 - 3 tỷ</span></div>
                                                <div rel="Từ 3 tỷ - Đến 5 tỷ"           class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>3 - 5 tỷ</span></div>
                                                <div rel="Từ 5 tỷ - Đến 7 tỷ"           class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>5 - 7 tỷ</span></div>
                                                <div rel="Từ 7 tỷ - Đến 10 tỷ"          class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>7 - 10 tỷ</span></div>
                                                <div rel="Từ 10 tỷ - Đến 20 tỷ"         class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>10 - 20 tỷ</span></div>
                                                <div rel="Từ 20 tỷ - Đến 30 tỷ"         class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>20 - 30 tỷ</span></div>
                                                <div rel="Từ 30 tỷ - Đến 50 tỷ"         class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>30 - 50 tỷ</span></div>
                                                <div rel="Từ 50 tỷ"                     class="select-khoang-gia-bds_mobile border-bottom item-popup-select p-2-5"><span>> 50 tỷ</span></div>
                                            </div>

                                            <div id="select_khoang_gia_cho_thue_bds_du_an" class="popup-select-fixed-content-body display_none_important">
                                                <div rel="Tất Cả"                       class="select-khoang-gia-cho-thue-bds_mobile border-bottom item-popup-select p-2-5 current">Tất cả</div>
                                                <div rel="< 1 triệu"                    class="select-khoang-gia-cho-thue-bds_mobile border-bottom item-popup-select p-2-5"><span>< 1 triệu</span></div>
                                                <div rel="1 - 3 triệu"                  class="select-khoang-gia-cho-thue-bds_mobile border-bottom item-popup-select p-2-5"><span>1 - 3 triệu</span></div>
                                                <div rel="3 - 5 triệu"                  class="select-khoang-gia-cho-thue-bds_mobile border-bottom item-popup-select p-2-5"><span>3 - 5 triệu</span></div>
                                                <div rel="5 - 7 triệu"                  class="select-khoang-gia-cho-thue-bds_mobile border-bottom item-popup-select p-2-5"><span>5 - 7 triệu</span></div>
                                                <div rel="7 - 10 triệu"                 class="select-khoang-gia-cho-thue-bds_mobile border-bottom item-popup-select p-2-5"><span>7 - 10 triệu</span></div>
                                                <div rel="10 - 30 triệu"                class="select-khoang-gia-cho-thue-bds_mobile border-bottom item-popup-select p-2-5"><span>10 - 30 triệu</span></div>
                                                <div rel="30 - 50 triệu"                class="select-khoang-gia-cho-thue-bds_mobile border-bottom item-popup-select p-2-5"><span>30 - 50 triệu</span></div>
                                                <div rel="50 - 100 triệu"               class="select-khoang-gia-cho-thue-bds_mobile border-bottom item-popup-select p-2-5"><span>50 - 100 triệu</span></div>
                                                <div rel="> 100 triệu"                  class="select-khoang-gia-cho-thue-bds_mobile border-bottom item-popup-select p-2-5"><span>> 100 triệu</span></div>
                                                
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- END Khoảng Giá -->

                    <!--Chủ Đầu Tư -->
                        <div class="mt-4">
                            <div class="search-mobile-box-item mb-3 mr-2 ml-2">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">Chủ đầu tư</span>
                                                <span id="lua_chon_chu_dau_tu_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input_khoang_gia_bds-->
                                            <div id="input_chu_dau_tu_bds" style="display:none;"></div>
                                            <!--END input_khoang_gia_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_chu_dau_tu_bds" class="popup-fixed off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">Chủ đầu tư</b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div class="p-2 mt-2">
                                                    <input id="search_chu_dau_tu_mobile" onkeyup="search_chu_dau_tu_mobile()" class="form-control mb-0" placeholder="Tìm kiếm">
                                                </div>
                                                <div id="chu_dau_tu_mobile_list">
                                                    <div rel="" class="select-chu-dau-tu-bds_mobile border-bottom item-popup-select p-2-5 current"><span>Tất Cả</span></div>
                                                    <?php foreach($chu_dau_tu_list as $chu_dau_tu): ?>
                                                    <div rel="<?php echo $chu_dau_tu->id ?>" class="select-chu-dau-tu-bds_mobile border-bottom item-popup-select p-2-5"><span><?php echo json_decode($chu_dau_tu->prefix).' '.json_decode($chu_dau_tu->name); ?></span></div>
                                                    <?php endforeach; ?>

                                                </div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!--END Chủ Đầu Tư-->
                    
                    <!-- Trạng Thái BĐS-->
                        <div class="search-mobile-box-item mt-4 mr-2 ml-2">
                            <div class="list-category-search">
                                <div>
                                    <div class="hasValue box-item-popup-search">
                                        <span class="display-flex flex-center div-full showBoxPopup">
                                            <div class="display-grid flex-first">
                                                <span class="label-item">Trạng thái</span>
                                                <span id="lua_chon_trang_thai_bds" class="box-item-selected-name">Tất Cả</span>
                                            </div>
                                            <!--input loai_hinh_bds-->
                                            <div id="input_trang_thai_du_an_bds" style="display:none;">Tất Cả</div>
                                            <!--END input loai_hinh_bds-->
                                            <i class="text-placeholder fa fa-angle-right"></i>
                                        </span>
                                    </div>
                                    <div id="danh_sach_trang_thai_bds" class="popup-fixed off">
                                        <div class="popup-select-fixed-content show">
                                            <div class="display-flex p-2-5 flex-center border-bottom">
                                                <b class="text-center div-full">Trạng thái </b>
                                                <span class="x-close-mini"></span>
                                            </div>
                                            <div class="popup-select-fixed-content-body">
                                                <div rel="Tất Cả"           class="select-trang-thai-bds_mobile border-bottom item-popup-select p-2-5 current">Tất Cả</div>
                                                <div rel="Đang Cập Nhật"    class="select-trang-thai-bds_mobile border-bottom item-popup-select p-2-5"><span>Đang Cập Nhật</span></div>
                                                <div rel="Sắp Mở Bán"       class="select-trang-thai-bds_mobile border-bottom item-popup-select p-2-5"><span>Sắp Mở Bán</span></div>
                                                <div rel="Đang Mở Bán"      class="select-trang-thai-bds_mobile border-bottom item-popup-select p-2-5"><span>Đang Mở Bán</span></div>
                                                <div rel="Đã Bàn Giao"      class="select-trang-thai-bds_mobile border-bottom item-popup-select p-2-5"><span>Đã Bàn Giao</span></div>
                                            </div>
                                        </div>
                                        <div class="popup-overlay"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <!-- END Trạng Thái BĐS-->
                    <div class="btn-box-search-mobile">
                        <span id="clear_input_search_mobile" class="btn-clear-search-mobile"><i class="fa fa-refresh mr-2"></i>Xóa bộ lọc</span>
                        <a id="button_search_mobile" class="btn-apply-search-mobile" style="color:white;"><i class="fa fa-search mr-2"></i>Áp dụng</a>
                    </div>
                </div>
            </div>
            `;
            jquery_search_du_an_mobile();
        }
        //Jquery Form Dự Án mobile
        function jquery_search_du_an_mobile(){
            console.log('dự án');
            $("#select_form_mua_ban_mobile").click(function(){
                render_form_mua_ban_mobile();
                create_url_to_search_mua_ban_mobile();
            });

            $("#select_form_cho_thue_mobile").click(function(){
                render_form_cho_thue_mobile();
                create_url_to_search_cho_thue_mobile();
            });

            $("#select_form_du_an_mobile").click(function(){
                render_form_du_an_mobile();
                create_url_to_search_du_an_mobile();
            });


            //tìm dự án theo tên
            $("#lua_chon_du_an_bds_theo_ten").click(function(){
                $("#danh_sach_du_an_bds_theo_ten").removeClass("off");
            });

            $(".select-du-an-bds-theo-ten_mobile").click(function(evt){
                $("#danh_sach_du_an_bds_theo_ten").addClass("off");
                $(".select-du-an-bds-theo-ten_mobile").removeClass("current");
                $(this).addClass('current');
                var value   = $(this).attr('rel');

                $("#lua_chon_du_an_bds_theo_ten").html(value);
                $("#input_chu_dau_tu_bds").html(value);
                create_url_to_search_du_an_mobile();
            });

            //loại hình giao dịch bds
            $("#lua_chon_loai_hinh_giao_dich_du_an_bds").click(function(){
                $("#danh_sach_loai_hinh_giao_dich_du_an_bds").removeClass("off");
            });
            
            $(".select-loai-hinh-giao-dich-du-an-bds_mobile").click(function(evt){
                $("#danh_sach_loai_hinh_giao_dich_du_an_bds").addClass("off");
                $(".select-loai-hinh-giao-dich-du-an-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                $(this).addClass('current');

                // change nội dung hiển thị form chọn khoảng giá
                if(value == 'Cho Thuê'){
                    $("#select_khoang_gia_ban_bds_du_an").addClass("display_none_important");
                    $("#select_khoang_gia_cho_thue_bds_du_an").removeClass("display_none_important");
                }else{
                    $("#select_khoang_gia_ban_bds_du_an").removeClass("display_none_important");
                    $("#select_khoang_gia_cho_thue_bds_du_an").addClass("display_none_important");
                }

                //reset các giá trị của phần chọn khoảng giá về mặc định
                $("#lua_chon_khoang_gia_bds").html('Tất Cả');
                $("#input_khoang_gia_bds").html('Tất Cả');
                $("#input_khoang_gia_cho_thue_bds").html('Tất Cả');

                $("#lua_chon_loai_hinh_giao_dich_du_an_bds").html(value);
                $("#input_loai_hinh_giao_dich_du_an_bds").html(value);
                create_url_to_search_du_an_mobile();
            });
            

            
            //loại hình bds
            $("#lua_chon_loai_hinh_bds").click(function(){
                $("#danh_sach_loai_hinh_bds").removeClass("off");
            });

            $(".select-loai-hinh-bds_mobile").click(function(evt){
                $("#danh_sach_loai_hinh_bds").addClass("off");
                var value = $(this).attr('rel');

                $(".check-loai-hinh-bds_mobile").html("");
                $(".check-loai-hinh-bds_mobile").removeClass("current");
                $(this).html('<div><span>' +value+'</span><span class="check-loai-hinh-bds_mobile current search-filter-item-radio"><i class="fa fa-circle"></i></span></div>');

                $("#lua_chon_loai_hinh_bds").html(value);
                $("#input_loai_hinh_bds").html(value);
                create_url_to_search_du_an_mobile();
            });

            //location city
            $("#lua_chon_city_bds").click(function(){
                $("#danh_sach_city_bds").removeClass("off");
            });

            $(".select-city-bds_mobile").click(function(evt){
                $("#danh_sach_city_bds").addClass("off");
                $(".select-city-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                if(value > '0'){ // không phải chọn tất cả
                    active_district_select();

                    //ẩn các quận / huyện của thành phố khác và hiển thị các quận của thành phố được chọn
                    var city_id = '.city_id' + value; //set class để hiển thị
                    
                    $(".district_list").addClass("display_none_important");
                    $(city_id).removeClass("display_none_important");
                }else{
                    disabled_district_select();
                }
                reset_district_id_input();

                $("#lua_chon_city_bds").html(name);
                $("#input_city_bds").html(value);
                create_url_to_search_du_an_mobile();
            });

            function active_district_select(){
                $("#select_districts").removeClass("disabled-selected-item");
                $("#danh_sach_district_bds").removeClass("display_none_important");
            }
            function disabled_district_select(){
                $("#select_districts").addClass("disabled-selected-item");
                $("#danh_sach_district_bds").addClass("display_none_important");
            }
            function reset_district_id_input(){
                $("#lua_chon_district_bds").html('Tất Cả');
                $("#input_district_bds").html('');
            }

            //location district
            $("#lua_chon_district_bds").click(function(){
                $("#danh_sach_district_bds").removeClass("off");
            });

            $(".select-district-bds_mobile").click(function(evt){
                $("#danh_sach_district_bds").addClass("off");
                $(".select-district-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                $("#lua_chon_district_bds").html(name);
                $("#input_district_bds").html(value);
                create_url_to_search_du_an_mobile();
            });

            //khoảng giá bán & cho thuê BDS
            $("#lua_chon_khoang_gia_bds").click(function(){
                $("#danh_sach_khoang_gia_bds").removeClass("off");
            });

            $(".select-khoang-gia-bds_mobile").click(function(evt){
                $("#danh_sach_khoang_gia_bds").addClass("off");
                $(".select-khoang-gia-bds_mobile").removeClass("current");
                $(".select-khoang-gia-cho-thue-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                $("#lua_chon_khoang_gia_bds").html(name);
                $("#input_khoang_gia_bds").html(value);
                $("#input_khoang_gia_cho_thue_bds").html('Tất Cả');
                
                create_url_to_search_du_an_mobile();
            });

            $(".select-khoang-gia-cho-thue-bds_mobile").click(function(evt){
                $("#danh_sach_khoang_gia_bds").addClass("off");
                $(".select-khoang-gia-cho-thue-bds_mobile").removeClass("current");
                $(".select-khoang-gia-bds_mobile").removeClass("current");
                var value = $(this).attr('rel');
                var name  = $(this).html();
                $(this).addClass('current');

                $("#lua_chon_khoang_gia_bds").html(name);
                $("#input_khoang_gia_bds").html('Tất Cả');
                $("#input_khoang_gia_cho_thue_bds").html(value);
                create_url_to_search_du_an_mobile();
            });

            //chủ đầu tư
            $("#lua_chon_chu_dau_tu_bds").click(function(){
                $("#danh_sach_chu_dau_tu_bds").removeClass("off");
            });

            $(".select-chu-dau-tu-bds_mobile").click(function(evt){
                $("#danh_sach_chu_dau_tu_bds").addClass("off");
                $(".select-chu-dau-tu-bds_mobile").removeClass("current");
                $(this).addClass('current');
                var value   = $(this).attr('rel');
                var name    = $(this).html();

                $("#lua_chon_chu_dau_tu_bds").html(name);
                $("#input_chu_dau_tu_bds").html(value);
                create_url_to_search_du_an_mobile();
            });

            //Trạng Thái Dự Án BDS
            $("#lua_chon_trang_thai_bds").click(function(){
                $("#danh_sach_trang_thai_bds").removeClass("off");
            });

            $(".select-trang-thai-bds_mobile").click(function(evt){
                $("#danh_sach_trang_thai_bds").addClass("off");
                $(".select-trang-thai-bds_mobile").removeClass("current");
                $(this).addClass('current');
                var value   = $(this).attr('rel');
                var name    = $(this).html();

                $("#lua_chon_trang_thai_bds").html(value);
                $("#input_trang_thai_du_an_bds").html(value);
                create_url_to_search_du_an_mobile();
            });


            //reset form tìm kiếm 
            $("#clear_input_search_mobile").click(function(){
                
                $("#lua_chon_loai_hinh_giao_dich_du_an_bds").html('Tất Cả');
                $("#input_loai_hinh_giao_dich_du_an_bds").html('Tất Cả');

                $("#lua_chon_loai_hinh_bds").html('Tất Cả');
                $("#input_loai_hinh_bds").html('Tất Cả');

                $("#lua_chon_city_bds").html('Tất Cả');
                $("#input_city_bds").html('');

                $("#lua_chon_district_bds").html('Tất Cả');
                $("#input_district_bds").html('');

                $("#lua_chon_khoang_gia_bds").html('Tất Cả');
                $("#input_khoang_gia_bds").html('Tất Cả');
                $("#input_khoang_gia_cho_thue_bds").html('Tất Cả');

                $("#lua_chon_khoang_gia_bds").html('Tất Cả');
                $("#input_khoang_gia_bds").html('Tất Cả');
                $("#input_khoang_gia_cho_thue_bds").html('Tất Cả');

                $("#lua_chon_chu_dau_tu_bds").html('Tất Cả');
                $("#input_chu_dau_tu_bds").html('');

                $("#lua_chon_trang_thai_bds").html('Tất Cả');
                $("#input_trang_thai_du_an_bds").html('Tất Cả');

                //reset hiển thị form chọn khoảng giá & quận huyện
                $("#select_khoang_gia_ban_bds_du_an").removeClass("display_none_important");
                $("#select_khoang_gia_cho_thue_bds_du_an").addClass("display_none_important");
                disabled_district_select();
                
                create_url_to_search_du_an_mobile();
            });



            //Tắt tất cả Modal 
            $(".x-close-mini").click(function(){
                $("#danh_sach_du_an_bds_theo_ten").addClass("off");
                $("#danh_sach_loai_hinh_giao_dich_du_an_bds").addClass("off");
                $("#danh_sach_loai_hinh_bds").addClass("off");
                $("#danh_sach_city_bds").addClass("off");
                $("#danh_sach_district_bds").addClass("off");
                $("#danh_sach_khoang_gia_bds").addClass("off");
                $("#danh_sach_chu_dau_tu_bds").addClass("off");
                $("#danh_sach_trang_thai_bds").addClass("off");
            });
        }

        function create_url_to_search_du_an_mobile(){
            var loai_hinh_mua_ban_bds   = document.getElementById('input_loai_hinh_giao_dich_du_an_bds').innerText;
            var loai_hinh_bds           = document.getElementById('input_loai_hinh_bds').innerText;
            var city_id                 = document.getElementById('input_city_bds').innerText;
            var districts_id            = document.getElementById('input_district_bds').innerText;
            var khoang_gia_bds          = document.getElementById('input_khoang_gia_bds').innerText;
            var khoang_gia_cho_thue_bds = document.getElementById('input_khoang_gia_cho_thue_bds').innerText;
            var chu_dau_tu_id           = document.getElementById('input_chu_dau_tu_bds').innerText;
            var trang_thai_bds          = document.getElementById('input_trang_thai_du_an_bds').innerText;

            //Gộp uri
            var uri =
                'danh-sach-bds?'            +
                '&du_an_status=1'           +
                '&loai_hinh_mua_ban_bds='   + (loai_hinh_mua_ban_bds) + 
                '&loai_hinh_bds='           + (loai_hinh_bds) +
                '&city_id='                 + city_id +
                '&districts_id='            + districts_id +
                '&khoang_gia_bds='          + khoang_gia_bds +
                '&khoang_gia_cho_thue_bds=' + khoang_gia_cho_thue_bds + 
                '&chu_dau_tu_id='           + chu_dau_tu_id +
                '&trang_thai_bds='          + trang_thai_bds
            ;
            
            console.log(uri);
            //Sau đó điều hướng khi nhấn vào button
            $('#button_search_mobile').attr('href','<?php echo base_url() ?>' + uri);
        }


        //auto complete tìm kiếm tỉnh thành
        function search_city_mobile() {
            // Declare variables
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById('search_city_mobile');
            filter = input.value.toUpperCase();
            ul = document.getElementById("city_mobile_list");
            li = ul.getElementsByTagName('div');

            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("span")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
                } else {
                li[i].style.display = "none";
                }
            }
        }

        //auto complete tìm kiếm quận huyện
        function search_district_mobile() {
            // Declare variables
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById('search_district_mobile');
            filter = input.value.toUpperCase();
            ul = document.getElementById("district_mobile_list");
            li = ul.getElementsByTagName('div');

            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("span")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
                } else {
                li[i].style.display = "none";
                }
            }
        }

        //auto complete tìm kiếm chủ đầu tư
        function search_chu_dau_tu_mobile() {
            // Declare variables
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById('search_chu_dau_tu_mobile');
            filter = input.value.toUpperCase();
            ul = document.getElementById("chu_dau_tu_mobile_list");
            li = ul.getElementsByTagName('div');

            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("span")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
                } else {
                li[i].style.display = "none";
                }
            }
        }

        //auto complete tìm kiếm dự án theo tên
        function search_du_an_mobile() {
            // Declare variables
            var input, filter, ul, li, a, i, txtValue;
            input = document.getElementById('search_du_an_mobile');
            filter = input.value.toUpperCase();
            ul = document.getElementById("du_an_mobile_list");
            li = ul.getElementsByTagName('div');

            // Loop through all list items, and hide those who don't match the search query
            for (i = 0; i < li.length; i++) {
                a = li[i].getElementsByTagName("span")[0];
                txtValue = a.textContent || a.innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                li[i].style.display = "";
                } else {
                li[i].style.display = "none";
                }
            }
        }

        //các funtion cho mục tìm kiếm trên mobile, viết sau
    }else{
        //desktop
        let header = document.getElementById("main_header");
        header.innerHTML = `
            <div class="header-row">
                <div class="header-logo display-flex">
                    <span class="menu-mobile"><i class="fa fa-bars"></i></span>
                    <a href="<?php echo base_url() ?>" class="display-flex mr-3">
                        <img src = "<?php echo $data_site_info['logo_image_link']  ?>" alt="<?php echo $data_site_info['site_title'] ?>"/>
                    </a>
                </div>
                <div class="right-header-top display-flex flex-center">
                    <ul class="flex-first display-flex ul-menu-top hidden-md">
                        <li>
                            <span id="li_mua_ban_header" class="root">
                                <a id="a_mua_ban_header" href="<?php echo base_url('danh-sach-bds-mua-ban/?loai_hinh_mua_ban_bds=Mua Bán&du_an_status=0') ?>">Mua bán</a>
                            </span>
                            <div class="menu-full-screen">
                                <ul class="ul-menu-top-child">
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-nha-rieng/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Nhà Riêng&du_an_status=0') ?>">Nhà riêng</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-can-ho/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Căn Hộ&du_an_status=0') ?>">Căn hộ</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-biet-thu/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Biệt Thự&du_an_status=0') ?>">Biệt thự</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-shophouse/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Shophouse&du_an_status=0') ?>">Shop-house</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-penthouse/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Pent-house&du_an_status=0') ?>">Pent-house</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-dat/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Đất Bán&du_an_status=0') ?>">Đất bán</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-dat-nen/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Đất Nền&du_an_status=0') ?>">Đất nền</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-dat-cho-thue/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Đất Cho Thuê&du_an_status=0') ?>">Đất cho thuê</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-office-tel/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Office-tel&du_an_status=0') ?>">Office-tel</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-condotel/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Condotel&du_an_status=0') ?>">Condotel</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-kho-nha-xuong/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Kho, Nhà Xưởng&du_an_status=0') ?>">Kho, nhà xưởng</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-khu-nghi-duong-trang-trai/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Khu Nghỉ Dưỡng, Trang Trại&du_an_status=0') ?>">Khu nghỉ dưỡng, trang trại</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-van-phong/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Văn Phòng&du_an_status=0') ?>">Văn Phòng</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-mat-bang-cua-hang/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Mặt Bằng, Cửa Hàng&du_an_status=0') ?>">Mặt Tiền, Cửa Hàng</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-nha-tro-phong-tro/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=Nhà Trọ, Phòng Trọ&du_an_status=0') ?>">Nhà Trọ, Phòng Trọ</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-mua-nha-bds-loai-khac/?loai_hinh_mua_ban_bds=Mua Bán&loai_hinh_bds=BDS loại khác&du_an_status=0') ?>">Bất động sản khác</a></li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <span id="li_cho_thue_header" class="root">
                                <a id="a_cho_thue_header" href="<?php echo base_url('danh-sach-bds-cho-thue/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0') ?>">Cho thuê</a>
                            </span>
                            <div class="menu-full-screen">
                                <ul class="ul-menu-top-child">
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-nha-rieng/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Nhà Riêng') ?>">Nhà riêng</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-can-ho/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Căn Hộ') ?>">Căn hộ</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-biet-thu/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Biệt Thự') ?>">Biệt thự</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-shophouse/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Shophouse') ?>">Shop-house</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-penthouse/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Pent-house') ?>">Pent-house</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-dat-ban/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Đất Bán') ?>">Đất bán</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-dat-nen/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Đất Nền') ?>">Đất nền</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-dat/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Đất Cho Thuê') ?>">Đất cho thuê</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-office-tel/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Office-tel') ?>">Office-tel</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-condotel/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Condotel') ?>">Condotel</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-kho-nha-xuong/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Kho, Nhà Xưởng') ?>">Kho, Nhà Xưởng</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-khu-nghi-duong-trang-trai/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Khu Nghỉ Dưỡng, Trang Trại') ?>">Khu nghỉ dưỡng, trang trại</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-van-phong/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Văn Phòng') ?>">Văn Phòng</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-mat-bang-cua-hang/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Mặt Bằng, Cửa Hàng') ?>">Mặt Tiền, Cửa Hàng</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-nha-tro-phong-tro/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=Nhà Trọ, Phòng Trọ') ?>">Nhà Trọ, Phòng Trọ</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-cho-thue-bds-loai-khac/?loai_hinh_mua_ban_bds=Cho Thuê&du_an_status=0&loai_hinh_bds=BDS loại khác') ?>">Bất động sản khác</a></li>
                                </ul>
                            </div>
                        </li>
                        <li>
                            <span id="li_du_an_header" class="root">
                                <a id="a_du_an_header" href="<?php echo base_url('danh-sach-bds-du-an/?du_an_status=1') ?>">Dự án</a>
                            </span>
                            <div class="menu-full-screen">
                                <ul class="ul-menu-top-child">
                                    <li><a href="<?php echo base_url('danh-sach-bds-du-an-nha-pho/?du_an_status=1&loai_hinh_bds=Nhà Riêng') ?>">Nhà phố</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-du-an-can-ho/?du_an_status=1&loai_hinh_bds=Căn Hộ') ?>">Căn hộ</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-du-an-biet-thu/?du_an_status=1&loai_hinh_bds=Biệt Thự') ?>">Biệt thự</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-du-an-shophouse/?du_an_status=1&loai_hinh_bds=Shophouse') ?>">Shophouse</a></li>
                                    <li><a href="<?php echo base_url('danh-sach-bds-du-an-dat-nen/?du_an_status=1&loai_hinh_bds=Đất Nền') ?>">Đất nền</a></li>
                                </ul>
                            </div>
                        </li>
                    </ul>

                    <ul class="display-flex flex-center ul-menu-top hidden-ml">
                        <li>
                            <span class="root">
                                <a href="<?php echo base_url() ?>khu-vuc">Khu vực</a>
                            </span>
                        </li>
                        <li>
                            <span class="root">
                                <a href="<?php echo base_url() ?>tin-tuc">Tin tức</a>
                            </span>
                            <div class="menu-full-screen">
                                <ul class="ul-menu-top-child">
                                    <?php foreach($catalog_news_list as $row): ?>
                                    <li><a href="<?php echo $row['url']; ?>"><?php echo $row['name']; ?></a></li>
                                    <?php endforeach; ?>
                                </ul>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        `;
        
        <?php if(isset($query_du_an_status)): ?>
        var check_du_an = '<?php echo $query_du_an_status; ?>';
        <?php else: ?>
        var check_du_an = '0';
        <?php endif; ?>
        <?php if(isset($query_loai_hinh_mua_ban_bds)): ?>
        var check_loai_hinh_mua_ban_bds = '<?php echo json_decode($query_loai_hinh_mua_ban_bds); ?>';
        <?php else: ?>
        var check_loai_hinh_mua_ban_bds = '';
        <?php endif; ?>

        if(check_du_an == '1'){
            $('#a_du_an_header').attr('style',' text-decoration: underline var(--orange) solid;text-decoration-thickness: 2px;');
        }else{
            if(check_loai_hinh_mua_ban_bds == 'Mua Bán'){
                $('#a_mua_ban_header').attr('style',' text-decoration: underline var(--orange) solid;text-decoration-thickness: 2px;');
            }else{
                if(check_loai_hinh_mua_ban_bds == 'Cho Thuê'){
                    $('#a_cho_thue_header').attr('style',' text-decoration: underline var(--orange) solid;text-decoration-thickness: 2px;');
                }
            }
        }
    }
</script>
