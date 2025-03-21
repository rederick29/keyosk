<?php

namespace App\Utils;

use Illuminate\Support\Facades\Log;

class CountryCodes
{
    /*
        'name',
        'alpha-2', [2-letter country code]
        'alpha-3', [3-letter country code]
        'country-code',
        'iso_3166-2',
        'region',
        'sub-region',
        'intermediate-region',
        'region-code',
        'sub-region-code',
        'intermediate-region-code'
    */

    private const CSV_PATH = 'thirdparty/country-codes/all/all.csv';
    private const NAME_INDEX = 0;
    private const CODE_INDEX = 1;
    private static array $country_codes = [];

    public static function get_codes(): ?array
    {
        // If the country codes have already been loaded, return them
        if (!empty(self::$country_codes)) {
            return self::$country_codes;
        }

        try {
            // Load the country codes from the CSV file
            $filepath = base_path(self::CSV_PATH);

            // If the file doesn't exist, we haven't initialized the submodule, so do it now
            if (!file_exists($filepath)) {
                $current_dir = getcwd();
                chdir(base_path());
                exec('git submodule update --init 2>&1', $output, $result);
                chdir($current_dir);

                if ($result !== 0 || !file_exists($filepath)) {
                    throw new \RuntimeException('Country codes CSV file not found');
                }
            }

            $file = fopen($filepath, 'r');
            if (!$file) {
                throw new \RuntimeException('Failed to open country codes file');
            }

            $headers = fgetcsv($file);
            if (!$headers) {
                throw new \RuntimeException('Failed to read CSV headers');
            }

            // Could do more checks here for the header of the CSV, using the EXPECTED_HEADERS constant
            // but for now, we'll just read the file and assume it's correct

            self::$country_codes = [];
            while ($line = fgetcsv($file)) {
                $code = $line[self::CODE_INDEX] ?? ''; // Alpha-2 code
                $name = $line[self::NAME_INDEX] ?? ''; // Country name

                // Only add the country code if both the code and name are non-empty
                if (strlen($code) && strlen($name)) {
                    self::$country_codes[$code] = $name;
                }
            }

            fclose($file);

            return self::$country_codes;
        } catch (\Exception $e) {
            Log::error('Error processing country codes: ' . $e->getMessage(), [
                'file' => $filepath ?? null,
                'trace' => $e->getTraceAsString()
            ]);
            return null;
        }
    }
}
