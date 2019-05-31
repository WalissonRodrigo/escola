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
    return view('welcome');
});

Route::get('aluno/report-database', 'Admin\AlunoCrudController@reportBasicSql')->name('aluno.report.basic.sql');

Route::get('aluno/report-api', 'Admin\AlunoCrudController@reportBasicApi')->name('aluno.report.basic.api');
