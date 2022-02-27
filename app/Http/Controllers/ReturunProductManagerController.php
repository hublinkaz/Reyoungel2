<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ReturunProductQuery;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class ReturunProductManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index()
    {
        $returns=ReturunProductQuery::join('products', 'products.id','=','product_id')->join('users', 'users.id','=','manager_id')
            ->Select('first_name', 'last_name','products.name_az as name_az','manager_return.qty as qty','manager_return.id as id','manager_id','product_id')
            ->get();
        return view('admin.manager.return',compact('returns'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        ReturunProductQuery::create([
          'product_id'=>$request->product_id,
          'manager_id'=>$request->manager_id,
          'qty'=>$request->qty,
            ]);
        return back()->with('success', 'Yeni Dəyər Əlavə Edildi');

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



    public function update(Request $request)
    {
        if($request->value==1){
            $qty=Product::where('id',$request->product_id)->first()->qty;


            $warehouseqty=Warehouse::where('manager_id',$request->manager_id)->where('product_id',$request->product_id)->first()->qty;



            Warehouse::where('manager_id',$request->manager_id)->where('product_id',$request->product_id)->update([
                'qty' => $warehouseqty-$request->qty
            ]);
            Product::where('id',$request->product_id)->update([
                'qty' => $qty+$request->qty
            ]);
            ReturunProductQuery::where('manager_id',$request->manager_id)->where('product_id',$request->product_id)->delete();


            return back()->with('success', 'Yeni Dəyər Əlavə Edildi');

        }
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
