<?php 
Class News extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('admin_model');
        $this->load->model('news_model');

		//tạo alias
		function create_alias($string)
		{
			$search = array(
				'#(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)#',
				'#(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)#',
				'#(ì|í|ị|ỉ|ĩ)#',
				'#(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)#',
				'#(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)#',
				'#(ỳ|ý|ỵ|ỷ|ỹ)#',
				'#(đ)#',
				'#(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)#',
				'#(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)#',
				'#(Ì|Í|Ị|Ỉ|Ĩ)#',
				'#(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)#',
				'#(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)#',
				'#(Ỳ|Ý|Ỵ|Ỷ|Ỹ)#',
				'#(Đ)#',
				"/[^a-zA-Z0-9\-\_]/",
			);
			$replace = array(
				'a',
				'e',
				'i',
				'o',
				'u',
				'y',
				'd',
				'A',
				'E',
				'I',
				'O',
				'U',
				'Y',
				'D',
				'-',
			);
			$string = preg_replace($search, $replace, $string);
			$string = preg_replace('/(-)+/', '-', $string);
			$string = strtolower($string);
			return $string;
		}
	}

	/*
	*Lấy danh sách admin
	*/
	
	function api_news_list(){
		$this->load->view('admin/news/api_news_list');
	}

	function index()
	{
		$this->load->view('admin/news/index', $this->data);
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
				$author_id				= $this->input->post('author_id');
                $name       			= $this->input->post('name');
				$alias   				= $this->input->post('alias');
				$status   				= $this->input->post('status');

                $hot   				    = $this->input->post('hot');
                $catalog_id   		    = $this->input->post('catalog_id');

                $meta_key   		    = $this->input->post('meta_key');
                $meta_desc   		    = $this->input->post('meta_desc');
                $content   		        = $this->input->post('content');


				//Lấy tên file ảnh minh họa được upload lên
				$this->load->library('upload_library');
				$upload_path = './upload/news';

				$upload_data_image = $this->upload_library->upload($upload_path, 'image_link');

				$image_link ='';
				if(isset($upload_data_image['file_name']))
				{
					$image_link = $upload_data_image['file_name'];
				}

				$data = array(
					'author_id'			=> $author_id,
                    'name'      		=> json_encode($name),
					'alias'  			=> $alias,
					'status'  			=> $status,
                    'catalog_id'        => $catalog_id,
                    'hot'               => $hot,
                    'meta_key'          => json_encode($meta_key),
                    'meta_desc'         => json_encode($meta_desc),
                    'content'           => json_encode($content),
                    'image_link'        => $image_link,
                    'update_time'		=> now(),
				);

				//print_r($data);

				if($this->news_model->create($data)){
					$CI =& get_instance();
					$path = $CI->config->item('cache_path');
					//path of cache directory
					$cache_path = ($path == '') ? APPPATH.'cache/' : $path;

					//xóa cache trang chủ
					$url = base_url(''); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
					$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
					$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
					unlink ($cache_path.md5($path_delete));

					//xóa cache trang tin tức
					$url = base_url('tin-tuc'); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
					$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
					$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
					unlink ($cache_path.md5($path_delete));

					//xóa cache trang danh mục
					if($catalog_id == '1'){$url = base_url('tin-tuc-'.create_alias('Thị Trường').'-cn1');}
					if($catalog_id == '2'){$url = base_url('tin-tuc-'.create_alias('Kiến Thức').'-cn2');}
					if($catalog_id == '3'){$url = base_url('tin-tuc-'.create_alias('Xây Dựng, Phong Thủy').'-cn3');}
					if($catalog_id == '4'){$url = base_url('tin-tuc-'.create_alias('Góc Tư Vấn').'-cn4');}
					if($catalog_id == '5'){$url = base_url('tin-tuc-'.create_alias('Phân Tích, Nhận Định').'-cn5');}
					if($catalog_id == '6'){$url = base_url('tin-tuc-'.create_alias('Thông Tin Quy Hoạch').'-cn6');}
					if($catalog_id == '7'){$url = base_url('tin-tuc-'.create_alias('Tài Chính').'-cn7');}
					if($catalog_id == '100'){$url = base_url('tin-tuc-'.create_alias('Giới Thiệu').'-cn100');}
					if($catalog_id == '101'){$url = base_url('tin-tuc-'.create_alias('Hỗ Trợ Khách Hàng').'-cn101');}
					if($catalog_id == '102'){$url = base_url('tin-tuc-'.create_alias('Quảng Cáo').'-cn102');}
					$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
					$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
					unlink ($cache_path.md5($path_delete));
                    
					redirect('admin/news');
				}else{
					echo 'Không Tạo Thành Công';
				}
				
			}
		}

		$this->data['temp']  ='admin/news/add';
		$this->load->view('admin/news/add', $this->data);
	}

	/*
	*Hàm chỉnh sửa thông tin admin
	*/
	function edit()
	{
        //Lấy ID của dự án cần chỉnh sửa
		$id   = $this->uri->rsegment('3');
		$id   = intval($id);
		$info = $this->news_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message','Không tồn tại nội dung này');
			redirect(admin_url('news'));
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
				$author_id				= $this->input->post('author_id');
                $name       			= $this->input->post('name');
				$alias   				= $this->input->post('alias');
				$status   				= $this->input->post('status');

                $hot   				    = $this->input->post('hot');
                $catalog_id   		    = $this->input->post('catalog_id');

                $meta_key   		    = $this->input->post('meta_key');
                $meta_desc   		    = $this->input->post('meta_desc');
                $content   		        = $this->input->post('content');


				//Lấy tên file ảnh minh họa được upload lên
				$this->load->library('upload_library');
				$upload_path = './upload/news';

				$upload_data_image = $this->upload_library->upload($upload_path, 'image_link');

				$image_link ='';
				if(isset($upload_data_image['file_name']))
				{
					$image_link = $upload_data_image['file_name'];
				}

				$data = array(
					'author_id'			=> $author_id,
                    'name'      		=> json_encode($name),
					'alias'  			=> $alias,
					'status'  			=> $status,
                    'catalog_id'        => $catalog_id,
                    'hot'               => $hot,
                    'meta_key'          => json_encode($meta_key),
                    'meta_desc'         => json_encode($meta_desc),
                    'content'           => json_encode($content),
                    'update_time'		=> now(),
				);

				if($image_link != '')
				{
					$info_image_link 	= './upload/news/'.$info->image_link;
                    if(file_exists($info_image_link) && ($info_image_link !== './upload/news/')){
                        unlink($info_image_link);
                    }
					$data['image_link'] = $image_link;
				}

				if($this->news_model->update($id,$data)){
					$CI =& get_instance();
					$path = $CI->config->item('cache_path');
					//path of cache directory
					$cache_path = ($path == '') ? APPPATH.'cache/' : $path;

					//xóa cache trang chủ
					$url = base_url(''); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
					$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
					$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
					unlink ($cache_path.md5($path_delete));

					//xóa cache trang tin tức
					$url = base_url('tin-tuc'); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
					$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
					$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
					unlink ($cache_path.md5($path_delete));

					//xóa cache trang danh mục
					if($info->catalog_id == '1'){$url = base_url('tin-tuc-'.create_alias('Thị Trường').'-cn1');}
					if($info->catalog_id == '2'){$url = base_url('tin-tuc-'.create_alias('Kiến Thức').'-cn2');}
					if($info->catalog_id == '3'){$url = base_url('tin-tuc-'.create_alias('Xây Dựng, Phong Thủy').'-cn3');}
					if($info->catalog_id == '4'){$url = base_url('tin-tuc-'.create_alias('Góc Tư Vấn').'-cn4');}
					if($info->catalog_id == '5'){$url = base_url('tin-tuc-'.create_alias('Phân Tích, Nhận Định').'-cn5');}
					if($info->catalog_id == '6'){$url = base_url('tin-tuc-'.create_alias('Thông Tin Quy Hoạch').'-cn6');}
					if($info->catalog_id == '7'){$url = base_url('tin-tuc-'.create_alias('Tài Chính').'-cn7');}
					if($info->catalog_id == '100'){$url = base_url('tin-tuc-'.create_alias('Giới Thiệu').'-cn100');}
					if($info->catalog_id == '101'){$url = base_url('tin-tuc-'.create_alias('Hỗ Trợ Khách Hàng').'-cn101');}
					if($info->catalog_id == '102'){$url = base_url('tin-tuc-'.create_alias('Quảng Cáo').'-cn102');}
					$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
					$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
					unlink ($cache_path.md5($path_delete));

					//xóa cache trang nội dung tin tức
					$url = base_url($info->alias.'-news'.$info->id); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
					$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
					$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
					unlink ($cache_path.md5($path_delete));

					redirect('admin/news');
				}else{
					echo 'Không Tạo Thành Công';
				}
				
			}
		}

		$this->data['temp']  ='admin/news/edit';
		$this->load->view('admin/news/edit', $this->data);
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
		$info = $this->news_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message','Không tồn tại quản trị viên này');
			redirect(admin_url('news'));
		}

        $info_image_link 	= './upload/news/'.$info->image_link;
        if(file_exists($info_image_link) && ($info_image_link !== './upload/news/')){
            unlink($info_image_link);
        }
		//Thực hiện xóa
		if($this->news_model->delete($id)){
            $CI =& get_instance();
			$path = $CI->config->item('cache_path');
			//path of cache directory
			$cache_path = ($path == '') ? APPPATH.'cache/' : $path;

			//xóa cache trang chủ
			$url = base_url(''); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
			$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
			$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
			unlink ($cache_path.md5($path_delete));

			//xóa cache trang tin tức
			$url = base_url('tin-tuc'); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
			$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
			$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
			unlink ($cache_path.md5($path_delete));

			//xóa cache trang danh mục
			if($info->catalog_id == '1'){$url = base_url('tin-tuc-'.create_alias('Thị Trường').'-cn1');}
			if($info->catalog_id == '2'){$url = base_url('tin-tuc-'.create_alias('Kiến Thức').'-cn2');}
			if($info->catalog_id == '3'){$url = base_url('tin-tuc-'.create_alias('Xây Dựng, Phong Thủy').'-cn3');}
			if($info->catalog_id == '4'){$url = base_url('tin-tuc-'.create_alias('Góc Tư Vấn').'-cn4');}
			if($info->catalog_id == '5'){$url = base_url('tin-tuc-'.create_alias('Phân Tích, Nhận Định').'-cn5');}
			if($info->catalog_id == '6'){$url = base_url('tin-tuc-'.create_alias('Thông Tin Quy Hoạch').'-cn6');}
			if($info->catalog_id == '7'){$url = base_url('tin-tuc-'.create_alias('Tài Chính').'-cn7');}
			if($info->catalog_id == '100'){$url = base_url('tin-tuc-'.create_alias('Giới Thiệu').'-cn100');}
			if($info->catalog_id == '101'){$url = base_url('tin-tuc-'.create_alias('Hỗ Trợ Khách Hàng').'-cn101');}
			if($info->catalog_id == '102'){$url = base_url('tin-tuc-'.create_alias('Quảng Cáo').'-cn102');}
			$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
			$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
			unlink ($cache_path.md5($path_delete));

			//xóa cache trang nội dung tin tức
			$url = base_url($info->alias.'-news'.$info->id); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
			$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
			$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
			unlink ($cache_path.md5($path_delete));
        }
		$this->session->set_flashdata('message','Xóa dữ liệu thành công');
        
		redirect(admin_url('news'));
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