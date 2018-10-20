<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Http\Requests\BudgetStoreRequest;
use Illuminate\Http\Request;
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

        if ($budget->user_id == Auth::id()) {
            return $budget;
        }

        return response("Unauthorized", 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Budget $budget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Budget $budget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Budget $budget
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget)
    {
        //
    }
}
