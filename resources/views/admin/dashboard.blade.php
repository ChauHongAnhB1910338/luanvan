@extends('admin_layout')
@section('admin_content')
    <div class="container-fluid">
        <style type="text/css">
            p.title_thongke{
                text-align: center;
                font-size: 20px;
                font-weight: bold;
            }
        </style>
        <div class="row">
            <p class="title_thongke" style="color:rgb(26, 234, 26);">Thống kê doanh số bán hàng</p>
            <form autocomplete="off">
                @csrf
                <div class="col-md-2" style="color:rgb(26, 234, 26)">
                    <p >Từ ngày: <input type="text" id="datepicker" class="form-control"></p>
                    <input type="button" id="btn-dashboard-filter" class="btn btn-success btn-sm" value="Lọc kết quả">
                </div>
                <div class="col-md-2" style="color:rgb(26, 234, 26)">
                    <p>Đến ngày: <input type="text" id="datepicker2" class="form-control"></p>
                </div>

                <div class="col-md-2" style="color:rgb(26, 234, 26)">
                    <p>
                        Lọc theo:
                        <select class="dashboard-filter form-control">
                            <option >---Chọn số ngày---</option>
                            <option value="365ngayqua">Hôm nay</option>
                            <option value="7ngay">7 ngày qua</option>
                            <option value="thangtruoc">tháng trước</option>
                            <option value="thangnay">tháng này</option>
                            
                        </select>
                    </p>
                </div>

            </form>

            <div class="col-md-12">
                <div id="myfirstchart" style="height: 250px;"></div>
            </div>
        </div>
    </div>
@endsection