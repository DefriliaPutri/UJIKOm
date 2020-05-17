<?php

namespace App;


use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Member extends Model
{
    use softDeletes;
    public function transactions()  
    {
        return $this->belongsToMany('App\Transaction');
    }
}
