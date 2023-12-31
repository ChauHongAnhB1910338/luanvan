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
	<link href="{{asset('public/frontend/css/lightgallery.min.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/lightslider.css')}}" rel="stylesheet">
	<link href="{{asset('public/frontend/css/prettify.css')}}" rel="stylesheet">
    <!--[if lt IE 9]>
    <script src="js/html5shiv.js"></script>
    <script src="js/respond.min.js"></script>
    <![endif]-->       
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{asset('images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{asset('images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{asset('images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{asset('images/ico/apple-touch-icon-57-precomposed.png')}}">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/themes/base/jquery-ui.min.css">

	<script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>

	<style>
        .image-list-brand {
            display: flex;
            overflow-x: auto;
            scroll-behavior: smooth;
        }

        .image-list-brand img {
            width: 150px;
            height: auto;
            margin-right: 10px;
        }
    </style>

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
								<li><a href="{{URL::to('/account-details/'.$customer_id)}}"><i class="fa fa-lock"></i> Tài khoản</a></li>
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
						<a href="{{ URL::to('/trangchu') }}" class="active">
							<img style="height: 82px; padding-top: 7px" src="{{ asset('public/frontend/images/logo.jpg') }}" alt="">
						</a>
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

					
					{{-- <div class="panel-group text-center category-products" id="accordian"><!--brands_products-->
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
					</div><!--/brands_products--> --}}
					
				
				</div>
			</div>
			<div class="col-md-9 col-sm-9">
				@yield('content')
			</div>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<div class="image-list-brand">
					@foreach($brand as $key => $brand)
						<a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}">
							<img src="{{ asset('public/uploads/brand/' . $brand->brand_image) }}" alt="{{ $brand->brand_name }}">
						</a>
					@endforeach
				</div>
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
	<script src="{{asset('public/frontend/js/lightgallery-all.min.js')}}"></script>
	<script src="{{asset('public/frontend/js/lightslider.js')}}"></script>
	<script src="{{asset('public/frontend/js/prettify.js')}}"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
	{{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script> --}}

	{{-- <script>
        // Tự động chạy danh sách hình ảnh
        var imageList = document.querySelector('.image-list-brand');
        var images = imageList.querySelectorAll('img');
        var currentIndex = 0;
        var interval = setInterval(function() {
            currentIndex = (currentIndex + 1) % images.length;
            images[currentIndex].scrollIntoView({ behavior: 'smooth', inline: 'center' });
        }, 3000);

        // Ngừng tự động chạy khi người dùng tương tác
        imageList.addEventListener('mouseover', function() {
            clearInterval(interval);
        });

        // Tiếp tục tự động chạy khi người dùng không tương tác
        imageList.addEventListener('mouseout', function() {
            interval = setInterval(function() {
                currentIndex = (currentIndex + 1) % images.length;
                images[currentIndex].scrollIntoView({ behavior: 'smooth', inline: 'center' });
            }, 3000);
        });
    </script> --}}

	<script>
		$(document).ready(function() {
			$( "#slider-range" ).slider({
				orientation: "horizontal",
				range: true,
				values: [ 17, 67 ],
				slide: function( event, ui ) {
					$( "#amount" ).val( "đ" + ui.values[ 0 ] + " - đ" + ui.values[ 1 ] );
					$( "#start_price" ).val(ui.values[ 0 ] );
					$( "#end_price" ).val( ui.values[ 1 ]);
				}
			});

			$( "#amount" ).val( "đ" + $( "#slider-range" ).slider( "values", 0 ) +
				" - đ" + $( "#slider-range" ).slider( "values", 1 ) ); 
		});
	</script>

	{{-- Đường dẫn lọc sản phẩm theo kiểu --}}
	<script>
		$(document).ready(function() {
			$('#sort_by_type').on('change',function(){
				var url = $(this).val();
				if(url){
					window.location = url;
				}
				return false;
			});  
		});
	</script>

	{{-- Đường dẫn lọc sản phẩm theo giá --}}
	<script>
		$(document).ready(function() {
			$('#sort_by_price').on('change',function(){
				var url = $(this).val();
				if(url){
					window.location = url;
				}
				return false;
			});  
		});
	</script>

	<script>
		$(document).ready(function() {
			$('#imageGallery').lightSlider({
				gallery:true,
				item:1,
				loop:true,
				thumbItem:3,
				slideMargin:0,
				enableDrag: false,
				currentPagerPosition:'left',
				onSliderLoad: function(el) {
					el.lightGallery({
						selector: '#imageGallery .lslide'
					});
				}   
			});  
		});
	</script>

	<script type="text/javascript">
		function remove_background(product_id){
			for(var count=1; count <= 5; count++)
			{	
				$('#'+product_id+'-'+count).css('color', '#ccc');
			}
		}
		
		$(document).on('mouseenter','.rating',function(){
			var index = $(this).data("index");
			var product_id = $(this).data('product_id');
			var customer_id = $(this).data('customer_id');
			
			remove_background(product_id);
			
			for(var count=1; count <= index; count++){
				$('#'+product_id+'-'+count).css('color', '#ffcc00');
			}
		});

		$(document).on('mouseleave','.rating',function(){
			var index = $(this).data("index");
			var product_id = $(this).data('product_id');
			var customer_id = $(this).data('customer_id');
			var rating = $(this).data('rating');
			remove_background(product_id);
			
			for(var count=1; count <= rating; count++){
				$('#'+product_id+'-'+count).css('color', '#ffcc00');
			}
		});

		$(document).on('click','.rating',function(){
			var index = $(this).data("index");
			var product_id = $(this).data('product_id');
			var customer_id = $(this).data('customer_id');
			var _token = $('input[name="_token"]').val();
			remove_background(product_id);
			
			$.ajax({
				url: "{{url('/insert-rating')}}",
				method: 'POST',
				data: {index:index,product_id:product_id,customer_id:customer_id,_token:_token},
				success:function(data){
					if(data == 'done'){
						alert("Bạn đã đánh giá sản phẩm này: "+index+"sao");
					}else if(data = 'change'){
						alert("Bạn đã thay đổi đánh giá sản phẩm này thành: "+index+"sao");
					}else{
						alert("Có lỗi xảy ra, vui lòng thử lại sau!");
					}
					window.setTimeout(function(){
						location.reload();
					}, 1000);
				}
			});
		});
	</script>
	
	<script>
		$(document).ready(function(){
			load_comment();
			function load_comment(){
				var product_id = $('.comment_product_id').val();
				var _token = $('input[name="_token"]').val();

				$.ajax({
					url: "{{url('/load-comment')}}",
					method: 'POST',
					data: {product_id:product_id,_token:_token},
					success:function(data){
						$('#comment_show').html(data);
					}
				});
			}
			$('.send-comment').click(function(){
				var product_id = $('.comment_product_id').val();
				var comment_name = $('.comment_name').val();
				var comment_content = $('.comment_content').val();
				var _token = $('input[name="_token"]').val();
				$.ajax({
					url: "{{url('/send-comment')}}",
					method: 'POST',
					data: {product_id:product_id,comment_name:comment_name,comment_content:comment_content,_token:_token},
					success:function(data){
						load_comment();
						$('#notify_comment').fadeOut(2000);
						$('.comment_name').val('');
						$('.comment_content').val('');
					}
				});
			});
		});
	</script>
   
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
						var feeship = $('.feeship' ).val().trim();
						var _token = $('input[name="_token"]').val().trim();
						// Kiểm tra các giá trị nhập liệu có hợp lệ không
						if (shipping_name == "" || shipping_email == "" || shipping_address == "" || shipping_phone == "" || shipping_notes == "" || shipping_method == "" || feeship == "") {
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
							'feeship': feeship,
							'_token': _token},
						});
						// console.log(feeship);
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
					alert('Sản phẩm này đã hết hàng!');
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
	<script>
		$(document).ready(function(){
			$('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            // alert(action);
            // alert(matp );
            // alert(_token);
            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url: "{{url('/select-delivery-home')}}",
                method: 'POST',
                data: {action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                    $('#'+result).html(data);
                }
            });
        	});
		});
	</script>
	<script type="text/javascript"> 
		$(document).ready(function(){
			$('.calculate_delivery').click(function(){
				var matp = $('.city').val();
				var maqh = $('.province').val();
				var xaid = $('.wards').val();
				var _token = $('input[name="_token"]').val();
				// alert(matp);
				// alert(maqh);
				// alert(xaid);
				// alert(_token);
				if(matp == '' || maqh == '' || xaid == ''){
					alert('Làm ơn chọn để tính phí vận chuyển');
				}else{
					$.ajax({
						url: "{{url('/calculate-fee')}}",
						method: 'POST',
						data:{matp:matp,maqh:maqh,xaid:xaid,_token:_token},
						success:function(data){
							location.reload();
						}
					});
				}
			});
		});
	</script>
	<script type="text/javascript">
		(function(d, m){
			var kommunicateSettings = 
				{"appId":"fe42c738d29fa48c2a860a51e265a6a9","popupWidget":true,"automaticChatOpenOnNavigation":true};
			var s = document.createElement("script"); s.type = "text/javascript"; s.async = true;
			s.src = "https://widget.kommunicate.io/v2/kommunicate.app";
			var h = document.getElementsByTagName("head")[0]; h.appendChild(s);
			window.kommunicate = m; m._globals = kommunicateSettings;
		})(document, window.kommunicate || {});
	/* NOTE : Use web server to view HTML files as real-time update will not work if you directly open the HTML file in the browser. */
	</script>
</body>
</html>