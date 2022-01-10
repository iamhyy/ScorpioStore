<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class social extends Model
{
      public $timestamps = false;
    protected $fillable = [
          'provider_id',  'provider',  'user'
    ];
 
    protected $primaryKey = 'user_id';
    protected $table = 'social';
    public function login(){
        return $this->belongsTo('App\Models\Login', 'user');
    }

}
