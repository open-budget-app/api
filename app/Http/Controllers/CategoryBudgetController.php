<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Category;
use App\CategoryBudget;
use App\CategoryGroup;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoryBudgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \App\Budget $budget
     * @param  \App\CategoryGroup $categoryGroup
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function index(Budget $budget, CategoryGroup $categoryGroup, Category $category)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
        $budget->categoryGroups()->findOrFail($categoryGroup->id);
        $categoryGroup->categories()->findOrFail($category->id);
        return $category->categoryBudgets;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\CategoryBudget $categoryBudget
     * @return \Illuminate\Http\Response
     */
    public function show(CategoryBudget $categoryBudget)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\CategoryBudget $categoryBudget
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategoryBudget $categoryBudget)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\CategoryBudget $categoryBudget
     * @return \Illuminate\Http\Response
     */
    public function destroy(CategoryBudget $categoryBudget)
    {
        //
    }
}
