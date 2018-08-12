<?php

namespace Tests\Unit;

use App\Account;
use App\Budget;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AccountTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function an_account_can_be_added_to_a_budget()
    {
        // Create a new budget
        $budget = factory(Budget::class)->create([
            'name' => 'My budget',
        ]);

        // Create a new account
        $account = new Account([
            'name' => 'My account'
        ]);

        // Create a new account
        $budget->accounts()->save(
            $account
        );

        // Assert that the budget name is the same
        $this->assertEquals('My budget', Account::first()->budget->name);
    }
}