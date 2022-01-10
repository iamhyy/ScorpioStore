<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    public $timestamps = false;
    protected $fillable = ['order_code','prod_id','prod_name', 'prod_price','prod_sale_quantity','pord_coupon','fee_ship'];
    protected $primaryKey = 'detail_id';
    protected $table = 'order_details';
    public function product(){
        return $this->belongsTo('App\Models\product','prod_id');
    }
}
