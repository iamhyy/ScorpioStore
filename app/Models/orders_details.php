<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders_details extends Model
{
    public $timestamps = false;
    protected $fillable = ['order_code','prod_id','prod_name', 'prod_price','prod_sale_quantity','pord_coupon','fee_ship'];
    protected $primaryKey = 'detail_id';
    protected $table = 'order_details';
    
}
