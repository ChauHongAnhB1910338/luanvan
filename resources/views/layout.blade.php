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
				<div class="row">
					<div class="col-sm-7">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{URL::to('/trangchu')}}" class="active">Trang chủ</a></li>
								<li ><a href="{{URL::to('/san-pham')}}">Sản phẩm</i></a></li> 
								<li><a href="{{URL::to('/gio-hang')}}">Giỏ Hàng</a></li>
								<?php 
								if($customer_id!=NULL && $shipping_id==NULL){
								?>
								<li><a href="{{URL::to('/don-hang/'.$customer_id)}}">Đơn hàng</a></li>
								<?php
									}
								?>
							</ul>
						</div>
					</div>
					<div class="col-sm-5">
						<form action="{{URL::to('/tim-kiem')}}" method="POST">
							{{ csrf_field() }}
						<div class="search_box pull-right">
							<input type="text" name="keywords_submit" placeholder="Tìm kiếm sản phẩm"/>
							<input type="submit" name="search_items" style="margin-top:0;color:#666;background-color:yellow" class="btn btn-success btn-sm" value="Tìm kiếm">
						</div>
						</form>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->
	
	<section id="slider"><!--slider-->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div id="slider-carousel" class="carousel slide" data-ride="carousel">
						<ol class="carousel-indicators">
							<li data-target="#slider-carousel" data-slide-to="0" class="active"></li>
							<li data-target="#slider-carousel" data-slide-to="1"></li>
							<li data-target="#slider-carousel" data-slide-to="2"></li>
						</ol>
						
						<div class="carousel-inner">
							<div class="item active">
								<div class="col-sm-6">
									<h1><span>AC</span>-SHOP</h1>
									<h2>Voucher giảm giá HOT!</h2>
									<p>Voucher sẽ được chúng tôi đăng tại trang chủ vào mỗi dịp lễ!</p>
								</div>
								<div class="col-sm-6">
									<img src="https://media.istockphoto.com/id/1182639214/photo/middle-age-couple-in-jewelry-store.jpg?s=612x612&w=0&k=20&c=SX9O8zt0pK3bpPJEEb9qcjW11eleKvDImPpT5FvVf3M=" class="girl img-responsive" alt="" />
								</div>
							</div>
							<div class="item">
								<div class="col-sm-6">
									<h1><span>AC</span>-SHOP</h1>
									<h2>Phong cách và thời thượng</h2>
									<p>Cung cấp các sản phẩm từ những nhãn hiệu thời trang nổi tiếng hàng đầu thế giới! </p>
								</div>
								<div class="col-sm-6">
									<img style="height: 326.9px" src="https://media.istockphoto.com/id/611204924/photo/modern-jewelry-store-interior-design.jpg?s=612x612&w=0&k=20&c=4vczd7HyPu_lPrFQh1ZL35g44LmrcPUXQMDDFIKR7H0=" class="girl img-responsive" alt="" />
								</div>
							</div>
							
							<div class="item">
								<div class="col-sm-6">
									<h1><span>AC</span>-SHOP</h1>
									<h2>Thanh toán nhanh chóng</h2>
									<p>Quý khách hàng có thể lựa chọn các hình thức thanh toán khác nhau!</p>
								</div>
								<div class="col-sm-6">
									<img src="https://media.istockphoto.com/id/601031970/photo/young-woman-buying-a-golden-diamond-necklace.jpg?s=612x612&w=0&k=20&c=mNHkWrtOzPrApSxO9d6E07JhlUCOj1NuHUB84lnN2MQ=" class="girl img-responsive" alt="" />
								</div>
							</div>
							
						</div>
						
						<a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
							<i class="fa fa-angle-left"></i>
						</a>
						<a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
							<i class="fa fa-angle-right"></i>
						</a>
					</div>
					
				</div>
			</div>
		</div>
	</section><!--/slider-->
	<br>
	<br>
	<section>
		<div class="container-fluid">
			<div class="row">
				@yield('home')
				@yield('content')
			</div>
		</div>
	</section>
	
	<footer id="footer"><!--Footer-->
		
		<div class="footer-widget">
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
				</div>	
			</div>
		</div>
		
		<div class="footer-bottom"> 
			<div class="container">
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