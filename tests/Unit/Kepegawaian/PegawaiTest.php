<?php

namespace Tests\Unit\Kepegawaian;

use Tests\TestCase;
use App\Models\Kepegawaian\Jabatan;
use App\Models\Kepegawaian\Pegawai;
use App\Models\Kepegawaian\Kualifikasi;

class PegawaiTest extends TestCase
{
    /** @test */
    public function resource_belongs_to_jabatan()
    {
        $pegawai = factory(Pegawai::class)->create();

        $this->assertInstanceof(Jabatan::class, $pegawai->jabatan);
    }

    /** @test */
    public function resource_belongs_to_kualifikasi()
    {
        $pegawai = factory(Pegawai::class)->create();

        $this->assertInstanceof(Kualifikasi::class, $pegawai->kualifikasi);
    }
}
