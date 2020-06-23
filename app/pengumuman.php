<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pengumuman extends Model
{
    protected $table='pengumuman';
    protected $fillable=[
        'isi'
    ];
}
