<!--A Design by W3layouts
Author: W3layout
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->
<!DOCTYPE html>
<head>
<title>Dashboard</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="keywords" content="Visitors Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, 
Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
<script type="application/x-javascript"> addEventListener("load", function() { setTimeout(hideURLbar, 0); }, false); function hideURLbar(){ window.scrollTo(0,1); } </script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- bootstrap-css -->
<link rel="stylesheet" href="{{asset('public/backend/css/bootstrap.min.css')}}" >
<!-- //bootstrap-css -->
<!-- Custom CSS -->
<link href="{{asset('public/backend/css/style.css')}}" rel='stylesheet' type='text/css' />
<link href="{{asset('public/backend/css/style-responsive.css')}}" rel="stylesheet"/>
<!-- font CSS -->
<link href='//fonts.googleapis.com/css?family=Roboto:400,100,100italic,300,300italic,400italic,500,500italic,700,700italic,900,900italic' rel='stylesheet' type='text/css'>
<!-- font-awesome icons -->
<link rel="stylesheet" href="{{asset('public/backend/css/font.css')}}" type="text/css"/>
<link href="{{asset('public/backend/css/font-awesome.css')}}" rel="stylesheet"> 
<link rel="stylesheet" href="{{asset('public/backend/css/morris.css')}}" type="text/css"/>
<!-- calendar -->
<link rel="stylesheet" href="{{asset('public/backend/css/monthly.css')}}">
<link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" type="text/css"/>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<!-- //calendar -->
<link href="{{asset('public/frontend/css/sweetalert.css')}}" rel="stylesheet">

<meta name="csrf-token" content="{{csrf_token()}}">

<script src="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
<!-- //font-awesome icons -->
<script src="{{asset('public/backend/js/jquery2.0.3.min.js')}}"></script>
<script src="{{asset('public/backend/js/raphael-min.js')}}"></script>
<script src="{{asset('public/backend/js/morris.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/formvalidation/0.6.2-dev/js/formValidation.min.js"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

</head>
<body>
<section id="container">
<!--header start-->
<header class="header fixed-top clearfix">
<!--logo start-->
<div class="brand">
    <a href="index.html" class="logo">
        ADMIN
    </a>
    <div class="sidebar-toggle-box">
        <div class="fa fa-bars"></div>
    </div>
</div>
<div class="top-nav clearfix">
    <!--search & user info start-->
    <ul class="nav pull-right top-menu">
        <li>
            <input type="text" class="form-control search" placeholder=" Search">
        </li>
        <!-- user login dropdown start-->
        <li class="dropdown">
            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                <img alt="" src="public/backend/images/3.png">
                <span class="username">
                    <?php
                        $name = Session::get('admin_name');
                        if($name){
                            echo $name;
                        }
                    ?>
                </span>
                <b class="caret"></b>
            </a>
            <ul class="dropdown-menu extended logout">
                <li><a href="#"><i class=" fa fa-suitcase"></i>Thông tin</a></li>
                <li><a href="#"><i class="fa fa-cog"></i> Cài đặt</a></li>
                <li><a href="{{URL::to('/logout')}}"><i class="fa fa-key"></i> Đăng xuất</a></li>
            </ul>
        </li>
        <!-- user login dropdown end -->
       
    </ul>
    <!--search & user info end-->
