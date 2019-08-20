<?php

namespace App;


use Illuminate\Database\Eloquent\Model;




class pagos extends Model
{

    public $timestamps = false;
    protected $primaryKey = 'idg';
    protected $fillable = ['idg','idc', 'payment_id','preciot','descripcion','fecha','metodo','status'];

}
