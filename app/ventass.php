<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;//guardar el registro eliminado

class ventass extends Model
{

    use SoftDeletes;
    protected $primaryKey = 'id_vs';
    protected $fillable = ['id_vs','fecha_venta_ser','total_vs'];
    protected $table='ventass';
}
