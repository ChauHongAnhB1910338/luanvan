@extends('layout')
@section('content')
<section id="cart_items">
    <div>
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
        </div>
        @if(session()->has('message'))
            <div class="alert alert-success">
                {!!session()->get('message')!!}
            </div>
          @elseif(session()->has('error'))
            <div class="alert alert-danger">
                {!!session()->get('error')!!}
            </div>
        @endif
        <div class="table-responsive cart_info">
            <form action="{{url('/update-cart')}}" method="POST">
                @csrf
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="name">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng đặt</td>
                        <td class="total">Thành tiền</td>
                        <td></td>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    @if(Session::get('cart')==true)
                    <?php 
                            $total = 0;
                    ?>
                    @foreach (Session::get('cart') as $key => $cart)
                        <?php 
                            $subtotal = $cart['product_price']*$cart['product_qty'];
                            $total+=$subtotal;
                        ?>
                    

                        <tr>
                            <td class="cart_product">
                                <img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
                            </td>
                            <td class="cart_description">
                                <p>{{$cart['product_name']}}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{number_format($cart['product_price'])}}đ</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                            
                                    <input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
                                    <input type="hidden" value="" name="rowId_cart" class="form-control">
                                    
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{number_format($subtotal)}}đ
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete" href="{{url('/del-product/'.$cart['session_id'])}}"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    @endforeach
                        <tr>
                            <td><input type="submit" value="Cập nhật giỏ hàng" name="update_qty" class="check_out btn btn-default btn-sm"></td>
                        </tr>
                        <td><a class="btn btn-default check_out" href="{{url('/del-all-product')}}">Xóa tất cả</a></td>
                        <td>
                            @if (Session::get('coupon'))
                                <a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã giảm giá</a>
                            @endif
                        </td>
                        <td colspan="2">
                             <li>Tổng: <span>{{number_format($total)}} VNĐ</span></li>
                            @if (Session::get('coupon'))
                            <li>
                                
                                    @foreach (Session::get('coupon') as $key => $cou)
                                        @if ($cou['coupon_condition']==1)
                                            Mã giảm giá: {{$cou['coupon_number']}}%
                                            <p>
                                                @php
                                                    $total_coupon = ($total*$cou['coupon_number'])/100;
                                                    echo '<p><li>Tổng giảm: '.number_format($total_coupon).' VNĐ </li></p>';
                                                @endphp
                                            </p>
                                            <p>
                                                <li>Tổng tiền phải trả: 
                                                    {{number_format($total-$total_coupon)}} VNĐ
                                                </li>
                                            </p>
                                        @else
                                            Mã giảm giá: {{$cou['coupon_number']}}VNĐ
                                            <p>
                                                @php
                                                    $total_coupon = ($total - $cou['coupon_number']);
                                                @endphp
                                            </p>
                                            <p><li>Tổng tiền phải trả: 
                                                {{number_format($total_coupon)}} VNĐ
                                            </li></p>
                                        @endif
                                    @endforeach
                                @else
                                    
                                
                            </li>
                            @endif
                            {{-- <li>Phí vận chuyển: <span>Free</span></li>
                            <li>Thành tiền: <span></span></li> --}}
                        </td>
                        
                        
                        <td>
                            <?php 
								$customer_id = Session::get('customer_id');
								if($customer_id!=NULL){
								?>
								<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
								<?php 
								}else{
								?>
								<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
								<?php
								}
							?>
                        </td>
                                                
                    @else
                    <tr>
                        <td colspan="5"><center>
                        @php
                            echo 'Chưa có sản phẩm trong giỏ hàng!';   
                        @endphp
                        </center>
                        </td>
                    </tr>
                    @endif
                </tbody>
            </table>
            </form>
            @if (Session::get('cart'))
                <tr>
                <td>
                
                <form action="{{url('/check-coupon')}}" method="POST">
                   @csrf 
                    <input type="text" name="coupon" class="form-control" placeholder="Nhập mã giảm giá"><br>
                    
                    <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
                </form>
                                    
                </td> 
            </tr>
            @endif
            
            
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection