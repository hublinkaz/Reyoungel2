<?php

use Illuminate\Support\Facades\DB;

//$paids=DB::select("SELECT Sum(paid) as paid,manager_id,percentage_value from doctors_payments
//    join order_details on doctors_payments.order_detail_id = order_details.id
//    join products on order_details.product_id = products.id
//    join orders on order_details.order_id = orders.id
//    left join users on orders.doctor_id = users.id
//where is_gift=0 and doctors_payments.created_at =CURRENT_DATE
//group by order_details.id");
//
//foreach ($paids as $paid){
//    \App\Models\ManagerPaid::create([
//        'amount'=>$paid->paid,
//        'percent'=>$paid->percentage_value,
//        'status'=>0,
//        'manager_id'=>$paid->manager_id,
//    ]
//);
//}
$paids=DB::select("SELECT * from users");

foreach($paids as $paid){
    echo $paid->manager_id;
}
