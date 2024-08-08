<?php

use App\Http\Controllers\KaprodiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
Route::get('/info-akun/{id}', [ProfileController::class, 'info'])->name('kaprodi.info');

// Rute untuk kaprodi mengelola dosen

Route::get('/kaprodi', [KaprodiController::class, 'index'])->name('kaprodi.index')->middleware('useraccess:kaprodi');
Route::prefix('kaprodi/dosen')->name('kaprodi.dosen.')->middleware('auth')->group(function () {
    Route::get('/', [KaprodiController::class, 'indexDosen'])->name('index')->middleware('useraccess:kaprodi');
    Route::get('/create', [KaprodiController::class, 'createDosen'])->name('create')->middleware('useraccess:kaprodi');
    Route::post('/store', [KaprodiController::class, 'storeDosen'])->name('store')->middleware('useraccess:kaprodi');
    Route::get('/{dosen_id}/edit', [KaprodiController::class, 'editDosen'])->name('edit')->middleware('useraccess:kaprodi');
    Route::put('/{dosen_id}', [KaprodiController::class, 'updateDosen'])->name('update')->middleware('useraccess:kaprodi');
    Route::delete('/{dosen_id}', [KaprodiController::class, 'destroyDosen'])->name('destroy')->middleware('useraccess:kaprodi');
})->middleware('useraccess:kaprodi');

Route::get('/kaprodi/dosen', [KaprodiController::class, 'cariNamaDosen'])->name('kaprodi.dosen.index')->middleware('useraccess:kaprodi');
Route::get('/kaprodi/mahasiswa', [KaprodiController::class, 'cariNamaKelas'])->name('kaprodi.mahasiswa.index')->middleware('useraccess:kaprodi');


// Rute untuk kaprodi mengelola kelas
Route::prefix('kaprodi/kelas')->name('kaprodi.kelas.')->middleware('auth')->group(function () {
    Route::get('/', [KaprodiController::class, 'indexKelas'])->name('index')->middleware('useraccess:kaprodi');
    Route::get('/create', [KaprodiController::class, 'createKelas'])->name('create')->middleware('useraccess:kaprodi');
    Route::post('/store', [KaprodiController::class, 'storeKelas'])->name('store')->middleware('useraccess:kaprodi');
    Route::get('/{id}/edit', [KaprodiController::class, 'editKelas'])->name('edit')->middleware('useraccess:kaprodi');
    Route::put('/{id}', [KaprodiController::class, 'updateKelas'])->name('update')->middleware('useraccess:kaprodi');
    Route::delete('/{id}', [KaprodiController::class, 'destroyKelas'])->name('destroy')->middleware('useraccess:kaprodi');
});

Route::middleware('useraccess:kaprodi')->group(function () {
    Route::get('/kaprodi/plot/index', [KaprodiController::class, 'indexPlot'])->name('kaprodi.plot.index')->middleware('useraccess:kaprodi');
    Route::get('/kaprodi/plot/dosen/coba', [KaprodiController::class, 'plotDosenCoba'])->name('kaprodi.plot.dosen');
    Route::post('/kaprodi/dosen/update-kelas', [KaprodiController::class, 'updateKelasDosen'])->name('kaprodi.dosen.update.kelas');
    Route::delete('/dosen/{id}', [KaprodiController::class, 'destroyKelasDosen'])->name('kaprodi.dosen.destroy')->middleware('useraccess:kaprodi');
    Route::get('/kaprodi/plot/mahasiswa/coba', [KaprodiController::class, 'plotMahasiswaCoba'])->name('kaprodi.plot.mahasiswa');
    Route::post('/kaprodi/mahasiswa/update-kelas', [KaprodiController::class, 'updateKelasMahasiswa'])->name('kaprodi.mahasiswa.update.kelas');
    Route::delete('/mahasiswa/{id}', [KaprodiController::class, 'destroyKelasMahasiswa'])->name('kaprodi.mahasiswa.destroy')->middleware('useraccess:kaprodi');
});

require __DIR__ . '/auth.php';
