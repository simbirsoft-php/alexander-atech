<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, RefreshDatabase;

    public function sendRequest(string $method, string $url, array $data = [])
    {
        return $this->json(
            $method,
            $url,
            $data,
            [
                'Content-Type'  => 'application/vnd.api+json',
                'Accept'        => 'application/vnd.api+json'
            ]
        );
    }
}
