<?php

namespace App\Http\Controllers;

use App\Payments\PaymentGateway;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function store(Request $request)
    {
        //Validar la solicitud del pago.
        $request->validate([
            'amount' => 'required|numeric',
            'token' => 'required|string',
        ]);

        //Obtener datos de un formulario
        $amount = $request->input('amount');
        $token = $request->input('token');

        //Crear instancia en PaymentGateway.
        $paymentGateway = new PaymentGateway($amount, $token);

        //Procesar el pago.
        $paymentSuccessful = $paymentGateway->processPayment();

        //Redirigir según el resultado.
        if ($paymentSuccessful) {
            return redirect()->route('payment.success'); //Pago exitoso.
        } else {
            return redirect()->route('payment.cancel'); //Pago cancelado.
        }
    }
}


/*
{
    public function store(Request $request)
    {
        $paymentGateway = new PaymentGateway();

        $response = $paymentGateway->charge($request->amount, $request->token);

        //Retornar a "pagina de éxito".
        return redirect()->route('payments.success');
    }
}
*/
