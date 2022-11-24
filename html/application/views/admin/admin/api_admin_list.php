<?php 
   $input 				= array();
   $input['order']		= array('id','desc');
   $admin_list = $this->admin_model->get_list($input);

   $list 	= array();
   $count 	= '0';
   foreach($admin_list as $row){
       $count++;
       $row_info 				= array();
       $row_info['stt'] 		= $count;
       $row_info['id']			= $row->id;
       $row_info['name']		= $row->name;
       $row_info['username'] 	= $row->username;
       $row_info['group_id']	= $row->group_id;
       $row_info['status']		= $row->status;
       $list[] = $row_info;
   }
   header('Content-Type: application/json');
   echo json_encode($list);
   $this->output->cache('43200'); //3hours
?>