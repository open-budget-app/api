<?php

namespace Tests\Unit;

use App\Category;
use App\CategoryGroup;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoryGroupTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_category_group_can_have_a_category()
    {
        // Create a new categoryGroup
        $categoryGroup = factory(CategoryGroup::class)->create([
            'name' => 'Fixed Expenses',
        ]);

        // Create a new category
        $category = new Category([
            'name' => 'Rent'
        ]);

        // Create a new category
        $categoryGroup->categories()->save(
            $category
        );

        // Assert that the categoryGroup name is the same
        $this->assertEquals('Fixed Expenses', Category::first()->categoryGroup->name);
    }
}
