<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Cart;
use PDF;
use Illuminate\Support\Facades\Redirect;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\Statistic;

class OrderController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        } else return Redirect::to('admin')->send();
    }
    public function print_order($checkout_code){
        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($this->print_order_convert($checkout_code));
        return $pdf->stream();
    }
    public function print_order_convert($checkout_code){
        $order_details = OrderDetails::with('product')->where('order_code',$checkout_code)->get();
        $order = Order::where('order_code',$checkout_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        $order1 = Order::where('order_code',$checkout_code)->first();

        $output = '
        <style>
            body {
                font-family: DejaVu Sans;
            }
            h1, h2 {
                text-align: center;
            }
            table {
                width: 100%;
                border-collapse: collapse;
            }
            th, td {
                border: 1px solid black;
                padding: 8px;
                text-align: left;
            }
            th {
                background-color: #f2f2f2;
            }
        </style>
        <h1><center>HÓA ĐƠN BÁN HÀNG</h1>';
        $output .= '<h2><center>AnhChauShop</h2>';
        $output .= '<p>Mã hóa đơn: ' . $order1->order_id . '</p>';
        $output .= '<p>Ngày lập hóa đơn: ' . $order1->order_date . '</p>';
        $output .= '<p>Họ và tên: ' . $shipping->shipping_name . '</p>';
        $output .= '<p>Địa chỉ: ' . $shipping->shipping_address . '</p>';
        $output .= '<p>Số điện thoại: ' . $shipping->shipping_phone . '</p>';
        $output .= '<table>
                        <thead>
                            <tr>
                                <th>Tên sản phẩm</th>
                                <th>Số lượng</th>
                                <th>Giá</th>
                                <th>Tổng cộng</th>
                            </tr>
                        </thead>
                        <tbody>';
        $total = 0;
        foreach ($order_details as $order_detail) {
            $total += $order_detail->product_price * $order_detail->product_sales_quantity;
            $output .= '<tr>
                            <td>' . $order_detail->product_name . '</td>
                            <td>' . $order_detail->product_sales_quantity . '</td>
                            <td>' . number_format($order_detail->product_price) . 'đ</td>
                            <td>' . number_format($order_detail->product_price * $order_detail->product_sales_quantity)  . 'đ</td>
                        </tr>';
        }
        foreach($order_details as $key => $order_d){
            $product_coupon = $order_d->product_coupon;
            
        }
        if($product_coupon!='no'){
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
        }
        $total_coupon = 0;
        $total_after_coupon = 0;
        if ($coupon_condition == 1){
            $total_after_coupon = ($total*$coupon_number)/100;
            $total_coupon = $total - $total_after_coupon;
        }else{
            $total_coupon = ($total-$coupon_number);
        }
            
        $output .= '</tbody>
            <tfoot>
                <tr>
                    <td colspan="1">
                    <p>Tổng hóa đơn: ' . number_format($total) . ' VNĐ</p>
                    <p>Mã giảm giá: ' . $order_detail->product_coupon . ' (' .$coupon_number.')</p>
                    <p>Tổng giảm: ' . number_format($total_after_coupon) . ' VNĐ</p>
                    <p>Phí vận chuyển: ' . number_format( $order_detail->product_feeship) . ' VNĐ</p>
                    
                    </td>
                    <td colspan="3"><center><strong>Tổng thanh toán: ' . number_format($total+$order_detail->product_feeship) . ' VNĐ</td>
                </tr>
            </tfoot>
        </table>';
        $output .= '<h4><center>Mọi thắc mắc vui lòng liên hệ đến chúng tôi: </h4>';
        $output .= '<h5>Địa chỉ: Đường Quang Trung, Phường 5, Cà Mau</h5>';
        $output .= '<h5>Số điện thoại: 0947127033</h5>';

        return $output;
    }
    public function manage_order(){
        $this->AuthLogin();
        $order = Order::orderby('created_at','DESC')->where('order_store',0)->get();
        return view('admin.manage_order')->with(compact('order'));
    }
    public function view_order($order_code){
        $this->AuthLogin();
        $order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
        $order = Order::where('order_code',$order_code)->get();
        foreach($order as $key => $ord){
            $customer_id = $ord->customer_id;
            $shipping_id = $ord->shipping_id;
            $order_status = $ord->order_status;
        }
        $customer = Customer::where('customer_id',$customer_id)->first();
        $shipping = Shipping::where('shipping_id',$shipping_id)->first();
        $order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();

        foreach($order_details as $key => $order_d){
            $product_coupon = $order_d->product_coupon;
            
        }

        if($product_coupon!='no'){
            $coupon = Coupon::where('coupon_code',$product_coupon)->first();
            $coupon_condition = $coupon->coupon_condition;
            $coupon_number = $coupon->coupon_number;
        }else{
            $coupon_condition = 2;
            $coupon_number = 0;
        }

        
        return view('admin.view_order')->with(compact('order_details','customer','shipping','order_details','coupon_condition','coupon_number','order','order_status'));
    }
    // public function update_order_qty(REQUEST $request){
    //     $data = $request->all();
    //     $order = Order::find($data['order_id']);
    //     $order->order_status = $data['order_status'];
    //     $order->save();
    //     if($order->order_status==2){
    //         foreach($data['order_product_id'] as $key => $product_id){
    //             $product = Product::find($product_id);
    //             $product_quantity = $product->product_quantity;
    //             $product_sold = $product->product_sold;
    //             foreach($data['quantity'] as $key2 => $qty){
    //                 if($key==$key2){
    //                     $pro_remain = $product_quantity - $qty;
    //                     $product->product_quantity = $pro_remain;
    //                     $product->product_sold = $product_sold + $qty;
    //                     $product->save();
    //                 }
    //             }
    //         }
    //     }elseif($order->order_status==1){
    //         foreach($data['order_product_id'] as $key => $product_id){
    //             $product = Product::find($product_id);
    //             $product_quantity = $product->product_quantity;
    //             $product_sold = $product->product_sold;
    //             foreach($data['quantity'] as $key2 => $qty){
    //                 if($key==$key2){
    //                     $pro_remain = $product_quantity + $qty;
    //                     $product->product_quantity = $pro_remain;
    //                     $product->product_sold = $product_sold - $qty;
    //                     $product->save();
    //                 }
    //             }
    //         }
    //     }
    // }
    public function update_qty(REQUEST $request){
        $data = $request->all();
        $order_details = OrderDetails::where('product_id',$data['order_product_id'])->where('order_code',$data['order_code'])->first();
        $order_details->product_sales_quantity = $data['order_qty'];
        $order_details->save();

    }

    public function update_order_qty(REQUEST $request){
        $data = $request->all();
        $order = Order::find($data['order_id']);
        $order->order_status = $data['order_status'];
        $order->save();
        $order_date = $order->order_date;
        $statistic = Statistic::where('order_date',$order_date)->get();
        if($statistic){
            $statistic_count = $statistic->count();
        }else{
            $statistic_count = 0;
        }

        if($order->order_status==2){
            $total_order = 0;
            $sales = 0;
            $profit = 0;
            $quantity =0;
            foreach($data['order_product_id'] as $key => $product_id){
                $product = Product::find($product_id);
                $product_quantity = $product->product_quantity;
                $product_sold = $product->product_sold;
                $product_price = $product->product_price;
                $product_cost = $product->price_cost;
                $now = Carbon::now('Asia/Ho_Chi_Minh')->toDateString();
                foreach($data['quantity'] as $key2 => $qty){
                    if($key==$key2){
                        $pro_remain = $product_quantity - $qty;
                        $product->product_quantity = $pro_remain;
                        $product->product_sold = $product_sold + $qty;
                        $product->save();
                        
                        $quantity+=$qty;
                        $total_order+=1;
                        $sales+=$product_price*$qty;
                        $profit = $sales-($product_cost*$qty);
                    }
                }
            }
        }elseif($order->order_status==3){
            $total_order = 0;
            $sales = 0;
            $profit = 0;
            $quantity =0;
        }else{
            $total_order = 0;
            $sales = 0;
            $profit = 0;
            $quantity =0;
        }
        //update doanh so
        if($statistic_count>0){
            $statistic_update = Statistic::where('order_date',$order_date)->first();
            $statistic_update->sales = $statistic_update->sales + $sales;
            $statistic_update->profit = $statistic_update->profit + $profit;
            $statistic_update->quantity = $statistic_update->quantity + $quantity;
            $statistic_update->total_order = $statistic_update->total_order + $total_order;
            $statistic_update->save();
        }else{
            $statistic_new = new Statistic();
            $statistic_new->order_date =  $order_date;
            $statistic_new->sales =  $sales;
            $statistic_new->profit =  $profit;
            $statistic_new->quantity =  $quantity;
            $statistic_new->total_order = $total_order;
            $statistic_new->save();
        }

    }
}
