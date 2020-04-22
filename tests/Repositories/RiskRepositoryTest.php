<?php namespace Tests\Repositories;

use App\Models\Risk;
use App\Repositories\RiskRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;

class RiskRepositoryTest extends TestCase
{
    use ApiTestTrait, DatabaseTransactions;

    /**
     * @var RiskRepository
     */
    protected $riskRepo;

    public function setUp() : void
    {
        parent::setUp();
        $this->riskRepo = \App::make(RiskRepository::class);
    }

    /**
     * @test create
     */
    public function test_create_risk()
    {
        $risk = factory(Risk::class)->make()->toArray();

        $createdRisk = $this->riskRepo->create($risk);

        $createdRisk = $createdRisk->toArray();
        $this->assertArrayHasKey('id', $createdRisk);
        $this->assertNotNull($createdRisk['id'], 'Created Risk must have id specified');
        $this->assertNotNull(Risk::find($createdRisk['id']), 'Risk with given id must be in DB');
        $this->assertModelData($risk, $createdRisk);
    }

    /**
     * @test read
     */
    public function test_read_risk()
    {
        $risk = factory(Risk::class)->create();

        $dbRisk = $this->riskRepo->find($risk->id);

        $dbRisk = $dbRisk->toArray();
        $this->assertModelData($risk->toArray(), $dbRisk);
    }

    /**
     * @test update
     */
    public function test_update_risk()
    {
        $risk = factory(Risk::class)->create();
        $fakeRisk = factory(Risk::class)->make()->toArray();

        $updatedRisk = $this->riskRepo->update($fakeRisk, $risk->id);

        $this->assertModelData($fakeRisk, $updatedRisk->toArray());
        $dbRisk = $this->riskRepo->find($risk->id);
        $this->assertModelData($fakeRisk, $dbRisk->toArray());
    }

    /**
     * @test delete
     */
    public function test_delete_risk()
    {
        $risk = factory(Risk::class)->create();

        $resp = $this->riskRepo->delete($risk->id);

        $this->assertTrue($resp);
        $this->assertNull(Risk::find($risk->id), 'Risk should not exist in DB');
    }
}
