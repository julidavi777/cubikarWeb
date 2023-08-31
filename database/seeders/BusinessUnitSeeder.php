<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BusinessUnitSeeder extends Seeder
{
  /**
     * Run the seeder.
     *
     * @return void
     */
    public function run()
    {
        $businessUnits = $this->getBusinessUnits();

        foreach ($businessUnits as $businessUnit) {
            DB::table('business_units')->insert($businessUnit);
        }
    }

    /**
     * Get the business units array.
     *
     * @return array
     */
    private function getBusinessUnits()
    {
        return [
            ['id' => '1', 'name' => 'CONSULTORIAS E INTERVENTORIAS'],
            ['id' => '2', 'name' => 'MANTENIMIENTOS'],
            ['id' => '3', 'name' => 'OBRAS CIVILES'],
            ['id' => '4', 'name' => 'REMODELACIONES Y ADECUACIONES'],
            ['id' => '5', 'name' => 'OTRO'],
        ];
    }
}
