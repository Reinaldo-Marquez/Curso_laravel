<?php

use App\Profession;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    
        $professionId = Profession::whereTitle('Back-end development')->value('id');
        
        factory(User::class)->create([
            'name' => 'Reinaldo',
            'email' => 'reinaldo@reinaldo.com',
            'password' => bcrypt('12345'),
            'profession_id' => $professionId 
        ]);

        factory(User::class, 14)->create();
    }
}
