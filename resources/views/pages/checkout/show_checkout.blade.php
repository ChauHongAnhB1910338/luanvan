@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
              <li class="active">Thanh toán</li>
            </ol>
        </div>

        <div class="register-req">
            <p>Đăng ký hoặc đăng nhập để thanh toán</p>
        </div><!--/register-req-->

        <div class="review-payment">
            <h2>Kiểm tra lại đơn hàng</h2>
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
        @php
            $count_product = 0;
        @endphp
        <div class="table-responsive cart_info">
            <form action="{{url('/update-cart')}}" method="POST">
                @csrf
            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td class="image">Hình ảnh</td>
                        <td class="name">Tên sản phẩm</td>
                        <td class="price">Giá</td>
                        <td class="quantity">Số lượng</td>
                        <td class="total">Thành tiền</td>
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
                            $count_product++;
                            $subtotal = $cart['product_price']*$cart['product_qty'];
                            $total+=$subtotal;
                        ?>
                    

                        <tr>
                            <td class="cart_product">
                                <img src="{{asset('public/uploads/product/'.$cart['product_image'])}}" width="90" alt="{{$cart['product_name']}}" />
                            </td>
                            <td class="cart_description">
                                <h4><a href=""></a></h4>
                                <p>{{$cart['product_name']}}</p>
                            </td>
                            <td class="cart_price">
                                <p>{{number_format($cart['product_price'])}} VNĐ</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                            
                                    <input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart['session_id']}}]" value="{{$cart['product_qty']}}">
                                    <input type="hidden" value="" name="rowId_cart" class="form-control">
                                    
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">{{number_format($subtotal)}} VNĐ
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
                        <td></td>
                        <td>
                            <li>Tổng: <span>{{number_format($total)}} VNĐ</span></li>
                            <li>Phí vận chuyển: <span>{{number_format(Session::get('fee'))}} VNĐ</span>
                                @if(Session::get('fee'))
                                    <a class="feeship_delete" href="{{url('/del-fee')}}"><i class="fa fa-times"></i></a>
                                @endif
                            </li>
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
                                                    {{number_format($total-$total_coupon+Session::get('fee'))}} VNĐ
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
                                                {{number_format($total_coupon+Session::get('fee'))}} VNĐ
                                            </li></p>
                                        @endif
                                    @endforeach
                            @else
                                <p><li>Tổng tiền phải trả: 
                                    {{number_format($total+Session::get('fee'))}} VNĐ
                                </li></p>
                                
                            </li>
                            @endif
                            {{-- <li>Phí vận chuyển: <span>Free</span></li>
                            <li>Thành tiền: <span></span></li> --}}
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
                <style>
                    .table123 {
                        width: 100%;
                        border-collapse: collapse;
                    }
                
                    .table123 td {
                        padding: 20px;
                    }
                
                    .table123 .form-group {
                        margin-bottom: 10px;
                    }
                </style>
                        <table class="table123">
                            <tr>
                                <td>
                                    <form action="{{url('/check-coupon')}}" method="POST">
                                        @csrf 
                                        <input style="margin-right: 15px" type="text" name="coupon" class="form-control" placeholder="Nhập mã giảm giá"><br>
                                        <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
                                    </form>
                                </td>
                                <td>
                                    <h4>Chọn địa chỉ để tính phí vận chuyển</h4>
                                    <form>
                                        {{csrf_field()}}
                                        <div class="form-group">
                                            <label for="ex">Chọn thành phố</label>
                                            <select name="city" id="city" class="form-control input-sm m-bot15 choose city">
                                                <option value="">Chọn tỉnh thành phố</option>
                                                @foreach ($city as $key => $ci)
                                                    <option value="{{$ci->matp}}"> {{$ci->name_city}} </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="ex">Chọn quận huyện</label>
                                            <select name="province" id="province" class="form-control input-sm m-bot15 choose province">
                                                <option value="">--Chọn quận huyện--</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="ex">Chọn xã phường thị trấn</label>
                                            <select name="wards" id="wards" class="form-control input-sm m-bot15 wards">
                                                <option value="">--Chọn xã phường thị trấn--</option>
                                            </select>
                                        </div>
                                        <input type="button" class="btn btn-primary btn-sm calculate_delivery" name="calculate_order" value="Tính phí vận chuyển">
                                    </form>
                                </td>
                            </tr>
                        </table>
                        

            @endif
            
            
        </div>
        @if ($count_product!=0)
            <div class="shopper-informations">
            <div class="row">
                <div class="col-sm-8 clearfix">
                    <div class="bill-to">
                        <p>Thông tin người nhận</p>
                        <div class="form-one">
                            <form  method="POST">
                                @csrf
                                <input type="text" name="shipping_email" class="shipping_email" placeholder="Email*">
                                <input type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên">
                                <input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ cụ thể">
                                {{-- @if (Session::get('fee'))
                                    <input type="text" name="shipping_address" class="shipping_address" value="{{Session::get('name_city')}},{{Session::get('name_quanhuyen')}},{{Session::get('name_xaphuong')}}">
                                @else
                                    <input type="text" name="shipping_address" class="shipping_address" placeholder="Địa chỉ cụ thể">
                                @endif --}}
                                <input type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại">
                                <textarea name="shipping_notes" class="shipping_notes" placeholder="Ghi chú kèm theo" rows="5"></textarea>
                                @if (Session::get('fee'))
                                    <input type="hidden" name="feeship" class="feeship" value="{{Session::get('fee')}}">
                                @else
                                    <input type="hidden" name="feeship" class="feeship" value="30000">
                                @endif
                                @if (Session::get('coupon'))
                                    @foreach (Session::get('coupon') as $key => $cou)
                                        <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                                    @endforeach
                                    
                                @else
                                    <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                                @endif
                                <div class="">
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Chọn hình thức thanh toán</label>
                                        <select name="payment_select" class="form-control input-sm m-bot15 payment_select">
                                            <option value="0">ATM/Banking</option>
                                            <option value="1">Thanh toán khi nhận hàng</option>
                                        </select>
                                    </div>
                                </div>
                                <input type="button" value="Chấp nhận thanh toán" name="send_order" class="btn btn-primary btn-sm send_order">
                            </form>
                        </div>
                    </div>
                    
                </div>		
                <div class="col-sm-4">
                    <form action="{{url('/vnpay-payment')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$total+Session::get('fee')}}" name="total_vnpay" class="form-control">
                        <button type="submit" class="btn btn-default check_out vnpay_payment_button" name="redirect">Thanh toán VNPay</button>
                    </form>
                    
                    <form action="{{url('/momo-payment')}}" method="POST">
                        @csrf
                        <input type="hidden" value="{{$total+Session::get('fee')}}" name="total_momo" class="form-control">
                        <button type="submit" class="btn btn-default check_out momo_payment_button" name="payUrl">Thanh toán MOMO</button>
                    </form>    
                </div>		
            </div>
        </div>
        @else
            <div class="register-req">
                <p>Vui lòng thêm sản phẩm vào giỏ hàng để có thể đặt hàng!</p>
            </div><!--/register-req-->
        @endif
        
        
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var paymentSelect = document.querySelector('.payment_select');
                var momoPaymentButton = document.querySelector('.momo_payment_button');
                var vnpayPaymentButton = document.querySelector('.vnpay_payment_button');
        
                paymentSelect.addEventListener('change', function() {
                    if (paymentSelect.value === '0') {
                        momoPaymentButton.style.display = 'block';
                        vnpayPaymentButton.style.display = 'block';
                    } else {
                        momoPaymentButton.style.display = 'none';
                        vnpayPaymentButton.style.display = 'none';
                    }
                });
            });
        </script>
    </div>
</section> <!--/#cart_items-->
@endsection