@extends('layout')
@section('home')
<div class="col-sm-3">
	<div class="left-sidebar">
		<h2>Danh mục sản phẩm</h2>
		<div class="panel-group category-products" id="accordian"><!--category-productsr-->
			@foreach ($category as $key => $cate)
				<div class="panel panel-default">
					<div class="panel-heading">
						<h4 class="panel-title"><a href="{{URL::to('/danh-muc-san-pham/'.$cate->category_id)}}">{{$cate->category_name}}</a></h4>
					</div>
				</div>
			@endforeach
			
		</div><!--/category-products-->
	
		<div class="brands_products"><!--brands_products-->
			<h2>Thương hiệu	</h2>
			<div class="brands-name">
				@foreach ($brand as $key => $brand)
				<ul class="nav nav-pills nav-stacked">
					<li><a href="{{URL::to('/thuong-hieu-san-pham/'.$brand->brand_id)}}">{{$brand->brand_name}}</a></li>
				</ul>
				@endforeach
			</div>
		</div><!--/brands_products-->
		
	
	</div>
</div>
@endsection
@section('content')
		<div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Sản phẩm mới</h2>
						@foreach ($all_product as $key => $product)
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
									
									<div class="choose">
										<ul class="nav nav-pills nav-justified">
											<li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
											<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
										</ul>
									</div>
								</div>
							</div>
						@endforeach
						
						
					</div><!--features_items-->
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Sản phẩm nổi bật</h2>
						@foreach ($all_product as $key => $product)
							@if ($product->product_id%2==0)
								<div class="col-sm-6">
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
										
										<div class="choose">
											<ul class="nav nav-pills nav-justified">
												<li><a href="#"><i class="fa fa-plus-square"></i>Yêu thích</a></li>
												<li><a href="#"><i class="fa fa-plus-square"></i>So sánh</a></li>
											</ul>
										</div>
									</div>
								</div>
							@endif
						@endforeach
						
						
					</div><!--features_items-->
		</div>
@endsection