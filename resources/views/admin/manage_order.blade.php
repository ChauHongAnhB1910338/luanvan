@extends('admin_layout')
@section('admin_content')    
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Tất cả đơn hàng
    </div>
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light " id="myTable">
        <thead>
          <tr>
            <th>STT</th>
            <th>Mã đơn hàng</th>
            <th>Ngày đặt hàng</th>
            <th>Tình trạng</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $i = 0;
          ?>
          @foreach($order as $key => $ord)
          @php
            $i++;
          @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{ $ord->order_code }}</td>
            <td>{{ $ord->created_at }}</td>
            <td>
              @if ($ord->order_status == 1)
                <span style="color: green">Đơn hàng mới</span>
              @elseif ($ord->order_status == 2 || $ord->order_status == 3)
                <span style="color: blue">Đã hoàn thành</span>
              @else
                <span style="color: darkorange">Đang xử lý</span>
              @endif
            </td>
            <td>
              <a href="{{URL::to('/view-order/'.$ord->order_code)}}" class="active" ui-toggle-class="">
                <i class="fa fa-eye text-success text-active"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>
@endsection