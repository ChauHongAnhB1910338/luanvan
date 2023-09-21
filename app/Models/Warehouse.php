<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    public $timestamps = false;
    protected $fillable = [
        'warehouse_id','admin_id','warehouse__notes'
    ];
    protected $primaryKey = 'warehouse_id';
    protected $table = 'tbl_warehouse';
}
