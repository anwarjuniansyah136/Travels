<?php

use App\Http\Controllers\admin\AdminDashboardController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Bus_TypeController;
use App\Http\Controllers\Admin\BusTypeController;
use App\Http\Controllers\Admin\CustomerDataController;
use App\Http\Controllers\CustomerIdentity;
use App\Http\Controllers\Admin\ReservationController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\SesiController;
use App\Http\Controllers\Admin\UserController;
use App\Models\CustomerData;
use App\Http\Controllers\Admin\RegisterController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\Pelanggan\BusController;
use App\Http\Controllers\Pelanggan\ReservasiController;
use App\Http\Controllers\Pelanggan\PembayaranController;
use App\Http\Controllers\Pelanggan\TransactionsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Pelanggan\MidtranController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


// Route::get('/', function () {
//     return view('login');
// });

// GUEST ROUTES (belum login)
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SesiController::class, 'index'])->name('login');
    Route::post('/login', [SesiController::class, 'login']);
});

// AUTH ROUTES (hanya untuk user yang sudah login)
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::post('/logout', [SesiController::class, 'logout'])->name('logout');
});


Route::view('/homepagee', 'homepagee');

Route::get('/homepage', [HomeController::class, 'index']);
 
Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SesiController::class, 'index'])->name('login');
    Route::post('/login', [SesiController::class, 'login']);
});

// Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');



Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::post('/dashboard/generate-report', [DashboardController::class, 'generateReport'])->name('dashboard.generate-report');
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index']);
    Route::get('/admin/admin', [SesiController::class, 'admin'])->middleware('userAkses::admin');
    Route::get('/admin/customer', [SesiController::class, 'customer'])->middleware('userAkses::customer');;
    Route::get('/logout', [SesiController::class, 'logout'])->name('logout');
});


//Data User 
Route::post('user', [UserController::class, 'store'])->name('user');
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user/create', [UserController::class, 'create']);
Route::put('/user/update/{id}', [UserController::class, 'update']);
Route::delete('/user/delete/{id}', [UserController::class, 'destroy']);

//Data Role 
Route::post('roles', [RoleController::class, 'store'])->name('roles');
Route::get('/roles', [RoleController::class, 'index']);
Route::get('/roles/search', [RoleController::class, 'search'])->name('roles.search');
Route::get('/roles/{id}', [RoleController::class, 'show']);

Route::get('/role/create', [RoleController::class, 'create'])->name('role.create');
Route::post('/role', [RoleController::class, 'store'])->name('role.store');

Route::get('/roles/edit/{id}', [RoleController::class, 'edit'])->name('roles.edit');
Route::put('/roles/update/{id}', [RoleController::class, 'update'])->name('roles.update');
Route::delete('/roles/delete/{id}', [RoleController::class, 'destroy']);
Route::delete('/roles/force-delete/{id}', [RoleController::class, 'forceDestroy'])->name('roles.forceDelete');

//Data Customer
Route::get('/customer_data', [CustomerDataController::class, 'index']);
Route::get('/customer_data/search', [CustomerDataController::class, 'search'])->name('customer_data.search');
Route::get('/customer_data/{id}', [CustomerDataController::class, 'show']);
Route::get('/customer/create', [CustomerDataController::class, 'create'])->name('customer.create');
Route::get('/customer_data/update/{id}', [CustomerDataController::class, 'update']);
Route::get('/customer_data/delete/{id}', [CustomerDataController::class, 'destroy']);
Route::post('customer_data', [CustomerDataController::class, 'store'])->name('customer_data');
Route::post('customer', [CustomerDataController::class, 'store'])->name('customer.store');

//Data Reservasi 
Route::get('/reservation', [ReservationController::class, 'index'])->name('admin.reservation.index');
Route::get('/reservation/search', [ReservationController::class, 'search'])->name('reservation.search');
Route::get('/reservation/{id}', [ReservationController::class, 'show']);
Route::get('/reservasi/create', [ReservationController::class, 'create'])->name('reservation.create');
Route::post('/reservation', [ReservationController::class, 'store'])->name('reservation');
Route::post('/reservasi', [ReservationController::class, 'store'])->name('reservation.store');
Route::put('/reservation/update/{id}', [ReservationController::class, 'update']);
Route::delete('/reservation/delete/{id}', [ReservationController::class, 'destroy']);

Route::patch('/reservation/{id}/status', [ReservationController::class, 'updateStatus'])
    ->name('reservation.updateStatus');



