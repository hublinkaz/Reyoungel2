<?php

namespace App\Http\Controllers;

use App\Models\DoctorPayments;
use App\Models\ManagerPayments;
use App\Models\OrderDetails;
use App\Models\Orders;
use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReturnsController extends Controller
{
    public function index(){

        $gifts = OrderDetails::where('order_details.is_gift',1)
            ->Join('orders', 'order_details.order_id', '=', 'orders.id')
            ->Join('users as manager', 'manager.id', '=', 'orders.manager_id')
            ->Join('users as doctor', 'doctor.id', '=', 'orders.doctor_id')
            ->Join('users as seller', 'seller.id', '=', 'gift_by')
            ->Join('products', 'products.id', '=', 'product_id')
            ->Select('order_details.id as gift_id','product_id','order_id','seller.first_name as seller_first_name','seller.last_name as seller_last_name','manager.first_name as manager_first_name','manager.last_name as manager_last_name','doctor.first_name as doctor_first_name','doctor.last_name as doctor_last_name','order_details.created_at as create_at','name_az','name_en','name_ru','name_tr')->get();


        return view('gift.index',compact('gifts'));

    }


    public function create(){
        if (Auth::user()->role_id === 1){
            $products = Product::where('qty','>',0)->get();

        }
        else{
            $products = Warehouse::where('qty','>',0)
                ->join('products','products.id',' = ','product_id')->get();

        }

        $orders=Orders::latest()->take(10)->get();

        return view('gift.create',compact('products','orders'));

    }



    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\OrderDetails $order_details
     * @return \Illuminate\Http\RedirectResponse
     */
    public function post(Request $request, OrderDetails $order_details)

    {
        OrderDetails::where('id', $request->order_details_id)->update(['is_return' => $request->is_return]);

        $order=OrderDetails::where('id', $request->order_details_id)->first();

        return redirect()->back()->withSuccess('Dəyişiklik Edildi ');


    }


    public function return_query()
    {
        $products=DB::select("select order_details.order_id as order_id,manager.first_name as manager_first_name
     , manager.last_name as manager_last_name,doctor.first_name as doctor_first_name
     ,doctor.last_name as doctor_last_name,p.name_az as product_name,product_id,manager_id,order_details.id as order_detail_id from order_details
    join orders on order_details.order_id = orders.id
    join products p on order_details.product_id = p.id
    join users doctor on doctor.id =orders.doctor_id
    join users manager on manager.id =orders.manager_id where order_details.is_return =1");
        return view('admin.order.return',compact('products'));
    }

    public function return_query_post(Request $request)
    {
        if ($request->value==1){
            $check=Warehouse::where('manager_id',$request->manager_id)->where('product_id',$request->product_id)->count();
            if ($check>0){
               $qty= Warehouse::where('manager_id',$request->manager_id)->where('product_id',$request->product_id)->first()->qty;
                Warehouse::where('manager_id',$request->manager_id)->where('product_id',$request->product_id)->update([
                    'qty'=>$qty+1
                ]);
                OrderDetails::where('id',$request->order_detail_id)->delete();

            }else{
                Warehouse::create([
                    'manager_id'=>$request->manager_id,
                    'product_id'=>$request->product_id,
                    'qty'=>1
                ]);
                // OrderDetails::where('id',$request->order_detail_id)->update([
                //     'is_return'=>0
                // ]);
                                OrderDetails::where('id',$request->order_detail_id)->delete();

            }
            return redirect()->back()->withSuccess('Dəyişiklik Edildi ');

        }
        else{
            OrderDetails::where('id',$request->order_detail_id)->update([
                'is_return'=>0
            ]);
            return redirect()->back()->withSuccess('Dəyişiklik Edildi ');

        }
    }
}
