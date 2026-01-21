<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Firestation;

class FirestationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Firestation::factory()->count(1)->create([
            'city' => 'Saint Martin des Noyers',
            'postal_code' => '85140',
            'code' => '925654'
        ]);
    }
}
