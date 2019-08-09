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

            function trunc (x, posiciones = 0) {
  var s = x.toString()
  var l = s.length
  var decimalLength = s.indexOf('.') + 1
  var numStr = s.substr(0, decimalLength + posiciones)
  return Number(numStr)

 
            

        }    
			
   


            $("#id_cat_producto").click(function() {
				$("#id_prod").load('{{url('combopro')}}' + '?id_cat_producto=' + this.options[this.selectedIndex].value) ;
               //alert('hola00')
        $('#descripcion_prod').val("");
        $('#archivo').val("");
        $('#Existencia').val("");
        $('#costo').val("");
        $('#marca').val("");
        $('#cantidad').val("");
        $('#subt').val("");
        $('#subto').val("");
        $('#des').val("");
        $("#no").remove();
        $("#si").remove();

		});

        $("#id_prod").click(function() {
				$("#datos").load('{{url('detallep')}}' + '?id_prod=' + this.options[this.selectedIndex].value) ;
               ///alert('hola00')
       
        $('#cantidad').val("");
        $('#subt').val("");
        $('#subto').val("");
        $('#des').val("");
        $("#no").remove();
        $("#si").remove();

            });

            $("#cantidad").keyup(function() {
              
            var Existencia;
            var cantidad;
            Existencia = parseInt($("#Existencia").val());
            cantidad = parseInt($("#cantidad").val());
            if (cantidad>Existencia  || Existencia =='0' || cantidad =='0')
            {

          $("#status").html('<div class="alert alert-danger" id="no" role="alert"><h6 class="alert-heading">No se puede</h6></div>  '); 
          $('#agrega').attr("disabled", true);
          $('#subt').val(0);
          $('#descuento1').attr("disabled", true);
          $('#descuento2').attr("disabled", true);
          $('#descuento3').attr("disabled", true);
        
            
            
            }
            else
            {
                $("#status").html('<div class="alert alert-success" id="si" role="alert"><h6 class="alert-heading">Si se puede</h6></div>  '); 
    
                $('#subt').val( $("#costo").val() * $("#cantidad").val());
                $('#descuento1').attr("disabled", false);
                $('#descuento2').attr("disabled", false);
                $('#descuento3').attr("disabled", false);

      
              
            }
        if($('#cantidad').val()== "")
        {
            $('#agrega').attr("disabled", true);
            $("#no").remove();
            $("#si").remove();
            $('#subt').val("");
            $('#subto').val("");
            $('#des').val("");
            $('#descuento1').attr("disabled", true);
            $('#descuento2').attr("disabled", true);
            $('#descuento3').attr("disabled", true);
            
        }

        

      
        
       });

      
       $("input[name=descuento]").click(function () {
        switch ($('input:radio[name=descuento]:checked').val()) { 
	    case '0': 
          $("#des").val(parseInt($("#subt").val())*0,6);
          $('#agrega').attr("disabled", false);
		break;
		case '10': 
          $("#des").val(trunc(parseInt($("#subt").val())*0.10,6));
          $('#agrega').attr("disabled", false);
		break;
	    case '30': 
          $("#des").val(trunc(parseInt($("#subt").val())*0.30,6));
          $('#agrega').attr("disabled", false);
		break;
          }
        });
        


    
      $("input[name=descuento]").click(function () {
        switch ($('input:radio[name=descuento]:checked').val()) { 
      case '0': 
          $("#subto").val($("#subt").val()-$("#des").val());
    break;
    case '10': 
          $("#subto").val($("#subt").val()-$("#des").val());
    break;
      case '30': 
         $("#subto").val($("#subt").val()-$("#des").val());
    break;
          }
        });

       $("#agrega").click(function() {
	   $("#Existencia").val($("#Existencia").val()-$("#cantidad").val());	
       $("#carrito").load('{{url('carrito')}}' + '?' + $(this).closest('form').serialize()) ;
       
       
            $('#agrega').attr("disabled", true);
            $("#no").remove();
            $("#si").remove();
            $('#cantidad').val("");
            $('#subt').val("");
            $('#subto').val("");
            $('#des').val("");
            $('#descuento1').attr("disabled", true);
            $('#descuento2').attr("disabled", true);
            $('#descuento3').attr("disabled", true);

		
       });
 


      
    

		});


	</script>
 <!--mensajes-->

@if ($message = Session::get('success'))
        <div class="row justify-content-center">
        <div class="col-lg-10">
        <div class="alert alert-success" role="alert">
       <div align="center"> <font color="black"><strong>{!! $message !!}
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
       </button>
       </strong>
       </font>
       </div>
        </div>
        </div>
        </div>

        <?php Session::forget('success');?>
        @endif


        @if ($message = Session::get('error'))
        <div class="row justify-content-center">
        <div class="col-lg-10">
        <div class="alert alert-danger" role="alert">
       <div align="center"> <font color="black"><strong>{!! $message !!}
       <button type="button" class="close" data-dismiss="alert" aria-label="Close">
       <span aria-hidden="true">&times;</span>
       </button>
       </strong>
       </font>
       </div>
        </div>
        </div>
        </div>
        <?php Session::forget('error');?>
        @endif
	
 <!--mensajes-->

    <div class="container mt-4 " >
        <div class="card">
            <div class="card-header">
                Modulos Productos
            </div>
