<div class="search-filter-box" style="" id="search_pc">
    <div class="container-fluid" id="HomeSearchPanel">
        <div class="search-suggest">
            <div class="rounded search-index-box div-relative">
                <!-- <div class="type-category-home">
                    <div id="search_form_mua_ban" class="item search-type search-buy"><span>Mua Bán</span></div>
                    <div id="search_form_cho_thue" class="item search-type search-buy"><span>Cho Thuê</span></div>
                    <div id="search_form_du_an" class="item search-type search-buy active"><span>Dự án</span></div>
                </div> -->
                <!-- cái này để input-->
                <!-- <div id="lua_chon_loai_hinh_mua_ban_bds" style="display:none!important;"><span>Dự án</span></div> -->
                <!-- end cái này để input-->
                <div class="search-box-inner">
                    <div class="display-flex flex-center" style="width:100%;">
                        <div class="search-input-box" style="border: 1px solid var(--bordercolor);border-radius: 25px;">
                            <div class="txt-box-search" id="key_search_form_pc" style="min-width:18%;width:18%;">
                                <input type="text" onkeyup="create_url_to_search_form_2();" class="search-input-panel"
                                    id="input_key_search" placeholder="Tìm kiếm địa điểm, khu vực..." value=""
                                    autocomplete="off">
                                <input type="text" id="location_input_id" value="" style="display:none!important;">
                                <input type="text" id="location_input_name" value="" style="display:none!important;">
                            </div>
                            <div class="list-group-search  pt-2 pb-2" id="search_box_0">
                                    <div class="list-category-search" >
                                        <span class="display-flex flex-center p-1 cursor" id="">
                                            <span class="flex-first name-string-suggest" id="lua_chon_form">Hình Thức </span><i class="fa fa-angle-down"></i>
                                        </span>
                                        <!--input loại Form -->
                                        <span id="lua_chon_loai_hinh_mua_ban_bds" style="display:none;">Tất Cả</span>
                                        <!-- end input loại For,-->
                                        <div id="danh_sach_form" class="off">
                                            <ul id="ul-suggest-search" class="custom-scroll-bar">
                                                
                                                <li><div id="search_form_mua_ban"   class="first-title select-loai-hinh-form"><span>Mua Bán</span></div></li>
                                                <li><div id="search_form_cho_thue"  class="first-title select-loai-hinh-form"><span>Cho Thuê</span></div></li>
                                                <li><div id="search_form_du_an"     class="first-title select-loai-hinh-form"><span>Dự Án</span></div></li>
                                            </ul>
                                        </div>
                                    </div>
                            </div>
                            <div class="list-group-search  pt-2 pb-2" id="search_box_1"></div>

                            <div class="panel-search-filter pt-2 pb-2 pr-2" id="search_box_2"></div>
                            <a id="button_search_pc">
                                <button class="btn btn-search-panel btn-orange" style="min-width:unset;">
                                <i class="fa fa-search"></i></button>
                            </a>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    //auto-complete cho form search_1
    function autocomplete_1(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) { return false;}
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    //explode giá trị
                    const myArray   = arr[i].split("||||");
                    let city_name   = myArray[0];
                    let city_id     = myArray[1];
                    
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + city_name.substr(0, val.length) + "</strong>";
                b.innerHTML += city_name.substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' id='"+city_id+"' class='auto-input-location' value='" + city_name + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value         = this.getElementsByTagName("input")[0].value;
                    //var input_value   = this.getElementsByTagName("input")[0].value;
                    console.log('Location Name: ' + this.getElementsByTagName("input")[0].value);
                    console.log('Location id: ' + this.getElementsByTagName("input")[0].id);
                    document.getElementById('location_input_id').setAttribute('value',this.getElementsByTagName("input")[0].id);
                    document.getElementById('location_input_name').setAttribute('value',this.getElementsByTagName("input")[0].value);
                    //render url danh-sach-bds
                    create_url_to_search_form_1();
                    
                    

                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
                }
            }
        });
        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }
        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
            }
        }
        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }

    //auto-complete cho form search_2
    function autocomplete_2(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) { return false;}
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    //explode giá trị
                    const myArray   = arr[i].split("||||");
                    let city_name   = myArray[0];
                    let city_id     = myArray[1];
                    
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + city_name.substr(0, val.length) + "</strong>";
                b.innerHTML += city_name.substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' id='"+city_id+"' class='auto-input-location' value='" + city_name + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value         = this.getElementsByTagName("input")[0].value;
                    //var input_value   = this.getElementsByTagName("input")[0].value;
                    console.log('Location Name: ' + this.getElementsByTagName("input")[0].value);
                    console.log('Location id: ' + this.getElementsByTagName("input")[0].id);
                    document.getElementById('location_input_id').setAttribute('value',this.getElementsByTagName("input")[0].id);
                    document.getElementById('location_input_name').setAttribute('value',this.getElementsByTagName("input")[0].value);
                    //render url danh-sach-bds
                    create_url_to_search_form_2();
                    
                    

                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
                }
            }
        });
        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }
        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
            }
        }
        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }

    //auto-complete cho form search_2
    function autocomplete_3(inp, arr) {
        /*the autocomplete function takes two arguments,
        the text field element and an array of possible autocompleted values:*/
        var currentFocus;
        /*execute a function when someone writes in the text field:*/
        inp.addEventListener("input", function(e) {
            var a, b, i, val = this.value;
            /*close any already open lists of autocompleted values*/
            closeAllLists();
            if (!val) { return false;}
            currentFocus = -1;
            /*create a DIV element that will contain the items (values):*/
            a = document.createElement("DIV");
            a.setAttribute("id", this.id + "autocomplete-list");
            a.setAttribute("class", "autocomplete-items");
            /*append the DIV element as a child of the autocomplete container:*/
            this.parentNode.appendChild(a);
            /*for each item in the array...*/
            for (i = 0; i < arr.length; i++) {
                /*check if the item starts with the same letters as the text field value:*/
                if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
                    //explode giá trị
                    const myArray   = arr[i].split("||||");
                    let city_name   = myArray[0];
                    let city_id     = myArray[1];
                    
                /*create a DIV element for each matching element:*/
                b = document.createElement("DIV");
                /*make the matching letters bold:*/
                b.innerHTML = "<strong>" + city_name.substr(0, val.length) + "</strong>";
                b.innerHTML += city_name.substr(val.length);
                /*insert a input field that will hold the current array item's value:*/
                b.innerHTML += "<input type='hidden' id='"+city_id+"' class='auto-input-location' value='" + city_name + "'>";
                /*execute a function when someone clicks on the item value (DIV element):*/
                b.addEventListener("click", function(e) {
                    /*insert the value for the autocomplete text field:*/
                    inp.value         = this.getElementsByTagName("input")[0].value;
                    //var input_value   = this.getElementsByTagName("input")[0].value;
                    console.log('Location Name: ' + this.getElementsByTagName("input")[0].value);
                    console.log('Location id: ' + this.getElementsByTagName("input")[0].id);
                    document.getElementById('location_input_id').setAttribute('value',this.getElementsByTagName("input")[0].id);
                    document.getElementById('location_input_name').setAttribute('value',this.getElementsByTagName("input")[0].value);
                    //render url danh-sach-bds
                    create_url_to_search_form_3();
                    
                    

                    /*close the list of autocompleted values,
                    (or any other open lists of autocompleted values:*/
                    closeAllLists();
                });
                a.appendChild(b);
                }
            }
        });
        /*execute a function presses a key on the keyboard:*/
        inp.addEventListener("keydown", function(e) {
            var x = document.getElementById(this.id + "autocomplete-list");
            if (x) x = x.getElementsByTagName("div");
            if (e.keyCode == 40) {
                /*If the arrow DOWN key is pressed,
                increase the currentFocus variable:*/
                currentFocus++;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 38) { //up
                /*If the arrow UP key is pressed,
                decrease the currentFocus variable:*/
                currentFocus--;
                /*and and make the current item more visible:*/
                addActive(x);
            } else if (e.keyCode == 13) {
                /*If the ENTER key is pressed, prevent the form from being submitted,*/
                e.preventDefault();
                if (currentFocus > -1) {
                /*and simulate a click on the "active" item:*/
                if (x) x[currentFocus].click();
                }
            }
        });
        function addActive(x) {
            /*a function to classify an item as "active":*/
            if (!x) return false;
            /*start by removing the "active" class on all items:*/
            removeActive(x);
            if (currentFocus >= x.length) currentFocus = 0;
            if (currentFocus < 0) currentFocus = (x.length - 1);
            /*add class "autocomplete-active":*/
            x[currentFocus].classList.add("autocomplete-active");
        }
        function removeActive(x) {
            /*a function to remove the "active" class from all autocomplete items:*/
            for (var i = 0; i < x.length; i++) {
            x[i].classList.remove("autocomplete-active");
            }
        }
        function closeAllLists(elmnt) {
            /*close all autocomplete lists in the document,
            except the one passed as an argument:*/
            var x = document.getElementsByClassName("autocomplete-items");
            for (var i = 0; i < x.length; i++) {
            if (elmnt != x[i] && elmnt != inp) {
                x[i].parentNode.removeChild(x[i]);
            }
            }
        }
        /*execute a function when someone clicks in the document:*/
        document.addEventListener("click", function (e) {
            closeAllLists(e.target);
        });
    }

    <?php 
        //Lấy danh sách thành phô
        $input = array();
        $input['order'] = array('id','asc');
        $this->db->select('id, name');
        $city_list      = $this->city_model->get_list($input);
        foreach ($city_list as $city){
            $input['where'] = array('city_id' => $city->id);
            $input['order'] = array('id', 'ASC');
            $this->db->select('id, name');
            $districts_list = $this->districts_model->get_list($input);
            $city->districts = $districts_list;
            // foreach($districts_list as $districts){
            //     $input['where'] = array('districts_id' => $districts->id);
            //     $input['order'] = array('id', 'ASC');
            //     $this->db->select('id, name');
            //     $wards_list = $this->wards_model->get_list($input);
            //     $districts->wards = $wards_list;
            // }
        }
    ?>

    /*An array containing all the country names in the world:*/
    var locations = [
        <?php foreach($city_list as $city): ?>
        "<?php echo json_decode($city->name); ?>||||-find-city_id<?php echo $city->id ?>",
            <?php foreach($city->districts as $districts): ?>
                "<?php echo json_decode($districts->name); ?>, <?php echo json_decode($city->name); ?>||||-find-city_id<?php echo $city->id ?>-find-districts_id<?php echo $districts->id ?>",
            <?php endforeach; ?>
        <?php endforeach; ?>
    ];

    /*initiate the autocomplete function on the "myInput" element, and pass along the countries array as possible autocomplete values:*/
    autocomplete_1(document.getElementById("input_key_search"), locations);

    function search_chu_dau_tu() {
        // Declare variables
        var input, filter, ul, li, a, i, txtValue;
        input = document.getElementById('search_chu_dau_tu');
        filter = input.value.toUpperCase();
        ul = document.getElementById("danh_sach_chu_dau_tu");
        li = ul.getElementsByTagName('li');

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
</script>


<script>
    var check_du_an = '<?php echo $query_du_an_status; ?>';
    var check_loai_hinh_mua_ban_bds = '<?php echo json_decode($query_loai_hinh_mua_ban_bds); ?>';
    //Trên Mobile thì xóa rỗng vùng search_pc
    if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)){
        document.getElementById('search_pc').innerHTML = '';
    }else{
        if(check_du_an == '1'){
            
            render_search_pc_form_2();
            Jquery_total_form_2();
            create_url_to_search_form_2();
            autocomplete_2(document.getElementById("input_key_search"), locations);
        }else{
            if(check_loai_hinh_mua_ban_bds == ''){
                render_search_pc_form_1();
                Jquery_total_form_1();
                create_url_to_search_form_1();
                autocomplete_1(document.getElementById("input_key_search"), locations);
            }else{
                if(check_loai_hinh_mua_ban_bds == 'Mua Bán'){
                    render_search_pc_form_1();
                    Jquery_total_form_1();
                    create_url_to_search_form_1();
                    autocomplete_1(document.getElementById("input_key_search"), locations);
                }else{
                    if(check_loai_hinh_mua_ban_bds == 'Cho Thuê'){
                        render_search_pc_form_3();
                        Jquery_total_form_3();
                        create_url_to_search_form_3();
                        autocomplete_3(document.getElementById("input_key_search"), locations);
                    }
                }
            }
        }

        //Mặc Định trên Render form 1
        // render_search_pc_form_1();
        // Jquery_total_form_1();
        // create_url_to_search_form_1();
        // autocomplete_1(document.getElementById("input_key_search"), locations);
    }
    //Render form search trên pc theo 3 dạng
    //Mua Bán
    function render_search_pc_form_1(){
        document.getElementById('key_search_form_pc').innerHTML = `
            <input type="text" onkeyup="create_url_to_search_form_1();" class="search-input-panel" id="input_key_search" placeholder="Tìm kiếm địa điểm, khu vực..." value=""  autocomplete="off">
            <input type="text" id="location_input_id" value=""  style="display:none!important;">
            <input type="text" id="location_input_name" value=""  style="display:none!important;">
        `;

        if(check_loai_hinh_mua_ban_bds == 'Mua Bán'){
            document.getElementById('lua_chon_form').innerHTML = 'Mua Bán';
            document.getElementById('lua_chon_loai_hinh_mua_ban_bds').innerHTML = 'Mua Bán';
        }

        document.getElementById('search_box_1').innerHTML = `
                                    
                                    <div class="list-category-search" >
                                        <span class="display-flex flex-center p-1 cursor" id="showBoxSuggestChild">
                                            <span class="flex-first name-string-suggest" id="lua_chon_loai_hinh_bds">Loại Hình</span><i class="fa fa-angle-down"></i>
                                        </span>
                                        <!--input vị trí -->
                                        <span id="input_loai_hinh_bds" style="display:none;">Tất Cả</span>
                                        <!-- end input vị trí-->
                                        <div id="loai_hinh_bds" class="off">
                                            <ul id="ul-suggest-search" class="custom-scroll-bar">
                                                <li class="li_tieu_de"><div class="first-title current"><span>Tất Cả nhà đất</span></div></li>
                                                <li>
                                                    <ul>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Tất Cả</span></div></li>
                                                    </ul>
                                                </li>
                                                <li class="li_tieu_de">
                                                    <div class="first-title"><span>Nhà</span></div>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Nhà Riêng</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Căn Hộ</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Biệt Thự</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Shophouse</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Pent-house</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Condotel</span></div></li>
                                                    </ul>
                                                </li>
                                                <li class="li_tieu_de">
                                                    <div class="first-title"><span>Đất</span></div>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Đất Bán</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Đất Nền</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Đất Cho Thuê</span></div></li>
                                                    </ul>
                                                </li>
                                                <li class="li_tieu_de">
                                                    <div class="first-title"><span>Bất động sản các loại</span></div>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Kho, Nhà Xưởng</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Khu Nghỉ Dưỡng, Trang Trại</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Văn Phòng</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Mặt Bằng, Cửa Hàng</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Nhà Trọ, Phòng Trọ</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>BDS loại khác</span></div></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
        `;
        document.getElementById('search_box_2').innerHTML = `
                                        <div class="ul">
                                            <!-- Select Khoảng Giá-->
                                            <div class="showBoxSuggestChild">
                                                <div class="display-flex flex-center cursor p-1">
                                                    <span class="flex-first" id="lua_chon_khoang_gia_bds"><span class="text-with-sup"><i class="fa mr-1 fa-usd"></i> Khoảng giá</span></span>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                                <!--input khoảng giá -->
                                                <span id="input_khoang_gia_bds" style="display:none;">Tất Cả</span>
                                                <!-- end input khoảng giá-->
                                                <!--Cái này click mới hiện-->
                                                <div class="bg-white suggest-children off" id="danh_sach_khoang_gia">
                                                    <div>
                                                        <div class="p-2">
                                                            <div class="suggest-slider">
                                                                <div class="slider-range-user">
                                                                                            
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="select-range-user custom-scroll-bar">
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-all">Tất Cả</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-12">Đến 500 triệu</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-13">Từ 500 - Đến 800 triệu</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-55">Từ 800 triệu - Đến 1 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-56">Từ 1 tỷ - Đến 2 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-57">Từ 2 tỷ - Đến 3 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-58">Từ 3 tỷ - Đến 5 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-59">Từ 5 tỷ - Đến 7 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-60">Từ 7 tỷ - Đến 10 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-61">Từ 10 tỷ - Đến 20 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-62">Từ 20 tỷ - Đến 30 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-63">Từ 30 tỷ - Đến 50 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-64">Từ 50 tỷ</label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--END Cái này click mới hiện-->
                                            </div>
                                            <!-- END Select Khoảng Giá-->
                                            <!-- Select Diện Tích-->
                                            <div class="showBoxSuggestChild">
                                                <div class="display-flex flex-center cursor p-1">
                                                    <span class="flex-first">
                                                        <span class="text-with-sup" id="lua_chon_dien_tich_bds"><i class="fa mr-1 fa-icon-me fa-custom-square"></i> Diện tích</span>
                                                    </span>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                                <!--input diện tích -->
                                                <span id="input_dien_tich_bds" style="display:none;">Tất Cả</span>
                                                <!-- end input diện tích-->
                                                <!--Cái này click mới hiện-->
                                                <div class="bg-white suggest-children off" id="danh_sach_dien_tich">
                                                    <div>
                                                        <div class="p-2">
                                                            <div class="suggest-slider">
                                                                <div class="slider-range-user"></div>
                                                            </div>
                                                        </div>
                                                        <div class="select-range-user custom-scroll-bar">
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-all">Tất Cả</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-14">Đến 30 m²</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-15">Từ 30 m² - Đến 50 m²</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-72">Từ 50 m² - Đến 80 m²</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-73">Từ 80 m² - Đến 100 m²</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-74">Từ 100 m² - Đến 300 m²</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-75">Từ 300 m² - Đến 500 m²</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-76">Từ 500 m²</label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--END Cái này click mới hiện-->
                                            </div>
                                            <!-- END Select Diện Tích-->
                                            <!-- Select Hướng Nhà-->
                                            <div class="showBoxSuggestChild">
                                                <div class="display-flex flex-center cursor p-1">
                                                    <span class="flex-first">
                                                        <span class="text-with-sup" id="lua_chon_huong_nha_bds"><i class="fa mr-1 fa-icon-me fa-custom-direction"></i> Hướng</span>
                                                    </span>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                                <!--input hướng nhà -->
                                                <span id="input_huong_nha_bds" style="display:none;">Tất Cả</span>
                                                <!-- end input hướng nhà-->
                                                <!--Cái này click mới hiện-->
                                                <div class="bg-white suggest-children off" id="danh_sach_huong_nha">
                                                    <div>
                                                        <div class="p-2">
                                                            <div class="suggest-slider">
                                                                <div class="slider-range-user"></div>
                                                            </div>
                                                        </div>
                                                        <div class="select-range-user custom-scroll-bar">
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-all">Tất Cả</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-14">Đông</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-15">Tây</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-72">Nam</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-73">Bắc</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-74">Đông Bắc</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-75">Đông Nam</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-76">Tây Bắc</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-76">Tây Nam</label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--END Cái này click mới hiện-->
                                            </div>
                                            <!-- END Select Hướng Nhà-->
                                            <!-- Select Vị Trí-->
                                            <div class="showBoxSuggestChild">
                                                <div class="display-flex flex-center cursor p-1">
                                                    <span class="flex-first">
                                                        <span class="text-with-sup" id="lua_chon_vi_tri_bds"><i class="fa mr-1 fa-icon-me fa-custom-map-marker"></i> Vị trí</span>
                                                    </span>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                                <!--input vị trí -->
                                                <span id="input_vi_tri_bds" style="display:none;">Tất Cả</span>
                                                <!-- end input vị trí-->
                                                <!--Cái này click mới hiện-->
                                                <div class="bg-white suggest-children off" id="danh_sach_vi_tri">
                                                    <div>
                                                        <div class="p-2">
                                                            <div class="suggest-slider">
                                                                <div class="slider-range-user"></div>
                                                            </div>
                                                        </div>
                                                        <div class="select-range-user custom-scroll-bar">
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-vi-tri"><label for="select-range-all">Tất Cả</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-vi-tri"><label for="select-range-14">Mặt Hẻm</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-vi-tri"><label for="select-range-15">Mặt Tiền</label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--END Cái này click mới hiện-->
                                            </div>
                                            <!-- END Select Vị Trí-->
                                            <!-- Tìm Theo Tên-->
                                            <div class="showBoxSuggestChild" style="display:none!important;">
                                                <span class="display-flex flex-center p-1 cursor" id="showBoxSuggestChild">
                                                    <span class="flex-first name-string-suggest" id="lua_chon_tim_theo_ten">Tìm Theo Tên</span><i class="fa fa-angle-down"></i>
                                                </span>
                                                <!--input vị trí -->
                                                <span id="input_tim_theo_ten" style="display:none;">0</span>
                                                <!-- end input vị trí-->
                                                <div id="danh_sach_tim_theo_ten" class="off"  style="width: 660px!important;right: 0px;">
                                                    <input type="text" id="search_tim_theo_ten" onkeyup="create_url_to_search_form_1()" placeholder="Tìm Kiếm Dự Án.." style="width: 98%;border-radius: 25px;margin: 5px;">
                                                    
                                                </div>
                                            </div>
                                            <!-- END Tìm Theo Tên-->
                                        </div>
                                        
        `;
        Jquery_total_form_1();
        autocomplete_1(document.getElementById("input_key_search"), locations);
    }

    //Cho thuê
    function render_search_pc_form_3(){
        document.getElementById('key_search_form_pc').innerHTML = `
            <input type="text" onkeyup="create_url_to_search_form_3();" class="search-input-panel" id="input_key_search" placeholder="Tìm kiếm địa điểm, khu vực..." value=""  autocomplete="off">
            <input type="text" id="location_input_id" value=""  style="display:none!important;">
            <input type="text" id="location_input_name" value=""  style="display:none!important;">
        `;
        if(check_loai_hinh_mua_ban_bds == 'Cho Thuê'){
            document.getElementById('lua_chon_form').innerHTML = 'Cho Thuê';
            document.getElementById('lua_chon_loai_hinh_mua_ban_bds').innerHTML = 'Cho Thuê';
        }

        document.getElementById('search_box_1').innerHTML = `
                                    <div class="list-category-search" >
                                        <span class="display-flex flex-center p-1 cursor" id="showBoxSuggestChild">
                                            <span class="flex-first name-string-suggest" id="lua_chon_loai_hinh_bds">Tất Cả</span><i class="fa fa-angle-down"></i>
                                        </span>
                                        <!--input vị trí -->
                                        <span id="input_loai_hinh_bds" style="display:none;">Tất Cả</span>
                                        <!-- end input vị trí-->
                                        <div id="loai_hinh_bds" class="off">
                                            <ul id="ul-suggest-search" class="custom-scroll-bar">
                                                <li class="li_tieu_de"><div class="first-title current"><span>Tất Cả nhà đất</span></div></li>
                                                <li>
                                                    <ul>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Tất Cả</span></div></li>
                                                    </ul>
                                                </li>
                                                <li class="li_tieu_de">
                                                    <div class="first-title"><span>Nhà</span></div>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Nhà Riêng</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Căn Hộ</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Biệt Thự</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Shophouse</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Pent-house</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Condotel</span></div></li>
                                                    </ul>
                                                </li>
                                                <li class="li_tieu_de">
                                                    <div class="first-title"><span>Đất</span></div>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Đất Bán</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Đất Nền</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Đất Cho Thuê</span></div></li>
                                                    </ul>
                                                </li>
                                                <li class="li_tieu_de">
                                                    <div class="first-title"><span>Bất động sản các loại</span></div>
                                                </li>
                                                <li>
                                                    <ul>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Kho, Nhà Xưởng</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Khu Nghỉ Dưỡng, Trang Trại</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Văn Phòng</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Mặt Bằng, Cửa Hàng</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>Nhà Trọ, Phòng Trọ</span></div></li>
                                                        <li><div class="title-sub select-loai-hinh-bds"><span>BDS loại khác</span></div></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
        `;
        document.getElementById('search_box_2').innerHTML = `
                                        <div class="ul">
                                            <!-- Select Khoảng Giá-->
                                            <div class="showBoxSuggestChild">
                                                <div class="display-flex flex-center cursor p-1">
                                                    <span class="flex-first" id="lua_chon_khoang_gia_bds"><span class="text-with-sup"><i class="fa mr-1 fa-usd"></i> Khoảng giá</span></span>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                                <!--input khoảng giá -->
                                                <span id="input_khoang_gia_bds" style="display:none;">Tất Cả</span>
                                                <!-- end input khoảng giá-->
                                                <!--Cái này click mới hiện-->
                                                <div class="bg-white suggest-children off" id="danh_sach_khoang_gia">
                                                    <div>
                                                        <div class="p-2">
                                                            <div class="suggest-slider">
                                                                <div class="slider-range-user">
                                                                                            
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="select-range-user custom-scroll-bar">
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-all">Tất Cả</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-12">< 1 triệu</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-13">1 - 3 triệu</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-55">3 - 5 triệu</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-56">5 - 7 triệu</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-57">7 - 10 triệu</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-58">10 - 30 triệu</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-59">30 - 50 triệu</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-60">50 - 100 triệu</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-61">> 100 triệu</label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--END Cái này click mới hiện-->
                                            </div>
                                            <!-- END Select Khoảng Giá-->
                                            <!-- Select Diện Tích-->
                                            <div class="showBoxSuggestChild">
                                                <div class="display-flex flex-center cursor p-1">
                                                    <span class="flex-first">
                                                        <span class="text-with-sup" id="lua_chon_dien_tich_bds"><i class="fa mr-1 fa-icon-me fa-custom-square"></i> Diện tích</span>
                                                    </span>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                                <!--input diện tích -->
                                                <span id="input_dien_tich_bds" style="display:none;">Tất Cả</span>
                                                <!-- end input diện tích-->
                                                <!--Cái này click mới hiện-->
                                                <div class="bg-white suggest-children off" id="danh_sach_dien_tich">
                                                    <div>
                                                        <div class="p-2">
                                                            <div class="suggest-slider">
                                                                <div class="slider-range-user"></div>
                                                            </div>
                                                        </div>
                                                        <div class="select-range-user custom-scroll-bar">
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-all">Tất Cả</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-14">Đến 30 m²</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-15">Từ 30 m² - Đến 50 m²</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-72">Từ 50 m² - Đến 80 m²</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-73">Từ 80 m² - Đến 100 m²</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-74">Từ 100 m² - Đến 300 m²</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-75">Từ 300 m² - Đến 500 m²</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-dien-tich"><label for="select-range-76">Từ 500 m²</label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--END Cái này click mới hiện-->
                                            </div>
                                            <!-- END Select Diện Tích-->
                                            <!-- Select Hướng Nhà-->
                                            <div class="showBoxSuggestChild">
                                                <div class="display-flex flex-center cursor p-1">
                                                    <span class="flex-first">
                                                        <span class="text-with-sup" id="lua_chon_huong_nha_bds"><i class="fa mr-1 fa-icon-me fa-custom-direction"></i> Hướng</span>
                                                    </span>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                                <!--input hướng nhà -->
                                                <span id="input_huong_nha_bds" style="display:none;">Tất Cả</span>
                                                <!-- end input hướng nhà-->
                                                <!--Cái này click mới hiện-->
                                                <div class="bg-white suggest-children off" id="danh_sach_huong_nha">
                                                    <div>
                                                        <div class="p-2">
                                                            <div class="suggest-slider">
                                                                <div class="slider-range-user"></div>
                                                            </div>
                                                        </div>
                                                        <div class="select-range-user custom-scroll-bar">
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-all">Tất Cả</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-14">Đông</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-15">Tây</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-72">Nam</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-73">Bắc</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-74">Đông Bắc</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-75">Đông Nam</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-76">Tây Bắc</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-huong-nha"><label for="select-range-76">Tây Nam</label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--END Cái này click mới hiện-->
                                            </div>
                                            <!-- END Select Hướng Nhà-->
                                            <!-- Select Vị Trí-->
                                            <div class="showBoxSuggestChild">
                                                <div class="display-flex flex-center cursor p-1">
                                                    <span class="flex-first">
                                                        <span class="text-with-sup" id="lua_chon_vi_tri_bds"><i class="fa mr-1 fa-icon-me fa-custom-map-marker"></i> Vị trí</span>
                                                    </span>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                                <!--input vị trí -->
                                                <span id="input_vi_tri_bds" style="display:none;">Tất Cả</span>
                                                <!-- end input vị trí-->
                                                <!--Cái này click mới hiện-->
                                                <div class="bg-white suggest-children off" id="danh_sach_vi_tri">
                                                    <div>
                                                        <div class="p-2">
                                                            <div class="suggest-slider">
                                                                <div class="slider-range-user"></div>
                                                            </div>
                                                        </div>
                                                        <div class="select-range-user custom-scroll-bar">
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-vi-tri"><label for="select-range-all">Tất Cả</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-vi-tri"><label for="select-range-14">Mặt Hẻm</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-vi-tri"><label for="select-range-15">Mặt Tiền</label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--END Cái này click mới hiện-->
                                            </div>
                                            <!-- END Select Vị Trí-->
                                            <!-- Tìm Theo Tên-->
                                            <div class="showBoxSuggestChild" style="display:none!important;">
                                                <span class="display-flex flex-center p-1 cursor" id="showBoxSuggestChild">
                                                    <span class="flex-first name-string-suggest" id="lua_chon_tim_theo_ten">Tìm Theo Tên</span><i class="fa fa-angle-down"></i>
                                                </span>
                                                <!--input vị trí -->
                                                <span id="input_tim_theo_ten" style="display:none;">0</span>
                                                <!-- end input vị trí-->
                                                <div id="danh_sach_tim_theo_ten" class="off"  style="width: 660px!important;right: 0px;">
                                                    <input type="text" id="search_tim_theo_ten" onkeyup="create_url_to_search_form_3()" placeholder="Tìm Kiếm Dự Án.." style="width: 98%;border-radius: 25px;margin: 5px;">
                                                    
                                                </div>
                                            </div>
                                            <!-- END Tìm Theo Tên-->
                                        </div>
                                        
        `;
        Jquery_total_form_3();
        autocomplete_3(document.getElementById("input_key_search"), locations);
    }
    //Dự Án
    function render_search_pc_form_2(){
        document.getElementById('key_search_form_pc').innerHTML = `
            <input type="text" onkeyup="create_url_to_search_form_2();" class="search-input-panel" id="input_key_search" placeholder="Tìm kiếm địa điểm, khu vực..." value=""  autocomplete="off">
            <input type="text" id="location_input_id" value=""  style="display:none!important;">
            <input type="text" id="location_input_name" value=""  style="display:none!important;">
        `;

        document.getElementById('lua_chon_form').innerHTML = 'Dự Án';
        document.getElementById('lua_chon_loai_hinh_mua_ban_bds').innerHTML = 'Dự Án';    

        document.getElementById('search_box_1').innerHTML = `
                                    <div class="list-category-search" >
                                        <span class="display-flex flex-center p-1 cursor" id="showBoxSuggestChild">
                                            <span class="flex-first name-string-suggest" id="lua_chon_loai_nha_dat_bds">Loại Nhà Đất</span><i class="fa fa-angle-down"></i>
                                        </span>
                                        <!--input loại nhà đất-->
                                        <span id="input_loai_nha_dat_bds" style="display:none;">Tất Cả</span>
                                        <!--END input loại nhà đất-->
                                        <div id="loai_nha_dat_bds" class="off">
                                            <ul id="ul-suggest-search" class="custom-scroll-bar">
                                                
                                                <li>
                                                    <ul>
                                                        <li><div class="title-sub select-loai-nha-dat-bds"><span>Tất Cả</span></div></li>
                                                        <li><div class="title-sub select-loai-nha-dat-bds"><span>Mua Bán</span></div></li>
                                                        <li><div class="title-sub select-loai-nha-dat-bds"><span>Cho Thuê</span></div></li>
                                                    </ul>
                                                </li>
                                                
                                            </ul>
                                        </div>
                                    </div>
        `;
        document.getElementById('search_box_2').innerHTML = `
                                        <div class="ul">
                                            <!-- Select Khoảng Giá-->
                                            <div class="showBoxSuggestChild">
                                                <div class="display-flex flex-center cursor p-1">
                                                    <span class="flex-first" id="lua_chon_khoang_gia_bds"><span class="text-with-sup"><i class="fa mr-1 fa-usd"></i> Khoảng giá</span></span>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                                <!--input khoảng giá -->
                                                <span id="input_khoang_gia_bds" style="display:none;">Tất Cả</span>
                                                <!-- end input khoảng giá-->
                                                <!--Cái này click mới hiện-->
                                                <div class="bg-white suggest-children off" id="danh_sach_khoang_gia">
                                                    <div>
                                                        <div class="p-2">
                                                            <div class="suggest-slider">
                                                                <div class="slider-range-user">
                                                                                            
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="select-range-user custom-scroll-bar">
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-all">Tất Cả</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-12">Đến 500 triệu</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-13">Từ 500 - Đến 800 triệu</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-55">Từ 800 triệu - Đến 1 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-56">Từ 1 tỷ - Đến 2 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-57">Từ 2 tỷ - Đến 3 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-58">Từ 3 tỷ - Đến 5 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-59">Từ 5 tỷ - Đến 7 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-60">Từ 7 tỷ - Đến 10 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-61">Từ 10 tỷ - Đến 20 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-62">Từ 20 tỷ - Đến 30 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-63">Từ 30 tỷ - Đến 50 tỷ</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-khoang-gia"><label for="select-range-64">Từ 50 tỷ</label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--END Cái này click mới hiện-->
                                            </div>
                                            <!-- END Select Khoảng Giá-->
                                            <!-- Select Trạng Thái-->
                                            <div class="showBoxSuggestChild">
                                                <div class="display-flex flex-center cursor p-1">
                                                    <span class="flex-first" id="lua_chon_trang_thai_bds"><span class="text-with-sup"><i class="fa mr-1 fa-calendar-minus-o"></i> Trạng Thái</span></span>
                                                    <i class="fa fa-angle-down"></i>
                                                </div>
                                                <!--input khoảng giá -->
                                                <span id="input_trang_thai_bds" style="display:none;">Tất Cả</span>
                                                <!-- end input khoảng giá-->
                                                <!--Cái này click mới hiện-->
                                                <div class="bg-white suggest-children off" id="danh_sach_trang_thai">
                                                    <div>
                                                        <div class="p-2">
                                                            <div class="suggest-slider">
                                                                <div class="slider-range-user">
                                                                                            
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="select-range-user custom-scroll-bar">
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-trang-thai"><label for="select-range-all">Tất Cả</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-trang-thai"><label for="select-range-12">Đang Cập Nhật</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-trang-thai"><label for="select-range-13">Sắp Mở Bán</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-trang-thai"><label for="select-range-12">Đang Mở Bán</label></div>
                                                            </div>
                                                            <div class="select-range-user-item cursor">
                                                                <div class="p-2 select-trang-thai"><label for="select-range-13">Đã Bàn Giao</label></div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--END Cái này click mới hiện-->
                                            </div>
                                            <!-- END Select Trạng Thái-->
                                            <!-- Select Loại hình BDS-->
                                            <div class="showBoxSuggestChild">
                                                <span class="display-flex flex-center p-1 cursor" id="showBoxSuggestChild">
                                                    <span class="flex-first name-string-suggest" id="lua_chon_loai_hinh_bds">Loại Hình</span><i class="fa fa-angle-down"></i>
                                                </span>
                                                <!--input vị trí -->
                                                <span id="input_loai_hinh_bds" style="display:none;">Tất Cả</span>
                                                <!-- end input vị trí-->
                                                <div id="loai_hinh_bds" class="off">
                                                    <ul id="ul-suggest-search" class="custom-scroll-bar">
                                                        <li class="li_tieu_de"><div class="first-title current"><span>Tất Cả nhà đất</span></div></li>
                                                        <li>
                                                            <ul>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>Tất Cả</span></div></li>
                                                            </ul>
                                                        </li>
                                                        <li class="li_tieu_de">
                                                            <div class="first-title"><span>Nhà</span></div>
                                                        </li>
                                                        <li>
                                                            <ul>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>Nhà Riêng</span></div></li>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>Căn Hộ</span></div></li>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>Biệt Thự</span></div></li>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>Shophouse</span></div></li>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>Pent-house</span></div></li>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>Condotel</span></div></li>
                                                            </ul>
                                                        </li>
                                                        <li class="li_tieu_de">
                                                            <div class="first-title"><span>Đất</span></div>
                                                        </li>
                                                        <li>
                                                            <ul>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>Đất Bán</span></div></li>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>Đất Nền</span></div></li>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>Đất Cho Thuê</span></div></li>
                                                            </ul>
                                                        </li>
                                                        <li class="li_tieu_de">
                                                            <div class="first-title"><span>Bất động sản các loại</span></div>
                                                        </li>
                                                        <li>
                                                            <ul>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>Kho, Nhà Xưởng</span></div></li>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>Khu Nghỉ Dưỡng, Trang Trại</span></div></li>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>Văn Phòng</span></div></li>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>Mặt Bằng, Cửa Hàng</span></div></li>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>Nhà Trọ, Phòng Trọ</span></div></li>
                                                                <li><div class="title-sub select-loai-hinh-bds"><span>BDS loại khác</span></div></li>
                                                            </ul>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- END Select Loại hình BDS-->
                                            

                                            <!-- Chủ Đầu Tư-->
                                            <div class="showBoxSuggestChild" style="display:none!important;">
                                                <span class="display-flex flex-center p-1 cursor" id="showBoxSuggestChild">
                                                    <span class="flex-first name-string-suggest" id="lua_chon_chu_dau_tu">Chủ Đầu Tư</span><i class="fa fa-angle-down"></i>
                                                </span>
                                                <!--input vị trí -->
                                                <span id="input_chu_dau_tu" style="display:none;">0</span>
                                                <!-- end input vị trí-->
                                                <div id="danh_sach_chu_dau_tu" class="off"  style="width: 660px!important;right: 0px;">
                                                    <input type="text" id="search_chu_dau_tu" onkeyup="search_chu_dau_tu()" placeholder="Tìm Kiếm Chủ Đầu Tư.." style="width: 98%;border-radius: 25px;margin: 5px;">
                                                    <ul id="chu_dau_tu_list" class="custom-scroll-bar">
                                                        <li><div class="first-title select-chu-dau-tu"><span>Tất Cả</span></div></li>
                                                       
                                                        <?php foreach($chu_dau_tu_list as $row): ?>
                                                            <?php
                                                                $chu_dau_tu_name = json_decode($row->prefix).' '.json_decode($row->name);
                                                            ?>
                                                        <li><div class="first-title select-chu-dau-tu" id="<?php echo $row->id ?>" rel="<?php echo json_decode($row->name); ?>"><span><?php echo $chu_dau_tu_name; ?> (CDT-<?php echo $row->id ?>)</span></div></li>
                                                        <?php endforeach; ?>
                                                    </ul>
                                                </div>
                                            </div>
                                            <!-- END Chủ Đầu Tư-->
                                            <!-- Tìm Theo Tên-->
                                            <div class="showBoxSuggestChild">
                                                <span class="display-flex flex-center p-1 cursor" id="showBoxSuggestChild" style="display:none!important;">
                                                    <span class="flex-first name-string-suggest" id="lua_chon_tim_theo_ten">Tìm Theo Tên</span><i class="fa fa-angle-down"></i>
                                                </span>
                                                <!--input vị trí -->
                                                <span id="input_tim_theo_ten" style="display:none;">0</span>
                                                <!-- end input vị trí-->
                                                <div id="danh_sach_tim_theo_ten" class="off"  style="width: 660px!important;right: 0px;">
                                                    <input type="text" id="search_tim_theo_ten" onkeyup="create_url_to_search_form_2()" placeholder="Tìm Kiếm Dự Án.." style="width: 98%;border-radius: 25px;margin: 5px;">
                                                    
                                                </div>
                                            </div>
                                            <!-- END Tìm Theo Tên-->

                                            
                                        </div>
        `;
        Jquery_total_form_2();
        autocomplete_2(document.getElementById("input_key_search"), locations);
       
    }

    //tạo alias - sử dụng chung
    function create_alias(key){
        var title, slug;
                                                
        //Lấy text từ thẻ input title 
        title = key;
                                                
        //Đổi chữ hoa thành chữ thường
        slug = title.toLowerCase();
                                                
        //Đổi ký tự có dấu thành không dấu
        slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
        slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
        slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
        slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
        slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
        slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'y');
        slug = slug.replace(/đ/gi, 'd');
        //Xóa các ký tự đặt biệt
        slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
        //Đổi khoảng trắng thành ký tự gạch ngang
        slug = slug.replace(/ /gi, "-");
        //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
        //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
        slug = slug.replace(/\-\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-\-/gi, '-');
        slug = slug.replace(/\-\-\-/gi, '-');
        slug = slug.replace(/\-\-/gi, '-');
        //Xóa các ký tự gạch ngang ở đầu và cuối
        slug = '@' + slug + '@';
        slug = slug.replace(/\@\-|\-\@|\@/gi, '');
        //In slug ra textbox có id “slug”
        return slug;
    }

    //Render url search sau khi render form
    //Mua Bán
    function create_url_to_search_form_1(){
        //Lấy các biến
        var input_key_search        = document.getElementById('input_key_search').value;
        var location_input_id       = document.getElementById('location_input_id').value;
        var location_input_name     = document.getElementById('location_input_name').value;
        var loai_hinh_mua_ban_bds   = document.getElementById('lua_chon_loai_hinh_mua_ban_bds').innerText;
        var loai_hinh_bds           = document.getElementById('input_loai_hinh_bds').innerText;
        var khoang_gia_bds          = document.getElementById('input_khoang_gia_bds').innerText;
        var dien_tich_bds           = document.getElementById('input_dien_tich_bds').innerText;
        var huong_nha_bds           = document.getElementById('input_huong_nha_bds').innerText;
        var vi_tri_bds              = document.getElementById('input_vi_tri_bds').innerText;

        var input_search_tim_theo_ten = document.getElementById('search_tim_theo_ten').value;

        var key_search_vi_tri       = '';
        if(vi_tri_bds !== 'Tất Cả'){
            key_search_vi_tri       = vi_tri_bds;
        }

        var key_loai_hinh_bds       = '';
        if(loai_hinh_bds !== 'Tất Cả'){
            key_loai_hinh_bds       = loai_hinh_bds;
        }

        var key_search_loai_hinh_mua_ban_bds = '';
        if(loai_hinh_mua_ban_bds !== 'Tất Cả'){
            key_search_loai_hinh_mua_ban_bds = loai_hinh_mua_ban_bds;
        }
        var key_search              = 'Nhà Đất ' + input_key_search + ' ' + key_search_loai_hinh_mua_ban_bds + ' ' + key_loai_hinh_bds + ' ' + key_search_vi_tri;

        var location = '';
        if(location_input_id !== ''){
            location = '&location_id='+location_input_id;
        }

        //Gộp uri
        var uri =
            'danh-sach-bds?'           +
            'input_key_search='         + (input_key_search + location)+
            '&du_an_status=0'           +
            '&loai_hinh_mua_ban_bds='   + (loai_hinh_mua_ban_bds) +
            '&loai_hinh_bds='           + (loai_hinh_bds)+
            '&khoang_gia_bds='          + (khoang_gia_bds)+
            '&dien_tich_bds='           + (dien_tich_bds)+
            '&huong_nha_bds='           + (huong_nha_bds)+
            '&vi_tri_bds='              + (vi_tri_bds)+
            '&search_theo_ten='         + (input_search_tim_theo_ten)+
            '&key_search='              + key_search;
        console.log(uri);
        //Sau đó điều hướng khi nhấn vào button
        $('#button_search_pc').attr('href','<?php echo base_url() ?>' + uri);

        //Enter để chạy kết quả
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button_search_pc").click();
        }
    }
    //Cho Thuê
    function create_url_to_search_form_3(){
        //Lấy các biến
        var input_key_search        = document.getElementById('input_key_search').value;
        var location_input_id       = document.getElementById('location_input_id').value;
        var location_input_name     = document.getElementById('location_input_name').value;
        var loai_hinh_mua_ban_bds   = document.getElementById('lua_chon_loai_hinh_mua_ban_bds').innerText;
        var loai_hinh_bds           = document.getElementById('input_loai_hinh_bds').innerText;
        var khoang_gia_cho_thue_bds = document.getElementById('input_khoang_gia_bds').innerText;
        var dien_tich_bds           = document.getElementById('input_dien_tich_bds').innerText;
        var huong_nha_bds           = document.getElementById('input_huong_nha_bds').innerText;
        var vi_tri_bds              = document.getElementById('input_vi_tri_bds').innerText;

        var input_search_tim_theo_ten = document.getElementById('search_tim_theo_ten').value;

        var key_search_vi_tri       = '';
        if(vi_tri_bds !== 'Tất Cả'){
            key_search_vi_tri       = vi_tri_bds;
        }

        var key_loai_hinh_bds       = '';
        if(loai_hinh_bds !== 'Tất Cả'){
            key_loai_hinh_bds       = loai_hinh_bds;
        }

        var key_search_loai_hinh_mua_ban_bds = '';
        if(loai_hinh_mua_ban_bds !== 'Tất Cả'){
            key_search_loai_hinh_mua_ban_bds = loai_hinh_mua_ban_bds;
        }
        var key_search              = 'Nhà Đất ' + input_key_search + ' ' + key_search_loai_hinh_mua_ban_bds + ' ' + key_loai_hinh_bds + ' ' + key_search_vi_tri;

        var location = '';
        if(location_input_id !== ''){
            location = '&location_id='+location_input_id;
        }

        //Gộp uri
        var uri =
            'danh-sach-bds?'           +
            'input_key_search='         + (input_key_search + location)+
            '&du_an_status=0'           +
            '&loai_hinh_mua_ban_bds='   + (loai_hinh_mua_ban_bds) +
            '&loai_hinh_bds='           + (loai_hinh_bds)+
            '&khoang_gia_cho_thue_bds=' + (khoang_gia_cho_thue_bds)+
            '&dien_tich_bds='           + (dien_tich_bds)+
            '&huong_nha_bds='           + (huong_nha_bds)+
            '&vi_tri_bds='              + (vi_tri_bds)+
            '&search_theo_ten='         + (input_search_tim_theo_ten)+
            '&key_search='              + key_search;
        console.log(uri);
        //Sau đó điều hướng khi nhấn vào button
        $('#button_search_pc').attr('href','<?php echo base_url() ?>' + uri);

        //Enter để chạy kết quả
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button_search_pc").click();
        }
    }
    //Dự Án
    function create_url_to_search_form_2(){
        //Lấy các biến
        var input_key_search        = document.getElementById('input_key_search').value;
        var location_input_id       = document.getElementById('location_input_id').value;
        var location_input_name     = document.getElementById('location_input_name').value;
        var loai_hinh_mua_ban_bds   = document.getElementById('lua_chon_loai_hinh_mua_ban_bds').innerText;
        var loai_nha_dat_bds        = document.getElementById('input_loai_nha_dat_bds').innerText;
        var khoang_gia_bds          = document.getElementById('input_khoang_gia_bds').innerText;
        var trang_thai_bds          = document.getElementById('input_trang_thai_bds').innerText;
        var loai_hinh_bds           = document.getElementById('input_loai_hinh_bds').innerText;
        var input_chu_dau_tu_id     = document.getElementById('input_chu_dau_tu').innerText;
        var input_search_tim_theo_ten = document.getElementById('search_tim_theo_ten').value;

        var key_search_loai_nha_dat_bds       = '';
        if(loai_nha_dat_bds !== 'Tất Cả'){
            key_search_loai_nha_dat_bds = loai_nha_dat_bds;
        }

        var key_search_trang_thai_bds       = '';
        if(trang_thai_bds !== 'Tất Cả'){
            key_search_trang_thai_bds = trang_thai_bds;
        }

        var key_search              = 'Dự Án ' + input_key_search + ' ' + loai_hinh_mua_ban_bds + ' ' + key_search_loai_nha_dat_bds + ' ' + key_search_trang_thai_bds;

        var location = '';
        if(location_input_id !== ''){
            location = '&location_id='+location_input_id;
        }

        //Gộp uri
        var uri =
            'danh-sach-bds?'           +
            'input_key_search='         + (input_key_search + location)+
            '&du_an_status=1'           +
            '&loai_hinh_mua_ban_bds='   + (loai_nha_dat_bds)+
            '&khoang_gia_bds='          + (khoang_gia_bds)+
            '&trang_thai_bds='          + (trang_thai_bds)+
            '&loai_hinh_bds='           + (loai_hinh_bds) +
            '&chu_dau_tu_id='            + input_chu_dau_tu_id +
            '&search_theo_ten='         + (input_search_tim_theo_ten)+
            '&key_search='              + key_search;
        console.log(uri);
        //Sau đó điều hướng khi nhấn vào button
        $('#button_search_pc').attr('href','<?php echo base_url() ?>' + uri);

        //Enter để chạy kết quả
        if (event.keyCode === 13) {
            event.preventDefault();
            document.getElementById("button_search_pc").click();
        }
    }


    //Jquery toàn trang sau khi render form
    //Mua Bán
    function Jquery_total_form_1(){
        //show form
        $("#lua_chon_form").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");

            $("#danh_sach_form").removeClass("off");
            $("#danh_sach_form").addClass("suggest-search pt-2 pb-2");
        });
        // Chọn Form
        $(".select-loai-hinh-form").click(function(evt){
            
            
            //select
            $("#danh_sach_form").removeClass("suggest-search pt-2 pb-2");
            $("#danh_sach_form").addClass("off");
            var value = $(this).html();
            $("#lua_chon_form").html(value);
        });

        //Jquery chọn các tab Mua Bán - Cho Thuê - dự án
        $("#search_form_mua_ban").click(function(){
            render_search_pc_form_1();
            $("#search_form_mua_ban").addClass("active");
            $("#search_form_cho_thue").removeClass("active");
            $("#search_form_du_an").removeClass("active");
            var value = $(this).html();
            $("#lua_chon_loai_hinh_mua_ban_bds").html(value);
            create_url_to_search_form_1();
        });


        $("#search_form_cho_thue").click(function(){
            render_search_pc_form_3();
            $("#search_form_mua_ban").removeClass("active");
            $("#search_form_cho_thue").addClass("active");
            $("#search_form_du_an").removeClass("active");
            var value = $(this).html();
            $("#lua_chon_loai_hinh_mua_ban_bds").html(value);
            create_url_to_search_form_3();
        });

        $("#search_form_du_an").click(function(){
            render_search_pc_form_2();
            $("#search_form_mua_ban").removeClass("active");
            $("#search_form_cho_thue").removeClass("active");
            $("#search_form_du_an").addClass("active");
            var value = $(this).html();
            $("#lua_chon_loai_hinh_mua_ban_bds").html(value);
            create_url_to_search_form_2();
        });
        $("#input_key_search").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
        });
        //Jquery lua_chon_loai_hinh_bds
        $("#lua_chon_loai_hinh_bds").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");

            //Thực hiện Select
            $("#loai_hinh_bds").removeClass("off");
            $("#loai_hinh_bds").addClass("suggest-search pt-2 pb-2");
        });

        $(".select-loai-hinh-bds").click(function(evt){
            $("#loai_hinh_bds").removeClass("suggest-search pt-2 pb-2");
            $("#loai_hinh_bds").addClass("off");
            var value = $(this).html();
            $("#lua_chon_loai_hinh_bds").html(value);
            $("#input_loai_hinh_bds").html(value);
            create_url_to_search_form_1();
        });

        //Jquery lua_chon_khoang_gia_bds
        $("#lua_chon_khoang_gia_bds").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");

            //Thực hiện Select
            $("#danh_sach_khoang_gia").removeClass("off");
        });

        $(".select-khoang-gia").click(function(evt){
            $("#danh_sach_khoang_gia").addClass("off");
            var value    = $(this).html();
            $("#lua_chon_khoang_gia_bds").html(value);
            $("#input_khoang_gia_bds").html(value);
            create_url_to_search_form_1();
        });

        //Jquery lua_chon_dien_tich_bds
        $("#lua_chon_dien_tich_bds").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");

            //Thực hiện Select
            $("#danh_sach_dien_tich").removeClass("off");
        });

        $(".select-dien-tich").click(function(evt){
            $("#danh_sach_dien_tich").addClass("off");
            var value    = $(this).html();
            $("#lua_chon_dien_tich_bds").html(value);
            $("#input_dien_tich_bds").html(value);
            create_url_to_search_form_1();
        });

        //Jquery lua_chon_huong_nha_bds
        $("#lua_chon_huong_nha_bds").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");

            //Thực hiện Select
            $("#danh_sach_huong_nha").removeClass("off");
        });

        $(".select-huong-nha").click(function(evt){
            $("#danh_sach_huong_nha").addClass("off");
            var value    = $(this).html();
            $("#lua_chon_huong_nha_bds").html(value);
            $("#input_huong_nha_bds").html(value);
            create_url_to_search_form_1();
        });

        //Jquery lua_chon_vi_tri_bds
        $("#lua_chon_vi_tri_bds").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");

            //Thực hiện Select
            $("#danh_sach_vi_tri").removeClass("off");
        });

        $(".select-vi-tri").click(function(evt){
            $("#danh_sach_vi_tri").addClass("off");
            var value    = $(this).html();
            $("#lua_chon_vi_tri_bds").html(value);
            $("#input_vi_tri_bds").html(value);
            create_url_to_search_form_1();
        });

        //Jquery lua_chon_tim_theo_ten
        $("#lua_chon_tim_theo_ten").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
            //Thực hiện Select
            $("#danh_sach_tim_theo_ten").removeClass("off");
            $("#danh_sach_tim_theo_ten").addClass("suggest-search pt-2 pb-2");
        });

        //Jquery click tiêu đề
                $(".li_tieu_de").click(function(evt){
                    $("#danh_sach_form").addClass("off");
                    $("#loai_hinh_bds").addClass("off");
                    $("#danh_sach_khoang_gia").addClass("off");
                    $("#danh_sach_dien_tich").addClass("off");
                    $("#danh_sach_huong_nha").addClass("off");
                    $("#danh_sach_vi_tri").addClass("off");
                    $("#danh_sach_tim_theo_ten").addClass("off");
                });
        

    }
    //Cho Thuê
    function Jquery_total_form_3(){
        //show form
        $("#lua_chon_form").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");

            $("#danh_sach_form").removeClass("off");
            $("#danh_sach_form").addClass("suggest-search pt-2 pb-2");
        });
        // Chọn Form
        $(".select-loai-hinh-form").click(function(evt){
            
            
            //select
            $("#danh_sach_form").removeClass("suggest-search pt-2 pb-2");
            $("#danh_sach_form").addClass("off");
            var value = $(this).html();
            $("#lua_chon_form").html(value);
        });

        //Jquery chọn các tab Mua Bán - Cho Thuê - dự án
        $("#search_form_mua_ban").click(function(){
            render_search_pc_form_1();
            $("#search_form_mua_ban").addClass("active");
            $("#search_form_cho_thue").removeClass("active");
            $("#search_form_du_an").removeClass("active");
            var value = $(this).html();
            $("#lua_chon_loai_hinh_mua_ban_bds").html(value);
            create_url_to_search_form_1();
        });

        $("#search_form_cho_thue").click(function(){
            render_search_pc_form_3();
            $("#search_form_mua_ban").removeClass("active");
            $("#search_form_cho_thue").addClass("active");
            $("#search_form_du_an").removeClass("active");
            var value = $(this).html();
            $("#lua_chon_loai_hinh_mua_ban_bds").html(value);
            create_url_to_search_form_3();
        });

        $("#search_form_du_an").click(function(){
            render_search_pc_form_2();
            $("#search_form_mua_ban").removeClass("active");
            $("#search_form_cho_thue").removeClass("active");
            $("#search_form_du_an").addClass("active");
            var value = $(this).html();
            $("#lua_chon_loai_hinh_mua_ban_bds").html(value);
            create_url_to_search_form_2();
        });

        $("#input_key_search").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
        });

        //Jquery lua_chon_loai_hinh_bds
        $("#lua_chon_loai_hinh_bds").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
            //thực hiện select
            $("#loai_hinh_bds").removeClass("off");
            $("#loai_hinh_bds").addClass("suggest-search pt-2 pb-2");
        });

        $(".select-loai-hinh-bds").click(function(evt){
            $("#loai_hinh_bds").removeClass("suggest-search pt-2 pb-2");
            $("#loai_hinh_bds").addClass("off");
            var value = $(this).html();
            $("#lua_chon_loai_hinh_bds").html(value);
            $("#input_loai_hinh_bds").html(value);
            create_url_to_search_form_3();
        });

        //Jquery lua_chon_khoang_gia_bds
        $("#lua_chon_khoang_gia_bds").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
            //thực hiện select
            $("#danh_sach_khoang_gia").removeClass("off");
        });

        $(".select-khoang-gia").click(function(evt){
            $("#danh_sach_khoang_gia").addClass("off");
            var value    = $(this).html();
            $("#lua_chon_khoang_gia_bds").html(value);
            $("#input_khoang_gia_bds").html(value);
            create_url_to_search_form_3();
        });
        
        //Jquery lua_chon_dien_tich_bds
        $("#lua_chon_dien_tich_bds").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
            //thực hiện select
            $("#danh_sach_dien_tich").removeClass("off");
        });

        $(".select-dien-tich").click(function(evt){
            $("#danh_sach_dien_tich").addClass("off");
            var value    = $(this).html();
            $("#lua_chon_dien_tich_bds").html(value);
            $("#input_dien_tich_bds").html(value);
            create_url_to_search_form_3();
        });

        //Jquery lua_chon_huong_nha_bds
        $("#lua_chon_huong_nha_bds").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
            //thực hiện select
            $("#danh_sach_huong_nha").removeClass("off");
        });

        $(".select-huong-nha").click(function(evt){
            $("#danh_sach_huong_nha").addClass("off");
            var value    = $(this).html();
            $("#lua_chon_huong_nha_bds").html(value);
            $("#input_huong_nha_bds").html(value);
            create_url_to_search_form_3();
        });

        //Jquery lua_chon_vi_tri_bds
        $("#lua_chon_vi_tri_bds").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
            //thực hiện select
            $("#danh_sach_vi_tri").removeClass("off");
        });

        $(".select-vi-tri").click(function(evt){
            $("#danh_sach_vi_tri").addClass("off");
            var value    = $(this).html();
            $("#lua_chon_vi_tri_bds").html(value);
            $("#input_vi_tri_bds").html(value);
            create_url_to_search_form_3();
        });

        //Jquery lua_chon_tim_theo_ten
        $("#lua_chon_tim_theo_ten").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
            //Thực hiện Select
            $("#danh_sach_tim_theo_ten").removeClass("off");
            $("#danh_sach_tim_theo_ten").addClass("suggest-search pt-2 pb-2");
        });

                $(".li_tieu_de").click(function(evt){
                    $("#danh_sach_form").addClass("off");
                    $("#loai_hinh_bds").addClass("off");
                    $("#danh_sach_khoang_gia").addClass("off");
                    $("#danh_sach_dien_tich").addClass("off");
                    $("#danh_sach_huong_nha").addClass("off");
                    $("#danh_sach_vi_tri").addClass("off");
                    $("#danh_sach_tim_theo_ten").addClass("off");
                });

    }
    //Dự Án
    function Jquery_total_form_2(){
        //show form
        $("#lua_chon_form").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_nha_dat_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_trang_thai").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_chu_dau_tu").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");

            $("#danh_sach_form").removeClass("off");
            $("#danh_sach_form").addClass("suggest-search pt-2 pb-2");
        });
        // Chọn Form
        $(".select-loai-hinh-form").click(function(evt){
            //select
            $("#danh_sach_form").removeClass("suggest-search pt-2 pb-2");
            $("#danh_sach_form").addClass("off");
            var value = $(this).html();
            $("#lua_chon_form").html(value);
        });

        //Jquery chọn các tab Mua Bán - Cho Thuê - dự án
        $("#search_form_mua_ban").click(function(){
            render_search_pc_form_1();
            $("#search_form_mua_ban").addClass("active");
            $("#search_form_cho_thue").removeClass("active");
            $("#search_form_du_an").removeClass("active");
            var value = $(this).html();
            $("#lua_chon_loai_hinh_mua_ban_bds").html(value);
            create_url_to_search_form_1();
        });

        $("#search_form_cho_thue").click(function(){
            render_search_pc_form_3();
            $("#search_form_mua_ban").removeClass("active");
            $("#search_form_cho_thue").addClass("active");
            $("#search_form_du_an").removeClass("active");
            var value = $(this).html();
            $("#lua_chon_loai_hinh_mua_ban_bds").html(value);
            create_url_to_search_form_3();
        });

        $("#search_form_du_an").click(function(){
            render_search_pc_form_2();
            $("#search_form_mua_ban").removeClass("active");
            $("#search_form_cho_thue").removeClass("active");
            $("#search_form_du_an").addClass("active");
            var value = $(this).html();
            $("#lua_chon_loai_hinh_mua_ban_bds").html(value);
            create_url_to_search_form_2();
        });

        $("#input_key_search").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_nha_dat_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_trang_thai").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_chu_dau_tu").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
        });

        
        //Jquery lua_chon_loai_nha_dat_bds
        $("#showBoxSuggestChild").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_nha_dat_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_trang_thai").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_chu_dau_tu").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
            //Thực hiện Select
            $("#loai_nha_dat_bds").removeClass("off");
            $("#loai_nha_dat_bds").addClass("suggest-search pt-2 pb-2");
        });

        $(".select-loai-nha-dat-bds").click(function(evt){
            $("#loai_nha_dat_bds").removeClass("suggest-search pt-2 pb-2");
            $("#loai_nha_dat_bds").addClass("off");
            var value = $(this).html();
            $("#lua_chon_loai_nha_dat_bds").html(value);
            $("#input_loai_nha_dat_bds").html(value);
            create_url_to_search_form_2();
        });

        //Jquery lua_chon_khoang_gia_bds
        $("#lua_chon_khoang_gia_bds").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_nha_dat_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_trang_thai").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_chu_dau_tu").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
            //Thực hiện Select
            $("#danh_sach_khoang_gia").removeClass("off");
        });

        $(".select-khoang-gia").click(function(evt){
            $("#danh_sach_khoang_gia").addClass("off");
            var value    = $(this).html();
            $("#lua_chon_khoang_gia_bds").html(value);
            $("#input_khoang_gia_bds").html(value);
            create_url_to_search_form_2();
        });

        //Jquery lua_chon_trang_thai_bds
        $("#lua_chon_trang_thai_bds").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_nha_dat_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_trang_thai").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_chu_dau_tu").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
            //Thực hiện Select
            $("#danh_sach_trang_thai").removeClass("off");
        });

        $(".select-trang-thai").click(function(evt){
            $("#danh_sach_trang_thai").addClass("off");
            var value    = $(this).html();
            $("#lua_chon_trang_thai_bds").html(value);
            $("#input_trang_thai_bds").html(value);
            create_url_to_search_form_2();
        });

        //Jquery lua_chon_loai_hinh_bds
        $("#lua_chon_loai_hinh_bds").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_nha_dat_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_trang_thai").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_chu_dau_tu").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
            //Thực hiện Select
            $("#loai_hinh_bds").removeClass("off");
            $("#loai_hinh_bds").addClass("suggest-search pt-2 pb-2");
        });

        $(".select-loai-hinh-bds").click(function(evt){
            $("#loai_hinh_bds").removeClass("suggest-search pt-2 pb-2");
            $("#loai_hinh_bds").addClass("off");
            var value = $(this).html();
            $("#lua_chon_loai_hinh_bds").html(value);
            $("#input_loai_hinh_bds").html(value);
            create_url_to_search_form_2();
        });

        //Jquery lua_chon_chu_dau_tu
        $("#lua_chon_chu_dau_tu").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_nha_dat_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_trang_thai").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_chu_dau_tu").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
            //Thực hiện Select
            $("#danh_sach_chu_dau_tu").removeClass("off");
            $("#danh_sach_chu_dau_tu").addClass("suggest-search pt-2 pb-2");
        });

        $(".select-chu-dau-tu").click(function(evt){
            $("#danh_sach_chu_dau_tu").removeClass("suggest-search pt-2 pb-2");
            $("#danh_sach_chu_dau_tu").addClass("off");
            var name = 'CDT-' + $(this).attr('id');
            var value= $(this).attr('id');
            $("#lua_chon_chu_dau_tu").html(name);
            $("#input_chu_dau_tu").html(value);
            create_url_to_search_form_2();
        });

        //Jquery lua_chon_tim_theo_ten
        $("#lua_chon_tim_theo_ten").click(function(){
            //ẩn các thẻ select đang mở
            $("#danh_sach_form").addClass("off");
            $("#loai_hinh_bds").addClass("off");
            $("#danh_sach_khoang_gia").addClass("off");
            $("#danh_sach_dien_tich").addClass("off");
            $("#danh_sach_huong_nha").addClass("off");
            $("#danh_sach_vi_tri").addClass("off");
            $("#danh_sach_tim_theo_ten").addClass("off");
            //Thực hiện Select
            $("#danh_sach_tim_theo_ten").removeClass("off");
            $("#danh_sach_tim_theo_ten").addClass("suggest-search pt-2 pb-2");
        });

                $(".li_tieu_de").click(function(evt){
                    $("#danh_sach_form").addClass("off");
                    $("#loai_hinh_bds").addClass("off");
                    $("#danh_sach_khoang_gia").addClass("off");
                    $("#danh_sach_dien_tich").addClass("off");
                    $("#danh_sach_huong_nha").addClass("off");
                    $("#danh_sach_vi_tri").addClass("off");
                    $("#danh_sach_tim_theo_ten").addClass("off");
                });

    }
