<?php

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::post('login', 'UserController@login');
Route::post('register', 'UserController@register');
Route::group(['middleware' => 'auth:api'], function () {
    Route::post('details', 'UserController@details');
    Route::apiResources([
        'budgets' => 'BudgetController',
        'budgets/{id}/accounts' => 'AccountController',
        'category_budgets' => 'CategoryBudgetController',
        'categories' => 'CategoryController',
        'category_groups' => 'CategoryGroupController',
        'payees' => 'PayeeController',
        'recurring_transactions' => 'RecurringTransactionController',
        'repeat_types' => 'RepeatTypeController',
        'transactions' => 'TransactionController',
    ]);
});
