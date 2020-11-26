<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


///////////////////////ROUTES PRODUCTS AVEC MIDDELWARE ON NE POURRA PAS ACCEDER AU ROUTES SI ON N4EST PAS CONNECTE

    Route::get('/boutique','ProductController@index')->name('products.index');
    Route::get('/boutique/{slug}','ProductController@show')->name('products.show');
    Route::get('/search','ProductController@search')->name('products.search');

///////////////////////ROUTES panier AVEC MIDDELWARE ON NE POURRA PAS ACCEDER AU ROUTES SI ON N4EST PAS CONNECTE
Route::group(['middleware' => ['auth']], function () {
 Route::get('/panier','CartController@index')->name('cart.index');
 Route::post('/panier/ajouter','CartController@store')->name('cart.store');
 Route::delete('/panier/{rowId}','CartController@destroy')->name('cart.destroy');
 /////////////////////////////ROUTE AJOUT QUANTITE PANIER/////////////////////
 Route::put('/panier/{rowId}','CartController@update')->name('cart.update');
});

Route::group(['middleware' => ['auth']], function () {
Route::get('/paiement','CheckoutController@index')->name('checkout.index');
Route::post('/paiement','CheckoutController@store')->name('checkout.store');
Route::get('/merci','CheckoutController@thankyou')->name('checkout.thankyou');
});



Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
