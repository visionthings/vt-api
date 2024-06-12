<?php

namespace App\Http\Controllers;

use App\Models\ContactEmail;
use Illuminate\Http\Request;

class ContactEmailController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $email = ContactEmail::create($request->all());
        return response()->json($email, 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(ContactEmail $contactEmail, string $id)
    {
        $email = ContactEmail::find($id);
        return response()->json($email, 200);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContactEmail $contactEmail)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContactEmail $contactEmail)
    {
        $email = $contactEmail->update($request->all());
        return response()->json($email, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContactEmail $contactEmail, string $id)
    {
        return $contactEmail->destroy($id);
    }
}
