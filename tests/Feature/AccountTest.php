<?php

namespace Tests\Feature;

use App\Account;
use App\Budget;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class AccountTest extends TestCase
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
        $this->budget->accounts()->save(factory(Account::class)->create());
        $this->baseEndpoint = '/api/budgets/' . $this->budget->id . '/accounts/';
    }

    /**
     * @test
     */
    public function all_accounts_can_be_retrieved_by_an_owner()
    {
        Passport::actingAs($this->user);

        $response = $this->json('GET', $this->baseEndpoint);
        $collection = collect(json_decode($response->getContent()));

        $response->assertStatus(200);
        $this->assertEquals(1, $collection->count());
    }

    /**
     * @test
     */
    public function an_account_can_be_retrieved_by_its_owner()
    {
      Passport::actingAs($this->user);

      $response = $this->json('GET', $this->baseEndpoint . '1');
      $collection = collect(json_decode($response->getContent()));

      $response->assertStatus(200);
      $this->assertNotEmpty($collection);
    }

}
