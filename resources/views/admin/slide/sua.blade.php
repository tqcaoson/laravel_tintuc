@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Slide
                            <small>{{$slide->Ten}}</small>
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
                        <form action="admin/slide/sua/{{$slide->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" class="form-control" name="Ten" value="{{$slide->Ten}}" placeholder="Nhập Tên Loại Tin"> 
                            </div>
                            
                            <div class="form-group">
                                <label>Nội Dung</label>
                                <textarea id="demo" rows="3" class="ckeditor" name="NoiDung" >{{$slide->NoiDung}}</textarea>
                            </div>
                            <div class="form-group">
                                <label>Link</label>
                                <input type="text" value="{{$slide->link}}" class="form-control" name="Link">
                            </div>
                            <div class="form-group">
                                <label>Hình Ảnh</label>
                                <p><img width="400px" src="upload/slide/{{$slide->Hinh}}"></p>
                                <input type="file" name="Hinh" class="form-control">
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
        @endsection