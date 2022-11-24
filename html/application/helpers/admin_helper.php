<?php
// Hàm tạo ra các link url trong trang admin
function admin_url($url = '')
{
	return base_url('admin/'.$url);
}