</script>

<style>
    * {
    box-sizing: border-box;
    }

    body {
    font: 16px Arial;  
    }

    /*the container must be positioned relative:*/
    .autocomplete {
    position: relative;
    display: inline-block;
    }

    input {
    border: 1px solid transparent;
    /* background-color: #f1f1f1; */
    padding: 10px;
    font-size: 16px;
    }

    input[type=text] {
    /* background-color: #f1f1f1; */
    width: 100%;
    }

    input[type=submit] {
    background-color: DodgerBlue;
    color: #fff;
    cursor: pointer;
    }

    .autocomplete-items {
    position: absolute;
    border: 1px solid #d4d4d4;
    border-bottom: none;
    border-top: none;
    z-index: 99;
    /*position the autocomplete items to be the same width as the container:*/
    top: 100%;
    left: 0;
    right: 0;
    }

    .autocomplete-items div {
    padding: 10px;
    cursor: pointer;
    background-color: #fff; 
    border-bottom: 1px solid #d4d4d4; 
    }

    /*when hovering an item:*/
    .autocomplete-items div:hover {
    background-color: #e9e9e9; 
    }

    /*when navigating through the items using the arrow keys:*/
    .autocomplete-active {
    background-color: DodgerBlue !important; 
    color: #ffffff; 
    }
</style>


           

<script>
    //Ẩn khi click ra ngoài div
    $(document).mouseup(function(e)
    {
        var search_box_1 = $("#search_box_1");
        if (!search_box_1.is(e.target) && search_box_1.has(e.target).length === 0)
        {
            $("#loai_hinh_bds").addClass('off');
            $("#loai_nha_dat_bds").addClass('off');
            
        }

        var search_box_2 = $("#search_box_2");
        if (!search_box_2.is(e.target) && search_box_2.has(e.target).length === 0)
        {
            
            $("#danh_sach_form").addClass('off');
            $("#danh_sach_khoang_gia").addClass('off');
            $("#danh_sach_dien_tich").addClass('off');
            $("#danh_sach_huong_nha").addClass('off');
            $("#danh_sach_vi_tri").addClass('off');
            $("#danh_sach_trang_thai").addClass('off');
            $("#danh_sach_chu_dau_tu").addClass('off');
            $("#danh_sach_tim_theo_ten").addClass('off');
        }
    });
</script>
