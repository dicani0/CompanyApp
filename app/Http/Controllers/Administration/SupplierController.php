<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Catering\Supplier;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administration.suppliers.index', ['suppliers' => Supplier::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'supplier');
        })->get()
            ->pluck('name', 'id');

        return view('administration.suppliers.create', ['users' => $users]);
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
            'address' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'image' => 'required|image',
        ]);

        $imgPath = $request->file('image')->store('suppliers', 'public');

        Supplier::create([
            'name' => $request->name,
            'address' => $request->address,
            'description' => $request->description,
            'user_id' => $request->user_id,
            'logo' => $imgPath,
        ])
            ->save();
        flash('Supplier added!');
        return redirect()->route('suppliers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catering\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function show(Supplier $supplier)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catering\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function edit(Supplier $supplier)
    {
        $users = User::whereHas('roles', function ($q) {
            $q->where('name', '=', 'supplier');
        })->get()
            ->pluck('name', 'id');

        return view(
            'administration.suppliers.edit',
            [
                'supplier' => $supplier,
                'users' => $users,
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catering\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Supplier $supplier)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'description' => 'required',
            'user_id' => 'required',
            'logo' => 'image',
        ]);

        if (isset($request->image)) {
            Storage::disk('public')->delete($supplier->logo);
            $imgPath = $request->file('image')->store('suppliers', 'public');
            $supplier->update([
                'name' => $request->name,
                'address' => $request->address,
                'description' => $request->description,
                'user_id' => $request->user_id,
                'logo' => $imgPath,
            ]);
        } else {
            $supplier->update([
                'name' => $request->name,
                'address' => $request->address,
                'description' => $request->description,
                'user_id' => $request->user_id,
            ]);
        }


        \flash('Supplier updated!');
        return redirect()->route('suppliers.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catering\Supplier  $supplier
     * @return \Illuminate\Http\Response
     */
    public function destroy(Supplier $supplier)
    {
        //
    }
}
