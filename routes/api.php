<?php

use Illuminate\Http\Request;
use App\Models\Aluno;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('alunos/get', function(Request $request){
    set_time_limit(3000);
    $alunos = Aluno::orderBy('cidade')->get();
    return json_encode($alunos);
})->name('api.alunos.get');