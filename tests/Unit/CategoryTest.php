<?php

namespace Tests\Unit;

use App\Category;
use App\CategoryGroup;
use Tests\TestCase;

class CategoryTest extends TestCase
{
    /**
     * @test
     * @expectedException \Illuminate\Database\QueryException
     */
    public function a_category_name_must_be_unique_in_the_same_category_group()
    {
        $categoryGroup = factory(CategoryGroup::class)->create();

        $categoryGroup->categories()->save(factory(Category::class)->make([
            'name' => 'Rent'
        ]));

        $categoryGroup->categories()->save(factory(Category::class)->make([
            'name' => 'Rent'
        ]));
    }
}
