<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    public $timestamps = false;
    protected $fillable = ['cus_id','ship_id','order_status', 'order_day','order_code','order_total'];
    protected $primaryKey = 'order_id';
    protected $table = 'orders';

    
}
