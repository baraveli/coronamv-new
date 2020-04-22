<?php namespace Tests\APIs;

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;
use Tests\ApiTestTrait;
use App\Models\Maldives;

class MaldivesApiTest extends TestCase
{
    use ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function test_create_maldives()
    {
        $maldives = factory(Maldives::class)->make()->toArray();

        $this->response = $this->json(
            'POST',
            '/api/maldives', $maldives
        );

        $this->assertApiResponse($maldives);
    }

    /**
     * @test
     */
    public function test_read_maldives()
    {
        $maldives = factory(Maldives::class)->create();

        $this->response = $this->json(
            'GET',
            '/api/maldives/'.$maldives->id
        );

        $this->assertApiResponse($maldives->toArray());
    }

    /**
     * @test
     */
    public function test_update_maldives()
    {
        $maldives = factory(Maldives::class)->create();
        $editedMaldives = factory(Maldives::class)->make()->toArray();

        $this->response = $this->json(
            'PUT',
            '/api/maldives/'.$maldives->id,
            $editedMaldives
        );

        $this->assertApiResponse($editedMaldives);
    }

    /**
     * @test
     */
    public function test_delete_maldives()
    {
        $maldives = factory(Maldives::class)->create();

        $this->response = $this->json(
            'DELETE',
             '/api/maldives/'.$maldives->id
         );

        $this->assertApiSuccess();
        $this->response = $this->json(
            'GET',
            '/api/maldives/'.$maldives->id
        );

        $this->response->assertStatus(404);
    }
}
