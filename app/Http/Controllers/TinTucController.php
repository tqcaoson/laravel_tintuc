<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\TheLoai;
use App\LoaiTin;
use App\Comment;
class TinTucController extends Controller
{
    public function getDanhSach(){
    	$tintuc = TinTuc::orderBy('id', 'DESC',)->get();
    	return view('admin.tintuc.danhsach', ['tintuc' => $tintuc]);
    }
    public function getThem(){
    	$theloai = TheLoai::all();
    	$loaitin = LoaiTin::all();
    	return view('admin.tintuc.them', ['loaitin' => $loaitin], ['theloai' => $theloai]);
    }
    public function getSua($id){
    	$theloai = TheLoai::all();
    	$tintuc = TinTuc::find($id);
    	$loaitin = LoaiTin::all();
    	return view('admin.tintuc.sua', ['tintuc' => $tintuc, 'loaitin' => $loaitin, 'theloai' => $theloai]);
    }
    public function getXoa($id){
    	$tintuc = TinTuc::find($id);
		$tintuc->delete();
		return redirect('admin/tintuc/danhsach')->with('thongbao', 'Xóa thành công');
    }
    public function postSua(Request $request, $id){
    	$tintuc = TinTuc::find($id);
    	$this -> validate($request,
            [
            	'LoaiTin' => 'required',
            	'TheLoai' => 'required',
            	'TomTat' => 'required',
                'Ten' => 'required|unique:TinTuc,TieuDe|min:3|max:100'
            ],
            [
            	'TheLoai.required' => 'Bạn chưa chọn thể loại',
            	'LoaiTin.required' => 'Bạn chưa chọn loại tin',
            	'TomTat.required' => 'Bạn chưa nhập tóm tắt',
                'Ten.required' => 'Bạn chưa nhập tên thể loại',
                'Ten.unique' => 'Tên bài đã tồn tại',
                'Ten.min' => 'Tên bài phải từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên bài phải từ 3 đến 100 ký tự',
            ]);
    	$tintuc->TieuDe = $request->Ten;
    	$tintuc->TieuDeKhongDau = str_slug($request->Ten);
    	$tintuc->idLoaiTin = $request->LoaiTin;
    	$tintuc->TomTat = $request->TomTat; 
    	$tintuc->NoiDung = $request->NoiDung;
    	if($request->hasFile('Hinh')){
    		$file = $request->file('Hinh');
    		$name = $file->getClientOriginalName();
    		$duoi = $file->getClientOriginalExtension();
    		if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
    			return redirect('admin/tintuc/sua')->with('thongbao', 'Bạn chỉ được upload ảnh có đuôi jpg, png, jpeg');
    		}
    		$hinh = str_random(4)."_".$name;
    		while(file_exists("upload/tintuc/".$hinh)){
    			$hinh = str_random(4)."_".$name;
    		}
            unlink("upload/tintuc/".$tintuc->Hinh);
    		$file->move("upload/tintuc", $hinh);
    		$tintuc->Hinh = $hinh;
    	}
    	$tintuc->save();
    	return redirect('admin/tintuc/sua/'.$id)->with('thongbao', 'Sửa bài thành công');
    }
    public function postThem(Request $request){
    	$this -> validate($request,
            [
            	'LoaiTin' => 'required',
            	'TheLoai' => 'required',
            	'TomTat' => 'required',
                'Ten' => 'required|unique:TinTuc,TieuDe|min:3|max:100'
            ],
            [
            	'TheLoai.required' => 'Bạn chưa chọn thể loại',
            	'LoaiTin.required' => 'Bạn chưa chọn loại tin',
            	'TomTat.required' => 'Bạn chưa nhập tóm tắt',
                'Ten.required' => 'Bạn chưa nhập tên thể loại',
                'Ten.unique' => 'Tên bài đã tồn tại',
                'Ten.min' => 'Tên bài phải từ 3 đến 100 ký tự',
                'Ten.max' => 'Tên bài phải từ 3 đến 100 ký tự',
            ]);
    	$tintuc = new TinTuc;
    	$tintuc->TieuDe = $request->Ten;
    	$tintuc->TieuDeKhongDau = str_slug($request->Ten);
    	$tintuc->idLoaiTin = $request->LoaiTin;
    	$tintuc->TomTat = $request->TomTat;
    	$tintuc->NoiDung = $request->NoiDung;
    	$tintuc->SoLuotXem = 0;
    	if($request->hasFile('Hinh')){
    		$file = $request->file('Hinh');
    		$name = $file->getClientOriginalName();
    		$duoi = $file->getClientOriginalExtension();
    		if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
    			return redirect('admin/tintuc/them')->with('thongbao', 'Bạn chỉ được upload ảnh có đuôi jpg, png, jpeg');
    		}
    		$hinh = str_random(4)."_".$name;
    		while(file_exists("upload/tintuc/".$hinh)){
    			$hinh = str_random(4)."_".$name;
    		}
    		$file->move("upload/tintuc", $hinh);
    		$tintuc->Hinh = $hinh;
    	}else $tintuc->Hinh = "";
    	$tintuc->save();
    	return redirect('admin/tintuc/them')->with('thongbao', 'Thêm bài thành công');
    }
}
