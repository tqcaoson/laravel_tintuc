@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>Thêm</small>
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
                        <form action="admin/user/them" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" class="form-control" name="name" placeholder="Nhập Tên"> 
                            </div>
                            
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email"  class="form-control" name="email" placeholder="Nhập Email">
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" name="password" class="form-control" placeholder="Nhập Password">
                            </div>
                            <div class="form-group">
                                <label>Nhập lại Password</label>
                                <input type="password" name="password2" placeholder="Nhập lại Password" class="form-control">
                            </div>
                            <div class="form-group">
                                <label>Quyền User</label>
                                <label class="radio-inline"><input type="radio" name="quyen" value="0" checked="">Thường</label>
                                <label class="radio-inline"><input type="radio" name="quyen" value="1" checked="">Admin</label>
                            </div>
                            
                            <button type="submit" class="btn btn-default">Thêm</button>
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