<?php

namespace App\Http\Controllers;

use App\Models\FailedPayment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class FailedPaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return FailedPayment::all(); 
    }

    /**
     * Display count of the resource.
     */
    public function count()
    {
        return FailedPayment::all()->count(); 
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

        return FailedPayment::create($form_data);
    }


    /**
     * Display the specified resource.
     */
    public function show(FailedPayment $failedPayment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FailedPayment $failedPayment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FailedPayment $failedPayment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FailedPayment $failedPayment, string $id)
    {
        return FailedPayment::destroy($id);
    }
}
