<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Uom;

class UomSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $uoms = [
            // Unidades de Peso
            ['name' => 'kg', 'description' => 'Unidades de Peso'],
            ['name' => 'g', 'description' => 'Unidades de Peso'],
            ['name' => 'lb', 'description' => 'Unidades de Peso'],
            ['name' => 'oz', 'description' => 'Unidades de Peso'],
            ['name' => 'ton', 'description' => 'Unidades de Peso'],

            // Unidades de Longitud
            ['name' => 'in', 'description' => 'Unidades de Longitud'],
            ['name' => 'ft', 'description' => 'Unidades de Longitud'],
            ['name' => 'cm', 'description' => 'Unidades de Longitud'],
            ['name' => 'm', 'description' => 'Unidades de Longitud'],
            ['name' => 'yd', 'description' => 'Unidades de Longitud'],

            // Unidades de Volumen
            ['name' => 'l', 'description' => 'Unidades de Volumen'],
            ['name' => 'ml', 'description' => 'Unidades de Volumen'],
            ['name' => 'm3', 'description' => 'Unidades de Volumen'],
            ['name' => 'ft3', 'description' => 'Unidades de Volumen'],

            // Unidades de Cantidad
            ['name' => 'unit', 'description' => 'Unidades de Cantidad'],
            ['name' => 'box', 'description' => 'Unidades de Cantidad'],
            ['name' => 'pallet', 'description' => 'Unidades de Cantidad'],
            ['name' => 'crate', 'description' => 'Unidades de Cantidad'],
            ['name' => 'container', 'description' => 'Unidades de Cantidad'],

            // Unidades Especiales
            ['name' => 'teu', 'description' => 'Unidades Especiales'],
            ['name' => 'feu', 'description' => 'Unidades Especiales'],
        ];

        foreach ($uoms as $uom) {
            Uom::create($uom);
        }
    }
}
