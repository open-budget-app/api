<?php

namespace Tests\Unit;

use App\Account;
use App\Budget;
use Tests\TestCase;
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
            'name' => 'Budget of Tom',
        ]);

        // Create a new account
        $account = new Account([
            'name' => 'Bank of Acme'
        ]);

        // Create a new account
        $budget->accounts()->save(
            $account
        );

        // Assert that the budget name is the same
        $this->assertEquals('Budget of Tom', Account::first()->budget->name);
    }
}