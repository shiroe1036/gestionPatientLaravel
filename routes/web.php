<?php

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
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\MaladiesController;
// use Illuminate\Routing\Route;

// Route::get('/', function () {
//     // return view('welcome');
//     return view('auth.login');
//     // return view('layouts.test');
// });
Route::get('/', 'Auth\LoginController@showLoginForm')->name('login');

Route::group(['middleware' => ['auth']], function(){
    /**
 * Route profile
 */
Route::get('profile/{profile}', 'ProfilController@index')->name('profile.index');

/**
 * Route utilisateur
 */
Route::get('utilisateur', 'UserController@index')->name('utilisateur.index');
Route::delete('utilisateur/{utilisateur}', 'UserController@destroy')->name('utilisateur.destroy');
Route::get('utilisateur/{utilisateur}/edit{option?}', 'UserController@edit')->name('utilisateur.edit');
Route::PATCH('utlisateur/{utilisateur}/{option?}', 'UserController@update')->name('utilisateur.update');


// route medicament
Route::resource('medoc', 'MedicamentsController');
Route::get('allMedoc', 'MedicamentsController@getAll');

// route maladie
Route::resource('maladie', 'MaladiesController');
Route::get('allMaladie', 'MaladiesController@getData');

// route patients
// Route::resource('patient', 'PatientsController');
Route::put('patient/{idPatient}/{idUrgence}/{idDossierP}/editEtatP/{option?}', 'PatientsController@updateEtatPatient')->name('patient.updateEtat');

/**
 * route custom patient en attente de traitement
 */
Route::get('patientAttente', 'PatientsController@indexAttente')->name('patient.index.attente');
Route::get('patientAttente/{patientAttente}/traiter/{option?}/{idUrgence?}', 'PatientsController@traiterPatient')->name('patient.traiter.attente');
Route::post('patientTraiter/{option?}/{idUrgence?}', 'PatientsController@traiter')->name('patient.traiter');

/**
 * Patient en cours de traitement
 */
Route::get('patientEnCoursTraitement', 'PatientsController@indexTraiter')->name('patient.index.traiter');
Route::get('patientEnCoursTraitement/{patientTraiter}/dossier/{option?}', 'PatientsController@dossierPatient')->name('patient.dossier.traiter');

/**
 * Route print dossier patient
*/
// Route::get()

/**
 * Route traitements
 */
Route::post('traitement/{idDossierPatient}/store', 'TraitementsController@store')->name('traitements.store');

/**
 * Patient en archive
 */
Route::get('patientArchive', 'PatientsController@listArchiveP')->name('patient.index.archive');
Route::get('patientArchive/{idPatient}/dossiers/{option?}/{idUrgence?}', 'PatientsController@listDossier')->name('patient.archive.dossier');

Route::resource('patient', 'PatientsController');

Route::get('/home', 'DashboardController@index')->name('home');
});

Auth::routes();
