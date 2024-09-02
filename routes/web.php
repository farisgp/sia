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
// Route::get('/administrator', function () {
//     return view('admin.index');
// });
// Route::get('/halaman_guru', function () {
//     return view('guru.index');
// });
Route::middleware('auth')->group(function(){
    Route::get('/access-denied', function () {
        return view('admin.access_denied');
    });
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::resource('data_siswa', SiswaController::class);
    Route::resource('data_guru', GuruController::class);
    Route::resource('presensi', PresensiController::class);
    Route::resource('jadwal', JadwalController::class);
    Route::resource('nilai', NilaiController::class);
    Route::resource('kelola_user', KelolaUserController::class);
    
    // Route::group(['middleware'=>['admin']], function(){
        Route::get('siswa_admin', [SiswaController::class, 'index'])->name('siswa.index');

        //--------setting aplikasi--------
        Route::get('settings', [App\Http\Controllers\SettingController::class, 'index'])->name('settings');
        Route::put('settings', [App\Http\Controllers\SettingController::class, 'update'])->name('settings.update');
        //------------Graduate-----------
        Route::get('graduate/{kelas_lama?}', [SiswaController::class, 'graduate'])->name('siswa.graduate');
        Route::post('siswa_graduated/{kelas_lama}', [SiswaController::class, 'siswa_graduated'])->name('siswa.siswa_graduated');
        Route::get('show_graduated', [SiswaController::class, 'show_graduated'])->name('siswa.show_graduated');
        Route::put('not_graduated/{id}', [SiswaController::class, 'not_graduated'])->name('siswa.not_graduated');
        Route::post('graduate_selector', [SiswaController::class, 'graduate_selector'])->name('siswa.graduate_selector');
        //-----------Kenaikan Kelas----------
        Route::post('promote_selector', [SiswaController::class, 'selector'])->name('siswa.promote_selector');
        Route::get('promotion/manage', [SiswaController::class, 'manage'])->name('siswa.promotion_manage');
        Route::delete('promotion/reset/{pid}', [SiswaController::class, 'reset'])->name('siswa.promotion_reset');
        Route::delete('promotion/reset_all', [SiswaController::class, 'reset_all'])->name('siswa.promotion_reset_all');
        Route::get('promotion/{kelas_lama?}/{kelas_baru?}', [SiswaController::class, 'promotion'])->name('siswa.promotion');
        Route::post('promote/{kelas_lama}/{kelas_baru}', [SiswaController::class, 'promote'])->name('siswa.promote');
    // });
    // Route::middleware(['peran:guru'])->group(function(){
        Route::get('data_guru_detail/{id}', [GuruController::class, 'detail'])->name('data_guru.detail');
        Route::get('siswa_guru', [SiswaController::class, 'index_siswa'])->name('siswa.index_siswa');
        Route::get('siswa_kepsek', [GuruController::class, 'index_guru'])->name('siswa.index_guru');
        Route::get('tugas_guru', [GuruController::class, 'tugas_guru'])->name('guru.tugas_guru');
        Route::post('tugas_guru_promote', [GuruController::class, 'tugas_guru_promote'])->name('guru.tugas_guru_promote');
        Route::get('lihat_guru_keluar', [GuruController::class, 'lihat_guru_keluar'])->name('guru.lihat_guru_keluar');



        //----------Nilai-----------
        Route::get('nilai', [App\Http\Controllers\NilaiController::class, 'index'])->name('nilai.index');
        Route::get('manage/{id_kelas}/{id_mapel}', [App\Http\Controllers\NilaiController::class, 'manage'])->name('nilai.manage');
        Route::put('update/{kelas}/{mata_pelajaran}', [App\Http\Controllers\NilaiController::class, 'update'])->name('nilai.update');
        Route::put('comment_update/{exr_id}', [App\Http\Controllers\NilaiController::class, 'comment_update'])->name('nilai.comment_update');
        Route::put('skills_update/{skill}/{exr_id}', [App\Http\Controllers\NilaiController::class, 'skills_update'])->name('nilai.skills_update');
        Route::post('selector', [App\Http\Controllers\NilaiController::class, 'selector'])->name('nilai.selector');
        Route::get('bulk/{kelas?}', [App\Http\Controllers\NilaiController::class, 'bulk'])->name('nilai.bulk');
        Route::post('bulk', [App\Http\Controllers\NilaiController::class, 'bulk_select'])->name('nilai.bulk_select');
        
        Route::get('select_year/{id}', [App\Http\Controllers\NilaiController::class, 'year_selector'])->name('nilai.year_selector');
        Route::post('select_year/{id}', [App\Http\Controllers\NilaiController::class, 'year_selected'])->name('nilai.year_select');
        Route::get('show/{id}/{year}', [App\Http\Controllers\NilaiController::class, 'show'])->name('nilai.show');
        // -------------PDF EXCEL-----------
        Route::get('generate-pdf/{id}/{year}', [App\Http\Controllers\NilaiController::class, 'generatePDF']);
        Route::get('generate-excel/{id}/{year}', [App\Http\Controllers\NilaiController::class, 'generateExcel']);
        Route::get('tesPDF', [App\Http\Controllers\NilaiController::class, 'tesPDF']);
    // });
    // Route::middleware(['peran:guru-admin'])->group(function(){
        Route::get('generate-pdf-siswa', [App\Http\Controllers\SiswaController::class, 'generatePDFSiswa'])->name('generatePDFSiswa');
        Route::get('generate-pdf-kelulusan-siswa', [App\Http\Controllers\SiswaController::class, 'generatePDFKelulusanSiswa'])->name('generatePDFKelulusanSiswa');
        Route::get('generate-excel-siswa', [App\Http\Controllers\SiswaController::class, 'generateExcelSiswa'])->name('generateExcelSiswa');
        Route::get('kepsek_show_graduated', [SiswaController::class, 'kepsek_show_graduated'])->name('siswa.kepsek_show_graduated');

        Route::get('generate-pdf-guru', [App\Http\Controllers\GuruController::class, 'generatePDFGuru'])->name('generatePDFGuru');
        Route::get('generate-excel-guru', [App\Http\Controllers\GuruController::class, 'generateExcelGuru'])->name('generateExcelGuru');
    // });
    // Route::middleware(['peran:guru-siswa'])->group(function(){
        Route::get('/info_guru', [App\Http\Controllers\GuruController::class, 'biodata'])->name('info_guru');
        Route::get('/info_siswa', [App\Http\Controllers\SiswaController::class, 'biodata']);
        Route::get('data_siswa_detail/{id}', [SiswaController::class, 'detail'])->name('data_siswa.detail');

        //----------jadwal-------
        Route::get('jadwal/guru/{id}', [App\Http\Controllers\GuruController::class, 'showJadwalGuru'])->name('jadwal.guru');
        Route::get('jadwal/siswa/{id}', [App\Http\Controllers\SiswaController::class, 'showJadwalSiswa'])->name('jadwal.siswa');
        //---------setting profil-----------
        Route::get('setting', [App\Http\Controllers\AuthController::class, 'edit_profile'])->name('setting');
        Route::put('change_password', [App\Http\Controllers\AuthController::class, 'change_pass'])->name('setting.change_pass');

        Route::get('profil_siswa/{id}', [ProfilController::class, 'profil_siswa'])->name('profil_siswa.index');
        Route::get('profil_guru/{id}', [ProfilController::class, 'profil_guru'])->name('profil_guru.index');
    // });
});

// Route::get('/profile_guru', [App\Http\Controllers\KelolaUserController::class, 'profile_guru'])->name('profile_guru');
// Route::get('/mata-pelajaran', [App\Http\Controllers\MataPelController::class, 'index'])->name('mata-pelajaran.index');

// Route::get('profil', [ProfilController::class, 'index'])->name('profil.index');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