Route::get('/', [BusController::class, 'index'])->name('homepage');
Route::get('/detail/{id}', [BusController::class, 'show'])->name('detail-bus');

// ✅ route reservasi
// Route::get('/reservasi', [ReservasiController::class, 'index'])->name('reservasi');


//Data Reservasi Pelanggan 
// Route::get('/reservasi', [ReservasiController::class, 'index'])->name('reservasi.index');
// Route::post('/reservasi', [ReservasiController::class, 'store'])->name('reservasi.store');

//Data Schedule
Route::get('/schedule', [ScheduleController::class, 'index']);
Route::get('/schedule/search', [ScheduleController::class, 'search'])->name('schedule.search');
Route::get('/schedule/{id}', [ScheduleController::class, 'show']);
Route::get('/jadwal/create', [ScheduleController::class, 'create'])->name('schedule.create');
Route::get('/schedule/edit/{id}', [ScheduleController::class, 'edit'])->name('schedule.edit');
Route::post('schedule', [ScheduleController::class, 'store'])->name('shedule');
Route::post('jadwal', [ScheduleController::class, 'store'])->name('schedule.store');
Route::put('/schedule/update/{id}', [ScheduleController::class, 'update']);
Route::delete('/schedule/delete/{id}', [ScheduleController::class, 'destroy']);

//Data bus_type
Route::get('/bus_type', [BusTypeController::class, 'index']);
Route::get('/bus_type/search', [BusTypeController::class, 'search'])->name('bus_type.search');
Route::get('/bus_type/{id}', [BusTypeController::class, 'show']);
Route::get('/bus/create', [BusTypeController::class, 'create'])->name('bus.create');
Route::get('/bus/edit/{id}', [BusTypeController::class, 'edit'])->name('bus.edit');
Route::get('/bus/{id}', [BusTypeController::class, 'show'])->name('bus.show');
Route::post('bus_type', [BusTypeController::class, 'store'])->name('bus_type');
Route::post('bus', [BusTypeController::class, 'store'])->name('bus.store');
Route::put('/bus_type/update/{id}', [BusTypeController::class, 'update']);
Route::delete('/bus_type/delete/{id}', [BusTypeController::class, 'destroy']);



//Detail
Route::get('/pelanggan/bus', [PelangganController::class, 'index'])->name('pelanggan.bus');
Route::get('/pelanggan/detail-bus/{id}', [PelangganController::class, 'detailBus'])->name('detail.bus');

Route::get('/', [BusController::class, 'index'])->name('homepage');
Route::get('/detail/{id}', [BusController::class, 'show'])->name('detail.bus');

//Pembayaran
Route::get('/pembayaran', [PembayaranController::class, 'index'])->name('pembayaran');



Route::get('role', function () {
    return view('role');
});

Route::get('home', function () {
    return view('home');
});

Route::get('forgot', function () {
    return view('forgot');
});

Route::get('/register', [RegisterController::class, 'registerForm'])->name('register');

Route::get('busType', function () {
    return view('busType');
});


// Pelanggan reservasi
// Route::get('/reservasi', [ReservasiController::class, 'create'])->name('pelanggan.reservation.create');
Route::middleware(['auth'])->group(function () {
    Route::get('/reservasi', [ReservasiController::class, 'create'])->name('pelanggan.reservation.create');
    Route::post('/reservasi', [ReservasiController::class, 'store'])->name('pelanggan.reservation.store');
    Route::get('/reservasi-saya', [ReservasiController::class, 'index'])->name('pelanggan.reservation.index');
    Route::get('/reservasi/{id}', [ReservasiController::class, 'show'])->name('pelanggan.reservation.show');
    Route::get('/pelanggan/reservation/transaction/{id}', [ReservasiController::class, 'transaction'])->name('pelanggan.reservation.transaction');
    Route::get('/pelanggan/reservasi/payment/{id}', [ReservasiController::class, 'pay'])->name('pelanggan.reservation.payment');
    Route::get('/pelanggan/reservasi/invoice/{id}', [ReservasiController::class, 'invoice'])->name('pelanggan.invoice');
});

Route::middleware(['auth']) -> group(function() {
    Route::get('/transaction', [TransactionsController::class, 'index'])->name('pelanggan.transaction.index');
    Route::put('/transaction/delete/{id}', [TransactionsController::class, 'delete'])->name('pelanggan.transaction.delete');
});
