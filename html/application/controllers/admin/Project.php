<?php 
Class Project extends MY_Controller
{
	function __construct()
	{
		parent::__construct();
		$this->load->model('city_model');
		$this->load->model('districts_model');
		$this->load->model('wards_model');
		$this->load->model('project_model');
		$this->load->model('chu_dau_tu_model');

		//Danh sách chủ đầu tư
		$input 				= array();
		$input['order']		= array('grade');
		$this->db->select('id, name, prefix, status');
		$chu_dau_tu_list	= $this->chu_dau_tu_model->get_list($input);
		$this->data['chu_dau_tu_list']	= $chu_dau_tu_list;

		//loại bỏ dấu
		function loai_bo_dau_admin($string)
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
	}

	/*
	*Lấy danh sách admin
	*/
	
	function api_project_list(){
		$this->load->view('admin/project/api_project_list');
	}

	function api_project_city_list(){
		$this->load->view('admin/project/api_project_city_list');
	}

	function api_project_wards_list_of_districts(){
		$this->load->view('admin/project/api_project_wards_list_of_districts');
	}

	function api_project_districts_list_of_city(){
		$this->load->view('admin/project/api_project_districts_list_of_city');
	}

	function index()
	{
		$this->load->view('admin/project/index', $this->data);
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

				$google_map				= $this->input->post('google_map');
				$google_map				= str_replace(array('<iframe src="','" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'),'',$google_map);

				$meta_key   			= $this->input->post('meta_key');
				$meta_desc   			= $this->input->post('meta_desc');
				$content   				= $this->input->post('content');

				$dien_tich   			= $this->input->post('dien_tich');
				$chieu_dai				= $this->input->post('chieu_dai');
				$chieu_rong				= $this->input->post('chieu_rong');
				$gia_tien   			= $this->input->post('gia_tien');
				$gia_tien_option   		= $this->input->post('gia_tien_option');
				$loai_hinh_1   			= $this->input->post('loai_hinh_1');
				$loai_hinh_2   			= $this->input->post('loai_hinh_2');
				$loai_hinh_3   			= $this->input->post('loai_hinh_3');

				$phong_ngu				= $this->input->post('phong_ngu');
				$phong_tam				= $this->input->post('phong_tam');

				$location = '';
				$wards_id				= $this->input->post('wards_id');
				$wards_name				= '';
				if(isset($wards_id)){
					$wards_name			= json_decode($this->wards_model->get_info($wards_id)->name);
					$location			.= ' '.json_decode($this->wards_model->get_info($wards_id)->prefix).' '.json_decode($this->wards_model->get_info($wards_id)->name).', ';
				}
				$districts_id			= $this->input->post('districts_id');
				$districts_name			= '';
				if(isset($districts_id)){
					$districts_name		= json_decode($this->districts_model->get_info($districts_id)->name);
					$location			.= 'Quận / Huyện '.json_decode($this->districts_model->get_info($districts_id)->name).', ';
				}
				$city_id				= $this->input->post('city_id');
				$city_name				= '';
				if(isset($city_id )){
					$city_name			= json_decode($this->city_model->get_info($city_id)->name);
				}
				$location				.= 'Thành Phố '.json_decode($this->city_model->get_info($city_id)->name);
				$key_search				= '';
				$key_search 			.= $name.' '.$alias.' '.$loai_hinh_1.' '.$loai_hinh_2.' hướng '.$loai_hinh_3.' diện tích '.$dien_tich.' chiều dài '.$chieu_dai.' chiều rộng '.$chieu_rong.' '.$phong_ngu.' phòng ngủ '.$phong_tam.' phòng tắm '.$location;

				$chi_tiet_nha_dat		= array();
				//gộp các check box vào $chi_tiet_nha_dat 
				
				$so_tang 				= $this->input->post('so_tang');
				$chi_tiet_nha_dat['so_tang'] = $so_tang;
				if($so_tang > '0'){
					$key_search		   .= ' '.$so_tang.' Tầng';
				}

				$giay_to_phap_ly 		= $this->input->post('giay_to_phap_ly');
				if($giay_to_phap_ly == '1'){
					$chi_tiet_nha_dat['giay_to_phap_ly'] = 'Giấy Tờ Pháp Lý: Sổ Hồng';
					$key_search		   .= ' Sổ Hồng, Sổ Đỏ';
				}

				$vi_tri_mat_tien 		= $this->input->post('vi_tri_mat_tien');
				if($vi_tri_mat_tien == '1'){
					$chi_tiet_nha_dat['vi_tri_mat_tien'] = 'Vị Trí: Mặt Tiền';
					$key_search		   .= ' Mặt Tiền';
				}

				$vi_tri_mat_hem 		= $this->input->post('vi_tri_mat_hem');
				if($vi_tri_mat_hem == '1'){
					$chi_tiet_nha_dat['vi_tri_mat_hem'] = 'Vị Trí: Mặt Hẻm';
					$key_search		   .= ' Mặt Hẻm';
				}

				$gan_cho 				= $this->input->post('gan_cho');
				if($gan_cho == '1'){
					$chi_tiet_nha_dat['gan_cho'] = 'Gần Chợ';
					$key_search		   .= ' Gần Chợ';
				}

				$nha_tre 				= $this->input->post('nha_tre');
				if($nha_tre == '1'){
					$chi_tiet_nha_dat['nha_tre'] = 'Gần Nhà Trẻ';
					$key_search		   .= ' Gần Nhà Trẻ';
				}

				$truong_cap_2 			= $this->input->post('truong_cap_2');
				if($truong_cap_2 == '1'){
					$chi_tiet_nha_dat['truong_cap_2'] = 'Gần Trường Cấp 2';
					$key_search		   .= ' Gần Trường Cấp 2';
				}

				$truong_cap_3 			= $this->input->post('truong_cap_3');
				if($truong_cap_3 == '1'){
					$chi_tiet_nha_dat['truong_cap_3'] = 'Gần Trường Cấp 3';
					$key_search		   .= ' Gần Trường Cấp 3';
				}

				$dai_hoc 			= $this->input->post('dai_hoc');
				if($dai_hoc == '1'){
					$chi_tiet_nha_dat['dai_hoc'] = 'Gần Trường Đại Học';
					$key_search		   .= ' Gần Trường Đại Học';
				}

				$ho_boi 				= $this->input->post('ho_boi');
				if($ho_boi == '1'){
					$chi_tiet_nha_dat['ho_boi'] = 'Gần Hồ Bơi';
					$key_search		   .= ' Gần Hồ Bơi';
				}

				$khu_dan_cu 				= $this->input->post('khu_dan_cu');
				if($khu_dan_cu == '1'){
					$chi_tiet_nha_dat['khu_dan_cu'] = 'Gần Khu Dân Cư';
					$key_search		   .= ' Gần Khu Dân Cư';
				}

				$sieu_thi 				= $this->input->post('sieu_thi');
				if($sieu_thi == '1'){
					$chi_tiet_nha_dat['sieu_thi'] = 'Gần Siêu Thị';
					$key_search		   .= ' Gần Siêu Thị';
				}

				$benh_vien 				= $this->input->post('benh_vien');
				if($benh_vien == '1'){
					$chi_tiet_nha_dat['benh_vien'] = 'Gần Bệnh Viện';
					$key_search		   .= ' Gần Bệnh Viện';
				}

				$cho_dau_oto 				= $this->input->post('cho_dau_oto');
				if($sieu_thi == '1'){
					$chi_tiet_nha_dat['cho_dau_oto'] = 'Có Chỗ Đậu Ô Tô';
					$key_search		   .= ' Có Chỗ Đậu Ô Tô';
				}

				$duong_nhua 			= $this->input->post('duong_nhua');
				if($duong_nhua == '1'){
					$chi_tiet_nha_dat['duong_nhua'] = 'Đường Trải Nhựa';
					$key_search		   .= ' Đường Trải Nhựa';
				}

				$camera_an_ninh 			= $this->input->post('camera_an_ninh');
				if($camera_an_ninh == '1'){
					$chi_tiet_nha_dat['camera_an_ninh'] = 'Camera An Ninh';
					$key_search		   .= ' Camera An Ninh';
				}

				$view_bien 			= $this->input->post('view_bien');
				if($view_bien == '1'){
					$chi_tiet_nha_dat['view_bien'] = 'View Biển';
					$key_search		   .= ' View Biển';
				}

				$trung_tam_hanh_chinh 			= $this->input->post('trung_tam_hanh_chinh');
				if($trung_tam_hanh_chinh == '1'){
					$chi_tiet_nha_dat['trung_tam_hanh_chinh'] = 'Gần Trung Tâm Hành Chính';
					$key_search		   .= ' Gần Trung Tâm Hành Chính';
				}

				$san_bay 			= $this->input->post('san_bay');
				if($san_bay == '1'){
					$chi_tiet_nha_dat['san_bay'] = 'Gần Sân Bay';
					$key_search		   .= ' Gần Sân Bay';
				}

				$san_golf 			= $this->input->post('san_golf');
				if($san_golf == '1'){
					$chi_tiet_nha_dat['san_golf'] = 'Gần Sân Golf';
					$key_search		   .= ' Gần Sân Golf';
				}

				$cong_vien 			= $this->input->post('cong_vien');
				if($cong_vien == '1'){
					$chi_tiet_nha_dat['cong_vien'] = 'Gần Công Viên';
					$key_search		   .= ' Gần Công Viên';
				}

				$trung_tam_mua_sam 			= $this->input->post('trung_tam_mua_sam');
				if($trung_tam_mua_sam == '1'){
					$chi_tiet_nha_dat['trung_tam_mua_sam'] = 'Gần Trung Tâm Mua Sắm';
					$key_search		   .= ' Gần Trung Tâm Mua Sắm';
				}

				$dia_chi_cu_the 			= $this->input->post('dia_chi_cu_the');
				if($dia_chi_cu_the !== ''){
					$chi_tiet_nha_dat['dia_chi_cu_the'] = $dia_chi_cu_the;
					$key_search		   .= ' '.$dia_chi_cu_the;
				}

				$gia_thue_1 			= $this->input->post('gia_thue_1');
				if($gia_thue_1){
					$chi_tiet_nha_dat['gia_thue_1'] = $gia_thue_1;
				}

				$gia_thue_2 			= $this->input->post('gia_thue_2');
				if($gia_thue_2){
					$chi_tiet_nha_dat['gia_thue_2'] = $gia_thue_2;
				}

				$trang_thai_bds 			= $this->input->post('trang_thai_bds');
				if($trang_thai_bds){
					$chi_tiet_nha_dat['trang_thai_bds'] = $trang_thai_bds;
					$key_search		   .= ' '.$trang_thai_bds;
				}

				$so_block 			= $this->input->post('so_block');
				if($so_block){
					$chi_tiet_nha_dat['so_block'] = $so_block;
				}

				$so_can_ho 			= $this->input->post('so_can_ho');
				if($so_can_ho){
					$chi_tiet_nha_dat['so_can_ho'] = $so_can_ho;
				}

				$so_tang 			= $this->input->post('so_tang');
				if($so_tang){
					$chi_tiet_nha_dat['so_tang'] = $so_tang;
				}

				$mat_do_xay_dung 			= $this->input->post('mat_do_xay_dung');
				if($mat_do_xay_dung){
					$chi_tiet_nha_dat['mat_do_xay_dung'] = $mat_do_xay_dung;
					$key_search		   .= ' Mật Độ Xây Dựng '.$mat_do_xay_dung;
				}

				$tong_dien_tich_du_an 			= $this->input->post('tong_dien_tich_du_an');
				if($tong_dien_tich_du_an){
					$chi_tiet_nha_dat['tong_dien_tich_du_an'] = $tong_dien_tich_du_an;
				}

				$chu_dau_tu 			= $this->input->post('chu_dau_tu');
				$chu_dau_tu_id			= '0';
				if($chu_dau_tu){
					$data_chu_dau_tu 	= explode('||||',$chu_dau_tu);
					$chu_dau_tu_id		= $data_chu_dau_tu['0'];
					$chu_dau_tu_name	= $data_chu_dau_tu['1'];
					$chi_tiet_nha_dat['chu_dau_tu_id'] 		= $chu_dau_tu_id;
					$chi_tiet_nha_dat['chu_dau_tu_name'] 	= $chu_dau_tu_name;

					$key_search			.= ' Chủ Đầu Tư '.$chu_dau_tu_name;
				}

				$so_nen_dat 			= $this->input->post('so_nen_dat');
				if($so_nen_dat){
					$chi_tiet_nha_dat['so_nen_dat'] = $so_nen_dat;
				}

				$nam_xay_dung 			= $this->input->post('nam_xay_dung');
				if($nam_xay_dung){
					$chi_tiet_nha_dat['nam_xay_dung'] = $nam_xay_dung;
					$key_search			.= ' Xây Dựng Năm '.$nam_xay_dung;
				}

				$nam_ban_giao 			= $this->input->post('nam_ban_giao');
				if($nam_ban_giao){
					$chi_tiet_nha_dat['nam_ban_giao'] = $nam_ban_giao;
					$key_search			.= ' Bàn Giao Năm '.$nam_ban_giao;
				}

				//Gộp biến để tìm kiếm theo loại hình bds, vị trí bds và location 
				$key_search	.= $loai_hinh_2.' '.$city_name;
				$key_search	.= $loai_hinh_2.' '.$districts_name;
				$key_search	.= $loai_hinh_2.' '.$wards_name;
				$key_search	.= $loai_hinh_2.' '.$districts_name.' '.$city_name;
				$key_search	.= $loai_hinh_2.' '.$wards_name.' '.$city_name;
				$key_search	.= $loai_hinh_2.' '.$wards_name.' '.$districts_name;
				$key_search	.= $loai_hinh_2.' '.$wards_name.' '.$districts_name.' '.$city_name;
				if($vi_tri_mat_tien == '1'){
					$key_search	.= $loai_hinh_2.' '.'mặt tiền';
					$key_search	.= $loai_hinh_2.' '.'mặt tiền'.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt tiền'.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt tiền'.$wards_name;
					$key_search	.= $loai_hinh_2.' '.'mặt tiền'.$districts_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt tiền'.$wards_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt tiền'.$wards_name.' '.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt tiền'.$wards_name.' '.$districts_name.' '.$city_name;

					$key_search	.= $loai_hinh_2.' '.'mặt đường';
					$key_search	.= $loai_hinh_2.' '.'mặt đường'.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt đường'.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt đường'.$wards_name;
					$key_search	.= $loai_hinh_2.' '.'mặt đường'.$districts_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt đường'.$wards_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt đường'.$wards_name.' '.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt đường'.$wards_name.' '.$districts_name.' '.$city_name;
				}

				if($vi_tri_mat_hem == '1'){
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm';
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm'.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm'.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm'.$wards_name;
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm'.$districts_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm'.$wards_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm'.$wards_name.' '.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm'.$wards_name.' '.$districts_name.' '.$city_name;

					$key_search	.= $loai_hinh_2.' '.'mặt ngõ';
					$key_search	.= $loai_hinh_2.' '.'mặt ngõ'.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngõ'.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngõ'.$wards_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngõ'.$districts_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngõ'.$wards_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngõ'.$wards_name.' '.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngõ'.$wards_name.' '.$districts_name.' '.$city_name;

					$key_search	.= $loai_hinh_2.' '.'mặt ngách';
					$key_search	.= $loai_hinh_2.' '.'mặt ngách'.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngách'.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngách'.$wards_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngách'.$districts_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngách'.$wards_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngách'.$wards_name.' '.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngách'.$wards_name.' '.$districts_name.' '.$city_name;
				}


				$loai_hinh_bds_phu 			= $this->input->post('loai_hinh_bds_phu');
				if($loai_hinh_bds_phu){
					$chi_tiet_nha_dat['loai_hinh_bds_phu'] = $loai_hinh_bds_phu;
					foreach($loai_hinh_bds_phu as $row){
						$key_search			.= ' '.$row;
						$key_search			.= $row.' '.$city_name;
						$key_search			.= $row.' '.$districts_name;
						$key_search			.= $row.' '.$wards_name;
						$key_search			.= $row.' '.$districts_name.' '.$city_name;
						$key_search			.= $row.' '.$wards_name.' '.$city_name;
						$key_search			.= $row.' '.$wards_name.' '.$districts_name;
						$key_search			.= $row.' '.$wards_name.' '.$districts_name.' '.$city_name;

						if($vi_tri_mat_tien == '1'){
							$key_search	.= $row.' '.'mặt tiền';
							$key_search	.= $row.' '.'mặt tiền'.$city_name;
							$key_search	.= $row.' '.'mặt tiền'.$districts_name;
							$key_search	.= $row.' '.'mặt tiền'.$wards_name;
							$key_search	.= $row.' '.'mặt tiền'.$districts_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt tiền'.$wards_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt tiền'.$wards_name.' '.$districts_name;
							$key_search	.= $row.' '.'mặt tiền'.$wards_name.' '.$districts_name.' '.$city_name;
		
							$key_search	.= $row.' '.'mặt đường';
							$key_search	.= $row.' '.'mặt đường'.$city_name;
							$key_search	.= $row.' '.'mặt đường'.$districts_name;
							$key_search	.= $row.' '.'mặt đường'.$wards_name;
							$key_search	.= $row.' '.'mặt đường'.$districts_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt đường'.$wards_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt đường'.$wards_name.' '.$districts_name;
							$key_search	.= $row.' '.'mặt đường'.$wards_name.' '.$districts_name.' '.$city_name;
						}

						if($vi_tri_mat_hem == '1'){
							$key_search	.= $row.' '.'mặt hẻm';
							$key_search	.= $row.' '.'mặt hẻm'.$city_name;
							$key_search	.= $row.' '.'mặt hẻm'.$districts_name;
							$key_search	.= $row.' '.'mặt hẻm'.$wards_name;
							$key_search	.= $row.' '.'mặt hẻm'.$districts_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt hẻm'.$wards_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt hẻm'.$wards_name.' '.$districts_name;
							$key_search	.= $row.' '.'mặt hẻm'.$wards_name.' '.$districts_name.' '.$city_name;
		
							$key_search	.= $row.' '.'mặt ngõ';
							$key_search	.= $row.' '.'mặt ngõ'.$city_name;
							$key_search	.= $row.' '.'mặt ngõ'.$districts_name;
							$key_search	.= $row.' '.'mặt ngõ'.$wards_name;
							$key_search	.= $row.' '.'mặt ngõ'.$districts_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt ngõ'.$wards_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt ngõ'.$wards_name.' '.$districts_name;
							$key_search	.= $row.' '.'mặt ngõ'.$wards_name.' '.$districts_name.' '.$city_name;
		
							$key_search	.= $row.' '.'mặt ngách';
							$key_search	.= $row.' '.'mặt ngách'.$city_name;
							$key_search	.= $row.' '.'mặt ngách'.$districts_name;
							$key_search	.= $row.' '.'mặt ngách'.$wards_name;
							$key_search	.= $row.' '.'mặt ngách'.$districts_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt ngách'.$wards_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt ngách'.$wards_name.' '.$districts_name;
							$key_search	.= $row.' '.'mặt ngách'.$wards_name.' '.$districts_name.' '.$city_name;
						}
					}
				}

				$nguoi_lien_he 			= $this->input->post('nguoi_lien_he');
				if($nguoi_lien_he){
					$chi_tiet_nha_dat['nguoi_lien_he'] = $nguoi_lien_he;
				}
				
				$sdt_lien_he 			= $this->input->post('sdt_lien_he');
				if($sdt_lien_he){
					$chi_tiet_nha_dat['sdt_lien_he'] = $sdt_lien_he;
				}

				$du_an_status 			= $this->input->post('du_an_status');
				if($du_an_status){
					$chi_tiet_nha_dat['du_an_status'] = $du_an_status;
					if($du_an_status == '1'){
						$key_search			.= ' Là Dự Án';
					}
				}

				//Lấy tên file ảnh minh họa được upload lên
				$this->load->library('upload_library');
				$upload_path = './upload/project';

				$upload_data_image = $this->upload_library->upload($upload_path, 'image_link');

				$image_link ='';
				if(isset($upload_data_image['file_name']))
				{
					$image_link = $upload_data_image['file_name'];
				}

				//Upload các ảnh kèm theo
				$image_list = array();
				$image_list = $this->upload_library->upload_file($upload_path, 'image_list');
				$image_list = json_encode($image_list);
				

				$data = array(
					'author_id'			=> $author_id,
                    'name'      		=> json_encode($name),
					'alias'  			=> $alias,
					'status'  			=> $status,

					'google_map'		=> $google_map,

					'meta_key'			=> json_encode($meta_key),
					'meta_desc'			=> json_encode($meta_desc),
					'content'    		=> json_encode($content),

					'dien_tich'    		=> $dien_tich,
					'chieu_dai'			=> $chieu_dai,
					'chieu_rong'		=> $chieu_rong,

					'gia_tien'    		=> $gia_tien,
					'gia_tien_option'   => $gia_tien_option,

					'gia_tien_thue'			=> $gia_thue_1,
					'gia_tien_thue_option'	=> $gia_thue_2,

					'loai_hinh_1'    	=> json_encode($loai_hinh_1),
					'loai_hinh_2'    	=> json_encode($loai_hinh_2),
					'loai_hinh_3'    	=> json_encode($loai_hinh_3),
					'du_an_status'		=> $du_an_status,
					'chu_dau_tu_id'		=> $chu_dau_tu_id,

					'phong_ngu'			=> $phong_ngu,
					'phong_tam'			=> $phong_tam,

					'chi_tiet_nha_dat'	=> json_encode($chi_tiet_nha_dat),
					'trang_thai_bds'	=> json_encode($trang_thai_bds),
					'city_id'			=> $city_id,
					'districts_id'		=> $districts_id,
					'wards_id'			=> $wards_id,
					'location'			=> json_encode($location),

					'image_link'		=> $image_link,
					'image_list'		=> $image_list,

					'key_search'		=> loai_bo_dau_admin(strtolower($key_search)),
					'update_time'		=> now(),
				);

				//print_r($data);

				if($this->project_model->create($data)){
					//Update lại số lượng dự án cho chủ đầu tư mới
					if(isset($chu_dau_tu_id) && ($chu_dau_tu_id !== '0')){
						$input = array();
						$input['where'] = array('status' => '0','chu_dau_tu_id' => $chu_dau_tu_id);
						$total_project  = $this->project_model->get_total($input);
						$data_import	= array(
							'total_project' => $total_project,
						);
						$this->chu_dau_tu_model->update($chu_dau_tu_id,$data_import);
					}
                    
					$CI =& get_instance();
					$path = $CI->config->item('cache_path');
					//path of cache directory
					$cache_path = ($path == '') ? APPPATH.'cache/' : $path;

					//xóa cache trang chủ
					$url = base_url(''); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
					$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
					$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
					unlink ($cache_path.md5($path_delete));

					redirect('admin/project');
				}else{
					echo 'Không Tạo Thành Công';
				}
				
			}
		}

		$this->load->view('admin/project/add', $this->data);
	}

	function edit(){
		//Lấy ID của dự án cần chỉnh sửa
		$id   = $this->uri->rsegment('3');
		$id   = intval($id);
		$info = $this->project_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message','Không tồn tại nội dung này');
			redirect(admin_url('project'));
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
				// Thêm vào cơ sở dữ liệu
				$author_id				= $this->input->post('author_id');
                $name       			= $this->input->post('name');
				$alias   				= $this->input->post('alias');
				$status   				= $this->input->post('status');

				$google_map				= $this->input->post('google_map');
				$google_map				= str_replace(array('<iframe src="','" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>'),'',$google_map);

				$meta_key   			= $this->input->post('meta_key');
				$meta_desc   			= $this->input->post('meta_desc');
				$content   				= $this->input->post('content');

				$dien_tich   			= $this->input->post('dien_tich');
				$chieu_dai				= $this->input->post('chieu_dai');
				$chieu_rong				= $this->input->post('chieu_rong');
				$gia_tien   			= $this->input->post('gia_tien');
				$gia_tien_option   		= $this->input->post('gia_tien_option');
				$loai_hinh_1   			= $this->input->post('loai_hinh_1');
				$loai_hinh_2   			= $this->input->post('loai_hinh_2');
				$loai_hinh_3   			= $this->input->post('loai_hinh_3');

				$phong_ngu				= $this->input->post('phong_ngu');
				$phong_tam				= $this->input->post('phong_tam');

				$location = '';
				$wards_id				= $this->input->post('wards_id');
				$wards_name				= '';
				if(isset($wards_id)){
					$wards_name			= json_decode($this->wards_model->get_info($wards_id)->name);
					$location			.= ' '.json_decode($this->wards_model->get_info($wards_id)->prefix).' '.json_decode($this->wards_model->get_info($wards_id)->name).', ';
				}
				$districts_id			= $this->input->post('districts_id');
				$districts_name			= '';
				if(isset($districts_id)){
					$districts_name		= json_decode($this->districts_model->get_info($districts_id)->name);
					$location			.= 'Quận / Huyện '.json_decode($this->districts_model->get_info($districts_id)->name).', ';
				}
				$city_id				= $this->input->post('city_id');
				$city_name				= '';
				if(isset($city_id )){
					$city_name			= json_decode($this->city_model->get_info($city_id)->name);
				}
				$location				.= 'Thành Phố '.json_decode($this->city_model->get_info($city_id)->name);
				$key_search				= '';
				$key_search 			.= $name.' '.$alias.' '.$loai_hinh_1.' '.$loai_hinh_2.' hướng '.$loai_hinh_3.' diện tích '.$dien_tich.' chiều dài '.$chieu_dai.' chiều rộng '.$chieu_rong.' '.$phong_ngu.' phòng ngủ '.$phong_tam.' phòng tắm '.$location;

				$chi_tiet_nha_dat		= array();
				//gộp các check box vào $chi_tiet_nha_dat 
				
				$so_tang 				= $this->input->post('so_tang');
				$chi_tiet_nha_dat['so_tang'] = $so_tang;
				if($so_tang > '0'){
					$key_search		   .= ' '.$so_tang.' Tầng';
				}

				$giay_to_phap_ly 		= $this->input->post('giay_to_phap_ly');
				if($giay_to_phap_ly == '1'){
					$chi_tiet_nha_dat['giay_to_phap_ly'] = 'Giấy Tờ Pháp Lý: Sổ Hồng';
					$key_search		   .= ' Sổ Hồng, Sổ Đỏ';
				}

				$vi_tri_mat_tien 		= $this->input->post('vi_tri_mat_tien');
				if($vi_tri_mat_tien == '1'){
					$chi_tiet_nha_dat['vi_tri_mat_tien'] = 'Vị Trí: Mặt Tiền';
					$key_search		   .= ' Mặt Tiền';
				}

				$vi_tri_mat_hem 		= $this->input->post('vi_tri_mat_hem');
				if($vi_tri_mat_hem == '1'){
					$chi_tiet_nha_dat['vi_tri_mat_hem'] = 'Vị Trí: Mặt Hẻm';
					$key_search		   .= ' Mặt Hẻm';
				}

				$gan_cho 				= $this->input->post('gan_cho');
				if($gan_cho == '1'){
					$chi_tiet_nha_dat['gan_cho'] = 'Gần Chợ';
					$key_search		   .= ' Gần Chợ';
				}

				$nha_tre 				= $this->input->post('nha_tre');
				if($nha_tre == '1'){
					$chi_tiet_nha_dat['nha_tre'] = 'Gần Nhà Trẻ';
					$key_search		   .= ' Gần Nhà Trẻ';
				}

				$truong_cap_2 			= $this->input->post('truong_cap_2');
				if($truong_cap_2 == '1'){
					$chi_tiet_nha_dat['truong_cap_2'] = 'Gần Trường Cấp 2';
					$key_search		   .= ' Gần Trường Cấp 2';
				}

				$truong_cap_3 			= $this->input->post('truong_cap_3');
				if($truong_cap_3 == '1'){
					$chi_tiet_nha_dat['truong_cap_3'] = 'Gần Trường Cấp 3';
					$key_search		   .= ' Gần Trường Cấp 3';
				}

				$dai_hoc 			= $this->input->post('dai_hoc');
				if($dai_hoc == '1'){
					$chi_tiet_nha_dat['dai_hoc'] = 'Gần Trường Đại Học';
					$key_search		   .= ' Gần Trường Đại Học';
				}

				$ho_boi 				= $this->input->post('ho_boi');
				if($ho_boi == '1'){
					$chi_tiet_nha_dat['ho_boi'] = 'Gần Hồ Bơi';
					$key_search		   .= ' Gần Hồ Bơi';
				}

				$khu_dan_cu 				= $this->input->post('khu_dan_cu');
				if($khu_dan_cu == '1'){
					$chi_tiet_nha_dat['khu_dan_cu'] = 'Gần Khu Dân Cư';
					$key_search		   .= ' Gần Khu Dân Cư';
				}

				$sieu_thi 				= $this->input->post('sieu_thi');
				if($sieu_thi == '1'){
					$chi_tiet_nha_dat['sieu_thi'] = 'Gần Siêu Thị';
					$key_search		   .= ' Gần Siêu Thị';
				}

				$benh_vien 				= $this->input->post('benh_vien');
				if($benh_vien == '1'){
					$chi_tiet_nha_dat['benh_vien'] = 'Gần Bệnh Viện';
					$key_search		   .= ' Gần Bệnh Viện';
				}

				$cho_dau_oto 				= $this->input->post('cho_dau_oto');
				if($sieu_thi == '1'){
					$chi_tiet_nha_dat['cho_dau_oto'] = 'Có Chỗ Đậu Ô Tô';
					$key_search		   .= ' Có Chỗ Đậu Ô Tô';
				}

				$duong_nhua 			= $this->input->post('duong_nhua');
				if($duong_nhua == '1'){
					$chi_tiet_nha_dat['duong_nhua'] = 'Đường Trải Nhựa';
					$key_search		   .= ' Đường Trải Nhựa';
				}

				$camera_an_ninh 			= $this->input->post('camera_an_ninh');
				if($camera_an_ninh == '1'){
					$chi_tiet_nha_dat['camera_an_ninh'] = 'Camera An Ninh';
					$key_search		   .= ' Camera An Ninh';
				}

				$view_bien 			= $this->input->post('view_bien');
				if($view_bien == '1'){
					$chi_tiet_nha_dat['view_bien'] = 'View Biển';
					$key_search		   .= ' View Biển';
				}

				$trung_tam_hanh_chinh 			= $this->input->post('trung_tam_hanh_chinh');
				if($trung_tam_hanh_chinh == '1'){
					$chi_tiet_nha_dat['trung_tam_hanh_chinh'] = 'Gần Trung Tâm Hành Chính';
					$key_search		   .= ' Gần Trung Tâm Hành Chính';
				}

				$san_bay 			= $this->input->post('san_bay');
				if($san_bay == '1'){
					$chi_tiet_nha_dat['san_bay'] = 'Gần Sân Bay';
					$key_search		   .= ' Gần Sân Bay';
				}

				$san_golf 			= $this->input->post('san_golf');
				if($san_golf == '1'){
					$chi_tiet_nha_dat['san_golf'] = 'Gần Sân Golf';
					$key_search		   .= ' Gần Sân Golf';
				}

				$cong_vien 			= $this->input->post('cong_vien');
				if($cong_vien == '1'){
					$chi_tiet_nha_dat['cong_vien'] = 'Gần Công Viên';
					$key_search		   .= ' Gần Công Viên';
				}

				$trung_tam_mua_sam 			= $this->input->post('trung_tam_mua_sam');
				if($trung_tam_mua_sam == '1'){
					$chi_tiet_nha_dat['trung_tam_mua_sam'] = 'Gần Trung Tâm Mua Sắm';
					$key_search		   .= ' Gần Trung Tâm Mua Sắm';
				}

				$dia_chi_cu_the 			= $this->input->post('dia_chi_cu_the');
				if($dia_chi_cu_the !== ''){
					$chi_tiet_nha_dat['dia_chi_cu_the'] = $dia_chi_cu_the;
					$key_search		   .= ' '.$dia_chi_cu_the;
				}

				$gia_thue_1 			= $this->input->post('gia_thue_1');
				if($gia_thue_1){
					$chi_tiet_nha_dat['gia_thue_1'] = $gia_thue_1;
				}

				$gia_thue_2 			= $this->input->post('gia_thue_2');
				if($gia_thue_2){
					$chi_tiet_nha_dat['gia_thue_2'] = $gia_thue_2;
				}

				$trang_thai_bds 			= $this->input->post('trang_thai_bds');
				if($trang_thai_bds){
					$chi_tiet_nha_dat['trang_thai_bds'] = $trang_thai_bds;
					$key_search		   .= ' '.$trang_thai_bds;
				}

				$so_block 			= $this->input->post('so_block');
				if($so_block){
					$chi_tiet_nha_dat['so_block'] = $so_block;
				}

				$so_can_ho 			= $this->input->post('so_can_ho');
				if($so_can_ho){
					$chi_tiet_nha_dat['so_can_ho'] = $so_can_ho;
				}

				$so_tang 			= $this->input->post('so_tang');
				if($so_tang){
					$chi_tiet_nha_dat['so_tang'] = $so_tang;
				}

				$mat_do_xay_dung 			= $this->input->post('mat_do_xay_dung');
				if($mat_do_xay_dung){
					$chi_tiet_nha_dat['mat_do_xay_dung'] = $mat_do_xay_dung;
					$key_search		   .= ' Mật Độ Xây Dựng '.$mat_do_xay_dung;
				}

				$tong_dien_tich_du_an 			= $this->input->post('tong_dien_tich_du_an');
				if($tong_dien_tich_du_an){
					$chi_tiet_nha_dat['tong_dien_tich_du_an'] = $tong_dien_tich_du_an;
				}

				$chu_dau_tu 			= $this->input->post('chu_dau_tu');
				$chu_dau_tu_id			= '0';
				if($chu_dau_tu){
					$data_chu_dau_tu 	= explode('||||',$chu_dau_tu);
					$chu_dau_tu_id		= $data_chu_dau_tu['0'];
					$chu_dau_tu_name	= $data_chu_dau_tu['1'];
					$chi_tiet_nha_dat['chu_dau_tu_id'] 		= $chu_dau_tu_id;
					$chi_tiet_nha_dat['chu_dau_tu_name'] 	= $chu_dau_tu_name;

					$key_search			.= ' Chủ Đầu Tư '.$chu_dau_tu_name;
				}

				$so_nen_dat 			= $this->input->post('so_nen_dat');
				if($so_nen_dat){
					$chi_tiet_nha_dat['so_nen_dat'] = $so_nen_dat;
				}

				$nam_xay_dung 			= $this->input->post('nam_xay_dung');
				if($nam_xay_dung){
					$chi_tiet_nha_dat['nam_xay_dung'] = $nam_xay_dung;
					$key_search			.= ' Xây Dựng Năm '.$nam_xay_dung;
				}

				$nam_ban_giao 			= $this->input->post('nam_ban_giao');
				if($nam_ban_giao){
					$chi_tiet_nha_dat['nam_ban_giao'] = $nam_ban_giao;
					$key_search			.= ' Bàn Giao Năm '.$nam_ban_giao;
				}

				//Gộp biến để tìm kiếm theo loại hình bds, vị trí bds và location 
				$key_search	.= $loai_hinh_2.' '.$city_name;
				$key_search	.= $loai_hinh_2.' '.$districts_name;
				$key_search	.= $loai_hinh_2.' '.$wards_name;
				$key_search	.= $loai_hinh_2.' '.$districts_name.' '.$city_name;
				$key_search	.= $loai_hinh_2.' '.$wards_name.' '.$city_name;
				$key_search	.= $loai_hinh_2.' '.$wards_name.' '.$districts_name;
				$key_search	.= $loai_hinh_2.' '.$wards_name.' '.$districts_name.' '.$city_name;
				if($vi_tri_mat_tien == '1'){
					$key_search	.= $loai_hinh_2.' '.'mặt tiền';
					$key_search	.= $loai_hinh_2.' '.'mặt tiền'.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt tiền'.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt tiền'.$wards_name;
					$key_search	.= $loai_hinh_2.' '.'mặt tiền'.$districts_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt tiền'.$wards_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt tiền'.$wards_name.' '.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt tiền'.$wards_name.' '.$districts_name.' '.$city_name;

					$key_search	.= $loai_hinh_2.' '.'mặt đường';
					$key_search	.= $loai_hinh_2.' '.'mặt đường'.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt đường'.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt đường'.$wards_name;
					$key_search	.= $loai_hinh_2.' '.'mặt đường'.$districts_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt đường'.$wards_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt đường'.$wards_name.' '.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt đường'.$wards_name.' '.$districts_name.' '.$city_name;
				}

				if($vi_tri_mat_hem == '1'){
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm';
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm'.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm'.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm'.$wards_name;
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm'.$districts_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm'.$wards_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm'.$wards_name.' '.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt hẻm'.$wards_name.' '.$districts_name.' '.$city_name;

					$key_search	.= $loai_hinh_2.' '.'mặt ngõ';
					$key_search	.= $loai_hinh_2.' '.'mặt ngõ'.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngõ'.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngõ'.$wards_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngõ'.$districts_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngõ'.$wards_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngõ'.$wards_name.' '.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngõ'.$wards_name.' '.$districts_name.' '.$city_name;

					$key_search	.= $loai_hinh_2.' '.'mặt ngách';
					$key_search	.= $loai_hinh_2.' '.'mặt ngách'.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngách'.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngách'.$wards_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngách'.$districts_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngách'.$wards_name.' '.$city_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngách'.$wards_name.' '.$districts_name;
					$key_search	.= $loai_hinh_2.' '.'mặt ngách'.$wards_name.' '.$districts_name.' '.$city_name;
				}


				$loai_hinh_bds_phu 			= $this->input->post('loai_hinh_bds_phu');
				if($loai_hinh_bds_phu){
					$chi_tiet_nha_dat['loai_hinh_bds_phu'] = $loai_hinh_bds_phu;
					foreach($loai_hinh_bds_phu as $row){
						$key_search			.= ' '.$row;
						$key_search			.= $row.' '.$city_name;
						$key_search			.= $row.' '.$districts_name;
						$key_search			.= $row.' '.$wards_name;
						$key_search			.= $row.' '.$districts_name.' '.$city_name;
						$key_search			.= $row.' '.$wards_name.' '.$city_name;
						$key_search			.= $row.' '.$wards_name.' '.$districts_name;
						$key_search			.= $row.' '.$wards_name.' '.$districts_name.' '.$city_name;

						if($vi_tri_mat_tien == '1'){
							$key_search	.= $row.' '.'mặt tiền';
							$key_search	.= $row.' '.'mặt tiền'.$city_name;
							$key_search	.= $row.' '.'mặt tiền'.$districts_name;
							$key_search	.= $row.' '.'mặt tiền'.$wards_name;
							$key_search	.= $row.' '.'mặt tiền'.$districts_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt tiền'.$wards_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt tiền'.$wards_name.' '.$districts_name;
							$key_search	.= $row.' '.'mặt tiền'.$wards_name.' '.$districts_name.' '.$city_name;
		
							$key_search	.= $row.' '.'mặt đường';
							$key_search	.= $row.' '.'mặt đường'.$city_name;
							$key_search	.= $row.' '.'mặt đường'.$districts_name;
							$key_search	.= $row.' '.'mặt đường'.$wards_name;
							$key_search	.= $row.' '.'mặt đường'.$districts_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt đường'.$wards_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt đường'.$wards_name.' '.$districts_name;
							$key_search	.= $row.' '.'mặt đường'.$wards_name.' '.$districts_name.' '.$city_name;
						}

						if($vi_tri_mat_hem == '1'){
							$key_search	.= $row.' '.'mặt hẻm';
							$key_search	.= $row.' '.'mặt hẻm'.$city_name;
							$key_search	.= $row.' '.'mặt hẻm'.$districts_name;
							$key_search	.= $row.' '.'mặt hẻm'.$wards_name;
							$key_search	.= $row.' '.'mặt hẻm'.$districts_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt hẻm'.$wards_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt hẻm'.$wards_name.' '.$districts_name;
							$key_search	.= $row.' '.'mặt hẻm'.$wards_name.' '.$districts_name.' '.$city_name;
		
							$key_search	.= $row.' '.'mặt ngõ';
							$key_search	.= $row.' '.'mặt ngõ'.$city_name;
							$key_search	.= $row.' '.'mặt ngõ'.$districts_name;
							$key_search	.= $row.' '.'mặt ngõ'.$wards_name;
							$key_search	.= $row.' '.'mặt ngõ'.$districts_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt ngõ'.$wards_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt ngõ'.$wards_name.' '.$districts_name;
							$key_search	.= $row.' '.'mặt ngõ'.$wards_name.' '.$districts_name.' '.$city_name;
		
							$key_search	.= $row.' '.'mặt ngách';
							$key_search	.= $row.' '.'mặt ngách'.$city_name;
							$key_search	.= $row.' '.'mặt ngách'.$districts_name;
							$key_search	.= $row.' '.'mặt ngách'.$wards_name;
							$key_search	.= $row.' '.'mặt ngách'.$districts_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt ngách'.$wards_name.' '.$city_name;
							$key_search	.= $row.' '.'mặt ngách'.$wards_name.' '.$districts_name;
							$key_search	.= $row.' '.'mặt ngách'.$wards_name.' '.$districts_name.' '.$city_name;
						}
					}
				}

				$nguoi_lien_he 			= $this->input->post('nguoi_lien_he');
				if($nguoi_lien_he){
					$chi_tiet_nha_dat['nguoi_lien_he'] = $nguoi_lien_he;
				}
				
				$sdt_lien_he 			= $this->input->post('sdt_lien_he');
				if($sdt_lien_he){
					$chi_tiet_nha_dat['sdt_lien_he'] = $sdt_lien_he;
				}

				$du_an_status 			= $this->input->post('du_an_status');
				if($du_an_status){
					$chi_tiet_nha_dat['du_an_status'] = $du_an_status;
					if($du_an_status == '1'){
						$key_search			.= ' Là Dự Án';
					}
				}


				//Lấy tên file ảnh minh họa được upload lên
				$this->load->library('upload_library');
				$upload_path = './upload/project';

				$upload_data_image = $this->upload_library->upload($upload_path, 'image_link');

				$image_link ='';
				if(isset($upload_data_image['file_name']))
				{
					$image_link = $upload_data_image['file_name'];
				}

				//Upload các ảnh kèm theo
				$image_list = array();
				$image_list = $this->upload_library->upload_file($upload_path, 'image_list');
				$image_list = json_encode($image_list);
				

				$data = array(
					'author_id'			=> $author_id,
                    'name'      		=> json_encode($name),
					'alias'  			=> $alias,
					'status'  			=> $status,

					'google_map'		=> $google_map,

					'meta_key'			=> json_encode($meta_key),
					'meta_desc'			=> json_encode($meta_desc),
					'content'    		=> json_encode($content),

					'dien_tich'    		=> $dien_tich,
					'chieu_dai'			=> $chieu_dai,
					'chieu_rong'		=> $chieu_rong,

					'gia_tien'    		=> $gia_tien,
					'gia_tien_option'   => $gia_tien_option,

					'gia_tien_thue'			=> $gia_thue_1,
					'gia_tien_thue_option'	=> $gia_thue_2,

					'loai_hinh_1'    	=> json_encode($loai_hinh_1),
					'loai_hinh_2'    	=> json_encode($loai_hinh_2),
					'loai_hinh_3'    	=> json_encode($loai_hinh_3),

					'du_an_status'		=> $du_an_status,
					'chu_dau_tu_id'		=> $chu_dau_tu_id,

					'phong_ngu'			=> $phong_ngu,
					'phong_tam'			=> $phong_tam,

					'chi_tiet_nha_dat'	=> json_encode($chi_tiet_nha_dat),
					'trang_thai_bds'	=> json_encode($trang_thai_bds),
					'city_id'			=> $city_id,
					'districts_id'		=> $districts_id,
					'wards_id'			=> $wards_id,
					'location'			=> json_encode($location),

					'key_search'		=> loai_bo_dau_admin(strtolower($key_search)),
					'update_time'		=> now(),
				);

				if($image_link != '')
				{
					$info_image_link 	= './upload/project/'.$info->image_link;
					if(file_exists($info_image_link) && ($info_image_link !== './upload/project/')){
						unlink($info_image_link);
					}
					$data['image_link'] = $image_link;
				}

				if($image_list != '[]')
				{
					$image_list_of_this_info = json_decode($info->image_list);
					if(is_array($image_list_of_this_info)){
						foreach($image_list_of_this_info as $img){
							$image_to_unlink = './upload/project/'.$img;
							if(file_exists($image_to_unlink) && ($image_to_unlink !== './upload/project/')){
								unlink($image_to_unlink);
							}
						}
					}
					$data['image_list'] = $image_list;
				}

				//print_r($data);

				if($this->project_model->update($info->id,$data)){
					if($chu_dau_tu_id !== $info->chu_dau_tu_id){
						//Update lại số lượng dự án cho chủ đầu tư cũ
						if(isset($info->chu_dau_tu_id) && ($info->chu_dau_tu_id !== '0')){
							$input = array();
							$input['where'] = array('status' => '0','chu_dau_tu_id' => $info->chu_dau_tu_id);
							$total_project  = $this->project_model->get_total($input);
							$data_import	= array(
								'total_project' => $total_project,
							);
							$this->chu_dau_tu_model->update($info->chu_dau_tu_id,$data_import);
						}
						
						//Update lại số lượng dự án cho chủ đầu tư mới
						if(isset($chu_dau_tu_id) && ($chu_dau_tu_id !== '0')){
							$input = array();
							$input['where'] = array('status' => '0','chu_dau_tu_id' => $chu_dau_tu_id);
							$total_project  = $this->project_model->get_total($input);
							$data_import	= array(
								'total_project' => $total_project,
							);
							$this->chu_dau_tu_model->update($chu_dau_tu_id,$data_import);
						}
					}

					$CI =& get_instance();
					$path = $CI->config->item('cache_path');
					//path of cache directory
					$cache_path = ($path == '') ? APPPATH.'cache/' : $path;

					//xóa cache trang chủ
					$url = base_url(''); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
					$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
					$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
					unlink ($cache_path.md5($path_delete));

					//xóa cache trang nội dung dự án
					$url = base_url($info->alias.'-pr'.$info->id); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
					$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
					$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
					unlink ($cache_path.md5($path_delete));
                    

					redirect('admin/project');
				}else{
					echo 'Không cập nhật Thành Công';
				}
				
			}
		}

		$this->load->view('admin/project/edit', $this->data);

	}

	function delete()
	{
		//Lấy ID của quản trị viên cần xóa
		$id   = $this->uri->rsegment('3');
		$id   = intval($id);

		//Lấy thông tin của quản trị viên cần xóa
		$info = $this->project_model->get_info($id);
		if(!$info)
		{
			$this->session->set_flashdata('message','Không tồn tại quản trị viên này');
			redirect(admin_url('project'));
		}

        $info_image_link 	= './upload/project/'.$info->image_link;
		if(file_exists($info_image_link) && ($info_image_link !== './upload/project/')){
			unlink($info_image_link);
		}

		$image_list_of_this_info = json_decode($info->image_list);
		if(is_array($image_list_of_this_info)){
			foreach($image_list_of_this_info as $img){
				$image_to_unlink = './upload/project/'.$img;
				if(file_exists($image_to_unlink) && ($image_to_unlink !== './upload/project/')){
					unlink($image_to_unlink);
				}
			}
		}
        
		//Thực hiện xóa
		if($this->project_model->delete($id)){
            //Update lại số lượng dự án cho chủ đầu tư cũ
			if(isset($info->chu_dau_tu_id) && ($info->chu_dau_tu_id !== '0')){
				$input = array();
				$input['where'] = array('status' => '0','chu_dau_tu_id' => $info->chu_dau_tu_id);
				$total_project  = $this->project_model->get_total($input);
				$data_import	= array(
					'total_project' => $total_project,
				);
				$this->chu_dau_tu_model->update($info->chu_dau_tu_id,$data_import);
			}
            
			$CI =& get_instance();
			$path = $CI->config->item('cache_path');
			//path of cache directory
			$cache_path = ($path == '') ? APPPATH.'cache/' : $path;

			//xóa cache trang chủ
			$url = base_url(''); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
			$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
			$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
			unlink ($cache_path.md5($path_delete));

			//xóa cache trang nội dung dự án
			$url = base_url($info->alias.'-pr'.$info->id); //url chuẩn của view theo routes - thay đổi cụ thể ở đây
			$uri = str_replace(base_url(),'',$url); //url chuẩn theo route (loại trừ base_url)
			$path_delete =  $CI->config->item('base_url').$CI->config->item('index_page').$uri;
			unlink ($cache_path.md5($path_delete));
        }
		$this->session->set_flashdata('message','Xóa dữ liệu thành công');
        
		redirect(admin_url('project'));
	}

	
}