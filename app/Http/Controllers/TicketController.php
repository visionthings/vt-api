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
        return Ticket::latest()->paginate(10);
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
    public function close_ticket(TicketRequest $request, Ticket $ticket, string $id)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            $ticket = Ticket::find($id);
            $ticket->status = 'closed';
            $ticket->save();
            return response()->json(['message' => 'تم غلق الطلب بنجاح.'], 201);
        }
    }

    public function open_tickets()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            return Ticket::where('status', 'open')->latest()->paginate(10);
        }
    }
    public function closed_tickets()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            return Ticket::where('status', 'closed')->latest()->paginate(10);
        }
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
