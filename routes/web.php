<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\StokController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/level', [LevelController::class, 'index']);
Route::get('/kategori', [KategoriController::class, 'index']);
Route::get('/user', [UserController::class, 'index']);
Route::get('/user/tambah', [UserController::class, 'tambah']);
Route::post('/user/tambah_simpan', [UserController::class, 'tambah_simpan']);
Route::get('/user/ubah{id}', [UserController::class, 'ubah']);
Route::put('/user/ubah_simpan{id}', [UserController::class, 'ubah_simpan']);
Route::get('/user/hapus{id}', [UserController::class, 'hapus']);


Route::pattern('id', '[0-9]+'); //artinya ketika ada parameter {id}, maka harus berupa angka

Route::get('login', [AuthController::class, 'login'])->name('login');
Route::post('login', [AuthController::class, 'postLogin']);
Route::get('logout', [AuthController::class, 'logout'])->middleware('auth');
Route::get('register', [AuthController::class, 'register']);
Route::post('register', [AuthController::class, 'store']);

Route::middleware(['auth'])->group(function () { // artinya semua route di dalam group ini harus login dulu

    Route::get('/', [WelcomeController::class, 'index']);

    // artinya semua route di dalam group ini harus punya role ADM (Administrator)
    Route::middleware(['authorize:ADM'])->group(function(){
        Route::get('/', [LevelController::class, 'index']);          // menampilkan halaman awal level
        Route::post('/list', [LevelController::class, 'list']);      // menampilkan data level dalam bentuk json untuk datatables
        Route::get('/create', [LevelController::class, 'create']);   // menampilkan halaman form tambah level
        Route::post('/', [LevelController::class, 'store']);         // menyimpan data level baru
        Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah level Ajax
        Route::post('/ajax', [LevelController::class, 'store_ajax']); // Menyimpan data level baru Ajax
        Route::get('/{id}', [LevelController::class, 'show']);       // menampilkan detail level
        Route::get('/{id}/edit', [LevelController::class, 'edit']);  // menampilkan halaman form edit level
        Route::put('/{id}', [LevelController::class, 'update']);     // menyimpan perubahan data level
        Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);  // menampilkan halaman form edit level Ajax
        Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // menyimpan perubahan data level Ajax
        Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);     // menyimpan perubahan data level Ajax
        Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // menghapus data level Ajax
        Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data level
    });
    
    // artinya semua route di dalam group ini harus punya role ADM (Administrator), MNG (Manager), STF (Staff) dan CUS (Peawlanggan) 
    Route::middleware(['authorize:ADM,MNG,STF,CUS'])->group(function(){
        Route::get('/', [BarangController::class, 'index']);          // menampilkan halaman awal barang
        Route::post('/list', [BarangController::class, 'list']);      // menampilkan data barang dalam bentuk json untuk datatables
        Route::get('/create', [BarangController::class, 'create']);   // menampilkan halaman form tambah barang
        Route::post('/', [BarangController::class, 'store']);         // menyimpan data barang baru
        Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // Menampilkan halaman form tambah barang Ajax
        Route::post('/ajax', [BarangController::class, 'store_ajax']); // Menyimpan data barang baru Ajax
        Route::get('/{id}', [BarangController::class, 'show']);       // menampilkan detail barang
        Route::get('/{id}/edit', [BarangController::class, 'edit']);  // menampilkan halaman form edit barang
        Route::put('/{id}', [BarangController::class, 'update']);     // menyimpan perubahan data barang
        Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);  // menampilkan halaman form edit barang Ajax
        Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // menyimpan perubahan data barang Ajax
        Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);     // menyimpan perubahan data barang Ajax
        Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // menghapus data barang Ajax
        Route::delete('/{id}', [BarangController::class, 'destroy']); // menghapus data barang
    });

    // artinya semua route di dalam group ini harus punya role ADM (Administrator), dan MNG (Manager)
    Route::middleware(['authorize:ADM,MNG'])->group(function(){
        Route::get('/', [KategoriController::class, 'index']);          // menampilkan halaman awal kategori
        Route::post('/list', [KategoriController::class, 'list']);      // menampilkan data kategori dalam bentuk json untuk datatables
        Route::get('/create', [KategoriController::class, 'create']);   // menampilkan halaman form tambah kategori
        Route::post('/', [KategoriController::class, 'store']);         // menyimpan data kategori baru
        Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // Menampilkan halaman form tambah kategori Ajax
        Route::post('/ajax', [KategoriController::class, 'store_ajax']); // Menyimpan data kategori baru Ajax
        Route::get('/{id}', [KategoriController::class, 'show']);       // menampilkan detail kategori
        Route::get('/{id}/edit', [KategoriController::class, 'edit']);  // menampilkan halaman form edit kategori
        Route::put('/{id}', [KategoriController::class, 'update']);     // menyimpan perubahan data kategori
        Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);  // menampilkan halaman form edit kategori Ajax
        Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data kategori Ajax
        Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);     // menyimpan perubahan data kategori Ajax
        Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // menghapus data kategori Ajax
        Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data kategori
    });

    // artinya semua route di dalam group ini harus punya role ADM (Administrator), dan MNG (Manager)
    Route::middleware(['authorize:ADM,MNG'])->group(function(){
        Route::get('/', [SupplierController::class, 'index']);          // menampilkan halaman awal supplier
        Route::post('/list', [SupplierController::class, 'list']);      // menampilkan data supplier dalam bentuk json untuk datatables
        Route::get('/create', [SupplierController::class, 'create']);   // menampilkan halaman form tambah supplier
        Route::post('/', [SupplierController::class, 'store']);         // menyimpan data supplier baru
        Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // Menampilkan halaman form tambah supllier Ajax
        Route::post('/ajax', [SupplierController::class, 'store_ajax']); // Menyimpan data supllier baru Ajax
        Route::get('/{id}', [SupplierController::class, 'show']);       // menampilkan detail supplier
        Route::get('/{id}/edit', [SupplierController::class, 'edit']);  // menampilkan halaman form edit supplier
        Route::put('/{id}', [SupplierController::class, 'update']);     // menyimpan perubahan data supplier
        Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);  // menampilkan halaman form edit supllier Ajax
        Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // menyimpan perubahan data supllier Ajax
        Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);     // menyimpan perubahan data supllier Ajax
        Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // menghapus data supllier Ajax
        Route::delete('/{id}', [SupplierController::class, 'destroy']); // menghapus data supplier
    });

    // artinya semua route di dalam group ini harus punya role ADM (Administrator), MNG (Manager), dan STF (Staff)
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function(){
        Route::get('/', [StokController::class, 'index']);          // menampilkan halaman awal stok
        Route::post('/list', [StokController::class, 'list']);      // menampilkan data stok dalam bentuk json untuk datatables
        Route::get('/create', [StokController::class, 'create']);   // menampilkan halaman form tambah stok
        Route::post('/', [StokController::class, 'store']);         // menyimpan data stok baru
        Route::get('/create_ajax', [StokController::class, 'create_ajax']); // Menampilkan halaman form tambah stok Ajax
        Route::post('/ajax', [StokController::class, 'store_ajax']); // Menyimpan data stok baru Ajax
        Route::get('/{id}', [StokController::class, 'show']);       // menampilkan detail stok
        Route::get('/{id}/edit', [StokController::class, 'edit']);  // menampilkan halaman form edit stok
        Route::put('/{id}', [StokController::class, 'update']);     // menyimpan perubahan data stok
        Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']);  // menampilkan halaman form edit stok Ajax
        Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']); // menyimpan perubahan data stok Ajax
        Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']);     // menyimpan perubahan data stok Ajax
        Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']); // menghapus data stok Ajax
        Route::delete('/{id}', [StokController::class, 'destroy']); // menghapus data stok
    });
        

