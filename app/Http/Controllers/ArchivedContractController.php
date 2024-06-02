<?php

namespace App\Http\Controllers;

use App\Models\ArchivedContract;
use Illuminate\Http\Request;

class ArchivedContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return ArchivedContract::all();
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(ArchivedContract $archivedContract)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ArchivedContract $archivedContract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ArchivedContract $archivedContract)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ArchivedContract $archivedContract)
    {
        //
    }
}
