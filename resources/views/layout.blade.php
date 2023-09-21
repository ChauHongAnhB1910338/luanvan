<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <title>Anh Chau Shop</title>
    <link href="{{asset('public/frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('public/frontend/css/animate.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/main.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/responsive.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('images/ico/apple-touch-icon-57-precomposed.png')}}">
</head><!--/head-->

<body>
	<header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container-fluid">
				<div class="row">
					<div class="col-sm-1">

					</div>
					<div class="col-sm-5">
						<div class="btn-group">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									Việt Nam
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Mỹ</a></li>
									<li><a href="#">Trung Quốc</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									Tiền Việt
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="#">Canadian Dollar</a></li>
									<li><a href="#">Dollar</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-sm-5">
						<div class="shop-menu pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-star"></i> Yêu thích</a></li>
								<?php 
								$shipping_id = Session::get('shipping_id');
								$customer_id = Session::get('customer_id');
								if($customer_id!=NULL && $shipping_id==NULL){
								?>
								<li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								<?php 
								}elseif($customer_id!=NULL && $shipping_id!=NULL){
								?>
								<li><a href="{{URL::to('/payment')}}"><i class="fa fa-lock"></i> Thanh toán</a></li>
								<?php
								}else{
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Thanh toán</a></li>
								<?php } ?>
								<?php 
								
								if($customer_id!=NULL && $shipping_id==NULL){
								?>
								<li><a href="{{URL::to('/don-hang/'.$customer_id)}}">Đơn hàng</a></li>
								<?php
									}
								?>
								<li><a href="{{URL::to('/gio-hang')}}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								<?php 
								$customer_id = Session::get('customer_id');
								if($customer_id!=NULL){
								?>
								<li><a href="{{URL::to('/logout-checkout')}}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
								<?php 
								}else{
								?>
								<li><a href="{{URL::to('/login-checkout')}}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
								<?php
								}
								?>
								
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container-fluid">
				<div style="background-color: pink;" class="row">
					<div class="col-sm-1"></div>
					<div class="col-sm-1">
						<a href="{{URL::to('/trangchu')}}" class="active"><img style="height: 82px; padding-top: 7px" src="public/frontend/images/logo.jpg" alt=""></a>
					</div>
					<div class="col-sm-3" style="padding-top: 20px">
						<form action="{{URL::to('/tim-kiem')}}" method="POST">
							{{ csrf_field() }}
						<div class="search_box pull-right">
							<input type="text" style="width: 350px" name="keywords_submit" placeholder="Bạn muốn tìm kiếm sản phẩm gì hôm nay?..."/>
							<input type="submit" name="search_items" style="margin-top:0;color:#666;background-color:yellow" class="btn btn-success btn-sm" value="Tìm">
						</div>
						</form>
					</div>
					<div class="col-sm-1"></div>
					<div class="col-sm-5">
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li style="background-color: #d80101">
									<a style="color: white; font-size: 20px; font-weight: bold;" href="{{URL::to('/san-pham')}}">
										<img style="height: 82px; padding-top: 7px" src="{{ asset('public/frontend/images/shop.png') }}" alt="">
										Tất cả sản phẩm
									</a>
								</li> 
								<li style="background-color: #fda702" class="dropdown">
									<a href="#" style="color: white; font-size: 20px; font-weight: bold;" class="dropdown-toggle" data-toggle="dropdown">
										<img style="height: 80px" src="{{ asset('public/frontend/images/baby.png') }}" alt="">
										Cho bé<b class="caret"></b>
									</a>
									<ul class="dropdown-menu custom-dropdown">
										@foreach ($category as $key => $cate)
											@if ($cate->category_desc == 'Dành cho bé')
												<li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></li>
											@endif
										@endforeach
									</ul>
								</li>
								<li style="background-color: #0072b0" class="dropdown">
									<a href="#" style="color: white; font-size: 20px; font-weight: bold;" class="dropdown-toggle" data-toggle="dropdown">
										<img style="height: 80px" src="{{ asset('public/frontend/images/mom.png') }}" alt="">
										Cho mẹ<b class="caret"></b>
									</a>
									<ul class="dropdown-menu custom-dropdown">
										@foreach ($category as $key => $cate)
											@if ($cate->category_desc == 'Dành cho mẹ')
												<li><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></li>
											@endif
										@endforeach
									</ul>
								</li>
							</ul>
						</div>
					</div>
					<div class="col-sm-1"></div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
		@yield('sld-home')
	<section>
		<div class="container-fluid">
			<div class="col-md-3 col-sm-3" style="padding-top: 15px">
				<div class="left-sidebar">

					<h2>Danh mục sản phẩm</h2>
					<div class="panel-group category-products" style="padding-left: 44px" id="accordian"><!--category-productsr-->
						@foreach ($category as $key => $cate)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></h4>
								</div>
							</div>
						@endforeach
						
					</div><!--/category-products-->

					<h2>Thương hiệu</h2>
					<div class="panel-group text-center category-products" id="accordian"><!--brands_products-->
						@foreach ($brand as $key => $brand)
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}">
											<img style="height: 80px; width: 200px;" src="{{ asset('public/uploads/brand/' . $brand->brand_image) }}" alt="">
										</a>
									</h4>
								</div>
							</div>
						@endforeach
					</div><!--/brands_products-->
					
				
				</div>
			</div>
			<div class="col-md-9 col-sm-9">
				@yield('content')
			</div>
		</div>
	</section>
	<footer id="footer"><!--Footer-->
		
		<div class="footer-widget">
			<div class="container">
				
					
			</div>	
		</div>
		
		<div class="footer-bottom"> 
			<div class="container">
				<div class="row text-center text-xs-center text-sm-left text-md-left">
					<div class="col-xs-12 col-sm-4 col-md-4">
						<h5>Cửa hàng trang sức Anh Chau</h5>
						<ul class="list-unstyled quick-links">
							<li><i class="fa"></i>Liên lạc trực tiếp qua hotline: 0947127033</li>
							<li>Ghé thăm cửa hàng tại địa chỉ: Số 1, Đường ABC, Thành phố Cà Mau</li>
						</ul>
					</div>
					<div class="col-xs-12 col-sm-8 col-md-8">
						<h5>Cam kết mang đến sự hài lòng cho khách hàng!</h5>
						<ul class="list-unstyled quick-links">
							<li>Cửa hàng Anh Chau luôn mang đến những sản phẩm chất lượng!</li>
							<br>
						</ul>
					</div>
				</div>
				<div class="row">
					<div class="col-xs-12 col-sm-12 col-md-12 mt-2 mt-sm-5">
						<ul class="list-unstyled list-inline social text-center">
							<li class="list-inline-item"><a href="#"><i class="fa fa-facebook"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fa fa-twitter"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fa fa-instagram"></i></a></li>
							<li class="list-inline-item"><a href="#"><i class="fa fa-google-plus"></i></a></li>
							<li class="list-inline-item"><a href="#" target="_blank"><i class="fa fa-envelope"></i></a></li>
						</ul>
					</div>
				</div>
				<div class="row">
					<p class="pull-right">Designed by <span><a target="_blank" href="https://www.facebook.com/profile.php?id=100009845684044">Anh Châu</a></span></p>
				</div>
			</div>
		</div>
		
	</footer><!--/Footer-->
    <script src="{{asset('public/frontend/js/jquery.js')}}"></script>
	<script src="{{asset('public/frontend/js/bootstrap.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/jquery.scrollUp.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/price-range.js')}}"></script>
    <script src="{{asset('public/frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('public/frontend/js/main.js')}}"></script>
	<script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>
	{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}
	<script>
		$(document).ready(function(){
			$('.send_order').click(function(){
				swal({
					title: "Bạn chắc chắn muốn đặt hàng?",
					text: "Đơn hàng sẽ được đặt ngay khi bạn đồng ý!",
					type: "warning",
					showCancelButton:true,
					confirmButtonClass: "btn-success",
					confirmButtonText: "Tôi đồng ý!",
					cancelButtonText: "Không, chưa mua",
					closeOnConfirm: false,
					closeOnCancel: false
				},
				function(isConfirm){
					if (isConfirm) {
						// Lấy các giá trị nhập liệu và loại bỏ khoảng trắng thừa
						var shipping_name = $('.shipping_name').val().trim();
						var shipping_email = $('.shipping_email').val().trim();
						var shipping_address = $('.shipping_address').val().trim();
						var shipping_phone = $('.shipping_phone').val().trim();
						var shipping_notes = $('.shipping_notes').val().trim();
						var shipping_method = $('.payment_select').val().trim();
						var order_coupon = $('.order_coupon' ).val().trim();
						var _token = $('input[name="_token"]').val().trim();
						// Kiểm tra các giá trị nhập liệu có hợp lệ không
						if (shipping_name == "" || shipping_email == "" || shipping_address == "" || shipping_phone == "") {
							// Hiển thị thông báo lỗi nếu thiếu thông tin bắt buộc
							alert("Vui lòng nhập đầy đủ thông tin giao hàng.");
							return;
						}

						if (!/^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/.test(shipping_email)) {
							// Hiển thị thông báo lỗi nếu email không đúng định dạng
							alert("Vui lòng nhập email hợp lệ.");
							return;
						}

						// console.log(shipping_name);
						$.ajax({
						url: '{{url('/confirm-order')}}',
						method: 'POST',
						dataType: "json",
						data:{'shipping_name': shipping_name,
							'shipping_email': shipping_email,
							'shipping_address': shipping_address,
							'shipping_phone': shipping_phone,
							'shipping_notes': shipping_notes,
							'shipping_method': shipping_method,
							'order_coupon': order_coupon,
							'_token': _token},
						});
						swal("Đặt hàng thành công!","Chúng tôi sẽ sớm liên hệ với bạn!","success");

						window.setTimeout(function(){
							location.reload();
						}, 3000);
					} else {
						swal("Đã hủy!","Vui lòng xem và đặt hàng lại!","error");
					}
					
				}
				);
				
		
			});
		});
	</script>

	<script type="text/javascript">
		$(document).ready(function()
		{
			$('.add-to-cart').click(function(){
				var id= $(this).data('id_product');
				var cart_product_id = $('.cart_product_id_' + id).val();
				var cart_product_name = $('.cart_product_name_' + id).val();
				var cart_product_image = $('.cart_product_image_' + id).val();
				var cart_product_quantity = $('.cart_product_quantity_' + id).val();
				var cart_product_price = $('.cart_product_price_' + id).val();
				var cart_product_qty = $('.cart_product_qty_' + id).val();
				var _token = $('input[name="_token"]').val();
				if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
					alert('Kho hàng không đủ. Xin hãy đặt ít hơn ' +cart_product_quantity);
				}else{
					$.ajax({
					url: '{{url('/add-cart-ajax')}}',
					method: 'POST',
					data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,
					cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,cart_product_quantity:cart_product_quantity,_token:_token},
					success:function(data){
						swal({
							title: "Đã thêm vào giỏ hàng",
							text: "Bạn có thể tiếp tục hoặc tới giỏ hàng để thanh toán",

							showCancelButton: true,
							cancelButtonText: "Xem tiếp",
							confirmButtonClass: "btn-success",
							confirmButtonText: "Đến giỏ hàng",
							closeOnConfirm: false
						},
						function(){
							window.location.href = "{{url('/gio-hang')}}";
						}
						);
					}
					})
				}
				
			});
		});
	</script>
</body>
</html>