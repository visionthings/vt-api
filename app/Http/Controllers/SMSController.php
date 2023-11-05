<?php

namespace App\Http\Controllers;

use App\Models\SMS;
use Illuminate\Http\Request;

class SMSController extends Controller
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
    public function create($number)
    {
        $basic  = new \Vonage\Client\Credentials\Basic("bda6acc1", "sPkYj2Rb9gIRirNu");
        $client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));

        $request = new \Vonage\Verify\Request($number, "Vision Things");
        $response = $client->verify()->start($request);
        $res = $response->getRequestId();

        return response($res, 201);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function verify(Request $request)
    {
       $fileds = $request->validate([
        'id'=> 'nullable',
        'code'=> 'nullable',
       ]);
       $id = $fileds['id'];
       $code = $fileds['code'];
       $basic  = new \Vonage\Client\Credentials\Basic("bda6acc1", "sPkYj2Rb9gIRirNu");
       $client = new \Vonage\Client(new \Vonage\Client\Credentials\Container($basic));

       $result = $client->verify()->check($id, $code);
       $res = $result->getResponseData();
       return response($res, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(SMS $sMS)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SMS $sMS)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SMS $sMS)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SMS $sMS)
    {
        //
    }
}
