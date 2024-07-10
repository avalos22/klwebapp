<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Joanna',
            'last_name' => 'Avalos',
            'email' => 'joanna@lunavalos.com',
            'password' => bcrypt('12345678'),
            'job_title' => 'Web Developer',
            'office' => 'saltillo',
        ])->assignRole('admin');

        User::factory(18)->create();
    }
}
