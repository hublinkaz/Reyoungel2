<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\Managers;
use App\Models\OrderDetails;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function doctor(){
//        $managers= Doctors::join('users','users.id','=','doctors.user_id')->where('is_active',1)->get();
        $managers= Doctors::join('users as doctor','doctor.id','=','doctors.user_id')->where('doctor.is_active',1)->join('users as manager','manager.id','=','doctors.last_manager_id')->select('doctor.first_name as first_name','doctor.last_name as last_name','doctor.id as id','manager.first_name as manager_first_name','manager.last_name as manager_last_name')->get();

        return view('admin.report.doctor',compact('managers'));
    }


    public function doctors(){
//        $managers= Doctors::join('users','users.id','=','doctors.user_id')->where('is_active',1)->get();
        $doctors= Doctors::join('users as doctor','doctor.id','=','doctors.user_id')
            ->where('doctor.is_active',1)
            ->join('users as manager','manager.id','=','doctors.last_manager_id')
            ->select('doctor.first_name as first_name',
                'doctor.last_name as last_name'
                ,'doctor.id as id'
                ,'manager.first_name as manager_first_name',
                'manager.last_name as manager_last_name',
                'doctor.phone as phone',
                'doctor.email as email',
                'doctors.location as location',
                'doctors.workplace as workplace',
                'doctor.card_number as card_number',
                'doctor.birth_date as birth_date'

            )
            ->get();

        return view('admin.report.doctors_info',compact('doctors'));
    }

    public function product(){
        $managers= Managers::join('users','users.id','=','managers.user_id')->where('is_active',1)->get();

        return view('admin.report.product',compact('managers'));
    }


    public function manager(){

        return view('admin.report.manager');
    }
    public function warehouse(){
        $products=DB::Select('select name_az,products.price,(products.qty + IFNULL(doctors.qty,0) + IFNULL(manager.qty,0)) as qty,(products.qty + IFNULL(doctors.qty,0) + IFNULL(manager.qty,0)) * products.price as total_price,products.qty as admin_qty,products.qty*products.price as admin_price,IFNULL(doctors.qty,0) as doctor_qty,IFNULL(doctors.qty,0) * products.price as doctor_price,IFNULL(manager.qty,0) as manager_qty,IFNULL(manager.qty,0)*products.price as manager_price from products left join (select product_id,COUNT(product_id) as qty from order_details
 left join (select order_detail_id, SUM(paid) as total from doctors_payments GROUP BY order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
 join orders on orders.id = order_details.order_id where is_gift=0 and doctors_payments.total != order_details.amount or doctors_payments.total is NULL and orders.is_delivered=3
  group by product_id) as doctors on doctors.product_id = products.id
  left join (select Sum(qty) as qty,product_id from warehouse  group by product_id) as manager on manager.product_id = products.id');
        $total =DB::Select("select SUM(qty) as qty,ROUND(SUM(total_price),2) as total_price,SUM(admin_qty) as admin_qty,ROUND(SUM(admin_price),2) as admin_price,SUM(doctor_qty) as doctor_qty,ROUND(SUM(doctor_price),2) as doctor_price, SUM(manager_qty) as manager_qty, ROUND(SUM(manager_price),2) as manager_price from (select name_az,products.price,(products.qty + IFNULL(doctors.qty,0) + IFNULL(manager.qty,0)) as qty,(products.qty + IFNULL(doctors.qty,0) + IFNULL(manager.qty,0)) * products.price as total_price,products.qty as admin_qty,products.qty*products.price as admin_price,IFNULL(doctors.qty,0) as doctor_qty,IFNULL(doctors.qty,0) * products.price as doctor_price,IFNULL(manager.qty,0) as manager_qty,IFNULL(manager.qty,0)*products.price as manager_price from products left join (select product_id,COUNT(product_id) as qty from order_details
left join (select order_detail_id, SUM(paid) as total from doctors_payments GROUP BY order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
 join orders on orders.id = order_details.order_id where is_gift=0 and doctors_payments.total != order_details.amount or doctors_payments.total is NULL and orders.is_delivered=3
 group by product_id) as doctors on doctors.product_id = products.id
left join (select Sum(qty) as qty,product_id from warehouse  group by product_id) as manager on manager.product_id = products.id) as warehouse");

        return view('admin.report.warehouse',compact('products','total'));
    }

    public function deposit(){
        $managers= Managers::join('users','users.id','=','managers.user_id')->where('is_active',1)->get();

        return view('admin.report.deposit',compact('managers'));
    }

    public function manager_post(Request $request)
    {
        $start =$request->date_start;
        $end=$request->date_end;
        $managers=Managers::join('users','users.id','=','managers.user_id')->where('is_active',1)->select('first_name','last_name','id')->get();

        $paids=DB::select("select first_name,last_name,percentage_value,manager_id,order_details.created_at, COUNT(order_details.product_id) as qty,SUM(order_details.amount) as amount, SUM(dp.paid) as paid ,discount from order_details
    join doctors_payments dp on order_details.id = dp.order_detail_id
    left join (select COUNT(product_id) as discount,product_id from order_details join doctors_payments dp on order_details.id = dp.order_detail_id
    join products on order_details.product_id = products.id where order_details.amount < products.price and amount >0 group by product_id) as dis on dis.product_id =order_details.product_id
    join orders o on o.id = order_details.order_id
    join users on users.id=manager_id
    where order_details.amount=dp.paid and order_details.amount>0 and is_gift=0 and order_details.created_at between '$start' AND '$end' group by manager_id");
        $nopaids=DB::select("select manager_id,order_id,COUNT(product_id) as qty,product_id,is_gift,SUM(order_details.amount) as amount,SUM(doctors_payments.paid) as paid ,order_details.created_at as created_at,doctors_payments.percentage_value as percentage_value from order_details
      left join (Select order_detail_id,SUM(paid) as paid,percentage_value,created_at from doctors_payments group by order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
      join orders o on order_details.order_id = o.id
    where is_gift=0 and order_details.created_at between '$start' AND '$end' and paid < amount or paid is null  and is_gift=0 and order_details.created_at between '$start' AND '$end' group by manager_id");


        foreach ($managers as $manager){
            foreach ($paids as $paid){
                if ($manager->id==$paid->manager_id){
                    $manager->qty=$paid->qty;
                    $manager->amount=$paid->amount;
                    $manager->paid=$paid->paid;
                    $manager->percentage_value=$paid->percentage_value;
                    $manager->company_price=$manager->paid-($manager->paid*$paid->percentage_value/100);
                    $manager->manager_price=($manager->paid*$paid->percentage_value/100);
                    $manager->total_qty =$manager->qty;
                    $manager->total_amount=$manager->amount;
                }
            }

            foreach ($nopaids as $nopaid){
                if ($manager->id==$paid->manager_id) {
                    $manager->total_qty += $nopaid->qty;
                    $manager->total_amount = $nopaid->amount+$manager->amount;
                    $manager->total_paid = $nopaid->paid+$manager->paid;
                }
            }
        }

        return view('admin.report.manager_show',compact('managers'));

    }


    public function doctor_post(Request $request){



        $manager_id=$request->manager_id;
        $start =$request->date_start;
        $end=$request->date_end;

            $payments=DB::select("SELECT doctor.first_name as first_name
         ,doctor.last_name as last_name
         ,doctor.phone as phone
         ,doctors.workplace as workplace
         ,doctors.location as location
         ,products.name_az as product_name,products.units as units
         ,order_details.amount as price
         ,order_details.created_at as created
            ,payments.created_at as paid_created,
            payments.paid as paid
             from order_details
            join orders o on order_details.order_id = o.id
            join users doctor on doctor.id = o.doctor_id
            join doctors on doctors.user_id = o.doctor_id
            join products on order_details.product_id = products.id
            left join (Select SUM(paid) as paid,order_detail_id,created_at from doctors_payments GROUP BY order_detail_id)
                as payments on payments.order_detail_id = order_details.id
        where doctor_id = $manager_id and order_details.created_at between '$start' AND '$end'");

            $total=DB::Select("SELECT COUNT(*) as count,SUM(order_details.amount) as price,
      SUM(payments.paid) as paid
from order_details
         join orders o on order_details.order_id = o.id
         join users doctor on doctor.id = o.doctor_id
         join doctors on doctors.user_id = o.doctor_id
         join products on order_details.product_id = products.id
         left join (Select SUM(paid) as paid,order_detail_id,created_at from doctors_payments GROUP BY order_detail_id)
    as payments on payments.order_detail_id = order_details.id
where doctor_id = $manager_id and order_details.created_at between '$start' AND '$end'");

            $count=1;
            $totalcount=$total[0]->count;
            $paid=$total[0]->paid;
            $amount=$total[0]->price;
        return view('admin.report.doctor_show',compact('payments','count','amount','paid','totalcount'));
    }



    public function product_post(Request $request)
    {


        $manager_id = $request->manager_id;
        $start = $request->date_start;
        $end = $request->date_end;


        $products=Product::where('status',1)->get();

//        $paids=DB::select("select manager_id,order_id,COUNT(product_id) as qty,product_id,is_gift,amount,doctors_payments.paid as paid ,order_details.created_at as created_at,doctors_payments.percentage_value as percentage_value from order_details
//            left join (Select order_detail_id,SUM(paid) as paid,percentage_value,created_at from doctors_payments group by order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
//            join orders o on order_details.order_id = o.id
//            where paid = amount and manager_id = $manager_id and order_details.created_at between '$start' AND '$end' group by product_id");

        $nopaids=DB::select("select manager_id,order_id,COUNT(product_id) as qty,product_id,is_gift,amount,doctors_payments.paid as paid ,order_details.created_at as created_at,doctors_payments.percentage_value as percentage_value from order_details
        left join (Select order_detail_id,SUM(paid) as paid,percentage_value,created_at from doctors_payments group by order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
        join orders o on order_details.order_id = o.id
        where manager_id = $manager_id and is_gift=0 and order_details.created_at between '$start' AND '$end'  and paid < amount or paid is null and manager_id = $manager_id and is_gift=0 and order_details.created_at between '$start' AND '$end'  group by product_id");


        $paids=DB::select("select percentage_value,manager_id,order_details.created_at as created_at, order_details.product_id,COUNT(order_details.product_id) as qty,SUM(order_details.amount) as amount, SUM(dp.paid) as paid ,discount from order_details
   join doctors_payments dp on order_details.id = dp.order_detail_id
   left join (select COUNT(product_id) as discount,product_id from order_details join doctors_payments dp on order_details.id = dp.order_detail_id
       join products on order_details.product_id = products.id where order_details.amount < products.price and amount >0 group by product_id) as dis on dis.product_id =order_details.product_id
join orders o on o.id = order_details.order_id
where order_details.amount=dp.paid and order_details.amount>0 and manager_id = $manager_id and order_details.created_at between '$start' AND '$end'  group by product_id");


        $total_nopaid=DB::Select("select SUM(oddpo.qty)as qty , sum(oddpo.amount) as amount,ifnull(SUM(paid),0) as paid,percentage_value  from (select manager_id,order_id,COUNT(product_id) as qty,product_id,is_gift,amount,doctors_payments.paid as paid ,order_details.created_at as created_at,doctors_payments.percentage_value as percentage_value from order_details
        left join (Select order_detail_id,SUM(paid) as paid,percentage_value,created_at from doctors_payments group by order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
        join orders o on order_details.order_id = o.id
        where paid < amount or paid is null and manager_id = $manager_id and is_gift=0 and order_details.created_at between '$start' AND '$end'  group by product_id) as oddpo");
        $total_paid=DB::Select("select SUM(oddpo.qty)as qty , sum(oddpo.amount) as amount,ifnull(SUM(paid),0) as paid ,percentage_value from (select percentage_value,manager_id,order_details.created_at as created_at, order_details.product_id,COUNT(order_details.product_id) as qty,SUM(order_details.amount) as amount, SUM(dp.paid) as paid ,discount from order_details
   join doctors_payments dp on order_details.id = dp.order_detail_id
   left join (select COUNT(product_id) as discount,product_id from order_details join doctors_payments dp on order_details.id = dp.order_detail_id
       join products on order_details.product_id = products.id where order_details.amount < products.price and amount >0 group by product_id) as dis on dis.product_id =order_details.product_id
join orders o on o.id = order_details.order_id
where order_details.amount=dp.paid and order_details.amount>0 and manager_id = $manager_id and order_details.created_at between '$start' AND '$end'  group by product_id) as oddpo");

//        $nopaids=DB::select("select manager_id,order_id,COUNT(product_id) as qty,product_id,is_gift,amount,doctors_payments.paid as paid ,order_details.created_at as created_at,doctors_payments.percentage_value as percentage_value from order_details
//        left join (Select order_detail_id,SUM(paid) as paid,percentage_value,created_at from doctors_payments group by order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
//        join orders o on order_details.order_id = o.id
//        where paid < amount or paid is null  and is_gift=0  group by product_id");
//
//
//        $paids=DB::select("select percentage_value,manager_id,order_details.created_at, order_details.product_id,COUNT(order_details.product_id) as qty,SUM(order_details.amount) as amount, SUM(dp.paid) as paid ,discount from order_details
//   join doctors_payments dp on order_details.id = dp.order_detail_id
//   left join (select COUNT(product_id) as discount,product_id from order_details join doctors_payments dp on order_details.id = dp.order_detail_id
//       join products on order_details.product_id = products.id where order_details.amount < products.price and amount >0 group by product_id) as dis on dis.product_id =order_details.product_id
//join orders o on o.id = order_details.order_id
//where order_details.amount=dp.paid and order_details.amount>0  group by product_id");

        foreach ($products as $product) {
            $product->order_qty=0;
            $product->total_order_qty=0;
            foreach ($paids as $paid) {
                if ($product->id == $paid->product_id){
                    $product->order_qty=$paid->qty;
                    $product->order_price=$paid->paid;
                    $product->company_price=$paid->paid-($paid->paid*$paid->percentage_value/100);
                    $product->manager_price=($paid->paid*$paid->percentage_value/100);
                    $product->created=$paid->created_at;
                    $product->total_order_qty=$paid->qty;
                }

            }
            foreach ($nopaids as $nopaid){
                if ($product->id == $nopaid->product_id){
                    $product->total_order_qty=$product->order_qty +$nopaid->qty;
                    $product->total_amount=$product->order_qty*$product->price;
                    $product->created=$nopaid->created_at;
                }
            }

        }
        return view('admin.report.product_show',compact('products','total_paid','total_nopaid'));

    }



    public function deposit_post(Request $request){

        $manager_id = $request->manager_id;
        $end = $request->date_end;

        $products=DB::select("select id, name, price, cost,  units, detail, image, discount, deposit.created_at as created_at,  name_az, name_en, name_ru, name_tr, detail_en, detail_az, detail_ru, detail_tr, status, manager_id, order_id, product_id, IFNULL(deposit.qty,0) as qty, is_gift, IFNULL(amount,0) as total_price, paid from products left join (select manager_id,order_id,product_id,COUNT(product_id) as qty,is_gift,SUM(order_details.amount) as amount ,SUM(doctors_payments.paid)as paid ,order_details.created_at as created_at,doctors_payments.percentage_value as percentage_value from order_details
   left join (Select order_detail_id,SUM(paid) as paid,percentage_value,created_at from doctors_payments group by order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
    join orders o on order_details.order_id = o.id
     where is_gift=0 and manager_id = 3 and order_details.created_at between '2020-01-01' AND '$end' and  paid < amount or paid is null  and is_gift=0 and manager_id = 3 and order_details.created_at between '2020-01-01' AND '$end'  group by product_id) as deposit on deposit.product_id = products.id");


        return view('admin.report.deposit_show',compact('products'));


    }

}
