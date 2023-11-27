@extends('admin_layout')
@section('admin_content')
    <div class="container-fluid">
        <style type="text/css">
            p.title_thongke{
                text-align: center;
                font-size: 20px;
                font-weight: bold;
            }
            ol.list_views {
                margin: 10px 0;
                color: #fff;
            }
            ol.list_views a{
                color: orange;
                font-weight: 400;
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

        <div class="row">
            <div class="col-md-6 col-xs-12">
                <p class="title_thongke" style="color:rgb(26, 234, 26);">Thống kê số lượng admin</p>
                <div id="donut-example"></div>
            </div>
            <div class="col-md-6 col-xs-12">
                <p class="title_thongke" style="color:rgb(26, 234, 26);">Sản phẩm được quan tâm nhiều nhất</p>
                <ol class="list_views">
                    @foreach ($product_views as $views)
                        <li>
                            <a target="_blank" href="{{url('/chi-tiet-san-pham/'.$views->product_id)}}">{{$views->product_name}} | Lượt xem: {{$views->product_view}}</a>
                        </li>
                    @endforeach
                </ol>
            </div>
        </div>

        {{-- Biểu đồ donut --}}
        <script>
            Morris.Donut({
                element: 'donut-example',
                data: [
                    {label: "Sản phẩm", value: <?php echo $product ?>, color: "#FF0000"},
                    {label: "Đơn hàng tại cửa hàng", value: <?php echo $order_store ?>, color: "#00FF00"},
                    {label: "Đơn hàng online", value: <?php echo $order_online ?>, color: "#0000FF"},
                    {label: "Nhân viên", value: <?php echo $admin ?>, color: "#FFFF00"},
                    {label: "Khách hàng", value: <?php echo $customer ?>, color: "#FF00FF"}
                ]
            });

        </script>        
    </div>
    
@endsection