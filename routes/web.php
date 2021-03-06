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

use App\Manager;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;





Route::get('test',function (){

    if(Manager::can(Config::get('rolecode.BirthManagement'))){

        return "yes";
    }
    else {

        return "no";

    }

});

//dashboard

Route::get('dashboard','DashboardController@index');

//birth controller

Route::group(['prefix'=>'birth-certificates'],function (){

    Route::get('/{tab}/new','BirthRegistration\BirthRegistrationController@index');

    Route::get('/{tab}/new-request','BirthRegistration\BirthRegistrationController@newRequest');
    Route::get('/{tab}/new-processing','BirthRegistration\BirthRegistrationController@newProcessing');

    Route::get('/{tab}/new-issue','BirthRegistration\BirthRegistrationController@newIssue');

    Route::get('new/pending/{trackerId}','BirthRegistration\BirthRegistrationController@pendingTask');
    Route::get('new/view/{trackerId}','BirthRegistration\BirthRegistrationController@viewRequestDetails');
    Route::post('new/verify/{trackerId}','BirthRegistration\BirthRegistrationController@verify');

    Route::post('new/approve/{trackerId}','BirthRegistration\BirthRegistrationController@approve');

    Route::get('new-processing-request/{trackerId}','BirthRegistration\BirthRegistrationController@processingRequest');

    Route::get('new-processing-request/view/{trackerId}','BirthRegistration\BirthRegistrationController@viewProcessingTask');

    Route::get('new-issue/view/{trackerId}','BirthRegistration\BirthRegistrationController@viewIssue');
    Route::post('new/issue/{trackerId}','BirthRegistration\BirthRegistrationController@storeIssue');
    Route::get('new-certificate/print/{trackerId}','BirthRegistration\BirthRegistrationController@newCertificatePrint');
    Route::get('new/certificate/{entryNo}','BirthRegistration\BirthRegistrationController@certificate');

    //birth dublicates

    Route::get('/duplicate/{tab}/request','BirthRegistration\BirthDuplicateController@index');
    Route::get('/duplicate/my-task/{trackerId}','BirthRegistration\BirthDuplicateController@myTask');
    // dupl.. processing

    Route::get('/duplicate/{tab}/processing','BirthRegistration\BirthDuplicateController@processRequest');
    Route::get('/duplicate/processing/my-task/{trackerId}','BirthRegistration\BirthDuplicateController@processingMyTask');
    Route::get('/duplicate/view-processing/{trackerId}','BirthRegistration\BirthDuplicateController@viewProcessRequest');
    Route::post('/duplicate/process-approve/{trackerId}','BirthRegistration\BirthDuplicateController@approveProcessRequest');

    Route::get('/duplicate/view-request/{trackerId}','BirthRegistration\BirthDuplicateController@viewRequest');
        Route::post('/duplicate/search-byentry-number/{trackerId}','BirthRegistration\BirthDuplicateController@serachByEntryNumber');

    Route::post('/duplicate/verify/{trackerId}','BirthRegistration\BirthDuplicateController@verify');

    Route::get('/duplicate/{tab}/issue','BirthRegistration\BirthDuplicateController@issueRequest');
    Route::get('/duplicate/view-issue-request/{trackerId}','BirthRegistration\BirthDuplicateController@viewIssueRequest');
    Route::post('/duplicate/issue/search-byentry-number/{trackerId}','BirthRegistration\BirthDuplicateController@issueSerachByEntryNumber');
    Route::post('/duplicate/issue-approve/{trackerId}','BirthRegistration\BirthDuplicateController@issueStore');

    //birth replace

    Route::get('/replace/{tab}/request','BirthRegistration\BirthChangeRequestController@index');
    Route::get('/replace/my-task/{trackerId}','BirthRegistration\BirthChangeRequestController@myTask');

    Route::get('/replace/{tab}/processing','BirthRegistration\BirthChangeRequestController@processing');

    Route::post('replace/approve/{trackerId}','BirthRegistration\BirthChangeRequestController@approve');

    Route::get('replace/processing-request/view/{trackerId}','BirthRegistration\BirthChangeRequestController@processingRequest');

    /////

    Route::get('/replace/view-request/{trackerId}','BirthRegistration\BirthChangeRequestController@viewRequest');
    Route::post('/replace/search-byentry-number/{trackerId}','BirthRegistration\BirthChangeRequestController@serachByEntryNumber');

    Route::post('/replace/verify/{trackerId}','BirthRegistration\BirthChangeRequestController@verify');

    Route::get('/replace/{tab}/issue','BirthRegistration\BirthChangeRequestController@issueRequest');
    Route::get('/replace/view-issue-request/{trackerId}','BirthRegistration\BirthChangeRequestController@viewIssueRequest');
    Route::post('/replace/issue/search-byentry-number/{trackerId}','BirthRegistration\BirthChangeRequestController@issueSerachByEntryNumber');
    Route::post('/replace/issue-approve/{trackerId}','BirthRegistration\BirthChangeRequestController@issueStore');

    //birth correction

    Route::get('/correction/{tab}/request','BirthRegistration\BirthErrorCorrectionController@index');
    Route::get('/correction/my-task/{trackerId}','BirthRegistration\BirthErrorCorrectionController@myTask');

    //proces
    Route::get('/correction/{tab}/processing','BirthRegistration\BirthErrorCorrectionController@processing');
    Route::get('/correction/processing/my-task/{trackerId}','BirthRegistration\BirthErrorCorrectionController@processingMyTask');
    Route::get('/correction/processing-view-request/{trackerId}','BirthRegistration\BirthErrorCorrectionController@viewProcessRequest');
    Route::post('/correction/process-approve/{trackerId}','BirthRegistration\BirthErrorCorrectionController@approveProcessRequest');

    Route::get('/correction/view-request/{trackerId}','BirthRegistration\BirthErrorCorrectionController@viewRequest');
    Route::post('/correction/search-byentry-number/{trackerId}','BirthRegistration\BirthErrorCorrectionController@serachByEntryNumber');

    Route::post('/correction/verify/{trackerId}','BirthRegistration\BirthErrorCorrectionController@verify');

    Route::get('/correction/{tab}/issue','BirthRegistration\BirthErrorCorrectionController@issueRequest');
    Route::get('/correction/view-issue-request/{trackerId}','BirthRegistration\BirthErrorCorrectionController@viewIssueRequest');
    Route::post('/correction/issue/search-byentry-number/{trackerId}','BirthRegistration\BirthErrorCorrectionController@issueSerachByEntryNumber');
    Route::post('/correction/issue-approve/{trackerId}','BirthRegistration\BirthErrorCorrectionController@issueStore');

    Route::post('/correction/return/{trackerId}','BirthRegistration\BirthErrorCorrectionController@returnRequest');

    /////////////////////////////////
    Route::get('/changes','BirthRegistration\BirthChangeRequestController@index');
    Route::get('/verifications','BirthRegistration\BirthVerificationController@index');
    Route::get('/error-corrections','BirthRegistration\BirthErrorCorrectionController@index');

    ////search controller

    Route::get('/search/{tab}/request','Search\BirthSearchController@newBirthCertificateSearch');
    Route::get('/search/request/my-task/{searchId}','Search\BirthSearchController@myTask');

    Route::get('/search/view/{searchId}','Search\BirthSearchController@viewBirthCertificateSearch');
    Route::post('search/send-back-result','Search\BirthSearchController@sendBackResult');
    Route::post('search/exist/{trackerId}','Search\BirthSearchController@checkExisteByEntryNumber');
    Route::post('search/process-approve','Search\BirthSearchController@approve');


    // ssearch proces

    Route::get('/search/{tab}/processing','Search\BirthSearchController@processing');
    Route::get('/search/processing/my-task/{searchId}','Search\BirthSearchController@processMyTask');
    Route::get('/search/process/view/{searchId}','Search\BirthSearchController@viewProcess');
    Route::post('search/exist/process/{trackerId}','Search\BirthSearchController@processCheckExisteByEntryNumber');

    //verify
    Route::post('verify/search-byentry-number/{trackerId}','BirthRegistration\BirthVerificationController@serachByEntryNumber');

    Route::get('/{tab}/verify','BirthRegistration\BirthVerificationController@index');
    Route::get('/verify/view-processing-request/{trackerId}','BirthRegistration\BirthVerificationController@viewProcessingRequest');

    Route::get('/verify/process/my-task/{trackerID}','BirthRegistration\BirthVerificationController@processMyTask');

    Route::post('/verify/approve','BirthRegistration\BirthVerificationController@approve');

    Route::post('/verify/response','BirthRegistration\BirthVerificationController@response');

    //processs verif

    Route::get('verify/{tab}/processing','BirthRegistration\BirthVerificationController@process');
    Route::get('/verify/view-request/{trackerId}','BirthRegistration\BirthVerificationController@viewRequest');

    Route::get('/verify/my-task/{trackerID}','BirthRegistration\BirthVerificationController@myTask');

    Route::post('/verify/response','BirthRegistration\BirthVerificationController@response');


});

