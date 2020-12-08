<?php

namespace App\Http\Controllers\Catering;

use App\Http\Controllers\Controller;
use App\Models\Catering\Dish;
use App\Models\Catering\Supplier;
use Illuminate\Http\Request;

class DishController extends Controller
{

    public function __construct()
    {
        $this->middleware('hasCart');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function allSupplierDishes(Supplier $supplier)
    {
        if (!$supplier->dishes()->exists()) {
            flash('This supplier has no dishes in menu yet.')->warning();
            return redirect()->back();
        }

        return view('catering.dishes.menu', ['supplier' => $supplier]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Supplier $supplier)
    {
        return view('catering.dishes.create', ['supplier' => $supplier]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'image' => 'required|image',
            'price' => 'required|numeric',
            'special_price' => 'required|numeric',
        ]);

        $imgPath = $request->file('image')->store('dishes', 'public');

        Dish::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imgPath,
            'price' => $request->price,
            'special_price' => $request->special_price,
            'supplier_id' => $request->supplier_id,
        ]);
        return redirect()->route('dishes', $request->supplier_id);
    }
}
