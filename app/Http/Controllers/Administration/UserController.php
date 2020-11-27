<?php

namespace App\Http\Controllers\Administration;

use App\Http\Controllers\Controller;
use App\Models\Administration\Role;
use App\Models\User;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $trashed = preg_match('/trashed/', request()->url()) === 1;
        if ($trashed) {
            $users = User::onlyTrashed()->get();
        } else {
            $users = User::withoutTrashed()->get();
        }
        return view('administration.users.index', ['trashed' => $trashed]);
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
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show($user)
    {
        dd($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view(
            'administration.users.edit',
            [
                'user' => $user,
                'roles' => Role::all()->pluck('name', 'id'),
            ]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate(
            [
                'name' => 'required',
                'email' => 'required',
                'roles' => 'required',
            ]
        );

        $user->update(
            [
                'name' => $request->name,
                'email' => $request->email,
            ]
        );

        $user->roles()->sync($request->roles);

        flash('User updated');

        return redirect()->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        flash('User disabled');
        return redirect()->route('users.index');
    }

    public function forceDelete($id)
    {
        User::withTrashed()->find($id)->forceDelete();
        flash('User deleted successfully');
        return redirect()->route('users.index');
    }

    public function restore(int $user)
    {
        $user = User::withTrashed()->find($user)->restore();
        flash('User restored');
        return redirect()->route('users.index');
    }

    /**
     * Verify user.
     *
     * @param User $user
     * @return void
     */
    public function verify(Request $request, User $user)
    {
        $user->verified = 1;
        $user->saveOrFail();
        // $request->session()->flash('status', 'User verified' . $user->name . 'successfully');
        flash('User verified');
        return redirect()->back();
        // ->with('flashSuccess', 'User verified ' . $user->name . ' successfully');
    }
}
