<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;//guardar el registro eliminado

class cotizaciones extends Model
{
    use SoftDeletes;
    
    protected $primaryKey = 'idc';
    protected $fillable = ['idc','id_user','cliente', 'telefono','emal','empresa','servicio','municipio','costo'];

}
