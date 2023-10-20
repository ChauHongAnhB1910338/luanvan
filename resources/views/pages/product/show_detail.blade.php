@extends('layout')
@section('content')
<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="{{URL::to('/')}}">Trang chủ</a></li>
      <li class="breadcrumb-item"><a href="{{URL::to('/danh-muc-san-pham').'/'.$product_cate_id}}">{{$product_cate_name}}</a></li>
      <li class="breadcrumb-item active" aria-current="page">{{$product_name}}</li>
    </ol>
  </nav>
<style>
    .lSSlideOuter .lSPager.lSGallery img {
        display: block;
        height: 140px;
        max-width: 100%;
    }
    li.active{
        border: 2px solid #d1350a;
    }
</style>
@foreach ($product_details as $key => $product)
    <div class="product-details"><!--product-details-->
        <div class="col-sm-5">
            <ul id="imageGallery">
                @foreach ($gallery as $gal)
                    <li data-thumb="{{URL::to('/public/uploads/gallery/'.$gal->gallery_image)}}" data-src="{{URL::to('/public/uploads/gallery/'.$gal->gallery_image)}}">
                        <img width="100%" alt="{{$gal->gallery_name}}" src="{{URL::to('/public/uploads/gallery/'.$gal->gallery_image)}}" />
                    </li>        
                @endforeach
              </ul>

        </div>
        <div class="col-sm-7">
            <div class="product-information"><!--/product-information-->
                <img src="{{URL::to('/public/frontend/images/new.jpg')}}" class="newarrival" alt="" />
                <h2>{{$product->product_name}}</h2>
                <p>ID: {{$product->product_id}}</p>
                <img src="{{URL::to('/public/frontend/images/rating.png')}}" alt="" />
                
                <form>
                    @csrf
                <input type="hidden" value="{{$product->product_id}}" class="cart_product_id_{{$product->product_id}}">
                <input type="hidden" value="{{$product->product_name}}" class="cart_product_name_{{$product->product_id}}">
                <input type="hidden" value="{{$product->product_image}}" class="cart_product_image_{{$product->product_id}}">
                <input type="hidden" value="{{$product->product_price}}" class="cart_product_price_{{$product->product_id}}">
                <input type="hidden" value="{{$product->product_quantity}}" class="cart_product_quantity_{{$product->product_id}}">
                <input type="hidden" value="1" class="cart_product_qty_{{$product->product_id}}">
                <a href="{{URL::to('/chi-tiet-san-pham/'.$product->product_id)}}">
                <img src="public/uploads/product/{{ $product->product_image }}" alt="" />
                <h2>{{number_format($product->product_price)}} VNĐ</h2>
                <p>{{ $product->product_name }}</p>
                <p>Số lượng trong kho còn: {{ $product->product_quantity }}</p>
                </a>
                {{-- <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a> --}}
                <button class="btn btn-default add-to-cart" type="button" data-id_product="{{$product->product_id}}" name="add-to-card" >Thêm vào giỏ hàng</button>
                </form>
                <p><b>Trạng thái:</b> Còn hàng</p>
                <p><b>Điều kiện:</b> Mới 100%</p>
                <p><b>Thương hiệu:</b> {{$product->brand_name}}</p>
                <p><b>Danh mục:</b> {{$product->category_name}}</p>
                <a href=""><img src="{{URL::to('/public/frontend/images/share.png')}}" class="share img-responsive"  alt="" /></a>
            </div><!--/product-information-->
        </div>
    </div><!---->


<div class="category-tab shop-details-tab"><!--category-tab-->
    <div class="col-sm-12">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
            <li><a href="#companyprofile" data-toggle="tab">Chi tiết</a></li>
            <li ><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
        </ul>
    </div>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="details" >
            <p>{!!$product->product_desc!!}</p>
        </div>
        
        <div class="tab-pane fade" id="companyprofile" >
            <p>{!!$product->product_content!!}</p>
        </div>
        
        
        <div class="tab-pane fade" id="reviews" >
            <div class="col-sm-12">
                <ul>
                    <li><a href=""><i class="fa fa-user"></i>User</a></li>
                    <li><a href=""><i class="fa fa-clock-o"></i>12:41 AM</a></li>
                    <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                </ul>
                <style>
                    .row.style_comment{
                        border: 1px solid #ddd;
                        border-radius: 10px;
                        background: #f0f0e9;
                    }
                </style>
                <form>
                    @csrf
                    <input type="hidden" name="comment_product_id" class="comment_product_id" value="{{$product->product_id}}"> 
                    <div id="comment_show"></div>
                    
                </form>
                
                
            </div>
            <div class="col-md-12" style="padding-top: 10px">
                <form action="#">
                    <span>
                        <input style="width: 100%; margin-left: 0" type="text" class="comment_name" placeholder="Tên của bạn"/>
                    </span>
                    <textarea name="comment" class="comment_content" placeholder="Nhập bình luận"></textarea>
                    <div id="notify_comment"></div>
                    <ul class="list-inline" title="Average Rating">
                        @for ($count=1; $count <= 5; $count++)
                            @php
                                if ($count <= $rating) {
                                    $color = 'color:#ffcc00;';
                                } else {
                                    $color = 'color:#ccc;';
                                }
                                
                            @endphp
                            <li title="Đánh giá sao" id="{{$product->product_id}}-{{$count}}" data-index="{{$count}}" data-product_id="{{$product->product_id}}" data-rating="{{$rating}}" class="rating" style="cursor: pointer;{{$color}};font-size:30px">&#9733;</li>
                        @endfor
                    </ul>
                    <button type="button" class="btn btn-default pull-right send-comment">
                        Đăng bình luận
                    </button>
                </form>
            </div>
        </div>
        
    </div>
</div><!--/category-tab-->
@endforeach
<div class="recommended_items"><!--recommended_items-->
    <h2 class="title text-center">Sản phẩm liên quan</h2>
    
    <div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="item active">	
                @foreach ($relate as $key => $lienquan)
                    <div class="col-sm-4">
                        <div class="product-image-wrapper">
                            <div class="single-products">
                                <div class="productinfo text-center">
                                    <img src="{{URL::to('public/uploads/product/'.$lienquan->product_image)}}" alt="" />
                                    <h2>{{number_format($lienquan->product_price)}} VNĐ</h2>
                                    <p>{{ $lienquan->product_name }}</p>
                                </div>
                        </div>
                        </div>
                    </div>
                @endforeach
                
                
            </div>
            
        </div>
         <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
            <i class="fa fa-angle-left"></i>
          </a>
          <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
            <i class="fa fa-angle-right"></i>
          </a>			
    </div>
</div><!--/recommended_items-->
@endsection