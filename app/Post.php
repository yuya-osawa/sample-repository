<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['amount', 'image', 'comment', 'title', 'date', 'del_flg', 'user_id', 'report_count'];

    protected $table = 'posts';

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function jobask()
    {
        return $this->belongsTo('App\Jobask');
    }

    public function spam()
    {
        return $this->belongsTo('App\Spam');
    }
}
