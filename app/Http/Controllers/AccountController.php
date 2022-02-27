<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\Drivers;
use App\Models\Managers;
use App\Models\Staffes;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id == 5) {
            $account = User::Where('users.id', Auth::user()->id)->join('doctors', 'doctors.user_id', '=', 'users.id')
                ->first();
            $managers = Managers::join('users', 'user_id', '=', 'users.id')->get();
            return view('account.edit-profile', compact('account', 'managers'));


        } else if (Auth::user()->role_id == 1) {
            $account = User::Where('users.id', Auth::user()->id)
                ->first();
        } else if (Auth::user()->role_id == 2) {
            $account = User::Where('users.id', Auth::user()->id)->join('managers', 'managers.user_id', '=', 'users.id')->first();

        }
        return view('account.edit-profile', compact('account'));
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function password()
    {
        if (Auth::user()->role_id == 3) {
            $account = User::Join('roles', 'roles.id', '=', 'users.role_id')
                ->Where('users.id', Auth::user()->id)
                ->first();

            return view('staff.account.reset_password', compact('account'));
        }
        $account = User::Join('roles', 'roles.id', '=', 'users.role_id')
            ->Where('users.id', Auth::user()->id)
            ->first();

        return view('account.reset_password', compact('account'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $user = User::Where('id', $request->id)->first();
        if (!is_null($request->image)) {
            $imageName = time() . '.' . $request->image->extension();


            $request->image->move(public_path('assets/images/avtar/'), $imageName);
            User::Where('id', $request->id)
                ->Update([
                    'first_name' => $request->first_name,
                    'is_active' => $request->is_active,
                    'last_name' => $request->last_name,
                    'card_number' => $request->card_number,
                    'map_x' => $request->map_x,
                    'map_y' => $request->map_y,
                    'description' => $request->description,
                    'phone' => $request->phone,
                    'telegram_user_id' => $request->telegram,
                    'image' => $imageName,
                ]);
            if ($user->role_id == 5) {
                Doctors::Where('user_id', $request->id)
                    ->Update([
                        'last_manager_id' => $request->last_manager_id,
                        'location' => $request->location,
                        'workplace' => $request->workplace,

                    ]);
            } elseif ($user->role_id == 4) {
                Drivers::Where('user_id', $request->id)
                    ->Update([
                        'car_number' => $request->car_number,
                    ]);
            } elseif ($user->role_id == 2) {
                Managers::Where('user_id', $request->id)
                    ->Update([
                        'percentage_value' => $request->percentage_value,
                    ]);
            }
            return redirect()->back()->withSuccess('Dəyişiklik Edildi ');


        } else {
            User::Where('id', $request->id)
                ->Update([
                    'first_name' => $request->first_name,
                    'is_active' => $request->is_active,
                    'last_name' => $request->last_name,
                    'description' => $request->description,
                    'map_x' => $request->map_x,
                    'map_y' => $request->map_y,
                    'phone' => $request->phone,
                    'telegram_user_id' => $request->telegram,

                ]);
            if ($user->role_id == 5) {
                Doctors::Where('user_id', $request->id)
                    ->Update([
                        'last_manager_id' => $request->last_manager_id,
                        'location' => $request->location,
                        'workplace' => $request->workplace,

                    ]);
            } elseif ($user->role_id == 4) {
                Drivers::Where('user_id', $request->id)
                    ->Update([
                        'car_number' => $request->car_number,
                    ]);
            } elseif ($user->role_id == 2) {
                Managers::Where('user_id', $request->id)
                    ->Update([
                        'percentage_value' => $request->percentage_value,
                    ]);
            }
            return redirect()->back()->withSuccess('Dəyişiklik Edildi ');

        }

    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function location(Request $request)
    {
        $data = request()->json()->all();

        User::where('id', $data['id'])->update(['map_x' => $data['map_x'], 'map_y' => $data['map_y']]);

        return response()->json(['success' => 'success'], 200);


    }


    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function rpassword(Request $request)
    {
        $request->validate([
            'password' => 'required|confirmed|min:6',
        ]);

        User::Where('id', $request->id)->Update(['password' => Hash::make($request->password)]);


        return redirect()->route('index')
            ->with('success', 'Password Reset successfully.');

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function cretate_doctor(Request $request)
    {


        $request->validate([
            'first_name' => 'required',
            'email' => 'required',
            'password' => 'required',
        ]);

        if(User::where('email','=',$request->email)->count()>0){
             return back()->withErrors('Email Istifadə Edilib !');


        }

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'card_number' => $request->card_number,
                'phone' => $request->phone,
                'birth_date' => $request->birth_date,
                'password' => Hash::make($request->password),
                'role_id' => 5,
                'is_active' => 0
            ]);


            Doctors::create([
                'user_id' => $user->id,
                'location' => $request->location,
                'workplace' => $request->workplace,
                'last_manager_id' => $request->last_manager_id
            ]);

            return redirect()->route('doctors')->withSuccess('Istifadəçi yaradıldı');



    }

    public function cretate_manager(Request $request)
    {
        if(User::where('email','=',$request->email)->count()>0){
            return back()->withErrors('Email Istifadə Edilib !');


        }
        try {

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'card_number' => $request->card_number,
                'birth_date' => $request->birth_date,
                'password' => Hash::make($request->password),
                'role_id' => 2,
                'is_active' => 0
            ]);


            Managers::create([
                'user_id' => $user->id,
                'percentage_value' => $request->percentage_value
            ]);
            return redirect()->route('managers')->withSuccess('Istifadəçi yaradıldı');

        } catch (Exception $e) {
            return redirect()->back()->withErrors('Xəta :' . $e->getMessage());


        }
    }

    public function cretate_staff(Request $request)
    {
        if(User::where('email','=',$request->email)->count()>0){
            return back()->withErrors('Email Istifadə Edilib !');


        }
        try {

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'card_number' => $request->card_number,
                'birth_date' => $request->birth_date,
                'password' => Hash::make($request->password),
                'role_id' => 3,
                'is_active' => 0
            ]);
            Staffes::create([
                'user_id' => $user->id,

            ]);
            return redirect()->back()->withSuccess('Istifadəçi yaradıldı');

        } catch (Exception $e) {
            return redirect()->back()->withErrors('Xəta :' . $e->getMessage());

        }
    }

    public function cretate_driver(Request $request)
    {
        if(User::where('email','=',$request->email)->count()>0){
            return back()->withErrors('Email Istifadə Edilib !');


        }
        try {

            $user = User::create([
                'first_name' => $request->first_name,
                'last_name' => $request->last_name,
                'email' => $request->email,
                'phone' => $request->phone,
                'card_number' => $request->card_number,
                'birth_date' => $request->birth_date,
                'password' => Hash::make($request->password),
                'role_id' => 4,
                'is_active' => 0
            ]);
            Drivers::create([
                'user_id' => $user->id,
                'car_number' => $request->car_number
            ]);
            return redirect()->back()->withSuccess('Istifadəçi yaradıldı');

        } catch (Exception $e) {
            return redirect()->back()->withErrors('Xəta :' . $e->getMessage());

        }
    }
}
