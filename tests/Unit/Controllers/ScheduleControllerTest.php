<?php

namespace Tests\Unit\Controllers;

use App\Models\Schedule;
use App\Models\Stoa;
use Tests\TestCase;

class ScheduleControllerTest extends TestCase
{
    public function testImport()
    {
        $uploadedFile = base_path('tests/data/import.csv');

        $response = $this->postJson(route('schedule.import'), [
            'file' => new \Illuminate\Http\UploadedFile($uploadedFile, 'test.csv', null, null, null, true),
        ]);

        $response->assertStatus(201);
    }

    public function testSetSchedule()
    {
        $stoa = factory(Stoa::class)->create();

        $data = [
            'monday' => [
                'from' => '08:00:00',
                'to' => '18:00:00'
            ],
            'tuesday' => [
                'from' => '08:00:00',
                'to' => '18:00:00'
            ],
            'wednesday' => [
                'from' => '08:00:00',
                'to' => '18:00:00'
            ],
            'thursday' => [
                'from' => '08:00:00',
                'to' => '18:00:00'
            ],
            'friday' => [
                'from' => '08:00:00',
                'to' => '18:00:00'
            ],
            'saturday' => [
                'from' => '08:00:00',
                'to' => '18:00:00'
            ],
            'sunday' => [
                'from' => '08:00:00',
                'to' => '18:00:00'
            ],
        ];

        $response = $this->sendRequest(
            'POST',
            route('schedule.set-schedule', $stoa->id),
            $data
        );

        $response->assertStatus(201);

        $stoa = Stoa::with(['Schedule'])->where('id', '=', $stoa->id)->first();
        $this->assertTrue($stoa->schedule->exists);
    }

    public function testSetScheduleFail()
    {
        $stoa = factory(Stoa::class)->create();

        $data = [
            'monday' => [
                'from' => '',
                'to' => ''
            ],
            'tuesday' => [
                'from' => '08:00:00',
                'to' => '18:00:00'
            ],
            'wednesday' => [
                'from' => '08:00:00',
                'to' => '18:00:00'
            ],
            'thursday' => [
                'from' => '08:00:00',
                'to' => '18:00:00'
            ],
            'friday' => [
                'from' => '08:00:00',
                'to' => '18:00:00'
            ],
            'saturday' => [
                'from' => '08:00:00',
                'to' => '18:00:00'
            ],
            'sunday' => [
                'from' => '08:00:00',
                'to' => '18:00:00'
            ],
        ];

        $response = $this->sendRequest(
            'POST',
            route('schedule.set-schedule', $stoa->id),
            $data
        );

        $response->assertStatus(422);
    }

    public function testEraseSchedule()
    {
        $stoa = factory(Stoa::class)->create();
        $schedule = factory(Schedule::class)->create(['stoa_id' => $stoa->id]);

        $response = $this->sendRequest(
            'DELETE',
            route('schedule.delete', $stoa->id)
        );

        $response->assertStatus(204);
    }
}
