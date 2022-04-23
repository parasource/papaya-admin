<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\User;
use Illuminate\Http\Request;

class UsersController extends Controller
{

    public function index(Request $request)
    {
        $query = AppUser::whereNull('deleted_at')->orderByDesc('id');

        if (!empty($value = $request->input('id'))) {
            $query->where('id', $value);
        }
        if (!empty($value = $request->input('name'))) {
            $query->where('name', 'like', '%' . $value . '%');
        }
        if (!empty($value = $request->input('email'))) {
            $query->where('email', 'like', '%' . $value . '%');
        }

        $users = $query->paginate(20);

        return view('admin.users.index', compact('users'));
    }


    public function create()
    {

    }


    public function store(Request $request)
    {
        //
    }


    public function show(AppUser $user)
    {
        return view('admin.users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\User $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
