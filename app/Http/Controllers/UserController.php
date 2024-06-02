<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        return User::with(['contracts', 'tickets', 'companies', 'roles'])->get();
    }

    public function show(string $id)
    {

        return User::with(['contracts', 'tickets', 'companies', 'media'])->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        $user = User::find($id);
        if (empty($request['password'])) unset($request['password']);
        else $request['password'] = Hash::make($request['password']);

        $user::where('id', $id)->update($request->all());
        return $user;
    }

    // Get the count of users
    public function count()
    {
        return User::all()->count();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
    }
}
