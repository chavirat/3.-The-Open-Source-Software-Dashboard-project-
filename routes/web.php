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
Auth::routes();
Route::get('/',['as'=>'/','uses'=>'LoginController@getLogin']);
Route::get('/noPermission',function(){
  return view('permission.noPermission');
});
Route::group(['middleware'=>['authen']],function()
{
  Route::get('/logout',['as'=>'logout','uses'=>'LoginController@getLogout']);
  Route::get('/dashboard',['as'=>'dashboard','uses'=>'DashboardController@getSummary']);
  Route::get('/dashboard/top10',['as'=>'top10','uses'=>'DashboardController@getTop10']);
  Route::get('/dashboard/software_model',['as'=>'software_model','uses'=>'DashboardController@getSoftwareModel']);
  Route::get('/dashboard/license_type',['as'=>'license_type','uses'=>'DashboardController@getLicenseType']);
  Route::get('/dashboard/languages',['as'=>'languages','uses'=>'DashboardController@getLanguages']);
  Route::get('/dashboard/cve/cve',['as'=>'cve','uses'=>'CveController@getCVE']);
  Route::get('/dashboard/cve/severity',['as'=>'severity','uses'=>'CveController@getSeverity']);
  Route::get('/dashboard/cve/cvss3.0calculator',['as'=>'cvss30calculator','uses'=>'CveController@getcvss30calculator']);
  Route::get('/dashboard/cve/latestcve',['as'=>'latestcve','uses'=>'CveController@getLatestCve']);
  Route::resource('industry','IndustryController');
  Route::resource('profile','ProfileController');
});

Route::group(['middleware'=>['authen','roles'],'roles'=>['admin']],function(){
  //for admin
  // Route::resource('profile','ProfileController');
});
