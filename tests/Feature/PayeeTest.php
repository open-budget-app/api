<?php

namespace Tests\Feature;

use App\Payee;
use App\Budget;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class PayeeTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $budget;
    private $baseEndpoint;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->user->budgets()->save(factory(Budget::class)->create());
        $this->budget = $this->user->budgets()->first();
        $this->budget->payees()->saveMany(factory(Payee::class, 5)->create());
        $this->baseEndpoint = '/api/budgets/' . $this->budget->id . '/payees/';
    }

    /**
     * @test
     */
    public function all_payees_can_be_retrieved_by_an_owner()
    {
        Passport::actingAs($this->user);

        $response = $this->json('GET', $this->baseEndpoint);
        $collection = collect(json_decode($response->getContent()));

        $response->assertStatus(200);
        $this->assertEquals(5, $collection->count());
    }

    /**
     * @test
     */
    public function a_payee_can_be_retrieved_by_its_owner()
    {
        Passport::actingAs($this->user);

        $response = $this->json('GET', $this->baseEndpoint . '1');
        $collection = collect(json_decode($response->getContent()));

        $response->assertStatus(200);
        $this->assertNotEmpty($collection);
    }
}