</div>
</header>
<!--header end-->
<!--sidebar start-->
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <li>
                    <a class="active" href="{{URL::to('/dashboard')}}">
                        <i class="fa fa-dashboard"></i>
                        <span>Tổng quan</span>
                    </a>
                </li>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Danh mục sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/all-category-product')}}">Tất cả danh mục</a></li>
						<li><a href="{{URL::to('/add-category-product')}}">Thêm danh mục</a></li>
                    </ul>
                </li>
				<li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Thương hiệu sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/all-brand-product')}}">Tất cả thương hiệu</a></li>
						<li><a href="{{URL::to('/add-brand-product')}}">Thêm thương hiệu</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Sản phẩm</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/all-product')}}">Tất cả sản phẩm</a></li>
						<li><a href="{{URL::to('/add-product')}}">Thêm sản phẩm</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Đơn hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-order')}}">Quản lý đơn hàng</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Mã giảm giá</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/list-coupon')}}">Quản lý mã giảm giá</a></li>
						<li><a href="{{URL::to('/insert-coupon')}}">Thêm mã giảm giá</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Vận chuyển</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/delivery')}}">Quản lý vận chuyển</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Bình luận</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/comment')}}">Quản lý bình luận</a></li>
                    </ul>
                </li>
                <?php
                        $role = Session::get('admin_role');
                        if($role == '1'){
                ?>
                    <li class="sub-menu">
                        <a href="javascript:;">
                            <i class="fa fa-book"></i>
                            <span>Nhân viên</span>
                        </a>
                        <ul class="sub">
                            <li><a href="{{URL::to('/add-users')}}">Thêm nhân viên</a></li>
                            <li><a href="{{URL::to('/users')}}">Quản lý nhân viên</a></li>
                        
                        </ul>
                    </li>
                <?php
                        }
                ?>
                
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Kho hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/warehouse')}}">Tất cả phiếu nhập kho</a></li>
						<li><a href="{{URL::to('/addproduct-warehouse')}}">Thêm phiếu nhập kho</a></li>
                    </ul>
                </li>
                <li class="sub-menu">
                    <a href="javascript:;">
                        <i class="fa fa-book"></i>
                        <span>Quản lý cửa hàng</span>
                    </a>
                    <ul class="sub">
						<li><a href="{{URL::to('/manage-order-store')}}">Danh sách hóa đơn</a></li>
						<li><a href="{{URL::to('/add-order-store')}}">Lập hóa đơn bán hàng</a></li>
                    </ul>
                </li>
            </ul>            </div>
        <!-- sidebar menu end-->
    </div>
</aside>
<!--sidebar end-->
<!--main content start-->
<section id="main-content">
	<section class="wrapper">
		@yield('admin_content')
</section>



</section>
<!--main content end-->
</section>
<script src="{{asset('public/backend/js/bootstrap.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.dcjqaccordion.2.7.js')}}"></script>
<script src="{{asset('public/backend/js/scripts.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.slimscroll.js')}}"></script>
<script src="{{asset('public/backend/js/jquery.nicescroll.js')}}"></script>
<!--[if lte IE 8]><script language="javascript" type="text/javascript" src="{{asset('public/backend/js/flot-chart/excanvas.min.js')}}"></script><![endif]-->
<script src="{{asset('public/backend/js/jquery.scrollTo.js')}}"></script>
<script src="{{asset('public/frontend/js/sweetalert.min.js')}}"></script>



{{-- Nhập hàng --}}
<script>
    var nhapHangUrl = "{{url('/nhap-hang')}}";

    $(document).ready(function() {
        $('.nhap-hang').click(function() {

            var table = $("#product-table");
            var rows = table.find("tr");
            
            var data = [];

            for (var i = 1; i < rows.length; i++) {
                var row = rows[i];
                var inputs = $(row).find("input");
                var select = $(row).find("select");

                var product_id = select.val();
                var product_name = select.val();
                var quantity = inputs.eq(0).val();
                var price = inputs.eq(1).val();
                var fee = inputs.eq(2).val();

                if (product_id === '') {
                    swal("Lỗi", "Vui lòng chọn sản phẩm", "error");
                    return; // Stop further execution
                }

                var rowData = {
                    product_id: product_id,
                    product_name: product_name,
                    quantity: quantity,
                    price: price,
                    fee: fee,
                };

                data.push(rowData);
            }

            var warehouse_note = $("#warehouse_note").val();
            var _token = $('input[name="_token"]').val();

            // console.log(data);
            // console.log(warehouse_note);
            $.ajax({
                url: nhapHangUrl,
                method: "POST",
                data: {
                    _token: _token,
                    data: JSON.stringify(data),
                    warehouse_note: warehouse_note
                },
                success: function(data) {
                    swal("Thêm hóa đơn nhập hàng thành công!");
                    window.setTimeout(function(){
                        location.reload();
                    }, 1000);
                },
                error: function(error) {
                    console.error("Error:", error);
                },
            });
        });
    });
