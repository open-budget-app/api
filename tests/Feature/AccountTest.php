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

    /**
     * @test
     */
    public function an_account_can_be_created_by_a_user()
    {
        Passport::actingAs($this->user);

        $data = [
          'name' => 'This is a test Account.'
        ];

        $response = $this->json('POST', $this->baseEndpoint, $data);
        $collection = collect(json_decode($response->getContent()));
        $response->assertStatus(201);
        $this->assertNotEmpty($collection);
        $this->assertDatabaseHas('accounts', [
            'name' => 'This is a test Account.',
            'budget_id' => 1,
        ]);
    }

    /**
     * @test
     */
    public function an_account_can_be_updated_by_its_owner()
    {
        Passport::actingAs($this->user);

        $data = [
          'name' => 'I\'ve been updated.'
        ];

        $response = $this->json('PUT', $this->baseEndpoint . '1', $data);
        $updatedAccount = json_decode($response->getContent());

        $response->assertStatus(200);
        $this->assertTrue($updatedAccount->name == 'I\'ve been updated.');
    }

    /**
     * @test
     */
    public function an_account_can_be_delete_by_its_owner()
    {
        Passport::actingAs($this->user);

        $response = $this->json('DELETE', $this->baseEndpoint . '1');

        $response->assertStatus(200);
        $this->assertDatabaseMissing('accounts', [
            'budget_id' => 1,
        ]);
    }

}
