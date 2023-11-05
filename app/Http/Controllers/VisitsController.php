<?php

namespace App\Http\Controllers;

use App\Models\Visits;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;
 
class VisitsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Visits::all(); 
    }
    /**
     * Display a count of the resource.
     */
    public function count()
    {
        return Visits::all()->count(); 
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
        $ip = $request->ip(); 
        $user_info = Location::get($ip);
        Visits::create([
            'ip'=> $ip,
            'region'=> $user_info->regionName,
            'city' => $user_info->cityName, 
            'country' => $user_info->countryName, 
        ]); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Visits $visits)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Visits $visits)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Visits $visits, string $id)
    {
      
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Visits $visits)
    {
        //
    }
}
