<?php

namespace App\Http\Controllers;

use App\Models\Page;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Page::with(['contents'])->get();
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

            'nav_ele_id'=>'required',
            'title_ar'=>'required',
            'title_en'=>'required',
            'slug'=>'required',

        ]);

        return Page::create($form_fields);
    }

    /**
     * Display the specified resource.
     */
    public function show(Page $page, string $id)
    {
        return Page::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Page $page)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Page $page, string $id)
    {
        $page = Page::find($id);
        $form_fields = $request->validate([
            'nav_ele_id'=>'required',
            'title_ar'=>'required',
            'title_en'=>'required',
            'slug'=>'required',
        ]);

        $page::where('id', $id)->update($form_fields);
        return $page ;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Page $page, string $id)
    {
        return Page::destroy($id);
    }
}
