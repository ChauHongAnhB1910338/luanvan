<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\HTTP\Requests;
use Session;
use App\Models\Statistic;
use App\Models\Product;
use App\Models\Order;
use App\Models\Admin;
use App\Models\Customer;

use Illuminate\Support\Facades\Redirect;
use Carbon\Carbon;
session_start();

class AdminController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        $admin_role = Session::get('admin_role');
        if($admin_id ){
            return Redirect::to('dashboard');
        } else return Redirect::to('admin')->send();
    }
    public function index(){
        return view('admin_login');
    }
    public function show_dashboard(){
        $this->AuthLogin();
        $product = Product::all()->count();
        $order_online = Order::where('order_store', 0)->count();
        $order_store = Order::where('order_store', 1)->count();
        $admin = Admin::all()->count();
        $customer = Customer::all()->count();
        return view('admin.dashboard')->with(compact('product','order_store','order_online','admin','customer'));
    }
    public function dashboard(Request $request){
        $admin_email = $request->admin_email;
        $admin_password = md5($request->admin_password);

        $result = DB::table('tbl_admin')->where('admin_email',$admin_email)->where('admin_password',$admin_password)->first();
        if($result){
            Session::put('admin_name',$result->admin_name);
            Session::put('admin_id',$result->admin_id);
            Session::put('admin_role',$result->admin_role);
            return Redirect::to('/dashboard');
        } else {
            Session::put('message','Sai tài khoản hoặc mật khẩu!');
            return Redirect::to('/admin');
        }
    }
    public function logout(){
        $this->AuthLogin();
        Session::put('admin_id',NULL);
        Session::put('admin_name',NULL);
        Session::put('admin_role',NULL);
        return Redirect::to('/admin');
       
    }
    public function filter_by_date(Request $request){
        $data = $request->all();
        $from_date = $data['from_date'];
        $to_date = $data['to_date'];
        $get = Statistic::whereBetween('order_date',[$from_date,$to_date])->orderBy('order_date','ASC')->get();

        foreach($get as $key => $val){
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }

    public function dashboard_filter(Request $request) {
        $data = $request->all();
        $dauthangnay = Carbon::now('Asia/Ho_Chi_Minh')->startOfMonth()->format('m/d/Y');
        $dau_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->startOfMonth()->format('m/d/Y');
        $cuoi_thangtruoc = Carbon::now('Asia/Ho_Chi_Minh')->subMonth()->endOfMonth()->format('m/d/Y');
        $sub7days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(7)->format('m/d/Y');
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('m/d/Y');
        if($data['dashboard_value']=='7ngay'){
            $get = Statistic::whereBetween('order_date',[$sub7days,$now])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangtruoc'){
            $get = Statistic::whereBetween('order_date',[$dau_thangtruoc,$cuoi_thangtruoc])->orderBy('order_date','ASC')->get();
        }elseif($data['dashboard_value']=='thangnay'){
            $get = Statistic::whereBetween('order_date',[$dauthangnay,$now])->orderBy('order_date','ASC')->get();
        }
        foreach($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
    
    public function filter30(Request $request){
        $data = $request->all();

        $sub30days = Carbon::now('Asia/Ho_Chi_Minh')->subdays(30)->format('m/d/Y');
        $now = Carbon::now('Asia/Ho_Chi_Minh')->format('m/d/Y');
        $get = Statistic::whereBetween('order_date',[$sub30days,$now])->orderBy('order_date','ASC')->get();

        foreach($get as $key => $val) {
            $chart_data[] = array(
                'period' => $val->order_date,
                'order' => $val->total_order,
                'sales' => $val->sales,
                'profit' => $val->profit,
                'quantity' => $val->quantity
            );
        }
        echo $data = json_encode($chart_data);
    }
}