//death controller

Route::group(['prefix'=>'death-certificates'],function (){


    Route::get('/{tab}/new','DeathRegistration\BirthRegistrationController@index');

    Route::get('/{tab}/new-request','DeathRegistration\BirthRegistrationController@newRequest');
    Route::get('/{tab}/new-processing','DeathRegistration\BirthRegistrationController@newProcessing');

    Route::get('/{tab}/new-issue','DeathRegistration\BirthRegistrationController@newIssue');

    Route::get('new/pending/{trackerId}','DeathRegistration\BirthRegistrationController@pendingTask');
    Route::get('new/view/{trackerId}','DeathRegistration\BirthRegistrationController@viewRequestDetails');
    Route::post('new/verify/{trackerId}','DeathRegistration\BirthRegistrationController@verify');

    Route::post('new/approve/{trackerId}','DeathRegistration\BirthRegistrationController@approve');

    Route::get('new-processing-request/{trackerId}','DeathRegistration\BirthRegistrationController@processingRequest');

    Route::get('new-processing-request/view/{trackerId}','DeathRegistration\BirthRegistrationController@viewProcessingTask');

    Route::get('new-issue/view/{trackerId}','DeathRegistration\BirthRegistrationController@viewIssue');
    Route::post('new/issue/{trackerId}','DeathRegistration\BirthRegistrationController@storeIssue');

    //birth dublicates

    Route::get('/duplicate/{tab}/request','DeathRegistration\BirthDuplicateController@index');
    Route::get('/duplicate/my-task/{trackerId}','DeathRegistration\BirthDuplicateController@myTask');

    Route::get('/duplicate/view-request/{trackerId}','DeathRegistration\BirthDuplicateController@viewRequest');
    Route::post('/duplicate/search-byentry-number/{trackerId}','DeathRegistration\BirthDuplicateController@serachByEntryNumber');

    Route::post('/duplicate/verify/{trackerId}','DeathRegistration\BirthDuplicateController@verify');

     //dupli process
    Route::get('/duplicate/{tab}/processing','DeathRegistration\BirthDuplicateController@process');
    Route::get('/duplicate/my-task/{trackerId}','DeathRegistration\BirthDuplicateController@myTask');

    Route::get('/duplicate/view-request/{trackerId}','DeathRegistration\BirthDuplicateController@viewRequest');
    Route::post('/duplicate/search-byentry-number/{trackerId}','DeathRegistration\BirthDuplicateController@serachByEntryNumber');

    Route::post('/duplicate/verify/{trackerId}','DeathRegistration\BirthDuplicateController@verify');
    ///


    Route::get('/duplicate/{tab}/issue','DeathRegistration\BirthDuplicateController@issueRequest');
    Route::get('/duplicate/view-issue-request/{trackerId}','DeathRegistration\BirthDuplicateController@viewIssueRequest');
    Route::post('/duplicate/issue/search-byentry-number/{trackerId}','DeathRegistration\BirthDuplicateController@issueSerachByEntryNumber');
    Route::post('/duplicate/issue-approve/{trackerId}','DeathRegistration\BirthDuplicateController@issueStore');

    //death replace

    Route::get('/replace/{tab}/request','DeathRegistration\BirthChangeRequestController@index');
    Route::get('/replace/my-task/{trackerId}','DeathRegistration\BirthChangeRequestController@myTask');

    Route::get('/replace/view-request/{trackerId}','DeathRegistration\BirthChangeRequestController@viewRequest');
    Route::post('/replace/search-byentry-number/{trackerId}','DeathRegistration\BirthChangeRequestController@serachByEntryNumber');

    Route::post('/replace/verify/{trackerId}','DeathRegistration\BirthChangeRequestController@verify');

    //process replace

    Route::get('/replace/{tab}/processing','DeathRegistration\BirthChangeRequestController@process');
    Route::get('/replace/my-task/{trackerId}','DeathRegistration\BirthChangeRequestController@myTask');

    Route::get('/replace/view-request/{trackerId}','DeathRegistration\BirthChangeRequestController@viewRequest');
    Route::post('/replace/search-byentry-number/{trackerId}','DeathRegistration\BirthChangeRequestController@serachByEntryNumber');

    Route::post('/replace/verify/{trackerId}','DeathRegistration\BirthChangeRequestController@verify');

    //
    Route::get('/replace/{tab}/issue','DeathRegistration\BirthChangeRequestController@issueRequest');
    Route::get('/replace/view-issue-request/{trackerId}','DeathRegistration\BirthChangeRequestController@viewIssueRequest');
    Route::post('/replace/issue/search-byentry-number/{trackerId}','DeathRegistration\BirthChangeRequestController@issueSerachByEntryNumber');
    Route::post('/replace/issue-approve/{trackerId}','DeathRegistration\BirthChangeRequestController@issueStore');

    //seath correction

    Route::get('/correction/{tab}/request','DeathRegistration\BirthErrorCorrectionController@index');
    Route::get('/correction/my-task/{trackerId}','DeathRegistration\BirthErrorCorrectionController@myTask');

    Route::get('/correction/view-request/{trackerId}','DeathRegistration\BirthErrorCorrectionController@viewRequest');
    Route::post('/correction/search-byentry-number/{trackerId}','DeathRegistration\BirthErrorCorrectionController@serachByEntryNumber');

    Route::post('/correction/verify/{trackerId}','DeathRegistration\BirthErrorCorrectionController@verify');


    // death correction process

    Route::get('/correction/{tab}/processing','DeathRegistration\BirthErrorCorrectionController@process');
    Route::get('/correction/my-task/{trackerId}','DeathRegistration\BirthErrorCorrectionController@myTask');

    Route::get('/correction/view-request/{trackerId}','DeathRegistration\BirthErrorCorrectionController@viewRequest');
    Route::post('/correction/search-byentry-number/{trackerId}','DeathRegistration\BirthErrorCorrectionController@serachByEntryNumber');

    Route::post('/correction/verify/{trackerId}','DeathRegistration\BirthErrorCorrectionController@verify');


    //
    Route::get('/correction/{tab}/issue','DeathRegistration\BirthErrorCorrectionController@issueRequest');
    Route::get('/correction/view-issue-request/{trackerId}','DeathRegistration\BirthErrorCorrectionController@viewIssueRequest');
    Route::post('/correction/issue/search-byentry-number/{trackerId}','DeathRegistration\BirthErrorCorrectionController@issueSerachByEntryNumber');
    Route::post('/correction/issue-approve/{trackerId}','DeathRegistration\BirthErrorCorrectionController@issueStore');
    Route::post('/correction/return/{trackerId}','DeathRegistration\BirthErrorCorrectionController@return');

    /////////////////////////////////
    Route::get('/changes','DeathRegistration\BirthChangeRequestController@index');
    Route::get('/verifications','DeathRegistration\BirthVerificationController@index');
    Route::get('/error-corrections','DeathRegistration\BirthErrorCorrectionController@index');

    Route::get('/search/{tab}/request','Search\DeathSearchController@newBirthCertificateSearch');

    Route::get('/search/view/{searchId}','Search\DeathSearchController@viewBirthCertificateSearch');
    Route::post('search/send-back-result','Search\DeathSearchController@sendBackResult');
    Route::post('search/exist/{trackerId}','Search\DeathSearchController@checkExisteByEntryNumber');

    ///  search processing

    Route::get('/search/{tab}/processing','Search\DeathSearchController@process');

    Route::get('/search/processing/view/{searchId}','Search\DeathSearchController@viewBirthCertificateSearch');
    Route::post('search/processing/approve','Search\DeathSearchController@sendBackResult');
    Route::post('search/processing/exist/{trackerId}','Search\DeathSearchController@checkExisteByEntryNumber');

    //verify
    Route::post('verify/search-byentry-number/{trackerId}','DeathRegistration\BirthVerificationController@serachByEntryNumber');

    Route::get('/{tab}/verify','DeathRegistration\BirthVerificationController@index');
    Route::get('/verify/view-request/{trackerId}','DeathRegistration\BirthVerificationController@viewRequest');

    Route::get('/verify/my-task/{trackerID}','DeathRegistration\BirthVerificationController@myTask');

    Route::post('/verify/response','DeathRegistration\BirthVerificationController@response');

    /// pro
    ///
       Route::get('/verify/{tab}/processing','DeathRegistration\BirthVerificationController@process');
        Route::get('/verify/view-process-request/{trackerId}','DeathRegistration\BirthVerificationController@viewRequest');

        Route::get('/verify/process/my-task/{trackerID}','DeathRegistration\BirthVerificationController@myTask');

        Route::post('/verify/process/response','DeathRegistration\BirthVerificationController@processResponse');
});

