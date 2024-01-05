<?php

use App\Http\Controllers\MemberController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TeamController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Update the team of a member
Route::put('/members/{member}/update-team', [MemberController::class, 'updateTeam']);
// Get the members of a specific team
Route::get('/teams/{team}/get-members', [TeamController::class, 'getMembers']);
// Add a member to a project
Route::put('/projects/{project}/add-member', [ProjectController::class, 'addMember']);
// Get the members of a specific project
Route::get('/projects/{project}/get-members', [ProjectController::class, 'getMembers']);

Route::apiResource('teams', TeamController::class);
Route::apiResource('members', MemberController::class);
Route::apiResource('projects', ProjectController::class);

Route::fallback(function () {
    return response()->json([
        'message' => 'invalid path'
    ], 404);
});
