<?php
Class MY_Controller extends CI_Controller
{ 
	// Biến gửi dữ liệu sang Views
	public $data=array();
	
	function __construct()
	{
		// Kế thừa từ CI_Controller
		parent::__construct();
		$this->load->model('city_model');
		$this->load->model('districts_model');
		$this->load->model('wards_model');
		$this->load->model('chu_dau_tu_model');
		$this->load->model('news_model');

		$controller =$this->uri->segment(1);
		switch ($controller)
		{
			case 'admin' :
			{
				// Xử lý thông tin khi truy cập trang Admin
				$this->load->helper('admin');
				$this->_check_login();
				break;
			}

			default:
			{	
				//Get_info site_info
				$site_info = $this->db->query('
					SELECT * 
					From site_info
					where id = 1
				')->result_array();
				//Để select 1 giá trị từ query thì dùng hàm array_shift để convert
				$site_info = array_shift($site_info);
			
				$data        		= json_decode($site_info['sife_info_data']);
				$image_link  		= base_url('upload/site_info/'.$site_info['image_link']);
				$logo_image_link	= base_url('upload/site_info/'.$site_info['logo_image_link']);
				$favicon_image_link	= base_url('upload/site_info/'.$site_info['favicon_image_link']);
				
				$data_site_info 	= array();
				$data_site_info['site_title']                                            = $data->site_title;
				if(isset($data->hotline)){       $data_site_info['hotline']              = $data->hotline;}
				if(isset($data->email)){         $data_site_info['email']                = $data->email;}
				if(isset($data->dia_chi)){       $data_site_info['dia_chi']              = $data->dia_chi;}
				if(isset($data->ma_so_thue)){    $data_site_info['ma_so_thue']           = $data->ma_so_thue;}
				if(isset($data->zalo)){          $data_site_info['zalo']                 = $data->zalo;}
				if(isset($data->skype)){         $data_site_info['skype']                = $data->skype;}
				if(isset($data->messenger)){     $data_site_info['messenger']            = $data->messenger;}
				if(isset($data->facebook)){      $data_site_info['facebook']             = $data->facebook;}
				if(isset($data->youtube)){       $data_site_info['youtube']              = $data->youtube;}
				if(isset($data->pinterest)){     $data_site_info['pinterest']            = $data->pinterest;}
				if(isset($data->twitter)){       $data_site_info['twitter']              = $data->twitter;}
				if(isset($data->instagram)){     $data_site_info['instagram']            = $data->instagram;}
				if(isset($data->linkedin)){      $data_site_info['linkedin']             = $data->linkedin;}
				if(isset($data->head_script)){   $data_site_info['head_script']          = $data->head_script;}
				if(isset($data->body_script)){   $data_site_info['body_script']          = $data->body_script;}
				if(isset($data->success_script)){$data_site_info['success_script']       = $data->success_script;}
				if(isset($data->meta_key)){      $data_site_info['meta_key']             = $data->meta_key;}
				if(isset($data->meta_desc)){     $data_site_info['meta_desc']            = $data->meta_desc;}
				$data_site_info['social_image_link']                                     = $image_link;
				$data_site_info['logo_image_link']                                     	 = $logo_image_link;
				$data_site_info['favicon_image_link']                                    = $favicon_image_link;
				
				//Truyền data_site_info vào toàn trang
				$this->data['data_site_info'] 	= $data_site_info;
				
				
				//Truyền data data_site_info vào head
				$this->data['data_head'] 		= $data_site_info;
				

				//Hàm chuyển đổi đơn vị tiền tệ sang tỷ / triệu / đồng / ngàn
				function price_format($number){
					$price = $number;
					if($number >= '1000000000'){
						$price = $number / 1000000000;
						$price = str_replace(',00','',number_format($price, 2, ',', ' ').' Tỷ');
					}else{
						if($number >= '1000000'){
							$price = $number / 1000000;
							$price = str_replace(',00','',number_format($price, 2, ',', ' ').' Triệu');
						}else{
							if($number >= '1000'){
								$price = $number / 1000;
								$price = str_replace(',00','',number_format($price).' Ngàn');
							}else{
								$price = number_format($number).' Đồng';
							}
						}
					}

					return $price;
				}

				//loại bỏ dấu
				function loai_bo_dau($string)
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
					$string = preg_replace('/(-)+/', '', $string);
					$string = strtolower($string);
					return $string;
				}

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

				//Lấy danh sách thành phố
				$input 	= array();
				$input['order']	 = array('id','asc');
				$city_list = $this->city_model->get_list($input);
				$this->data['city_list'] = $city_list;

				//Lấy Danh Sách Chủ Đầu Tư
				$input = array();
				$input['where']	 = array('status' => '0');
				$input['order']	 = array('name','grade');
				$this->db->select('id, name, prefix');
				$chu_dau_tu_list 	= $this->chu_dau_tu_model->get_list($input);
				$this->data['chu_dau_tu_list'] = $chu_dau_tu_list;

				//Danh mục tin tức
				$catalog_news_list 		= array();
				$catalog_news_list[]	= array('id'=>'1','name'=>'Thị Trường','url' => base_url('tin-tuc-'.create_alias('Thị Trường').'-cn1'));
				$catalog_news_list[]	= array('id'=>'2','name'=>'Kiến Thức','url' => base_url('tin-tuc-'.create_alias('Kiến Thức').'-cn2'));
				$catalog_news_list[]	= array('id'=>'3','name'=>'Xây Dựng, Phong Thủy','url' => base_url('tin-tuc-'.create_alias('Xây Dựng, Phong Thủy').'-cn3'));
				$catalog_news_list[]	= array('id'=>'4','name'=>'Góc Tư Vấn','url' => base_url('tin-tuc-'.create_alias('Góc Tư Vấn').'-cn4'));
				$catalog_news_list[]	= array('id'=>'5','name'=>'Phân Tích, Nhận Định','url' => base_url('tin-tuc-'.create_alias('Phân Tích, Nhận Định').'-cn5'));
				$catalog_news_list[]	= array('id'=>'6','name'=>'Thông Tin Quy Hoạch','url' => base_url('tin-tuc-'.create_alias('Thông Tin Quy Hoạch').'-cn6'));
				$catalog_news_list[]	= array('id'=>'7','name'=>'Tài Chính','url' => base_url('tin-tuc-'.create_alias('Tài Chính').'-cn7'));

				$catalog_news_list[]	= array('id'=>'100','name'=>'Giới Thiệu','url' => base_url('tin-tuc-'.create_alias('Giới Thiệu').'-cn100'));
				$catalog_news_list[]	= array('id'=>'101','name'=>'Hỗ Trợ Khách Hàng','url' => base_url('tin-tuc-'.create_alias('Hỗ Trợ Khách Hàng').'-cn101'));
				$catalog_news_list[]	= array('id'=>'102','name'=>'Quảng Cáo','url' => base_url('tin-tuc-'.create_alias('Quảng Cáo').'-cn102'));

				$this->data['catalog_news_list'] = $catalog_news_list;

			}
		}
	}




	/*
	 * Kiểm tra trạng thái đăng nhập của Admin
	 */

	private function _check_login()
	{
		$controller = $this->uri->rsegment('1');
		$controller = strtolower($controller);

		$login = $this->session->userdata('login');
		// Nếu chưa đăng nhập mà truy cập vào controller khác 'login' thì chuyển về trang login
		if(!$login && $controller !='login')
		{
			redirect(admin_url('login'));
		}
		// Nếu đã đăng nhập thì không cho chuyển về trang login nữa
		if($login && $controller =='login')
		{
			redirect(admin_url('home'));
		}
	}
}