<?php 
    $input_for_admin            = array();
    $input_for_admin['order']   = array('id','desc');
    $list_for_admin             = $this->news_model->get_list($input_for_admin);

    $input_for_view             = array();
    $input_for_view['where']    = array('status' => '0');
    $input_for_view['order']    = array('id','desc');
    $list_for_view              = $this->news_model->get_list($input_for_view);

    $data   = array();

    $data_admin 	= array();
    $data_view 	    = array();

    //json cho admin
    $count 	= '0';
    foreach($list_for_admin as $row){
        $count++;
        $row_info 				= array();
        $row_info['stt'] 		= $count;
        $row_info['id']			= $row->id;
        $row_info['name']		= json_decode($row->name);
        $row_info['catalog_id']	= $row->catalog_id;
        $row_info['hot']	        = $row->hot;
        $row_info['view']	    = $row->view;
        $row_info['status']		= $row->status;
        $data_admin[] = $row_info;
    }
    $data['admin']  = $data_admin;

    //json cho view - tất cả bài viết tin tức
    $count 	= '0';
    foreach($list_for_view as $row){
        $count++;
        $row_info 				= array();
        $row_info['stt'] 		= $count;
        $row_info['id']			= $row->id;
        $row_info['name']		= json_decode($row->name);
        $row_info['catalog_id']	= $row->catalog_id;
        $row_info['hot']	    = $row->hot;
        $row_info['view']	    = $row->view;
        $row_info['status']		= $row->status;
        $data_view[] = $row_info;
    }
    $data['view']  = $data_view;

    header('Content-Type: application/json');
    echo json_encode($data,JSON_PRETTY_PRINT);
    $this->output->cache('43200'); //3hours


?>