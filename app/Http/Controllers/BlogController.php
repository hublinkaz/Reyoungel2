<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id==3) {
            $blogs=Blog::all();

            return view('staff.blog.index',compact('blogs'));
        }

            $blogs=Blog::all();

        return view('admin.blog.index',compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->role_id==3) {
            return view('staff.blog.create');

        }
            return view('admin.blog.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_az' => 'required',
            'name_en' => 'required',
            'name_ru' => 'required',
            'name_tr' => 'required',
            'detail_az' => 'required',
            'detail_en' => 'required',
            'detail_ru' => 'required',
            'detail_tr' => 'required',
            'image' => 'required|file|image|mimes:jpeg,jpg,png'
        ]);

        $imageName = time().'.'.$request->image->extension();


        $request->image->move(public_path('assets/images/blog/'), $imageName);



        Blog::create([
            'name_az' =>  $request->name_az,
            'name_en' =>  $request->name_en,
            'name_ru' =>  $request->name_ru,
            'name_tr' =>  $request->name_tr,
            'desc_az' =>  $request->detail_az,
            'desc_en' =>  $request->detail_en,
            'desc_ru' =>  $request->detail_ru,
            'desc_tr' =>  $request->detail_tr,
            'image' => $imageName,
        ]);

        return redirect()->back()->with('success','Blog created successfully.');


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function show(Blog $blog)
    {
        //
    }


    public function edit($id)
    {
        if (Auth::user()->role_id==3) {
            $product=Blog::where('id',$id)->first();
            return view('staff.blog.edit',compact('product'));
        }
            $product=Blog::where('id',$id)->first();
        return view('admin.blog.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {

        if (is_null($request->image)) {

            $request->validate([
                'name_az' => 'required',
                'name_en' => 'required',
                'name_ru' => 'required',
                'name_tr' => 'required',

                'detail_az' => 'required',
                'detail_en' => 'required',
                'detail_ru' => 'required',
                'detail_tr' => 'required',


            ]);


            $product=Blog::where('id',$id)->update([
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'name_tr' => $request->name_tr,
                'desc_az' => $request->detail_az,
                'desc_en' => $request->detail_en,
                'desc_ru' => $request->detail_ru,
                'desc_tr' => $request->detail_tr,

            ]);
            return redirect()->route('blogs')
                ->with('success', 'Product updated successfully');
        } else {
            $request->validate([
                'name_az' => 'required',
                'name_en' => 'required',
                'name_ru' => 'required',
                'name_tr' => 'required',
                'detail_az' => 'required',
                'detail_en' => 'required',
                'detail_ru' => 'required',
                'detail_tr' => 'required',

                'image' => 'required|file|image|mimes:jpeg,jpg,png'
            ]);
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('assets/images/blog/'), $imageName);

            $product=Blog::where('id',$id)->update([
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'name_tr' => $request->name_tr,
                'desc_az' => $request->detail_az,
                'desc_en' => $request->detail_en,
                'desc_ru' => $request->detail_ru,
                'desc_tr' => $request->detail_tr,
                'image' => $imageName
            ]);
            return redirect()->route('products')
                ->with('success', 'Product updated successfully');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blog  $blog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Blog::where('id', $id)->delete();
        return back()->with('success', 'Uğurla Silindi');

    }
}
