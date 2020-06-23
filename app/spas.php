<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class spas extends Model
{
    protected $table='userpass';
    protected $fillable=[
        'name',
        'pass',
        'noreg'
    ];
}
