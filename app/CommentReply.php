<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentReply extends Model
{
    //
    protected $fillable = ['author','comment_id','is_active','email','content','photo'];

    public function comment(){
        return $this->belongsTo('App\Comment');
    }
}
