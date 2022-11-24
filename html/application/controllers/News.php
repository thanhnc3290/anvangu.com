<?php  
Class News extends MY_Controller
{
	//private $perPage = 16; // mỗi trang loadmore thì thêm 10 kết quả

	/* 
	* Hàm khởi tạo
	*/
	function __construct()
	{
		parent::__construct();
		$this->load->model('news_model');
		$this->load->model('project_model');

		
		//tin tức nổi bật
		$input = array();
		$input['where'] = array('status' => '0', 'hot' => '1');
		$input['order']	= array('id','desc');
		$this->db->select('id, name, alias, image_link');
		$this->db->where('catalog_id <','100');
		$tin_tuc_noi_bat_list = $this->news_model->get_list($input);
		$this->data['tin_tuc_noi_bat_list']	= $tin_tuc_noi_bat_list;

		//tin tức mới
		$input = array();
		$input['where']	= array('status' => '0','hot'=>'0');
		$input['order'] = array('id','desc');
		$this->db->select('id, name, alias, image_link');
		$this->db->where('catalog_id <','100');
		$tin_tuc_moi_list = $this->news_model->get_list($input);
		$this->data['tin_tuc_moi_list'] = $tin_tuc_moi_list;
	}
	
	function index()
	{	
		$total_key = '0';
		$query_phan_trang = '0';
		$query_danh_muc = '';
		$query_key_search = '';
		$check_page = '0';

		//input catalog_id
		$id_danh_muc = $this->uri->rsegment('3');
		if(isset($id_danh_muc)){
			$query_danh_muc = trim($id_danh_muc);
			$total_key++;
			$check_page++;
			$this->data['id_danh_muc'] = trim($id_danh_muc);
		}

		//input keysearch
		if(isset($_GET['key_search'])){
			$key_search				 		 	 = $_GET['key_search'];
			
			if($key_search !== ''){
				$query_key_search 				= str_replace('"','',json_encode($key_search));
				$total_key++;
				$check_page++;
				$this->data['key_search']		= trim($key_search);
			}
		}
		$this->data['check_page'] = $check_page;
		$this->data['total_key'] = $total_key;

		//Tạo 1 biến để query
		$filter_data = array(
			'status' 				=> '0',
			'catalog_id'			=> $query_danh_muc,
		);
		//Xóa điều kiện nếu value rỗng
		if($query_danh_muc == '')	{	unset($filter_data['catalog_id']);}
		

		$input = array();
		$input['where'] = $filter_data; // truyền biến query vào input['where']
		$input['order'] = array('id','desc');

		if($query_key_search !==''){
			$this->db->like('name', trim($query_key_search));
		}
		$this->data['query_key_search']	= $query_key_search;
		

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

		$this->db->select('id, name, alias, meta_desc, image_link');
		$this->db->where('catalog_id <','100');
		$list 			= $this->news_model->get_list($input);
		$this->data['list']	= $list;

		//tạo thông tin head

		
		//Danh mục tin tức
		$catalog_news_list 		= array();
		$catalog_news_list[]	= array('id'=>'1','name'=>'Thị Trường','url' => base_url('tin-tuc-'.create_alias('Thị Trường').'-cn1'));
		$catalog_news_list[]	= array('id'=>'2','name'=>'Kiến Thức','url' => base_url('tin-tuc-'.create_alias('Kiến Thức').'-cn2'));
		$catalog_news_list[]	= array('id'=>'3','name'=>'Xây Dựng, Phong Thủy','url' => base_url('tin-tuc-'.create_alias('Xây Dựng, Phong Thủy').'-cn3'));
		$catalog_news_list[]	= array('id'=>'4','name'=>'Góc Tư Vấn','url' => base_url('tin-tuc-'.create_alias('Góc Tư Vấn').'-cn4'));
		$catalog_news_list[]	= array('id'=>'5','name'=>'Phân Tích, Nhận Định','url' => base_url('tin-tuc-'.create_alias('Phân Tích, Nhận Định').'-cn5'));
		$catalog_news_list[]	= array('id'=>'6','name'=>'Thông Tin Quy Hoạch','url' => base_url('tin-tuc-'.create_alias('Thông Tin Quy Hoạch').'-cn6'));
		$catalog_news_list[]	= array('id'=>'7','name'=>'Tài Chính','url' => base_url('tin-tuc-'.create_alias('Tài Chính').'-cn7'));
		$this->data['catalog_news_list'] = $catalog_news_list;

		$site_title	= 'Anvangu.com | Tin Tức Tổng Hợp';
		$meta_desc	= 'Thông tin mở bán dự án bất động sản. Tin tức mới nhất về thị trường và các dự án mới. Phân tích dòng tiền đầu tư dự án. Căn hộ, nhà phố, shophouse, biệt thự biển từ cđt uy tín. Căn hộ, nhà phố đô thị. Bất động sản nghỉ dưỡng. Tư vấn hoàn toàn miễn phí.';
		$head_url	= base_url('tin-tuc');
		if(isset($id_danh_muc)){
			foreach($catalog_news_list as $row){
				if($row['id'] == $id_danh_muc){
					$site_title = 'Anvangu.com | Tin Tức '.$row['name'];
					$meta_desc = 'Tổng hợp tin tức đầu tư BĐS - '.$row['name'];
					$head_url  = $row['url'];
				}
			}
		}

		if(isset($key_search) &&($key_search !== '')){
			$site_title = 'Anvangu.com | Tin Tức - Tìm kiếm từ khóa: "'.$key_search.'"';
			$meta_desc = 'Tổng hợp tin tức đầu tư BĐS - '.$key_search;
		}

		$head_danh_muc = array();
		$head_danh_muc['site_title'] 	= $site_title;
		$head_danh_muc['meta_desc'] 	= $meta_desc;
		$head_danh_muc['url'] 			= $head_url;
		$this->data['head_danh_muc']	= $head_danh_muc;

		$this->output->cache('5');
        //Truyền ra view
		$this->data['temp'] = 'site/news/index';
		$this->load->view('site/layout', $this->data);
		
	}

    function view()
	{	
		$id = $this->uri->rsegment('3');
		$info = $this->news_model->get_info($id);
		if(!$id){ redirect(base_url('404'));}
		if(!$info){ redirect(base_url('404'));}
		if($info->status !== '0'){ redirect(base_url('404'));}

		$this->data['info']	 = $info;

		//tạo thông tin catalog từ $info
		$catalog_name	= '';
		if($info->catalog_id == '1'){$catalog_name = 'Thị Trường';}
		if($info->catalog_id == '2'){$catalog_name = 'Kiến Thức';}
		if($info->catalog_id == '3'){$catalog_name = 'Xây Dựng, Phong Thủy';}
		if($info->catalog_id == '4'){$catalog_name = 'Góc Tư Vấn';}
		if($info->catalog_id == '5'){$catalog_name = 'Phân Tích, Nhận Định';}
		if($info->catalog_id == '6'){$catalog_name = 'Thông Tin Quy Hoạch';}
		if($info->catalog_id == '7'){$catalog_name = 'Tài Chính';}

		$catalog_info = array(
			'id'	=> $info->catalog_id,
			'name' 	=> $catalog_name,
			'alias'	=> create_alias($catalog_name),
			'url'	=> base_url('tin-tuc-'.create_alias($catalog_name).'-cn'.$info->catalog_id),
		);

		$this->data['catalog_info'] = $catalog_info;

		$this->output->cache('40320');
		//Truyền ra view
		$this->data['temp'] = 'site/news/view';
		$this->load->view('site/layout', $this->data);
	}
	
	

	function error()
	{	

		redirect(base_url());
		
		$this->data['temp'] = 'site/home/404';

		$this->load->view('site/layout', $this->data);
	}

}