</script>
{{-- Hết nhập hàng --}}

<script type="text/javascript">
    $(document).ready(function()
    {
      $('.add-to-cart-store').click(function(){
        var id= $(this).data('id_product');
        var cart_product_id = $('.cart_product_id_' + id).val();
        var cart_product_name = $('.cart_product_name_' + id).val();
        var cart_product_image = $('.cart_product_image_' + id).val();
        var cart_product_quantity = $('.cart_product_quantity_' + id).val();
        var cart_product_price = $('.cart_product_price_' + id).val();
        var cart_product_qty = $('.cart_product_qty_' + id).val();
        var _token = $('input[name="_token"]').val();
        if(parseInt(cart_product_qty)>parseInt(cart_product_quantity)){
          alert('Sản phẩm này trong kho đã hết!');
        }else{
          $.ajax({
          url: '{{url('/add-cart-ajax-store')}}',
          method: 'POST',
          data:{cart_product_id:cart_product_id,cart_product_name:cart_product_name,cart_product_image:cart_product_image,
          cart_product_price:cart_product_price,cart_product_qty:cart_product_qty,cart_product_quantity:cart_product_quantity,_token:_token},
          success:function(data){
            swal("Đã thêm sản phẩm này vào hóa đơn");
				window.setTimeout(function(){
					location.reload();
				}, 1000);
          }
          })
        }
        
      });
    });
  </script>

<script>
    $(document).ready(function(){
        $('.send-order-store').click(function(){
            swal({
                title: "Bạn chắc chắn muốn lập hóa đơn?",
                text: "Đơn hàng sẽ được lập ngay khi bạn đồng ý!",
                type: "warning",
                showCancelButton:true,
                confirmButtonClass: "btn-success",
                confirmButtonText: "Tôi đồng ý!",
                cancelButtonText: "Không, tôi muốn thay đổi",
                closeOnConfirm: false,
                closeOnCancel: false
            },
            function(isConfirm){
                if (isConfirm) {
                    // Lấy các giá trị nhập liệu và loại bỏ khoảng trắng thừa
                    var shipping_name = $('.shipping_name').val().trim();
                    var shipping_phone = $('.shipping_phone').val().trim();
                    var shipping_notes = $('.shipping_notes').val().trim();
                    var order_coupon = $('.order_coupon' ).val().trim();
                    var _token = $('input[name="_token"]').val().trim();
                    // Kiểm tra các giá trị nhập liệu có hợp lệ không
                    if (shipping_name == "" || shipping_phone == "" || shipping_notes == "") {
                        // Hiển thị thông báo lỗi nếu thiếu thông tin bắt buộc
                        alert("Vui lòng nhập đầy đủ thông tin hóa đơn");
                        return;
                    }
                    $.ajax({
                    url: '{{url('/confirm-order-store')}}',
                    method: 'POST',
                    dataType: "json",
                    data:{'shipping_name': shipping_name,
                        'shipping_phone': shipping_phone,
                        'shipping_notes': shipping_notes,
                        'order_coupon': order_coupon,
                        '_token': _token},
                    });
                    // console.log(feeship);
                    swal("Thêm hóa đơn thành công!","success");

                    window.setTimeout(function(){
                        location.reload();
                    }, 3000);
                } else {
                    swal("Đã hủy quá trình!","Hãy thao tác lại!","error");
                }
                
            }
            );
            
    
        });
    });
</script>


