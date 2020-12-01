<?php

namespace App\Http\Controllers\Catering;

use App\Http\Controllers\Controller;
use App\Models\Catering\Dish;
use App\Models\Catering\Supplier;
use Illuminate\Http\Request;

class DishController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catering\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function show(Dish $dish)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catering\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function edit(Dish $dish)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catering\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dish $dish)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catering\Dish  $dish
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dish $dish)
    {
        //
    }
}
