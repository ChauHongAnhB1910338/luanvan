@extends('admin_layout')
@section('admin_content')    
@php
    $tong = 0;
@endphp
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Thông tin người mua hàng
    </div>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
            <th>Tên khách hàng</th>
            <th>Số điện thoại</th>
            <th>Email</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>

          <tr>
            <td>{{$customer->customer_name}}</td>
            <td>{{$customer->customer_phone}}</td>
            <td>{{$customer->customer_email}}</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</div>
<br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông tin vận chuyển
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>Tên người nhận</th>
              <th>Địa chỉ</th>
              <th>Số điện thoại</th>
              <th>Email</th>
              <th>Ghi chú</th>
              <th>Hình thức thanh toán</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
  
            <tr>
              <td>{{$shipping->shipping_name}}</td>
              <td>{{$shipping->shipping_address}}</td>
              <td>{{$shipping->shipping_phone}}</td>
              <td>{{$shipping->shipping_email}}</td>
              <td>{{$shipping->shipping_notes}}</td>
              <td>
                @if ($shipping->shipping_method==0)
                    Chuyển khoản
                @else 
                    Thanh toán khi nhận hàng
                @endif
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
<br>
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Chi tiết đơn hàng 
      </div>
                              <?php
                                  $message = Session::get('message');
                                  if($message){
                                      echo '<span class="text-alert">'.$message.'</span>';
                                      Session::put('message',null);
                                  }
                              ?>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th style="width:20px;">
                STT
              </th>
              <th>Tên sản phẩm</th>
              <th>Số lượng trong kho</th>
              <th>Số lượng đặt</th>
              <th>Giá bán</th>
              <th>Giá gốc</th>
              <th>Mã giảm giá</th>
              <th>Phí vận chuyển</th>
              <th>Tổng tiền</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @php
                $i = 0;
                $total = 0;
            @endphp
          @foreach ($order_details as $key => $details)
            @php
                $i++;
                $subtotal = $details->product_price*$details->product_sales_quantity;
                $total+=$subtotal;
            @endphp    
          <tr class="color_qty_{{$details->product_id}}">
                
              <td><i>{{$i}}</i></td>
              <td>{{$details->product_name}}</td>
              <td>{{$details->product->product_quantity}}</td>
              <td>
                <input type="number" min="1" {{$order_status==2 || $order_status==3 ? 'disabled' : ''}} class="order_qty_{{$details->product_id}}" value="{{$details->product_sales_quantity}}" name="product_sales_quantity">
                <input type="hidden" name="order_qty_storage" class="order_qty_storage_{{$details->product_id}}" value="{{$details->product->product_quantity}}">
                <input type="hidden" name="order_code" class="order_code" value="{{$details->order_code}}">
                <input type="hidden" name="order_product_id" class="order_product_id" value="{{$details->product_id}}">
                @if ($order_status==1)
                 <button class="btn btn-default update_quantity_order" data-product_id="{{$details->product_id}}" name="update_quantity_order" >Cập nhật</button>
   
                @endif
              </td>
              <td>{{number_format($details->product_price)}} VNĐ</td>
              <td>{{number_format($details->product->price_cost)}} VNĐ</td>
              <td>
                @if ($details->product_coupon!='no')
                    {{$details->product_coupon}}
                @else
                    Không sử dụng
                @endif
              </td>
              <td>{{number_format($details->product_feeship)}} VNĐ</td>
              <td>{{number_format($subtotal)}} VNĐ</td>
              @php
                  $tong+=$subtotal;
              @endphp
            </tr>
          @endforeach
            <tr>
              <td colspan="5">
                Tổng giá trị đơn hàng: {{number_format($tong)}} VNĐ 
                <br>
                  
                 {{-- {{number_format($total)}} VNĐ  --}}
                 @php
                     $total_coupon = 0;
                 @endphp
                @if ($coupon_condition == 1)
                  @php
                      $total_after_coupon = ($total*$coupon_number)/100;
                      echo 'Tổng giảm: ' .number_format($total_after_coupon).' VNĐ';
                      $total_coupon = $total - $total_after_coupon;
                  @endphp
                    
                @else
                    @php
                      echo 'Tổng giảm: ' .number_format($coupon_number).' VNĐ';
                        $total_coupon = ($total-$coupon_number);
                    @endphp
                @endif
                <br>
                Phí vận chuyển: {{number_format($details->product_feeship)}} VNĐ

                <br>
                Tổng thanh toán: {{number_format($total_coupon+$details->product_feeship)}} VNĐ 
              </td>
            </tr>
            <tr>
              <td colspan="6">
                @foreach ($order as $key => $or)
                    @if ($or->order_status == 1)
                        <form >
                          @csrf
                          <select class="form-control order_details">
                            <option id="{{$or->order_id}}" selected value="1">Chưa xử lý</option>
                            <option id="{{$or->order_id}}" value="2">Đã xử lý/Đã giao</option>
                            <option id="{{$or->order_id}}" value="3">Hủy đơn</option>
                          </select>
                        </form>
                    @elseif($or->order_status == 2)
                      <form >
                        @csrf
                        <input id="{{$or->order_id}}" disabled selected value="Đã giao hàng">
                      </form>
                    @else
                    <form >
                      @csrf
                        <input id="{{$or->order_id}}" disabled selected value="Đã hủy đơn">
                    </form>
                    @endif
                @endforeach
                
                
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection