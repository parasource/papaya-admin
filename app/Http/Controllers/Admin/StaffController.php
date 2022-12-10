<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AppUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StaffController extends Controller
{
    public function index(Request $request) {
        $query = User::orderByDesc('id');

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

        return view('admin.staff.index', compact('users'));
    }

    public function create()
    {
        $roles = User::rolesList();
        return view('admin.staff.create', compact('roles'));
    }

    public function show(User $user) {
        return view('admin.staff.show', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string'],
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
            'role' => ['required', 'string', Rule::in(array_keys(User::rolesList()))]
        ]);

        $user = User::create([
            'name' => $request['name'],
            'email' => $request['email'],
            'password' => bcrypt($request['password']),
            'role' => $request['role']
        ]);

        return redirect()->route('admin.staff.show', $user);
    }

    public function edit(User $user) {

    }

    public function update(Request $request, User $user) {

    }

    public function ban(User $user) {
        $user->ban();

        return redirect()->back()->with('success', 'Забанен ебать');
    }

    public function delete() {
        return redirect()->route('admin.staff.index');
    }


}
