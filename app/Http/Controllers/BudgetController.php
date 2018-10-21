<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Http\Requests\BudgetStoreRequest;
use App\Http\Requests\BudgetUpdateRequest;
use Illuminate\Support\Facades\Auth;

class BudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Auth::user()->budgets;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param BudgetStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(BudgetStoreRequest $request)
    {
        return Auth::user()
            ->budgets()
            ->save(
                Budget::make(
                    $request->validated()
                )
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Budget $budget
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget)
    {
        return Auth::user()->budgets()->findOrFail($budget->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param BudgetUpdateRequest $request
     * @param  \App\Budget $budget
     * @return Budget
     */
    public function update(BudgetUpdateRequest $request, Budget $budget)
    {
        Auth::user()->budgets()->findOrFail($budget->id);

        $budget->update($request->validated());

        return $budget;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Budget $budget
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Budget $budget)
    {
        Auth::user()->budgets()->findOrFail($budget->id);

        $budget->delete();

        return response(['message' => 'Budget deleted'], 200);
    }
}
