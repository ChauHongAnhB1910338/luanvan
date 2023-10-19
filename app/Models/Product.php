<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'product_name','product_code','category_id','brand__id','product_desc','product_content','product_price','price_cost','product_image','product_status'
    ];
    protected $primaryKey = 'product_id';
    protected $table = 'tbl_product';

    public function comment(){
        return $this->hasMany('App\Models\Comment');
    }
}
