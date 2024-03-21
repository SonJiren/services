<!-- resources/views/Services.blade.php -->

<h1>Listado de Servicios</h1>

@foreach ($Services as $service)

<div>
    <h2>{{ $Services->nombre }}</h2>
</div>

@endforeach

{{ $Services->links() }}

<!-- <form action="{{ route('simulate-payment') }}" method="post">
@csfr
<label for="amount">Cantidad a pagar:</label>
<input type="number" name="amount" id="amount" required>
<input type="submit" class= "btn btn-primary">Simular Pago Ficticio</button>
<form> -->

<form action="{{ route('payments.store') }}" method="POST">
    @csrf
    <label for="amount">Monto:</label>
    <input type="number" id="amount" name="amount" required>
    <label for="token">Token:</label>
    <input type="text" id="token" name="token" required>
    <!-- Campo para ingresar el monto adicional -->
    <label for="additional_amount">Monto Adicional:</label>
    <input type="number" id="additional_amount" name="additional_amount">
    <button type="submit">Realizar Pago</button>
</form>