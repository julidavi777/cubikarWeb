<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;

class DepartamentoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1,  'name' =>'AMAZONAS'],
            ['id' => 2,  'name' =>'ANTIOQUIA'],
            ['id' => 3,  'name' =>'ARAUCA'],
            ['id' => 4,  'name' =>'ARCHIPIÉLAGO DE SAN ANDRÉS, PROVIDENCIA Y SANTA CATALINA'],
            ['id' => 5,  'name' =>'ATLANTICO'],
            ['id' => 6,  'name' =>'BOLIVAR'],
            ['id' => 7,  'name' =>'BOYACA'],
            ['id' => 8,  'name' =>'CALDAS'],
            ['id' => 9,  'name' =>'CAQUETA'],
            ['id' => 10, 'name' => 'CASANARE'],
            ['id' => 11, 'name' => 'CAUCA'],
            ['id' => 12, 'name' => 'CESAR'],
            ['id' => 13, 'name' => 'CHOCO'],
            ['id' => 14, 'name' => 'CORDOBA'],
            ['id' => 15, 'name' => 'CUNDINAMARCA'],
            ['id' => 16, 'name' => 'GUAINIA'],
            ['id' => 17, 'name' => 'GUAJIRA'],
            ['id' => 18, 'name' => 'GUAVIARE'],
            ['id' => 19, 'name' => 'HUILA'],
            ['id' => 20, 'name' => 'MAGDALENA'],
            ['id' => 21, 'name' => 'META'],
            ['id' => 22, 'name' => 'NARIÑO'],
            ['id' => 23, 'name' => 'NORTE DE SANTANDER'],
            ['id' => 24, 'name' => 'PUTUMAYO'],
            ['id' => 25, 'name' => 'QUINDIO'],
            ['id' => 26, 'name' => 'RISARALDA'],
            ['id' => 27, 'name' => 'SANTANDER'],
            ['id' => 28, 'name' => 'SUCRE'],
            ['id' => 29, 'name' => 'TOLIMA'],
            ['id' => 30, 'name' => 'VALLE DEL CAUCA'],
            ['id' => 31, 'name' => 'VAUPES'],
            ['id' => 32, 'name' => 'VICHADA']
        ];
        
        Departamento::insert($data);
    }
}
