


@extends('index')

@section("contenido")


<head>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="jquery/jquery-3.3.1.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.css">

  
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
			
   $("#iduser").click(function() {
   $("#tapa").load('{{url('combopago')}}' + '?iduser=' + this.options[this.selectedIndex].value) ;
   $("#deta").hide();

		});

    

  

      
		});


    </script>



 
<h1 align="center">HISTORIAL DE PEDIDOS</h1><br>
<div class="container-fluid">

    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Export</h4>
                    <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                    <div class="table-hover m-t-20">
                    
                    <div align="center">
                   <h5><font color="#41AA80">Seleccione un Cliente: </font><h5>
                    </div>
                  
             
                    <div align="center">     <div class="col-md-3">
                        <select name='iduser' id='iduser' class="form-control">
                        @foreach($users as $us)
		             	<option value = '{{$us->id_user}}'>{{$us->ncompleto}}</option>
		            	@endforeach
                        </select>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>
                    </div>

    <div id="tapa">

    </div>

    <div id="deta">

    </div>
               
                 
                  

            @stop
