<?php

namespace App\Http\Controllers\Admin;

use Backpack\CRUD\app\Http\Controllers\CrudController;

// VALIDATION: change the requests to match your own file names if you need form validation
use App\Http\Requests\AlunoRequest as StoreRequest;
use App\Http\Requests\AlunoRequest as UpdateRequest;
use Backpack\CRUD\CrudPanel;
use JasperPHP\JasperPHP;

/**
 * Class AlunoCrudController
 * @package App\Http\Controllers\Admin
 * @property-read CrudPanel $crud
 */
class AlunoCrudController extends CrudController
{
    public function setup()
    {
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Basic Information
        |--------------------------------------------------------------------------
        */
        $this->crud->setModel('App\Models\Aluno');
        $this->crud->setRoute(config('backpack.base.route_prefix') . '/aluno');
        $this->crud->setEntityNameStrings('aluno', 'alunos');
        $this->crud->enableExportButtons(true);
        $this->crud->enableResponsiveTable(true);
        $this->crud->addButtonFromModelFunction('top', 'aluno', 'reports', 'beginning');
        //$this->crud->addButtonFromModelFunction('line', 'aluno', 'reportBasic', 'beginning');
        // add a button whose HTML is returned by a method in the CRUD model
        /*
        |--------------------------------------------------------------------------
        | CrudPanel Configuration
        |--------------------------------------------------------------------------
        */

        // TODO: remove setFromDb() and manually define Fields and Columns
        $this->crud->setFromDb();
        /* $this->crud->setColumns(['nome', 'endereco', 'cidade']);
        $this->crud->addFields([
            [
                'name' => 'nome',
                'label' => "Nome do Aluno"
            ],
            [
                'name' => 'endereco',
                'label' => "Endereço"
            ],
            [
                'name' => 'cidade',
                'label' => "Cidade"
            ],
        ]); */
        // add asterisk for fields that are required in AlunoRequest
        $this->crud->setRequiredFields(StoreRequest::class, 'create');
        $this->crud->setRequiredFields(UpdateRequest::class, 'edit');
    }

    public function store(StoreRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::storeCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function update(UpdateRequest $request)
    {
        // your additional operations before save here
        $redirect_location = parent::updateCrud($request);
        // your additional operations after save here
        // use $this->data['entry'] or $this->crud->entry
        return $redirect_location;
    }

    public function reportBasicSql()
    {
        set_time_limit(3000);
        $file = 'Aluno';
        $input = app_path('Reports') . DIRECTORY_SEPARATOR . 'Coffee_Landscape.jasper';
        $output = public_path('uploads') . DIRECTORY_SEPARATOR . $file;
        $jasper = new JasperPHP(app_path('Reports'));

        $jasper->process(
            $input, $output, ['pdf'], [], ['driver' => env('DB_CONNECTION'), 'username' => env('DB_USERNAME'), 
                'password' => env('DB_PASSWORD'), 'host' => env('DB_HOST'), 
                'database' => env('DB_DATABASE'), 'port' => env('DB_PORT'), ]
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
    }

    public function reportBasicApi()
    {
        set_time_limit(3000);
        $file = 'Aluno';
        $input = app_path('Reports') . DIRECTORY_SEPARATOR . 'Coffee_Landscape_Api.jasper';
        $output = public_path('uploads') . DIRECTORY_SEPARATOR . $file;
        $json = $output . '.json';
        file_put_contents($json, file_get_contents(route('api.alunos.get'), false));
        $jasper = new JasperPHP(app_path('Reports'));
        $jasper->process(
         //jasper, saída, tipos arquivos, parametros, conexão
            $input, $output, array("pdf"), array(), array("driver" => "json", "json_query" => ".", "data_file" => $json)
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
    }
}
