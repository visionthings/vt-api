<?php

namespace App\Http\Controllers;

use App\Models\Contract;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContractController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Contract::all();
    }

    /**
     * Display a count of the resource.
     */    
    public function count()
    {
        return Contract::all()->count();
    }

    /**
     * Display a count of the resource.
     */    
    public function number()
    {
        return Contract::all()->last()->id + 10001 ;
    }

    /**
     * Display a sum of sales.
     */    
    public function sales()
    {
        $sales = DB::table('contracts')->sum('price');
        return $sales;
    }

    /**
     * Search by contract number
     */
    public function search($contract_number)
    {
        return Contract::where('contract_number', $contract_number)->get();
    }


    /**
     * Search by name
     */
    public function search_name($name)
    {
        return Contract::where('name', $name)->get();
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
            'phone'=>'required',
            'email'=>'required',
            'company_type'=>'required',
            'commercial_number'=>'required',
            'tax_number'=>'required',
            'city'=>'required',
            'building_number'=>'required',
            'street_name'=>'required',
            'second_number'=>'required',
            'district'=>'required',
            'zip_code'=>'required',
            'indoor_cameras'=>'required',
            'outdoor_cameras'=>'required',
            'storage_device'=>'required',
            'period_of_record'=>'required',
            'show_screens'=>'required',
            'camera_type'=>'required',
            'contract_date'=>'required',
            'expiry_date'=>'required',
            'contract_number'=>'required',
            'paid_amount'=>'nullable',
            'discount'=>'nullable'
        ]);

        return Contract::create($form_fields);
    }

    /**
     * Display the specified resource.
     */
    public function show(Contract $contract, string $id)
    {
        return Contract::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contract $contract)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contract $contract, string $id)
    {
        $contract = Contract::find($id);
        $form_fields = $request->validate([
            'name'=>'required',
            'phone'=>'required',
            'email'=>'required',
            'company_type'=>'required',
            'commercial_number'=>'required',
            'tax_number'=>'required',
            'city'=>'required',
            'building_number'=>'required',
            'street_name'=>'required',
            'second_number'=>'required',
            'district'=>'required',
            'zip_code'=>'required',
            'indoor_cameras'=>'required',
            'outdoor_cameras'=>'required',
            'storage_device'=>'required',
            'period_of_record'=>'required',
            'show_screens'=>'required',
            'camera_type'=>'required',
            'contract_date'=>'required',
            'expiry_date'=>'required',
            'contract_number'=>'required',
            'paid_amount'=>'nullable',
            'discount'=>'nullable'
        ]);

        $contract::where('id', $id)->update($form_fields);
        return $contract ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contract $contract, string $id)
    {
        return $contract::destroy($id);
    }
}
