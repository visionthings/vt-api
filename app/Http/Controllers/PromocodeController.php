<?php

namespace App\Http\Controllers;

use App\Http\Requests\PromocodeRequest;
use App\Models\Promocode;

class PromocodeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            return Promocode::latest()->paginate(10);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(PromocodeRequest $request)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            Promocode::create($request->all());
            return response(['message' => 'تم إنشاء كوبون الخصم بنجاح.'], 200);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Promocode $promocode, string $id)
    {
        return $promocode->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(PromocodeRequest $request, Promocode $promocode, int $id)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            $promocode = Promocode::find($id);
            $promocode::where('id', $id)->update($request->all());
            return $promocode;
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Promocode $promocode, string $id)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin')) {
            return $promocode->destroy($id);
        }
    }
}
