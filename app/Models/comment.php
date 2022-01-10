<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class comment extends Model
{
    public $timestamps = false;
    protected $fillable = ['comment', 'comment_name', 'comment_date','comment_status','comment_before', 'prod_id'];
    protected $primaryKey = 'comment_id';
    protected $table = 'comments';

    public function product(){
        return $this->belongsTo('App\Models\product', 'prod_id');
    }
}
