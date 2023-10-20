@extends('admin_layout')
@section('admin_content')    
<div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Tất cả bình luận
    </div>
    <div id="notify_comment">

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
            <th>Tên người comment</th>
            <th>Nội dung</th>
            <th>Sản phẩm</th>
            <th>Ngày bình luận</th>
            <th>Duyệt bình luận</th>
            <th>Quản lý</th>
          </tr>
        </thead>
        <tbody>
          @php
              $count = 0;
          @endphp
          @foreach($comment as $key => $comm)
          @php
              $count++;
          @endphp
          <tr>
            <td>{{ $count }}</td>
            <td>{{ $comm->comment_name }}</td>
            <td>{{ $comm->comment }}
            <style>
              ul.list_rep li{
                list-style-type: decimal;
                color: blue;
                margin: 5px 40px;
              }
            </style>
              <ul class="list_rep">
                @foreach ($comment_rep as $key => $comm_reply)
                  @if ($comm_reply->comment_parent_comment == $comm->comment_id)
                      <li>{{$comm_reply->comment}}</li>
                  @endif
                
                    
                @endforeach
              </ul>
                <?php 
                if ($comm->comment_status==1){
                ?>
                    <br> <textarea class="form-control reply_comment_{{$comm->comment_id}}" name="" id="" rows="5"></textarea>
                    <br> <button class="btn btn-default btn-xs btn-reply-comment" data-product_id="{{ $comm->comment_product_id }}" data-comment_id="{{$comm->comment_id}}" type="submit">Phản hồi</button>
                <?php
                } 
                ?>
                
            </td>
            <td>
                <a href="{{URL::to('/chi-tiet-san-pham/'.$comm->comment_product_id)}}" target="_blank">
                    {{ $comm->product->product_name }}
                </a>
            </td>
            <td>{{ $comm->comment_date }}</td>
            <td><span class="text-ellipsis">
            <?php 
              if ($comm->comment_status==0){
            ?>
                <input type="button" data-comment_status="1" data-comment_id="{{$comm->comment_id}}" class="btn btn-primary btn-xs comment_duyet_btn" id="{{ $comm->comment_product_id }}" value="Duyệt">
            <?php
              }else{
            ?>
                <input type="button" data-comment_status="0" data-comment_id="{{$comm->comment_id}}" class="btn btn-danger btn-xs comment_duyet_btn" id="{{ $comm->comment_product_id }}" value="Bỏ duyệt">
            <?php
             } 
            ?>
            </span></td>
            <td>
              <a href="{{URL::to('/edit-comment/'.$comm->comment_id)}}" class="active" ui-toggle-class="">
                <i class="fa fa-pencil text-success text-active"></i>
              </a>
              <a onclick="return confirm('Bạn có chắc muốn xóa bình luận này không?')" href="{{URL::to('/delete-comment/'.$comm->comment_id)}}" class="active" ui-toggle-class="">
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