@extends('layout')
@section('content')
    <style>
        .personal-info-container {
            max-width: 500px;
            margin: 0 auto;
            padding: 20px;
            background-color: #f2f2f2;
            border-radius: 5px;
        }

        .personal-info-container h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .personal-info-container form {
            display: grid;
            gap: 10px;
        }

        .personal-info-container label {
            font-weight: bold;
        }

        .personal-info-container input[type="text"],
        .personal-info-container input[type="email"],
        .personal-info-container input[type="tel"],
        .personal-info-container textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .personal-info-container input[type="submit"] {
            width: 100%;
            padding: 10px;
            background-color: #4caf50;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .personal-info-container input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="container personal-info-container">
        <h1>Thông tin tài khoản</h1>
        <form action="{{URL::to('/edit-customer-details/'.$customer->customer_id)}}" method="POST">
            @csrf
            <label for="name">Họ và tên:</label>
            <input type="text" required id="name" name="name" value="{{$customer->customer_name}}">

            <label for="email">Email:</label>
            <input type="email" required id="email" name="email" value="{{$customer->customer_email}}">

            <label for="phone">Số điện thoại:</label>
            <input type="tel" id="phone" required name="phone" value="{{$customer->customer_phone}}">

            <input type="submit" value="Lưu chỉnh sửa">
        </form>
    </div>

@endsection
