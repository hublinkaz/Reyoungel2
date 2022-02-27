<?php

namespace App\Http\Controllers;

use App\Models\DoctorPayments;
use App\Models\Doctors;
use App\Models\ManagerPaid;
use App\Models\Managers;
use App\Http\Controllers\Controller;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\WarehouseQuery;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManagersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->role_id==1) {

            //        $doctors=User::Join('doctors', 'users.id', '=', 'doctors.id')->get();
            $managers = Managers::Join('users', 'users.id', '=', 'managers.user_id')->get();

            return view('admin.manager.index', compact('managers'));
        }else if(Auth::user()->role_id==3) {
            $managers = Managers::Join('users', 'users.id', '=', 'managers.user_id')->get();

            return view('staff.manager.index', compact('managers'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()

    {
        if(Auth::user()->role_id==3){
            return view('staff.manager.create');

        }
        return view('admin.manager.create');
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function add()

    {
        $products = Product::all();
        return view('manager.warehouse.create',compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function checkout(){
        if(Auth::user()->role_id==1 or Auth::user()->role_id==3 ) {
            $managers = Managers::Join('users', 'users.id', '=', 'managers.user_id')->get();
            return view('manager.warehouse.checkout',compact('managers'));

        }
        else if (Auth::user()->role_id==2) {

            $manager = Managers::where('user_id', Auth::user()->id)
            ->Join('users', 'users.id', '=', 'managers.user_id')->first();



            return view('manager.warehouse.checkout',compact('manager'));

        }

    }





    public function manager_checkout(){
        $manager = Managers::where('user_id', Auth::user()->id)
            ->Join('users', 'users.id', '=', 'managers.user_id')->first();



        return view('manager.manager.warehouse.checkout',compact('manager'));

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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response|string
     */
    public function show($id)
    {
        if(Auth::user()->role_id==1) {
            $start= Carbon::today()->format('Y-m-d');
            $end= Carbon::tomorrow()->format('Y-m-d');
            $orders = DB::select("SELECT first_name,last_name,order_details.id as id,product_id,name_az, is_gift, amount, doctor_id, manager_id, is_delivered, order_details.created_at,coalesce(paid,0) as paid from order_details
    join orders o on order_details.order_id = o.id
    left join doctors_payments  on doctors_payments.order_detail_id = order_details.id
    join products p on p.id = order_details.product_id
    join users on o.doctor_id = users.id where manager_id =$id and order_details.created_at between '$start' AND '$end'");

            $manager = Managers::where('user_id', $id)->Join('users', 'users.id', '=', 'managers.user_id')
                ->Select('first_name', 'last_name', 'phone', 'email', 'birth_date', 'user_id','description')
                ->first();
            return view('admin.manager.profile',compact('manager','orders'));

        }
        else if(Auth::user()->role_id==3) {
            $payments = OrderDetails::Join('doctors_payments', 'order_details.id', '=', 'doctors_payments.order_detail_id')
                ->Join('manager_payments', 'order_details.id', '=', 'manager_payments.order_detail_id')
                ->Join('orders', 'orders.id', '=', 'order_details.order_id')
                ->Join('users as manager', 'manager.id', '=', 'manager_id')
                ->Join('users as doctor', 'doctor.id', '=', 'doctor_id')
                ->Select('order_details.id as od_id',
                    'amount',
                    'doctors_payments.paid as doctor_paid',
                    'doctors_payments.created_at as doctor_paid_created',
                    'manager_payments.paid as manager_paid',
                    'manager.first_name as manager_first_name',
                    'manager.last_name as manager_last_name',
                    'manager.id as manager_id',
                    'doctor.id as doctor_id',
                    'doctor.first_name as doctor_first_name',
                    'doctor.last_name as doctor_last_name')
                ->where('manager_id', $id)->get();

            $manager = Managers::where('user_id', $id)->Join('users', 'users.id', '=', 'managers.user_id')
                ->Select('first_name', 'last_name', 'phone', 'email', 'birth_date', 'user_id')
                ->first();
            return view('staff.manager.profile',compact('manager','payments'));
        }
        else if(Auth::user()->role_id==2) {



            $payments = OrderDetails::Join('doctors_payments', 'order_details.id', '=', 'doctors_payments.order_detail_id')
                ->Join('manager_payments', 'order_details.id', '=', 'manager_payments.order_detail_id')
                ->Join('orders', 'orders.id', '=', 'order_details.order_id')
                ->Join('users as manager', 'manager.id', '=', 'manager_id')
                ->Join('users as doctor', 'doctor.id', '=', 'doctor_id')
                ->Select('order_details.id as od_id',
                    'amount',
                    'doctors_payments.paid as doctor_paid',
                    'doctors_payments.created_at as doctor_paid_created',
                    'manager_payments.paid as manager_paid',
                    'manager.first_name as manager_first_name',
                    'manager.last_name as manager_last_name',
                    'manager.id as manager_id',
                    'doctor.id as doctor_id',
                    'doctor.first_name as doctor_first_name',
                    'doctor.last_name as doctor_last_name')
                ->where('manager_id', Auth::user()->id)->get();

            $manager = Managers::where('user_id', $id)->Join('users', 'users.id', '=', 'managers.user_id')
                ->Select('first_name', 'last_name', 'phone', 'email', 'birth_date', 'user_id')
                ->first();
            return view('manager.profile',compact('manager','payments'));

        }

            return 'permision is denied';

    }



    public function profile(){

        $id=Auth::user()->id;

        $start= Carbon::today()->format('Y-m-d');
        $end= Carbon::tomorrow()->format('Y-m-d');
        $orders = DB::select("SELECT first_name,last_name,order_details.id as id,product_id,name_az, is_gift, amount, doctor_id, manager_id, is_delivered, order_details.created_at,coalesce(paid,0) as paid from order_details
    join orders o on order_details.order_id = o.id
    left join doctors_payments  on doctors_payments.order_detail_id = order_details.id
    join products p on p.id = order_details.product_id
    join users on o.doctor_id = users.id where manager_id =$id and order_details.created_at between '$start' AND '$end'");

        $manager = Managers::where('user_id', $id)->Join('users', 'users.id', '=', 'managers.user_id')
            ->Select('first_name', 'last_name', 'phone', 'email', 'birth_date', 'user_id','description')
            ->first();
        return view('manager.manager.profile',compact('manager','orders'));
//        $payments = OrderDetails::Join('doctors_payments', 'order_details.id', '=', 'doctors_payments.order_detail_id')
//            ->Join('manager_payments', 'order_details.id', '=', 'manager_payments.order_detail_id')
//            ->Join('orders', 'orders.id', '=', 'order_details.order_id')
//            ->Join('users as manager', 'manager.id', '=', 'manager_id')
//            ->Join('users as doctor', 'doctor.id', '=', 'doctor_id')
//            ->Select('order_details.id as od_id',
//                'amount',
//                'doctors_payments.paid as doctor_paid',
//                'doctors_payments.created_at as doctor_paid_created',
//                'manager_payments.paid as manager_paid',
//                'manager.first_name as manager_first_name',
//                'manager.last_name as manager_last_name',
//                'manager.id as manager_id',
//                'doctor.id as doctor_id',
//                'doctor.first_name as doctor_first_name',
//                'doctor.last_name as doctor_last_name')
//            ->where('manager_id', Auth::user()->id)->get();
//
//        $manager = Managers::where('user_id',  Auth::user()->id)->Join('users', 'users.id', '=', 'managers.user_id')
//            ->Select('first_name', 'last_name', 'phone', 'email', 'birth_date', 'user_id')
//            ->first();
//        return view('manager.manager.profile',compact('manager','payments'));
    }
    public function deposit()
    {
        $id=Auth::user()->id;
        $products=DB::select('Select * from products');
   $managers=DB::select("SELECT COUNT(product_id) as qty,product_id,order_details.amount  as amount ,order_details.id as order_detail_id,orders.id as order_id,odip.paid as paid from order_details
                       join orders on order_details.order_id = orders.id
                      left join (select order_detail_id,SUM(paid) as paid  from doctors_payments  GROUP BY order_detail_id) as odip  on odip.order_detail_id = order_details.id where
        order_details.is_gift = 0 and manager_id=$id and order_details.is_gift = 0 and is_return = 0 and is_return = 0  and odip.paid != amount or odip.paid is NULL and is_delivered=3 and manager_id=$id and order_details.is_gift = 0 and is_return = 0 GROUP BY product_id");


        $amounts=DB::select("SELECT COUNT(product_id) as qty,product_id,SUM(order_details.amount)  as amount ,order_details.id as order_detail_id,orders.id as order_id,odip.paid as paid from order_details
             join orders on order_details.order_id = orders.id
            left join (select order_detail_id,SUM(paid) as paid  from doctors_payments  GROUP BY order_detail_id) as odip  on odip.order_detail_id = order_details.id where
        order_details.is_gift = 0 and orders.is_delivered=3 and manager_id=$id and is_return = 0  and odip.paid != amount or odip.paid is NULL and orders.is_delivered=3 and manager_id=$id and order_details.is_gift = 0 and is_return = 0 GROUP BY product_id");

        $total=0;
        $total_qty=0;
        foreach($amounts as $amount){
            if ($amount->paid==NULL){
                $amount->paid=0;
            }
            $total +=$amount->amount -$amount->paid;
        }

        foreach($products as $product){
            $product->qty=0;

            foreach($managers as $manager){
                if($manager->product_id == $product->id){
                    $product->qty=$product->qty+$manager->qty;
                }

            }
            $total_qty +=$product->qty;

        }

        return view('manager.manager.deposit',compact('products','total','total_qty'));
    }


    public function all_deposits(){
        $id=Auth::user()->id;
        $products=DB::select('Select * from products');
        $managers=DB::select("SELECT COUNT(product_id) as qty,product_id,order_details.amount  as amount ,order_details.id as order_detail_id,orders.id as order_id,odip.paid as paid from order_details
                       join orders on order_details.order_id = orders.id
                      left join (select order_detail_id,SUM(paid) as paid  from doctors_payments  GROUP BY order_detail_id) as odip  on odip.order_detail_id = order_details.id where
        order_details.is_gift = 0 and is_return = 0  and odip.paid != amount or odip.paid is NULL and is_delivered=3 and manager_id=$id GROUP BY product_id");

        $amounts=DB::select("SELECT COUNT(product_id) as qty,product_id,SUM(order_details.amount)  as amount ,order_details.id as order_detail_id,orders.id as order_id,odip.paid as paid from order_details
             join orders on order_details.order_id = orders.id
            left join (select order_detail_id,SUM(paid) as paid  from doctors_payments  GROUP BY order_detail_id) as odip  on odip.order_detail_id = order_details.id where
        order_details.is_gift = 0 and is_return = 0  and (odip.paid != amount or odip.paid is NULL) and is_delivered=3 and manager_id=$id GROUP BY product_id");

        $warehouses=Warehouse::where('manager_id',$id)->get();




        $aaaaaa=Product::all();
        $bbbbbbbb=Warehouse::where('manager_id',$id)->get();

        $wwww=0;
        foreach($aaaaaa as $product){
            $product->qty=0;

            foreach($bbbbbbbb as $manager){
                if($manager->product_id == $product->id){
                    $product->qty=$manager->qty;
                    $product->created_at=$manager->created_at;
                    $wwww+=$product->qty*$product->price;
                }

            }

        }
        $total_qty=0;
        $total=0;
        foreach($amounts as $amount){
            if ($amount->paid==NULL){
                $amount->paid=0;
            }
            $total +=$amount->amount -$amount->paid;
        }
        $total +=$wwww;
        foreach($products as $product){
            $product->qty=0;

            foreach($managers as $manager){
                if($manager->product_id == $product->id){
                    $product->qty=$product->qty+$manager->qty;
                }

            }

            foreach($warehouses as $warehouse){
                if( $warehouse->product_id == $product->id) {

                    $product->qty = $product->qty + $warehouse->qty;

                }
            }
           $total_qty +=$product->qty;
        }

        return view('manager.manager.deposit',compact('products','total','total_qty'));
    }



    public function all_warehouse($id)
    {
        $products=DB::select('Select * from products');
        $managers=DB::select("SELECT COUNT(product_id) as qty,product_id,order_details.amount  as amount ,order_details.id as order_detail_id,orders.id as order_id,odip.paid as paid from order_details
                       join orders on order_details.order_id = orders.id
                      left join (select order_detail_id,SUM(paid) as paid  from doctors_payments  GROUP BY order_detail_id) as odip  on odip.order_detail_id = order_details.id where
        order_details.is_gift = 0 and is_return = 0 and manager_id=$id  and odip.paid != amount or odip.paid is NULL GROUP BY product_id");

        $amounts=DB::select("SELECT COUNT(product_id) as qty,product_id,SUM(order_details.amount)  as amount ,order_details.id as order_detail_id,orders.id as order_id,odip.paid as paid from order_details
             join orders on order_details.order_id = orders.id
            left join (select order_detail_id,SUM(paid) as paid  from doctors_payments  GROUP BY order_detail_id) as odip  on odip.order_detail_id = order_details.id where
        order_details.is_gift = 0 and is_return = 0 and (odip.paid != amount or odip.paid is NULL) GROUP BY product_id and manager_id=$id");


        $warehouses=Warehouse::where('manager_id',$id)->get();








        $total=0;
        foreach($amounts as $amount){
            if ($amount->paid==NULL){
                $amount->paid=0;
            }
            $total +=$amount->amount -$amount->paid;
        }

        foreach($products as $product){
            $product->qty=0;
            $product->warehouse_qty=0;

            foreach($managers as $manager){

                if($manager->product_id == $product->id){
                    $product->qty=$product->qty+$manager->qty;
                }

            }

            foreach($warehouses as $warehouse) {
                if($warehouse->product_id == $product->id){
                    $product->warehouse_qty=$warehouse->qty;
                    $total +=$warehouse->qty * $product->price;
                }
            }

            }

        return view('manager.manager.all_warehouse',compact('products','total'));
    }


    public function admin_manager_deposit($id){
        $products=DB::select('Select * from products');
        $managers=DB::select("SELECT COUNT(product_id) as qty,product_id,order_details.amount  as amount ,order_details.id as order_detail_id,orders.id as order_id,odip.paid as paid from order_details
                       join orders on order_details.order_id = orders.id
                      left join (select order_detail_id,SUM(paid) as paid  from doctors_payments  GROUP BY order_detail_id) as odip  on odip.order_detail_id = order_details.id where
        order_details.is_gift = 0 and is_return = 0 and manager_id=$id  and odip.paid != amount or odip.paid is NULL and is_delivered=3  GROUP BY product_id");

        $amounts=DB::select("SELECT COUNT(product_id) as qty,product_id,SUM(order_details.amount)  as amount ,order_details.id as order_detail_id,orders.id as order_id,odip.paid as paid from order_details
             join orders on order_details.order_id = orders.id
            left join (select order_detail_id,SUM(paid) as paid  from doctors_payments  GROUP BY order_detail_id) as odip  on odip.order_detail_id = order_details.id where
        order_details.is_gift = 0 and is_return = 0 and manager_id=$id  and (odip.paid != amount or odip.paid is NULL) and is_delivered=3  GROUP BY product_id");

        $total=0;
        foreach($amounts as $amount){
            if ($amount->paid==NULL){
                $amount->paid=0;
            }
            $total +=$amount->amount -$amount->paid;
        }

        foreach($products as $product){
            $product->qty=0;

            foreach($managers as $manager){
                if($manager->product_id == $product->id){
                    $product->qty=$product->qty+$manager->qty;
                }

            }

        }

        return view('admin.manager.deposit',compact('products','total','id'));
    }


    public function admin_manager_deposit_detail($product_id,$manager_id)
    {
        $products=DB::select("SELECT first_name, last_name,product_id,order_details.amount  as amount ,order_details.id as order_detail_id,orders.id as order_id,odip.paid as paid from order_details
    join orders on order_details.order_id = orders.id
    join users on users.id=orders.doctor_id
     left join (select order_detail_id,SUM(paid) as paid  from doctors_payments  GROUP BY order_detail_id) as odip  on odip.order_detail_id = order_details.id where
            order_details.is_gift = 0 and is_return = 0 and manager_id=$manager_id  and (odip.paid != amount or odip.paid) is NULL and product_id=$product_id");
        $i=1;
        return view('admin.manager.deposit_detail',compact('products','i'));

    }
    public function manager_manager_deposit_detail($id)
    {
        $userid=Auth::user()->id;
        $products=DB::select("SELECT first_name, last_name,product_id,order_details.amount  as amount ,order_details.id as order_detail_id,orders.id as order_id,odip.paid as paid from order_details
    join orders on order_details.order_id = orders.id
    join users on users.id=orders.doctor_id
     left join (select order_detail_id,SUM(paid) as paid  from doctors_payments  GROUP BY order_detail_id) as odip  on odip.order_detail_id = order_details.id where
            order_details.is_gift = 0 and is_return = 0  and (odip.paid != amount or odip.paid is NULL) and product_id=$id and manager_id=$userid");
        $i=1;
        return view('manager.manager.deposit_detail',compact('products','i'));

    }

        public function warehouse()
    {

//        $warehouse= Warehouse::where('manager_id',$id)
//           ->Join('products', 'products.id', '=', 'warehouse.product_id')
//            ->get();
        $id=Auth::user()->id;
//        $warehouse=Warehouse::where('manager_id',$id)
//            ->Join('products', 'products.id','=','warehouse.product_id')
//            ->select('warehouse.qty as warehouse_qty','warehouse.created_at as warehouse_created_at', 'name_az', 'name_en', 'name_ru', 'name_tr','price','image','discount')
//            ->get();


        $products=Product::all();
        $managers=Warehouse::where('manager_id',$id)->get();

        $total=0;
        foreach($products as $product){
            $product->qty=0;

            foreach($managers as $manager){
                if($manager->product_id == $product->id){
                    $product->qty=$manager->qty;
                    $product->created_at=$manager->created_at;
                    $total+=$product->qty*$product->price;
                }

            }

        }
        return view('manager.manager.warehouse',compact('products','total'));
    }


    public function gifts(){
        $gifts = OrderDetails::where('order_details.is_gift',1)
            ->Join('orders', 'order_details.order_id', '=', 'orders.id')
            ->Join('users as manager', 'manager.id', '=', 'orders.manager_id')
            ->Join('users as doctor', 'doctor.id', '=', 'orders.doctor_id')
            ->Join('users as seller', 'seller.id', '=', 'gift_by')
            ->Join('products', 'products.id', '=', 'product_id')
            ->Select('order_details.id as gift_id','product_id','order_id','seller.first_name as seller_first_name','seller.last_name as seller_last_name','manager.first_name as manager_first_name','manager.last_name as manager_last_name','doctor.first_name as doctor_first_name','doctor.last_name as doctor_last_name','order_details.created_at as create_at','name_az','name_en','name_ru','name_tr')
            ->where('manager.id',Auth::user()->id)
            ->get();

        return view('manager.gift.index',compact('gifts'));

    }


    public function gift_create(){
//        $products = Warehouse::where('manager_id',Auth::user()->id)->where('warehouse.qty','!=', 0)
//            ->join('products','products.id','=','product_id')->get();

//        $products = Product::join('warehouse','warehouse.product_id','=','products.id')->where('warehouse.manager_id','=',Auth::user()->id)->where('warehouse.qty','!=',0)->get();
        $id=Auth::user()->id;
        $products=DB::select("select product_id,qty,name_az,name_en,name_ru,name_tr from (select product_id, SUM(warehouse.qty) qty,name_az,name_en,name_ru,name_tr from warehouse
join products p on p.id = warehouse.product_id where manager_id = $id GROUP BY product_id) as product where qty >0");
        $orders=Orders::where('manager_id',Auth::user()->id)->latest()->take(10)->get();

        return view('manager.gift.create',compact('products','orders'));

    }

    public function orders(){
        $orders=Orders::where('manager_id',Auth::user()->id)->leftJoin('status', 'status.id','=','orders.is_delivered')
       ->Join('users', 'users.id','=','orders.doctor_id')
            ->Select('orders.created_at as created_at','orders.id as id','status_az','status_en','status_ru','status_tr','first_name','last_name')
            ->get();

        $payments=DB::select("SELECT sum(paid) as paid,order_id from doctors_payments
                  join order_details on doctors_payments.order_detail_id = order_details.id
                  join orders o on order_details.order_id = o.id  group by  order_id");
        $paids=DB::select("SELECT sum(amount) as paid,order_id from order_details
       join orders o on order_details.order_id = o.id  group by  order_id");
        foreach($orders as $order){
            $order->paid=0;
            $order->total=0;

            foreach($payments as $payment) {
                if ($payment->order_id == $order->id) {

                    $order->paid = $payment->paid;

                }
            }

            foreach($paids as $paid) {
                if ($paid->order_id == $order->id) {

                    $order->total = $paid->paid;

                }
            }

        }

        return view('manager.order.orders',compact('orders'));
    }


    public function create_order(){
        $products = Product::where('status',true)->get();

        return view('manager.order.create', compact('products'));
    }

    public function doctors(){
        $doctors=Doctors::Join('users', 'users.id', '=', 'doctors.user_id')
            ->where('last_manager_id',Auth::user()->id)
            ->get();
        return view('manager.doctor.index',compact('doctors'));

    }


    public function doctor_create(){
        $managers=Managers::Join('users', 'users.id', '=', 'managers.user_id')
            ->where('user_id', '=', Auth::user()->id)
            ->get();
        return view('manager.doctor.create',compact('managers'));

    }


    public function paid($id)
    {
        if(Auth::user()->role_id==1) {
            $paids=ManagerPaid::where('manager_id',$id)->get();
        }
        elseif (Auth::user()->role_id==2){
            $paids=ManagerPaid::where('manager_id',Auth::user()->id)->get();
        }
        else {
            return 'permision is denied';
        }

        return view('admin.manager.paid',compact('paids'));
    }



public function returun_product(Request $request, $id){



}







    public function edit($id)
    {
        if(Auth::user()->role_id==3) {
            $account = User::join('managers','managers.user_id','=','users.id')
                ->Where('user_id',$id)
                ->first();
//        $managers=Managers::join('users','user_id','=','users.id')->get();
            return view('staff.account.edit-profile',compact('account'));
        }
        $account = User::join('managers','managers.user_id','=','users.id')
            ->Where('user_id',$id)
            ->first();
                        $managers = Managers::join('users', 'user_id', '=', 'users.id')->get();

//        $managers=Managers::join('users','user_id','=','users.id')->get();
        return view('admin.account.edit-profile',compact('account','managers'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Managers  $managers
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Managers $managers)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Managers  $managers
     * @return \Illuminate\Http\Response
     */
    public function destroy(Managers $managers)
    {
        //
    }


    public function product_query(){
        if (Auth::user()->role_id==3){
            $products = DB::select("SELECT first_name, last_name,warehouse_query.qty as qty ,name_az,name_en,name_ru,name_tr ,warehouse_query.created_at as created_at ,warehouse_query.id as id from warehouse_query
        join products on products.id = warehouse_query.product_id
        join users on users.id = warehouse_query.manager_id");

            return view('staff.manager.queryproduct',compact('products'));
        }
        $products = DB::select("SELECT first_name, last_name,warehouse_query.qty as qty ,name_az,name_en,name_ru,name_tr ,warehouse_query.created_at as created_at ,warehouse_query.id as id from warehouse_query
        join products on products.id = warehouse_query.product_id
        join users on users.id = warehouse_query.manager_id");

        return view('admin.manager.queryproduct',compact('products'));
    }

    public function update_query($id){
        if (Auth::user()->role_id==3) {
            $product = DB::select("SELECT first_name,last_name,warehouse_query.qty as qty
     ,name_az,name_en,name_ru,name_tr
     ,warehouse_query.created_at as created_at
     ,warehouse_query.id as id
     ,warehouse_query.product_id as product_id
     ,warehouse_query.manager_id as manager_id from warehouse_query
        join products on products.id = warehouse_query.product_id
        join users on users.id = warehouse_query.manager_id where warehouse_query.id=$id");


            $product=WarehouseQuery::join('products','products.id','=','warehouse_query.product_id')
                ->join('users','users.id','=','warehouse_query.manager_id')
                ->where('warehouse_query.id',$id)->select('name_az','name_en','name_ru','name_tr','warehouse_query.created_at as created_at','warehouse_query.id as id',
                    'warehouse_query.product_id as product_id','warehouse_query.manager_id as manager_id','users.first_name as first_name','warehouse_query.qty as qty')->first();


            return view('staff.manager.update_query',compact('product'));
        }
        $product = DB::select("SELECT first_name,last_name,warehouse_query.qty as qty
     ,name_az,name_en,name_ru,name_tr
     ,warehouse_query.created_at as created_at
     ,warehouse_query.id as id
     ,warehouse_query.product_id as product_id
     ,warehouse_query.manager_id as manager_id from warehouse_query
        join products on products.id = warehouse_query.product_id
        join users on users.id = warehouse_query.manager_id where warehouse_query.id=$id");


        $product=WarehouseQuery::join('products','products.id','=','warehouse_query.product_id')
        ->join('users','users.id','=','warehouse_query.manager_id')
            ->where('warehouse_query.id',$id)->select('name_az','name_en','name_ru','name_tr','warehouse_query.created_at as created_at','warehouse_query.id as id',
                'warehouse_query.product_id as product_id','warehouse_query.manager_id as manager_id','users.first_name as first_name','warehouse_query.qty as qty')->first();


        return view('admin.manager.update_query',compact('product'));
    }


    public function post_query(Request $request)
    {
        if ($request->status == 1) {
            $warehouse = WarehouseQuery::where('manager_id', $request->manager_id)->where('product_id',$request->product_id)->first();

            if ($warehouse->qty != $request->qty){
                WarehouseQuery::where('manager_id', $request->manager_id)->where('product_id', $warehouse->product_id)->update([
                    'qty' => WarehouseQuery::where('manager_id', $request->manager_id)->where('product_id', $warehouse->product_id)->first()->qty - $request->qty]);




                if (Warehouse::where('manager_id', $request->manager_id)->where('product_id', $warehouse->product_id)->count() == 0) {
                    Warehouse::create([
                        'manager_id' => $warehouse->manager_id,
                        'product_id' => $warehouse->product_id,
                        'qty' => $request->qty,
                    ]);
                    Product::where('id', $warehouse->product_id)->update([
                        'qty' => Product::where('id', $warehouse->product_id)->first()->qty - $request->qty]);

                } else {

                    Warehouse::where('manager_id', $warehouse->manager_id)->where('product_id', $warehouse->product_id)->update([
                        'qty' => Warehouse::where('manager_id', $warehouse->manager_id)->where('product_id', $warehouse->product_id)->first()->qty + $request->qty]);

                    Product::where('id', $warehouse->product_id)->update([
                        'qty' => Product::where('id', $warehouse->product_id)->first()->qty - $request->qty]);


                }

            }else{
                WarehouseQuery::where('manager_id', $request->manager_id)->where('product_id', $request->product_id)->delete();


                if (Warehouse::where('manager_id', $request->manager_id)->where('product_id', $warehouse->product_id)->count() == 0) {
                    Warehouse::create([
                        'manager_id' => $warehouse->manager_id,
                        'product_id' => $warehouse->product_id,
                        'qty' => $request->qty,
                    ]);
                    Product::where('id', $warehouse->product_id)->update([
                        'qty' => Product::where('id', $warehouse->product_id)->first()->qty - $request->qty]);

                } else {

                    Warehouse::where('manager_id', $warehouse->manager_id)->where('product_id', $warehouse->product_id)->update([
                        'qty' => Warehouse::where('manager_id', $warehouse->manager_id)->where('product_id', $warehouse->product_id)->first()->qty + $request->qty]);

                    Product::where('id', $warehouse->product_id)->update([
                        'qty' => Product::where('id', $warehouse->product_id)->first()->qty - $request->qty]);


                }

            }


            if(Auth::user()->role_id==3){
                return redirect()->route('staff.manager.query')->withSuccess('Sorğu Qəbul Edildi');
            }

            return redirect()->route('manager.query')->withSuccess('Sorğu Qəbul Edildi');
        }
        else if ($request->status == 2) {

            WarehouseQuery::where('manager_id', $request->manager_id)->where('product_id', $request->product_id)->delete();
            if(Auth::user()->role_id==3){
                return redirect()->route('staff.manager.query')->withSuccess('Sorğu Qəbul Edildi');
            }
            return redirect()->route('manager.query')->withSuccess('Sorğu Qəbul Edildi');
        }else{
            if(Auth::user()->role_id==3){
                return redirect()->route('staff.manager.query')->withSuccess('Sorğu Qəbul Edildi');
            }
            return redirect()->route('manager.query')->withSuccess('Sorğu Qəbul Edildi');
        }

    }

    public function doctor_list($id)
    {
        $payments = OrderDetails::Join('doctors_payments', 'order_details.id', '=', 'doctors_payments.order_detail_id')
            ->leftjoin('manager_payments', 'order_details.id', '=', 'manager_payments.order_detail_id')
            ->Join('orders', 'orders.id', '=', 'order_details.order_id')
            ->Join('users as manager', 'manager.id', '=', 'manager_id')
            ->Join('users as doctor', 'doctor.id', '=', 'doctor_id')
            ->Select('order_details.id as od_id',
                'amount',
                'orders.id as orderid',
                'doctors_payments.paid as doctor_paid',
                'doctors_payments.created_at as doctor_paid_created',
                'manager_payments.paid as manager_paid',
                'manager.first_name as manager_first_name',
                'manager.last_name as manager_last_name',
                'manager.id as manager_id',
                'doctor.id as doctor_id',
                'doctor.map_x as doctor_map_x',
                'doctor.map_y as doctor_map_y',
                'doctor.first_name as doctor_first_name',
                'doctor.last_name as doctor_last_name')
            ->where('manager_id', '=', Auth::user()->id)
            ->where('order_details.is_gift', '=', 0)
            ->where('doctor_id', $id)->get();


        $doctor = Doctors::where('user_id', $id)->Join('users', 'users.id', '=', 'doctors.user_id')
            ->Select('first_name', 'last_name', 'phone', 'email', 'location','workplace', 'birth_date', 'user_id')
            ->first();

        $userlink = User::where("id",$id)->first();
        $maplink = 'http://www.google.com/maps/place/' . $userlink->map_x . ',' . $userlink->map_y;
        return view('manager.doctor.profile', compact('doctor', 'payments', 'maplink'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response|string
     */
    public function doctor_deposit($id){


        $products=DB::select('Select * from products');
        $managers=DB::select("select * from order_details
    left join (select order_detail_id, SUM(paid) as paid from doctors_payments GROUP BY order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
    join orders on orders.id = order_details.order_id where is_gift=0 and (doctors_payments.paid != order_details.amount or doctors_payments.paid is NULL) and doctor_id=$id");

        $amount=DB::select("SELECT sum(amount) as amount from order_details
                                      left join doctors_payments on doctors_payments.order_detail_id = order_details.id
                                      join orders on order_details.order_id = orders.id
where order_details.amount != doctors_payments.paid or doctors_payments.paid IS NULL and
        order_details.is_gift = 0 and
        is_return = 0 and doctor_id=$id");

        $paid=DB::select("SELECT sum(paid) as paid from doctors_payments
                          join order_details on doctors_payments.order_detail_id = order_details.id
                          join orders on order_details.order_id = orders.id
        where order_details.amount != doctors_payments.paid and
                order_details.is_gift = 0 and
                is_return = 0
                 and doctor_id=$id");

        $total=$amount[0]->amount - $paid[0]->paid;
        foreach($products as $product){
            $product->qty=0;

            foreach($managers as $manager){
                if($manager->product_id == $product->id){
                    $product->qty +=1;
                }

            }

        }

        return view('manager.doctor.deposit',compact('products','total'));
    }


    public function doctor_order($id){

        $orders=Orders::where('doctor_id',$id)->Join('status', 'status.id','=','orders.is_delivered')->Select('orders.created_at as created_at','orders.id as id','status_az','status_en','status_ru','status_tr')->get();

        $payments=DB::select("SELECT sum(paid) as paid,order_id from doctors_payments
                  join order_details on doctors_payments.order_detail_id = order_details.id
                  join orders o on order_details.order_id = o.id  group by  order_id");
        $paids=DB::select("SELECT sum(amount) as paid,order_id from order_details
       join orders o on order_details.order_id = o.id  group by  order_id");
        foreach($orders as $order){
            $order->paid=0;
            $order->total=0;

            foreach($payments as $payment) {
                if ($payment->order_id == $order->id) {

                    $order->paid = $payment->paid;

                }
            }

            foreach($paids as $paid) {
                if ($paid->order_id == $order->id) {

                    $order->total = $paid->paid;

                }
            }

        }

        return view('manager.doctor.orders',compact('orders'));
    }

    public function order_details($id){

        $products = Orders::join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->select('name_az','name_en','name_ru','name_tr', 'amount as price', 'image', 'order_details.created_at as order_detail_created', 'order_details.id as order_details_id','order_details.is_return as is_return')
            ->where('orders.id', $id)
            ->get();

//        $products = OrderDetails::Join('products', 'order_details.product_id', '=','products.id')->where('order_id', $id)
//            ->select('name_az','name_en','name_ru','name_tr', 'amount as price', 'image', 'order_details.created_at as order_detail_created','order_details.id as order_detail_id','order_details.is_return as is_return')
//            ->get();

//        $payments=DB::select("Select order_detail_id , SUM(paid) as paid , created_at as order_details_paid from doctors_payments GROUP BY order_detail_id");
        foreach ($products as $product) {

            $check=DoctorPayments::where('order_detail_id',$product->order_details_id)->count();
            if ($check != 0) {
                $payment=DB::select("Select order_detail_id , SUM(paid) as paid , created_at as order_details_paid from doctors_payments where order_detail_id = $product->order_details_id GROUP BY order_detail_id");

                $product->paid=round($payment[0]->paid,1);
                $product->order_details_paid=$payment[0]->order_details_paid;

            }



        }
        return view('manager.order.detail', compact('products', 'id'));
    }




    public function percent_manager(){
        $payments=DB::select("select manager_payments.created_at, order_detail_id,doctor_payment_id,SUM(paid) as paid,first_name,last_name,manager_id,percentage_value from manager_payments
            join order_details od on manager_payments.order_detail_id = od.id
            join orders on orders.id = od.order_id
            join users on users.id = orders.manager_id
            join managers on users.id = managers.user_id
        GROUP BY created_at  DESC");

        return view('admin.manager.percent_manager',compact('payments'));
    }

    public function percent_manager_detail($date,$manager){
        $payments=DB::select("select name_az,paid from manager_payments
  join order_details od on manager_payments.order_detail_id = od.id
 join orders on orders.id = od.order_id
 join users on users.id = orders.manager_id
 join managers on users.id = managers.user_id
 join products on products.id = od.product_id
WHERE manager_payments.created_at = '$date' and manager_id=$manager");

        return view('admin.manager.percent_manager_detail',compact('payments'));
    }

    public function manager_percent_manager(){
        $id=Auth::user()->id;
        $payments=DB::select("select manager_payments.created_at, order_detail_id,doctor_payment_id,SUM(paid) as paid,first_name,last_name,manager_id,percentage_value from manager_payments
    join order_details od on manager_payments.order_detail_id = od.id
    join orders on orders.id = od.order_id
    join users on users.id = orders.manager_id
    join managers on users.id = managers.user_id where orders.manager_id = $id
        GROUP BY created_at  DESC");

        return view('manager.manager.percent_manager',compact('payments'));
    }
}
