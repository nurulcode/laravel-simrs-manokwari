<?php

namespace Tests\Feature\Authorization;

use Tests\TestCase;
use Sty\Tests\ResourceControllerTestCase;

class RoleControllerTest extends TestCase
{
    use ResourceControllerTestCase;

    public function resource()
    {
        return \App\Models\Role::class;
    }

    /** @test **/
    public function user_cannot_create_role_with_same_name()
    {
        $resource = factory($this->resource())->create();
        $new_data = factory($this->resource())->make(['name' => $resource->name]);

        $this->withExceptionHandling()
             ->signIn()
             ->postJson($resource->path('store'), $this->beforePost($new_data))
             ->assertJson(['errors' => []])
             ->assertJsonValidationErrors(['name']);
    }

    /** @test **/
    public function user_can_update_role_with_same_name()
    {
        $resource = factory($this->resource())->create();
        $new_data = factory($this->resource())->make(['name' => $resource->name]);

        $this->withExceptionHandling()
             ->signIn()
             ->putJson($resource->path, $this->beforePost($new_data))
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);

        $this->assertDatabaseMissing(
            $this->resourceTable($resource),
            $this->matchDatabase($resource)
        );

        $this->assertDatabaseHas(
            $this->resourceTable($resource),
            $this->matchDatabase($new_data)
        );
    }

    /** @test **/
    public function can_not_update_superadmin_role()
    {
        $resource = factory($this->resource())->create(['name' => 'superadmin']);

        $new_data = factory($this->resource())->make();

        $this->withExceptionHandling()
             ->signIn()
             ->putJson($resource->path, $this->beforePost($new_data))
             ->assertStatus(403);
    }

    /** @test **/
    public function can_not_delete_superadmin_role()
    {
        $resource = factory($this->resource())->create([
            'name' => 'superadmin'
        ]);

        $this->signIn()
             ->deleteJson($resource->path)
             ->assertStatus(403);
    }
}
