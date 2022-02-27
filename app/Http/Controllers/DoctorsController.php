<?php

namespace App\Http\Controllers;

use App\Models\Doctors;
use App\Models\OrderDetails;
use App\Models\Managers;
use App\Models\Orders;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DoctorsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->role_id===3){
            $doctors=Doctors::Join('users', 'users.id', '=', 'doctors.user_id')->get();


            return view('staff.doctor.index',compact('doctors'));
        }

            $doctors=Doctors::Join('users', 'users.id', '=', 'doctors.user_id')->get();


        return view('admin.doctor.index',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response|string
     */
    public function create()
    {
        if (Auth::user()->role_id===3) {

            $managers=Managers::Join('users', 'users.id', '=', 'managers.user_id')->get();



            return view('staff.doctor.create',compact('managers'));
        }
            $managers=Managers::Join('users', 'users.id', '=', 'managers.user_id')->get();



        return view('admin.doctor.create',compact('managers'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        $request->validate([
//            'name' => 'required',
//            'price' => 'required',
//            'detail' => 'required',
//            'qty' => 'required',
//            'image' => 'required|file|image|mimes:jpeg,jpg,png'
//        ]);
//
//        $imageName = time().'.'.$request->image->extension();
//
//
//        $request->image->move(public_path('assets/images/product/'), $imageName);
//
//
//
//        Doctors::create([
//            'name' =>  $request->name,
//            'detail' =>  $request->detail,
//            'cost' =>  $request->cost,
//            'qty' =>  $request->qty,
//            'price' => intval( $request->price),
//            'image' => $imageName,
//            'discount' => $request->discount
//        ]);
//
//        return redirect()->route('products')
//            ->with('success','Product created successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response|string
     */
    public function show($id)
    {
        if (Auth::user()->role_id==2){
            $payments=OrderDetails::Join('doctors_payments', 'order_details.id', '=', 'doctors_payments.order_detail_id')
                ->Join('manager_payments', 'order_details.id', '=', 'manager_payments.order_detail_id')
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
                ->where('manager_id','=',Auth::user()->id)
                ->where('doctor_id',$id)->get();

            $doctor=Doctors::where('user_id',$id)->Join('users', 'users.id', '=', 'doctors.user_id')
                ->Select('first_name','last_name','phone','email','location','birth_date','user_id','description')
                ->first();

            $userlink=User::where("id",Auth::user()->id)->first();
            $maplink='http://www.google.com/maps/place/'.$userlink->map_x.','.$userlink->map_y;
            return view('manager.doctor.profile',compact('doctor','payments','maplink'));
        }
        else if (Auth::user()->role_id==1) {
            $payments=OrderDetails::Join('doctors_payments', 'order_details.id', '=', 'doctors_payments.order_detail_id')
                ->Join('manager_payments', 'order_details.id', '=', 'manager_payments.order_detail_id')
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
                    'doctor.first_name as doctor_first_name',
                    'doctor.last_name as doctor_last_name')
                ->where('doctor_id',$id)->get();
            $doctor=Doctors::where('user_id',$id)->Join('users', 'users.id', '=', 'doctors.user_id')
                ->Select('first_name','last_name','phone','email','location','birth_date','user_id')
                ->first();

            $userlink=User::where("id",Auth::user()->id)->first();
            $maplink='http://www.google.com/maps/place/'.$userlink->map_x.','.$userlink->map_y;
            return view('admin.doctor.profile',compact('doctor','payments','maplink'));

        }


        else if (Auth::user()->role_id==3) {
            $payments=OrderDetails::Join('doctors_payments', 'order_details.id', '=', 'doctors_payments.order_detail_id')
                ->Join('manager_payments', 'order_details.id', '=', 'manager_payments.order_detail_id')
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
                    'doctor.first_name as doctor_first_name',
                    'doctor.last_name as doctor_last_name')
                ->where('doctor_id',$id)->get();

            $doctor=Doctors::where('user_id',$id)->Join('users', 'users.id', '=', 'doctors.user_id')
                ->Select('first_name','last_name','phone','email','location','birth_date','user_id')
                ->first();

            $userlink=User::where("id",Auth::user()->id)->first();
            $maplink='http://www.google.com/maps/place/'.$userlink->map_x.','.$userlink->map_y;
            return view('staff.doctor.profile',compact('doctor','payments','maplink'));
        }
        else {
            $payments=OrderDetails::Join('doctors_payments', 'order_details.id', '=', 'doctors_payments.order_detail_id')
                ->Join('manager_payments', 'order_details.id', '=', 'manager_payments.order_detail_id')
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

                ->where('doctor_id',Auth::user()->id)->get();
        }

        $doctor=Doctors::where('user_id',$id)->Join('users', 'users.id', '=', 'doctors.user_id')
            ->Select('first_name','last_name','phone','email','location','birth_date','user_id')
            ->first();

        $userlink=User::where("id",Auth::user()->id)->first();
        $maplink='http://www.google.com/maps/place/'.$userlink->map_x.','.$userlink->map_y;
        return view('doctor.profile',compact('doctor','payments','maplink'));
    }







    public function profile(){
        $payments=OrderDetails::Join('doctors_payments', 'order_details.id', '=', 'doctors_payments.order_detail_id')
            ->Join('manager_payments', 'order_details.id', '=', 'manager_payments.order_detail_id')
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

            ->where('doctor_id',Auth::user()->id)->get();
        $doctor=Doctors::where('user_id',Auth::user()->id)->Join('users', 'users.id', '=', 'doctors.user_id')
            ->Select('first_name','last_name','phone','email','location','birth_date','user_id')
            ->first();

        $userlink=User::where("id",Auth::user()->id)->first();
        $maplink='http://www.google.com/maps/place/'.$userlink->map_x.','.$userlink->map_y;
        return view('doctor.doctor.profile',compact('doctor','payments','maplink'));
    }

//    /**
//     * Display the specified resource.
//     *
//     * @param  int  $id
//     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
//     */
    public function deposit()
    {
        $id=Auth::user()->id;
    $products=DB::select("select products.id,image,products.name_az,ifnull(product.qty,0) as qty from products left join (select (doctors.qty) as qty,price,doctors.product_id from products
   left join (select product_id,COUNT(product_id) as qty,doctor_id from order_details
    left join (select order_detail_id, SUM(paid) as total from doctors_payments GROUP BY order_detail_id)
        as doctors_payments on doctors_payments.order_detail_id = order_details.id
    join orders on orders.id = order_details.order_id where orders.is_delivered=3 and is_gift=0 and doctors_payments.total != order_details.amount or doctors_payments.total is NULL and orders.is_delivered=3 and is_gift=0
    group by product_id) as doctors on doctors.product_id = products.id
    left join (select Sum(qty) as qty,product_id from warehouse  group by product_id) as manager on manager.product_id = products.id where doctors.doctor_id=$id) as product on products.id = product.product_id
");

        $total=DB::select("select (SUM(product.price)*SUM(product.qty)) as total from products left join (select (doctors.qty) as qty,price,doctors.product_id from products
    left join ( select product_id,COUNT(product_id) as qty,doctor_id from order_details
     left join (select order_detail_id, SUM(paid) as total from doctors_payments GROUP BY order_detail_id)
        as doctors_payments on doctors_payments.order_detail_id = order_details.id
       join orders on orders.id = order_details.order_id where is_gift=0 and orders.is_delivered=3 and doctors_payments.total != order_details.amount or doctors_payments.total is NULL and is_gift=0 and orders.is_delivered=3
    group by product_id) as doctors on doctors.product_id = products.id
     left join (select Sum(qty) as qty,product_id from warehouse  group by product_id) as manager on manager.product_id = products.id where doctors.doctor_id=$id) as product on products.id = product.product_id");


        return view('doctor.doctor.deposit',compact('products','total'));
    }


    public function admin_doctor_deposit($id){
        $products=DB::select('Select * from products');
        $managers=DB::select("select * from order_details
    left join (select order_detail_id, SUM(paid) as paid from doctors_payments GROUP BY order_detail_id) as doctors_payments on doctors_payments.order_detail_id = order_details.id
    join orders on orders.id = order_details.order_id where is_gift=0 and (doctors_payments.paid != order_details.amount or doctors_payments.paid is NULL) and doctor_id=$id");

        $amount=DB::select("SELECT sum(amount) as amount from order_details
                                      left join doctors_payments on doctors_payments.order_detail_id = order_details.id
                                      join orders on order_details.order_id = orders.id
where (order_details.amount != doctors_payments.paid or doctors_payments.paid IS NULL) and
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

        return view('admin.doctor.deposit',compact('products','total'));
    }


    public function orders_doctor(){
        $id=Auth::user()->id;
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

        return view('doctor.doctor.orders',compact('orders'));
    }



    public function orders($id){

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

        return view('admin.doctor.orders',compact('orders'));
    }

    public function deposit_products($product_id){
        $doctor_id=Auth::user()->id;
        $products=DB::select('Select * from products');
        $managers=DB::select("SELECT count(product_id) as qty,product_id,doctor_id,order_detail_id from order_details
            join doctors_payments on doctors_payments.order_detail_id = order_details.id
            join orders on order_details.order_id = orders.id
        where order_details.amount != doctors_payments.paid and
              order_details.is_gift = 0 and
              is_return = 0 and doctor_id =$doctor_id and product_id =$product_id
        group by product_id");


        foreach($products as $product){
            $product->qty=0;
            $product->price=0;

            foreach($managers as $manager){
                if($manager->product_id == $product->id){
                    $product->qty=$product->qty+$manager->qty;
                    $product->price=$manager->order_detail_id;

                }

            }

        }

        return view('doctor.deposit',compact('products'));
    }



    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (Auth::user()->role_id===3) {
            $account = User::join('doctors','user_id','=','users.id')
                ->Where('users.id',$id)
                ->first();
            $managers=Managers::join('users','user_id','=','users.id')->get();
            return view('staff.account.edit-profile',compact('account','managers'));
        }
            $account = User::join('doctors','user_id','=','users.id')
            ->Where('users.id',$id)
            ->first();
        $managers=Managers::join('users','user_id','=','users.id')->get();
        return view('admin.account.edit-profile',compact('account','managers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function password($id)
    {
        $account = User::Where('users.id',$id)->first();
        return view('account.reset_password',compact('account'));
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


    public function order_detail($id){
        $products = Orders::join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->leftJoin('doctors_payments', 'order_details.id', '=', 'doctors_payments.order_detail_id')
            ->select('name_az','name_en','name_ru','name_tr', 'amount as price', 'image', 'order_details.created_at as order_detail_created', 'paid', 'doctors_payments.created_at as order_details_paid','order_details.id as order_details_id','order_details.is_return as is_return')
            ->where('orders.id', $id)
            ->where('orders.doctor_id', Auth::user()->id)
            ->get();


        return view('doctor.order.detail', compact('products', 'id'));
    }

    public function gifts(){
        $gifts = OrderDetails::where('order_details.is_gift',1)
            ->Join('orders', 'order_details.order_id', '=', 'orders.id')
            ->Join('users as manager', 'manager.id', '=', 'orders.manager_id')
            ->Join('users as doctor', 'doctor.id', '=', 'orders.doctor_id')
            ->Join('users as seller', 'seller.id', '=', 'gift_by')
            ->Join('products', 'products.id', '=', 'product_id')
            ->Select('order_details.id as gift_id','product_id','order_id','seller.first_name as seller_first_name','seller.last_name as seller_last_name','manager.first_name as manager_first_name','manager.last_name as manager_last_name','doctor.first_name as doctor_first_name','doctor.last_name as doctor_last_name','order_details.created_at as create_at','name_az','name_en','name_ru','name_tr')
            ->where('doctor.id',Auth::user()->id)
            ->get();
        return view('doctor.gift.index',compact('gifts'));

    }
}
