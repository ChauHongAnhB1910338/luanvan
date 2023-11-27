@extends('admin_layout')
@section('admin_content')    
@php
    $tong = 0;
@endphp
<div class="table-agile-info">
    <div class="panel panel-default">
      <div class="panel-heading">
        Thông tin nhập hàng
      </div>
      <div class="table-responsive">
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>ID Admin</th>
              <th>Ngày nhập</th>
              <th>Ghi chú</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
  
            <tr>
              <td>{{$admin_id}}</td>
              <td>{{$warehouse_date}}</td>
              <td>{{$warehouse_notes}}</td>
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
              <th>Số lượng</th>
              <th>Giá nhập</th>
              <th>Tổng tiền</th>
              <th style="width:30px;"></th>
            </tr>
          </thead>
          <tbody>
            @php
                $i = 0;
                $total = 0;
            @endphp
          @foreach ($warehouse_details as $key => $details)
            @php
                $i++;
                $subtotal = $details->product_price*$details->product_quantity;
                $total+=$subtotal;
            @endphp    
          <tr class="color_qty_{{$details->product_id}}">
                
              <td><i>{{$i}}</i></td>
              <td>{{$details->product_name}}</td>
              <td>{{$details->product_quantity}}</td>
              <td>{{number_format($details->product_price)}} VNĐ</td>
              <td>{{number_format($details->product_total)}} VNĐ</td>
              @php
                  $tong+=$subtotal;
              @endphp
            </tr>
          @endforeach
            <tr>
              <td colspan="5">
                Tổng giá trị đơn nhập: {{number_format($tong)}} VNĐ 
              </td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </div>
@endsection