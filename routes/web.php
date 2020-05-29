<?php

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
Auth::routes([
    'register' => false,
    'reset'    => false,
    'verify'   => false,
]);

Route::middleware(['auth'])->group(function () {
    Route::get('/', 'HomeController@index');
    Route::get('/activities', 'ActivityController@view');

    Route::middleware('can:manage_role')->group(function () {
        Route::view('role', 'role');
    });

    Route::middleware('can:manage_user')->group(function () {
        Route::view('user', 'user');
    });

    Route::middleware('can:manage_fasilitas')->group(function () {
        Route::view('fasilitas', 'fasilitas.index');
    });

    Route::middleware('can:manage_tarif')->group(function () {
        Route::view('tarif', 'tarif.index');
    });

    Route::middleware('can:manage_pasien')->group(function () {
        Route::view('pasien', 'pasien');
    });

    Route::middleware('can:manage_permission')->group(function () {
        Route::view('permission', 'permission');
    });

    Route::middleware('can:manage_kepegawaian')->group(function () {
        Route::view('kepegawaian', 'kepegawaian.index');
    });

    Route::middleware('can:manage_logistik')->group(function () {
        Route::view('logistik',             'logistik.index');
        Route::view('logistik/stock',       'logistik.stock');
        Route::view('logistik/penerimaan',  'logistik.penerimaan');
        Route::view('suplier',              'logistik.suplier');
    });

    Route::resource('kunjungan', 'KunjunganWebController')->only(['index', 'show']);

    Route::get('kunjungan/{kunjungan}/cetak', 'KunjunganCetakController');

    Route::namespace('Perawatan')->prefix('perawatan')->group(function () {
        Route::resource('rawat-jalan', 'RawatJalanWebController')
            ->only(['index', 'create', 'show']);

        Route::resource('rawat-darurat', 'RawatDaruratWebController')
            ->only(['index', 'create', 'show']);

        Route::resource('rawat-inap', 'RawatInapWebController')
            ->only(['index', 'create', 'show']);
    });

    Route::namespace('Penunjang')->prefix('penunjang')->group(function () {
        Route::resource('apotek', 'ApotekController')
            ->only(['index', 'show'])
            ->middleware('can:manage_apotek');
        Route::resource('laboratorium', 'LaboratoriumController')
            ->only(['index', 'show'])
            ->middleware('can:manage_laboratorium');
        Route::resource('radiologi', 'RadiologiController')
            ->only(['index', 'show'])
            ->middleware('can:manage_radiologi');
        Route::resource('rehabilitasi-medik', 'RehabilitasiMedikController')
            ->only(['index', 'show'])
            ->middleware('can:manage_rehabilitasi_medik');
        Route::resource('operasi', 'OperasiController')
            ->only(['index', 'show'])
            ->middleware('can:manage_operasi');
        Route::resource('insenerator', 'InseneratorController')
            ->only(['index', 'show'])
            ->middleware('can:manage_insenerator');
        Route::resource('utdrs', 'UtdrsController')
            ->parameters(['utdrs' => 'utdrs'])
            ->only(['index', 'show'])
            ->middleware('can:manage_utdrs');
        Route::resource('kamar-jenazah', 'KamarJenazahController')
            ->only(['index', 'show'])
            ->middleware('can:manage_kamar_jenazah');
    });

    Route::middleware('can:manage_master_data')
        ->prefix('master')
        ->group(function () {
            Route::view('agama',               'master.agama');
            Route::view('cara-pembayaran',     'master.cara-pembayaran');
            Route::view('gizi',                'master.gizi');
            Route::view('insenerator',         'master.insenerator');
            Route::view('jenis-identitas',     'master.jenis-identitas');
            Route::view('jenis-laundry',       'master.jenis-laundry');
            Route::view('jenis-logistik',      'master.jenis-logistik');
            Route::view('jenis-poliklinik',    'master.jenis-poliklinik');
            Route::view('jenis-registrasi',    'master.jenis-registrasi');
            Route::view('jenis-rujukan',       'master.jenis-rujukan');
            Route::view('jenis-visite',        'master.jenis-visite');
            Route::view('kasus',               'master.kasus');
            Route::view('kegiatan',            'master.kegiatan');
            Route::view('oksigen',             'master.oksigen');
            Route::view('pekerjaan',           'master.pekerjaan');
            Route::view('pemeriksaan-jenazah', 'master.pemeriksaan-jenazah');
            Route::view('pemeriksaan-umum',    'master.pemeriksaan-umum');
            Route::view('pendidikan',          'master.pendidikan');
            Route::view('penyakit',            'master.penyakit.index');
            Route::view('perawatan-khusus',    'master.perawatan-khusus');
            Route::view('prosedur',            'master.prosedur');
            Route::view('suku',                'master.suku');
            Route::view('tindakan',            'master.tindakan-pemeriksaan');
            Route::view('tindakan-operasi',    'master.tindakan-operasi');
            Route::view('tipe-diagnosa',       'master.tipe-diagnosa');
            Route::view('utdrs',               'master.utdrs');
            Route::view('wilayah',             'master.wilayah.index');
        });
});
