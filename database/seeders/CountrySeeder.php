<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Utils\CountryCodes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $countries = array_keys(CountryCodes::get_codes());
        foreach ($countries as $country_code) {
            Country::factory()->create(['code' => $country_code]);
        }
    }
}
