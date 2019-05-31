<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Backpack\CRUD\CrudTrait;

class Aluno extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'alunos';
    protected $primaryKey = 'id';
    // public $timestamps = false;
    // protected $guarded = ['id'];
    protected $fillable = ['nome', 'endereco', 'cidade'];
    // protected $hidden = [];
    protected $dates = ['created_at', 'updated_at'];
    protected $dateFormat = 'Y-m-d H:i:s';
    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESORS
    |--------------------------------------------------------------------------
    */
    public function reportSql()
    {
        $url = route('aluno.report.basic.sql');
        return '<a target="_blank" href="' . $url .
            '" data-toggle="tooltip" title="Relatório construido com Jasper a partir do banco de dados">
                <i class="fa fa-file"></i> SQL</a>';
    }

    public function reportApi()
    {
        $url = route('aluno.report.basic.api');
        return '<a target="_blank" href="' . $url .
            '" data-toggle="tooltip" title="Relatório construido com Jasper a partir de API Json">
                <i class="fa fa-file"></i> API</a>';
    }

    public function reports()
    {
        $btnSql = self::reportSql();
        $btnApi = self::reportApi();
        $html = <<<EOD
        <div class="btn-group">
            <div class="dropdown">
                <button class="btn btn-primary dropdown-toggle" type="button" data-toggle="dropdown">Relatórios
                <span class="caret"></span></button>
                <ul class="dropdown-menu">
                    <li>$btnSql</li>
                    <li>$btnApi</li>
                </ul>
            </div>
        </div>
EOD;
        return $html;
    }
    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
    public function getCreatedAtAttribute($timestamp)
    {
        return \Carbon\Carbon::parse($timestamp)->format('d/m/Y H:i:s');
    }
    public function getUpdatedAtAttribute($timestamp)
    {
        return \Carbon\Carbon::parse($timestamp)->format('d/m/Y H:i:s');
    }
}
