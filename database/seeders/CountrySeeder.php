<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //  FIRST METHOD 
        //will return a stirng
        // $json=file_get_contents('database/data/Country.json');

        // SECOND METHOD
        // using laravel path helper function
        // $json=file_get_contents(database_path('data/Country.json'));

        // third method 
        // need to config in filesystem
        $json=Storage::disk('seed-data')->get('Country.json');

        //convert array 
        $data=json_decode($json,true);

        // dd ($data);
        DB::table('countries')->insert($data);

    }
}
