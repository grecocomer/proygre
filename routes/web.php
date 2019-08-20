<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/jeje', function () {
    return view('welcome');
});


Route::get('/det', function () {
    return view('modulos.producto.detalles');
});


//paginas de productos
route::get('/limpieza','con1@limpieza')->name('limpieza');
route::get('/seguridad','con1@seguridad')->name('seguridad');
// pag rpincipal
route::get('/vistaprincipal','con1@vistaprincipal')->name('principal');


// rutas para el cliente
route::get('/altacliente','concliente@altacliente');
Route::POST('/guardacliente','concliente@guardacliente')->name('guardacliente');

Route::get('/confirmacion','concliente@confirmacion')->name('confirmacion'); // Confirma el guardado de los datos
Route::get('/inicio','concliente@home')->name('home');

// ruta para reportes.
Route::get('/reporteclientes', 'concliente@reporteclientes');
// ruta para eliminar cliente con parametros idm
Route::get('/eliminac/{idc}', 'concliente@eliminac')->name('eliminac');
//modificar cliente
Route::get('/modificac/{idc}', 'concliente@modificac')->name('modificac');
//guarda los nuevos datos modificados
Route::POST('/guardaedicionc', 'concliente@guardaedicionc')->name('guardaedicionc');
//eliminacion solo para desactivar
Route::get('/restaurarc/{idc}', 'concliente@restaurarc')->name('restaurarc');



// rutas para el empleado
route::get('/altaempleados','conempleado@altaempleados');
Route::POST('/guardaempleado','conempleado@guardaempleado')->name('guardaempleado');

Route::get('/confirmacion','conempleado@confirmacion')->name('confirmacion'); // Confirma el guardado de los datos
Route::get('/inicio','conempleado@home')->name('home');
// ruta para reportes.
Route::get('/reporteempleado', 'conempleado@reporteempleado');
// ruta para eliminar cliente con parametros id-emp
Route::get('/eliminae/{id_emp}', 'conempleado@eliminae')->name('eliminae');
//modificar cliente
Route::get('/modificae/{id_emp}', 'conempleado@modificae')->name('modificae');
//guarda los nuevos datos modificados
Route::POST('/guardaedicione', 'conempleado@guardaedicione')->name('guardaedicione');
//eliminacion solo para desactivar
Route::get('/restaurare/{id_emp}', 'conempleado@restaurare')->name('restaurare');



//rutas para proveedor
route::get('/altaproveedor','conproveedor@altaproveedor');
Route::POST('/guardaproveedor','conproveedor@guardaproveedor')->name('guardaproveedor');

Route::get('/confirmacion','conproveedor@confirmacion')->name('confirmacion'); // Confirma el guardado de los datos
Route::get('/inicio','conproveedor@home')->name('home');
// ruta para reportes.
Route::get('/reporteproveedor', 'conproveedor@reporteproveedor');
// ruta para eliminar provedor con parametros idm
Route::get('/eliminap/{id_prov}', 'conproveedor@eliminap')->name('eliminap');
//modificar provedor
Route::get('/modificap/{id_prov}', 'conproveedor@modificap')->name('modificap');
//guarda los nuevos datos modificados
Route::POST('/guardaedicionpro', 'conproveedor@guardaedicionpro')->name('guardaedicionpro');
//eliminacion solo para desactivar
Route::get('/restaurarp/{id_prov}', 'conproveedor@restaurarp')->name('restaurarp');



// rutas productos
route::get('/altaproducto','conproducto@altaproducto');
Route::POST('/guardaproducto','conproducto@guardaproducto')->name('guardaproducto');

Route::get('/confirmacion','conproducto@confirmacion')->name('confirmacion'); // Confirma el guardado de los datos
Route::get('/inicio','conproducto@home')->name('home');

// ruta para reportes.
Route::get('/reporteproducto', 'conproducto@reporteproducto');
//modificar
Route::get('/modificaproductos/{id_prod}', 'conproducto@modificaproductos')->name('modificaproductos');
//guarda los nuevos datos modificados
Route::POST('/guardaedicionp', 'conproducto@guardaedicionp')->name('guardaedicionp');
//ruta para eliminar desactivar registros
Route::get('/eliminaproducto/{id_prod}', 'conproducto@eliminaproducto')->name('eliminaproducto');
//restaurar datos
Route::get('/restaurarproducto/{id_prod}', 'conproducto@restaurarproducto')->name('restaurarproducto');




