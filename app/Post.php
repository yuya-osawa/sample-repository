<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable=['amount','image','comment','title','date','del_flg','user_id']; 
    
    protected $table='posts';

     public function user(){
        return $this->belongsTo('App\User');
    }

}
