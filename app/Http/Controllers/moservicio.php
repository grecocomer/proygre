<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\catservicios;
use App\servicios;
use App\empresas;
use App\empleados;
use App\municipios;
use App\detalle_vs;
use App\users;
use App\ventass;
use App\cotizaciones;
use Carbon\Carbon;
use Session; 
use DB;

class moservicio extends Controller
{
    public function venta_s(){
       // return view('modulos.servicio.moservicio');
        
        $clavequesigue = ventass::orderBy('id_vs','desc')
        ->take(1)->get();
        $cuantos = count($clavequesigue);
        if($cuantos==0)
        {
        $id_vs= 1;
        }
        else
        {
        $id_vs = $clavequesigue[0]->id_vs+1;   
        }
        $id_emp = empleados::all();
        $fecha_venta=carbon::now();
        //$fecha_venta=$fecha_venta->format('d-m-Y');
        $catservicios = catservicios::all();
        return view('modulos.servicio.moservicio')
        ->with('catservicios',$catservicios)
        ->with('id_vs',$id_vs)
        ->with('id_emp',$id_emp)
        //->with('fecha_venta',$fecha_venta);
        ->with('fecha_venta',$fecha_venta->toDateString());
        //->with('fecha_venta',$fecha_venta->format('y-m-d'));
        
            }  

            function comboser(Request $request)
       {
            $id_cat_ser = $request->get('id_cat_ser');
            $servicios = servicios::where('id_cat_ser','=',$id_cat_ser)->get();
             return view ('modulos.servicio.coms')->with('servicios',$servicios);
       }

