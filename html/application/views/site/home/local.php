<?php 
    function create_alias($str) {
        $str = trim(mb_strtolower($str));
        $str = preg_replace('/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/', 'a', $str);
        $str = preg_replace('/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/', 'e', $str);
        $str = preg_replace('/(ì|í|ị|ỉ|ĩ)/', 'i', $str);
        $str = preg_replace('/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/', 'o', $str);
        $str = preg_replace('/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/', 'u', $str);
        $str = preg_replace('/(ỳ|ý|ỵ|ỷ|ỹ)/', 'y', $str);
        $str = preg_replace('/(đ)/', 'd', $str);
        $str = preg_replace('/[^a-z0-9-\s]/', '', $str);
        $str = preg_replace('/([\s]+)/', '-', $str);
        return $str;
    }

    $list = json_decode(file_get_contents(base_url('local.json')));
    $data = array();
    foreach($list as $city){
        $row_info = array();
        $row_info['prefix']         = 'Thành Phố / Tỉnh';
        $row_info['name']           = $city->name;
        $row_info['code']           = $city->code;
        $row_info['city_name']      = $city->name;
        $data[] = $row_info;

       
        
    }
    print_r($data);


    // foreach($list as $row){
    //     echo $row->id.'-Code: '.$row->code.'-Name: '.$row->name.'</br>';
    //     foreach($row->districts as $districts){
    //         echo '---'.$districts->id.'- name: '.$districts->name.'<br/>';
    //         foreach($districts->wards as $wards){
    //             echo '------'.$wards->id.'- name: '.$wards->prefix.' - '.$wards->name.'<br/>';
    //         }

    //         foreach($districts->streets as $streets){
    //             echo '------'.$streets->id.'- name: '.$streets->prefix.' - '.$streets->name.'<br/>';
    //         }
    //     }
    //     echo '<br/><br/>';
    // }

    // $list = file_get_contents(base_url('local.json'));
    // echo $list;
    // $data = array();
    // foreach($list as $city){
    //     $row_info = array();
    //     $row_info['prefix']         = 'Thành Phố / Tỉnh';
    //     $row_info['name']           = $city->name;
    //     $row_info['code']           = $city->code;
    //     $row_info['city_name']      = $city->name;
    //     $data[] = $row_info;

    //     foreach($city->districts as $districts){
    //         $row_info = array();
    //         $row_info['prefix']         = 'Quận / Huyện';
    //         $row_info['name']           = $districts->name;
    //         $row_info['code']           = $city->code;
    //         $row_info['city_name']      = $city->name;
    //         $data[] = $row_info;

    //         foreach($districts->wards as $wards){
    //             $row_info = array();
    //             $row_info['prefix']         = $wards->prefix;
    //             $row_info['name']           = $wards->name;
    //             $row_info['code']           = $city->code;
    //             $row_info['city_name']      = $city->name;
    //             $data[] = $row_info;
    //         }

    //         foreach($districts->streets as $streets){
    //             $row_info = array();
    //             $row_info['prefix']         = $streets->prefix;
    //             $row_info['name']           = $streets->name;
    //             $row_info['code']           = $city->code;
    //             $row_info['city_name']      = $city->name;
    //             $data[] = $row_info;
    //         }
    //     }
    // }

    // header('Content-Type: application/json');
    
    // echo json_encode($data);
    //$this->output->cache('43200'); //3hours


    // $data = array();
    // foreach($list as $city){
    //     // $row_info = array();
    //     // $row_info['city_id']        = $city->id;
    //     // $row_info['name']           = json_encode($city->name);
    //     // $row_info['alias']          = create_alias($city->name);
    //     // $data[] = $row_info;
    //     //$this->city_model->create($row_info);
    //     //echo json_encode($row_info['name']).'<br/>';


    //     foreach($city->districts as $districts){
    //         // $row_info = array();
    //         // $row_info['name']           = json_encode($districts->name);
    //         // $row_info['alias']          = create_alias($districts->name);
    //         // $row_info['city_id']        = $city->id;
    //         // $row_info['districts_id']   = $districts->id;
    //         //$data[] = $row_info;
    //         //$this->districts_model->create($row_info);

    //         foreach($districts->wards as $wards){
    //             $row_info = array();
    //             $row_info['prefix']         = json_encode($wards->prefix);
    //             $row_info['name']           = json_encode($wards->name);
    //             $row_info['alias']          = create_alias($wards->name);
    //             $row_info['city_id']        = $city->id;
    //             $row_info['districts_id']   = $districts->id;
    //             $row_info['wards_id']       = $wards->id;
    //             //$data[] = $row_info;
    //             $this->wards_model->create($row_info);
    //         }
    //     }
    // }

    //print_r($data);
    // $city_list = $this->wards_model->get_list();
    // foreach($city_list as $row){
    //     echo '<p>'.$row->id.'-'.json_decode($row->prefix).' '.json_decode($row->name).'-'.$row->alias.'-'.$row->wards_id.'-'.$row->districts_id.'-'.$row->city_id.'</p>';     
    // }

?>