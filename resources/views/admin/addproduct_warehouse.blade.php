@extends('admin_layout')
@section('admin_content')    
<style>
    /* CSS cho bảng nhập hàng */
    #product-table {
        width: 100%;
        border-collapse: collapse;
    }

    #product-table th,
    #product-table td {
        padding: 10px;
        border: 1px solid #ccc;
    }

    #product-table th {
        background-color: #f2f2f2;
    }

    /* CSS cho nút "+" và "-" */
    .add-row-button,
    .remove-row-button {
        padding: 5px 10px;
        background-color: #ccc;
        color: #fff;
        border: none;
        cursor: pointer;
    }

    .add-row-button:hover,
    .remove-row-button:hover {
        background-color: #999;
    }
</style>

        <div class="row">
            <div class="col-lg-12">
                    <section class="panel">
                        <header class="panel-heading">
                            THÊM PHIẾU NHẬP KHO
                        </header>
                        <div class="panel-body">
                            <form  method="POST" enctype="multipart/form-data">
                                @csrf
                                <label for="warehouse_note">Ghi chú:</label>
                                <textarea id="warehouse_notes" name="warehouse_notes" required></textarea>
                                <br><br>
                                <table id="product-table">
                                    <tr>
                                        <th>Sản phẩm</th>
                                        <th>Số lượng</th>
                                        <th>Giá nhập</th>
                                        <th>Tổng </th>
                                        <th><button type="button" onclick="addRow()">+</button></th>
                                    </tr>
                                    <tr>
                                        <td>
                                            <select name="product_id" onchange="changeImage(this)">
                                                <option value="">Chọn sản phẩm</option>
                                                @foreach ($all_product as $key => $pro)
                                                    <option value="{{$pro->product_id}}" data-image="{{asset('public/uploads/product/'.$pro->product_image)}}">
                                                        {{$pro->product_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <img id="product-image" width="90px" height="90px" src="" alt="Hình ảnh sản phẩm">
                                        </td>
                                        <td><input type="number" min="1" required="number" value="1" name="quantity" onchange="calculateTotal(this)"></td>
                                        <td><input type="number" required="number" name="price" onchange="calculateTotal(this)"></td>
                                        <td><input type="number" required="number" name="fee" readonly></td>
                                        <td><button type="button" onclick="removeRow(this)">-</button></td>
                                    </tr>
                                </table>
                                <br>
                                <input type="button" value="Nhập hàng" name="nhap-hang" class="nhap-hang btn btn-default btn-sm">
                            </form>
                            
                            <script>
                                function calculateTotal(input) {
                                    var row = input.parentNode.parentNode;
                                    var quantity = row.querySelector('input[name="quantity"]').value;
                                    var price = row.querySelector('input[name="price"]').value;
                                    var total = quantity * price;
                                    row.querySelector('input[name="fee"]').value = total;
                                }
                            
                                function addRow() {
                                    var table = document.getElementById("product-table");
                                    var row = table.insertRow(-1);
                                    var cell1 = row.insertCell(0);
                                    var cell2 = row.insertCell(1);
                                    var cell3 = row.insertCell(2);
                                    var cell4 = row.insertCell(3);
                                    var cell5 = row.insertCell(4);
                                    cell1.innerHTML = `
                                            <select name="product_id" onchange="changeImage(this)">
                                                <option value="">Chọn sản phẩm</option>
                                                @foreach ($all_product as $key => $pro)
                                                    <option value="{{$pro->product_id}}" data-image="{{asset('public/uploads/product/'.$pro->product_image)}}">
                                                        {{$pro->product_name}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <img id="product-image" width="90px" height="90px" src="" alt="Hình ảnh sản phẩm">
                                        `;
                                    cell2.innerHTML = '<input type="number" min="1" value="1" required="number" name="quantity" onchange="calculateTotal(this)">';
                                    cell3.innerHTML = '<input type="number" required="number" name="price" onchange="calculateTotal(this)">';
                                    cell4.innerHTML = '<input type="number" required="number" name="fee" readonly>';
                                    cell5.innerHTML = '<button type="button" onclick="removeRow(this)">-</button>';
                                }
                            
                                function removeRow(button) {
                                    var row = button.parentNode.parentNode;
                                    row.parentNode.removeChild(row);
                                }
                            </script>
                            <script>
                                function changeImage(select) {
                                    var image = select.options[select.selectedIndex].getAttribute('data-image');
                                    var imgElement = select.nextElementSibling;
                                    imgElement.src = image;
                                }
                            </script>
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