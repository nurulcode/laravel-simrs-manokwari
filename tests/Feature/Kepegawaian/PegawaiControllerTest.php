<?php

namespace Tests\Feature\Kepegawaian;

use Tests\TestCase;
use App\Models\Kepegawaian\Jabatan;
use App\Models\Kepegawaian\Kualifikasi;
use Sty\Tests\ResourceControllerTestCase;
use Sty\Tests\ResourceViewTestCase;

class PegawaiControllerTest extends TestCase
{
    use ResourceControllerTestCase, ResourceViewTestCase;

    public function resource()
    {
        return \App\Models\Kepegawaian\Pegawai::class;
    }

    public function viewpath()
    {
        return url('kepegawaian');
    }

    /** @test */
    public function user_cant_post_invalid_data()
    {
        $resource = factory($this->resource())->make();

        $this->signIn()
            ->postJson($resource->path, array_merge($this->beforePost($resource),
                [
                    'kualifikasi_id' => str_random(5),
                    'jabatan_id'     => str_random(5),
                    'jenis_kelamin'  => str_random(5),
                    'tanggal_lahir'  => str_random(5),
                ]
            ))
            ->assertJson(['errors' => []])
            ->assertJsonValidationErrors([
                'kualifikasi_id',
                'jabatan_id',
                'jenis_kelamin',
                'tanggal_lahir'
            ])
            ->assertStatus(422);
    }

    /** @test */
    public function user_can_filter_collection_by_kualifikasi()
    {
        $kualifikasi = factory(Kualifikasi::class)->create();

        $pegawai = factory($this->resource(), 5)->create([
            'kualifikasi_id' => $kualifikasi->id
        ]);

        $lainnya = factory($this->resource(), 5)->create();

        $controller = 'Kepegawaian\PegawaiController@index';

        $this->signIn()
             ->getJson(action($controller) . '?kualifikasi=' . $kualifikasi->id)
             ->assertJson(['data' => []])
             ->assertJsonCount(5, 'data')
             ->assertStatus(200);
    }

    /** @test */
    public function user_can_filter_collection_by_jabatan()
    {
        $jabatan = factory(Jabatan::class)->create();

        $pegawai = factory($this->resource(), 5)->create(['jabatan_id' => $jabatan->id]);

        $lainnya = factory($this->resource(), 5)->create();

        $controller = 'Kepegawaian\PegawaiController@index';

        $this->signIn()
             ->getJson(action($controller) . '?jabatan=' . $jabatan->id)
             ->assertJson(['data' => []])
             ->assertJsonCount(5, 'data')
             ->assertStatus(200);
    }
}
