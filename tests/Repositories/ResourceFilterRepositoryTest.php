<?php namespace Tests\Repositories;

use App\Models\ResourceFilter;
use App\Repositories\ResourceFilterRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class ResourceFilterRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var ResourceFilterRepository
     */
    protected $resourceFilterRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->resourceFilterRepo = \App::make(ResourceFilterRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_resource_filter()
    {
        $resourceFilter = factory(ResourceFilter::class)->make()->toArray();

        $createdResourceFilter = $this->resourceFilterRepo->create($resourceFilter);

        $createdResourceFilter = $createdResourceFilter->toArray();
        $this->assertArrayHasKey('id', $createdResourceFilter);
        $this->assertNotNull($createdResourceFilter['id'], 'Created ResourceFilter must have id specified');
        $this->assertNotNull(ResourceFilter::find($createdResourceFilter['id']), 'ResourceFilter with given id must be in DB');
        $this->assertModelData($resourceFilter, $createdResourceFilter);
    }

    /**
     * @test read
     */
    public function test_read_resource_filter()
    {
        $resourceFilter = factory(ResourceFilter::class)->create();

        $dbResourceFilter = $this->resourceFilterRepo->find($resourceFilter->id);

        $dbResourceFilter = $dbResourceFilter->toArray();
        $this->assertModelData($resourceFilter->toArray(), $dbResourceFilter);
    }

    /**
     * @test update
     */
    public function test_update_resource_filter()
    {
        $resourceFilter = factory(ResourceFilter::class)->create();
        $fakeResourceFilter = factory(ResourceFilter::class)->make()->toArray();

        $updatedResourceFilter = $this->resourceFilterRepo->update($fakeResourceFilter, $resourceFilter->id);

        $this->assertModelData($fakeResourceFilter, $updatedResourceFilter->toArray());
        $dbResourceFilter = $this->resourceFilterRepo->find($resourceFilter->id);
        $this->assertModelData($fakeResourceFilter, $dbResourceFilter->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_resource_filter()
    {
        $resourceFilter = factory(ResourceFilter::class)->create();

        $resp = $this->resourceFilterRepo->delete($resourceFilter->id);

        $this->assertTrue($resp);
        $this->assertNull(ResourceFilter::find($resourceFilter->id), 'ResourceFilter should not exist in DB');
    }
}
