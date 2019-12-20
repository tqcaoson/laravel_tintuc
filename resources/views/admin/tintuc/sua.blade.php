@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Tin Tức
                            <small>{{$tintuc->TieuDe}}</small>
                        </h1>
                    </div>
                    <!-- /.col-lg-12 -->
                    <div class="col-lg-7" style="padding-bottom:120px">
                        @if(count($errors) > 0)
                            <div class="alert alert-danger">
                                @foreach($errors -> all() as $err)
                                    {{$err}}
                                @endforeach
                            </div>
                        @endif
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                        <form action="admin/tintuc/sua/{{$tintuc->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            <div class="form-group">
                                <label>Thể Loại</label>
                                <select class="form-control" name="TheLoai" id="TheLoai">
                                    @foreach($theloai as $tl)
                                    
                                        <option
                                        @if($tintuc->loaitin->theloai->id == $tl->id)
                                        {
                                            {{"selected"}}
                                        }
                                        @endif

                                        value="{{$tl->id}}">{{$tl->Ten}}</option>
                                        
                                    @endforeach
                                </select>
                                <br>
                                <label>Thể Loại</label>
                                <select class="form-control" name="LoaiTin" id="LoaiTin">
                                    @foreach($loaitin as $lt)
                                        <option
                                        @if($tintuc->loaitin->theloai->id == $tl->id)
                                        {
                                            {{"selected"}}
                                        }
                                        @endif
                                         value="{{$lt->id}}">{{$lt->Ten}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Tên Bài</label>
                                <input value="{{$tintuc->TieuDe}}" type="text" class="form-control" name="Ten" placeholder="Nhập Tên Loại Tin"> 
                            </div>
                            <div class="form-group">
                                <label>Tóm Tắt</label>
                                <textarea class="form-control" name="TomTat">{{$tintuc->TomTat}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea id="demo" rows="3" class="ckeditor" name="NoiDung" placeholder="Nhập Nội Dung">{{$tintuc->NoiDung}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <img src="upload/tintuc/{{$tintuc->Hinh}}" width="400px">
                                <input value="{{$tintuc->Hinh}}" type="file" name="Hinh" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Nổi Bật</label>
                                <label class="radio-inline"><input type="radio" name="NoiBat" value="0" checked="">Không</label>
                                <label class="radio-inline"><input type="radio" name="NoiBat" value="1" checked="">Có</label>
                            </div>
                            
                            <button type="submit" class="btn btn-default">Sửa</button>
                            <button type="reset" class="btn btn-default">Làm mới</button>
                        </form>
                    </div>
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </div>
        <!-- /#page-wrapper -->


                <div class="row">
                    <div class="col-lg-12">
                        
                        <h1 class="page-header">Comment
                            <small>Danh Sách</small>
                        </h1>
                        @if(session('thongbao'))
                            <div class="alert alert-success">
                                {{session('thongbao')}}
                            </div>
                        @endif
                    </div>
                    <!-- /.col-lg-12 -->
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                            <tr align="center">
                                <th>ID</th>
                                <th>Người Dùng</th>
                                <th>Nội Dung</th>
                                <th>Ngày</th>
                                <th>Delete</th>
                            </tr>
                        </thead>
                        <tbody> 
                            @foreach($tintuc->comment as $cm)
                            <tr class="odd gradeX" align="center">
                                <td>{{$cm->id}}</td>
                                <td><p>{{$cm->user->name}}</p>
                                </td>
                                <td>{{$cm->NoiDung}}</td>
                                <td>{{$cm->created_at}}</td>
                                <td class="center"><i class="fa fa-pencil fa-fw"></i> <a href="admin/comment/xoa/{{$cm->id}}/{{$tintuc->id}}">Xóa</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>


@endsection

@section('script')
    <script>
        $(document).ready(function(){
            $('#TheLoai').change(function(){
                var idTheLoai = $(this).val();
                $.get("admin/ajax/loaitin/"+idTheLoai, function(data){
                    $("#LoaiTin").html(data);
                });
            });
        });
    </script>
@endsection