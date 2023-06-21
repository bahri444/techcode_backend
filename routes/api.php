<?php

use App\Http\Controllers\ActifityCategoriesController;
use App\Http\Controllers\ActifityController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\IndustriesController;
use App\Http\Controllers\ModulCategoriesController;
use App\Http\Controllers\ModulsController;
use App\Http\Controllers\ProfessionsController;
use App\Http\Controllers\StudentClassController;
use App\Http\Resources\UserCollection;
use App\Models\ModulCategories;
use App\Models\User;
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
Route::get('/getoneactifity/{uuid}', [ActifityController::class, 'GetActifityByUuid']);
Route::post('/addactifity', [ActifityController::class, 'AddActifity']);
Route::put('/updateactifity/{uuid}', [ActifityController::class, 'UpdateActifityByUuid']);
Route::delete('/deleteactifity/{uuid}', [ActifityController::class, 'DeleteActifityByUuid']);

Route::get('/getallmodulcategories', [ModulCategoriesController::class, 'GetAllModulCategories']);
Route::get('/getmodulcategoriesbyuuid/{uuid}', [ModulCategoriesController::class, 'GetModulCategoriesByUuid']);
Route::post('/addmodulcategories', [ModulCategoriesController::class, 'AddModulCategories']);
Route::put('/updatemodulcategories/{uuid}', [ModulCategoriesController::class, 'UpdateModulCategories']);
Route::delete('/deletemodulcategories/{uuid}', [ModulCategoriesController::class, 'DeleteModulCategories']);

Route::get('getallmoduls', [ModulsController::class, 'GetAllModuls']);
Route::get('getmodulbyuuid/{uuid}', [ModulsController::class, 'GetModulsByUuid']);
Route::post('addmodul', [ModulsController::class, 'AddModuls']);
Route::put('updatemodul/{uuid}', [ModulsController::class, 'UpdateModuls']);
Route::delete('deletemodul/{uuid}', [ModulsController::class, 'DeleteModuls']);

Route::get('getallprofessions', [ProfessionsController::class, 'GetAllProfession']);
Route::get('getprofessionsbyuuid/{uuid}', [ProfessionsController::class, 'GetProfessionByUuid']);
Route::post('addprofessions', [ProfessionsController::class, 'AddProfession']);
Route::put('updateprofessions/{uuid}', [ProfessionsController::class, 'UpdateProfession']);
Route::delete('deleteprofessions/{uuid}', [ProfessionsController::class, 'DeleteProfession']);

Route::get('getallclass', [ClassesController::class, 'GetAllClass']);
Route::get('getclassbyuuid/{uuid}', [ClassesController::class, 'GetClassByUuid']);
Route::post('addclass', [ClassesController::class, 'AddClass']);
Route::put('updateclass/{uuid}', [ClassesController::class, 'UpdateClass']);
Route::delete('deleteclass/{uuid}', [ClassesController::class, 'DeleteClass']);

Route::get('getallindustries', [IndustriesController::class, 'GetAllIndustries']);
Route::get('getindustriesbyuuid/{uuid}', [IndustriesController::class, 'GetIndustriesByUuid']);
Route::post('addindustries', [IndustriesController::class, 'AddIndustries']);
Route::put('updateindustries/{uuid}', [IndustriesController::class, 'UpdateIndustries']);
Route::delete('deleteindustries/{uuid}', [IndustriesController::class, 'DeleteIndustries']);

Route::get('getallstudentclass', [StudentClassController::class, 'GetAllStudentClass']);
Route::get('getstudentclassbyuuid/{uuid}', [StudentClassController::class, 'GetStudentClassByUuid']);
Route::post('addstudentclass', [StudentClassController::class, 'AddStudentClass']);
Route::put('updatestudentclass/{uuid}', [StudentClassController::class, 'UpdateStudentClass']);
Route::delete('deletestudentclass/{uuid}', [StudentClassController::class, 'DeleteStudentClass']);
