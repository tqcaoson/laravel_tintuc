@extends('layouts.index')
@section('content')
	<!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	<div class="row carousel-holder">
            <div class="col-md-2">
            </div>
            <div class="col-md-8">
                <div class="panel panel-default">
				  	<div class="panel-heading">Thông tin tài khoản</div>
				  	<div class="panel-body">
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
				    	<form action="nguoidung" method="POST">
				    		<input type="hidden" name="_token" value="{{csrf_token()}}"/>
				    		<div>
				    			<label>Họ tên</label>
							  	<input type="text" class="form-control" value="{{Auth::user()->name}}" placeholder="Username" name="name" aria-describedby="basic-addon1">
							</div>
							<br>
							<div>
				    			<label>Email</label>
							  	<input type="email" class="form-control" value="{{Auth::user()->email}}" name="email" aria-describedby="basic-addon1"
							  	readonly="" 
							  	>
							</div>
							<br>	
							<div class="form-group">
                                <input type="checkbox" id="changepw" name="changepw">
                                <label>Password</label><br>
                                <input type="password" name="password" class="cpassword"  class="form-control" placeholder="Nhập Password" disabled="" />
                            </div>
                            <div class="form-group">
                                <label>Nhập lại Password</label><br>
                                <input type="password" name="password2" class="cpassword"  placeholder="Nhập lại Password" class="form-control" disabled="" />
                            </div>
							<br>
							<button type="submit" class="btn btn-default">Sửa
							</button>

				    	</form>
				  	</div>
				</div>
            </div>
            <div class="col-md-2">
            </div>
        </div>
        <!-- end slide -->
    </div>
    <!-- end Page Content -->
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