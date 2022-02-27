<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function index()
    {
        if(Auth::user()->role_id==1 ){
            $products = Product::all();

            return view('admin.product.index',compact('products'));
        }

        else if ( Auth::user()->role_id==3) {
            $products = Product::all();

            return view('staff.product.index',compact('products'));
        }
        else if (Auth::user()->role_id==2) {
            return redirect()->route('manager.warehouse',Auth::user()->id);
        }


    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()->role_id==1){
            return view('admin.product.create');
        }
        else if ( Auth::user()->role_id==3) {
            return view('staff.product.create');

        }
        else{
            return redirect()->route('order.create');

        }

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name_az' => 'required',
            'name_en' => 'required',
            'name_ru' => 'required',
            'name_tr' => 'required',
            'price' => 'required',
            'detail_az' => 'required',
            'detail_en' => 'required',
            'detail_ru' => 'required',
            'detail_tr' => 'required',
            'qty' => 'required',
            'image' => 'required|file|image|mimes:jpeg,jpg,png'
        ]);

            $imageName = time().'.'.$request->image->extension();


            $request->image->move(public_path('assets/images/product/'), $imageName);



            Product::create([
                'name_az' =>  $request->name_az,
                'name_en' =>  $request->name_en,
                'name_ru' =>  $request->name_ru,
                'name_tr' =>  $request->name_tr,

                'detail_az' =>  $request->detail_az,
                'detail_en' =>  $request->detail_en,
                'detail_ru' =>  $request->detail_ru,
                'detail_tr' =>  $request->detail_tr,

                'cost' =>  $request->cost,
                'qty' =>  $request->qty,
                'price' => $request->price,
                'image' => $imageName,
                'discount' => $request->discount
            ]);

            return redirect()->route('products')
                ->with('success','Product created successfully.');


    }




    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        return redirect()->route('products.index')
            ->with('success','Product created successfully.');

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        if(Auth::user()->role_id==3){
            $product=Product::where('id',$id)->first();
            return view('staff.product.edit',compact('product'));
        }
        $product=Product::where('id',$id)->first();
        return view('admin.product.edit',compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        if (is_null($request->image)) {

            $request->validate([
                'name_az' => 'required',
                'name_en' => 'required',
                'name_ru' => 'required',
                'name_tr' => 'required',
                'price' => 'required',
                'detail_az' => 'required',
                'detail_en' => 'required',
                'detail_ru' => 'required',
                'detail_tr' => 'required',
                'qty' => 'required',
                'status' => 'required'

            ]);


            $product=Product::where('id',$id)->update([
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'name_tr' => $request->name_tr,

                'detail_az' => $request->detail_az,
                'detail_en' => $request->detail_en,
                'detail_ru' => $request->detail_ru,
                'detail_tr' => $request->detail_tr,
                'qty' => $request->qty,
                'status' => $request->status,
                'price' => $request->price,
            ]);
            return redirect()->route('products')
                ->with('success', 'Product updated successfully');
        } else {
            $request->validate([
                'name_az' => 'required',
                'name_en' => 'required',
                'name_ru' => 'required',
                'name_tr' => 'required',
                'price' => 'required',
                'detail_az' => 'required',
                'detail_en' => 'required',
                'detail_ru' => 'required',
                'detail_tr' => 'required',
                'qty' => 'required',
                'status' => 'required',
                'image' => 'required|file|image|mimes:jpeg,jpg,png'
            ]);
            $imageName = time() . '.' . $request->image->extension();

            $request->image->move(public_path('assets/images/product/'), $imageName);

            $product=Product::where('id',$id)->update([
                'name_az' => $request->name_az,
                'name_en' => $request->name_en,
                'name_ru' => $request->name_ru,
                'name_tr' => $request->name_tr,

                'detail_az' => $request->detail_az,
                'detail_en' => $request->detail_en,
                'detail_ru' => $request->detail_ru,
                'detail_tr' => $request->detail_tr,
                'qty' => $request->qty,
                'status' => $request->status,

                'price' => $request->price,
                'image' => $imageName
            ]);
            return redirect()->route('products')
                ->with('success', 'Product updated successfully');
        }



    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
//        Product::destroy($request->id);
        return redirect()->route('products')
            ->with('success','Product deleted successfully');
    }
}
