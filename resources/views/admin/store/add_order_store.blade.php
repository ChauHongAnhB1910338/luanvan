@extends('admin_layout')
@section('admin_content')    
<div class="table-agile-info col-sm-12">
  <div class=" col-sm-6">
    <div>
      @if(session()->has('message'))
          <div class="alert alert-success">
              {!!session()->get('message')!!}
          </div>
        @elseif(session()->has('error'))
          <div class="alert alert-danger">
              {!!session()->get('error')!!}
          </div>
      @endif
      <div class="table-responsive cart_info">
          <form action="{{url('/update-cart-store')}}" method="POST">
              @csrf
          <table class="table table-condensed">
              <thead>
                  <tr class="cart_menu">
                      <td class="image">Hình ảnh</td>
                      <td class="name">Tên sản phẩm</td>
                      <td class="price">Giá</td>
                      <td class="quantity">Số lượng</td>
                      <td class="total">Thành tiền</td>
                      <td></td>
                      <td></td>
                  </tr>
              </thead>
              <tbody>
                  @if(Session::get('cart_store')==true)
                  <?php 
                          $total = 0;
                  ?>
                  @foreach (Session::get('cart_store') as $key => $cart_store)
                      <?php 
                          $subtotal = $cart_store['product_price']*$cart_store['product_qty'];
                          $total+=$subtotal;
                      ?>
                  

                      <tr>
                          <td class="cart_product">
                              <img src="{{asset('public/uploads/product/'.$cart_store['product_image'])}}" width="90" alt="{{$cart_store['product_name']}}" />
                          </td>
                          <td class="cart_description">
                              <p>{{$cart_store['product_name']}}</p>
                          </td>
                          <td class="cart_price">
                              <p>{{number_format($cart_store['product_price'])}}đ</p>
                          </td>
                          <td class="cart_quantity">
                              <div class="cart_quantity_button">
                          
                                  <input class="cart_quantity" type="number" min="1" name="cart_qty[{{$cart_store['session_id']}}]" value="{{$cart_store['product_qty']}}">
                                  <input type="hidden" value="" name="rowId_cart" class="form-control">
                                  
                              </div>
                          </td>
                          <td class="cart_total">
                              <p class="cart_total_price">{{number_format($subtotal)}}đ
                              </p>
                          </td>
                          <td class="cart_delete">
                              <a class="cart_store_quantity_delete" href="{{url('/del-product-store/'.$cart_store['session_id'])}}"><i class="fa fa-times"></i></a>
                          </td>
                      </tr>
                  @endforeach
                      <tr>
                          <td><input type="submit" value="Cập nhật" name="update_qty_store" class="check_out btn btn-default btn-sm"></td>
                          <td><a class="btn btn-default check_out" href="{{url('/del-all-product-store')}}">Xóa tất cả</a></td>
                      </tr>
                      <td>
                          @if (Session::get('coupon'))
                              <a class="btn btn-default check_out" href="{{url('/unset-coupon')}}">Xóa mã giảm giá</a>
                          @endif
                      </td>
                      <td colspan="2">
                           <li>Tổng: <span>{{number_format($total)}} VNĐ</span></li>
                          @if (Session::get('coupon'))
                          <li>
                              
                                  @foreach (Session::get('coupon') as $key => $cou)
                                      @if ($cou['coupon_condition']==1)
                                          Mã giảm giá: {{$cou['coupon_number']}}%
                                          <p>
                                              @php
                                                  $total_coupon = ($total*$cou['coupon_number'])/100;
                                                  echo '<p><li>Tổng giảm: '.number_format($total_coupon).' VNĐ </li></p>';
                                              @endphp
                                          </p>
                                          <p>
                                              <li>Tổng tiền phải trả: 
                                                  {{number_format($total-$total_coupon)}} VNĐ
                                              </li>
                                          </p>
                                      @else
                                          Mã giảm giá: {{$cou['coupon_number']}}VNĐ
                                          <p>
                                              @php
                                                  $total_coupon = ($total - $cou['coupon_number']);
                                              @endphp
                                          </p>
                                          <p><li>Tổng tiền phải trả: 
                                              {{number_format($total_coupon)}} VNĐ
                                          </li></p>
                                      @endif
                                  @endforeach
                              @else
                                  
                              
                          </li>
                          @endif
                          {{-- <li>Phí vận chuyển: <span>Free</span></li>
                          <li>Thành tiền: <span></span></li> --}}
                      </td>
                      
                  @else
                  <tr>
                      <td colspan="5"><center>
                      @php
                          echo 'Chưa có sản phẩm nào được chọn!';   
                      @endphp
                      </center>
                      </td>
                  </tr>
                  @endif
              </tbody>
          </table>
          </form>
          @if (Session::get('cart_store'))
            <tr>
              <td>
              
              <form action="{{url('/check-coupon')}}" method="POST">
                 @csrf 
                 <span>
                    <input type="text" name="coupon" class="form-control" placeholder="Nhập mã giảm giá"><br>
                    <input type="submit" class="btn btn-default check_coupon" name="check_coupon" value="Tính mã giảm giá">
                 </span>
                  
              </form>
              </td> 
            </tr>
            <br>
              <h3>Thông tin khách hàng</h3>
                <form  method="POST">
                    @csrf
                    <div>
                      <a style="margin-right: 75px">Họ tên: </a>
                      <input required type="text" name="shipping_name" class="shipping_name" placeholder="Họ và tên">
                    </div>
                    <br>
                    <div>
                      <a style="margin-right: 30px">Số điện thoại: </a>
                      <input required type="text" name="shipping_phone" class="shipping_phone" placeholder="Số điện thoại">
                    </div>
                    <br>
                    <div>
                      <a style="margin-right: 9px">Ghi chú hóa đơn: </a>
                      <textarea required name="shipping_notes" class="shipping_notes" placeholder="Ghi chú kèm theo" rows="5"></textarea>
                    </div>
                    <br>
                    @if (Session::get('coupon'))
                        @foreach (Session::get('coupon') as $key => $cou)
                            <input type="hidden" name="order_coupon" class="order_coupon" value="{{$cou['coupon_code']}}">
                        @endforeach
                    @else
                        <input type="hidden" name="order_coupon" class="order_coupon" value="no">
                    @endif
                    <input type="button" value="Lập hóa đơn" name="send-order-store" class="btn btn-primary btn-sm send-order-store">
                </form>
          @endif
          
          
      </div>
  </div>
  </div>
  <div class=" col-sm-6">
    <div class="panel panel-default">
      <div class="panel-heading">
        Tất cả sản phẩm
      </div>
      <input id="nhap" type="text" placeholder="Nhập bất kỳ để tìm kiếm" class="w-25 my-5 form-control form-control-md" spellcheck="false"/>
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
        <table class="table table-striped b-t b-light">
          <thead>
            <tr>
              <th>STT</th>
              <th>Tên sản phẩm</th>
              <th>Số lượng</th>
              <th>Hình ảnh</th>
              <th>Giá bán</th>
              <th></th>
            </tr>
          </thead>
          <tbody id="myTb">
            @php
                $count = 0;
            @endphp
            @foreach($all_product as $key => $pro)
            @php
                $count++;
            @endphp
            <tr>
              <form>
                @csrf
                <input type="hidden" value="{{$pro->product_id}}" class="cart_product_id_{{$pro->product_id}}">
								<input type="hidden" value="{{$pro->product_name}}" class="cart_product_name_{{$pro->product_id}}">
								<input type="hidden" value="{{$pro->product_image}}" class="cart_product_image_{{$pro->product_id}}">
								<input type="hidden" value="{{$pro->product_quantity}}" class="cart_product_quantity_{{$pro->product_id}}">
								<input type="hidden" value="{{$pro->product_price}}" class="cart_product_price_{{$pro->product_id}}">
								<input type="hidden" value="1" class="cart_product_qty_{{$pro->product_id}}">
                <td>{{ $count }}</td>
                <td>{{ $pro->product_name }}</td>
                <td>{{ $pro->product_quantity }}</td>
                <td>
                  <img src="{{asset('public/uploads/product/'.$pro->product_image)}}" width="90" alt="{{$pro->product_name}}" />
                </td>
                <td>{{number_format($pro->product_price)}}đ</td>
                <td>
                  <button class="btn btn-default add-to-cart-store" type="button" data-id_product="{{$pro->product_id}}" name="add-to-cart" >Chọn sản phẩm</button>
                </td>
              </form>
              
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
<script>
  $(document).ready(function() {
      $('#nhap').on('keyup', function() {
          var tukhoa = $(this).val().toLowerCase();
          $('#myTb tr').filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(tukhoa)>-1);
          });
      });
  });
</script>
@endsection