Route::group(['prefix' => 'user'], function () {
    Route::get('/', [UserController::class, 'index']);          // menampilkan halaman awal user
    Route::post('/list', [UserController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
    Route::get('/create', [UserController::class, 'create']);   // menampilkan halaman form tambah user
    Route::post('/', [UserController::class, 'store']);         // menyimpan data user baru
    Route::get('/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
    Route::post('/ajax', [UserController::class, 'store_ajax']); // Menyimpan data user baru Ajax
    Route::get('/{id}', [UserController::class, 'show']);       // menampilkan detail user
    Route::get('/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
    Route::put('/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
    Route::get('/{id}/edit_ajax', [UserController::class, 'edit_ajax']);  // menampilkan halaman form edit user Ajax
    Route::put('/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
    Route::get('/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);     // menyimpan perubahan data user Ajax
    Route::delete('/{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user Ajax
    Route::delete('/{id}', [UserController::class, 'destroy']); // menghapus data user
});

Route::group(['prefix' => 'level'], function () {
    Route::get('/', [LevelController::class, 'index']);          // menampilkan halaman awal level
    Route::post('/list', [LevelController::class, 'list']);      // menampilkan data level dalam bentuk json untuk datatables
    Route::get('/create', [LevelController::class, 'create']);   // menampilkan halaman form tambah level
    Route::post('/', [LevelController::class, 'store']);         // menyimpan data level baru
    Route::get('/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah level Ajax
    Route::post('/ajax', [LevelController::class, 'store_ajax']); // Menyimpan data level baru Ajax
    Route::get('/{id}', [LevelController::class, 'show']);       // menampilkan detail level
    Route::get('/{id}/edit', [LevelController::class, 'edit']);  // menampilkan halaman form edit level
    Route::put('/{id}', [LevelController::class, 'update']);     // menyimpan perubahan data level
    Route::get('/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);  // menampilkan halaman form edit level Ajax
    Route::put('/{id}/update_ajax', [LevelController::class, 'update_ajax']); // menyimpan perubahan data level Ajax
    Route::get('/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);     // menyimpan perubahan data level Ajax
    Route::delete('/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // menghapus data level Ajax
    Route::delete('/{id}', [LevelController::class, 'destroy']); // menghapus data level
});

Route::group(['prefix' => 'kategori'], function () {
    Route::get('/', [KategoriController::class, 'index']);          // menampilkan halaman awal kategori
    Route::post('/list', [KategoriController::class, 'list']);      // menampilkan data kategori dalam bentuk json untuk datatables
    Route::get('/create', [KategoriController::class, 'create']);   // menampilkan halaman form tambah kategori
    Route::post('/', [KategoriController::class, 'store']);         // menyimpan data kategori baru
    Route::get('/create_ajax', [KategoriController::class, 'create_ajax']); // Menampilkan halaman form tambah kategori Ajax
    Route::post('/ajax', [KategoriController::class, 'store_ajax']); // Menyimpan data kategori baru Ajax
    Route::get('/{id}', [KategoriController::class, 'show']);       // menampilkan detail kategori
    Route::get('/{id}/edit', [KategoriController::class, 'edit']);  // menampilkan halaman form edit kategori
    Route::put('/{id}', [KategoriController::class, 'update']);     // menyimpan perubahan data kategori
    Route::get('/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);  // menampilkan halaman form edit kategori Ajax
    Route::put('/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data kategori Ajax
    Route::get('/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);     // menyimpan perubahan data kategori Ajax
    Route::delete('/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // menghapus data kategori Ajax
    Route::delete('/{id}', [KategoriController::class, 'destroy']); // menghapus data kategori
});

Route::group(['prefix' => 'supplier'], function () {
    Route::get('/', [SupplierController::class, 'index']);          // menampilkan halaman awal supplier
    Route::post('/list', [SupplierController::class, 'list']);      // menampilkan data supplier dalam bentuk json untuk datatables
    Route::get('/create', [SupplierController::class, 'create']);   // menampilkan halaman form tambah supplier
    Route::post('/', [SupplierController::class, 'store']);         // menyimpan data supplier baru
    Route::get('/create_ajax', [SupplierController::class, 'create_ajax']); // Menampilkan halaman form tambah supllier Ajax
    Route::post('/ajax', [SupplierController::class, 'store_ajax']); // Menyimpan data supllier baru Ajax
    Route::get('/{id}', [SupplierController::class, 'show']);       // menampilkan detail supplier
    Route::get('/{id}/edit', [SupplierController::class, 'edit']);  // menampilkan halaman form edit supplier
    Route::put('/{id}', [SupplierController::class, 'update']);     // menyimpan perubahan data supplier
    Route::get('/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);  // menampilkan halaman form edit supllier Ajax
    Route::put('/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // menyimpan perubahan data supllier Ajax
    Route::get('/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);     // menyimpan perubahan data supllier Ajax
    Route::delete('/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // menghapus data supllier Ajax
    Route::delete('/{id}', [SupplierController::class, 'destroy']); // menghapus data supplier
});

Route::group(['prefix' => 'barang'], function () {
    Route::get('/', [BarangController::class, 'index']);          // menampilkan halaman awal barang
    Route::post('/list', [BarangController::class, 'list']);      // menampilkan data barang dalam bentuk json untuk datatables
    Route::get('/create', [BarangController::class, 'create']);   // menampilkan halaman form tambah barang
    Route::post('/', [BarangController::class, 'store']);         // menyimpan data barang baru
    Route::get('/create_ajax', [BarangController::class, 'create_ajax']); // Menampilkan halaman form tambah barang Ajax
    Route::post('/ajax', [BarangController::class, 'store_ajax']); // Menyimpan data barang baru Ajax
    Route::get('/{id}', [BarangController::class, 'show']);       // menampilkan detail barang
    Route::get('/{id}/edit', [BarangController::class, 'edit']);  // menampilkan halaman form edit barang
    Route::put('/{id}', [BarangController::class, 'update']);     // menyimpan perubahan data barang
    Route::get('/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);  // menampilkan halaman form edit barang Ajax
    Route::put('/{id}/update_ajax', [BarangController::class, 'update_ajax']); // menyimpan perubahan data barang Ajax
    Route::get('/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);     // menyimpan perubahan data barang Ajax
    Route::delete('/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // menghapus data barang Ajax
    Route::delete('/{id}', [BarangController::class, 'destroy']); // menghapus data barang
});

Route::group(['prefix' => 'stok'], function () {
    Route::get('/', [StokController::class, 'index']);          // menampilkan halaman awal stok
    Route::post('/list', [StokController::class, 'list']);      // menampilkan data stok dalam bentuk json untuk datatables
    Route::get('/create', [StokController::class, 'create']);   // menampilkan halaman form tambah stok
    Route::post('/', [StokController::class, 'store']);         // menyimpan data stok baru
    Route::get('/create_ajax', [StokController::class, 'create_ajax']); // Menampilkan halaman form tambah stok Ajax
    Route::post('/ajax', [StokController::class, 'store_ajax']); // Menyimpan data stok baru Ajax
    Route::get('/{id}', [StokController::class, 'show']);       // menampilkan detail stok
    Route::get('/{id}/edit', [StokController::class, 'edit']);  // menampilkan halaman form edit stok
    Route::put('/{id}', [StokController::class, 'update']);     // menyimpan perubahan data stok
    Route::get('/{id}/edit_ajax', [StokController::class, 'edit_ajax']);  // menampilkan halaman form edit stok Ajax
    Route::put('/{id}/update_ajax', [StokController::class, 'update_ajax']); // menyimpan perubahan data stok Ajax
    Route::get('/{id}/delete_ajax', [StokController::class, 'confirm_ajax']);     // menyimpan perubahan data stok Ajax
    Route::delete('/{id}/delete_ajax', [StokController::class, 'delete_ajax']); // menghapus data stok Ajax
    Route::delete('/{id}', [StokController::class, 'destroy']); // menghapus data stok
});
});
