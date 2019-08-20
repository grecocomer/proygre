@extends('index')

@section("contenido")


<head>
<meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!--<script src="main.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="jquery/jquery-3.3.1.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->

  
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
 
<h1 align="center">HISTORIAL DE PEDIDOS</h1><br>
<div class="container-fluid">

    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Export</h4>
                    <h6 class="card-subtitle">Export data to Copy, CSV, Excel, PDF & Print</h6>
                    <div class="table-hover m-t-30">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>ID</th>
                                    <th>Usuario</th>
                                    <th>Payment_ID</th>
                                    <th>Precio total</th>
                                    <th>Metodo</th>
                                    <th>Status</th>
                                    <th>Detalles</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach($res as $rc)
                                <tr>
                                    <td>{{$rc->idg}}</td>
                                    <td>{{$rc->nombre}}</td>
                                    <td>{{$rc->payment_id}}</td>
                                    <td>{{$rc->precio}}</td>
                                    <td>{{$rc->me}}</td>
                                    @if($rc->sta=="Aprobado")
<td><span class="badge badge-pill badge-success">  {{$rc->sta}} </span></td>
@else
<td><span class="badge badge-pill badge-info"> {{$rc->sta}}  </span></td>
@endif
<td> <a href="{{URL::action('moproducto@detalles',['idg'=>$rc->idg])}}"  class="btn btn-outline-dark"><span> <i class="fa fa-search"></i> <i class="fa fa-book"></i>  <i class="fa fa-arrow-right"></i></span> </a></td>
                                </tr>
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



<div id="deta">

<span class="d-block p-2  bg-light text-black">
<li> <h3>Dirección de envío (Mi dirección) <i class="fa fa-info-circle"></i></h3>
<hr></li>

<li><b>{{$pagos->nco}}</b> <i class="fa fa-user"></i> </li> 
<br>
<br>
<li><b>{{$pagos->email}}</b> <i class="fa fa-envelope"></i> </li> 
<br>
<br>
<li><b>{{$pagos->tel}}</b> <i class="fa fa-phone-square"></i> </li>
<br>
<br>
<li><b>{{$pagos->direc}}</b> <i class="fa fa-flag"></i> </li>
    </ul> 
    </span>
 
    </div>
            @stop
