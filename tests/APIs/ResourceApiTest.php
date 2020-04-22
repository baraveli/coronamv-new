<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Resource;

class ResourceApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_resource()
    {
        $resource = factory(Resource::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/resources', $resource
        );

        $this->assertApiResponse($resource);
    }

    /**
     * @test
     */
    public function test_read_resource()
    {
        $resource = factory(Resource::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/resources/'.$resource->id
        );

        $this->assertApiResponse($resource->toArray());
    }

    /**
     * @test
     */
    public function test_update_resource()
    {
        $resource = factory(Resource::class)->create();
        $editedResource = factory(Resource::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/resources/'.$resource->id,
            $editedResource
        );

        $this->assertApiResponse($editedResource);
    }

    /**
     * @test
     */
    public function test_delete_resource()
    {
        $resource = factory(Resource::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/resources/'.$resource->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/resources/'.$resource->id
        );

        $this->response->assertStatus(404);
    }
}
