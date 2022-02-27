<?php

namespace App\Http\Controllers;
use App\Models\Deliverers;
use App\Models\Doctors;
use App\Models\Drivers;
use App\Models\Managers;
use App\Models\Managerss;
use App\Models\Roles;
use App\Models\Staffes;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use RealRashid\SweetAlert\Facades\Alert;
use Symfony\Component\HttpFoundation\Session\Session;
use Telegram\Bot\Laravel\Facades\Telegram;


class AuthController extends Controller
{
    public function index()
    {

        return view('auth.signin');
    }


    public function createSignin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {
            if (!empty(Auth::user()->telegram_user_id))
            Telegram::sendMessage([
                'chat_id' => Auth::user()->telegram_user_id,
                'text' => '     ⚠️ Diqqət ⚠️
Sizin Hesabla Portala Giriş edildi
Siz Deyilsinizsə bizimlə əlaqə saxlayın'
            ]);

            if (Auth::user()->role_id==1){
                return redirect("admin-panel")
                    ->withSuccess('Xoş Gəldin '. Auth::user()->first_name);
            }else if(Auth::user()->role_id==2){
                return redirect("manager-panel")
                    ->withSuccess('Xoş Gəldin '. Auth::user()->first_name);
            }else{
                return redirect("/")
                    ->withSuccess('Xoş Gəldin '. Auth::user()->first_name);
            }

        }



        return redirect("login")->withErrors('Login Xətalı');

    }


    public function signup()
    {
        return view('auth.signup');
    }


    public function customSignup(Request $request)
    {
        $request->validate([
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
        $data = $request->all();
        $check = $this->createUser($data);
        return redirect("/")->withSuccess('Successfully logged-in!');
    }





    public function manager(Request $request){
        $request->validate([
            'first_name' =>'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user= User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'phone'=>$request->phone,
            'card_number'=>$request->card_number,
            'birth_date'=>$request->birth_date,
            'password' => Hash::make($request->password),
            'role_id'=>5,
            'is_active' => 0
        ]);


        Managers::create([
            'user_id'=> $user->id,
            'percentage_value'=>$request->percentage_value
        ]);

        return redirect("/doctors")->withErrors('Hesab Yaradıldı');


    }


    public function doctor(Request $request){
        $request->validate([
            'first_name' =>'required',
            'email' => 'required',
            'password' => 'required',
        ]);
        $user= User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'email' => $request->email,
            'card_number'=>$request->card_number,

            'phone'=>$request->phone,
            'birth_date'=>$request->birth_date,
            'password' => Hash::make($request->password),
            'role_id'=>5,
            'is_active' => 0
        ]);


            Doctors::create([
                'user_id'=> $user->id,
                'location' => $request->location,
                'workplace' => $request->workplace,
                'last_manager_id' => 2
            ]);



        return redirect("login")->withErrors('Qeydiyyatınız Tamamlandı Təstiq Üçün Gözləyin . ');


    }


    public function createUser(array $data)
    {
        $data['is_active']=false;
        $user= User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone'=>$data['phone'],
            'birth_date'=>$data['birth_date'],
            'card_number'=>$data['card_number'],

            'password' => Hash::make($data['password']),
            'role_id'=>$data['role_id'],
            'is_active' => $data['is_active']
        ]);

        if ($data['role_id']==5){
            Doctors::create([
                'user_id'=> $user->id,
                'location' => $data['location'],
                'workplace' => $data['workplace'],
                'last_manager_id' => $data['last_manager_id']
            ]);
        }
        elseif ($data['role_id']==4){
            Drivers::create([
                'user_id'=> $user->id,
                'car_number'=> $data['car_number'],
            ]);
        }
        elseif ($data['role_id']==3){
            Staffes::create([
                'user_id'=> $user->id,

            ]);
        }
        elseif ($data['role_id']==2){
            Managers::create([
                'user_id'=> $user->id,
                'percentage_value'=>$data['percentage_value']
            ]);
        }
        return $user;
    }


    public function dashboardView()
    {
        if(Auth::check()){
            return view('dashboard.index');
        }
        return redirect("login")->withErrors('Access is not permitted');
    }


    public function logout() {
//        Session::flush();
        Auth::logout();
        return Redirect('login');
    }
}
