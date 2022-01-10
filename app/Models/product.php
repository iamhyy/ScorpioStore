<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    public $timestamps = false;
    protected $fillable = ['cate_id','brand_id', 'prod_name','prod_content','prod_price','prod_price_new', 'prod_discount','prod_quantity','prod_size','prod_color','prod_image','prod_status'];
    protected $primaryKey = 'prod_id';
    protected $table = 'products';

    public function comment(){
        return $this->hasMany('App\Models\comment');
    }
}
