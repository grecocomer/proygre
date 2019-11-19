<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\pagos;
use App\users;
use Session; 
use Carbon\Carbon;
use DB;


class buscador extends Controller
{
    public function index()
    {

    $users=users::all()->where('tipo_user','=','Usuario');
    return view('modulos.producto.busqueda')
    ->with('users',$users);
    }

    function combopago(Request $request)
    {
         $iduser = $request->get('iduser');
         $pagos =DB::table('pagos')->Where('idc','=',$iduser)->get();
         return view ('modulos.producto.muestrapagos')
         ->with('pagos',$pagos);
         
    }


    public function modistatus(Request $request)
    {
        
        
    
       // pagos::find($request->idg)->delete();

        $deleted =\DB::update("UPDATE pagos SET pagos.`status`='Entregado' 
        WHERE idg= ?",[$request->idg]);
        $detalle =DB::table('pagoscli')->Where('idg','=',$request->idg)->get();

         ////////////////////////////
         $iduser = $request->get('iduser');
         $pagos =DB::table('pagoscli')->Where('idc','=',$iduser)->get();
         return view ('modulos.producto.muestrapagos')
         ->with('pagos',$pagos)
         ->with('deleted',$deleted);
    }


    public function descripcion(Request $request)
    {
        
        $pagos =DB::table('pagoscli')->Where('idg','=',$request->idg)->get();
        return view ('modulos.producto.descri')
        ->with('pagos',$pagos[0]);
    
    
    }

    
}
