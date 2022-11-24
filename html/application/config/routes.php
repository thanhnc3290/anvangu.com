<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/

$route['default_controller'] = 'home';
$route['404_override'] = 'home/error';
$route['translate_uri_dashes'] = true;

//Trỏ sitemap
$route['^sitemap.xml?$'] = 'home/sitemap'; //trỏ về controller home - function sitemap

//trỏ json trong admin

$route['^local_list.json$'] = 'home/local'; //trỏ về controller home/local -- Danh sách tỉnh thành quận huyện phường xã đường phố
$route['^api_project_city_list.json$'] = 'admin/project/api_project_city_list'; //trỏ về controller admin/project/api_project_list
$route['^api_project_districts_list_of_city_(:num).json$'] = 'admin/project/api_project_districts_list_of_city/$1'; //trỏ về controller admin/project/api_project_list
$route['^api_project_wards_list_of_districts_(:num).json$'] = 'admin/project/api_project_wards_list_of_districts/$1'; //trỏ về controller admin/project/api_project_list

//route các js sinh bằng php
$route['^render_header.js$'] = 'home/render_header'; //trỏ về controller admin/news/api_news_list


//routes views -- chuyển tất cả trang danh sách dự án về project/search
$route['^danh-sach-bds-(:any)$']          = 'project/search/'; //trỏ về controller admin/news/api_news_list
$route['^danh-sach-bds$']                 = 'project/search/'; //trỏ về controller admin/news/api_news_list

//routes map
$route['^map$']                     = 'project/map/'; //trỏ về controller admin/news/api_news_list
$route['^map/(:num)$']              = 'project/map/$1'; //trỏ về controller admin/news/api_news_list


//404
$route['404'] = 'home/error';

//route view
$route['^(:any)-city(:num)$']           = 'project/city/$2'; //trỏ về controller admin/news/api_news_list
$route['^(:any)-districts(:num)$']      = 'project/districts/$2'; //trỏ về controller admin/news/api_news_list
$route['^(:any)-wards(:num)$']          = 'project/wards/$2'; //trỏ về controller admin/news/api_news_list
$route['^(:any)-pr(:num)$']             = 'project/view/$2'; //trỏ về controller admin/news/api_news_list
$route['^khu-vuc$']                     = 'project/all_location/'; //trỏ về controller admin/news/api_news_list

//route tin tức
$route['^tin-tuc$']                     = 'news/index'; //trỏ về controller 
$route['^tin-tuc-(:any)-cn(:num)$']     = 'news/index/$2'; //trỏ về controller 
$route['^(:any)-news(:num)$']           = 'news/view/$2'; //trỏ về controller

//route chủ đầu tư
$route['^chu-dau-tu$']                  = 'project/chu_dau_tu_list'; //trỏ về controller admin/news/api_news_list
$route['^(:any)-cdt(:num)$']            = 'project/chu_dau_tu/$2'; //trỏ về controller admin/news/api_news_list

//sitemap
$route['sitemap.xml'] = 'home/sitemap';
