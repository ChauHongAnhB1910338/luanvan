@extends('admin_layout')
@section('admin_content')    
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Thêm mã giảm giá
                        </header>
                        <?php
                            $message = Session::get('message');
                            if($message){
                                echo '<span class="text-alert">'.$message.'</span>';
                                Session::put('message',null);
                            }
                        ?>
                        <div class="panel-body">
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/insert-coupon-code')}}" method="post">
                                    @csrf
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tên mã giảm giá</label>
                                    <input type="text" required="text" name="coupon_name" class="form-control" id="exampleInputEmail1" >
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">Mã code giảm giá</label>
                                    <textarea required="text" style="resize:none" rows="10" type="password" name="coupon_code" class="form-control" id="exampleInputPassword1" ></textarea>
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Số lượng mã giảm giá</label>
                                    <input type="number" required="text" name="coupon_time" class="form-control" id="exampleInputEmail1">
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Tính mã giảm giá</label>
                                    <select name="coupon_condition" class="form-control input-sm m-bot15">
                                        <option value="0">---Chọn---</option>
                                        <option value="1">Giảm %</option>
                                        <option value="2">Giảm tiền</option>
                                    </select>                                
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">% hoặc số tiền giảm</label>
                                    <input type="text" required="text" name="coupon_number" class="form-control" id="exampleInputEmail1" placeholder="Nhập tên mã giảm giá">
                                </div>
                                <button type="submit" name="add_coupon" class="btn btn-info">Thêm mã giảm giá</button>
                            </form>
                            </div>

                        </div>
                    </section>

            </div>
        </div>
@endsection