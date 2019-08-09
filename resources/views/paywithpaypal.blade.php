

<head>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="jquery/jquery-3.3.1.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->
    <script src="./js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="./css/bootstrap.css">

</head>

<title> Paypal</title>
   <meta charset="utf-8" />
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <script src="main.js"></script>
 </head>

        @if ($message = Session::get('success'))
        <div class="row justify-content-center">
        <div class="col-lg-4">
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
        <div class="col-lg-4">
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

        <!--<body align='center'>-->
<div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row justify-content-center">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="form-validation">

    	<form class="form-valide" method="POST" id="payment-form"
          action="{{ route('paypal') }}" enctype='multipart/form-data' align="center">
          
    	  {{ csrf_field() }}

    	
        <h1 align='center'> Formulario de Pagos</h1>
        <br>
        <br>
        <div class="form-group row">
        <label class="col-lg-4 col-form-label" for="id">Ingresar Cantidad: <span class="text-danger">*</span></label>
        <div class="col-lg-12">

<input  class="form-control"   id="dcp"  value="{{$resultado4->dcp}}" type="text" name='dcp'>
<input  class="form-control" placeholder="Cantidad..." id="amount"  value="{{$resultado2->total}}" type="text" name='amount'>


        </div>
        </div>
     

        <div class="form-group row">
        <div class="col-lg-8 ml-auto">
        <button type="submit"  class="btn btn-primary">Pagar con Paypal</button>
        </div>
        </div>

    </div>

    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->