Route::group(['prefix'=>'roles'],function (){

    Route::get('/','Role\RoleController@index');
    Route::get('/create','Role\RoleController@create');
    Route::post('/store','Role\RoleController@store');

    Route::get('/{roleId}/edit','Role\RoleController@edit')->name('role-edit');
    Route::post('/update/{roleId}','Role\RoleController@update');

});

//userController goes here

Route::group(['prefix'=>'users'],function (){

    Route::get('/','User\UserController@index');
    Route::get('/create','User\UserController@create');
    Route::post('/store','User\UserController@store');
    Route::get('/{userId}/edit','User\UserController@edit')->name('user-edit');
    Route::post('/update/{userId}','User\UserController@update');
    Route::get('/view/{userId}','User\UserController@view');

});

//Permission controller

Route::group(['prefix'=>'permissions'],function (){

    Route::get('/','Permission\PermissionController@index');
    Route::get('/create','User\UserController@create');

});


Route::group(['prefix'=>'departments'],function (){

    Route::get('/','Department\DepartmentController@index');
    Route::get('/create','Department\DepartmentController@create');
    Route::post('/store','Department\DepartmentController@store');
    Route::get('/{departmentId}/edit','Department\DepartmentController@edit')->name('department-edit');

    Route::post('/update/{departmentId}','Department\DepartmentController@update');

});

