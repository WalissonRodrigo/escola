<?php

use Illuminate\Database\Seeder;

use App\Models\Aluno;
use Laracasts\TestDummy\Factory as TestDummy;

class EscolaFakerTableSeeder extends Seeder
{
    public function run()
    {
        Aluno::truncate();
        factory(Aluno::class, 1000)->create();
    }
}
