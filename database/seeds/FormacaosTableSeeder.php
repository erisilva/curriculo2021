<?php

use Illuminate\Database\Seeder;

class FormacaosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('formacaos')->insert([
            'descricao' => 'Médico',
        ]);

        DB::table('formacaos')->insert([
            'descricao' => 'Médico Psiquiatra',
        ]);

        DB::table('formacaos')->insert([
            'descricao' => 'Psicólogo',
        ]);

        DB::table('formacaos')->insert([
            'descricao' => 'Enfermeiro',
        ]);
        DB::table('formacaos')->insert([
            'descricao' => 'Assistente Social',
        ]);
        DB::table('formacaos')->insert([
            'descricao' => 'Terapeuta Ocupacional',
        ]);

    }
}
