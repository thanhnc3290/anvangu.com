<!DOCTYPE html>
<html lang="vi">

<?php $this->load->view('site/head'); ?>

<body>
    <div class="se-pre-con"></div>
    <style>
        .no-js #loader { display: none;  }
        .js #loader { display: block; position: absolute; left: 100px; top: 0; }
        .se-pre-con {
            position: fixed;
            left: 0px;
            top: 0px;
            width: 100%;
            height: 100%;
            z-index: 9999;
            background: url('<?php echo $data_site_info['logo_image_link']  ?>') center no-repeat #fff;
        }
    </style>
    <script>
        $(document).ready(function(){
            $(".se-pre-con").fadeOut('slow');
            console.log(' load completed');
        });
    </script>
    
    
    <?php echo $data_head['body_script']; ?>
    <?php $this->load->view('site/header'); ?>
    <?php $this->load->view($temp,$this->data); ?>
    <div class="notification"></div>
    <div class="overlay"></div>
    <div class="scrolltop">
        <span>
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512">
                <path
                    d="M374.6 246.6C368.4 252.9 360.2 256 352 256s-16.38-3.125-22.62-9.375L224 141.3V448c0 17.69-14.33 31.1-31.1 31.1S160 465.7 160 448V141.3L54.63 246.6c-12.5 12.5-32.75 12.5-45.25 0s-12.5-32.75 0-45.25l160-160c12.5-12.5 32.75-12.5 45.25 0l160 160C387.1 213.9 387.1 234.1 374.6 246.6z" />
            </svg>
        </span>
    </div>
    <div id="bottom-support" class="btn-show-support">
        <span class="display-flex flex-center">
            <i class="fa fa-icon-me fa-custom-message-white"></i>
            <span>Chat</span>
        </span>
    </div>
    <!--render ra phần header-->
    <script src="<?php echo base_url('render_header.js') ?>"></script>
    <!--end render ra phần header-->
    
    
</body>

</html>
