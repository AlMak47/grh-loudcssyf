<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('departements')->insert([
            'reference' =>  Str::slug('laye distribution'),
            'title'   =>  'Laye Distribution',
            'description'   =>  '',
        ]);
    }
}
