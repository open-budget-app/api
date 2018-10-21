<?php

namespace App\Http\Controllers;

use App\CategoryGroup;
use App\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryGroupStoreRequest;
use App\Http\Requests\CategoryGroupUpdateRequest;

class CategoryGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($budgetId)
    {
        $budget = Auth::user()->budgets()->findOrFail($budgetId);
        return $budget->categoryGroups;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryGroupStoreRequest $request
     * @param  \App\Budget $budget
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryGroupStoreRequest $request, Budget $budget)
    {
      Auth::user()->budgets()->findOrFail($budget->id);

      return $budget
          ->categoryGroups()
          ->save(
              CategoryGroup::make(
                  $request->validated()
              )
          );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Budget $budget
     * @param  \App\CategoryGroup $categoryGroup
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget, CategoryGroup $categoryGroup)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
        $budget->categoryGroups()->findOrFail($categoryGroup->id);
        return $categoryGroup;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryGroupUpdateRequest $request
     * @param  \App\Budget $budget
     * @param  \App\CategoryGroup $categoryGroup
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryGroupUpdateRequest $request, Budget $budget, CategoryGroup $categoryGroup)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
        $budget->categoryGroups()->findOrFail($categoryGroup->id);
        $categoryGroup->update($request->validated());
        return $categoryGroup;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Budget $budget
     * @param  \App\CategoryGroup $categoryGroup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Budget $budget, CategoryGroup $categoryGroup)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
        $budget->categoryGroups()->findOrFail($categoryGroup->id);
        $categoryGroup->delete();
        return response(['message' => 'CategoryGroup deleted.'], 200);
    }
}
