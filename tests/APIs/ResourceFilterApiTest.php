<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\ResourceFilter;

class ResourceFilterApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_resource_filter()
    {
        $resourceFilter = factory(ResourceFilter::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/resource_filters', $resourceFilter
        );

        $this->assertApiResponse($resourceFilter);
    }

    /**
     * @test
     */
    public function test_read_resource_filter()
    {
        $resourceFilter = factory(ResourceFilter::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/resource_filters/'.$resourceFilter->id
        );

        $this->assertApiResponse($resourceFilter->toArray());
    }

    /**
     * @test
     */
    public function test_update_resource_filter()
    {
        $resourceFilter = factory(ResourceFilter::class)->create();
        $editedResourceFilter = factory(ResourceFilter::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/resource_filters/'.$resourceFilter->id,
            $editedResourceFilter
        );

        $this->assertApiResponse($editedResourceFilter);
    }

    /**
     * @test
     */
    public function test_delete_resource_filter()
    {
        $resourceFilter = factory(ResourceFilter::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/resource_filters/'.$resourceFilter->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/resource_filters/'.$resourceFilter->id
        );

        $this->response->assertStatus(404);
    }
}
