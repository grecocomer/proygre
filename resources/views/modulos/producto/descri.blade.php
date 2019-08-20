<form>
 
  <div class="form-group">
   <h4> <label for="exampleFormControlTextarea1">Detalles de la Venta</label></h4>
   <hr>
    <textarea class="form-control" readonly='readonly'  name = 'detal' id= 'detal' rows="10">
   
Fecha de la venta: * {{$pagos->fecha}} *

Productos: * {{$pagos->descr}} *

Dirección de Envio: * {{$pagos->direc}} *

Datos del comprador: * {{$pagos->email}}  ,  {{$pagos->tel}} *
    
    </textarea>
  </div>
</form>


