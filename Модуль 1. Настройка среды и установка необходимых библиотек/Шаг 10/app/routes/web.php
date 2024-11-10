<?php

use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return View::make('app');
});

$router->post('/', function (Request $request) {
    $this->validate($request, ['content' => 'required|string|max:255']);
    app('db')->table('records')->insert(['content' => request()->input('content')]);

    return redirect('/');
});
