<?php

use App\Http\Controllers\LocalizationController;
use App\Livewire\Base\Maps;
use App\Livewire\Beranda\Beranda;
use App\Livewire\Berita\Berita;
use App\Livewire\Berita\DetailBerita;
use App\Livewire\Cjibf\Dashboard;
use App\Livewire\Faq\Faq;
use App\Livewire\Kawasan\DetailKawasan;
use App\Livewire\Kawasan\Kawasan;
use App\Livewire\Lokasi\Peta;
use App\Livewire\Profil\DetailProfil;
use App\Livewire\Profil\Profil;
use App\Livewire\Profil\ProfilKabkota;
use App\Livewire\Proyek\DetailProyek;
use App\Livewire\Proyek\Proyek;
use App\Livewire\Proyek\Sektor;
use App\Models\Cjip\ProfileKabkota;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('lang/{language}', [LocalizationController::class, 'switch'])->name('localization.switch');

Route::get('/', Beranda::class)->name('beranda');
Route::get('profil-jateng', Profil::class)->name('profil_jateng');
Route::get('profil-kabkota/{id}', DetailProfil::class)->name('profil_kabkota');

Route::get('berita', Berita::class)->name('berita');
Route::get('detail-berita/{slug}', DetailBerita::class)->name('detail_berita');

Route::get('kawasan-industri', Kawasan::class)->name('kawasan');
Route::get('detail-kawasan-industri/{id}', DetailKawasan::class)->name('detail_kawasan');

Route::get('peluang-investasi', Proyek::class)->name('peluang_investasi');
Route::get('peluang-investasi/{id}', DetailProyek::class)->name('detail_investasi');
Route::get('sektor', Sektor::class)->name('sektor');
// Route::get('profil-kabkota/{id}', ProfilKabKota::class)->name('profil_kabkota');

Route::get('lokasi', Peta::class)->name('peta');

Route::get('cjibf', Dashboard::class)->name('cjibf');

Route::get('panduan-investasi', Faq::class)->name('faq');

Route::get('/loi', function () {
    return view('templates.loi');
});

