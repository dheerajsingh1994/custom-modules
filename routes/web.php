<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Controller;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\DocumentController;

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

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('/gpay', function(){
//     return view('gpay');
// });
Route::get('gpay', [Controller::class, 'gpay']);
Route::get('/', [Controller::class, 'gpay']);
Route::get('/stripe', [PaymentController::class, 'stripe']);
Route::post('/get-intent', [PaymentController::class, 'createPaymentIntent']);


Route::match(['GET', 'POST'], 'employee/upload/document', [DocumentController::class, 'documentUpload'])->name('employee.upload.document');
Route::get('employee/documents', [DocumentController::class, 'index'])->name('employee.document.list');
Route::get('employee/document/attachments/{id}', [DocumentController::class, 'attachmentLists'])->name('employee.document.attachments');
Route::get('employee/document/delete/{id}', [DocumentController::class, 'documentDelete'])->name('employee.document.delete');
