@extends('admin_layout')
@section('admin_content')    
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm thương hiệu sản phẩm
                        </header>
                        <div class="panel-body">
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                        ?>
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-brand-product')}}" enctype="multipart/form-data" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên thương hiệu</label>
                                        <input type="text" required="text" name="brand_product_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Hình ảnh thương hiệu</label>
                                        <input type="file" required="text" name="brand_product_image" class="form-control" id="exampleInputEmail1" placeholder="">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputPassword1">Mô tả thương hiệu</label>
                                        <textarea required="text" style="resize:none" rows="10" type="password" name="brand_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <select name="brand_product_status" class="form-control input-sm m-bot15">
                                            <option value="0">Ẩn</option>
                                            <option selected value="1">Hiện</option>
                                        </select>
                                    </div>
                                    <button type="submit" name="add_brand_product" class="btn btn-info">Thêm thương hiệu</button>
                                </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
@endsection