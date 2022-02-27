<?php

namespace App\Http\Controllers;
use App\Models\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use PHPUnit\Framework\Constraint\Count;
use Telegram\Bot\Laravel\Facades\Telegram;

class MessagesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $updates = Telegram::getUpdates();
//        echo var_dump($updates);


        $check=strpos($updates->message->text,'/');
            if ($check===false){

                Telegram::sendMessage([
                    'chat_id' => $updates->message->from->id,
                    'text' => 'Səhv ! Xaiş Edirik Düzgün Göndərin . Nümunə : info@hublink.az/parol123'
                ]);

            }else{

                $a=explode("/",$updates->message->text);
                echo "<br>";
                $password =Hash::make($a[1]);
                try {
                    $user = User::where('email',$a[0])->orwhere('password',$password)
                        ->update(['telegram_user_id'=>$updates->message->from->id])
                        ->count();
                    Telegram::sendMessage([
                        'chat_id' => $updates->message->from->id,
                        'text' => 'Telegram iD Qeyd Edildi '
                    ]);
                }catch (\Exception $e){

                        Telegram::sendMessage([
                            'chat_id' => $updates->message->from->id,
                            'text' => 'Xəta ! : Bu Telegram hesabı Var . Hublink.az'
                        ]);

                }


            }




    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        Telegram::sendMessage([
            'chat_id' => '815286201',
            'text' => 'aaaaaaa'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
