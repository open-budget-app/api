<?php

namespace App\Http\Controllers;

use App\Category;
use App\CategoryGroup;
use App\Budget;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CategoryStoreRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Budget $budget, CategoryGroup $categoryGroup)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
        $budget->categoryGroups()->findOrFail($categoryGroup->id);
        return $budget->categories;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryStoreRequest $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryStoreRequest $request, Budget $budget, CategoryGroup $categoryGroup)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
        $budget->categoryGroups()->findOrFail($categoryGroup->id);

        return $budget
            ->categories()
            ->save(
                Category::make(
                    $request->validated()
                )
            );
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function show(Budget $budget, CategoryGroup $categoryGroup, Category $category)
    {
        Auth::user()->budgets()->findOrFail($budget->id);
        $budget->categoryGroups()->findOrFail($categoryGroup->id);
        $budget->categories()->findOrFail($category->id);
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        //
    }
}
