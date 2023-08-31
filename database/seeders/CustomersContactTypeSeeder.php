<?php

namespace Database\Seeders;

use App\Models\CustomersContactType;
use Illuminate\Database\Seeder;

class CustomersContactTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['id' => 1, 'name' => 'Contacto comercial 1'],
            ['id' => 2, 'name' => 'Contacto comercial 2'],
            ['id' => 3, 'name' => 'Contacto facturación'],
            ['id' => 4, 'name' => 'Contacto pagos Tesorería'],
          
        ];

        CustomersContactType::insert($data);
    }
}
