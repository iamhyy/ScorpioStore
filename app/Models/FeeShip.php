<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FeeShip extends Model
{
    public $timestamps = false;
    protected $fillable = ['city_id', 'province_id', 'wards_id', 'fee_feeship'];
    protected $primaryKey = 'fee_id';
    protected $table = 'fee_ship';

    public function city(){
        return $this->belongsTo('App\Models\City', 'city_id');
    }
    public function province(){
        return $this->belongsTo('App\Models\Province', 'province_id');
    }
    public function wards(){
        return $this->belongsTo('App\Models\Wards', 'wards_id');
    }
}
