<?php

namespace App\Http\Controllers;

use App\Contracts\DataImport;
use App\Http\Resources\StoaResource;
use App\Models\Schedule;
use App\Models\Stoa;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ImportScheduleRequest as ImportRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

/**
 * Class ScheduleController
 */
class ScheduleController extends Controller
{
    /**
     * Set schedule for specified stoa
     *
     * @param Stoa $stoa
     * @param ImportRequest $request
     * @return JsonResponse
     *
     * @OA\Post(
     *     path="/api/schedules/{stoa_id}",
     *     tags={"schedule"},
     *     summary="Добавление расписания для СТОА",
     *     description="Добавление расписания для СТОА",
     *     operationId="setSchedule",
     *     @OA\Parameter(
     *         name="stoa_id",
     *         in="path",
     *         description="Stoa id.",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(
     *                     property="monday",
     *                     type="object",
     *                     @OA\Property(
     *                         property="from",
     *                         type="string",
     *                         example="00:00:00",
     *                     ),
     *                     @OA\Property(
     *                         property="to",
     *                         type="string",
     *                         example="00:00:00",
     *                     ),
     *                 ),
     *                 @OA\Property(
     *                     property="tuesday",
     *                     type="object",
     *                     @OA\Property(
     *                         property="from",
     *                         type="string",
     *                         example="00:00:00",
     *                     ),
     *                     @OA\Property(
     *                         property="to",
     *                         type="string",
     *                         example="00:00:00",
     *                     ),
     *                 ),
     *                 @OA\Property(
     *                     property="wednesday",
     *                     type="object",
     *                     @OA\Property(
     *                         property="from",
     *                         type="string",
     *                         example="00:00:00",
     *                     ),
     *                     @OA\Property(
     *                         property="to",
     *                         type="string",
     *                         example="00:00:00",
     *                     ),
     *                 ),
     *                 @OA\Property(
     *                     property="thursday",
     *                     type="object",
     *                     @OA\Property(
     *                         property="from",
     *                         type="string",
     *                         example="00:00:00",
     *                     ),
     *                     @OA\Property(
     *                         property="to",
     *                         type="string",
     *                         example="00:00:00",
     *                     ),
     *                 ),
     *                 @OA\Property(
     *                     property="friday",
     *                     type="object",
     *                     @OA\Property(
     *                         property="from",
     *                         type="string",
     *                         example="00:00:00",
     *                     ),
     *                     @OA\Property(
     *                         property="to",
     *                         type="string",
     *                         example="00:00:00",
     *                     ),
     *                 ),
     *                 @OA\Property(
     *                     property="saturday",
     *                     type="object",
     *                     @OA\Property(
     *                         property="from",
     *                         type="string",
     *                         example="00:00:00",
     *                     ),
     *                     @OA\Property(
     *                         property="to",
     *                         type="string",
     *                         example="00:00:00",
     *                     ),
     *                 ),
     *                 @OA\Property(
     *                     property="sunday",
     *                     type="object",
     *                     @OA\Property(
     *                         property="from",
     *                         type="string",
     *                         example="00:00:00",
     *                     ),
     *                     @OA\Property(
     *                         property="to",
     *                         type="string",
     *                         example="00:00:00",
     *                     ),
     *                 )
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Успешно",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Ошибка: СТОА не найдена"
     *     )
     * )
     */
    public function setSchedule(Stoa $stoa, ImportRequest $request) : JsonResponse
    {
        $requestData = $request->all();
        $schedule = $stoa->schedule;

        if (!$schedule) {
            $schedule = new Schedule(['stoa_id' => $stoa->id]);
        }

        $schedule->importData($requestData, $stoa->id);
        $stoa->schedule = $schedule;

        return new JsonResponse(new StoaResource($stoa), 201);
    }

    /**
     * Delete Schedule for specified stoa
     *
     * @param Stoa $stoa
     * @return JsonResponse
     * @throws \Exception
     *
     * @OA\Delete(
     *     path="/api/schedules/{id}",
     *     tags={"schedule"},
     *     summary="Удаление расписания для СТОА",
     *     operationId="eraseSchedule",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="schedule id.",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Расписание не найдено"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Успешно",
     *     )
     * )
     */
    public function deleteSchedule(Stoa $stoa) : JsonResponse
    {
        $stoa->schedule->delete();

        return new JsonResponse('', 204);
    }

    /**
     * Import data from file
     *
     * @param Request $request
     * @return Response
     * @throws \Exception
     *
     * @OA\Post(
     *     path="/api/schedules/import",
     *     tags={"schedule"},
     *     summary="Импорт расписания",
     *     operationId="import",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 @OA\Property(
     *                     description="Файл",
     *                     property="file",
     *                     type="file",
     *                     format="file",
     *                 ),
     *                 required={"file"}
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Успешно",
     *     )
     * )
     */
    public function import(Request $request, DataImport $dataImportService): Response
    {
        $files = $request->file();

        /** @var UploadedFile $file */
        $file = array_pop($files);
        $fileName = $file->getClientOriginalName();
        $path = Storage::putFileAs('/', $file, $fileName);

        $dataImportService->import($path, $fileName);

        return new Response('', 201);
    }
}
