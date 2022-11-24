        <div class="div-relative">
            <div class="home-slider">
                
                <div class="slider-home owl-carousel owl-theme  owl-has-dot">
                    <?php 
                        foreach($data_banner as $row){
                            $link = '';
                            if($row['link']){
                                $link ='onclick ="window.open('.$row['link'].')"';
                            }
                            $image_link = base_url('upload/banner/'.$row['image_link']);
                            echo '<img alt="'.$row['name'].'" '.$link.' src="'.$image_link.'" />';
                        } 
                    ?>
                </div>
            </div>
            <?php $this->load->view('site/home/search_form_pc'); ?>
            
        </div>