//hospitals

Route::group(['prefix'=>'hospitals'],function (){

    Route::get('/','Hospital\HospitalController@index');
    Route::get('/create','Hospital\HospitalController@create');
    Route::post('/store','Hospital\HospitalController@store');
    Route::get('/{hospitalId}/edit','Hospital\HospitalController@edit')->name('hospital-edit');

    Route::post('/update/{hospitalId}','Hospital\HospitalController@update');

});


//offices

Route::group(['prefix'=>'offices'],function (){

    Route::get('/','Office\RitaOfficeController@index');
    Route::get('/create','Office\RitaOfficeController@create');
    Route::post('/store','Office\RitaOfficeController@store');
    Route::get('/{hospitalId}/edit','Office\RitaOfficeController@edit')->name('office-edit');

    Route::post('/update/{hospitalId}','Office\RitaOfficeController@update');

});

//regions

Route::group(['prefix'=>'regions'],function (){
    Route::get('/','Region\RegionController@index');
    Route::get('/create','Region\RegionController@create');

    Route::get('/get-all','Region\RegionController@getAll');
    Route::get('/{districtId}/edit','Region\RegionController@edit')->name('region-edit');
    Route::post('/store','Region\RegionController@store');
    Route::post('/update/{regionId}','Region\RegionController@update');

});


