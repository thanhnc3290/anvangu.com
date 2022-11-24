<?php  
Class Project extends MY_Controller
{
	//private $perPage = 16; // mỗi trang loadmore thì thêm 10 kết quả

	/*
	* Hàm khởi tạo
	*/
	function __construct()
	{
		parent::__construct();
		$this->load->model('project_model');
		$this->load->model('city_model');
		$this->load->model('districts_model');
		$this->load->model('wards_model');
		$this->load->model('chu_dau_tu_model');

		

		
	}
	
	function index()
	{	
        echo 'project layout index';
	}

    function view()
	{	
		$id = $this->uri->rsegment('3');
		$info = $this->project_model->get_info($id);
		if(!$id){ redirect(base_url('404'));}
		if(!$info){ redirect(base_url('404'));}
		if($info->status !== '0'){ redirect(base_url('404'));}

		$this->data['info']	 = $info;

		$query_du_an_status  = $info->du_an_status;
		$this->data['query_du_an_status'] = $query_du_an_status;
		$query_loai_hinh_mua_ban_bds = $info->loai_hinh_1;
		$this->data['query_loai_hinh_mua_ban_bds'] = $query_loai_hinh_mua_ban_bds;

		$this->output->cache('40320');
        $this->data['temp'] = 'site/project/view';
		$this->load->view('site/project/layout', $this->data);
	}

	function chu_dau_tu_list(){
		$total_key = '0';
		$query_phan_trang = '0';
		$query_key_search = '';

		//input keysearch
		if(isset($_GET['key_search'])){
			$key_search				 		 	 = $_GET['key_search'];
			
			if($key_search !== ''){
				$query_key_search 				= str_replace('"','',json_encode($key_search));
				$total_key++;
				$this->data['key_search']		= trim($key_search);
			}
		}

		$this->data['total_key'] = $total_key;

		$input = array();
		$input['order'] = array('name','grade');

		//phân Trang
		if(isset($_GET['phan_trang'])){
			$phan_trang						 	= $_GET['phan_trang'];
			if($phan_trang !== ''){
				$query_phan_trang					= $phan_trang;
			}
		}
		$this->data['query_phan_trang']			= $query_phan_trang;
		$per_page		= '12'; // item từng trang
		$from_number 	= $query_phan_trang * $per_page;
		$to_number		= $per_page;  
		
		$input['limit']	= array($to_number,$from_number); // Phân Trang theo ?phan_trang=, 10 item 1 trang

		if($query_key_search !==''){
			$this->db->like('name', trim($query_key_search));
		}
		$this->data['query_key_search']	= $query_key_search;

		$this->db->select('id, prefix, name, alias');

		$list 			= $this->chu_dau_tu_model->get_list($input);
		$total_list		= $this->chu_dau_tu_model->get_total();
		$this->data['list']	= $list;
		$this->data['total_list']	= $total_list;

		//tạo thông tin head

		$site_title	= 'Anvangu.com | Danh sách Chủ Đầu Tư';
		$meta_desc	= 'Thông tin tổng hợp về doanh nghiệp BDS tại Việt Nam, thời gian mở bán dự án bất động sản. Tin tức mới nhất về thị trường và các dự án mới. Phân tích dòng tiền đầu tư dự án. Căn hộ, nhà phố, shophouse, biệt thự biển từ cđt uy tín. Căn hộ, nhà phố đô thị. Bất động sản nghỉ dưỡng. Tư vấn hoàn toàn miễn phí.';
		$head_url	= base_url('chu-dau-tu');
		
		$head_danh_muc = array();
		$head_danh_muc['site_title'] 	= $site_title;
		$head_danh_muc['meta_desc'] 	= $meta_desc;
		$head_danh_muc['url'] 			= $head_url;
		$this->data['head_danh_muc']	= $head_danh_muc;

		$query_du_an_status  = '';
		$this->data['query_du_an_status'] = $query_du_an_status;
		$query_loai_hinh_mua_ban_bds = '';
		$this->data['query_loai_hinh_mua_ban_bds'] = $query_loai_hinh_mua_ban_bds;

		$this->output->cache('5');

		$this->data['temp'] = 'site/project/chu_dau_tu_list';
		$this->load->view('site/project/layout', $this->data);
	}
	
	function chu_dau_tu(){
		$id_chu_dau_tu = $this->uri->rsegment('3');
		if(!$id_chu_dau_tu){ redirect(base_url('404'));}

		$info 	= $this->chu_dau_tu_model->get_info($id_chu_dau_tu);
		if(!$info){ redirect(base_url('404'));}
		if($info->status !== '0'){ redirect(base_url('404'));}

		$this->data['info']	 = $info;

		//tạo thông tin head

		$site_title	= 'Anvangu.com | '.json_decode($info->prefix).' '. json_decode($info->name);
		$meta_desc	= json_decode($info->meta_desc);
		$head_url	= base_url($info->alias.'-cdt'.$info->id);
		
		$head_danh_muc = array();
		$head_danh_muc['site_title'] 	= $site_title;
		$head_danh_muc['meta_desc'] 	= $meta_desc;
		$head_danh_muc['url'] 			= $head_url;
		$this->data['head_danh_muc']	= $head_danh_muc;

		$query_du_an_status  = '';
		$this->data['query_du_an_status'] = $query_du_an_status;
		$query_loai_hinh_mua_ban_bds = '';
		$this->data['query_loai_hinh_mua_ban_bds'] = $query_loai_hinh_mua_ban_bds;

		$this->output->cache('5');

		$this->data['temp'] = 'site/project/chu_dau_tu';
		$this->load->view('site/project/layout', $this->data);
	}

	function city(){
		echo 'project layout city';
	}

	function districts(){
		echo 'project layout districts';
	}

	function wards(){
		echo 'project layout wards';
	}

	function map(){
		$this->data['temp'] = 'site/project/map';
		$this->load->view('site/project/layout', $this->data);
	}

	function all_location(){
		//phân Trang
		$query_phan_trang				= '0';
		if(isset($_GET['phan_trang'])){
			$phan_trang						 	= $_GET['phan_trang'];
			if($phan_trang !== ''){
				$query_phan_trang					= $phan_trang;
			}
		}
		$this->data['query_phan_trang']			= $query_phan_trang;

		$input = array();
		$input['order'] = array('id','asc');
		
		$per_page		= '24'; // item từng trang
		$from_number 	= $query_phan_trang * $per_page;
		$to_number		= $per_page;  
		
		$input['limit']	= array($to_number,$from_number); // Phân Trang theo ?phan_trang=, 10 item 1 trang

		$list 			= $this->city_model->get_list($input);
		$this->data['list']	= $list;

		$query_du_an_status  = '';
		$this->data['query_du_an_status'] = $query_du_an_status;
		$query_loai_hinh_mua_ban_bds = '';
		$this->data['query_loai_hinh_mua_ban_bds'] = $query_loai_hinh_mua_ban_bds;

		$this->output->cache('5');

		$this->data['temp'] = 'site/project/all_location';
		$this->load->view('site/project/layout', $this->data);
	}

	//Dùng query search làm trang danh sách
	function search(){
		$total_key = '';
		$query_du_an_status 			= '';
		$query_loai_hinh_mua_ban_bds 	= '';
		$query_loai_hinh_bds 		 	= '';
		$query_khoang_gia_bds			= '';
		$query_khoang_gia_cho_thue_bds  = '';
		$query_dien_tich_bds			= '';
		$query_huong_nha_bds			= '';
		$query_vi_tri_bds				= '';
		$query_trang_thai_bds			= '';
		$query_chu_dau_tu_id			= '';
		$query_city_id					= '';
		$query_districts_id				= '';
		$query_wards_id					= '';
		$query_input_key_search			= '';

		$query_input_key_search_theo_ten = '';


		//thông tin truyền vào head
		$site_title	= 'Anvangu.com | Danh Sách BĐS';
		$meta_desc	= 'Thông tin mở bán dự án bất động sản. Tin tức mới nhất về thị trường và các dự án mới. Phân tích dòng tiền đầu tư dự án. Căn hộ, nhà phố, shophouse, biệt thự biển từ cđt uy tín. Căn hộ, nhà phố đô thị. Bất động sản nghỉ dưỡng. Tư vấn hoàn toàn miễn phí.';
		$head_url	= base_url('danh-sach-bds').'?';

		//Sort_by
		$query_sort_by 					= '';
		if(isset($_GET['sort_by'])){
			$sort_by						 	= urldecode($_GET['sort_by']);
			$total_key						   .= $sort_by;
			if(($sort_by !== '') && ($sort_by !== 'Mới nhất')){
				$query_sort_by					= trim($sort_by);
				$head_url	.= '&sort_by='.$sort_by;
			}
		}
		$this->data['query_sort_by']			= $query_sort_by;
		

		//phân Trang
		$query_phan_trang				= '0';
		if(isset($_GET['phan_trang'])){
			$phan_trang						 	= $_GET['phan_trang'];
			$total_key						   .= $phan_trang;
			if($phan_trang !== ''){
				$query_phan_trang					= $phan_trang;
			}
		}
		$this->data['query_phan_trang']			= $query_phan_trang;

		if(isset($_GET['loai_hinh_mua_ban_bds'])){
			$loai_hinh_mua_ban_bds				 = urldecode($_GET['loai_hinh_mua_ban_bds']);
			$total_key							.= $loai_hinh_mua_ban_bds;
			if($loai_hinh_mua_ban_bds !== 'Tất Cả'){
				$query_loai_hinh_mua_ban_bds		 = json_encode($loai_hinh_mua_ban_bds);
				$site_title		   .= ' '.$loai_hinh_mua_ban_bds;
				$head_url		   .= '&loai_hinh_mua_ban_bds='.$loai_hinh_mua_ban_bds;
			}
		}
		$this->data['query_loai_hinh_mua_ban_bds'] = $query_loai_hinh_mua_ban_bds;

		if(isset($_GET['du_an_status'])){
			$du_an_status						 = $_GET['du_an_status'];
			$total_key							.= $du_an_status;
			$query_du_an_status					 = $du_an_status;

			if($du_an_status == '1'){$site_title		   .= ' Dự Án';}
			$head_url		   .= '&du_an_status='.$du_an_status;
		}
		$this->data['query_du_an_status']		 = $query_du_an_status;

		if(isset($_GET['loai_hinh_bds'])){
			$loai_hinh_bds				 		 = urldecode($_GET['loai_hinh_bds']);
			$total_key							.= $loai_hinh_bds;
			if($loai_hinh_bds !== 'Tất Cả'){
				$query_loai_hinh_bds		 	 = json_encode($loai_hinh_bds);
				$site_title		   .= ' '.$loai_hinh_bds;
				$head_url		   .= '&loai_hinh_bds='.$loai_hinh_bds;
			}
		}
		$this->data['query_loai_hinh_bds'] = $query_loai_hinh_bds;

		//Tìm Theo Location
		$show_location_1 = '';
		if(isset($_GET['location_id'])){
			$location_id						 = urldecode($_GET['location_id']);
			$total_key							.= $location_id;

			$city_id 		= '';
			$districts_id 	= '';

			$data_location  = explode('-find-',$location_id);
			foreach($data_location as $row){
				if(strpos($row,'city_id')  !== false){
					$city_id		= trim(str_replace('city_id','',$row));
				}
				if(strpos($row,'districts_id')  !== false){
					$districts_id 	= trim(str_replace('districts_id','',$row));
				}
			}

			
			if($districts_id !== ''){
				$query_districts_id = $districts_id;
				$districts_name		= $this->districts_model->get_info($districts_id)->name;
				$site_title		   .= ' '.json_decode($districts_name);
				$head_url		   .= '&districts_id='.$districts_id;

				$show_location_1 .= json_decode($districts_name);
			}

			if($city_id !== ''){
				$query_city_id = $city_id;
				$city_name			= $this->city_model->get_info($city_id)->name;
				$site_title		   .= ' '.json_decode($city_name);
				$head_url		   .= '&city_id='.$city_id;
				
				$show_location_1 .= ' '.json_decode($city_name);
			}
			$this->data['show_location_1'] = $show_location_1;
		}else{
			if(isset($_GET['input_key_search'])){
				$input_key_search 					 = urldecode($_GET['input_key_search']);
				$total_key							.= $input_key_search;
				if($input_key_search !== ''){
					$query_input_key_search		 	 = $input_key_search;
				}

				$show_location = $input_key_search;
				$this->data['show_location'] = $show_location;
			}
		}

		
		
		
		//tìm theo tên
		if(isset($_GET['search_theo_ten'])){
			$input_key_search_theo_ten = urldecode($_GET['search_theo_ten']);
			if($input_key_search_theo_ten !== ''){
				$query_input_key_search_theo_ten = $input_key_search_theo_ten;
			}
		}
		$this->data['query_input_key_search_theo_ten'] = $query_input_key_search_theo_ten;
		
		
		if(isset($_GET['khoang_gia_bds'])){
			$khoang_gia_bds				 		 = urldecode($_GET['khoang_gia_bds']);
			$total_key							.= $khoang_gia_bds;
			if($khoang_gia_bds !== 'Tất Cả'){
				$query_khoang_gia_bds	 	 	= $khoang_gia_bds;
			}
		}
		$this->data['query_khoang_gia_bds'] = $query_khoang_gia_bds;

		if(isset($_GET['khoang_gia_cho_thue_bds'])){
			$khoang_gia_cho_thue_bds				 	= urldecode($_GET['khoang_gia_cho_thue_bds']);
			$total_key								   .= $khoang_gia_cho_thue_bds;
			if($khoang_gia_cho_thue_bds !== 'Tất Cả'){
				$query_khoang_gia_cho_thue_bds	 	 	= $khoang_gia_cho_thue_bds;
			}
		}
		$this->data['query_khoang_gia_cho_thue_bds'] = $query_khoang_gia_cho_thue_bds;

		if(isset($_GET['dien_tich_bds'])){
			$dien_tich_bds				 		 = urldecode($_GET['dien_tich_bds']);
			$total_key							.= $dien_tich_bds;
			if($dien_tich_bds !== 'Tất Cả'){
				$query_dien_tich_bds	 	 	= $dien_tich_bds;
			}
		}
		$this->data['query_dien_tich_bds'] = $query_dien_tich_bds;

		if(isset($_GET['huong_nha_bds'])){
			$huong_nha_bds				 		 = urldecode($_GET['huong_nha_bds']);
			$total_key							.= $huong_nha_bds;
			if($huong_nha_bds !== 'Tất Cả'){
				$query_huong_nha_bds	 	 	= json_encode($huong_nha_bds);
			}
		}
		if(isset($_GET['vi_tri_bds'])){
			$vi_tri_bds				 		 	 = urldecode($_GET['vi_tri_bds']);
			$total_key							.= $vi_tri_bds;
			if($vi_tri_bds !== 'Tất Cả'){
				if($vi_tri_bds == 'Mặt Tiền'){
					$query_vi_tri_bds = 'vi_tri_mat_tien';
				}
				if($vi_tri_bds == 'Mặt Hẻm'){
					$query_vi_tri_bds = 'vi_tri_mat_hem';
				}
			}
		}
		if(isset($_GET['trang_thai_bds'])){
			$trang_thai_bds				 		 = urldecode($_GET['trang_thai_bds']);
			$total_key							.= $trang_thai_bds;
			if($trang_thai_bds !== 'Tất Cả'){
				$query_trang_thai_bds	 	 	= json_encode($trang_thai_bds);
			}
		}
		if(isset($_GET['chu_dau_tu_id'])){
			$chu_dau_tu_id						 	 = urldecode($_GET['chu_dau_tu_id']);
			$total_key								.= $chu_dau_tu_id;
			if($chu_dau_tu_id > '0'){
				$query_chu_dau_tu_id				 = trim($chu_dau_tu_id);
			}
		}

		
		//search theo id location
		$show_location_2 = '';
		if(isset($_GET['wards_id'])){
			$wards_id				 		 	 = $_GET['wards_id'];
			$total_key							.= trim($wards_id);
			if($wards_id !== ''){
				$query_wards_id = $wards_id;
				$show_location_2 .= json_decode($this->wards_model->get_info($wards_id)->name).', ';
			}
			
		}

		if(isset($_GET['districts_id'])){
			$districts_id				 		 = $_GET['districts_id'];
			$total_key							.= trim($districts_id);
			if($districts_id !== ''){
				$query_districts_id = $districts_id;
				$show_location_2 .= json_decode($this->districts_model->get_info($districts_id)->name).', ';
			}
		}

		if(isset($_GET['city_id'])){
			$city_id				 		 	 = $_GET['city_id'];
			$total_key							.= trim($city_id);
			if($city_id !== ''){
				$query_city_id = $city_id;
				$show_location_2 .= json_decode($this->city_model->get_info($city_id)->name);
			}
		}
		$this->data['show_location_2'] = $show_location_2;
		
		


		if(isset($_GET['key_search'])){
			$key_search				 		 	 = $_GET['key_search'];
			$total_key							.= $key_search;
		}

		if($total_key == ''){
			redirect(base_url());
		}
		
		//Tạo 1 biến để query
		$filter_data = array(
			'status' 				=> '0',
			'du_an_status'			=> $query_du_an_status,
			'chu_dau_tu_id'			=> $query_chu_dau_tu_id,
			'loai_hinh_1'			=> $query_loai_hinh_mua_ban_bds,
			//'loai_hinh_2'			=> $query_loai_hinh_bds,
			'loai_hinh_3'			=> $query_huong_nha_bds,
			'trang_thai_bds'		=> $query_trang_thai_bds,
			'city_id'				=> $query_city_id,
			'districts_id'			=> $query_districts_id,
			'wards_id'				=> $query_wards_id,
		);
		//Xóa điều kiện nếu value rỗng
		if($query_du_an_status == '')		  	{	unset($filter_data['du_an_status']);}
		if($query_loai_hinh_mua_ban_bds == '')	{	unset($filter_data['loai_hinh_1']);}
		//if($query_loai_hinh_bds == '')			{	unset($filter_data['loai_hinh_2']);}
		if($query_huong_nha_bds == '')			{	unset($filter_data['loai_hinh_3']);}
		if($query_trang_thai_bds == '')			{	unset($filter_data['trang_thai_bds']);}
		if($query_city_id == '')				{	unset($filter_data['city_id']);}
		if($query_districts_id == '')			{	unset($filter_data['districts_id']);}
		if($query_wards_id == '')				{	unset($filter_data['wards_id']);}
		if($query_chu_dau_tu_id == '')			{	unset($filter_data['chu_dau_tu_id']);}
		

		$input = array();
		$input['where'] = $filter_data; // truyền biến query vào input['where']
		
		$per_page		= '24'; // item từng trang
		$from_number 	= $query_phan_trang * $per_page;
		$to_number		= $per_page;  
		
		$input['limit']	= array($to_number,$from_number); // Phân Trang theo ?phan_trang=, 10 item 1 trang
		

		//tạo mảng để query giá bán theo khoảng
			if(trim($query_khoang_gia_bds) == 'Đến 500 triệu'){
				$money_max = '500000000';
				$this->db->where('gia_tien <=', $money_max);
				$this->db->where('gia_tien >', '0');
			}
			if(trim($query_khoang_gia_bds) == 'Từ 500 - Đến 800 triệu'){
				$money_min = '500000000';
				$money_max = '800000000';
				$this->db->where('gia_tien <=', $money_max);
				$this->db->where('gia_tien >=', $money_min);
			}
			if(trim($query_khoang_gia_bds) == 'Từ 800 triệu - Đến 1 tỷ'){
				$money_min = '800000000';
				$money_max = '1000000000';
				$this->db->where('gia_tien <=', $money_max);
				$this->db->where('gia_tien >=', $money_min);
			}
			if(trim($query_khoang_gia_bds) == 'Từ 1 tỷ - Đến 2 tỷ'){
				$money_min = '1000000000';
				$money_max = '2000000000';
				$this->db->where('gia_tien <=', $money_max);
				$this->db->where('gia_tien >=', $money_min);
			}
			if(trim($query_khoang_gia_bds) == 'Từ 2 tỷ - Đến 3 tỷ'){
				$money_min = '2000000000';
				$money_max = '3000000000';
				$this->db->where('gia_tien <=', $money_max);
				$this->db->where('gia_tien >=', $money_min);
			}
			if(trim($query_khoang_gia_bds) == 'Từ 3 tỷ - Đến 5 tỷ'){
				$money_min = '3000000000';
				$money_max = '5000000000';
				$this->db->where('gia_tien <=', $money_max);
				$this->db->where('gia_tien >=', $money_min);
			}
			if(trim($query_khoang_gia_bds) == 'Từ 5 tỷ - Đến 7 tỷ'){
				$money_min = '5000000000';
				$money_max = '7000000000';
				$this->db->where('gia_tien <=', $money_max);
				$this->db->where('gia_tien >=', $money_min);
			}
			if(trim($query_khoang_gia_bds) == 'Từ 7 tỷ - Đến 10 tỷ'){
				$money_min = '7000000000';
				$money_max = '10000000000';
				$this->db->where('gia_tien <=', $money_max);
				$this->db->where('gia_tien >=', $money_min);
			}
			if(trim($query_khoang_gia_bds) == 'Từ 10 tỷ - Đến 20 tỷ'){
				$money_min = '10000000000';
				$money_max = '20000000000';
				$this->db->where('gia_tien <=', $money_max);
				$this->db->where('gia_tien >=', $money_min);
			}
			if(trim($query_khoang_gia_bds) == 'Từ 20 tỷ - Đến 30 tỷ'){
				$money_min = '20000000000';
				$money_max = '30000000000';
				$this->db->where('gia_tien <=', $money_max);
				$this->db->where('gia_tien >=', $money_min);
			}
			if(trim($query_khoang_gia_bds) == 'Từ 30 tỷ - Đến 50 tỷ'){
				$money_min = '30000000000';
				$money_max = '50000000000';
				$this->db->where('gia_tien <=', $money_max);
				$this->db->where('gia_tien >=', $money_min);
			}
			if(trim($query_khoang_gia_bds) == 'Từ 50 tỷ'){
				$money_min = '50000000000';
				$this->db->where('gia_tien >=', $money_min);
			}
		//End Query giá tiền bán

		//tạo mảng để  query giá thuê theo khoảng
			if(trim($query_khoang_gia_cho_thue_bds) == '< 1 triệu'){
				$money_max = '1000000';
				$this->db->where('gia_tien_thue <=', $money_max);
				$this->db->where('gia_tien_thue >', '0');
			}
			if(trim($query_khoang_gia_cho_thue_bds) == '1 - 3 triệu'){
				$money_min = '1000000';
				$money_max = '3000000';
				$this->db->where('gia_tien_thue <=', $money_max);
				$this->db->where('gia_tien_thue >=', $money_min);
			}
			if(trim($query_khoang_gia_cho_thue_bds) == '3 - 5 triệu'){
				$money_min = '3000000';
				$money_max = '5000000';
				$this->db->where('gia_tien_thue <=', $money_max);
				$this->db->where('gia_tien_thue >=', $money_min);
			}
			if(trim($query_khoang_gia_cho_thue_bds) == '5 - 7 triệu'){
				$money_min = '5000000';
				$money_max = '7000000';
				$this->db->where('gia_tien_thue <=', $money_max);
				$this->db->where('gia_tien_thue >=', $money_min);
			}
			if(trim($query_khoang_gia_cho_thue_bds) == '7 - 10 triệu'){
				$money_min = '7000000';
				$money_max = '10000000';
				$this->db->where('gia_tien_thue <=', $money_max);
				$this->db->where('gia_tien_thue >=', $money_min);
			}

			if(trim($query_khoang_gia_cho_thue_bds) == '10 - 30 triệu'){
				$money_min = '10000000';
				$money_max = '30000000';
				$this->db->where('gia_tien_thue <=', $money_max);
				$this->db->where('gia_tien_thue >=', $money_min);
			}
			if(trim($query_khoang_gia_cho_thue_bds) == '30 - 50 triệu'){
				$money_min = '30000000';
				$money_max = '50000000';
				$this->db->where('gia_tien_thue <=', $money_max);
				$this->db->where('gia_tien_thue >=', $money_min);
			}
			if(trim($query_khoang_gia_cho_thue_bds) == '50 - 100 triệu'){
				$money_min = '50000000';
				$money_max = '100000000';
				$this->db->where('gia_tien_thue <=', $money_max);
				$this->db->where('gia_tien_thue >=', $money_min);
			}
			if(trim($query_khoang_gia_cho_thue_bds) == '> 100 triệu'){
				$money_min = '100000000';
				$this->db->where('gia_tien_thue >=', $money_min);
			}
			echo $query_khoang_gia_cho_thue_bds;
		//End Query giá tiền thuê

		//Tạo mảng để query diện tích
			if(trim($query_dien_tich_bds) == 'Đến 30 m²'){
				$dien_tich_max = '30';
				$this->db->where('dien_tich <=', $dien_tich_max);
				$this->db->where('dien_tich >', '0');
			}

			if(trim($query_dien_tich_bds) == 'Từ 30 m² - Đến 50 m²'){
				$dien_tich_min = '30';
				$dien_tich_max = '50';
				$this->db->where('dien_tich >=', $dien_tich_min);
				$this->db->where('dien_tich <=', $dien_tich_max);
			}
			if(trim($query_dien_tich_bds) == 'Từ 50 m² - Đến 80 m²'){
				$dien_tich_min = '50';
				$dien_tich_max = '80';
				$this->db->where('dien_tich >=', $dien_tich_min);
				$this->db->where('dien_tich <=', $dien_tich_max);
			}
			if(trim($query_dien_tich_bds) == 'Từ 80 m² - Đến 100 m²'){
				$dien_tich_min = '80';
				$dien_tich_max = '100';
				$this->db->where('dien_tich >=', $dien_tich_min);
				$this->db->where('dien_tich <=', $dien_tich_max);
			}
			if(trim($query_dien_tich_bds) == 'Từ 100 m² - Đến 300 m²'){
				$dien_tich_min = '100';
				$dien_tich_max = '300';
				$this->db->where('dien_tich >=', $dien_tich_min);
				$this->db->where('dien_tich <=', $dien_tich_max);
			}
			if(trim($query_dien_tich_bds) == 'Từ 300 m² - Đến 500 m²'){
				$dien_tich_min = '300';
				$dien_tich_max = '500';
				$this->db->where('dien_tich >=', $dien_tich_min);
				$this->db->where('dien_tich <=', $dien_tich_max);
			}
			if(trim($query_dien_tich_bds) == 'Từ 500 m²'){
				$dien_tich_min = '500';
				$this->db->where('dien_tich >=', $dien_tich_min);
			}
		//End Query diện tích

		//Query loại hình bds chính / phụ, mặt tiền , mặt hẻm bằng like
		$key_search_to_input_like = '';
		$check_search = '0';
		if($query_loai_hinh_bds !== ''){
			$check_search++;
			$key_search_to_input_like 	.= loai_bo_dau($_GET['loai_hinh_bds']);
		}
		if(trim($query_vi_tri_bds) !== ''){
			$check_search++;
			$key_search_to_input_like 	.= loai_bo_dau($_GET['vi_tri_bds']);
		}
		if(($query_input_key_search) !== ''){
			$check_search++;
			$key_search_to_input_like 	.= loai_bo_dau($query_input_key_search);
		}
		if($check_search > '0'){
			$this->db->like('key_search', trim($key_search_to_input_like));
		}

		//thêm like theo tên
		if($check_search > '0'){
			if($query_input_key_search_theo_ten !== ''){
				$key_search_theo_ten = str_replace('"','',json_encode($query_input_key_search_theo_ten));
				$this->db->or_like('name', trim($key_search_theo_ten));
			}
		}else{
			if($query_input_key_search_theo_ten !== ''){
				$key_search_theo_ten = str_replace('"','',json_encode($query_input_key_search_theo_ten));
				$this->db->like('name', trim($key_search_theo_ten));
			}
		}

		

		//query theo sort_by
		if($query_sort_by == ''){
			$input['order']	= array('id','desc');
		}else{
			
				
			
			//if(isset($_GET['khoang_gia_cho_thue_bds'])){
			if(json_decode($query_loai_hinh_mua_ban_bds) == 'Cho Thuê'){
				if($query_sort_by == 'Giá giảm dần'){
					$input['order']	= array('gia_tien_thue','desc');
				}
				if($query_sort_by == 'Giá tăng dần'){
					$input['order']	= array('gia_tien_thue','asc');
				}
			}else{
				if($query_sort_by == 'Giá giảm dần'){
					$input['order']	= array('gia_tien','desc');
				}
				if($query_sort_by == 'Giá tăng dần'){
					$input['order']	= array('gia_tien','asc');
				}
			}

			if($query_sort_by == 'Diện tích giảm dần'){
				$input['order']	= array('dien_tich','desc');
			}
			if($query_sort_by == 'Diện tích tăng dần'){
				$input['order']	= array('dien_tich','asc');
			}
		}
		

		
		//select dữ liệu
		$this->db->select('id, name, alias, meta_desc, loai_hinh_1, loai_hinh_2, loai_hinh_3, location, gia_tien, gia_tien_option, gia_tien_thue, gia_tien_thue_option, dien_tich, chu_dau_tu_id, phong_ngu, phong_tam, chi_tiet_nha_dat, image_link, image_list, update_time, key_search');
		$list 	= $this->project_model->get_list($input);
		$this->data['list']	= $list;


		//tạo thông tin head
		
		$head_danh_muc = array();
		$head_danh_muc['site_title'] 	= $site_title;
		$head_danh_muc['meta_desc'] 	= $meta_desc;
		$head_danh_muc['url'] 			= $head_url;
		$this->data['head_danh_muc']	= $head_danh_muc;

		
		$this->output->cache('5');

		$this->data['temp'] = 'site/project/search';
		$this->load->view('site/project/layout', $this->data);
	}

	

	function error()
	{	

		redirect(base_url());
		
		$this->data['temp'] = 'site/home/404';

		$this->load->view('site/layout', $this->data);
	}

}
