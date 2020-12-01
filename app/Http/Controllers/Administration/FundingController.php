<?php

namespace App\Http\Controllers\Administration;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Catering\Funding;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class FundingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('administration.fundings.index', ['users' => User::withoutTrashed()->get(), 'fundings' => Funding::all()]);
    }

    /**
     * Renew all users fundings.
     *
     * @return \Illuminate\Http\Response
     */
    public function renewAllFundings()
    {
        Funding::query()->update([
            'amount' => DB::raw('default_amount')
        ]);

        flash('All users fundings renewed!');
        return redirect()->route('fundings.index');
    }

    /**
     * Renew one user fundings.
     *
     * @return \Illuminate\Http\Response
     */
    public function renewUserFunding($id)
    {
        Funding::where('user_id', $id)->update([
            'amount' => DB::raw('default_amount')
        ]);
        flash('User funding renewed!');
        return redirect()->route('fundings.index');
    }

    /**
     * Clear one user fundings.
     *
     * @return \Illuminate\Http\Response
     */
    public function clearUserFunding($id)
    {
        Funding::where('user_id', $id)->update([
            'amount' => 0
        ]);
        flash('User funding zeroed!');
        return redirect()->route('fundings.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Catering\Funding  $funding
     * @return \Illuminate\Http\Response
     */
    public function show(Funding $funding)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Catering\Funding  $funding
     * @return \Illuminate\Http\Response
     */
    public function edit(Funding $funding)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Catering\Funding  $funding
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Funding $funding)
    {
        $request->validate([
            'amount' => 'required|numeric'
        ]);
        $funding->update([
            'default_amount' => $request->amount
        ]);
        flash('Default funding value updated');
        return redirect()->route('fundings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Catering\Funding  $funding
     * @return \Illuminate\Http\Response
     */
    public function destroy(Funding $funding)
    {
        //
    }
}
