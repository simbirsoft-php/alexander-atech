<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateStoaRequest as CreateRequest;
use App\Http\Requests\UpdateStoaRequest as UpdateRequest;
use App\Http\Resources\StoaResource;
use App\Models\Stoa;
use Illuminate\Http\JsonResponse;

/**
 * Class StoaController
 */
class StoaController extends Controller
{
    /**
     * Show all stoas
     *
     * @return \Illuminate\Http\Resources\Json\AnonymousResourceCollection
     *
     * @OA\Get(
     *     path="/api/stoas",
     *     tags={"stoa"},
     *     summary="Информация обо всех СТОА",
     *     description="Информация обо всех СТОА",
     *     operationId="index",
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *     )
     * )
     */
    public function index()
    {
        return StoaResource::collection(Stoa::all());
    }

    /**
     * Show specified stoa
     *
     * @param Stoa $stoa
     * @return StoaResource
     *
     * @OA\Get(
     *     path="/api/stoas/{id}",
     *     tags={"stoa"},
     *     summary="Информация о конкретной СТОА",
     *     description="Информация о конкретной СТОА",
     *     operationId="show",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Stoa id.",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="СТОА не найдена"
     *     )
     * )
     */
    public function show(Stoa $stoa)
    {
        return new StoaResource($stoa);
    }

    /**
     * Create stoa
     *
     * @param CreateRequest $request
     * @return StoaResource
     *
     * @OA\Post(
     *     path="/api/stoas",
     *     tags={"stoa"},
     *     summary="Добавление СТОА",
     *     description="Добавление СТОА",
     *     operationId="create",
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *                type="object",
     *                @OA\Property(
     *                    property="name",
     *                    description="Название СТОА",
     *                    type="string"
     *                ),
     *            )
     *        )
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Успешно",
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Некорректные данные"
     *     )
     * )
     */
    public function create(CreateRequest $request)
    {
        return new StoaResource(Stoa::create($request->all()));
    }

    /**
     * Update stoa
     *
     * @param Stoa $stoa
     * @param UpdateRequest $request
     * @return StoaResource
     *
     * @OA\Put(
     *     path="/api/stoas/{id}",
     *     tags={"stoa"},
     *     summary="Обновление СТОА",
     *     operationId="update",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Stoa id.",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *        required=true,
     *        @OA\MediaType(
     *            mediaType="application/x-www-form-urlencoded",
     *            @OA\Schema(
     *                type="object",
     *                @OA\Property(
     *                    property="name",
     *                    description="Новое название",
     *                    type="string"
     *                ),
     *            )
     *        )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Успешно",
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="СТОА не найдена"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Некорректные данные"
     *     )
     * )
     */
    public function update(Stoa $stoa, UpdateRequest $request)
    {
        $stoa->update($request->all());

        return new StoaResource($stoa);
    }

    /**
     * Delete stoa
     *
     * @param Stoa $stoa
     * @return JsonResponse
     * @throws \Exception
     *
     * @OA\Delete(
     *     path="/api/stoas/{id}",
     *     tags={"stoa"},
     *     summary="Удаление СТОА",
     *     operationId="delete",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         description="Stoa id.",
     *         required=true,
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="СТОА не найдена"
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Успешно",
     *     )
     * )
     */
    public function delete(Stoa $stoa)
    {
        $stoa->delete();

        return new JsonResponse('', 204);
    }
}
