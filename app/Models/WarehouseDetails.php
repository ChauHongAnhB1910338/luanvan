<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseDetails extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'warehouse_code','product_id','product_name','product_price','product_quantity','product_total'
    ];
    protected $primaryKey = 'warehouse_details_id';
    protected $table = 'tbl_warehouse_details';

    public function product(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
