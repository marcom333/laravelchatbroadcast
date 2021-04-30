<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\UserController;

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

Route::get('/', function () {return view('welcome');});

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [SiteController::class, "login_form"]);
    Route::post('/login', [SiteController::class, "login"]);
    Route::get('/user/register', [UserController::class, "register_form"]);
    Route::post('/user/register', [UserController::class, "register"]);
});

Route::middleware(["auth"])->group(function (){
    Route::get('/dashboard', [SiteController::class, "dashboard"]);
    Route::get("/chat/{code}", [SiteController::class, "chat"]);
    Route::post("/chat/{code}", [SiteController::class, "chat_send"]);
});
/*
Route::get('/chat', function(){
    event(new \App\Events\PublicMessage());
    dd("Mensaje publico papu");
});
*/
Route::get('/private-chat', function(){
    event(new \App\Events\PrivateMessage(auth()->user()));
    dd("Mensaje privado papu");
});