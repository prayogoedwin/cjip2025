<?php

use App\Http\Controllers\Map\MapController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\{
    Authcontroller,
    Beritacontroller,
    Kawasanindustricontroller,
    Proyekcontroller,
    Cjibfcontroller,
    Kabkotacontroller,
    Emailcontroller,
    Usercontroller,
    Profilinvestorcontroller,
    Sektorcontroller,
    Sosmedcontroller,
    Settingcontroller,
    Interestcontroller,
    Othercontroller,
    Oneononecontroller,
    Berandacontroller,
    Slidercontroller,
    Configcontroller,
    Infrastrukturcontroller
};
use App\Http\Controllers\api\v2\SatuData\RilisApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route::get('koordinat/id', [MapController::class, 'koordinat']);
// Route::get('bounding', [MapController::class, 'bounding']);

// Config
Route::get('phone', [Configcontroller::class, 'gethp']);

// Setting
// Route::group(['prefix' => 'setting'], function () {
//     Route::get('/why', [Settingcontroller::class, 'why']);
//     // Route::get('/why/en', [Settingcontroller::class, 'whyen']);
// });

// Cjibf
Route::get('cjibf', [Cjibfcontroller::class, 'cjibf']);

// Infrastructure
Route::get('infra', [Infrastrukturcontroller::class, 'getinfrastucture']);

// Slider
Route::get('slider', [Slidercontroller::class, 'get']);
// Route::get('en/slider', [Slidercontroller::class, 'enget']);

// Berita
Route::group(['prefix' => 'berita'], function () {
    Route::get('/', [Beritacontroller::class, 'berita']);
    // Route::get('/en', [Beritacontroller::class, 'enberita']);
});

// Kawasan Industri
Route::group(['prefix' => 'kawasan'], function () {
    Route::get('/', [Kawasanindustricontroller::class, 'ki2']);
    Route::post('/search', [Kawasanindustricontroller::class, 'search']);
    // Route::get('/en', [Kawasanindustricontroller::class, 'enki2']);
    // Route::post('/search/en', [Kawasanindustricontroller::class, 'ensearch']);
});

// Proyek
Route::group(['prefix' => 'proyek'], function () {
    Route::get('/', [Proyekcontroller::class, 'allproyek']);
    Route::post('/', [Proyekcontroller::class, 'getbyid']);
    Route::post('market', [Proyekcontroller::class, 'proyek']);
    Route::post('penanggungjawab', [Kabkotacontroller::class, 'detailkabkota']);
    Route::post('bysektor', [Proyekcontroller::class, 'sektor']);
    Route::post('search', [Proyekcontroller::class, 'search']);
    Route::post('searchsektor', [Proyekcontroller::class, 'searchsektor']);

    // Route::post('market/en', [Proyekcontroller::class, 'enproyek']);
    // Route::post('bysektor/en', [Proyekcontroller::class, 'enbysektor']);
    // Route::post('search/en', [Proyekcontroller::class, 'ensearch']);
    // Route::post('searchsektor/en', [Proyekcontroller::class, 'ensearchsektor']);
});

// Tes Email
Route::get('sendmail', [Emailcontroller::class, 'sendmail']);

// Registrasi
Route::post('registrasi', [Usercontroller::class, 'register']);

// Sosmed
Route::group(['prefix' => 'sosmed'], function () {
    Route::post('registrasi', [Sosmedcontroller::class, 'registrasi']);
    Route::post('login', [Sosmedcontroller::class, 'login']);
});

// Beranda
Route::group(['prefix' => 'beranda'], function () {
    Route::get('/berita', [Berandacontroller::class, 'berita']);
    Route::get('/kawasan', [Berandacontroller::class, 'kawasan']);
    // Route::get('en/berita', [Berandacontroller::class, 'enberita']);
    // Route::get('en/kawasan', [Berandacontroller::class, 'enkawasan']);
});

// Login
Route::post('login', [Authcontroller::class, 'login']);

// Forgot password
Route::post('/usr/forgot', [Usercontroller::class, 'forgot']);

