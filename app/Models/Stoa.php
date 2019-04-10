<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Stoa
 * @package App
 *
 * @OA\Schema(
 *     description="Stoa model",
 *     title="Stoa model",
 *     required={"name"},
 * )
 *
 * @OA\Property(
 *     property="id",
 *     type="integer",
 *     description="Stoa id"
 * )
 *
 * @OA\Property(
 *     property="name",
 *     type="string",
 *     description="Stoa name"
 * )
 *
 * @property integer $id
 * @property string $name
 * @property Schedule $schedule
 */
class Stoa extends Model
{
    protected $fillable = [
        'name'
    ];

    /**
     * @return Schedule
     */
    public function schedule()
    {
        return $this->hasOne(Schedule::class);
    }
}
