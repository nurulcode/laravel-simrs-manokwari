<?php

use App\Seeder;
use App\Models\Tarif;
use App\Enums\JenisTarif;
use App\Enums\KelasTarif;
use App\Models\Master\Oksigen;
use App\Models\Fasilitas\Ruangan;
use App\Models\Master\JenisVisite;
use App\Models\Master\JenisRegistrasi;
use App\Models\Master\PerawatanKhusus;
use App\Models\Master\TindakanPemeriksaan;
use App\Models\Master\Gizi;

class TarifSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->seeds([
            Gizi::class                => ['tarif_gizi.csv', 13],
            JenisRegistrasi::class     => ['tarif_registrasi.csv', 7],
            JenisVisite::class         => ['tarif_visite.csv', 6],
            Oksigen::class             => ['tarif_oksigen.csv', 2],
            PerawatanKhusus::class     => ['tarif_keperawatan.csv', 4],
            Ruangan::class             => ['tarif_ruangan.csv', 15],
            TindakanPemeriksaan::class => ['tarif_tindakan_pemeriksaan.csv', 856],
        ]);
    }

    public function seed($class, $path, $output, $parameters = [])
    {
        $this->title($class);

        $file = new SplFileObject(database_path('seeds/data/tarif/' . $path));

        $file->setFlags(SplFileObject::READ_CSV | SplFileObject::SKIP_EMPTY);

        $cmdOutput   = $this->command->getOutput();

        $progressBar = $cmdOutput->createProgressBar($output);

        $progressBar->start();

        while ($row = $file->fgetcsv()) {
            [$id, $kelas, $sarana, $pelayanan, $bhp] = $row;

            Tarif::updateOrCreate([
                'tarifable_type' => $class,
                'tarifable_id'   => $id,
            ], [
                'tarif'          => [
                    KelasTarif::getKey((string) $kelas) => [
                        JenisTarif::SARANA    => $sarana,
                        JenisTarif::PELAYANAN => $pelayanan,
                        JenisTarif::BHP       => $bhp
                    ]
                ]
            ]);

            $progressBar->advance(1);
        }

        $progressBar->finish();

        $cmdOutput->newLine(2);
    }
}
