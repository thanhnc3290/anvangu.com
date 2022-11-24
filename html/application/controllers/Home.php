<?php  
Class Home extends MY_Controller
{
	//private $perPage = 16; // mỗi trang loadmore thì thêm 10 kết quả

	/*
	* Hàm khởi tạo
	*/
	function __construct()
	{
		parent::__construct();
		$this->load->model('project_model');
		$this->load->model('news_model');
		$this->load->model('chu_dau_tu_model');
	}
	
	function index()
	{	
		//Lấy danh sách slider
		$data_banner = $this->db->query('
            SELECT 	id, name, status, sort_order, link, image_link
            From slider
            ORDER BY sort_order DESC
        ')->result_array();
        $count = '0';
		$this->data['data_banner'] = $data_banner;
		
		//Lấy danh sách Nhà Đất Bán Mới Nhất
		$input = array();
		$input['where'] = array('status' => '0', 'du_an_status' => '0', 'loai_hinh_1' => json_encode('Mua Bán'));
		$input['order']	= array('update_time','desc');
		$input['limit'] = array('8','0');
		//Select cho nhẹ
		$this->db->select('id, name, alias, meta_desc, loai_hinh_1, loai_hinh_2, loai_hinh_3, location, gia_tien, gia_tien_option, gia_tien_thue, gia_tien_thue_option, dien_tich, chu_dau_tu_id, phong_ngu, phong_tam, chi_tiet_nha_dat, image_link, update_time');
		$nha_data_ban_moi_nhat = $this->project_model->get_list($input);
		$this->data['nha_data_ban_moi_nhat'] = $nha_data_ban_moi_nhat;

		//Lấy danh sách Nhà Đất cho thuê mới nhất
		$input = array();
		$input['where'] = array('status' => '0', 'du_an_status' => '0', 'loai_hinh_1' => json_encode('Cho Thuê'));
		$input['order']	= array('update_time','desc');
		$input['limit'] = array('8','0');
		//Select cho nhẹ
		$this->db->select('id, name, alias, meta_desc, loai_hinh_1, loai_hinh_2, loai_hinh_3, location, gia_tien, gia_tien_option, gia_tien_thue, gia_tien_thue_option, dien_tich, chu_dau_tu_id, phong_ngu, phong_tam, chi_tiet_nha_dat, image_link, update_time');
		$nha_data_cho_thue_moi_nhat = $this->project_model->get_list($input);
		$this->data['nha_data_cho_thue_moi_nhat'] = $nha_data_cho_thue_moi_nhat;

		
		//Lấy danh sách Dự Án Mới Nhất
		$input = array();
		$input['where'] = array('status' => '0', 'du_an_status' => '1');
		$input['order']	= array('update_time','desc');
		$input['limit'] = array('8','0');
		//Select cho nhẹ
		$this->db->select('id, name, alias, meta_desc, loai_hinh_1, loai_hinh_2, loai_hinh_3, location, gia_tien, gia_tien_option, gia_tien_thue, gia_tien_thue_option, dien_tich, chu_dau_tu_id, phong_ngu, phong_tam, chi_tiet_nha_dat, image_link, update_time');
		$du_an_bds_moi_nhat = $this->project_model->get_list($input);
		$this->data['du_an_bds_moi_nhat'] = $du_an_bds_moi_nhat;

		//Lấy danh sách tin tức mới nhất
		$input = array();
		$input['where'] = array('status' => '0');
		$input['order']	= array('update_time','desc');
		$input['limit'] = array('5','0');
		$this->db->select('id, name, alias, meta_desc, image_link');
		$this->db->where('catalog_id <','100');
		$tin_tuc_moi_nhat = $this->news_model->get_list($input);
		$this->data['tin_tuc_moi_nhat'] = $tin_tuc_moi_nhat;

		//Lấy Danh Sách Chủ Đầu Tư
		$input = array();
		$input['where'] = array('status' => '0');
		$input['order']	= array('total_project','desc');
		$input['limit'] = array('8','0');
		$this->db->select('id, name, prefix, alias, image_link, total_project');
		$danh_sach_chu_dau_tu = $this->chu_dau_tu_model->get_list($input);
		$this->data['danh_sach_chu_dau_tu'] = $danh_sach_chu_dau_tu;

		$this->output->cache('5');

		//Truyền ra view
		$this->data['temp'] = 'site/home/index';
		$this->load->view('site/layout', $this->data);

	}

	//Danh sách tỉnh / thành phố -- quận / huyện -- phường / xã / đường / phố / ấp -- render bằng json
	function local(){
		$this->load->view('site/home/local', $this->data);
	}

	function sitemap(){
		$this->load->view('site/sitemap', $this->data);
	}



	//Script để render phần header
	function render_header(){
		$this->load->view('site/render_header', $this->data);
	}

	function error()
	{	
		$this->data['temp'] = 'site/home/404';

		$this->load->view('site/layout', $this->data);
	}

}
