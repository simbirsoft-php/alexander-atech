<?php

namespace App\Contracts;


interface DataImport
{
    /**
     * Import data from file
     *
     * @param string $path
     * @param string $originalFileName
     */
    public function import(string $path, string $originalFileName): void;
}
