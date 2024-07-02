<?php

namespace App\Http\Controllers;

use App\Http\Requests\CameraPriceRequest;
use App\Models\CameraPrice;
use Illuminate\Http\Request;

class CameraPriceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return CameraPrice::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CameraPriceRequest $request)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin') || $user->can('add_camera_price')) {
            CameraPrice::create($request->all());
            return response()->json(['message' => 'تم إضافة السعر بنجاح.'], 201);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, CameraPrice $cameraPrice, string $id)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin') || $user->can('add_camera_price')) {
            $cameraPrice = $cameraPrice->find($id);
            $cameraPrice->update($request->all());
            return response()->json(['message' => 'تم تعديل السعر بنجاح.'], 201);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(CameraPrice $cameraPrice, string $id)
    {
        $user = auth()->user();
        if ($user->hasRole('super_admin') || $user->can('add_camera_price')) {
            $cameraPrice->destroy($id);
            return response()->json(['message' => 'تم حذف السعر بنجاح.'], 201);
        }
    }
}
