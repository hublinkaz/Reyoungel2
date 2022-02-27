<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\DoctorPayments;
use App\Models\ManagerPayment;
use App\Models\ManagerPayments;
use App\Models\OrderDetails;
use Illuminate\Http\Request;
use App\Exports\ManagerPaymentHistory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response|string
     */
    public function index()
    {

//            $payments=DB::Select("SELECT SUM(doctors_payments.paid) as doctor_paid,order_details.id as od_id, amount,manager_payments.paid as manager_paid,
//                      manager.first_name as manager_first_name,
//                      manager.last_name as manager_last_name,
//                      doctor.first_name as doctor_first_name,
//                      doctor.last_name as doctor_last_name,
//                      manager.id as manager_id,
//                      doctor.id as doctor_id,
//                      orders.id as order_id,
//                       doctors_payments.created_at as doctors_payments_created_at
//                from order_details
//                    join doctors_payments on order_details.id = doctors_payments.order_detail_id
//                    left join manager_payments on order_details.id = manager_payments.order_detail_id
//                    join orders on orders.id = order_details.order_id
//                    join users as manager on manager.id = manager_id
//                    join users as doctor on doctor.id = doctor_id
//                WHERE is_gift=0
//                group by (od_id)
//                ");
        $doctors=DB::select("select doctors_payments.created_at as date,users.first_name as first_name,users.last_name as last_name ,
       SUM(doctors_payments.paid) as doctor_paid,orders.manager_id as manager_id,
       managers.percentage_value as percent_value,order_id
from doctors_payments
         join order_details on doctors_payments.order_detail_id = order_details.id
         join orders on orders.id = order_details.order_id
         join users on orders.manager_id = users.id
         join managers on managers.user_id = orders.manager_id where doctors_payments.paid !=0 GROUP BY order_id");

        $managers=DB::select("select manager_payments.created_at as
                                 date,users.first_name as first_name
     ,users.last_name as last_name
     ,SUM(manager_payments.paid) as manager_paid
     ,orders.manager_id as manager_id,
    managers.percentage_value as percent,order_id
from manager_payments
         join order_details on manager_payments.order_detail_id = order_details.id
         join orders on orders.id = order_details.order_id
         join users on orders.manager_id = users.id
         join managers on managers.user_id = orders.manager_id GROUP BY order_id
");

        $amounts =DB::select("Select order_id , SUM(amount) as amount from order_details GROUP BY order_id");

        foreach($doctors as $doctor){
            $doctor->manager_paid=0;

            foreach($managers as $manager){
                foreach($amounts as $amount){
                    if($doctor->order_id == $manager->order_id){

                        $doctor->manager_paid = $manager->manager_paid;


                    }
                    if ($amount->order_id == $doctor->order_id){
                        $doctor->amount = $amount->amount;

                    }


                }
            }

        }


            return view('admin.payment.indexadmin',compact('doctors'));


    }



public function is_okay(Request $request){


}








    public function log(){

        $doctors=DB::select("select doctors_payments.created_at as date,users.first_name as manager_first_name,users.last_name as manager_last_name ,
       doctors_payments.paid as doctor_paid,orders.manager_id as manager_id,
       managers.percentage_value as percent,order_id,order_detail_id,doctor.first_name as doctor_first_name,doctor.last_name as doctor_last_name
from doctors_payments
         join order_details on doctors_payments.order_detail_id = order_details.id
         join orders on orders.id = order_details.order_id
         join users on orders.manager_id = users.id
         join users as doctor on orders.doctor_id = doctor.id
         join managers on managers.user_id = orders.manager_id");

        $managers=DB::select("select manager_payments.created_at as
                                 date,users.first_name as first_name
     ,users.last_name as last_name
     ,SUM(manager_payments.paid) as manager_paid
     ,orders.manager_id as manager_id,
    managers.percentage_value as percent,order_id
from manager_payments
         join order_details on manager_payments.order_detail_id = order_details.id
         join orders on orders.id = order_details.order_id
         join users on orders.manager_id = users.id
         join managers on managers.user_id = orders.manager_id GROUP BY order_id
");

        $amounts =DB::select("Select order_id , SUM(amount) as amount from order_details GROUP BY order_id");

        foreach($doctors as $doctor){
            $doctor->manager_paid=0;

            foreach($managers as $manager){
                foreach($amounts as $amount){
                    if($doctor->order_id == $manager->order_id){

                        $doctor->manager_paid = $manager->manager_paid;


                    }
                    if ($amount->order_id == $doctor->order_id){
                        $doctor->amount = $amount->amount;

                    }


                }
            }

        }


    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
            $payments=OrderDetails::leftJoin('doctors_payments', 'order_details.id', '=', 'doctors_payments.order_detail_id')
                ->leftJoin('manager_payments', 'order_details.id', '=', 'manager_payments.order_detail_id')
                ->Join('orders', 'orders.id', '=', 'order_details.order_id')
                ->Join('products', 'products.id', '=', 'order_details.product_id')
                ->Join('users as manager', 'manager.id', '=', 'manager_id')
                ->Join('users as doctor', 'doctor.id', '=', 'doctor_id')
                ->Select('order_details.id as od_id',
                    'amount',
                    DoctorPayments::raw('sum(doctors_payments.paid) as doctor_paid'),
//                    'doctors_payments.paid as doctor_paid',
                    'products.name_az as product_name_az',
                    'products.name_en as product_name_en',
                    'products.name_ru as product_name_ru',
                    'products.name_tr as product_name_tr',
                    'manager_payments.paid as manager_paid',
                    'manager.first_name as manager_first_name',
                    'manager.last_name as manager_last_name',
                    'manager.id as manager_id',
                    'doctor.id as doctor_id',
                    'doctor.first_name as doctor_first_name',
                    'doctor.last_name as doctor_last_name')
                ->groupby('order_details.id')
                 ->get();

        return view('admin.payment.create',compact('payments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request,$id)
    {
       $value=OrderDetails::join('orders','orders.id','=','order_details.order_id')
            ->join('managers','managers.user_id','=','orders.manager_id')
           ->select('managers.percentage_value as value')
            ->where('order_details.id',$id)->first()->value;

        DoctorPayments::create([
                'order_detail_id' =>  $id,
                'paid' =>  $request->paid,
                'percentage_value'=>$value
            ]);


        return redirect()->back()->with('success','Ödəniş Tamamlandı.');
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


    public function edit($id)
    {
        //
    }













    public function update(Request $request, $id)
    {

        $querys=DB::select("select order_id,doctors_payments.id as doctor_payment_id,doctors_payments.paid as doctor_paid,manager_payments.paid as manager_paid, doctors_payments.order_detail_id as order_detail_id from doctors_payments
    join order_details od on doctors_payments.order_detail_id = od.id
    left join manager_payments on doctors_payments.order_detail_id = manager_payments.order_detail_id where manager_payments.paid is NULL and order_id=$id or doctors_payments.paid != manager_payments.paid and order_id=$id");

        foreach($querys as $query){

            $check_order=ManagerPayments::where('order_detail_id',$query->order_detail_id)->count();
            if ($check_order===0) {
                ManagerPayments::create([
                    'order_detail_id'=>$query->order_detail_id,
                    'doctor_payment_id'=>$query->doctor_payment_id,
                    'paid'=>$query->doctor_paid
                ]);

            }
            else if ($check_order===1){
                $order_paid=ManagerPayments::where('order_detail_id',$query->order_detail_id)->first()->paid;


                ManagerPayments::where('order_detail_id', $query->order_detail_id)->update(['paid' => $query->doctor_paid+$order_paid]);

            }

        }
        return redirect()->back()->withSuccess('Dəyişiklik Edildi 1');




//        return response('success :'.$response['is_delivered'],200);
    }





    public function destroy($id)
    {
        //
    }

    public function export()
    {
        return Excel::download(new ManagerPaymentHistory, 'users.xlsx');
    }
}
