<?php

use Illuminate\Database\Seeder;

class FuncaosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('funcaos')->insert([
            'descricao' => 'SCIIJ01 - Supervisor Clínico Institucional CAPS Infanto-Juvenil',
        ]);

        DB::table('funcaos')->insert([
            'descricao' => 'SCIAD02 - Supervisor Clínico Institucional APS AD III',
        ]);

        DB::table('funcaos')->insert([
            'descricao' => 'SCIEL03 - Supervisor Clínico Institucional CAPS III Eldorado',
        ]);

        DB::table('funcaos')->insert([
            'descricao' => 'SCISD04 - Supervisor Clínico Institucional CAPS III Sede',
        ]);
    }
}
