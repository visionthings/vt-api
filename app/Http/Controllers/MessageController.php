<?php

namespace App\Http\Controllers;

use App\Http\Requests\MessageRequest;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            return Message::latest()->paginate(10);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MessageRequest $request)
    {
        return Message::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(Message $message, string $id)
    {
        return $message->find($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Message $message, string $id)
    {
        return $message->destroy($id);
    }
}
