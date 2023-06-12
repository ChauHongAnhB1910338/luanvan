@extends('admin_layout')
@section('admin_content')    
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Tất cả mã giảm giá
    </div>
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên mã giảm giá</th>
            <th>Mã code</th>
            <th>Số lượng</th>
            <th>Điều kiện</th>
            <th>Số tiền/% giảm</th>
            <th>Xóa mã</th>
          </tr>
        </thead>
        <tbody>
          @php
              $count=0;
          @endphp
          @foreach($coupon as $key => $cou)
          @php
              $count++;
          @endphp
          <tr>
            <td>{{ $count }}</td>
            <td>{{ $cou->coupon_name }}</td>
            <td>{{ $cou->coupon_code }}</td>
            <td>{{ $cou->coupon_time }}</td>
            <td><span class="text-ellipsis">
            <?php 
              if ($cou->coupon_condition==1){
            ?>
            Giảm theo %
            <?php
              }else{
            ?>
            Giảm theo tiền
            <?php
             } 
            ?>
            </span></td>
            <td><span class="text-ellipsis">
                <?php 
                  if ($cou->coupon_condition==1){
                ?>
                {{$cou->coupon_number}}%
                <?php
                  }else{
                ?>
                {{number_format($cou->coupon_number)}} VNĐ
                <?php
                 } 
                ?>
                </span></td>
            <td>
              
              <a onclick="return confirm('Bạn có chắc muốn xóa mã giảm giá này?')" href="{{URL::to('/delete-coupon/'.$cou->coupon_id)}}" class="active" ui-toggle-class="">
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