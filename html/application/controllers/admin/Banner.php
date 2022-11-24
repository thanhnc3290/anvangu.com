<?php 
Class Banner extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
        $this->load->model('banner_model');
	}

	/*
	*Lấy danh sách admin
	*/
	
	function api_banner_list(){
		$this->load->view('admin/banner/api_banner_list');
	}

	function index()
	{
		$this->load->view('admin/banner/index', $this->data);
	}

	function add()
	{
        $this->load->library('form_validation');
		$this->load->helper('form');

		//check dữ liệu input lên database
		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Tên Dự Án','required|min_length[3]');

			// Nhập Liệu chính xác
			if($this->form_validation->run())
			{
				// Thêm vào cơ sở dữ liệu
                $name       			= $this->input->post('name');
				$status   				= $this->input->post('status');
                $sort_order   		    = $this->input->post('sort_order');
                $link       			= $this->input->post('link');

				//Lấy tên file ảnh minh họa được upload lên
				$this->load->library('upload_library');
				$upload_path = './upload/banner';

				$upload_data_image = $this->upload_library->upload($upload_path, 'image_link');

				$image_link ='';
				if(isset($upload_data_image['file_name']))
				{
					$image_link = $upload_data_image['file_name'];
				}

				$data = array(
                    'name'      		=> json_encode($name),
					'status'  			=> $status,
                    'sort_order'        => $sort_order,
                    'link'              => $link,
                    'image_link'        => $image_link,
				);

				//print_r($data);

				if($this->banner_model->create($data)){
					$CI =& get_instance();
					$path = $CI->config->item('cache_path');
					//path of cache directory
					$cache_path = ($path == '') ? APPPATH.'cache/' : $path;

					//xóa cache trang chủ
					$url = base_url(''); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
					$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
					$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
					unlink ($cache_path.md5($path_delete));
                    
					redirect('admin/banner');
				}else{
					echo 'Không Tạo Thành Công';
				}
				
			}
		}

		$this->data['temp']  ='admin/banner/add';
		$this->load->view('admin/banner/add', $this->data);
	}

	/*
	*Hàm chỉnh sửa thông tin admin
	*/
	function edit()
	{
        //Lấy ID của dự án cần chỉnh sửa
		$id   = $this->uri->rsegment('3');
		$id   = intval($id);
		$info = $this->banner_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message','Không tồn tại nội dung này');
			redirect(admin_url('banner'));
		}

		$this->data['info']  = $info;

		$this->load->library('form_validation');
		$this->load->helper('form');

		//check dữ liệu input lên database
		if($this->input->post())
		{
			$this->form_validation->set_rules('name','Tên Dự Án','required|min_length[3]');

			// Nhập Liệu chính xác
			if($this->form_validation->run())
			{
				// Thêm vào cơ sở dữ liệu
                $name       			= $this->input->post('name');
				$status   				= $this->input->post('status');
                $sort_order   		    = $this->input->post('sort_order');
                $link       			= $this->input->post('link');

				//Lấy tên file ảnh minh họa được upload lên
				$this->load->library('upload_library');
				$upload_path = './upload/banner';

				$upload_data_image = $this->upload_library->upload($upload_path, 'image_link');

				$image_link ='';
				if(isset($upload_data_image['file_name']))
				{
					$image_link = $upload_data_image['file_name'];
				}

				$data = array(
					'name'      		=> json_encode($name),
					'status'  			=> $status,
                    'sort_order'        => $sort_order,
                    'link'              => $link,
				);

				if($image_link != '')
				{
					$info_image_link 	= './upload/banner/'.$info->image_link;
                    if(file_exists($info_image_link) && ($info_image_link !== './upload/banner/')){
                        unlink($info_image_link);
                    }
					$data['image_link'] = $image_link;
				}

				if($this->banner_model->update($id,$data)){
					$CI =& get_instance();
					$path = $CI->config->item('cache_path');
					//path of cache directory
					$cache_path = ($path == '') ? APPPATH.'cache/' : $path;

					//xóa cache trang chủ
					$url = base_url(''); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
					$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
					$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
					unlink ($cache_path.md5($path_delete));

					redirect('admin/banner');
				}else{
					echo 'Không Tạo Thành Công';
				}
				
			}
		}

		$this->data['temp']  ='admin/banner/edit';
		$this->load->view('admin/banner/edit', $this->data);
	}

	/*
	*Hàm xóa thông tin admin
	*/
	function delete()
	{
		//Lấy ID của quản trị viên cần xóa
		$id   = $this->uri->rsegment('3');
		$id   = intval($id);

		//Lấy thông tin của quản trị viên cần xóa
		$info = $this->banner_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message','Không tồn tại quản trị viên này');
			redirect(admin_url('banner'));
		}

        $info_image_link 	= './upload/banner/'.$info->image_link;
        if(file_exists($info_image_link) && ($info_image_link !== './upload/banner/')){
            unlink($info_image_link);
        }
		//Thực hiện xóa
		if($this->banner_model->delete($id)){
            $CI =& get_instance();
			$path = $CI->config->item('cache_path');
			//path of cache directory
			$cache_path = ($path == '') ? APPPATH.'cache/' : $path;

			//xóa cache trang chủ
			$url = base_url(''); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
			$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
			$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
			unlink ($cache_path.md5($path_delete));
        }
		$this->session->set_flashdata('message','Xóa dữ liệu thành công');
        
		redirect(admin_url('banner'));
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