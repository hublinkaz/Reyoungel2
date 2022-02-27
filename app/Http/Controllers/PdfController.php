<?php

namespace App\Http\Controllers;

use App\Models\DoctorPayments;
use App\Models\Handovers;
use App\Models\Invoices;
use App\Models\Managers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade as PDF;

use Illuminate\Support\Facades\Redirect;
use Telegram\Bot\FileUpload\InputFile;
use Telegram\Bot\Laravel\Facades\Telegram;

class PdfController extends Controller
{

    public function index($id){
        if (Auth::user()->role_id==2){
            return view("manager.pdf.create",compact('id'));

        }


        $invoices=Handovers::where('manager_id',$id)->get();
       return view("admin.pdf.create",compact('invoices'));
    }



    public function create(Request $request)
    {
        if (Auth::user()->role_id==2){
            $managers = User::where('id', $request->manager_id)->first();


            $data = [
                'serila' => $request->pdf,

            ];




            $manager = [
                'name' => $managers->first_name . ' ' . $managers->last_name,
                'phone' => $managers->phone,
                'address'=>''
            ];

            $company = [
                'name' => 'Reyoungel',
                'email' => 'info@reyoungel.az',
                'phone' => '+994 55 555 55 55',
            ];


            $items = DoctorPayments::Select('doctors_payments.id as doctors_payments_id',
                'order_detail_id',
                'percentage_value',
                'order_details.id as order_detail_id',
                'order_id',
                'product_id',
                'is_gift',
                'units',
                'amount',
                'order_details.created_at as order_details_created_at',
                'is_return',
                'products.name_az as product_name_az',
                'products.name_en as product_name_en',
                'products.name_ru as product_name_ru',
                'products.name_tr as product_name_tr',
                'first_name',
                'last_name',
                'phone','qty',
                DoctorPayments::raw('sum(paid) as paid'))
                ->join('order_details','doctors_payments.order_detail_id','=','order_details.id')
                ->join('products','order_details.product_id','=','products.id')
                ->join('orders','order_details.order_id','=','orders.id')
                ->leftJoin('users','orders.doctor_id','=','users.id')
                ->where('manager_id',$request->manager_id)
                ->where('is_gift',0)
                ->whereBetween('doctors_payments.created_at',[$request->date_start,$request->date_end])
                ->groupby('order_details.id')

                ->get();

//
//        $items = DB::Select("Select SUM(paid) as paid,doctors_payments.id as doctors_payments_id,order_detail_id,percentage_value,
//       doctors_payments.created_at as doctors_payments_created_at
//        ,order_details.id as order_detail_id, order_id ,product_id,is_gift,amount,order_details.created_at as order_details_created_at,products.units as units
//       is_return,products.name as product_name , first_name,last_name,phone
//from `doctors_payments`
//         join order_details on doctors_payments.order_detail_id = order_details.id
//         join products on order_details.product_id = products.id
//         join orders on order_details.order_id = orders.id
//         join users on orders.doctor_id = users.id
//where manager_id = $request->manager_id and doctors_payments.created_at between '2021-10-02 00:00:00' and '2021-10-22 00:00:00' group by order_details.id");

            view()->share('items', $items);
            view()->share('company', $company);
            view()->share('manager', $manager);
            view()->share('data', $data);
            $pdf = PDF::loadView('manager.invoice.report_invoice', $data);


            $path = public_path('pdf_docs/doctor/'); // <--- folder to store the pdf documents into the server;
            $fileName = $request->pdf . '.' . 'pdf'; // <--giving the random filename,
            $pdf->save($path . '/' . $fileName);
            $generated_pdf_link = url('pdf_docs/doctor/' . $fileName);
//        Telegram::sendDocument([
//            'chat_id' => '815286201',
//            'document' => InputFile::create($generated_pdf_link),
//            'caption' => $user->first_name. ' ' .$user->last_name . ' Tərəfindən Sifarişiniz var!'
//        ]);
//        return response()->json($generated_pdf_link);
            return redirect::to($generated_pdf_link);
//        return redirect()->url($generated_pdf_link);

        }
        else {
            $managers = User::where('id', $request->manager_id)->first();


            $data = [
                'serila' => $request->pdf,

            ];




            $manager = [
                'name' => $managers->first_name . ' ' . $managers->last_name,
                'phone' => $managers->phone,
                'address'=>''
            ];

            $company = [
                'name' => 'Reyoungel',
                'email' => 'info@reyoungel.az',
                'phone' => '+994 55 555 55 55',
            ];


            $items = DoctorPayments::Select('doctors_payments.id as doctors_payments_id',
                'order_detail_id',
                'percentage_value',
                'order_details.id as order_detail_id',
                'order_id',
                'product_id',
                'is_gift',
                'units',
                'amount',
                'order_details.created_at as order_details_created_at',
                'is_return',
                'products.name_az as product_name_az',
                'products.name_en as product_name_en',
                'products.name_ru as product_name_ru',
                'products.name_tr as product_name_tr',
                'first_name',
                'last_name',
                'phone','qty',
                DoctorPayments::raw('sum(paid) as paid'))
                ->join('order_details','doctors_payments.order_detail_id','=','order_details.id')
                ->join('products','order_details.product_id','=','products.id')
                ->join('orders','order_details.order_id','=','orders.id')
                ->leftJoin('users','orders.doctor_id','=','users.id')
                ->where('manager_id',$request->manager_id)
                ->where('is_gift',0)
                ->whereBetween('doctors_payments.created_at',[$request->date_start,$request->date_end])
                ->groupby('order_details.id')

                ->get();

//
//        $items = DB::Select("Select SUM(paid) as paid,doctors_payments.id as doctors_payments_id,order_detail_id,percentage_value,
//       doctors_payments.created_at as doctors_payments_created_at
//        ,order_details.id as order_detail_id, order_id ,product_id,is_gift,amount,order_details.created_at as order_details_created_at,products.units as units
//       is_return,products.name as product_name , first_name,last_name,phone
//from `doctors_payments`
//         join order_details on doctors_payments.order_detail_id = order_details.id
//         join products on order_details.product_id = products.id
//         join orders on order_details.order_id = orders.id
//         join users on orders.doctor_id = users.id
//where manager_id = $request->manager_id and doctors_payments.created_at between '2021-10-02 00:00:00' and '2021-10-22 00:00:00' group by order_details.id");

            view()->share('items', $items);
            view()->share('company', $company);
            view()->share('manager', $manager);
            view()->share('data', $data);
            $pdf = PDF::loadView('admin.invoice.report_invoice', $data);


            $path = public_path('pdf_docs/doctor/'); // <--- folder to store the pdf documents into the server;
            $fileName = $request->pdf . '.' . 'pdf'; // <--giving the random filename,
            $pdf->save($path . '/' . $fileName);
            $generated_pdf_link = url('pdf_docs/doctor/' . $fileName);
//        Telegram::sendDocument([
//            'chat_id' => '815286201',
//            'document' => InputFile::create($generated_pdf_link),
//            'caption' => $user->first_name. ' ' .$user->last_name . ' Tərəfindən Sifarişiniz var!'
//        ]);
//        return response()->json($generated_pdf_link);
            return redirect::to($generated_pdf_link);
//        return redirect()->url($generated_pdf_link);

        }

    }
}
