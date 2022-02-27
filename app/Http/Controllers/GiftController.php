<?php

namespace App\Http\Controllers;

use App\Models\DoctorPayments;
use App\Models\Doctors;
use App\Models\GiftQuery;
use App\Models\Gifts;
use App\Models\ManagerPayments;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Product;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class GiftController extends Controller
{
    public function index(){
        if(Auth::user()->role_id === 1){
            $gifts = OrderDetails::where('order_details.is_gift',1)
                ->Join('orders', 'order_details.order_id', '=', 'orders.id')
                ->Join('users as manager', 'manager.id', '=', 'orders.manager_id')
                ->Join('users as doctor', 'doctor.id', '=', 'orders.doctor_id')
                ->Join('users as seller', 'seller.id', '=', 'gift_by')
                ->Join('products', 'products.id', '=', 'product_id')
                ->Select('order_details.id as gift_id','product_id','order_id','seller.first_name as seller_first_name','seller.last_name as seller_last_name','manager.first_name as manager_first_name','manager.last_name as manager_last_name','doctor.first_name as doctor_first_name','doctor.last_name as doctor_last_name','order_details.created_at as create_at','name_az','name_en','name_ru','name_tr')->get();

        }elseif(Auth::user()->role_id === 3){
            $gifts = OrderDetails::where('order_details.is_gift',1)
                ->Join('orders', 'order_details.order_id', '=', 'orders.id')
                ->Join('users as manager', 'manager.id', '=', 'orders.manager_id')
                ->Join('users as doctor', 'doctor.id', '=', 'orders.doctor_id')
                ->Join('users as seller', 'seller.id', '=', 'gift_by')
                ->Join('products', 'products.id', '=', 'product_id')
                ->Select('order_details.id as gift_id','product_id','order_id','seller.first_name as seller_first_name','seller.last_name as seller_last_name','manager.first_name as manager_first_name','manager.last_name as manager_last_name','doctor.first_name as doctor_first_name','doctor.last_name as doctor_last_name','order_details.created_at as create_at','name_az','name_en','name_ru','name_tr')->get();

            return view('staff.gift.index',compact('gifts'));

        }




        elseif(Auth::user()->role_id === 2){
            $gifts = OrderDetails::where('order_details.is_gift',1)
                ->Join('orders', 'order_details.order_id', '=', 'orders.id')
                ->Join('users as manager', 'manager.id', '=', 'orders.manager_id')
                ->Join('users as doctor', 'doctor.id', '=', 'orders.doctor_id')
                ->Join('users as seller', 'seller.id', '=', 'gift_by')
                ->Join('products', 'products.id', '=', 'product_id')
                ->Select('order_details.id as gift_id','product_id','order_id','seller.first_name as seller_first_name','seller.last_name as seller_last_name','manager.first_name as manager_first_name','manager.last_name as manager_last_name','doctor.first_name as doctor_first_name','doctor.last_name as doctor_last_name','order_details.created_at as create_at','name_az','name_en','name_ru','name_tr')
                ->where('manager.id',Auth::user()->id)
                ->get();


        }elseif(Auth::user()->role_id === 5){
            $gifts = OrderDetails::where('order_details.is_gift',1)
                ->Join('orders', 'order_details.order_id', '=', 'orders.id')
                ->Join('users as manager', 'manager.id', '=', 'orders.manager_id')
                ->Join('users as doctor', 'doctor.id', '=', 'orders.doctor_id')
                ->Join('users as seller', 'seller.id', '=', 'gift_by')
                ->Join('products', 'products.id', '=', 'product_id')
                ->Select('order_details.id as gift_id','product_id','order_id','seller.first_name as seller_first_name','seller.last_name as seller_last_name','manager.first_name as manager_first_name','manager.last_name as manager_last_name','doctor.first_name as doctor_first_name','doctor.last_name as doctor_last_name','order_details.created_at as create_at','name_az','name_en','name_ru','name_tr')
                ->where('doctor.id',Auth::user()->id)
                ->get();
        }
        else{
            return false;
        }

            return view('admin.gift.index',compact('gifts'));

    }


    public function create(){
        if (Auth::user()->role_id === 1 ){
            $products = Product::where('qty','!=',0)->get();

        }
        else if (Auth::user()->role_id === 3){
            $products = Product::where('qty','!=',0)->get();
            $orders=Orders::latest()->take(10)->get();

            return view('staff.gift.create',compact('products','orders'));

        }
        else{
            $products = Warehouse::where('warehouse.qty','>', 0)
                ->join('products','products.id','=','product_id')->get();

        }

        $orders=Orders::latest()->take(10)->get();

        return view('admin.gift.create',compact('products','orders'));

    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post(Request $request)
    {
        if($request->order_id === 0 ){
            return redirect()->back()->withErrors('Xeta');
        }
        else{


            GiftQuery::create([
                     'order_id'=> $request->order_id ,
                    'product_id'=>$request->product_id,
                    'gift_by'=>Auth::user()->id,
            ]);





            return redirect()->back()->withSuccess('Admin Təsdiqinə Göndərildi');
        }



    }



    public function gift_query(){

        $gifts=DB::select("SELECT doctor.first_name as doctor_first_name,doctor.last_name as doctor_last_name,
       name_az,name_en,name_ru,name_tr,users.first_name as seller_first_name,users.last_name as seller_last_name,gift_query.created_at as created_at,gift_query.id as gift_id
       from gift_query
    join users on users.id = gift_by
    join products on products.id = gift_query.product_id
    join orders on orders.id = gift_query.order_id
    join users  doctor on orders.doctor_id = doctor.id");

        return view('admin.gift.gift_query',compact('gifts'));

    }


    public function gift_query_post(Request  $request){

        if ($request->status==1) {
            $gift = GiftQuery::where('id', $request->gift_id)->first();

            $gift_by = User::where('id', $gift->gift_by)->first();

            if ($gift_by->role_id == 2) {


                $check = Warehouse::where('manager_id',$gift_by->id)->where('product_id', $gift->product_id)->count();
                if ($check>0){
                    $check_qty = Warehouse::where('manager_id',$gift_by->id)->where('product_id', $gift->product_id)->first()->qty;
                    if ($check_qty >0){
                        $order_detail = OrderDetails::create([
                            'order_id' => $gift->order_id,
                            'product_id' => $gift->product_id,
                            'amount' => 0,
                            'is_gift' => 1,
                            'gift_by' => $gift->gift_by,
                        ]);

                        Warehouse::where('manager_id',$gift_by->id)->where('product_id', $gift->product_id)->update([
                            'qty'=> $check_qty -1,
                        ]);
                        GiftQuery::where('id', $request->gift_id)->delete();
                        return redirect()->back()->withSuccess('Təstiqləndi !');

                    }else{
                        return redirect()->back()->withErrors('Məhsul Yoxdur !');

                    }
                }else{
                    return redirect()->back()->withErrors('Məhsul Yoxdur  !');

                }






            }else{
                GiftQuery::where('id', $request->gift_id)->delete();
                Product::where('id', $gift->product_id)->update(['qty' => (Product::where('id', $gift->product_id)->first()->qty) - 1]);
                return redirect()->back()->withSuccess('Təstiqləndi !');
            }
        }else {
            GiftQuery::where('id', $request->gift_id)->delete();
            return redirect()->back()->withSuccess('Ləğv Edildi !');

        }





    }
}
