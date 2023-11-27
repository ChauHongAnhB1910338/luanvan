<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Models\Gallery;
use App\HTTP\Requests;
use App\Models\Comment;
use App\Models\Rating;
use File;
use Session;
use Illuminate\Support\Facades\Redirect;
session_start();
class ProductController extends Controller
{
    public function AuthLogin(){
        $admin_id = Session::get('admin_id');
        if($admin_id){
            return Redirect::to('dashboard');
        } else return Redirect::to('admin')->send();
    }
    public function all_product(){
        $this->AuthLogin();
        $all_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->orderby('tbl_product.product_id','desc')->get();

        $manager_product = view('admin.all_product')->with('all_product',$all_product);
        return view('admin_layout')->with('admin.all_product',$manager_product);
    }
    public function add_product(){
        $this->AuthLogin();
        $cate_product = DB::table('tbl_category_product')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->orderby('brand_id','desc')->get();
        return view('admin.add_product')->with('cate_product',$cate_product)->with('brand_product',$brand_product);
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

        $path = 'public/uploads/product/';
        $path_gallery = 'public/uploads/gallery/';

        if($get_image){
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.',$get_name_image));
            $new_image = $name_image.rand(0,99).'.'.$get_image->getClientOriginalExtension();
            $get_image->move($path,$new_image);
            File::copy($path.$new_image,$path_gallery.$new_image);
            $data['product_image'] = $new_image;
        }
        $pro_id = DB::table('tbl_product')->insertGetId($data);
        $gallery = new Gallery();
        $gallery->gallery_image = $new_image;
        $gallery->gallery_name = $new_image;
        $gallery->product_id = $pro_id;
        $gallery->save();
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
    public function details_product($product_id){
        $cate_product = DB::table('tbl_category_product')->where('category_status','1')->orderby('category_id','desc')->get();
        $brand_product = DB::table('tbl_brand_product')->where('brand_status','1')->orderby('brand_id','desc')->get();
        $details_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_product.product_id',$product_id)->get();
        foreach ($details_product as $key => $value) {
            $category_id = $value->category_id;
            $product_id = $value->product_id;
            $product_name = $value->product_name;
            $product_cate_id = $value->category_id;
            $product_cate_name = $value->category_name;
        }
        //gallery
        $gallery = Gallery::where('product_id',$product_id)->get();

        //count-view
        $product = DB::table('tbl_product')->where('tbl_product.product_id', $product_id)->first();
        if ($product) {
            // Tăng số lượt xem lên 1
            $product->product_view += 1;

            // Lưu thay đổi vào cơ sở dữ liệu
            DB::table('tbl_product')->where('tbl_product.product_id', $product_id)->update(['product_view' => $product->product_view]);
        }
        //related
        $related_product = DB::table('tbl_product')
        ->join('tbl_category_product','tbl_category_product.category_id','=','tbl_product.category_id')
        ->join('tbl_brand_product','tbl_brand_product.brand_id','=','tbl_product.brand_id')
        ->where('tbl_category_product.category_id',$category_id)->whereNotIn('tbl_product.product_id',[$product_id])->get();
        //rating
        $rating = Rating::where('product_id',$product_id)->avg('rating');
        $customer_rating = Rating::where('product_id',$product_id)->where('customer_id',Session::get('customer_id'))->avg('rating');

        $rating = round($rating);

        return view('pages.product.show_detail')
        ->with('category',$cate_product)
        ->with('brand',$brand_product)
        ->with('product_details',$details_product)
        ->with('product_name',$product_name)
        ->with('relate',$related_product)
        ->with('product_cate_name',$product_cate_name)
        ->with('product_cate_id',$product_cate_id)
        ->with('gallery',$gallery)
        ->with('rating',$rating)
        ->with('customer_rating',$customer_rating)
        ;
    }
    public function load_comment(Request $request){
        $product_id = $request->product_id;
        $comment = Comment::where('comment_product_id',$product_id)->where('comment_status',1)->where('comment_parent_comment','=',NULL)->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->orderby('comment_id','DESC')->get();
        $output = '';
        foreach($comment as $key => $comm){
            $output.= '
                    <div class="row style_comment col-md-12" style="margin-top: 10px; margin-bot:10px;">
                        <div class="col-md-1">
                            <img width="70px" height="70px" src="'.url('/public/backend/images/1.png').'" class="img img-responsive img-thumbnail">
                        </div>
                        <div class="col-md-11">
                            <p style="color: blue">@'.$comm->comment_name.'</p>
                            <p style="color: green">'.$comm->comment_date.'</p>
                            <p style="color: black">'.$comm->comment.'</p>
                        </div>
                    </div>
                    ';
            foreach($comment_rep as $key => $rep_comment){
                if($rep_comment->comment_parent_comment == $comm->comment_id){
                    $output.= '
                            <div class="col-md-12">
                                <div class="row style_comment col-md-11" style="margin-top: 10px; margin-bot:10px; margin-left: 40px; margin-right: 20px">
                                    <div class="col-md-1">
                                        <img width="70px" height="70px" src="'.url('/public/frontend/images/hotro.jpg').'" class="img img-responsive img-thumbnail">
                                    </div>
                                    <div class="col-md-11">
                                        <p style="color: red">@Admin</p>
                                        <p style="color: green">'.$rep_comment->comment_date.'</p>
                                        <p style="color: black">'.$rep_comment->comment.'</p>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                </div>
                            </div>

                    ';
                }
            }
            
        }
        echo $output;
    }
    public function send_comment(Request $request){
        $product_id = $request->product_id;
        $comment_name = $request->comment_name;
        $comment_content = $request->comment_content;
        $comment = new Comment();
        $comment->comment = $comment_content;
        $comment->comment_name = $comment_name;
        $comment->comment_status = 0;
        $comment->comment_product_id = $product_id;
        $comment->comment_parent_comment = NULL;
        $comment->save();
    }
    public function list_comment(){
        $comment = Comment::with('product')->where('comment_parent_comment','=',NULL)->orderby('comment_id','DESC')->get();
        $comment_rep = Comment::with('product')->where('comment_parent_comment','>',0)->orderby('comment_id','DESC')->get();
        return view('admin.comment.list_comment')->with(compact('comment','comment_rep'));
    }
    public function allow_comment(Request $request){
        $data = $request->all();
        $comment = Comment::find($data['comment_id']);
        $comment->comment_status = $data['comment_status'];
        $comment->save();
    }
    public function reply_comment(Request $request){
        $data = $request->all();
        $comment = new Comment();
        $comment->comment = $data['comment'];
        $comment->comment_product_id = $data['comment_product_id'];
        $comment->comment_parent_comment = $data['comment_id'];
        $comment->comment_status = 1;
        $comment->comment_name = 'AnhChauStore';
        $comment->save();
        
    }
    public function insert_rating(Request $request){
        $data = $request->all();
        $ratingExists = DB::table('tbl_rating')->where('customer_id', $data['customer_id'])->where('product_id', $data['product_id'])->exists();
        if(!$ratingExists){
            $rating = new Rating();
            $rating->product_id = $data['product_id'];
            $rating->customer_id = $data['customer_id'];
            $rating->rating = $data['index'];
            $rating->save();
            echo 'done';
        }else{
            DB::table('tbl_rating')
            ->where('customer_id', $data['customer_id'])
            ->where('product_id',$data['product_id'])
            ->update(['rating' => $data['index']]);
            echo 'change';
        }
    }
}
