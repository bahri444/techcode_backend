<?php

use App\Http\Controllers\ActifityCategoriesController;
use App\Http\Controllers\ActifityController;
use App\Http\Resources\UserCollection;
use App\Models\User;
use Illuminate\Auth\Access\Response;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
// Route::get('/', function () {
//     return Response::success("welcome to staging api lombok cyber");
// });

// Route::get('/users', function () {
//     return UserCollection::collection(
//         User::all()->keyBy->user_id
//     );
// });
Route::get('/actifity_categories', [ActifityCategoriesController::class, 'GetAllActifityCategories']);
Route::get('/actifity_category/{uuid}', [ActifityCategoriesController::class, 'GetActifityCategoriesByUuid']);
Route::post('/add_actifity_categories', [ActifityCategoriesController::class, 'AddActifityCategories']);
Route::put('/update_actifity_category/{uuid}', [ActifityCategoriesController::class, 'UpdateActifityCategories']);
Route::delete('/delete_actifity_category/{uuid}', [ActifityCategoriesController::class, 'DeleteActifityCategories']);

Route::get('/actifities', [ActifityController::class, 'GetAllActifity']);
Route::get('/getactifity/{uuid}', [ActifityController::class, 'GetActifityByUuid']);
Route::post('/addactifity', [ActifityController::class, 'AddActifity']);
Route::put('/updateactifity/{uuid}', [ActifityController::class, 'UpdateActifityByUuid']);
Route::delete('/deleteactifity/{uuid}', [ActifityController::class, 'DeleteActifityByUuid']);
