<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Information;

class InformationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Information::firstOrCreate([
            'name' => 'Datum',
            // 30 sekundi
            'poll_interval' => 30,
        ]);
        Information::firstOrCreate([
            'name' => 'Vrijeme',
            // 1 minuta = 60 sekundi
            'poll_interval' => 60,
        ]);
        Information::firstOrCreate([
            'name' => 'Tecajna lista',
            // 1 sat = 3600 sekundi
            'poll_interval' => 3600,
        ]);
    }
}
