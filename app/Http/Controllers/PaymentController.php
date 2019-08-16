<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use App\pagos;

use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

/** All Paypal Details class **/
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;
use Carbon\Carbon;



class PaymentController extends Controller
{
    private $_api_context;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
            $paypal_conf['client_id'],
            $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }

    public function index()
    {
        return view('venta');
    }

    public function payWithpaypal(Request $request)
    {
        

        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $metod=$payer;
        


        $item_1 = new Item();

        $item_1
            ->setName($request->get('dcp')) /** item name **/
            ->setCurrency('MXN')
            ->setQuantity(1)
            ->setPrice($request->get('amount')); /** unit price **/

        $item_list = new ItemList();
        $item_list->setItems(array($item_1));

        $amount = new Amount();
        $amount->setCurrency('MXN')
            ->setTotal($request->get('amount'));

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription('Descripción');

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('status')) /** Specify return URL **/
            ->setCancelUrl(URL::to('status'));
            

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
            $metod=('paypal');

            /** add payment ID to session **/
        

           
            
        /** dd($payment->create($this->_api_context));exit; **/
        try {
 
            $payment->create($this->_api_context);

            

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {

                \Session::put('error', 'El tiempo de conexión expiro');
                return Redirect::to('/venta');

            } else {

                \Session::put('error', 'Se produjo algún error, disculpe las molestias');
                return Redirect::to('/venta');

            }

        }

        foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {
                
                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {
            
            $date = Carbon::now();
            $date = $date->format('Y-m-d');

            $count =0;
            $pagos = new pagos;
            $pagos->idg = $count++;
            $pagos->idc = $request->get('id');
            $pagos->payment_id = $payment->getId();
            $pagos->preciot = $request->get('amount');
            $pagos->descripcion = $request->get('dcp');
            $pagos->fecha = $date;
            $pagos->metodo = $metod;
            $pagos->status = 'Aprovado';
            $pagos->save();

            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }

        \Session::put('error', 'Se produjo un error desconocido.');
        return Redirect::to('/venta');

    }

    public function getPaymentStatus()
    {
        /** Get the payment ID before session clear **/
        $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');
        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {
           
            $deleted =\DB::delete("DELETE from pagos ORDER BY idg DESC
        LIMIT 1");
            \Session::put('error', 'Pago fallido');
            return Redirect::to('/venta')
            ->with('deleted',$deleted);

        }

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

            

        if ($result->getState() == 'approved') {

            

            \Session::put('success', 'Pago realizado con exito.');
            return Redirect::to('/reportepay');

            

        }

        \Session::put('error', 'Pago fallido');

        
        return Redirect::to('/venta');

    }

}

