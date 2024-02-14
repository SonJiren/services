use App\Models\Service;
use Illuminate\Http\Request;

public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'telefono' => 'required|string|max:255',
        'domicilio' => 'required|string|max:255',
        'fecha' => 'required|date',
        'servicio' => 'required|string|max:255',
        'pago' => 'nullable|numeric',
    ]);

    Service::create($request->all());

    return redirect()->back()->with('success', 'Cliente agregado correctamente');
}
