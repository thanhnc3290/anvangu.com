<?php 
   
   $info = $this->site_info_model->get_info('1');
   $data        = json_decode($info->sife_info_data);
   $image_link  = base_url('upload/site_info/'.$info->image_link);
   

   //Xuất dữ liệu

   $export = array();
   $export['site_title']                                            = $data->site_title;
   if(isset($data->hotline)){       $export['hotline']              = $data->hotline;}
   if(isset($data->email)){         $export['email']                = $data->email;}
   if(isset($data->dia_chi)){       $export['dia_chi']              = $data->dia_chi;}
   if(isset($data->ma_so_thue)){    $export['ma_so_thue']           = $data->ma_so_thue;}
   if(isset($data->zalo)){          $export['zalo']                 = $data->zalo;}
   if(isset($data->skype)){         $export['skype']                = $data->skype;}
   if(isset($data->messenger)){     $export['messenger']            = $data->messenger;}
   if(isset($data->facebook)){      $export['facebook']             = $data->facebook;}
   if(isset($data->youtube)){       $export['youtube']              = $data->youtube;}
   if(isset($data->pinterest)){     $export['pinterest']            = $data->pinterest;}
   if(isset($data->twitter)){       $export['twitter']              = $data->twitter;}
   if(isset($data->instagram)){     $export['instagram']            = $data->instagram;}
   if(isset($data->linkedin)){      $export['linkedin']             = $data->linkedin;}
   if(isset($data->head_script)){   $export['head_script']          = $data->head_script;}
   if(isset($data->body_script)){   $export['body_script']          = $data->body_script;}
   if(isset($data->success_script)){$export['success_script']       = $data->success_script;}
   if(isset($data->meta_key)){      $export['meta_key']             = $data->meta_key;}
   if(isset($data->meta_desc)){     $export['meta_desc']            = $data->meta_desc;}
   $export['social_image_link']                                     = $image_link;

   header('Content-Type: application/json');
   echo json_encode($export,JSON_PRETTY_PRINT);
   $this->output->cache('43200'); //3hours
?>