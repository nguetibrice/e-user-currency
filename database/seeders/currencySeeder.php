<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class currencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('currencies')->insert([
            'code' => 'XAF',
            'description' => 'Central African CFA Franc',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('currencies')->insert([
            'code' => 'USD',
            'description' => 'United States Dollar',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('currencies')->insert([
            'code' => 'CAD',
            'description' => 'Canadian Dollar',
            'created_at' => date('Y-m-d H:i:s')
        ]);
        DB::table('currencies')->insert([
            'code' => 'EUR',
            'description' => 'Euro',
            'created_at' => date('Y-m-d H:i:s')
        ]);

    }
}
