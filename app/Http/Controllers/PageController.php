<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\TheLoai;
use App\Slide;
use App\TinTuc;
use App\LoaiTin;
use App\User;

class PageController extends Controller
{
	function __construct(){
		$theloai = TheLoai::all();
		$slide = Slide::all();
		view()->share('theloai', $theloai);
		view()->share('slide', $slide);
        // if(Auth::check()){
        //     view()->share('nguoidung', Auth::user());
        // }
	}
    public function timkiem(Request $request){
        $tukhoa = $request->tukhoa;
        $tintuc = TinTuc::where('TieuDe', 'like', "%$tukhoa%")->orWhere('TomTat', 'like', "%$tukhoa%")->orWhere('NoiDung', 'like', "%$tukhoa%")->take(30)->paginate(5);
        return view('pages.timkiem', ['tintuc' => $tintuc, 'tukhoa' => $tukhoa]);
    }
    public function getdangnhap(){
        return view('pages.dangnhap');
    }
    public function getnguoidung(){
        return view('pages.nguoidung');
    }
    public function getdangky(){
        return view('pages.dangky');
    }
    public function postdangky(Request $request){
        $this -> validate($request,
            [
                'name' => 'required|min:6|max:30',
                'password' => 'required|min:6|max:30',
                'email' => 'required|email|unique:users,email',
                'password2' => 'required|same:password',
            ],
            [
                'name.required' => 'Bạn chưa nhập tài khoản',
                'password.required' => 'Bạn chưa nhập password',
                'name.min' => 'Tài khoản từ 6 đến 30 kí tự',
                'name.max' => 'Tài khoản từ 6 đến 30 kí tự',
                'password.max' => 'password từ 6 đến 30 kí tự',
                'password.min' => 'password từ 6 đến 30 kí tự',
                'email.required' => 'Bạn chưa nhập email',
                'email.unique' => 'email đã tồn tại',
                'password2.required' => 'Bạn chưa nhập lại password',
                'password2.same' => 'password nhập lại không khớp',
            ]);
        $user = new User;
        $user->name = $request->name;
        $user->password = bcrypt($request->password);
        $user->email = $request->email;
        $user->quyen = 0;
        $user->save();
        return redirect('dangky')->with('thongbao', 'Đăng ký thành công');
    }
    public function postnguoidung(Request $request){
        
        $this -> validate($request,
            [
                'name' => 'required|min:6|max:30',
            ],
            [
                'name.min' => 'Tên từ 6 đến 30 kí tự',
                'password.required' => 'Bạn chưa nhập Tên',
                'name.max' => 'Tên khoản từ 6 đến 30 kí tự',
            ]);
        $user = Auth::user();
        $user->name = $request->name;
        if($request->changepw == 'on'){
            $this -> validate($request,
            [
                'password' => 'required|min:6|max:30',
                'password2' => 'required|same:password', 
            ],
            [
                'password.required' => 'Bạn chưa nhập password',
                'password.max' => 'password từ 6 đến 30 kí tự',
                'password.min' => 'password từ 6 đến 30 kí tự',
                'password2.required' => 'Bạn chưa nhập lại password',
                'password2.same' => 'password nhập lại không khớp',
            ]);
            $user->password = bcrypt($request->password);
        }
        $user->save();
        return redirect('nguoidung')->with('thongbao', 'Sửa user thành công');
    }
    public function postdangnhap(Request $request){
        $this -> validate($request,
            [
                'password' => 'required|min:6|max:30',
                'email' => 'required',
            ],
            [
                'email.required' => 'Bạn chưa nhập tài khoản',
                'password.required' => 'Bạn chưa nhập mật khẩu',
                'password.min' => 'Mật khẩu từ 6 đến 30 kí tự',
                'password.max' => 'Mật Khẩu từ 6 đến 30 kí tự',
            ]);
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return redirect('trangchu');
        }else return redirect('dangnhap')->with('thongbao', 'Tài khoản mật khẩu không chính xác');
    }
    public function getdangxuat(){
        Auth::logout();
        return redirect('dangnhap');
    }
    function trangchu(){
    	return view('pages.trangchu');
    }
    function lienhe(){
    	return view('pages.lienhe');
    }
    function gioithieu(){
        return view('pages.gioithieu');
    }
    function loaitin($id,$TenKhongDau){
    	$loaitin = LoaiTin::find($id);
    	$tintuc = TinTuc::where('idLoaiTin',$id)->paginate(5);
    	return view('pages.loaitin', ['loaitin' => $loaitin, 'tintuc' => $tintuc]);
    }
    function tintuc($id){
    	$tintuc = TinTuc::find($id);
    	$tinnoibat = TinTuc::where('NoiBat',1)->take(4)->get();
    	$tinlienquan = TinTuc::where('idLoaiTin', $tintuc->idLoaiTin)->take(4)->get();
    	return view('pages.tintuc', ['tintuc' => $tintuc, 'tinnoibat' => $tinnoibat, 'tinlienquan' => $tinlienquan]);
    }
}
