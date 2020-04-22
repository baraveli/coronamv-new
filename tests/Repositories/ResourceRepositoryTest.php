<?php namespace Tests\Repositories;

use App\Models\Resource;
use App\Repositories\ResourceRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ResourceRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ResourceRepository
     */
    protected $resourceRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->resourceRepo = \App::make(ResourceRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_resource()
    {
        $resource = factory(Resource::class)->make()->toArray();

        $createdResource = $this->resourceRepo->create($resource);

        $createdResource = $createdResource->toArray();
        $this->assertArrayHasKey('id', $createdResource);
        $this->assertNotNull($createdResource['id'], 'Created Resource must have id specified');
        $this->assertNotNull(Resource::find($createdResource['id']), 'Resource with given id must be in DB');
        $this->assertModelData($resource, $createdResource);
    }

    /**
     * @test read
     */
    public function test_read_resource()
    {
        $resource = factory(Resource::class)->create();

        $dbResource = $this->resourceRepo->find($resource->id);

        $dbResource = $dbResource->toArray();
        $this->assertModelData($resource->toArray(), $dbResource);
    }

    /**
     * @test update
     */
    public function test_update_resource()
    {
        $resource = factory(Resource::class)->create();
        $fakeResource = factory(Resource::class)->make()->toArray();

        $updatedResource = $this->resourceRepo->update($fakeResource, $resource->id);

        $this->assertModelData($fakeResource, $updatedResource->toArray());
        $dbResource = $this->resourceRepo->find($resource->id);
        $this->assertModelData($fakeResource, $dbResource->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_resource()
    {
        $resource = factory(Resource::class)->create();

        $resp = $this->resourceRepo->delete($resource->id);

        $this->assertTrue($resp);
        $this->assertNull(Resource::find($resource->id), 'Resource should not exist in DB');
    }
}
