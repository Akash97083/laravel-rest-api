<?php

namespace App\Http\Controllers;

use App\Model\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json(['data' => $users], 200);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed'
        ]);

        $requested_data = $request->only(['name', 'email', 'password']);

        $requested_data['password'] = Hash::make($request->password);
        $requested_data['verified'] = User::UNVERIFIED_USER;
        $requested_data['verification_token'] = (new User)->generateVerificationToken();
        $requested_data['admin'] = User::REGULAR_USER;

        $user = User::create($requested_data);

        return response()->json(['data' => $user], 201);
    }

    public function show(User $user)
    {
        return response()->json(['data' => $user], 200);
    }

    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
