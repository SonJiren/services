<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class PaginateController extends Controller
{
    public function index()
    {
        $services = Service::paginate(5); //Paginar hasta un máximo de 5.
        return view('servicios', compact('Services'));
    }
}
