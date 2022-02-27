<?php

namespace App\Http\Controllers;

use App\Models\Staffes;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class StaffesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        //        $doctors=User::Join('doctors', 'users.id', '=', 'doctors.id')->get();
        $staffes = Staffes::Join('users', 'users.id', '=', 'staffes.user_id')->get();

        return view('admin.staff.index', compact('staffes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.staff.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Staffes $stafes
     * @return \Illuminate\Http\Response
     */
    public function show(Staffes $stafes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Staffes $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        $account = User::
        Where('users.id', $id)->first();

        return view('admin.account.edit-profile', compact('account',));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Staffes $stafes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Staffes $stafes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Staffes $stafes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Staffes $stafes)
    {
        //
    }











}
