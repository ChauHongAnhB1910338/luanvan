@extends('admin_layout')
@section('admin_content')    
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Quản lý tài khoản khách hàng
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
            <th>Tên khách hàng</th>
            <th>Email</th>
            <th>Số điện thoại</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
              $count = 0;
          @endphp
          @foreach($all_customer as $key => $cus)
          @php
              $count++;
          @endphp
          <tr>
            <td>{{$count}}</td>
            <td>{{ $cus->customer_name }}</td>
            <td>{{ $cus->customer_email }}</td>
            <td>{{ $cus->customer_phone }}</td>
            <td>
              <a href="{{URL::to('/edit-customer/'.$cus->customer_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil text-success text-active"></i>
              </a>
              <a onclick="return confirm('Bạn có chắc muốn xóa tài khoản này?')" href="{{URL::to('/delete-customer/'.$cus->customer_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
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