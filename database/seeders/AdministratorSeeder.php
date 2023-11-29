<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class AdministratorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
     /*   DB::table('administrators')->insert([
            'cin'=>intval(Str::random(8)),
            'last_name'=>Str::random(10),
            'first_name'=>Str::random(10),
            'email'=>Str::random(20),
            'password'=>Str::random(),
            'role'=>array_rand(['Admin','Super-Admin'],1)]);*/
    }
}
