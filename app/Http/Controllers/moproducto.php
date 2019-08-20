<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\catproductos;
use App\productos;
use App\marcaproductos;
use App\detalle_vp;
use App\ventasp;
use App\clientes;
use App\estados;
use App\users;
use App\pagos;
use Session; 
use Carbon\Carbon;
use DB;

class moproducto extends Controller
{
    public function venta(){
//return view('modulos.producto.moproducto');

$clavequesigue = ventasp::orderBy('id_vp','desc')
->take(1)->get();
$cuantos = count($clavequesigue);
if($cuantos==0)
{
$id_vp= 1;
}
else
{
$id_vp = $clavequesigue[0]->id_vp+1;   
}

$fecha_venta=carbon::now();
//$fecha_venta=$fecha_venta->format('d-m-Y');
$catproductos = catproductos::all();
$clientes = clientes::withTrashed()->orderBy('idc','asc')
    ->get();

return view('modulos.producto.moproducto')
->with('catproductos',$catproductos)
->with('clientes',$clientes)
->with('id_vp',$id_vp)
//->with('fecha_venta',$fecha_venta);
->with('fecha_venta',$fecha_venta->toDateString());
//->with('fecha_venta',$fecha_venta->format('y-m-d'));

    }

    function combopro(Request $request)
       {
            $id_cat_producto = $request->get('id_cat_producto');
            $productos = productos::where('id_cat_producto','=',$id_cat_producto)->get();
             return view ('modulos.producto.comp')->with('productos',$productos);
       }

