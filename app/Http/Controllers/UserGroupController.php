<?php

namespace App\Http\Controllers;

use App\UserGroup;
use Illuminate\Http\Request;

class UserGroupController extends Controller
{
    public function index()
    {
        $groups = UserGroup::all();
        
        return view('user_group.index', compact('groups'));
    }

    public function create()
    {
        return view('user_group.create');
    }

    public function store(Request $request)
    {
        UserGroup::create($request->all());

        return redirect()->route('group.index')->withStatus('Group successfully created.');
    }

    public function show($id)
    {
        $group = UserGroup::findOrFail($id);

        return view('user_group.show', compact('group'));
    }

    public function edit($id)
    {
        $group = UserGroup::findOrFail($id);

        return view('user_group.edit', compact('group'));
    }

    public function update(Request $request, $id)
    {
        $group = UserGroup::findOrFail($id);

        $group->update($request->all());

        return redirect()->route('group.index')->withStatus('Group successfully updated.');
    }

    public function destroy($id)
    {
        $group = UserGroup::findOrFail($id);

        $group->delete();

        return redirect()->route('group.index')->withStatus('Group successfully deleted.');
    }
}
