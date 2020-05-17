<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;

class Transaction extends Model
{
     use AutoNumberTrait;
    public function outlets()  
    {
        return $this->belongsToMany('App\Outlet');
    }

    public function pakets() 
    {
        return $this->belongsTo('App\Paket', 'pakets', 'id');
    }

    public function members() 
    {
        return $this->belongsToMany('App\Member');
    }

    public function getAutoNumberOptions()
    {
        return [
            'kode_invoice' => [
                'format' => function () {
                    return date('Y.m.d') . '/INV/?';
                },
                'length' => 5
            ]
        ];
    }
}
