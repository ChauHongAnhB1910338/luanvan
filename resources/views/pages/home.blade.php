@extends('layout')
@section('sld-home')
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
								<img src="{{ asset('public/frontend/images/Sale1.jpg') }}" class="girl img-responsive" alt="" />
							</div>
						</div>
						<div class="item">
							<div class="col-sm-6">
								<h1><span>AC</span>-SHOP</h1>
								<h2>Sản phẩm chất lượng</h2>
								<p>Cung cấp các sản phẩm tốt và an toàn cho mẹ và bé! </p>
							</div>
							<div class="col-sm-6">
								<img src="{{ asset('public/frontend/images/Sale2.png') }}" class="girl img-responsive" alt="" />
							</div>
						</div>
						
						<div class="item">
							<div class="col-sm-6">
								<h1><span>AC</span>-SHOP</h1>
								<h2>Thanh toán nhanh chóng</h2>
								<p>Quý khách hàng có thể lựa chọn các hình thức thanh toán khác nhau!</p>
							</div>
							<div class="col-sm-6">
								<img src="{{ asset('public/frontend/images/Sale3.png') }}" class="girl img-responsive" alt="" />
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
@endsection
@section('content')
		<div class="col-sm-12 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Sản phẩm mới</h2>
						@foreach ($newest_products as $key => $product)
							<div class="col-sm-3">
								<div class="product-image-wrapper">
									
									<div class="single-products">
											<div class="productinfo text-center">
												<form>
													@csrf
												<input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
												<input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
												<input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
												<input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
												<input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
												<input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
												<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
												<img src="public/uploads/product/{{ $product->product_image }}" alt="" />
												<h2>{{number_format($product->product_price)}} VNĐ</h2>
												<p>{{ $product->product_name }}</p>
												</a>
												{{-- <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a> --}}
												<button class="btn btn-default add-to-cart" type="button" data-id_product="{{$product->product_id}}" name="add-to-card" >Thêm vào giỏ hàng</button>
												</form>
											</div>
											
									</div>
									
								</div>
							</div>
						@endforeach
						
						
					</div><!--features_items-->
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Sản phẩm nổi bật</h2>
						@foreach ($most_viewed_products as $key => $most_viewed)
							{{-- @if ($product->product_id%2==0) --}}
								<div class="col-sm-3">
									<div class="product-image-wrapper">
										<div class="single-products">
												<div class="productinfo text-center">
													<form>
														@csrf
													<input type="hidden" value="{{$most_viewed->product_id}}" class="cart_product_id_{{$most_viewed->product_id}}">
													<input type="hidden" value="{{$most_viewed->product_name}}" class="cart_product_name_{{$most_viewed->product_id}}">
													<input type="hidden" value="{{$most_viewed->product_image}}" class="cart_product_image_{{$most_viewed->product_id}}">
													<input type="hidden" value="{{$most_viewed->product_quantity}}" class="cart_product_quantity_{{$most_viewed->product_id}}">
													<input type="hidden" value="{{$most_viewed->product_price}}" class="cart_product_price_{{$most_viewed->product_id}}">
													<input type="hidden" value="1" class="cart_product_qty_{{$most_viewed->product_id}}">
													<a href="{{URL::to('/chi-tiet-san-pham/'.$most_viewed->product_id)}}">
													<img src="public/uploads/product/{{ $most_viewed->product_image }}" alt="" />
													<h2>{{number_format($most_viewed->product_price)}} VNĐ</h2>
													<p>{{ $most_viewed->product_name }}</p>
													</a>
													{{-- <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a> --}}
													<button class="btn btn-default add-to-cart" type="button" data-id_product="{{$most_viewed->product_id}}" name="add-to-card" >Thêm vào giỏ hàng</button>
													</form>
												</div>
												
										</div>
									</div>
								</div>
							{{-- @endif --}}
						@endforeach
						
						
					</div><!--features_items-->
		</div>
@endsection