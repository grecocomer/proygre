<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class municipios extends Model
{
    protected $primaryKey = 'idm';
    protected $fillable = ['idm','nombre', 'costo'];

}