// rutas para el servicio
route::get('/altaservicio','conservicio@altaservicio');
Route::POST('/guardaservicio','conservicio@guardaservicio')->name('guardaservicio');

Route::get('/confirmacion','conservicio@confirmacion')->name('confirmacion'); // Confirma el guardado de los datos
Route::get('/inicio','conservicio@home')->name('home');
// ruta para reportes.
Route::get('/reporteservicio', 'conservicio@reporteservicio');
//modificar
Route::get('/modificaservicios/{id_ser}', 'conservicio@modificaservicios')->name('modificaservicios');
//guarda los nuevos datos modificados
Route::POST('/guardaedicionser', 'conservicio@guardaedicionser')->name('guardaedicionser');
//ruta para eliminar desactivar registros
Route::get('/eliminaservicio/{id_ser}', 'conservicio@eliminaservicio')->name('eliminaservicio');
//restaurar datos
Route::get('/restaurarservicio/{id_ser}', 'conservicio@restaurarservicio')->name('restaurarservicio');


// rutas para empresas
route::get('/altaempresa','conempresa@altaempresa');
Route::POST('/guardaempresa','conempresa@guardaempresa')->name('guardaempresa');
Route::get('/reporteempresa', 'conempresa@reporteempresa');

Route::get('/confirmacion','conempresa@confirmacion')->name('confirmacion'); // Confirma el guardado de los datos
Route::get('/inicio','conempresa@home')->name('home');


// ruta para eliminar empresas con parametros id-emp
Route::get('/eliminaem/{id_empresa}', 'conempresa@eliminaem')->name('eliminaem');
//modificar empresas
Route::get('/modificaem/{id_empresa}', 'conempresa@modificaem')->name('modificaem');
//guarda los nuevos datos modificados
Route::POST('/guardaedicionem', 'conempresa@guardaedicionem')->name('guardaedicionem');
//eliminacion solo para desactivar
Route::get('/restaurarem/{id_empresa}', 'conempresa@restaurarem')->name('restaurarem');


//rutas del login
route::get('/','conuser@login')->name('login');
Route::POST('/validalogin','conuser@validalogin')->name('validalogin');
Route::get('/principal','conuser@principal')->name('principal');
Route::get('/cerrarsesion','conuser@cerrarsesion');

//modulos productos
Route::get('/venta','moproducto@venta')->name('venta');
Route::get('/combopro','moproducto@combopro')->name('combopro');
Route::get('/detallep','moproducto@detallep')->name('detallep');
Route::get('/carrito','moproducto@carrito')->name('carrito');
Route::get('/borraventas','moproducto@borraventas')->name('borraventas');
Route::get('/restuara','moproducto@restaura')->name('restaura');

//modulos servicio
Route::get('/venta_s','moservicio@venta_s')->name('venta_s');
Route::get('/comboser','moservicio@comboser')->name('comboser');
Route::get('/detalles','moservicio@detalles')->name('detalles');
Route::get('/carritos','moservicio@carritos')->name('carritos');
Route::get('/borraventass','moservicio@borraventass')->name('borraventass');

//paypal
Route::get('/pay', 'moproducto@pay')->name('pay');

//payment form
Route::get('/pagos', 'PaymentController@index')->name('pagos');

// route for processing payment
Route::post('paypal', 'PaymentController@payWithpaypal')->name('paypal');

// route for check status of the payment
Route::get('status', 'PaymentController@getPaymentStatus');

// ruta para reporte
Route::get('/reportepay', 'moproducto@reportepay')->name('reportepay');

//mostrar detalles
Route::get('/detalles/{idg}', 'moproducto@detalles')->name('detalles');

//buscador ya no
//Route::get('/buscador','SearchController@index');
//Route::get('/search','SearchController@search');


//buscador ya si

Route::get('/buscador','buscador@index');
Route::get('/combopago','buscador@combopago')->name('combopago');
Route::get('/descripcion','buscador@descripcion')->name('descripcion');
Route::get('/modistatus','buscador@modistatus')->name('modistatus');

