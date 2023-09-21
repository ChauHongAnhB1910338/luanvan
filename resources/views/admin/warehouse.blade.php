@extends('admin_layout')
@section('admin_content')    
<!-- Button trigger modal -->
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Tất cả sản phẩm
    </div>
                            <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
    {{-- <div class="row w3-res-tb">
      <div class="col-sm-5 m-b-xs">
        <select class="input-sm form-control w-sm inline v-middle">
          <option value="0">Bulk action</option>
          <option value="1">Delete selected</option>
          <option value="2">Bulk edit</option>
          <option value="3">Export</option>
        </select>
        <button class="btn btn-sm btn-default">Apply</button>                
      </div>
      <div class="col-sm-4">
      </div>
      <div class="col-sm-3">
        <div class="input-group">
          <input type="text" class="input-sm form-control" placeholder="Search">
          <span class="input-group-btn">
            <button class="btn btn-sm btn-default" type="button">Go!</button>
          </span>
        </div>
      </div>
    </div> --}}
    <div class="table-responsive">
      <table class="table table-striped b-t b-light" id="myTable">
        <thead>
          <tr>
            <th>STT</th>
            <th>Hình ảnh</th>
            <th>Tên sản phẩm</th>
            <th>Số lượng tồn kho</th>
            <th>Loại</th>
            <th>Giá trị mỗi sản phẩm</th>
            <th>Giá trị tồn kho</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
              $count = 0;
          @endphp
          @foreach($warehouse as $key => $pro)
          @php
              $count++;
          @endphp
          <tr>
            <td>{{ $count }}</td>
            <td><img src="public/uploads/product/{{ $pro->product_image }}" height="100" width="100"></td>
            <td>{{ $pro->product_name }}</td>
            <td>{{ $pro->product_quantity }}</td>
            <td>{{ $pro->category_name }}</td>
            <td>{{number_format($pro->price_cost)}}đ</td>
            <td>{{number_format($pro->price_cost * $pro->product_quantity)}}đ</td>
            <td>
              <a onclick="return confirm('Bạn có chắc muốn xóa sản phẩm này không?')" href="{{URL::to('/delete-product/'.$pro->product_id)}}" class="active" ui-toggle-class="">
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