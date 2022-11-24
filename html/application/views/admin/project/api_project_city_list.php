<?php 
    $this->load->model('city_model');

    $input 				= array();
    $input['order']		= array('id','asc');
    $admin_list = $this->city_model->get_list($input);

    $list 	= array();
    $count 	= '0';
    foreach($admin_list as $row){
        $count++;
        $row_info 				= array();
        $row_info['id']			= $row->id;
        $row_info['name']		= json_decode($row->name);
        $row_info['city_id'] 	= $row->city_id;
        $list[] = $row_info;
    }
    header('Content-Type: application/json');
    echo json_encode($list,JSON_PRETTY_PRINT);
    $this->output->cache('43200'); //3hours
?>