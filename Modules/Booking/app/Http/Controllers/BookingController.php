<?php

namespace Modules\Booking\Http\Controllers;

use App\Http\Controllers\Controller;
use Modules\Booking\Data\BookingData;
use Modules\Booking\Http\Requests\StoreBookingRequest;
use Modules\Booking\Http\Resources\BookingResource;
use Modules\Booking\Services\BookingService;

/**
 * @OA\Tag(
 *     name="Bookings",
 *     description="Операции с бронированиями"
 * )
 */
class BookingController extends Controller
{
    public function __construct(private readonly BookingService $service) {}

    /**
     * @OA\Post(
     *     path="/api/bookings",
     *     summary="Создание нового бронирования",
     *     tags={"Bookings"},
     *
     *     @OA\RequestBody(
     *         required=true,
     *
     *         @OA\JsonContent(
     *             required={"resource_id", "user_id", "start_time", "end_time"},
     *
     *             @OA\Property(property="resource_id", type="integer", example=1),
     *             @OA\Property(property="user_id", type="integer", example=1),
     *             @OA\Property(property="start_time", type="string", format="date-time", example="2025-07-10T10:00:00Z"),
     *             @OA\Property(property="end_time", type="string", format="date-time", example="2025-07-10T12:00:00Z")
     *         )
     *     ),
     *
     *     @OA\Response(
     *         response=201,
     *         description="Успешное бронирование",
     *
     *         @OA\JsonContent(ref="#/components/schemas/BookingResource")
     *     ),
     *
     *     @OA\Response(
     *         response=422,
     *         description="Ошибка валидации"
     *     )
     * )
     */
    public function store(StoreBookingRequest $request)
    {
        $data = BookingData::from($request->validated());
        $booking = $this->service->create($data);

        return new BookingResource($booking);
    }

    /**
     * @OA\Delete(
     *     path="/api/bookings/{id}",
     *     summary="Удалить бронирование",
     *     tags={"Bookings"},
     *
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID бронирования",
     *
     *         @OA\Schema(type="integer")
     *     ),
     *
     *     @OA\Response(
     *         response=204,
     *         description="Бронирование удалено"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Бронирование не найдено"
     *     )
     * )
     */
    public function destroy(int $id)
    {
        $this->service->delete($id);

        return response()->json(null, 204);
    }
}
