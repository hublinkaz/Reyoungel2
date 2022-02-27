<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function manager_warehouse($id){
        $products=Product::all();
        $managers=Warehouse::where('manager_id',$id)->get();


        foreach($products as $product){
            $product->qty=0;

            foreach($managers as $manager){
                if($manager->product_id === $product->id){
                    $product->qty=$manager->qty;
                    $product->created_at=$manager->created_at;
                }

            }

        }
        return view('admin.manager.warehouse',compact('products'));
    }
}
