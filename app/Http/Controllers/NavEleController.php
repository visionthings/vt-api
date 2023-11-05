<?php

namespace App\Http\Controllers;

use App\Models\NavEle;
use Illuminate\Http\Request;

class NavEleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return NavEle::with(['pages'=>['contents']])->get() ;
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

            'title_ar'=>'required',
            'title_en'=>'required',

        ]);

        return NavEle::create($form_fields);
    }

    /**
     * Display the specified resource.
     */
    public function show(NavEle $navEle, string $id)
    {
        return NavEle::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(NavEle $navEle)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, NavEle $navEle, string $id)
    {
        $nav_ele = NavEle::find($id);
        $form_fields = $request->validate([
            'title_ar'=>'required',
            'title_en'=>'required',
        ]);

        $nav_ele::where('id', $id)->update($form_fields);
        return $nav_ele ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(NavEle $navEle , string $id)
    {
        return NavEle::destroy($id);
    }
}
