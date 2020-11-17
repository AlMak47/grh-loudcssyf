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
    return view('layouts.app');
})->middleware('guest');

Route::get('/login',function () {
    return redirect('/');
});

Route::post('/login','Auth\LoginController@connexion')->name('login');
Route::post('/logout','Auth\LoginController@logout');



Route::middleware(['auth'])->group(function () {
    Route::get('/app',function () {
        return view('layouts.myapp');
    });

    Route::post('/setting/profile/change-password','UserController@changePassword');

    // ADMIN ROUTING
    Route::prefix('admin')->group(function () {
        // ROUTES SECTION EMPLOYES
        Route::get('/employe/add/get-data','EmployeController@addGetData')->middleware('admin');
        Route::post('/employe/add/','EmployeController@addEmployeRequest')->middleware('admin');
        Route::get('/employe/list','EmployeController@listEmployeRequest')->middleware('admin');
        Route::get('/employe/edit/{id}','EmployeController@getDetails')->middleware('admin');

        // ROUTES DEPARTEMENT
        Route::post('/departement/add','DepartementController@addDepartement')->middleware('admin');
        Route::get('/departement/list','DepartementController@listDepartement')->middleware('admin');

        // ROUTES POSTES
        Route::post('/poste/add','PosteController@addPoste')->middleware('admin');
        Route::get('/poste/list','PosteController@listPoste')->middleware('admin');
        Route::post('/poste/edit/{reference}','PosteController@updatePoste')->middleware('admin');
    });
});


// Auth::routes();