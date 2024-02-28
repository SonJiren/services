<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class PaginateController extends Controller
{
    public function index()
    {
        try {
            $services = Service::paginate(5);
            return view('servicios', compact('services'));
        } catch (\Exception $e) {
            return response()->view('error', ['error' => $e->getMessage()], 500);
        }
    }
}

/*class PaginateController extends Controller
{
    public function index()
    {
        $services = Service::paginate(5);
        return view('servicios', compact('services'));
    }
}
*/