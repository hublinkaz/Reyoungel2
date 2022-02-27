<?php

namespace App\Http\Controllers;

use App\Models\DoctorPayments;
use App\Models\Doctors;
use App\Models\Drivers;
use App\Models\Gifts;
use App\Models\Handovers;
use App\Models\HandoverDetails;
use App\Models\InvoiceDetails;
use App\Models\Invoices;
use App\Models\ManagerPayments;
use App\Models\Managers;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Settings;
use App\Models\Status;
use App\Models\User;
use App\Models\Warehouse;
use App\Models\WarehouseQuery;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use phpDocumentor\Reflection\Types\Null_;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Laravel\Facades\Telegram;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if(Auth::user()->role_id===3){
            $products = Orders::Join('users', 'orders.doctor_id', '=', 'users.id')
                ->join('users as u', 'orders.manager_id', '=', 'u.id')
                ->join('users as us', 'orders.driver_id', '=', 'us.id')
                ->select('orders.id as order_id', 'doctor_id', 'manager_id', 'driver_id', 'location', 'is_delivered', 'orders.created_at as order_created_at', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'u.first_name as manager_first_name', 'u.last_name as manager_last_name', 'us.first_name as driver_first_name', 'us.last_name as driver_last_name')
                ->get();

            $status=Status::all();


            return view('staff.order.index', compact('products','status'));
        }else{

            $products = Orders::Join('users', 'orders.doctor_id', '=', 'users.id')
                ->join('users as u', 'orders.manager_id', '=', 'u.id')
                ->leftjoin('users as us', 'orders.driver_id', '=', 'us.id')
                ->select('orders.id as order_id', 'doctor_id', 'manager_id', 'driver_id', 'location', 'is_delivered', 'orders.created_at as order_created_at', 'users.first_name as doctor_first_name', 'users.last_name as doctor_last_name', 'u.first_name as manager_first_name', 'u.last_name as manager_last_name', 'us.first_name as driver_first_name', 'us.last_name as driver_last_name')
                ->get();

        $status=Status::all();


        return view('admin.order.index', compact('products','status'));
        }
    }

    public function detail($id)
    {
        if (Auth::user()->role_id==3){
            $products = Orders::join('order_details', 'orders.id', '=', 'order_details.order_id')
                ->join('products', 'products.id', '=', 'order_details.product_id')
                ->leftJoin('doctors_payments', 'order_details.id', '=', 'doctors_payments.order_detail_id')
                ->select('name_az','name_en','name_ru','name_tr', 'amount as price', 'image', 'order_details.created_at as order_detail_created', 'paid', 'doctors_payments.created_at as order_details_paid','order_details.id as order_details_id','order_details.is_return as is_return')
                ->where('orders.id', $id)
                ->get();


            return view('staff.order.detail', compact('products', 'id'));
        }
        $products = Orders::join('order_details', 'orders.id', '=', 'order_details.order_id')
            ->join('products', 'products.id', '=', 'order_details.product_id')
            ->leftJoin('doctors_payments', 'order_details.id', '=', 'doctors_payments.order_detail_id')
            ->select('name_az','name_en','name_ru','name_tr', 'amount as price', 'image', 'order_details.created_at as order_detail_created', 'paid', 'doctors_payments.created_at as order_details_paid','order_details.id as order_details_id','order_details.is_return as is_return')
            ->where('orders.id', $id)
            ->get();


        return view('admin.order.detail', compact('products', 'id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::where('status',true)->get();

        return view('admin.order.create', compact('products'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function checkout()
    {

            $doctors = Doctors::Join('users', 'users.id', '=', 'doctors.user_id')->get();

        return view('admin.checkout.checkout', compact('doctors'));

    }




    public function checkout_manager()
    {


            $doctors = Doctors::Join('users', 'users.id', '=', 'doctors.user_id')
                ->where('doctors.last_manager_id',Auth::user()->id)
                ->get();




        return view('manager.checkout.checkout', compact('doctors'));

    }


    /*

 /**
  * Store a newly created resource in storage.
  *
  * @param  \Illuminate\Http\Request  $request
  * @return \Illuminate\Http\Response
  */
//    public function status($id)
//
//    {
//        $response = $request->json()->all();
//
//        Orders::where('id', $response['order_id'])->update(['is_delivered' => $response['is_delivered']]);
//        return response('success :' . $response['is_delivered'], 200);
//
//    }

    /*




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function driver_post(Request $request)
    {
        Orders::where('id', $request->id)->update([
            'driver_id'=>$request->driver_id
        ]);

        $driver=User::where('id', $request->driver_id)->first();
        $pdf=Invoices::where('order_id', $request->id)->first();
        $location=Orders::where('orders.id', $request->id)->join('users','users.id','=','orders.doctor_id')->first();
        if ($driver->telegram_user_id !=0) {
            Telegram::sendMessage([
                'chat_id' => $driver->telegram_user_id,
                'text' => 'Çatdırılacaq Sifariş Var. Məlumat: '.$pdf->url.' '.'--- Unvan : http://www.google.com/maps/place/'.$location->map_x.','.$location->map_y
            ]);
        }


        return redirect()->back()->withSuccess('Dəyişiklik Edildi ');

    }


    public function driver($id){

        $order=Orders::where('id', $id)->first();

        $drivers=Drivers::join('users', 'drivers.user_id', '=', 'users.id')
            ->where('is_active',1)->get();


        return view('admin.order.driver.create', compact('order','drivers'));

    }










    public function store(Request $request)
    {
        $response = $request->json()->all();
        if ($response['role_id'] == 5) {

            if (User::where('id', $response['user_id'])->first()->role_id == 2 or User::where('id', $response['user_id'])->first()->role_id == 5) {

                if ($response['order_type']==='1') {


                    $user=User::where('id', $response['user_id'])->first();
                    if ($user->role_id ==5){
                        $doctor = Doctors::where('user_id', $response['doctor'])->first();
                        $manager_telegram_id = User::where('id', $doctor->user_id)
                            ->select('telegram_user_id')
                            ->first();


                        $order = Orders::create([
                            'doctor_id' => $doctor->user_id,
                            'manager_id' => $doctor->last_manager_id,
                            'driver_id' => 5,
                            'create_by' => $response['user_id'],
                            'location' => $doctor->location,
                            'is_delivered' => 1
                        ]);
                        $invoices = Invoices::create([
                            'doctor_id' => $response['doctor'],
                            'order_id' => $order->id,
                            'url' => '',
                        ]);
                        $discount=Settings::where('key','doctor_discount')->first()->value;
                        foreach ($response['data'] as $data) {
                            $product = Product::whereId($data['id'])->first();
                            $invoice_details = InvoiceDetails::create([
                                'product_id' => $product->id,
                                'invoice_id' => $invoices->id,
                                'name_az' => $product->name_az,
                                'name_en' => $product->name_en,
                                'name_ru' => $product->name_ru,
                                'name_tr' => $product->name_tr,
                                'price' => ($product->price)-(($product->price*$discount)/100),
                                'cost' => $product->cost,
                                'qty' => $data['count'],
                                'units' => $product->units,
                                'detail_az' => $product->detail_az,
                                'detail_en' => $product->detail_en,
                                'detail_ru' => $product->detail_ru,
                                'detail_tr' => $product->detail_tr,
                                'image' => $product->image

                            ]);

                                $percentage_value = Doctors::where('doctors.user_id', $response['user_id'])->join('managers', 'managers.user_id', '=', 'doctors.last_manager_id')->first()->percentage_value;



                            for ($i = 0; $i < $data['count']; $i++) {
                                $order_detal = OrderDetails::create([
                                    'product_id' => $data['id'],
                                    'amount' => $data['price'] - ($data['price']*1)/100,
                                    'order_id' => $order->id,
                                ]);

                                DoctorPayments::create([
                                    'order_detail_id' => $order_detal->id,
                                    'paid' =>  $data['price'] - ($data['price']*1/100),
                                    'percentage_value' => $percentage_value
                                ]);


//                            ManagerPayments::create([
//                                'order_detail_id' => $order_detal->id,
//                                'doctor_payment_id' => $doctorpay->id,
//                                'paid' => $data['price']
//                            ]);


                            }

                        }
                    }else{
                        $doctor = Doctors::where('user_id', $response['doctor'])->first();
                        $manager_telegram_id = User::where('id', $doctor->user_id)
                            ->select('telegram_user_id')
                            ->first();


                        $order = Orders::create([
                            'doctor_id' => $doctor->user_id,
                            'manager_id' => $doctor->last_manager_id,
                            'driver_id' => 5,
                            'create_by' => $response['user_id'],
                            'location' => $doctor->location,
                            'is_delivered' => 1
                        ]);
                        $invoices = Invoices::create([
                            'doctor_id' => $response['doctor'],
                            'order_id' => $order->id,
                            'url' => '',
                        ]);
                        foreach ($response['data'] as $data) {
                            $product = Product::whereId($data['id'])->first();
                            $invoice_details = InvoiceDetails::create([
                                'invoice_id' => $invoices->id,
                                'product_id' => $product->id,

                                'name_az' => $product->name_az,
                                'name_en' => $product->name_en,
                                'name_ru' => $product->name_ru,
                                'name_tr' => $product->name_tr,
                                'price' => $product->price,
                                'cost' => $product->cost,
                                'qty' => $data['count'],
                                'units' => $product->units,
                                'detail_az' => $product->detail_az,
                                'detail_en' => $product->detail_en,
                                'detail_ru' => $product->detail_ru,
                                'detail_tr' => $product->detail_tr,
                                'image' => $product->image

                            ]);
                            if (User::where('id', $response['user_id'])->first()->role_id === 2) {

                                $percentage_value = Managers::where('user_id', $response['user_id'])->first()->percentage_value;
                            } else {
                                $percentage_value = Doctors::where('doctors.user_id', $response['user_id'])->join('managers', 'managers.user_id', '=', 'doctors.last_manager_id')->first()->percentage_value;
                            }


                            for ($i = 0; $i < $data['count']; $i++) {
                                $order_detal = OrderDetails::create([
                                    'product_id' => $data['id'],
                                    'amount' => $data['price'],
                                    'order_id' => $order->id,
                                ]);

                                DoctorPayments::create([
                                    'order_detail_id' => $order_detal->id,
                                    'paid' => $data['price'],
                                    'percentage_value' => $percentage_value
                                ]);

//                            ManagerPayments::create([
//                                'order_detail_id' => $order_detal->id,
//                                'doctor_payment_id' => $doctorpay->id,
//                                'paid' => $data['price']
//                            ]);


                            }

                        }
                    }

                    $user = User::where('id', $response['user_id'])->first();

                    Telegram::sendMessage([
                        'chat_id' => '815286201',
                        'text' => $user->first_name . ' ' . $user->last_name . ' Tərəfindən Sifarişiniz var!'
                    ]);

                    $msg = "This is a simple message.";

                    return response()->json(array('msg'=> $msg), 200);
                } else {

                    $doctor = Doctors::where('user_id', $response['doctor'])->first();
                    $manager_telegram_id = User::where('id', $doctor->user_id)
                        ->select('telegram_user_id')
                        ->first();


                    $order = Orders::create([
                        'doctor_id' => $doctor->user_id,
                        'manager_id' => $doctor->last_manager_id,
                        'driver_id' => 5,
                        'create_by' => $response['user_id'],
                        'location' => $doctor->location,
                        'is_delivered' => 1
                    ]);
                    $invoices = Invoices::create([
                        'doctor_id' => $response['doctor'],
                        'order_id' => $order->id,
                        'url' => '',
                    ]);
                    foreach ($response['data'] as $data) {
                        $product = Product::whereId($data['id'])->first();
                        $invoice_details = InvoiceDetails::create([
                            'invoice_id' => $invoices->id,
                            'product_id' => $product->id,

                            'name_az' => $product->name_az,
                            'name_en' => $product->name_en,
                            'name_ru' => $product->name_ru,
                            'name_tr' => $product->name_tr,
                            'price' => $product->price,
                            'cost' => $product->cost,
                            'qty' => $data['count'],
                            'units' => $product->units,
                            'detail_az' => $product->detail_az,
                            'detail_en' => $product->detail_en,
                            'detail_ru' => $product->detail_ru,
                            'detail_tr' => $product->detail_tr,
                            'image' => $product->image

                        ]);


                        for ($i = 0; $i < $data['count']; $i++) {
                            OrderDetails::create([
                                'product_id' => $data['id'],
                                'amount' => $data['price'],
                                'order_id' => $order->id,
                            ]);

                        }

                    }

                    $user = User::where('id', $response['user_id'])->first();
                    Telegram::sendMessage([
                        'chat_id' => '815286201',
                        'text' => $user->first_name . ' ' . $user->last_name . ' Tərəfindən Sifarişiniz var!'
                    ]);
                    $msg = "This is a simple message.";
                    return response()->json(array('msg'=> $msg), 200);
                }


            } else {
                $doctor = Doctors::where('user_id', $response['doctor'])->first();

                $order = Orders::create([
                    'doctor_id' => $doctor->user_id,
                    'manager_id' => $doctor->last_manager_id,
                    'driver_id' => 5,
                    'create_by' => $response['user_id'],
                    'location' => $doctor->location,
                    'is_delivered' => 1
                ]);
                $invoices = Invoices::create([
                    'doctor_id' => $response['doctor'],
                    'order_id' => $order->id,
                    'url' => '',
                ]);
                foreach ($response['data'] as $data) {
                    $product = Product::whereId($data['id'])->first();
                    $invoice_details = InvoiceDetails::create([
                        'invoice_id' => $invoices->id,
                        'product_id' => $product->id,

                        'name_az' => $product->name_az,
                        'name_en' => $product->name_en,
                        'name_ru' => $product->name_ru,
                        'name_tr' => $product->name_tr,
                        'price' => $product->price,
                        'cost' => $product->cost,
                        'qty' => $data['count'],
                        'units' => $product->units,
                        'detail_az' => $product->detail_az,
                        'detail_en' => $product->detail_en,
                        'detail_ru' => $product->detail_ru,
                        'detail_tr' => $product->detail_tr,
                        'image' => $product->image

                    ]);


                    for ($i = 0; $i < $data['count']; $i++) {
                        OrderDetails::create([
                            'product_id' => $data['id'],
                            'amount' => $data['price'],
                            'order_id' => $order->id,
                        ]);

                    }

                }


                $user = User::where('id', $response['user_id'])->first();
                Telegram::sendMessage([
                    'chat_id' => '815286201',
                    'text' => $user->first_name . ' ' . $user->last_name . ' Tərəfindən Sifarişiniz var!'
                ]);
                $msg = "This is a simple message.";
                return response()->json(array('msg'=> $msg), 200);
            }


        } else if ($response['role_id'] == 2) {


            $managers = Managers::where('user_id', $response['doctor'])->first();
            $users = User::where('id', $response['doctor'])->first();


            $handovers = Handovers::create([
                'manager_id' => $response['doctor'],
                'url' => '',
            ]);
            $id = $handovers->id;
            foreach ($response['data'] as $data) {
                $product = Product::whereId($data['id'])->first();
                $handover = HandoverDetails::create([
                    'handovers_id' => $id,
                    'name_az' => $product->name_az,
                    'name_en' => $product->name_en,
                    'name_ru' => $product->name_ru,
                    'name_tr' => $product->name_tr,
                    'price' => $product->price,
                    'cost' => $product->cost,
                    'qty' => $data['count'],
                    'units' => $product->units,
                    'detail_az' => $product->detail_az,
                    'detail_en' => $product->detail_en,
                    'detail_ru' => $product->detail_ru,
                    'detail_tr' => $product->detail_tr,
                    'image' => $product->image

                ]);

                $check_warhouse=WarehouseQuery::where('manager_id',$response['doctor'])->where('product_id',$data['id'])->count();
                if($check_warhouse==0){
                    WarehouseQuery::create([
                        'manager_id' => $response['doctor'],
                        'product_id' => $data['id'],
                        'qty' => $data['count'],
                    ]);
                }else{
                    WarehouseQuery::where('manager_id', $response['doctor'])->where('product_id', $data['id'])->update([
                        'qty' => WarehouseQuery::where('manager_id', $response['doctor'])->where('product_id', $data['id'])->first()->qty + $data['count']]);
                }



            }


            $user = User::where('id', $response['doctor'])->first();
            Telegram::sendMessage([
                'chat_id' => '815286201',
                'text' => $user->first_name . ' ' . $user->last_name . ' Tərəfindən Sifarişiniz var!'
            ]);
            $msg = "This is a simple message.";
            return response()->json(array('msg'=> $msg), 200);
        }
        return response('error', 500);
    }



    /**
     * Display the specified resource.
     *
     * @param \App\Models\Orders $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Orders $orders)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Orders $orders
     * @return \Illuminate\Http\Response
     */
    public function edit(Orders $orders)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Orders $orders
     * @return string
     */
    public function update(Request $request)
    {

        $create_by = Orders::where('id', $request->order_id)->first()->create_by;
        $manager_id = Orders::where('id', $request->order_id)->first()->manager_id;
        User::where('id', $create_by)->first()->role_id;
        $products = OrderDetails::where('order_id', $request->order_id)->get();
        $order_detalils = DB::select("SELECT id, order_id, COUNT(product_id) as qty,product_id, is_gift, gift_by, amount, created_at, updated_at, is_return from order_details where order_id = $request->order_id group by product_id");
        if (User::where('id', $create_by)->first()->role_id ==1  or  User::where('id', $create_by)->first()->role_id ==3 ) {
            if ($request->is_delivered == 3) {
                foreach ($products as $product) {
                    Product::where('id', $product->product_id)->update(['qty' => (Product::where('id', $product->product_id)->first()->qty) - 1]);

                }
                Orders::where('id', $request->order_id)->update(['is_delivered' => $request->is_delivered]);

            }
        } else {
            if ($request->is_delivered == 3) {
                foreach ($order_detalils as $order_detalil) {
                    if (Warehouse::where('product_id', $order_detalil->product_id)->where('manager_id', $manager_id)->count() == 0) {

                        return redirect()->back()->withErrors('Sifariş Edilən məhsul Menecerde Yoxdur ');
                    }else{
                        $qty = Warehouse::where('product_id', $order_detalil->product_id)->where('manager_id', $manager_id)->first()->qty;

                        if ($order_detalil->qty>$qty){
                            return redirect()->back()->withErrors('Sifariş Edilən məhsul Menecerde Yoxdur ');

                        }

                    }

//
//                    foreach ($products as $prod) {
//                        if (Warehouse::where('product_id', $prod->product_id)->where('manager_id', $manager_id)->count() == 0) {
//                            return redirect()->back()->withErrors('Sifariş Edilən məhsul Menecerde Yoxdur ');
//
//                        }
//                        if ($qty <= 1) {
//                            return redirect()->back()->withErrors('Sifariş Edilən məhsul Menecerde Yoxdur '.$prod->product_id);
//                        }
//                        $qty -= 1;
//                    }

                }


                foreach (OrderDetails::where('order_id', $request->order_id)->get() as $prs) {

                        Warehouse::where('product_id', $prs->product_id)->where('manager_id', $manager_id)->update([
                            'qty' => (Warehouse::where('product_id', $prs->product_id)->where('manager_id', $manager_id)->first()->qty) - 1
                        ]);



                }
            }
            Orders::where('id', $request->order_id)->update(['is_delivered' => $request->is_delivered]);
        }


        return redirect()->back()->withSuccess('Dəyişiklik Edildi ');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Orders $orders
     * @return \Illuminate\Http\Response
     */
    public function destroy(Orders $orders)
    {
        //
    }



    public function invoice_create($id){


        $invoice=Invoices::where('order_id', $id)->first();

        $customer=Orders::where('orders.id', $id)->join('users','users.id','=','doctor_id')->join('doctors','doctors.user_id','=','doctor_id')
            ->Select('first_name','last_name','phone','doctors.location as location','orders.created_at as created_at')->first();



        $data = [
            'serila' => $id,
            'date' => $customer->created_at->format('Y-m-d'),
        ];




        $manager = [
            'name' =>$customer->first_name.' '.$customer->last_name,
            'phone' => $customer->phone,
            'address'=>$customer->location,
        ];

        $company = [
            'name' => 'Reyoungel',
            'email' => 'info@reyoungel.az',
            'phone' => '+994 55 555 55 55',
        ];


//        $items = InvoiceDetails::where('invoice_id', '=', $invoice->id)->get();
        $items = DB::select("select name_az,name_en,name_ru,name_tr,units,price,amount,paid,invoice.qty as qty from products
    join (select order_id,order_details.id,order_details.product_id,COUNT(order_details.product_id) as qty,SUM(amount) as amount,sum(doctors_payments.paid) as paid from order_details
 left join (select order_detail_id,ROUND(SUM(paid),2) as paid,percentage_value,created_at from doctors_payments group by order_detail_id) as doctors_payments on order_details.id = doctors_payments.order_detail_id
where order_details.order_id=$id group by order_details.product_id) as invoice on invoice.product_id = products.id");




        view()->share('items', $items);
        view()->share('company', $company);
        view()->share('manager', $manager);
        view()->share('data', $data);
        view()->share('data', $data);
        $pdf = PDF::loadView('admin.invoice.report_invoice', $data);
        return $pdf->stream();


    }
}