<form>
            <div class="card-body">

                <div class="row mt-3">
                    <div class="col-md-1">
                        <label for="">No.Vta:</label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="id_vp" id="id_vp"  value = '{{$id_vp}}' readonly = 'readonly' class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="">Fecha Vta:</label>
                    </div>
                    <div class="col-md-2">
                        <input name="fecha_venta" id="fecha_venta" value='{{$fecha_venta}}' class="form-control"  readonly = 'readonly'>
                    </div>

               
                    <div class="col-md-1">
                    <input name="idcl" id="idcl" type="hidden" value="{{Session::get('sesionidu')}}" class="form-control"  readonly = 'readonly'>
                    </div>
                   
              

                    <div class="col-md-2">
                        <label for="">Nombre Cliente:</label>
                    </div>
                    <div class="col-md-2">
                    <input name="nom" id="nom" value="{{Session::get('sesionname')}}" class="form-control"  readonly = 'readonly'>
                    </div>
                    </div>
              

                <div class="row mt-3">
                    <div class="col-md-2">
                        <label for="">Seleccione Categoria:</label>
                    </div>
                    <div class="col-md-10">
                        <select name='id_cat_producto' id='id_cat_producto' class="form-control">
                        @foreach($catproductos as $cat)
		             	<option value = '{{$cat->id_cat_producto}}'>{{$cat->nom_categoria}}</option>
		            	@endforeach
                        </select>
                    </div>
                    </div>


                    <div class="row mt-3">
                        <div class="col-md-2">
                            <label for="">Seleccione Producto:</label>
                        </div>
                        <div class="col-md-10">
                        <div id="ten">
                            <select name='id_prod' id='id_prod' class="form-control">
                            </select>
                        </div>
                        </div>
                        </div>
                        
                        <div id='datos'>
                        <div class="row mt-3 ">
    <div class="col-md-2">
        <label for="">Descripcion:</label>
    </div>
    <div class="col-md-4">
        <input type="text" name="descripcion_prod" id="descripcion_prod"
            readonly='readonly' class="form-control">
    </div>
    <div class="col-md-2">

        <label for="">Imagen Producto:</label>
    </div>
    <div class="col-md-4">
        <input type="text" name="archivo" id="archivo"  readonly='readonly'
            class="form-control">
    </div>
</div>


<div class="row mt-3 ">
    <div class="col-md-2">
        <label for="">Existencia:</label>
    </div>
    <div class="col-md-2">
        <input type="text" name="Existencia" id="Existencia" readonly='readonly'
            class="form-control">
           
    </div>
  

    <div class="col-md-2">
        <label for="">Precio:</label>
    </div>
    <div class="col-md-2">
        <input type="text" name="costo" id="costo" readonly='readonly'
            class="form-control">
    </div>
    <div class="col-md-2">
        <label for="">Marca:</label>
    </div>
    <div class="col-md-2">
        <input type="text" name="marca" id="marca"  readonly='readonly'
            class="form-control">
    </div>
</div>     
                        </div>  
                       

                <div class="row mt-4 ">
                <div class="col-md-2">
                        <label for="">Cantidad:</label>
                    </div>
                    <div class="col-md-2">
                        <input type="text" name="cantidad" id="cantidad" class="form-control">
                    </div>
                    <div class="col-md-2">
                        <label for="">Descuento:</label>
                    </div>
                    <div class="col-md-2">
                         <input type = 'hidden' name ='subt' id = 'subt'>
                        <input type = 'text' name ='des' id = 'des' readonly='readonly' class="form-control">
                    </div>

                    <div class="col-md-2">
                        <label for="">Subtotal:</label>
                    </div>
                    <div class="col-md-2">
                        <input type = 'text' name ='subto' id = 'subto' readonly='readonly' class="form-control">
                    </div>
                    </div>
                    <br>

                    <div align="center">
                    <div class="col-md-4">
                        <label for="">Valorar:</label>
                    </div>
                    <div  class="col-md-4" id="status">
                    
                    </div>
                    </div>
                  
                    
              
                <br>
                <div id="rad" class="mx-auto" style="width: 200px;" >
                <label for="">Descuento:</label>
            <input type = 'radio' value = '0' name = 'descuento' id = 'descuento1'  disabled= 'false' checked>0%
            <input type = 'radio' value = '10' name = 'descuento' id = 'descuento2' disabled= 'false'>10%
            <input type = 'radio' value = '30' name = 'descuento' id = 'descuento3' disabled= 'false'>30%
		     </div>
                <br>
               
                    <button type="button" class="btn btn-primary btn-lg btn-block" name = "agrega" id="agrega" disabled= 'false'>Agrega Carrito</button>

            
                    

                    </div>
                </div>
            </div>
        </div>
 
 



                <div id='carrito' align="center">
               </div>

             
  
 

@stop
