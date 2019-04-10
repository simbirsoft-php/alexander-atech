<?php

namespace Tests\Unit;

use App\Models\Stoa;
use Tests\TestCase;

class StoaControllerTest extends TestCase
{
    public function testIndex()
    {
        $response = $this->get(route('stoa.get-all'));
        $response->assertStatus(200);
    }

    public function testShow()
    {
        /** @var Stoa $stoa */
        $stoa = factory(Stoa::class)->create();

        $response = $this->get(route('stoa.get-all', ['stoa' => $stoa->id]));
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                [
                    'name' => $stoa->name,
                    'schedule' => null
                ]
            ]
        ]);
    }

    public function testShowOne()
    {
        /** @var Stoa $stoa */
        $stoa = factory(Stoa::class)->create();

        $response = $this->get(route('stoa.get', ['stoa' => $stoa->id]));
        $response->assertStatus(200);
        $response->assertJson([
            'data' => [
                'name' => $stoa->name,
                'schedule' => null
            ]
        ]);
    }

    public function testCreate()
    {

        $data = [
            'name' => 'test stoa',
        ];

        $response = $this->sendRequest(
            'POST',
            route('stoa.post'),
            $data
        );

        $response->assertStatus(201);
        $response->assertJsonFragment([
            'data' => [
                'name' => $data['name'],
                'schedule' => null,
            ]
        ]);

        $stoa = Stoa::where('name', '=', $data['name'])->first();
        $this->assertTrue($stoa->exists);
    }

    public function testUpdate()
    {

        $stoa = factory(Stoa::class)->create();

        $data = [
            'id' => $stoa->id,
            'name' => 'test stoa',
        ];

        $response = $this->sendRequest(
            'PUT',
            route('stoa.put', $stoa->id),
            $data
        );

        $response->assertStatus(200);
        $response->assertJsonFragment([
            'data' => [
                'name' => 'test stoa',
                'schedule' => null,
            ]
        ]);
    }

    public function testDelete()
    {

        $stoa = factory(Stoa::class)->create();

        $response = $this->sendRequest(
            'DELETE',
            route('stoa.delete', $stoa->id)
        );

        $response->assertStatus(204);
    }
}
