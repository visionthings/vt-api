<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::with(['contracts','visit_requests'])->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $form_fields = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'phone' => 'required',
            'commercial_number' => 'required',
            'address' => 'required',
        ]);

        return User::create($form_fields);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::with(['contracts','visit_requests'])->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $user = User::find($id);
        $form_fields = $request->validate([
            'name' => 'nullable',
            'email' => 'nullable',
            'password' => 'nullable',
            'phone' => 'nullable',
            'commercial_number' => 'nullable',
            'address' => 'nullable',
        ]);
         if (empty($form_fields['password'])) unset($form_fields['password']);
        else $form_fields['password'] = Hash::make($form_fields['password']);
        
        $user::where('id', $id)->update($form_fields);
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::destroy($id);
    }
}
