<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Spam extends Model
{
    protected $fillable=[
        'report',
        'posts_id',
        'users_id',
    ]; 

    protected $table='spam';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function post(){
        return $this->belongsTo('App\Post');
    }
}
