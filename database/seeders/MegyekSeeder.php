<?php

namespace Database\Seeders;

use App\Models\MegyekModel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MegyekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $megyek_array = ["Csongrád","Békés","Pest"];

        //végigmegyek a megyéken és egy insertálás beleteszi a táblába az adatot:
        foreach ($megyek_array as $megye) {
            $megyek = new MegyekModel();
            $megyek->me_nev = $megye;
            $megyek->save();
        }
    }
}
