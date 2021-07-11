<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\DBLoans\Branch;
class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $branch = Branch::firstOrNew(['name'=>'Main Branch']);
        if(!$branch->exists){
            $branch->save();
        }
    }
}
