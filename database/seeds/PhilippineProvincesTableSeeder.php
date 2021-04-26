<?php
namespace Database\Seeders;
use Illuminate\Database\Seeder;

class PhilippineProvincesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!DB::connection('dbsystem')->table('philippine_provinces')->count()) {
            DB::connection('dbsystem')->unprepared(file_get_contents(__DIR__ . '/sql/philippine_provinces.sql'));
        }
    }
}
