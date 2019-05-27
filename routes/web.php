<?php
use PHPJasper\PHPJasper;
use JasperPHP\JasperPHP;

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

Route::get('aluno/report-database', function (Request $request) {
    set_time_limit(3000);
    $input = app_path('Reports') . DIRECTORY_SEPARATOR . 'Coffee_Landscape.jasper';
    $output = public_path('uploads') . DIRECTORY_SEPARATOR . 'alunos';
    $jasper = new JasperPHP(app_path('Reports'));

    $jasper->process(
        $input,
        $output,
        ['pdf'],
        [],
        [
            'driver' => env('DB_CONNECTION'), //mysql, ....
            'username' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'host' => env('DB_HOST'),
            'database' => env('DB_DATABASE'),
            'port' => env('DB_PORT'),
        ]
    )->execute();

    $file = $output . '.pdf';
    $path = $file;
    // caso o arquivo não tenha sido gerado retorno um erro 404
    if (!file_exists($file)) {
        abort(404);
    }
    //caso tenha sido gerado pego o conteudo
    $file = file_get_contents($file);
    //deleta o arquivo gerado, pois iremos mandar o conteudo para o navegador
    unlink($path);
    // retornamos o conteudo para o navegador que íra abrir o PDF
    return response($file, 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="cliente.pdf"');
})->name('aluno.report.basic');

Route::get('aluno/report-api', function (Request $request) {
    set_time_limit(3000);
    $file = 'Aluno_';
    $input = app_path('Reports') . DIRECTORY_SEPARATOR . 'Coffee_Landscape_Api.jasper';
    $output = public_path('uploads') . DIRECTORY_SEPARATOR . $file;
    $json = $output . '.json';
    file_put_contents($json, file_get_contents(route('api.alunos.get'), false));
    $jasper = new JasperPHP(app_path('Reports'));

    $jasper->process(
        $input,
        $output,
        array("pdf"), //formato
        array(), //parametros
        array("driver" => "json", "json_query" => ".", "data_file" => $json)
    )->execute();
    //apaga arquivo json temporário
    unlink($json);
    $file = $output . '.pdf';
    $path = $file;
    // caso o arquivo não tenha sido gerado retorno um erro 404
    if (!file_exists($file)) {
        abort(404);
    }
    //caso tenha sido gerado pego o conteudo
    $file = file_get_contents($file);
    //deleta o arquivo gerado, pois iremos mandar o conteudo para o navegador
    unlink($path);
    // retornamos o conteudo para o navegador que íra abrir o PDF
    return response($file, 200)
        ->header('Content-Type', 'application/pdf')
        ->header('Content-Disposition', 'inline; filename="cliente.pdf"');
})->name('aluno.report.api');
