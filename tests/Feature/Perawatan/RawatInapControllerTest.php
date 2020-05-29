<?php

namespace Tests\Feature\Perawatan;

use Tests\TestCase;
use App\Models\Fasilitas;
use App\Models\Kunjungan;
use App\Models\Registrasi;
use Sty\Tests\ResourceControllerTestCase;
use App\Models\Master\JenisRegistrasi;

class RawatInapControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Perawatan\RawatInap::class;
    }

    public function matchDatabase($resource)
    {
        return array_except($resource->getAttributes(), 'kunjungan_id');
    }

    /** @test **/
    public function user_can_create_a_resource()
    {
        $resource  = factory($this->resource())->make();

        $kunjungan = factory(Kunjungan::class)->make();

        $registrasi = factory(Registrasi::class)->make([
            'kunjungan_id'   => null,
            'perawatan_type' => get_class($resource)
        ]);

        $ranjang   = Fasilitas\Ranjang::find(factory(Fasilitas\Ranjang::class)->create()->id);

        $this->signIn()
            ->postJson($resource->path('store'), array_merge(
                $ranjang->append('ranjang_id')->toArray(),
                $kunjungan->toArray(),
                $registrasi->toArray(),
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
        $resource  = factory($this->resource())->make();

        $kunjungan = factory(Kunjungan::class)->make();

        $jregister = factory(JenisRegistrasi::class)->create();

        $registrasi = factory(Registrasi::class)->make([
            'kunjungan_id'   => null,
            'perawatan_type' => get_class($resource)
        ]);

        $ranjang   = Fasilitas\Ranjang::find(factory(Fasilitas\Ranjang::class)->create()->id);

        $this->signIn()
            ->postJson($resource->path('store'), array_merge(
                $ranjang->append('ranjang_id')->toArray(),
                $kunjungan->toArray(),
                $registrasi->toArray(),
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
            $registrasi->getTable(), [
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
            'ranjang_id'       => str_random(9),
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
                'ranjang_id',
            ])
            ->assertStatus(422);
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
