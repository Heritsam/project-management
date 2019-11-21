<?php

namespace App\Http\Controllers;

use App\User;
use App\UserGroup;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $user_groups = UserGroup::all();
        
        return view('users.create', compact('user_groups'));

        \App\maklonProject::where([
            ['status_approval', 1], 
            ['id', $request->id]]
        )->get();
    }

    public function store(UserRequest $request, User $model)
    {
        $model->create(
            $request->merge(['password' => Hash::make($request->get('password'))])->all()
        );

        return redirect()->route('user.index')->withStatus(__('User successfully created.'));
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $user_groups = UserGroup::all();
        
        return view('users.edit', compact('user', 'user_groups'));
    }

    public function update(UserRequest $request, User $user)
    {
        $user->update(
            $request->merge(['password' => Hash::make($request->get('password'))])
                ->except([$request->get('password') ? '' : 'password']
        ));

        return redirect()->route('user.index')->withStatus(__('User successfully updated.'));
    }

    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->route('user.index')->withStatus(__('User successfully deleted.'));
    }
}
