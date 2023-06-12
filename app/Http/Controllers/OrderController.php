<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Cart;
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
    public function manage_order(){
        $this->AuthLogin();
        $order = Order::orderby('created_at','DESC')->get();
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
