<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\HTTP\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
use Cart;
use App\Models\Coupon;
session_start();
class CartController extends Controller
{
    public function save_cart(Request $request){

        $productId = $request->productid_hidden;
        $quantity = $request->qty;

        $product_info = DB::table('tbl_product')->where('product_id',$productId)->first();
        $data['id'] = $product_info->product_id;
        $data['qty'] = $quantity;
        $data['name'] = $product_info->product_name;
        $data['price'] = $product_info->product_price;
        $data['weight'] = '1';
        $data['options']['image'] = $product_info->product_image;
        Cart::add($data);
        Cart::setGlobalTax(5);
        return Redirect::to('/show-cart');
    }
    public function show_cart(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.cart.show_cart')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function delete_to_cart($rowId){
        Cart::update($rowId,0);
        return Redirect::to('/show-cart');
    }
    public function update_cart_quantity(Request $request){
        $rowId = $request->rowId_cart;
        $qty = $request->cart_quantity;
        Cart::update($rowId,$qty);
        return Redirect::to('/show-cart');
    }
    public function add_cart_ajax(Request $request){
        $data = $request->all();
        $session_id = substr(md5(microtime()),rand(0,26),5);
        $cart = Session::get('cart');
        if($cart==true){
            $is_available = 0;
            foreach($cart as $key => $val){
                if($val['product_id']==$data['cart_product_id']){
                    $is_available++;
                }
            }
            if($is_available == 0){
                $cart[] = array(
                    'session_id' => $session_id,
                    'product_name' => $data['cart_product_name'],
                    'product_id' => $data['cart_product_id'],
                    'product_image' => $data['cart_product_image'],
                    'product_quantity' => $data['cart_product_quantity'],
                    'product_qty' => $data['cart_product_qty'],
                    'product_price' => $data['cart_product_price'],
                );
                Session::put('cart',$cart);
            }
        }else{
            $cart[] = array(
                'session_id' => $session_id,
                'product_name' => $data['cart_product_name'],
                'product_id' => $data['cart_product_id'],
                'product_image' => $data['cart_product_image'],
                'product_quantity' => $data['cart_product_quantity'],
                'product_qty' => $data['cart_product_qty'],
                'product_price' => $data['cart_product_price'],
            );
        }
        Session::put('cart',$cart);
        Session::save();
    }
    public function gio_hang(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.cart.cart_ajax')->with('category',$cate_product)->with('brand',$brand_product);
    }
    public function del_product($session_id){
        $cart = Session::get('cart');
        if($cart==true){
            foreach ($cart as $key => $value) {
                if($value['session_id']==$session_id){
                    unset($cart[$key]);
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message','Xóa thành công!');
        }else{
            return redirect()->back()->with('message','Xóa thất bại!');
        }
    }
    // public function update_cart(Request $request){
    //     $product_in = DB::table('tbl_product');
    //     $data = $request->all();
    //     $cart = Session::get('cart');
    //     if($cart==true){
    //         foreach($data['cart_qty'] as $key => $qty){
    //             foreach($cart as $session => $val){
    //                 if($val['session_id'] == $key){
    //                     // get the current product quantity from database by id
    //                     // using query builder
    //                     $current_qty = $product_in->where('product_id', $key)->value('product_quantity');
    //                     // or using model
    //                     // $current_qty = tbl_product::where('product_id', $key)->value('product_quantity');
    //                     // compare the requested quantity with the current quantity
    //                     if($qty > $current_qty){
    //                         // print an error message and break the loop
    //                         echo "Không đủ số lượng sản phẩm. Bạn chỉ có thể đặt tối đa $current_qty sản phẩm.";
    //                         break;
    //                     }else{
    //                         // update the cart quantity
    //                         $cart[$session]['product_qty'] = $qty;
    //                     }
    //                 }
    //             }
    //         }
    //         Session::put('cart',$cart);
    //         return redirect()->back()->with('message','Cập nhật thành công!');
    //     }else{
    //         return redirect()->back()->with('message','Cập nhật thất bại!');
    //     }
    // }
    public function update_cart(Request $request){
        $data = $request->all();
        $cart = Session::get('cart');
        if($cart==true){
            $message = '';
            foreach($data['cart_qty'] as $key => $qty){
                foreach($cart as $session => $val){
                    if($val['session_id'] == $key && $qty<$cart[$session]['product_quantity']){
                        $cart[$session]['product_qty'] = $qty;
                        $message.='<p style="color:blue;">Cập nhật số lượng sản phẩm '.$cart[$session]['product_name'].' thành công</p>';
                    }elseif($val['session_id'] == $key && $qty>$cart[$session]['product_quantity']){
                        $message.='<p style="color:red;">Cập nhật số lượng sản phẩm '.$cart[$session]['product_name'].' thất bại</p>';
                    }
                }
            }
            Session::put('cart',$cart);
            return redirect()->back()->with('message',$message);
        }else{
            return redirect()->back()->with('message','Cập nhật thất bại!');
        }
    }
    public function del_all_product(){
        $cart = Session::get('cart');
        if($cart==true){
            Session::forget('cart');
            Session::forget('coupon');
            return redirect()->back()->with('message','Xóa giỏ hàng thành công!');
        }
    }

    //check coupon
    public function check_coupon(Request $request){
        $data = $request->all();
        $coupon = Coupon::where('coupon_code',$data['coupon'])->first();
        if($coupon){
            $count_coupon = $coupon->count();
            if($count_coupon>0){
                $coupon_session = Session::get('coupon');
                if($coupon_session==true){
                    $is_available = 0;
                    if($is_available==0){
                        $cou[] = array(
                            'coupon_code'=> $coupon->coupon_code,
                            'coupon_condition'=> $coupon->coupon_condition,
                            'coupon_number'=> $coupon->coupon_number,
                        );
                        Session::put('coupon',$cou);
                    }
                }else{
                    $cou[] = array(
                        'coupon_code'=> $coupon->coupon_code,
                        'coupon_condition'=> $coupon->coupon_condition,
                        'coupon_number'=> $coupon->coupon_number,
                    );
                    Session::put('coupon',$cou);
                }
                Session::save();
                return redirect()->back()->with('message','Thêm mã giảm giá thành công!');
            }
        }else{
            return redirect()->back()->with('error','Mã giảm giá không đúng!');
        }
    }
}
