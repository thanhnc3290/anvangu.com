<?php
Class Login extends MY_Controller
{
	function index()
	{
		$this->load->library('form_validation');
		$this->load->helper('form');
		if($this->input->post())
		{
			$this->form_validation->set_rules('login','login','callback_check_login');
			if($this->form_validation->run())
			{
				$this->session->set_userdata('login', true);
				//Lấy thông tin admin đăng nhập
				
				$this->load->model('admin_model');

				$username = $this->input->post('username');
				$password = $this->input->post('password');
				$input = array();
				$admin_list = $this->admin_model->get_list($input);

				foreach($admin_list as $row){
					if(($row->username == $username) && ($row->password == $password))
					{
						//tạo mới giá trị của user đăng nhập bằng session
						$this->session->set_userdata('id', $row->id);
						$this->session->set_userdata('username', $row->username);
						$this->session->set_userdata('password', $row->password);
						$this->session->set_userdata('group_id', $row->group_id);
						$this->session->set_userdata('name', $row->name);

					}
				}
				redirect(admin_url('home'));
			}
		}
		$this->load->view('admin/login/index');
	}

	function check_login()
	{
		$username = $this->input->post('username');
		$password = $this->input->post('password');
		$password = $password;

		$this->load->model('admin_model');
		$where = array('username' => $username, 'password' => $password,'status' => '0');
		if ($this->admin_model->check_exists($where))
		{
			return true;
		}
		$this->form_validation->set_message(__FUNCTION__, 'Không đăng nhập thành công');
		return false;
	}
}