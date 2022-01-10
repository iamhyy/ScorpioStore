<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class statistic extends Model
{
    public $timestamps = false;
    protected $fillable = [
          'order_date',  'sales',  'profit', 'quantity', 'order_total'
    ];
 
    protected $primaryKey = 'statistic_id';
    protected $table = 'statistic';
}
