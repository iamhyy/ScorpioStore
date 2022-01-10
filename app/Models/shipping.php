<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class shipping extends Model
{
    public $timestamps = false;
    protected $fillable = ['ship_name','ship_email','ship_phone', 'ship_address', 'ship_note', 'ship_method'];
    protected $primaryKey = 'ship_id';
    protected $table = 'shipping';
}
