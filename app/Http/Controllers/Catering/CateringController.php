<?php

namespace App\Http\Controllers\Catering;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Catering\Supplier;

class CateringController extends Controller
{
    public function dashboard()
    {
        return view('catering.dashboard', ['suppliers' => Supplier::all()]);
    }
}
