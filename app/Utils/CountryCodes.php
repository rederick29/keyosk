<?php
namespace App\Utils;

use Illuminate\Support\Facades\Log;

class CountryCodes {
    const CSV_PATH = 'thirdparty/country-codes/all/all.csv';
    private static array $country_codes = [];
    static function get_codes(): array | null
    {
        if (!empty(self::$country_codes)) {
            return self::$country_codes;
        }

        $codes_countries_map = [];
        if (!file_exists(base_path(self::CSV_PATH))) {
            // try initialising submodules
            $current_dir = getcwd();
            chdir(base_path());
            shell_exec('git submodule update --init');
            chdir($current_dir);
            // file still doesn't exist, try the database
            if (!file_exists(base_path(self::CSV_PATH))) {
                // todo
                Log::error('Failed to find country codes csv file');
                return null;
            }
        }
        $file = fopen(base_path(self::CSV_PATH), 'r');
        $skip_line = fgetcsv($file);
        while (($line = fgetcsv($file)) !== false) {
            $codes_countries_map[$line[1]] = $line[0];
        }
        fclose($file);
        self::$country_codes = $codes_countries_map;
        return self::$country_codes;
    }
}
