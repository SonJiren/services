<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class PaginateController extends Controller
{
    public function index()
    {
        $Services = Services::paginate(12);
        return view('services', compact('Services'));
    }
}
