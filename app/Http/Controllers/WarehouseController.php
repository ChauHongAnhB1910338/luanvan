<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Warehouse;
use App\Models\WarehouseDetails;
use App\Models\Product;
use Carbon\Carbon;
use App\HTTP\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class WarehouseController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        } else return Redirect::to('admin')->send();
    }
    public function view_warehouse($warehouse_code){
        $this->AuthLogin();
        $warehouse_details = WarehouseDetails::with('product')->where('warehouse_code',$warehouse_code)->get();
        $warehouse = Warehouse::where('warehouse_code',$warehouse_code)->get();
        foreach($warehouse as $key => $ware){
            $admin_id = $ware->admin_id;
            $warehouse_notes = $ware->warehouse_notes;
            $warehouse_date = $ware->warehouse_date;
        }
        $warehouse_details = WarehouseDetails::with('product')->where('warehouse_code',$warehouse_code)->get();

        return view('admin.view_details_warehouse')->with(compact('warehouse_details','admin_id','warehouse_notes','warehouse_date'));
    }

    public function nhap_hang(Request $request){

        $data = $request->all();

        $warehouse = new Warehouse();
        $warehouse->admin_id = '1';
        $checkout_code = substr(md5(microtime()),rand(0,26),5);
        $warehouse->warehouse_code = $checkout_code;
        $warehouse->warehouse_notes = $data['warehouse_notes'];
        // $warehouse->warehouse_notes = 'Thử nghiệm';
        date_default_timezone_set('Asia/Ho_Chi_Minh');
        $today = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i:s');
        $warehouse->warehouse_date = $today;
        $warehouse->save();

        // Lấy dữ liệu từ mảng "data" và lưu vào cơ sở dữ liệu warehouseDetails
            $danhSachSanPham = json_decode($data['data'], true);
        foreach($danhSachSanPham as $sanPham){
            $warehouseDetail = new WarehouseDetails();
            $warehouseDetail->warehouse_code = $checkout_code;
            $warehouseDetail->product_id = $sanPham['product_id'];
            $warehouseDetail->product_name = $sanPham['product_name'];
            $warehouseDetail->product_quantity = $sanPham['quantity'];
            $warehouseDetail->product_price = $sanPham['price'];
            $warehouseDetail->product_total = $sanPham['fee'];
            $warehouseDetail->save();

            // Tìm sản phẩm trong bảng tbl_product dựa trên id_product
            $product = Product::find($sanPham['product_id']);

            // Cộng product_quantity vào thuộc tính product_quantity của bảng tbl_product
            $product->product_quantity += $sanPham['quantity'];
            $product->save();
        }
        
    }
    public function warehouse(){
        $this->AuthLogin();
        $warehouse = Warehouse::orderby('warehouse_date','DESC')->get();
        return view('admin.warehouse')->with(compact('warehouse'));
    }
    public function addproduct_warehouse(){
        $this->AuthLogin();
        $addproduct_warehouse = DB::table('tbl_product')
        ->orderby('tbl_product.product_id','desc')->get();
        return view('admin.addproduct_warehouse')->with('all_product',$addproduct_warehouse);
    }
    public function save_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['product_sold'] = 0;
        $data['price_cost'] = $request->price_cost;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;
        
        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->insert($data);
            Session::put('message','Thêm sản phẩm thành công!');
            return Redirect::to('all-product');
        }
        $data['product_image'] = '';
        DB::table('tbl_product')->insert($data);
        Session::put('message','Thêm sản phẩm thành công!');
        return Redirect::to('all-product');
    }
    public function active_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>1]);
        Session::put('message','Kích hoạt sản phẩm thành công!');
        return Redirect::to('all-product');
    }
    public function unactive_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->update(['product_status'=>0]);
        Session::put('message','Hủy kích hoạt sản phẩm thành công!');
        return Redirect::to('all-product');
    } 
    public function edit_product($product_id){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();

        $edit_product = DB::table('tbl_product')->where('product_id',$product_id)->get();
        $manager_product = view('admin.edit_product')->with('edit_product',$edit_product)->with('cate_product',$cate_product)->with('brand_product',$brand_product);
        return view('admin_layout')->with('admin.edit_product',$manager_product);
    }
    public function update_product(Request $request,$product_id){
        $this->AuthLogin();
        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['product_price'] = $request->product_price;
        $data['price_cost'] = $request->price_cost;
        $data['product_desc'] = $request->product_desc;
        $data['product_content'] = $request->product_content;
        $data['category_id'] = $request->product_cate;
        $data['brand_id'] = $request->product_brand;
        $data['product_status'] = $request->product_status;

        $get_image = $request->file('product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/product',$new_image);
            $data['product_image'] = $new_image;
            DB::table('tbl_product')->where('product_id',$product_id)->update($data);
            Session::put('message','Cập nhật sản phẩm thành công!');
            return Redirect::to('all-product');
        }

        DB::table('tbl_product')->where('product_id',$product_id)->update($data);
        Session::put('message','Cập nhật sản phẩm không thành công!');
        return Redirect::to('all-product');
    }
    public function delete_product($product_id){
        $this->AuthLogin();
        DB::table('tbl_product')->where('product_id',$product_id)->delete();
        Session::put('message','Xóa sản phẩm thành công!');
        return Redirect::to('all-product');
    }
    //End Admin
}

