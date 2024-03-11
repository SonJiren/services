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
            'amount' => 'required|numeric|min:2',
            'token' => 'required|string|min:16',
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

    public function simulatePayment (Request $request)
    {
        $amount = $request->input('amount');
    }
}



/* App/Http/Controllers/PaymentsController.php
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
} */