Route::group(['middleware' => ['auth:api']], function () {
    // user
    Route::group(['prefix' => 'usr'], function () {
        Route::get('/', [Authcontroller::class, 'userdetail']);
        Route::post('/change', [Usercontroller::class, 'changepass']);
    });

    // Sektor
    Route::get('sektor', [Sektorcontroller::class, 'getsektor']);

    // Interest Proyek
    Route::group(['prefix' => 'interest'], function () {
        Route::get('cart', [Interestcontroller::class, 'interest']);
        Route::group(['prefix' => 'proyek'], function () {
            Route::get('cart', [Interestcontroller::class, 'interest_proyek']);
            Route::post('/', [Proyekcontroller::class, 'getproyek']);
            // Route::post('/en', [Proyekcontroller::class, 'engetproyek']);
            Route::post('addtocart', [Interestcontroller::class, 'addtocart']);
            Route::post('remove', [Interestcontroller::class, 'remove']);
            Route::post('destroy', [Interestcontroller::class, 'destroy']);
            Route::post('filter', [Proyekcontroller::class, 'proyekinterest']);
            // Route::post('filter/en', [Proyekcontroller::class, 'enproyekinterest']);
        });
        Route::group(['prefix' => 'kawasan'], function () {
            Route::get('/', [Kawasanindustricontroller::class, 'ki']);
            // Route::get('/en', [Kawasanindustricontroller::class, 'enki']);
            Route::get('cart', [Kawasanindustricontroller::class, 'cart']);
            Route::post('addtocart', [Kawasanindustricontroller::class, 'addtocart']);
            Route::post('remove', [Kawasanindustricontroller::class, 'remove']);
            Route::post('destroy', [Kawasanindustricontroller::class, 'destroy']);
        });
        Route::group(['prefix' => 'other'], function () {
            Route::get('cart', [Othercontroller::class, 'cart']);
            Route::get('kabkota', [Othercontroller::class, 'kabkota']);
            Route::post('addtocart', [Othercontroller::class, 'addtocart']);
            Route::post('destroy', [Othercontroller::class, 'destroy']);
        });
    });

    // One on one meeting
    Route::group(['prefix' => 'o3m'], function () {
        Route::get('/proyek', [Oneononecontroller::class, 'findproyek']);
        Route::get('/kawasan', [Oneononecontroller::class, 'findkawasan']);
        Route::get('/other', [Oneononecontroller::class, 'findother']);
        Route::post('/', [Oneononecontroller::class, 'store']);
        Route::get('/', [Oneononecontroller::class, 'get']);
    });

    // Kota
    Route::get('/kabkota', [Kabkotacontroller::class, 'getkota']);

    // Profil investor
    Route::group(['prefix' => 'profil'], function () {
        Route::post('/store', [Profilinvestorcontroller::class, 'store']);
        Route::post('/edit', [Profilinvestorcontroller::class, 'update']);
    });

    Route::post('logout', [Authcontroller::class, 'logout']);
});

Route::group(['middleware' => ['auth.basic']], function () {
    //SIDAK
    Route::get('/proyeks', [\App\Http\Controllers\api\v2\ProyekController::class, 'index']);
    Route::get('/pengawasan', [\App\Http\Controllers\api\v2\ProyekController::class, 'pengawasan']); // with request
    Route::get('/baps', [\App\Http\Controllers\api\v2\BapController::class, 'index']);
    Route::get('/nibs', [\App\Http\Controllers\api\v2\NibController::class, 'index']);
    Route::post('/update-fasilitasi', [\App\Http\Controllers\api\v2\ProyekController::class, 'updateStatusFasilitasi']); // with request
    Route::post('/update-pembinaan', [\App\Http\Controllers\api\v2\ProyekController::class, 'updateStatusPembinaan']); // with request

    //SIDAK LoI
    Route::get('/lois', [\App\Http\Controllers\api\v2\LoiController::class, 'index']);
    Route::get('/proyek-investasi', [\App\Http\Controllers\api\v2\ProyekInvestasiController::class, 'index']);
    Route::get('/kawasan-industri', [\App\Http\Controllers\api\v2\KawasanIndustriController::class, 'index']);
    Route::get('/events', [\App\Http\Controllers\api\v2\EventController::class, 'index']);
    Route::get('/kab-kota', [\App\Http\Controllers\api\v2\KabKotaController::class, 'index']);

    //SIDAK WAJIB MITRA
    Route::get('/proyek-wajib-mitra', [\App\Http\Controllers\api\v2\ProyekController::class, 'wajibMitra']);

    //SIDAK INVESTASI
    Route::get('/rilis', [\App\Http\Controllers\api\v2\RilisController::class, 'index']);
    Route::get('/bap-rilis', [\App\Http\Controllers\api\v2\RilisController::class, 'bapRilis']); // with request

    // SIMIKE
    Route::post('/simike-import', [\App\Http\Controllers\api\v2\SimikeController::class, 'import']);
    Route::get('/simike-import-status/{batchId}', [\App\Http\Controllers\api\v2\SimikeController::class, 'checkImportStatus']);
});

Route::middleware(['sanctum_auth'])->group(function () {
    Route::get('/pmdn-sektor', [RilisApiController::class, 'pmdnSektor'])->middleware(['auth', 'sanctum']);
    Route::get('/pmdn-kabkota', [RilisApiController::class, 'pmdnKabkota'])->middleware(['auth', 'sanctum']);
    Route::get('/pma-sektor', [RilisApiController::class, 'pmaSektor'])->middleware(['auth', 'sanctum']);
    Route::get('/pma-kabkota', [RilisApiController::class, 'pmaKabkota'])->middleware(['auth', 'sanctum']);
    Route::get('/pma-negara', [RilisApiController::class, 'pmaNegara'])->middleware(['auth', 'sanctum']);
    Route::get('/tenaga-kerja', [RilisApiController::class, 'tenagaKerja'])->middleware(['auth', 'sanctum']);

    Route::get('/kawasan-industri', [\App\Http\Controllers\api\v2\SatuData\KawasanIndustriApiController::class, 'index'])->middleware(['auth', 'sanctum']);

    Route::get('/e-makaryo/nib', [\App\Http\Controllers\api\v2\EMakaryo\PerusahaanController::class, 'index'])->middleware(['auth', 'sanctum']);
});
