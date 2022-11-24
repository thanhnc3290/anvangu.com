<?php
/*
* Lấy ngày từ dạng int
* $time: thời gian muốn hiển thị
* $full_time: hiển thị cụ thể giờ phút giây
*/


function get_date($time, $full_time = false)
{
	$format ='%d-%m-%Y';
	if($full_time)
	{
		$format = $format. '<br/> %h:%i:%s';
	}
	$date = mdate($format, $time);
	return $date;
}