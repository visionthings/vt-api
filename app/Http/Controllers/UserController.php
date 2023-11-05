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
        return User::all();
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
            'username'=>'nullable',
            'password'=>'required',
            'name'=> 'nullable',
             'phone'=>'nullable',
             'email'=>'nullable',
           'company_type'=>'nullable',
         'commercial_number'=>'nullable',
      'tax_number'=>'nullable',
      'address'=>'nullable',
      'city'=>'nullable',
      'building_number'=>'nullable',
      'street_name'=>'nullable',
      'second_number'=>'nullable',
      'district'=>'nullable',
      'zip_code'=>'nullable',
            'manage_pages'=>'nullable',
            'manage_contracts'=>'nullable',
            'create_contract'=>'nullable',
            'manage_promocodes'=>'nullable',
            'manage_members'=>'nullable',
            'view_reports'=>'nullable',
            'view_mail'=>'nullable'
        ]);

        return User::create($form_fields);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return User::find($id);
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
            'username'=>'nullable',
            'password'=>'nullable',
            'name'=> 'nullable',
             'phone'=>'nullable',
             'email'=>'nullable',
           'company_type'=>'nullable',
         'commercial_number'=>'nullable',
      'tax_number'=>'nullable',
      'address'=>'nullable',
      'city'=>'nullable',
      'building_number'=>'nullable',
      'street_name'=>'nullable',
      'second_number'=>'nullable',
      'district'=>'nullable',
      'zip_code'=>'nullable',
            'manage_pages'=>'nullable',
            'manage_contracts'=>'nullable',
            'create_contract'=>'nullable',
            'manage_promocodes'=>'nullable',
            'manage_members'=>'nullable',
            'view_reports'=>'nullable',
            'view_mail'=>'nullable',
            'profile_pic'=>'nullable'
        ]);
         if (empty($form_fields['password'])) unset($form_fields['password']);
        else $form_fields['password'] = Hash::make($form_fields['password']);

        if ($request->has('manage_pages') === false) {
            $form_fields['manage_pages'] = null;
        }
        if ($request->has('manage_contracts') === false) {
            $form_fields['manage_contracts'] = null;
        }
        if ($request->has('create_contract') === false) {
            $form_fields['create_contract'] = null;
        }
        if ($request->has('manage_promocodes') === false) {
            $form_fields['manage_promocodes'] = null;
        }
        if ($request->has('manage_members') === false) {
            $form_fields['manage_members'] = null;
        }
        if ($request->has('view_reports') === false) {
            $form_fields['view_reports'] = null;
        }
        if ($request->has('view_mail') === false) {
            $form_fields['view_mail'] = null;
        }
        if($request->hasFile('profile_pic')) {
            $file = $request->file('profile_pic')->store('images/profile_pics', 'images');
            $form_fields['profile_pic'] = $file;
        }
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
