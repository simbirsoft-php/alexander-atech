<?php

namespace App\Contracts;


interface DataImportFromCSV
{
    /**
     * Load data from file (by path)
     *
     * @param string $path
     * @return array
     */
    public function getData(string $path) : array;
}
