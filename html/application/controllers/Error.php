<?php
Class Error1 extends MY_Controller
{
	function index()
	{
		$this->load->view('site/error', $this->data);
	}
}