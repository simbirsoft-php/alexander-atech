<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ScheduleResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'monday' => [
                'from' => $this->monday_from,
                'to'   => $this->monday_to
            ],
            'tuesday' => [
                'from' => $this->tuesday_from,
                'to'   => $this->tuesday_to
            ],
            'wednesday' => [
                'from' => $this->wednesday_from,
                'to'   => $this->wednesday_to
            ],
            'thursday' => [
                'from' => $this->thursday_from,
                'to'   => $this->thursday_to
            ],
            'friday' => [
                'from' => $this->friday_from,
                'to'   => $this->friday_to
            ],
            'saturday' => [
                'from' => $this->saturday_from,
                'to'   => $this->saturday_to
            ],
            'sunday' => [
                'from' => $this->sunday_from,
                'to'   => $this->sunday_to
            ]
        ];
    }
}
