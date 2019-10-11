<?php

use App\Profession;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProfessionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        // DB::table('professions')->insert([
        //     'title' => 'Back-end development'
        // ]); <------Esta es a forma sin Elocuent------#

        Profession::create([
            'title' => 'Back-end development'
        ]);

        Profession::create([
            'title' => 'Front-end development'
        ]);

        factory(Profession::class, 18)->create();


    }
}
