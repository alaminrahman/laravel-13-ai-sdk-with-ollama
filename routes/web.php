<?php

use Illuminate\Support\Facades\Route;
use App\Ai\Agents\ChatAgent;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ai-test', function () {
    $response = (new ChatAgent)->prompt('What is the name of Capital Of Bangladesh?');

    return response()->json([
        'response' => $response,
    ]);
});
