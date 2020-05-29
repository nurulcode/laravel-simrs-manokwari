<?php

namespace Tests\Unit\Kepegawaian;

use Tests\TestCase;
use Illuminate\Support\Collection;
use App\Models\Kepegawaian\Jabatan;
use App\Models\Kepegawaian\Pegawai;

class JabatanTest extends TestCase
{
    /** @test */
    public function resource_may_has_many_pegawai()
    {
        $jabatan = factory(Jabatan::class)->create();

        factory(Pegawai::class, 10)->create(['jabatan_id' => $jabatan->id]);

        $this->assertInstanceOf(Collection::class, $jabatan->pegawais);
        $this->assertInstanceOf(Pegawai::class, $jabatan->pegawais->random());
    }
}
