<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\TinTuc;
use App\TheLoai; 
use App\LoaiTin;
use App\Comment;
use App\Slide;

class SlideController extends Controller
{
    public function getDanhSach(){
    	$slide = Slide::all();
        return view('admin.slide.danhsach', ['slide' => $slide]);
    }
    public function getThem(){
    	return view('admin.slide.them');
    }
    public function getSua($id){
    	$slide = Slide::find($id);
        return view('admin.slide.sua', ['slide' => $slide]);
    }
    public function getXoa($id){
    	$slide = Slide::find($id);
        $slide->delete();
        return redirect('admin/slide/danhsach')->with('thongbao', 'Xóa thành công');
    }
    public function postSua(Request $request, $id){
    	$this -> validate($request,
            [
                'Ten' => 'required',
                'NoiDung' => 'required',
                'Link' => 'required',
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên thể loại',
                'NoiDung.required' => 'Bạn chưa nhập nội dung',
                'Link.required' => 'Bạn chưa nhập link',
            ]);
        $slide = Slide::find($id);
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('Link'))
            $slide->link = $request->Link;
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect('admin/slide/sua')->with('thongbao', 'Bạn chỉ được upload ảnh có đuôi jpg, png, jpeg');
            }
            $hinh = str_random(4)."_".$name;
            while(file_exists("upload/slide/".$hinh)){
                $hinh = str_random(4)."_".$name;
            }
            unlink("upload/slide/".$slide->Hinh);
            $file->move("upload/slide", $hinh);
            $slide->Hinh = $hinh;
        }else $slide->Hinh = "";
        $slide->save();
        return redirect('admin/slide/sua/'.$id)->with('thongbao', 'Sửa bài thành công');
    }
    public function postThem(Request $request){
    	$this -> validate($request,
            [
                'Ten' => 'required',
                'NoiDung' => 'required',
                'Link' => 'required',
            ],
            [
                'Ten.required' => 'Bạn chưa nhập tên thể loại',
                'NoiDung.required' => 'Bạn chưa nhập nội dung',
                'Link.required' => 'Bạn chưa nhập link',
            ]);
        $slide = new Slide;
        $slide->Ten = $request->Ten;
        $slide->NoiDung = $request->NoiDung;
        if($request->has('Link'))
            $slide->link = $request->Link;
        if($request->hasFile('Hinh')){
            $file = $request->file('Hinh');
            $name = $file->getClientOriginalName();
            $duoi = $file->getClientOriginalExtension();
            if($duoi != 'jpg' && $duoi != 'png' && $duoi != 'jpeg'){
                return redirect('admin/slide/them')->with('thongbao', 'Bạn chỉ được upload ảnh có đuôi jpg, png, jpeg');
            }
            $hinh = str_random(4)."_".$name;
            while(file_exists("upload/slide/".$hinh)){
                $hinh = str_random(4)."_".$name;
            }
            $file->move("upload/slide", $hinh);
            $slide->Hinh = $hinh;
        }else $slide->Hinh = "";
        $slide->save();
        return redirect('admin/slide/them')->with('thongbao', 'Thêm bài thành công');
    }
}
