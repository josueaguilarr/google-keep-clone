<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\NoteController;

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

Route::controller(NoteController::class)->group(function () {
    Route::get('v1/notes', 'getNotes');
    Route::post('v1/notes', 'createNote');
    Route::delete('v1/notes/{id}', 'destroyNote');
    Route::put('v1/notes/{id}', 'updateNote');
    Route::post('v1/notes/{id}/archived', 'archiveNote');
    Route::get('v1/notes/archived', 'showArchivedNotes');
});
