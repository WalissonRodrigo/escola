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
    $alunos = Aluno::where('cidade', 'like', '%Norte%')->get();
    return json_encode($alunos);
})->name('api.alunos.get');