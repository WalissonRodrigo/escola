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
    public function reportBasic()
    {
        $url = route('aluno.report.basic');
        return '<a class="btn btn-xs btn-success" target="_blank" href="' . $url . '" data-toggle="tooltip" title="Relatório construido com Jasper a partir do banco de dados"><i class="fa fa-file"></i> PDF</a>';
    }

    public function reportApi()
    {
        $url = route('aluno.report.api');
        return '<a class="btn btn-primary ladda-button" target="_blank" href="' . $url . '" data-toggle="tooltip" title="Relatório construido com Jasper a partir de API Json"><i class="fa fa-file"></i> API</a>';
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
