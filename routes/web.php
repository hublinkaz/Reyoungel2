<?php

use App\Exports\ManagerPaymentHistory;
use App\Models\Banner;
use App\Models\DoctorPayments;
use App\Models\Doctors;
use App\Models\ManagerPayment;
use App\Models\Orders;
use App\Models\Permission;
use App\Models\Product;
use App\Models\Role;
use App\Models\Warehouse;
use App\Models\WarehouseQuery;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;
use Telegram\Bot\Laravel\Facades\Telegram;

Route::post('/42yUojv1YQPOssPEpn5i3q6vjdhh7hl7djVWDIAVhFDRMAwZ1tj0Og2v4PWyj4PZ/webhook', function () {
    $update = Telegram::commandsHandler(true);
});
Route::get('/cron_paid',function(){

$paids=DB::select("SELECT Sum(paid) as paid,manager_id,percentage_value from doctors_payments
    join order_details on doctors_payments.order_detail_id = order_details.id
    join products on order_details.product_id = products.id
    join orders on order_details.order_id = orders.id
    left join users on orders.doctor_id = users.id
where is_gift=0 and doctors_payments.created_at =CURRENT_DATE
group by order_details.id");

    foreach ($paids as $paid){
        \App\Models\ManagerPaid::create([
            'amount'=>$paid->paid,
            'percent'=>($paid->paid*$paid->percentage_value)/100,
            'status'=>0,
            'manager_id'=>$paid->manager_id,
        ]);
    }

});
Route::get('/', [\App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/blogs', [\App\Http\Controllers\HomeController::class, 'blogs'])->name('index.blogs');
Route::get('/blog/{id}', [\App\Http\Controllers\HomeController::class, 'blog'])->name('index.blog');
Route::get('/map', [\App\Http\Controllers\HomeController::class, 'map'])->name('map');
Route::get('/about', [\App\Http\Controllers\HomeController::class, 'about'])->name('about');

Route::get('/cart', [\App\Http\Controllers\HomeController::class, 'cart'])->name('cart');
Route::get('/private', function(){return view('frontend.private');})->name('private');
Route::get('/contact', function (){
    return view('frontend.contact');
})->name('contact');
Route::get('/doctors', [\App\Http\Controllers\HomeController::class, 'doctors'])->name('doctors');
Route::get('/doctor/{id}', [\App\Http\Controllers\HomeController::class, 'doctor'])->name('doctor');
Route::get('/product/{id}', [\App\Http\Controllers\HomeController::class, 'detail'])->name('cart');
Route::post('/location', [\App\Http\Controllers\AccountController::class, 'location'])->name('location');
Route::get('/password', [\App\Http\Controllers\AccountController::class, 'password'])->name('password-reset');
Route::post('/password/edit', [\App\Http\Controllers\AccountController::class, 'rpassword'])->name('password.reset');


Route::get('/test',function(){

//    $users=\App\Models\User::whereMonth('birth_date', '=', \Illuminate\Support\Carbon::now()->format('m'))->whereDay('birth_date', '=', \Illuminate\Support\Carbon::now()->addDay()->format('d'))->join('roles','roles.id','=','users.role_id')->get();
////    foreach(\App\Models\User::where('role_id','1')->get() as $admin){
////        foreach($users as $user){
////
////            Telegram::sendMessage([
////                'chat_id' => $admin->telegram_user_id,
////                'text' => '🎉🎉🎉🎉🎉🎉🎉🎉🎉🎉🎉
////         Sabah sizin '.$user->name.' olan :
////              '.$user->first_name.' '.$user->last_name.'
////             Doğum günüdür .
////             Tell: '.$user->phone
////            ]);
////        }
////
////    }
///
///
///
echo $check_warhouse=WarehouseQuery::where('manager_id',4)->where('product_id',2)->count();

});



Route::group(['middleware' => 'auth'], function() {
        Route::group(['middleware' => 'doctor:5'], function() {
            Route::prefix('doctor-panel')->group( function () {

                Route::get('/', [\App\Http\Controllers\HomeController::class, 'doctor_dashboard'])->name('doctor.dashboard');
                Route::get('deposit', [\App\Http\Controllers\DoctorsController::class, 'deposit'])->name('doctor.doctor.deposit');
                Route::get('orders', [\App\Http\Controllers\DoctorsController::class, 'orders_doctor'])->name('doctor.doctor.orders');
    //            Route::get('deposit/{doctor_id}/{product_id}', [\App\Http\Controllers\DoctorsController::class, 'deposit_products'])->name('doctor.doctor.deposit');
                Route::get('create', [\App\Http\Controllers\DoctorsController::class, 'create'])->name('doctor.doctor.create');
                Route::get('gifts', [\App\Http\Controllers\DoctorsController::class, 'gifts'])->name('doctor.gifts');
    //        Route::post('/doctor/create/post', [\App\Http\Controllers\DoctorsController::class,'store'])->name('doctor.store');
                Route::delete('delete/{product}', [\App\Http\Controllers\DoctorsController::class, 'destroy'])->name('doctor.doctor.delete');
                Route::get('profile', [\App\Http\Controllers\DoctorsController::class, 'profile'])->name('doctor.doctor.profile');
                Route::get('edit/{id}', [\App\Http\Controllers\DoctorsController::class, 'edit'])->name('doctor.doctor.edit');
                Route::get('edit/password/{id}', [\App\Http\Controllers\DoctorsController::class, 'password'])->name('doctor.doctor.password');

                Route::get('/orders/detail/{id}', [\App\Http\Controllers\DoctorsController::class, 'order_detail'])->name('doctor.detail');

                Route::post('/return/post/{id}', [\App\Http\Controllers\ReturnsController::class, 'post'])->name('doctor.return.post');


            });

        });

        Route::group(['middleware' => 'manager:2'], function() {
            Route::prefix('manager-panel')->group( function () {
                Route::post('/create/doctor', [\App\Http\Controllers\AccountController::class, 'cretate_doctor'])->name('manager.create.doctor.update');

                Route::get('/manager/report/doctor/', [\App\Http\Controllers\ManagerReportController::class, 'doctor'])->name('manager.report.doctor');
                Route::post('/manager/report/doctor/show', [\App\Http\Controllers\ManagerReportController::class, 'doctor_post'])->name('manager.report.doctor.post');

                Route::get('/manager/report/product/', [\App\Http\Controllers\ManagerReportController::class, 'product'])->name('manager.report.product');
                Route::post('/manager/report/product/show', [\App\Http\Controllers\ManagerReportController::class, 'product_post'])->name('manager.report.product.post');

                Route::get('/order/invoice/{id}', [\App\Http\Controllers\OrdersController::class, 'invoice_create'])->name('manager.order.invoice');



                Route::get('/manager/report/deposit/', [\App\Http\Controllers\ManagerReportController::class, 'deposit'])->name('manager.report.deposit');
                Route::post('/manager/report/deposit/show', [\App\Http\Controllers\ManagerReportController::class, 'deposit_post'])->name('manager.report.deposit.post');


                Route::get('/manager/deposit_detail/{id}', [\App\Http\Controllers\ManagersController::class, 'manager_manager_deposit_detail'])->name('manager.manager.deposit.detail');


                Route::get('/', [\App\Http\Controllers\HomeController::class, 'manager_dashboard'])->name('manager.dashboard');
                Route::get('create', [\App\Http\Controllers\ManagersController::class, 'create'])->name('manager.create');
                Route::get('gifts', [\App\Http\Controllers\ManagersController::class, 'gifts'])->name('manager.gifts');
                Route::get('/gift/create', [\App\Http\Controllers\ManagersController::class, 'gift_create'])->name('manager.gift.create');
                Route::post('/gift/post', [\App\Http\Controllers\GiftController::class, 'post'])->name('manager.gift.post');


    //            Route::get('warehouse', [\App\Http\Controllers\ManagersController::class, 'warehouse'])->name('manager.warehouse');
                Route::get('warehouse/add', [\App\Http\Controllers\ManagersController::class, 'add'])->name('manager.warehouse.add');
                Route::get('edit/{id}', [\App\Http\Controllers\ManagersController::class, 'edit'])->name('manager.edit');
                Route::get('orders', [\App\Http\Controllers\ManagersController::class, 'orders'])->name('manager.orders');
                Route::get('doctors', [\App\Http\Controllers\ManagersController::class, 'doctors'])->name('manager.doctors');
                Route::get('doctor/create', [\App\Http\Controllers\ManagersController::class, 'doctor_create'])->name('manager.doctor.create');
                Route::get('orders/create', [\App\Http\Controllers\ManagersController::class, 'create_order'])->name('manager.order.create');
                Route::post('create/post', [\App\Http\Controllers\ManagersController::class, 'store'])->name('manager.store');
                Route::post('query/post', [\App\Http\Controllers\ManagersController::class, 'post_query'])->name('query.post');
                Route::get('checkout', [\App\Http\Controllers\ManagersController::class, 'manager_checkout'])->name('manager.manager.checkout');
                Route::get('query', [\App\Http\Controllers\ManagersController::class, 'product_query'])->name('manager.query');
                Route::get('query/{id}', [\App\Http\Controllers\ManagersController::class, 'update_query'])->name('manager.query.edit');


                Route::post('warehouse/post/{id}', [\App\Http\Controllers\ReturunProductManagerController::class, 'store'])->name('warehouse.return');



                Route::get('/order/checkout', [\App\Http\Controllers\OrdersController::class, 'checkout_manager'])->name('manager.doctor.checkout');

                Route::get('percent', [\App\Http\Controllers\ManagersController::class, 'manager_percent_manager'])->name('manager.payment.percent');

                Route::get('profile', [\App\Http\Controllers\ManagersController::class, 'profile'])->name('manager.manager.profile');
                Route::get('deposit', [\App\Http\Controllers\ManagersController::class, 'deposit'])->name('manager.manager.deposit');
                Route::get('all', [\App\Http\Controllers\ManagersController::class, 'all_deposits'])->name('manager.manager.all_deposits');
                Route::get('warehouse', [\App\Http\Controllers\ManagersController::class, 'warehouse'])->name('manager.manager.warehouse');
                Route::get('paid/{id}', [\App\Http\Controllers\ManagersController::class, 'paid'])->name('manager.paid');
                Route::get('/orders/detail/{id}', [\App\Http\Controllers\ManagersController::class, 'order_details'])->name('manager.order.detail');
                Route::get('/doctor/deposit/{id}', [\App\Http\Controllers\ManagersController::class, 'doctor_deposit'])->name('manager.doctor.deposit');
                Route::get('/doctor/orders/{id}', [\App\Http\Controllers\ManagersController::class, 'doctor_order'])->name('manager.doctor.orders');
                Route::get('/doctor/{id}', [\App\Http\Controllers\ManagersController::class, 'doctor_list'])->name('manager.doctor.profile');
                Route::post('/payment/create/post/{id}', [\App\Http\Controllers\PaymentsController::class, 'store'])->name('manager.payment.store');

                Route::post('/return/post/{id}', [\App\Http\Controllers\ReturnsController::class, 'post'])->name('manager.return.post');

                Route::get('/export/{id}', function ($id) {

                    return Excel::download(new ManagerPaymentHistory($id), 'çıxarış.xlsx');

                });


                Route::get('/pdf/create/{id}', [\App\Http\Controllers\PdfController::class, 'index'])->name('manager.pdf.create');
                Route::post('/pdf/post', [\App\Http\Controllers\PdfController::class, 'create'])->name('manager.pdf.post');


            });

        });

        Route::group(['middleware' => 'staff:3'], function() {
            Route::prefix('staff-panel')->group( function () {
                Route::get('/', [\App\Http\Controllers\HomeController::class, 'staff_dashboard'])->name('staff.dashboard');
                Route::post('/create/manager', [\App\Http\Controllers\AccountController::class, 'cretate_manager'])->name('staff.create.manager.update');
                Route::post('/create/doctor', [\App\Http\Controllers\AccountController::class, 'cretate_doctor'])->name('staff.create.doctor.update');
                Route::post('/create/staff', [\App\Http\Controllers\AccountController::class, 'cretate_staff'])->name('staff.create.staff.update');
                Route::post('/create/driver', [\App\Http\Controllers\AccountController::class, 'cretate_driver'])->name('staff.create.driver.update');
    //            -------------------------------------- Məhsullar Başlanğıc ------------------------------
                Route::get('/products', [\App\Http\Controllers\ProductsController::class, 'index'])->name('staff.products');
                Route::get('/product/create', [\App\Http\Controllers\ProductsController::class, 'create'])->name('staff.product.create');
                Route::get('/product/edit/{id}', [\App\Http\Controllers\ProductsController::class, 'edit'])->name('staff.product.edit');
                Route::post('/product/create/post', [\App\Http\Controllers\ProductsController::class, 'store'])->name('staff.products.store');
                Route::post('/product/update/{id}', [\App\Http\Controllers\ProductsController::class, 'update'])->name('staff.product.update');
    //            -------------------------------------- Məhsullar Bitiş ------------------------------

    //            -------------------------------------- Hədiyyələr Başlanğıc ------------------------------

                Route::get('/gifts', [\App\Http\Controllers\GiftController::class, 'index'])->name('staff.gifts');
                Route::get('/gift/create', [\App\Http\Controllers\GiftController::class, 'create'])->name('staff.gift.create');
                Route::post('/gift/post', [\App\Http\Controllers\GiftController::class, 'post'])->name('staff.gift.post');
    //            -------------------------------------- Hədiyyələr Bitiş ------------------------------


    //            -------------------------------------- Sifariş Başlanğıc ------------------------------
                Route::get('/orders', [\App\Http\Controllers\OrdersController::class, 'index'])->name('staff.orders');
                Route::get('/orders/detail/{id}', [\App\Http\Controllers\OrdersController::class, 'detail'])->name('staff.detail');
                Route::get('/order/create', [\App\Http\Controllers\OrdersController::class, 'create'])->name('staff.order.create');
                Route::get('/order/edit', [\App\Http\Controllers\OrdersController::class, 'edit'])->name('staff.order.edit');
                Route::post('/order/create/post', [\App\Http\Controllers\OrdersController::class, 'store'])->name('staff.order.store');
                Route::delete('/order/delete/{product}', [\App\Http\Controllers\OrdersController::class, 'destroy'])->name('staff.order.delete');

                Route::get('/order/checkout', [\App\Http\Controllers\OrdersController::class, 'checkout'])->name('staff.checkout');
                Route::post('/order/status/{id}', [\App\Http\Controllers\OrdersController::class, 'update'])->name('staff.order.status');


                Route::get('/order/driver/{id}', [\App\Http\Controllers\OrdersController::class, 'driver'])->name('staff.order.driver');
                Route::post('/order/driver/post', [\App\Http\Controllers\OrdersController::class, 'driver_post'])->name('staff.order.driver.post');
    //            -------------------------------------- Sifariş Bitiş ------------------------------

    //            -------------------------------------- Həkimlər Başlanğıc ------------------------------
                Route::get('/doctors', [\App\Http\Controllers\DoctorsController::class, 'index'])->name('staff.doctors');
                Route::get('/doctor/deposit/{id}', [\App\Http\Controllers\DoctorsController::class, 'deposit'])->name('staff.doctor.deposit');
                Route::get('/doctor/orders/{id}', [\App\Http\Controllers\DoctorsController::class, 'orders'])->name('staff.doctor.orders');
                Route::get('/doctor/deposit/{doctor_id}/{product_id}', [\App\Http\Controllers\DoctorsController::class, 'deposit_products'])->name('staff.doctor.deposit');
                Route::get('/doctor/create', [\App\Http\Controllers\DoctorsController::class, 'create'])->name('staff.doctor.create');
    //        Route::post('/doctor/create/post', [\App\Http\Controllers\DoctorsController::class,'store'])->name('doctor.store');
                Route::delete('/doctor/delete/{product}', [\App\Http\Controllers\DoctorsController::class, 'destroy'])->name('staff.doctor.delete');
                Route::get('/doctor/{id}', [\App\Http\Controllers\DoctorsController::class, 'show'])->name('staff.doctor.profile');
                Route::get('/doctor/edit/{id}', [\App\Http\Controllers\DoctorsController::class, 'edit'])->name('staff.doctor.edit');
                Route::get('/doctor/edit/password/{id}', [\App\Http\Controllers\DoctorsController::class, 'password'])->name('staff.doctor.password');
    //            -------------------------------------- Həkimlər Bitiş ------------------------------


    //            -------------------------------------- Menecerlər Başlanğıc ------------------------------
                Route::get('/managers', [\App\Http\Controllers\ManagersController::class, 'index'])->name('staff.managers');
                Route::get('/manager/create', [\App\Http\Controllers\ManagersController::class, 'create'])->name('staff.manager.create');
                Route::get('/manager/warehouse/add', [\App\Http\Controllers\ManagersController::class, 'add'])->name('staff.manager.warehouse.add');
                Route::get('/manager/edit/{id}', [\App\Http\Controllers\ManagersController::class, 'edit'])->name('staff.manager.edit');
                Route::post('/manager/create/post', [\App\Http\Controllers\ManagersController::class, 'store'])->name('staff.manager.store');
                Route::post('/manager/query/post', [\App\Http\Controllers\ManagersController::class, 'post_query'])->name('staff.query.post');
                Route::get('/manager/checkout', [\App\Http\Controllers\ManagersController::class, 'checkout'])->name('staff.manager.checkout');
                Route::get('/manager/query', [\App\Http\Controllers\ManagersController::class, 'product_query'])->name('staff.manager.query');
                Route::get('/manager/query/{id}', [\App\Http\Controllers\ManagersController::class, 'update_query'])->name('staff.manager.query.edit');

                Route::delete('/manager/delete/{product}', [\App\Http\Controllers\ManagersController::class, 'destroy'])->name('staff.manager.delete');
                Route::get('/manager/{id}', [\App\Http\Controllers\ManagersController::class, 'show'])->name('staff.manager.profile');
                Route::get('/manager/deposit/{id}', [\App\Http\Controllers\ManagersController::class, 'deposit'])->name('staff.manager.deposit');
                Route::get('/manager/warehouse/{id}', [\App\Http\Controllers\AdminController::class, 'manager_warehouse'])->name('staff.manager.warehouse');
                Route::get('/manager/paid/{id}', [\App\Http\Controllers\ManagersController::class, 'paid'])->name('staff.manager.paid');
    //            -------------------------------------- Menecerlər Bitiş ------------------------------

    //            -------------------------------------- Sürücülər Başlanğıc ------------------------------
                Route::get('/drivers', [\App\Http\Controllers\DriversController::class, 'index'])->name('staff.drivers');
                Route::get('/driver/create', [\App\Http\Controllers\DriversController::class, 'create'])->name('staff.driver.create');
                Route::get('/driver/edit/{id}', [\App\Http\Controllers\DriversController::class, 'edit'])->name('staff.driver.edit');
                Route::post('/driver/create/post', [\App\Http\Controllers\DriversController::class, 'store'])->name('staff.driver.store');
                Route::delete('/driver/delete/{product}', [\App\Http\Controllers\DriversController::class, 'destroy'])->name('staff.driver.delete');
    //            -------------------------------------- Sürücülər Bitiş ------------------------------


    //            -------------------------------------- Ofis Heyyəti Başlanğıc ------------------------------





    //            -------------------------------------- Slayd Başlanğıc ------------------------------
                Route::get('/slides', [\App\Http\Controllers\SlidesController::class, 'index'])->name('staff.slides');
                Route::get('/slide/create', [\App\Http\Controllers\SlidesController::class, 'create'])->name('staff.slide.create');
                Route::get('/slide/edit/{id}', [\App\Http\Controllers\SlidesController::class, 'edit'])->name('staff.slide.edit');
                Route::post('/slide/create/post', [\App\Http\Controllers\SlidesController::class, 'store'])->name('staff.slide.store');
                Route::delete('/slider/delete/{slide}', [\App\Http\Controllers\SlidesController::class, 'destroy'])->name('staff.slide.delete');
                Route::post('/slide/update', [\App\Http\Controllers\SlidesController::class, 'update'])->name('staff.slide.update');
    //            -------------------------------------- Slayd Bitiş ------------------------------



    //            -------------------------------------- Hesab Baışlanğıc ------------------------------
                Route::get('/account', [\App\Http\Controllers\AccountController::class, 'index'])->name('staff.account');
    //            Route::get('/slide/create', [\App\Http\Controllers\SlidesController::class, 'create'])->name('slide.create');
    //            Route::get('/account/edit/{id}', [\App\Http\Controllers\AccountController::class, 'edit'])->name('staff.account.edit');
                Route::post('/account/edit', [\App\Http\Controllers\AccountController::class, 'store'])->name('staff.account.store');
                Route::post('/password/edit', [\App\Http\Controllers\AccountController::class, 'rpassword'])->name('staff.password.reset');
    //            -------------------------------------- Hesab Bitiş ------------------------------



    //            -------------------------------------- Ayarlar Başlanğıc ------------------------------
                Route::get('/settings/doctors', [\App\Http\Controllers\FrontDoctorsController::class, 'index'])->name('staff.front.doctors');
                Route::get('/settings/doctor/create', [\App\Http\Controllers\FrontDoctorsController::class, 'create'])->name('staff.front.doctors.create');
                Route::get('/settings/doctor/edit/{id}', [\App\Http\Controllers\FrontDoctorsController::class, 'edit'])->name('staff.front.doctors.edit');
                Route::post('/settings/doctor/create/post', [\App\Http\Controllers\FrontDoctorsController::class, 'store'])->name('staff.front.doctors.store');
                Route::delete('/settings/doctor/delete/{id}', [\App\Http\Controllers\FrontDoctorsController::class, 'destroy'])->name('staff.front.doctors.delete');
                Route::post('/settings/doctor/update', [\App\Http\Controllers\FrontDoctorsController::class, 'update'])->name('staff.front.doctors.update');
                Route::get('/settings/banners', function (){
                    $banners=Banner::all();
                    return view('staff.settings.banners',compact('banners'));
                })->name('staff.banners');


                Route::get('/settings/banner/edit/{id}', [\App\Http\Controllers\FrontDoctorsController::class, 'banner_edit'])->name('staff.front.banner.edit');
                Route::post('/settings/banner/update', [\App\Http\Controllers\FrontDoctorsController::class, 'banner'])->name('staff.front.banner.update');

    //            -------------------------------------- Ayarlar Bitiş ------------------------------


    //            -------------------------------------- Anbar Başlanğıc ------------------------------
                Route::get('/warehouse', [\App\Http\Controllers\HomeController::class, 'warehouse'])->name('staff.warehouse');
                Route::get('/warehouse/manager', [\App\Http\Controllers\HomeController::class, 'manager_warehouse'])->name('staff.warehouse.managers');
                Route::get('/warehouse/doctor', [\App\Http\Controllers\HomeController::class, 'doctor_warehouse'])->name('staff.warehouse.doctors');
    //            -------------------------------------- Anbar Bitiş ------------------------------

    //            -------------------------------------- Geri Qaytarma Başlanğıc ------------------------------

                Route::get('/returns', [\App\Http\Controllers\ReturnsController::class, 'return_query'])->name('staff.returns');
                Route::get('/return/create', [\App\Http\Controllers\ReturnsController::class, 'create'])->name('staff.return.create');
                Route::post('/return/post/{id}', [\App\Http\Controllers\ReturnsController::class, 'post'])->name('staff.return.post');
                Route::post('/return/post-query', [\App\Http\Controllers\ReturnsController::class, 'return_query_post'])->name('staff.return.post.query');

                Route::delete('/blog/delete/{id}', [\App\Http\Controllers\BlogController::class, 'destroy'])->name('staff.blog.delete');

                Route::get('/blog/create', [\App\Http\Controllers\BlogController::class, 'create'])->name('staff.blog.create');
                Route::get('/blog/edit/{id}', [\App\Http\Controllers\BlogController::class, 'edit'])->name('staff.blog.edit');
                Route::get('/blogs', [\App\Http\Controllers\BlogController::class, 'index'])->name('staff.blogs');

                Route::post('/blog/create/post', [\App\Http\Controllers\BlogController::class, 'store'])->name('staff.blog.store');
                Route::post('/blog/update/{id}', [\App\Http\Controllers\BlogController::class, 'update'])->name('staff.blog.update');

    //            -------------------------------------- Geri Qaytarma Bitiş ------------------------------


    //            -------------------------------------- PDF Başlanğıc ------------------------------
                Route::get('/pdf/create/{id}', [\App\Http\Controllers\PdfController::class, 'staff.index'])->name('pdf.create');
                Route::post('/pdf/post', [\App\Http\Controllers\PdfController::class, 'staff.create'])->name('pdf.post');
    //            -------------------------------------- PDF Bitiş ------------------------------

                Route::get('/invoices', [\App\Http\Controllers\InvoicesController::class, 'index'])->name('staff.invoices');
                Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('staff.settings');
                Route::get('/messages', [\App\Http\Controllers\MessagesController::class, 'index'])->name('staff.messages');

            });

        });



            Route::group(['middleware' => 'admin:1'], function() {
                Route::prefix('admin-panel')->group( function () {



                    Route::post('/create/manager', [\App\Http\Controllers\AccountController::class, 'cretate_manager'])->name('create.manager.update');
                    Route::post('/create/doctor', [\App\Http\Controllers\AccountController::class, 'cretate_doctor'])->name('create.doctor.update');
                    Route::post('/create/staff', [\App\Http\Controllers\AccountController::class, 'cretate_staff'])->name('create.staff.update');
                    Route::post('/create/driver', [\App\Http\Controllers\AccountController::class, 'cretate_driver'])->name('create.driver.update');



                    Route::get('/', [\App\Http\Controllers\HomeController::class, 'admin_dashboard'])->name('admin.dashboard');

        //            -------------------------------------- Məhsullar Başlanğıc ------------------------------
                    Route::get('/products', [\App\Http\Controllers\ProductsController::class, 'index'])->name('products');
                    Route::get('/product/create', [\App\Http\Controllers\ProductsController::class, 'create'])->name('product.create');
                    Route::get('/product/edit/{id}', [\App\Http\Controllers\ProductsController::class, 'edit'])->name('product.edit');
                    Route::post('/product/create/post', [\App\Http\Controllers\ProductsController::class, 'store'])->name('products.store');
                    Route::post('/product/update/{id}', [\App\Http\Controllers\ProductsController::class, 'update'])->name('product.update');
        //            -------------------------------------- Məhsullar Bitiş ------------------------------

        //            -------------------------------------- Hədiyyələr Başlanğıc ------------------------------

                    Route::get('/gifts', [\App\Http\Controllers\GiftController::class, 'index'])->name('gifts');
                    Route::get('/gift/create', [\App\Http\Controllers\GiftController::class, 'create'])->name('gift.create');
                    Route::post('/gift/post', [\App\Http\Controllers\GiftController::class, 'post'])->name('gift.post');

                    Route::get('/gift/query', [\App\Http\Controllers\GiftController::class, 'gift_query'])->name('gift.query');
                    Route::post('/gift/query/post', [\App\Http\Controllers\GiftController::class, 'gift_query_post'])->name('gift.query.post');


                    //            -------------------------------------- Hədiyyələr Bitiş ------------------------------


        //            -------------------------------------- Sifariş Başlanğıc ------------------------------
                    Route::get('/orders', [\App\Http\Controllers\OrdersController::class, 'index'])->name('orders');
                    Route::get('/orders/detail/{id}', [\App\Http\Controllers\OrdersController::class, 'detail'])->name('detail');
                    Route::get('/order/create', [\App\Http\Controllers\OrdersController::class, 'create'])->name('order.create');
                    Route::get('/order/edit', [\App\Http\Controllers\OrdersController::class, 'edit'])->name('order.edit');
                    Route::post('/order/create/post', [\App\Http\Controllers\OrdersController::class, 'store'])->name('order.store');
                    Route::delete('/order/delete/{product}', [\App\Http\Controllers\OrdersController::class, 'destroy'])->name('order.delete');

                    Route::get('/order/checkout', [\App\Http\Controllers\OrdersController::class, 'checkout'])->name('checkout');
                    Route::post('/order/status/{id}', [\App\Http\Controllers\OrdersController::class, 'update'])->name('order.status');


                    Route::get('/order/driver/{id}', [\App\Http\Controllers\OrdersController::class, 'driver'])->name('order.driver');
                    Route::post('/order/driver/post', [\App\Http\Controllers\OrdersController::class, 'driver_post'])->name('order.driver.post');
        //            -------------------------------------- Sifariş Bitiş ------------------------------

        //            -------------------------------------- Həkimlər Başlanğıc ------------------------------
                    Route::get('/doctors', [\App\Http\Controllers\DoctorsController::class, 'index'])->name('doctors');
                    Route::get('/doctor/deposit/{id}', [\App\Http\Controllers\DoctorsController::class, 'admin_doctor_deposit'])->name('doctor.deposit');
                    Route::get('/doctor/orders/{id}', [\App\Http\Controllers\DoctorsController::class, 'orders'])->name('doctor.orders');
                    Route::get('/doctor/deposit/{doctor_id}/{product_id}', [\App\Http\Controllers\DoctorsController::class, 'deposit_products'])->name('doctor.deposit');
                    Route::get('/doctor/create', [\App\Http\Controllers\DoctorsController::class, 'create'])->name('doctor.create');
        //        Route::post('/doctor/create/post', [\App\Http\Controllers\DoctorsController::class,'store'])->name('doctor.store');
                    Route::delete('/doctor/delete/{product}', [\App\Http\Controllers\DoctorsController::class, 'destroy'])->name('doctor.delete');
                    Route::get('/doctor/{id}', [\App\Http\Controllers\DoctorsController::class, 'show'])->name('doctor.profile');
                    Route::get('/doctor/edit/{id}', [\App\Http\Controllers\DoctorsController::class, 'edit'])->name('doctor.edit');
                    Route::get('/doctor/edit/password/{id}', [\App\Http\Controllers\DoctorsController::class, 'password'])->name('doctor.password');
        //            -------------------------------------- Həkimlər Bitiş ------------------------------


        //            -------------------------------------- Menecerlər Başlanğıc ------------------------------
                    Route::get('/managers', [\App\Http\Controllers\ManagersController::class, 'index'])->name('managers');
                    Route::get('/manager/create', [\App\Http\Controllers\ManagersController::class, 'create'])->name('manager.create');
                    Route::get('/manager/warehouse/add', [\App\Http\Controllers\ManagersController::class, 'add'])->name('manager.warehouse.add');
                    Route::get('/manager/edit/{id}', [\App\Http\Controllers\ManagersController::class, 'edit'])->name('manager.edit');
                    Route::post('/manager/create/post', [\App\Http\Controllers\ManagersController::class, 'store'])->name('manager.store');
                    Route::post('/manager/query/post', [\App\Http\Controllers\ManagersController::class, 'post_query'])->name('query.post');
                    Route::get('/manager/checkout', [\App\Http\Controllers\ManagersController::class, 'checkout'])->name('manager.checkout');
                    Route::get('/manager/query', [\App\Http\Controllers\ManagersController::class, 'product_query'])->name('manager.query');
                    Route::get('/manager/query/{id}', [\App\Http\Controllers\ManagersController::class, 'update_query'])->name('manager.query.edit');

                    Route::delete('/manager/delete/{product}', [\App\Http\Controllers\ManagersController::class, 'destroy'])->name('manager.delete');
                    Route::get('/manager/{id}', [\App\Http\Controllers\ManagersController::class, 'show'])->name('manager.profile');
                    Route::get('/manager/deposit/{id}', [\App\Http\Controllers\ManagersController::class, 'admin_manager_deposit'])->name('manager.deposit');
                    Route::get('/manager/all_warehouse/{id}', [\App\Http\Controllers\ManagersController::class, 'all_warehouse'])->name('manager.deposit.all');
                    Route::get('/manager/deposit_detail/{product_id}/{manager_id}', [\App\Http\Controllers\ManagersController::class, 'admin_manager_deposit_detail'])->name('manager.deposit.detail');
                    Route::get('/manager/warehouse/{id}', [\App\Http\Controllers\AdminController::class, 'manager_warehouse'])->name('manager.warehouse');
                    Route::get('/manager/paid/{id}', [\App\Http\Controllers\ManagersController::class, 'paid'])->name('manager.paid');
        //            -------------------------------------- Menecerlər Bitiş ------------------------------

        //            -------------------------------------- Sürücülər Başlanğıc ------------------------------
                    Route::get('/drivers', [\App\Http\Controllers\DriversController::class, 'index'])->name('drivers');
                    Route::get('/driver/create', [\App\Http\Controllers\DriversController::class, 'create'])->name('driver.create');
                    Route::get('/driver/edit/{id}', [\App\Http\Controllers\DriversController::class, 'edit'])->name('driver.edit');
                    Route::post('/driver/create/post', [\App\Http\Controllers\DriversController::class, 'store'])->name('driver.store');
                    Route::delete('/driver/delete/{product}', [\App\Http\Controllers\DriversController::class, 'destroy'])->name('driver.delete');
        //            -------------------------------------- Sürücülər Bitiş ------------------------------


        //            -------------------------------------- Ofis Heyyəti Başlanğıc ------------------------------

                    Route::get('/staffes', [\App\Http\Controllers\StaffesController::class, 'index'])->name('staffes');
                    Route::get('/staff/create', [\App\Http\Controllers\StaffesController::class, 'create'])->name('staff.create');
                    Route::get('/staff/edit/{id}', [\App\Http\Controllers\StaffesController::class, 'edit'])->name('staff.edit');
                    Route::post('/staff/create/post', [\App\Http\Controllers\StaffesController::class, 'store'])->name('staff.store');
                    Route::delete('/staff/delete/{product}', [\App\Http\Controllers\StaffesController::class, 'destroy'])->name('staff.delete');
        //            -------------------------------------- Ofis Heyyəti Bitiş ------------------------------


        //            -------------------------------------- Ödənişlər Başlanğıc ------------------------------
                    Route::get('/payments', [\App\Http\Controllers\PaymentsController::class, 'index'])->name('payments');
                    Route::get('/payment/create', [\App\Http\Controllers\PaymentsController::class, 'create'])->name('payment.create');
                    Route::get('/payment/percent', [\App\Http\Controllers\ManagersController::class, 'percent_manager'])->name('payment.percent');
                    Route::get('/payment/percent/detail/{date}/{manager}', [\App\Http\Controllers\ManagersController::class, 'percent_manager_detail'])->name('payment.percent.detail');
                    Route::post('/payment/create/post', [\App\Http\Controllers\PaymentsController::class, 'store'])->name('payment.store');
                    Route::post('/payment/status/{id}', [\App\Http\Controllers\PaymentsController::class, 'update'])->name('payment.status');
        //            -------------------------------------- Ödənişlər Bitiş ------------------------------

        //            -------------------------------------- Slayd Başlanğıc ------------------------------
                    Route::get('/slides', [\App\Http\Controllers\SlidesController::class, 'index'])->name('slides');
                    Route::get('/slide/create', [\App\Http\Controllers\SlidesController::class, 'create'])->name('slide.create');
                    Route::get('/slide/edit/{id}', [\App\Http\Controllers\SlidesController::class, 'edit'])->name('slide.edit');
                    Route::post('/slide/create/post', [\App\Http\Controllers\SlidesController::class, 'store'])->name('slide.store');
                    Route::delete('/slider/delete/{slide}', [\App\Http\Controllers\SlidesController::class, 'destroy'])->name('slide.delete');
                    Route::post('/slide/update', [\App\Http\Controllers\SlidesController::class, 'update'])->name('slide.update');
        //            -------------------------------------- Slayd Bitiş ------------------------------



        //            -------------------------------------- Hesab Baışlanğıc ------------------------------
                    Route::get('/account', [\App\Http\Controllers\AccountController::class, 'index'])->name('account');
        //            Route::get('/slide/create', [\App\Http\Controllers\SlidesController::class, 'create'])->name('slide.create');
                    Route::get('/account/edit/{id}', [\App\Http\Controllers\AccountController::class, 'edit'])->name('account.edit');
                    Route::post('/account/edit', [\App\Http\Controllers\AccountController::class, 'store'])->name('account.store');
        //            -------------------------------------- Hesab Bitiş ------------------------------

                    Route::get('/order/invoice/{id}', [\App\Http\Controllers\OrdersController::class, 'invoice_create'])->name('order.invoice');


        //            -------------------------------------- Ayarlar Başlanğıc ------------------------------
                    Route::get('/settings/doctors', [\App\Http\Controllers\FrontDoctorsController::class, 'index'])->name('front.doctors');
                    Route::get('/settings/doctor/create', [\App\Http\Controllers\FrontDoctorsController::class, 'create'])->name('front.doctors.create');
                    Route::get('/settings/doctor/edit/{id}', [\App\Http\Controllers\FrontDoctorsController::class, 'edit'])->name('front.doctors.edit');
                    Route::post('/settings/doctor/create/post', [\App\Http\Controllers\FrontDoctorsController::class, 'store'])->name('front.doctors.store');
                    Route::delete('/settings/doctor/delete/{id}', [\App\Http\Controllers\FrontDoctorsController::class, 'destroy'])->name('front.doctors.delete');
                    Route::post('/settings/doctor/update', [\App\Http\Controllers\FrontDoctorsController::class, 'update'])->name('front.doctors.update');
                    Route::get('/settings/banners', function (){
                        $banners=Banner::all();
                        return view('admin.settings.banners',compact('banners'));
                    })->name('banners');


                    Route::get('/settings/banner/edit/{id}', [\App\Http\Controllers\FrontDoctorsController::class, 'banner_edit'])->name('front.banner.edit');
                    Route::post('/settings/banner/update', [\App\Http\Controllers\FrontDoctorsController::class, 'banner'])->name('front.banner.update');


                    Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
                    Route::get('/setting/create', [\App\Http\Controllers\SettingsController::class, 'create'])->name('setting.create');
                    Route::get('/setting/edit/{id}', [\App\Http\Controllers\SettingsController::class, 'edit'])->name('setting.edit');

                    Route::post('/setting/create/post', [\App\Http\Controllers\SettingsController::class, 'store'])->name('setting.create.post');
                    Route::post('/setting/edit/post', [\App\Http\Controllers\SettingsController::class, 'update'])->name('setting.edit.post');


                    Route::post('/page/create/post', [\App\Http\Controllers\PagesController::class, 'store'])->name('page.create.post');
                    Route::post('/page/edit/post/{id}', [\App\Http\Controllers\PagesController::class, 'update'])->name('page.edit.post');
                    Route::get('/page/create', [\App\Http\Controllers\PagesController::class, 'create'])->name('page.create');
                    Route::get('/page/edit/{id}', [\App\Http\Controllers\PagesController::class, 'edit'])->name('page.edit');
                    Route::get('/pages', [\App\Http\Controllers\PagesController::class, 'index'])->name('pages');




                    //            -------------------------------------- Ayarlar Bitiş ------------------------------


        //            -------------------------------------- Anbar Başlanğıc ------------------------------
                    Route::get('/warehouse', [\App\Http\Controllers\HomeController::class, 'warehouse'])->name('warehouse');
                    Route::get('/warehouse/manager', [\App\Http\Controllers\HomeController::class, 'manager_warehouse'])->name('warehouse.managers');
                    Route::get('/warehouse/doctor', [\App\Http\Controllers\HomeController::class, 'doctor_warehouse'])->name('warehouse.doctors');
        //            -------------------------------------- Anbar Bitiş ------------------------------

        //            -------------------------------------- Geri Qaytarma Başlanğıc ------------------------------

                    Route::get('/returns', [\App\Http\Controllers\ReturnsController::class, 'return_query'])->name('returns');
                    Route::get('/managers/return/product', [\App\Http\Controllers\ReturunProductManagerController::class, 'index'])->name('manager.return.product');
                    Route::post('/managers/return/update}', [\App\Http\Controllers\ReturunProductManagerController::class, 'update'])->name('manager.return.product.update');
                    Route::get('/return/create', [\App\Http\Controllers\ReturnsController::class, 'create'])->name('return.create');
                    Route::post('/return/post/{id}', [\App\Http\Controllers\ReturnsController::class, 'post'])->name('return.post');
                    Route::post('/return/post-query', [\App\Http\Controllers\ReturnsController::class, 'return_query_post'])->name('return.post.query');



        //            -------------------------------------- Geri Qaytarma Bitiş ------------------------------


//                  ------------------------------------ Hesabat ---------------------------------------

                    Route::get('/report/doctor/', [\App\Http\Controllers\ReportController::class, 'doctor'])->name('report.doctor');
                    Route::post('/report/doctor/show', [\App\Http\Controllers\ReportController::class, 'doctor_post'])->name('report.doctor.post');

                    Route::get('/report/product/', [\App\Http\Controllers\ReportController::class, 'product'])->name('report.product');
                    Route::post('/report/product/show', [\App\Http\Controllers\ReportController::class, 'product_post'])->name('report.product.post');


                    Route::get('/report/manager/', [\App\Http\Controllers\ReportController::class, 'manager'])->name('report.manager');
                    Route::post('/report/manager/show', [\App\Http\Controllers\ReportController::class, 'manager_post'])->name('report.manager.post');


                    Route::get('/report/warehouse/', [\App\Http\Controllers\ReportController::class, 'warehouse'])->name('report.warehouse');
                    Route::get('/report/doctors/', [\App\Http\Controllers\ReportController::class, 'doctors'])->name('report.doctors');


                    Route::get('/report/deposit/', [\App\Http\Controllers\ReportController::class, 'deposit'])->name('report.deposit');
                    Route::post('/report/deposit/show', [\App\Http\Controllers\ReportController::class, 'deposit_post'])->name('report.deposit.post');


                    Route::delete('/blog/delete/{id}', [\App\Http\Controllers\BlogController::class, 'destroy'])->name('blog.delete');

                    Route::get('/blog/create', [\App\Http\Controllers\BlogController::class, 'create'])->name('blog.create');
                    Route::get('/blog/edit/{id}', [\App\Http\Controllers\BlogController::class, 'edit'])->name('blog.edit');
                    Route::get('/blogs', [\App\Http\Controllers\BlogController::class, 'index'])->name('blogs');

                    Route::post('/blog/create/post', [\App\Http\Controllers\BlogController::class, 'store'])->name('blog.store');
                    Route::post('/blog/update/{id}', [\App\Http\Controllers\BlogController::class, 'update'])->name('blog.update');











//                  ------------------------------------ Hesabat ---------------------------------------










        //            -------------------------------------- PDF Başlanğıc ------------------------------
                    Route::get('/pdf/create/{id}', [\App\Http\Controllers\PdfController::class, 'index'])->name('pdf.create');
                    Route::post('/pdf/post', [\App\Http\Controllers\PdfController::class, 'create'])->name('pdf.post');
        //            -------------------------------------- PDF Bitiş ------------------------------

                    Route::get('/invoices', [\App\Http\Controllers\InvoicesController::class, 'index'])->name('invoices');



                    Route::get('/settings', [\App\Http\Controllers\SettingsController::class, 'index'])->name('settings');
                    Route::get('/messages', [\App\Http\Controllers\MessagesController::class, 'index'])->name('messages');

                    Route::get('/export/{id}', function ($id) {

                        return Excel::download(new ManagerPaymentHistory($id), 'çıxarış.xlsx');

                    });


                });

            });




        });



//Language Change
Route::get('lang/{locale}', function ($locale) {
    if (! in_array($locale, ['en', 'az', 'tr','ru'])) {
        abort(400);
    }
    Session()->put('locale', $locale);
    Session::get('locale');
    return redirect()->back();
})->name('lang');


Route::get('/clear', function() {
    Artisan::call('config:cache');
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return "Cache is cleared";
})->name('clear.cache');


Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/custom-signin', [AuthController::class, 'createSignin'])->name('signin.custom');
Route::get('/register', [AuthController::class, 'signup'])->name('register');
Route::post('/create-user', [AuthController::class, 'customSignup'])->name('user.registration');
Route::post('/create-doctor', [AuthController::class, 'doctor'])->name('doctor.registration');


//Route::get('/dashboard', [\App\Http\Controllers\HomeController::class, 'dashboard'])->name('dashboard');
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

Route::prefix('others')->group(function () {
    Route::view('400', 'errors.400')->name('error-400');
    Route::view('401', 'errors.401')->name('error-401');
    Route::view('403', 'errors.403')->name('error-403');
    Route::view('404', 'errors.404')->name('error-404');
    Route::view('500', 'errors.500')->name('error-500');
    Route::view('503', 'errors.503')->name('error-503');
});
