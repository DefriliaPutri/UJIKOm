<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Paket extends Model
{
    use SoftDeletes;
    public function outlets()  
    {
        return $this->belongsToMany('App\Outlet');
    }

    public function transactions()  
    {
        return $this->hasMany('App\Transaction');
    }
}
