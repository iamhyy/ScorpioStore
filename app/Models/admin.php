<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class admin extends Model
{
    public $timestamps = false;
    protected $fillable = ['admin_email',  'admin_password' ,'admin_name','admin_phone', 'admin_role'];
    protected $primaryKey = 'admin_id';
    protected $table = 'admin';
}
