<?php

namespace Modules\Resource\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Booking\Http\Resources\BookingResource;
use Modules\Resource\Data\ResourceData;
use Modules\Resource\Http\Requests\StoreResourceRequest;
use Modules\Resource\Http\Resources\ResourceResource;
use Modules\Resource\Services\ResourceService;

/**
 * @OA\Tag(
 *     name="Resources",
 *     description="Управление ресурсами (комнаты, автомобили и т.д.)"
 * )
 */
class ResourceController extends Controller
{
    public function __construct(private readonly ResourceService $service) {}

    /**
     * @OA\Post(
     *     path="/api/resources",
     *     summary="Создание нового ресурса",
     *     tags={"Resources"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"name", "type"},
     *
     *             @OA\Property(property="name", type="string", example="Conference Room"),
     *             @OA\Property(property="type", type="string", example="room"),
     *             @OA\Property(property="description", type="string", example="Main hall with projector")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Ресурс создан",
     *
     *         @OA\JsonContent(ref="#/components/schemas/ResourceResource")
     *     ),
     *
     *     @OA\Response(response=422, description="Ошибка валидации")
     * )
     */
    public function store(StoreResourceRequest $request)
    {
        $data = ResourceData::from($request->validated());
        $resource = $this->service->create($data);

        return new ResourceResource($resource);
    }

    /**
     * @OA\Get(
     *     path="/api/resources",
     *     summary="Получить список ресурсов",
     *     tags={"Resources"},
     *
     *     @OA\Response(
     *         response=200,
     *         description="Список ресурсов",
     *
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/ResourceResource"))
     *     )
     * )
     */
    public function index()
    {
        return ResourceResource::collection($this->service->all());
    }

    /**
     * @OA\Get(
     *     path="/api/resources/{id}/bookings",
     *     summary="Получить бронирования для ресурса",
     *     tags={"Resources"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID ресурса",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Список бронирований",
     *
     *         @OA\JsonContent(type="array", @OA\Items(ref="#/components/schemas/BookingResource"))
     *     )
     * )
     */
    public function bookings(int $id)
    {
        return BookingResource::collection($this->service->getBookings($id));
    }
}
