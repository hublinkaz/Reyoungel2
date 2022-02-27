<?php

namespace App\Http\Controllers;

use App\Models\Slides;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SlidesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if(Auth::user()->role_id==3){
            $slides = Slides::all();

            return view('staff.slides.index',compact('slides'));
        }
            $slides = Slides::all();

            return view('admin.slides.index',compact('slides'));




    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->role_id==3){
            return view('staff.slides.create');
        }

            return view('admin.slides.create');



    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'text_az' => 'required',
            'text_en' => 'required',
            'text_ru' => 'required',
            'text_tr' => 'required',
            'button_text_az' => 'required',
            'button_text_en' => 'required',
            'button_text_ru' => 'required',
            'button_text_tr' => 'required',
            'button_link' => 'required',
            'image' => 'required|file|image|mimes:jpeg,jpg,png'
        ]);

        $imageName = time().'.'.$request->image->extension();


        $request->image->move(public_path('assets/images/slider/'), $imageName);



        Slides::create([
            'image' => $imageName,
            'text_az' =>  $request->text_az,
            'text_en' =>  $request->text_en,
            'text_ru' =>  $request->text_ru,
            'text_tr' =>  $request->text_tr,
            'button_text_az' =>  $request->button_text_az,
            'button_text_en' =>  $request->button_text_en,
            'button_text_ru' =>  $request->button_text_ru,
            'button_text_tr' =>  $request->button_text_tr,
            'button_link' =>  $request->button_link,

        ]);

        return redirect()->route('slides')
            ->with('success','Slide created successfully.');
    }




    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return redirect()->route('slides.index')
            ->with('success','Product created successfully.');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if(Auth::user()->role_id==3){
           $slide= Slides::where('id',$id)->first();
            return view('staff.slides.edit',compact('slide'));

        }
        $slide= Slides::where('id',$id)->first();

        return view('admin.slides.edit',compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Slides $slide)
    {
        $request->validate([
            'text_az' => 'required',
            'text_en' => 'required',
            'text_ru' => 'required',
            'text_tr' => 'required',
            'button_text_az' => 'required',
            'button_text_en' => 'required',
            'button_text_ru' => 'required',
            'button_text_tr' => 'required',
            'button_link' => 'required',
            'image' => 'required|file|image|mimes:jpeg,jpg,png'
        ]);

        $imageName = time().'.'.$request->image->extension();


        $request->image->move(public_path('assets/images/slider/'), $imageName);



        $slide->update([
            'image' => $imageName,
            'text_az' =>  $request->text_az,
            'text_en' =>  $request->text_en,
            'text_ru' =>  $request->text_ru,
            'text_tr' =>  $request->text_tr,
            'button_text_az' =>  $request->button_text_az,
            'button_text_en' =>  $request->button_text_en,
            'button_text_ru' =>  $request->button_text_ru,
            'button_text_tr' =>  $request->button_text_tr,
            'button_link' =>  $request->button_link,
        ]);


        return redirect()->route('slides.index')
            ->with('success','Product updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Slides $slide)
    {
        $slide->delete();
//        Product::destroy($request->id);
        return redirect()->route('slides')
            ->with('success','slide deleted successfully');
    }
}
