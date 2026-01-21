<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::factory()->count(1)->create([
            'firstname' => 'Axel',
            'lastname' => 'Jaunet',
            'email' => 'okino813@pm.me',
            'password' => Hash::make('password'),
            'firestation_id' => 1
        ]);
    }
}
