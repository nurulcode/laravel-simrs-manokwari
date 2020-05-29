<?php

namespace Sty\Tests;

use Sty\ResourceModel;

trait ResourceControllerTestCase
{
    use APITestCase;

    abstract public function resource();

    public function setUp()
    {
        parent::setUp();

        $class    = $this->resource();

        $resource = new $class;

        if (!$resource instanceof ResourceModel) {
            throw new \Exception("Model provided isn't instanceof ResourceModel");
        }
    }

    public function beforePost($resource)
    {
        return $resource->toArray();
    }

    public function beforePut($resource, $existing = null)
    {
        if ($existing) {
            return array_merge(
                $this->beforePost($existing),
                $this->beforePost($resource)
            );
        }
        return $this->beforePost($resource);
    }

    public function matchDatabase($resource)
    {
        return $resource->getAttributes();
    }

    public function getDatabaseConnection($resource)
    {
        return $resource->getConnection()->getConfig('name');
    }

    public function resourceTable($resource)
    {
        return $resource->getTable();
    }

    public function permissionKey()
    {
        return with(new $this->resource())->permissionKeyName();
    }

    /** @test */
    public function resource_only_accessible_by_authorized_user()
    {
        $admin = $this->createAdmin();
        $user  = $this->createUser();

        $resource = factory($this->resource())->create();

        $this->getJson($resource->path('index'))->assertStatus(401);

        $this->postJson($resource->path('store'), [])->assertStatus(401);

        $this->getJson($resource->path)->assertStatus(401);

        $this->putJson($resource->path, [])->assertStatus(401);

        $this->deleteJson($resource->path)->assertStatus(401);

        $this->signIn($user);

        $this->postJson($resource->path('store'), [])->assertStatus(403);

        $this->getJson($resource->path)->assertStatus(403);

        $this->putJson($resource->path, [])->assertStatus(403);

        $this->deleteJson($resource->path)->assertStatus(403);
    }

    /** @test */
    public function user_can_see_resource_collection()
    {
        $collection = factory($this->resource(), 20)->create();

        $this->signIn()
             ->getJson($collection->random()->path('index'))
             ->assertJson(['data' => []])
             ->assertJsonStructure([
                'data'  => ['*' => ['path']]
              ])
             ->assertJsonCount(20, 'data')
             ->assertStatus(200);

        return $this;
    }

    /** @test */
    public function resource_collection_can_be_filtered_over_http()
    {
        $collection = factory($this->resource(), 20)->create();

        $filter     = '?limit=5';

        $this->signIn()
             ->getJson($collection->random()->path('index') . $filter)
             ->assertJson([
                'data'  => [],
                'links' => [],
                'meta'  => [],
             ])
             ->assertJsonStructure([
                'data'  => ['*' => ['path']],
                'links' => [],
                'meta'  => []
              ])
             ->assertJsonCount(5, 'data')
             ->assertStatus(200);

        return $this;
    }

    /** @test **/
    public function user_can_create_a_resource()
    {
        $resource = factory($this->resource())->make();

        $this->signIn()
             ->postJson($resource->path('store'), $this->beforePost($resource))
             ->assertJson(['status' => 'success'])
             ->assertHeader('Location')
             ->assertStatus(201);

        $this->assertDatabaseHas(
            $this->resourceTable($resource),
            $this->matchDatabase($resource),
            $this->getDatabaseConnection($resource)
        );
    }

    /** @test **/
    public function user_can_not_post_empty_data()
    {
        $resource = factory($this->resource())->make();

        $this->signIn()
             ->postJson($resource->path, [])
             ->assertJson(['errors' => []])
             ->assertStatus(422);
    }

    /** @test **/
    public function user_can_view_a_resource()
    {
        $this->withExceptionHandling()
             ->signIn();

        $resource = factory($this->resource())->create();

        $this->getJson($resource->path)
             ->assertJson(['data' => []])
             ->assertStatus(200);
    }

    /** @test **/
    public function user_can_update_a_resource()
    {
        $this->withExceptionHandling()
             ->signIn();

        $resource = factory($this->resource())->create();
        $new_data = factory($this->resource())->make();

        $this->putJson($resource->path, $this->beforePut($new_data, $resource))
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);

        $this->assertDatabaseMissing(
            $this->resourceTable($resource),
            $this->matchDatabase($resource),
            $this->getDatabaseConnection($resource)
        );

        $this->assertDatabaseHas(
            $this->resourceTable($new_data),
            $this->matchDatabase($new_data),
            $this->getDatabaseConnection($resource)
        );
    }

    /** @test */
    public function user_can_not_put_empty_data_to_a_resource()
    {
        $this->withExceptionHandling()
             ->signIn();

        $resource = factory($this->resource())->create();

        $this->putJson($resource->path, [])
             ->assertStatus(422);
    }

    /** @test **/
    public function user_can_delete_a_resource()
    {
        $this->withExceptionHandling()
             ->signIn();

        $resource = factory($this->resource())->create();

        $this->deleteJson($resource->path)
             ->assertJson(['status' => 'success'])
             ->assertStatus(200);

        $this->getJson($resource->path)
             ->assertStatus(404);

        if (method_exists($resource, 'trashed')) {
            $this->assertSoftDeleted(
                $this->resourceTable($resource),
                $this->matchDatabase($resource),
                $this->getDatabaseConnection($resource)
            );
        } else {
            $this->assertDatabaseMissing(
                $this->resourceTable($resource),
                $this->matchDatabase($resource),
                $this->getDatabaseConnection($resource)
            );
        }
    }
}
