<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Risk;

class RiskApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_risk()
    {
        $risk = factory(Risk::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/risks', $risk
        );

        $this->assertApiResponse($risk);
    }

    /**
     * @test
     */
    public function test_read_risk()
    {
        $risk = factory(Risk::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/risks/'.$risk->id
        );

        $this->assertApiResponse($risk->toArray());
    }

    /**
     * @test
     */
    public function test_update_risk()
    {
        $risk = factory(Risk::class)->create();
        $editedRisk = factory(Risk::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/risks/'.$risk->id,
            $editedRisk
        );

        $this->assertApiResponse($editedRisk);
    }

    /**
     * @test
     */
    public function test_delete_risk()
    {
        $risk = factory(Risk::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/risks/'.$risk->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/risks/'.$risk->id
        );

        $this->response->assertStatus(404);
    }
}
