<?php

namespace Tests\Unit;

use App\Budget;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BudgetTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * @test
     */
    public function a_budget_can_have_a_name()
    {
        $budget = new Budget;
        $budget->name = 'My Budget';
        $budget->save();

        $this->assertEquals(1, Budget::all()->count());
    }

    /**
     * @test
     */
    public function a_budget_name_can_not_be_empty()
    {
        $this->expectException('Illuminate\Database\QueryException');

        $budget = new Budget;
        $budget->save();
    }
}
