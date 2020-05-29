<?php


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

Route::middleware(['auth:api'])->group(function () {
    Route::put('user/password',      'UserPasswordUpdateController')->name('user.password');
    Route::put('user/{user}/toggle', 'UserActivationToggleController')->name('user.toggle');

    Route::post('tarif', 'StoreTarifController');

    Route::apiResources([
        'activity'    => 'ActivityController',
        'kunjungan'   => 'KunjunganController',
        'pasien'      => 'PasienController',
        'permission'  => 'PermissionController',
        'role'        => 'RoleController',
        'user'        => 'UserController',
    ]);

    Route::namespace('Kepegawaian')->prefix('kepegawaian')->group(function () {
        Route::apiResources([
            'jabatan'     => 'JabatanController',
            'kategori'    => 'KategoriKualifikasiController',
            'kualifikasi' => 'KualifikasiController',
            'pegawai'     => 'PegawaiController',
        ]);
    });

    Route::namespace('Fasilitas')->prefix('fasilitas')->group(function () {
        /*  */
        Route::apiResources([
            'poliklinik' => 'PoliklinikController',
            'ruangan'    => 'RuanganController',
            'kamar'      => 'KamarController',
            'ranjang'    => 'RanjangController',
        ]);
    });

    Route::namespace('Logistik')->prefix('logistik')->group(function () {
        /*  */
        Route::apiResources([
            'logistik'   => 'LogistikController',
            'suplier'    => 'SuplierController',
            'penerimaan' => 'PenerimaanController',
            'transaksi'  => 'TransaksiController',
        ]);

        Route::post('transfer', 'TransferLogistikController');

        Route::get('stock',  'StockLogistikController@index');

        Route::post('stock', 'StockLogistikController@update');
    });

    Route::prefix('master')->group(base_path('routes/master.php'));

    Route::prefix('layanan')->group(base_path('routes/layanan.php'));

    Route::prefix('perawatan')->group(base_path('routes/perawatan.php'));
});

//TODO: Hapus saat production
Route::get('client', function () {
    return response()->json(
        DB::table('oauth_clients')->select('*')->where('password_client', 1)->first()
    );
});
