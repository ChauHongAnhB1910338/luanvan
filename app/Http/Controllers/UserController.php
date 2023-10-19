<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;
use App\Models\Roles;
use App\Models\Admin;
use Session;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $admin = Admin::with('roles')->orderBy('admin_id','DESC')->paginate(10);
        return view('admin.users.all_users')->with(compact('admin'));
    }
    public function add_users(){
        return view('admin.users.add_users');
    }
    public function delete_user_roles($admin_id){
        if(Session::get('admin_id') == $admin_id){
            return redirect()->back()->with('message','Không thể xóa tài khoản của chính mình');
        }else{
            DB::table('tbl_admin')->where('admin_id',$admin_id)->delete();
            DB::table('admin_roles')->where('admin_admin_id', $admin_id)->delete();
            Session::put('message','Xóa tài khoản thành công!');
        }
        return redirect()->back()->with('message','Xóa tài khoản thành công');
    }
    public function assign_roles(Request $request){
        if(Session::get('admin_id') == $request->admin_id){
            return redirect()->back()->with('message','Không thể tự phân quyền cho chính mình');
        }
        $data = $request->all();
        $user = Admin::where('admin_email',$data['admin_email'])->first();
        $user->roles()->detach();
        if($request['user_role']){
           $user->roles()->attach(Roles::where('name','Nhân viên')->first());     
        }
        if($request['admin_role']){
           $user->roles()->attach(Roles::where('name','Admin')->first());     
        }
        return redirect()->back();
    }
    public function store_users(Request $request){
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        $admin->roles()->attach(Roles::where('name','Nhân viên')->first());
        Session::put('message','Thêm users thành công');
        return Redirect::to('users');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }



}
