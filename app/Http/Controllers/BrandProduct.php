<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\HTTP\Requests;
use Session;
use App\Models\Product;

use App\Models\Brand;
use Illuminate\Support\Facades\Redirect;
session_start();
class BrandProduct extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        } else return Redirect::to('admin')->send();
    }
    public function all_brand_product(){
        $this->AuthLogin();
        $all_brand_product = DB::table('tbl_brand_product')->get();
        // $all_brand_product = Brand::all();
        $manager_brand_product = view('admin.all_brand_product')->with('all_brand_product',$all_brand_product);
        return view('admin_layout')->with('admin.all_brand_product',$manager_brand_product);
    }
    public function add_brand_product(){
        $this->AuthLogin();
        return view('admin.add_brand_product');
    }
    public function save_brand_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $data['brand_status'] = $request->brand_product_status;

        $get_image = $request->file('brand_product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/brand',$new_image);
            $data['brand_image'] = $new_image;
            DB::table('tbl_brand_product')->insert($data);
            Session::put('message','Thêm thương hiệu thành công!');
            return Redirect::to('add-brand-product');
        }
        $data['brand_image'] = '';
        DB::table('tbl_brand_product')->insert($data);
        Session::put('message','Thêm thương hiệu thành công!');
        return Redirect::to('add-brand-product');
    }
    public function active_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=>1]);
        Session::put('message','Kích hoạt thương hiệu thành công!');
        return Redirect::to('all-brand-product');
    }
    public function unactive_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update(['brand_status'=>0]);
        Session::put('message','Hủy kích hoạt thương hiệu thành công!');
        return Redirect::to('all-brand-product');
    } 
    public function edit_brand_product($brand_product_id){
        $this->AuthLogin();
        $edit_brand_product = DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->get();
        $manager_brand_product = view('admin.edit_brand_product')->with('edit_brand_product',$edit_brand_product);
        return view('admin_layout')->with('admin.edit_brand_product',$manager_brand_product);
    }
    public function update_brand_product(Request $request,$brand_product_id){
        $this->AuthLogin();
        $data = array();
        $data['brand_name'] = $request->brand_product_name;
        $data['brand_desc'] = $request->brand_product_desc;
        $get_image = $request->file('brand_product_image');
        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move('public/uploads/brand',$new_image);
            $data['brand_image'] = $new_image;
            DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->update($data);
            Session::put('message','Chỉnh sửa thương hiệu thành công!');
            return Redirect::to('all-brand-product');
        }
        $data['brand_image'] = '';
        DB::table('tbl_brand_product')->insert($data);
        Session::put('message','Chỉnh sửa thương hiệu thành công!');
        return Redirect::to('all-brand-product');
    }
    public function delete_brand_product($brand_product_id){
        $this->AuthLogin();
        DB::table('tbl_brand_product')->where('brand_id',$brand_product_id)->delete();
        Session::put('message','Xóa thương hiệu thành công!');
        return Redirect::to('all-brand-product');
    }
    // End Admin
    public function show_brand_home($brand_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderBy('brand_id', 'desc')->get();

        $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : '';

        $query = Product::with('category')->where('brand_id', $brand_id);

        switch ($sort_by) {
            case 'giam_dan':
                $query->orderByRaw('CAST(product_price AS DECIMAL(10,2)) DESC');
                break;
            case 'tang_dan':
                $query->orderByRaw('CAST(product_price AS DECIMAL(10,2)) ASC');
                break;
            case 'kytu_za':
                $query->orderBy('product_name', 'desc');
                break;
            case 'kytu_az':
                $query->orderBy('product_name', 'asc');
                break;
            case 'duoi200':
                $query->where('product_price', '<', 200000)->orderBy('product_price', 'asc');
                break;
            case '200_500':
                $query->whereBetween('product_price', [200000, 500000])->orderBy('product_price', 'asc');
                break;
            case '500_1000':
                $query->whereBetween('product_price', [500000, 1000000])->orderBy('product_price', 'asc');
                break;
            case 'tren1000':
                $query->where('product_price', '>', 1000000)->orderBy('product_price', 'asc');
                break;
            default:
                $query->orderBy('product_id', 'desc');
                break;
        }

        $brand_by_id = $query->paginate(6)->appends(request()->query());
        $brand_name = DB::table('tbl_brand_product')->where('brand_id', $brand_id)->limit(1)->get();

        return view('pages.brand.show_brand')->with('category', $cate_product)->with('brand', $brand_product)->with('brand_by_id', $brand_by_id)->with('brand_name', $brand_name);
    }
}
