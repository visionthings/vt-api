<?php

namespace App\Http\Controllers;

use App\Models\InterestedMessage;
use Illuminate\Http\Request;

class InterestedMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return InterestedMessage::all();
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
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'company_name'=>'required',
            'company_type'=>'required',
            'company_size'=>'required',
            'message'=>'required',
        ]);

        return InterestedMessage::create($form_fields);
    }

    /**
     * Display the specified resource.
     */
    public function show(InterestedMessage $interestedMessage, string $id)
    {
        return InterestedMessage::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(InterestedMessage $interestedMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, InterestedMessage $interestedMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(InterestedMessage $interestedMessage, string $id)
    {
        return InterestedMessage::destroy($id);
    }
}
