<?php

namespace App\Http\Controllers;

use App\Models\Content;
use Illuminate\Http\Request;

class ContentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Content::all();
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
            'page_id'=>'required',
            'title_ar'=>'required',
            'title_en'=>'required',
            'content_ar'=>'required',
            'content_en'=>'required',
            'content_type'=>'required',
            'file_1'=> 'nullable',
            'file_2'=> 'nullable',
            'file_3'=> 'nullable',
            'file_4'=> 'nullable',
            'file_5'=> 'nullable',
            'file_6'=> 'nullable',
            'file_7'=> 'nullable',
            'file_8'=> 'nullable',
            'file_9'=> 'nullable',
            'file_10'=> 'nullable',
            'file_11'=> 'nullable',
            'file_12'=> 'nullable',
            'file_13'=> 'nullable',
            'file_14'=> 'nullable',
            'file_15'=> 'nullable',
            'file_16'=> 'nullable',
            'file_17'=> 'nullable',
            'file_18'=> 'nullable',
            'file_19'=> 'nullable',
            'file_20'=> 'nullable',
            'file_21'=> 'nullable',
            'file_22'=> 'nullable',
            'file_23'=> 'nullable',
            'file_24'=> 'nullable',
            'file_25'=> 'nullable',
        ]);
      
        for ($i=1; $i <26 ; $i++) { 
            if($request->hasFile('file_'.$i)) {
            $file = $request->file('file_'.$i)->store('images/contents', 'images');
            $form_fields['file_'.$i] = $file;
        }
        }
        return Content::create($form_fields);
    }

    /**
     * Display the specified resource.
     */
    public function show(Content $content, $id)
    {
        return Content::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Content $content)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Content $content, string $id)
    {
        $content = Content::find($id);
        $form_fields = $request->validate([
            'page_id'=>'required',
            'title_ar'=>'required',
            'title_en'=>'required',
            'content_ar'=>'required',
            'content_en'=>'required',
            'content_type'=>'required',
            'file_1'=> 'nullable',
            'file_2'=> 'nullable',
            'file_3'=> 'nullable',
            'file_4'=> 'nullable',
            'file_5'=> 'nullable',
            'file_6'=> 'nullable',
            'file_7'=> 'nullable',
            'file_8'=> 'nullable',
            'file_9'=> 'nullable',
            'file_10'=> 'nullable',
            'file_11'=> 'nullable',
            'file_12'=> 'nullable',
            'file_13'=> 'nullable',
            'file_14'=> 'nullable',
            'file_15'=> 'nullable',
            'file_16'=> 'nullable',
            'file_17'=> 'nullable',
            'file_18'=> 'nullable',
            'file_19'=> 'nullable',
            'file_20'=> 'nullable',
            'file_21'=> 'nullable',
            'file_22'=> 'nullable',
            'file_23'=> 'nullable',
            'file_24'=> 'nullable',
            'file_25'=> 'nullable',
        ]);

        for ($i=1; $i <26 ; $i++) { 
            if($request->hasFile('file_'.$i)) {
            $file = $request->file('file_'.$i)->store('images/contents', 'images');
            $form_fields['file_'.$i] = $file;
        }
        }

        $content::where('id', $id)->update($form_fields);
        
        return $content;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Content $content, string $id)
    {
        return Content::destroy($id);
    }
}
