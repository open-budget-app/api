<?php

namespace Tests\Feature;

use App\Category;
use App\CategoryBudget;
use App\CategoryGroup;
use App\Budget;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Passport\Passport;
use Tests\TestCase;

class CategoryBudgetTest extends TestCase
{
    use RefreshDatabase;

    private $user;
    private $budget;
    private $categoryGroup;
    private $category;
    private $baseEndpoint;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->create();
        $this->budget = $this->user->budgets()->save(factory(Budget::class)->create());
        $this->categoryGroup = $this->budget->categoryGroups()->save(factory(CategoryGroup::class)->create());
        $this->category = $this->categoryGroup->categories()->save(factory(Category::class)->create());
        $this->category->categoryBudgets()->saveMany(factory(CategoryBudget::class, 5)->create());
        $this->baseEndpoint = '/api/budgets/' .
            $this->budget->id . '/category_groups/' .
            $this->categoryGroup->id . '/categories/' .
            $this->category->id . '/category_budgets';
    }

    /**
     * @test
     */
    public function all_category_budgets_can_be_retrieved_by_an_owner()
    {
        Passport::actingAs($this->user);

        $response = $this->json('GET', $this->baseEndpoint);
        $collection = collect(json_decode($response->getContent()));
        
        $response->assertStatus(200);
        $this->assertEquals(5, $collection->count());
    }
}
