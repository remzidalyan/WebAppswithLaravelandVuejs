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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

// Route::get('falan',function(){
//     return "SELAM";
// });

Route::get('falan',function(){
    return App\TodoItem::all();
});

// BÜTÜN TODO LİSTESİ
// Yeni bir todo ekleme işlemi
// Bir todo'yu tamamlandı işaretleme
// Bir todo'yu yapılmadı işaretleme

Route::get('todos','TodoItemController@index')->name('todos.all')->middleware(['auth']);

//Route::get('todos/{id}/togglecomplete','TodoItemController@toggle')->name('todos.toggle');
Route::get('todos/{todo}/togglecomplete','TodoItemController@toggle')->name('todos.toggle')->middleware(['auth']);

Route::post('todos','TodoItemController@store')->name('todos.store')->middleware(['auth']);


Route::get('/home', 'HomeController@index')->name('home');