//districts

Route::group(['prefix'=>'districts'],function (){
    Route::get('/','District\DistrictController@index');
    Route::get('/create','District\DistrictController@create');

    Route::get('/get-all','District\DistrictController@getAll');
    Route::get('/{districtId}/edit','District\DistrictController@edit')->name('district-edit');
    Route::post('/store','District\DistrictController@store');
    Route::post('/update','District\DistrictController@update');


});

Auth::routes();

Route::post('login','Auth\LoginController@login')->name('login');

Route::get('logout','Auth\LoginController@logout')->name('logout');

//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'Auth\LoginController@showLoginForm')->name('/');

//search

Route::get('/advanced-search', 'Search\AdvancedSearch@advancedSearch');



Route::group(['prefix'=>'reports'],function (){


    ///cert-type  1---new birth, 2---replace, 3..
    Route::get('/certificate/{trackerId}/view/{type}','Report\PrintController@certificate');
    Route::get('/replace-certificate/print/{entryNo}','Report\PrintController@print');
    Route::get('/duplicate-certificate/print/{entryNo}','Report\PrintController@print');

    Route::get('/birth-correction-certificate/print/{entryNo}','Report\PrintController@print');


    //Death cert
//    Route::get('/new-death-certificate/print/{entryNo}','Report\PrintController@deathPrint');
    Route::get('/death-correction-certificate/print/{entryNo}','Report\PrintController@deathPrint');
    Route::get('/new-death-certificate/print/{entryNo}','Report\PrintController@deathPrint');

//    Route::get('/new-death-certificate/{entryNo}/view/{type}','Report\PrintController@deathCertificte');


});

Route::get('certificatex/{tr}/view/{cert-type}','Report\PrintController@certificate');