       function detallep(Request $request)
       {

        
       
           // todo esto sirve para mostrar los detalles del producto pero en marca solo muestra el id
          $id_prod = $request->get('id_prod');
          //  $nom_marca = $request->get('nom_marca');
         $productos = productos::where('id_prod','=',$id_prod)->get();
          //  $marcaproductos = marcaproductos::where('nom_marca','=',$nom_marca)->get();

          $marca=\DB::select(" SELECT  m.nom_marca AS marca
         FROM productos AS p 
         INNER JOIN marcaproductos AS m ON p.id_marca = m.id_marca
         WHERE p.id_prod = ?",[$id_prod]); 

         return view ('modulos.producto.detallepro')
         ->with('productos',$productos[0])
         ->with('marca',$marca[0]);
           // ->with('nom_marca',$nom_marca);

           // todo esto sirve para mostrar los detalles del producto pero en marca muestra el nombre

      
   
       
       }

       function carrito(Request $request)
    {
	
        
        $exist = $request->Existencia;
		$cantidad = $request->cantidad;

        $ventasp = ventasp::where('id_vp',$request->id_vp)->get();
       
		$cuantos = count($ventasp);
	
	
        if($cuantos==0)
        {   
          
            $ventasp = new ventasp;
			$ventasp->id_vp = $request->id_vp;
			$ventasp->idc = $request->idcl;
            $ventasp->fecha_venta =$request->fecha_venta;
			$ventasp->save();
            
            $detalle_vp = new detalle_vp;
            $detalle_vp->id_vp = $request->id_vp;
            $detalle_vp->id_prod = $request->id_prod;
            $detalle_vp->cantidad = $request->cantidad;
            $detalle_vp->costo = $request->subt / $request->cantidad ;
            $detalle_vp->descuento = $request->des;
            $detalle_vp->save();
           
        }
        else
        {
            $detalle_vp = new detalle_vp;
            $detalle_vp->id_vp = $request->id_vp;
            $detalle_vp->id_prod = $request->id_prod;
            $detalle_vp->cantidad = $request->cantidad;
            $detalle_vp->costo = $request->subt / $request->cantidad ;
            $detalle_vp->descuento = $request->des;
            $detalle_vp->save();
        }
       // echo $request->idcl."<br>";
        $totp = $exist - $cantidad;
	
	    $updated = \DB::update('update productos set Existencia=? 
                           where id_prod=?',[$totp + $cantidad,$request->id_prod]);
                           
        $resultado=\DB::select("SELECT vd.id_dvp,
        vd.id_prod,
        vd.cantidad,
        vd.costo,
        vd.cantidad * vd.costo - vd.descuento AS subt,
        p.nombre_prod,
        p.descripcion_prod AS dcp,
        p.Archivo
        FROM detalle_vp AS vd
        INNER JOIN productos AS p ON p.id_prod = vd.id_prod
        WHERE vd.id_vp= ?",[$request->id_vp]);
        
       $resultado2=\DB::select("SELECT SUM(cantidad*costo)-SUM(descuento) AS subtotal,
       ROUND((SUM(cantidad*costo)-SUM(descuento))*0.16,2) AS iva,
       SUM(cantidad*costo)-SUM(descuento)+ ROUND((SUM(cantidad*costo)-SUM(descuento))*0.16,2)  AS total,
       SUM(cantidad) AS suca
       FROM detalle_vp
       WHERE id_vp = ?",[$request->id_vp]);

        $resultado3=\DB::select("SELECT vd.id_vp,
        vd.id_prod,
        vd.cantidad,
        vd.costo,
        vd.cantidad * vd.costo - vd.descuento AS subt,
        p.nombre_prod,
        p.descripcion_prod AS dcp
        FROM detalle_vp AS vd
        INNER JOIN productos AS p ON p.id_prod = vd.id_prod
        WHERE vd.id_vp= ?",[$request->id_vp]);


    $resultado4=\DB::select("SELECT vd.id_vp,GROUP_CONCAT(vd.`cantidad`,' ',p.descripcion_prod,' ') AS dcp
    FROM detalle_vp AS vd
    INNER JOIN productos AS p ON p.id_prod = vd.id_prod
    WHERE vd.id_vp= ?",[$request->id_vp]);

      /*  $resultado3=\DB::select("SELECT SUM(vp.`cantidad`) AS suca
        FROM detalle_vp AS vp
        WHERE id_vp  = ?",[$request->id_vp]);*/
    
       return view ('modulos.producto.listap')
       ->with('resultado',$resultado)
       ->with('resultado3',$resultado3[0])
       ->with('resultado2',$resultado2[0])
       ->with('resultado4',$resultado4[0]);
    }

    public function borraventas(Request $request)
    {
        $canti = $request->canti;
        $ventasp = detalle_vp::where('id_dvp',$request->id_dvp)->get();
        $id_vp = $ventasp[0]->id_vp;
        $id_prod = $ventasp[0]->id_prod;

        $productos = productos::where('id_prod',$id_prod)->get();
        $exist = $productos[0]->Existencia;

        $updated = \DB::update('update productos set Existencia=Existencia +? where id_prod=?',[$canti ,$id_prod]);


        detalle_vp::find($request->id_dvp)->delete();
         ////////////////////////////
     //echo "borraventasp con clave $request->id_dvp con venta $id_vp ";
     $resultado=\DB::select("SELECT vd.id_dvp, vd.id_prod ,vd.cantidad, vd.costo,vd.cantidad * vd.costo - vd.descuento AS subt,
     p.nombre_prod,
     p.Archivo
     FROM detalle_vp AS vd
     INNER JOIN productos AS p ON p.id_prod = vd.id_prod
     WHERE vd.id_vp= ?",[$id_vp]);
        
        

    $resultado2=\DB::select("SELECT SUM(cantidad*costo)-SUM(descuento) AS subtotal,
    ROUND((SUM(cantidad*costo)-SUM(descuento))*0.16,2) AS iva,
    SUM(cantidad*costo)-SUM(descuento)+ ROUND((SUM(cantidad*costo)-SUM(descuento))*0.16,2)  AS total,
    SUM(cantidad) AS suca
    FROM detalle_vp
    WHERE id_vp = ?",[$id_vp]);

    $resultado4=\DB::select("SELECT vd.id_vp,GROUP_CONCAT(vd.`cantidad`,' ',p.descripcion_prod,' ') AS dcp
    FROM detalle_vp AS vd
    INNER JOIN productos AS p ON p.id_prod = vd.id_prod
    WHERE vd.id_vp= ?",[$id_vp]);

  /* $resultado3=\DB::select("SELECT SUM(vp.`cantidad`) AS suca
    FROM detalle_vp AS vp
    WHERE id_vp  = ?",[$request->id_vp]);*/
        
       return view ('modulos.producto.listap')
       ->with('resultado',$resultado)
     ->with('resultado2',$resultado2[0])
     ->with('resultado4',$resultado4[0]);
    // ->with('resultado3',$resultado3);
    }

    public function restaura(Request $request)
    {
        $produ = $request->id_prod;


     $resultado=\DB::select("SELECT p.`Existencia`
     FROM productos AS p
     WHERE p.`id_prod`= ?",[$id_prod]);

     return view ('modulos.producto.restaura')
     ->with('resultado',$resultado[0]);

    
    }

    //muestra los datos de los clientes
    public function reportepay()
    {
      if(Session::get('sesionidu')!="")
		{
    //  $clientes = clientes::orderBy('nombrecli','asc')->get();
    // return view ('cliente.reportecli')->with('clientes',$clientes);
    
      $res=\DB::select("SELECT p.`idg`AS idg,u.`nombre_user` AS nombre,u.`correo` AS email,u.`ncompleto` AS nco,u.`tel` AS tel,u.`direccion` AS direc,p.`payment_id` AS payment_id,p.`preciot` AS precio,
      p.`descripcion` AS descr,p.`fecha` AS fecha,p.`metodo` AS me,p.`status` AS sta
      FROM pagos AS p
      INNER JOIN users AS u ON u.`id_user`=p.`idc`
      WHERE p.`idc` =?",[Session::get('sesionidu')]);

      $pagos=\DB::select("SELECT p.`idg`AS idg,u.`nombre_user` AS nombre,u.`correo` AS email,u.`ncompleto` AS nco,u.`tel` AS tel,u.`direccion` AS direc,p.`payment_id` AS payment_id,p.`preciot` AS precio,
      p.`descripcion` AS descr,p.`fecha` AS fecha,p.`metodo` AS me,p.`status` AS sta
      FROM pagos AS p
      INNER JOIN users AS u ON u.`id_user`=p.`idc`
      WHERE p.`idc` =?",[Session::get('sesionidu')]);

   //   rutas para mandar a llamar la vista 1.-carpeta 2.-nombre de la vista
     return view ('modulos.producto.pagoscli')
     ->with('pagos',$pagos[0])
     ->with('res',$res);
    }
    else
    {
      Session::flash('error', 'El usuario esta desactivado, favor de consultar a su administrador');
     return redirect()->route('login');
    }
    }


    
    function detalles($idg)
    {

        $res=\DB::select("SELECT p.`idg`AS idg,u.`nombre_user` AS nombre,u.`correo` AS email,u.`ncompleto` AS nco,u.`tel` AS tel,u.`direccion` AS direc,p.`payment_id` AS payment_id,p.`preciot` AS precio,
        p.`descripcion` AS descr,p.`fecha` AS fecha,p.`metodo` AS me,p.`status` AS sta
        FROM pagos AS p
        INNER JOIN users AS u ON u.`id_user`=p.`idc`
        WHERE p.`idc` =?",[Session::get('sesionidu')]);

         $pagos = pagos::where('idg','=',$idg)->get();

        // echo $pagos;
         return view ('modulos.producto.detalles')
          ->with('pagos',$pagos[0])
          ->with('res',$res[0]);

    }
}

