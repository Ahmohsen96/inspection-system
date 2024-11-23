<?php

use App\Http\Controllers\InspectionFormController;
use App\Http\Controllers\RawMaterialController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/raw-material/create', [RawMaterialController::class, 'create'])->name('raw-material.create');
Route::post('/raw-material/store', [RawMaterialController::class, 'store'])->name('raw-material.store');
Route::get('/raw-materials', [RawMaterialController::class, 'index'])->name('raw-material.index');
Route::get('/raw-materials/{id}', [RawMaterialController::class, 'show'])->name('raw-material.show');

Route::post('raw-materials/{id}/non-conformity', [RawMaterialController::class, 'storeNonConformity'])->name('raw-material.storeNonConformity');

Route::get('/inspection_forms/create', [InspectionFormController::class, 'create'])->name('inspection_forms.create');

Route::resource('inspection_forms', InspectionFormController::class);

Route::get('/inspections', [InspectionFormController::class, 'index'])->name('inspection.index');

// Route::resource('inspections', InspectionFormController::class);

