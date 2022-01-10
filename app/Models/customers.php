<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class customers extends Model
{
    public $timestamps = false;
    protected $fillable = ['cus_name','cus_email','cus_password', 'cus_phone'];
    protected $primaryKey = 'cus_id';
    protected $table = 'customers';
}
