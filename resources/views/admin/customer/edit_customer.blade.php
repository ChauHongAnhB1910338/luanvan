@extends('admin_layout')
@section('admin_content')    
        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            Cập nhật tài khoản khách hàng
                        </header>
                        <?php
                                $message = Session::get('message');
                                if($message){
                                    echo '<span class="text-alert">'.$message.'</span>';
                                    Session::put('message',null);
                                }
                            ?>
                        <div class="panel-body">
                            @foreach($edit_customer as $key => $edit_value)
                            <div class="position-center">
                                <form role="form" action="{{URL::to('/update-customer/'.$edit_value->customer_id)}}" method="post">
                                    {{csrf_field()}}
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Tên khách hàng</label>
                                        <input required type="text" value="{{$edit_value->customer_name}}" name="customer_name" class="form-control" id="exampleInputEmail1" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Email</label>
                                        <input required="email" type="email" value="{{$edit_value->customer_email}}" name="customer_email" class="form-control" id="exampleInputEmail1" >
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">Số điện thoại</label>
                                        <input required type="text" value="{{$edit_value->customer_phone}}" name="customer_phone" class="form-control" id="exampleInputEmail1" >
                                    </div>
                                    <button type="submit" name="add_customer" class="btn btn-info">Cập nhật tài khoản</button>
                                </form>
                            </div>
                            @endforeach
                        </div>
                    </section>

            </div>
        </div>
@endsection