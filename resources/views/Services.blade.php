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