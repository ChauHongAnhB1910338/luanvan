<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\HTTP\Requests;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class HomeController extends Controller
{
    public function index(){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        // Sắp xếp theo sản phẩm mới được thêm
        $newest_products = DB::table('tbl_product')->where('product_status', '1')->orderBy('created_at', 'desc')->limit(4)->get();

        // Sắp xếp theo sản phẩm có nhiều lượt view nhất
        $most_viewed_products = DB::table('tbl_product')->where('product_status', '1')->orderBy('product_view', 'desc')->limit(4)->get();
        return view('pages.home')->with('category',$cate_product)->with('brand',$brand_product)->with('newest_products',$newest_products)->with('most_viewed_products',$most_viewed_products);
    }
    public function search(Request $request){
        $keywords = $request->keywords_submit;
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        $search_product = DB::table('tbl_product')->where('product_name','like','%'.$keywords.'%')->get();
        return view('pages.product.search')->with('category',$cate_product)->with('brand',$brand_product)->with('search_product',$search_product);
    }
    public function san_pham()
    {
        $cate_product = DB::table('tbl_category_product')->where('category_status', '1')->orderBy('category_id', 'desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status', '1')->orderBy('brand_id', 'desc')->get();

        $sort_by = isset($_GET['sort_by']) ? $_GET['sort_by'] : '';

        $query = DB::table('tbl_product')->where('product_status', '1');

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

        $all_product = $query->paginate(12)->appends(request()->query());

        return view('pages.product')->with('category', $cate_product)->with('brand', $brand_product)->with('all_product', $all_product);
    }
    public function don_hang($customer_id){
        $order_customer = DB::table('tbl_order')->where('customer_id',$customer_id)->orderby('order_id','desc')->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        return view('pages.order')->with('category',$cate_product)->with('brand',$brand_product)->with('ordercustomer',$order_customer);
    }
    public function view_order_customer($order_code){
        $order_customer = DB::table('tbl_order_details')
        ->leftJoin('tbl_product', 'tbl_order_details.product_id', '=', 'tbl_product.product_id')
        ->leftJoin('tbl_coupon', 'tbl_order_details.product_coupon', '=', 'tbl_coupon.coupon_code')
        ->where('tbl_order_details.order_code', $order_code)
        // ->orderBy('tbl_order_details.order_details_id', 'asc')
        ->get();
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        
        // $all_product = DB::table('tbl_product')
        // ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        // ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        // ->orderby('tbl_product.product_id','desc')->get();
        return view('pages.order_Customer')->with('category',$cate_product)->with('brand',$brand_product)->with('ordercustomer',$order_customer);
    }
}
