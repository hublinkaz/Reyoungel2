<?php

namespace App\Exports;

use App\Models\Orders;
use App\Models\User;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ManagerPaymentHistory implements FromQuery,WithMapping,WithHeadings
{

    use Exportable;


    /**
     * @var int
     */
    private $manager;

    public function __construct(int $manager_id)
    {
        $this->manager_id = $manager_id;

    }


    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        $manager_id=$this->manager_id;
        return Orders::Select('users.first_name as doctor_fname',
            'users.last_name as doctor_lname',
            'users.phone as doctor_phone',
            'doctors.workplace as doctor_workplace',
            'orders.location as location',
            'products.name as product_name',
            'products.units as units',
            'order_details.amount as price',
            'order_details.created_at as order_time',
            'doctors_payments.created_at as paid_time',
            'users.id as id',
            'products.id as product_id',
            'orders.manager_id as manager_id',
            'doctors_payments.paid as paid',
            Orders::raw('count(*) as total'))
            ->join('users','users.id','=','orders.doctor_id')
            ->join('order_details','orders.id','=','order_details.order_id')
            ->join('doctors','users.id','=','doctors.user_id')
            ->join('products','order_details.product_id','=','products.id')
            ->leftJoin('doctors_payments','order_details.id','=','doctors_payments.order_detail_id')
            ->where('manager_id',3)
            ->groupby('product_id');

    }

    public function map($user): array
    {

        return [
            $user->id,
            $user->doctor_fname.' '.$user->doctor_lname,
            $user->doctor_phone,
            $user->doctor_workplace,
            $user->location,
            $user->product_name,
            $user->total.' ədəd '.$user->units,
            $user->price,
            $user->order_time,
            $user->paid_time,
            $user->paid ,

        ];

    }

    public function headings(): array
    {
        return [
            'iD',
            'Həkimin Adı',
            'Əlaqə No	',
            'İş Yeri Adı',
            'Ərazi',
            'Məhsulun Adı',
            'Məhsulun Sayı,Ölçüsü',
            'Qiymət',
            'Depozit Tarixi',
            'Ödəniş Tarixi',
            'Ödədi',

        ];
    }
}
