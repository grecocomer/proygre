<head>
<style>
#button {
  background-color: #FE3C39; /* Green */
  border: none;
  color: white;
  padding: 2px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 12px;
  margin: 2px 2px;
  cursor: pointer;
  border-radius: 4px;
  
}

.div { text-align: center}
table { margin: auto; }
th   { text-align: center; }
td   { text-align: center; }


</style>
</head>

<div class="container mt-4 " >
        <div class="card">
        <div class="card-body">

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th scope="col">Clave Producto</th>
            <th scope="col">Producto</th>
            <th scope="col">Imagen</th>
            <th scope="col">Cantidad</th>
            <th scope="col">Costo</th>
            <th scope="col">Subtotal</th>
            <th scope="col" ><div align="center">Operaciones </div></th>
           
        </tr>
    </thead>
    <tbody>
        @foreach($resultado as $res)
        <tr>
            <th scope="row">{{$res->id_prod}}</th>
            <td>{{$res->nombre_prod}}</td>
            <td><img src="{{asset('Archivo/'. $res->Archivo)}}" height=50 windth=50></td>
            <td>{{$res->cantidad}}</td>
            <td>{{$res->costo}}</td>
            <td>{{$res->subt}}</td>
            <td>
                <form action='' method='POST' enctype='application/x-www-form-urlencoded' 
                name='frmdo{{$res->id_dvp}}' id='frmdo{{$res->id_dvp}}' target='_self'>
                    <input type='hidden' value='{{$res->id_dvp}}' name='id_dvp' id='id_dvp'>
                    <input type = 'hidden' value = '{{$res->cantidad}}' name = 'canti' id= 'canti'>
               <div class='div'>    <input type='button'  class='borrar' id='button' name='borrar' value='Borrar' /></div>
                </form>
            </td>
        </tr>
        @endforeach
        </tr>
          
            <tr><td colspan= 5>Subtotal</td><td><div class='div'> {{$resultado2->subtotal}} </div></td></tr>
            <tr><td colspan= 5>IVA</td><td><div class='div'>  {{$resultado2->iva}} </div></td></tr>
            <tr><td colspan= 5>Total</td><td><div class='div'> {{$resultado2->total}} </div></td></tr>
            <tr><td colspan= 5>Confirmar</td><td><div class='div'><button type="button" class="btn btn-success" name='confirmar' id="confirmar" disabled= 'false'>Confirmar</button></div></td>
            </tr>
         
    </tbody>
</table>


<script type="text/javascript">


    $(function () {
        
        $("#pay").hide();

        var total;
            total = parseInt($("#amount").val());

              if( total =="0" || $("#amount").val() =="" ) 
              {
                $('#confirmar').attr("disabled", true);
              } 
              else
              {
                $('#confirmar').attr("disabled", false); 
              }
              

       
         
	$('.borrar').click(function () {
			formulario = this.form;
            $("#carrito").load('{{url('borraventas')}}' + '?' + $(this).closest('form').serialize()) ;
            
           
            
		});
        

     
       $("#confirmar").click(function() {
	   $("#pay").show();
       
    

		
       });
 
});
</script>


</div>
</div>
</div>





<div id="pay">

  <!--<body align='center'>-->
  <div class="container-fluid">
    <!-- Start Page Content -->
    <div class="row justify-content-center">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="form-validation">

    	<form class="form-valide" method="POST" id="payment-form"
          action="{{ route('paypal') }}" enctype='multipart/form-data' align="center">
          
    	  {{ csrf_field() }}

          
     

<input  class="form-control"   id="dcp"  value="{{$resultado4->dcp}}" type="text" name='dcp'>
<input  class="form-control" placeholder="Cantidad..." id="amount"  value="{{$resultado2->total}}" type="text" name='amount'>


        <h3> <font color="#B4B2B2 ">Continuar con la Compra</font></h3>
        <hr>

        <div class="form-group row">
        <div class="col-lg-12 ml-auto">
        
        <button type="submit"  class="btn btn-outline-dark btn-lg btn-block"><font color="#006EF3">Pagar con Paypal</font></button>
        
        </div>
        </div>
        
        <br>

        
        <img src="../public/images/seguro.jpg"  width="350" height="100">

        <img src="../public/images/logopy.png"  width="350" height="100">
            

    </div>

    </div>

                </div>
            </div>
        </div>
    </div>
    <!-- End PAge Content -->
</div>
