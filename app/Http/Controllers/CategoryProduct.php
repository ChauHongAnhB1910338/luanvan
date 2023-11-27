<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\HTTP\Requests;
use App\Models\Product;
use App\Models\CategoryProductModel;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class CategoryProduct extends Controller
{
    // Function Admin Pages
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        } else return Redirect::to('admin')->send();
    }
    public function all_category_product(){
        $this->AuthLogin();
        $all_category_product = DB::table('tbl_category_product')->get();
        $manager_category_product = view('admin.all_category_product')->with('all_category_product',$all_category_product);
        return view('admin_layout')->with('admin.all_category_product',$manager_category_product);
    }
    public function add_category_product(){
        $this->AuthLogin();
        return view('admin.add_category_product');
    }
    public function save_category_product(Request $request){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        $data['category_status'] = $request->category_product_status;
        
        DB::table('tbl_category_product')->insert($data);
        Session::put('message','Thêm danh mục thành công!');
        return Redirect::to('add-category-product');
    }
    public function active_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>1]);
        Session::put('message','Kích hoạt danh mục thành công!');
        return Redirect::to('all-category-product');
    }
    public function unactive_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update(['category_status'=>0]);
        Session::put('message','Hủy kích hoạt danh mục thành công!');
        return Redirect::to('all-category-product');
    } 
    public function edit_category_product($category_product_id){
        $this->AuthLogin();
        $edit_category_product = DB::table('tbl_category_product')->where('category_id',$category_product_id)->get();
        $manager_category_product = view('admin.edit_category_product')->with('edit_category_product',$edit_category_product);
        return view('admin_layout')->with('admin.edit_category_product',$manager_category_product);
    }
    public function update_category_product(Request $request,$category_product_id){
        $this->AuthLogin();
        $data = array();
        $data['category_name'] = $request->category_product_name;
        $data['category_desc'] = $request->category_product_desc;
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->update($data);
        Session::put('message','Cập nhật danh mục thành công!');
        return Redirect::to('all-category-product');
    }
    public function delete_category_product($category_product_id){
        $this->AuthLogin();
        DB::table('tbl_category_product')->where('category_id',$category_product_id)->delete();
        Session::put('message','Xóa danh mục thành công!');
        return Redirect::to('all-category-product');
    }

    //End Function AdminPages
    public function show_category_home($category_id)
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderBy('brand_id', 'desc')->get();

        $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : '';

        $query = Product::with('category')->where('category_id', $category_id);

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

        $category_by_id = $query->paginate(6)->appends(request()->query());

        $category_name = DB::table('tbl_category_product')->where('category_id', $category_id)->limit(1)->get();

        return view('pages.category.show_category')->with('category', $cate_product)->with('brand', $brand_product)->with('category_by_id', $category_by_id)->with('category_name', $category_name);
    }
    
}
