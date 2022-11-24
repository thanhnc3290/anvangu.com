<?php 
    $city_id = $this->uri->rsegment('3');
    $this->load->model('districts_model');
    $input 				= array();
    $input['where']     = array('city_id' => $city_id);
    $input['order']		= array('id','asc');
    $item_list = $this->districts_model->get_list($input);

    $list 	= array();
    $count 	= '0';
    foreach($item_list as $row){
        $count++;
        $row_info 				    = array();
        $row_info['id']			    = $row->id;
        $row_info['name']		    = json_decode($row->name);
        $row_info['alias']		    = $row->alias;
        $row_info['city_id'] 	    = $row->city_id;
        $row_info['districts_id'] 	= $row->districts_id;
        $list[] = $row_info;
    }
    header('Content-Type: application/json');
    echo json_encode($list,JSON_PRETTY_PRINT);
    $this->output->cache('43200'); //3hours

?>