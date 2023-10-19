@extends('admin_layout')
@section('admin_content')    
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
            <th>Tên sản phẩm</th>
            <th>Số lượng</th>
            <th>Thư viện ảnh</th>
            <th>Danh mục</th>
            <th>Thương hiệu</th>
            <th>Giá bán</th>
            <th>Giá gốc</th>
            <th>Ẩn/Hiện</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
              $count = 0;
          @endphp
          @foreach($all_product as $key => $pro)
          @php
              $count++;
          @endphp
          <tr>
            <td>{{ $count }}</td>
            <td>{{ $pro->product_name }}</td>
            <td>{{ $pro->product_quantity }}</td>
            <td><a href="{{URL::to('/add-gallery/'.$pro->product_id)}}">Xem ảnh</a></td>
            <td>{{ $pro->category_name }}</td>
            <td>{{ $pro->brand_name }}</td>
            <td>{{number_format($pro->product_price)}}đ</td>
            <td>{{number_format($pro->price_cost)}}đ</td>
            <td><span class="text-ellipsis">
            <?php 
              if ($pro->product_status==1){
            ?><a href="{{URL::to('/unactive-product/'.$pro->product_id)}}"><span style="color: green" class="fa fa-thumbs-up"></span></a>
            <?php
              }else{
            ?>
              <a href="{{URL::to('/active-product/'.$pro->product_id)}}"><span style="color: red" class="fa fa-thumbs-down"></span></a>
            <?php
             } 
            ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-product/'.$pro->product_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil text-success text-active"></i>
              </a>
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