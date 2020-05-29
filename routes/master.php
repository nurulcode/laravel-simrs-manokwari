<?php

Route::namespace('Master')->group(function () {
    /*  */
    Route::apiResources([
        'agama'                => 'AgamaController',
        'cara-pembayaran'      => 'CaraPembayaranController',
        'gizi'                 => 'GiziController',
        'insenerator'          => 'InseneratorController',
        'jenis-identitas'      => 'JenisIdentitasController',
        'jenis-laundry'        => 'JenisLaundryController',
        'jenis-logistik'       => 'JenisLogistikController',
        'jenis-poliklinik'     => 'JenisPoliklinikController',
        'jenis-registrasi'     => 'JenisRegistrasiController',
        'jenis-rujukan'        => 'JenisRujukanController',
        'jenis-visite'         => 'JenisVisiteController',
        'kasus'                => 'KasusController',
        'kategori-kegiatan'    => 'KategoriKegiatanController',
        'kegiatan'             => 'KegiatanController',
        'oksigen'              => 'OksigenController',
        'pekerjaan'            => 'PekerjaanController',
        'pemeriksaan-jenazah'  => 'PemeriksaanJenazahController',
        'pemeriksaan-umum'     => 'PemeriksaanUmumController',
        'pendidikan'           => 'PendidikanController',
        'perawatan-khusus'     => 'PerawatanKhususController',
        'prosedur'             => 'ProsedurController',
        'suku'                 => 'SukuController',
        'tindakan-operasi'     => 'TindakanOperasiController',
        'tindakan-pemeriksaan' => 'TindakanPemeriksaanController',
        'tipe-diagnosa'        => 'TipeDiagnosaController',
    ]);

    Route::apiResource('utdrs', 'UtdrsController')->parameters(['utdrs' => 'utdrs']);

    Route::namespace('Wilayah')->prefix('wilayah')->name('wilayah.')->group(function () {
        Route::apiResources([
            'provinsi'       => 'ProvinsiController',
            'kota-kabupaten' => 'KotaKabupatenController',
            'kecamatan'      => 'KecamatanController',
            'kelurahan'      => 'KelurahanController',
        ]);
    });

    Route::namespace('Penyakit')->prefix('penyakit')->name('penyakit.')->group(function () {
        Route::apiResources([
            'klasifikasi'    => 'KlasifikasiPenyakitController',
            'kelompok'       => 'KelompokPenyakitController',
            'penyakit'       => 'PenyakitController'
        ]);
    });
});
