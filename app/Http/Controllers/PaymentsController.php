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



App/Http/Controllers/PaymentsController.php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentTransaction extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'amount', 'status', 'token'];

    //Relacion con el modelo de usuario.
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

use App\Models\PaymentTransaction;

class PaymentController extends Controller
{
    public function store(Request $request)
    {
        $PaymentTransaction = PaymentTransaction::create([
            'user_id' => auth()->id(),
            'amount' => $amount,
            'status' => $paymentSuccessful ? 'success' : 'cancel',
            'token' => $token,
        ]);

        if ($paymentSuccessful) {
            return redirect()->route('payment.success');
        } else {
            return redirect()->route('payment.cancel');
        }
    }
}
*/
