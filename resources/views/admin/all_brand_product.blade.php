@extends('admin_layout')
@section('admin_content')    
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Tất cả thương hiệu sản phẩm
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
            <th>Tên thương hiệu</th>
            <th>Ẩn/Hiện</th>
            <th>Mô tả</th>
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @php
              $count = 0;
          @endphp
          @foreach($all_brand_product as $key => $brand_pro)
          @php
              $count++;
          @endphp
          <tr>
            <td>{{ $count }}</td>
            <td>{{ $brand_pro->brand_name }}</td>
            <td><span class="text-ellipsis">
            <?php 
              if ($brand_pro->brand_status==1){
            ?><a href="{{URL::to('/unactive-brand-product/'.$brand_pro->brand_id)}}"><span style="color: green" class="fa fa-thumbs-up"></span></a>
            <?php
              }else{
            ?>
              <a href="{{URL::to('/active-brand-product/'.$brand_pro->brand_id)}}"><span style="color: red" class="fa fa-thumbs-down"></span></a>
            <?php
             } 
            ?>
            </span></td>
            <td>{{ $brand_pro->brand_desc }}</td>
            <td>
              <a href="{{URL::to('/edit-brand-product/'.$brand_pro->brand_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil text-success text-active"></i>
              </a>
              <a onclick="return confirm('Bạn có chắc muốn xóa thương hiệu này?')" href="{{URL::to('/delete-brand-product/'.$brand_pro->brand_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-times text-danger text"></i>
              </a>
            </td>
          </tr>
          @endforeach
        </tbody>
      </table>
    </div>
    {{-- <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer> --}}
  </div>
</div>
@endsection