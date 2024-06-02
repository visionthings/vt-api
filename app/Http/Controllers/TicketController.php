<?php

namespace App\Http\Controllers;

use App\Http\Requests\TicketRequest;
use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Ticket::all();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        return Ticket::create($request->all());
    }

    /**
     * Search by email
     */
    public function search($email)
    {
        return Ticket::where('email', $email)->get();
    }

    /**
     * Update the specified resource in storage.
     */
    public function close_ticket(TicketRequest $request, Ticket $ticket)
    {
        $user = auth()->user();
        if (!$user || !$user->hasRole('super_admin') || !$user->can('close_ticket')) {
            return response()->json('not auth', 401);
        };
        $ticket = Ticket::find($request->id);
        $ticket->status = 'closed';
        return response()->json('done', 201);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Ticket $ticket, string $id)
    {
        $user = auth()->user();
        if (!$user || !$user->hasRole('super_admin')) {
            return response('عفواً، ليس لديك الصلاحية لحذف طلب الزيارة.');
        }
        return $ticket->destroy($id);
    }
}
