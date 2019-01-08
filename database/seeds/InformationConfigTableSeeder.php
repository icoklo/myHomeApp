<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Information;
use App\Models\InformationConfig;

class InformationConfigTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $informationVrijeme = Information::where('name', '=', 'Vrijeme')->first();
        InformationConfig::firstOrCreate([
            'name' => 'vrijeme-1',
            'information_id' => $informationVrijeme->id,
            'default_value' => 'Sunčano',
        ]);
        InformationConfig::firstOrCreate([
            'name' => 'vrijeme-2',
            'information_id' => $informationVrijeme->id,
            'default_value' => 'Oblačno',
        ]);
        InformationConfig::firstOrCreate([
            'name' => 'vrijeme-3',
            'information_id' => $informationVrijeme->id,
            'default_value' => 'Pada snijeg',
        ]);
        InformationConfig::firstOrCreate([
            'name' => 'grad',
            'information_id' => $informationVrijeme->id,
            'default_value' => 'Varaždin',
        ]);

        $informationTecajnaLista = Information::where('name', '=', 'Tecajna lista')->first();
        InformationConfig::firstOrCreate([
            'name' => 'banka-1',
            'information_id' => $informationTecajnaLista->id,
            'default_value' => 'RBA',
        ]);
        InformationConfig::firstOrCreate([
            'name' => 'banka-2',
            'information_id' => $informationTecajnaLista->id,
            'default_value' => 'Zagrebačka',
        ]);
        InformationConfig::firstOrCreate([
            'name' => 'valuta',
            'information_id' => $informationTecajnaLista->id,
            'default_value' => 'HRK',
        ]);
        InformationConfig::firstOrCreate([
            'name' => 'kategorija',
            'information_id' => $informationTecajnaLista->id,
            'default_value' => 'srednji',
        ]);
        InformationConfig::firstOrCreate([
            'name' => 'vrijednost-tecaja-1',
            'information_id' => $informationTecajnaLista->id,
            'default_value' => '7,429937',
        ]);
        InformationConfig::firstOrCreate([
            'name' => 'vrijednost-tecaja-2',
            'information_id' => $informationTecajnaLista->id,
            'default_value' => '7,409937',
        ]);
        InformationConfig::firstOrCreate([
            'name' => 'vrijednost-tecaja-3',
            'information_id' => $informationTecajnaLista->id,
            'default_value' => '7,3937',
        ]);
    }
}
