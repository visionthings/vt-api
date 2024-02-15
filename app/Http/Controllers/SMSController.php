<?php

namespace App\Http\Controllers;

use App\Models\SMS;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
    public function create(string $number)
    {
        $response = Http::post('https://rest.gateway.sa/api/Verify', [
            'api_id' => 'API94645066018',
            'api_password' => 'tmGeSwL5SA',
            'brand' => 'VisionThings',
            'phonenumber' => $number,
            'sender_id' => 'vt.com.sa',
        ]);
        return $response;
    }

    public function verify(Request $request)
    {
        $form_fields = $request->validate(
            ['verification_id' => 'required', 'verification_code' => 'required']
        );

        $response = Http::post('http://rest.gateway.sa/api/VerifyStatus', [
            'verification_id' => $form_fields['verification_id'],
            'verification_code' => $form_fields['verification_code'],
        ]);

        return $response;
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
