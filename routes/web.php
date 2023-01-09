<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('backend.login');
    
});
Route::post('adminlogin', 'AdminController@login')->name('admin.login');
Route::get('logout', 'AdminController@logout')->name('logout');
Route::get('systemlogin', 'AdminController@logout')->name('systemlogin');
Route::get('dashboard', 'AdminController@dashboard')->middleware('auth');

Route::middleware(['auth'])->group(function () {
    Route::controller(UsersController::class)->group(function(){
        Route::get('setup/users','index');
        Route::post('setup/create_user','store');
        Route::get('setup/companyinfo','companyinfo');
        Route::get('setup/profile','profile');
        Route::post('setup/editProfile','editProfile');
        Route::post('setup/changePassword','changePassword');
        Route::get('setup/themes','themes');
        Route::get('deleteuser/{id}','deleteuser');
        Route::get('getuserdetail/{id}','getuserdetail');
        Route::post('update','update');
        Route::get('export', 'export');
        Route::get('setup/project', 'project');
        Route::post('setup/save_project', 'save_project');
        Route::get('deleteproject/{id}', 'deleteproject');
        Route::get('projectdetail/{id}', 'projectdetail');
        Route::post('updateproject','updateproject');
        Route::get('project/list','projectlist')->name('project.list');
        
    });
});

Route::middleware(['auth'])->group(function () {
    Route::controller(RecordsController::class)->group(function(){
        Route::post('record/create','store');
        Route::get('record/me/{id?}','me');
        Route::get('recorddetail/{id}','recorddetail');
        Route::post('updaterecord/','updaterecord');
        Route::post('record/byname','byname');
        Route::get('deleterecord/{id}','deleterecord');
    });
});
Route::middleware(['auth'])->group(function () {
    Route::controller(CalendarController::class)->group(function(){
        Route::get('fullcalendar','index');
        Route::post('fullcalendar/create','create');
        Route::post('fullcalendar/delete','destroy');
        Route::post('fullcalendar/update','update');
    });
});