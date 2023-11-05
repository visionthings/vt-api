<?php

namespace App\Http\Controllers;

use App\Models\Promocode;
use Illuminate\Http\Request;

class PromocodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Promocode::all();
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

            'promocode'=>'required',
            'discount'=>'required',
            'start_date'=>'required',
            'expiry_date'=>'required',

        ]);

        return Promocode::create($form_fields);
    }

    /**
     * Display the specified resource.
     */
    public function show(Promocode $promocode, string $id)
    {
        return Promocode::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Promocode $promocode)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Promocode $promocode, int $id)
    {
        $promocode = Promocode::find($id);
        $form_fields = $request->validate([
            'promocode'=>'required',
            'discount'=>'required',
            'start_date'=>'required',
            'expiry_date'=>'required',
        ]);

        $promocode::where('id', $id)->update($form_fields);
        return $promocode;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promocode $promocode, string $id)
    {
        return Promocode::destroy($id);
    }
}
