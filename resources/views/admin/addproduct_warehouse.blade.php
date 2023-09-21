@extends('admin_layout')
@section('admin_content')    
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            THÔNG TIN NHẬP KHO
                        </header>
                        <div class="panel-body">
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#Modal1">
                                Thêm sản phẩm mới vào kho hàng
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="Modal1" tabindex="-1" role="dialog" aria-labelledby="Modal1Label" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="Modal1Label">Thêm sản phẩm mới vào kho hàng</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
                                        <div class="position-center">
                                            <form role="form" action="{{URL::to('/save-product')}}" method="post" enctype="multipart/form-data">
                                                {{csrf_field()}}
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Tên sản phẩm</label>
                                                    <input type="text" required="text" name="product_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">Số lượng sản phẩm</label>
                                                    <input type="text" required="text" name="product_quantity" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                                                </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Hình ảnh sản phẩm</label>
                                                <input type="file" required="text" name="product_image" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Giá bán</label>
                                                <input type="text" required="text" name="product_price" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">Giá gốc</label>
                                                <input type="text" required="text" name="price_cost" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Mô tả sản phẩm</label>
                                                <textarea style="resize:none" required="text" rows="10" type="password" name="product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Nội dung sản phẩm</label>
                                                <textarea style="resize:none" required="text" rows="10" type="password" name="product_content" class="form-control" id="exampleInputPassword1" placeholder="Nội dung"></textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Danh mục sản phẩm</label>
                                                <select name="product_cate" class="form-control input-sm m-bot15">
                                                    @foreach ($cate_product as $key => $cate)
                                                        <option value="{{$cate->category_id}}">{{$cate->category_name}}</option>
                                                    @endforeach
                                                    
                                                    
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Thương hiệu sản phẩm</label>
                                                <select name="product_brand" class="form-control input-sm m-bot15">
                                                    @foreach ($brand_product as $key => $brand)
                                                        <option value="{{$brand->brand_id}}">{{$brand->brand_name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="exampleInputPassword1">Ẩn/Hiện</label>
                                                <select name="product_status" class="form-control input-sm m-bot15">
                                                    <option value="0">Ẩn</option>
                                                    <option selected value="1">Hiện</option>
                                                </select>
                                            </div>
                                            <button type="submit" name="add_product" class="btn btn-info">Thêm sản phẩm</button>
                                        </form>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary">Save changes</button>
                                    </div>
                                </div>
                                </div>
                            </div>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                Thêm sản phẩm đã có trong kho
                            </button>
                            
                            <!-- Modal -->
                            <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm đã có trong kho</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                    </div>
                                    <div class="modal-body">
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
                                                      <th>Hình ảnh</th>
                                                      <th>Danh mục</th>
                                                      <th>Thương hiệu</th>
                                                      <th>Giá bán</th>
                                                      <th>Giá gốc</th>
                                                    </tr>
                                                  </thead>
                                                  <tbody>
                                                    @php
                                                        $all_product = DB::table('tbl_product')
                                                        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
                                                        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
                                                        ->orderby('tbl_product.product_id','desc')->get();
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
                                                      <td><img src="public/uploads/product/{{ $pro->product_image }}" height="100" width="100"></td>
                                                      <td>{{ $pro->category_name }}</td>
                                                      <td>{{ $pro->brand_name }}</td>
                                                      <td>{{number_format($pro->product_price)}}đ</td>
                                                      <td>{{number_format($pro->price_cost)}}đ</td>
                                                    </tr>
                                                    @endforeach
                                                  </tbody>
                                                </table>
                                              </div>
                                            </div>
                                          </div>
                                    </div>
                                    <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                                </div>
                            </div>

                            
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                        ?>

                        </div>
                    </section>

            </div>
        </div>
@endsection