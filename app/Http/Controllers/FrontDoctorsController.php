<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\DoctorsImages;
use App\Models\FrontDoctors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontDoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id==3){
            $doctors=FrontDoctors::all();
            return view('staff.settings.doctors.index',compact('doctors'));
        }
        $doctors=FrontDoctors::all();
        return view('admin.settings.doctors.index',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::user()->role_id==3) {
            return view('staff.settings.doctors.create');

        }
            return view('admin.settings.doctors.create');
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
            'imageFile' => 'required',
            'imageFile.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
        ]);


        if($request->hasfile('imageFile')) {
            foreach($request->file('imageFile') as $file)
            {
//                $name = $file->getClientOriginalName();
                $name = time().'.'.$file->extension();

                $file->move(public_path('assets/images/doctors/'), $name);
                $imgData[] = $name;
            }

            $doctors=FrontDoctors::create([
                'name' => $request->name,
                'phone' => $request->phone,
                'text' => $request->text,
                'location' => $request->location,
                'workplace' => $request->workplace,
                'video_url' => $request->video_url,
                'images' => json_encode($imgData),
            ]);


            return back()->with('success', 'File has successfully uploaded!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\FrontDoctors  $frontDoctors
     * @return \Illuminate\Http\Response
     */
    public function show(FrontDoctors $frontDoctors)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\FrontDoctors  $frontDoctors
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(Auth::user()->role_id==3) {
            $doctor=FrontDoctors::where('id',$id)->first();

            return view('staff.settings.doctors.edit',compact('doctor'));
        }
            $doctor=FrontDoctors::where('id',$id)->first();

        return view('admin.settings.doctors.edit',compact('doctor'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\FrontDoctors  $frontDoctors
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, FrontDoctors $frontDoctors)
    {

        if (!is_null($request->imageFile)) {

            $request->validate([
                'imageFile' => 'required',
                'imageFile.*' => 'mimes:jpeg,jpg,png,gif,csv,txt,pdf|max:2048'
            ]);


            if ($request->hasfile('imageFile')) {
                foreach ($request->file('imageFile') as $file) {
//                    $name = $file->getClientOriginalName();
                    $name = time().'.'.$file->extension();
                    $file->move(public_path('assets/images/doctors/'), $name);
                    $imgData[] = $name;
                }

                $doctors = FrontDoctors::where('id', $request->id)
                    ->update([
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'text' => $request->text,
                        'location' => $request->location,
                        'workplace' => $request->workplace,
                        'video_url' => $request->video_url,
                        'images' => json_encode($imgData),
                    ]);


                return back()->with('success', 'File has successfully uploaded!');
            }
        }else{




                $doctors = FrontDoctors::where('id', $request->id)
                    ->update([
                        'name' => $request->name,
                        'phone' => $request->phone,
                        'text' => $request->text,
                        'location' => $request->location,
                        'workplace' => $request->workplace,
                        'video_url' => $request->video_url,
                    ]);


                return back()->with('success', 'File has successfully uploaded!');


        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        FrontDoctors::where('id', $id)->delete();
        return back()->with('success', 'Uğurla Silindi');


    }

    public function banner_edit($id){
        if(Auth::user()->role_id==3) {
            $banner=Banner::where('id',$id)->first();
            return view('staff.settings.banner',compact('banner'));
        }
            $banner=Banner::where('id',$id)->first();
        return view('admin.settings.banner',compact('banner'));
    }


    public function banner(Request  $request){

        $request->validate([
            'text_az' => 'required',
            'text_en' => 'required',
            'text_ru' => 'required',
            'text_tr' => 'required',
            'url' => 'required',
            'image' => 'required|file|image|mimes:jpeg,jpg,png'
        ]);

        $imageName = time().'.'.$request->image->extension();
        $request->image->move(public_path('assets/images/banner/'), $imageName);



        Banner::where('id',$request->id)->update([
            'text_az' =>  $request->text_az,
            'text_en' =>  $request->text_en,
            'text_ru' =>  $request->text_ru,
            'text_tr' =>  $request->text_tr,
            'url' =>  $request->url,
            'image' => $imageName,
        ]);

        return redirect()->route('banners')
            ->with('success','Uğurlu Əməliyyat.');

    }
}
