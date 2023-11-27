@extends('admin_layout')
@section('admin_content')    
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Tất cả phiếu nhập kho
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
            <th>Mã phiếu nhập</th>
            <th>Ngày nhập</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          <?php 
            $i = 0;
          ?>
          @foreach($warehouse as $key => $ware)
          @php
            $i++;
          @endphp
          <tr>
            <td>{{$i}}</td>
            <td>{{ $ware->warehouse_code }}</td>
            <td>{{ $ware->warehouse_date }}</td>
            <td>
              <a href="{{URL::to('/view-warehouse/'.$ware->warehouse_code)}}" class="active" ui-toggle-class="">
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