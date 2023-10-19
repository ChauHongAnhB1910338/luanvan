@extends('layout')
@section('content')
<section id="cart_items">
    <div class="container">
        <div class="breadcrumbs">
            <ol class="breadcrumb">
              <li><a href="{{URL::to('/')}}">Trang chủ</a></li>
              <li class="active">Giỏ hàng</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">

            <table class="table table-condensed">
                <thead>
                    <tr class="cart_menu">
                        <td>STT</td>
                        <td>Tên sản phẩm</td>
                        <td>Hình ảnh</td>
                        <td>Số lượng đặt</td>
                        <td>Đơn giá</td>
                        <td>Tổng giá</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count=0;
                        $final_total=0;
                        $discount=0;
                    @endphp
                    @foreach ($ordercustomer as $cus)
                    @php
                        $total = $cus->product_sales_quantity*$cus->product_price;
                        $count++;
                        $final_total+=$total;
                    @endphp
                        <tr>
                            <td>
                                <h4>{{$count}}</h4>
                            </td>
                            <td>
                                <h4>{{ $cus->product_name }}</h4>
                            </td>
                            <td>
                                <img style="height:50px" src="../public/uploads/product/{{ $cus->product_image }}" alt="" />
                            </td>
                            <td>
                                {{$cus->product_sales_quantity}}
                            </td>
                            <td>{{number_format($cus->product_price)}}đ</td>
                            <td>
                                {{number_format($total)}}đ
                            </td>
                        </tr>
                    @endforeach
                    

                </tbody>
            </table>
            <hr>
            <div class="text-center">
                <h4>Tổng hóa đơn: {{number_format($final_total)}}đ</h4>
            </div>
            @if ($cus->coupon_condition==1)
                @php
                    $discount=($final_total*$cus->coupon_number)/100;
                @endphp
            @else
                @php
                    $discount=$final_total-$cus->coupon_number;
                @endphp
            @endif
            @php
                if ($cus->product_coupon=='no')
                    $discount=0
            @endphp
            
            <div class="text-center">
                <h4>Tổng số tiền được giảm: {{number_format($discount)}}đ</h4>
            </div>
            <div class="text-center">
                <h4>Phí vận chuyển: {{number_format($cus->product_feeship)}}đ</h4>
            </div>
            <div class="text-center">
                <h4>Tổng số tiền thanh toán: {{number_format($final_total-$discount+$cus->product_feeship)}}đ</h4>
            </div>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection