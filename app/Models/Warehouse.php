<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'warehouse_id','warehouse_code','admin_id','warehouse__notes','warehouse_date'
    ];
    protected $primaryKey = 'warehouse_id';
    protected $table = 'tbl_warehouse';
}
