<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use App\Contracts\DataImportFromCSV;

class DataImportFromCSVService implements DataImportFromCSV
{
    private $map = [
        0 => 'stoa_id',
        1 => 'monday_from',
        2 => 'monday_to',
        3 => 'tuesday_from',
        4 => 'tuesday_to',
        5 => 'wednesday_from',
        6 => 'wednesday_to',
        7 => 'thursday_from',
        8 => 'thursday_to',
        9 => 'friday_from',
        10 => 'friday_to',
        11 => 'saturday_from',
        12 => 'saturday_to',
        13 => 'sunday_from',
        14 => 'sunday_to',
    ];

    /**
     * Parse data from csv
     *
     * @param string $path
     * @return array
     * @throws \Exception
     */
    public function getData(string $path): array
    {
        $rows = [];
        $file = Storage::get($path);
        $csvAsArray = explode(PHP_EOL, $file);
        array_pop($csvAsArray);

        foreach ($csvAsArray as $row) {
            $rows[] = $this->prepareData(explode(';', $row));
        }

        return $rows;
    }

    /**
     * Data mapping
     *
     * @param array $row
     * @return array
     */
    public function prepareData(array $row) : array
    {
        $result = [];

        foreach ($this->map as $key => $value) {
            $result[$value] = $row[$key];
        }

        return $result;
    }
}
