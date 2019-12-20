<?php

/*  
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use App\TheLoai; 
Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'admin', 'middleware' => 'adminLogin'], function(){
	Route::group(['prefix' => 'theloai'], function(){
		//admin/theloai/them
		Route::get('danhsach', 'TheLoaiController@getDanhSach');
		Route::get('sua/{id}', 'TheLoaiController@getSua');
		Route::post('sua/{id}', 'TheLoaiController@postSua');
		Route::get('xoa/{id}', 'TheLoaiController@getXoa');
		Route::get('them', 'TheLoaiController@getThem');
		Route::post('them', 'TheLoaiController@postThem');
	});
	Route::group(['prefix' => 'loaitin'], function(){
		//admin/theloai/them
		Route::get('danhsach', 'LoaiTinController@getDanhSach');
		Route::get('sua/{id}', 'LoaiTinController@getSua');
		Route::post('sua/{id}', 'LoaiTinController@postSua');
		Route::get('xoa/{id}', 'LoaiTinController@getXoa');
		Route::get('them', 'LoaiTinController@getThem');
		Route::post('them', 'LoaiTinController@postThem');
	});
	Route::group(['prefix' => 'tintuc'], function(){
		//admin/theloai/them
		Route::get('danhsach', 'TinTucController@getDanhSach');
		Route::get('sua/{id}', 'TinTucController@getSua');
		Route::post('sua/{id}', 'TinTucController@postSua');
		Route::get('xoa/{id}', 'TinTucController@getXoa');
		Route::get('them', 'TinTucController@getThem');
		Route::post('them', 'TinTucController@postThem');
	});
	Route::group(['prefix' => 'slide'], function(){
		//admin/theloai/them
		Route::get('danhsach', 'SlideController@getDanhSach');
		Route::get('sua/{id}', 'SlideController@getSua');
		Route::post('sua/{id}', 'SlideController@postSua');
		Route::get('xoa/{id}', 'SlideController@getXoa');
		Route::get('them', 'SlideController@getThem');
		Route::post('them', 'SlideController@postThem');
	});
	Route::group(['prefix' => 'user'], function(){
		//admin/theloai/them
		Route::get('danhsach', 'UserController@getDanhSach');
		Route::get('sua/{id}', 'UserController@getSua');
		Route::post('sua/{id}', 'UserController@postSua');
		Route::get('xoa/{id}', 'UserController@getXoa');
		Route::get('them', 'UserController@getThem');
		Route::post('them', 'UserController@postThem');
	});
	Route::group(['prefix' => 'ajax'], function(){
		Route::get('loaitin/{idTheLoai}', 'AjaxController@getLoaiTin');
	});
	Route::group(['prefix' => 'comment'], function(){
		Route::get('xoa/{id}/{idTinTuc}', 'CommentController@getXoa');
	});
});
Route::get('admin/dangnhap', 'UserController@getdangnhapAdmin');
Route::post('admin/dangnhap', 'UserController@postdangnhapAdmin');
Route::get('admin/logout', 'UserController@getdangxuatAdmin');


//user

Route::get('trangchu', 'PageController@trangchu');
Route::get('lienhe', 'PageController@lienhe');
Route::get('gioithieu', 'PageController@gioithieu');
Route::get('loaitin/{id}/{TenKhongDau}.html', 'PageController@loaitin');
Route::get('tintuc/{id}/{TenKhongDau}.html', 'PageController@tintuc');

Route::get('dangnhap', 'PageController@getdangnhap');
Route::post('dangnhap', 'PageController@postdangnhap');
Route::get('dangxuat', 'PageController@getdangxuat');
Route::get('nguoidung', 'PageController@getnguoidung');
Route::post('nguoidung', 'PageController@postnguoidung');
Route::post('comment/{id}', 'CommentController@postcomment');
Route::get('dangky', 'PageController@getdangky');
Route::post('dangky', 'PageController@postdangky');

Route::post('timkiem', 'PageController@timkiem');