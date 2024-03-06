<?php

namespace App\Http\Controllers;

use App\Payments\PaymentGateway;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    public function store(Request $request)
    {
        $paymentGateway = new PaymentGateway();

        $response = $paymentGateway->charge($request->amount, $request->token);

        //Retornar a "pagina de éxito".
        return redirect()->route('payments.success');
    }
}
