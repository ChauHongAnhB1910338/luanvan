@extends('layout')
@section('content')
<section id="form"><!--form-->
    <div class="container">
        <div class="row">
            <div class="col-sm-4 col-sm-offset-1">
                <div class="login-form"><!--login form-->
                    <h2>Đăng nhập</h2>
                    <form action="{{URL::to('/login-customer')}}" method="POST">
                        {{csrf_field()}}
                        <input type="text" name="email_account" placeholder="Tài khoản" />
                        <input type="password" name="password_account" placeholder="Mật khẩu" />
                        <span>
                            <input type="checkbox" class="checkbox"> 
                            Ghi nhớ tôi
                        </span>
                        <button type="submit" class="btn btn-default">Đăng nhập</button>
                    </form>
                </div><!--/login form-->
            </div>
            <div class="col-sm-1">
                <h2 class="or">Hoặc</h2>
            </div>
            <div class="col-sm-4">
                <div class="signup-form"><!--sign up form-->
                    <h2>Đăng ký</h2>
                    <form action="{{URL::to('/add-customer')}}" method="POST">
                        {{csrf_field()}}
                        <input type="text" required="text" name="customer_name" placeholder="Họ tên"/>
                        <input type="email" required="text" name="customer_email" placeholder="Địa chỉ Email"/>
                        <input type="password" required="text" name="customer_password" placeholder="Mật khẩu"/>
                        <input type="text" required="text" name="customer_phone" placeholder="Số điện thoại"/>
                        <button type="submit" class="btn btn-default">Đăng ký</button>
                    </form>
                </div><!--/sign up form-->
            </div>
        </div>
    </div>
</section><!--/form-->
@endsection