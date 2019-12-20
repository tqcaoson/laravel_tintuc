<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TheLoai;
use App\LoaiTin;

class TheLoaiController extends Controller
{
    public function getDanhSach(){
    	$theloai = TheLoai::all();
    	return view('admin.theloai.danhsach', ['theloai' => $theloai]);
    }
    public function getThem(){
    	return view('admin.theloai.them');
    }
    public function getSua($id){
        $theloai = TheLoai::find($id);
    	return view('admin.theloai.sua', ['theloai' => $theloai]);
    }
    public function getXoa($id){
        $theloai = TheLoai::find($id);
        $loaitin = LoaiTin::where('idTheLoai',$id);
        $loaitin->delete();
        $theloai->delete();
        return redirect('admin/theloai/danhsach')->with('thongbao', 'Xóa thành công');
    }
    public function postSua(Request $request, $id){
        $theloai = TheLoai::find($id);
        $this -> validate($request,
            [
                'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên thể loại',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
                'Ten.min' => 'Tên thể loại phải từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên thể loại phải từ 3 đến 100 ký tự',
            ]); 
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = str_slug($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/sua/'.$id)->with('thongbao', 'Sửa thành công');
        
    }
    public function postThem(Request $request){
        $this -> validate($request,
            [
                'Ten' => 'required|unique:TheLoai,Ten|min:3|max:100'
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên thể loại',
                'Ten.unique' => 'Tên thể loại đã tồn tại',
                'Ten.min' => 'Tên thể loại phải từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên thể loại phải từ 3 đến 100 ký tự',
            ]);
        $theloai = new TheLoai;
        $theloai->Ten = $request->Ten;
        $theloai->TenKhongDau = str_slug($request->Ten);
        $theloai->save();
        return redirect('admin/theloai/them')->with('thongbao', 'Thêm thành công');
    }
}
