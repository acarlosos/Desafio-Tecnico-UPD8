<?php

namespace Database\Seeders;

use App\Models\Cidade;
use Illuminate\Database\Seeder;
use Storage;

class CidadesSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $json = Storage::get('cities.json');
        $cidades = json_decode($json, true);
        foreach ($cidades as $key => $cidade) {
            if($cidade['country_code'] == 'BR'){
                Cidade::create([
                    'nome' => $cidade['name'],
                    'uf' => $cidade['state_code'],
                ]);
            }
        }
    }
}
