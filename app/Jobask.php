<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Jobask extends Model
{
    protected $fillable=['amount','image','comment','title','date','del_flg','user_id','post_id']; 
    
    protected $table='jobask';

     public function user(){
        return $this->belongsTo('App\User');
    }

    public function post(){
        return $this->belongsTo('App\Post');
    }
}
