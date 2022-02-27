<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Blog;
use App\Models\FrontDoctors;
use App\Models\OrderDetails;
use App\Models\Pages;
use App\Models\Product;
use App\Models\Managers;
use App\Models\Role;
use App\Models\Roles;
use App\Models\Slides;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class HomeController extends Controller
{
    public function dashboard(){

        $doctors=DB::select('SELECT sum(paid) as total, amount,product_id from doctors_payments join order_details od on doctors_payments.order_detail_id = od.id
                    where is_gift=0
                    group by order_detail_id
                    ');
        $products=DB::select('Select * from products');
        $managers=DB::select('select Sum(qty) as qty,product_id from warehouse where status =1 group by product_id');


        $e=0;
        foreach(\App\Models\DoctorPayments::select('paid','percentage_value')->where('paid','!=',0)->get() as $paid){

            $e=$e+(($paid->paid) -(($paid->paid * $paid->percentage_value)/100));
        }



        return view('manager.dashboard.index',compact('e'));
    }





    public function admin_dashboard(){

//        $start= date('Y-m-d');
//        $start= '20-11-2021';
        $start= Carbon::today()->format('Y-m-d');
        $end= Carbon::tomorrow()->format('Y-m-d');

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
    where (paid < amount or paid is null)  and is_gift=0 and order_details.created_at between '$start' AND '$end' group by manager_id");


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

                }
            }

            foreach ($nopaids as $nopaid){
                if ($manager->id==$nopaid->manager_id) {
                    $manager->total_qty += $nopaid->qty;
                    $manager->total_amount = $nopaid->amount+$manager->amount;
                    $manager->total_paid = $nopaid->paid+$manager->paid;
                }
            }
        }


        $manager_prices=DB::select("select u.id as id,first_name,last_name,ROUND(SUM(paid),2) as paid,m.percentage_value,(ROUND(SUM(paid),2)*m.percentage_value)/100 as manager from doctors_payments
    join order_details od on doctors_payments.order_detail_id = od.id
    join orders o on od.order_id = o.id
    join managers m on o.manager_id = m.user_id
    join users u on u.id = m.user_id
    where doctors_payments.created_at between '$start' and '$end'
    group by manager_id");


        return view('admin.dashboard.index',compact('managers','manager_prices'));

    }


    public function doctor_dashboard(){



        return view('doctor.dashboard.index');
    }


    public function staff_dashboard(){



        return view('staff.dashboard.index');
    }


    public function manager_dashboard(){

        $id=Auth::user()->id;
        $start= Carbon::today()->format('Y-m-d');
        $end= Carbon::tomorrow()->format('Y-m-d');

        $managers=Managers::join('users','users.id','=','managers.user_id')->where('is_active',1)->where('users.id',$id)->select('first_name','last_name','id')->get();

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
    where (paid < amount or paid is null)  and is_gift=0 and order_details.created_at between '$start' AND '$end' group by manager_id");


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

                }
            }

            foreach ($nopaids as $nopaid){
                if ($manager->id==$nopaid->manager_id) {
                    $manager->total_qty += $nopaid->qty;
                    $manager->total_amount = $nopaid->amount+$manager->amount;
                    $manager->total_paid = $nopaid->paid+$manager->paid;
                }
            }
        }

        $e=0;
        foreach(\App\Models\DoctorPayments::select('paid','percentage_value')->where('paid','!=',0)->get() as $paid){

            $e=$e+(($paid->paid) -(($paid->paid * $paid->percentage_value)/100));
        }


        $manager_prices=DB::select("select u.id as id,first_name,last_name,ROUND(SUM(paid),2) as paid,m.percentage_value,(ROUND(SUM(paid),2)*m.percentage_value)/100 as manager from doctors_payments
    join order_details od on doctors_payments.order_detail_id = od.id
    join orders o on od.order_id = o.id
    join managers m on o.manager_id = m.user_id
    join users u on u.id = m.user_id
    where doctors_payments.created_at between '$start' and '$end' and manager_id=$id
    group by manager_id");

        return view('manager.dashboard.index',compact('e','managers','manager_prices'));
    }



    public function doctors(){

        $doctors=FrontDoctors::all();
        return view('frontend.doctors',compact('doctors'));
    }



    public function doctor($id){

        $doctor=FrontDoctors::Where('id',$id)->first();

        return view('frontend.doctor',compact('doctor'));
    }


    public function map(){


        return view('map');
    }

    public function about(){

        $slides=Slides::all();

        $pages=Pages::where('id',1)->first();

        return view('frontend.about',compact('slides','pages'));
    }


    public function index(){

        if(!Auth::guest()){
            $role= Auth::user()->role_id;

            $user=Roles::where('id',Auth::user()->role_id)->first()->name;
            $banners=Banner::all();
            $slides=Slides::all();
            $products = Product::where('status',1)->get();
            return view('frontend.home',compact('products','role','slides','banners','user'));
        }
        else{
            $role=5;
            $user='doctor';
            $banners=Banner::all();
            $slides=Slides::all();
            $products = Product::where('status',1)->get();
            return view('frontend.home',compact('products','role','slides','banners','user'));
        }


//        foreach (products as $product) {
//            echo $product->name;
//        }



    }

    public function cart(){
        if (!Auth::check()){
            return redirect()->route('login');
        }
        else{
            if (Auth::user()->role_id==1){
                return redirect()->to('admin-panel');
            }elseif (Auth::user()->role_id==2){
                return redirect()->route('manager.manager.checkout');
            }elseif (Auth::user()->role_id==3){
                return redirect()->route('staff.checkout');
            }elseif (Auth::user()->role_id==5){
                return view('frontend.cart');
            }

        }

        return view('frontend.cart');
    }
    public function detail($id){

        $product = Product::where('id',$id)->first();
        if(!Auth::guest()){
            $role= Auth::user()->role_id;
        }
        else{
            $role=8;
        }

        return view("frontend.product",compact('product','role'));
    }
    public function manager(){


        return view('dashboard.index');
    }

    public function warehouse(){
        $total=DB::select("select name_az,SUM(products.qty+ IFNULL(doctors.qty,0) + IFNULL(manager.qty,0)) as qty,SUM(price*(products.qty+ doctors.qty + manager.qty)) as price from products left join (select product_id,COUNT(product_id) as qty from order_details
left join (select order_detail_id, SUM(paid) as total from doctors_payments GROUP BY order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
join orders on orders.id = order_details.order_id where is_gift=0 and (doctors_payments.total != order_details.amount or doctors_payments.total is NULL) and orders.is_delivered=3
                                  group by product_id) as doctors on doctors.product_id = products.id
left join (select Sum(qty) as qty,product_id from warehouse  group by product_id) as manager on manager.product_id = products.id");

        $news=DB::select("select name_az,(products.qty + IFNULL(doctors.qty,0) + IFNULL(manager.qty,0)) as qty from products left join (select product_id,COUNT(product_id) as qty from order_details
                         left join (select order_detail_id, SUM(paid) as total from doctors_payments GROUP BY order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
                          join orders on orders.id = order_details.order_id where is_gift=0 and (doctors_payments.total != order_details.amount or doctors_payments.total is NULL) and orders.is_delivered=3
                           group by product_id) as doctors on doctors.product_id = products.id
                           left join (select Sum(qty) as qty,product_id from warehouse  group by product_id) as manager on manager.product_id = products.id");


        $products=DB::select('Select * from products');

        if (Auth::user()->role_id==3){
            return view('staff.warehouse.index',compact('products'));

        }else{

            return view('admin.warehouse.index',compact('products','news','total'));
        }

    }

    public function manager_warehouse(){


        $total=DB::select("SELECT SUM(warehouse.total_qty) as total_qty,SUM(warehouse.price) as total_price from (select (warehouse_qty+doctor_qty) as total_qty,(warehouse_qty+doctor_qty)*price as price from (select name_az,IFNULL(manager.qty,0) as warehouse_qty ,IFNULL(doctors.qty,0) as doctor_qty,price from products left join (select product_id,COUNT(product_id) as qty from order_details
   left join (select order_detail_id, SUM(paid) as total from doctors_payments GROUP BY order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
   join orders on orders.id = order_details.order_id where is_gift=0 and (doctors_payments.total != order_details.amount or doctors_payments.total is NULL) and orders.is_delivered=3
group by product_id) as doctors on doctors.product_id = products.id
left join (select Sum(qty) as qty,product_id from warehouse  group by product_id) as manager on manager.product_id = products.id) as warehouse) as warehouse");


        $news=DB::select("select product_id,name_az,name_en,name_ru,name_tr,doctor_qty,warehouse_qty,(warehouse_qty+doctor_qty) as total_qty,(warehouse_qty+doctor_qty)*price as price from (select name_az,name_en,name_ru,name_tr,IFNULL(manager.qty,0) as warehouse_qty ,IFNULL(doctors.qty,0) as doctor_qty,price,products.id as product_id from products left join (select product_id,COUNT(product_id) as qty from order_details
 left join (select order_detail_id, SUM(paid) as total from doctors_payments GROUP BY order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
 join orders on orders.id = order_details.order_id where is_gift=0 and (doctors_payments.total != order_details.amount or doctors_payments.total is NULL) and orders.is_delivered=3
 group by product_id) as doctors on doctors.product_id = products.id
left join (select Sum(qty) as qty,product_id from warehouse  group by product_id) as manager on manager.product_id = products.id) as warehouse
");

//        $products=DB::select("select name_az,IFNULL(managers.qty,0) as qty
//from products left join (select order_details.product_id,COUNT(order_details.product_id) +warehouse.qty as qty from order_details
// left join (SELECT order_detail_id,SUM(paid) as paid, percentage_value from doctors_payments group by order_detail_id) as doctors_payments on order_detail_id = order_details.id
// left join (select product_id,SUM(qty) as qty from warehouse group by  product_id) as warehouse on order_details.product_id = warehouse.product_id
//                         where amount!=paid or paid is NULL group by product_id) as managers on managers.product_id = products.id");
        if (Auth::user()->role_id==3){
            return view('staff.warehouse.manager',compact('news','total'));

        }

        return view('admin.warehouse.manager',compact('news','total'));
    }

    public function doctor_warehouse(){
        $total=DB::select("select name_az,SUM(doctors.qty ) as qty,SUM(price*(doctors.qty )) as price from products left join (select product_id,COUNT(product_id) as qty from order_details
   left join (select order_detail_id, SUM(paid) as total from doctors_payments GROUP BY order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
   join orders on orders.id = order_details.order_id where is_gift=0 and (doctors_payments.total != order_details.amount or doctors_payments.total is NULL) and orders.is_delivered=3
    group by product_id) as doctors on doctors.product_id = products.id
    left join (select Sum(qty) as qty,product_id from warehouse  group by product_id) as manager on manager.product_id = products.id");


        $news=DB::select("select name_az,(doctors.qty ) as qty,price from products left join (select product_id,COUNT(product_id) as qty from order_details
left join (select order_detail_id, SUM(paid) as total from doctors_payments GROUP BY order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
join orders on orders.id = order_details.order_id where is_gift=0 and (doctors_payments.total != order_details.amount or doctors_payments.total is NULL) and orders.is_delivered=3
                                  group by product_id) as doctors on doctors.product_id = products.id
left join (select Sum(qty) as qty,product_id from warehouse  group by product_id) as manager on manager.product_id = products.id");



        if (Auth::user()->role_id==3){
//            return view('staff.warehouse.manager',compact('products'));
            return view('staff.warehouse.manager',compact('news','total'));


        }
        return view('admin.warehouse.manager',compact('news','total'));

    }


    public function blogs(){
        $blogs = Blog::orderBy('id', 'DESC')->paginate(12);
        return view('frontend.blogs',compact('blogs'));

    }
    public function blog($id){
        $blog = Blog::where('id',$id)->first();
        return view('frontend.blog',compact('blog'));

    }

}
