<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    //
    protected $directory = "/images/";
    protected $fillable = ['path','user_id'];
    public function user(){
        return $this->hasOne('App\User');
    }
    public function getPathAttribute($photo){
        return $this->directory . $photo ;
    }
}
