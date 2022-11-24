<?php 
Class Site_info extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
        $this->load->model('site_info_model');
	}

	/*
	*Lấy danh sách admin
	*/
	
	function api_site_info_list(){
		$this->load->view('admin/site_info/api_site_info_list');
	}

	/*
	*Hàm chỉnh sửa thông tin admin
	*/
	function edit()
	{
		//Lấy ID của dự án cần chỉnh sửa
		$id   = $this->uri->rsegment('3');
		$id   = intval($id);
		$info = $this->site_info_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message','Không tồn tại nội dung này');
			redirect(admin_url(''));
		}

		$this->data['info']  = $info;

		$this->load->library('form_validation');
		$this->load->helper('form');

		//check dữ liệu input lên database
		if($this->input->post())
		{
			$this->form_validation->set_rules('site_title','Tên Dự Án','required|min_length[3]');

			// Nhập Liệu chính xác
			if($this->form_validation->run())
			{
				// Thêm vào cơ sở dữ liệu
                $sife_info_data = array();
				$sife_info_data['site_title']   	= $this->input->post('site_title');
				$sife_info_data['hotline']   		= $this->input->post('hotline');
				$sife_info_data['email']   			= $this->input->post('email');
				$sife_info_data['dia_chi']   		= $this->input->post('dia_chi');
				$sife_info_data['ma_so_thue']   	= $this->input->post('ma_so_thue');
				$sife_info_data['zalo']   			= $this->input->post('zalo');
				$sife_info_data['skype']   			= $this->input->post('skype');
				$sife_info_data['messenger']   		= $this->input->post('messenger');
				$sife_info_data['facebook']   		= $this->input->post('facebook');
				$sife_info_data['youtube']   		= $this->input->post('youtube');
				$sife_info_data['pinterest']   		= $this->input->post('pinterest');
				$sife_info_data['twitter']   		= $this->input->post('twitter');
				$sife_info_data['instagram']   		= $this->input->post('instagram');
				$sife_info_data['linkedin']   		= $this->input->post('linkedin');
				$sife_info_data['head_script']   	= $this->input->post('head_script');
				$sife_info_data['body_script']   	= $this->input->post('body_script');
				$sife_info_data['success_script']   = $this->input->post('success_script');
				
                $sife_info_data['meta_key']     	= $this->input->post('meta_key');
                $sife_info_data['meta_desc']    	= $this->input->post('meta_desc');


				//Lấy tên file ảnh minh họa được upload lên
				$this->load->library('upload_library');
				$upload_path = './upload/site_info';

				$upload_data_image = $this->upload_library->upload($upload_path, 'image_link');
				$image_link ='';
				if(isset($upload_data_image['file_name']))
				{
					$image_link = $upload_data_image['file_name'];
				}

				$upload_data = $this->upload_library->upload($upload_path, 'logo_image_link');

				$logo_image_link ='';
				if(isset($upload_data['file_name']))
				{
					$logo_image_link = $upload_data['file_name'];
				}

				$upload_data = $this->upload_library->upload($upload_path, 'favicon_image_link');

				$favicon_image_link ='';
				if(isset($upload_data['file_name']))
				{
					$favicon_image_link = $upload_data['file_name'];
				}

				$data = array(
					'sife_info_data'      		=> json_encode($sife_info_data),
				);

				if($image_link != '')
				{
					$info_image_link 	= './upload/site_info/'.$info->image_link;
                    if(file_exists($info_image_link) && ($info_image_link !== './upload/site_info/')){
                        unlink($info_image_link);
                    }
					$data['image_link'] = $image_link;
				}

				if($logo_image_link != '')
				{
					$info_image_link 	= './upload/site_info/'.$info->logo_image_link;
                    if(file_exists($info_image_link) && ($info_image_link !== './upload/site_info/')){
                        unlink($info_image_link);
                    }
					$data['logo_image_link'] = $logo_image_link;
				}

				if($favicon_image_link != '')
				{
					$info_image_link 	= './upload/site_info/'.$info->favicon_image_link;
                    if(file_exists($info_image_link) && ($info_image_link !== './upload/site_info/')){
                        unlink($info_image_link);
                    }
					$data['favicon_image_link'] = $favicon_image_link;
				}

				if($this->site_info_model->update($id,$data)){
					

					redirect(admin_url());
				}else{
					echo 'Không Update Thành Công';
				}
				
			}
		}
		$this->data['temp']  ='admin/site_info/edit';
		$this->load->view('admin/site_info/edit', $this->data);
	}


	/*
	*Thực hiện đăng xuất
	*/
	function logout()
	{
		if($this->session->userdata('login'))
		{
			
			$this->session->set_userdata('login', false);
			//$this->session->unset_userdata('login');
		}
		redirect(admin_url('login'));
	}
}