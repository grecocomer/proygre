<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class pagoscli extends Model
{
    protected $primaryKey = 'idc';
    protected $fillable = ['idc','idg', 'payment_id','precio','ncompleto','me','sta'];
}