<script>
    $('.comment_duyet_btn').click(function(){
        var comment_status = $(this).data('comment_status');
        var comment_id = $(this).data('comment_id');
        var comment_product_id = $(this).attr('id');
        if(comment_status==1){
            var alert = 'Duyệt thành công';
        }else{
            var alert = 'Bỏ duyệt thành công';
        }
        $.ajax({
            url: "{{url('/allow-comment')}}",
            method: 'POST',
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{comment_status:comment_status,comment_id:comment_id,comment_product_id:comment_product_id},
            success:function(data){
                location.reload();
                $('#notify_comment').html('<span class="text text-alert">'+alert+'</span>')
            }
        });
    });
    
    $('.btn-reply-comment').click(function(){
        var comment_id = $(this).data('comment_id');
        var comment = $('.reply_comment_'+comment_id).val();
        var comment_product_id = $(this).data('product_id');

        $.ajax({
            url: "{{url('/reply-comment')}}",
            method: 'POST',
            headers:{
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data:{comment:comment,comment_id:comment_id,comment_product_id:comment_product_id},
            success:function(data){
                $('.reply_comment_'+comment_id).val('');
                $('#notify_comment').html('<span class="text text-alert">Đã phản hồi bình luận</span>');
            }
        });
    });
</script>

<script type="text/javascript">
    $(document).ready(function(){
        load_gallery();

        function load_gallery(){
            var pro_id = $('.pro_id').val();
            var _token = $('input[name="_token"]').val();
            // alert(pro_id);
            $.ajax({
                url: "{{url('/select-gallery')}}",
                method: 'POST',
                data:{pro_id:pro_id,_token:_token},
                success:function(data){
                    $('#load_gallery').html(data);
                }
            });
        }

        $('#file').change(function(){
            var error = '';
            var files = $('#file')[0].files;

            if(files.length>5){
                error+='<p>Không được chọn quá 5 ảnh</p>'
            }else if(files.length==''){
                error+='<p>Không được bỏ trống</p>'
            }else if(files.size > 2000000){
                error+='<p>Không được lớn hơn 2Mb</p>'
            }

            if(error==''){

            }else{
                $('#file').val('');
                $('#error_gallery').html('<span class="text-danger">'+error+'</span>');
                return false;
            }
        });

        $(document).on('blur','.edit_gal_name',function(){
            var gal_id = $(this).data('gal_id');
            var gal_text = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/update-gallery-name')}}",
                method: 'POST',
                data:{gal_id:gal_id,gal_text:gal_text,_token:_token},
                success:function(data){
                    load_gallery();
                    $('#error_gallery').html('<span class="text-danger">Cập nhật tên hình ảnh thành công</span>');
                }
            });
        });

        $(document).on('click','.delete-gallery',function(){
            var gal_id = $(this).data('gal_id');
            var _token = $('input[name="_token"]').val();
            if(confirm('Bạn chắc chắn muốn xóa hình ảnh này khỏi sản phẩm?')){
                $.ajax({
                    url: "{{url('/delete-gallery')}}",
                    method: 'POST',
                    data:{gal_id:gal_id,_token:_token},
                    success:function(data){
                        load_gallery();
                        $('#error_gallery').html('<span class="text-danger">Xóa hình ảnh thành công</span>');
                    }
                });
            }
            
        });
    });
</script>
<script type="text/javascript">
    $(document).ready(function(){
        fetch_delivery();
        function fetch_delivery(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/select-feeship')}}",
                method: 'POST',
                data: {_token:_token},
                success:function(data){
                    $('#load_delivery').html(data);
                }
            });
        }
        $(document).on('blur','.fee_feeship_edit',function(){
            var feeship_id = $(this).data('feeship_id');
            var fee_value = $(this).text();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{url('/update-feeship')}}",
                method: 'POST',
                data: {feeship_id:feeship_id,fee_value:fee_value,_token:_token},
                success:function(data){
                    alert('Thay đổi phí vận chuyển thành công!');
                    fetch_delivery(); // Tự động load csdl ko cần tự load
                }
            });
        });
        $('.add_delivery').click(function(){
            var city = $('.city').val();
            var province = $('.province').val();
            var wards = $('.wards').val();
            var fee_ship = $('.fee_ship').val();
            var _token = $('input[name="_token"]').val();
            // alert(city);
            // alert(province);
            // alert(wards);
            // alert(fee_ship);
            $.ajax({
                url: "{{url('/insert-delivery')}}",
                method: 'POST',
                data: {city:city,province:province,_token:_token,wards:wards,fee_ship:fee_ship},
                success:function(data){
                    alert('Thêm phí vận chuyển thành công!');
                    fetch_delivery();
                }
            });
        });

        $('.choose').on('change',function(){
            var action = $(this).attr('id');
            var ma_id = $(this).val();
            var _token = $('input[name="_token"]').val();
            var result = '';
            // alert(action);
            // alert(matp );
            // alert(_token);
            if(action=='city'){
                result = 'province';
            }else{
                result = 'wards';
            }
            $.ajax({
                url: "{{url('/select-delivery')}}",
                method: 'POST',
                data: {action:action,ma_id:ma_id,_token:_token},
                success:function(data){
                    $('#'+result).html(data);
                }
            });
        });
    });
