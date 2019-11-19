@extends('index')

@section("contenido")

<head>
    <title>Modulo Productos</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="jquery/jquery-3.3.1.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">

</head>

<div class="container-fluid">

<script type="text/javascript">



		$(document).ready(function(){

    $("#tele").hide();
    $("#emam").hide();
    $("#empre").hide();
    $("#serv").hide();
    $("#muni").hide();
            

            function trunc (x, posiciones = 0) {
  var s = x.toString()
  var l = s.length
  var decimalLength = s.indexOf('.') + 1
  var numStr = s.substr(0, decimalLength + posiciones)
  return Number(numStr)
  

    

        }    
			
   


        

        $("#id_empresa").click(function() {
		$("#id_ser").load('{{url('comboemp')}}' + '?id_empresa=' + this.options[this.selectedIndex].value) ;


    });

    $("#nom").keyup(function() {
    
    $("#tele").show();
    

});

$("#tel").keyup(function() {

    $("#emam").show();

});

$("#ema").keyup(function() {


$("#empre").show();


});


$("#id_empresa").click(function() {

$("#serv").show();
$("#muni").show();


});

$("#id_ser").click(function() {
$("#dser").load('{{url('detalls')}}' + '?id_ser=' + this.options[this.selectedIndex].value) ;
               ///alert('hola00')
       


            });
   

$("#idm").click(function() {
$("#datos").load('{{url('detallc')}}' + '?idm=' + this.options[this.selectedIndex].value) ;
$('#cotizar').attr("disabled", false);


       


            });

$("#cotizar").click(function() {

    var servicio;
    var traslado;
    servicio = parseInt($("#cser").val());
    traslado = parseInt($("#cost").val());
 var total;
    total= (servicio+traslado);

$("#total").val(total);


$("#carrito").load('{{url('carrico')}}' + '?' + $(this).closest('form').serialize()) ;

    alert("El costo total de su servicio sería: $"+  total);

       


            });

      



$("#idc").click(function() {
$("#modi").load('{{url('detallecoti')}}' + '?idc=' + this.options[this.selectedIndex].value) ;
$("#b").hide();


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

<!--

<input name="nc" id="nc" type="hidden" value="{{$returnd->cliente}} " class="form-control"  readonly = 'readonly'>
<input name="te" id="te" type="hidden" value="{{$returnd->telefono}} " class="form-control"  readonly = 'readonly'>
<input name="em" id="em" type="hidden" value="{{$returnd->emal}} " class="form-control"  readonly = 'readonly'>

-->
<div class="container mt-4 " >
        <div class="card">
            <div class="card-header">
                
                Cotizaciones 

<button type="button" class="btn btn-outline-danger" onclick="javascript:cambia();"  style="float: right;" name="cerrar" id="cerrar">X</button>

            </div>


            <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="">Editar Cotización:</label>
                    </div>
                    <div class="col-md-4">
                        <select name='idc' id='idc' class="form-control">
                        @foreach($cotizaciones as $cot)
		             	<option value = '{{$cot->idc}}'> #  {{$cot->idc}}   {{$cot->nombre_ser}} </option>
		            	@endforeach
                        </select>
                    </div>
</div>


            </div>

           
<div id="modi">

</div>

     <!-- Large modal -->
     <div id="b">
<button type="button" id="cot" class="btn btn-outline-primary  btn-lg btn-block" data-toggle="modal" data-target=".bd-example-modal-lg">Realizar Cotizaci&oacute;n</button>
</div>
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
                        <input type="text" name="idc" id="idc"  value = '{{$idc}}' readonly = 'readonly' class="form-control">
                    </div>

                    <div class="col-md-2">
                        <label for="">Fecha Vta:</label>
                    </div>

                    <div class="col-md-3">
                        <input name="fecha_venta" id="fecha_venta" value='{{$fecha_venta}}' class="form-control"  readonly = 'readonly'>
                    </div>
                   
            

               
                    <div class="col-md-2">
                    <input name="idcl" id="idcl" type="hidden" value="{{Session::get('sesionidu')}}" class="form-control"  readonly = 'readonly'>
                    </div>
                    </div>
                    
                    <div id="nombre">
                    <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="">Nombre Cliente:</label>
                    </div>

                    <div class="col-md-6">
                    <input name="nom" id="nom" value="" placeholder="Escriba su nombre copleto" class="form-control">
                    </div>

                    </div>
                    </div>

                    <div id="tele">

                    <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="">Telefono:</label>
                    </div>

                    <div class="col-md-6">
                    <input name="tel" id="tel" value="" placeholder="Escriba su telefono de 10 digitos" class="form-control">
                    </div>

                    </div>


                    </div>


                    <div id="emam">

                    <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="">Email:</label>
                    </div>

                    <div class="col-md-6">
                    <input name="ema" id="ema" value="" placeholder="Escriba su dirección de correo" class="form-control">
                    </div>

                    </div>
                   
                    </div>
                  
              
                    <div id="empre">

                <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="">Seleccione la Empresa:</label>
                    </div>
                    <div class="col-md-6">
                        <select name='id_empresa' id='id_empresa' class="form-control">
                        @foreach($empresas as $emp)
		             	<option value = '{{$emp->id_empresa}}'>{{$emp->nombre_empresa}}</option>
		            	@endforeach
                        </select>
                    </div>
                    </div>

                    </div>


                    <div id="serv">

                    <div class="row mt-3">
                        <div class="col-md-3">
                            <label for="">Seleccione Servicio:</label>
                        </div>
                        <div class="col-md-6">
                            <select name='id_ser' id='id_ser' class="form-control">
                            </select>
                        </div>
                        </div>

                        </div>


                        <div id="dser">
                    </div>
                


                        <div id="muni">

                        <div class="row mt-3">
                    <div class="col-md-3">
                        <label for="">Selecione el Municipio donde sera el servicio:</label>
                    </div>
                    <div class="col-md-6">
                        <select name='idm' id='idm' class="form-control">
                        @foreach($municipios as $mun)
		             	<option value = '{{$mun->idm}}'>{{$mun->nombre}}</option>
                         
		            	@endforeach
                        </select>

                    </div>

                    

                    </div>

                  
                    <div id="datos">
                    </div>
                
                    </div>

 
   



                    </div>

                    <div align="center">

    <input type="hidden" name="total" id="total" value="" class="form-control">

        <button type="button" class="btn btn-success" name='cotizar' id="cotizar" disabled= 'true'>Cotizar</button>
                   
            

        </div>
                </div>
            </div>



</form>
<!---formula-->
<div class="modal-footer">
        <button type="button" id="close" name="close" onclick="javascript:cambia_de_pagina();" class="btn btn-secondary" data-dismiss="modal">Close</button>

      </div>


    </div>
    

  </div>
</div>

</div>


      
<div id='carrito' align="center">
               </div>

  
@stop
