<?php

namespace App\Http\Controllers;

use App\Payee;
use App\Budget;
use App\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PayeeStoreRequest;
use App\Http\Requests\PayeeUpdateRequest;

class PayeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($budgetId)
    {
        $budget = Auth::user()->budgets()->findOrFail($budgetId);
        return $budget->payees;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\PayeeStoreRequest $request
     * @param  \App\Budget $budget
     * @return \Illuminate\Http\Response
     */
    public function store(PayeeStoreRequest $request, Budget $budget)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
        $data = $request->validated();

        if (array_has($request->validated(), 'account_id')) {
            $name = Account::find($request->validated()['account_id'])->name;
            $data = array_add($request->validated(), 'name' , $name);
        }
        
        return $budget
            ->payees()
            ->save(
                Payee::make(
                    $data
                )
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Payee $payee
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget, Payee $payee)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
        return $payee;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\PayeeUpdateRequest $request
     * @param  \App\Payee $payee
     * @return \Illuminate\Http\Response
     */
    public function update(PayeeUpdateRequest $request, Budget $budget, Payee $payee)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
        $budget->payees()->findOrFail($payee->id);
        $payee->update($request->validated());
        return $payee;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Payee $payee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget, Payee $payee)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
        $budget->payees()->findOrFail($payee->id);
        $payee->delete();
        return response(['message' => 'Payee deleted.'], 200);
    }
}
