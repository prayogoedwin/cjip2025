<?php

use App\Http\Controllers\LocalizationController;
use App\Livewire\Base\Maps;
use App\Livewire\Beranda\Beranda;
use App\Livewire\Berita\Berita;
use App\Livewire\Berita\DetailBerita;
use App\Livewire\Cjibf\Dashboard;
use App\Livewire\Faq\Faq;
use App\Livewire\Frontend\Auth\Login;
use App\Livewire\Frontend\Auth\Profile;
use App\Livewire\Frontend\Auth\Register;
use App\Livewire\Frontend\Dashboard as FrontendDashboard;
use App\Livewire\Frontend\Kemitraan\Minat\DetailMinatKeluar;
use App\Livewire\Frontend\Kemitraan\Minat\DetailMinatMasuk;
use App\Livewire\Frontend\Kemitraan\Minat\MinatKeluar;
use App\Livewire\Frontend\Kemitraan\Minat\MinatMasuk;
use App\Livewire\Frontend\Kemitraan\Produk\DetailProduct;
use App\Livewire\Frontend\Kemitraan\Produk\ProductAdd;
use App\Livewire\Frontend\Kemitraan\Produk\ProductAll;
use App\Livewire\Frontend\Kemitraan\Produk\ProductDetail;
use App\Livewire\Frontend\Kemitraan\Produk\ProductEdit;
use App\Livewire\Frontend\Kemitraan\Produk\ProductList;
use App\Livewire\Frontend\Kemitraan\Produk\ProductMe;
use App\Livewire\Frontend\Kepeminatan\BerandaPengajuan;
use App\Livewire\Frontend\Kepeminatan\Surat\DownloadLoi;
use App\Livewire\Frontend\Kepeminatan\SuratKepeminatan;
use App\Livewire\Frontend\MasterDashboard;
use App\Livewire\Frontend\Sinida\RiwayatPengajuan;
use App\Livewire\Frontend\Sinida\Surat\PaktaIntegritas;
use App\Livewire\Frontend\Sinida\SuratPengajuan;
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

Route::get('register', Register::class)->name('register');
Route::get('login', Login::class, 'login')->name('login');

// Kepeminatan
Route::get('kepeminatan', BerandaPengajuan::class)->name('pengajuan.kepeminatan');
Route::get('/success', function () {
    return view('success');
});
Route::get('product-all', ProductList::class)->name('product');
Route::get('product/{slug}', DetailProduct::class)->name('product.detail');

Route::middleware(['auth', 'auth.investor'])->prefix('dashboard')->group(function () {

    // Kemitraan
    Route::get('product-me', ProductMe::class)->name('product.me');
    Route::get('product-kemitraan', ProductAll::class)->name('product-kemitraan');
    Route::get('add-product', ProductAdd::class)->name('add-product'); // perbaikan
    Route::get('edit-product/{id}', ProductEdit::class)->name('edit-product'); // perbaikan
    Route::get('product-kemitraan/{slug}', ProductDetail::class)->name('detail.product');
    Route::get('minat-masuk', MinatMasuk::class)->name('kemitraan.minat-masuk');
    Route::get('minat-masuk/{id}', DetailMinatMasuk::class)->name('detail.minat-masuk');

    Route::get('minat-keluar', MinatKeluar::class)->name('kemitraan.minat-keluar');
    Route::get('minat-keluar/{slug}', DetailMinatKeluar::class)->name('detail.minat-keluar');

    // Kepeminatan
    Route::get('/', MasterDashboard::class)->name('dashboard.investor');
    Route::get('/', FrontendDashboard::class)->name('dashboard.investor');
    Route::get('profile', Profile::class)->name('dashboard.profile'); // perbaikan
    Route::get('kepeminatan', SuratKepeminatan::class)->name('dashboard.kepeminatan');
    // Route::get('download-loi/{id}', DownloadLoi::class)->name('download-loi');
    // Route::get('riwayat-kepeminatan', RiwayatPengajuan::class)->name('dashboard.riwayat-kepeminatan');


    // Sinida
    Route::get('sinida', SuratPengajuan::class)->name('dashboard.sinida');
    Route::get('riwayat-sinida', RiwayatPengajuan::class)->name('dashboard.riwayat-sinida');
    Route::get('pakta-integritas', PaktaIntegritas::class)->name('pakta-integritas');
    // Route::get('pernyataan-tidak-menerima-intensif', PernyataanTidakMenerimaInsentif::class)->name('pernyataan-tidak-menerima-intensif');
});
Route::get('download-loi/{id}', DownloadLoi::class)->name('download-loi');
