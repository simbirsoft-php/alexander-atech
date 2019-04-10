<?php

namespace App\Services;

use App\Models\Schedule;
use App\Models\Stoa;
use App\Contracts\DataImport;

class DataImportService implements DataImport
{
    private $dataProviders;

    public function __construct(array $dataProviders)
    {
        $this->dataProviders = $dataProviders;
    }

    /**
     * Import data from file
     *
     * @param string $path
     * @param string $originalFileName
     * @throws \Exception
     */
    public function import(string $path, string $originalFileName): void
    {
        $nameArray = explode('.',  $originalFileName);
        $ext = end($nameArray);

        if (!array_key_exists($ext, $this->dataProviders)) {
            throw new \Exception('Unknown file format.');
        }

        $data = $this->dataProviders[$ext]->getData($path);

        foreach ($data as $row) {
            /** @var Stoa $stoa */
            $stoa = Stoa::where('name', '=', $row['stoa_id'])->first();

            if (!$stoa) {
                $stoa = new Stoa(['name' => $row['stoa_id']]);
                $stoa->save();
            }

            $row['stoa_id'] = $stoa->id;
            $stoa->schedule()->delete();
            (new Schedule)->create($row);
        }
    }
}
