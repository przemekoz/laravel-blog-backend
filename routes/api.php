<?php

use Illuminate\Http\Request;
Use App\Http\Controllers\Article;
Use App\Http\Controllers\Element;
Use App\Http\Controllers\ElementTag;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get(     'v1/articles',            'ArticleController@index');
Route::get(     'v1/articles/{article}',  'ArticleController@show');
Route::post(    'v1/articles',            'ArticleController@store');
Route::put(     'v1/articles/{article}',  'ArticleController@update');
Route::delete(  'v1/articles/{article}',  'ArticleController@delete');

Route::get(     'v1/elements',            'ElementController@index');
Route::get(     'v1/elements/{element}',  'ElementController@show');
Route::post(    'v1/elements',            'ElementController@store');
Route::put(     'v1/elements/{element}',  'ElementController@update');
Route::patch(   'v1/elements/{element}',  'ElementController@update');
Route::delete(  'v1/elements/{element}',  'ElementController@delete');
Route::get(     'v1/elements/withTags/{element}',  'ElementController@showWithTags');

Route::get(     'v1/elementTags',               'ElementTagController@index');
Route::get(     'v1/elementTags/{elementTag}',  'ElementTagController@show');
Route::post(    'v1/elementTags',               'ElementTagController@store');
Route::put(     'v1/elementTags/{elementTag}',  'ElementTagController@update');
Route::delete(  'v1/elementTags/{elementTag}',  'ElementTagController@delete');

Route::fallback(function(){
    return response()->json([
        'message' => 'Page Not Found.'], 404);
});