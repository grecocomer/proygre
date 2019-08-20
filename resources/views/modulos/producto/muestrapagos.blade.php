


<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1">

    <!--<script src="main.js"></script>-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
   <script src="jquery/jquery-3.3.1.min.js"></script>
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>-->


</head>

<style>
#button {
  background-color: #F62F2F;
  border: none;
  color: white;
  padding: 1px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 13px;
  margin: 2px 2px;
  cursor: pointer;
  border-radius: 4px;
  
}

.div { text-align: center}
table { margin: auto; }
th   { text-align: center; }
td   { text-align: center; }


</style>



<!--mensajes-->

<body>
	
 <!--mensajes-->


    <!-- Start Page Content -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="table-hover m-t-30">
                        <table id="example23" class="display nowrap table table-hover table-striped table-bordered"
                            cellspacing="0" width="100%">
                            <thead class="thead-dark">
                                <tr>
                                    <th>IDP</th>
                                    <th>Payment_ID</th>
                                    <th>Usuario</th>
                                    <th>Descripción</th>
                                    <th>Precio total</th>
                                    <th>Metodo</th>
                                    <th>Acciones</th>
                                    <th>Status</th>
                                </tr>
                            </thead>


                            <tbody>
                                @foreach($pagos as $pus)
                                <tr>
                                    <td>{{$pus->idg}}</td>
                                    <td>{{$pus->payment_id}}</td>
                                    <td>{{$pus->nombre}}</td>
                                    <td>
                                    
            <form action='' method='POST' enctype='application/x-www-form-urlencoded' 
               name='frmdo{{$pus->idg}}' id='frmdo{{$pus->idg}}' target='_self'>
                   <input type='hidden' value='{{$pus->idg}}' name='idg' id='idg'>
                   <input type = 'hidden' value = '{{$pus->descr}}' name = 'cantina' id= 'cantina'>
<div class='div'> <input type='button'  class='btn btn-outline-info' id='detalle' name='detalle' value='Detalles' /></div>
</form>

                                    
                                    
                                    </td>                        
<td><font color="#1D82EC"><strong> ${{$pus->precio}}  </strong></font></td>

<td><font color="#FF5500"><strong>{{$pus->me}} </strong></td>

                                    <td>

<form action='' method='POST' enctype='application/x-www-form-urlencoded' 
               name='frmdo{{$pus->idg}}' id='frmdo{{$pus->idg}}' target='_self'>
                   <input type='hidden' value='{{$pus->idg}}' name='idg' id='idg'>
                   <input type = 'hidden' value = '{{$pus->descr}}' name = 'canti' id= 'canti'>
<div class='div'>  <input type='button'  class='borrar' id='button' name='borrar' value='Status' /> </div>
</form>

</td>

                                    @if($pus->sta=="Aprobado")
<td><span class="badge badge-pill badge-primary">  {{$pus->sta}} </span></td>
@else

<td><span class="badge badge-pill badge-success"> {{$pus->sta}}  </span></td>
@endif

                   </tr>

                   
                                @endforeach


                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

     

   

    

     
            <script type="text/javascript">

        $(function () {                 
                $('.borrar').click(function () {
                        formulario = this.form;
                        $("#tapa").load('{{url('modistatus')}}' + '?' + $(this).closest('form').serialize()) ;
                        $("#deta").hide();
                    });

                $('#myModal').on('shown.bs.modal', function () {
                $('#myInput').trigger('focus');

                })

              $('.btn').click(function () {
                       formulario = this.form;
                       $("#deta").load('{{url('descripcion')}}' + '?' + $(this).closest('form').serialize()) ;
                       $("#deta").show();
                        
            });
    
            });
        
                
        </script>


</body>

