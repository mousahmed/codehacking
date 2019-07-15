<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    protected $fillable = ['author','post_id','is_active','email','content','photo'];
    public function post(){
        return $this->belongsTo('App\Post');
    }
    public function user(){
        return $this->belongsTo('App\User');
    }
    public function replies(){
        return $this->hasMany('App\CommentReply');
    }
}
