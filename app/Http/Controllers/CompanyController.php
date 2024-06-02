<?php

namespace App\Http\Controllers;

use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Illuminate\Http\Request;

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
     * Store a newly created resource in storage.
     */
    public function store(CompanyRequest $request)
    {
        return Company::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Company $company, string $id)
    {
        return $company->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CompanyRequest $request, Company $company)
    {
        $company->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Company $company, string $id)
    {
        return $company->destroy($id);
    }
}
