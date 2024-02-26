<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class PaginateController extends Controller
{
    public function index()
    {
        $Services = Services::paginate(5);
        return view('servicios', compact('Services'));
    }
}
