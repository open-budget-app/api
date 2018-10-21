<?php

namespace App\Http\Controllers;

use App\Account;
use App\Budget;
use App\Http\Requests\AccountStoreRequest;
use App\Http\Requests\AccountUpdateRequest;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $budgetId
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
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function store(AccountStoreRequest $request, Budget $budget)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
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
     * @param Budget $budget
     * @param  \App\Account $account
     * @return Account
     */
    public function show(Budget $budget, Account $account)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
        return $account;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\AccountUpdateRequest $request
     * @param Budget $budget
     * @param  \App\Account $account
     * @return Account
     */
    public function update(AccountUpdateRequest $request, Budget $budget, Account $account)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
        $budget->accounts()->findOrFail($account->id);
        $account->update($request->validated());
        return $account;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Budget $budget
     * @param  \App\Account $account
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Budget $budget, Account $account)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
        $account->delete();
        return response(['message' => 'Account deleted.'], 200);
    }
}
