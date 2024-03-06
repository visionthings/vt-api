<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $user_id)
    {
        return Company::where('user_id', $user_id)->get();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Company::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, $id)
    {
        return $company->find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Company $company)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Company $company, $id)
    {
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, string $id)
    {
        return Company::destroy($id);
    }
}
