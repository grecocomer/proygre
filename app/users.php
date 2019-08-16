<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;//guardar el registro eliminado

class users extends Model
{
    use SoftDeletes;

    protected $primaryKey = 'id_user';
    protected $fillable = ['id_user','nombre_user','ncompleto','tel','contrasena','correo','direccion','tipo_user'];

    protected $date=['deleted_at'];
}
