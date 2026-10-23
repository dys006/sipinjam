<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Suppliers; // Sesuaikan dengan nama file Model kamu

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $suppliers = [
            ['name' => 'PT.Elektronik Jaya',  'no_tlp' => '08123456789'],
            ['name' => 'PT.Berkah Jaya',  'no_tlp' => '08987654321'],
            ['name' => 'PT.Berkah Jaya',  'no_tlp' => '08987654321'],

         ];
          foreach ($suppliers as $data) {
            $suppliers = Suppliers::create($data);
        }

    }
}
