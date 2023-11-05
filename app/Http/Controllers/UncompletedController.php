<?php

namespace App\Http\Controllers;

use App\Models\Uncompleted;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UncompletedController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Uncompleted::all(); 
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
        $form_data = $request->validate([
            'name'=>'required', 
            'phone'=> 'required', 
            'email'=> 'required' 
        ]);

        return Uncompleted::create($form_data);
    }

    /**
     * Display the specified resource.
     */
    public function show(Uncompleted $uncompleted)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Uncompleted $uncompleted)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Uncompleted $uncompleted)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Uncompleted $uncompleted, string $id)
    {
        return Uncompleted::destroy($id);
    }
}