       function detalles(Request $request)
       {
           // todo esto sirve para mostrar los detalles del producto pero en marca solo muestra el id
          $id_ser = $request->get('id_ser');
          //  $nom_marca = $request->get('nom_marca');
           // $servicios = servicios::where('id_ser','=',$id_ser)->get();
          //  $marcaservicios = marcaservicios::where('nom_marca','=',$nom_marca)->get();
         //  return view ('modulos.producto.detallepro')->with('servicios',$servicios[0]);
           // ->with('nom_marca',$nom_marca);

           // todo esto sirve para mostrar los detalles del producto pero en marca muestra el nombre

      $servicios=\DB::select("     SELECT  
      s.id_ser,
        s.nombre_ser,
        s.descripcion_ser,
        s.costo
          FROM servicios AS s 
           WHERE s.id_ser = ".$id_ser); 
       
     return view ('modulos.servicio.detalleser')->with('servicios',$servicios[0]);
       
       }

       function carritos(Request $request)
       {
     
           $ventass = ventass::where('id_vs',$request->id_vs)->get();
          
       $cuantos = count($ventass);
     
           if($cuantos==0)
           {   
             
               $ventass = new ventass;
               $ventass->id_vs = $request->id_vs;
               $ventass->id_user = $request->id;
               $ventass->fecha_venta_ser =$request->fecha_venta;
               $ventass->total_vs =$request->total;
               $ventass->save();
               
               $detalle_vs = new detalle_vs;
               $detalle_vs->id_vs = $request->id_vs;
               $detalle_vs->id_ser = $request->id_ser;
               $detalle_vs->id_emp = $request->id_emp;
               $detalle_vs->cantidad = $request->cantidad;
               $detalle_vs->costo = $request->costo;
               $detalle_vs->fecha_venta = $request->fecha_venta;
               //$detalle_vs->costo = $request->subt / $request->cantidad;
               $detalle_vs->save();
              
           }
           else
           {
            $detalle_vs = new detalle_vs;
            $detalle_vs->id_vs = $request->id_vs;
            $detalle_vs->id_ser = $request->id_ser;
            $detalle_vs->id_emp = $request->id_emp;
            $detalle_vs->cantidad = $request->cantidad;
            $detalle_vs->costo = $request->costo;
            $detalle_vs->fecha_venta = $request->fecha_venta;
            //$detalle_vs->costo = $request->subt / $request->cantidad;
            $detalle_vs->save();
           }
           $resultado=\DB::select("SELECT vs.id_dvs,
           vs.id_ser, 
           vs.id_emp,
           vs.cantidad,
           vs.costo,
           s.nombre_ser
                      FROM detalle_vs AS vs
                      INNER JOIN servicios AS s ON s.id_ser = vs.id_ser
           WHERE vs.id_vs= ?",[$request->id_vs]);
           
          $resultado2=\DB::select("SELECT total_vs AS total
                                   FROM ventass WHERE id_vs = ?",[$request->id_vs]);
       
          return view ('modulos.servicio.listas')
          ->with('resultado',$resultado)
          ->with('resultado2',$resultado2[0]);
       }
   
       public function borraventass(Request $request)
    {
         $ventass = detalle_vs::where('id_dvs',$request->id_dvs)->get();
         $id_vs = $ventass[0]->id_vs;
         detalle_vs::find($request->id_dvs)->delete();
         ////////////////////////////
     //echo "borraventass con clave $request->id_dvs con venta $id_vs ";
     $resultado=\DB::select("SELECT vs.id_dvs,
     vs.id_ser, 
     vs.id_emp,
     vs.cantidad,
     vs.costo,
     s.nombre_ser
                FROM detalle_vs AS vs
                INNER JOIN servicios AS s ON s.id_ser = vs.id_ser
     WHERE vs.id_vs = ?",[$id_vs]);
        
 $resultado2=\DB::select("SELECT total_vs AS total
 FROM vestass WHERE id_vs = ?",[$id_vs]);

    
       return view ('modulos.servicio.listas')
       ->with('resultado',$resultado)
     ->with('resultado2',$resultado2[0]);
    }


    public function cotizacion()
    {
        
        $clavequesigue = cotizaciones::orderBy('idc','desc')
        ->take(1)->get();
        $cuantos = count($clavequesigue);
        if($cuantos==0)
        {
        $idc= 1;
        }
        else
        {
        $idc = $clavequesigue[0]->idc+1;   
        }
        $empresas=empresas::all();
        $municipios=municipios::all();

        $cotizaciones=\DB::select("SELECT co.`idc`,co.`id_user`,u.`ncompleto`,co.`telefono`,co.`emal`,em.`nombre_empresa`,s.`nombre_ser`,co.`costo`
        FROM cotizaciones AS co
        INNER JOIN empresas AS em ON em.`id_empresa`=co.`empresa`
        INNER JOIN users AS u ON u.`id_user`=co.`id_user`
        INNER JOIN servicios AS s ON s.`id_ser`=co.`servicio`
        WHERE co.id_user = ?",[Session::get('sesionidu')]);

       $returnd=\DB::select("SELECT co.`idc`,co.`id_user`,u.`ncompleto`,co.`telefono`,co.`emal`,em.`nombre_empresa`,s.`nombre_ser`,co.`costo`,co.cliente
        FROM cotizaciones AS co
        INNER JOIN empresas AS em ON em.`id_empresa`=co.`empresa`
        INNER JOIN users AS u ON u.`id_user`=co.`id_user`
        INNER JOIN servicios AS s ON s.`id_ser`=co.`servicio`
        WHERE co.id_user = ?",[Session::get('sesionidu')]);

       

        $fecha_venta=carbon::now();
        return view('modulos.servicios.cotizar')
        ->with('idc',$idc)
        ->with('empresas',$empresas)
        ->with('municipios',$municipios)
        ->with('cotizaciones',$cotizaciones)
        ->with('returnd',$returnd[0])
        ->with('fecha_venta',$fecha_venta->toDateString());


    }


    function comboemp(Request $request)
       {
            $id_empresa = $request->get('id_empresa');
            $servicios = servicios::where('id_empresa','=',$id_empresa)->get();
            return view ('modulos.servicios.comp')
            ->with('servicios',$servicios);
       }

       function detalls(Request $request)
       {

        
       
           // todo esto sirve para mostrar los detalles del producto pero en marca solo muestra el id
          $id_ser = $request->get('id_ser');
          //  $nom_marca = $request->get('nom_marca');
         $servicios = servicios::where('id_ser','=',$id_ser)->get();
          //  $marcaproductos = marcaproductos::where('nom_marca','=',$nom_marca)->get();

         return view ('modulos.servicios.detallerser')
         ->with('servicios',$servicios[0]);
           // ->with('nom_marca',$nom_marca);

           // todo esto sirve para mostrar los detalles del producto pero en marca muestra el nombre

      
   
       
       }


       function detallc(Request $request)
       {

        
       
           // todo esto sirve para mostrar los detalles del producto pero en marca solo muestra el id
          $idm = $request->get('idm');
          //  $nom_marca = $request->get('nom_marca');
         $municipios = municipios::where('idm','=',$idm)->get();
          //  $marcaproductos = marcaproductos::where('nom_marca','=',$nom_marca)->get();

         return view ('modulos.servicios.detallepro')
         ->with('municipios',$municipios[0]);
           // ->with('nom_marca',$nom_marca);

           // todo esto sirve para mostrar los detalles del producto pero en marca muestra el nombre

      
   
       
       }

       
       function carrico(Request $request)
    {
	
        
            $coti = new cotizaciones;
            $coti->idc ="";
            $coti->id_user =$request->idcl;
            $coti->cliente= $request->nom;
            $coti->telefono = $request->tel;
            $coti->emal = $request->ema;
            $coti->empresa = $request->id_empresa;
            $coti->servicio = $request->id_ser;
            $coti->municipio = $request->idm;
            $coti->costo = $request->total;
            $coti->save();
        }


        function detallecoti(Request $request)
       {

        
       
           // todo esto sirve para mostrar los detalles del producto pero en marca solo muestra el id
          $idc = $request->get('idc');
          //  $nom_marca = $request->get('nom_marca');

         $cotizaciones=\DB::select("SELECT co.`idc`,co.`id_user`,em.id_empresa,s.id_ser,u.`ncompleto`,co.`telefono`,co.`emal`,em.`nombre_empresa`,
         s.`nombre_ser`,co.`costo`,mun.idm,mun.nombre,s.costo as scosto,mun.costo as mcosto
        FROM cotizaciones AS co
        INNER JOIN empresas AS em ON em.`id_empresa`=co.`empresa`
        INNER JOIN users AS u ON u.`id_user`=co.`id_user`
        INNER JOIN servicios AS s ON s.`id_ser`=co.`servicio`
        INNER JOIN municipios as mun ON mun.idm=co.municipio
        WHERE co.idc = ?",[$idc]);
          //  $marcaproductos = marcaproductos::where('nom_marca','=',$nom_marca)->get();
          $fecha_venta=carbon::now();
          
          $empresas=empresas::all();
          $municipios=municipios::all();

         return view ('modulos.servicios.detallecoti')
         ->with('cotizaciones',$cotizaciones[0])
         ->with('empresas',$empresas)
         ->with('municipios',$municipios)
         ->with('fecha_venta',$fecha_venta->toDateString());
           // ->with('nom_marca',$nom_marca);

           // todo esto sirve para mostrar los detalles del producto pero en marca muestra el nombre

      
   
       
       }


       function comboemp2(Request $request)
       {
            $id_empresa1 = $request->get('id_empresa1');
            $servicios = servicios::where('id_empresa','=',$id_empresa1)->get();
            return view ('modulos.servicios.comp2')
            ->with('servicios',$servicios);
       }


       function detalls2(Request $request)
       {

        
       
           // todo esto sirve para mostrar los detalles del producto pero en marca solo muestra el id
          $id_ser1 = $request->get('id_ser1');
          //  $nom_marca = $request->get('nom_marca');
         $servicios = servicios::where('id_ser','=',$id_ser1)->get();
          //  $marcaproductos = marcaproductos::where('nom_marca','=',$nom_marca)->get();

         return view ('modulos.servicios.detalleser2')
         ->with('servicios',$servicios[0]);
           // ->with('nom_marca',$nom_marca);

           // todo esto sirve para mostrar los detalles del producto pero en marca muestra el nombre

      
   
       
       }


       function detallc2(Request $request)
       {

        
       
           // todo esto sirve para mostrar los detalles del producto pero en marca solo muestra el id
          $idm1 = $request->get('idm1');
          //  $nom_marca = $request->get('nom_marca');
         $municipios = municipios::where('idm','=',$idm1)->get();
          //  $marcaproductos = marcaproductos::where('nom_marca','=',$nom_marca)->get();

         return view ('modulos.servicios.detallepro2')
         ->with('municipios',$municipios[0]);
           // ->with('nom_marca',$nom_marca);

           // todo esto sirve para mostrar los detalles del producto pero en marca muestra el nombre

      
   
       
       }


         
       function updateco(Request $request)
    {
    
        
        $idc=$request->idc1;
        

     //   $modifi =\DB::update("UPDATE cotizaciones SET pagos.`status`='Entregado' 
     //   WHERE idc= ?",[$request->idc1]);


            // insertar datos 

            $coti = cotizaciones::find($idc);
            $coti->id_user =$request->idcl1;
            $coti->cliente= $request->nom1;
            $coti->telefono = $request->tel1;
            $coti->emal = $request->ema1;
            $coti->empresa = $request->id_empresa1;
            $coti->servicio = $request->id_ser1;
            $coti->municipio = $request->idm1;
            $coti->costo = $request->total1;
            $coti->save();
                


        }



       
    }
    

