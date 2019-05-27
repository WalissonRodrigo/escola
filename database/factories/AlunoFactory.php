<?php

/* @var $factory \Illuminate\Database\Eloquent\Factory */

use App\Models\Aluno;
use Faker\Generator as Faker;

$factory->define(Aluno::class, function (Faker $faker) {
    return [
        'nome' => $faker->name,
        'endereco' => $faker->address,
        'cidade' => $faker->city,
    ];
});