</script>
<!-- morris JavaScript -->	
<script>
    $(document).ready(function(){
        
        function chart30daysorder(){
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/filter30')}}",
                method:"POST",
                dataType:"JSON",
                data:{_token:_token},
                success:function(data){
                    chart.setData(data);
                }
            });
        }

        var chart = new Morris.Bar({
            element: 'myfirstchart',
            lineColors: ['#819C79', '#fc8710', '#FF6541', '#A4ADD3', '#766B56'],
            parseTime: false,
            hideHover: 'auto',
            xkey: 'period',
            ykeys: ['order', 'sales', 'profit', 'quantity'],
            labels: ['đơn hàng', 'doanh số', 'lợi nhuận', 'số lượng'],
            hoverCallback: function (index, options, content, row) {
                var tooltip = '<div class="morris-hover-row-label">' + row.period + '</div>';
                tooltip += '<div class="morris-hover-point" style="color: ' + options.lineColors[index] + '">';
                tooltip += options.labels[0] + ': ' + row.order + '<br>';
                tooltip += options.labels[1] + ': ' + row.sales + '<br>';
                tooltip += options.labels[2] + ': ' + row.profit + '<br>';
                tooltip += options.labels[3] + ': ' + row.quantity + '<br>';
                tooltip += '</div>';
                return tooltip;
            }
        });

        $('.dashboard-filter').change(function(){
            var dashboard_value = $(this).val();
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{url('/dashboard-filter')}}",
                method:"POST",
                dataType:"JSON",
                data:{dashboard_value:dashboard_value,_token:_token},
                success:function(data){
                    chart.setData(data);
                }
            });
        });

        $('#btn-dashboard-filter').click(function(){
            var _token = $('input[name="_token"]').val();
            var from_date = $('#datepicker').val();
            var to_date = $('#datepicker2').val();
            // alert(from_date);
            // alert(to_date);
            // alert(_token);
            $.ajax({
                url:"{{url('/filter-by-date')}}",
                method:"POST",
                dataType:"JSON",
                data:{from_date:from_date,to_date:to_date,_token:_token},
                success:function(data){
                    chart.setData(data);
                }
            });
        });
        chart30daysorder();            
    });
</script>
<script>
    $( function() {
      $( "#datepicker" ).datepicker();
      $( "#datepicker2" ).datepicker();
    } );
</script>
<script>
    let table = new DataTable('#myTable');
</script>
<script>
    $('.update_quantity_order').click(function(){
        var order_product_id = $(this).data('product_id');
        var order_qty = $('.order_qty_'+order_product_id).val();
        var order_code = $('.order_code').val();
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:'{{url('/update-qty')}}',
            method: 'POST',
            data:{_token:_token,order_product_id:order_product_id,order_qty:order_qty,order_code:order_code},
            success:function(data){
                alert('Cập nhật số lượng thành công');
                location.reload();
            }
        });
    });
