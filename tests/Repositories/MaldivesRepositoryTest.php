<?php namespace Tests\Repositories;

use App\Models\Maldives;
use App\Repositories\MaldivesRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class MaldivesRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var MaldivesRepository
     */
    protected $maldivesRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->maldivesRepo = \App::make(MaldivesRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_maldives()
    {
        $maldives = factory(Maldives::class)->make()->toArray();

        $createdMaldives = $this->maldivesRepo->create($maldives);

        $createdMaldives = $createdMaldives->toArray();
        $this->assertArrayHasKey('id', $createdMaldives);
        $this->assertNotNull($createdMaldives['id'], 'Created Maldives must have id specified');
        $this->assertNotNull(Maldives::find($createdMaldives['id']), 'Maldives with given id must be in DB');
        $this->assertModelData($maldives, $createdMaldives);
    }

    /**
     * @test read
     */
    public function test_read_maldives()
    {
        $maldives = factory(Maldives::class)->create();

        $dbMaldives = $this->maldivesRepo->find($maldives->id);

        $dbMaldives = $dbMaldives->toArray();
        $this->assertModelData($maldives->toArray(), $dbMaldives);
    }

    /**
     * @test update
     */
    public function test_update_maldives()
    {
        $maldives = factory(Maldives::class)->create();
        $fakeMaldives = factory(Maldives::class)->make()->toArray();

        $updatedMaldives = $this->maldivesRepo->update($fakeMaldives, $maldives->id);

        $this->assertModelData($fakeMaldives, $updatedMaldives->toArray());
        $dbMaldives = $this->maldivesRepo->find($maldives->id);
        $this->assertModelData($fakeMaldives, $dbMaldives->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_maldives()
    {
        $maldives = factory(Maldives::class)->create();

        $resp = $this->maldivesRepo->delete($maldives->id);

        $this->assertTrue($resp);
        $this->assertNull(Maldives::find($maldives->id), 'Maldives should not exist in DB');
    }
}
