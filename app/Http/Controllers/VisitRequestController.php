<?php

namespace App\Http\Controllers;

use App\Models\VisitRequest;
use Illuminate\Http\Request;
use function Laravel\Prompts\error;

class VisitRequestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return VisitRequest::all();
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
        $fields = $request->validate([
            'user_id' => 'required', 'name' => 'required', 'phone' => 'required', 'email'=>'required'
        ]);
        return VisitRequest::create($fields);
    }
    
        /**
     * Search by email
     */
    public function search($email)
    {
        return VisitRequest::where('email', $email)->get();
    }

    /**
     * Display the specified resource.
     */
    public function show(VisitRequest $visitRequest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VisitRequest $visitRequest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VisitRequest $visitRequest)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(VisitRequest $visitRequest, $id)
    {
        $user = auth()->user();
        if (!$user->hasRole('super_admin')) {
            return response('عفواً، ليس لديك الصلاحية لحذف طلب الزيارة.');
        }
        return VisitRequest::destroy($id);
    }
}
