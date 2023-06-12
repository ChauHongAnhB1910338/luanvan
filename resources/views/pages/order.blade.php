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
                        <td>Mã đơn hàng</td>
                        <td>Ngày đặt hàng</td>
                        <td>Tình trạng</td>
                        <td>Xem chi tiết</td>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $count=0;
                    @endphp
                    @foreach ($ordercustomer as $cus)
                    @php
                        $count++;
                    @endphp
                        <tr>
                            <td>
                                <h4>{{$count}}</h4>
                            </td>
                            <td>
                                <h4>{{ $cus->shipping_id }}</h4>
                            </td>
                            <td>
                                <h4>{{ $cus->order_date }}</h4>
                            </td>
                            <td>
                                @if ($cus->order_status == 1)
                                    <h4>Chưa xử lý</h4>
                                
                                @elseif($cus->order_status == 2)
                                    <h4>Đã giao hàng</h4>
                                
                                @else
                                    <h4>Đơn đã bị hủy</h4>
                                    
                                @endif
                                
                            </td>
                            <td>
                                <a href="{{URL::to('/view-order-customer/'.$cus->order_code)}}" class="active" ui-toggle-class="">
                                  <i class="fa fa-eye text-success text-active"></i>
                                </a>
                              </td>
                        </tr>
                    @endforeach
                    

                </tbody>
            </table>
        </div>
    </div>
</section> <!--/#cart_items-->
@endsection