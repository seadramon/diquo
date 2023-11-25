<?php

use App\Http\Controllers\Master\ArmadaController;
use App\Http\Controllers\Master\DriverController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Sp3Controller;
use App\Http\Controllers\SpmController;
use App\Http\Controllers\SppController;
use App\Http\Controllers\SppApprovalController;
use App\Http\Controllers\SptbController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\KalenderPengirimanController;
use App\Http\Controllers\MasterDriverController;
use App\Http\Controllers\MasterArmadaController;
use App\Http\Controllers\PdaController;
use App\Http\Controllers\PricelistAngkutanController;
use App\Http\Controllers\Report\PemenuhanArmadaController;
use App\Http\Controllers\Verifikasi\ArmadaController as VerifikasiArmadaController;
use App\Http\Controllers\LoginVendorController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\PermintaanPenawaranController;
use App\Http\Controllers\Report\EvaluasiVendorController;
use App\Http\Controllers\Report\MonitoringDistribusiController;
use App\Http\Middleware\EnsureSessionIsValid;

use App\Http\Controllers\PenawaranController;
use App\Http\Controllers\UsersController;

use App\Models\User;


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

Route::middleware('auth')->group(function () {

	Route::get('/', function () {
		// dd(session()->all());
		return redirect()->route('penawaran.index');
	});
	
	
	Route::group(['prefix' => '/penawaran', 'as' => 'penawaran.'], function(){
		Route::get('/', [PenawaranController::class, 'index'])->name('index');
		Route::get('/data', [PenawaranController::class, 'data'])->name('data');
		Route::get('create', [PenawaranController::class, 'create'])->name('create');
		Route::get('search-produk', [PenawaranController::class, 'getProduk'])->name('search-produk');
		Route::get('harsat', [PenawaranController::class, 'getHarsat'])->name('harsat');
		Route::get('harga', [PenawaranController::class, 'getHarga'])->name('harga');
		Route::get('show/{id}', [PenawaranController::class, 'show'])->name('show');
		Route::get('/print/{id}', [PenawaranController::class, 'cetak'])->name('print');
		Route::get('/nego/{id}', [PenawaranController::class, 'nego'])->name('nego');
	
		Route::post('store', [PenawaranController::class, 'store'])->name('store');
		Route::post('store-nego', [PenawaranController::class, 'storeNego'])->name('store-nego');
	});
	
	Route::group(['prefix' => '/permintaan-penawaran', 'as' => 'permintaan-penawaran.'], function(){
		Route::post('/destroy', [PermintaanPenawaranController::class, 'destroy'])->name('destroy');
		Route::get('/data', [PermintaanPenawaranController::class, 'data'])->name('data');
		Route::resource('/',  PermintaanPenawaranController::class)->except([
			'show', 'destroy', 'edit'
		])->parameters(['' => 'permintaan-penawaran']);
	});

	Route::group(['prefix' => '/user', 'as' => 'user.'], function(){
		Route::post('/destroy', [UsersController::class, 'destroy'])->name('destroy');
		Route::get('/data', [UsersController::class, 'data'])->name('data');
		Route::get('search-employee', [UsersController::class, 'getEmployee'])->name('search-employee');
		Route::resource('/',  UsersController::class)->except([
			'show', 'destroy'
		])->parameters(['' => 'user']);
	});
});



Route::get('/login',	[LoginController::class, 'index'])->name('login');
Route::post('/login',	[LoginController::class, 'postLogin'])->name('post-login');
Route::get('logout',	[LoginController::class, 'signOut'])->name('logout');
