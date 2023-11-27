<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use Cart;
use DB;
use App\Models\Gallery;
use App\HTTP\Requests;
use App\Models\Comment;
use App\Models\Rating;
use File;
use Illuminate\Support\Facades\Redirect;
use App\Models\Shipping;
use App\Models\Order;
use App\Models\OrderDetails;
use App\Models\Customer;
use App\Models\Coupon;
use App\Models\Product;
use Carbon\Carbon;
use App\Models\Statistic;
class StoreController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        } else return Redirect::to('admin')->send();
    }
    public function manage_order_store(){
        $this->AuthLogin();
        $order = Order::orderby('created_at','DESC')->where('order_store',1)->get();
        return view('admin.store.manage_order_store')->with(compact('order'));
    }
    public function add_order_store(){
        $this->AuthLogin();
        $add_order_store = DB::table('tbl_product')
        ->orderby('tbl_product.product_id','desc')->get();

        $manager_product = view('admin.store.add_order_store')->with('all_product',$add_order_store);
        return view('admin_layout')->with('admin.store.add_order_store',$manager_product);
    }
    public function add_cart_ajax_store(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart_store = Session::get('cart_store');
        if($cart_store==true){+
            $is_available = 0;
            foreach($cart_store as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_available++;
                }
            }
            if($is_available == 0){
                $cart_store[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart_store',$cart_store);
            }
        }else{
            $cart_store[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
        }
        Session::put('cart_store',$cart_store);
        Session::save();
    }
    public function gio_hang_store(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('admin.store.cart_ajax')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function del_product_store($session_id){
        $cart_store = Session::get('cart_store');
        if($cart_store==true){
            foreach ($cart_store as $key => $value) {
                if($value['session_id']==$session_id){
                    unset($cart_store[$key]);
                }
            }
            Session::put('cart_store',$cart_store);
            return redirect()->back()->with('message','Xóa thành công!');
        }else{
            return redirect()->back()->with('message','Xóa thất bại!');
        }
    }
    public function del_all_product_store(){
        $cart = Session::get('cart_store');
        if($cart==true){
            Session::forget('cart_store');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa tất cả sản phẩm khỏi hóa đơn thành công!');
        }
    }
    public function update_cart_store(Request $request){
        $data = $request->all();
        $cart_store = Session::get('cart_store');
        if($cart_store==true){
            $message = '';
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart_store as $session => $val){
                    if($val['session_id'] == $key && $qty<=$cart_store[$session]['product_quantity']){
                        $cart_store[$session]['product_qty'] = $qty;
                        $message.='<p style="color:blue;">Cập nhật số lượng sản phẩm '.$cart_store[$session]['product_name'].' thành công</p>';
                    }elseif($val['session_id'] == $key && $qty>$cart_store[$session]['product_quantity']){
                        $message.='<p style="color:red;">Cập nhật số lượng sản phẩm '.$cart_store[$session]['product_name'].' thất bại</p>';
                    }
                }
            }
            Session::put('cart_store',$cart_store);
            return redirect()->back()->with('message',$message);
        }else{
            return redirect()->back()->with('message','Cập nhật thất bại!');
        }
    }
    public function confirm_order_store(Request $request){
        $data = $request->all();
        $shipping = new Shipping();
        $shipping->shipping_name = $data['shipping_name'];
        $shipping->shipping_email = 'No data';
        $shipping->shipping_address = 'No data';
        $shipping->shipping_phone = $data['shipping_phone'];
        $shipping->shipping_notes = $data['shipping_notes'];
        $shipping->shipping_method = 4;
        $shipping->save();
        $shipping_id = $shipping->shipping_id;

        $checkout_code = substr(md5(microtime()),rand(0,26),5);
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $order = new Order;
        $order->customer_id = 0;
        $order->shipping_id = $shipping_id;
        $order->order_store = 1;
        $order->order_admin_id = NULL;
        $order->order_status = 1;
        $order->order_code = $checkout_code;
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $order_date = Carbon::now('Asia/Ho_Chi_Minh')->format('m/d/Y');
        $order->created_at = $today;
        $order->order_date = $order_date;
        $order->save();

        
        if(Session::get('cart_store')){
            foreach(Session::get('cart_store') as $key => $cart_store){
                $order_details = new OrderDetails;
                $order_details->order_code = $checkout_code;
                $order_details->product_id = $cart_store['product_id'];
                $order_details->product_name = $cart_store['product_name'];
                $order_details->product_price = $cart_store['product_price'];
                $order_details->product_sales_quantity = $cart_store['product_qty'];
                $order_details->product_coupon = $data['order_coupon'];
                $order_details->product_feeship = 0;
                $order_details->save();
            }
        }
        
        Session::forget('coupon');
        Session::forget('cart_store');
    }
    public function view_order_store($order_code){
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

        
        return view('admin.store.view_order_store')->with(compact('order_details','customer','shipping','order_details','coupon_condition','coupon_number','order','order_status'));
    }
    // public function store_view_order($order_code){
    //     $this->AuthLogin();
    //     $order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();
    //     $order = Order::where('order_code',$order_code)->get();
    //     foreach($order as $key => $ord){
    //         $customer_id = $ord->customer_id;
    //         $shipping_id = $ord->shipping_id;
    //         $order_status = $ord->order_status;
    //     }
    //     $customer = Customer::where('customer_id',$customer_id)->first();
    //     $shipping = Shipping::where('shipping_id',$shipping_id)->first();
    //     $order_details = OrderDetails::with('product')->where('order_code',$order_code)->get();

    //     foreach($order_details as $key => $order_d){
    //         $product_coupon = $order_d->product_coupon;
            
    //     }

    //     if($product_coupon!='no'){
    //         $coupon = Coupon::where('coupon_code',$product_coupon)->first();
    //         $coupon_condition = $coupon->coupon_condition;
    //         $coupon_number = $coupon->coupon_number;
    //     }else{
    //         $coupon_condition = 2;
    //         $coupon_number = 0;
    //     }

        
    //     return view('admin.view_order')->with(compact('order_details','customer','shipping','order_details','coupon_condition','coupon_number','order','order_status'));
    // }
}
