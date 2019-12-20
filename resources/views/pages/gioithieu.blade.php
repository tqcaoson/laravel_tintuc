@extends('layouts.index')
@section('content')
    <!-- Page Content -->
    <div class="container">

    	<!-- slider -->
    	@include('layouts.slide')
    	<!-- end slide -->

        <div class="space20"></div>


        <div class="row main-left">
            @include('layouts.menu')

            <div class="col-md-9">
	            <div class="panel panel-default">            
	            	<div class="panel-heading" style="background-color:#337AB7; color:white;" >
	            		<h2 style="margin-top:0px; margin-bottom:0px;">Giới thiệu</h2>
	            	</div>

	            	<div class="panel-body">
	            		<!-- item -->
					   <h3>
					   	Tôi là Trịnh Quang Cao Sơn, năm nay 20 tuổi. Hiện là một lập trình viên nghiệp dư và đang hướng tới trở thành lập trình viên chuyên nghiệp. Tôi viết ra trang Web này mục đích để kiểm tra lại trình độ của mình.
					   </h3><br>
					   <h3>
					   	Đây là một trang Web tin tức, chuyên cập nhật những vấn đề nổi bật trong xã hội hiện nay về mọi mặt trong đời sống xã hội.
					   </h3>

					</div>
	            </div>
        	</div>
        </div>
        <!-- /.row -->
    </div>
    <!-- end Page Content -->
@endsection