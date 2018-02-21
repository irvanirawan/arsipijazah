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
Route::get('/', function () {
    return redirect('/login');
});
Route::get('/tesgen', function () {
    return substr(md5(uniqid(mt_rand(), true)) , 0, 8);
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['prefix' => 'tahunajaran', 'middleware' => ['role:superadmin|admin']], function() {
    Route::get('/', ['as'=>'tahunajaran','uses'=>'TahunajaranController@index']);
    Route::post('/savetahunajaran', ['as'=>'saveth','uses'=>'TahunajaranController@store']);
    Route::post('/edittahunajaran', ['as'=>'saveeditth','uses'=>'TahunajaranController@update']);
    Route::get('/put/{id}', ['as'=>'putth','uses'=>'TahunajaranController@show']);
    Route::get('/delete/{id}', ['as'=>'deleteth','uses'=>'TahunajaranController@destroy']);
    Route::get('/{id}', ['as'=>'aktifth','uses'=>'TahunajaranController@aktif']);
    // Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});
Route::group(['prefix' => 'siswa', 'middleware' => ['role:superadmin|admin']], function() {
    Route::get('/', ['as'=>'siswa','uses'=>'SiswaController@index']);
    Route::post('/savesiswa', ['as'=>'savesiswa','uses'=>'SiswaController@store']);
    Route::post('/editsiswa', ['as'=>'saveeditsiswa','uses'=>'SiswaController@update']);
    Route::get('/put/{id}', ['as'=>'putsiswa','uses'=>'SiswaController@show']);
    Route::get('/delete/{id}', ['as'=>'deletesiswa','uses'=>'SiswaController@destroy']);
    // Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});
Route::group(['prefix' => 'user', 'middleware' => ['role:superadmin|admin']], function() {
    Route::get('/', ['as'=>'user','uses'=>'UserController@index']);
    Route::post('/saveuser', ['as'=>'saveuser','uses'=>'UserController@store']);
    Route::post('/edituser', ['as'=>'saveedituser','uses'=>'UserController@update']);
    Route::get('/put/{id}', ['as'=>'putuser','uses'=>'UserController@show']);
    Route::get('/delete/{id}', ['as'=>'deleteuser','uses'=>'UserController@destroy']);
    // Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});
Route::group(['prefix' => 'guru', 'middleware' => ['role:superadmin|admin']], function() {
    Route::get('/', ['as'=>'walikelas','uses'=>'WalikelasController@index']);
    Route::post('/saveguru', ['as'=>'savewk','uses'=>'WalikelasController@store']);
    Route::post('/editguru', ['as'=>'saveeditwk','uses'=>'WalikelasController@update']);
    Route::get('/put/{id}', ['as'=>'putwk','uses'=>'WalikelasController@show']);
    Route::get('/delete/{id}', ['as'=>'deletewk','uses'=>'WalikelasController@destroy']);
    // Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});
Route::group(['prefix' => 'kepsek', 'middleware' => ['role:superadmin|admin']], function() {
    Route::get('/', ['as'=>'kepsek','uses'=>'KepsekController@index']);
    Route::post('/savekepsek', ['as'=>'savekepsek','uses'=>'KepsekController@store']);
    Route::post('/editkepsek', ['as'=>'saveeditkepsek','uses'=>'KepsekController@update']);
    Route::get('/put/{id}', ['as'=>'putkepsek','uses'=>'KepsekController@show']);
    Route::get('/delete/{id}', ['as'=>'deletekepsek','uses'=>'KepsekController@destroy']);
    // Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});
Route::group(['prefix' => 'kelas', 'middleware' => ['role:superadmin|admin']], function() {
    Route::get('/', ['as'=>'kls','uses'=>'KelasController@index']);
    Route::get('/detail/{id}', ['as'=>'klsdetail','uses'=>'KelasController@detail']);
    Route::post('/savekelas', ['as'=>'savekls','uses'=>'KelasController@store']);
    Route::post('/editkelas', ['as'=>'saveeditkls','uses'=>'KelasController@update']);
    Route::get('/put/{id}', ['as'=>'putkls','uses'=>'KelasController@show']);
    Route::get('/delete/{id}', ['as'=>'deletekls','uses'=>'KelasController@destroy']);
    Route::get('/deletesiswa/{id}', ['as'=>'deleteklssiswa','uses'=>'KelasController@destroysiswa']);
    Route::post('/tambahsiswa', ['as'=>'tambahsiswa','uses'=>'KelasController@tambahsiswa']);
    // Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});
Route::group(['prefix' => 'nilai', 'middleware' => ['role:superadmin|guru']], function() {
    Route::get('/{id}', ['as'=>'formnilai','uses'=>'NilaiController@index']);
    Route::get('/{id}/{matpel}', ['as'=>'nilaipel','uses'=>'NilaiController@nilaipel']);
    Route::post('/savenilai', ['as'=>'savenilai','uses'=>'NilaiController@store']);
    Route::post('/editnilai', ['as'=>'saveeditnilai','uses'=>'NilaiController@update']);
    Route::get('/put/{id}', ['as'=>'putnilai','uses'=>'NilaiController@show']);
    Route::get('/delete/{id}', ['as'=>'deletenilai','uses'=>'NilaiController@destroy']);
    // Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});
Route::group(['prefix' => 'matapelajaran', 'middleware' => ['role:superadmin|guru']], function() {
    Route::get('/', ['as'=>'matpel','uses'=>'MatpelController@index']);
    Route::post('/savematapelajaran', ['as'=>'savematpel','uses'=>'MatpelController@store']);
    Route::post('/editmatapelajaran', ['as'=>'saveeditmatpel','uses'=>'MatpelController@update']);
    Route::get('/put/{id}', ['as'=>'putmatpel','uses'=>'MatpelController@show']);
    Route::get('/delete/{id}', ['as'=>'deletematpel','uses'=>'MatpelController@destroy']);
    // Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});
Route::group(['prefix' => 'ijazah', 'middleware' => ['role:superadmin|kepsek']], function() {
    Route::get('/', ['as'=>'ijazah','uses'=>'IjazahController@index1']);
    Route::get('/{id}/{matpel}', ['as'=>'ijazahdetail','uses'=>'IjazahController@index']);
    Route::get('/siswa/{id}/{siswa}', ['as'=>'ijazahdetail','uses'=>'IjazahController@persiswa']);
    Route::post('/saveijazah', ['as'=>'saveijazah','uses'=>'IjazahController@store']);
    Route::post('/editijazah', ['as'=>'saveeditijazah','uses'=>'IjazahController@update']);
    Route::get('/put/{id}', ['as'=>'putijazah','uses'=>'IjazahController@show']);
    Route::get('/delete/{id}', ['as'=>'deleteijazah','uses'=>'IjazahController@destroy']);
    // Route::get('/manage', ['middleware' => ['permission:manage-admins'], 'uses' => 'AdminController@manageAdmins']);
});

// Route::resource('siswa', 'SiswaController');
// Route::resource('tahunajaran', 'TahunajaranController');
// Route::resource('kelasmodel', 'KelasModelController');
// Route::resource('modelwalikelas', 'ModelWalikelasController');
// Route::resource('modelnilai', 'ModelNilaiController');
// Route::resource('modelkepalasekolah', 'ModelKepalaSekolahController');
