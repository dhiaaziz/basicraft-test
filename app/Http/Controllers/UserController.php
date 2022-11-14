<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    //
    public function token(){
        return csrf_token();
    }

    public function index()
    {
        // dd('test_user');
        return view('admin.users.index');
    }

    public function fetch()
    {
        $users = \App\Models\User::all();
        // dd($users);
        return response()->json([
            'data' => $users
        ]);
        // return view('users.index');
    }

    public function store(Request $request)
    {
        // dd($request->all());

        $user = new \App\Models\User();
        // $user = $request->all();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->is_active = $request->is_active;
        $user->created = now();
        $user->updated = now();
        $user->save();
        return response()->json($user);
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $user = \App\Models\User::where('id_user', $id)->first();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->is_active = $request->is_active;
        $user->updated = now();
        $user->save();
        return response()->json($user);
    }

    public function destroy($id)
    {
        $user = \App\Models\User::where('id_user', $id)->first();
        $user->delete();
        return response()->json($user);
    }
}
