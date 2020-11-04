<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cola extends Model
{
    protected $fillable = ['id','url','user_id','format','state'];
    public $timestamps = false;
}

