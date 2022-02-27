<?php

namespace App\Http\Controllers;

use App\Models\DoctorPayments;
use App\Models\Product;
use App\Models\User;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;


class InvoicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index()
    {
        // share data to view
        $data =DoctorPayments::Select('doctors_payments.id as doctors_payments_id',
            'order_detail_id',
            'percentage_value',
            'order_details.id as order_detail_id',
            'order_id',
            'product_id',
            'is_gift',
            'units',
            'amount',
            'order_details.created_at as order_details_created_at',
            'is_return',
            'products.name_az as product_name_az',
            'products.name_en as product_name_en',
            'products.name_ru as product_name_ru',
            'products.name_tr as product_name_tr',
            'first_name',
            'last_name',
            'phone','qty',
            DoctorPayments::raw('sum(paid) as paid'),DoctorPayments::raw('count(product_id) as qty'))
            ->join('order_details','doctors_payments.order_detail_id','=','order_details.id')
            ->join('products','order_details.product_id','=','products.id')
            ->join('orders','order_details.order_id','=','orders.id')
            ->leftJoin('users','orders.doctor_id','=','users.id')
            ->where('manager_id',3)
            ->whereBetween('doctors_payments.created_at',['2021-10-02','2021-10-22'])
            ->groupby('order_details.id')
            ->groupby('product_id')
            ->get();

//        return view('invoice.invoice',compact('data'));
//        return view('invoice.invoice',compact('data'));
            return response(json_decode($data));


//        $data = [
//            'serila'=>'111111',
//
//        ];
//
//        $staff=[
//            'name'=>'Samir Ibrahimov',
//            'address'=>'Ashiq Molla Juma',
//            'phone'=>$aaa
//
//        ];
//
//        $manager=[
//          'name'=>'Elshad dalbayov',
//          'phone'=>'123',
//          'address'=>'Ashiq Molla Juma',
//
//        ];
//
//        $company=[
//            'name' => 'Reyoungel',
//            'email' => 'info@reyoungel.az',
//            'phone' => '+994 55 555 55 55',
//        ];
//        view()->share('items',$items);
//        view()->share('company',$company);
//        view()->share('manager',$manager);
//        view()->share('staff',$staff);
//        view()->share('data',$data);
//        $pdf = PDF::loadView('invoice.invoice', $data);
//        return $pdf->stream();
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
