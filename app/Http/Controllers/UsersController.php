<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', [
            'except' => ['create', 'store']
        ]);

        $this->middleware('guest', [
            'only' => ['create']
        ]);
    }

    // register page
    public function create()
    {
        return view('users.create');
    }

    // user profile page
    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function index()
    {
        //$users = User::all();

        $users = User::paginate(10);

        return view('users.index', compact('users'));
    }

    public function edit(User $user)
    {
        // $user = $currentUser: can edit
        $this->authorize('update', $user);

        return view('users.edit', compact('user'));
    }

    // post: store registered user name, email and password in database
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|confirmed|min:6'
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // auto login after register
        Auth::login($user);

        session()->flash('success', 'welcome to our blog!');
        return redirect()->route('users.show', [$user]);
        // = return redirect()->route('users.show', [$user->id];
    }

    public function update(User $user, Request $request)
    {
        // $user = $currentUser: can update
        $this->authorize('update', $user);

        $this->validate($request, [
            'name' => 'required|max:50',
            'password' => 'nullable|confirmed|min:6'
        ]);

        /*
        $user->update([
            'name' => $request->name,
            'password' => bcrypt($request->password)
        ]);
        */

        // user can choose not to update password
        $data = [];
        $data['name'] = $request->name;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        $user->update($data);
        session()->flash('success', 'user profile updated!');

        return redirect()->route('users.show', $user->id);
    }
}
