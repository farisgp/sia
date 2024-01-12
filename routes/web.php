<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\NilaiController;
use App\Http\Controllers\KelolaUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\ProfilController;
use App\Http\Controllers\MataPelController;

// use App\Http\Controllers\AuthController;
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
//----------- Route LandingPage ----------
Route::get('/', function () {
    return view('landingpage.home');
});
// Route::get('/login', function () {
//     return view('auth.login');
// });

// Route::get('/register', function () {
//     return view('auth.register');
// });
Route::get('/landingpage', function () {
    return view('landingpage.home');
})->name('landingpage');
Route::get('/tentang', function () {
    return view('landingpage.profil_sekolah');
});
Route::get('/visimisi', function () {
    return view('landingpage.visimisi');
});
//----------- Route Halaman Admin ----------
Route::get('/administrator', function () {
    return view('admin.index');
});
Route::get('/halaman_guru', function () {
    return view('guru.index');
});
// Route::get('/redirect', [App\Http\Controllers\UsersController::class, 'role'])->name('redirect');
Route::get('/after_register', function () {
    return view('landingpage.after_register');
});

Route::resource('data_siswa', SiswaController::class);
// Route::resource('daftar_siswa/{idUser}', [GuruController::class, 'tampilkanSiswaGuru']);
Route::resource('data_guru', GuruController::class);
Route::resource('presensi', PresensiController::class);
Route::resource('jadwal', JadwalController::class);
Route::resource('nilai', NilaiController::class);
Route::resource('kelola_user', KelolaUserController::class);
// Route::resource('tambah_user', [ KelolaUserController::class, 'add_user'])->name('tambah_user');

Route::get('/siswa/by-kelas/{id_kelas}', [NilaiController::class, 'getSiswaByKelas']);
Route::get('/siswa/{kelas}', [NilaiController::class, 'getSiswaByKelas']);
// Route::middleware(['peran:admin'])->group(function () {

//     Route::resource('paket', PaketController::class);

//     Route::resource('order', OrderController::class);

//     Route::resource('guru', GuruController::class);

//     Route::resource('pembayaran', PembayaranController::class);
// });

Route::post('/update_guru_bio', [App\Http\Controllers\GuruController::class, 'update3'])->name('update3');
Route::get('/profile_guru', [App\Http\Controllers\KelolaUserController::class, 'profile_guru'])->name('profile_guru');

Route::get('/mata-pelajaran', [App\Http\Controllers\MataPelController::class, 'index'])->name('mata-pelajaran.index');
Route::get('/mata-pelajaran/{id}/index', [App\Http\Controllers\NilaiController::class, 'index'])->name('nilai.index');
Route::get('/nilai', [App\Http\Controllers\NilaiController::class, 'index'])->name('nilai.index');
Route::get('/nilai/create/{id}', [App\Http\Controllers\NilaiController::class, 'create'])->name('nilai.create.mapel');
Route::post('/nilai/store', [App\Http\Controllers\NilaiController::class, 'store'])->name('nilai.store');

// Route::get('/nilai', [App\Http\Controllers\NilaiController::class, 'index'])->name('nilai.index');



Route::get('dashboard', [DashboardController::class, 'index']);
Route::get('/info_guru', [App\Http\Controllers\GuruController::class, 'biodata'])->name('info_guru');
Route::get('/info_siswa', [App\Http\Controllers\SiswaController::class, 'biodata']);

Route::get('/profil', [ProfilController::class, 'index'])->name('profil.index');

Route::get('/register', [AuthController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register.submit');

// Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login.form');
// Route::post('/login', [AuthController::class, 'login'])->name('login.submit');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
// Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
// Route::get('/edit_siswa/{id}', 'EditController@editSiswa')->name('edit_siswa');
// Route::get('/edit_guru/{id}', 'EditController@editGuru')->name('edit_guru');


// Auth::routes();
// Route::get('/redirect', [App\Http\Controllers\UsersController::class, 'role'])->name('redirect');

// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


// Route::post('/register', [AuthController::class, 'register'])->name('register');
// Route::post('/login', [AuthController::class, 'login'])->name('login');
