<?php

namespace Tests\Feature;

use App\Budget;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class BudgetTest extends TestCase
{
    use RefreshDatabase;

    private $budget;
    private $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->budget = factory(Budget::class)->create();

        $this->user->budgets()->saveMany(factory(Budget::class, 3)->create());
    }

    /**
     * @test
     */
    public function all_budgets_can_be_retrieved_by_a_owner()
    {
        Passport::actingAs($this->user);

        $response = $this->json('GET', '/api/budgets');
        $collection = collect(json_decode($response->getContent()));

        $response->assertStatus(200);
        $this->assertEquals(3, $collection->count());

    }

    /**
     * @test
     */
    public function a_budget_can_be_created_by_a_user()
    {
        Passport::actingAs($this->user);

        $response = $this->json('POST', '/api/budgets', [
            'name' => 'My budget',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseHas('budgets', [
            'name' => 'My budget',
            'user_id' => $this->user->id,
        ]);
    }

    /**
     * @test
     */
    public function a_budget_can_be_retrieved_by_an_owner()
    {
        Passport::actingAs($this->user);

        $response = $this->json('GET', '/api/budgets/' . $this->user->budgets->first()->id);
        $collection = collect(json_decode($response->getContent()));

        $response->assertStatus(200);
        $this->assertNotEmpty($collection);

    }

    /**
     * @test
     */
    public function a_budget_can_only_retrieved_by_its_owner()
    {
        Passport::actingAs($this->user);

        $budgetNotOwnedByUser = factory(Budget::class)->create();

        $response = $this->json('GET', '/api/budgets/' . $budgetNotOwnedByUser->id);
        $response->assertStatus(404);

    }

    /**
     * @test
     */
    public function a_budget_can_be_updated_by_its_owner()
    {
        Passport::actingAs($this->user);

        $budget = $this->user->budgets()->first();

        $response = $this->json('PUT', '/api/budgets/' . $budget->id, [
            'name' => 'New budget name'
        ]);

        $updatedBudget = $this->user->budgets()->first();


        $response->assertStatus(200);
        $this->assertContains('New budget name', $response->getContent());
        $this->assertTrue($updatedBudget->name == 'New budget name');
    }

    /**
     * @test
     */
    public function a_budget_can_only_be_updated_by_its_owner()
    {
        Passport::actingAs($this->user);

        $budgetNotOwnedByUser = factory(Budget::class)->create();

        $response = $this->json('PUT', '/api/budgets/' . $budgetNotOwnedByUser->id, [
            'name' => 'New budget name'
        ]);

        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function a_budget_can_be_delete_by_its_owner()
    {
        Passport::actingAs($this->user);

        $budget = $this->user->budgets()->first();

        $response = $this->json('DELETE', '/api/budgets/' . $budget->id);

        $response->assertStatus(200);
        $this->assertDatabaseMissing('budgets', [
            'id' => $budget->id,
        ]);
    }

    /**
     * @test
     */
    public function a_budget_can_only_be_delete_by_its_owner()
    {
        Passport::actingAs($this->user);

        $budgetNotOwnedByUser = factory(Budget::class)->create();

        $response = $this->json('DELETE', '/api/budgets/' . $budgetNotOwnedByUser->id);

        $response->assertStatus(404);
        $this->assertDatabaseHas('budgets', [
            'id' => $budgetNotOwnedByUser->id,
        ]);
    }
}
