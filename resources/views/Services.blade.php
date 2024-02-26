<!-- resources/views/Services.blade.php -->

<h1>Listado de Servicios</h1>

@foreach ($Services as $service)

<div>
    <h2>{{ $Services->nombre }}</h2>
</div>

@endforeach

{{ $Services->links() }}