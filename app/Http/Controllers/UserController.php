<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            return User::where('membership_status', 'active')->with(['contracts', 'tickets', 'companies', 'roles'])->latest()->paginate(10);
        }
    }
    public function blocked()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            return User::where('membership_status', 'blocked')->with(['contracts', 'tickets', 'companies', 'roles'])->latest()->paginate(10);
        }
    }

    public function show(string $id)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            return User::with(['contracts', 'tickets', 'companies', 'media'])->find($id);
        }
    }

    public function check_auth()
    {
        $user = auth()->user();
        if ($user) {
            $user_with_media = User::with(['media'])->find($user->id);
            return response()->json($user_with_media, 200);
        }
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

    public function search(string $name)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            $users = User::query()
                ->where('name', 'LIKE', "%{$name}%")
                ->orWhere('email', 'LIKE', "%{$name}%")
                ->get();

            return response()->json($users, 200);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            User::destroy($id);
        }
    }
    public function block(string $id)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            $member = User::find($id);
            $member->update(['membership_status' => 'blocked']);
            $member->save();
            return response()->json(['تم حظر العضو بنجاح.', 200]);
        }
    }
    public function unblock(string $id)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            $member = User::find($id);
            $member->update(['membership_status' => 'active']);
            $member->save();
            return response()->json(['تم فك الحظر عن العضو بنجاح.', 200]);
        }
    }
}
