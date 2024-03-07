<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class PaginateController extends Controller
{
    public function index(Request $request)
    {
        try {
            $services = Service::paginate(5);
            $servicesLinks = $services->links();
            return view('servicios', compact('services', 'servicesLinks'));
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->withException($request, $e);
        } catch (\Exception $e) {
            return response()->withException($request, $e);
        }
    }
}



/* {
    public function index()
    {
        try {
            $services = Service::paginate(5);
            $servicesLinks = $services->links();
            return view('servicios', compact('services', 'servicesLinks'));
        } catch (\Illuminate\Database\QueryException $e) {
            return response()->view('error', ['error' => 'Error de la base de datos: ' . $e->getMessage()], 500);
        } catch (\Exception $e) {
            return response()->view('error', ['error' => $e->getMessage()], 500);
        }
    }
} */
