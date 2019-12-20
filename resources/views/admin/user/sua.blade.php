@extends('admin.layout.index')
@section('content')
<div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">User
                            <small>{{$user->name}}</small>
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
                        <form action="admin/user/sua/{{$user->id}}" method="POST" enctype="multipart/form-data">
                            <input type="hidden" name="_token" value="{{csrf_token()}}"/>
                            
                            <div class="form-group">
                                <label>Tên</label>
                                <input type="text" value="{{$user->name}}" class="form-control" name="name" > 
                            </div>
                            
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" value="{{$user->email}}" class="form-control" name="email" placeholder="Nhập Email" readonly="">
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="changepw" name="changepw">
                                <label>Password</label><br>
                                <input type="password" name="password" class="cpassword"  class="form-control" placeholder="Nhập Password" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại Password</label><br>
                                <input type="password" name="password2" class="cpassword"  placeholder="Nhập lại Password" class="form-control" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Quyền User</label>
                                <label class="radio-inline"><input type="radio" name="quyen" value="0" checked="">Thường</label>
                                <label class="radio-inline"><input type="radio" name="quyen" value="1" checked="">Admin</label>
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
        @section('script')
        <script>
            $(document).ready(function(){
                $("#changepw").change(function(){
                    if($(this).is(":checked")){
                        $(".cpassword").removeAttr('disabled');
                    }
                    else{
                        $(".cpassword").attr('disabled', '');
                    }
                });
            });
        </script>
        @endsection
        