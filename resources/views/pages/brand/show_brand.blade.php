@extends('layout')
@section('content')
<div class="features_items"><!--features_items-->
						@foreach ($brand_name as $key => $bra_name)
							<h2 class="title text-center">{{ $bra_name->brand_name }}</h2>
						@endforeach

						<div class="row">
							<div class="col-md-4">
								<label for="amount">Sắp xếp theo</label>
								<form>
									@csrf
									<select name="sort_by_type" id="sort_by_type" class="form-control">
										<option value="{{Request::url()}}?sort_by=none">Lọc theo kiểu</option>
										<option value="{{Request::url()}}?sort_by=kytu_az">Theo tên từ A-Z</option>
										<option value="{{Request::url()}}?sort_by=kytu_za">Theo tên từ Z-A</option>
										<option value="{{Request::url()}}?sort_by=tang_dan">Giá tăng dần</option>
										<option value="{{Request::url()}}?sort_by=giam_dan">Giá giảm dần</option>
									</select>
								</form>
							</div>

							<div class="col-md-4">
								<label for="amount">Sắp xếp theo giá</label>
								<form>
									@csrf
									<select name="sort_by_price" id="sort_by_price" class="form-control">
										<option value="{{Request::url()}}?sort_by=none">Lọc giá từ</option>
										<option value="{{Request::url()}}?sort_by=duoi200">Dưới 200k</option>
										<option value="{{Request::url()}}?sort_by=200_500">Trên 200k dưới 500k</option>
										<option value="{{Request::url()}}?sort_by=500_1000">Từ 500k tới 1 triệu</option>
										<option value="{{Request::url()}}?sort_by=tren1000">Trên 1 triệu</option>
									</select>
								</form>
							</div>
						</div>
						<br>
						@foreach ($brand_by_id as $key => $product)
							<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
							<div class="col-sm-4">
								<div class="product-image-wrapper">
									<div class="single-products">
										<div class="productinfo text-center">
											<form>
												@csrf
											<input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
											<input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
											<input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
											<input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
											<input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
											<input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
											<a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
											<img src="../public/uploads/product/{{ $product->product_image }}" alt="" />
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
							</a>
						@endforeach
						
						
					</div><!--features_items-->

@endsection