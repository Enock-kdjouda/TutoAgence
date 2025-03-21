<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Property;
use App\Models\Option;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create(
            [
                'name' => 'John Doe',
                'email' => 'john.doe@example.com',
                'password' => bcrypt('password'),
            ]
        );
       $options =  Option::factory(10)->create();
       Property::factory(32)
       ->hasAttached($options->random(3))
       ->create();

       
    }
}
