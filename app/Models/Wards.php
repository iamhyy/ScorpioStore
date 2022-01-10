<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wards extends Model
{
    public $timestamps = false;
    protected $fillable = ['name_xa', 'type', 'maqh'];
    protected $primaryKey = 'xaid';
    protected $table = 'wards';
}
