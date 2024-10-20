<?php

use App\Http\Controllers\KategoriController;
use App\Http\Controllers\LevelController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PenjualanController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\StokController;
use App\Http\Controllers\ProfileController;
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
Route::get('/profile', [ProfileController::class, 'index']);
Route::post('/profile/update', [ProfileController::class, 'update']);
Route::post('/profile/update_data_diri{id}', [ProfileController::class, 'updateDataDiri']);
Route::post('/profile/update_password', [ProfileController::class, 'updatePassword']);

Route::middleware(['auth'])->group(function () { // artinya semua route di dalam group ini harus login dulu

    Route::get('/', [WelcomeController::class, 'index']);
    Route::middleware(['authorize:ADM'])->group(function(){
        Route::get('/user', [UserController::class, 'index']);          // menampilkan halaman awal user
        Route::post('/user/list', [UserController::class, 'list']);      // menampilkan data user dalam bentuk json untuk datatables
        Route::get('/user/create', [UserController::class, 'create']);   // menampilkan halaman form tambah user
        Route::post('/user', [UserController::class, 'store']);         // menyimpan data user baru
        Route::get('/user/create_ajax', [UserController::class, 'create_ajax']); // Menampilkan halaman form tambah user Ajax
        Route::post('/user/ajax', [UserController::class, 'store_ajax']); // Menyimpan data user baru Ajax
        Route::get('/user/{id}', [UserController::class, 'show']);       // menampilkan detail user
        Route::get('/user/{id}/edit', [UserController::class, 'edit']);  // menampilkan halaman form edit user
        Route::put('/user/{id}', [UserController::class, 'update']);     // menyimpan perubahan data user
        Route::get('/user/{id}/edit_ajax', [UserController::class, 'edit_ajax']);  // menampilkan halaman form edit user Ajax
        Route::put('/user/{id}/update_ajax', [UserController::class, 'update_ajax']); // menyimpan perubahan data user Ajax
        Route::get('/user/{id}/delete_ajax', [UserController::class, 'confirm_ajax']);     // menyimpan perubahan data user Ajax
        Route::delete('/user{id}/delete_ajax', [UserController::class, 'delete_ajax']); // menghapus data user Ajax
        Route::delete('/user/{id}', [UserController::class, 'destroy']); // menghapus data user
        Route::get('/user/import', [UserController::class, 'import']); //ajax form upload excel
        Route::post('/user/import_ajax', [UserController::class, 'import_ajax']); //ajax import excel
        Route::get('/user/export_excel', [UserController::class, 'export_excel']); // export excel
        Route::get('/user/export_pdf', [UserController::class, 'export_pdf']); // export pdf
    });

    // artinya semua route di dalam group ini harus punya role ADM (Administrator)
    Route::middleware(['authorize:ADM'])->group(function(){
        Route::get('/level', [LevelController::class, 'index']);          // menampilkan halaman awal level
        Route::post('/level/list', [LevelController::class, 'list']);      // menampilkan data level dalam bentuk json untuk datatables
        Route::get('/level/create', [LevelController::class, 'create']);   // menampilkan halaman form tambah level
        Route::post('/level', [LevelController::class, 'store']);         // menyimpan data level baru
        Route::get('/level/create_ajax', [LevelController::class, 'create_ajax']); // Menampilkan halaman form tambah level Ajax
        Route::post('/level/ajax', [LevelController::class, 'store_ajax']); // Menyimpan data level baru Ajax
        Route::get('/level/{id}', [LevelController::class, 'show']);       // menampilkan detail level
        Route::get('/level/{id}/edit', [LevelController::class, 'edit']);  // menampilkan halaman form edit level
        Route::put('/level/{id}', [LevelController::class, 'update']);     // menyimpan perubahan data level
        Route::get('/level/{id}/edit_ajax', [LevelController::class, 'edit_ajax']);  // menampilkan halaman form edit level Ajax
        Route::put('/level/{id}/update_ajax', [LevelController::class, 'update_ajax']); // menyimpan perubahan data level Ajax
        Route::get('/level/{id}/delete_ajax', [LevelController::class, 'confirm_ajax']);     // menyimpan perubahan data level Ajax
        Route::delete('/level/{id}/delete_ajax', [LevelController::class, 'delete_ajax']); // menghapus data level Ajax
        Route::delete('/level/{id}', [LevelController::class, 'destroy']); // menghapus data level
        Route::get('/level/import', [LevelController::class, 'import']); //ajax form upload excel
        Route::post('/level/import_ajax', [LevelController::class, 'import_ajax']); //ajax import excel
        Route::get('/level/export_excel', [LevelController::class, 'export_excel']); // export excel
        Route::get('/level/export_pdf', [LevelController::class, 'export_pdf']); // export pdf
    });
    
    // artinya semua route di dalam group ini harus punya role ADM (Administrator), MNG (Manager), STF (Staff) dan CUS (Peawlanggan) 
    Route::middleware(['authorize:ADM,MNG,STF,CUS'])->group(function(){
        Route::get('/barang', [BarangController::class, 'index']);          // menampilkan halaman awal barang
        Route::post('/barang/list', [BarangController::class, 'list']);      // menampilkan data barang dalam bentuk json untuk datatables
        Route::get('/barang/create', [BarangController::class, 'create']);   // menampilkan halaman form tambah barang
        Route::post('/barang', [BarangController::class, 'store']);         // menyimpan data barang baru
        Route::get('/barang/create_ajax', [BarangController::class, 'create_ajax']); // Menampilkan halaman form tambah barang Ajax
        Route::post('/barang/ajax', [BarangController::class, 'store_ajax']); // Menyimpan data barang baru Ajax
        Route::get('/barang/{id}', [BarangController::class, 'show']);       // menampilkan detail barang
        Route::get('/barang/{id}/edit', [BarangController::class, 'edit']);  // menampilkan halaman form edit barang
        Route::put('/barang/{id}', [BarangController::class, 'update']);     // menyimpan perubahan data barang
        Route::get('/barang/{id}/edit_ajax', [BarangController::class, 'edit_ajax']);  // menampilkan halaman form edit barang Ajax
        Route::put('/barang/{id}/update_ajax', [BarangController::class, 'update_ajax']); // menyimpan perubahan data barang Ajax
        Route::get('/barang/{id}/delete_ajax', [BarangController::class, 'confirm_ajax']);     // menyimpan perubahan data barang Ajax
        Route::delete('/barang/{id}/delete_ajax', [BarangController::class, 'delete_ajax']); // menghapus data barang Ajax
        Route::delete('/barang/{id}', [BarangController::class, 'destroy']); // menghapus data barang
        Route::get('/barang/import', [BarangController::class, 'import']); //ajax form upload excel
        Route::post('/barang/import_ajax', [BarangController::class, 'import_ajax']); //ajax import excel
        Route::get('/barang/export_excel', [BarangController::class, 'export_excel']); // export excel
        Route::get('/barang/export_pdf', [BarangController::class, 'export_pdf']); // export pdf
    });

    // artinya semua route di dalam group ini harus punya role ADM (Administrator), dan MNG (Manager)
    Route::middleware(['authorize:ADM,MNG'])->group(function(){
        Route::get('/kategori', [KategoriController::class, 'index']);          // menampilkan halaman awal kategori
        Route::post('/kategori/list', [KategoriController::class, 'list']);      // menampilkan data kategori dalam bentuk json untuk datatables
        Route::get('/kategoricreate', [KategoriController::class, 'create']);   // menampilkan halaman form tambah kategori
        Route::post('/kategori', [KategoriController::class, 'store']);         // menyimpan data kategori baru
        Route::get('/kategori/create_ajax', [KategoriController::class, 'create_ajax']); // Menampilkan halaman form tambah kategori Ajax
        Route::post('/kategori/ajax', [KategoriController::class, 'store_ajax']); // Menyimpan data kategori baru Ajax
        Route::get('/kategori/{id}', [KategoriController::class, 'show']);       // menampilkan detail kategori
        Route::get('/kategori/{id}/edit', [KategoriController::class, 'edit']);  // menampilkan halaman form edit kategori
        Route::put('/kategori/{id}', [KategoriController::class, 'update']);     // menyimpan perubahan data kategori
        Route::get('/kategori/{id}/edit_ajax', [KategoriController::class, 'edit_ajax']);  // menampilkan halaman form edit kategori Ajax
        Route::put('/kategori/{id}/update_ajax', [KategoriController::class, 'update_ajax']); // menyimpan perubahan data kategori Ajax
        Route::get('/kategori/{id}/delete_ajax', [KategoriController::class, 'confirm_ajax']);     // menyimpan perubahan data kategori Ajax
        Route::delete('/kategori/{id}/delete_ajax', [KategoriController::class, 'delete_ajax']); // menghapus data kategori Ajax
        Route::delete('/kategori/{id}', [KategoriController::class, 'destroy']); // menghapus data kategori
        Route::get('/kategori/import', [KategoriController::class, 'import']); //ajax form upload excel
        Route::post('/kategori/import_ajax', [KategoriController::class, 'import_ajax']); //ajax import excel
        Route::get('/kategori/export_excel', [KategoriController::class, 'export_excel']); // export excel
        Route::get('/kategori/export_pdf', [KategoriController::class, 'export_pdf']); // export pdf
    });

    // artinya semua route di dalam group ini harus punya role ADM (Administrator), dan MNG (Manager)
    Route::middleware(['authorize:ADM,MNG'])->group(function(){
        Route::get('/supplier', [SupplierController::class, 'index']);          // menampilkan halaman awal supplier
        Route::post('/supplier/list', [SupplierController::class, 'list']);      // menampilkan data supplier dalam bentuk json untuk datatables
        Route::get('/supplier/create', [SupplierController::class, 'create']);   // menampilkan halaman form tambah supplier
        Route::post('/supplier', [SupplierController::class, 'store']);         // menyimpan data supplier baru
        Route::get('/supplier/create_ajax', [SupplierController::class, 'create_ajax']); // Menampilkan halaman form tambah supllier Ajax
        Route::post('/supplier/ajax', [SupplierController::class, 'store_ajax']); // Menyimpan data supllier baru Ajax
        Route::get('/supplier/{id}', [SupplierController::class, 'show']);       // menampilkan detail supplier
        Route::get('/supplier/{id}/edit', [SupplierController::class, 'edit']);  // menampilkan halaman form edit supplier
        Route::put('/supplier/{id}', [SupplierController::class, 'update']);     // menyimpan perubahan data supplier
        Route::get('/supplier/{id}/edit_ajax', [SupplierController::class, 'edit_ajax']);  // menampilkan halaman form edit supllier Ajax
        Route::put('/supplier/{id}/update_ajax', [SupplierController::class, 'update_ajax']); // menyimpan perubahan data supllier Ajax
        Route::get('/supplier/{id}/delete_ajax', [SupplierController::class, 'confirm_ajax']);     // menyimpan perubahan data supllier Ajax
        Route::delete('/supplier/{id}/delete_ajax', [SupplierController::class, 'delete_ajax']); // menghapus data supllier Ajax
        Route::delete('/supplier/{id}', [SupplierController::class, 'destroy']); // menghapus data supplier
        Route::get('/supplier/import', [SupplierController::class, 'import']); //ajax form upload excel
        Route::post('/supplier/import_ajax', [SupplierController::class, 'import_ajax']); //ajax import excel
        Route::get('/supplier/export_excel', [SupplierController::class, 'export_excel']); // export excel
        Route::get('/supplier/export_pdf', [SupplierController::class, 'export_pdf']); // export pdf
    });

    // artinya semua route di dalam group ini harus punya role ADM (Administrator), MNG (Manager), dan STF (Staff)
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function(){
        Route::get('/stok', [StokController::class, 'index']);          // menampilkan halaman awal stok
        Route::post('/stok/list', [StokController::class, 'list']);      // menampilkan data stok dalam bentuk json untuk datatables
        Route::get('/stok/create', [StokController::class, 'create']);   // menampilkan halaman form tambah stok
        Route::post('/stok', [StokController::class, 'store']);         // menyimpan data stok baru
        Route::get('/stok/create_ajax', [StokController::class, 'create_ajax']); // Menampilkan halaman form tambah stok Ajax
        Route::post('/stok/ajax', [StokController::class, 'store_ajax']); // Menyimpan data stok baru Ajax
        Route::get('/stok/{id}', [StokController::class, 'show']);       // menampilkan detail stok
        Route::get('/stok/{id}/edit', [StokController::class, 'edit']);  // menampilkan halaman form edit stok
        Route::put('/stok/{id}', [StokController::class, 'update']);     // menyimpan perubahan data stok
        Route::get('/stok/{id}/edit_ajax', [StokController::class, 'edit_ajax']);  // menampilkan halaman form edit stok Ajax
        Route::put('/stok/{id}/update_ajax', [StokController::class, 'update_ajax']); // menyimpan perubahan data stok Ajax
        Route::get('/stok/{id}/delete_ajax', [StokController::class, 'confirm_ajax']);     // menyimpan perubahan data stok Ajax
        Route::delete('/stok/{id}/delete_ajax', [StokController::class, 'delete_ajax']); // menghapus data stok Ajax
        Route::delete('/stok/{id}', [StokController::class, 'destroy']); // menghapus data stok
        Route::get('/stok/import', [StokController::class, 'import']); //ajax form upload excel
        Route::post('/stok/import_ajax', [StokController::class, 'import_ajax']); //ajax import excel
        Route::get('/stok/export_excel', [StokController::class, 'export_excel']); // export excel
        Route::get('/stok/export_pdf', [StokController::class, 'export_pdf']); // export pdf
    });

    // artinya semua route di dalam group ini harus punya role ADM (Administrator), MNG (Manager), dan STF (Staff)
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function(){
        Route::get('/penjualan', [PenjualanController::class, 'index']);          // menampilkan halaman awal stok
        Route::post('/penjualan/list', [PenjualanController::class, 'list']);      // menampilkan data stok dalam bentuk json untuk datatables
        Route::get('/penjualan/create', [PenjualanController::class, 'create']);   // menampilkan halaman form tambah stok
        Route::post('/penjualan', [PenjualanController::class, 'store']);         // menyimpan data stok baru
        Route::get('/penjualan/create_ajax', [PenjualanController::class, 'create_ajax']); // Menampilkan halaman form tambah stok Ajax
        Route::post('/penjualan/ajax', [PenjualanController::class, 'store_ajax']); // Menyimpan data stok baru Ajax
        Route::get('/penjualan/{id}', [PenjualanController::class, 'show']);       // menampilkan detail stok
        Route::get('/penjualan/{id}/edit', [PenjualanController::class, 'edit']);  // menampilkan halaman form edit stok
        Route::put('/penjualan/{id}', [PenjualanController::class, 'update']);     // menyimpan perubahan data stok
        Route::get('/penjualan/{id}/edit_ajax', [PenjualanController::class, 'edit_ajax']);  // menampilkan halaman form edit stok Ajax
        Route::put('/penjualan/{id}/update_ajax', [PenjualanController::class, 'update_ajax']); // menyimpan perubahan data stok Ajax
        Route::get('/penjualan/{id}/delete_ajax', [PenjualanController::class, 'confirm_ajax']);     // menyimpan perubahan data stok Ajax
        Route::delete('/penjualan/{id}/delete_ajax', [PenjualanController::class, 'delete_ajax']); // menghapus data stok Ajax
        Route::delete('/penjualan/{id}', [PenjualanController::class, 'destroy']); // menghapus data stok
        Route::get('/penjualan/import', [PenjualanController::class, 'import']); //ajax form upload excel
        Route::post('/penjualan/import_ajax', [PenjualanController::class, 'import_ajax']); //ajax import excel
        Route::get('/penjualan/export_excel', [PenjualanController::class, 'export_excel']); // export excel
        Route::get('/penjualan/export_pdf', [PenjualanController::class, 'export_pdf']); // export pdf
    });

    // artinya semua route di dalam group ini harus punya role ADM (Administrator), MNG (Manager), dan STF (Staff)
    Route::middleware(['authorize:ADM,MNG,STF'])->group(function(){
        Route::get('/detail', [DetailController::class, 'index']);          // menampilkan halaman awal detail
        Route::post('/detail/list', [DetailController::class, 'list']);      // menampilkan data detail dalam bentuk json untuk datatables
        Route::get('/detail/create', [DetailController::class, 'create']);   // menampilkan halaman form tambah detail
        Route::post('/detail', [DetailController::class, 'store']);         // menyimpan data detail baru
        Route::get('/detail/create_ajax', [DetailController::class, 'create_ajax']); // Menampilkan halaman form tambah detail Ajax
        Route::post('/detail/ajax', [DetailController::class, 'store_ajax']); // Menyimpan data detail baru Ajax
        Route::get('/detail/{id}', [DetailController::class, 'show']);       // menampilkan detail detail
        Route::get('/detail/{id}/edit', [DetailController::class, 'edit']);  // menampilkan halaman form edit detail
        Route::put('/detail/{id}', [DetailController::class, 'update']);     // menyimpan perubahan data detail
        Route::get('/detail/{id}/edit_ajax', [DetailController::class, 'edit_ajax']);  // menampilkan halaman form edit detail Ajax
        Route::put('/detail/{id}/update_ajax', [DetailController::class, 'update_ajax']); // menyimpan perubahan data detail Ajax
        Route::get('/detail/{id}/delete_ajax', [DetailController::class, 'confirm_ajax']);     // menyimpan perubahan data detail Ajax
        Route::delete('/detail/{id}/delete_ajax', [DetailController::class, 'delete_ajax']); // menghapus data detail Ajax
        Route::delete('/detail/{id}', [DetailController::class, 'destroy']); // menghapus data detail
        Route::get('/detail/import', [DetailController::class, 'import']); //ajax form upload excel
        Route::post('/detail/import_ajax', [DetailController::class, 'import_ajax']); //ajax import excel
        Route::get('/detail/export_excel', [DetailController::class, 'export_excel']); // export excel
        Route::get('/detail/export_pdf', [DetailController::class, 'export_pdf']); // export pdf
    });

});