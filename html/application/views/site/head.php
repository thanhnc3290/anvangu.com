<?php 
    if(isset($info)){
        $site_title     = json_decode($info->name);
        $meta_desc      = json_decode($info->meta_desc);
        $social_image_link  = public_url('site/images/no-image.jpg');
        if($info->image_link !== ''){
            $social_image_link = base_url('upload/project/'.$info->image_link);
        }
        $url_info       = base_url($info->alias.'-pr'.$info->id);
    }else{
        if(isset($head_danh_muc)){
            $site_title         = $head_danh_muc['site_title'];
            $meta_desc          = $head_danh_muc['meta_desc'];
            $social_image_link  = $data_head['social_image_link'];
            $url_info           = $head_danh_muc['url'];
        }else{
            $site_title         = $data_head['site_title'];
            $meta_desc          = $data_head['meta_desc'];
            $social_image_link  = $data_head['social_image_link'];
            $url_info           = base_url();
        }
    }

    
    
?>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $site_title ?></title>
    <link rel="shortcut icon" href="<?php echo $data_site_info['favicon_image_link']  ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=yes">
    <meta name='description' content="<?php echo $meta_desc; ?>">
    <meta property="og:type" content="website">
    <meta property="fb:app_id" content="772346889767048" />
    <meta property="og:url" content="<?php echo $url_info; ?>">
    <meta property="og:title" content="<?php echo $site_title; ?>">
    <meta property="og:description" content="<?php echo $meta_desc; ?>">
    <meta property="og:image" content="<?php echo $social_image_link; ?>" />
    <meta name='csrf-token' content=''>
    <script src="<?php echo public_url('site') ?>/js/jquery-3.5.1.min.js"></script>
    <?php echo $data_head['head_script']; ?>

    <script>
        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
            
            let scriptToAdd     = document.createElement('script');
            scriptToAdd.type    = 'text/javascript';
            scriptToAdd.src     = '<?php echo public_url('site') ?>/js/mobile.js';

            let scriptToAdd2     = document.createElement('script');
            scriptToAdd2.type    = 'text/javascript';
            scriptToAdd2.src     = '<?php echo public_url('site') ?>/js/multislider.js';
            
            let cssToAdd    = document.createElement('link');
            cssToAdd.rel   = 'stylesheet';
            //cssToAdd.href   = '<?php echo public_url('site') ?>/css/mobile.css';
            cssToAdd.href   = '<?php echo public_url('site') ?>/css/mobile_new.css';

            $('head').append(cssToAdd);
            $('head').append(scriptToAdd);
            $('head').append(scriptToAdd2);
            
        }else{
            
            let scriptToAdd     = document.createElement('script');
            scriptToAdd.type    = 'text/javascript';
            scriptToAdd.src     = '<?php echo public_url('site') ?>/js/app.js';
            

            let scriptToAdd2     = document.createElement('script');
            scriptToAdd2.type    = 'text/javascript';
            scriptToAdd2.src     = '<?php echo public_url('site') ?>/js/multislider.js';
            
            let cssToAdd    =   document.createElement('link');
            cssToAdd.rel    =   'stylesheet';
            cssToAdd.href   =   '<?php echo public_url('site') ?>/css/app.css';

            $('head').append(cssToAdd);
            $('head').append(scriptToAdd);
            $('head').append(scriptToAdd2);

        }
    </script>
    
    <script src="<?php echo public_url('site') ?>/js/bootstrap.bundle.min.js"></script>
   
    
    <style>
        /* .ul-list-new-home img {width:100%!important;height:auto!important;} */
        .min-width-70{min-width:70%;}
        .detail-content img{width:100%!important;height:auto!important;}
        #bottom-support{display:none!important;}
        .display_none_important{
            display:none!important;
        }
        .mixedSlider_1 , .mixedSlider_2, .mixedSlider_3, .mixedSlider_4, .mixedSlider_5 {
            position: relative;
        }
        .mixedSlider_1 .MS-content, .mixedSlider_2 .MS-content, .mixedSlider_3 .MS-content, .mixedSlider_4 .MS-content, .mixedSlider_5 .MS-content {
            white-space: nowrap;
            overflow: hidden;
            display: -webkit-inline-box;
        }
        .mixedSlider_1 .MS-content .item {
            display: inline-block;
            width: 24%!important;
            position: relative;
            vertical-align: top;
            overflow: hidden;
            height: 100%;
            white-space: normal;
            margin-left:5px;
            margin-right:5px;
        }
        .mixedSlider_2 .MS-content .item {
            display: inline-block;
            width: 24%!important;
            position: relative;
            vertical-align: top;
            overflow: hidden;
            height: 100%;
            white-space: normal;
            margin-left:5px;
            margin-right:5px;
        }
        .mixedSlider_3 .MS-content .item {
            display: inline-block;
            width: 31.5%!important;
            position: relative;
            vertical-align: top;
            overflow: hidden;
            height: 100%;
            white-space: normal;
            margin-left:10px;
            margin-right:10px;
        }
        .mixedSlider_4 .MS-content .item {
            display: inline-block;
            width: 24%!important;
            position: relative;
            vertical-align: top;
            overflow: hidden;
            height: 100%;
            white-space: normal;
            margin-left:5px;
            margin-right:5px;
        }

        .mixedSlider_5 .MS-content .item {
            display: inline-block;
            /* width: 19%!important; */
            position: relative;
            vertical-align: top;
            overflow: hidden;
            height: 100%;
            white-space: normal;
            margin-left:5px;
            margin-right:5px;
        }
        @media (max-width: 900px){
            .footer_hidden_on_mobile{
                display:none!important;
            }
            #tin-tuc-list{width:100%!important;}
        }
        @media (max-width: 768px) {
            
            .MS-content .item {
                display: inline-block;
                width: 50%!important;
                position: relative;
                vertical-align: top;
                overflow: hidden;
                height: 100%;
                white-space: normal;
            }
            .MS-content .item {
                display: inline-block;
                width: 50%!important;
                position: relative;
                vertical-align: top;
                overflow: hidden;
                height: 100%;
                white-space: normal;
            }
            .MS-content .item {
                display: inline-block;
                width: 50%!important;
                position: relative;
                vertical-align: top;
                overflow: hidden;
                height: 100%;
                white-space: normal;
            }
        }
        @media (max-width: 539px) {
            .footer_hidden_on_mobile{
                display:none!important;
            }
            .mixedSlider_1 .MS-content .item {
                display: inline-block;
                width: 100%!important;
                position: relative;
                vertical-align: top;
                overflow: hidden;
                height: 100%;
                white-space: normal;
            }
            .mixedSlider_2 .MS-content .item {
                display: inline-block;
                width: 100%!important;
                position: relative;
                vertical-align: top;
                overflow: hidden;
                height: 100%;
                white-space: normal;
            }
            .mixedSlider_3 .MS-content .item {
                display: inline-block;
                width: 100%!important;
                position: relative;
                vertical-align: top;
                overflow: hidden;
                height: 100%;
                white-space: normal;
            }
            .mixedSlider_4 .MS-content .item {
                display: inline-block;
                width: 100%!important;
                position: relative;
                vertical-align: top;
                overflow: hidden;
                height: 100%;
                white-space: normal;
            }

            .mixedSlider_5 .MS-content .item {
                display: inline-block;
                /* width: 100%!important; */
                position: relative;
                vertical-align: top;
                overflow: hidden;
                height: 100%;
                white-space: normal;
            }
        }
    </style>
</head>