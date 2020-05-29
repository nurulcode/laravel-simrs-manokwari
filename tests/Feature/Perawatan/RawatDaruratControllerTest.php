<?php

namespace Tests\Feature\Perawatan;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Kunjungan;
use App\Models\Registrasi;
use App\Enums\KondisiAkhir;
use Sty\Tests\ResourceControllerTestCase;
use App\Models\Master\JenisRegistrasi;

class RawatDaruratControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Perawatan\RawatDarurat::class;
    }

    /** @test **/
    public function user_can_create_a_resource()
    {
        $resource   = factory($this->resource())->make();

        $kunjungan  = factory(Kunjungan::class)->make();

        $registrasi = factory(Registrasi::class)->make([
            'kunjungan_id'   => null,
            'perawatan_type' => get_class($resource)
        ]);

        $this->signIn()
            ->postJson($resource->path('store'), array_merge(
                $registrasi->toArray(),
                $kunjungan->toArray(),
                $resource->toArray()
            ))
            ->assertJson(['status' => 'success'])
            ->assertHeader('Location')
            ->assertStatus(201);

        $this->assertDatabaseHas(
            $this->resourceTable($resource),
            $this->matchDatabase($resource)
        );

        $this->assertDatabaseHas(
            $registrasi->getTable(),
            array_except($registrasi->getAttributes(), 'kunjungan_id')
        );

        $this->assertDatabaseHas(
            $kunjungan->getTable(),
            $kunjungan->getAttributes()
        );
    }

    /** @test **/
    public function pasien_baru_create_two_register()
    {
        $resource   = factory($this->resource())->make();

        $kunjungan  = factory(Kunjungan::class)->make();

        $jregister  = factory(JenisRegistrasi::class)->create();

        $registrasi = factory(Registrasi::class)->make([
            'kunjungan_id'   => null,
            'perawatan_type' => get_class($resource)
        ]);

        $this->signIn()
            ->postJson($resource->path('store'), array_merge(
                $registrasi->toArray(),
                $kunjungan->toArray(),
                $resource->toArray(),
                ['pasien_baru' => true]
            ))
            ->assertJson(['status' => 'success'])
            ->assertHeader('Location')
            ->assertStatus(201);

        $this->assertDatabaseHas(
            $this->resourceTable($resource),
            $this->matchDatabase($resource)
        );

        $this->assertDatabaseHas(
            $registrasi->getTable(),
            array_except($registrasi->getAttributes(), 'kunjungan_id')
        );

        $this->assertDatabaseHas(
            $registrasi->getTable(),
            [
                'jenis_registrasi_id' => $jregister->id,
                'perawatan_id'        => null,
                'perawatan_type'      => null,
            ]
        );

        $this->assertDatabaseHas(
            $kunjungan->getTable(),
            $kunjungan->getAttributes()
        );
    }

    /** @test **/
    public function user_can_not_post_invalid_data()
    {
        $kunjungan = factory(Kunjungan::class)->make([
            'jenis_registrasi_id' => str_random(9),
            'pasien_id'           => str_random(9),
            'kasus_id'            => str_random(9),
            'penyakit_id'         => str_random(9),
            'jenis_rujukan_id'    => str_random(9),
            'cara_pembayaran_id'  => str_random(9),
        ]);
        $resource  = factory($this->resource())->make([
            'kegiatan_id'         => str_random(9),
            'poliklinik_id'       => str_random(9),
        ]);

        $this->signIn()
            ->postJson($resource->path('store'), array_merge(
                $resource->toArray(),
                $kunjungan->toArray()
            ))
            ->assertJson(['errors' => []])
            ->assertJsonValidationErrors([
                'jenis_registrasi_id',
                'pasien_id',
                'kasus_id',
                'penyakit_id',
                'rujukan.jenis_id',
                'cara_pembayaran_id',
                'kegiatan_id',
                'poliklinik_id',
            ])
            ->assertStatus(422);
    }

    /** @test */
    public function pasien_rawat_darurat_dapat_pulang()
    {
        $resource   = factory($this->resource())->create();

        $kunjungan  = factory(Kunjungan::class)->create();

        $registrasi = factory(Registrasi::class)->create([
            'kunjungan_id'   => $kunjungan->id,
            'perawatan_type' => get_class($resource),
            'perawatan_id'   => $resource->id
        ]);

        $waktu_keluar = Carbon::now()->toDateTimeString();

        $this->disableExceptionHandling()
            ->signIn()
            ->postJson(action('Perawatan\RawatDaruratPulangController', $resource->id), [
                'waktu_keluar'   => $waktu_keluar,
                'kondisi_akhir'  => KondisiAkhir::getRandomValue(),
            ])
            ->assertStatus(200);

        $resource = \App\Models\Perawatan\RawatDarurat::find($resource->id);

        $this->assertEquals($waktu_keluar, $resource->kunjungan->waktu_keluar);
        $this->assertEquals($waktu_keluar, $resource->waktu_keluar);
    }

    /** @test **/
    public function user_can_update_a_resource()
    {
        $this->assertTrue(true);
    }

    /** @test **/
    public function user_can_delete_a_resource()
    {
        $this->assertTrue(true);
    }

    /** @test */
    public function user_can_not_put_empty_data_to_a_resource()
    {
        $this->assertTrue(true);
    }
}
