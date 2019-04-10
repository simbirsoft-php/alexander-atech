<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Schedule
 * @package App
 *
 * @property integer $id
 * @property integer $stoa_id
 * @property string $monday_from
 * @property string $monday_to
 * @property string $tuesday_from
 * @property string $tuesday_to
 * @property string $wednesday_from
 * @property string $wednesday_to
 * @property string $thursday_from
 * @property string $thursday_to
 * @property string $friday_from
 * @property string $friday_to
 * @property string $saturday_from
 * @property string $saturday_to
 * @property string $sunday_from
 * @property string $sunday_to
 *
 * @OA\Schema(
 *     description="Schedule model",
 *     type="object",
 *     title="Schedule model",
 *     required={
 *         "stoa_id",
 *         "monday_from",
 *         "monday_to",
 *         "tuesday_from",
 *         "tuesday_to",
 *         "wednesday_from",
 *         "wednesday_to",
 *         "thursday_from",
 *         "thursday_to",
 *         "friday_from",
 *         "friday_to",
 *         "saturday_from",
 *         "saturday_to",
 *         "sunday_from",
 *         "sunday_to"
 *     },
 * )
 *
 * @OA\Property(
 *     property="stoa_id",
 *     type="integer",
 *     title="Stoa id",
 * )
 *
 * @OA\Property(
 *     property="monday_from",
 *     type="time"
 * )
 * @OA\Property(
 *     property="monday_to",
 *     type="integer"
 * )
 * @OA\Property(
 *     property="tuesday_from",
 *     type="integer"
 * )
 * @OA\Property(
 *     property="tuesday_to",
 *     type="integer"
 * )
 * @OA\Property(
 *     property="wednesday_from",
 *     type="integer"
 * )
 * @OA\Property(
 *     property="wednesday_to",
 *     type="integer"
 * )
 * @OA\Property(
 *     property="thursday_from",
 *     type="integer"
 * )
 * @OA\Property(
 *     property="thursday_to",
 *     type="integer"
 * )
 * @OA\Property(
 *     property="friday_from",
 *     type="integer"
 * )
 * @OA\Property(
 *     property="friday_to",
 *     type="integer"
 * )
 * @OA\Property(
 *     property="saturday_from",
 *     type="integer"
 * )
 * @OA\Property(
 *     property="saturday_to",
 *     type="integer"
 * )
 * @OA\Property(
 *     property="sunday_from",
 *     type="integer"
 * )
 * @OA\Property(
 *     property="sunday_to",
 *     type="integer"
 * )
 */
class Schedule extends Model
{
    protected $fillable = [
        'stoa_id',
        'monday_from',
        'monday_to',
        'tuesday_from',
        'tuesday_to',
        'wednesday_from',
        'wednesday_to',
        'thursday_from',
        'thursday_to',
        'friday_from',
        'friday_to',
        'saturday_from',
        'saturday_to',
        'sunday_from',
        'sunday_to'
    ];

    /**
     * Импорт данных о расписании
     *
     * @param array $requestData
     * @param int $stoaId
     */
    public function importData(array $requestData, int $stoaId): void
    {
        $this->fill([
            'stoa_id'        => $stoaId,
            'monday_from'    => $requestData['monday']['from'],
            'monday_to'      => $requestData['monday']['to'],
            'tuesday_from'   => $requestData['tuesday']['from'],
            'tuesday_to'     => $requestData['tuesday']['to'],
            'wednesday_from' => $requestData['wednesday']['from'],
            'wednesday_to'   => $requestData['wednesday']['to'],
            'thursday_from'  => $requestData['thursday']['from'],
            'thursday_to'    => $requestData['thursday']['to'],
            'friday_from'    => $requestData['friday']['from'],
            'friday_to'      => $requestData['friday']['to'],
            'saturday_from'  => $requestData['saturday']['from'],
            'saturday_to'    => $requestData['saturday']['to'],
            'sunday_from'    => $requestData['sunday']['from'],
            'sunday_to'      => $requestData['sunday']['to'],
        ]);

        $this->save();
    }
}
