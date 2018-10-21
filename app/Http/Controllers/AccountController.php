<?php

namespace App\Http\Controllers;

use App\Account;
use App\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\AccountStoreRequest;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($budgetId)
    {
        $budget = Auth::user()->budgets()->findOrFail($budgetId);
        return $budget->accounts;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\AccountStoreRequest $request
     * @param  \App\Budget $budget
     * @return \Illuminate\Http\Response
     */
    public function store(AccountStoreRequest $request, Budget $budget)
    {
        return $budget
            ->accounts()
            ->save(
                Account::make(
                    $request->validated()
                )
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Account $account
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget, Account $account)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
        return $account;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Account $account
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Account $account)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Account $account
     * @return \Illuminate\Http\Response
     */
    public function destroy(Account $account)
    {
        //
    }
}