</script>
<script>
    $('.order_details').change(function(){
        var order_status = $(this).val();
        var order_id = $(this).children(":selected").attr("id");
        var _token = $('input[name="_token"]').val();
        quantity = [];
        $("input[name='product_sales_quantity']").each(function(){
            quantity.push($(this).val());
        });
        order_product_id = [];
        $("input[name='order_product_id']").each(function(){
            order_product_id.push($(this).val());
        });
        j = 0;
        for(i=0;i<order_product_id.length;i++){
            var order_qty = $('.order_qty_'+order_product_id[i]).val();
            var order_qty_storage = $('.order_qty_storage_'+order_product_id[i]).val();
            if(parseInt(order_qty)>parseInt(order_qty_storage)){
                j++;
                if(j==1){
                    alert('Số lượng trong kho hàng không đủ!');
                }
                
                $('.color_qty_'+order_product_id[i]).css('background','#000');
            }
        }
        if(j==0){
            $.ajax({
                url:'{{url('/update-order-qty')}}',
                method: 'POST',
                data:{_token:_token,order_status:order_status,order_id:order_id,quantity:quantity,order_product_id:order_product_id},
                success:function(data){
                    alert('Thay đổi trạng thái đơn hàng thành công!');
                    location.reload();
                }
            });
        }

        
    });
</script>

<script>
	$(document).ready(function() {
		//BOX BUTTON SHOW AND CLOSE
	   jQuery('.small-graph-box').hover(function() {
		  jQuery(this).find('.box-button').fadeIn('fast');
	   }, function() {
		  jQuery(this).find('.box-button').fadeOut('fast');
	   });
	   jQuery('.small-graph-box .box-close').click(function() {
		  jQuery(this).closest('.small-graph-box').fadeOut(200);
		  return false;
	   });
	   
	    //CHARTS
	    function gd(year, day, month) {
			return new Date(year, month - 1, day).getTime();
		}
		
		graphArea2 = Morris.Area({
			element: 'hero-area',
			padding: 10,
        behaveLikeLine: true,
        gridEnabled: false,
        gridLineColor: '#dddddd',
        axes: true,
        resize: true,
        smooth:true,
        pointSize: 0,
        lineWidth: 0,
        fillOpacity:0.85,
			data: [
				{period: '2015 Q1', iphone: 2668, ipad: null, itouch: 2649},
				{period: '2015 Q2', iphone: 15780, ipad: 13799, itouch: 12051},
				{period: '2015 Q3', iphone: 12920, ipad: 10975, itouch: 9910},
				{period: '2015 Q4', iphone: 8770, ipad: 6600, itouch: 6695},
				{period: '2016 Q1', iphone: 10820, ipad: 10924, itouch: 12300},
				{period: '2016 Q2', iphone: 9680, ipad: 9010, itouch: 7891},
				{period: '2016 Q3', iphone: 4830, ipad: 3805, itouch: 1598},
				{period: '2016 Q4', iphone: 15083, ipad: 8977, itouch: 5185},
				{period: '2017 Q1', iphone: 10697, ipad: 4470, itouch: 2038},
			
			],
			lineColors:['#eb6f6f','#926383','#eb6f6f'],
			xkey: 'period',
            redraw: true,
            ykeys: ['iphone', 'ipad', 'itouch'],
            labels: ['All Visitors', 'Returning Visitors', 'Unique Visitors'],
			pointSize: 2,
			hideHover: 'auto',
			resize: true
		});
		
	   
	});
	</script>
<!-- calendar -->
	<script type="text/javascript" src="public/backend/js/monthly.js"></script>
	<script type="text/javascript">
		$(window).load( function() {

			$('#mycalendar').monthly({
				mode: 'event',
				
			});

			$('#mycalendar2').monthly({
				mode: 'picker',
				target: '#mytarget',
				setWidth: '250px',
				startHidden: true,
				showTrigger: '#mytarget',
				stylePast: true,
				disablePast: true
			});

		switch(window.location.protocol) {
		case 'http:':
		case 'https:':
		// running on a server, should be good.
		break;
		case 'file:':
		alert('Just a heads-up, events will not work when run locally.');
		}

		});
	</script>
	<!-- //calendar -->
</body>
</html>
