<?php

namespace Tests\Unit;

use App\Budget;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class BudgetTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function a_budget_must_have_a_name()
    {
        $budget = new Budget;
        $budget->user_id = 1;
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
