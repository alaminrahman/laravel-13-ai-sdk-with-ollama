<?php

use Illuminate\Support\Facades\Route;
use App\Ai\Agents\ChatAgent;
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/ai-test', function () {
    $response = (new ChatAgent)->prompt('What is the name of Capital Of Bangladesh?');

    return response()->json([
        'response' => (string) $response,
    ]);
});

Route::get('/chat', function () {
    // $res = (new ChatAgent)->prompt('laravel');

    // return response()->json([
    //     'response' => (string) $res,
    // ]);

    return view('chat');
})->name('chat');

Route::post('/chat/stream', function (Request $request) {
    $request->validate([
        'message' => 'required|string',
    ]);

    $res = (new ChatAgent)->prompt($request->input('message'));
    return response()->json([
        'response' => (string) $res,
    ]);

    return (new ChatAgent)->stream($request->input('message'));


})->name('chat.stream');
