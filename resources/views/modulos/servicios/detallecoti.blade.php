
<head>
    <title>Modulo Productos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="jquery/jquery-3.3.1.min.js"></script>
 
</head>



<script type="text/javascript">



		$(document).ready(function(){



            function trunc (x, posiciones = 0) {
  var s = x.toString()
  var l = s.length
  var decimalLength = s.indexOf('.') + 1
  var numStr = s.substr(0, decimalLength + posiciones)
  return Number(numStr)
  

    

        }    
			
        $("#id_empresa1").click(function() {
		$("#id_ser1").load('{{url('comboemp2')}}' + '?id_empresa1=' + this.options[this.selectedIndex].value) ;


    });


        

      
$("#id_ser1").click(function() {
$("#deser1").load('{{url('detalls2')}}' + '?id_ser1=' + this.options[this.selectedIndex].value) ;
               ///alert('hola00')
       


            });
   

$("#idm1").click(function() {
$("#datos2").load('{{url('detallc2')}}' + '?idm1=' + this.options[this.selectedIndex].value) ;
$('#cotizar2').attr("disabled", false);


       


            });

$("#cotizar2").click(function() {

    var servicio;
    var traslado;
    servicio = parseInt($("#cser2").val());
    traslado = parseInt($("#cost2").val());
 var total;
    total= (servicio+traslado);

$("#total1").val(total);

$("#carrito2").load('{{url('updateco')}}' + '?' + $(this).closest('form').serialize()) ;

alert("El costo total de su servicio sería: $"+  total);

       


            });

});




    </script>

<script>
function cambia_de_pagina(){

    location.href="{{ route('cotizacion') }}"
}
</script>

    
<script>
function cambia(){

    location.href="{{ route('principal') }}"
}
</script>


<div class="container-fluid">






     <!-- Large modal -->
     <button type="button" id="cote" class="btn btn-outline-danger  btn-lg btn-block" data-toggle="modal" data-target=".bd-example-modal-lg">Modificar  Cotizaci&oacute;n</button>

<div class="modal  bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      

 <!---formula-->


 <div class="container mt-4 " >
        <div class="card">
            <div class="card-header">
                
                Cotizaciones  
                </div>

            
            
<form  id="formEjemplo">
                <div class="card-body">

                <div class="row mt-3">
                    <div class="col-md-1">
                        <label for="">No.Vta:</label>
                    </div>
                    

                    <div class="col-md-2">
                        <input type="text" name="idc1" id="idc1"  value = '{{$cotizaciones->idc}}' readonly = 'readonly' class="form-control">
                    </div>

                    <div class="col-md-2">
                        <label for="">Fecha Vta:</label>
                    </div>

                    <div class="col-md-3">
                        <input name="fecha_venta1" id="fecha_venta1" value='{{$fecha_venta}}' class="form-control"  readonly = 'readonly'>
                    </div>
                   
            

               
                    <div class="col-md-2">
                    <input name="idcl1" id="idcl1" type="hidden" value="{{Session::get('sesionidu')}}" class="form-control"  readonly = 'readonly'>
                    </div>
                    </div>
                    
     
                    <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="">Nombre Cliente:</label>
                    </div>

                    <div class="col-md-6">
                    <input name="nom1" id="nom1" value="{{$cotizaciones->ncompleto}}" placeholder="Escriba su nombre copleto" class="form-control">
                    </div>

                    </div>
              

           

                    <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="">Telefono:</label>
                    </div>

                    <div class="col-md-6">
                    <input name="tel1" id="tel1" value="{{$cotizaciones->telefono}}" placeholder="Escriba su telefono de 10 digitos" class="form-control">
                    </div>

                    </div>


             


         

                    <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="">Email:</label>
                    </div>

                    <div class="col-md-6">
                    <input name="ema1" id="ema1" value="{{$cotizaciones->emal}}" placeholder="Escriba su dirección de correo" class="form-control">
                    </div>

                    </div>
                   
       
                  
              
               

                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="">Seleccione la Empresa:</label>
                    </div>
                    <div class="col-md-6">
                        <select name='id_empresa1' id='id_empresa1' class="form-control">
                        <option value = '{{$cotizaciones->id_empresa}}'>{{$cotizaciones->nombre_empresa}}</option>
                        @foreach($empresas as $emp)
		             	<option value = '{{$emp->id_empresa}}'>{{$emp->nombre_empresa}}</option>
		            	@endforeach
                        </select>
                    </div>
                    </div>

          

            
                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="">Seleccione Servicio:</label>
                        </div>
                        <div class="col-md-6">
                            <select name='id_ser1' id='id_ser1' class="form-control">
                            <option value = '{{$cotizaciones->id_ser}}'>{{$cotizaciones->nombre_ser}}</option>
                            </select>
                        </div>
                        </div>

                    

                     <div id="deser1">


                     <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="">Costo de Servicio:</label>
                    </div>

                    <div class="col-md-2">
                    <input name="cser2" id="cser2" type="text" value="{{$cotizaciones->scosto}}" class="form-control"  readonly = 'readonly'>
</div>

</div>


                     </div>
                


                  

                        <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="">Selecione el Municipio donde sera el servicio:</label>
                    </div>
                    <div class="col-md-6">
                        <select name='idm1' id='idm1' class="form-control">
                        
		             	<option value = '{{$cotizaciones->idm}}'>{{$cotizaciones->nombre}}</option>
                         @foreach($municipios as $mun)
                         <option value = '{{$mun->idm}}'>{{$mun->nombre}}</option>
		            	 @endforeach
                        </select>

                    </div>

                    


                    </div>

                   <div id="datos2">

                   <div class="row mt-3">
<div class="col-md-3">
                        <label for="">Costo de Traslado:</label>
                    </div>

                    <div class="col-md-2">
                    <input name="cost2" id="cost2" type="text" value="{{$cotizaciones->mcosto}}" class="form-control"  readonly = 'readonly'>
</div>

</div>



                   </div>
   



                    </div>

                    <div align="center">

    <input type="hidden" name="total1" id="total1" value="" class="form-control">

        <button type="button" class="btn btn-success" name='cotizar2' id="cotizar2" disabled= 'true'>Cotizar</button>
                   
            

        </div>
                </div>
            </div>

        


</form>
<!---formula-->
<div class="modal-footer">
        <button type="button" id="close1" name="close1" onclick="javascript:cambia_de_pagina();" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>


    </div>
    

  </div>
</div>

</div>


<div id='carrito2' align="center">
               </div>
