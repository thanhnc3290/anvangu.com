<?php
Class Home extends MY_Controller
{
	function __construct()
	{
		// Kế thừa từ MY_Controller
		parent::__construct();
	}
	
	

	
	function index()
	{
		$this->data['temp']='admin/home/index';
		$this->load->view('admin/main', $this->data);
	}

	function clear_all_cache()
	{
		$CI =& get_instance();
		$path = $CI->config->item('cache_path');

		$cache_path = ($path == '') ? APPPATH.'cache/' : $path;

		$handle = opendir($cache_path);
		while (($file = readdir($handle))!== FALSE) 
		{
			//Leave the directory protection alone
			if ($file != '.htaccess' && $file != 'index.html')
			{
			@unlink($cache_path.'/'.$file);
			}
		}
		closedir($handle);
		
		redirect(base_url());
	}
	

}