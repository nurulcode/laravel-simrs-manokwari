<?php

use Carbon\Carbon;
use Sty\CsvSeeder;
use App\Enums\StatusPernikahan;
use Illuminate\Database\Seeder;

class PasienTableSeeder extends Seeder
{
    protected $rekam_medis           = [];
    protected $duplicate_rekam_medis = [];

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        with(new CsvSeeder('pasiens', database_path('seeds/data/pasiens.csv')))
            ->setProgressOutput($this->command->getOutput(), 95345)
            ->select([
                0,  // ID
                2,  // Tanggal Registrasi
                1,  // Nomor Rekam Medis
                5,  // Jenis Identitas
                6,  // Nomor Indentitas
                7,  // Nama Pasien
                13, // Tempat lahir
                14, // Tanggal Lahir
                8,  // Jenis Kelamin
                34, // NULL
                9,  // Agama
                12, // Suku
                10, // Pendidikan
                20, // Pekerjaan
                17, // Alamat
                34, // NULL
                19, // Telepon
                25, // Nama Ayah
                26, // Nama Ibu
                34, // NULL
                34, // NULL
                21, // Status Pernikahan
                27  // Nama Pasangangan
            ])
            ->beforeEach([$this, 'mapIdentitas'])
            ->beforeEach([$this, 'mapAgama'])
            ->beforeEach([$this, 'mapPendidikan'])
            ->beforeEach([$this, 'mapPekerjaan'])
            ->beforeEach([$this, 'mapSuku'])
            ->beforeEach([$this, 'mapStatus'])
            ->beforeEach([$this, 'fixDataPasien'])
            ->seed();
    }

    public function fixDataPasien($data)
    {
        if (in_array($data['no_rekam_medis'], $this->rekam_medis)) {
            array_push($this->duplicate_rekam_medis, $data['no_rekam_medis']);

            $data['no_rekam_medis'] = $data['no_rekam_medis'] . ' (Duplikat dengan ID:' . $data['id'] . ')';
        }

        if (empty($data['tanggal_registrasi'])) {
            $data['tanggal_registrasi'] = Carbon::create(1972, 1, 1, 0, 0, 0);
        }

        if (!empty($data['tanggal_lahir'])) {
            $data['tanggal_lahir'] = Carbon::createFromFormat('Y-m-d', $data['tanggal_lahir']);
        }

        if (empty($data['nomor_identitas'])) {
            $data['nomor_identitas'] = '-';
        }

        if (!empty($data['nama'])) {
            $data['nama'] = trim($data['nama'], ' ');
            $data['nama'] = ltrim($data['nama'], '.');
            $data['nama'] = strtoupper($data['nama']);
        }

        if (!empty($data['nama_ayah'])) {
            $data['nama_ayah'] = strtoupper($data['nama_ayah']);
        }

        if (!empty($data['nama_ibu'])) {
            $data['nama_ibu'] = strtoupper($data['nama_ibu']);
        }

        array_push($this->rekam_medis, $data['no_rekam_medis']);

        return $data;
    }

    public function mapIdentitas($data)
    {
        switch ($data['jenis_identitas_id']) {
            case 'Kartu BPJS':
                $data['jenis_identitas_id'] = 6;
                break;
            case 'KTP':
                $data['jenis_identitas_id'] = 1;
                break;
            case 'Kartu Asuransi Lainnya':
                $data['jenis_identitas_id'] = 9;
                break;
            case 'Kartu Jamkesmas':
                $data['jenis_identitas_id'] = 7;
                break;
            case 'Kartu Askes':
                $data['jenis_identitas_id'] = 8;
                break;
            case 'Akte':
                $data['jenis_identitas_id'] = 5;
                break;
            case 'SIM':
                $data['jenis_identitas_id'] = 2;
                break;
            case 'Kartu Pelajar':
                $data['jenis_identitas_id'] = 3;
                break;
            case 'Kartu Keluarga':
                $data['jenis_identitas_id'] = 4;
                break;
            default:
                $data['jenis_identitas_id'] = 10;
                break;
        }

        return $data;
    }

    public function mapAgama($data)
    {
        switch ($data['agama_id']) {
            case 'Islam':
                $data['agama_id'] = 1;
                break;
            case 'Protestan':
                $data['agama_id'] = 3;
                break;
            case 'Khatolik':
                $data['agama_id'] = 2;
                break;
            case 'Hindu':
                $data['agama_id'] = 4;
                break;
            case 'Budha':
                $data['agama_id'] = 5;
                break;
            case null:
                $data['agama_id'] = null;
                break;
            default:
                $data['agama_id'] = 7;
                break;
        }

        return $data;
    }

    public function mapPendidikan($data)
    {
        switch ($data['pendidikan_id']) {
            case 'S1':
            case 'D4':
                $data['pendidikan_id'] = 7;
                break;
            case 'SLTA':
                $data['pendidikan_id'] = 3;
                break;
            case 'SD':
                $data['pendidikan_id'] = 1;
                break;
            case 'SLTP':
                $data['pendidikan_id'] = 2;
                break;
            case 'D3':
                $data['pendidikan_id'] = 6;
                break;
            case 'D2':
                $data['pendidikan_id'] = 5;
                break;
            case 'D1':
                $data['pendidikan_id'] = 4;
                break;
            case 'S2':
                $data['pendidikan_id'] = 8;
                break;
            case 'S3':
                $data['pendidikan_id'] = 9;
                break;
            case 'Tidak Ada':
                $data['pendidikan_id'] = 10;
                break;
            default:
                $data['pendidikan_id'] = null;
                break;
        }

        return $data;
    }

    public function mapStatus($data)
    {
        switch ($data['status_pernikahan']) {
            case 'Belum Kawin':
                $data['status_pernikahan'] = StatusPernikahan::BELUM_MENIKAH;
                break;
            case 'Kawin':
                $data['status_pernikahan'] = StatusPernikahan::MENIKAH;
                break;
            case 'Janda':
                $data['status_pernikahan'] = StatusPernikahan::JANDA;
                break;
            case 'Duda':
                $data['status_pernikahan'] = StatusPernikahan::DUDA;
                break;
            default:
                $data['status_pernikahan'] = null;
                break;
        }

        return $data;
    }

    public function mapSuku($data)
    {
        switch ($data['suku_id']) {
            case 'Bugis':
                $data['suku_id'] = 8;
                break;
            case 'Papua':
                $data['suku_id'] = 1;
                break;
            case 'Batak':
                $data['suku_id'] = 4;
                break;
            case 'Makassar':
                $data['suku_id'] = 12;
                break;
            case 'Jawa':
                $data['suku_id'] = 2;
                break;
            case 'Toraja':
                $data['suku_id'] = 14;
                break;
            case 'Sunda':
                $data['suku_id'] = 3;
                break;
            case null:
                $data['suku_id'] = null;
                break;
            default:
                $data['suku_id'] = 15;
                break;
        }

        return $data;
    }

    public function mapPekerjaan($data)
    {
        switch ($data['pekerjaan_id']) {
            case 'PNS':
                $data['pekerjaan_id'] = 4;
                break;
            case 'PELAJAR':
            case 'PELAJAR SMP':
            case 'PELAJAR SD':
                $data['pekerjaan_id'] = 1;
                break;
            case 'SWASTA':
                $data['pekerjaan_id'] = 10;
                break;
            case 'MAHASISWA':
            case 'MAHASISWI':
                $data['pekerjaan_id'] = 2;
                break;
            case 'PENDETA':
                $data['pekerjaan_id'] = 11 ;
                break;
            case 'WIRASWASTA':
                $data['pekerjaan_id'] = 3;
                break;
            case 'TNI':
                $data['pekerjaan_id'] = 5;
                break;
            case 'PENSIUNAN':
            case 'PURNAWIRAWAN':
            case 'PENSIUNAN PORI':
            case 'PENSIUNAN PNS':
            case 'PENSIUNAN TNI AD':
                $data['pekerjaan_id'] = 7;
                break;
            case 'TIDAK ADA':
                $data['pekerjaan_id'] = 13;
                break;
            case 'IRT':
            case 'IRT BAHARI':
            case 'IBU RUMAH TANGGA':
                $data['pekerjaan_id'] = 8;
                break;
            case null:
                $data['pekerjaan_id'] = null;
                break;
            default:
                $data['pekerjaan_id'] = 12;
                break;
        }

        return $data;
    }
}
