<?php 
    $data   = array();
    
    
    //json cho admin - tất cả dự án
    $input_for_admin            = array();
    $input_for_admin['order']   = array('id','desc');
    $list_for_admin             = $this->project_model->get_list($input_for_admin);
    
    $data_admin 	= array();
    $count 	= '0';
    foreach($list_for_admin as $row){
        $count++;
        $row_info 			= array();
        $row_info['stt'] 		= $count;
        $row_info['id']			= $row->id;
        $row_info['name']		= json_decode($row->name);
        $row_info['status']		= $row->status;
        $data_admin[] = $row_info;
    }
    $data['admin']  = $data_admin;


    //json cho view - tất cả dự án
    $input_for_view             = array();
    $input_for_view['where']    = array('status' => '0');
    $input_for_view['order']    = array('id','desc');
    $list_for_view              = $this->project_model->get_list($input_for_view);
    
    $data_view 	    = array();
    $count 	= '0';
    foreach($list_for_view as $row){
        $count++;
        $row_info 			    = array();
        $row_info['stt'] 		= $count;
        $row_info['id']			= $row->id;
        $row_info['name']		= json_decode($row->name);
        $row_info['status']		= $row->status;
        $data_view[] = $row_info;
    }
    $data['view']  = $data_view;

    echo json_encode($data);
    //$this->output->cache('43200'); //3hours
?>