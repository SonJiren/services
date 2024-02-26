<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class PaginateController extends Controller
{
    public function index()
    {
        $services = Services::paginate(15); //Servicios paginados
        return view('Name', compact('services'));
    }
}
