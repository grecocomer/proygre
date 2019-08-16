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
<body>


<div id="desc" >

<span class="d-block p-2  bg-dark text-white">
<li> <h3><font color="white">Datos de la Compra <i class="fa fa-info-circle"></i></font> 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="{{ route('reportepay') }}" class="btn btn-outline-warning"><span><i class="fa fa-star-half-o"></i>&nbsp;&nbsp; REGRESAR A MI HISTORAL &nbsp;&nbsp;<i class="fa fa-mail-reply-all"></i></span> </a>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<a href="{{ route('venta') }}" class="btn btn-outline-success"><span><i class="fa fa-shopping-cart"></i>&nbsp;&nbsp; SEGUIR COMPRANDO &nbsp;&nbsp;<i class="fa fa-credit-card"></i></span> </a>

</h3>
<hr>

</li>

<li><b>Referencia de pedido:</b>   {{$pagos->payment_id}} <i class="fa fa-files-o"></i> </li> 
<br>
<br>
<li><b>Descripción del pedido:</b>   {{$pagos->descripcion}}   <i class="fa fa-list-alt"></i> </li>
<br>
<br>
<li><b>Fecha de la Compra:</b>   {{$pagos->fecha}}   <i class="fa fa-calendar-o"></i> </li>
<br>
<br>
<li><b>Total de la compra:</b>   ${{$pagos->preciot}}   <i class="fa fa-money"></i> </li> 
<br>
<br>
<li><b>Metodo de pago:</b>   {{$pagos->metodo}}   <i class="fa fa-shopping-cart"></i>  <i class="fa fa-credit-card"></i> </li>
<br>
<br>
<li><b>Estatus:</b>   {{$pagos->status}}  <i class="fa fa-heart"></i> </li>
    </ul> 
    </span>
 
    </div>

    <div id="deta" >

<span class="d-block p-2  bg-light text-black">
<li> <h3>Dirección de envío (Mi dirección) <i class="fa fa-info-circle"></i></h3>
<hr></li>

<li><b>{{$res->nco}}</b> <i class="fa fa-user"></i> </li> 
<br>
<br>
<li><b>{{$res->email}}</b> <i class="fa fa-envelope"></i> </li> 
<br>
<br>
<li><b>{{$res->tel}}</b> <i class="fa fa-phone-square"></i> </li>
<br>
<br>
<li><b>{{$res->direc}}</b> <i class="fa fa-flag"></i> </li>
    </ul> 
    </span>
 
    </div>


</body>


@stop