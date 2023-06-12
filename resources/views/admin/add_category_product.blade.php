@extends('admin_layout')
@section('admin_content')    
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                        ?>
                        <header class="panel-heading">
                            Thêm danh mục sản phẩm
                        </header>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/save-category-product')}}" method="post">
                                    {{csrf_field()}}
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên danh mục</label>
                                    <input type="text" required="text" name="category_product_name" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên danh mục">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mô tả danh mục</label>
                                    <textarea required="text" style="resize:none" rows="10" type="password" name="category_product_desc" class="form-control" id="exampleInputPassword1" placeholder="Mô tả"></textarea>
                                </div>
                                <div class="form-group">
                                    <select name="category_product_status" class="form-control input-sm m-bot15">
                                        <option value="0">Ẩn</option>
                                        <option selected value="1">Hiện</option>
                                    </select>
                                </div>
                                <button type="submit" name="add_category_product" class="btn btn-info">Thêm danh mục</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
@endsection