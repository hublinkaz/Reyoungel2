<?php

namespace App\Http\Controllers;

use App\Models\Pages;
use App\Models\Settings;
use Illuminate\Http\Request;

class PagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $pages=Pages::all();
        return view('admin.settings.page.index',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
       return view('admin.settings.page.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Pages::create([
            'title' => $request->trixFields,
            'body' => request('attachment-post-trixFields')
        ]);

        return back()->with('success', 'Yeni Dəyər Əlavə Edildi');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function show(Settings $settings)
    {
        //
    }


    public function edit($id)
    {
        $page=Pages::where('id',$id)->first();
        return view('admin.settings.page.edit',compact('page'));

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        Pages::where('id',$id)->update([
            'title_az'=>$request->title_az,
            'title_en'=>$request->title_en,
            'title_ru'=>$request->title_ru,
            'title_tr'=>$request->title_tr,

            'body_az'=>$request->body_az,
            'body_en'=>$request->body_en,
            'body_ru'=>$request->body_ru,
            'body_tr'=>$request->body_tr,
        ]);
        return back()->with('success', 'Yeni Dəyər Əlavə Edildi');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Settings  $settings
     * @return \Illuminate\Http\Response
     */
    public function destroy(Settings $settings)
    {
        //
    }
}
