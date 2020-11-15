<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class PostesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('postes')->insert([
            'reference' =>  Str::slug('responsable commercial'),
            'nom'   =>  'Responsable Commercial',
            'description'   =>  '',
            'salaire'   =>  15000000,
        ]);
    }
}
